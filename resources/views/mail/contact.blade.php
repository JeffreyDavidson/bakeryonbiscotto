<x-mail::message>
# New Contact Message

**From:** {{ $data['name'] }} ({{ $data['email'] }})

@if(!empty($data['phone']))
**Phone:** {{ $data['phone'] }}
@endif

**Subject:** {{ $data['subject'] }}

<x-mail::panel>
{{ $data['message'] }}
</x-mail::panel>

You can reply directly to this email to respond.
</x-mail::message>
