@props(['title', 'plain' => false])

@if($plain)
<div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.25rem; border-bottom: 1px solid #f3ebe0; background: #fdf8f2;" {{ $attributes }}>
    <h3 style="font-size: 0.875rem; font-weight: 700; color: #4a3225; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $title }}</h3>
    @if($slot->isNotEmpty())
        <div>{{ $slot }}</div>
    @endif
</div>
@else
<div data-admin-gradient-header {{ $attributes }}>
    <h3 data-header-title>{{ $title }}</h3>
    @if($slot->isNotEmpty())
        <div>{{ $slot }}</div>
    @endif
</div>
@endif
