<x-mail::message>
# Your Order is Ready! 🎉

Hi {{ $order->customer_name }},

Your order is fresh out of the oven and ready for {{ $order->fulfillment_type === 'delivery' ? 'delivery' : 'pickup' }}!

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

@if($order->fulfillment_type === 'delivery')
We'll be heading your way soon — keep an eye out! 🚗
@else
Come grab your goodies whenever you're ready!
@endif

Can't wait for you to try everything!

With love,<br>
Cassie — Bakery on Biscotto

<x-mail::subcopy>
Questions? Reply to this email or call us anytime.
</x-mail::subcopy>
</x-mail::message>
