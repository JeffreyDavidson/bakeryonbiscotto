<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto — Where Sourdough Dreams Come True</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Dancing+Script:wght@400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --soft-white: #FEFCF8;
            --light-cream: #FFF9F0;
            --text-muted: #9A8573;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--soft-white);
            color: var(--dark-brown);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ── Concept Switcher ── */
        .concept-nav {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 8px;
            background: rgba(255,255,255,0.95);
            padding: 10px 16px;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }
        .concept-nav a {
            padding: 6px 14px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            color: var(--warm-brown);
            transition: all 0.2s;
        }
        .concept-nav a:hover { background: var(--cream); }
        .concept-nav a.active { background: var(--dark-brown); color: white; }

        /* ── Navigation ── */
        .main-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(254, 252, 248, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(139, 94, 60, 0.1);
            padding: 16px 0;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-brown);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .nav-links a {
            padding: 10px 22px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--warm-brown);
            transition: all 0.25s;
        }

        .nav-links a:hover {
            background: var(--cream);
            color: var(--dark-brown);
        }

        /* ── Hero ── */
        .hero {
            position: relative;
            min-height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
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
                rgba(61, 35, 20, 0.3) 0%,
                rgba(61, 35, 20, 0.5) 50%,
                rgba(61, 35, 20, 0.7) 100%
            );
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            padding: 40px 24px;
        }

        .hero-tagline {
            font-family: 'Dancing Script', cursive;
            font-size: 1.3rem;
            color: var(--golden-tan);
            margin-bottom: 16px;
            letter-spacing: 1px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: white;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.85);
            font-weight: 300;
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .hero-btn {
            display: inline-block;
            padding: 16px 40px;
            background: var(--golden-tan);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(212, 165, 116, 0.4);
        }

        .hero-btn:hover {
            background: var(--warm-brown);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 94, 60, 0.4);
        }

        /* ── Section Divider ── */
        .section-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 12px 0;
        }

        .divider-line {
            height: 1px;
            width: 80px;
            background: linear-gradient(to right, transparent, var(--golden-tan), transparent);
        }

        .divider-icon {
            font-size: 1.4rem;
            color: var(--golden-tan);
            opacity: 0.7;
        }

        /* ── Section Styling ── */
        .section {
            padding: 80px 24px;
        }

        .section-alt {
            background: var(--light-cream);
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-label {
            font-family: 'Dancing Script', cursive;
            font-size: 1.1rem;
            color: var(--golden-tan);
            margin-bottom: 8px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: var(--dark-brown);
            line-height: 1.2;
        }

        .section-subtitle {
            margin-top: 12px;
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ── Meet Cassie ── */
        .meet-cassie {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .cassie-image {
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/5;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cassie-image-placeholder {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            color: var(--warm-brown);
            text-align: center;
            padding: 40px;
        }

        .cassie-text h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--dark-brown);
        }

        .cassie-text p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .cassie-signature {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            color: var(--warm-brown);
            margin-top: 24px;
        }

        /* ── Our Process ── */
        .process-steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .process-step {
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }

        .process-step::after {
            content: '→';
            position: absolute;
            right: -18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: var(--golden-tan);
            opacity: 0.4;
        }

        .process-step:last-child::after { display: none; }

        .process-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 1.5rem;
        }

        .process-step h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: var(--dark-brown);
        }

        .process-step p {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ── Menu ── */
        .menu-tabs {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .menu-tab {
            padding: 12px 32px;
            border-radius: 50px;
            border: 2px solid var(--cream);
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--warm-brown);
            cursor: pointer;
            transition: all 0.3s;
        }

        .menu-tab.active, .menu-tab:hover {
            background: var(--dark-brown);
            border-color: var(--dark-brown);
            color: white;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .menu-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            transition: all 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .menu-card-image {
            width: 100%;
            height: 200px;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .menu-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-card-image-placeholder {
            font-size: 3rem;
        }

        .menu-card-body {
            padding: 20px;
        }

        .menu-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .menu-card-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--dark-brown);
        }

        .menu-card-price {
            font-weight: 700;
            color: var(--warm-brown);
            font-size: 1.1rem;
            white-space: nowrap;
            margin-left: 12px;
        }

        .menu-card-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .menu-special {
            margin-top: 40px;
            background: linear-gradient(135deg, var(--cream) 0%, var(--light-cream) 100%);
            border-radius: 16px;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px dashed var(--golden-tan);
        }

        .menu-special-text h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--dark-brown);
            margin-bottom: 4px;
        }

        .menu-special-text p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .menu-special-price {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--warm-brown);
            font-weight: 700;
        }

        /* ── Customer Favorites ── */
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .favorite-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            position: relative;
        }

        .favorite-card::before {
            content: '"';
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            color: var(--golden-tan);
            opacity: 0.3;
            position: absolute;
            top: 10px;
            left: 20px;
            line-height: 1;
        }

        .favorite-stars {
            color: var(--golden-tan);
            font-size: 0.85rem;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }

        .favorite-text {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.7;
            font-style: italic;
            margin-bottom: 16px;
        }

        .favorite-author {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-brown);
        }

        /* ── Instagram ── */
        .instagram-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .instagram-item {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .instagram-item:hover {
            transform: scale(1.03);
        }

        .instagram-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .instagram-placeholder {
            font-size: 2.5rem;
        }

        .instagram-handle {
            text-align: center;
            margin-top: 24px;
        }

        .instagram-handle a {
            font-family: 'Dancing Script', cursive;
            font-size: 1.3rem;
            color: var(--warm-brown);
            text-decoration: none;
        }

        .instagram-handle a:hover { text-decoration: underline; }

        /* ── Ready to Order ── */
        .order-section {
            background: var(--dark-brown);
            color: white;
            text-align: center;
        }

        .order-section .section-label {
            color: var(--golden-tan);
        }

        .order-section .section-title {
            color: white;
        }

        .order-section .section-subtitle {
            color: rgba(255,255,255,0.7);
        }

        .order-methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 40px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .order-method {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 30px 24px;
            transition: all 0.3s;
        }

        .order-method:hover {
            background: rgba(255,255,255,0.12);
            border-color: var(--golden-tan);
        }

        .order-method-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .order-method h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .order-method p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.5;
        }

        .order-btn {
            display: inline-block;
            margin-top: 40px;
            padding: 16px 48px;
            background: var(--golden-tan);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .order-btn:hover {
            background: var(--warm-brown);
            transform: translateY(-2px);
        }

        /* ── Footer ── */
        .footer {
            background: #2A1A0E;
            color: rgba(255,255,255,0.7);
            padding: 60px 24px 30px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
        }

        .footer-brand h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 12px;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.7;
            max-width: 350px;
        }

        .footer-brand .flour-dust {
            font-family: 'Dancing Script', cursive;
            font-size: 1.1rem;
            color: var(--golden-tan);
            margin-top: 16px;
        }

        .footer h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: white;
            margin-bottom: 16px;
        }

        .footer ul {
            list-style: none;
        }

        .footer ul li {
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer a:hover { color: var(--golden-tan); }

        .footer-bottom {
            max-width: 1200px;
            margin: 40px auto 0;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
        }

        .footer-social {
            display: flex;
            gap: 16px;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: var(--golden-tan);
            border-color: var(--golden-tan);
            color: white;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .concept-nav { display: none; }
            .nav-links { display: none; }
            .meet-cassie { grid-template-columns: 1fr; gap: 40px; }
            .process-steps { grid-template-columns: repeat(2, 1fr); }
            .process-step::after { display: none; }
            .favorites-grid { grid-template-columns: 1fr; }
            .instagram-grid { grid-template-columns: repeat(2, 1fr); }
            .order-methods { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
            .menu-special { flex-direction: column; text-align: center; gap: 16px; }
        }
    </style>
</head>
<body>

<!-- Concept Switcher -->
<nav class="concept-nav">
    <a href="/">A</a>
    <a href="/concept-b">B</a>
    <a href="/concept-c">C</a>
    <a href="/concept-d">D</a>
    <a href="/concept-e">E</a>
    <a href="/concept-f">F</a>
    <a href="/concept-g" class="active">G</a>
</nav>

<!-- Navigation -->
<nav class="main-nav">
    <div class="nav-inner">
        <a href="#" class="nav-logo">Bakery on Biscotto</a>
        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="#order">Order</a></li>
        </ul>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <p class="hero-tagline">Handcrafted in Davenport, Florida</p>
        <h1 class="hero-title">Where Sourdough Dreams Come True</h1>
        <p class="hero-subtitle">Fresh, handcrafted bread baked with love using our signature sourdough starter, Biscotto. Available for local pickup and delivery.</p>
        <a href="#menu" class="hero-btn">Explore Our Bread</a>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"><div class="divider-line"></div><span class="divider-icon">🌾</span><div class="divider-line"></div></div>

<!-- Meet Cassie -->
<section class="section" id="about">
    <div class="section-inner">
        <div class="meet-cassie">
            <div class="cassie-image">
                <div class="cassie-image-placeholder">
                    Photo of Cassie<br>coming soon
                </div>
            </div>
            <div class="cassie-text">
                <p class="section-label">The Baker Behind the Bread</p>
                <h3>Meet Cassie</h3>
                <p>What started as a pandemic hobby quickly turned into an obsession. After countless loaves, late-night feedings, and one very spoiled sourdough starter named Biscotto, I realized I wanted to share this with my community.</p>
                <p>Every loaf that leaves my kitchen is made with the same care I'd put into feeding my own family. Simple ingredients, slow fermentation, and a whole lot of love. No shortcuts, no preservatives, just real bread the way it should be.</p>
                <p>Whether you're a sourdough purist or just craving a good loaf of banana bread, I've got something for you.</p>
                <p class="cassie-signature">With love and flour dust, Cassie ♡</p>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"><div class="divider-line"></div><span class="divider-icon">🌾</span><div class="divider-line"></div></div>

<!-- Our Process -->
<section class="section section-alt">
    <div class="section-inner">
        <div class="section-header">
            <p class="section-label">From Starter to Table</p>
            <h2 class="section-title">How We Bake</h2>
            <p class="section-subtitle">Every loaf follows a slow, thoughtful process. Great bread can't be rushed.</p>
        </div>
        <div class="process-steps">
            <div class="process-step">
                <div class="process-icon">🫙</div>
                <h4>Feed the Starter</h4>
                <p>Biscotto gets fed daily to stay happy, bubbly, and ready for baking</p>
            </div>
            <div class="process-step">
                <div class="process-icon">🤲</div>
                <h4>Mix &amp; Shape</h4>
                <p>Simple ingredients come together by hand with care and intention</p>
            </div>
            <div class="process-step">
                <div class="process-icon">⏳</div>
                <h4>Slow Rise</h4>
                <p>Long fermentation develops deep flavor and that perfect texture</p>
            </div>
            <div class="process-step">
                <div class="process-icon">🍞</div>
                <h4>Bake &amp; Enjoy</h4>
                <p>Into the oven and straight to your table, fresh and golden</p>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"><div class="divider-line"></div><span class="divider-icon">🌾</span><div class="divider-line"></div></div>

<!-- Menu -->
<section class="section" id="menu" x-data="{ tab: 'sourdough' }">
    <div class="section-inner">
        <div class="section-header">
            <p class="section-label">Explore Our Collection</p>
            <h2 class="section-title">Freshly Baked, Made to Order</h2>
            <p class="section-subtitle">Everything is baked fresh for your order. Choose your favorites and we'll have them ready for pickup or delivery.</p>
        </div>

        <!-- Tabs -->
        <div class="menu-tabs">
            <button class="menu-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="menu-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <!-- Sourdough Loaves -->
        <div x-show="tab === 'sourdough'" x-transition>
            <div class="menu-grid">
                <div class="menu-card">
                    <div class="menu-card-image">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough Boule">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Regular Sourdough</span>
                            <span class="menu-card-price">$10</span>
                        </div>
                        <p class="menu-card-desc">Our classic loaf. Crispy crust, tangy crumb, perfect for everything.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🧀</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Cheddar Sourdough</span>
                            <span class="menu-card-price">$12</span>
                        </div>
                        <p class="menu-card-desc">Loaded with sharp cheddar that melts into golden pockets throughout.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🧄</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Mozzarella &amp; Garlic</span>
                            <span class="menu-card-price">$14</span>
                        </div>
                        <p class="menu-card-desc">Gooey mozzarella meets roasted garlic in every irresistible slice.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍫</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Chocolate Chip</span>
                            <span class="menu-card-price">$12</span>
                        </div>
                        <p class="menu-card-desc">Sweet meets tangy. Semi-sweet chocolate chips in every bite.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍬</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Cinnamon &amp; Sugar</span>
                            <span class="menu-card-price">$14</span>
                        </div>
                        <p class="menu-card-desc">Warm cinnamon swirled through with a sweet sugar crust on top.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍫🍫</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Double Chocolate Chip</span>
                            <span class="menu-card-price">$12</span>
                        </div>
                        <p class="menu-card-desc">Chocolate dough packed with chocolate chips. For the serious chocoholics.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍫🌰</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Chocolate Almond Chip</span>
                            <span class="menu-card-price">$15</span>
                        </div>
                        <p class="menu-card-desc">Rich chocolate dough with crunchy almonds and chocolate chips.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Breads -->
        <div x-show="tab === 'other'" x-transition>
            <div class="menu-grid">
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍯</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Honey Wheat Sandwich</span>
                            <span class="menu-card-price">$10</span>
                        </div>
                        <p class="menu-card-desc">Soft sourdough sandwich bread with a touch of honey. Perfect for everyday.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image">
                        <img src="/images/product-english-muffins.jpg" alt="English Muffins">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">English Muffins (6ct)</span>
                            <span class="menu-card-price">$8</span>
                        </div>
                        <p class="menu-card-desc">Nooks and crannies for days. You'll never go back to store-bought.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🧁</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">English Muffins (12ct)</span>
                            <span class="menu-card-price">$15</span>
                        </div>
                        <p class="menu-card-desc">The smart buy. Stock up, freeze some, thank yourself later.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍌</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Banana Bread</span>
                            <span class="menu-card-price">$12</span>
                        </div>
                        <p class="menu-card-desc">Moist, sweet, and loaded with ripe bananas. A classic done right.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🍌🌰</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Banana Walnut</span>
                            <span class="menu-card-price">$15</span>
                        </div>
                        <p class="menu-card-desc">Everything you love about our banana bread with toasty walnut crunch.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🎃</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Pumpkin Chocolate Chip</span>
                            <span class="menu-card-price">$12</span>
                        </div>
                        <p class="menu-card-desc">Spiced pumpkin bread studded with chocolate chips. Cozy in every slice.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card-image"><span class="menu-card-image-placeholder">🎃🌰</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-header">
                            <span class="menu-card-name">Pumpkin Almond Chip</span>
                            <span class="menu-card-price">$15</span>
                        </div>
                        <p class="menu-card-desc">Our pumpkin bread elevated with almonds and chocolate chips.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mini Loaf Deal -->
        <div class="menu-special">
            <div class="menu-special-text">
                <h4>🎉 Mix &amp; Match Mini Loaves</h4>
                <p>Pick any 4 mini loaves and save! Perfect for trying new flavors or sharing with friends.</p>
            </div>
            <div class="menu-special-price">$25</div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"><div class="divider-line"></div><span class="divider-icon">🌾</span><div class="divider-line"></div></div>

<!-- Customer Favorites -->
<section class="section section-alt" id="reviews">
    <div class="section-inner">
        <div class="section-header">
            <p class="section-label">What People Are Saying</p>
            <h2 class="section-title">Customer Favorites</h2>
        </div>
        <div class="favorites-grid">
            <div class="favorite-card">
                <div class="favorite-stars">★★★★★</div>
                <p class="favorite-text">The cheddar sourdough is absolutely incredible. My family fights over the last slice every single time.</p>
                <p class="favorite-author">Sarah M.</p>
            </div>
            <div class="favorite-card">
                <div class="favorite-stars">★★★★★</div>
                <p class="favorite-text">I ordered English muffins on a whim and now I can never go back to Thomas'. They're that good.</p>
                <p class="favorite-author">Mike T.</p>
            </div>
            <div class="favorite-card">
                <div class="favorite-stars">★★★★★</div>
                <p class="favorite-text">Cassie's banana bread is the best I've ever had, and I don't say that lightly. It's moist, flavorful, and disappears in minutes.</p>
                <p class="favorite-author">Jennifer R.</p>
            </div>
        </div>
    </div>
</section>

<!-- Instagram -->
<section class="section">
    <div class="section-inner">
        <div class="section-header">
            <p class="section-label">Follow Along</p>
            <h2 class="section-title">Fresh from the Oven</h2>
            <p class="section-subtitle">Peek behind the scenes at what's baking today</p>
        </div>
        <div class="instagram-grid">
            <div class="instagram-item">
                <img src="/images/product-sourdough-boule.jpg" alt="Fresh sourdough">
            </div>
            <div class="instagram-item">
                <img src="/images/product-english-muffins.jpg" alt="English muffins">
            </div>
            <div class="instagram-item">
                <span class="instagram-placeholder">🍞</span>
            </div>
            <div class="instagram-item">
                <span class="instagram-placeholder">🫙</span>
            </div>
        </div>
        <div class="instagram-handle">
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">@bakeryonbiscotto</a>
        </div>
    </div>
</section>

<!-- Ready to Order -->
<section class="section order-section" id="order">
    <div class="section-inner">
        <div class="section-header">
            <p class="section-label">Ready to Order?</p>
            <h2 class="section-title">Let's Get You Some Bread</h2>
            <p class="section-subtitle">Everything is baked fresh to order. Just tell us what you'd like and we'll take care of the rest.</p>
        </div>
        <div class="order-methods">
            <div class="order-method">
                <div class="order-method-icon">📱</div>
                <h4>Message Us</h4>
                <p>DM us on Facebook or Instagram with your order</p>
            </div>
            <div class="order-method">
                <div class="order-method-icon">🏠</div>
                <h4>Local Pickup</h4>
                <p>Grab your order fresh from our kitchen in Davenport, FL</p>
            </div>
            <div class="order-method">
                <div class="order-method-icon">🚗</div>
                <h4>Local Delivery</h4>
                <p>We deliver to the Davenport area. Ask us about delivery!</p>
            </div>
        </div>
        <a href="https://facebook.com/bakeryonbiscotto" target="_blank" class="order-btn">Place an Order</a>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <h3>Bakery on Biscotto</h3>
            <p>Handcrafted sourdough and artisan breads baked with love in Davenport, Florida. Made to order, always fresh.</p>
            <p class="flour-dust">With love and flour dust ♡</p>
        </div>
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#about">About Cassie</a></li>
                <li><a href="#menu">Our Menu</a></li>
                <li><a href="#reviews">Reviews</a></li>
                <li><a href="#order">Order Now</a></li>
            </ul>
        </div>
        <div>
            <h4>Find Us</h4>
            <ul>
                <li>Davenport, Florida</li>
                <li><a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a></li>
                <li style="margin-top: 12px;"><a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook</a></li>
                <li><a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>&copy; 2026 Bakery on Biscotto. All rights reserved.</span>
        <div class="footer-social">
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">f</a>
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">ig</a>
        </div>
    </div>
</footer>

</body>
</html>
