@props(['type', 'label' => null, 'rounded' => false])

@php
    $badgeLabel = $label ?? ucfirst($type);
    $colors = match($type) {
        'pending' => ['background' => '#fef3c7', 'color' => '#92400e'],
        'confirmed' => ['background' => '#e8d0b0', 'color' => '#3d2314'],
        'baking' => ['background' => '#fde68a', 'color' => '#78350f'],
        'ready' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'delivered' => ['background' => '#f3ebe0', 'color' => '#6b4c3b'],
        'pickup' => ['background' => '#fdf8f2', 'color' => '#6b4c3b'],
        'delivery' => ['background' => '#e8d0b0', 'color' => '#3d2314'],
        'cancelled' => ['background' => '#fee2e2', 'color' => '#991b1b'],
        'paid' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'refunded' => ['background' => '#fef9c3', 'color' => '#a16207'],
        'new' => ['background' => '#fef3c7', 'color' => '#92400e'],
        'read' => ['background' => '#e8d0b0', 'color' => '#3d2314'],
        'replied' => ['background' => '#d1fae5', 'color' => '#065f46'],
        'warn' => ['background' => '#f59e0b', 'color' => '#fff'],
        'danger' => ['background' => '#ef4444', 'color' => '#fff'],
        'critical' => ['background' => '#7f1d1d', 'color' => '#fff'],
        default => ['background' => '#f3f4f6', 'color' => '#374151'],
    };
    $radius = $rounded ? '9999px' : '0.375rem';
@endphp

<span style="display: inline-flex; align-items: center; border-radius: {{ $radius }}; padding: 0.2rem 0.5rem; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.02em; background: {{ $colors['background'] }}; color: {{ $colors['color'] }};" {{ $attributes }}>{{ $badgeLabel }}</span>
