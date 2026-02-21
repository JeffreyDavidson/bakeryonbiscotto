<x-mail::message>
# Thank You for Your Order!

Hi {{ $order->customer_name }},

We've received your order and we're getting started on your fresh-baked goodies!

**Order Number:** {{ $order->order_number }}

## Order Details

<x-mail::table>
| Item | Qty | Price |
|:-----|:---:|------:|
@foreach($order->items as $item)
| {{ $item->product_name }}@if($item->selections) ({{ implode(', ', $item->selections) }})@endif | {{ $item->quantity }} | ${{ number_format($item->unit_price * $item->quantity, 2) }} |
@endforeach
| **Total** | | **${{ number_format($order->total, 2) }}** |
</x-mail::table>

@if($order->requested_date)
**Requested Date:** {{ $order->requested_date->format('l, F j, Y') }}
@endif

@if($order->notes)
**Your Notes:** {{ $order->notes }}
@endif

We'll reach out if we have any questions. Remember, sourdough takes love and time, so please allow at least 2 days for your order!

Thanks for supporting a small local bakery,<br>
{{ config('app.name') }}
</x-mail::message>
