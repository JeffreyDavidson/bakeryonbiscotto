@props(['label', 'time' => null, 'dotColor' => 'var(--brand-600)'])

<div style="display: flex; align-items: baseline; gap: 0.5rem; font-size: 0.8rem; color: var(--brand-500);">
    <span style="display: inline-block; width: 0.5rem; height: 0.5rem; border-radius: 9999px; background: {{ $dotColor }}; flex-shrink: 0; margin-top: 0.3rem;"></span>
    <span><strong style="color: var(--brand-900);">{{ $label }}</strong>@if($time) — {{ $time }}@endif</span>
</div>
