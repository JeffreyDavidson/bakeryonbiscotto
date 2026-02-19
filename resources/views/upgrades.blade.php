<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Upgrades | Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --dark: #3D2314;
            --brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden: #D4A574;
            --accent: #C17F4E;
            --light: #FDF8F2;
            --white: #FFFFFF;
            --warm: #6B4C3B;
            --parchment: #f0e0c8;
            --ink: #2a1a0e;
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ── Section labels ── */
        .upgrade-label {
            text-align: center;
            padding: 60px 20px 20px;
            background: var(--light);
        }
        .upgrade-label h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--dark);
            margin-bottom: 4px;
        }
        .upgrade-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            color: var(--warm);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }
        .upgrade-divider {
            padding: 40px 20px;
            background: var(--light);
            text-align: center;
        }
        .upgrade-divider span {
            display: inline-block;
            width: 200px; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139,94,60,0.2), transparent);
        }

        /* ═══════════════════════════════════════
           1. HERO — shimmer text + scroll indicator
        ═══════════════════════════════════════ */
        .hero-v2 {
            position: relative;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: var(--dark);
        }
        .hero-v2-bg {
            position: absolute; inset: 0;
            background: url('/images/hero-banner.jpg') center/cover no-repeat;
            transform: scale(1.05);
        }
        .hero-v2-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                180deg,
                rgba(26,15,8,0.4) 0%,
                rgba(61,35,20,0.6) 40%,
                rgba(26,15,8,0.85) 100%
            );
        }
        /* Animated grain */
        .hero-v2-grain {
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }
        .hero-v2-content {
            position: relative; z-index: 3;
            text-align: center;
            padding: 0 40px;
        }
        .hero-v2-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3.5rem, 8vw, 6rem);
            font-weight: 700;
            color: var(--cream);
            line-height: 1.05;
            margin-bottom: 24px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }
        .hero-v2-content h1 em {
            font-style: italic; font-weight: 400;
            /* Shimmer gradient */
            background: linear-gradient(
                120deg,
                var(--golden) 0%,
                #f4d9a0 25%,
                var(--golden) 50%,
                #e8c080 75%,
                var(--golden) 100%
            );
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer-text 4s ease-in-out infinite;
        }
        @keyframes shimmer-text {
            0% { background-position: 200% center; }
            100% { background-position: -200% center; }
        }
        .hero-v2-tagline {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            color: var(--golden);
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(212,165,116,0.4);
            opacity: 0.9;
        }
        .hero-v2-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            color: rgba(245,230,208,0.8);
            max-width: 520px;
            line-height: 1.8;
            margin: 0 auto 36px;
            font-style: italic;
        }
        .hero-v2-btn {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 18px 44px;
            background: transparent;
            color: var(--golden);
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid var(--golden);
            border-radius: 0;
            text-decoration: none;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }
        .hero-v2-btn::before {
            content: '';
            position: absolute; inset: 0;
            background: var(--golden);
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: -1;
        }
        .hero-v2-btn:hover {
            color: var(--dark);
        }
        .hero-v2-btn:hover::before {
            transform: translateY(0);
        }
        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px; left: 50%; transform: translateX(-50%);
            z-index: 3;
            display: flex; flex-direction: column;
            align-items: center; gap: 8px;
        }
        .scroll-indicator span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: rgba(245,230,208,0.3);
        }
        .scroll-chevron {
            width: 24px; height: 24px;
            border-right: 2px solid rgba(212,165,116,0.4);
            border-bottom: 2px solid rgba(212,165,116,0.4);
            transform: rotate(45deg);
            animation: bounce-down 2s infinite;
        }
        @keyframes bounce-down {
            0%, 20%, 50%, 80%, 100% { transform: rotate(45deg) translateY(0); }
            40% { transform: rotate(45deg) translateY(8px); }
            60% { transform: rotate(45deg) translateY(4px); }
        }

        /* ═══════════════════════════════════════
           2. MARQUEE — with wheat icons between words
        ═══════════════════════════════════════ */
        .marquee-v2 {
            padding: 24px 0;
            background: var(--dark);
            overflow: hidden;
            position: relative;
            border-top: 1px solid rgba(212,165,116,0.1);
            border-bottom: 1px solid rgba(212,165,116,0.1);
        }
        .marquee-v2-track {
            display: flex;
            width: max-content;
            animation: marquee-scroll 40s linear infinite;
        }
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }
        .marquee-v2-content {
            display: flex;
            align-items: center;
            gap: 0;
            padding-right: 0;
            flex-shrink: 0;
        }
        .mv2-word {
            font-family: 'Dancing Script', cursive;
            font-size: 20px;
            color: var(--golden);
            white-space: nowrap;
            padding: 0 20px;
            opacity: 0.6;
        }
        .mv2-icon {
            color: var(--golden);
            opacity: 0.2;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════
           3. ORDER — Handwritten note style
        ═══════════════════════════════════════ */
        .order-v2 {
            padding: 100px 20px;
            background: var(--cream);
            position: relative;
            overflow: hidden;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.7' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
            background-color: var(--cream);
        }
        .order-v2::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.08), transparent 60%);
            pointer-events: none;
        }
        .order-note {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            position: relative;
        }
        /* Decorative quotes */
        .order-note::before {
            content: '🍞';
            display: block;
            font-size: 48px;
            margin-bottom: 24px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .order-note h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
            line-height: 1.2;
        }
        .order-note .note-body {
            font-family: 'Cormorant Garamond', serif;
            font-size: 19px;
            font-style: italic;
            color: var(--warm);
            line-height: 1.8;
            margin-bottom: 36px;
        }
        .order-note .note-body strong {
            color: var(--dark);
            font-style: normal;
            font-weight: 600;
        }
        .order-v2-btn {
            display: inline-flex; align-items: center; gap: 12px;
            padding: 20px 48px;
            background: var(--dark);
            color: var(--cream);
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 0;
            transition: all 0.4s;
            box-shadow: 0 4px 20px rgba(61,35,20,0.15);
            position: relative;
        }
        .order-v2-btn:hover {
            background: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(61,35,20,0.2);
        }
        .order-v2-btn svg { transition: transform 0.3s; }
        .order-v2-btn:hover svg { transform: translateX(4px); }
        .order-aside {
            margin-top: 32px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: var(--warm);
            opacity: 0.6;
        }

        /* ═══════════════════════════════════════
           4. FOOTER — warm and personal
        ═══════════════════════════════════════ */
        .footer-v2 {
            background: var(--dark);
            padding: 80px 20px 40px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .footer-v2::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--golden), var(--accent), var(--golden), transparent);
        }
        /* Warm glow */
        .footer-v2::after {
            content: '';
            position: absolute;
            top: -100px; left: 50%; transform: translateX(-50%);
            width: 600px; height: 300px;
            background: radial-gradient(ellipse, rgba(212,165,116,0.06), transparent 70%);
            pointer-events: none;
        }
        .footer-v2-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 8px;
            position: relative;
        }
        .footer-v2-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(245,230,208,0.4);
            margin-bottom: 32px;
        }
        /* Bread illustration divider */
        .footer-bread {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 32px;
        }
        .footer-bread-line {
            width: 60px; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.2));
        }
        .footer-bread-line:last-child {
            background: linear-gradient(90deg, rgba(212,165,116,0.2), transparent);
        }
        .footer-bread-icon {
            font-size: 24px;
            opacity: 0.4;
        }
        .footer-v2-location {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: rgba(245,230,208,0.5);
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }
        .footer-v2-links {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-bottom: 48px;
        }
        .footer-v2-links a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: var(--golden);
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s;
        }
        .footer-v2-links a::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; right: 0;
            height: 1px;
            background: var(--golden);
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        .footer-v2-links a:hover { color: var(--cream); }
        .footer-v2-links a:hover::after { transform: scaleX(1); }
        .footer-v2-email {
            display: inline-block;
            margin-bottom: 48px;
        }
        .footer-v2-email a {
            font-family: 'Dancing Script', cursive;
            font-size: 1.3rem;
            color: var(--golden);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-v2-email a:hover { color: var(--cream); }
        .footer-v2-copy {
            font-size: 12px;
            color: rgba(245,230,208,0.2);
            letter-spacing: 1px;
        }

        /* ═══════════════════════════════════════
           5. SECTION TRANSITIONS — gradient bridges
        ═══════════════════════════════════════ */
        .transition-demo {
            padding: 60px 20px;
            text-align: center;
        }
        .bridge-dark-to-cream {
            height: 80px;
            background: linear-gradient(180deg, var(--dark), var(--cream));
        }
        .bridge-cream-to-dark {
            height: 80px;
            background: linear-gradient(180deg, var(--cream), var(--dark));
        }
        /* Wave divider */
        .wave-bridge {
            position: relative;
            height: 80px;
            background: var(--cream);
        }
        .wave-bridge svg {
            position: absolute;
            top: 0; left: 0; right: 0;
            width: 100%;
            height: 80px;
        }
        .wave-bridge-reverse {
            position: relative;
            height: 80px;
            background: var(--dark);
        }
        .wave-bridge-reverse svg {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            width: 100%; height: 80px;
        }
    </style>
</head>
<body>

    {{-- ═══ 1. HERO UPGRADE ═══ --}}
    <div class="upgrade-label" style="padding-top:20px;">
        <h2>1. Hero Upgrade</h2>
        <p>Shimmer gradient on "Biscotto", refined typography with Cormorant Garamond, and an animated scroll-down indicator.</p>
    </div>

    <section class="hero-v2">
        <div class="hero-v2-bg"></div>
        <div class="hero-v2-overlay"></div>
        <div class="hero-v2-grain"></div>
        <div class="hero-v2-content">
            <h1>Bakery on<br><em>Biscotto</em></h1>
            <p class="hero-v2-tagline">Where Sourdough Dreams Come True</p>
            <p class="hero-v2-desc">Handcrafted sourdough and baked goods from our cottage kitchen to your table. Every creation starts with care, patience, and our beloved starter.</p>
            <a href="#" class="hero-v2-btn">
                Explore Our Menu
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <div class="scroll-chevron"></div>
        </div>
    </section>


    {{-- ═══ 2. MARQUEE UPGRADE ═══ --}}
    <div class="upgrade-label">
        <h2>2. Ingredients Marquee Upgrade</h2>
        <p>Wheat stalk icons between words instead of plain dots. Darker background to separate from hero, golden script font.</p>
    </div>

    <div class="marquee-v2">
        <div class="marquee-v2-track">
            @for ($i = 0; $i < 4; $i++)
            <div class="marquee-v2-content">
                <span class="mv2-word">flour</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
                <span class="mv2-word">water</span>
                <span class="mv2-icon">✦</span>
                <span class="mv2-word">salt</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
                <span class="mv2-word">time</span>
                <span class="mv2-icon">✦</span>
                <span class="mv2-word">love</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
                <span class="mv2-word">cheddar</span>
                <span class="mv2-icon">✦</span>
                <span class="mv2-word">cinnamon</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
                <span class="mv2-word">chocolate</span>
                <span class="mv2-icon">✦</span>
                <span class="mv2-word">garlic</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
                <span class="mv2-word">honey</span>
                <span class="mv2-icon">✦</span>
                <span class="mv2-word">patience</span>
                <span class="mv2-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C12 2 13 8 12 14C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/><path d="M12 5C12 5 16 9 15 14C13.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><path d="M12 5C12 5 8 9 9 14C10.5 10 12 5 12 5Z" fill="currentColor" opacity="0.4"/><line x1="12" y1="14" x2="12" y2="22" stroke="currentColor" stroke-width="1" opacity="0.3"/></svg>
                </span>
            </div>
            @endfor
        </div>
    </div>


    {{-- ═══ 3. ORDER UPGRADE ═══ --}}
    <div class="upgrade-label">
        <h2>3. Order Section Upgrade</h2>
        <p>Replaced the 1-2-3 numbered steps with a warm, personal invitation. Like a handwritten note from Cassie.</p>
    </div>

    <section class="order-v2">
        <div class="order-note">
            <h2>Ready for Fresh Bread?</h2>
            <p class="note-body">
                Every loaf is baked to order, just for you. Drop us an email with what you'd like and we'll take care of the rest. <strong>We deliver locally</strong> in the Four Corners and greater Orlando area, or you can pick up right from our kitchen.
            </p>
            <a href="mailto:bakeryonbiscotto@gmail.com?subject=Bread%20Order" class="order-v2-btn">
                Place Your Order
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <p class="order-aside">Orders need at least 2 days lead time. We'll confirm timing and details by email.</p>
        </div>
    </section>


    {{-- ═══ 4. FOOTER UPGRADE ═══ --}}
    <div class="upgrade-label">
        <h2>4. Footer Upgrade</h2>
        <p>Warmer, more personal. Dancing Script logo, bread emoji divider, golden gradient top border, uppercase link styling.</p>
    </div>

    <footer class="footer-v2">
        <h3 class="footer-v2-logo">Bakery on Biscotto</h3>
        <p class="footer-v2-tagline">With love and flour dust</p>

        <div class="footer-bread">
            <span class="footer-bread-line"></span>
            <span class="footer-bread-icon">🌾</span>
            <span class="footer-bread-line"></span>
        </div>

        <p class="footer-v2-location">📍 Davenport, FL · Local Pickup & Delivery</p>

        <div class="footer-v2-email">
            <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a>
        </div>

        <div class="footer-v2-links">
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook</a>
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram</a>
        </div>

        <p class="footer-v2-copy">&copy; {{ date('Y') }} Bakery on Biscotto. All rights reserved.</p>
    </footer>


    {{-- ═══ 5. SECTION TRANSITIONS ═══ --}}
    <div class="upgrade-label">
        <h2>5. Section Transitions</h2>
        <p>Smooth gradient bridges between dark and cream sections, so they don't feel like hard cuts. Two options: simple gradient or organic wave.</p>
    </div>

    <div style="background:var(--dark); padding: 40px; text-align:center;">
        <p style="font-family:'Dancing Script',cursive; font-size:24px; color:var(--cream);">Dark section (e.g. Menu)</p>
    </div>
    <div class="bridge-dark-to-cream"></div>
    <div style="background:var(--cream); padding: 40px; text-align:center;">
        <p style="font-family:'Dancing Script',cursive; font-size:24px; color:var(--dark);">Cream section (e.g. Reviews)</p>
    </div>

    <div class="upgrade-divider"><span></span></div>
    <p style="text-align:center; font-family:'Cormorant Garamond',serif; font-style:italic; color:var(--warm); padding:0 20px 20px;">Or with an organic wave shape:</p>

    <div style="background:var(--dark); padding: 40px; text-align:center;">
        <p style="font-family:'Dancing Script',cursive; font-size:24px; color:var(--cream);">Dark section</p>
    </div>
    <div class="wave-bridge">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,0 C360,80 1080,80 1440,0 L1440,80 L0,80 Z" fill="var(--cream)"/>
            <path d="M0,0 L1440,0 C1080,70 360,70 0,0 Z" fill="var(--dark)"/>
        </svg>
    </div>
    <div style="background:var(--cream); padding: 40px; text-align:center;">
        <p style="font-family:'Dancing Script',cursive; font-size:24px; color:var(--dark);">Cream section</p>
    </div>
    <div style="background:var(--cream);">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" style="display:block;">
            <path d="M0,80 C360,0 1080,0 1440,80 L1440,0 L0,0 Z" fill="var(--cream)"/>
            <path d="M0,80 L1440,80 C1080,10 360,10 0,80 Z" fill="var(--dark)"/>
        </svg>
    </div>
    <div style="background:var(--dark); padding: 40px; text-align:center;">
        <p style="font-family:'Dancing Script',cursive; font-size:24px; color:var(--cream);">Dark section</p>
    </div>

    <div style="padding: 80px 20px; text-align: center; background: var(--light);">
        <p style="color: var(--warm); font-family: 'Playfair Display', serif; font-size: 18px;">~ End of upgrades ~</p>
    </div>

</body>
</html>
