<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto — Sunday Morning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden: #D4A574;
            --peach: #F8E8D8;
            --soft-pink: #FDF0E8;
            --warm-white: #FFFBF5;
            --coral: #E8956A;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--dark-brown);
            background: var(--warm-white);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
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
            font-weight: 700;
        }
        .concept-nav a:hover, .concept-nav a.active { opacity: 1; }

        /* Main Nav */
        .main-nav {
            position: sticky;
            top: 33px;
            z-index: 900;
            background: rgba(255,251,245,0.95);
            backdrop-filter: blur(15px);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .main-nav .logo { height: 48px; border-radius: 12px; }
        .nav-links { display: flex; gap: 28px; list-style: none; }
        .nav-links a {
            text-decoration: none;
            color: var(--dark-brown);
            font-size: 14px;
            font-weight: 700;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--coral); }
        .nav-cta {
            background: var(--dark-brown) !important;
            color: var(--cream) !important;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 13px !important;
        }
        .nav-cta:hover { background: var(--warm-brown) !important; }

        /* Hero */
        .hero {
            text-align: center;
            padding: 80px 24px 60px;
            background: linear-gradient(180deg, var(--peach) 0%, var(--warm-white) 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-badge {
            display: inline-block;
            background: var(--dark-brown);
            color: var(--cream);
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: clamp(2.8rem, 6vw, 5rem);
            max-width: 700px;
            margin: 0 auto 20px;
            font-weight: 700;
        }
        .hero h1 .highlight {
            color: var(--coral);
            position: relative;
        }
        .hero h1 .highlight::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            height: 8px;
            background: rgba(232, 149, 106, 0.25);
            border-radius: 4px;
        }
        .hero p {
            font-size: 1.15rem;
            color: var(--warm-brown);
            max-width: 500px;
            margin: 0 auto 36px;
        }
        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-round {
            display: inline-block;
            padding: 16px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-round.primary {
            background: var(--dark-brown);
            color: var(--cream);
        }
        .btn-round.primary:hover {
            background: var(--warm-brown);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(61,35,20,0.2);
        }
        .btn-round.secondary {
            background: white;
            color: var(--dark-brown);
            border: 2px solid var(--dark-brown);
        }
        .btn-round.secondary:hover {
            background: var(--cream);
        }
        .hero-image {
            max-width: 800px;
            margin: 50px auto 0;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(61,35,20,0.15);
        }
        .hero-image img {
            width: 100%;
            display: block;
        }

        /* Stats */
        .stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 60px 24px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 32px 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(61,35,20,0.06);
            min-width: 200px;
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-card .emoji { font-size: 2rem; margin-bottom: 8px; }
        .stat-card .number {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-brown);
        }
        .stat-card .label {
            color: var(--warm-brown);
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Section titles */
        .section-header {
            text-align: center;
            padding: 60px 24px 40px;
        }
        .section-header .tag {
            display: inline-block;
            background: var(--peach);
            color: var(--warm-brown);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .section-header h2 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            margin-bottom: 12px;
        }
        .section-header p {
            color: var(--warm-brown);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Favorites */
        .favorites {
            padding: 0 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .fav-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(61,35,20,0.06);
            transition: all 0.3s;
        }
        .fav-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(61,35,20,0.12);
        }
        .fav-card-img {
            height: 180px;
            background: linear-gradient(135deg, var(--peach), var(--cream));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }
        .fav-card-body {
            padding: 24px;
        }
        .fav-card-body .stars {
            color: #F5A623;
            font-size: 14px;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }
        .fav-card-body h3 {
            font-size: 1.2rem;
            margin-bottom: 6px;
        }
        .fav-card-body p {
            color: var(--warm-brown);
            font-size: 0.9rem;
        }
        .fav-card-body .price-tag {
            display: inline-block;
            margin-top: 12px;
            background: var(--peach);
            color: var(--dark-brown);
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* Market Schedule */
        .market-section {
            background: linear-gradient(135deg, var(--dark-brown), #5A3828);
            color: var(--cream);
            padding: 80px 24px;
            border-radius: 32px;
            max-width: 1100px;
            margin: 0 auto 80px;
        }
        .market-section h2 {
            text-align: center;
            font-size: 2.4rem;
            margin-bottom: 40px;
            color: var(--cream);
        }
        .market-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 900px;
            margin: 0 auto;
        }
        .market-card {
            background: rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 28px 24px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.08);
            transition: background 0.3s;
        }
        .market-card:hover { background: rgba(255,255,255,0.12); }
        .market-day {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--golden);
        }
        .market-name {
            font-size: 0.95rem;
            opacity: 0.8;
            margin-bottom: 12px;
        }
        .market-time {
            display: inline-block;
            background: var(--golden);
            color: var(--dark-brown);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* About */
        .about-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 80px;
            align-items: center;
        }
        .about-img {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 16px 60px rgba(61,35,20,0.1);
        }
        .about-img img { width: 100%; display: block; }
        .about-text h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        .about-text p {
            color: #5a3a22;
            margin-bottom: 14px;
            font-size: 1.05rem;
        }
        .about-text .signature {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.2rem;
            color: var(--warm-brown);
            margin-top: 20px;
        }

        /* Testimonials */
        .testimonials {
            background: var(--peach);
            padding: 80px 24px;
            border-radius: 32px;
            max-width: 1100px;
            margin: 0 auto 80px;
        }
        .testimonials h2 {
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 40px;
        }
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            max-width: 900px;
            margin: 0 auto;
        }
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 16px rgba(61,35,20,0.05);
        }
        .testimonial-card .stars {
            color: #F5A623;
            margin-bottom: 12px;
        }
        .testimonial-card p {
            font-size: 0.95rem;
            color: #5a3a22;
            margin-bottom: 12px;
            font-style: italic;
        }
        .testimonial-card cite {
            font-style: normal;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--warm-brown);
        }

        /* Newsletter */
        .newsletter {
            text-align: center;
            padding: 80px 24px;
            max-width: 600px;
            margin: 0 auto;
        }
        .newsletter h2 {
            font-size: 2rem;
            margin-bottom: 12px;
        }
        .newsletter p {
            color: var(--warm-brown);
            margin-bottom: 28px;
        }
        .newsletter-form {
            display: flex;
            gap: 0;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(61,35,20,0.08);
        }
        .newsletter-form input {
            flex: 1;
            padding: 16px 24px;
            border: 2px solid var(--cream);
            border-right: none;
            font-size: 1rem;
            font-family: 'Lato', sans-serif;
            background: white;
            border-radius: 50px 0 0 50px;
            outline: none;
        }
        .newsletter-form input:focus { border-color: var(--golden); }
        .newsletter-form button {
            padding: 16px 32px;
            background: var(--dark-brown);
            color: var(--cream);
            border: none;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            font-family: 'Lato', sans-serif;
            border-radius: 0 50px 50px 0;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .newsletter-form button:hover { background: var(--warm-brown); }

        /* Footer */
        footer {
            background: var(--dark-brown);
            color: var(--cream);
            text-align: center;
            padding: 40px 24px;
            border-radius: 24px 24px 0 0;
        }
        footer .logo { height: 40px; border-radius: 8px; margin-bottom: 16px; }
        footer p { opacity: 0.6; font-size: 0.85rem; }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 16px;
        }
        .footer-links a {
            color: var(--cream);
            text-decoration: none;
            opacity: 0.7;
            font-size: 0.9rem;
            transition: opacity 0.2s;
        }
        .footer-links a:hover { opacity: 1; }

        @media (max-width: 768px) {
            .main-nav { padding: 12px 20px; }
            .nav-links { display: none; }
            .stats { gap: 16px; }
            .stat-card { min-width: 140px; padding: 20px; }
            .stat-card .number { font-size: 1.6rem; }
            .favorites-grid { grid-template-columns: 1fr; }
            .market-grid { grid-template-columns: 1fr; }
            .about-section { grid-template-columns: 1fr; }
            .testimonial-grid { grid-template-columns: 1fr; }
            .newsletter-form { flex-direction: column; border-radius: 16px; }
            .newsletter-form input { border-radius: 16px; border-right: 2px solid var(--cream); }
            .newsletter-form button { border-radius: 16px; }
            .market-section, .testimonials { border-radius: 20px; margin-left: 12px; margin-right: 12px; }
        }
    </style>
</head>
<body>

<!-- Concept Switcher -->
<nav class="concept-nav">
    <a href="/">A — The Bakehouse</a>
    <a href="/concept-b">B — Modern Artisan</a>
    <a href="/concept-c" class="active">C — Sunday Morning</a>
</nav>

<!-- Main Nav -->
<nav class="main-nav">
    <img src="/images/logo.jpg" alt="Bakery on Biscotto" class="logo">
    <ul class="nav-links">
        <li><a href="#favorites">Breads</a></li>
        <li><a href="#markets">Markets</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#" class="nav-cta">Pre-Order</a></li>
    </ul>
</nav>

<!-- Hero -->
<section class="hero">
    <span class="hero-badge">🌾 Fresh Every Weekend</span>
    <h1>Life's too short for <span class="highlight">boring bread</span></h1>
    <p>Handmade sourdough baked with love, patience, and a starter named Biscotto. Find us at your local farmers market!</p>
    <div class="hero-buttons">
        <a href="#favorites" class="btn-round primary">See Our Breads 🍞</a>
        <a href="#markets" class="btn-round secondary">Find Us This Week</a>
    </div>
    <div class="hero-image">
        <img src="/images/hero-banner.jpg" alt="Bakery on Biscotto breads">
    </div>
</section>

<!-- Fun Stats -->
<section class="stats" x-data="{ show: false }" x-intersect="show = true">
    <div class="stat-card">
        <div class="emoji">🍞</div>
        <div class="number">1,200+</div>
        <div class="label">Loaves Baked</div>
    </div>
    <div class="stat-card">
        <div class="emoji">⏰</div>
        <div class="number">5 AM</div>
        <div class="label">Wake-Up Calls</div>
    </div>
    <div class="stat-card">
        <div class="emoji">🌿</div>
        <div class="number">4</div>
        <div class="label">Simple Ingredients</div>
    </div>
    <div class="stat-card">
        <div class="emoji">💛</div>
        <div class="number">24 hrs</div>
        <div class="label">Slow Fermented</div>
    </div>
</section>

<!-- Customer Favorites -->
<div class="section-header" id="favorites">
    <span class="tag">Customer Favorites</span>
    <h2>The Breads Everyone Loves</h2>
    <p>Every loaf is made by hand with our 24-hour fermentation process.</p>
</div>

<section class="favorites">
    <div class="favorites-grid">
        <div class="fav-card">
            <div class="fav-card-img">🍞</div>
            <div class="fav-card-body">
                <div class="stars">★★★★★</div>
                <h3>Rustic Sourdough</h3>
                <p>Our #1 seller. Crispy crust, tangy crumb, perfect for everything.</p>
                <span class="price-tag">$8</span>
            </div>
        </div>
        <div class="fav-card">
            <div class="fav-card-img">🫒</div>
            <div class="fav-card-body">
                <div class="stars">★★★★★</div>
                <h3>Olive Rosemary Loaf</h3>
                <p>Briny olives and fragrant rosemary. Dip it in good olive oil.</p>
                <span class="price-tag">$10</span>
            </div>
        </div>
        <div class="fav-card">
            <div class="fav-card-img">🍇</div>
            <div class="fav-card-body">
                <div class="stars">★★★★★</div>
                <h3>Cinnamon Raisin</h3>
                <p>Sweet, warm, and perfect toasted with butter on a lazy morning.</p>
                <span class="price-tag">$9</span>
            </div>
        </div>
        <div class="fav-card">
            <div class="fav-card-img">🌾</div>
            <div class="fav-card-body">
                <div class="stars">★★★★☆</div>
                <h3>Honey Wheat</h3>
                <p>Soft whole wheat sweetened with local honey. A sandwich dream.</p>
                <span class="price-tag">$8</span>
            </div>
        </div>
        <div class="fav-card">
            <div class="fav-card-img">🥖</div>
            <div class="fav-card-body">
                <div class="stars">★★★★★</div>
                <h3>Classic Baguette</h3>
                <p>Golden, crisp, and airy. Our sourdough spin on a French classic.</p>
                <span class="price-tag">$6</span>
            </div>
        </div>
        <div class="fav-card">
            <div class="fav-card-img">🌻</div>
            <div class="fav-card-body">
                <div class="stars">★★★★★</div>
                <h3>Seeded Multigrain</h3>
                <p>Loaded with seeds — sunflower, flax, sesame, pumpkin. So hearty.</p>
                <span class="price-tag">$10</span>
            </div>
        </div>
    </div>
</section>

<!-- Market Schedule -->
<section class="market-section" id="markets">
    <h2>📍 Find Us This Week</h2>
    <div class="market-grid">
        <div class="market-card">
            <div class="market-day">Saturday</div>
            <div class="market-name">Morning Market</div>
            <span class="market-time">8 AM – 1 PM</span>
        </div>
        <div class="market-card">
            <div class="market-day">Wednesday</div>
            <div class="market-name">Evening Market</div>
            <span class="market-time">4 PM – 7 PM</span>
        </div>
        <div class="market-card">
            <div class="market-day">1st Sunday</div>
            <div class="market-name">Pop-Up Event</div>
            <span class="market-time">9 AM – 12 PM</span>
        </div>
    </div>
</section>

<!-- About -->
<section class="about-section" id="about">
    <div class="about-img">
        <img src="/images/branding-final.png" alt="Bakery on Biscotto branding">
    </div>
    <div class="about-text">
        <h2>A Little About Us 🤍</h2>
        <p>Bakery on Biscotto started in our home kitchen with a dream and a sourdough starter we lovingly named Biscotto. What began as a weekend baking hobby quickly turned into a passion — and now we get to share our bread with the whole community.</p>
        <p>Every loaf is handcrafted with just four ingredients: flour, water, salt, and our trusty starter. No shortcuts, no preservatives, just bread the way it should be made.</p>
        <p class="signature">— Cassie, Head Baker & Chief Bread Enthusiast</p>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <h2>Kind Words 💬</h2>
    <div class="testimonial-grid">
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"Best sourdough I've ever had. The crust is incredible and the flavor is out of this world. I'm obsessed!"</p>
            <cite>— Sarah M.</cite>
        </div>
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"My kids won't eat any other bread now. The cinnamon raisin disappears before lunch!"</p>
            <cite>— Jake & Family</cite>
        </div>
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"I drive 30 minutes to the market just for their olive rosemary loaf. Worth every mile."</p>
            <cite>— Linda R.</cite>
        </div>
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"You can taste the love in every bite. This is what real bread should be. Thank you, Cassie!"</p>
            <cite>— Mark T.</cite>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter">
    <h2>Get the Fresh Loaf 📬</h2>
    <p>Weekly updates on what's baking, market schedules, and first dibs on new flavors.</p>
    <form class="newsletter-form" onsubmit="event.preventDefault()">
        <input type="email" placeholder="your@email.com">
        <button type="submit">Subscribe</button>
    </form>
</section>

<!-- Footer -->
<footer>
    <img src="/images/logo.jpg" alt="Bakery on Biscotto" class="logo">
    <div class="footer-links">
        <a href="#">Instagram</a>
        <a href="#">Facebook</a>
        <a href="#">Email Us</a>
    </div>
    <p>&copy; 2026 Bakery on Biscotto. Made with flour, water, salt & a whole lot of love. 🍞</p>
</footer>

</body>
</html>
