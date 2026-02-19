<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Design | Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
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
            background: var(--dark);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════
           THE BAKER'S TABLE
           Looking down at a flour-dusted surface.
           A single parchment scroll with hand-drawn
           illustrations, flowing typography, and
           photos that break out of the frame.
        ═══════════════════════════════════════ */

        .menu-scene {
            position: relative;
            min-height: 100vh;
            padding: 60px 20px 100px;
            /* Wooden table texture */
            background:
                radial-gradient(ellipse at 50% 0%, rgba(212,165,116,0.12) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 80%, rgba(139,94,60,0.08) 0%, transparent 40%),
                radial-gradient(ellipse at 80% 60%, rgba(193,127,78,0.06) 0%, transparent 40%),
                linear-gradient(180deg, #2a1a0e 0%, #3D2314 5%, #33200f 50%, #2a1a0e 100%);
            /* Wood grain effect */
            background-size: 100%, 100%, 100%, 100%;
        }

        /* Flour dust particles */
        .flour-dust {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }
        .flour-particle {
            position: absolute;
            width: 3px; height: 3px;
            background: rgba(245,230,208,0.15);
            border-radius: 50%;
            animation: flour-float 20s infinite linear;
        }
        @keyframes flour-float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
        }

        /* ── The Parchment Scroll ── */
        .parchment {
            position: relative;
            z-index: 2;
            max-width: 780px;
            margin: 0 auto;
            background: var(--parchment);
            padding: 80px 60px 60px;
            /* Aged paper edges */
            box-shadow:
                0 0 0 1px rgba(139,94,60,0.15),
                4px 4px 0 rgba(139,94,60,0.08),
                8px 8px 0 rgba(139,94,60,0.04),
                0 20px 60px rgba(0,0,0,0.4),
                inset 0 0 80px rgba(139,94,60,0.06);
            /* Subtle paper texture */
            background-image:
                url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            background-color: var(--parchment);
        }
        /* Burned/aged edges */
        .parchment::before {
            content: '';
            position: absolute;
            inset: 0;
            box-shadow:
                inset 8px 0 20px rgba(139,94,60,0.08),
                inset -8px 0 20px rgba(139,94,60,0.08),
                inset 0 8px 20px rgba(139,94,60,0.06),
                inset 0 -8px 20px rgba(139,94,60,0.06);
            pointer-events: none;
        }
        /* Coffee ring stain (subtle) */
        .parchment::after {
            content: '';
            position: absolute;
            top: 140px; right: -20px;
            width: 100px; height: 100px;
            border-radius: 50%;
            border: 3px solid rgba(139,94,60,0.05);
            transform: rotate(-15deg);
            pointer-events: none;
        }

        /* ── Title Area ── */
        .menu-title {
            text-align: center;
            margin-bottom: 16px;
            position: relative;
        }
        .menu-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3rem, 7vw, 4.5rem);
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
            letter-spacing: 1px;
        }
        .menu-title-flourish {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin: 20px 0 8px;
        }
        .flourish-line {
            width: 80px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--brown), transparent);
        }
        .flourish-icon {
            color: var(--accent);
            font-size: 20px;
            line-height: 1;
        }
        .menu-epigraph {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: var(--warm);
            margin-bottom: 48px;
            letter-spacing: 0.3px;
        }

        /* ── Category Tabs ── */
        .scroll-tabs {
            display: flex;
            justify-content: center;
            gap: 0;
            margin-bottom: 48px;
            position: relative;
        }
        .scroll-tabs::after {
            content: '';
            position: absolute;
            bottom: 0; left: 10%; right: 10%;
            height: 1px;
            background: rgba(139,94,60,0.15);
        }
        .scroll-tab {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 500;
            padding: 12px 32px;
            border: none;
            background: transparent;
            color: var(--brown);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .scroll-tab::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 20%; right: 20%;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        .scroll-tab:hover { color: var(--dark); }
        .scroll-tab.active {
            color: var(--ink);
            font-weight: 600;
        }
        .scroll-tab.active::after { transform: scaleX(1); }

        /* ── Hand-drawn wheat divider (SVG) ── */
        .wheat-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 40px 0 36px;
            opacity: 0.5;
        }
        .wheat-divider .wd-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139,94,60,0.25), transparent);
        }

        /* ── Menu Item ── */
        .menu-item {
            padding: 24px 0;
            position: relative;
            transition: all 0.3s;
        }
        .menu-item + .menu-item {
            border-top: 1px solid rgba(139,94,60,0.08);
        }
        .menu-item:hover {
            padding-left: 6px;
        }
        .menu-item-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }
        .menu-item-name {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ink);
            white-space: nowrap;
        }
        .menu-item-dots {
            flex: 1;
            min-width: 20px;
            border-bottom: 2px dotted rgba(139,94,60,0.15);
            margin: 0 4px;
            align-self: baseline;
            position: relative;
            top: -4px;
        }
        .menu-item-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--accent);
            white-space: nowrap;
        }
        .menu-item-desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15px;
            color: var(--warm);
            line-height: 1.6;
            margin-top: 6px;
            padding-right: 60px;
        }

        /* ── Signature Item (breaks out of parchment) ── */
        .signature-item {
            position: relative;
            margin: 32px -30px 40px;
            padding: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: 4px;
            overflow: hidden;
            box-shadow:
                0 4px 20px rgba(0,0,0,0.08),
                0 0 0 1px rgba(139,94,60,0.1);
        }
        .signature-photo {
            height: 260px;
            overflow: hidden;
            position: relative;
        }
        .signature-photo img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s;
        }
        .signature-item:hover .signature-photo img {
            transform: scale(1.05);
        }
        .signature-body {
            background: var(--dark);
            padding: 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .signature-body::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(212,165,116,0.08), transparent 60%);
        }
        .signature-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--golden);
            margin-bottom: 12px;
            position: relative;
        }
        .signature-body h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 10px;
            position: relative;
        }
        .signature-body .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15px;
            color: rgba(245,230,208,0.55);
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
        }
        .signature-price {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: var(--golden);
            position: relative;
        }

        /* ── Photo Break (product photo that peeks out) ── */
        .photo-break {
            margin: 36px -30px;
            position: relative;
            overflow: hidden;
            border-radius: 3px;
            height: 200px;
            box-shadow:
                0 4px 20px rgba(0,0,0,0.08),
                0 0 0 1px rgba(139,94,60,0.1);
        }
        .photo-break img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s;
        }
        .photo-break:hover img { transform: scale(1.04); }
        .photo-break .photo-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 40px 24px 16px;
            background: linear-gradient(transparent, rgba(42,26,14,0.7));
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15px;
            color: var(--cream);
            letter-spacing: 0.5px;
        }

        /* ── Bundle Callout ── */
        .bundle-callout {
            margin: 40px 0 8px;
            padding: 32px;
            text-align: center;
            position: relative;
            border: 2px solid var(--golden);
            border-radius: 2px;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(212,165,116,0.06), transparent 70%),
                var(--parchment);
        }
        /* Corner ornaments */
        .bundle-callout::before,
        .bundle-callout::after {
            content: '✦';
            position: absolute;
            font-size: 10px;
            color: var(--golden);
        }
        .bundle-callout::before { top: 8px; left: 12px; }
        .bundle-callout::after { bottom: 8px; right: 12px; }
        .bundle-corners::before,
        .bundle-corners::after {
            content: '✦';
            position: absolute;
            font-size: 10px;
            color: var(--golden);
        }
        .bundle-corners::before { top: 8px; right: 12px; }
        .bundle-corners::after { bottom: 8px; left: 12px; }
        .bundle-callout h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
        }
        .bundle-callout .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: var(--warm);
            margin-bottom: 20px;
        }
        .bundle-price {
            display: inline-block;
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--accent);
            position: relative;
        }
        .bundle-price::before,
        .bundle-price::after {
            content: '~';
            margin: 0 12px;
            color: var(--golden);
            font-size: 1.5rem;
        }

        /* ── Decorative Wheat SVGs ── */
        .deco-wheat {
            position: absolute;
            z-index: 1;
            opacity: 0.06;
            pointer-events: none;
        }
        .deco-wheat-left {
            top: 200px; left: -80px;
            transform: rotate(-20deg);
        }
        .deco-wheat-right {
            top: 600px; right: -60px;
            transform: rotate(15deg) scaleX(-1);
        }
        .deco-wheat-bottom {
            bottom: 100px; left: 50%;
            transform: translateX(-50%) rotate(0deg);
        }

        /* ── Floating elements outside parchment ── */
        .table-objects {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 1;
        }
        /* Scattered flour on the table */
        .flour-smudge {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(245,230,208,0.04), transparent 70%);
        }

        /* ── Bottom seal / stamp ── */
        .menu-seal {
            text-align: center;
            margin-top: 48px;
            padding-top: 32px;
            border-top: 1px solid rgba(139,94,60,0.1);
        }
        .seal-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px; height: 100px;
            border: 2px solid var(--golden);
            border-radius: 50%;
            position: relative;
            margin-bottom: 16px;
        }
        .seal-circle::before {
            content: '';
            position: absolute;
            inset: 4px;
            border: 1px solid rgba(212,165,116,0.3);
            border-radius: 50%;
        }
        .seal-text {
            font-family: 'Dancing Script', cursive;
            font-size: 14px;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
            line-height: 1.2;
        }
        .seal-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 14px;
            color: var(--warm);
            letter-spacing: 0.5px;
        }

        /* ── Handwritten margin notes ── */
        .margin-note {
            position: absolute;
            font-family: 'Dancing Script', cursive;
            font-size: 13px;
            color: rgba(193,127,78,0.25);
            transform: rotate(-5deg);
            pointer-events: none;
            white-space: nowrap;
        }
        .margin-note.right {
            right: -10px;
            transform: rotate(3deg);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .parchment {
                padding: 60px 32px 48px;
                margin: 0 -10px;
            }
            .signature-item {
                grid-template-columns: 1fr;
                margin: 24px -16px 32px;
            }
            .signature-photo { height: 200px; }
            .photo-break { margin: 24px -16px; height: 160px; }
            .menu-item-desc { padding-right: 0; }
            .margin-note { display: none; }
            .bundle-callout { padding: 24px 20px; }
        }
        @media (max-width: 480px) {
            .parchment { padding: 48px 24px 40px; }
            .menu-item-name { font-size: 1.3rem; }
            .menu-item-row { flex-wrap: wrap; }
            .menu-item-dots { display: none; }
            .menu-item-price { margin-left: auto; }
            .scroll-tab { padding: 10px 20px; font-size: 15px; }
        }

        /* ── Reveal animation ── */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div class="menu-scene">

    {{-- Flour dust particles --}}
    <div class="flour-dust">
        @for ($i = 0; $i < 30; $i++)
        <div class="flour-particle" style="
            left: {{ rand(0, 100) }}%;
            animation-delay: {{ $i * 0.7 }}s;
            animation-duration: {{ rand(15, 30) }}s;
            width: {{ rand(2, 5) }}px;
            height: {{ rand(2, 5) }}px;
            opacity: {{ rand(5, 20) / 100 }};
        "></div>
        @endfor
    </div>

    {{-- Table objects (flour smudges) --}}
    <div class="table-objects">
        <div class="flour-smudge" style="top: 15%; left: 5%; width: 200px; height: 150px;"></div>
        <div class="flour-smudge" style="top: 45%; right: 3%; width: 180px; height: 180px;"></div>
        <div class="flour-smudge" style="bottom: 20%; left: 8%; width: 160px; height: 120px;"></div>
    </div>

    {{-- Decorative wheat --}}
    <svg class="deco-wheat deco-wheat-left" width="200" height="400" viewBox="0 0 200 400" fill="none">
        <path d="M100 400 C100 400 100 200 100 0" stroke="var(--golden)" stroke-width="2"/>
        <ellipse cx="85" cy="60" rx="25" ry="40" fill="var(--golden)" transform="rotate(-30 85 60)"/>
        <ellipse cx="115" cy="100" rx="25" ry="40" fill="var(--golden)" transform="rotate(30 115 100)"/>
        <ellipse cx="85" cy="140" rx="22" ry="35" fill="var(--golden)" transform="rotate(-25 85 140)"/>
        <ellipse cx="115" cy="180" rx="22" ry="35" fill="var(--golden)" transform="rotate(25 115 180)"/>
        <ellipse cx="90" cy="220" rx="18" ry="28" fill="var(--golden)" transform="rotate(-20 90 220)"/>
        <ellipse cx="110" cy="260" rx="18" ry="28" fill="var(--golden)" transform="rotate(20 110 260)"/>
    </svg>
    <svg class="deco-wheat deco-wheat-right" width="200" height="400" viewBox="0 0 200 400" fill="none">
        <path d="M100 400 C100 400 100 200 100 0" stroke="var(--golden)" stroke-width="2"/>
        <ellipse cx="85" cy="60" rx="25" ry="40" fill="var(--golden)" transform="rotate(-30 85 60)"/>
        <ellipse cx="115" cy="100" rx="25" ry="40" fill="var(--golden)" transform="rotate(30 115 100)"/>
        <ellipse cx="85" cy="140" rx="22" ry="35" fill="var(--golden)" transform="rotate(-25 85 140)"/>
        <ellipse cx="115" cy="180" rx="22" ry="35" fill="var(--golden)" transform="rotate(25 115 180)"/>
        <ellipse cx="90" cy="220" rx="18" ry="28" fill="var(--golden)" transform="rotate(-20 90 220)"/>
    </svg>

    {{-- ═══ THE PARCHMENT ═══ --}}
    <div class="parchment" x-data="{ tab: 'sourdough' }">

        {{-- Margin notes --}}
        <span class="margin-note" style="top: 320px; left: -8px;">our favorite ♡</span>
        <span class="margin-note right" style="top: 700px;">so good!</span>
        <span class="margin-note" style="top: 1100px; left: -4px;">try this one →</span>

        {{-- Title --}}
        <div class="menu-title reveal">
            <h2>Our Menu</h2>
            <div class="menu-title-flourish">
                <span class="flourish-line"></span>
                <span class="flourish-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2C12 2 13 8 12 12C11 8 12 2 12 2Z" fill="currentColor" opacity="0.6"/>
                        <path d="M12 4C12 4 16 8 15 13C13.5 9 12 4 12 4Z" fill="currentColor" opacity="0.4"/>
                        <path d="M12 4C12 4 8 8 9 13C10.5 9 12 4 12 4Z" fill="currentColor" opacity="0.4"/>
                        <line x1="12" y1="12" x2="12" y2="22" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                    </svg>
                </span>
                <span class="flourish-line"></span>
            </div>
        </div>
        <p class="menu-epigraph reveal">Everything baked fresh to order. Never frozen, never rushed.</p>

        {{-- Tabs --}}
        <div class="scroll-tabs reveal">
            <button class="scroll-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="scroll-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        {{-- ═══ SOURDOUGH TAB ═══ --}}
        <div x-show="tab === 'sourdough'" x-transition.opacity.duration.400ms>

            {{-- Signature: Regular Loaf with photo --}}
            <div class="signature-item reveal">
                <div class="signature-photo">
                    <img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf">
                </div>
                <div class="signature-body">
                    <span class="signature-label">✦ Our Signature</span>
                    <h3>Regular Loaf</h3>
                    <p class="desc">Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                    <span class="signature-price">$10</span>
                </div>
            </div>

            {{-- Menu items --}}
            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Cheddar</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Mozzarella & Garlic</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$14</span>
                </div>
                <p class="menu-item-desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
            </div>

            {{-- Wheat divider --}}
            <div class="wheat-divider">
                <span class="wd-line"></span>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M14 2C14 2 15 8 14 14C13 8 14 2 14 2Z" fill="var(--golden)" opacity="0.5"/>
                    <path d="M14 5C14 5 18 9 17 14C15.5 10 14 5 14 5Z" fill="var(--golden)" opacity="0.3"/>
                    <path d="M14 5C14 5 10 9 11 14C12.5 10 14 5 14 5Z" fill="var(--golden)" opacity="0.3"/>
                    <line x1="14" y1="14" x2="14" y2="26" stroke="var(--golden)" stroke-width="1" opacity="0.2"/>
                </svg>
                <span class="wd-line"></span>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Cinnamon & Sugar</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$14</span>
                </div>
                <p class="menu-item-desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate, Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate Almond, Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
            </div>

            {{-- Bundle callout --}}
            <div class="bundle-callout reveal">
                <span class="bundle-corners"></span>
                <h3>4 Pack of Mini Loaves</h3>
                <p class="desc">Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</p>
                <span class="bundle-price">$25</span>
            </div>
        </div>

        {{-- ═══ OTHER BREADS TAB ═══ --}}
        <div x-show="tab === 'other'" x-transition.opacity.duration.400ms>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Sourdough Honey Wheat Sandwich Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$10</span>
                </div>
                <p class="menu-item-desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
            </div>

            {{-- English muffins with photo --}}
            <div class="photo-break reveal">
                <img src="/images/product-english-muffins.jpg" alt="Sourdough English Muffins">
                <span class="photo-caption">Our famous English muffins, griddle-cooked to perfection</span>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Sourdough English Muffins</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">6ct · $8 &nbsp;|&nbsp; 12ct · $15</span>
                </div>
                <p class="menu-item-desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
            </div>

            <div class="wheat-divider">
                <span class="wd-line"></span>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M14 2C14 2 15 8 14 14C13 8 14 2 14 2Z" fill="var(--golden)" opacity="0.5"/>
                    <path d="M14 5C14 5 18 9 17 14C15.5 10 14 5 14 5Z" fill="var(--golden)" opacity="0.3"/>
                    <path d="M14 5C14 5 10 9 11 14C12.5 10 14 5 14 5Z" fill="var(--golden)" opacity="0.3"/>
                    <line x1="14" y1="14" x2="14" y2="26" stroke="var(--golden)" stroke-width="1" opacity="0.2"/>
                </svg>
                <span class="wd-line"></span>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Banana Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Banana Walnut Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Our classic banana bread loaded with crunchy toasted walnuts.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Pumpkin Chocolate Chip Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
            </div>

            <div class="menu-item reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Pumpkin Almond Chocolate Chip Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
            </div>
        </div>

        {{-- Bottom seal --}}
        <div class="menu-seal reveal">
            <div class="seal-circle">
                <span class="seal-text">Baked<br>with<br>Love</span>
            </div>
            <p class="seal-tagline">Handcrafted in our cottage kitchen, Davenport FL</p>
        </div>

    </div>{{-- /parchment --}}

</div>{{-- /menu-scene --}}

<script>
// Reveal on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
