@extends('layouts.storefront', ['title' => 'About | ' . \App\Models\Setting::get('business_name', 'Bakery on Biscotto'), 'active' => 'about'])

@section('styles')
    <style>
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
@endsection

@section('content')
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
                    <img src="/images/cassie-portrait.jpg" alt="{{ \App\Models\Setting::get('owner_name', 'Cassie') }}, baker and owner of {{ \App\Models\Setting::get('business_name', 'Bakery on Biscotto') }}">
                </div>
                <div class="annotation annotation-1">That's me! ↑</div>
            </div>
            <div class="about-text reveal" style="transition-delay: 0.15s;">
                <h2>Meet {{ \App\Models\Setting::get('owner_name', 'Cassie') }}</h2>
                <p>I've always loved being in the kitchen, but bread changed everything. It started simple: I wanted my family to have bread without all the processed ingredients and preservatives. I began with yeast bread, then curiosity took over. I started experimenting, tweaking, trying new things, and that's when sourdough found me.</p>
                <p>My approach isn't complicated, and I like it that way. Good ingredients, good technique, something genuinely good to eat. No fuss.</p>
                <p>What started as care packages for friends turned into something bigger. People kept asking for more, and eventually the question became: could this be a business? Turns out, yes.</p>
                <p>I bake everything in the same kitchen where I cook dinner for my husband and daughter. Nothing leaves this house that I wouldn't put on our own table. I have a background in music and a love for the arts, and I bring that same creativity to every loaf I shape. Baking is my art form, and every piece is made by hand, with care.</p>
                <p class="signature">With love and flour dust, {{ \App\Models\Setting::get('owner_name', 'Cassie') }} ✨</p>
            </div>
        </div>
        <div class="torn-bottom"></div>
    </section>
@endsection

@section('scripts')
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
@endsection
