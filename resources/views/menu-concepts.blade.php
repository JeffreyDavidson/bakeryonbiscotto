<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Bakery on Biscotto</title>
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
            --candle: #f4c87a;
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: #1a0f08;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════════
           THE SCENE: Dark wood table, candlelit
        ═══════════════════════════════════════════ */
        .menu-scene {
            position: relative;
            min-height: 100vh;
            padding: 80px 20px 120px;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 30%, rgba(139,94,60,0.05) 0%, transparent 40%),
                radial-gradient(ellipse at 80% 70%, rgba(139,94,60,0.04) 0%, transparent 40%),
                linear-gradient(180deg, #1a0f08 0%, #241508 10%, #1e1209 90%, #1a0f08 100%);
        }

        /* Wood grain overlay */
        .menu-scene::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                92deg,
                transparent,
                transparent 80px,
                rgba(139,94,60,0.015) 80px,
                rgba(139,94,60,0.015) 82px
            );
            pointer-events: none;
        }

        /* ── Mouse-tracking candlelight ── */
        .candle-glow {
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle,
                rgba(244,200,122,0.07) 0%,
                rgba(212,165,116,0.03) 30%,
                transparent 70%
            );
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

        /* ── Floating flour particles ── */
        .flour-dust { position: fixed; inset: 0; pointer-events: none; z-index: 1; overflow: hidden; }
        .flour-particle {
            position: absolute;
            background: rgba(245,230,208,0.12);
            border-radius: 50%;
            animation: flour-drift linear infinite;
        }
        @keyframes flour-drift {
            0% { transform: translateY(100vh) translateX(0) rotate(0deg); opacity: 0; }
            5% { opacity: 1; }
            95% { opacity: 0.8; }
            100% { transform: translateY(-5vh) translateX(40px) rotate(360deg); opacity: 0; }
        }

        /* ── Table objects: scattered ingredients ── */
        .table-scatter {
            position: absolute;
            pointer-events: none;
            z-index: 1;
            opacity: 0.08;
        }

        /* ═══════════════════════════════════════════
           THE PARCHMENT — torn organic edges
        ═══════════════════════════════════════════ */
        .parchment-wrap {
            position: relative;
            z-index: 2;
            max-width: 780px;
            margin: 0 auto;
            /* Torn edge effect using clip-path */
            filter: drop-shadow(0 20px 60px rgba(0,0,0,0.5))
                    drop-shadow(0 4px 12px rgba(0,0,0,0.3));
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
            /* Paper texture */
            background-image:
                url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='5' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            background-color: var(--parchment);
        }
        /* Aged edges shadow */
        .parchment::before {
            content: '';
            position: absolute; inset: 0;
            box-shadow:
                inset 12px 0 30px rgba(139,94,60,0.1),
                inset -12px 0 30px rgba(139,94,60,0.1),
                inset 0 12px 30px rgba(139,94,60,0.08),
                inset 0 -12px 30px rgba(139,94,60,0.08);
            pointer-events: none;
        }
        /* Candle glow on parchment */
        .parchment::after {
            content: '';
            position: absolute;
            top: -40px; left: 50%; transform: translateX(-50%);
            width: 300px; height: 200px;
            background: radial-gradient(ellipse, rgba(244,200,122,0.06), transparent 70%);
            pointer-events: none;
            animation: candle-flicker 4s infinite ease-in-out;
        }

        /* ── Coffee ring stain ── */
        .coffee-ring {
            position: absolute;
            width: 90px; height: 85px;
            border: 3px solid rgba(139,94,60,0.06);
            border-radius: 50%;
            top: 160px; right: 30px;
            transform: rotate(-12deg);
            pointer-events: none;
        }
        .coffee-ring::after {
            content: '';
            position: absolute;
            inset: 4px;
            border: 1px solid rgba(139,94,60,0.03);
            border-radius: 50%;
        }

        /* ═══════════════════════════════════════════
           TITLE with ink-drip animation
        ═══════════════════════════════════════════ */
        .menu-title {
            text-align: center;
            margin-bottom: 8px;
            position: relative;
        }
        .menu-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3.2rem, 8vw, 5rem);
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
            position: relative;
            display: inline-block;
        }
        /* Ink drip from the "M" */
        .ink-drip {
            position: absolute;
            bottom: -18px;
            left: 22%;
            width: 2px;
            height: 0;
            background: linear-gradient(180deg, var(--ink), rgba(42,26,14,0.3), transparent);
            animation: drip 3s ease-in 1s forwards;
            border-radius: 0 0 2px 2px;
        }
        .ink-drip::after {
            content: '';
            position: absolute;
            bottom: -3px; left: -1.5px;
            width: 5px; height: 5px;
            background: var(--ink);
            border-radius: 50%;
            opacity: 0;
            animation: drip-drop 3s ease-in 1s forwards;
        }
        @keyframes drip { 0% { height: 0; } 100% { height: 24px; } }
        @keyframes drip-drop { 0%, 80% { opacity: 0; } 100% { opacity: 0.4; } }

        /* Ornate flourish */
        .title-flourish {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin: 24px 0 8px;
        }
        .tf-line {
            width: 100px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--brown), transparent);
        }
        .tf-ornament { color: var(--accent); opacity: 0.6; }

        .menu-epigraph {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-weight: 300;
            font-size: 18px;
            color: var(--warm);
            margin-bottom: 48px;
            letter-spacing: 0.5px;
        }

        /* ═══════════════════════════════════════════
           TABS — wax-sealed tab look
        ═══════════════════════════════════════════ */
        .scroll-tabs {
            display: flex; justify-content: center;
            gap: 32px; margin-bottom: 52px;
            position: relative;
        }
        .scroll-tab {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 500;
            padding: 10px 0;
            border: none; background: transparent;
            color: var(--brown);
            cursor: pointer; transition: all 0.4s;
            position: relative;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .scroll-tab::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-tab:hover { color: var(--dark); }
        .scroll-tab.active { color: var(--ink); font-weight: 700; }
        .scroll-tab.active::before { transform: scaleX(1); }
        /* Wax dot on active tab */
        .scroll-tab.active::after {
            content: '';
            position: absolute;
            bottom: -5px; left: 50%; transform: translateX(-50%);
            width: 8px; height: 8px;
            background: radial-gradient(circle, var(--accent), #a0623a);
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(193,127,78,0.4);
        }

        /* ═══════════════════════════════════════════
           MENU ITEMS — ink-reveal on scroll
        ═══════════════════════════════════════════ */
        .menu-item {
            padding: 28px 0;
            position: relative;
        }
        .menu-item + .menu-item {
            border-top: 1px solid rgba(139,94,60,0.06);
        }
        /* Warm glow on hover */
        .menu-item::after {
            content: '';
            position: absolute;
            inset: -4px -20px;
            background: radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
            border-radius: 8px;
        }
        .menu-item:hover::after { opacity: 1; }
        .menu-item:hover { z-index: 2; }

        .menu-item-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }
        .menu-item-name {
            font-family: 'Dancing Script', cursive;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--ink);
            white-space: nowrap;
            position: relative;
        }
        /* Handwritten underline on hover */
        .menu-item-name::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            /* Wobbly hand-drawn effect */
            border-radius: 2px;
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
            align-self: baseline;
            position: relative; top: -5px;
        }
        /* Hand-drawn price circles */
        .menu-item-price {
            position: relative;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent);
            white-space: nowrap;
            z-index: 1;
        }
        .menu-item-price::before {
            content: '';
            position: absolute;
            inset: -6px -14px;
            border: 1.5px solid rgba(193,127,78,0.25);
            border-radius: 50%;
            /* Hand-drawn wobbly circle */
            clip-path: ellipse(52% 58% at 48% 50%);
            transition: border-color 0.3s, background 0.3s;
        }
        .menu-item:hover .menu-item-price::before {
            border-color: rgba(193,127,78,0.5);
            background: rgba(193,127,78,0.04);
        }

        .menu-item-desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15.5px;
            color: var(--warm);
            line-height: 1.6;
            margin-top: 8px;
            padding-right: 40px;
        }

        /* ═══════════════════════════════════════════
           SIGNATURE ITEM — photo with steam effect
        ═══════════════════════════════════════════ */
        .signature-item {
            position: relative;
            margin: 0 -34px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border-radius: 3px;
            box-shadow:
                0 8px 30px rgba(0,0,0,0.12),
                0 0 0 1px rgba(139,94,60,0.1);
        }
        .signature-photo {
            min-height: 280px; overflow: hidden; position: relative;
        }
        .signature-photo img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 8s ease;
        }
        .signature-item:hover .signature-photo img {
            transform: scale(1.1);
        }
        /* Steam rising from bread */
        .steam-wrap {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 120px;
            pointer-events: none;
            overflow: hidden;
        }
        .steam {
            position: absolute;
            bottom: 0;
            width: 40px;
            background: linear-gradient(
                180deg,
                transparent 0%,
                rgba(245,230,208,0.08) 20%,
                rgba(245,230,208,0.12) 40%,
                rgba(245,230,208,0.06) 70%,
                transparent 100%
            );
            border-radius: 50%;
            filter: blur(8px);
            animation: steam-rise linear infinite;
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
            background: var(--dark);
            padding: 40px;
            display: flex; flex-direction: column; justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .signature-body::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(circle at 80% 20%, rgba(244,200,122,0.06), transparent 60%),
                radial-gradient(circle at 20% 80%, rgba(139,94,60,0.04), transparent 50%);
        }
        .signature-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: var(--golden);
            margin-bottom: 14px;
            position: relative;
        }
        .signature-body h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 12px;
            position: relative;
        }
        .signature-body .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(245,230,208,0.5);
            line-height: 1.7;
            margin-bottom: 24px;
            position: relative;
        }
        .signature-price-wrap {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .signature-price {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--golden);
            position: relative;
            text-shadow: 0 0 30px rgba(212,165,116,0.3);
        }
        .signature-price-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, var(--golden), transparent);
            opacity: 0.3;
        }

        /* ═══════════════════════════════════════════
           PHOTO BREAK — polaroid pinned at angle
        ═══════════════════════════════════════════ */
        .polaroid-break {
            margin: 40px auto;
            width: 320px;
            background: white;
            padding: 12px 12px 48px;
            box-shadow:
                0 4px 20px rgba(0,0,0,0.1),
                2px 2px 0 rgba(139,94,60,0.05);
            transform: rotate(-2deg);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }
        .polaroid-break:hover {
            transform: rotate(0deg) scale(1.03);
        }
        /* Tape piece */
        .tape {
            position: absolute;
            top: -10px; left: 50%; transform: translateX(-50%) rotate(-3deg);
            width: 80px; height: 24px;
            background: rgba(245,230,208,0.6);
            border: 1px solid rgba(139,94,60,0.08);
            z-index: 2;
        }
        .polaroid-break img {
            width: 100%; height: 220px; object-fit: cover;
            display: block;
        }
        .polaroid-caption {
            position: absolute;
            bottom: 12px; left: 0; right: 0;
            text-align: center;
            font-family: 'Dancing Script', cursive;
            font-size: 15px;
            color: var(--warm);
        }

        /* ═══════════════════════════════════════════
           WHEAT DIVIDER — hand-drawn SVG
        ═══════════════════════════════════════════ */
        .wheat-divider {
            display: flex; align-items: center; justify-content: center;
            gap: 12px; margin: 40px 0 36px; opacity: 0.4;
        }
        .wd-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139,94,60,0.2), transparent);
        }

        /* ═══════════════════════════════════════════
           BUNDLE CALLOUT — wax seal accent
        ═══════════════════════════════════════════ */
        .bundle-callout {
            margin: 48px -10px 8px;
            padding: 40px 36px;
            text-align: center;
            position: relative;
            border-top: 1px solid rgba(139,94,60,0.15);
            border-bottom: 1px solid rgba(139,94,60,0.15);
        }

        .bundle-callout h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 10px;
        }
        .bundle-callout .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: var(--warm);
            margin-bottom: 24px;
        }
        .bundle-price-wrap {
            display: inline-flex; align-items: center; gap: 16px;
        }
        .bundle-line { width: 40px; height: 1px; background: var(--golden); }
        .bundle-price {
            font-family: 'Dancing Script', cursive;
            font-size: 2.6rem;
            font-weight: 700;
            color: var(--accent);
        }

        /* ═══════════════════════════════════════════
           WAX SEAL — bottom of menu
        ═══════════════════════════════════════════ */
        .menu-seal {
            text-align: center;
            margin-top: 56px;
            padding-top: 36px;
        }
        .seal-stamp {
            display: inline-block;
            width: 110px; height: 110px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 35%,
                #c0734a,
                #a0623a 40%,
                #8b5230 70%,
                #6b3d22
            );
            position: relative;
            box-shadow:
                0 4px 12px rgba(0,0,0,0.2),
                inset 0 2px 6px rgba(255,255,255,0.1),
                inset 0 -2px 6px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            cursor: default;
            transition: transform 0.3s;
        }
        .seal-stamp:hover { transform: scale(1.05) rotate(-5deg); }
        .seal-stamp::before {
            content: '';
            position: absolute;
            inset: 6px;
            border: 1.5px solid rgba(245,230,208,0.2);
            border-radius: 50%;
        }
        .seal-stamp::after {
            content: '';
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(245,230,208,0.1);
            border-radius: 50%;
        }
        .seal-inner {
            position: absolute;
            inset: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .seal-inner .seal-b {
            font-family: 'Dancing Script', cursive;
            font-size: 28px;
            font-weight: 700;
            color: rgba(245,230,208,0.8);
            line-height: 1;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .seal-inner .seal-est {
            font-family: 'Cormorant Garamond', serif;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: rgba(245,230,208,0.5);
            margin-top: 2px;
        }
        .seal-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15px;
            color: var(--warm);
            letter-spacing: 0.5px;
        }

        /* ═══════════════════════════════════════════
           MARGIN NOTES — handwritten scribbles
        ═══════════════════════════════════════════ */
        .margin-note {
            position: absolute;
            font-family: 'Dancing Script', cursive;
            font-size: 13px;
            color: rgba(193,127,78,0.2);
            pointer-events: none;
            white-space: nowrap;
        }

        /* ═══════════════════════════════════════════
           DECORATIVE WHEAT SVGs on table
        ═══════════════════════════════════════════ */
        .deco-wheat {
            position: absolute;
            z-index: 1;
            opacity: 0.04;
            pointer-events: none;
        }

        /* ═══════════════════════════════════════════
           SCROLL REVEAL with ink-fade effect
        ═══════════════════════════════════════════ */
        .ink-reveal {
            opacity: 0;
            transform: translateY(16px);
            filter: blur(3px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ink-reveal.visible {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
        /* Stagger children */
        .ink-reveal.visible .menu-item-name { animation: ink-write 0.6s ease forwards; }
        @keyframes ink-write {
            0% { clip-path: inset(0 100% 0 0); }
            100% { clip-path: inset(0 0 0 0); }
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 768px) {
            .parchment { padding: 60px 36px 48px; }
            .signature-item { grid-template-columns: 1fr; margin: 20px -20px 36px; }
            .signature-photo { height: 220px; }
            .signature-body { padding: 32px; }
            .polaroid-break { width: 260px; }
            .menu-item-desc { padding-right: 0; }
            .margin-note { display: none; }
            .bundle-callout { margin: 40px 0 8px; padding: 28px 24px; }
        }
        @media (max-width: 480px) {
            .parchment { padding: 48px 24px 40px; }
            .menu-item-name { font-size: 1.35rem; white-space: normal; }
            .menu-item-row { flex-wrap: wrap; }
            .menu-item-dots { display: none; }
            .menu-item-price { margin-left: auto; }
            .scroll-tab { font-size: 14px; letter-spacing: 1px; }
            .signature-body h3 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

{{-- Mouse-tracking candle glow --}}
<div class="candle-glow" id="candleGlow"></div>

<div class="menu-scene">

    {{-- Flour particles --}}
    <div class="flour-dust">
        @for ($i = 0; $i < 25; $i++)
        <div class="flour-particle" style="
            left: {{ rand(0, 100) }}%;
            width: {{ rand(2, 4) }}px;
            height: {{ rand(2, 4) }}px;
            animation-duration: {{ rand(18, 35) }}s;
            animation-delay: {{ $i * 0.9 }}s;
        "></div>
        @endfor
    </div>

    {{-- Decorative wheat stalks on the table --}}
    <svg class="deco-wheat" style="top: 150px; left: 20px; transform: rotate(-25deg);" width="180" height="360" viewBox="0 0 180 360" fill="none">
        <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
        <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
        <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
        <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
        <ellipse cx="102" cy="170" rx="18" ry="32" fill="var(--golden)" transform="rotate(25 102 170)"/>
        <ellipse cx="82" cy="210" rx="14" ry="24" fill="var(--golden)" transform="rotate(-20 82 210)"/>
    </svg>
    <svg class="deco-wheat" style="top: 500px; right: 30px; transform: rotate(20deg) scaleX(-1);" width="160" height="320" viewBox="0 0 180 360" fill="none">
        <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
        <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
        <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
        <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
        <ellipse cx="102" cy="170" rx="18" ry="32" fill="var(--golden)" transform="rotate(25 102 170)"/>
    </svg>
    <svg class="deco-wheat" style="bottom: 200px; left: 50px; transform: rotate(-10deg);" width="120" height="240" viewBox="0 0 180 360" fill="none">
        <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
        <ellipse cx="76" cy="60" rx="20" ry="34" fill="var(--golden)" transform="rotate(-28 76 60)"/>
        <ellipse cx="104" cy="100" rx="20" ry="34" fill="var(--golden)" transform="rotate(28 104 100)"/>
        <ellipse cx="80" cy="140" rx="16" ry="26" fill="var(--golden)" transform="rotate(-22 80 140)"/>
    </svg>

    {{-- ═══ THE PARCHMENT ═══ --}}
    <div class="parchment-wrap">
    <div class="parchment" x-data="{ tab: 'sourdough' }">

        {{-- Margin notes --}}
        <span class="margin-note" style="top: 380px; left: 8px; transform: rotate(-7deg);">our favorite ♡</span>
        <span class="margin-note" style="top: 780px; right: 12px; transform: rotate(4deg);">so good!</span>
        <span class="margin-note" style="top: 1050px; left: 10px; transform: rotate(-3deg);">try this →</span>

        {{-- Title --}}
        <div class="menu-title ink-reveal">
            <h2>Our Menu<span class="ink-drip"></span></h2>
        </div>
        <p class="menu-epigraph ink-reveal">Everything baked fresh to order. Never frozen, never rushed.</p>

        {{-- Tabs --}}
        <div class="scroll-tabs ink-reveal">
            <button class="scroll-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="scroll-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        {{-- ═══ SOURDOUGH ═══ --}}
        <div x-show="tab === 'sourdough'" x-transition.opacity.duration.400ms>

            {{-- Signature item with steam --}}
            <div class="signature-item ink-reveal">
                <div class="signature-photo">
                    <img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf">
                    <div class="steam-wrap">
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                    </div>
                </div>
                <div class="signature-body">
                    <span class="signature-label">✦ Our Signature</span>
                    <h3>Regular Loaf</h3>
                    <p class="desc">Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                    <div class="signature-price-wrap">
                        <span class="signature-price">$10</span>
                        <span class="signature-price-line"></span>
                    </div>
                </div>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Cheddar</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Mozzarella & Garlic</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$14</span>
                </div>
                <p class="menu-item-desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Cinnamon & Sugar</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$14</span>
                </div>
                <p class="menu-item-desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate, Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Chocolate Almond, Chocolate Chip</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
            </div>

            {{-- Bundle --}}
            <div class="bundle-callout ink-reveal">
                <h3>4 Pack of Mini Loaves</h3>
                <p class="desc">Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</p>
                <div class="bundle-price-wrap">
                    <span class="bundle-line"></span>
                    <span class="bundle-price">$25</span>
                    <span class="bundle-line"></span>
                </div>
            </div>
        </div>

        {{-- ═══ OTHER BREADS ═══ --}}
        <div x-show="tab === 'other'" x-transition.opacity.duration.400ms>

            {{-- Signature: English Muffins with steam --}}
            <div class="signature-item ink-reveal">
                <div class="signature-photo">
                    <img src="/images/product-english-muffins.jpg" alt="Sourdough English Muffins">
                    <div class="steam-wrap">
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                    </div>
                </div>
                <div class="signature-body">
                    <span class="signature-label">✦ Fan Favorite</span>
                    <h3>Sourdough English Muffins</h3>
                    <p class="desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
                    <div class="signature-price-wrap">
                        <span class="signature-price">6ct · $8 | 12ct · $15</span>
                        <span class="signature-price-line"></span>
                    </div>
                </div>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Sourdough Honey Wheat Sandwich Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$10</span>
                </div>
                <p class="menu-item-desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Banana Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Banana Walnut Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Our classic banana bread loaded with crunchy toasted walnuts.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Pumpkin Chocolate Chip Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$12</span>
                </div>
                <p class="menu-item-desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
            </div>

            <div class="menu-item ink-reveal">
                <div class="menu-item-row">
                    <span class="menu-item-name">Pumpkin Almond Chocolate Chip Bread</span>
                    <span class="menu-item-dots"></span>
                    <span class="menu-item-price">$15</span>
                </div>
                <p class="menu-item-desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
            </div>
        </div>

    </div>{{-- /parchment --}}
    </div>{{-- /parchment-wrap --}}

</div>{{-- /menu-scene --}}

<script>
// Mouse-tracking candlelight
const glow = document.getElementById('candleGlow');
document.addEventListener('mousemove', (e) => {
    glow.style.left = e.clientX + 'px';
    glow.style.top = e.clientY + 'px';
});

// Ink reveal on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            // Stagger the reveal
            setTimeout(() => {
                entry.target.classList.add('visible');
            }, i * 80);
        }
    });
}, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

document.querySelectorAll('.ink-reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
