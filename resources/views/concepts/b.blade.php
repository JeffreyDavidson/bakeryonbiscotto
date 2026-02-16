<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Artisan - Bakery on Biscotto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --pure-white: #FFFFFF;
            --soft-white: #FEFCF8;
            --text-light: #8A8A8A;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--soft-white);
            color: var(--dark-brown);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Concept Navigation */
        .concept-nav {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 1000;
            display: flex;
            gap: 15px;
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 20px;
            border-radius: 50px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .concept-nav a {
            color: var(--dark-brown);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
            letter-spacing: 0.5px;
        }

        .concept-nav a.active {
            background: var(--dark-brown);
            color: var(--cream);
            transform: translateY(-2px);
        }

        .concept-nav a:hover {
            background: var(--golden-tan);
            color: var(--dark-brown);
            transform: translateY(-2px);
        }

        /* Sticky Navigation that morphs */
        .main-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            background: rgba(254, 252, 248, 0.8);
            backdrop-filter: blur(20px);
            padding: 20px 40px;
            transition: all 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
            transform: translateY(-100%);
        }

        .main-nav.visible {
            transform: translateY(0);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-brown);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }

        .nav-links a {
            color: var(--dark-brown);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--golden-tan);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section - Split Screen */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
        }

        .hero-left {
            padding: 0 80px;
            padding-left: max(80px, calc(50vw - 700px));
        }

        .hero-right {
            background: url('/images/product-sourdough-boule.jpg') center/cover;
            position: relative;
            min-height: 100vh;
        }

        .hero-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(61,35,20,0.2) 100%);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 300;
            line-height: 1.1;
            margin-bottom: 30px;
            color: var(--dark-brown);
        }

        .hero-title strong {
            font-weight: 700;
            display: block;
            color: var(--warm-brown);
        }

        .hero-subtitle {
            font-size: 1.4rem;
            font-weight: 200;
            color: var(--text-light);
            margin-bottom: 50px;
            letter-spacing: 0.5px;
            line-height: 1.8;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            background: var(--dark-brown);
            color: var(--cream);
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(61,35,20,0.2);
        }

        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 45px rgba(61,35,20,0.3);
        }

        /* Scroll snap sections */
        .section {
            scroll-snap-align: start;
            min-height: 100vh;
        }

        /* Biscotto Character Section */
        .biscotto-section {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--cream) 0%, var(--soft-white) 100%);
            position: relative;
        }

        .biscotto-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23D4A574' fill-opacity='0.03'%3E%3Ccircle cx='20' cy='20' r='1'/%3E%3C/g%3E%3C/svg%3E");
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            position: relative;
            z-index: 1;
        }

        .biscotto-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 100px;
            align-items: center;
        }

        .biscotto-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            margin-bottom: 40px;
            color: var(--dark-brown);
            line-height: 1.2;
        }

        .biscotto-story {
            font-size: 1.2rem;
            font-weight: 300;
            line-height: 2;
            color: var(--warm-brown);
            margin-bottom: 30px;
        }

        .biscotto-story:last-of-type {
            font-style: italic;
            color: var(--text-light);
        }

        .biscotto-visual {
            text-align: center;
            position: relative;
        }

        .starter-bubble {
            background: radial-gradient(circle, var(--golden-tan) 0%, var(--warm-brown) 100%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--cream);
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            animation: breathe 4s ease-in-out infinite;
        }

        .starter-bubble::before {
            content: '';
            position: absolute;
            inset: -10px;
            border: 2px dashed var(--dark-brown);
            border-radius: 50%;
            opacity: 0.3;
        }

        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Process Section */
        .process-section {
            padding: 120px 0;
            background: var(--dark-brown);
            color: var(--cream);
        }

        .process-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 300;
            margin-bottom: 80px;
            color: var(--cream);
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .process-step {
            text-align: center;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        .process-step.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .step-number {
            display: block;
            width: 80px;
            height: 80px;
            border: 2px solid var(--golden-tan);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--golden-tan);
            margin-bottom: 30px;
        }

        .step-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: var(--cream);
        }

        .step-description {
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.8;
            color: var(--text-light);
        }

        /* Menu Section with Tabs */
        .menu-section {
            padding: 120px 0;
            background: var(--soft-white);
        }

        .menu-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .menu-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-brown);
        }

        .menu-subtitle {
            font-size: 1.3rem;
            font-weight: 300;
            color: var(--text-light);
            letter-spacing: 0.5px;
        }

        .menu-tabs {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-bottom: 60px;
            border-bottom: 1px solid rgba(61,35,20,0.1);
        }

        .menu-tab {
            background: none;
            border: none;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-light);
            cursor: pointer;
            padding: 20px 0;
            position: relative;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .menu-tab.active {
            color: var(--dark-brown);
        }

        .menu-tab::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--golden-tan);
            transition: width 0.3s ease;
        }

        .menu-tab.active::after {
            width: 100%;
        }

        .menu-content {
            display: none;
            max-width: 900px;
            margin: 0 auto;
        }

        .menu-content.active {
            display: block;
        }

        .menu-grid {
            display: grid;
            gap: 40px;
        }

        .menu-item-card {
            background: var(--pure-white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid rgba(212,165,116,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .menu-item-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent 0%, rgba(212,165,116,0.1) 50%, transparent 100%);
            transition: left 0.6s ease;
        }

        .menu-item-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .menu-item-card:hover::before {
            left: 100%;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .item-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--dark-brown);
            line-height: 1.3;
        }

        .item-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--warm-brown);
            margin-left: 20px;
        }

        .item-description {
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.6;
            font-weight: 300;
        }

        .special-item {
            background: linear-gradient(135deg, var(--golden-tan) 0%, var(--warm-brown) 100%);
            color: var(--cream);
        }

        .special-item .item-name {
            color: var(--cream);
        }

        .special-item .item-price {
            color: var(--cream);
        }

        .special-item .item-description {
            color: rgba(245,230,208,0.9);
        }

        /* Product Gallery */
        .gallery-section {
            padding: 120px 0;
            background: var(--cream);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        .gallery-item:hover {
            transform: scale(1.03);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(61,35,20,0.8) 0%, transparent 70%);
            display: flex;
            align-items: flex-end;
            padding: 40px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-text h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--cream);
            margin-bottom: 10px;
        }

        .gallery-text p {
            color: rgba(245,230,208,0.9);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Contact/Footer */
        .contact-section {
            padding: 120px 0;
            background: var(--dark-brown);
            color: var(--cream);
            text-align: center;
        }

        .contact-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 600;
            margin-bottom: 40px;
            color: var(--cream);
        }

        .contact-info {
            font-size: 1.1rem;
            line-height: 2;
            margin-bottom: 50px;
            font-weight: 300;
        }

        .contact-info p {
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }

        .social-link {
            color: var(--golden-tan);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .social-link:hover {
            color: var(--cream);
            transform: translateY(-2px);
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .hero-left {
                padding: 60px 40px;
                order: 1;
            }
            
            .hero-right {
                order: 0;
                min-height: 60vh;
            }

            .biscotto-grid {
                grid-template-columns: 1fr;
                gap: 60px;
            }

            .menu-tabs {
                gap: 30px;
                flex-wrap: wrap;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .concept-nav {
                position: relative;
                top: 0;
                right: 0;
                margin: 20px;
                justify-content: center;
            }

            .container {
                padding: 0 20px;
            }

            .hero-left {
                padding-left: 40px;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .process-steps {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .menu-tabs {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }
        }

        /* Scroll behavior */
        .scroll-container {
            scroll-snap-type: y mandatory;
        }
    </style>
</head>
<body x-data="{ 
    activeTab: 'sourdough',
    scrollY: 0,
    showNav: false 
}" 
@scroll.window="
    scrollY = window.pageYOffset;
    showNav = scrollY > 200;
">
    
    <!-- Concept Navigation -->
    <div class="concept-nav">
        <a href="/">The Bakehouse</a>
        <a href="/concept-b" class="active">Modern Artisan</a>
        <a href="/concept-c">Sunday Morning</a>
    <a href="/concept-d">D — Kitchen Table</a>
    <a href="/concept-e">E — Flour &amp; Fire</a>
    <a href="/concept-f">F — Neighborhood</a>
    </div>

    <!-- Main Navigation -->
    <nav class="main-nav" :class="{ 'visible': showNav }">
        <div class="nav-content">
            <a href="#" class="nav-logo">Bakery on Biscotto</a>
            <ul class="nav-links">
                <li><a href="#process">Our Process</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-container">
        <!-- Hero Section -->
        <section class="hero section">
            <div class="hero-left">
                <h1 class="hero-title">
                    Artisan
                    <strong>Sourdough</strong>
                </h1>
                <p class="hero-subtitle">
                    Where tradition meets innovation. Each loaf is a testament to the ancient art of bread-making, 
                    refined through generations of craft and elevated by modern technique.
                </p>
                <a href="#menu" class="hero-cta">
                    Explore Our Collection
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="hero-right"></div>
        </section>

        <!-- Biscotto Section -->
        <section class="biscotto-section section">
            <div class="container">
                <div class="biscotto-grid">
                    <div class="biscotto-visual">
                        <div class="starter-bubble">Biscotto</div>
                        <p style="font-style: italic; color: var(--text-light); font-size: 0.95rem;">
                            Our living culture, born 2024
                        </p>
                    </div>
                    <div class="biscotto-content">
                        <h2>Meet Biscotto</h2>
                        <p class="biscotto-story">
                            Every great bakery has a story. Ours begins with Biscotto — our cherished sourdough starter that breathes life into every loaf we create.
                        </p>
                        <p class="biscotto-story">
                            Born from wild Florida yeasts and nurtured with daily devotion, Biscotto transforms simple flour and water into something extraordinary. Each bubble that rises carries with it the essence of our craft.
                        </p>
                        <p class="biscotto-story">
                            This is more than fermentation. This is alchemy.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="process-section section" id="process">
            <div class="container">
                <h2 class="process-title">Our Process</h2>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">01</div>
                        <h3 class="step-title">Feed</h3>
                        <p class="step-description">Every morning at 6 AM, Biscotto is fed with organic flour and filtered water. We watch for the perfect peak of activity.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">02</div>
                        <h3 class="step-title">Mix</h3>
                        <p class="step-description">Hand-selected ingredients are combined with precision. No shortcuts, no compromises — just time-honored technique.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">03</div>
                        <h3 class="step-title">Rise</h3>
                        <p class="step-description">Patience is our secret ingredient. 18-24 hours of slow fermentation develops complex flavors and perfect texture.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">04</div>
                        <h3 class="step-title">Bake</h3>
                        <p class="step-description">High heat, steam, and careful timing create the perfect crust and crumb. Each loaf is a small masterpiece.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Menu Section -->
        <section class="menu-section section" id="menu">
            <div class="container">
                <div class="menu-header">
                    <h2 class="menu-title">Our Collection</h2>
                    <p class="menu-subtitle">Handcrafted daily in small batches</p>
                </div>

                <div class="menu-tabs">
                    <button 
                        class="menu-tab" 
                        :class="{ 'active': activeTab === 'sourdough' }"
                        @click="activeTab = 'sourdough'"
                    >
                        Sourdough Loafs
                    </button>
                    <button 
                        class="menu-tab"
                        :class="{ 'active': activeTab === 'other' }"
                        @click="activeTab = 'other'"
                    >
                        Other Bread
                    </button>
                </div>

                <div class="menu-content" :class="{ 'active': activeTab === 'sourdough' }">
                    <div class="menu-grid">
                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Regular Loaf</h3>
                                <span class="item-price">$10</span>
                            </div>
                            <p class="item-description">Our signature sourdough — pure, simple, perfect. The foundation of great bread-making.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Cheddar</h3>
                                <span class="item-price">$12</span>
                            </div>
                            <p class="item-description">Sharp Vermont cheddar folded into our classic dough. Comfort food elevated.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Mozzarella and Garlic</h3>
                                <span class="item-price">$14</span>
                            </div>
                            <p class="item-description">Fresh mozzarella and roasted garlic create pockets of savory richness in every bite.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Chocolate Chip</h3>
                                <span class="item-price">$12</span>
                            </div>
                            <p class="item-description">Belgian dark chocolate chips scattered throughout tangy sourdough. Sweet meets sour in perfect harmony.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Cinnamon and Sugar</h3>
                                <span class="item-price">$14</span>
                            </div>
                            <p class="item-description">Ceylon cinnamon swirled with organic sugar. Morning indulgence at its finest.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Chocolate, Chocolate Chip</h3>
                                <span class="item-price">$12</span>
                            </div>
                            <p class="item-description">Double chocolate delight — cocoa in the dough, chips throughout. Rich, complex, irresistible.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Chocolate Almond, Chocolate Chip</h3>
                                <span class="item-price">$15</span>
                            </div>
                            <p class="item-description">Premium California almonds join our chocolate celebration. Texture and flavor in perfect balance.</p>
                        </div>

                        <div class="menu-item-card special-item">
                            <div class="item-header">
                                <h3 class="item-name">4 Pack Mini Loafs</h3>
                                <span class="item-price">$25</span>
                            </div>
                            <p class="item-description">Choose any four varieties in perfectly portioned mini loaves. Ideal for sampling or sharing.</p>
                        </div>
                    </div>
                </div>

                <div class="menu-content" :class="{ 'active': activeTab === 'other' }">
                    <div class="menu-grid">
                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Sourdough Honey Wheat Sandwich Bread</h3>
                                <span class="item-price">$10</span>
                            </div>
                            <p class="item-description">Whole wheat flour and wildflower honey create the perfect sandwich foundation.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Sourdough English Muffins</h3>
                                <span class="item-price">$8 / $15</span>
                            </div>
                            <p class="item-description">Hand-shaped and griddle-cooked. Available in 6-count ($8) or 12-count ($15) packages.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Banana Bread</h3>
                                <span class="item-price">$12</span>
                            </div>
                            <p class="item-description">Ripe bananas and warm spices in a tender, moist loaf. Comfort in every slice.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Banana Walnut Bread</h3>
                                <span class="item-price">$15</span>
                            </div>
                            <p class="item-description">Premium walnuts add rich texture to our classic banana bread.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Pumpkin Chocolate Chip Bread</h3>
                                <span class="item-price">$12</span>
                            </div>
                            <p class="item-description">Autumn spices and pumpkin puree studded with chocolate chips. Seasonal perfection.</p>
                        </div>

                        <div class="menu-item-card">
                            <div class="item-header">
                                <h3 class="item-name">Pumpkin Almond Chocolate Chip Bread</h3>
                                <span class="item-price">$15</span>
                            </div>
                            <p class="item-description">Our pumpkin bread enhanced with toasted almonds and premium chocolate chips.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery-section section" id="gallery">
            <div class="container">
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="/images/product-sourdough-boule.jpg" alt="Artisan Sourdough Boule">
                        <div class="gallery-overlay">
                            <div class="gallery-text">
                                <h3>Perfect Crust</h3>
                                <p>Every boule showcases the beautiful ear and deep caramelization that comes from proper technique.</p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="/images/product-english-muffins.jpg" alt="Fresh English Muffins">
                        <div class="gallery-overlay">
                            <div class="gallery-text">
                                <h3>Handcrafted Excellence</h3>
                                <p>Each English muffin is shaped by hand and cooked on our traditional griddle for authentic texture.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section section" id="contact">
            <div class="container">
                <div class="contact-content">
                    <h2 class="contact-title">From Our Kitchen to Yours</h2>
                    <div class="contact-info">
                        <p><strong>Cassie's Cottage Food Operation</strong></p>
                        <p>2339 Biscotto Cir, Davenport, FL 33897</p>
                        <p>bakeryonbiscotto@gmail.com</p>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook @bakeryonbiscotto</a>
                        <a href="#" class="social-link">Instagram @bakeryonbiscotto</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, observerOptions);

        // Observe process steps
        document.querySelectorAll('.process-step').forEach((el, index) => {
            el.style.transitionDelay = `${index * 0.2}s`;
            observer.observe(el);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>