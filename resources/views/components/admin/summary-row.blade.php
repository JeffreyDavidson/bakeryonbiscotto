@props(['label', 'value', 'total' => false])

<div style="display: flex; justify-content: space-between; padding: {{ $total ? '0.75rem 1rem' : '0.5rem 1rem' }}; font-size: 0.875rem; {{ $total ? 'border-top: 2px solid #e8d0b0; background: #fdf8f2;' : '' }}" {{ $attributes }}>
    <span style="color: {{ $total ? '#3d2314' : '#a08060' }}; {{ $total ? 'font-weight: 700; font-size: 1rem;' : '' }}">{{ $label }}</span>
    <span style="font-weight: {{ $total ? '800' : '600' }}; color: {{ $total ? '#8b5e3c' : '#3d2314' }}; {{ $total ? 'font-size: 1.25rem;' : '' }}">{{ $value }}</span>
</div>
