<x-mail::message>
# Happy Birthday, {{ $customer->name }}! 🎂🎉

We hope your day is as sweet as our pastries! To celebrate, here's a special birthday treat just for you:

## {{ number_format($coupon->value, 0) }}% OFF your next order!

Use code **{{ $coupon->code }}** at checkout.

- **Discount:** {{ number_format($coupon->value, 0) }}% off your entire order
- **Code:** {{ $coupon->code }}
- **Valid until:** {{ $coupon->expires_at->format('F j, Y') }}
- **Single use** — make it count! 🧁

<x-mail::button :url="url('/order')">
Order Your Birthday Treats 🎁
</x-mail::button>

Wishing you the sweetest birthday ever! 🎈

With love and sprinkles,<br>
{{ \App\Models\Setting::get('owner_name', 'Cassie') }} & the {{ \App\Models\Setting::get('business_name', 'Bakery on Biscotto') }} team
</x-mail::message>
