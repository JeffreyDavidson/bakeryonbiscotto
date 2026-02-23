@props(['type', 'label' => null])

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
        default => ['background' => '#f3f4f6', 'color' => '#374151'],
    };
@endphp

<span style="display: inline-flex; align-items: center; border-radius: 0.375rem; padding: 0.2rem 0.5rem; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.02em; background: {{ $colors['background'] }}; color: {{ $colors['color'] }};" {{ $attributes }}>{{ $badgeLabel }}</span>
