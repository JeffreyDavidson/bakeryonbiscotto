@props(['name', 'size' => '2.75rem', 'context' => 'dark'])

@php
    $initial = strtoupper(substr($name, 0, 1));
    $bg = $context === 'dark'
        ? 'rgba(255,255,255,0.15)'
        : 'linear-gradient(135deg, var(--brand-600), var(--brand-700))';
    $border = $context === 'dark'
        ? '2px solid rgba(255,255,255,0.3)'
        : 'none';
@endphp

<div style="width: {{ $size }}; height: {{ $size }}; border-radius: 9999px; background: {{ $bg }}; border: {{ $border }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: calc({{ $size }} * 0.4); flex-shrink: 0;" {{ $attributes }}>{{ $initial }}</div>
