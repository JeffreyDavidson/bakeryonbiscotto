<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto — The Bakehouse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden: #D4A574;
            --light-cream: #FDF8F0;
            --parchment: #F0DCC0;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--dark-brown);
            background: var(--light-cream);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5 {
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
            font-size: 13px;
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
        .concept-nav a:hover, .concept-nav a.active {
            opacity: 1;
        }

        /* Main Nav */
        .main-nav {
            background: rgba(253, 248, 240, 0.95);
            backdrop-filter: blur(10px);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 33px;
            z-index: 900;
            border-bottom: 1px solid rgba(139, 94, 60, 0.1);
        }
        .main-nav .logo {
            height: 50px;
        }
        .main-nav .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }
        .main-nav .nav-links a {
            text-decoration: none;
            color: var(--dark-brown);
            font-size: 14px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 400;
            transition: color 0.2s;
        }
        .main-nav .nav-links a:hover {
            color: var(--warm-brown);
        }

        /* Hero */
        .hero {
            position: relative;
            height: 90vh;
            min-height: 600px;
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
            background: linear-gradient(to bottom, rgba(61,35,20,0.3), rgba(61,35,20,0.5));
        }
        .hero-content {
            position: relative;
            z-index: 2;
            color: var(--cream);
            max-width: 700px;
            padding: 0 24px;
        }
        .hero-content h1 {
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .hero-content p {
            font-size: clamp(1.1rem, 2.5vw, 1.4rem);
            font-style: italic;
            font-family: 'Playfair Display', serif;
            opacity: 0.9;
            margin-bottom: 32px;
        }
        .hero-cta {
            display: inline-block;
            padding: 14px 40px;
            background: var(--golden);
            color: var(--dark-brown);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            transition: all 0.3s;
        }
        .hero-cta:hover {
            background: var(--cream);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        /* Decorative Divider */
        .divider {
            text-align: center;
            padding: 40px 0;
        }
        .divider svg {
            width: 120px;
            height: 20px;
            fill: var(--golden);
            opacity: 0.6;
        }
        .divider-wheat::before {
            content: '🌾  ✦  🌾';
            font-size: 18px;
            letter-spacing: 8px;
            opacity: 0.5;
        }

        /* Sections */
        .section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-title {
            text-align: center;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 16px;
            color: var(--dark-brown);
        }
        .section-subtitle {
            text-align: center;
            color: var(--warm-brown);
            font-size: 1.05rem;
            max-width: 600px;
            margin: 0 auto 48px;
        }

        /* Our Story */
        .story-section {
            background: var(--cream);
            position: relative;
        }
        .story-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
        }
        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding: 80px 24px;
        }
        .story-text h2 {
            font-size: 2.5rem;
            margin-bottom: 24px;
        }
        .story-text p {
            margin-bottom: 16px;
            color: #5a3a22;
            font-size: 1.05rem;
        }
        .story-image {
            width: 100%;
            aspect-ratio: 4/3;
            background: url('/images/branding-final.png') center/contain no-repeat;
            background-color: var(--parchment);
            border: 8px solid white;
            box-shadow: 0 8px 40px rgba(61,35,20,0.1);
        }

        /* Breads */
        .breads-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .bread-card {
            background: white;
            border: 1px solid rgba(139, 94, 60, 0.12);
            padding: 0;
            text-align: center;
            transition: all 0.3s;
            overflow: hidden;
        }
        .bread-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(61,35,20,0.12);
        }
        .bread-card-img {
            height: 200px;
            background: linear-gradient(135deg, var(--cream), var(--parchment));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }
        .bread-card-body {
            padding: 28px 24px;
        }
        .bread-card h3 {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }
        .bread-card p {
            color: var(--warm-brown);
            font-size: 0.95rem;
        }
        .bread-card .price {
            display: inline-block;
            margin-top: 12px;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--dark-brown);
            font-weight: 600;
        }

        /* Visit Us */
        .visit-section {
            background: var(--dark-brown);
            color: var(--cream);
            padding: 80px 24px;
        }
        .visit-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .visit-section h2 {
            color: var(--cream);
            font-size: 2.5rem;
            margin-bottom: 24px;
        }
        .visit-section h3 {
            color: var(--golden);
            font-size: 1.2rem;
            margin-bottom: 12px;
            margin-top: 24px;
        }
        .visit-section p, .visit-section li {
            opacity: 0.85;
            line-height: 1.8;
        }
        .visit-section ul {
            list-style: none;
        }
        .visit-section ul li::before {
            content: '✦ ';
            color: var(--golden);
        }

        /* Testimonial */
        .testimonial {
            background: var(--cream);
            text-align: center;
            padding: 100px 24px;
        }
        .testimonial blockquote {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.3rem, 3vw, 2rem);
            font-style: italic;
            max-width: 800px;
            margin: 0 auto 24px;
            color: var(--dark-brown);
            line-height: 1.6;
        }
        .testimonial cite {
            color: var(--warm-brown);
            font-style: normal;
            font-size: 0.95rem;
            letter-spacing: 1px;
        }

        /* Footer */
        footer {
            background: #2A1810;
            color: var(--cream);
            padding: 60px 24px 30px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto 40px;
        }
        footer h4 {
            color: var(--golden);
            font-size: 1rem;
            margin-bottom: 16px;
            letter-spacing: 1px;
        }
        footer p, footer li {
            opacity: 0.7;
            font-size: 0.9rem;
            line-height: 1.8;
        }
        footer ul { list-style: none; }
        footer a {
            color: var(--cream);
            text-decoration: none;
            transition: opacity 0.2s;
        }
        footer a:hover { opacity: 1; }
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(245,230,208,0.1);
            opacity: 0.5;
            font-size: 0.85rem;
        }

        /* Newsletter */
        .newsletter-form {
            display: flex;
            gap: 0;
            margin-top: 12px;
        }
        .newsletter-form input {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid rgba(245,230,208,0.2);
            background: rgba(245,230,208,0.1);
            color: var(--cream);
            font-family: 'Lato', sans-serif;
            font-size: 0.9rem;
        }
        .newsletter-form input::placeholder { color: rgba(245,230,208,0.4); }
        .newsletter-form button {
            padding: 10px 20px;
            background: var(--golden);
            color: var(--dark-brown);
            border: none;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            font-family: 'Lato', sans-serif;
            transition: background 0.2s;
        }
        .newsletter-form button:hover { background: var(--cream); }

        /* Mobile */
        @media (max-width: 768px) {
            .main-nav { padding: 12px 20px; }
            .main-nav .nav-links { display: none; }
            .story-grid { grid-template-columns: 1fr; gap: 30px; }
            .breads-grid { grid-template-columns: 1fr; }
            .visit-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .hero { height: 70vh; min-height: 500px; }
        }
        @media (min-width: 769px) and (max-width: 1024px) {
            .breads-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<!-- Concept Switcher -->
<nav class="concept-nav">
    <a href="/" class="active">A — The Bakehouse</a>
    <a href="/concept-b">B — Modern Artisan</a>
    <a href="/concept-c">C — Sunday Morning</a>
</nav>

<!-- Main Navigation -->
<nav class="main-nav">
    <img src="/images/logo.jpg" alt="Bakery on Biscotto" class="logo">
    <ul class="nav-links">
        <li><a href="#story">Our Story</a></li>
        <li><a href="#breads">Our Breads</a></li>
        <li><a href="#visit">Visit Us</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Bakery on Biscotto</h1>
        <p>Where every bite is a slice of heaven</p>
        <a href="#breads" class="hero-cta">Explore Our Breads</a>
    </div>
</section>

<!-- Divider -->
<div class="divider divider-wheat"></div>

<!-- Our Story -->
<section class="story-section" id="story">
    <div class="story-grid">
        <div class="story-text">
            <h2>Our Story</h2>
            <p>It started with a single jar of sourdough starter and a kitchen covered in flour. What began as a weekend experiment quickly became a passion — the kind that wakes you up at 4 AM with excitement rather than obligation.</p>
            <p>At Bakery on Biscotto, every loaf is handcrafted with patience and care. Our sourdough ferments slowly, developing deep flavor and that perfect tangy crumb that only time can create. No shortcuts. No additives. Just flour, water, salt, and love.</p>
            <p>From our family's kitchen to your table, we're honored to share the bread that brings people together.</p>
        </div>
        <div class="story-image"></div>
    </div>
</section>

<!-- Divider -->
<div class="divider divider-wheat"></div>

<!-- Featured Breads -->
<section class="section" id="breads">
    <h2 class="section-title">Our Breads</h2>
    <p class="section-subtitle">Each loaf is made by hand with a 24-hour fermentation process, local ingredients, and a whole lot of heart.</p>

    <div class="breads-grid">
        <div class="bread-card">
            <div class="bread-card-img">🍞</div>
            <div class="bread-card-body">
                <h3>Rustic Sourdough</h3>
                <p>Our signature loaf. Crispy crust, open crumb, unmistakable tang. The one that started it all.</p>
                <span class="price">$8</span>
            </div>
        </div>
        <div class="bread-card">
            <div class="bread-card-img">🫒</div>
            <div class="bread-card-body">
                <h3>Olive Rosemary Loaf</h3>
                <p>Kalamata olives and fresh rosemary folded into our classic dough. Perfect with a drizzle of olive oil.</p>
                <span class="price">$10</span>
            </div>
        </div>
        <div class="bread-card">
            <div class="bread-card-img">🍇</div>
            <div class="bread-card-body">
                <h3>Cinnamon Raisin</h3>
                <p>Swirls of cinnamon and plump raisins in a slightly sweet sourdough. A breakfast favorite.</p>
                <span class="price">$9</span>
            </div>
        </div>
        <div class="bread-card">
            <div class="bread-card-img">🌾</div>
            <div class="bread-card-body">
                <h3>Honey Wheat</h3>
                <p>Whole wheat flour and local honey create a soft, nutty loaf. Great for sandwiches.</p>
                <span class="price">$8</span>
            </div>
        </div>
        <div class="bread-card">
            <div class="bread-card-img">🥖</div>
            <div class="bread-card-body">
                <h3>Classic Baguette</h3>
                <p>Crispy outside, airy inside. Our take on the French classic with a sourdough twist.</p>
                <span class="price">$6</span>
            </div>
        </div>
        <div class="bread-card">
            <div class="bread-card-img">🌻</div>
            <div class="bread-card-body">
                <h3>Seeded Multigrain</h3>
                <p>Packed with sunflower, flax, sesame, and pumpkin seeds. Hearty and deeply flavorful.</p>
                <span class="price">$10</span>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="testimonial">
    <div class="divider divider-wheat" style="padding-bottom:30px"></div>
    <blockquote>"The moment I tasted their sourdough, I knew I'd never buy grocery store bread again. It's the real deal — crusty, tangy, and absolutely soul-warming."</blockquote>
    <cite>— Sarah M., Farmers Market Regular</cite>
    <div class="divider divider-wheat" style="padding-top:30px"></div>
</section>

<!-- Visit Us -->
<section class="visit-section" id="visit">
    <div class="visit-grid">
        <div>
            <h2>Visit Us</h2>
            <p>Find us at local farmers markets and pop-up events throughout the season. Pre-orders are always welcome!</p>

            <h3>Market Schedule</h3>
            <ul>
                <li>Saturday Morning Market — 8 AM to 1 PM</li>
                <li>Wednesday Evening Market — 4 PM to 7 PM</li>
                <li>First Sunday Pop-Up — 9 AM to 12 PM</li>
            </ul>
        </div>
        <div>
            <h3>Pre-Order</h3>
            <p>Want to make sure your favorite loaf is waiting for you? Send us a message by Thursday evening for Saturday pickup.</p>

            <h3>Get in Touch</h3>
            <ul>
                <li>hello@bakeryonbiscotto.com</li>
                <li>@bakeryonbiscotto</li>
                <li>Follow us for fresh-from-the-oven updates!</li>
            </ul>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="contact">
    <div class="footer-grid">
        <div>
            <h4>Bakery on Biscotto</h4>
            <p>Handcrafted sourdough made with love, patience, and a really good starter named Biscotto.</p>
        </div>
        <div>
            <h4>Hours & Markets</h4>
            <ul>
                <li>Saturday: 8 AM – 1 PM</li>
                <li>Wednesday: 4 PM – 7 PM</li>
                <li>Sunday Pop-Up: 9 AM – 12 PM</li>
            </ul>
        </div>
        <div>
            <h4>Stay Connected</h4>
            <p>Join our newsletter for weekly bread drops, recipes, and behind-the-scenes baking fun.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault()">
                <input type="email" placeholder="Your email">
                <button type="submit">Join</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Bakery on Biscotto. Made with flour, water, salt & love.</p>
    </div>
</footer>

</body>
</html>
