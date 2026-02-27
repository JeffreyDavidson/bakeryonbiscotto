<x-mail::message>
# Good News!

Hi {{ $entry->customer_name }},

A spot just opened up for **{{ $entry->requested_date->format('l, F j, Y') }}**!

@if($entry->product_interest)
We know you were interested in: *{{ $entry->product_interest }}*
@endif

Don't wait too long — spots fill up fast!

<x-mail::button :url="url('/order')">
Order Now
</x-mail::button>

Thanks for your patience,<br>
{{ \App\Models\Setting::get('owner_name', 'Cassie') }}
</x-mail::message>
