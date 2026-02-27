<x-mail::message>
# Your Order Has Been Delivered! 🍞✨

Hi {{ $order->customer_name }},

Your order has been delivered — we hope you love everything!

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

Enjoyed your bread? We'd love to hear from you!

<x-mail::button :url="url('/review')">
Leave a Review
</x-mail::button>

Thank you for supporting a small local bakery — it means the world to us. 💛

With love,<br>
{{ \App\Models\Setting::get('owner_name', 'Cassie') }} — {{ \App\Models\Setting::get('business_name', 'Bakery on Biscotto') }}

<x-mail::subcopy>
Questions? Reply to this email or call us anytime.
</x-mail::subcopy>
</x-mail::message>
