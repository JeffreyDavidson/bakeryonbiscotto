<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\CapacityLimit;
use App\Models\Category;
use App\Models\Coupon;
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
     * Validate and apply a coupon code via AJAX.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string', 'subtotal' => 'required|numeric|min:0']);

        $code = strtoupper(trim($request->input('code')));
        $subtotal = (float) $request->input('subtotal');

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found.'], 422);
        }

        if (!$coupon->isValid()) {
            return response()->json(['error' => 'This coupon is no longer valid.'], 422);
        }

        if ($coupon->minimum_order && $subtotal < (float) $coupon->minimum_order) {
            return response()->json([
                'error' => 'Minimum order of $' . number_format($coupon->minimum_order, 2) . ' required for this coupon.',
            ], 422);
        }

        $discount = $coupon->calculateDiscount($subtotal);

        return response()->json([
            'success' => true,
            'coupon_id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discount,
            'label' => $coupon->type === 'percentage'
                ? number_format($coupon->value, 0) . '% off'
                : '$' . number_format($coupon->value, 2) . ' off',
        ]);
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

        // Apply coupon if provided
        $couponId = $request->input('coupon_id');
        $discountAmount = 0;
        if ($couponId) {
            $coupon = Coupon::find($couponId);
            if ($coupon && $coupon->isValid()) {
                $discountAmount = $coupon->calculateDiscount($calculated['subtotal']);
                $calculated['discount_amount'] = $discountAmount;
                $calculated['coupon_id'] = $coupon->id;
                $calculated['total'] = max(0, $calculated['total'] - $discountAmount);
            }
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
            'discount_amount' => $calculated['discount_amount'] ?? 0,
            'coupon_id' => $calculated['coupon_id'] ?? null,
            'total' => $calculated['total'],
            'status' => 'pending',
            'payment_status' => 'paid',
            'stripe_payment_intent' => $captureId, // Reusing column for PayPal capture ID
            'paid_at' => now(),
        ]);

        // Increment coupon usage
        if (!empty($calculated['coupon_id'])) {
            Coupon::where('id', $calculated['coupon_id'])->increment('times_used');
        }

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

    public function checkCapacity(string $date)
    {
        try {
            $carbon = \Carbon\Carbon::parse($date);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date'], 422);
        }

        $available = CapacityLimit::isAvailable($carbon);
        $remaining = CapacityLimit::remainingSlots($carbon);
        $limit = CapacityLimit::forDate($carbon);

        $holiday = \App\Models\Holiday::nearDate($carbon, 2);

        return response()->json([
            'available' => $available,
            'remaining' => $remaining === PHP_INT_MAX ? null : $remaining,
            'blocked' => $limit?->is_blocked ?? false,
            'max_orders' => $limit?->max_orders ?? null,
            'holiday' => $holiday ? [
                'name' => $holiday->name,
                'deadline' => $holiday->order_deadline->format('M j'),
                'deadline_passed' => $holiday->isDeadlinePassed(),
            ] : null,
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

    public function joinWaitlist(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'product_interest' => 'nullable|string|max:1000',
            'requested_date' => 'required|date|after_or_equal:today',
        ]);

        \App\Models\WaitlistEntry::create(array_merge($validated, [
            'status' => 'waiting',
        ]));

        return response()->json([
            'success' => true,
            'message' => "You're on the waitlist! We'll email you if a spot opens up.",
        ]);
    }
}
