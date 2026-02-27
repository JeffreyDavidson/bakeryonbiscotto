@props(['type', 'label' => null, 'rounded' => false])

@php
    $badgeLabel = $label ?? ucfirst($type);
    $colors = match($type) {
        'pending' => ['background' => '#fef3c7', 'color' => 'var(--status-warning-dark)'],
        'confirmed' => ['background' => 'var(--brand-200)', 'color' => 'var(--brand-900)'],
        'baking' => ['background' => '#fde68a', 'color' => '#78350f'],
        'ready' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'delivered' => ['background' => 'var(--brand-150)', 'color' => 'var(--brand-700)'],
        'pickup' => ['background' => 'var(--brand-50)', 'color' => 'var(--brand-700)'],
        'delivery' => ['background' => 'var(--brand-200)', 'color' => 'var(--brand-900)'],
        'cancelled' => ['background' => '#fee2e2', 'color' => 'var(--status-danger-dark)'],
        'paid' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'refunded' => ['background' => '#fef9c3', 'color' => '#a16207'],
        'new' => ['background' => '#fef3c7', 'color' => 'var(--status-warning-dark)'],
        'read' => ['background' => 'var(--brand-200)', 'color' => 'var(--brand-900)'],
        'replied' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'warn' => ['background' => '#f59e0b', 'color' => '#fff'],
        'danger' => ['background' => '#ef4444', 'color' => '#fff'],
        'critical' => ['background' => '#7f1d1d', 'color' => '#fff'],
        default => ['background' => 'var(--brand-50)', 'color' => 'var(--brand-800)'],
    };
    $radius = $rounded ? '9999px' : '0.375rem';
@endphp

<span style="display: inline-flex; align-items: center; border-radius: {{ $radius }}; padding: 0.2rem 0.5rem; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.02em; background: {{ $colors['background'] }}; color: {{ $colors['color'] }};" {{ $attributes }}>{{ $badgeLabel }}</span>
