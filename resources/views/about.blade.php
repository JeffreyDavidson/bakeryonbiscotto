<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Bakery on Biscotto</title>
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

        /* Navigation */
        .main-nav {
            position: fixed; top: 12px; left: 50%; transform: translateX(-50%);
            z-index: 1000;
            display: flex; align-items: center; gap: 4px;
            padding: 8px 12px;
            background: rgba(61,35,20,0.75);
            backdrop-filter: blur(24px) saturate(1.6);
            -webkit-backdrop-filter: blur(24px) saturate(1.6);
            border-radius: 100px;
            border: 1px solid rgba(212,165,116,0.15);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        .main-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 500;
            color: var(--cream); text-decoration: none;
            padding: 10px 24px; border-radius: 100px;
            transition: all 0.3s ease;
        }
        .main-nav a:hover { background: rgba(212,165,116,0.2); color: var(--golden); }
        .main-nav a.active { background: var(--golden); color: var(--dark); font-weight: 600; }

        /* Skip to main content */
        .skip-to-main {
            position: absolute; top: -100px; left: 50%; transform: translateX(-50%);
            background: var(--dark); color: var(--cream); padding: 12px 24px;
            border-radius: 0 0 8px 8px; font-family: 'Inter', sans-serif;
            font-size: 14px; font-weight: 600; text-decoration: none;
            z-index: 10000; transition: top 0.3s ease;
        }
        .skip-to-main:focus { top: 0; outline: 2px solid var(--golden); outline-offset: 2px; }

        /* Focus styles */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible {
            outline: 2px solid var(--golden); outline-offset: 2px;
        }

        /* Footer */
        .footer {
            background: var(--dark); position: relative; overflow: hidden;
            padding: 0 20px 40px; text-align: center;
        }
        .footer-gradient {
            height: 3px;
            background: linear-gradient(90deg, transparent 5%, var(--golden), var(--accent), var(--golden), transparent 95%);
            margin-bottom: 60px;
        }
        .footer h3 {
            font-family: 'Playfair Display', serif; font-size: 1.8rem;
            color: var(--cream); margin-bottom: 8px;
        }
        .footer .tagline {
            font-family: 'Dancing Script', cursive; font-size: 1.15rem;
            color: var(--golden); margin-bottom: 24px;
        }
        .footer-badge {
            display: inline-block; padding: 10px 28px;
            border: 1.5px solid rgba(212,165,116,0.25); border-radius: 100px;
            font-size: 13px; font-weight: 500; color: rgba(245,230,208,0.6);
            margin-bottom: 28px; letter-spacing: 0.5px;
        }
        .footer-info {
            font-size: 14px; color: rgba(245,230,208,0.4); line-height: 2.2;
        }
        .footer-info a { color: var(--golden); text-decoration: none; transition: color 0.3s; }
        .footer-info a:hover { color: var(--cream); }
        .footer-allergen {
            margin-top: 24px; font-size: 11px; color: rgba(245,230,208,0.35);
            max-width: 600px; margin-left: auto; margin-right: auto;
            line-height: 1.5; font-style: italic;
        }
        .footer-bottom {
            margin-top: 20px; padding-top: 20px;
            border-top: 1px solid rgba(245,230,208,0.06);
            font-size: 12px; color: rgba(245,230,208,0.2);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible, [tabindex]:focus-visible {
            outline: 2px solid var(--golden);
            outline-offset: 2px;
        }

        /* ═══ HERO ═══ */
        .about-hero {
            position: relative;
            padding: 160px 20px 80px;
            background: var(--dark);
            text-align: center;
            overflow: hidden;
        }
        .about-hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(212,165,116,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .about-hero h1 {
            position: relative;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 16px;
        }
        .about-hero h1 em {
            font-style: italic; font-weight: 400;
            color: var(--golden);
        }
        .about-hero .hero-sub {
            position: relative;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgba(245,230,208,0.5);
        }

        /* ═══ MEET CASSIE ═══ */
        .about {
            position: relative; overflow: hidden;
            padding: 80px 0;
        }
        .torn-top {
            position: absolute; top: -2px; left: 0; right: 0; height: 40px;
            background: var(--light);
            clip-path: polygon(
                0% 0%, 100% 0%,
                100% 40%, 97% 55%, 94% 35%, 90% 60%, 87% 40%, 83% 55%,
                80% 30%, 76% 50%, 73% 35%, 70% 55%, 66% 40%, 63% 60%,
                60% 35%, 56% 50%, 53% 30%, 50% 55%, 46% 40%, 43% 60%,
                40% 35%, 36% 50%, 33% 30%, 30% 55%, 26% 40%, 23% 60%,
                20% 35%, 16% 55%, 13% 40%, 10% 55%, 6% 35%, 3% 50%, 0% 40%
            );
            z-index: 2;
        }
        .torn-bottom {
            position: absolute; bottom: -2px; left: 0; right: 0; height: 40px;
            background: var(--light);
            clip-path: polygon(
                0% 100%, 100% 100%,
                100% 60%, 97% 45%, 94% 65%, 90% 40%, 87% 60%, 83% 45%,
                80% 70%, 76% 50%, 73% 65%, 70% 45%, 66% 60%, 63% 40%,
                60% 65%, 56% 50%, 53% 70%, 50% 45%, 46% 60%, 43% 40%,
                40% 65%, 36% 50%, 33% 70%, 30% 45%, 26% 60%, 23% 40%,
                20% 65%, 16% 45%, 13% 60%, 10% 45%, 6% 65%, 3% 50%, 0% 60%
            );
            z-index: 2;
        }
        .about-bg {
            position: absolute; inset: 0;
            background: var(--cream);
            background-image:
                radial-gradient(circle at 20% 50%, rgba(193,127,78,0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 30%, rgba(212,165,116,0.1) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-blend-mode: overlay;
        }
        .about-inner {
            position: relative; z-index: 3;
            max-width: 1100px; margin: 0 auto; padding: 40px 40px;
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 80px;
            align-items: center;
        }
        .about-photo-wrap {
            position: relative;
            justify-self: center;
        }
        .about-photo {
            width: 100%; max-width: 380px;
            border-radius: 12px;
            box-shadow:
                0 0 0 4px var(--cream),
                0 0 0 6px var(--golden),
                0 20px 60px rgba(61,35,20,0.25);
            position: relative;
            overflow: hidden;
        }
        .about-photo img { width: 100%; height: auto; display: block; }
        .about-photo::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(180deg, transparent 70%, rgba(61,35,20,0.15) 100%);
            pointer-events: none;
        }
        .annotation {
            position: absolute;
            font-family: 'Dancing Script', cursive;
            font-size: 16px; color: var(--brown);
            white-space: nowrap;
        }
        .annotation-1 {
            bottom: -30px; left: 50%;
            transform: translateX(-50%) rotate(-3deg);
        }
        .about-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem; font-weight: 600;
            margin-bottom: 24px; color: var(--dark);
            position: relative;
        }
        .about-text h2::after {
            content: '';
            display: block; width: 60px; height: 3px;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            margin-top: 16px; border-radius: 2px;
        }
        .about-text p {
            font-size: 16px; line-height: 1.8;
            color: rgba(61,35,20,0.8); margin-bottom: 16px;
        }
        .about-text .signature {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem; color: var(--accent);
            margin-top: 24px;
        }

        /* ═══ SECTION HEAD ═══ */
        .section-head {
            text-align: center; margin-bottom: 60px;
        }
        .section-head h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.6rem);
            font-weight: 600; color: var(--dark);
        }
        .section-head .accent-line {
            width: 60px; height: 3px; margin: 16px auto 0;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            border-radius: 2px;
        }

        /* ═══ FAQ ═══ */
        .faq {
            padding: 80px 20px;
            background: var(--light);
        }
        .faq-list {
            max-width: 800px; margin: 0 auto;
            display: flex; flex-direction: column; gap: 0;
        }
        .faq-item {
            border-bottom: 1px solid rgba(61,35,20,0.1);
        }
        .faq-item:first-child {
            border-top: 1px solid rgba(61,35,20,0.1);
        }
        .faq-question {
            width: 100%;
            background: none; border: none;
            padding: 24px 40px 24px 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem; font-weight: 600;
            color: var(--dark);
            text-align: left;
            cursor: pointer;
            position: relative;
            transition: color 0.3s;
        }
        .faq-question:hover { color: var(--accent); }
        .faq-question::after {
            content: '+';
            position: absolute; right: 0; top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem; font-weight: 300;
            color: var(--golden);
            transition: transform 0.3s;
        }
        .faq-item.open .faq-question::after {
            transform: translateY(-50%) rotate(45deg);
        }
        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.4s ease;
        }
        .faq-item.open .faq-answer {
            grid-template-rows: 1fr;
        }
        .faq-answer-inner {
            overflow: hidden;
        }
        .faq-answer-inner p {
            padding: 0 0 24px 0;
            color: var(--warm);
            line-height: 1.7;
        }
        .faq-answer-inner a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .faq-answer-inner a:hover {
            text-decoration: underline;
        }

        /* ═══ DIVIDER ═══ */
        .divider {
            display: flex; align-items: center; justify-content: center;
            gap: 20px; padding: 40px 20px;
        }
        .divider-line {
            flex: 1; max-width: 180px; height: 2px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .divider-icon { opacity: 0.7; }

        /* ═══ SCROLL REVEAL ═══ */
        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══ MOBILE ═══ */
        @media (max-width: 1024px) {
            .about-inner {
                grid-template-columns: 1fr;
                gap: 40px; text-align: center;
            }
            .about-text h2::after { margin: 16px auto 0; }
        }
        @media (max-width: 768px) {
            .about-photo { max-width: 300px; }
        }
        @media (max-width: 600px) {
            .review-featured { padding: 32px 16px; }
            .convo-card, .convo-card.from-right { flex-direction: column; text-align: left; }
            .convo-card.from-right .convo-meta { justify-content: flex-start; }
            .convo-bubble::before { display: none !important; }
            .convo-avatar { width: 44px; height: 44px; font-size: 16px; }
            .review-form-card { padding: 28px 20px; }
            .review-form-row { grid-template-columns: 1fr; }
            .star-rating label { font-size: 28px; }
        }
    </style>
</head>
<body>

    <x-main-nav active="about" />

    {{-- ═══ HERO ═══ --}}
    <section class="about-hero">
        <h1>Our <em>Story</em></h1>
        <p class="hero-sub">The heart behind every loaf.</p>
    </section>

    {{-- ═══ MEET CASSIE ═══ --}}
    <section class="about" id="about">
        <div class="torn-top"></div>
        <div class="about-bg"></div>
        <div class="about-inner">
            <div class="about-photo-wrap reveal">
                <div class="about-photo">
                    <img src="/images/cassie-portrait.jpg" alt="Cassie, baker and owner of Bakery on Biscotto">
                </div>
                <div class="annotation annotation-1">That's me! ↑</div>
            </div>
            <div class="about-text reveal" style="transition-delay: 0.15s;">
                <h2>Meet Cassie</h2>
                <p>I've always loved being in the kitchen, but bread changed everything. It started simple: I wanted my family to have bread without all the processed ingredients and preservatives. I began with yeast bread, then curiosity took over. I started experimenting, tweaking, trying new things, and that's when sourdough found me.</p>
                <p>My approach isn't complicated, and I like it that way. Good ingredients, good technique, something genuinely good to eat. No fuss.</p>
                <p>What started as care packages for friends turned into something bigger. People kept asking for more, and eventually the question became: could this be a business? Turns out, yes.</p>
                <p>I bake everything in the same kitchen where I cook dinner for my husband and daughter. Nothing leaves this house that I wouldn't put on our own table. I have a background in music and a love for the arts, and I bring that same creativity to every loaf I shape. Baking is my art form, and every piece is made by hand, with care.</p>
                <p class="signature">With love and flour dust, Cassie ✨</p>
            </div>
        </div>
        <div class="torn-bottom"></div>
    </section>

    {{-- ═══ FAQ ═══ --}}
    <section class="faq" id="faq" x-data="{ open: null }">
        <div class="section-head reveal">
            <h2>Frequently Asked Questions</h2>
            <div class="accent-line"></div>
        </div>
        <div class="faq-list reveal">
            <div class="faq-item" :class="{ 'open': open === 1 }">
                <button class="faq-question" :aria-expanded="open === 1 ? 'true' : 'false'" aria-controls="faq-answer-1" @click="open = open === 1 ? null : 1" @keydown.enter.prevent="open = open === 1 ? null : 1" @keydown.space.prevent="open = open === 1 ? null : 1">How do I order?</button>
                <div class="faq-answer" id="faq-answer-1" role="region"><div class="faq-answer-inner">
                    <p>Use our <a href="/order">online order page</a>! Pick what you'd like, choose pickup or delivery, and check out.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 2 }">
                <button class="faq-question" :aria-expanded="open === 2 ? 'true' : 'false'" aria-controls="faq-answer-2" @click="open = open === 2 ? null : 2" @keydown.enter.prevent="open = open === 2 ? null : 2" @keydown.space.prevent="open = open === 2 ? null : 2">How far in advance should I order?</button>
                <div class="faq-answer" id="faq-answer-2" role="region"><div class="faq-answer-inner">
                    <p>At least 2 days. Sourdough is a slow process. A basic loaf takes a minimum of 24 hours from feeding the starter to pulling it out of the oven. Every order is baked fresh, never in advance.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 3 }">
                <button class="faq-question" :aria-expanded="open === 3 ? 'true' : 'false'" aria-controls="faq-answer-3" @click="open = open === 3 ? null : 3" @keydown.enter.prevent="open = open === 3 ? null : 3" @keydown.space.prevent="open = open === 3 ? null : 3">Do you deliver?</button>
                <div class="faq-answer" id="faq-answer-3" role="region"><div class="faq-answer-inner">
                    <p>Yes! Pickup is in Davenport, FL and we deliver throughout the Four Corners and greater Orlando area for a fee based on mileage.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 4 }">
                <button class="faq-question" :aria-expanded="open === 4 ? 'true' : 'false'" aria-controls="faq-answer-4" @click="open = open === 4 ? null : 4" @keydown.enter.prevent="open = open === 4 ? null : 4" @keydown.space.prevent="open = open === 4 ? null : 4">What if I need to cancel?</button>
                <div class="faq-answer" id="faq-answer-4" role="region"><div class="faq-answer-inner">
                    <p>Cancellations made at least 48 hours in advance will receive a full refund. Between 24 and 48 hours notice will receive a 50% refund. Anything under 24 hours is non-refundable.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 5 }">
                <button class="faq-question" :aria-expanded="open === 5 ? 'true' : 'false'" aria-controls="faq-answer-5" @click="open = open === 5 ? null : 5" @keydown.enter.prevent="open = open === 5 ? null : 5" @keydown.space.prevent="open = open === 5 ? null : 5">What if I can't pick up at my scheduled time?</button>
                <div class="faq-answer" id="faq-answer-5" role="region"><div class="faq-answer-inner">
                    <p>Please contact us as soon as possible to discuss rescheduling. Orders will not be held longer than 24 hours. If your order is not picked up or rescheduled during that time, it will be considered cancelled with no refund.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 6 }">
                <button class="faq-question" :aria-expanded="open === 6 ? 'true' : 'false'" aria-controls="faq-answer-6" @click="open = open === 6 ? null : 6" @keydown.enter.prevent="open = open === 6 ? null : 6" @keydown.space.prevent="open = open === 6 ? null : 6">Can I customize my order?</button>
                <div class="faq-answer" id="faq-answer-6" role="region"><div class="faq-answer-inner">
                    <p>We don't take fully custom orders, but we can make small adjustments. Don't like walnuts in your banana bread? We can swap in pecans. We can't accommodate items outside our menu, but we always love hearing suggestions for future offerings.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 7 }">
                <button class="faq-question" :aria-expanded="open === 7 ? 'true' : 'false'" aria-controls="faq-answer-7" @click="open = open === 7 ? null : 7" @keydown.enter.prevent="open = open === 7 ? null : 7" @keydown.space.prevent="open = open === 7 ? null : 7">Why sourdough?</button>
                <div class="faq-answer" id="faq-answer-7" role="region"><div class="faq-answer-inner">
                    <p>It started with wanting bread without processed ingredients and preservatives. Sourdough uses a natural fermentation process, which means simpler ingredients and better flavor. No shortcuts, no additives.</p>
                </div></div>
            </div>
        </div>
    </section>

    <x-site-footer />

    <script>
        // Scroll reveal
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
