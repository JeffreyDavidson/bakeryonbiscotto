@props(['title' => null, 'subtitle' => null])

<div style="border-radius: 0.75rem; border: 1px solid #e8d0b0; background: white; overflow: hidden; margin-bottom: 1.5rem;" {{ $attributes }}>
    @if($title)
        <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e8d0b0; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #3d2314, #6b4c3b);">
            <span style="font-size: 1.125rem; font-weight: 700; color: white;">{{ $title }}</span>
            @if($subtitle)
                <span style="font-size: 0.8rem; font-weight: 500; color: #3d2314; background: #fef3c7; padding: 0.25rem 0.625rem; border-radius: 9999px;">{{ $subtitle }}</span>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
