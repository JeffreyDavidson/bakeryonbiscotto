@props(['variant' => 'primary', 'size' => 'md', 'href' => null, 'icon' => null])

@php
    $variants = match($variant) {
        'primary' => 'background: linear-gradient(135deg, #8b5e3c, #6b4c3b); color: white; border: none;',
        'secondary' => 'background: #e8d0b0; color: #3d2314; border: none;',
        'ghost' => 'background: #fdf8f2; color: #6b4c3b; border: 1px solid #e8d0b0;',
        'dark' => 'background: linear-gradient(135deg, #3d2314, #6b4c3b); color: white; border: none;',
        'danger' => 'background: #ef4444; color: white; border: none;',
        default => 'background: linear-gradient(135deg, #8b5e3c, #6b4c3b); color: white; border: none;',
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
