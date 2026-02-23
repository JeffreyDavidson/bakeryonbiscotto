@props(['title' => null, 'subtitle' => null, 'headerStyle' => 'gradient', 'padding' => true])

<div style="border-radius: 0.75rem; border: 1px solid #e8d0b0; background: white; overflow: hidden; margin-bottom: 1.5rem;" {{ $attributes }}>
    @if($title)
        @if($headerStyle === 'flat')
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.25rem; border-bottom: 1px solid #f3ebe0; background: #fdf8f2;">
                <h3 style="font-size: 0.875rem; font-weight: 700; color: #4a3225; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $title }}</h3>
                @if($subtitle)
                    <span style="font-size: 0.8rem; color: #6b7280;">{{ $subtitle }}</span>
                @endif
            </div>
        @else
            <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e8d0b0; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #3d2314, #6b4c3b);">
                <span style="font-size: 1.125rem; font-weight: 700; color: white;">{{ $title }}</span>
                @if($subtitle)
                    <span style="font-size: 0.8rem; font-weight: 500; color: #3d2314; background: #fef3c7; padding: 0.25rem 0.625rem; border-radius: 9999px;">{{ $subtitle }}</span>
                @endif
            </div>
        @endif
    @endif
    @if($padding && !$title)
        <div style="padding: 1rem 1.25rem;">{{ $slot }}</div>
    @else
        {{ $slot }}
    @endif
</div>
