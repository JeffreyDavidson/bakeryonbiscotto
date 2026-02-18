<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto | Handcrafted Sourdough, Davenport FL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
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

        /* ═══════════════════════════════════
           MAIN NAV - Glassmorphism pill bar
        ═══════════════════════════════════ */
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

        /* ═══════════════════════════════════
           HERO - Parallax + floating recipe card
        ═══════════════════════════════════ */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0;
            background: url('/images/hero-banner.jpg') center/cover no-repeat;
            transform: scale(1.1);
            will-change: transform;
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                180deg,
                rgba(61,35,20,0.5) 0%,
                rgba(61,35,20,0.65) 50%,
                rgba(61,35,20,0.88) 100%
            );
        }
        /* Flour particles */
        .flour-particles {
            position: absolute; inset: 0; pointer-events: none; overflow: hidden;
        }
        .flour {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(245,230,208,0.6);
            border-radius: 50%;
            animation: flour-fall linear infinite;
        }
        @keyframes flour-fall {
            0% { transform: translateY(-10px) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 0.6; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
        .hero-content {
            position: relative; z-index: 3;
            max-width: 1200px;
            padding: 120px 40px 80px;
            text-align: center;
        }
        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3.2rem, 7vw, 5.5rem);
            font-weight: 700; color: var(--cream);
            line-height: 1.05; margin-bottom: 24px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }
        .hero-text h1 em {
            font-style: italic; font-weight: 400;
            color: var(--golden);
        }
        .tagline-wrap {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin-bottom: 20px;
        }
        .tagline-flourish {
            color: var(--golden); font-size: 14px; opacity: 0.6;
        }
        .hero-text .tagline {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            color: var(--golden); margin-bottom: 0;
            text-shadow: 0 0 20px rgba(212,165,116,0.5), 0 0 40px rgba(212,165,116,0.2), 0 2px 6px rgba(0,0,0,0.4);
            letter-spacing: 1px;
        }
        .hero-text .hero-desc {
            font-size: 16px; color: rgba(245,230,208,0.85);
            max-width: 560px; line-height: 1.7; margin-bottom: 32px;
            margin-left: auto; margin-right: auto;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }
        .hero-btn {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 36px;
            background: var(--golden); color: var(--dark);
            font-weight: 600; font-size: 15px;
            border-radius: 100px; text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 24px rgba(193,127,78,0.3);
        }
        .hero-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 40px rgba(193,127,78,0.5);
            background: var(--cream);
        }
        .hero-btn svg { transition: transform 0.3s; }
        .hero-btn:hover svg { transform: translateX(4px); }

        /* Floating Recipe Card */
        .recipe-card-float {
            width: 280px;
            background: var(--cream);
            border-radius: 4px;
            padding: 32px 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(139,94,60,0.2);
            transform: rotate(3deg);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            animation: card-float 6s ease-in-out infinite;
        }
        .recipe-card-float:hover { transform: rotate(0deg) scale(1.05); }
        @keyframes card-float {
            0%, 100% { transform: rotate(3deg) translateY(0); }
            50% { transform: rotate(3deg) translateY(-12px); }
        }
        .recipe-card-float::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: repeating-linear-gradient(
                transparent, transparent 27px,
                rgba(139,94,60,0.12) 27px, rgba(139,94,60,0.12) 28px
            );
            pointer-events: none;
        }
        .recipe-card-float::after {
            content: '📌';
            position: absolute; top: -12px; right: 20px; font-size: 24px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }
        .recipe-card-float .recipe-title {
            font-family: 'Dancing Script', cursive;
            font-size: 1.3rem; color: var(--dark);
            margin-bottom: 12px; font-weight: 700;
        }
        .recipe-card-float .recipe-line {
            font-size: 13px; color: var(--brown);
            margin-bottom: 6px; line-height: 1.6;
            font-style: italic;
        }
        .recipe-card-float .recipe-heart {
            text-align: right; font-size: 18px; margin-top: 12px;
        }

        /* Hero entrance animations */
        .hero-enter { opacity: 0; transform: translateY(30px); animation: enter 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .hero-enter-d1 { animation-delay: 0.2s; }
        .hero-enter-d2 { animation-delay: 0.4s; }
        .hero-enter-d3 { animation-delay: 0.6s; }
        .hero-enter-d4 { animation-delay: 0.8s; }
        @keyframes enter { to { opacity: 1; transform: translateY(0); } }

        /* ═══════════════════════════════════
           BOTANICAL DIVIDER
        ═══════════════════════════════════ */
        .divider {
            display: flex; align-items: center; justify-content: center;
            gap: 20px; padding: 40px 20px;
        }
        .divider-line {
            flex: 1; max-width: 180px; height: 2px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .divider-icon { opacity: 0.7; }

        /* ═══════════════════════════════════
           MEET CASSIE - Asymmetric + torn paper
        ═══════════════════════════════════ */
        .about {
            position: relative; overflow: hidden;
            padding: 80px 0;
        }
        /* Torn paper top edge */
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
            /* Kraft paper texture */
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
        /* Photo with handwritten annotation */
        .about-photo-wrap {
            position: relative;
            justify-self: center;
        }
        .about-photo {
            width: 300px; height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 90px;
            box-shadow:
                0 0 0 6px var(--cream),
                0 0 0 8px var(--golden),
                0 20px 60px rgba(61,35,20,0.2);
            position: relative;
            overflow: hidden;
        }
        .about-photo::after {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), transparent 60%);
        }
        /* Handwritten annotation arrow */
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

        /* ═══════════════════════════════════
           SOURDOUGH STARTER JAR - Breathing animation
           (The "trading card" equivalent)
        ═══════════════════════════════════ */
        .starter-showcase {
            padding: 80px 20px;
            background: var(--dark);
            position: relative; overflow: hidden;
        }
        .starter-showcase::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(212,165,116,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        /* Noise overlay */
        .starter-showcase::after {
            content: '';
            position: absolute; inset: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            pointer-events: none;
        }
        .starter-inner {
            position: relative; z-index: 2;
            max-width: 900px; margin: 0 auto;
            display: grid; grid-template-columns: auto 1fr;
            gap: 80px; align-items: center;
        }
        /* The Jar */
        .jar-container {
            position: relative;
            width: 200px; height: 280px;
        }
        .jar {
            position: absolute; bottom: 0;
            width: 160px; height: 220px; left: 20px;
            border: 3px solid rgba(212,165,116,0.4);
            border-radius: 8px 8px 20px 20px;
            background: linear-gradient(180deg, transparent 0%, rgba(212,165,116,0.08) 100%);
            overflow: hidden;
        }
        .jar-lid {
            position: absolute; bottom: 220px; left: 10px;
            width: 180px; height: 30px;
            background: linear-gradient(180deg, rgba(212,165,116,0.6), rgba(193,127,78,0.6));
            border-radius: 6px 6px 2px 2px;
            border: 2px solid rgba(212,165,116,0.4);
        }
        .jar-label {
            position: absolute;
            top: 50%; left: 50%; transform: translate(-50%, -50%);
            font-family: 'Dancing Script', cursive;
            font-size: 20px; color: var(--golden);
            text-align: center; z-index: 3;
            text-shadow: 0 0 20px rgba(212,165,116,0.5);
        }
        .jar-label small {
            display: block; font-family: 'Inter', sans-serif;
            font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
            color: rgba(212,165,116,0.6); margin-top: 4px;
        }
        /* Starter "breathing" inside jar */
        .starter-level {
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 55%;
            background: linear-gradient(
                180deg,
                rgba(212,165,116,0.15) 0%,
                rgba(212,165,116,0.3) 100%
            );
            animation: breathe 4s ease-in-out infinite;
            border-top: 2px solid rgba(212,165,116,0.3);
        }
        @keyframes breathe {
            0%, 100% { height: 55%; }
            50% { height: 65%; }
        }
        /* Bubbles */
        .bubble {
            position: absolute; border-radius: 50%;
            border: 1px solid rgba(212,165,116,0.4);
            animation: bubble-rise linear infinite;
        }
        @keyframes bubble-rise {
            0% { transform: translateY(0) scale(1); opacity: 0.6; }
            100% { transform: translateY(-120px) scale(0.5); opacity: 0; }
        }
        /* Glow behind jar */
        .jar-glow {
            position: absolute;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(212,165,116,0.15), transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse-glow 4s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 1; transform: translate(-50%, -50%) scale(1.15); }
        }
        .starter-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; color: var(--cream);
            margin-bottom: 20px;
        }
        .starter-text p {
            font-size: 15px; line-height: 1.8;
            color: rgba(245,230,208,0.6); margin-bottom: 12px;
        }
        .starter-text .highlight {
            color: var(--golden); font-weight: 500;
        }

        /* ═══════════════════════════════════
           PROCESS - Horizontal timeline
        ═══════════════════════════════════ */
        .process {
            padding: 80px 20px;
            background: var(--light);
        }
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
        .timeline {
            max-width: 1000px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(4, 1fr);
            position: relative;
        }
        /* Connecting line */
        .timeline::before {
            content: '';
            position: absolute;
            top: 40px; left: 12.5%; right: 12.5%;
            height: 2px;
            background: linear-gradient(90deg, var(--golden), var(--accent), var(--golden));
            opacity: 0.3;
        }
        .timeline-step {
            text-align: center; padding: 0 16px;
            position: relative;
        }
        .step-dot {
            width: 80px; height: 80px;
            border-radius: 50%;
            border: 2px solid var(--golden);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
            background: var(--light);
            position: relative; z-index: 2;
            transition: all 0.4s ease;
        }
        .step-dot:hover {
            background: var(--golden);
            box-shadow: 0 0 30px rgba(212,165,116,0.4);
        }
        .step-dot:hover .step-emoji { transform: scale(1.2); }
        .step-emoji {
            font-size: 32px; transition: transform 0.3s;
        }
        .timeline-step h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; color: var(--dark);
            margin-bottom: 8px;
        }
        .timeline-step p {
            font-size: 14px; color: var(--brown);
            line-height: 1.6;
        }

        /* ═══════════════════════════════════
           MENU - Recipe card style
        ═══════════════════════════════════ */
        .menu {
            padding: 80px 20px;
            background: var(--cream);
            position: relative;
        }
        .menu-tabs {
            display: flex; justify-content: center;
            gap: 8px; margin-bottom: 48px;
        }
        .menu-tab {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 500;
            padding: 12px 32px; border-radius: 100px;
            border: 2px solid var(--golden);
            background: transparent; color: var(--brown);
            cursor: pointer; transition: all 0.3s;
        }
        .menu-tab:hover { background: rgba(212,165,116,0.15); }
        .menu-tab.active {
            background: var(--dark); color: var(--cream);
            border-color: var(--dark);
        }
        .menu-grid {
            max-width: 1100px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }
        /* Recipe-style menu card */
        .menu-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(139,94,60,0.1);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }
        .menu-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            opacity: 0;
            transition: opacity 0.3s;
        }
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(61,35,20,0.12);
        }
        .menu-card:hover::before { opacity: 1; }
        .menu-card-img {
            height: 200px;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        .menu-card-img.has-photo { height: 220px; }
        .menu-card-img img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s ease;
        }
        .menu-card:hover .menu-card-img img { transform: scale(1.08); }
        .menu-card-img.placeholder-img {
            background:
                radial-gradient(circle at 30% 70%, rgba(212,165,116,0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(193,127,78,0.15) 0%, transparent 50%),
                linear-gradient(135deg, rgba(212,165,116,0.08), rgba(193,127,78,0.04));
            position: relative;
        }
        .menu-card-img.placeholder-img::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(139,94,60,0.06) 1px, transparent 1px);
            background-size: 16px 16px;
        }
        .menu-card-img .emoji-icon {
            font-size: 56px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .menu-card-body {
            padding: 24px;
        }
        .menu-card-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem; font-weight: 600;
            color: var(--dark); margin-bottom: 8px;
        }
        .menu-card-body .desc {
            font-size: 14px; color: rgba(61,35,20,0.6);
            line-height: 1.6; margin-bottom: 16px;
        }
        .menu-card-footer {
            display: flex; justify-content: space-between; align-items: center;
        }
        .price {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; font-weight: 700; color: var(--accent);
        }
        .price-pill {
            display: inline-block;
            padding: 4px 16px; border-radius: 100px;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark); font-weight: 700; font-size: 15px;
            font-family: 'Inter', sans-serif;
        }
        /* Special deal card */
        .menu-card.special {
            background: linear-gradient(135deg, var(--dark), #4d2e1c);
            border: 1px solid rgba(212,165,116,0.2);
        }
        .menu-card.special .menu-card-body h3 { color: var(--cream); }
        .menu-card.special .desc { color: rgba(245,230,208,0.6); }
        .menu-card.special .price-pill {
            background: var(--golden); color: var(--dark);
        }

        /* ═══════════════════════════════════
           REVIEWS - Polaroid style
        ═══════════════════════════════════ */
        .reviews {
            padding: 80px 20px;
            background: var(--light);
        }
        .reviews-grid {
            max-width: 1200px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        .review-card {
            background: var(--white);
            padding: 36px 28px 28px;
            border-radius: 4px;
            box-shadow: 0 4px 20px rgba(61,35,20,0.06);
            position: relative;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
        }
        .review-card:nth-child(1) { transform: rotate(-1.5deg); }
        .review-card:nth-child(2) { transform: rotate(1deg); }
        .review-card:nth-child(3) { transform: rotate(-0.5deg); }
        .review-card:nth-child(4) { transform: rotate(2deg); }
        .review-card:hover {
            transform: rotate(0deg) translateY(-6px) !important;
            box-shadow: 0 16px 48px rgba(61,35,20,0.12);
        }
        .review-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            border-radius: 4px 4px 0 0;
        }
        .review-stars {
            color: var(--golden); font-size: 14px;
            margin-bottom: 16px; letter-spacing: 2px;
        }
        .review-card blockquote {
            font-size: 15px; line-height: 1.7;
            color: rgba(61,35,20,0.75); font-style: italic;
            margin-bottom: 20px;
        }
        .review-author {
            font-weight: 600; font-size: 14px; color: var(--brown);
            margin-top: auto;
        }
        .review-location {
            font-size: 13px; color: rgba(61,35,20,0.4);
        }
        /* Tape effect */
        .tape {
            position: absolute; top: -8px; left: 50%;
            transform: translateX(-50%) rotate(-2deg);
            width: 80px; height: 24px;
            background: rgba(212,165,116,0.35);
            border-radius: 2px;
        }

        /* ═══════════════════════════════════
           INSTAGRAM GRID
        ═══════════════════════════════════ */
        .insta {
            padding: 80px 20px;
            background: var(--cream);
        }
        .insta-grid {
            max-width: 900px; margin: 0 auto 40px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 180px;
            gap: 8px;
        }
        .insta-item:first-child {
            grid-row: span 2;
        }
        .insta-item {
            border-radius: 12px; overflow: hidden;
            position: relative; cursor: pointer;
            transition: all 0.4s ease;
        }
        .insta-item:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 32px rgba(61,35,20,0.15);
            z-index: 2;
        }
        .insta-item img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .insta-item.placeholder {
            background: linear-gradient(135deg, rgba(212,165,116,0.2), rgba(193,127,78,0.12));
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 8px;
        }
        .insta-item.placeholder .emoji { font-size: 40px; }
        .insta-item.placeholder .label {
            font-size: 12px; color: var(--brown); font-weight: 500;
            letter-spacing: 0.5px;
        }
        .insta-cta {
            text-align: center;
        }
        .insta-cta a {
            font-family: 'Inter', sans-serif;
            font-weight: 600; font-size: 16px;
            color: var(--accent); text-decoration: none;
        }
        .insta-cta a:hover { color: var(--dark); }

        /* ═══════════════════════════════════
           ORDER SECTION - Recipe card motif
        ═══════════════════════════════════ */
        .order {
            padding: 80px 20px;
            background: var(--dark);
            position: relative; overflow: hidden;
        }
        .order::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(212,165,116,0.06) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .order-inner {
            max-width: 900px; margin: 0 auto;
            position: relative; z-index: 2;
        }
        .order-card {
            background: var(--cream);
            border: none;
            border-radius: 4px;
            padding: 60px 48px;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transform: rotate(-0.5deg);
        }
        /* Lined paper effect */
        .order-card::before {
            content: '';
            position: absolute; inset: 0;
            background: repeating-linear-gradient(
                transparent, transparent 31px,
                rgba(139,94,60,0.08) 31px, rgba(139,94,60,0.08) 32px
            );
            pointer-events: none;
        }
        /* Red margin line */
        .order-card::after {
            content: '';
            position: absolute; top: 0; bottom: 0; left: 60px;
            width: 2px;
            background: rgba(200,80,80,0.2);
            pointer-events: none;
        }
        .order-card h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.4rem; color: var(--dark);
            margin-bottom: 12px;
            position: relative; z-index: 2;
        }
        .order-card .sub {
            font-family: 'Inter', sans-serif;
            font-size: 1rem; color: var(--brown);
            margin-bottom: 48px;
            position: relative; z-index: 2;
        }
        .order-steps {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 32px; margin-bottom: 48px;
        }
        .order-step {
            position: relative; padding: 24px 16px;
        }
        /* Connecting arrows between steps */
        .order-step:not(:last-child)::after {
            content: '→';
            position: absolute; right: -20px; top: 40px;
            font-size: 24px; color: var(--golden); opacity: 0.5;
        }
        .order-num {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark);
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 4px 20px rgba(193,127,78,0.3);
        }
        .order-step h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem; color: var(--dark);
            margin-bottom: 8px;
        }
        .order-step p {
            font-size: 14px; color: var(--brown);
            line-height: 1.6;
        }
        .order-btn {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 18px 48px;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--dark); font-weight: 700; font-size: 16px;
            border-radius: 100px; text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 4px 32px rgba(193,127,78,0.35);
        }
        .order-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 48px rgba(193,127,78,0.55);
        }

        /* ═══════════════════════════════════
           FOOTER
        ═══════════════════════════════════ */
        .footer {
            background: var(--dark);
            position: relative; overflow: hidden;
            padding: 0 20px 40px;
            text-align: center;
        }
        .footer-gradient {
            height: 3px;
            background: linear-gradient(90deg, transparent 5%, var(--golden), var(--accent), var(--golden), transparent 95%);
            margin-bottom: 60px;
        }
        .footer h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; color: var(--cream);
            margin-bottom: 8px;
        }
        .footer .tagline {
            font-family: 'Dancing Script', cursive;
            font-size: 1.15rem; color: var(--golden);
            margin-bottom: 24px;
        }
        .footer-badge {
            display: inline-block;
            padding: 10px 28px;
            border: 1.5px solid rgba(212,165,116,0.25);
            border-radius: 100px;
            font-size: 13px; font-weight: 500;
            color: rgba(245,230,208,0.6);
            margin-bottom: 28px;
            letter-spacing: 0.5px;
        }
        .footer-info {
            font-size: 14px; color: rgba(245,230,208,0.4);
            line-height: 2.2;
        }
        .footer-info a {
            color: var(--golden); text-decoration: none;
            transition: color 0.3s;
        }
        .footer-info a:hover { color: var(--cream); }
        .footer-bottom {
            margin-top: 40px; padding-top: 20px;
            border-top: 1px solid rgba(245,230,208,0.06);
            font-size: 12px; color: rgba(245,230,208,0.2);
        }

        /* ═══════════════════════════════════
           INGREDIENTS MARQUEE
        ═══════════════════════════════════ */
        .marquee-section {
            padding: 0;
            background: var(--dark);
            overflow: hidden;
            border-top: 1px solid rgba(212,165,116,0.15);
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .marquee-track {
            display: flex;
            animation: marquee-scroll 30s linear infinite;
            width: max-content;
        }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-content {
            display: flex; align-items: center;
            white-space: nowrap; padding: 16px 0;
        }
        .marquee-item {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 400;
            color: rgba(245,230,208,0.5);
            padding: 0 20px;
            font-style: italic;
        }
        .marquee-dot {
            width: 4px; height: 4px; border-radius: 50%;
            background: var(--golden); opacity: 0.4;
            flex-shrink: 0;
        }
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }

        /* ═══════════════════════════════════
           STATS BAR
        ═══════════════════════════════════ */
        .stats-bar {
            display: flex; justify-content: center; align-items: center;
            gap: 48px; padding: 24px 20px;
            background: var(--cream);
            border-bottom: 1px solid rgba(139,94,60,0.1);
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem; font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }
        .stat-label {
            font-size: 12px; font-weight: 500;
            color: var(--brown); letter-spacing: 1px;
            text-transform: uppercase; margin-top: 2px;
        }
        .stat-divider {
            width: 1px; height: 36px;
            background: rgba(139,94,60,0.2);
        }

        /* ═══════════════════════════════════
           TYPEWRITER
        ═══════════════════════════════════ */
        .typewriter {
            overflow: hidden;
            border-right: 2px solid var(--golden);
            white-space: nowrap;
            width: 0;
            animation: typing 2.5s steps(38, end) 0.5s forwards, blink-caret 0.75s step-end infinite;
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: var(--golden); }
        }

        /* ═══════════════════════════════════
           SPECIAL DEAL RIBBON
        ═══════════════════════════════════ */
        .ribbon-wrap {
            position: absolute; top: 16px; right: -8px; z-index: 3;
        }
        .ribbon {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 11px; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            padding: 6px 16px 6px 12px;
            position: relative;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .ribbon::before {
            content: '';
            position: absolute; left: 0; bottom: -6px;
            border-left: 6px solid transparent;
            border-right: 0px solid transparent;
            border-top: 6px solid #922b21;
        }
        .ribbon::after {
            content: '';
            position: absolute; right: -8px; top: 0;
            border-top: 16px solid #e74c3c;
            border-bottom: 16px solid #e74c3c;
            border-right: 8px solid transparent;
        }

        /* ═══════════════════════════════════
           SCROLL ANIMATIONS
        ═══════════════════════════════════ */
        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1; transform: translateY(0);
        }

        /* ═══════════════════════════════════
           MOBILE
        ═══════════════════════════════════ */
        @media (max-width: 1024px) {
            .hero-content {
                padding: 140px 20px 60px;
            }
            .about-inner {
                grid-template-columns: 1fr;
                gap: 40px; text-align: center;
            }
            .about-text h2::after { margin: 16px auto 0; }
            .starter-inner {
                grid-template-columns: 1fr;
                gap: 40px; text-align: center;
            }
            .jar-container { margin: 0 auto; }
        }
        @media (max-width: 768px) {
            .stats-bar {
                flex-wrap: wrap; gap: 24px;
                padding: 20px;
            }
            .stat-divider { display: none; }
            .stat-item { flex: 0 0 40%; }
            .main-nav {
                top: 38px; padding: 6px 8px; gap: 2px;
            }
            .main-nav a {
                padding: 8px 14px; font-size: 12px;
            }
            .timeline {
                grid-template-columns: repeat(2, 1fr);
                gap: 32px;
            }
            .timeline::before { display: none; }
            .menu-grid { grid-template-columns: 1fr; }
            .reviews-grid { grid-template-columns: repeat(2, 1fr); }
            .review-card { transform: none !important; }
            .order-steps {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .order-step::after { display: none; }
            .insta-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 150px; }
            .insta-item:first-child { grid-row: span 1; }
            .about-photo { width: 220px; height: 220px; font-size: 64px; }
        }
        @media (max-width: 480px) {
            .timeline { grid-template-columns: 1fr; }
            .main-nav {
                left: 10px; right: 10px; transform: none;
                flex-wrap: wrap; justify-content: center;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>

    {{-- Main Nav --}}
    <nav class="main-nav">
        <a href="#home">Home</a>
        <a href="#menu">Menu</a>
        <a href="#about">About</a>
        <a href="#order">Order</a>
        <a href="#contact">Contact</a>
    </nav>

    {{-- ═══ HERO ═══ --}}
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="flour-particles" id="flour-particles"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-enter hero-enter-d1">Bakery on<br><em>Biscotto</em></h1>
                <div class="tagline-wrap hero-enter hero-enter-d2">
                    <span class="tagline-flourish">✦</span>
                    <p class="tagline">Where Sourdough Dreams Come True</p>
                    <span class="tagline-flourish">✦</span>
                </div>
                <p class="hero-desc hero-enter hero-enter-d3">Handcrafted sourdough and baked goods from our cottage kitchen to your table. Every creation starts with care, patience, and our beloved starter.</p>
                <a href="#menu" class="hero-btn hero-enter hero-enter-d4">
                    Explore Our Menu
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ INGREDIENTS MARQUEE ═══ --}}
    <div class="marquee-section">
        <div class="marquee-track">
            <div class="marquee-content">
                <span class="marquee-item">flour</span><span class="marquee-dot"></span>
                <span class="marquee-item">water</span><span class="marquee-dot"></span>
                <span class="marquee-item">salt</span><span class="marquee-dot"></span>
                <span class="marquee-item">time</span><span class="marquee-dot"></span>
                <span class="marquee-item">love</span><span class="marquee-dot"></span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot"></span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot"></span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot"></span>
                <span class="marquee-item">garlic</span><span class="marquee-dot"></span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot"></span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot"></span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot"></span>
                <span class="marquee-item">honey</span><span class="marquee-dot"></span>
                <span class="marquee-item">banana</span><span class="marquee-dot"></span>
                <span class="marquee-item">almonds</span><span class="marquee-dot"></span>
                <span class="marquee-item">patience</span><span class="marquee-dot"></span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot"></span>
                <span class="marquee-item">water</span><span class="marquee-dot"></span>
                <span class="marquee-item">salt</span><span class="marquee-dot"></span>
                <span class="marquee-item">time</span><span class="marquee-dot"></span>
                <span class="marquee-item">love</span><span class="marquee-dot"></span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot"></span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot"></span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot"></span>
                <span class="marquee-item">garlic</span><span class="marquee-dot"></span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot"></span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot"></span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot"></span>
                <span class="marquee-item">honey</span><span class="marquee-dot"></span>
                <span class="marquee-item">banana</span><span class="marquee-dot"></span>
                <span class="marquee-item">almonds</span><span class="marquee-dot"></span>
                <span class="marquee-item">patience</span><span class="marquee-dot"></span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot"></span>
                <span class="marquee-item">water</span><span class="marquee-dot"></span>
                <span class="marquee-item">salt</span><span class="marquee-dot"></span>
                <span class="marquee-item">time</span><span class="marquee-dot"></span>
                <span class="marquee-item">love</span><span class="marquee-dot"></span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot"></span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot"></span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot"></span>
                <span class="marquee-item">garlic</span><span class="marquee-dot"></span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot"></span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot"></span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot"></span>
                <span class="marquee-item">honey</span><span class="marquee-dot"></span>
                <span class="marquee-item">banana</span><span class="marquee-dot"></span>
                <span class="marquee-item">almonds</span><span class="marquee-dot"></span>
                <span class="marquee-item">patience</span><span class="marquee-dot"></span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot"></span>
                <span class="marquee-item">water</span><span class="marquee-dot"></span>
                <span class="marquee-item">salt</span><span class="marquee-dot"></span>
                <span class="marquee-item">time</span><span class="marquee-dot"></span>
                <span class="marquee-item">love</span><span class="marquee-dot"></span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot"></span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot"></span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot"></span>
                <span class="marquee-item">garlic</span><span class="marquee-dot"></span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot"></span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot"></span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot"></span>
                <span class="marquee-item">honey</span><span class="marquee-dot"></span>
                <span class="marquee-item">banana</span><span class="marquee-dot"></span>
                <span class="marquee-item">almonds</span><span class="marquee-dot"></span>
                <span class="marquee-item">patience</span><span class="marquee-dot"></span>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="divider">
        <span class="divider-line"></span>
        <svg class="divider-icon" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M16 2C16 2 17.5 10 16 16C14.5 10 16 2 16 2Z" fill="var(--golden)" opacity="0.6"/>
            <path d="M16 6C16 6 21 11 19.5 17C18 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M16 6C16 6 11 11 12.5 17C14 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <line x1="16" y1="16" x2="16" y2="30" stroke="var(--golden)" stroke-width="1.5" opacity="0.4"/>
        </svg>
        <span class="divider-line"></span>
    </div>

    {{-- ═══ MEET CASSIE ═══ --}}
    <section class="about" id="about">
        <div class="torn-top"></div>
        <div class="about-bg"></div>
        <div class="about-inner">
            <div class="about-photo-wrap reveal">
                <div class="about-photo">👩‍🍳</div>
                <div class="annotation annotation-1">That's me! ↑</div>
            </div>
            <div class="about-text reveal" style="transition-delay: 0.15s;">
                <h2>Meet Cassie</h2>
                <p>Hi! I'm Cassie, and this little bakery is my heart and soul. What started as feeding my family homemade bread has turned into something so much bigger: a way to bring real, handmade bread to our amazing community here in Davenport.</p>
                <p>Every single loaf, muffin, and slice comes from my kitchen. I measure by feel, shape by hand, and bake with the kind of care I'd put into bread for my own family. Because honestly? That's exactly what you are.</p>
                <p>My sourdough starter Biscotto (named after our street!) has been bubbling away for years. It's the secret ingredient in everything we make, and I wouldn't have it any other way.</p>
                <p class="signature">With love and flour dust, Cassie ✨</p>
            </div>
        </div>
        <div class="torn-bottom"></div>
    </section>

    {{-- ═══ PROCESS ═══ --}}
    <section class="process">
        <div class="section-head reveal">
            <h2>Our Process</h2>
            <div class="accent-line"></div>
        </div>
        <div class="timeline">
            <div class="timeline-step reveal">
                <div class="step-dot"><span class="step-emoji">🌾</span></div>
                <h3>Source</h3>
                <p>Quality ingredients, locally when possible</p>
            </div>
            <div class="timeline-step reveal" style="transition-delay: 0.1s;">
                <div class="step-dot"><span class="step-emoji">🤲</span></div>
                <h3>Craft</h3>
                <p>Mixed and shaped by hand with care</p>
            </div>
            <div class="timeline-step reveal" style="transition-delay: 0.2s;">
                <div class="step-dot"><span class="step-emoji">⏳</span></div>
                <h3>Time</h3>
                <p>Slow rise for deep flavor and texture</p>
            </div>
            <div class="timeline-step reveal" style="transition-delay: 0.3s;">
                <div class="step-dot"><span class="step-emoji">🔥</span></div>
                <h3>Bake</h3>
                <p>Fresh from the oven to your table</p>
            </div>
        </div>
    </section>

    {{-- ═══ MENU ═══ --}}
    <section class="menu" id="menu" x-data="{ tab: 'sourdough' }">
        <div class="section-head reveal">
            <h2>What We Bake</h2>
            <div class="accent-line"></div>
        </div>
        <div class="menu-tabs reveal">
            <button class="menu-tab" :class="{ 'active': tab === 'sourdough' }" @click="tab = 'sourdough'">Sourdough Loaves</button>
            <button class="menu-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
        </div>

        <div class="menu-grid" x-show="tab === 'sourdough'" x-transition.opacity.duration.300ms>
            <div class="menu-card reveal">
                <div class="menu-card-img has-photo"><img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf"></div>
                <div class="menu-card-body">
                    <h3>Regular Loaf</h3>
                    <p class="desc">Our signature. Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                    <div class="menu-card-footer"><span class="price">$10</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.06s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🧀</span></div>
                <div class="menu-card-body">
                    <h3>Cheddar</h3>
                    <p class="desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
                    <div class="menu-card-footer"><span class="price">$12</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.12s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🧄</span></div>
                <div class="menu-card-body">
                    <h3>Mozzarella and Garlic</h3>
                    <p class="desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
                    <div class="menu-card-footer"><span class="price">$14</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.18s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍫</span></div>
                <div class="menu-card-body">
                    <h3>Chocolate Chip</h3>
                    <p class="desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
                    <div class="menu-card-footer"><span class="price">$12</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.24s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">✨</span></div>
                <div class="menu-card-body">
                    <h3>Cinnamon and Sugar</h3>
                    <p class="desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
                    <div class="menu-card-footer"><span class="price">$14</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.3s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍫</span></div>
                <div class="menu-card-body">
                    <h3>Chocolate, Chocolate Chip</h3>
                    <p class="desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
                    <div class="menu-card-footer"><span class="price">$12</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.36s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍫</span></div>
                <div class="menu-card-body">
                    <h3>Chocolate Almond, Chocolate Chip</h3>
                    <p class="desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
                    <div class="menu-card-footer"><span class="price">$15</span></div>
                </div>
            </div>
            <div class="menu-card special reveal" style="transition-delay:0.42s; position: relative;">
                <div class="ribbon-wrap"><div class="ribbon">Best Value</div></div>
                <div class="menu-card-img placeholder-img" style="background: linear-gradient(135deg, rgba(212,165,116,0.2), rgba(193,127,78,0.15));"><span class="emoji-icon">🎁</span></div>
                <div class="menu-card-body">
                    <h3>4 Pack of Mini Loaves</h3>
                    <p class="desc">Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</p>
                    <div class="menu-card-footer"><span class="price-pill">$25</span></div>
                </div>
            </div>
        </div>

        <div class="menu-grid" x-show="tab === 'other'" x-transition.opacity.duration.300ms>
            <div class="menu-card reveal">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍯</span></div>
                <div class="menu-card-body">
                    <h3>Sourdough Honey Wheat Sandwich Bread</h3>
                    <p class="desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
                    <div class="menu-card-footer"><span class="price">$10</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.06s;">
                <div class="menu-card-img has-photo"><img src="/images/product-english-muffins.jpg" alt="English Muffins"></div>
                <div class="menu-card-body">
                    <h3>Sourdough English Muffins</h3>
                    <p class="desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
                    <div class="menu-card-footer">
                        <span class="price">6ct · $8</span>
                        <span class="price">12ct · $15</span>
                    </div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.18s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍌</span></div>
                <div class="menu-card-body">
                    <h3>Banana Bread</h3>
                    <p class="desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
                    <div class="menu-card-footer"><span class="price">$12</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.24s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🍌</span></div>
                <div class="menu-card-body">
                    <h3>Banana Walnut Bread</h3>
                    <p class="desc">Our classic banana bread loaded with crunchy toasted walnuts.</p>
                    <div class="menu-card-footer"><span class="price">$15</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.3s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🎃</span></div>
                <div class="menu-card-body">
                    <h3>Pumpkin Chocolate Chip Bread</h3>
                    <p class="desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
                    <div class="menu-card-footer"><span class="price">$12</span></div>
                </div>
            </div>
            <div class="menu-card reveal" style="transition-delay:0.36s;">
                <div class="menu-card-img placeholder-img"><span class="emoji-icon">🎃</span></div>
                <div class="menu-card-body">
                    <h3>Pumpkin Almond Chocolate Chip Bread</h3>
                    <p class="desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
                    <div class="menu-card-footer"><span class="price">$15</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Divider --}}
    <div class="divider">
        <span class="divider-line"></span>
        <svg class="divider-icon" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M16 2C16 2 17.5 10 16 16C14.5 10 16 2 16 2Z" fill="var(--golden)" opacity="0.6"/>
            <path d="M16 6C16 6 21 11 19.5 17C18 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <path d="M16 6C16 6 11 11 12.5 17C14 12 16 6 16 6Z" fill="var(--golden)" opacity="0.4"/>
            <line x1="16" y1="16" x2="16" y2="30" stroke="var(--golden)" stroke-width="1.5" opacity="0.4"/>
        </svg>
        <span class="divider-line"></span>
    </div>

    {{-- ═══ REVIEWS ═══ --}}
    <section class="reviews">
        <div class="section-head reveal">
            <h2>What Our Neighbors Say</h2>
            <div class="accent-line"></div>
        </div>
        <div class="reviews-grid">
            <div class="review-card reveal">
                <div class="tape"></div>
                <div class="review-stars">★★★★★</div>
                <blockquote>The best sourdough I've ever had. The crust is perfectly crispy and the inside is so soft. We order every single week now and my kids fight over the last piece.</blockquote>
                <div class="review-author">Sarah M.</div>
                <div class="review-location">Davenport, FL</div>
            </div>
            <div class="review-card reveal" style="transition-delay: 0.1s;">
                <div class="tape"></div>
                <div class="review-stars">★★★★★</div>
                <blockquote>Cassie's chocolate chip sourdough changed my life. I'm not being dramatic. My family goes through a loaf in a single day and then immediately orders another.</blockquote>
                <div class="review-author">Mike T.</div>
                <div class="review-location">Haines City, FL</div>
            </div>
            <div class="review-card reveal" style="transition-delay: 0.2s;">
                <div class="tape"></div>
                <div class="review-stars">★★★★★</div>
                <blockquote>Finally, real bread from someone who actually cares. You can taste the difference in every bite. The English muffins are out of this world!</blockquote>
                <div class="review-author">Jessica R.</div>
                <div class="review-location">Clermont, FL</div>
            </div>
            <div class="review-card reveal" style="transition-delay: 0.3s;">
                <div class="tape"></div>
                <div class="review-stars">★★★★★</div>
                <blockquote>I ordered the mini loaf variety pack and now I can't pick a favorite. The chocolate chip and cinnamon sugar are tied for first place.</blockquote>
                <div class="review-author">David L.</div>
                <div class="review-location">Kissimmee, FL</div>
            </div>
        </div>
    </section>

    {{-- ═══ INSTAGRAM ═══ --}}
    <section class="insta">
        <div class="section-head reveal">
            <h2>Fresh from the Oven</h2>
            <div class="accent-line"></div>
        </div>
        <div class="insta-grid">
            <div class="insta-item reveal"><img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule"></div>
            <div class="insta-item reveal" style="transition-delay:0.05s;"><img src="/images/product-english-muffins.jpg" alt="English muffins"></div>
            <div class="insta-item placeholder reveal" style="transition-delay:0.1s;"><span class="emoji">🍞</span><span class="label">Bake day</span></div>
            <div class="insta-item placeholder reveal" style="transition-delay:0.15s;"><span class="emoji">🫧</span><span class="label">Biscotto bubbling</span></div>
            <div class="insta-item placeholder reveal" style="transition-delay:0.2s;"><span class="emoji">🤲</span><span class="label">Shaping dough</span></div>
            <div class="insta-item placeholder reveal" style="transition-delay:0.25s;"><span class="emoji">📦</span><span class="label">Ready for pickup</span></div>
        </div>
        <div class="insta-cta reveal">
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Follow @bakeryonbiscotto</a>
        </div>
    </section>

    {{-- ═══ ORDER ═══ --}}
    <section class="order" id="order">
        <div class="order-inner">
            <div class="order-card reveal">
                <h2>Ready to Order?</h2>
                <p class="sub">It's as easy as 1, 2, 3</p>
                <div class="order-steps">
                    <div class="order-step">
                        <div class="order-num">1</div>
                        <h3>Browse</h3>
                        <p>Check out our menu above and pick your favorites</p>
                    </div>
                    <div class="order-step">
                        <div class="order-num">2</div>
                        <h3>Email Us</h3>
                        <p>Send your order and we'll confirm details and timing</p>
                    </div>
                    <div class="order-step">
                        <div class="order-num">3</div>
                        <h3>Enjoy</h3>
                        <p>Pick up your fresh bread or get it delivered locally</p>
                    </div>
                </div>
                <a href="mailto:bakeryonbiscotto@gmail.com?subject=Bread%20Order" class="order-btn">
                    Place Your Order
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="footer" id="contact">
        <div class="footer-gradient"></div>
        <h3>Bakery on Biscotto</h3>
        <p class="tagline">With love and flour dust</p>
        <div class="footer-badge">📍 Davenport, FL &nbsp;·&nbsp; Local Pickup &amp; Delivery Available</div>
        <div class="footer-info">
            <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a><br>
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook</a> &nbsp;·&nbsp;
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram</a> &nbsp;·&nbsp;
            @bakeryonbiscotto
        </div>
        <div class="footer-bottom">&copy; {{ date('Y') }} Bakery on Biscotto. All rights reserved.</div>
    </footer>

    <script>
        // ── Flour particles ──
        (function() {
            const container = document.getElementById('flour-particles');
            for (let i = 0; i < 30; i++) {
                const f = document.createElement('div');
                f.className = 'flour';
                f.style.left = Math.random() * 100 + '%';
                f.style.animationDuration = (6 + Math.random() * 8) + 's';
                f.style.animationDelay = Math.random() * 10 + 's';
                f.style.width = f.style.height = (2 + Math.random() * 4) + 'px';
                f.style.opacity = 0.2 + Math.random() * 0.4;
                container.appendChild(f);
            }
        })();

        // ── Parallax hero ──
        const heroBg = document.querySelector('.hero-bg');
        window.addEventListener('scroll', () => {
            const y = window.pageYOffset;
            if (y < window.innerHeight) {
                heroBg.style.transform = `scale(1.1) translateY(${y * 0.3}px)`;
            }
        }, { passive: true });

        // ── Scroll reveal ──
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
