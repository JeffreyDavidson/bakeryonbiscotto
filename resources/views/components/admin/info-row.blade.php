@props(['label', 'value' => null, 'href' => null])

<div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 0.5rem 0; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem;" {{ $attributes }}>
    <span style="font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.05em; flex-shrink: 0;">{{ $label }}</span>
    <span style="color: #3d2314; font-weight: 500; text-align: right; word-break: break-word;">
        @if($href)
            <a href="{{ $href }}" style="color: #8b5e3c; text-decoration: none; font-weight: 600;">{{ $value ?? $slot }}</a>
        @elseif($value !== null)
            {{ $value }}
        @else
            {{ $slot }}
        @endif
    </span>
</div>
