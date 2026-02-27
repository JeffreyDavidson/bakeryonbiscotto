<x-mail::message>
# Thanks for Reaching Out!

Hi {{ $data['name'] }},

We received your message and we'll get back to you as soon as we can.

**Your message:**

<x-mail::panel>
**{{ $data['subject'] }}**

{{ $data['message'] }}
</x-mail::panel>

In the meantime, feel free to check out our menu and place an order!

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

{{ \App\Models\Setting::get('owner_name', 'Cassie') }}
</x-mail::message>
