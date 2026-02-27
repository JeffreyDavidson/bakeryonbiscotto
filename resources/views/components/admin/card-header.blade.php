@props(['title', 'plain' => false])

@if($plain)
<div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.25rem; border-bottom: 1px solid var(--brand-150); background: var(--brand-50);" {{ $attributes }}>
    <h3 style="font-size: 0.875rem; font-weight: 700; color: var(--brand-800); text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $title }}</h3>
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
