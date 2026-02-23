<x-mail::message>
# We're Baking Your Order! 🍞

Hi {{ $order->customer_name }},

Great news — your order is in the oven! We're carefully preparing everything fresh just for you.

**Order Number:** {{ $order->order_number }}

## Your Items

<x-mail::table>
| Item | Qty | Price |
|:-----|:---:|------:|
@foreach($order->items as $item)
| {{ $item->product_name }}@if($item->selections) ({{ implode(', ', $item->selections) }})@endif | {{ $item->quantity }} | ${{ number_format($item->unit_price * $item->quantity, 2) }} |
@endforeach
| **Total** | | **${{ number_format($order->total, 2) }}** |
</x-mail::table>

@if($order->requested_date)
**{{ $order->fulfillment_type === 'delivery' ? 'Delivery' : 'Pickup' }} Date:** {{ $order->requested_date->format('l, F j, Y') }}@if($order->requested_time) at {{ $order->requested_time }}@endif

@endif

We'll let you know as soon as everything is ready!

With love from the oven,<br>
Cassie — Bakery on Biscotto

<x-mail::subcopy>
Questions? Reply to this email or call us anytime.
</x-mail::subcopy>
</x-mail::message>
