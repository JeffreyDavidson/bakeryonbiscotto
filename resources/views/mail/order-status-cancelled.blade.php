<x-mail::message>
# Your Order Has Been Cancelled

Hi {{ $order->customer_name }},

We're sorry to let you know that your order **{{ $order->order_number }}** has been cancelled.

## Order Details

<x-mail::table>
| Item | Qty | Price |
|:-----|:---:|------:|
@foreach($order->items as $item)
| {{ $item->product_name }}@if($item->selections) ({{ implode(', ', $item->selections) }})@endif | {{ $item->quantity }} | ${{ number_format($item->unit_price * $item->quantity, 2) }} |
@endforeach
| **Total** | | **${{ number_format($order->total, 2) }}** |
</x-mail::table>

@if($order->payment_status === 'refunded')
A refund has been processed for this order.
@endif

If you have any questions or would like to place a new order, don't hesitate to reach out — we'd love to bake for you again!

<x-mail::button :url="url('/order')">
Place a New Order
</x-mail::button>

With love,<br>
{{ \App\Models\Setting::get('owner_name', 'Cassie') }} — {{ \App\Models\Setting::get('business_name', 'Bakery on Biscotto') }}

<x-mail::subcopy>
Questions? Reply to this email or call us anytime.
</x-mail::subcopy>
</x-mail::message>
