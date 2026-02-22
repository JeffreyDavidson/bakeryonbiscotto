@props(['active' => ''])

@php
    $isHome = $active === 'home';
    $prefix = $isHome ? '' : '/';
@endphp

<a href="#main-content" class="skip-to-main">Skip to main content</a>

<nav class="main-nav" aria-label="Main navigation">
    <a href="{{ $isHome ? '#home' : '/' }}" @class(['active' => $active === 'home'])>Home</a>
    <a href="{{ $prefix }}#about" @class(['active' => $active === 'about'])>About</a>
    <a href="{{ $prefix }}#menu" @class(['active' => $active === 'menu'])>Menu</a>
    <a href="/order" @class(['active' => $active === 'order'])>Order</a>
    <a href="/contact" @class(['active' => $active === 'contact'])>Contact</a>
</nav>
