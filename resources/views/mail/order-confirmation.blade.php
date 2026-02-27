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

@if($order->payment_method === 'paypal' && $order->paypal_invoice_url)
**Payment:** A PayPal invoice has been sent to your email. You can also pay directly here:

<x-mail::button :url="$order->paypal_invoice_url">
Pay Invoice
</x-mail::button>

Please complete payment by **{{ $order->payment_deadline?->format('l, F j, Y') ?? 'your pickup date' }}**.
@endif

@if($order->requested_date)
**Requested Date:** {{ $order->requested_date->format('l, F j, Y') }}@if($order->requested_time) at {{ $order->requested_time }}@endif

@endif

@if($order->notes)
**Your Notes:** {{ $order->notes }}
@endif

We'll reach out if we have any questions. Remember, sourdough takes love and time, so please allow at least 2 days for your order!

**A quick note on pickup & delivery:** If you can't make your scheduled time, please contact us as soon as possible to reschedule. Orders not picked up or rescheduled within 24 hours will be considered cancelled with no refund.

Enjoyed your bread? We'd love to hear from you! [Leave us a review]({{ url('/review') }}).

Thanks for supporting a small local bakery,<br>
{{ \App\Models\Setting::get('owner_name', 'Cassie') }}
</x-mail::message>
