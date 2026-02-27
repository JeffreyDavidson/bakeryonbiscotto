@props(['variant' => 'primary', 'size' => 'md', 'href' => null, 'icon' => null])

@php
    $variants = match($variant) {
        'primary' => 'background: linear-gradient(135deg, var(--brand-600), var(--brand-700)); color: white; border: none;',
        'secondary' => 'background: var(--brand-200); color: var(--brand-900); border: none;',
        'ghost' => 'background: var(--brand-50); color: var(--brand-700); border: 1px solid var(--brand-200);',
        'dark' => 'background: linear-gradient(135deg, var(--brand-900), var(--brand-700)); color: white; border: none;',
        'danger' => 'background: #ef4444; color: white; border: none;',
        default => 'background: linear-gradient(135deg, var(--brand-600), var(--brand-700)); color: white; border: none;',
    };
    $sizing = match($size) {
        'lg' => 'padding: 0.625rem 1.25rem; font-size: 0.875rem;',
        'sm' => 'padding: 0.3rem 0.625rem; font-size: 0.7rem;',
        default => 'padding: 0.4rem 0.875rem; font-size: 0.75rem;',
    };
    $base = "display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 0.5rem; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.15s;";
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif style="{{ $base }} {{ $variants }} {{ $sizing }}" {{ $attributes }}>@if($icon)<span>{{ $icon }}</span>@endif{{ $slot }}</{{ $tag }}>
