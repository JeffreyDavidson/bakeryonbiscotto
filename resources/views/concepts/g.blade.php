<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto | Handcrafted Sourdough, Davenport FL</title>
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
           FAQ
        ═══════════════════════════════════ */
        .faq {
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
        .timeline-step p {
            font-size: 14px; color: var(--brown);
            line-height: 1.6;
        }

        /* ═══════════════════════════════════
           FLOUR BURST TRANSITION
        ═══════════════════════════════════ */
        .flour-burst-section {
            padding: 120px 20px;
            background: var(--dark);
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 50vh;
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
            0% { transform: translate(0, 0) scale(1); opacity: 0.8; }
            100% { transform: translate(var(--bx), var(--by)) scale(0); opacity: 0; }
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

        /* ═══════════════════════════════════
           MENU - Baker's Table
        ═══════════════════════════════════ */
        .menu-scene {
            position: relative;
            padding: 100px 20px 120px;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 30%, rgba(139,94,60,0.05) 0%, transparent 40%),
                radial-gradient(ellipse at 80% 70%, rgba(139,94,60,0.04) 0%, transparent 40%),
                linear-gradient(180deg, #1a0f08 0%, #241508 10%, #1e1209 90%, #1a0f08 100%);
            overflow: hidden;
        }
                .menu-scene::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(92deg, transparent, transparent 80px, rgba(139,94,60,0.015) 80px, rgba(139,94,60,0.015) 82px);
            pointer-events: none;
        }
        .menu-candle-glow {
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(244,200,122,0.07) 0%, rgba(212,165,116,0.03) 30%, transparent 70%);
            pointer-events: none;
            z-index: 3;
            transform: translate(-50%, -50%);
            transition: left 0.3s ease-out, top 0.3s ease-out;
            animation: candle-flicker 3s infinite ease-in-out;
        }
        @keyframes candle-flicker {
            0%, 100% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            25% { opacity: 0.85; transform: translate(-50%, -50%) scale(0.97); }
            50% { opacity: 0.95; transform: translate(-50%, -50%) scale(1.02); }
            75% { opacity: 0.88; transform: translate(-50%, -50%) scale(0.99); }
        }
        .menu-flour-dust { position: absolute; inset: 0; pointer-events: none; z-index: 1; overflow: hidden; }
        .menu-flour-particle {
            position: absolute;
            background: rgba(245,230,208,0.12);
            border-radius: 50%;
            animation: menu-flour-drift linear infinite;
        }
        @keyframes menu-flour-drift {
            0% { transform: translateY(100%) translateX(0) rotate(0deg); opacity: 0; }
            5% { opacity: 1; }
            95% { opacity: 0.8; }
            100% { transform: translateY(-5%) translateX(40px) rotate(360deg); opacity: 0; }
        }
        .parchment-wrap {
            position: relative;
            z-index: 2;
            max-width: 780px;
            margin: 0 auto;
            filter: drop-shadow(0 20px 60px rgba(0,0,0,0.5)) drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        .parchment {
            position: relative;
            background: var(--parchment);
            padding: 80px 64px 64px;
            clip-path: polygon(
                0% 0.3%, 2% 0%, 5% 0.5%, 8% 0.1%, 12% 0.6%, 15% 0%, 18% 0.4%,
                22% 0.1%, 25% 0.5%, 30% 0%, 35% 0.3%, 40% 0.1%, 45% 0.5%,
                50% 0%, 55% 0.4%, 60% 0.1%, 65% 0.5%, 70% 0%, 75% 0.3%,
                80% 0.1%, 85% 0.6%, 90% 0%, 93% 0.4%, 96% 0.1%, 100% 0.3%,
                100% 99.7%, 97% 100%, 94% 99.5%, 90% 99.9%, 86% 99.4%,
                82% 100%, 78% 99.6%, 74% 99.9%, 70% 99.5%, 65% 100%,
                60% 99.6%, 55% 100%, 50% 99.7%, 45% 100%, 40% 99.5%,
                35% 100%, 30% 99.7%, 25% 99.9%, 20% 99.5%, 15% 100%,
                10% 99.6%, 5% 100%, 2% 99.7%, 0% 100%
            );
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='5' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            background-color: var(--parchment);
        }
        .parchment::before {
            content: '';
            position: absolute; inset: 0;
            box-shadow: inset 12px 0 30px rgba(139,94,60,0.1), inset -12px 0 30px rgba(139,94,60,0.1), inset 0 12px 30px rgba(139,94,60,0.08), inset 0 -12px 30px rgba(139,94,60,0.08);
            pointer-events: none;
        }
        .parchment::after {
            content: '';
            position: absolute;
            top: -40px; left: 50%; transform: translateX(-50%);
            width: 300px; height: 200px;
            background: radial-gradient(ellipse, rgba(244,200,122,0.06), transparent 70%);
            pointer-events: none;
            animation: candle-flicker 4s infinite ease-in-out;
        }
        .menu-title {
            text-align: center;
            margin-bottom: 8px;
            position: relative;
        }
        .menu-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3.2rem, 8vw, 5rem);
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
        }
        .title-flourish {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin: 24px 0 8px;
        }
        .tf-line {
            width: 100px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--brown), transparent);
        }
        .menu-epigraph {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-weight: 300;
            font-size: 18px;
            color: var(--warm);
            margin-bottom: 48px;
            letter-spacing: 0.5px;
        }
        .scroll-tabs {
            display: flex; justify-content: center;
            gap: 32px; margin-bottom: 52px;
        }
        .scroll-tab {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 500;
            padding: 10px 0;
            border: none; background: transparent;
            color: var(--brown);
            cursor: pointer; transition: all 0.4s;
            position: relative;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .scroll-tab::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-tab:hover { color: var(--dark); }
        .scroll-tab.active { color: var(--ink); font-weight: 700; }
        .scroll-tab.active::before { transform: scaleX(1); }
        .scroll-tab.active::after {
            content: '';
            position: absolute;
            bottom: -5px; left: 50%; transform: translateX(-50%);
            width: 8px; height: 8px;
            background: radial-gradient(circle, var(--accent), #a0623a);
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(193,127,78,0.4);
        }
        .menu-item {
            padding: 28px 0;
            position: relative;
        }
        .menu-item + .menu-item {
            border-top: 1px solid rgba(139,94,60,0.06);
        }
        .menu-item::after {
            content: '';
            position: absolute;
            inset: -4px -20px;
            background: radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
            border-radius: 8px;
        }
        .menu-item:hover::after { opacity: 1; }
        .menu-item:hover { z-index: 2; }
        .menu-item-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }
        .menu-item-name {
            font-family: 'Dancing Script', cursive;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--ink);
            white-space: nowrap;
            position: relative;
        }
        .menu-item-name::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            border-radius: 2px;
            clip-path: polygon(
                0% 60%, 5% 20%, 10% 70%, 15% 30%, 20% 80%, 25% 20%,
                30% 60%, 35% 10%, 40% 70%, 45% 40%, 50% 80%, 55% 20%,
                60% 60%, 65% 30%, 70% 70%, 75% 10%, 80% 60%, 85% 40%,
                90% 80%, 95% 30%, 100% 50%, 100% 100%, 0% 100%
            );
        }
        .menu-item:hover .menu-item-name::after { transform: scaleX(1); }
        .menu-item-dots {
            flex: 1; min-width: 20px;
            border-bottom: 2px dotted rgba(139,94,60,0.12);
            align-self: baseline;
            position: relative; top: -5px;
        }
        .menu-item-price {
            position: relative;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent);
            white-space: nowrap;
            z-index: 1;
        }
        .menu-item-price::before {
            content: '';
            position: absolute;
            inset: -6px -14px;
            border: 1.5px solid rgba(193,127,78,0.25);
            border-radius: 50%;
            clip-path: ellipse(52% 58% at 48% 50%);
            transition: border-color 0.3s, background 0.3s;
        }
        .menu-item:hover .menu-item-price::before {
            border-color: rgba(193,127,78,0.5);
            background: rgba(193,127,78,0.04);
        }
        .menu-item-desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15.5px;
            color: var(--warm);
            line-height: 1.6;
            margin-top: 8px;
            padding-right: 40px;
        }
        .signature-item {
            position: relative;
            margin: 0 -34px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border-radius: 3px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12), 0 0 0 1px rgba(139,94,60,0.1);
        }
        .signature-photo {
            min-height: 280px; overflow: hidden; position: relative;
        }
        .signature-photo img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 8s ease;
        }
        .signature-item:hover .signature-photo img { transform: scale(1.1); }
        .steam-wrap {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 120px;
            pointer-events: none;
            overflow: hidden;
        }
        .steam {
            position: absolute;
            bottom: 0;
            width: 40px;
            background: linear-gradient(180deg, transparent 0%, rgba(245,230,208,0.08) 20%, rgba(245,230,208,0.12) 40%, rgba(245,230,208,0.06) 70%, transparent 100%);
            border-radius: 50%;
            filter: blur(8px);
            animation: steam-rise linear infinite;
        }
        .steam:nth-child(1) { left: 25%; height: 80px; animation-duration: 3.5s; animation-delay: 0s; }
        .steam:nth-child(2) { left: 45%; height: 100px; animation-duration: 4s; animation-delay: 0.8s; }
        .steam:nth-child(3) { left: 65%; height: 70px; animation-duration: 3s; animation-delay: 1.5s; }
        .steam:nth-child(4) { left: 35%; height: 90px; animation-duration: 4.5s; animation-delay: 2.2s; }
        @keyframes steam-rise {
            0% { transform: translateY(0) scaleX(1); opacity: 0; }
            15% { opacity: 1; }
            50% { transform: translateY(-60px) scaleX(1.5); opacity: 0.6; }
            100% { transform: translateY(-120px) scaleX(2); opacity: 0; }
        }
        .signature-body {
            background: var(--dark);
            padding: 40px;
            display: flex; flex-direction: column; justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .signature-body::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(244,200,122,0.06), transparent 60%), radial-gradient(circle at 20% 80%, rgba(139,94,60,0.04), transparent 50%);
        }
        .signature-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: var(--golden);
            margin-bottom: 14px;
            position: relative;
        }
        .signature-body h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 12px;
            position: relative;
        }
        .signature-body .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(245,230,208,0.5);
            line-height: 1.7;
            margin-bottom: 24px;
            position: relative;
        }
        .signature-price-wrap {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .signature-price {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--golden);
            position: relative;
            text-shadow: 0 0 30px rgba(212,165,116,0.3);
        }
        .signature-price-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, var(--golden), transparent);
            opacity: 0.3;
        }
        .bundle-callout {
            margin: 48px -34px 8px;
            padding: 0;
            position: relative;
            background: linear-gradient(135deg, var(--dark) 0%, #4a2a18 100%);
            overflow: hidden;
            border-radius: 3px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15), 0 0 0 1px rgba(212,165,116,0.15);
        }
        .bundle-callout::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 0% 50%, rgba(244,200,122,0.1), transparent 60%), radial-gradient(ellipse at 100% 50%, rgba(212,165,116,0.06), transparent 50%);
            pointer-events: none;
        }
        .bundle-inner {
            display: flex;
            align-items: center;
            padding: 40px 48px;
            gap: 32px;
            position: relative;
        }
        .bundle-emoji {
            font-size: 56px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
            flex-shrink: 0;
        }
        .bundle-text { flex: 1; }
        .bundle-callout h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 8px;
        }
        .bundle-callout .desc {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(245,230,208,0.5);
        }
        .bundle-price-tag {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 35%, var(--golden), var(--accent));
            box-shadow: 0 4px 20px rgba(212,165,116,0.4), 0 0 40px rgba(212,165,116,0.15);
            position: relative;
        }
        .bundle-price-tag::before {
            content: '';
            position: absolute;
            inset: 4px;
            border: 1.5px solid rgba(255,255,255,0.2);
            border-radius: 50%;
        }
        .bundle-price-tag .amount {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }
        .bundle-price-tag .label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(61,35,20,0.6);
            margin-top: 2px;
        }
        .bundle-ribbon {
            position: absolute;
            top: 16px; right: -32px;
            background: var(--golden);
            color: var(--dark);
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 6px 40px;
            transform: rotate(45deg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .margin-note {
            position: absolute;
            font-family: 'Dancing Script', cursive;
            font-size: 13px;
            color: rgba(193,127,78,0.2);
            pointer-events: none;
            white-space: nowrap;
        }
        .menu-deco-wheat {
            position: absolute;
            z-index: 1;
            opacity: 0.04;
            pointer-events: none;
        }
        @media (max-width: 768px) {
            .parchment { padding: 60px 36px 48px; }
            .signature-item { grid-template-columns: 1fr; margin: 0 -20px; }
            .signature-photo { height: 220px; min-height: 220px; }
            .signature-body { padding: 32px; }
            .menu-item-desc { padding-right: 0; }
            .margin-note { display: none; }
            .bundle-callout { margin: 40px -20px 8px; }
            .bundle-inner { padding: 28px 24px; flex-wrap: wrap; justify-content: center; text-align: center; }
            .bundle-ribbon { display: none; }
        }
        @media (max-width: 480px) {
            .parchment { padding: 48px 24px 40px; }
            .menu-item-name { font-size: 1.35rem; white-space: normal; }
            .menu-item-row { flex-wrap: wrap; }
            .menu-item-dots { display: none; }
            .menu-item-price { margin-left: auto; }
            .scroll-tab { font-size: 14px; letter-spacing: 1px; gap: 16px; }
        }

        /* ═══════════════════════════════════
           REVIEWS - Conversation style
        ═══════════════════════════════════ */
        .reviews {
            padding: 100px 20px;
            position: relative;
            background: var(--cream);
            overflow: hidden;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.02'/%3E%3C/svg%3E");
            background-color: var(--cream);
        }
        .reviews::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(212,165,116,0.08), transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(193,127,78,0.06), transparent 50%);
            pointer-events: none;
        }
        .reviews .section-head h2 {
            font-family: 'Dancing Script', cursive;
            color: var(--dark);
            font-size: clamp(2.8rem, 6vw, 4rem);
            font-weight: 700;
        }
        .reviews .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), var(--accent), var(--golden), transparent);
            width: 120px;
        }
        .reviews-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: var(--warm);
            margin-top: -32px;
            margin-bottom: 56px;
        }
        .review-featured {
            max-width: 800px;
            margin: 0 auto 64px;
            text-align: center;
            position: relative;
            padding: 48px 40px;
        }
        .review-featured::before {
            content: '\201C';
            position: absolute;
            top: -20px; left: 50%; transform: translateX(-50%);
            font-family: 'Playfair Display', serif;
            font-size: 120px;
            color: var(--golden);
            opacity: 0.15;
            line-height: 1;
            pointer-events: none;
        }
        .review-featured blockquote {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.4rem, 3vw, 1.8rem);
            font-weight: 400;
            font-style: italic;
            color: var(--dark);
            line-height: 1.8;
            margin-bottom: 24px;
            position: relative;
        }
        .review-featured .review-author-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .review-featured .author-line {
            width: 40px; height: 1px;
            background: var(--golden);
        }
        .review-featured .review-author {
            font-family: 'Playfair Display', serif;
            font-weight: 600; font-size: 16px;
            color: var(--accent); letter-spacing: 1px;
        }
        .review-featured .review-location {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px; color: var(--warm);
        }
        .reviews-conversation {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        .convo-card {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .convo-card.from-right {
            flex-direction: row-reverse;
            text-align: right;
        }
        .convo-avatar {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
            font-size: 20px; font-weight: 700;
            color: var(--dark);
            box-shadow: 0 4px 12px rgba(61,35,20,0.1);
            position: relative;
        }
        .convo-avatar::after {
            content: '';
            position: absolute; inset: -3px;
            border: 2px solid var(--golden);
            border-radius: 50%; opacity: 0.3;
        }
        .convo-bubble {
            background: var(--white);
            padding: 24px 28px;
            border-radius: 20px;
            position: relative;
            box-shadow: 0 4px 20px rgba(61,35,20,0.06), 0 1px 3px rgba(61,35,20,0.04);
            flex: 1;
            transition: all 0.3s;
        }
        .convo-bubble:hover {
            box-shadow: 0 8px 30px rgba(61,35,20,0.1), 0 1px 3px rgba(61,35,20,0.04);
            transform: translateY(-2px);
        }
        .convo-card:not(.from-right) .convo-bubble::before {
            content: '';
            position: absolute;
            left: -8px; top: 20px;
            width: 16px; height: 16px;
            background: var(--white);
            transform: rotate(45deg);
            box-shadow: -2px 2px 4px rgba(61,35,20,0.04);
        }
        .convo-card.from-right .convo-bubble::before {
            content: '';
            position: absolute;
            right: -8px; top: 20px;
            width: 16px; height: 16px;
            background: var(--white);
            transform: rotate(45deg);
            box-shadow: 2px -2px 4px rgba(61,35,20,0.04);
        }
        .convo-bubble .review-stars {
            color: var(--golden); font-size: 12px;
            letter-spacing: 2px; margin-bottom: 10px;
        }
        .convo-bubble blockquote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-style: italic;
            line-height: 1.7; color: var(--dark);
            margin-bottom: 12px;
        }
        .convo-meta {
            display: flex; align-items: center; gap: 8px;
        }
        .convo-card.from-right .convo-meta { justify-content: flex-end; }
        .convo-meta .review-author {
            font-family: 'Playfair Display', serif;
            font-weight: 600; font-size: 13px; color: var(--accent);
        }
        .convo-meta .dot {
            width: 3px; height: 3px;
            background: var(--golden); border-radius: 50%;
        }
        .convo-meta .review-location {
            font-size: 12px; color: var(--warm);
        }
        @media (max-width: 600px) {
            .review-featured { padding: 32px 16px; }
            .convo-card, .convo-card.from-right { flex-direction: column; text-align: left; }
            .convo-card.from-right .convo-meta { justify-content: flex-start; }
            .convo-bubble::before { display: none !important; }
            .convo-avatar { width: 44px; height: 44px; font-size: 16px; }
        }

        /* ═══════════════════════════════════
           FRESH FROM THE OVEN - Clothesline
        ═══════════════════════════════════ */
        .fresh-oven {
            padding: 100px 20px 80px;
            position: relative;
            background: var(--dark);
            overflow: hidden;
        }
        .fresh-oven::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 30% 20%, rgba(244,200,122,0.06), transparent 50%),
                radial-gradient(ellipse at 70% 80%, rgba(139,94,60,0.05), transparent 40%);
            pointer-events: none;
        }
        .fresh-oven .section-head h2 {
            font-family: 'Dancing Script', cursive;
            color: var(--cream);
            font-size: clamp(2.8rem, 6vw, 4rem);
            font-weight: 700;
        }
        .fresh-oven .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
            width: 120px;
        }
        .fresh-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: rgba(245,230,208,0.4);
            margin-top: -32px;
            margin-bottom: 64px;
        }

        /* The clothesline */
        .clothesline-wrap {
            max-width: 1000px;
            margin: 0 auto 56px;
            position: relative;
        }
        /* The string */
        .clothesline-string {
            position: absolute;
            top: 20px;
            left: -20px; right: -20px;
            height: 2px;
            background: linear-gradient(90deg,
                transparent,
                rgba(212,165,116,0.25) 10%,
                rgba(212,165,116,0.35) 50%,
                rgba(212,165,116,0.25) 90%,
                transparent
            );
            z-index: 1;
        }
        /* Slight sag with SVG */
        .clothesline-string::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 40px;
            background: radial-gradient(ellipse at 50% 0%, rgba(212,165,116,0.03), transparent 70%);
        }

        .clothesline-photos {
            display: flex;
            justify-content: center;
            gap: 24px;
            padding-top: 32px;
            position: relative;
            z-index: 2;
        }

        /* Each hanging photo */
        .hanging-photo {
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            transform-origin: top center;
        }
        .hanging-photo:hover {
            z-index: 10;
        }

        /* The pin/clip at top */
        .photo-clip {
            position: absolute;
            top: -14px; left: 50%; transform: translateX(-50%);
            z-index: 3;
            width: 20px; height: 28px;
        }
        .photo-clip::before {
            content: '';
            position: absolute;
            top: 0; left: 50%; transform: translateX(-50%);
            width: 12px; height: 20px;
            background: linear-gradient(180deg, #c9a87c, #a88654);
            border-radius: 3px 3px 1px 1px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .photo-clip::after {
            content: '';
            position: absolute;
            top: 14px; left: 50%; transform: translateX(-50%);
            width: 16px; height: 8px;
            background: linear-gradient(180deg, #a88654, #8b6d3f);
            border-radius: 0 0 2px 2px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Polaroid frame */
        .photo-frame {
            background: white;
            padding: 10px 10px 40px;
            box-shadow:
                0 8px 30px rgba(0,0,0,0.25),
                2px 2px 0 rgba(139,94,60,0.03);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .hanging-photo:hover .photo-frame {
            box-shadow:
                0 16px 50px rgba(0,0,0,0.35),
                0 0 30px rgba(212,165,116,0.08);
            transform: scale(1.08) rotate(0deg) !important;
        }
        .photo-frame img {
            width: 100%; height: 100%; object-fit: cover;
            display: block;
        }
        .photo-frame .placeholder-slot {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 8px;
            background:
                radial-gradient(circle at 50% 40%, rgba(212,165,116,0.06), transparent 60%),
                #f8f0e4;
        }
        .photo-frame .placeholder-slot .ph-emoji {
            font-size: 40px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        .photo-frame .placeholder-slot .ph-text {
            font-family: 'Dancing Script', cursive;
            font-size: 13px;
            color: var(--brown);
            opacity: 0.5;
        }

        /* Handwritten caption below photo */
        .photo-caption {
            position: absolute;
            bottom: 8px; left: 10px; right: 10px;
            text-align: center;
            font-family: 'Dancing Script', cursive;
            font-size: 13px;
            color: var(--warm);
        }

        /* Individual photo sizes and rotations */
        .hanging-photo:nth-child(1) { margin-top: 12px; }
        .hanging-photo:nth-child(1) .photo-frame { transform: rotate(-3deg); width: 200px; }
        .hanging-photo:nth-child(1) .photo-frame img,
        .hanging-photo:nth-child(1) .photo-frame .placeholder-slot { height: 200px; }

        .hanging-photo:nth-child(2) { margin-top: 0; }
        .hanging-photo:nth-child(2) .photo-frame { transform: rotate(2deg); width: 220px; }
        .hanging-photo:nth-child(2) .photo-frame img,
        .hanging-photo:nth-child(2) .photo-frame .placeholder-slot { height: 260px; }

        .hanging-photo:nth-child(3) { margin-top: 8px; }
        .hanging-photo:nth-child(3) .photo-frame { transform: rotate(-1.5deg); width: 200px; }
        .hanging-photo:nth-child(3) .photo-frame img,
        .hanging-photo:nth-child(3) .photo-frame .placeholder-slot { height: 220px; }

        .hanging-photo:nth-child(4) { margin-top: 16px; }
        .hanging-photo:nth-child(4) .photo-frame { transform: rotate(3.5deg); width: 180px; }
        .hanging-photo:nth-child(4) .photo-frame img,
        .hanging-photo:nth-child(4) .photo-frame .placeholder-slot { height: 180px; }

        .hanging-photo:nth-child(5) { margin-top: 4px; }
        .hanging-photo:nth-child(5) .photo-frame { transform: rotate(-2.5deg); width: 200px; }
        .hanging-photo:nth-child(5) .photo-frame img,
        .hanging-photo:nth-child(5) .photo-frame .placeholder-slot { height: 240px; }

        /* CTA */
        .fresh-cta {
            text-align: center;
            position: relative;
        }
        .fresh-cta a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 600;
            color: var(--golden);
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 14px 36px;
            border: 1.5px solid rgba(212,165,116,0.3);
            border-radius: 100px;
            transition: all 0.3s;
        }
        .fresh-cta a:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
            box-shadow: 0 0 30px rgba(212,165,116,0.1);
        }
        .fresh-cta a svg {
            width: 18px; height: 18px;
            fill: var(--golden);
        }

        @media (max-width: 768px) {
            .clothesline-photos {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                justify-content: flex-start;
                padding-left: 20px;
                padding-right: 20px;
                margin-left: -20px;
                margin-right: -20px;
                scroll-snap-type: x mandatory;
            }
            .hanging-photo { scroll-snap-align: center; flex-shrink: 0; }
            .hanging-photo:nth-child(1) .photo-frame,
            .hanging-photo:nth-child(2) .photo-frame,
            .hanging-photo:nth-child(3) .photo-frame,
            .hanging-photo:nth-child(4) .photo-frame,
            .hanging-photo:nth-child(5) .photo-frame { width: 180px; }
            .hanging-photo:nth-child(1) .photo-frame img, .hanging-photo:nth-child(1) .photo-frame .placeholder-slot,
            .hanging-photo:nth-child(2) .photo-frame img, .hanging-photo:nth-child(2) .photo-frame .placeholder-slot,
            .hanging-photo:nth-child(3) .photo-frame img, .hanging-photo:nth-child(3) .photo-frame .placeholder-slot,
            .hanging-photo:nth-child(4) .photo-frame img, .hanging-photo:nth-child(4) .photo-frame .placeholder-slot,
            .hanging-photo:nth-child(5) .photo-frame img, .hanging-photo:nth-child(5) .photo-frame .placeholder-slot { height: 200px; }
        }

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
            color: var(--golden); opacity: 0.5;
            flex-shrink: 0;
            font-size: 10px;
            line-height: 1;
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
                <span class="marquee-item">flour</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">water</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">salt</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">time</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">love</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">garlic</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">honey</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">banana</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">almonds</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">patience</span><span class="marquee-dot">✦</span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">water</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">salt</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">time</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">love</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">garlic</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">honey</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">banana</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">almonds</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">patience</span><span class="marquee-dot">✦</span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">water</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">salt</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">time</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">love</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">garlic</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">honey</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">banana</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">almonds</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">patience</span><span class="marquee-dot">✦</span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">flour</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">water</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">salt</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">time</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">love</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cheddar</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">cinnamon</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">chocolate</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">garlic</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">mozzarella</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">pumpkin</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">walnuts</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">honey</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">banana</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">almonds</span><span class="marquee-dot">✦</span>
                <span class="marquee-item">patience</span><span class="marquee-dot">✦</span>
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
                <p>I've always loved being in the kitchen, but bread changed everything. It started simple: I wanted my family to have bread without all the processed ingredients and preservatives. I began with yeast bread, then curiosity took over. I started experimenting, tweaking, trying new things, and that's when sourdough found me.</p>
                <p>My approach isn't complicated, and I like it that way. Good ingredients, good technique, something genuinely good to eat. No fuss.</p>
                <p>What started as care packages for friends turned into something bigger. People kept asking for more, and eventually the question became: could this be a business? Turns out, yes.</p>
                <p>I bake everything in the same kitchen where I cook dinner for my husband and daughter. Nothing leaves this house that I wouldn't put on our own table. I have a background in music and a love for the arts, and I bring that same creativity to every loaf I shape. Baking is my art form, and every piece is made by hand, with care.</p>
                <p class="signature">With love and flour dust, Cassie ✨</p>
            </div>
        </div>
        <div class="torn-bottom"></div>
    </section>

    {{-- ═══ FLOUR BURST TRANSITION ═══ --}}
    <section class="flour-burst-section" id="flourBurst">
        <div class="burst-container" id="burstContainer"></div>
        <div class="burst-text">
            <h3>Every Loaf, a Little Different</h3>
            <p>That's the beauty of sourdough. Same love, same care, same starter — but each one is uniquely yours.</p>
        </div>
    </section>

    {{-- ═══ MENU ═══ --}}
    <section class="menu-scene" id="menu">
        {{-- Flour particles --}}
        <div class="menu-flour-dust">
            @for ($i = 0; $i < 25; $i++)
            <div class="menu-flour-particle" style="
                left: {{ rand(0, 100) }}%;
                width: {{ rand(2, 4) }}px;
                height: {{ rand(2, 4) }}px;
                animation-duration: {{ rand(18, 35) }}s;
                animation-delay: {{ $i * 0.9 }}s;
            "></div>
            @endfor
        </div>

        {{-- Decorative wheat --}}
        <svg class="menu-deco-wheat" style="top: 150px; left: 20px; transform: rotate(-25deg);" width="180" height="360" viewBox="0 0 180 360" fill="none">
            <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
            <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
            <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
            <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
            <ellipse cx="102" cy="170" rx="18" ry="32" fill="var(--golden)" transform="rotate(25 102 170)"/>
        </svg>
        <svg class="menu-deco-wheat" style="top: 500px; right: 30px; transform: rotate(20deg) scaleX(-1);" width="160" height="320" viewBox="0 0 180 360" fill="none">
            <path d="M90 360C90 360 90 180 90 0" stroke="var(--golden)" stroke-width="1.5"/>
            <ellipse cx="76" cy="50" rx="22" ry="38" fill="var(--golden)" transform="rotate(-30 76 50)"/>
            <ellipse cx="104" cy="90" rx="22" ry="38" fill="var(--golden)" transform="rotate(30 104 90)"/>
            <ellipse cx="78" cy="130" rx="18" ry="32" fill="var(--golden)" transform="rotate(-25 78 130)"/>
        </svg>

        {{-- Candle glow --}}
        <div class="menu-candle-glow" id="menuCandleGlow"></div>

        <div class="parchment-wrap">
        <div class="parchment" x-data="{ tab: 'loaves' }">

            {{-- Margin notes --}}
            <span class="margin-note" style="top: 380px; left: 8px; transform: rotate(-7deg);">our favorite ♡</span>
            <span class="margin-note" style="top: 780px; right: 12px; transform: rotate(4deg);">so good!</span>
            <span class="margin-note" style="top: 1050px; left: 10px; transform: rotate(-3deg);">try this →</span>

            {{-- Title --}}
            <div class="menu-title reveal">
                <h2>Our Menu</h2>
                <div class="title-flourish">
                    <span class="tf-line"></span>
                    <span class="tf-line"></span>
                </div>
            </div>
            <p class="menu-epigraph reveal">Everything baked fresh to order. Never frozen, never rushed.</p>

            {{-- Tabs --}}
            <div class="scroll-tabs reveal">
                <button class="scroll-tab" :class="{ 'active': tab === 'loaves' }" @click="tab = 'loaves'">Sourdough Loaves</button>
                <button class="scroll-tab" :class="{ 'active': tab === 'breads' }" @click="tab = 'breads'">Sourdough Breads</button>
                <button class="scroll-tab" :class="{ 'active': tab === 'other' }" @click="tab = 'other'">Other Breads</button>
            </div>

            {{-- ═══ SOURDOUGH LOAVES ═══ --}}
            <div x-show="tab === 'loaves'" x-transition.opacity.duration.400ms>
                <div class="signature-item reveal">
                    <div class="signature-photo">
                        <img src="/images/product-sourdough-boule.jpg" alt="Regular Sourdough Loaf">
                        <div class="steam-wrap">
                            <div class="steam"></div><div class="steam"></div><div class="steam"></div><div class="steam"></div>
                        </div>
                    </div>
                    <div class="signature-body">
                        <span class="signature-label">✦ Our Signature</span>
                        <h3>Regular Loaf</h3>
                        <p class="desc">Golden crust, airy crumb, perfectly tangy. The one that started it all.</p>
                        <div class="signature-price-wrap">
                            <span class="signature-price">$10</span>
                            <span class="signature-price-line"></span>
                        </div>
                    </div>
                </div>

                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Cheddar</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$12</span>
                    </div>
                    <p class="menu-item-desc">Sharp cheddar folded through tangy sourdough. Melty pockets in every slice.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Mozzarella & Garlic</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$14</span>
                    </div>
                    <p class="menu-item-desc">Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Chocolate Chip</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$12</span>
                    </div>
                    <p class="menu-item-desc">Rich chocolate meets tangy sourdough. Sweet and sour perfection.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Cinnamon & Sugar</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$14</span>
                    </div>
                    <p class="menu-item-desc">Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Chocolate, Chocolate Chip</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$12</span>
                    </div>
                    <p class="menu-item-desc">Cocoa in the dough, chips throughout. For the true chocolate lovers.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Chocolate Almond, Chocolate Chip</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$15</span>
                    </div>
                    <p class="menu-item-desc">Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.</p>
                </div>

                <div class="bundle-callout reveal">
                    <span class="bundle-ribbon">Best Deal</span>
                    <div class="bundle-inner">
                        <span class="bundle-emoji">🎁</span>
                        <div class="bundle-text">
                            <h3>4 Pack of Mini Loaves</h3>
                            <p class="desc">Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves.</p>
                        </div>
                        <div class="bundle-price-tag">
                            <span class="amount">$25</span>
                            <span class="label">bundle</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══ SOURDOUGH BREADS ═══ --}}
            <div x-show="tab === 'breads'" x-transition.opacity.duration.400ms>
                <div class="signature-item reveal">
                    <div class="signature-photo">
                        <img src="/images/product-english-muffins.jpg" alt="Sourdough English Muffins">
                        <div class="steam-wrap">
                            <div class="steam"></div><div class="steam"></div><div class="steam"></div><div class="steam"></div>
                        </div>
                    </div>
                    <div class="signature-body">
                        <span class="signature-label">✦ Fan Favorite</span>
                        <h3>Sourdough English Muffins</h3>
                        <p class="desc">Those perfect nooks and crannies. Griddle-cooked and ready for toasting.</p>
                        <div class="signature-price-wrap">
                            <span class="signature-price">6ct · $8 | 12ct · $15</span>
                            <span class="signature-price-line"></span>
                        </div>
                    </div>
                </div>

                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Sourdough Honey Wheat Sandwich Bread</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$10</span>
                    </div>
                    <p class="menu-item-desc">Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.</p>
                </div>
            </div>

            {{-- ═══ OTHER BREADS ═══ --}}
            <div x-show="tab === 'other'" x-transition.opacity.duration.400ms>
                <div class="signature-item reveal">
                    <div class="signature-photo">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin Almond Chocolate Chip Bread">
                        <div class="steam-wrap">
                            <div class="steam"></div><div class="steam"></div><div class="steam"></div><div class="steam"></div>
                        </div>
                    </div>
                    <div class="signature-body">
                        <span class="signature-label">✦ Fall Favorite</span>
                        <h3>Pumpkin Almond Chocolate Chip</h3>
                        <p class="desc">Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.</p>
                        <div class="signature-price-wrap">
                            <span class="signature-price">$15</span>
                            <span class="signature-price-line"></span>
                        </div>
                    </div>
                </div>

                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Banana Bread</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$12</span>
                    </div>
                    <p class="menu-item-desc">Moist, sweet, perfectly spiced. Made with bananas so ripe they're basically pudding.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Banana Walnut Bread</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$15</span>
                    </div>
                    <p class="menu-item-desc">Our classic banana bread loaded with crunchy toasted walnuts.</p>
                </div>
                <div class="menu-item reveal">
                    <div class="menu-item-row">
                        <span class="menu-item-name">Pumpkin Chocolate Chip Bread</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$12</span>
                    </div>
                    <p class="menu-item-desc">Warm pumpkin spice studded with chocolate chips. Seasonal magic.</p>
                </div>
            </div>

        </div>{{-- /parchment --}}
        </div>{{-- /parchment-wrap --}}
    </section>

    {{-- ═══ PROCESS ═══ --}}
    <section class="faq" id="faq" x-data="{ open: null }">
        <div class="section-head reveal">
            <h2>Frequently Asked Questions</h2>
            <div class="accent-line"></div>
        </div>
        <div class="faq-list reveal">
            <div class="faq-item" :class="{ 'open': open === 1 }">
                <button class="faq-question" @click="open = open === 1 ? null : 1">How do I order?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>Send us an email at <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a> with what you'd like and we'll work out timing and logistics together.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 2 }">
                <button class="faq-question" @click="open = open === 2 ? null : 2">How far in advance should I order?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>At least 2 days. Sourdough is a slow process. A basic loaf takes a minimum of 24 hours from feeding the starter to pulling it out of the oven. Every order is baked fresh, never in advance.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 3 }">
                <button class="faq-question" @click="open = open === 3 ? null : 3">Do you deliver?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>Yes! We offer both pickup and delivery. Delivery includes a small fee based on mileage.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 4 }">
                <button class="faq-question" @click="open = open === 4 ? null : 4">What area do you serve?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>We easily serve the Four Corners, FL area. We can also accommodate the greater Orlando area with a bit more lead time and coordination.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 5 }">
                <button class="faq-question" @click="open = open === 5 ? null : 5">Can I customize my order?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>We don't take fully custom orders, but we can make small adjustments. Don't like walnuts in your banana bread? We can swap in pecans. We can't accommodate items outside our menu, but we always love hearing suggestions for future offerings.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 6 }">
                <button class="faq-question" @click="open = open === 6 ? null : 6">Why sourdough?</button>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <p>It started with wanting bread without processed ingredients and preservatives. Sourdough uses a natural fermentation process, which means simpler ingredients and better flavor. No shortcuts, no additives.</p>
                </div></div>
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
    <section class="reviews" id="reviews">
        <div class="section-head reveal">
            <h2>What Our Neighbors Say</h2>
            <div class="accent-line"></div>
        </div>
        <p class="reviews-subtitle reveal">Real words from real people who keep coming back.</p>

        <div class="review-featured reveal">
            <blockquote>The best sourdough I've ever had. The crust is perfectly crispy and the inside is so soft. We order every single week now and my kids fight over the last piece.</blockquote>
            <div class="review-author-wrap">
                <span class="author-line"></span>
                <span class="review-author">Sarah M.</span>
                <span class="dot" style="width:4px;height:4px;background:var(--golden);border-radius:50%;display:inline-block;"></span>
                <span class="review-location">Davenport, FL</span>
                <span class="author-line"></span>
            </div>
        </div>

        <div class="reviews-conversation">
            <div class="convo-card reveal">
                <div class="convo-avatar">M</div>
                <div class="convo-bubble">
                    <div class="review-stars">★★★★★</div>
                    <blockquote>Cassie's chocolate chip sourdough changed my life. I'm not being dramatic. My family goes through a loaf in a single day and then immediately orders another.</blockquote>
                    <div class="convo-meta">
                        <span class="review-author">Mike T.</span>
                        <span class="dot"></span>
                        <span class="review-location">Haines City, FL</span>
                    </div>
                </div>
            </div>

            <div class="convo-card from-right reveal">
                <div class="convo-avatar">J</div>
                <div class="convo-bubble">
                    <div class="review-stars">★★★★★</div>
                    <blockquote>Finally, real bread from someone who actually cares. You can taste the difference in every bite. The English muffins are out of this world!</blockquote>
                    <div class="convo-meta">
                        <span class="review-author">Jessica R.</span>
                        <span class="dot"></span>
                        <span class="review-location">Clermont, FL</span>
                    </div>
                </div>
            </div>

            <div class="convo-card reveal">
                <div class="convo-avatar">D</div>
                <div class="convo-bubble">
                    <div class="review-stars">★★★★★</div>
                    <blockquote>I ordered the mini loaf variety pack and now I can't pick a favorite. The chocolate chip and cinnamon sugar are tied for first place.</blockquote>
                    <div class="convo-meta">
                        <span class="review-author">David L.</span>
                        <span class="dot"></span>
                        <span class="review-location">Kissimmee, FL</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══ FRESH FROM THE OVEN ═══ --}}
    <section class="fresh-oven">
        <div class="section-head reveal">
            <h2>Fresh from the Oven</h2>
            <div class="accent-line"></div>
        </div>
        <p class="fresh-subtitle reveal">A peek into our kitchen and what's baking today.</p>

        <div class="clothesline-wrap reveal">
            <div class="clothesline-string"></div>
            <div class="clothesline-photos">
                <div class="hanging-photo">
                    <div class="photo-clip"></div>
                    <div class="photo-frame">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <span class="photo-caption">The signature boule</span>
                    </div>
                </div>

                <div class="hanging-photo">
                    <div class="photo-clip"></div>
                    <div class="photo-frame">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <span class="photo-caption">Griddle day!</span>
                    </div>
                </div>

                <div class="hanging-photo">
                    <div class="photo-clip"></div>
                    <div class="photo-frame">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <span class="photo-caption">Fall vibes 🎃</span>
                    </div>
                </div>

                <div class="hanging-photo">
                    <div class="photo-clip"></div>
                    <div class="photo-frame">
                        <div class="placeholder-slot">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                        <span class="photo-caption">The starter</span>
                    </div>
                </div>

                <div class="hanging-photo">
                    <div class="photo-clip"></div>
                    <div class="photo-frame">
                        <div class="placeholder-slot">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Ready for pickup</span>
                        </div>
                        <span class="photo-caption">Packed with care</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="fresh-cta reveal">
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">
                <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Follow @bakeryonbiscotto
            </a>
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

        // ── Menu candlelight ──
        const menuGlow = document.getElementById('menuCandleGlow');
        const menuScene = document.querySelector('.menu-scene');
        if (menuGlow && menuScene) {
            menuScene.addEventListener('mousemove', (e) => {
                const rect = menuScene.getBoundingClientRect();
                menuGlow.style.left = (e.clientX - rect.left) + 'px';
                menuGlow.style.top = (e.clientY - rect.top) + 'px';
            });
        }

        // Flour burst on scroll
        const burstSection = document.getElementById('flourBurst');
        const burstContainer = document.getElementById('burstContainer');
        let burstFired = false;

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
