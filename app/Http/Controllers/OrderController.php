<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_available', true)->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        return view('order', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'fulfillment_type' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:fulfillment_type,delivery|nullable|string|max:255',
            'delivery_zip' => 'required_if:fulfillment_type,delivery|nullable|string|max:10',
            'requested_date' => 'required|date|after_or_equal:' . now()->addDays(2)->toDateString(),
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:20',
        ]);

        // Calculate totals
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
            ];
        }

        if (empty($orderItems)) {
            return back()->withErrors(['items' => 'Please add at least one item to your order.']);
        }

        $deliveryFee = 0;
        if ($validated['fulfillment_type'] === 'delivery') {
            $deliveryFee = 5.00; // Base delivery fee
        }

        $total = $subtotal + $deliveryFee;

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'fulfillment_type' => $validated['fulfillment_type'],
            'delivery_address' => $validated['delivery_address'] ?? null,
            'delivery_zip' => $validated['delivery_zip'] ?? null,
            'requested_date' => $validated['requested_date'],
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        // Send emails
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order->load('items')));
            Mail::to(config('mail.notify_address'))->send(new NewOrderNotification($order->load('items')));
        } catch (\Exception $e) {
            report($e);
        }

        return redirect()->route('order.confirmation', $order->order_number);
    }

    public function confirmation(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('order-confirmation', compact('order'));
    }
}
