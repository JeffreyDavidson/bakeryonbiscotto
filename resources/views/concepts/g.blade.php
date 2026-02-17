<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto | Handcrafted Bread, Davenport FL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --light-cream: #FDF8F2;
            --white: #FFFFFF;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark-brown);
            background: var(--light-cream);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Concept Switcher ── */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            gap: 4px;
            padding: 6px 10px;
            background: rgba(61, 35, 20, 0.92);
            backdrop-filter: blur(8px);
        }
        .concept-nav a {
            color: var(--cream);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 3px 12px;
            border-radius: 20px;
            transition: all 0.2s;
        }
        .concept-nav a:hover { background: rgba(212, 165, 116, 0.3); }
        .concept-nav a.active {
            background: var(--golden-tan);
            color: var(--dark-brown);
            font-weight: 600;
        }

        /* ── Main Nav ── */
        .main-nav {
            position: fixed;
            top: 34px;
            left: 0;
            right: 0;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 14px 20px;
            background: rgba(253, 248, 242, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 2px 20px rgba(61, 35, 20, 0.08);
            transition: all 0.3s;
        }
        .main-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 500;
            color: var(--dark-brown);
            text-decoration: none;
            padding: 10px 26px;
            border-radius: 50px;
            border: 1.5px solid transparent;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }
        .main-nav a:hover {
            border-color: var(--golden-tan);
            background: rgba(212, 165, 116, 0.12);
        }
        .main-nav a.active-link {
            background: var(--dark-brown);
            color: var(--cream);
        }

        /* ── Hero ── */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            max-height: 900px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            margin-top: 0;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('/images/hero-banner.jpg') center/cover no-repeat;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(61, 35, 20, 0.35) 0%,
                rgba(61, 35, 20, 0.55) 100%
            );
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 0 20px;
        }
        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 16px;
            text-shadow: 0 2px 30px rgba(0,0,0,0.3);
        }
        .hero-content h1 span {
            display: block;
            font-style: italic;
            font-weight: 400;
            font-size: 0.55em;
            color: var(--golden-tan);
            margin-top: 4px;
        }
        .hero-tagline {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.3rem, 3vw, 2rem);
            color: var(--cream);
            margin-bottom: 32px;
        }
        .hero-cta {
            display: inline-block;
            padding: 14px 40px;
            background: var(--golden-tan);
            color: var(--dark-brown);
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .hero-cta:hover {
            background: var(--cream);
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(0,0,0,0.25);
        }

        /* ── Section Divider ── */
        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            padding: 48px 0;
        }
        .divider-line {
            width: 80px;
            height: 1px;
            background: var(--golden-tan);
            opacity: 0.5;
        }
        .divider-icon {
            color: var(--golden-tan);
            font-size: 18px;
            opacity: 0.7;
        }
        .divider-icon svg {
            width: 28px;
            height: 28px;
            fill: var(--golden-tan);
            opacity: 0.6;
        }

        /* ── Section Shared ── */
        .section {
            padding: 40px 20px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 600;
            text-align: center;
            color: var(--dark-brown);
            margin-bottom: 12px;
        }
        .section-subtitle {
            text-align: center;
            color: var(--warm-brown);
            font-size: 16px;
            max-width: 560px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        /* ── Scroll Animation ── */
        .fade-in {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Meet Cassie ── */
        .meet-cassie {
            display: flex;
            align-items: center;
            gap: 60px;
            max-width: 900px;
            margin: 0 auto;
        }
        .cassie-photo {
            flex-shrink: 0;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--cream), var(--golden-tan));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Dancing Script', cursive;
            font-size: 18px;
            color: var(--warm-brown);
            border: 4px solid var(--white);
            box-shadow: 0 8px 30px rgba(61, 35, 20, 0.12);
        }
        .cassie-text p {
            color: var(--dark-brown);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 16px;
        }
        .cassie-signature {
            font-family: 'Dancing Script', cursive;
            font-size: 22px;
            color: var(--warm-brown);
            margin-top: 8px;
        }

        /* ── Process ── */
        .process-row {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        .process-step {
            text-align: center;
            flex: 1;
            min-width: 180px;
            max-width: 240px;
        }
        .process-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            box-shadow: 0 4px 16px rgba(61, 35, 20, 0.08);
        }
        .process-step h3 {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark-brown);
        }
        .process-step p {
            font-size: 14px;
            color: var(--warm-brown);
            line-height: 1.6;
        }

        /* ── Menu ── */
        .menu-section {
            background: var(--white);
            padding: 60px 20px;
        }
        .menu-inner {
            max-width: 1100px;
            margin: 0 auto;
        }
        .menu-tabs {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 36px;
        }
        .menu-tab {
            padding: 10px 28px;
            border-radius: 50px;
            border: 2px solid var(--golden-tan);
            background: transparent;
            color: var(--warm-brown);
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .menu-tab:hover { background: rgba(212, 165, 116, 0.15); }
        .menu-tab.active {
            background: var(--dark-brown);
            border-color: var(--dark-brown);
            color: var(--cream);
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
        }
        .menu-card {
            border-radius: 16px;
            overflow: hidden;
            background: var(--white);
            box-shadow: 0 4px 20px rgba(61, 35, 20, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(61, 35, 20, 0.14);
        }
        .menu-card-img {
            height: 160px;
            background: linear-gradient(135deg, var(--cream) 0%, var(--golden-tan) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            position: relative;
            overflow: hidden;
        }
        .menu-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .menu-card-body {
            padding: 16px 20px;
        }
        .menu-card-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 6px;
        }
        .menu-card-price {
            font-size: 18px;
            font-weight: 600;
            color: var(--warm-brown);
        }

        /* ── Reviews ── */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .review-card {
            background: var(--white);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 16px rgba(61, 35, 20, 0.06);
            position: relative;
        }
        .review-card::before {
            content: '\201C';
            font-family: 'Playfair Display', serif;
            font-size: 60px;
            color: var(--golden-tan);
            opacity: 0.3;
            position: absolute;
            top: 8px;
            left: 20px;
            line-height: 1;
        }
        .review-text {
            font-size: 15px;
            line-height: 1.7;
            color: var(--dark-brown);
            margin-bottom: 16px;
            padding-top: 20px;
            font-style: italic;
        }
        .review-stars { color: var(--golden-tan); font-size: 14px; margin-bottom: 8px; }
        .review-author {
            font-weight: 600;
            font-size: 14px;
            color: var(--warm-brown);
        }

        /* ── Instagram ── */
        .insta-section {
            background: var(--cream);
            padding: 60px 20px;
        }
        .insta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            max-width: 900px;
            margin: 0 auto 28px;
        }
        .insta-item {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--golden-tan), var(--warm-brown));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--cream);
            font-size: 32px;
            position: relative;
            transition: transform 0.3s;
        }
        .insta-item:hover { transform: scale(1.03); }
        .insta-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .insta-link {
            display: block;
            text-align: center;
            color: var(--warm-brown);
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            text-decoration: none;
            font-weight: 500;
        }
        .insta-link:hover { color: var(--dark-brown); }

        /* ── Order ── */
        .order-section {
            background: var(--dark-brown);
            padding: 80px 20px;
            text-align: center;
        }
        .order-section .section-title { color: var(--cream); }
        .order-section .section-subtitle { color: var(--golden-tan); }
        .order-steps {
            display: flex;
            justify-content: center;
            gap: 48px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .order-step {
            text-align: center;
            max-width: 200px;
        }
        .order-num {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--golden-tan);
            color: var(--dark-brown);
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }
        .order-step h3 {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            color: var(--cream);
            margin-bottom: 6px;
        }
        .order-step p {
            font-size: 14px;
            color: var(--golden-tan);
            line-height: 1.6;
        }
        .order-cta {
            display: inline-block;
            padding: 16px 48px;
            background: var(--golden-tan);
            color: var(--dark-brown);
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s;
        }
        .order-cta:hover {
            background: var(--cream);
            transform: translateY(-2px);
        }

        /* ── Footer ── */
        .footer {
            background: #2A1810;
            color: var(--cream);
            padding: 60px 20px 30px;
        }
        .footer-inner {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        .footer-name {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .footer-tagline {
            font-family: 'Dancing Script', cursive;
            font-size: 18px;
            color: var(--golden-tan);
            margin-bottom: 28px;
        }
        .footer-pickup {
            display: inline-block;
            padding: 14px 32px;
            border: 1.5px solid var(--golden-tan);
            border-radius: 12px;
            margin-bottom: 28px;
            color: var(--cream);
            font-size: 14px;
        }
        .footer-pickup strong { color: var(--golden-tan); }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 28px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .footer-links a {
            color: var(--golden-tan);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--cream); }
        .footer-copy {
            font-size: 13px;
            color: rgba(245, 230, 208, 0.5);
            margin-top: 20px;
        }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            .main-nav {
                gap: 4px;
                padding: 10px 12px;
                flex-wrap: wrap;
            }
            .main-nav a {
                padding: 8px 16px;
                font-size: 13px;
            }
            .meet-cassie {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }
            .cassie-photo { width: 180px; height: 180px; }
            .process-row { gap: 24px; }
            .process-step { min-width: 140px; }
            .menu-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
            .insta-grid { grid-template-columns: repeat(2, 1fr); }
            .order-steps { gap: 28px; }
        }

        @media (max-width: 480px) {
            .main-nav a { padding: 7px 12px; font-size: 12px; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Concept Switcher -->
<div class="concept-nav">
    <a href="/">A</a>
    <a href="/concept-b">B</a>
    <a href="/concept-c">C</a>
    <a href="/concept-d">D</a>
    <a href="/concept-e">E</a>
    <a href="/concept-f">F</a>
    <a href="/concept-g" class="active">G</a>
</div>

<!-- Main Navigation -->
<nav class="main-nav">
    <a href="#home" class="active-link">Home</a>
    <a href="#menu">Menu</a>
    <a href="#about">About</a>
    <a href="#order">Order</a>
    <a href="#contact">Contact</a>
</nav>

<!-- Hero -->
<section class="hero" id="home">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Bakery on Biscotto <span>Where Sourdough Dreams Come True</span></h1>
        <p class="hero-tagline">Handcrafted with love in Davenport, FL</p>
        <a href="#menu" class="hero-cta">Explore Our Menu</a>
    </div>
</section>

<!-- Divider -->
<div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c0 0-2 4-2 8s2 6 2 6 2-2 2-6-2-8-2-8zm-4 6c-1 2-1 5 0 7 1 1.5 2 2 3 3-1-1-3-3-3-5s0-4 0-5zm8 0c1 2 1 5 0 7-1 1.5-2 2-3 3 1-1 3-3 3-5s0-4 0-5zM12 18c-2 1-4 2-5 4h10c-1-2-3-3-5-4z"/></svg>
    </div>
    <div class="divider-line"></div>
</div>

<!-- Meet Cassie -->
<section class="section fade-in" id="about">
    <h2 class="section-title">Meet Cassie</h2>
    <p class="section-subtitle">The heart and hands behind every loaf</p>
    <div class="meet-cassie">
        <div class="cassie-photo">Cassie's Photo</div>
        <div class="cassie-text">
            <p>Hi there! I'm Cassie, and baking has been my passion for as long as I can remember. What started as a simple experiment with my sourdough starter, Biscotto (named after our street, Biscotto Circle), quickly turned into something so much bigger.</p>
            <p>Every loaf, every muffin, every bread that leaves my kitchen is made by hand with real ingredients and a whole lot of love. My husband Jeffrey says the house always smells like a bakery, and honestly, I wouldn't have it any other way.</p>
            <p>I believe that good bread brings people together. Whether it's a classic sourdough for your family dinner or a chocolate chip loaf for a special treat, I put the same care into every single one.</p>
            <p class="cassie-signature">With love and flour dust, Cassie</p>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c0 0-2 4-2 8s2 6 2 6 2-2 2-6-2-8-2-8zm-4 6c-1 2-1 5 0 7 1 1.5 2 2 3 3-1-1-3-3-3-5s0-4 0-5zm8 0c1 2 1 5 0 7-1 1.5-2 2-3 3 1-1 3-3 3-5s0-4 0-5zM12 18c-2 1-4 2-5 4h10c-1-2-3-3-5-4z"/></svg>
    </div>
    <div class="divider-line"></div>
</div>

<!-- Our Process -->
<section class="section fade-in">
    <h2 class="section-title">Our Process</h2>
    <p class="section-subtitle">Care and craft in every step</p>
    <div class="process-row">
        <div class="process-step">
            <div class="process-icon">🌾</div>
            <h3>Quality Ingredients</h3>
            <p>We start with the best flour, butter, and real ingredients. No shortcuts, no preservatives.</p>
        </div>
        <div class="process-step">
            <div class="process-icon">🤲</div>
            <h3>Made by Hand</h3>
            <p>Every loaf is hand-shaped and crafted with attention to detail and years of practice.</p>
        </div>
        <div class="process-step">
            <div class="process-icon">⏳</div>
            <h3>Slow and Steady</h3>
            <p>Good things take time. We never rush the process, letting flavor develop naturally.</p>
        </div>
        <div class="process-step">
            <div class="process-icon">🍞</div>
            <h3>Baked Fresh</h3>
            <p>Your order is baked fresh, so it arrives at your door at its very best.</p>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c0 0-2 4-2 8s2 6 2 6 2-2 2-6-2-8-2-8zm-4 6c-1 2-1 5 0 7 1 1.5 2 2 3 3-1-1-3-3-3-5s0-4 0-5zm8 0c1 2 1 5 0 7-1 1.5-2 2-3 3 1-1 3-3 3-5s0-4 0-5zM12 18c-2 1-4 2-5 4h10c-1-2-3-3-5-4z"/></svg>
    </div>
    <div class="divider-line"></div>
</div>

<!-- Menu -->
<section class="menu-section" id="menu" x-data="{ tab: 'sourdough' }">
    <div class="menu-inner">
        <h2 class="section-title fade-in">What We Bake</h2>
        <p class="section-subtitle fade-in">Handcrafted breads made to order, right here in Davenport</p>

        <div class="menu-tabs fade-in">
            <button class="menu-tab" :class="{ active: tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="menu-tab" :class="{ active: tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <!-- Sourdough Loaves -->
        <div class="menu-grid fade-in" x-show="tab === 'sourdough'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="menu-card">
                <div class="menu-card-img"><img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf"></div>
                <div class="menu-card-body">
                    <h3>Regular Loaf</h3>
                    <div class="menu-card-price">$10</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🧀</div>
                <div class="menu-card-body">
                    <h3>Cheddar</h3>
                    <div class="menu-card-price">$12</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🧄</div>
                <div class="menu-card-body">
                    <h3>Mozzarella and Garlic</h3>
                    <div class="menu-card-price">$14</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🍫</div>
                <div class="menu-card-body">
                    <h3>Chocolate Chip</h3>
                    <div class="menu-card-price">$12</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">✨</div>
                <div class="menu-card-body">
                    <h3>Cinnamon and Sugar</h3>
                    <div class="menu-card-price">$14</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🍫</div>
                <div class="menu-card-body">
                    <h3>Chocolate, Chocolate Chip</h3>
                    <div class="menu-card-price">$12</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🌰</div>
                <div class="menu-card-body">
                    <h3>Chocolate Almond, Chocolate Chip</h3>
                    <div class="menu-card-price">$15</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🌶️</div>
                <div class="menu-card-body">
                    <h3>Jalape&#241;o Cheddar</h3>
                    <div class="menu-card-price">$14</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🎁</div>
                <div class="menu-card-body">
                    <h3>4 Pack of Mini Loaves</h3>
                    <p style="font-size:13px;color:var(--warm-brown);margin-bottom:4px;">Choose any 4</p>
                    <div class="menu-card-price">$25</div>
                </div>
            </div>
        </div>

        <!-- Other Breads -->
        <div class="menu-grid fade-in" x-show="tab === 'other'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="menu-card">
                <div class="menu-card-img">🍯</div>
                <div class="menu-card-body">
                    <h3>Sourdough Honey Wheat Sandwich Bread</h3>
                    <div class="menu-card-price">$10</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                <div class="menu-card-body">
                    <h3>Sourdough English Muffins (6ct)</h3>
                    <div class="menu-card-price">$8</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                <div class="menu-card-body">
                    <h3>Sourdough English Muffins (12ct)</h3>
                    <div class="menu-card-price">$15</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🍌</div>
                <div class="menu-card-body">
                    <h3>Banana Bread</h3>
                    <div class="menu-card-price">$12</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🥜</div>
                <div class="menu-card-body">
                    <h3>Banana Walnut Bread</h3>
                    <div class="menu-card-price">$15</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🎃</div>
                <div class="menu-card-body">
                    <h3>Pumpkin Chocolate Chip Bread</h3>
                    <div class="menu-card-price">$12</div>
                </div>
            </div>
            <div class="menu-card">
                <div class="menu-card-img">🎃</div>
                <div class="menu-card-body">
                    <h3>Pumpkin Almond Chocolate Chip Bread</h3>
                    <div class="menu-card-price">$15</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c0 0-2 4-2 8s2 6 2 6 2-2 2-6-2-8-2-8zm-4 6c-1 2-1 5 0 7 1 1.5 2 2 3 3-1-1-3-3-3-5s0-4 0-5zm8 0c1 2 1 5 0 7-1 1.5-2 2-3 3 1-1 3-3 3-5s0-4 0-5zM12 18c-2 1-4 2-5 4h10c-1-2-3-3-5-4z"/></svg>
    </div>
    <div class="divider-line"></div>
</div>

<!-- Customer Favorites -->
<section class="section fade-in">
    <h2 class="section-title">Customer Favorites</h2>
    <p class="section-subtitle">Kind words from our bread-loving community</p>
    <div class="reviews-grid">
        <div class="review-card">
            <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="review-text">The jalape&#241;o cheddar loaf is out of this world. My family fights over the last slice every single time!</p>
            <div class="review-author">Sarah M.</div>
        </div>
        <div class="review-card">
            <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="review-text">I've tried bakeries all over central Florida and nothing compares. The sourdough is perfectly tangy with the most amazing crust.</p>
            <div class="review-author">David R.</div>
        </div>
        <div class="review-card">
            <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="review-text">Ordered the mini loaves pack to try different flavors. Every single one was incredible. The cinnamon sugar is now a weekly must-have!</p>
            <div class="review-author">Emily T.</div>
        </div>
        <div class="review-card">
            <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="review-text">The English muffins are the best I've ever had. You can taste the love and care in every bite. We're customers for life!</p>
            <div class="review-author">Mike and Jen K.</div>
        </div>
    </div>
</section>

<!-- Instagram -->
<section class="insta-section fade-in">
    <h2 class="section-title" style="margin-bottom:8px;">Fresh from the Oven</h2>
    <p class="section-subtitle">Follow along for behind-the-scenes baking and fresh batch alerts</p>
    <div class="insta-grid">
        <div class="insta-item"><img src="/images/product-sourdough-boule.jpg" alt="Sourdough Boule"></div>
        <div class="insta-item"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
        <div class="insta-item">📸</div>
        <div class="insta-item">📸</div>
    </div>
    <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="insta-link">@bakeryonbiscotto on Instagram</a>
</section>

<!-- Ready to Order -->
<section class="order-section fade-in" id="order">
    <h2 class="section-title">Ready to Order?</h2>
    <p class="section-subtitle">Getting fresh bread is as easy as 1, 2, 3</p>
    <div class="order-steps">
        <div class="order-step">
            <div class="order-num">1</div>
            <h3>Send Us a Message</h3>
            <p>Email us with what you'd like to order. We'll confirm availability and timing.</p>
        </div>
        <div class="order-step">
            <div class="order-num">2</div>
            <h3>We Bake It Fresh</h3>
            <p>Your order is baked just for you. No day-old bread here!</p>
        </div>
        <div class="order-step">
            <div class="order-num">3</div>
            <h3>Pickup or Delivery</h3>
            <p>Grab your order locally in Davenport, or we can deliver it to your door.</p>
        </div>
    </div>
    <a href="mailto:bakeryonbiscotto@gmail.com" class="order-cta">Place Your Order</a>
</section>

<!-- Footer -->
<footer class="footer" id="contact">
    <div class="footer-inner">
        <div class="footer-name">Bakery on Biscotto</div>
        <div class="footer-tagline">With love and flour dust</div>
        <div class="footer-pickup">
            <strong>Local Pickup &amp; Delivery</strong><br>
            Davenport, FL
        </div>
        <div class="footer-links">
            <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a>
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram @bakeryonbiscotto</a>
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook @bakeryonbiscotto</a>
        </div>
        <div class="footer-copy">&copy; {{ date('Y') }} Bakery on Biscotto. All rights reserved.</div>
    </div>
</footer>

<script>
    // Intersection Observer for scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
    });
</script>

</body>
</html>
