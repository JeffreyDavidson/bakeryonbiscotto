@props(['icon', 'title', 'subtitle' => null])

<div style="border-radius: 0.75rem; border: 2px dashed var(--brand-200); background: var(--brand-50); padding: 4rem 2rem; text-align: center;" {{ $attributes }}>
    <div style="font-size: 3.5rem; margin-bottom: 1rem;">{{ $icon }}</div>
    <div style="font-size: 1.25rem; font-weight: 600; color: var(--brand-900);">{{ $title }}</div>
    @if($subtitle)
        <div style="font-size: 0.875rem; color: var(--brand-500); margin-top: 0.375rem;">{{ $subtitle }}</div>
    @endif
    {{ $slot }}
</div>
