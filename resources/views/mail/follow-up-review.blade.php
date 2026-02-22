<x-mail::message>
# Hi {{ $order->customer_name }}! 👋

We hope you're enjoying your fresh-baked goodies from your recent order (**{{ $order->order_number }}**).

We'd love to hear how everything turned out! Your feedback means the world to a small local bakery like ours — it helps us keep improving and lets other customers know what to expect.

<x-mail::button :url="url('/review')">
Leave a Review
</x-mail::button>

It only takes a minute, and we truly appreciate it. ❤️

Thank you for supporting Bakery on Biscotto!

With love and flour dust,<br>
Cassie
</x-mail::message>
