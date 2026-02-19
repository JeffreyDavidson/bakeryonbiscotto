<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOW Concepts | Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
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
            --ink: #2a1a0e;
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: #1a0f08;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .concept-label {
            text-align: center;
            padding: 80px 20px 30px;
            background: var(--light);
        }
        .concept-label h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .concept-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: var(--warm);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }


        /* ═══════════════════════════════════════════
           CONCEPT A: "The Baking Journey"
           Full-screen scrollytelling — each scroll
           reveals the next step of making sourdough.
           Sticky sections with progress bar.
        ═══════════════════════════════════════════ */
        .journey {
            position: relative;
        }
        .journey-step {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .journey-step-bg {
            position: absolute; inset: 0;
            transition: opacity 0.6s;
        }
        /* Each step has unique ambiance */
        .journey-step:nth-child(1) .journey-step-bg {
            background:
                radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.08), transparent 60%),
                linear-gradient(180deg, #1a0f08, #241508);
        }
        .journey-step:nth-child(2) .journey-step-bg {
            background:
                radial-gradient(ellipse at 30% 40%, rgba(139,94,60,0.1), transparent 50%),
                radial-gradient(ellipse at 70% 60%, rgba(212,165,116,0.06), transparent 40%),
                linear-gradient(180deg, #241508, #1e1209);
        }
        .journey-step:nth-child(3) .journey-step-bg {
            background:
                radial-gradient(ellipse at 50% 30%, rgba(244,200,122,0.08), transparent 50%),
                linear-gradient(180deg, #1e1209, #2a1a0e);
        }
        .journey-step:nth-child(4) .journey-step-bg {
            background:
                radial-gradient(ellipse at 40% 50%, rgba(244,200,122,0.12), transparent 50%),
                radial-gradient(ellipse at 60% 30%, rgba(193,127,78,0.08), transparent 40%),
                linear-gradient(180deg, #2a1a0e, #3D2314);
        }
        .journey-step:nth-child(5) .journey-step-bg {
            background:
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.15), transparent 50%),
                linear-gradient(180deg, #3D2314, #1a0f08);
        }

        .journey-content {
            position: relative; z-index: 2;
            text-align: center;
            max-width: 600px;
            padding: 0 40px;
        }
        .journey-step-num {
            font-family: 'Dancing Script', cursive;
            font-size: 80px;
            font-weight: 700;
            color: var(--golden);
            opacity: 0.12;
            line-height: 1;
            margin-bottom: -20px;
        }
        .journey-emoji {
            font-size: 72px;
            margin-bottom: 24px;
            display: block;
            filter: drop-shadow(0 8px 20px rgba(0,0,0,0.4));
            animation: float-gentle 4s ease-in-out infinite;
        }
        @keyframes float-gentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .journey-step:nth-child(2) .journey-emoji { animation-delay: 0.5s; }
        .journey-step:nth-child(3) .journey-emoji { animation-delay: 1s; }
        .journey-step:nth-child(4) .journey-emoji { animation-delay: 1.5s; }
        .journey-step:nth-child(5) .journey-emoji { animation-delay: 2s; }

        .journey-title {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.2rem, 5vw, 3.2rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 16px;
        }
        .journey-time {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--golden);
            margin-bottom: 20px;
            opacity: 0.6;
        }
        .journey-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            font-style: italic;
            color: rgba(245,230,208,0.55);
            line-height: 1.8;
        }

        /* Progress dots on right side */
        .journey-progress {
            position: fixed;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .journey-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            border: 1.5px solid rgba(212,165,116,0.3);
            background: transparent;
            transition: all 0.4s;
            cursor: pointer;
        }
        .journey-dot.active {
            background: var(--golden);
            border-color: var(--golden);
            box-shadow: 0 0 12px rgba(212,165,116,0.4);
            transform: scale(1.3);
        }

        /* Connecting line between steps */
        .journey-connector {
            height: 0;
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .journey-connector::before {
            content: '';
            position: absolute;
            top: -40px; bottom: -40px;
            width: 1px;
            background: linear-gradient(180deg, transparent, rgba(212,165,116,0.15), transparent);
        }


        /* ═══════════════════════════════════════════
           CONCEPT B: "Biscotto's Birthday"
           Live counter showing the starter's age.
           Warm, personal, unique to sourdough bakers.
        ═══════════════════════════════════════════ */
        .starter-age {
            padding: 100px 20px;
            background: var(--cream);
            text-align: center;
            position: relative;
            overflow: hidden;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.7' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.02'/%3E%3C/svg%3E");
            background-color: var(--cream);
        }
        .starter-age::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.1), transparent 60%);
            pointer-events: none;
        }
        .starter-intro {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: var(--warm);
            margin-bottom: 12px;
            position: relative;
        }
        .starter-name {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3rem, 7vw, 5rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            position: relative;
        }
        .starter-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: var(--warm);
            margin-bottom: 48px;
            position: relative;
        }

        .age-counter {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-bottom: 48px;
            position: relative;
        }
        .age-unit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .age-number {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 5rem);
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
            position: relative;
        }
        /* Warm glow behind numbers */
        .age-number::before {
            content: '';
            position: absolute;
            inset: -20px -30px;
            background: radial-gradient(ellipse, rgba(212,165,116,0.08), transparent 70%);
            border-radius: 50%;
        }
        .age-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--accent);
        }
        .age-separator {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--golden);
            opacity: 0.3;
            align-self: flex-start;
            margin-top: 8px;
        }

        .starter-quote {
            max-width: 500px;
            margin: 0 auto;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: var(--warm);
            line-height: 1.7;
            position: relative;
        }
        .starter-quote::before {
            content: '🫧';
            display: block;
            font-size: 36px;
            margin-bottom: 16px;
            font-style: normal;
        }

        @media (max-width: 600px) {
            .age-counter { gap: 16px; }
            .age-separator { font-size: 2rem; }
        }


        /* ═══════════════════════════════════════════
           CONCEPT C: "Kitchen Window"
           An ambient nighttime scene — looking through
           a window at a warm kitchen. CSS illustration.
        ═══════════════════════════════════════════ */
        .kitchen-window {
            padding: 100px 20px;
            background: linear-gradient(180deg, #0d0805, #1a0f08 30%, #0d0805);
            position: relative;
            overflow: hidden;
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        /* Stars */
        .kw-stars {
            position: absolute; inset: 0;
            pointer-events: none;
        }
        .kw-star {
            position: absolute;
            width: 2px; height: 2px;
            background: rgba(245,230,208,0.4);
            border-radius: 50%;
            animation: twinkle 3s infinite ease-in-out;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.8; }
        }

        .kw-frame {
            width: 500px;
            max-width: 90vw;
            position: relative;
        }
        /* Window frame */
        .kw-window {
            background: #2a1a0e;
            border: 8px solid #3d2818;
            border-radius: 12px 12px 4px 4px;
            overflow: hidden;
            position: relative;
            box-shadow:
                0 0 80px rgba(244,200,122,0.15),
                0 0 200px rgba(244,200,122,0.05),
                0 20px 60px rgba(0,0,0,0.5);
        }
        /* Window pane divider */
        .kw-window::before {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            left: 50%; width: 6px;
            transform: translateX(-50%);
            background: #3d2818;
            z-index: 10;
            box-shadow: 2px 0 4px rgba(0,0,0,0.3), -2px 0 4px rgba(0,0,0,0.3);
        }
        .kw-window::after {
            content: '';
            position: absolute;
            left: 0; right: 0;
            top: 50%; height: 6px;
            transform: translateY(-50%);
            background: #3d2818;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3), 0 -2px 4px rgba(0,0,0,0.3);
        }
        /* The warm interior */
        .kw-interior {
            height: 350px;
            position: relative;
            background:
                radial-gradient(ellipse at 50% 30%, rgba(244,200,122,0.25), transparent 60%),
                radial-gradient(ellipse at 30% 70%, rgba(193,127,78,0.15), transparent 50%),
                linear-gradient(180deg, #4a3020, #3d2818 40%, #2a1a0e);
            animation: warm-pulse 4s ease-in-out infinite;
        }
        @keyframes warm-pulse {
            0%, 100% { filter: brightness(1); }
            50% { filter: brightness(1.05); }
        }
        /* Counter/shelf */
        .kw-counter {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 100px;
            background: linear-gradient(180deg, #5a3d28, #4a3020);
            border-top: 3px solid #6b4c35;
        }
        /* Bread silhouettes on counter */
        .kw-bread {
            position: absolute;
            bottom: 100px;
        }
        .kw-bread-1 {
            left: 15%;
            width: 80px; height: 50px;
            background: radial-gradient(ellipse at 50% 80%, #6b4c35, #5a3d28);
            border-radius: 50% 50% 10% 10%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .kw-bread-2 {
            left: 55%;
            width: 100px; height: 45px;
            background: radial-gradient(ellipse at 50% 80%, #7a5a3e, #6b4c35);
            border-radius: 40% 40% 5% 5%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .kw-bread-3 {
            right: 12%;
            width: 60px; height: 55px;
            background: radial-gradient(ellipse at 50% 70%, #6b4c35, #5a3d28);
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        /* Steam from bread */
        .kw-steam {
            position: absolute;
            bottom: 150px;
            width: 30px;
            background: linear-gradient(180deg, transparent, rgba(245,230,208,0.06), transparent);
            border-radius: 50%;
            filter: blur(6px);
            animation: kw-steam-rise 3.5s linear infinite;
        }
        .kw-steam-1 { left: 20%; height: 60px; animation-delay: 0s; }
        .kw-steam-2 { left: 60%; height: 50px; animation-delay: 1.2s; animation-duration: 4s; }
        .kw-steam-3 { right: 15%; height: 55px; animation-delay: 0.6s; animation-duration: 3s; }
        @keyframes kw-steam-rise {
            0% { transform: translateY(0) scaleX(1); opacity: 0; }
            20% { opacity: 1; }
            100% { transform: translateY(-80px) scaleX(1.8); opacity: 0; }
        }
        /* Warm light glow from window onto ground */
        .kw-ground-glow {
            width: 600px; max-width: 100%;
            height: 80px;
            margin-top: -4px;
            background: radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.08), transparent 70%);
        }
        /* Window sill */
        .kw-sill {
            width: calc(100% + 24px);
            margin-left: -12px;
            height: 14px;
            background: linear-gradient(180deg, #4a3020, #3d2818);
            border-radius: 0 0 4px 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .kw-text {
            text-align: center;
            margin-top: 48px;
            position: relative;
        }
        .kw-text h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--cream);
            margin-bottom: 12px;
        }
        .kw-text p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: rgba(245,230,208,0.4);
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.7;
        }

        @media (max-width: 600px) {
            .kw-interior { height: 250px; }
            .kw-counter { height: 70px; }
            .kw-bread { bottom: 70px; }
            .kw-bread-1 { width: 60px; height: 38px; }
            .kw-bread-2 { width: 75px; height: 34px; }
            .kw-bread-3 { width: 45px; height: 42px; }
        }


        /* ═══════════════════════════════════════════
           CONCEPT D: "Flour Burst on Scroll"
           Particles explode outward when section enters view
        ═══════════════════════════════════════════ */
        .flour-burst-section {
            padding: 120px 20px;
            background: var(--dark);
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .flour-burst-section::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.04), transparent 60%);
        }
        .burst-container {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        .burst-particle {
            position: absolute;
            border-radius: 50%;
            background: var(--cream);
            opacity: 0;
        }
        .burst-active .burst-particle {
            animation: burst-fly 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes burst-fly {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 0.8;
            }
            100% {
                transform: translate(var(--bx), var(--by)) scale(0);
                opacity: 0;
            }
        }

        .burst-text {
            position: relative; z-index: 2;
        }
        .burst-text h3 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 16px;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s;
        }
        .burst-active .burst-text h3 {
            opacity: 1;
            transform: scale(1);
        }
        .burst-text p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgba(245,230,208,0.5);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
            opacity: 0;
            transition: opacity 0.8s 0.6s;
        }
        .burst-active .burst-text p {
            opacity: 1;
        }
    </style>
</head>
<body>

    {{-- ═══ CONCEPT A: BAKING JOURNEY ═══ --}}
    <div class="concept-label" style="background: var(--light);">
        <h2>Concept A: "The Baking Journey"</h2>
        <p>Full-screen scrollytelling. Each scroll reveals the next step of making sourdough — from feeding the starter to pulling the loaf out of the oven. Progress dots on the right track where you are. Could replace or supplement the "Meet Cassie" section.</p>
    </div>

    <div class="journey" id="journey">
        <nav class="journey-progress" id="journeyProgress">
            <div class="journey-dot active" data-step="0"></div>
            <div class="journey-dot" data-step="1"></div>
            <div class="journey-dot" data-step="2"></div>
            <div class="journey-dot" data-step="3"></div>
            <div class="journey-dot" data-step="4"></div>
        </nav>

        <div class="journey-step">
            <div class="journey-step-bg"></div>
            <div class="journey-content">
                <span class="journey-step-num">01</span>
                <span class="journey-emoji">🫧</span>
                <div class="journey-time">5:00 AM</div>
                <h3 class="journey-title">Feed the Starter</h3>
                <p class="journey-desc">Before the sun rises, Biscotto gets fed. Equal parts flour and water, a gentle stir, and patience. In a few hours, the bubbles tell us it's ready.</p>
            </div>
        </div>

        <div class="journey-connector"></div>

        <div class="journey-step">
            <div class="journey-step-bg"></div>
            <div class="journey-content">
                <span class="journey-step-num">02</span>
                <span class="journey-emoji">🤲</span>
                <div class="journey-time">10:00 AM</div>
                <h3 class="journey-title">Mix & Fold</h3>
                <p class="journey-desc">Flour, water, salt, and our bubbling starter come together. Then the stretch-and-fold begins — building strength and structure, one gentle turn at a time.</p>
            </div>
        </div>

        <div class="journey-connector"></div>

        <div class="journey-step">
            <div class="journey-step-bg"></div>
            <div class="journey-content">
                <span class="journey-step-num">03</span>
                <span class="journey-emoji">⏳</span>
                <div class="journey-time">2:00 PM</div>
                <h3 class="journey-title">The Long Proof</h3>
                <p class="journey-desc">This is where the magic happens. The dough rests, ferments, and develops that signature tang. No rushing this part — time is the secret ingredient.</p>
            </div>
        </div>

        <div class="journey-connector"></div>

        <div class="journey-step">
            <div class="journey-step-bg"></div>
            <div class="journey-content">
                <span class="journey-step-num">04</span>
                <span class="journey-emoji">🔥</span>
                <div class="journey-time">6:00 AM · Next Day</div>
                <h3 class="journey-title">Into the Oven</h3>
                <p class="journey-desc">Scored and loaded into a screaming hot oven. The kitchen fills with warmth. Steam creates that crackling golden crust. The best smell in the world.</p>
            </div>
        </div>

        <div class="journey-connector"></div>

        <div class="journey-step">
            <div class="journey-step-bg"></div>
            <div class="journey-content">
                <span class="journey-step-num">05</span>
                <span class="journey-emoji">🍞</span>
                <div class="journey-time">8:00 AM</div>
                <h3 class="journey-title">Fresh for You</h3>
                <p class="journey-desc">Cooled, wrapped with care, and ready for your table. From our kitchen to yours — every loaf a labor of love that started 24 hours ago.</p>
            </div>
        </div>
    </div>


    {{-- ═══ CONCEPT B: BISCOTTO'S AGE ═══ --}}
    <div class="concept-label">
        <h2>Concept B: "Meet Biscotto"</h2>
        <p>A live counter showing the sourdough starter's age. Personal and unique — no other bakery has this. Builds emotional connection. Needs Cassie to provide the starter's "birthday."</p>
    </div>

    <section class="starter-age">
        <p class="starter-intro">Say hello to the heart of our kitchen</p>
        <h2 class="starter-name">Biscotto</h2>
        <p class="starter-subtitle">Our sourdough starter, alive and thriving since 2023</p>

        <div class="age-counter" id="ageCounter">
            <div class="age-unit">
                <span class="age-number" id="ageDays">547</span>
                <span class="age-label">Days</span>
            </div>
            <span class="age-separator">:</span>
            <div class="age-unit">
                <span class="age-number" id="ageHours">14</span>
                <span class="age-label">Hours</span>
            </div>
            <span class="age-separator">:</span>
            <div class="age-unit">
                <span class="age-number" id="ageMinutes">32</span>
                <span class="age-label">Minutes</span>
            </div>
        </div>

        <div class="starter-quote">
            Every loaf we bake starts right here. Biscotto gets fed every day, bubbles up with life, and shares that energy with every batch of dough. No two bakes are ever quite the same.
        </div>
    </section>


    {{-- ═══ CONCEPT C: KITCHEN WINDOW ═══ --}}
    <div class="concept-label">
        <h2>Concept C: "The Kitchen Window"</h2>
        <p>An atmospheric CSS illustration — you're looking through a window at a warm cottage kitchen at night. Bread silhouettes on the counter, steam rising, warm amber light spilling out. A mood piece that sells the feeling, not just the product.</p>
    </div>

    <section class="kitchen-window">
        {{-- Stars --}}
        <div class="kw-stars">
            @for ($i = 0; $i < 30; $i++)
            <div class="kw-star" style="
                left: {{ rand(0, 100) }}%;
                top: {{ rand(0, 40) }}%;
                animation-delay: {{ rand(0, 3000) / 1000 }}s;
                animation-duration: {{ rand(2000, 5000) / 1000 }}s;
                width: {{ rand(1, 3) }}px;
                height: {{ rand(1, 3) }}px;
            "></div>
            @endfor
        </div>

        <div class="kw-frame">
            <div class="kw-window">
                <div class="kw-interior">
                    {{-- Bread on counter --}}
                    <div class="kw-bread kw-bread-1"></div>
                    <div class="kw-bread kw-bread-2"></div>
                    <div class="kw-bread kw-bread-3"></div>
                    {{-- Steam --}}
                    <div class="kw-steam kw-steam-1"></div>
                    <div class="kw-steam kw-steam-2"></div>
                    <div class="kw-steam kw-steam-3"></div>
                    {{-- Counter --}}
                    <div class="kw-counter"></div>
                </div>
            </div>
            <div class="kw-sill"></div>
        </div>
        <div class="kw-ground-glow"></div>

        <div class="kw-text">
            <h3>Baked While You Sleep</h3>
            <p>Late nights and early mornings in our cottage kitchen. Every loaf handcrafted with patience, care, and a whole lot of love.</p>
        </div>
    </section>


    {{-- ═══ CONCEPT D: FLOUR BURST ═══ --}}
    <div class="concept-label">
        <h2>Concept D: "Flour Burst"</h2>
        <p>When this section scrolls into view, flour particles explode outward from the center and the text scales up dramatically. A moment of surprise and delight. Could be used for a CTA or section transition.</p>
    </div>

    <section class="flour-burst-section" id="flourBurst">
        <div class="burst-container" id="burstContainer"></div>
        <div class="burst-text">
            <h3>Every Loaf, a Little Different</h3>
            <p>That's the beauty of sourdough. Same love, same care, same starter — but each one is uniquely yours.</p>
        </div>
    </section>

    <div style="padding: 80px 20px; text-align: center; background: var(--light);">
        <p style="color: var(--warm); font-family: 'Playfair Display', serif; font-size: 18px;">~ End of concepts ~</p>
    </div>

    <script>
        // Journey progress dots
        const journeySteps = document.querySelectorAll('.journey-step');
        const journeyDots = document.querySelectorAll('.journey-dot');

        const journeyObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const index = Array.from(journeySteps).indexOf(entry.target);
                    journeyDots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                }
            });
        }, { threshold: 0.5 });

        journeySteps.forEach(step => journeyObserver.observe(step));

        // Age counter (placeholder — needs real birthday)
        // Using Aug 15, 2023 as example
        const starterBirth = new Date('2023-08-15T06:00:00');
        function updateAge() {
            const now = new Date();
            const diff = now - starterBirth;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById('ageDays').textContent = days;
            document.getElementById('ageHours').textContent = hours;
            document.getElementById('ageMinutes').textContent = minutes;
        }
        updateAge();
        setInterval(updateAge, 60000);

        // Flour burst on scroll
        const burstSection = document.getElementById('flourBurst');
        const burstContainer = document.getElementById('burstContainer');
        let burstFired = false;

        // Create particles
        for (let i = 0; i < 60; i++) {
            const p = document.createElement('div');
            p.className = 'burst-particle';
            const angle = (Math.random() * 360) * (Math.PI / 180);
            const distance = 200 + Math.random() * 400;
            const size = 3 + Math.random() * 8;
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.setProperty('--bx', Math.cos(angle) * distance + 'px');
            p.style.setProperty('--by', Math.sin(angle) * distance + 'px');
            p.style.animationDelay = (Math.random() * 0.3) + 's';
            burstContainer.appendChild(p);
        }

        const burstObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !burstFired) {
                    burstFired = true;
                    burstSection.classList.add('burst-active');
                }
            });
        }, { threshold: 0.5 });

        burstObserver.observe(burstSection);
    </script>

</body>
</html>
