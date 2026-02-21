<x-mail::message>
# New Order Received!

**{{ $order->customer_name }}** just placed an order.

**Order Number:** {{ $order->order_number }}<br>
**Phone:** {{ $order->customer_phone ?? 'Not provided' }}<br>
**Email:** {{ $order->customer_email ?? 'Not provided' }}

@if($order->requested_date)
**Requested Date:** {{ $order->requested_date->format('l, F j, Y') }}
@endif

@if($order->fulfillment_type === 'delivery')
**Delivery to:** {{ $order->delivery_address }}, {{ $order->delivery_zip }}
@else
**Pickup**
@endif

## Items

<x-mail::table>
| Item | Qty | Price |
|:-----|:---:|------:|
@foreach($order->items as $item)
| {{ $item->product_name }}@if($item->selections) ({{ implode(', ', $item->selections) }})@endif | {{ $item->quantity }} | ${{ number_format($item->unit_price * $item->quantity, 2) }} |
@endforeach
| **Total** | | **${{ number_format($order->total, 2) }}** |
</x-mail::table>

@if($order->notes)
**Customer Notes:** {{ $order->notes }}
@endif

<x-mail::button :url="config('app.url') . '/admin/orders'">
View Orders
</x-mail::button>

Cassie
</x-mail::message>
