@props(['active' => ''])

@php
    $isHome = $active === 'home';
    $prefix = $isHome ? '' : '/';
@endphp

<a href="#main-content" class="skip-to-main">Skip to main content</a>

<nav class="main-nav" aria-label="Main navigation">
    <a href="{{ $isHome ? '#home' : '/' }}" @class(['active' => $active === 'home'])>Home</a>
    <a href="/about" @class(['active' => $active === 'about'])>About</a>
    <a href="/menu" @class(['active' => $active === 'menu'])>Menu</a>
    <a href="/gallery" @class(['active' => $active === 'gallery'])>Gallery</a>
    <a href="/faq" @class(['active' => $active === 'faq'])>FAQ</a>
    <a href="/order" @class(['active' => $active === 'order'])>Order</a>
    <a href="/contact" @class(['active' => $active === 'contact'])>Contact</a>
</nav>
