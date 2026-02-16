<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto — Modern Artisan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden: #D4A574;
            --white: #FFFFFF;
            --light-gray: #FAFAF8;
            --border: rgba(61, 35, 20, 0.08);
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark-brown);
            background: var(--white);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            line-height: 1.15;
            font-weight: 400;
        }

        /* Concept Nav */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: var(--dark-brown);
            padding: 8px 0;
            text-align: center;
        }
        .concept-nav a {
            color: var(--cream);
            text-decoration: none;
            margin: 0 16px;
            opacity: 0.7;
            transition: opacity 0.2s;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
        }
        .concept-nav a:hover, .concept-nav a.active { opacity: 1; }

        /* Main Nav */
        .main-nav {
            position: sticky;
            top: 33px;
            z-index: 900;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }
        .main-nav .logo { height: 44px; }
        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--dark-brown);
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--warm-brown); }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 90px);
            align-items: center;
        }
        .hero-text {
            padding: 80px 80px 80px 60px;
        }
        .hero-eyebrow {
            font-size: 12px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--warm-brown);
            font-weight: 600;
            margin-bottom: 24px;
        }
        .hero-text h1 {
            font-size: clamp(3rem, 5vw, 4.5rem);
            margin-bottom: 24px;
            font-weight: 400;
        }
        .hero-text h1 em {
            font-style: italic;
            color: var(--warm-brown);
        }
        .hero-text p {
            font-size: 1.1rem;
            color: #6B4D3A;
            max-width: 460px;
            margin-bottom: 40px;
            font-weight: 300;
        }
        .btn-primary {
            display: inline-block;
            padding: 16px 48px;
            background: var(--dark-brown);
            color: var(--cream);
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: var(--warm-brown);
            transform: translateY(-1px);
        }
        .btn-outline {
            display: inline-block;
            padding: 16px 48px;
            border: 1px solid var(--dark-brown);
            color: var(--dark-brown);
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 600;
            margin-left: 16px;
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: var(--dark-brown);
            color: var(--cream);
        }
        .hero-image {
            height: 100%;
            background: url('/images/hero-banner.jpg') center/cover no-repeat;
        }

        /* Thin divider line */
        .line-divider {
            max-width: 1200px;
            margin: 0 auto;
            height: 1px;
            background: var(--border);
        }

        /* Products */
        .products {
            padding: 100px 60px;
            max-width: 1300px;
            margin: 0 auto;
        }
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 60px;
        }
        .products-header h2 {
            font-size: 2.8rem;
        }
        .products-header a {
            color: var(--warm-brown);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            border-bottom: 1px solid var(--warm-brown);
            padding-bottom: 2px;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }
        .product-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .product-img {
            aspect-ratio: 3/4;
            background: linear-gradient(135deg, #F5E6D0, #EBD5BC);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            transition: transform 0.5s;
        }
        .product-card:hover .product-img {
            transform: scale(1.03);
        }
        .product-info {
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        .product-info h3 {
            font-size: 1.15rem;
            font-weight: 500;
        }
        .product-info .price {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--warm-brown);
        }
        .product-desc {
            color: #8B7B6B;
            font-size: 0.9rem;
            font-weight: 300;
        }

        /* Process */
        .process-section {
            background: var(--light-gray);
            padding: 100px 60px;
        }
        .process-inner {
            max-width: 1200px;
            margin: 0 auto;
        }
        .process-inner h2 {
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 16px;
        }
        .process-subtitle {
            text-align: center;
            color: #8B7B6B;
            font-size: 1rem;
            font-weight: 300;
            max-width: 500px;
            margin: 0 auto 60px;
        }
        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }
        .process-step {
            text-align: center;
            position: relative;
        }
        .process-step::after {
            content: '';
            position: absolute;
            top: 36px;
            right: -20px;
            width: 40px;
            height: 1px;
            background: var(--golden);
        }
        .process-step:last-child::after { display: none; }
        .step-number {
            width: 72px;
            height: 72px;
            border: 1px solid var(--golden);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--warm-brown);
        }
        .process-step h3 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .process-step p {
            font-size: 0.9rem;
            color: #8B7B6B;
            font-weight: 300;
            line-height: 1.6;
        }

        /* Banner Quote */
        .quote-banner {
            background: var(--dark-brown);
            color: var(--cream);
            text-align: center;
            padding: 80px 40px;
        }
        .quote-banner blockquote {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-style: italic;
            font-weight: 400;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.5;
        }

        /* Contact */
        .contact-section {
            padding: 100px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1px 1fr 1px 1fr;
            gap: 40px;
        }
        .contact-divider {
            background: var(--border);
        }
        .contact-col {
            text-align: center;
            padding: 20px;
        }
        .contact-col h3 {
            font-size: 1.4rem;
            margin-bottom: 16px;
        }
        .contact-col p {
            color: #8B7B6B;
            font-size: 0.95rem;
            font-weight: 300;
            line-height: 1.8;
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--border);
            padding: 40px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        footer p {
            font-size: 0.85rem;
            color: #8B7B6B;
            font-weight: 300;
        }
        .social-links {
            display: flex;
            gap: 24px;
        }
        .social-links a {
            color: var(--dark-brown);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 500;
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        .social-links a:hover { opacity: 1; }

        @media (max-width: 768px) {
            .main-nav { padding: 16px 24px; }
            .nav-links { display: none; }
            .hero { grid-template-columns: 1fr; }
            .hero-text { padding: 60px 24px; }
            .hero-image { height: 50vh; }
            .products { padding: 60px 24px; }
            .products-grid { grid-template-columns: 1fr; }
            .process-section { padding: 60px 24px; }
            .process-grid { grid-template-columns: 1fr 1fr; }
            .process-step::after { display: none; }
            .contact-section { padding: 60px 24px; }
            .contact-grid { grid-template-columns: 1fr; }
            .contact-divider { display: none; }
            footer { flex-direction: column; gap: 16px; padding: 30px 24px; }
            .btn-outline { margin-left: 0; margin-top: 12px; }
        }
    </style>
</head>
<body>

<!-- Concept Switcher -->
<nav class="concept-nav">
    <a href="/">A — The Bakehouse</a>
    <a href="/concept-b" class="active">B — Modern Artisan</a>
    <a href="/concept-c">C — Sunday Morning</a>
</nav>

<!-- Main Nav -->
<nav class="main-nav">
    <img src="/images/logo-alt.jpg" alt="Bakery on Biscotto" class="logo">
    <ul class="nav-links">
        <li><a href="#products">Breads</a></li>
        <li><a href="#process">Process</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-text">
        <p class="hero-eyebrow">Artisan Sourdough</p>
        <h1>Bread made <em>slowly,</em> the way it should be</h1>
        <p>Handcrafted sourdough from a small family bakery. Long fermentation, simple ingredients, extraordinary flavor.</p>
        <a href="#products" class="btn-primary">Our Breads</a>
        <a href="#contact" class="btn-outline">Find Us</a>
    </div>
    <div class="hero-image"></div>
</section>

<div class="line-divider"></div>

<!-- Products -->
<section class="products" id="products">
    <div class="products-header">
        <h2>Our Collection</h2>
        <a href="#contact">Pre-order →</a>
    </div>
    <div class="products-grid">
        <div class="product-card">
            <div class="product-img">🍞</div>
            <div class="product-info">
                <h3>Rustic Sourdough</h3>
                <span class="price">$8</span>
            </div>
            <p class="product-desc">Our signature. 24-hour ferment, crispy crust, open crumb.</p>
        </div>
        <div class="product-card">
            <div class="product-img">🫒</div>
            <div class="product-info">
                <h3>Olive Rosemary</h3>
                <span class="price">$10</span>
            </div>
            <p class="product-desc">Kalamata olives and fresh rosemary in every bite.</p>
        </div>
        <div class="product-card">
            <div class="product-img">🍇</div>
            <div class="product-info">
                <h3>Cinnamon Raisin</h3>
                <span class="price">$9</span>
            </div>
            <p class="product-desc">Sweet swirls and plump raisins. Toast-worthy.</p>
        </div>
        <div class="product-card">
            <div class="product-img">🌾</div>
            <div class="product-info">
                <h3>Honey Wheat</h3>
                <span class="price">$8</span>
            </div>
            <p class="product-desc">Soft whole wheat with local honey. Perfect for sandwiches.</p>
        </div>
        <div class="product-card">
            <div class="product-img">🥖</div>
            <div class="product-info">
                <h3>Classic Baguette</h3>
                <span class="price">$6</span>
            </div>
            <p class="product-desc">Crisp, airy, and golden. A sourdough twist on the French icon.</p>
        </div>
        <div class="product-card">
            <div class="product-img">🌻</div>
            <div class="product-info">
                <h3>Seeded Multigrain</h3>
                <span class="price">$10</span>
            </div>
            <p class="product-desc">Sunflower, flax, sesame, pumpkin. Dense and nutty.</p>
        </div>
    </div>
</section>

<!-- Process -->
<section class="process-section" id="process">
    <div class="process-inner">
        <h2>The Process</h2>
        <p class="process-subtitle">Great sourdough can't be rushed. Here's how we make every loaf.</p>
        <div class="process-grid">
            <div class="process-step">
                <div class="step-number">01</div>
                <h3>Feed the Starter</h3>
                <p>Our starter "Biscotto" is fed daily with organic flour, keeping it alive and active for over two years now.</p>
            </div>
            <div class="process-step">
                <div class="step-number">02</div>
                <h3>Mix & Fold</h3>
                <p>Flour, water, salt, and starter. Gentle folding develops the gluten structure for that perfect open crumb.</p>
            </div>
            <div class="process-step">
                <div class="step-number">03</div>
                <h3>Slow Ferment</h3>
                <p>24 hours of cold fermentation. This is where the magic happens — deep flavor and natural preservation.</p>
            </div>
            <div class="process-step">
                <div class="step-number">04</div>
                <h3>Bake & Share</h3>
                <p>Baked in a blazing hot oven with steam for maximum rise and crust. Then straight to your hands.</p>
            </div>
        </div>
    </div>
</section>

<!-- Quote -->
<section class="quote-banner">
    <blockquote>"Simple ingredients, extraordinary patience, unforgettable bread."</blockquote>
</section>

<!-- Contact -->
<section class="contact-section" id="contact">
    <div class="contact-grid">
        <div class="contact-col">
            <h3>Markets</h3>
            <p>Saturday Market: 8 AM – 1 PM<br>Wednesday Market: 4 PM – 7 PM<br>Sunday Pop-Up: 9 AM – 12 PM</p>
        </div>
        <div class="contact-divider"></div>
        <div class="contact-col">
            <h3>Pre-Orders</h3>
            <p>Reserve your favorites by Thursday evening for Saturday pickup. DM us or send an email to guarantee your loaf.</p>
        </div>
        <div class="contact-divider"></div>
        <div class="contact-col">
            <h3>Say Hello</h3>
            <p>hello@bakeryonbiscotto.com<br>@bakeryonbiscotto<br>We'd love to hear from you.</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2026 Bakery on Biscotto. Flour, water, salt, love.</p>
    <div class="social-links">
        <a href="#">Instagram</a>
        <a href="#">Facebook</a>
        <a href="#">Email</a>
    </div>
</footer>

</body>
</html>
