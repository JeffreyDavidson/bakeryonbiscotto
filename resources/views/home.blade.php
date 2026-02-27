@extends('layouts.storefront', ['title' => 'Bakery on Biscotto | Handcrafted Sourdough, Davenport FL', 'active' => 'home'])

@section('styles')
    <style>
        /* ═══════════════════════════════════
           HERO - Parallax + floating recipe card
        ═══════════════════════════════════ */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0;
            background: url('/images/hero-banner.jpg?v=2') center/cover no-repeat;
            transform: scale(1.1);
            will-change: transform;
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                180deg,
                rgba(61,35,20,0.5) 0%,
                rgba(61,35,20,0.65) 50%,
                rgba(61,35,20,0.88) 100%
            );
        }
        /* Flour particles */
        .flour-particles {
            position: absolute; inset: 0; pointer-events: none; overflow: hidden;
        }
        .flour {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(245,230,208,0.6);
            border-radius: 50%;
            animation: flour-fall linear infinite;
        }
        @keyframes flour-fall {
            0% { transform: translateY(-10px) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 0.6; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
        .hero-content {
            position: relative; z-index: 3;
            max-width: 1200px;
            padding: 120px 40px 80px;
            text-align: center;
        }
        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3.2rem, 7vw, 5.5rem);
            font-weight: 700; color: var(--cream);
            line-height: 1.05; margin-bottom: 24px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }
        .hero-text h1 em {
            font-style: italic; font-weight: 400;
            color: var(--golden);
        }
        .tagline-wrap {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin-bottom: 20px;
        }
        .tagline-flourish {
            color: var(--golden); font-size: 14px; opacity: 0.6;
        }
        .hero-text .tagline {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            color: var(--golden); margin-bottom: 0;
            text-shadow: 0 0 20px rgba(212,165,116,0.5), 0 0 40px rgba(212,165,116,0.2), 0 2px 6px rgba(0,0,0,0.4);
            letter-spacing: 1px;
        }
        .hero-text .hero-desc {
            font-size: 16px; color: rgba(245,230,208,0.85);
            max-width: 560px; line-height: 1.7; margin-bottom: 32px;
            margin-left: auto; margin-right: auto;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }
        .hero-btn {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 36px;
            background: var(--golden); color: var(--dark);
            font-weight: 600; font-size: 15px;
            border-radius: 100px; text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 24px rgba(193,127,78,0.3);
        }
        .hero-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 40px rgba(193,127,78,0.5);
            background: var(--cream);
        }
        .hero-btn svg { transition: transform 0.3s; }
        .hero-btn:hover svg { transform: translateX(4px); }

        /* Hero entrance animations */
        .hero-enter { opacity: 0; transform: translateY(30px); animation: enter 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .hero-enter-d1 { animation-delay: 0.2s; }
        .hero-enter-d2 { animation-delay: 0.4s; }
        .hero-enter-d3 { animation-delay: 0.6s; }
        .hero-enter-d4 { animation-delay: 0.8s; }
        @keyframes enter { to { opacity: 1; transform: translateY(0); } }

        /* ═══════════════════════════════════
           INGREDIENTS MARQUEE
        ═══════════════════════════════════ */
        .marquee-section {
            padding: 0;
            background: var(--dark);
            overflow: hidden;
            border-top: 1px solid rgba(212,165,116,0.15);
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .marquee-track {
            display: flex;
            animation: marquee-scroll 30s linear infinite;
            width: max-content;
        }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-content {
            display: flex; align-items: center;
            white-space: nowrap; padding: 16px 0;
        }
        .marquee-item {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 400;
            color: rgba(245,230,208,0.5);
            padding: 0 20px;
            font-style: italic;
        }
        .marquee-dot {
            color: var(--golden); opacity: 0.5;
            flex-shrink: 0;
            font-size: 10px;
            line-height: 1;
        }
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }

        /* ═══════════════════════════════════
           BOTANICAL DIVIDER
        ═══════════════════════════════════ */
        .divider {
            display: flex; align-items: center; justify-content: center;
            gap: 20px; padding: 40px 20px;
        }
        .divider-line {
            flex: 1; max-width: 180px; height: 2px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .divider-icon { opacity: 0.7; }

        /* ═══════════════════════════════════
           MENU - Baker's Table
        ═══════════════════════════════════ */
        .menu-scene {
            position: relative;
            padding: 100px 20px 120px;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 30%, rgba(139,94,60,0.05) 0%, transparent 40%),
                radial-gradient(ellipse at 80% 70%, rgba(139,94,60,0.04) 0%, transparent 40%),
                linear-gradient(180deg, #1a0f08 0%, #241508 10%, #1e1209 90%, #1a0f08 100%);
            overflow: hidden;
        }
        .menu-scene::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(92deg, transparent, transparent 80px, rgba(139,94,60,0.015) 80px, rgba(139,94,60,0.015) 82px);
            pointer-events: none;
        }
        .menu-candle-glow {
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(244,200,122,0.07) 0%, rgba(212,165,116,0.03) 30%, transparent 70%);
            pointer-events: none;
            z-index: 3;
            transform: translate(-50%, -50%);
            transition: left 0.3s ease-out, top 0.3s ease-out;
            animation: candle-flicker 3s infinite ease-in-out;
        }
        @keyframes candle-flicker {
            0%, 100% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            25% { opacity: 0.85; transform: translate(-50%, -50%) scale(0.97); }
            50% { opacity: 0.95; transform: translate(-50%, -50%) scale(1.02); }
            75% { opacity: 0.88; transform: translate(-50%, -50%) scale(0.99); }
        }
        .menu-flour-dust { position: absolute; inset: 0; pointer-events: none; z-index: 1; overflow: hidden; }
        .menu-flour-particle {
            position: absolute;
            background: rgba(245,230,208,0.12);
            border-radius: 50%;
            animation: menu-flour-drift linear infinite;
        }
        @keyframes menu-flour-drift {
            0% { transform: translateY(100%) translateX(0) rotate(0deg); opacity: 0; }
            5% { opacity: 1; }
            95% { opacity: 0.8; }
            100% { transform: translateY(-5%) translateX(40px) rotate(360deg); opacity: 0; }
        }
        .menu-teaser-inner {
            position: relative; z-index: 4;
            max-width: 800px; margin: 0 auto;
            text-align: center;
        }
        .menu-teaser-title {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3rem, 7vw, 4.5rem);
            font-weight: 700; color: var(--cream);
            margin-bottom: 12px;
            text-shadow: 0 0 40px rgba(212,165,116,0.3);
        }
        .menu-teaser-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 18px;
            color: rgba(245,230,208,0.5);
            margin-bottom: 48px;
        }
        .menu-teaser-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px; margin-bottom: 48px;
        }
        .menu-teaser-card {
            background: rgba(245,230,208,0.06);
            border: 1px solid rgba(212,165,116,0.12);
            border-radius: 12px;
            padding: 28px 20px;
            display: flex; flex-direction: column; gap: 8px;
            transition: all 0.3s ease;
        }
        .menu-teaser-card:hover {
            background: rgba(245,230,208,0.1);
            border-color: rgba(212,165,116,0.25);
            transform: translateY(-4px);
        }
        .menu-teaser-name {
            font-family: 'Dancing Script', cursive;
            font-size: 1.4rem; font-weight: 700; color: var(--cream);
        }
        .menu-teaser-desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 14px;
            color: rgba(245,230,208,0.4); line-height: 1.5;
        }
        .menu-teaser-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem; font-weight: 700; color: var(--golden);
        }
        .menu-teaser-btn {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 40px;
            background: var(--golden); color: var(--dark);
            font-family: 'Playfair Display', serif;
            font-weight: 700; font-size: 16px;
            border-radius: 100px; text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 24px rgba(193,127,78,0.3);
        }
        .menu-teaser-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 40px rgba(193,127,78,0.5);
            background: var(--cream);
        }
        .menu-teaser-btn svg { transition: transform 0.3s; }
        .menu-teaser-btn:hover svg { transform: translateX(4px); }

        /* ═══════════════════════════════════
           REVIEWS - Simplified homepage version
        ═══════════════════════════════════ */
        .reviews {
            padding: 100px 20px 80px;
            position: relative;
            background: var(--cream);
            overflow: hidden;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.02'/%3E%3C/svg%3E");
            background-color: var(--cream);
        }
        .reviews::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(212,165,116,0.08), transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(193,127,78,0.06), transparent 50%);
            pointer-events: none;
        }
        .section-head {
            text-align: center; margin-bottom: 60px;
        }
        .section-head h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.6rem);
            font-weight: 600; color: var(--dark);
        }
        .section-head .accent-line {
            width: 60px; height: 3px; margin: 16px auto 0;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            border-radius: 2px;
        }
        .reviews .section-head h2 {
            font-family: 'Dancing Script', cursive;
            color: var(--dark);
            font-size: clamp(2.8rem, 6vw, 4rem);
            font-weight: 700;
        }
        .reviews .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), var(--accent), var(--golden), transparent);
            width: 120px;
        }
        .reviews-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: var(--warm);
            margin-top: -32px;
            margin-bottom: 56px;
        }
        .review-featured {
            max-width: 800px;
            margin: 0 auto 64px;
            text-align: center;
            position: relative;
            padding: 48px 40px;
        }
        .review-featured::before {
            content: '\201C';
            position: absolute;
            top: -20px; left: 50%; transform: translateX(-50%);
            font-family: 'Playfair Display', serif;
            font-size: 120px;
            color: var(--golden);
            opacity: 0.15;
            line-height: 1;
            pointer-events: none;
        }
        .review-featured blockquote {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.4rem, 3vw, 1.8rem);
            font-weight: 400;
            font-style: italic;
            color: var(--dark);
            line-height: 1.8;
            margin-bottom: 24px;
            position: relative;
        }
        .review-featured .review-author-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .review-featured .author-line {
            width: 40px; height: 1px;
            background: var(--golden);
        }
        .review-featured .review-author {
            font-family: 'Playfair Display', serif;
            font-weight: 600; font-size: 16px;
            color: var(--accent); letter-spacing: 1px;
        }
        .review-featured .review-location {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px; color: var(--warm);
        }
        .reviews-conversation {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        .convo-card {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .convo-card.from-right {
            flex-direction: row-reverse;
            text-align: right;
        }
        .convo-avatar {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
            font-size: 20px; font-weight: 700;
            color: var(--dark);
            box-shadow: 0 4px 12px rgba(61,35,20,0.1);
            position: relative;
        }
        .convo-avatar::after {
            content: '';
            position: absolute; inset: -3px;
            border: 2px solid var(--golden);
            border-radius: 50%; opacity: 0.3;
        }
        .convo-bubble {
            background: var(--white);
            padding: 24px 28px;
            border-radius: 20px;
            position: relative;
            box-shadow: 0 4px 20px rgba(61,35,20,0.06), 0 1px 3px rgba(61,35,20,0.04);
            flex: 1;
            transition: all 0.3s;
        }
        .convo-bubble:hover {
            box-shadow: 0 8px 30px rgba(61,35,20,0.1), 0 1px 3px rgba(61,35,20,0.04);
            transform: translateY(-2px);
        }
        .convo-card:not(.from-right) .convo-bubble::before {
            content: '';
            position: absolute;
            left: -8px; top: 20px;
            width: 16px; height: 16px;
            background: var(--white);
            transform: rotate(45deg);
            box-shadow: -2px 2px 4px rgba(61,35,20,0.04);
        }
        .convo-card.from-right .convo-bubble::before {
            content: '';
            position: absolute;
            right: -8px; top: 20px;
            width: 16px; height: 16px;
            background: var(--white);
            transform: rotate(45deg);
            box-shadow: 2px -2px 4px rgba(61,35,20,0.04);
        }
        .convo-bubble .review-stars {
            color: var(--golden); font-size: 12px;
            letter-spacing: 2px; margin-bottom: 10px;
        }
        .convo-bubble blockquote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-style: italic;
            line-height: 1.7; color: var(--dark);
            margin-bottom: 12px;
        }
        .convo-meta {
            display: flex; align-items: center; gap: 8px;
        }
        .convo-card.from-right .convo-meta { justify-content: flex-end; }
        .convo-meta .review-author {
            font-family: 'Playfair Display', serif;
            font-weight: 600; font-size: 13px; color: var(--accent);
        }
        .convo-meta .dot {
            width: 3px; height: 3px;
            background: var(--golden); border-radius: 50%;
        }
        .convo-meta .review-location {
            font-size: 12px; color: var(--warm);
        }
        /* ═══════════════════════════════════
           SCROLL ANIMATIONS
        ═══════════════════════════════════ */
        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1; transform: translateY(0);
        }

        /* ═══════════════════════════════════
           MOBILE
        ═══════════════════════════════════ */
        @media (max-width: 1024px) {
            .hero-content {
                padding: 140px 20px 60px;
            }
        }
        @media (max-width: 768px) {
            .menu-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
.review-featured { padding: 32px 16px; }
            .convo-card, .convo-card.from-right { flex-direction: column; text-align: left; }
            .convo-card.from-right .convo-meta { justify-content: flex-start; }
            .convo-bubble::before { display: none !important; }
            .convo-avatar { width: 44px; height: 44px; font-size: 16px; }
        }
    </style>
@endsection

@section('content')
    {{-- ═══ HERO ═══ --}}
    <main id="main-content">
    <section class="hero" id="home">
        <div class="hero-bg" role="img" aria-label="Freshly baked sourdough bread on a rustic table"></div>
        <div class="hero-overlay"></div>
        <div class="flour-particles" id="flour-particles"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-enter hero-enter-d1">Bakery on<br><em>Biscotto</em></h1>
                <div class="tagline-wrap hero-enter hero-enter-d2">
                    <span class="tagline-flourish">✦</span>
                    <p class="tagline">Where Sourdough Dreams Come True</p>
                    <span class="tagline-flourish">✦</span>
                </div>
                <p class="hero-desc hero-enter hero-enter-d3">Handcrafted sourdough and baked goods from our cottage kitchen to your table. Every creation starts with care, patience, and our beloved starter.</p>
                <a href="/menu" class="hero-btn hero-enter hero-enter-d4">
                    Explore Our Menu
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ INGREDIENTS MARQUEE ═══ --}}
    <div class="marquee-section">
        <div class="marquee-track">
            @for ($i = 0; $i < 4; $i++)
            <div class="marquee-content" @if($i > 0) aria-hidden="true" @endif>
                <span class="marquee-item">flour</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">water</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">salt</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">time</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">love</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">garlic</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">honey</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">banana</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">almonds</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">patience</span><span class="marquee-dot">✦</span>
            </div>
            @endfor
        </div>
    </div>

    {{-- Divider --}}
    <div class="divider">
        <span class="divider-line"></span>
        <svg class="divider-icon" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M16 2C16 2 17.5 10 16 16C14.5 10 16 2 16 2Z" fill="var(--golden)" opacity="0.6"/>
            <path d="M16 6C16 6 21 11 19.5 17C18 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M16 6C16 6 11 11 12.5 17C14 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <line x1="16" y1="16" x2="16" y2="30" stroke="var(--golden)" stroke-width="1.5" opacity="0.4"/>
        </svg>
        <span class="divider-line"></span>
    </div>

    {{-- ═══ MENU TEASER ═══ --}}
    <section class="menu-scene" id="menu">
        {{-- Flour particles --}}
        <div class="menu-flour-dust">
            @for ($i = 0; $i < 15; $i++)
            <div class="menu-flour-particle" style="
                left: {{ rand(0, 100) }}%;
                width: {{ rand(2, 4) }}px;
                height: {{ rand(2, 4) }}px;
                animation-duration: {{ rand(18, 35) }}s;
                animation-delay: {{ $i * 1.2 }}s;
            "></div>
            @endfor
        </div>

        {{-- Candle glow --}}
        <div class="menu-candle-glow" id="menuCandleGlow"></div>

        <div class="menu-teaser-inner">
            <h2 class="menu-teaser-title reveal">Our Menu</h2>
            <p class="menu-teaser-tagline reveal">Everything baked fresh to order. Never frozen, never rushed.</p>

            @php
                $featuredProducts = $categories->flatMap->products->where('is_featured', true)->take(4);
                if ($featuredProducts->isEmpty()) {
                    $featuredProducts = $categories->flatMap->products->take(4);
                }
            @endphp

            <div class="menu-teaser-grid reveal">
                @foreach($featuredProducts as $product)
                <div class="menu-teaser-card">
                    <span class="menu-teaser-name">{{ $product->name }}</span>
                    @if($product->description)
                        <span class="menu-teaser-desc">{{ Str::limit($product->description, 60) }}</span>
                    @endif
                    <span class="menu-teaser-price">${{ number_format($product->price, 0) }}</span>
                </div>
                @endforeach
            </div>

            <a href="/menu" class="menu-teaser-btn reveal">
                View Full Menu
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>

    {{-- ═══ REVIEWS ═══ --}}
    <section class="reviews" id="reviews">
        <div class="section-head reveal">
            <h2>What Our Neighbors Say</h2>
            <div class="accent-line"></div>
        </div>
        <p class="reviews-subtitle reveal">Real words from real people who keep coming back.</p>

        @if($featuredReview)
        <div class="review-featured reveal">
            <blockquote>{{ $featuredReview->body }}</blockquote>
            <div class="review-author-wrap">
                <span class="author-line"></span>
                <span class="review-author">{{ $featuredReview->name }}</span>
                @if($featuredReview->favorite_bread)
                    <span class="dot" style="width:4px;height:4px;background:var(--golden);border-radius:50%;display:inline-block;"></span>
                    <span class="review-location">Loves the {{ $featuredReview->favorite_bread }}</span>
                @endif
                <span class="author-line"></span>
            </div>
        </div>
        @endif

        @if($approvedReviews->count())
        <div class="reviews-conversation">
            @foreach($approvedReviews as $review)
            <div class="convo-card {{ $loop->iteration % 2 === 0 ? 'from-right' : '' }} reveal">
                <div class="convo-avatar">{{ strtoupper(substr($review->name, 0, 1)) }}</div>
                <div class="convo-bubble">
                    <div class="review-stars">{!! str_repeat('★', $review->rating) !!}</div>
                    <blockquote>{{ $review->body }}</blockquote>
                    <div class="convo-meta">
                        <span class="review-author">{{ $review->name }}</span>
                        @if($review->favorite_bread)
                            <span class="dot"></span>
                            <span class="review-location">Fav: {{ $review->favorite_bread }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>

    </main>
@endsection

@section('floating')
    {{-- Floating Contact CTA --}}
    <a href="/contact" class="floating-contact" aria-label="Contact us">
        <span class="fc-icon">💬</span>
        <span class="fc-text">Questions?</span>
    </a>
@endsection

@section('scripts')
    <script>
        // ── Flour particles ──
        (function() {
            const container = document.getElementById('flour-particles');
            for (let i = 0; i < 30; i++) {
                const f = document.createElement('div');
                f.className = 'flour';
                f.style.left = Math.random() * 100 + '%';
                f.style.animationDuration = (6 + Math.random() * 8) + 's';
                f.style.animationDelay = Math.random() * 10 + 's';
                f.style.width = f.style.height = (2 + Math.random() * 4) + 'px';
                f.style.opacity = 0.2 + Math.random() * 0.4;
                container.appendChild(f);
            }
        })();

        // ── Parallax hero ──
        const heroBg = document.querySelector('.hero-bg');
        window.addEventListener('scroll', () => {
            const y = window.pageYOffset;
            if (y < window.innerHeight) {
                heroBg.style.transform = `scale(1.1) translateY(${y * 0.3}px)`;
            }
        }, { passive: true });

        // ── Scroll reveal ──
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // ── Menu candlelight ──
        const menuGlow = document.getElementById('menuCandleGlow');
        const menuScene = document.querySelector('.menu-scene');
        if (menuGlow && menuScene) {
            menuScene.addEventListener('mousemove', (e) => {
                const rect = menuScene.getBoundingClientRect();
                menuGlow.style.left = (e.clientX - rect.left) + 'px';
                menuGlow.style.top = (e.clientY - rect.top) + 'px';
            });
        }
    </script>
@endsection
