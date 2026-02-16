<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Bakehouse - Bakery on Biscotto</title>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400&family=Amatic+SC:wght@400;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
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
        }

        body {
            font-family: 'Crimson Text', serif;
            background: linear-gradient(135deg, var(--cream) 0%, #f8f0e3 100%);
            overflow-x: hidden;
        }

        /* Concept Switcher */
        .concept-nav {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
            background: rgba(61, 35, 20, 0.9);
            padding: 12px;
            border-radius: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .concept-nav a {
            color: var(--cream);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            font-family: 'Amatic SC', cursive;
            font-weight: 700;
        }

        .concept-nav a.active {
            background: var(--golden-tan);
            color: var(--dark-brown);
        }

        .concept-nav a:hover {
            background: var(--warm-brown);
            transform: translateY(-2px);
        }

        /* Hand-drawn wheat SVG animation */
        .wheat-divider {
            margin: 40px auto;
            text-align: center;
            overflow: hidden;
        }

        .wheat-svg {
            animation: drawWheat 2s ease-in-out;
        }

        @keyframes drawWheat {
            0% { stroke-dasharray: 1000; stroke-dashoffset: 1000; }
            100% { stroke-dasharray: 1000; stroke-dashoffset: 0; }
        }

        /* Paper texture background */
        .kraft-section {
            background: linear-gradient(45deg, #d4a574 0%, #c49660 100%);
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(255,255,255,0.3) 1px, transparent 0),
                repeating-linear-gradient(0deg, rgba(0,0,0,0.05), rgba(0,0,0,0.05) 2px, transparent 2px, transparent 4px);
            position: relative;
        }

        .kraft-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f5e6d0' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            mix-blend-mode: overlay;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: url('/images/hero-banner.jpg') center/cover;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(61,35,20,0.8) 0%, rgba(139,94,60,0.6) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 6rem);
            color: var(--cream);
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform: translateY(50px);
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.5s forwards;
        }

        .hero-tagline {
            font-family: 'Amatic SC', cursive;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            color: var(--golden-tan);
            margin-bottom: 30px;
            font-weight: 400;
            transform: translateY(50px);
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.8s forwards;
        }

        .biscotto-intro {
            background: rgba(245,230,208,0.95);
            padding: 30px;
            border-radius: 15px;
            margin: 30px 0;
            border: 3px dashed var(--warm-brown);
            transform: translateY(50px);
            opacity: 0;
            animation: fadeInUp 1s ease-out 1.1s forwards;
        }

        .biscotto-intro h3 {
            font-family: 'Amatic SC', cursive;
            font-size: 2rem;
            color: var(--dark-brown);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .biscotto-intro p {
            color: var(--warm-brown);
            font-size: 1.2rem;
            line-height: 1.6;
            font-style: italic;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Letter from Baker Section */
        .baker-letter {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .letter-paper {
            background: var(--cream);
            padding: 60px;
            margin: 40px auto;
            max-width: 800px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            transform: rotate(-1deg);
            transition: transform 0.3s ease;
        }

        .letter-paper:hover {
            transform: rotate(0deg) scale(1.02);
        }

        .letter-paper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 80px;
            right: 0;
            height: 100%;
            background: repeating-linear-gradient(
                transparent,
                transparent 29px,
                #e8d5bf 29px,
                #e8d5bf 31px
            );
            pointer-events: none;
        }

        .letter-paper::after {
            content: '';
            position: absolute;
            left: 60px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #d4a574;
        }

        .letter-header {
            font-family: 'Amatic SC', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .letter-content {
            font-size: 1.1rem;
            line-height: 2;
            color: var(--dark-brown);
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .signature {
            text-align: right;
            margin-top: 30px;
            font-family: 'Amatic SC', cursive;
            font-size: 1.8rem;
            color: var(--warm-brown);
        }

        /* Menu Section */
        .menu-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, var(--dark-brown) 0%, var(--warm-brown) 100%);
            color: var(--cream);
        }

        .menu-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            margin-bottom: 20px;
            color: var(--cream);
        }

        .menu-subtitle {
            text-align: center;
            font-family: 'Amatic SC', cursive;
            font-size: 1.8rem;
            margin-bottom: 60px;
            color: var(--golden-tan);
        }

        .menu-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-category {
            background: rgba(245,230,208,0.1);
            border: 2px solid var(--golden-tan);
            border-radius: 15px;
            padding: 40px 30px;
            backdrop-filter: blur(10px);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .menu-category.in-view {
            transform: translateY(0);
            opacity: 1;
        }

        .category-title {
            font-family: 'Amatic SC', cursive;
            font-size: 2.2rem;
            color: var(--golden-tan);
            margin-bottom: 25px;
            font-weight: 700;
            text-align: center;
            text-decoration: underline;
            text-decoration-color: var(--golden-tan);
            text-underline-offset: 8px;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px 0;
            border-bottom: 1px dotted var(--golden-tan);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: rgba(212,165,116,0.1);
            padding-left: 10px;
            margin-left: -10px;
            border-radius: 8px;
        }

        .item-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--cream);
            flex-grow: 1;
        }

        .item-price {
            font-family: 'Amatic SC', cursive;
            font-size: 1.5rem;
            color: var(--golden-tan);
            font-weight: 700;
            margin-left: 20px;
        }

        /* Product Photos */
        .product-showcase {
            padding: 80px 20px;
            text-align: center;
        }

        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .product-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .product-card.in-view {
            transform: scale(1);
            opacity: 1;
        }

        .product-card:hover {
            transform: scale(1.05) rotate(2deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .product-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent 70%, rgba(212,165,116,0.3));
            pointer-events: none;
        }

        .product-label {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: rgba(61,35,20,0.9);
            color: var(--cream);
            padding: 15px;
            border-radius: 10px;
            font-family: 'Amatic SC', cursive;
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Contact Section */
        .contact-section {
            padding: 80px 20px;
            text-align: center;
            background: var(--cream);
            color: var(--dark-brown);
        }

        .contact-card {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 3px solid var(--golden-tan);
        }

        .contact-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: var(--dark-brown);
        }

        .contact-info p {
            margin: 15px 0;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .concept-nav {
                position: relative;
                top: 0;
                right: 0;
                margin: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .letter-paper {
                padding: 30px 20px;
                transform: none;
            }

            .menu-categories {
                grid-template-columns: 1fr;
            }

            .menu-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .item-price {
                margin-left: 0;
            }
        }

        /* Intersection Observer Animation */
        .fade-in-up {
            transform: translateY(50px);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .fade-in-up.in-view {
            transform: translateY(0);
            opacity: 1;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--warm-brown);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-brown);
        }
    </style>
</head>
<body x-data="{ scrollY: 0 }" @scroll.window="scrollY = window.pageYOffset">
    
    <!-- Concept Navigation -->
    <div class="concept-nav">
        <a href="/" class="active">The Bakehouse</a>
        <a href="/concept-b">Modern Artisan</a>
        <a href="/concept-c">Sunday Morning</a>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to The Bakehouse</h1>
            <p class="hero-tagline">Where Sourdough Dreams Come True</p>
            
            <div class="biscotto-intro">
                <h3>Meet Biscotto, Our Beloved Starter</h3>
                <p>Born from a love of tradition and nurtured with Florida sunshine, Biscotto has been our faithful companion since day one. Every loaf tells the story of patience, craft, and the magic that happens when flour meets time.</p>
            </div>
        </div>
    </section>

    <!-- Hand-drawn Wheat Divider -->
    <div class="wheat-divider">
        <svg class="wheat-svg" width="200" height="60" viewBox="0 0 200 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 30 C 50 10, 150 10, 180 30" stroke="#8B5E3C" stroke-width="2" fill="none" stroke-linecap="round"/>
            <path d="M40 20 L 45 15 L 45 25 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M60 15 L 65 10 L 65 20 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M80 12 L 85 7 L 85 17 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M100 10 L 105 5 L 105 15 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M120 12 L 125 7 L 125 17 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M140 15 L 145 10 L 145 20 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
            <path d="M160 20 L 165 15 L 165 25 Z" stroke="#8B5E3C" stroke-width="1.5" fill="#D4A574"/>
        </svg>
    </div>

    <!-- Letter from the Baker -->
    <section class="baker-letter kraft-section">
        <div class="letter-paper fade-in-up">
            <h2 class="letter-header">A Letter from Cassie's Kitchen</h2>
            <div class="letter-content">
                <p>Dear Friends,</p>
                <p>What started as a simple desire to feed my family wholesome bread has blossomed into something magical. In our little cottage kitchen on Biscotto Circle, we craft each loaf with the same care and attention I'd give to bread for my own table.</p>
                <p>Biscotto, our sourdough starter, is more than just flour and water — it's a living piece of our story. Fed daily with love and patience, it transforms simple ingredients into something extraordinary. When you taste our bread, you're tasting tradition, craft, and a little piece of our hearts.</p>
                <p>From our kitchen to yours, welcome to the Bakery on Biscotto family.</p>
                <div class="signature">With warm regards, Cassie ♥</div>
            </div>
        </div>
    </section>

    <!-- Product Showcase -->
    <section class="product-showcase">
        <div class="showcase-grid">
            <div class="product-card fade-in-up">
                <img src="/images/product-sourdough-boule.jpg" alt="Artisan Sourdough Boule">
                <div class="product-label">Our Signature Sourdough Boule</div>
            </div>
            <div class="product-card fade-in-up">
                <img src="/images/product-english-muffins.jpg" alt="Fresh English Muffins">
                <div class="product-label">Handcrafted English Muffins</div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu-section">
        <h2 class="menu-title">Our Daily Offerings</h2>
        <p class="menu-subtitle">Handcrafted with Love, Baked Fresh Daily</p>
        
        <div class="menu-categories">
            <div class="menu-category fade-in-up">
                <h3 class="category-title">Sourdough Loafs</h3>
                <div class="menu-item">
                    <span class="item-name">Regular Loaf</span>
                    <span class="item-price">$10</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Cheddar</span>
                    <span class="item-price">$12</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Mozzarella and Garlic</span>
                    <span class="item-price">$14</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Chocolate Chip</span>
                    <span class="item-price">$12</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Cinnamon and Sugar</span>
                    <span class="item-price">$14</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Chocolate, Chocolate Chip</span>
                    <span class="item-price">$12</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Chocolate Almond, Chocolate Chip</span>
                    <span class="item-price">$15</span>
                </div>
                <div class="menu-item" style="border-top: 2px solid #D4A574; border-bottom: 2px solid #D4A574; margin-top: 20px; padding: 20px 0;">
                    <span class="item-name"><strong>4 Pack of Mini Loafs</strong><br><small>choose any 4</small></span>
                    <span class="item-price">$25</span>
                </div>
            </div>

            <div class="menu-category fade-in-up">
                <h3 class="category-title">Other Bread</h3>
                <div class="menu-item">
                    <span class="item-name">Sourdough Honey Wheat Sandwich Bread</span>
                    <span class="item-price">$10</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Sourdough English Muffins (6ct)</span>
                    <span class="item-price">$8</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Sourdough English Muffins (12ct)</span>
                    <span class="item-price">$15</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Banana Bread</span>
                    <span class="item-price">$12</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Banana Walnut Bread</span>
                    <span class="item-price">$15</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Pumpkin Chocolate Chip Bread</span>
                    <span class="item-price">$12</span>
                </div>
                <div class="menu-item">
                    <span class="item-name">Pumpkin Almond Chocolate Chip Bread</span>
                    <span class="item-price">$15</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-card fade-in-up">
            <h2 class="contact-title">Visit Our Kitchen</h2>
            <div class="contact-info">
                <p><strong>Cassie's Cottage Food Operation</strong></p>
                <p>📍 2339 Biscotto Cir, Davenport, FL 33897</p>
                <p>📧 bakeryonbiscotto@gmail.com</p>
                <p>📱 Follow us @bakeryonbiscotto</p>
                <p style="margin-top: 30px; font-style: italic;">
                    "From our kitchen to yours — because every meal deserves homemade bread."
                </p>
            </div>
        </div>
    </section>

    <script>
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in-up, .menu-category, .product-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>