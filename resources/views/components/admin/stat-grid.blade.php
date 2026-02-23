@props(['cols' => 4])

<div style="display: grid; grid-template-columns: repeat({{ $cols }}, 1fr); gap: 0.75rem; margin-bottom: 1.5rem;" {{ $attributes }}>
    {{ $slot }}
</div>

@once
<style>
    @media (max-width: 768px) {
        [data-stat-grid] { grid-template-columns: repeat(2, 1fr) !important; }
    }
</style>
@endonce
