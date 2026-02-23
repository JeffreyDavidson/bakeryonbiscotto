@props(['title', 'plain' => false])

<div style="display: flex; justify-content: space-between; align-items: center; padding: {{ $plain ? '0.75rem 1.25rem' : '1rem 1.25rem' }}; border-bottom: 1px solid {{ $plain ? '#f3ebe0' : '#e8d0b0' }}; {{ $plain ? 'background: #fdf8f2;' : 'background: linear-gradient(135deg, #3d2314, #6b4c3b);' }}" {{ $attributes }}>
    <h3 style="font-size: 0.875rem; font-weight: 700; color: {{ $plain ? '#4a3225' : 'white' }}; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $title }}</h3>
    @if($slot->isNotEmpty())
        <div>{{ $slot }}</div>
    @endif
</div>
