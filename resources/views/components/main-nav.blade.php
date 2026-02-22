@props(['active' => ''])

@php
    $isHome = $active === 'home';
    $prefix = $isHome ? '' : '/';
@endphp

<nav class="main-nav">
    <a href="{{ $isHome ? '#home' : '/' }}" @class(['active' => $active === 'home'])>Home</a>
    <a href="{{ $prefix }}#about" @class(['active' => $active === 'about'])>About</a>
    <a href="{{ $prefix }}#menu" @class(['active' => $active === 'menu'])>Menu</a>
    <a href="/order" @class(['active' => $active === 'order'])>Order</a>
    <a href="/contact" @class(['active' => $active === 'contact'])>Contact</a>
</nav>
