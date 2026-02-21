<x-mail::message>
# New Review Submitted

**{{ $review->name }}** just left a {{ $review->rating }}-star review!

<x-mail::panel>
"{{ $review->body }}"
</x-mail::panel>

@if($review->favorite_bread)
**Favorite bread:** {{ $review->favorite_bread }}
@endif

This review is pending your approval.

<x-mail::button :url="config('app.url') . '/admin/reviews'">
View Reviews
</x-mail::button>

Thanks,<br>
Cassie
</x-mail::message>
