@props(['label', 'value', 'total' => false])

<div style="display: flex; justify-content: space-between; padding: {{ $total ? '0.75rem 1rem' : '0.5rem 1rem' }}; font-size: 0.875rem; {{ $total ? 'border-top: 2px solid var(--brand-200); background: var(--brand-50);' : '' }}" {{ $attributes }}>
    <span style="color: {{ $total ? 'var(--brand-900)' : 'var(--brand-500)' }}; {{ $total ? 'font-weight: 700; font-size: 1rem;' : '' }}">{{ $label }}</span>
    <span style="font-weight: {{ $total ? '800' : '600' }}; color: {{ $total ? 'var(--brand-600)' : 'var(--brand-900)' }}; {{ $total ? 'font-size: 1.25rem;' : '' }}">{{ $value }}</span>
</div>
