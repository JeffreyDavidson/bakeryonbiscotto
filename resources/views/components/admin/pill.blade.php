@props(['color' => null, 'bg' => null, 'borderColor' => null])

@php
    $bgColor = $bg ?? '#fdf8f2';
    $textColor = $color ?? '#6b4c3b';
    $bColor = $borderColor ?? '#e8d0b0';
@endphp

<span style="display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.375rem; background: {{ $bgColor }}; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; color: {{ $textColor }}; border: 1px solid {{ $bColor }}; margin: 0.125rem;" {{ $attributes }}>{{ $slot }}</span>
