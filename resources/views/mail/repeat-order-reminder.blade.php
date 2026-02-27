<x-mail::message>
# Hi {{ $order->customer_name }}! 👋

It's been about a month since your last order, and we've been baking up a storm over here at Bakery on Biscotto! We thought you might be ready for another round of fresh-baked goodness. 🥖

**Here's what you ordered last time:**

<x-mail::table>
| Item | Qty |
|:-----|:---:|
@foreach ($order->items as $item)
| {{ $item->product_name }} | {{ $item->quantity }} |
@endforeach
</x-mail::table>

Want to order the same thing (or mix it up)? We've made it easy — just click below and your last order will be pre-filled for you!

<x-mail::button :url="$reorderUrl">
Ready for More? 🛒
</x-mail::button>

We're so grateful for your support of our little bakery. Can't wait to bake for you again! ❤️

With love and flour dust,<br>
Cassie

<small>Don't want these reminders? Just reply to this email and let us know — no hard feelings!</small>
</x-mail::message>
