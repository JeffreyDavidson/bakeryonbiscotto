<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden: #D4A574;
            --light-cream: #FDF8F2;
            --accent: #C17F4E;
            --dark-brown-rgb: 61,35,20;
            --golden-rgb: 212,165,116;
            --accent-rgb: 193,127,78;
            --warm-brown-rgb: 139,94,60;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark-brown);
            background: var(--light-cream);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Noise overlay mixin ── */
        .noise { position: relative; }
        .noise::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }

        /* ── Ambient orb ── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.18;
        }

        /* ── Scroll animations ── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Concept Nav ── */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            gap: 2px;
            background: var(--dark-brown);
            padding: 6px 0;
        }
        .concept-nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13px;
            color: rgba(245,230,208,0.5);
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .concept-nav a:hover { color: var(--cream); background: rgba(245,230,208,0.08); }
        .concept-nav a.active {
            color: var(--dark-brown);
            background: var(--golden);
        }

        /* ── Main Nav ── */
        .main-nav {
            position: sticky;
            top: 44px;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            padding: 12px 20px;
            background: rgba(61,35,20,0.65);
            backdrop-filter: blur(20px) saturate(1.4);
            -webkit-backdrop-filter: blur(20px) saturate(1.4);
            border-bottom: 1px solid rgba(212,165,116,0.12);
        }
        .main-nav a {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 14px;
            color: var(--cream);
            text-decoration: none;
            padding: 8px 22px;
            border-radius: 100px;
            transition: all 0.3s ease;
            letter-spacing: 0.02em;
        }
        .main-nav a:hover {
            background: rgba(212,165,116,0.15);
            color: var(--golden);
        }

        /* ── Hero ── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            margin-top: 44px;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('/images/hero-banner.jpg') center/cover no-repeat;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(var(--dark-brown-rgb), 0.7) 0%,
                rgba(var(--dark-brown-rgb), 0.5) 40%,
                rgba(var(--dark-brown-rgb), 0.8) 100%
            );
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 40px 20px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: clamp(3rem, 8vw, 6.5rem);
            color: var(--cream);
            line-height: 1.05;
            margin-bottom: 16px;
            background: linear-gradient(135deg, var(--cream) 0%, var(--golden) 50%, var(--cream) 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 6s ease-in-out infinite;
        }
        @keyframes shimmer {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 200% center; }
        }
        .hero .tagline {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.3rem, 3vw, 2rem);
            color: var(--golden);
            margin-bottom: 40px;
            opacity: 0.9;
        }
        .btn-primary {
            display: inline-block;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.04em;
            color: var(--dark-brown);
            background: linear-gradient(135deg, var(--golden), var(--accent));
            padding: 16px 40px;
            border-radius: 100px;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 4px 24px rgba(var(--accent-rgb), 0.25);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 40px rgba(var(--accent-rgb), 0.45);
        }
        .hero-fade {
            animation: heroFadeUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }
        .hero-fade-d1 { animation-delay: 0.2s; }
        .hero-fade-d2 { animation-delay: 0.5s; }
        .hero-fade-d3 { animation-delay: 0.8s; }
        @keyframes heroFadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Botanical Divider ── */
        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 48px 20px;
        }
        .divider-line {
            flex: 1;
            max-width: 200px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .divider svg { flex-shrink: 0; opacity: 0.5; }

        /* ── Meet Cassie ── */
        .about-section {
            position: relative;
            padding: 100px 20px;
            overflow: hidden;
            background: var(--cream);
        }
        .about-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 60px;
            align-items: center;
        }
        .about-photo {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            box-shadow: 0 0 60px rgba(var(--accent-rgb), 0.25);
            justify-self: center;
        }
        .about-card {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(var(--golden-rgb), 0.18);
            border-radius: 24px;
            padding: 48px;
            position: relative;
            z-index: 2;
        }
        .about-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-brown);
        }
        .about-card p {
            font-size: 16px;
            line-height: 1.75;
            color: rgba(61,35,20,0.8);
            margin-bottom: 14px;
        }
        .about-card .signature {
            font-family: 'Dancing Script', cursive;
            font-size: 1.4rem;
            color: var(--accent);
            margin-top: 24px;
        }

        /* ── Process ── */
        .process-section {
            position: relative;
            padding: 100px 20px;
            background: var(--dark-brown);
            overflow: hidden;
        }
        .process-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(212,165,116,0.15) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
            z-index: 1;
        }
        .process-section .section-title {
            color: var(--cream);
        }
        .process-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            position: relative;
            z-index: 2;
        }
        .process-step {
            text-align: center;
            padding: 32px 16px;
        }
        .step-num {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 2px solid var(--golden);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--golden);
            margin-bottom: 20px;
            background: rgba(var(--golden-rgb), 0.06);
        }
        .process-step h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--cream);
            margin-bottom: 10px;
        }
        .process-step p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(245,230,208,0.6);
        }

        /* ── Section Title ── */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 600;
            text-align: center;
            margin-bottom: 48px;
            color: var(--dark-brown);
        }

        /* ── Menu ── */
        .menu-section {
            padding: 100px 20px;
            background: var(--light-cream);
        }
        .menu-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 48px;
        }
        .menu-tab {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 15px;
            padding: 10px 28px;
            border-radius: 100px;
            border: 1.5px solid var(--golden);
            background: transparent;
            color: var(--warm-brown);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .menu-tab:hover { background: rgba(var(--golden-rgb), 0.1); }
        .menu-tab.active {
            background: var(--golden);
            color: var(--dark-brown);
            font-weight: 600;
        }
        .menu-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 28px;
        }
        .menu-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(var(--golden-rgb), 0.12);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            border-top: 3px solid;
            border-image: linear-gradient(90deg, var(--golden), var(--accent)) 1;
        }
        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(var(--accent-rgb), 0.18);
        }
        .menu-card-img {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            background: linear-gradient(135deg, rgba(var(--golden-rgb),0.2), rgba(var(--accent-rgb),0.15));
        }
        .menu-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .menu-card-body {
            padding: 24px;
        }
        .menu-card-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--dark-brown);
        }
        .menu-card-body .desc {
            font-size: 13.5px;
            color: rgba(61,35,20,0.6);
            line-height: 1.5;
            margin-bottom: 12px;
        }
        .price-badge {
            display: inline-block;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 4px 16px;
            border-radius: 100px;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark-brown);
        }

        /* ── Reviews ── */
        .reviews-section {
            padding: 100px 20px;
            background: var(--cream);
        }
        .reviews-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
        }
        .review-card {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(var(--golden-rgb), 0.12);
            border-radius: 20px;
            padding: 36px 28px;
            position: relative;
            transition: all 0.4s ease;
        }
        .review-card:hover {
            box-shadow: 0 8px 40px rgba(var(--accent-rgb), 0.15);
        }
        .review-card .quote-mark {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            line-height: 1;
            color: var(--golden);
            opacity: 0.35;
            position: absolute;
            top: 16px;
            left: 24px;
        }
        .review-card p {
            font-size: 15px;
            line-height: 1.7;
            color: rgba(61,35,20,0.75);
            font-style: italic;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }
        .review-card .reviewer {
            font-weight: 600;
            font-size: 14px;
            color: var(--warm-brown);
            font-style: normal;
        }

        /* ── Instagram ── */
        .instagram-section {
            padding: 100px 20px;
            background: var(--light-cream);
        }
        .insta-grid {
            max-width: 900px;
            margin: 0 auto 40px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
        }
        .insta-item {
            aspect-ratio: 1;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            background: linear-gradient(135deg, rgba(var(--golden-rgb),0.25), rgba(var(--accent-rgb),0.18));
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
        }
        .insta-item:hover {
            transform: scale(1.04);
            box-shadow: 0 8px 32px rgba(var(--accent-rgb), 0.2);
        }
        .insta-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .insta-item .placeholder-text {
            position: absolute;
            bottom: 8px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: var(--warm-brown);
            font-weight: 500;
            opacity: 0.7;
        }
        .insta-cta {
            text-align: center;
        }
        .insta-cta a {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s;
        }
        .insta-cta a:hover { color: var(--warm-brown); }
        .insta-cta .social-icons {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 12px;
        }
        .insta-cta .social-icons a {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1.5px solid var(--golden);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .insta-cta .social-icons a:hover {
            background: var(--golden);
        }
        .insta-cta .social-icons a:hover svg { fill: var(--dark-brown); }
        .insta-cta .social-icons svg {
            width: 20px;
            height: 20px;
            fill: var(--warm-brown);
            transition: fill 0.3s;
        }

        /* ── Order ── */
        .order-section {
            position: relative;
            padding: 100px 20px;
            background: var(--dark-brown);
            overflow: hidden;
        }
        .order-section .section-title { color: var(--cream); }
        .order-grid {
            max-width: 900px;
            margin: 0 auto 48px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            position: relative;
            z-index: 2;
        }
        .order-step {
            background: rgba(245,230,208,0.06);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(var(--golden-rgb), 0.12);
            border-radius: 20px;
            padding: 36px 24px;
            text-align: center;
        }
        .order-step .order-num {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark-brown);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }
        .order-step h3 {
            font-family: 'Playfair Display', serif;
            color: var(--cream);
            font-size: 1.15rem;
            margin-bottom: 8px;
        }
        .order-step p {
            font-size: 14px;
            color: rgba(245,230,208,0.6);
            line-height: 1.6;
        }
        .order-cta {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        .btn-glow {
            display: inline-block;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: var(--dark-brown);
            background: linear-gradient(135deg, var(--golden), var(--accent));
            padding: 18px 48px;
            border-radius: 100px;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 4px 32px rgba(var(--accent-rgb), 0.35);
        }
        .btn-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 56px rgba(var(--accent-rgb), 0.55);
        }

        /* ── Footer ── */
        .footer {
            position: relative;
            background: var(--dark-brown);
            padding: 80px 20px 40px;
            text-align: center;
            overflow: hidden;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--golden), var(--accent), var(--golden), transparent);
        }
        .footer h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--cream);
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }
        .footer .footer-tagline {
            font-family: 'Dancing Script', cursive;
            font-size: 1.2rem;
            color: var(--golden);
            margin-bottom: 28px;
            position: relative;
            z-index: 2;
        }
        .footer-badge {
            display: inline-block;
            padding: 8px 24px;
            border: 1.5px solid rgba(var(--golden-rgb), 0.3);
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(245,230,208,0.7);
            margin-bottom: 28px;
            position: relative;
            z-index: 2;
        }
        .footer-info {
            font-size: 14px;
            color: rgba(245,230,208,0.5);
            line-height: 2;
            position: relative;
            z-index: 2;
        }
        .footer-info a {
            color: var(--golden);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-info a:hover { color: var(--cream); }
        .footer-bottom {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid rgba(245,230,208,0.08);
            font-size: 13px;
            color: rgba(245,230,208,0.3);
            position: relative;
            z-index: 2;
        }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            .about-inner {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            .about-photo {
                width: 200px;
                height: 200px;
                font-size: 60px;
            }
            .about-card { padding: 32px 24px; }
            .process-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .menu-grid { grid-template-columns: 1fr; }
            .reviews-grid { grid-template-columns: 1fr; }
            .order-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .insta-grid { grid-template-columns: repeat(3, 1fr); }
            .main-nav { gap: 2px; padding: 10px 12px; flex-wrap: wrap; }
            .main-nav a { padding: 6px 14px; font-size: 13px; }
        }

        @media (max-width: 480px) {
            .process-grid { grid-template-columns: 1fr; }
            .insta-grid { grid-template-columns: repeat(2, 1fr); }
            .menu-tabs { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>

    {{-- Concept Nav --}}
    <div class="concept-nav">
        <a href="/">A</a>
        <a href="/concept-b">B</a>
        <a href="/concept-c">C</a>
        <a href="/concept-d">D</a>
        <a href="/concept-e">E</a>
        <a href="/concept-f">F</a>
        <a href="/concept-g" class="active">G</a>
    </div>

    {{-- Main Nav --}}
    <nav class="main-nav">
        <a href="#home">Home</a>
        <a href="#menu">Menu</a>
        <a href="#about">About</a>
        <a href="#order">Order</a>
        <a href="#contact">Contact</a>
    </nav>

    {{-- Hero --}}
    <section class="hero noise" id="home">
        <div class="hero-bg"></div>
        <div class="orb" style="width:400px;height:400px;background:rgba(var(--accent-rgb),0.4);top:-100px;left:-80px;"></div>
        <div class="orb" style="width:300px;height:300px;background:rgba(var(--golden-rgb),0.3);bottom:-50px;right:-60px;"></div>
        <div class="orb" style="width:200px;height:200px;background:rgba(var(--accent-rgb),0.2);top:40%;right:15%;"></div>
        <div class="hero-content">
            <h1 class="hero-fade hero-fade-d1">Bakery on Biscotto</h1>
            <p class="tagline hero-fade hero-fade-d2">Where Sourdough Dreams Come True</p>
            <a href="#menu" class="btn-primary hero-fade hero-fade-d3">Explore Our Menu</a>
        </div>
    </section>

    {{-- Divider --}}
    <div class="divider">
        <span class="divider-line"></span>
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 4C20 4 22 12 20 20C18 12 20 4 20 4Z" fill="var(--golden)" opacity="0.6"/>
            <path d="M20 8C20 8 26 14 24 22C22 16 20 8 20 8Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M20 8C20 8 14 14 16 22C18 16 20 8 20 8Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M20 12C20 12 28 16 26 24C24 18 20 12 20 12Z" fill="var(--golden)" opacity="0.3"/>
            <path d="M20 12C20 12 12 16 14 24C16 18 20 12 20 12Z" fill="var(--golden)" opacity="0.3"/>
            <line x1="20" y1="20" x2="20" y2="36" stroke="var(--golden)" stroke-width="1.5" opacity="0.5"/>
        </svg>
        <span class="divider-line"></span>
    </div>

    {{-- Meet Cassie --}}
    <section class="about-section noise" id="about">
        <div class="orb" style="width:350px;height:350px;background:rgba(var(--accent-rgb),0.15);top:-80px;right:-100px;"></div>
        <div class="orb" style="width:250px;height:250px;background:rgba(var(--golden-rgb),0.12);bottom:-60px;left:-80px;"></div>
        <div class="about-inner">
            <div class="about-photo reveal">👩‍🍳</div>
            <div class="about-card reveal" style="transition-delay: 0.15s;">
                <h2>Meet Cassie</h2>
                <p>Hi there! I'm Cassie, the baker behind every loaf, every muffin, and every crumb at Bakery on Biscotto. What started as a love affair with sourdough in my home kitchen has grown into something I'm so proud of.</p>
                <p>My sourdough starter, Biscotto, is the heart of this bakery. But what really drives me is the joy of feeding my community with bread made slowly, with care, and with the best ingredients I can find.</p>
                <p>Every single thing I bake is made by hand, from scratch, with love. No shortcuts, no preservatives, just real bread the way it should be.</p>
                <p class="signature">With love and flour dust, Cassie ✨</p>
            </div>
        </div>
    </section>

    {{-- Divider --}}
    <div class="divider">
        <span class="divider-line"></span>
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 4C20 4 22 12 20 20C18 12 20 4 20 4Z" fill="var(--golden)" opacity="0.6"/>
            <path d="M20 8C20 8 26 14 24 22C22 16 20 8 20 8Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M20 8C20 8 14 14 16 22C18 16 20 8 20 8Z" fill="var(--golden)" opacity="0.4"/>
            <line x1="20" y1="20" x2="20" y2="36" stroke="var(--golden)" stroke-width="1.5" opacity="0.5"/>
        </svg>
        <span class="divider-line"></span>
    </div>

    {{-- Process --}}
    <section class="process-section noise">
        <div class="orb" style="width:300px;height:300px;background:rgba(var(--golden-rgb),0.15);top:-60px;left:10%;"></div>
        <div class="orb" style="width:250px;height:250px;background:rgba(var(--accent-rgb),0.1);bottom:-80px;right:5%;"></div>
        <h2 class="section-title reveal">Our Process</h2>
        <div class="process-grid">
            <div class="process-step reveal" style="transition-delay: 0s;">
                <div class="step-num">1</div>
                <h3>Source</h3>
                <p>Quality ingredients, locally when possible</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.12s;">
                <div class="step-num">2</div>
                <h3>Craft</h3>
                <p>Mixed and shaped by hand with care</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.24s;">
                <div class="step-num">3</div>
                <h3>Time</h3>
                <p>Slow rise for deep flavor and perfect texture</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.36s;">
                <div class="step-num">4</div>
                <h3>Bake</h3>
                <p>Fresh from the oven to your table</p>
            </div>
        </div>
    </section>

    {{-- Menu --}}
    <section class="menu-section" id="menu" x-data="{ tab: 'sourdough' }">
        <h2 class="section-title reveal">What We Bake</h2>
        <div class="menu-tabs reveal">
            <button class="menu-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="menu-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        {{-- Sourdough --}}
        <div class="menu-grid" x-show="tab === 'sourdough'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="menu-card reveal">
                <div class="menu-card-img"><img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf"></div>
                <div class="menu-card-body">
                    <h3>Regular Loaf</h3>
                    <p class="desc">Classic sourdough with a golden crust and airy crumb</p>
                    <span class="price-badge">$10</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.06s;">
                <div class="menu-card-img">🧀</div>
                <div class="menu-card-body">
                    <h3>Cheddar</h3>
                    <p class="desc">Sharp cheddar folded into tangy sourdough</p>
                    <span class="price-badge">$12</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.12s;">
                <div class="menu-card-img">🧄</div>
                <div class="menu-card-body">
                    <h3>Mozzarella and Garlic</h3>
                    <p class="desc">Melty mozzarella with roasted garlic throughout</p>
                    <span class="price-badge">$14</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.18s;">
                <div class="menu-card-img">🍫</div>
                <div class="menu-card-body">
                    <h3>Chocolate Chip</h3>
                    <p class="desc">Rich chocolate chips in every slice</p>
                    <span class="price-badge">$12</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.24s;">
                <div class="menu-card-img">✨</div>
                <div class="menu-card-body">
                    <h3>Cinnamon and Sugar</h3>
                    <p class="desc">Warm cinnamon swirled with sweet sugar</p>
                    <span class="price-badge">$14</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.3s;">
                <div class="menu-card-img">🍫</div>
                <div class="menu-card-body">
                    <h3>Chocolate, Chocolate Chip</h3>
                    <p class="desc">Double chocolate for the true chocolate lover</p>
                    <span class="price-badge">$12</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.36s;">
                <div class="menu-card-img">🍫</div>
                <div class="menu-card-body">
                    <h3>Chocolate Almond, Chocolate Chip</h3>
                    <p class="desc">Chocolate and almond with chips for extra indulgence</p>
                    <span class="price-badge">$15</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.42s;">
                <div class="menu-card-img">🌶️</div>
                <div class="menu-card-body">
                    <h3>Jalape&ntilde;o Cheddar</h3>
                    <p class="desc">Spicy jalape&ntilde;os and melty cheddar, a perfect pair</p>
                    <span class="price-badge">$14</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.48s;">
                <div class="menu-card-img">🍞</div>
                <div class="menu-card-body">
                    <h3>4 Pack of Mini Loaves</h3>
                    <p class="desc">Choose any 4 flavors for a variety pack</p>
                    <span class="price-badge">$25</span>
                </div>
            </div>
        </div>

        {{-- Other Breads --}}
        <div class="menu-grid" x-show="tab === 'other'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="menu-card reveal">
                <div class="menu-card-img">🍯</div>
                <div class="menu-card-body">
                    <h3>Sourdough Honey Wheat Sandwich Bread</h3>
                    <p class="desc">Soft honey wheat perfect for sandwiches</p>
                    <span class="price-badge">$10</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.06s;">
                <div class="menu-card-img"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                <div class="menu-card-body">
                    <h3>Sourdough English Muffins (6ct)</h3>
                    <p class="desc">Nooks and crannies in every single one</p>
                    <span class="price-badge">$8</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.12s;">
                <div class="menu-card-img"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                <div class="menu-card-body">
                    <h3>Sourdough English Muffins (12ct)</h3>
                    <p class="desc">Double the muffins, double the joy</p>
                    <span class="price-badge">$15</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.18s;">
                <div class="menu-card-img">🍌</div>
                <div class="menu-card-body">
                    <h3>Banana Bread</h3>
                    <p class="desc">Moist, sweet, and perfectly spiced</p>
                    <span class="price-badge">$12</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.24s;">
                <div class="menu-card-img">🍌</div>
                <div class="menu-card-body">
                    <h3>Banana Walnut Bread</h3>
                    <p class="desc">Classic banana bread loaded with crunchy walnuts</p>
                    <span class="price-badge">$15</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.3s;">
                <div class="menu-card-img">🎃</div>
                <div class="menu-card-body">
                    <h3>Pumpkin Chocolate Chip Bread</h3>
                    <p class="desc">Warm pumpkin spice with chocolate chips</p>
                    <span class="price-badge">$12</span>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.36s;">
                <div class="menu-card-img">🎃</div>
                <div class="menu-card-body">
                    <h3>Pumpkin Almond Chocolate Chip Bread</h3>
                    <p class="desc">Pumpkin, almond, and chocolate in every bite</p>
                    <span class="price-badge">$15</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Reviews --}}
    <section class="reviews-section">
        <h2 class="section-title reveal">What Our Neighbors Say</h2>
        <div class="reviews-grid">
            <div class="review-card reveal">
                <span class="quote-mark">&ldquo;</span>
                <p>The best sourdough I've ever had, and I've tried a lot! The crust is perfectly crispy and the inside is so soft. We order every single week now.</p>
                <span class="reviewer">Sarah M., Davenport</span>
            </div>
            <div class="review-card reveal" style="transition-delay:0.1s;">
                <span class="quote-mark">&ldquo;</span>
                <p>Cassie's chocolate chip sourdough changed my life. I'm not even being dramatic. My kids fight over the last slice every time.</p>
                <span class="reviewer">Mike T., Haines City</span>
            </div>
            <div class="review-card reveal" style="transition-delay:0.2s;">
                <span class="quote-mark">&ldquo;</span>
                <p>Finally, real bread from someone who actually cares. You can taste the difference. The English muffins are out of this world!</p>
                <span class="reviewer">Jessica R., Clermont</span>
            </div>
            <div class="review-card reveal" style="transition-delay:0.3s;">
                <span class="quote-mark">&ldquo;</span>
                <p>I ordered the mini loaf variety pack and now I can't pick a favorite. The jalape&ntilde;o cheddar and cinnamon sugar are tied for first place.</p>
                <span class="reviewer">David L., Kissimmee</span>
            </div>
        </div>
    </section>

    {{-- Instagram --}}
    <section class="instagram-section">
        <h2 class="section-title reveal">Fresh from the Oven</h2>
        <div class="insta-grid">
            <div class="insta-item reveal"><img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule"></div>
            <div class="insta-item reveal" style="transition-delay:0.06s;"><img src="/images/product-english-muffins.jpg" alt="English muffins"></div>
            <div class="insta-item reveal" style="transition-delay:0.12s;">🍞<span class="placeholder-text">Bake day</span></div>
            <div class="insta-item reveal" style="transition-delay:0.18s;">🧈<span class="placeholder-text">Fresh butter</span></div>
            <div class="insta-item reveal" style="transition-delay:0.24s;">🌾<span class="placeholder-text">Local flour</span></div>
            <div class="insta-item reveal" style="transition-delay:0.3s;">🥖<span class="placeholder-text">Cooling rack</span></div>
        </div>
        <div class="insta-cta reveal">
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Follow @bakeryonbiscotto</a>
            <div class="social-icons">
                <a href="https://facebook.com/bakeryonbiscotto" target="_blank" aria-label="Facebook">
                    <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" aria-label="Instagram">
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Order --}}
    <section class="order-section noise" id="order">
        <div class="orb" style="width:350px;height:350px;background:rgba(var(--golden-rgb),0.12);top:-100px;right:-80px;"></div>
        <div class="orb" style="width:280px;height:280px;background:rgba(var(--accent-rgb),0.1);bottom:-60px;left:-60px;"></div>
        <h2 class="section-title reveal">Ready to Order?</h2>
        <div class="order-grid">
            <div class="order-step reveal">
                <div class="order-num">1</div>
                <h3>Browse</h3>
                <p>Check out our menu and pick your favorites</p>
            </div>
            <div class="order-step reveal" style="transition-delay:0.12s;">
                <div class="order-num">2</div>
                <h3>Email Us</h3>
                <p>Send us your order and we'll confirm the details</p>
            </div>
            <div class="order-step reveal" style="transition-delay:0.24s;">
                <div class="order-num">3</div>
                <h3>Pick Up</h3>
                <p>Grab your fresh bread, still warm from the oven</p>
            </div>
        </div>
        <div class="order-cta reveal">
            <a href="mailto:bakeryonbiscotto@gmail.com" class="btn-glow">Place Your Order</a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="footer noise" id="contact">
        <h3>Bakery on Biscotto</h3>
        <p class="footer-tagline">With love and flour dust</p>
        <div class="footer-badge">Local Pickup &amp; Delivery Available</div>
        <div class="footer-info">
            Davenport, FL<br>
            <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a><br>
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook</a> &middot; <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram</a> &middot; @bakeryonbiscotto
        </div>
        <div class="footer-bottom">&copy; {{ date('Y') }} Bakery on Biscotto. All rights reserved.</div>
    </footer>

    <script>
        // Intersection Observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>
</html>
