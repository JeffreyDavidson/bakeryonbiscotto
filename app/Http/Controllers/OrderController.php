<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\CapacityLimit;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_available', true)->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        $bundles = [];
        foreach ($categories as $cat) {
            foreach ($cat->products as $product) {
                if ($product->is_bundle && $product->bundle_category_id && $product->bundle_pick_count) {
                    $options = Product::where('category_id', $product->bundle_category_id)
                        ->where('id', '!=', $product->id)
                        ->where('is_available', true)
                        ->where('is_bundle', false)
                        ->orderBy('sort_order')
                        ->get(['id', 'name']);
                    $bundles[$product->id] = [
                        'pick_count' => $product->bundle_pick_count,
                        'options' => $options->map(fn($p) => ['id' => $p->id, 'name' => $p->name])->values(),
                    ];
                }
            }
        }

        return view('order', compact('categories', 'bundles'));
    }

    /**
     * Create a PayPal order (called via AJAX before PayPal popup).
     */
    public function createPayPalOrder(Request $request, PayPalService $paypal)
    {
        $validated = $this->validateOrder($request);
        $calculated = $this->calculateOrder($validated);

        if (empty($calculated['items'])) {
            return response()->json(['error' => 'No valid items in order.'], 422);
        }

        // Check capacity limits
        if (!CapacityLimit::isAvailable($validated['requested_date'])) {
            return response()->json(['error' => 'Sorry, this date is fully booked. Please choose another date.'], 422);
        }

        // Store pending order data in session
        session(['pending_order' => [
            'validated' => $validated,
            'calculated' => $calculated,
        ]]);

        $result = $paypal->createOrder($calculated['total'], 'Bakery on Biscotto Order');

        return response()->json(['id' => $result['id']]);
    }

    /**
     * Capture PayPal payment and create the order (called after PayPal approval).
     */
    public function capturePayPalOrder(Request $request, PayPalService $paypal)
    {
        $paypalOrderId = $request->input('paypal_order_id');
        $pendingOrder = session('pending_order');

        if (!$pendingOrder || !$paypalOrderId) {
            return response()->json(['error' => 'Invalid order session.'], 422);
        }

        $result = $paypal->captureOrder($paypalOrderId);

        \Log::info('PayPal capture result', ['result' => $result]);

        if (($result['status'] ?? '') !== 'COMPLETED') {
            return response()->json([
                'error' => 'Payment not completed. Status: ' . ($result['status'] ?? 'unknown'),
                'details' => $result['details'] ?? null,
            ], 422);
        }

        $validated = $pendingOrder['validated'];
        $calculated = $pendingOrder['calculated'];

        $captureId = $result['purchase_units'][0]['payments']['captures'][0]['id'] ?? null;

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'fulfillment_type' => $validated['fulfillment_type'],
            'delivery_address' => $validated['delivery_address'] ?? null,
            'delivery_zip' => $validated['delivery_zip'] ?? null,
            'requested_date' => $validated['requested_date'],
            'requested_time' => $validated['requested_time'],
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $calculated['subtotal'],
            'delivery_fee' => $calculated['delivery_fee'],
            'total' => $calculated['total'],
            'status' => 'pending',
            'payment_status' => 'paid',
            'stripe_payment_intent' => $captureId, // Reusing column for PayPal capture ID
            'paid_at' => now(),
        ]);

        foreach ($calculated['items'] as $item) {
            $order->items()->create($item);
        }

        // Send emails
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order->load('items')));
            Mail::to(config('mail.notify_address'))->send(new NewOrderNotification($order->load('items')));
        } catch (\Exception $e) {
            report($e);
        }

        session()->forget('pending_order');

        return response()->json([
            'success' => true,
            'redirect' => route('order.confirmation', $order->order_number),
        ]);
    }

    public function confirmation(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('order-confirmation', compact('order'));
    }

    protected function validateOrder(Request $request): array
    {
        return $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'fulfillment_type' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:fulfillment_type,delivery|nullable|string|max:255',
            'delivery_zip' => 'required_if:fulfillment_type,delivery|nullable|string|max:10',
            'requested_date' => 'required|date|after_or_equal:' . now()->addDays(2)->toDateString(),
            'requested_time' => 'required|string|max:20',
            'delivery_tier' => 'required_if:fulfillment_type,delivery|nullable|in:under5,5to10,over10',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:20',
            'items.*.selections' => 'nullable|array',
        ]);
    }

    protected function calculateOrder(array $validated): array
    {
        $subtotal = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            if (!$product->is_available) continue;

            $lineTotal = $product->price * $item['quantity'];
            $subtotal += $lineTotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->price,
                'quantity' => $item['quantity'],
                'line_total' => $lineTotal,
                'selections' => $item['selections'] ?? null,
            ];
        }

        $deliveryFee = 0;
        if ($validated['fulfillment_type'] === 'delivery') {
            $deliveryFee = match ($validated['delivery_tier'] ?? null) {
                'under5' => 0,
                '5to10' => 5.00,
                'over10' => 10.00,
                default => 0,
            };
        }

        return [
            'items' => $orderItems,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $subtotal + $deliveryFee,
        ];
    }
}
