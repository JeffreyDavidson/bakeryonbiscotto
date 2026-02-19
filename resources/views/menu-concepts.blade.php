<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Design Concepts | Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
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
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Concept Selector ── */
        .concept-nav {
            position: fixed; top: 16px; left: 50%; transform: translateX(-50%);
            z-index: 1000;
            display: flex; gap: 4px;
            padding: 6px 8px;
            background: rgba(61,35,20,0.9);
            backdrop-filter: blur(20px);
            border-radius: 100px;
            border: 1px solid rgba(212,165,116,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .concept-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 500;
            color: var(--cream); text-decoration: none;
            padding: 10px 28px; border-radius: 100px;
            transition: all 0.3s;
        }
        .concept-nav a:hover { background: rgba(212,165,116,0.2); }
        .concept-nav a.active { background: var(--golden); color: var(--dark); }

        .concept-label {
            text-align: center;
            padding: 80px 20px 0;
        }
        .concept-label h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .concept-label p {
            color: var(--warm);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Shared section-head */
        .section-head {
            text-align: center;
            margin-bottom: 48px;
        }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.8rem, 6vw, 4rem);
            font-weight: 700;
            letter-spacing: 1px;
        }
        .accent-line {
            width: 120px;
            height: 3px;
            margin: 16px auto 0;
            border-radius: 2px;
        }

        /* ═══════════════════════════════════════
           CONCEPT 1: "Chalkboard Bistro"
           Dark bg, handwritten chalk aesthetic,
           items laid out like a real cafe menu board
        ═══════════════════════════════════════ */
        .menu-chalk {
            padding: 100px 20px;
            position: relative;
            background: #1a1008;
            background-image:
                url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }
        /* Chalkboard border frame */
        .menu-chalk::before {
            content: '';
            position: absolute;
            inset: 20px;
            border: 3px solid rgba(212,165,116,0.25);
            border-radius: 4px;
            pointer-events: none;
        }
        .menu-chalk::after {
            content: '';
            position: absolute;
            inset: 28px;
            border: 1px solid rgba(212,165,116,0.1);
            border-radius: 2px;
            pointer-events: none;
        }
        .menu-chalk .section-head h2 {
            color: var(--cream);
            text-shadow: 0 0 40px rgba(212,165,116,0.3);
        }
        .menu-chalk .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .chalk-subtitle {
            text-align: center;
            font-family: 'Dancing Script', cursive;
            color: rgba(245,230,208,0.5);
            font-size: 18px;
            margin-top: -32px;
            margin-bottom: 56px;
            letter-spacing: 1px;
        }
        .chalk-tabs {
            display: flex; justify-content: center;
            gap: 12px; margin-bottom: 56px;
        }
        .chalk-tab {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 500;
            padding: 12px 36px;
            border: 1.5px solid rgba(212,165,116,0.3);
            border-radius: 100px;
            background: transparent;
            color: var(--cream);
            cursor: pointer;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        .chalk-tab:hover { border-color: var(--golden); background: rgba(212,165,116,0.08); }
        .chalk-tab.active {
            background: var(--golden);
            color: var(--dark);
            border-color: var(--golden);
            box-shadow: 0 0 30px rgba(212,165,116,0.2);
        }
        .chalk-grid {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }
        .chalk-category-label {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            color: var(--golden);
            text-align: center;
            margin-bottom: 32px;
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .chalk-category-label::before,
        .chalk-category-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.2), transparent);
        }
        .chalk-item {
            display: flex;
            align-items: baseline;
            padding: 18px 0;
            border-bottom: 1px dashed rgba(212,165,116,0.08);
            transition: all 0.3s;
        }
        .chalk-item:hover {
            padding-left: 12px;
            background: rgba(212,165,116,0.03);
            border-radius: 8px;
        }
        .chalk-item:last-child { border-bottom: none; }
        .chalk-icon {
            font-size: 28px;
            margin-right: 20px;
            width: 40px;
            text-align: center;
            filter: drop-shadow(0 0 8px rgba(0,0,0,0.3));
        }
        .chalk-item-info { flex: 1; }
        .chalk-item-name {
            font-family: 'Dancing Script', cursive;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 4px;
        }
        .chalk-item-desc {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: rgba(245,230,208,0.4);
            line-height: 1.5;
        }
        .chalk-dots {
            flex: 1;
            min-width: 40px;
            margin: 0 16px;
            border-bottom: 2px dotted rgba(212,165,116,0.15);
            align-self: center;
        }
        .chalk-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--golden);
            white-space: nowrap;
            text-shadow: 0 0 20px rgba(212,165,116,0.2);
        }
        /* Featured / special item */
        .chalk-featured {
            margin: 24px 0 40px;
            padding: 32px;
            border: 2px solid rgba(212,165,116,0.2);
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(212,165,116,0.06), rgba(193,127,78,0.03));
            position: relative;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 20px;
            align-items: center;
        }
        .chalk-featured .chalk-icon { font-size: 48px; margin-right: 0; }
        .chalk-featured .chalk-item-name { font-size: 1.8rem; }
        .chalk-featured .chalk-item-desc { font-size: 15px; }
        .chalk-featured-badge {
            position: absolute;
            top: -12px; right: 24px;
            background: var(--golden);
            color: var(--dark);
            font-family: 'Playfair Display', serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 20px;
            border-radius: 100px;
        }
        .chalk-featured .chalk-price {
            font-size: 1.6rem;
            background: var(--golden);
            color: var(--dark);
            padding: 10px 24px;
            border-radius: 100px;
            font-weight: 700;
        }
        /* Photo callout */
        .chalk-photo-row {
            max-width: 900px;
            margin: 48px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .chalk-photo {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid rgba(212,165,116,0.15);
            aspect-ratio: 4/3;
        }
        .chalk-photo img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s;
        }
        .chalk-photo:hover img { transform: scale(1.05); }

        @media (max-width: 600px) {
            .chalk-item { flex-wrap: wrap; gap: 4px; }
            .chalk-dots { display: none; }
            .chalk-price { margin-left: auto; }
            .chalk-featured { grid-template-columns: 1fr; text-align: center; }
            .chalk-featured .chalk-price { justify-self: center; }
            .chalk-photo-row { grid-template-columns: 1fr; }
        }


        /* ═══════════════════════════════════════
           CONCEPT 2: "Recipe Book"
           Warm cream bg, open-book aesthetic,
           two-column spread with torn-edge cards
        ═══════════════════════════════════════ */
        .menu-book {
            padding: 100px 20px;
            position: relative;
            background: var(--cream);
            background-image:
                url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
        }
        .menu-book .section-head h2 { color: var(--dark); }
        .menu-book .accent-line {
            background: linear-gradient(90deg, transparent, var(--accent), var(--golden), var(--accent), transparent);
        }
        .book-subtitle {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--warm);
            font-size: 17px;
            margin-top: -32px;
            margin-bottom: 56px;
        }
        .book-tabs {
            display: flex; justify-content: center;
            gap: 0; margin-bottom: 56px;
        }
        .book-tab {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 500;
            padding: 14px 40px;
            border: none;
            background: transparent;
            color: var(--brown);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            letter-spacing: 0.5px;
        }
        .book-tab::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%; transform: translateX(-50%);
            width: 0; height: 2px;
            background: var(--accent);
            transition: width 0.3s;
        }
        .book-tab:hover::after { width: 60%; }
        .book-tab.active {
            color: var(--dark);
            font-weight: 700;
        }
        .book-tab.active::after { width: 80%; background: var(--dark); }
        .book-spread {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            gap: 0;
            position: relative;
        }
        .book-spine {
            background: linear-gradient(180deg,
                transparent,
                rgba(139,94,60,0.15) 20%,
                rgba(139,94,60,0.2) 50%,
                rgba(139,94,60,0.15) 80%,
                transparent
            );
            width: 1px;
            position: relative;
        }
        .book-spine::before {
            content: '';
            position: absolute;
            top: 0; bottom: 0; left: -6px; right: -6px;
            background: linear-gradient(90deg,
                rgba(61,35,20,0.04),
                rgba(61,35,20,0.08),
                rgba(61,35,20,0.04)
            );
        }
        .book-page {
            padding: 20px 40px;
        }
        .book-page-title {
            font-family: 'Dancing Script', cursive;
            font-size: 1.4rem;
            color: var(--accent);
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }
        .book-page-title::after {
            content: '❧';
            display: block;
            font-size: 18px;
            color: var(--golden);
            margin-top: 8px;
            opacity: 0.5;
        }
        .book-item {
            padding: 20px 0;
            border-bottom: 1px solid rgba(139,94,60,0.1);
            transition: all 0.3s;
            position: relative;
        }
        .book-item:last-child { border-bottom: none; }
        .book-item:hover {
            padding-left: 8px;
        }
        .book-item-header {
            display: flex;
            align-items: baseline;
            margin-bottom: 6px;
        }
        .book-item-icon {
            font-size: 20px;
            margin-right: 12px;
        }
        .book-item-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
        }
        .book-item-dots {
            flex: 1;
            margin: 0 12px;
            border-bottom: 1px dotted rgba(139,94,60,0.2);
            min-width: 20px;
        }
        .book-item-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--accent);
        }
        .book-item-desc {
            font-family: 'Inter', sans-serif;
            font-size: 13.5px;
            color: var(--warm);
            line-height: 1.6;
            padding-left: 32px;
            font-style: italic;
        }
        /* Featured photo items */
        .book-featured-card {
            margin: 24px 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(139,94,60,0.15);
            background: var(--white);
            box-shadow: 0 4px 20px rgba(61,35,20,0.06);
            transition: all 0.4s;
        }
        .book-featured-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(61,35,20,0.1);
        }
        .book-featured-img {
            height: 180px;
            overflow: hidden;
        }
        .book-featured-img img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s;
        }
        .book-featured-card:hover img { transform: scale(1.05); }
        .book-featured-body {
            padding: 20px;
        }
        .book-featured-body h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .book-featured-body .desc {
            font-size: 14px;
            color: var(--warm);
            line-height: 1.5;
            margin-bottom: 12px;
        }
        .book-featured-body .price-tag {
            display: inline-block;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent);
            background: rgba(193,127,78,0.08);
            padding: 6px 20px;
            border-radius: 100px;
            border: 1px solid rgba(193,127,78,0.15);
        }
        /* Mini loaves special */
        .book-special {
            margin: 32px 0 0;
            padding: 24px;
            background: linear-gradient(135deg, var(--dark), #4a2a18);
            border-radius: 8px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .book-special::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(212,165,116,0.15), transparent 70%);
        }
        .book-special h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            color: var(--cream);
            margin-bottom: 8px;
            position: relative;
        }
        .book-special p {
            font-size: 14px;
            color: rgba(245,230,208,0.5);
            margin-bottom: 16px;
            position: relative;
        }
        .book-special .price-badge {
            display: inline-block;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
            background: var(--golden);
            padding: 10px 32px;
            border-radius: 100px;
            position: relative;
            box-shadow: 0 4px 20px rgba(212,165,116,0.4);
        }

        @media (max-width: 768px) {
            .book-spread { grid-template-columns: 1fr; }
            .book-spine { display: none; }
            .book-page { padding: 20px 0; }
        }


        /* ═══════════════════════════════════════
           CONCEPT 3: "Marketplace"
           Rich wood-dark bg, product card gallery,
           horizontal scroll categories, floating prices
        ═══════════════════════════════════════ */
        .menu-market {
            padding: 100px 20px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #241508 0%, #1a1008 50%, #241508 100%);
        }
        .menu-market::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(212,165,116,0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(193,127,78,0.06) 0%, transparent 50%);
            pointer-events: none;
        }
        .menu-market .section-head h2 {
            color: var(--cream);
            text-shadow: 0 2px 30px rgba(212,165,116,0.2);
        }
        .menu-market .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .market-subtitle {
            text-align: center;
            font-family: 'Dancing Script', cursive;
            color: rgba(245,230,208,0.4);
            font-size: 18px;
            margin-top: -32px;
            margin-bottom: 56px;
        }
        .market-tabs {
            display: flex; justify-content: center;
            gap: 8px; margin-bottom: 56px;
        }
        .market-tab {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 500;
            padding: 12px 32px;
            border: none;
            border-radius: 100px;
            background: rgba(245,230,208,0.06);
            color: rgba(245,230,208,0.6);
            cursor: pointer;
            transition: all 0.3s;
        }
        .market-tab:hover { background: rgba(245,230,208,0.1); color: var(--cream); }
        .market-tab.active {
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark);
            font-weight: 700;
            box-shadow: 0 4px 20px rgba(212,165,116,0.3);
        }
        .market-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }
        .market-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: rgba(245,230,208,0.04);
            border: 1px solid rgba(212,165,116,0.1);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: default;
        }
        .market-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212,165,116,0.3);
            box-shadow:
                0 20px 60px rgba(0,0,0,0.3),
                0 0 40px rgba(212,165,116,0.06);
        }
        .market-card-visual {
            height: 200px;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 30% 50%, rgba(212,165,116,0.1) 0%, transparent 60%),
                rgba(245,230,208,0.04);
        }
        .market-card-visual.has-photo img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s;
        }
        .market-card:hover .market-card-visual img { transform: scale(1.08); }
        .market-card-visual .emoji-display {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            font-size: 64px;
            filter: drop-shadow(0 8px 16px rgba(0,0,0,0.3));
        }
        /* Floating price badge */
        .market-price-badge {
            position: absolute;
            bottom: -16px; right: 20px;
            background: var(--golden);
            color: var(--dark);
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            padding: 8px 24px;
            border-radius: 100px;
            box-shadow: 0 4px 16px rgba(212,165,116,0.4);
            z-index: 2;
        }
        .market-card-content {
            padding: 28px 24px 24px;
        }
        .market-card-content h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 8px;
        }
        .market-card-content p {
            font-size: 14px;
            color: rgba(245,230,208,0.4);
            line-height: 1.6;
        }
        /* Hero/featured card */
        .market-card.hero-card {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: linear-gradient(135deg, rgba(212,165,116,0.08), rgba(193,127,78,0.04));
            border-color: rgba(212,165,116,0.2);
        }
        .market-card.hero-card .market-card-visual { height: 100%; min-height: 280px; }
        .market-card.hero-card .market-card-content {
            display: flex; flex-direction: column; justify-content: center;
            padding: 40px;
        }
        .market-card.hero-card h3 { font-size: 2rem; }
        .market-card.hero-card p { font-size: 15px; }
        .market-card.hero-card .market-price-badge {
            position: static;
            display: inline-block;
            margin-top: 20px;
            width: fit-content;
            font-size: 1.3rem;
            padding: 12px 32px;
        }
        /* Bundle card */
        .market-card.bundle-card {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 200px 1fr;
            background: linear-gradient(135deg, var(--dark), #3d2314);
            border: 2px solid var(--golden);
        }
        .market-card.bundle-card .market-card-visual {
            height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .market-card.bundle-card .market-card-content {
            display: flex; flex-direction: column; justify-content: center;
        }
        .market-card.bundle-card .market-price-badge {
            position: static;
            display: inline-block;
            margin-top: 16px;
            width: fit-content;
            font-size: 1.3rem;
            padding: 12px 32px;
            box-shadow: 0 4px 20px rgba(212,165,116,0.5);
        }

        @media (max-width: 768px) {
            .market-grid { grid-template-columns: 1fr; }
            .market-card.hero-card,
            .market-card.bundle-card { grid-column: span 1; grid-template-columns: 1fr; }
            .market-card.hero-card .market-card-visual { min-height: 200px; }
            .market-card.bundle-card .market-card-visual { height: 200px; }
        }

        /* ── Dividers ── */
        .concept-divider {
            display: flex; align-items: center; justify-content: center;
            gap: 20px;
            padding: 60px 20px;
            background: var(--light);
        }
        .concept-divider span {
            flex: 1; max-width: 200px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139,94,60,0.2), transparent);
        }
        .concept-divider svg { opacity: 0.3; }
    </style>
</head>
<body x-data="{ concept: 'chalk' }">

    {{-- Concept Nav --}}
    <nav class="concept-nav">
        <a href="#concept-1" :class="{ 'active': concept === 'chalk' }" @click.prevent="concept = 'chalk'; document.getElementById('concept-1').scrollIntoView({behavior:'smooth'})">Chalkboard</a>
        <a href="#concept-2" :class="{ 'active': concept === 'book' }" @click.prevent="concept = 'book'; document.getElementById('concept-2').scrollIntoView({behavior:'smooth'})">Recipe Book</a>
        <a href="#concept-3" :class="{ 'active': concept === 'market' }" @click.prevent="concept = 'market'; document.getElementById('concept-3').scrollIntoView({behavior:'smooth'})">Marketplace</a>
    </nav>

    {{-- ═══════════════════════════════════════
         CONCEPT 1: Chalkboard Bistro
    ═══════════════════════════════════════ --}}
    <div id="concept-1">
        <div class="concept-label">
            <h2>Concept 1: Chalkboard Bistro</h2>
            <p>Classic cafe menu board feel. Dark background, handwritten typography, dotted price leaders. Clean, elegant, and easy to scan.</p>
        </div>
    </div>

    <section class="menu-chalk" x-data="{ tab: 'sourdough' }">
        <div class="section-head">
            <h2>Our Menu</h2>
            <div class="accent-line"></div>
        </div>
        <p class="chalk-subtitle">Everything baked fresh to order. Never frozen, never rushed.</p>

        <div class="chalk-tabs">
            <button class="chalk-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="chalk-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <div x-show="tab === 'sourdough'" x-transition.opacity>
            {{-- Photo row --}}
            <div class="chalk-photo-row">
                <div class="chalk-photo"><img src="/images/product-sourdough-boule.jpg" alt="Sourdough Boule"></div>
                <div class="chalk-photo"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
            </div>

            <div class="chalk-grid">
                {{-- Featured: Regular Loaf --}}
                <div class="chalk-featured">
                    <span class="chalk-featured-badge">Signature</span>
                    <div class="chalk-icon">🍞</div>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Regular Loaf</div>
                        <div class="chalk-item-desc">Our signature. Golden crust, airy crumb, perfectly tangy. The one that started it all.</div>
                    </div>
                    <div class="chalk-price">$10</div>
                </div>

                {{-- List items --}}
                <div class="chalk-item">
                    <span class="chalk-icon">🧀</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Cheddar</div>
                        <div class="chalk-item-desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$12</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🧄</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Mozzarella and Garlic</div>
                        <div class="chalk-item-desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$14</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🍫</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Chocolate Chip</div>
                        <div class="chalk-item-desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$12</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">✨</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Cinnamon and Sugar</div>
                        <div class="chalk-item-desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$14</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🍫</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Chocolate, Chocolate Chip</div>
                        <div class="chalk-item-desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$12</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🍫</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Chocolate Almond, Chocolate Chip</div>
                        <div class="chalk-item-desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$15</span>
                </div>

                {{-- Mini loaves special --}}
                <div class="chalk-featured" style="margin-top: 40px;">
                    <span class="chalk-featured-badge">Best Value</span>
                    <div class="chalk-icon">🎁</div>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">4 Pack of Mini Loaves</div>
                        <div class="chalk-item-desc">Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</div>
                    </div>
                    <div class="chalk-featured .chalk-price" style="font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; background: var(--golden); color: var(--dark); padding: 10px 24px; border-radius: 100px;">$25</div>
                </div>
            </div>
        </div>

        <div x-show="tab === 'other'" x-transition.opacity>
            <div class="chalk-grid">
                <div class="chalk-item">
                    <span class="chalk-icon">🍯</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Sourdough Honey Wheat Sandwich Bread</div>
                        <div class="chalk-item-desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$10</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🫓</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Sourdough English Muffins</div>
                        <div class="chalk-item-desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">6ct · $8 &nbsp;|&nbsp; 12ct · $15</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🍌</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Banana Bread</div>
                        <div class="chalk-item-desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$12</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🍌</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Banana Walnut Bread</div>
                        <div class="chalk-item-desc">Our classic banana bread loaded with crunchy toasted walnuts.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$15</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🎃</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Pumpkin Chocolate Chip Bread</div>
                        <div class="chalk-item-desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$12</span>
                </div>
                <div class="chalk-item">
                    <span class="chalk-icon">🎃</span>
                    <div class="chalk-item-info">
                        <div class="chalk-item-name">Pumpkin Almond Chocolate Chip Bread</div>
                        <div class="chalk-item-desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</div>
                    </div>
                    <span class="chalk-dots"></span>
                    <span class="chalk-price">$15</span>
                </div>
            </div>
        </div>
    </section>


    {{-- Divider --}}
    <div class="concept-divider">
        <span></span>
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M16 2C16 2 17.5 10 16 16C14.5 10 16 2 16 2Z" fill="var(--golden)"/><path d="M16 6C16 6 21 11 19.5 17C18 12 16 6 16 6Z" fill="var(--golden)"/><path d="M16 6C16 6 11 11 12.5 17C14 12 16 6 16 6Z" fill="var(--golden)"/></svg>
        <span></span>
    </div>


    {{-- ═══════════════════════════════════════
         CONCEPT 2: Recipe Book
    ═══════════════════════════════════════ --}}
    <div id="concept-2">
        <div class="concept-label">
            <h2>Concept 2: Recipe Book</h2>
            <p>Open cookbook spread with a spine down the middle. Warm, inviting, feels like flipping through a family recipe collection. Photo cards for hero items.</p>
        </div>
    </div>

    <section class="menu-book" x-data="{ tab: 'sourdough' }">
        <div class="section-head">
            <h2>Our Menu</h2>
            <div class="accent-line"></div>
        </div>
        <p class="book-subtitle">Everything baked fresh to order. Never frozen, never rushed.</p>

        <div class="book-tabs">
            <button class="book-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="book-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <div x-show="tab === 'sourdough'" x-transition.opacity>
            <div class="book-spread">
                {{-- Left page --}}
                <div class="book-page">
                    <div class="book-page-title">Our Favorites</div>

                    <div class="book-featured-card">
                        <div class="book-featured-img"><img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough"></div>
                        <div class="book-featured-body">
                            <h3>Regular Loaf</h3>
                            <p class="desc">Our signature. Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                            <span class="price-tag">$10</span>
                        </div>
                    </div>

                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🧀</span>
                            <span class="book-item-name">Cheddar</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$12</span>
                        </div>
                        <p class="book-item-desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🧄</span>
                            <span class="book-item-name">Mozzarella and Garlic</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$14</span>
                        </div>
                        <p class="book-item-desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍫</span>
                            <span class="book-item-name">Chocolate Chip</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$12</span>
                        </div>
                        <p class="book-item-desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
                    </div>
                </div>

                {{-- Spine --}}
                <div class="book-spine"></div>

                {{-- Right page --}}
                <div class="book-page">
                    <div class="book-page-title">Sweet & Indulgent</div>

                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">✨</span>
                            <span class="book-item-name">Cinnamon and Sugar</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$14</span>
                        </div>
                        <p class="book-item-desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍫</span>
                            <span class="book-item-name">Chocolate, Chocolate Chip</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$12</span>
                        </div>
                        <p class="book-item-desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍫</span>
                            <span class="book-item-name">Chocolate Almond, Chocolate Chip</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$15</span>
                        </div>
                        <p class="book-item-desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
                    </div>

                    <div class="book-special">
                        <h3>🎁 4 Pack of Mini Loaves</h3>
                        <p>Can't choose? Pick any 4 flavors in perfectly portioned mini loaves.</p>
                        <span class="price-badge">$25</span>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="tab === 'other'" x-transition.opacity>
            <div class="book-spread">
                <div class="book-page">
                    <div class="book-page-title">Sandwich & Breakfast</div>

                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍯</span>
                            <span class="book-item-name">Sourdough Honey Wheat Sandwich Bread</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$10</span>
                        </div>
                        <p class="book-item-desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
                    </div>

                    <div class="book-featured-card">
                        <div class="book-featured-img"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                        <div class="book-featured-body">
                            <h3>Sourdough English Muffins</h3>
                            <p class="desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
                            <span class="price-tag">6ct · $8 &nbsp;|&nbsp; 12ct · $15</span>
                        </div>
                    </div>
                </div>

                <div class="book-spine"></div>

                <div class="book-page">
                    <div class="book-page-title">Quick Breads</div>

                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍌</span>
                            <span class="book-item-name">Banana Bread</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$12</span>
                        </div>
                        <p class="book-item-desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🍌</span>
                            <span class="book-item-name">Banana Walnut Bread</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$15</span>
                        </div>
                        <p class="book-item-desc">Our classic banana bread loaded with crunchy toasted walnuts.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🎃</span>
                            <span class="book-item-name">Pumpkin Chocolate Chip Bread</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$12</span>
                        </div>
                        <p class="book-item-desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
                    </div>
                    <div class="book-item">
                        <div class="book-item-header">
                            <span class="book-item-icon">🎃</span>
                            <span class="book-item-name">Pumpkin Almond Chocolate Chip Bread</span>
                            <span class="book-item-dots"></span>
                            <span class="book-item-price">$15</span>
                        </div>
                        <p class="book-item-desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Divider --}}
    <div class="concept-divider">
        <span></span>
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M16 2C16 2 17.5 10 16 16C14.5 10 16 2 16 2Z" fill="var(--golden)"/><path d="M16 6C16 6 21 11 19.5 17C18 12 16 6 16 6Z" fill="var(--golden)"/><path d="M16 6C16 6 11 11 12.5 17C14 12 16 6 16 6Z" fill="var(--golden)"/></svg>
        <span></span>
    </div>


    {{-- ═══════════════════════════════════════
         CONCEPT 3: Marketplace
    ═══════════════════════════════════════ --}}
    <div id="concept-3">
        <div class="concept-label">
            <h2>Concept 3: Marketplace</h2>
            <p>Rich, dark gallery with floating price badges. Modern bakery-meets-boutique. Cards with depth, glow accents, and a premium product showcase feel.</p>
        </div>
    </div>

    <section class="menu-market" x-data="{ tab: 'sourdough' }">
        <div class="section-head">
            <h2>Our Menu</h2>
            <div class="accent-line"></div>
        </div>
        <p class="market-subtitle">Everything baked fresh to order. Never frozen, never rushed.</p>

        <div class="market-tabs">
            <button class="market-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="market-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <div x-show="tab === 'sourdough'" x-transition.opacity>
            <div class="market-grid">
                {{-- Hero card --}}
                <div class="market-card hero-card">
                    <div class="market-card-visual has-photo"><img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough"></div>
                    <div class="market-card-content">
                        <h3>Regular Loaf</h3>
                        <p>Our signature. Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                        <span class="market-price-badge">$10</span>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🧀</span>
                        <span class="market-price-badge">$12</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Cheddar</h3>
                        <p>Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🧄</span>
                        <span class="market-price-badge">$14</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Mozzarella and Garlic</h3>
                        <p>Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍫</span>
                        <span class="market-price-badge">$12</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Chocolate Chip</h3>
                        <p>Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">✨</span>
                        <span class="market-price-badge">$14</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Cinnamon and Sugar</h3>
                        <p>Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍫</span>
                        <span class="market-price-badge">$12</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Chocolate, Chocolate Chip</h3>
                        <p>Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍫</span>
                        <span class="market-price-badge">$15</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Chocolate Almond, Chocolate Chip</h3>
                        <p>Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
                    </div>
                </div>

                {{-- Bundle card --}}
                <div class="market-card bundle-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🎁</span>
                    </div>
                    <div class="market-card-content">
                        <h3>4 Pack of Mini Loaves</h3>
                        <p>Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</p>
                        <span class="market-price-badge">$25</span>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="tab === 'other'" x-transition.opacity>
            <div class="market-grid">
                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍯</span>
                        <span class="market-price-badge">$10</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Sourdough Honey Wheat Sandwich Bread</h3>
                        <p>Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
                    </div>
                </div>

                <div class="market-card hero-card">
                    <div class="market-card-visual has-photo"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                    <div class="market-card-content">
                        <h3>Sourdough English Muffins</h3>
                        <p>Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
                        <span class="market-price-badge">6ct · $8 &nbsp;|&nbsp; 12ct · $15</span>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍌</span>
                        <span class="market-price-badge">$12</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Banana Bread</h3>
                        <p>Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🍌</span>
                        <span class="market-price-badge">$15</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Banana Walnut Bread</h3>
                        <p>Our classic banana bread loaded with crunchy toasted walnuts.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🎃</span>
                        <span class="market-price-badge">$12</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Pumpkin Chocolate Chip Bread</h3>
                        <p>Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
                    </div>
                </div>

                <div class="market-card">
                    <div class="market-card-visual">
                        <span class="emoji-display">🎃</span>
                        <span class="market-price-badge">$15</span>
                    </div>
                    <div class="market-card-content">
                        <h3>Pumpkin Almond Chocolate Chip Bread</h3>
                        <p>Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="padding: 80px 20px; text-align: center; background: var(--light);">
        <p style="color: var(--warm); font-family: 'Playfair Display', serif; font-size: 18px;">~ End of concepts ~</p>
    </div>

</body>
</html>
