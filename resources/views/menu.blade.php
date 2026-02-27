@extends('layouts.storefront', ['title' => 'Menu | Bakery on Biscotto', 'active' => 'menu'])

@section('body_attrs')style="background: #1a0f08;"@endsection

@section('styles')
    <style>
        /* ═══ MENU HERO ═══ */
        .menu-hero {
            padding: 140px 20px 40px;
            text-align: center;
            position: relative;
        }
        .menu-hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3rem, 7vw, 5rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 12px;
            text-shadow: 0 0 40px rgba(212,165,116,0.3);
        }
        .menu-hero p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgba(245,230,208,0.5);
            max-width: 500px;
            margin: 0 auto;
        }

        /* ═══ MENU - Baker's Table ═══ */
        .menu-scene {
            position: relative;
            padding: 40px 20px 120px;
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
            pointer-events: none; z-index: 3;
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
        .parchment-wrap {
            position: relative; z-index: 2;
            max-width: 780px; margin: 0 auto;
            filter: drop-shadow(0 20px 60px rgba(0,0,0,0.5)) drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        .order-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 40px;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark);
            text-decoration: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(212,165,116,0.3);
        }
        .order-cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(212,165,116,0.4);
        }
        .parchment {
            position: relative;
            background: var(--parchment);
            padding: 80px 64px 64px;
            clip-path: polygon(
                0% 0.3%, 2% 0%, 5% 0.5%, 8% 0.1%, 12% 0.6%, 15% 0%, 18% 0.4%,
                22% 0.1%, 25% 0.5%, 30% 0%, 35% 0.3%, 40% 0.1%, 45% 0.5%,
                50% 0%, 55% 0.4%, 60% 0.1%, 65% 0.5%, 70% 0%, 75% 0.3%,
                80% 0.1%, 85% 0.6%, 90% 0%, 93% 0.4%, 96% 0.1%, 100% 0.3%,
                100% 99.7%, 97% 100%, 94% 99.5%, 90% 99.9%, 86% 99.4%,
                82% 100%, 78% 99.6%, 74% 99.9%, 70% 99.5%, 65% 100%,
                60% 99.6%, 55% 100%, 50% 99.7%, 45% 100%, 40% 99.5%,
                35% 100%, 30% 99.7%, 25% 99.9%, 20% 99.5%, 15% 100%,
                10% 99.6%, 5% 100%, 2% 99.7%, 0% 100%
            );
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='5' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            background-color: var(--parchment);
        }
        .parchment::before {
            content: '';
            position: absolute; inset: 0;
            box-shadow: inset 12px 0 30px rgba(139,94,60,0.1), inset -12px 0 30px rgba(139,94,60,0.1), inset 0 12px 30px rgba(139,94,60,0.08), inset 0 -12px 30px rgba(139,94,60,0.08);
            pointer-events: none;
        }
        .parchment::after {
            content: '';
            position: absolute;
            top: -40px; left: 50%; transform: translateX(-50%);
            width: 300px; height: 200px;
            background: radial-gradient(ellipse, rgba(244,200,122,0.06), transparent 70%);
            pointer-events: none;
            animation: candle-flicker 4s infinite ease-in-out;
        }
        .menu-title { text-align: center; margin-bottom: 8px; position: relative; }
        .menu-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3.2rem, 8vw, 5rem);
            font-weight: 700; color: var(--ink); line-height: 1.1;
        }
        .title-flourish {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin: 24px 0 8px;
        }
        .tf-line {
            width: 100px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--brown), transparent);
        }
        .menu-epigraph {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-weight: 300; font-size: 18px;
            color: var(--warm); margin-bottom: 48px; letter-spacing: 0.5px;
        }
        .scroll-tabs {
            display: flex; justify-content: center; gap: 32px; margin-bottom: 52px;
        }
        .scroll-tab {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 500; padding: 10px 0;
            border: none; background: transparent; color: var(--brown);
            cursor: pointer; transition: all 0.4s; position: relative;
            letter-spacing: 2px; text-transform: uppercase;
        }
        .scroll-tab::before {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0;
            height: 2px; background: var(--accent);
            transform: scaleX(0); transform-origin: center;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-tab:hover { color: var(--dark); }
        .scroll-tab.active { color: var(--ink); font-weight: 700; }
        .scroll-tab.active::before { transform: scaleX(1); }
        .scroll-tab.active::after {
            content: ''; position: absolute;
            bottom: -5px; left: 50%; transform: translateX(-50%);
            width: 8px; height: 8px;
            background: radial-gradient(circle, var(--accent), #a0623a);
            border-radius: 50%; box-shadow: 0 0 6px rgba(193,127,78,0.4);
        }
        .menu-item { padding: 28px 0; position: relative; }
        .menu-item + .menu-item { border-top: 1px solid rgba(139,94,60,0.06); }
        .menu-item::after {
            content: ''; position: absolute; inset: -4px -20px;
            background: radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 70%);
            opacity: 0; transition: opacity 0.4s; pointer-events: none; border-radius: 8px;
        }
        .menu-item:hover::after { opacity: 1; }
        .menu-item:hover { z-index: 2; }
        .menu-item-row { display: flex; align-items: baseline; gap: 8px; }
        .menu-item-name {
            font-family: 'Dancing Script', cursive; font-size: 1.7rem;
            font-weight: 700; color: var(--ink); white-space: nowrap; position: relative;
        }
        .menu-item-name::after {
            content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
            height: 2px; background: var(--accent);
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); border-radius: 2px;
            clip-path: polygon(
                0% 60%, 5% 20%, 10% 70%, 15% 30%, 20% 80%, 25% 20%,
                30% 60%, 35% 10%, 40% 70%, 45% 40%, 50% 80%, 55% 20%,
                60% 60%, 65% 30%, 70% 70%, 75% 10%, 80% 60%, 85% 40%,
                90% 80%, 95% 30%, 100% 50%, 100% 100%, 0% 100%
            );
        }
        .menu-item:hover .menu-item-name::after { transform: scaleX(1); }
        .menu-item-dots {
            flex: 1; min-width: 20px;
            border-bottom: 2px dotted rgba(139,94,60,0.12);
            align-self: baseline; position: relative; top: -5px;
        }
        .menu-item-price {
            position: relative;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem; font-weight: 700;
            color: var(--accent); white-space: nowrap; z-index: 1;
        }
        .menu-item-price::before {
            content: ''; position: absolute; inset: -6px -14px;
            border: 1.5px solid rgba(193,127,78,0.25); border-radius: 50%;
            clip-path: ellipse(52% 58% at 48% 50%);
            transition: border-color 0.3s, background 0.3s;
        }
        .menu-item:hover .menu-item-price::before {
            border-color: rgba(193,127,78,0.5); background: rgba(193,127,78,0.04);
        }
        .menu-item-desc {
            font-family: 'Cormorant Garamond', serif; font-style: italic;
            font-size: 15.5px; color: var(--warm); line-height: 1.6;
            margin-top: 8px; padding-right: 40px;
        }
        .signature-item {
            position: relative; margin: 0 -34px 0;
            display: grid; grid-template-columns: 1fr 1fr;
            overflow: hidden; border-radius: 3px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12), 0 0 0 1px rgba(139,94,60,0.1);
        }
        .signature-photo { min-height: 280px; overflow: hidden; position: relative; }
        .signature-photo img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 8s ease;
        }
        .signature-item:hover .signature-photo img { transform: scale(1.1); }
        .steam-wrap {
            position: absolute; top: 0; left: 0; right: 0; height: 120px;
            pointer-events: none; overflow: hidden;
        }
        .steam {
            position: absolute; bottom: 0; width: 40px;
            background: linear-gradient(180deg, transparent 0%, rgba(245,230,208,0.08) 20%, rgba(245,230,208,0.12) 40%, rgba(245,230,208,0.06) 70%, transparent 100%);
            border-radius: 50%; filter: blur(8px); animation: steam-rise linear infinite;
        }
        .steam:nth-child(1) { left: 25%; height: 80px; animation-duration: 3.5s; animation-delay: 0s; }
        .steam:nth-child(2) { left: 45%; height: 100px; animation-duration: 4s; animation-delay: 0.8s; }
        .steam:nth-child(3) { left: 65%; height: 70px; animation-duration: 3s; animation-delay: 1.5s; }
        .steam:nth-child(4) { left: 35%; height: 90px; animation-duration: 4.5s; animation-delay: 2.2s; }
        @keyframes steam-rise {
            0% { transform: translateY(0) scaleX(1); opacity: 0; }
            15% { opacity: 1; }
            50% { transform: translateY(-60px) scaleX(1.5); opacity: 0.6; }
            100% { transform: translateY(-120px) scaleX(2); opacity: 0; }
        }
        .signature-body {
            background: var(--dark); padding: 40px;
            display: flex; flex-direction: column; justify-content: center;
            position: relative; overflow: hidden;
        }
        .signature-body::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(244,200,122,0.06), transparent 60%), radial-gradient(circle at 20% 80%, rgba(139,94,60,0.04), transparent 50%);
        }
        .signature-label {
            font-family: 'Cormorant Garamond', serif; font-size: 11px;
            text-transform: uppercase; letter-spacing: 5px;
            color: var(--golden); margin-bottom: 14px; position: relative;
        }
        .signature-body h3 {
            font-family: 'Dancing Script', cursive; font-size: 2.4rem;
            font-weight: 700; color: var(--cream); margin-bottom: 12px; position: relative;
        }
        .signature-body .desc {
            font-family: 'Cormorant Garamond', serif; font-style: italic;
            font-size: 16px; color: rgba(245,230,208,0.5); line-height: 1.7;
            margin-bottom: 24px; position: relative;
        }
        .signature-price-wrap {
            position: relative; display: flex; align-items: center; gap: 16px;
        }
        .signature-price {
            font-family: 'Dancing Script', cursive; font-size: 1.8rem;
            font-weight: 700; color: var(--golden); position: relative;
            text-shadow: 0 0 30px rgba(212,165,116,0.3);
        }
        .signature-price-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, var(--golden), transparent); opacity: 0.3;
        }
        .bundle-callout {
            margin: 48px -34px 8px; padding: 0; position: relative;
            background: linear-gradient(135deg, var(--dark) 0%, #4a2a18 100%);
            overflow: hidden; border-radius: 3px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15), 0 0 0 1px rgba(212,165,116,0.15);
        }
        .bundle-callout::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 0% 50%, rgba(244,200,122,0.1), transparent 60%), radial-gradient(ellipse at 100% 50%, rgba(212,165,116,0.06), transparent 50%);
            pointer-events: none;
        }
        .bundle-inner {
            display: flex; align-items: center; padding: 40px 48px; gap: 32px; position: relative;
        }
        .bundle-emoji {
            font-size: 56px; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3)); flex-shrink: 0;
        }
        .bundle-text { flex: 1; }
        .bundle-callout h3 {
            font-family: 'Dancing Script', cursive; font-size: 2.2rem;
            font-weight: 700; color: var(--cream); margin-bottom: 8px;
        }
        .bundle-callout .desc {
            font-family: 'Cormorant Garamond', serif; font-style: italic;
            font-size: 16px; color: rgba(245,230,208,0.5);
        }
        .bundle-price-tag {
            flex-shrink: 0; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            width: 100px; height: 100px; border-radius: 50%;
            background: radial-gradient(circle at 40% 35%, var(--golden), var(--accent));
            box-shadow: 0 4px 20px rgba(212,165,116,0.4), 0 0 40px rgba(212,165,116,0.15);
            position: relative;
        }
        .bundle-price-tag::before {
            content: ''; position: absolute; inset: 4px;
            border: 1.5px solid rgba(255,255,255,0.2); border-radius: 50%;
        }
        .bundle-price-tag .amount {
            font-family: 'Dancing Script', cursive; font-size: 2.2rem;
            font-weight: 700; color: var(--dark); line-height: 1;
        }
        .bundle-price-tag .label {
            font-family: 'Cormorant Garamond', serif; font-size: 10px;
            text-transform: uppercase; letter-spacing: 2px;
            color: rgba(61,35,20,0.6); margin-top: 2px;
        }
        .bundle-ribbon {
            position: absolute; top: 16px; right: -32px;
            background: var(--golden); color: var(--dark);
            font-family: 'Cormorant Garamond', serif; font-size: 11px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
            padding: 6px 40px; transform: rotate(45deg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .margin-note {
            position: absolute;
            font-family: 'Dancing Script', cursive; font-size: 13px;
            color: rgba(193,127,78,0.2); pointer-events: none; white-space: nowrap;
        }
        .menu-deco-wheat {
            position: absolute; z-index: 1; opacity: 0.04; pointer-events: none;
        }

        /* ═══ SCROLL ANIMATIONS ═══ */
        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 768px) {
            .parchment { padding: 60px 36px 48px; }
            .signature-item { grid-template-columns: 1fr; margin: 0 -20px; }
            .signature-photo { height: 220px; min-height: 220px; }
            .signature-body { padding: 32px; }
            .menu-item-desc { padding-right: 0; }
            .margin-note { display: none; }
            .bundle-callout { margin: 40px -20px 8px; }
            .bundle-inner { padding: 28px 24px; flex-wrap: wrap; justify-content: center; text-align: center; }
            .bundle-ribbon { display: none; }
}
        @media (max-width: 480px) {
            .parchment { padding: 48px 24px 40px; }
            .menu-item-name { font-size: 1.35rem; white-space: normal; }
            .menu-item-row { flex-wrap: wrap; }
            .menu-item-dots { display: none; }
            .menu-item-price { margin-left: auto; }
            .scroll-tab { font-size: 14px; letter-spacing: 1px; gap: 16px; }
            .main-nav {
                left: 10px; right: 10px; transform: none;
                flex-wrap: wrap; justify-content: center; border-radius: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <main id="main-content">

    {{-- Menu Hero --}}
    <div class="menu-hero">
        <h1>Our Menu</h1>
        <p>Everything baked fresh to order. Never frozen, never rushed.</p>
    </div>

    {{-- Full Menu --}}
    <section class="menu-scene" id="menu">
        {{-- Flour particles --}}
        <div class="menu-flour-dust">
            @for ($i = 0; $i < 25; $i++)
            <div class="menu-flour-particle" style="
                left: {{ rand(0, 100) }}%;
                width: {{ rand(2, 4) }}px;
                height: {{ rand(2, 4) }}px;
                animation-duration: {{ rand(18, 35) }}s;
                animation-delay: {{ $i * 0.9 }}s;
            "></div>
            @endfor
        </div>

        {{-- Decorative wheat --}}
        <svg class="menu-deco-wheat" style="top: 150px; left: 20px; transform: rotate(-25deg);" width="180" height="360" viewBox="0 0 180 360" fill="none">
            <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
            <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
            <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
            <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
            <ellipse cx="102" cy="170" rx="18" ry="32" fill="var(--golden)" transform="rotate(25 102 170)"/>
        </svg>
        <svg class="menu-deco-wheat" style="top: 500px; right: 30px; transform: rotate(20deg) scaleX(-1);" width="160" height="320" viewBox="0 0 180 360" fill="none">
            <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
            <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
            <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
            <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
        </svg>

        {{-- Candle glow --}}
        <div class="menu-candle-glow" id="menuCandleGlow"></div>

        <div class="parchment-wrap">
        <div class="parchment" x-data="{ tab: '{{ $categories->first()?->slug ?? 'sourdough-loaves' }}' }">

            {{-- Margin notes --}}
            <span class="margin-note" style="top: 380px; left: 8px; transform: rotate(-7deg);">our favorite ♡</span>
            <span class="margin-note" style="top: 780px; right: 12px; transform: rotate(4deg);">so good!</span>
            <span class="margin-note" style="top: 1050px; left: 10px; transform: rotate(-3deg);">try this →</span>

            {{-- Title --}}
            <div class="menu-title reveal">
                <h2>The Baker's Table</h2>
                <div class="title-flourish">
                    <span class="tf-line"></span>
                    <span class="tf-line"></span>
                </div>
            </div>
            <p class="menu-epigraph reveal">Everything baked fresh to order. Never frozen, never rushed.</p>

            {{-- Tabs --}}
            @if($categories->count() > 1)
            <div class="scroll-tabs reveal">
                @foreach($categories as $cat)
                    @if($cat->products->count())
                    <button class="scroll-tab" :class="{ 'active': tab === '{{ $cat->slug }}' }" @click="tab = '{{ $cat->slug }}'">{{ $cat->name }}</button>
                    @endif
                @endforeach
            </div>
            @endif

            @foreach($categories as $cat)
                @if($cat->products->count())
                <div x-show="tab === '{{ $cat->slug }}'" x-transition.opacity.duration.400ms>
                    @foreach($cat->products as $product)
                        @if($product->is_featured)
                            <div class="signature-item reveal">
                                @if($product->image)
                                <div class="signature-photo">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                    <div class="steam-wrap">
                                        <div class="steam"></div><div class="steam"></div><div class="steam"></div><div class="steam"></div>
                                    </div>
                                </div>
                                @endif
                                <div class="signature-body">
                                    <span class="signature-label">✦ Featured</span>
                                    <h3>{{ $product->name }}</h3>
                                    @if($product->description)
                                        <p class="desc">{{ $product->description }}</p>
                                    @endif
                                    <div class="signature-price-wrap">
                                        <span class="signature-price">${{ number_format($product->price, 0) }}</span>
                                        <span class="signature-price-line"></span>
                                    </div>
                                </div>
                            </div>
                        @elseif($cat->slug === 'bundles')
                            <div class="bundle-callout reveal">
                                <span class="bundle-ribbon">Best Deal</span>
                                <div class="bundle-inner">
                                    <span class="bundle-emoji">🎁</span>
                                    <div class="bundle-text">
                                        <h3>{{ $product->name }}</h3>
                                        @if($product->description)
                                            <p class="desc">{{ $product->description }}</p>
                                        @endif
                                    </div>
                                    <div class="bundle-price-tag">
                                        <span class="amount">${{ number_format($product->price, 0) }}</span>
                                        <span class="label">bundle</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="menu-item reveal">
                                <div class="menu-item-row">
                                    <span class="menu-item-name">{{ $product->name }}</span>
                                    <span class="menu-item-dots"></span>
                                    <span class="menu-item-price">${{ number_format($product->price, 0) }}</span>
                                </div>
                                @if($product->description)
                                    <p class="menu-item-desc">{{ $product->description }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                @endif
            @endforeach

        </div>

        <div style="text-align: center; margin-top: 48px;">
            <a href="/order" class="order-cta-btn">
                Place Your Order
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        </div>
    </section>

    </main>
@endsection

@section('scripts')
    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Menu candlelight
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
