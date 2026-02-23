@props(['icon', 'title', 'subtitle' => null])

<div style="border-radius: 0.75rem; border: 2px dashed #e8d0b0; background: #fdf8f2; padding: 4rem 2rem; text-align: center;" {{ $attributes }}>
    <div style="font-size: 3.5rem; margin-bottom: 1rem;">{{ $icon }}</div>
    <div style="font-size: 1.25rem; font-weight: 600; color: #3d2314;">{{ $title }}</div>
    @if($subtitle)
        <div style="font-size: 0.875rem; color: #a08060; margin-top: 0.375rem;">{{ $subtitle }}</div>
    @endif
    {{ $slot }}
</div>
