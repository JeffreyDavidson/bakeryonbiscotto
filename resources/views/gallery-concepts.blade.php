<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Gallery Concepts</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Dancing+Script:wght@400;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #1a0f08;
            --dark-brown: #3D2314;
            --brown: #5C3A28;
            --warm: #6B4C3B;
            --warm-brown: #8B5E3C;
            --golden: #D4A574;
            --cream: #F5E6D0;
            --parchment: #f0e0c8;
            --candle: #f4c87a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0d0805;
            color: var(--cream);
        }

        /* ═══ CONCEPT NAV ═══ */
        .concept-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            display: flex; justify-content: center; gap: 8px;
            padding: 16px 20px;
            background: rgba(26,15,8,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .concept-nav a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px; font-weight: 600;
            color: var(--cream); text-decoration: none;
            padding: 8px 20px; border-radius: 100px;
            border: 1px solid rgba(212,165,116,0.2);
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        .concept-nav a:hover, .concept-nav a.active {
            background: rgba(212,165,116,0.15);
            border-color: var(--golden);
            color: var(--golden);
        }

        .concept-label {
            text-align: center;
            padding: 120px 20px 20px;
        }
        .concept-label h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--golden);
            margin-bottom: 8px;
        }
        .concept-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            color: rgba(245,230,208,0.5);
            font-size: 16px;
        }

        .divider {
            max-width: 200px;
            margin: 0 auto;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.3), transparent);
        }

        /* ═══════════════════════════════════
           OPTION A: KITCHEN WINDOW SHELF
        ═══════════════════════════════════ */
        .window-gallery {
            padding: 80px 20px 100px;
            position: relative;
            background: var(--dark);
            overflow: hidden;
        }
        .window-gallery::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.08), transparent 60%),
                radial-gradient(ellipse at 50% 100%, rgba(139,94,60,0.04), transparent 40%);
            pointer-events: none;
        }

        .section-head { text-align: center; margin-bottom: 56px; }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            color: var(--cream);
            font-size: clamp(2.4rem, 5vw, 3.5rem);
            font-weight: 700;
        }
        .accent-line {
            width: 100px; height: 2px; margin: 16px auto;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .section-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.4);
            margin-top: -24px; margin-bottom: 48px;
        }

        /* The window frame */
        .window-frame {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            padding: 40px;
            border: 2px solid rgba(139,94,60,0.2);
            border-radius: 12px;
            background: rgba(26,15,8,0.4);
        }
        /* Light glow from above */
        .window-frame::before {
            content: '';
            position: absolute;
            top: -2px; left: 15%; right: 15%;
            height: 80px;
            background: radial-gradient(ellipse at 50% 0%, rgba(244,200,122,0.12), transparent 80%);
            pointer-events: none;
        }
        /* Top bar of "window" */
        .window-frame::after {
            content: '';
            position: absolute;
            top: 0; left: 30px; right: 30px;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.3) 20%, rgba(212,165,116,0.3) 80%, transparent);
        }

        /* The shelf */
        .window-shelf {
            display: flex;
            justify-content: center;
            gap: 28px;
            position: relative;
            padding-bottom: 20px;
        }
        /* Wooden shelf bar */
        .window-shelf::after {
            content: '';
            position: absolute;
            bottom: 0; left: -10px; right: -10px;
            height: 8px;
            background: linear-gradient(180deg, #6B4C3B, #4a3428);
            border-radius: 2px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3), 0 2px 4px rgba(0,0,0,0.2);
        }
        /* Shelf bracket hints */
        .shelf-bracket {
            position: absolute;
            bottom: 8px;
            width: 16px; height: 20px;
            border-left: 2px solid rgba(107,76,59,0.6);
            border-bottom: 2px solid rgba(107,76,59,0.6);
        }
        .shelf-bracket.left { left: 60px; }
        .shelf-bracket.right { right: 60px; transform: scaleX(-1); }

        .shelf-photo {
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .shelf-photo:nth-child(odd) { transform: rotate(-2deg); margin-top: 8px; }
        .shelf-photo:nth-child(even) { transform: rotate(1.5deg); }
        .shelf-photo:hover {
            transform: rotate(0deg) translateY(-8px) scale(1.05);
            z-index: 10;
        }

        .shelf-photo .frame {
            background: white;
            padding: 8px 8px 32px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3), 2px 4px 8px rgba(0,0,0,0.15);
        }
        .shelf-photo .frame img {
            width: 180px; height: 180px;
            object-fit: cover; display: block;
        }
        .shelf-photo .frame .placeholder {
            width: 180px; height: 180px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle at 50% 40%, rgba(212,165,116,0.06), transparent 60%), #f8f0e4;
        }
        .shelf-photo .frame .placeholder .ph-emoji { font-size: 36px; }
        .shelf-photo .frame .placeholder .ph-text {
            font-family: 'Dancing Script', cursive;
            font-size: 12px; color: var(--brown); opacity: 0.5;
        }
        .shelf-photo .caption {
            position: absolute;
            bottom: 6px; left: 8px; right: 8px;
            text-align: center;
            font-family: 'Dancing Script', cursive;
            font-size: 12px; color: var(--warm);
        }

        /* Light rays from window top */
        .window-rays {
            position: absolute;
            top: 0; left: 0; right: 0; height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
        .window-rays::before {
            content: '';
            position: absolute;
            top: -20px; left: 25%;
            width: 50%; height: 120%;
            background: linear-gradient(180deg,
                rgba(244,200,122,0.04) 0%,
                transparent 60%
            );
            transform: perspective(400px) rotateX(5deg);
        }

        .window-cta {
            text-align: center; margin-top: 48px;
        }
        .gallery-cta {
            display: inline-flex; align-items: center; gap: 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600;
            color: var(--golden); text-decoration: none;
            letter-spacing: 1px; text-transform: uppercase;
            padding: 12px 32px;
            border: 1.5px solid rgba(212,165,116,0.3);
            border-radius: 100px; transition: all 0.3s;
        }
        .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
            box-shadow: 0 0 30px rgba(212,165,116,0.1);
        }
        .gallery-cta svg { width: 16px; height: 16px; fill: var(--golden); }

        @media (max-width: 768px) {
            .window-frame { padding: 24px 16px; }
            .window-shelf {
                flex-wrap: wrap; gap: 16px;
            }
            .shelf-photo .frame img,
            .shelf-photo .frame .placeholder { width: 140px; height: 140px; }
        }

        /* ═══════════════════════════════════
           OPTION B: RECIPE CARD SCRAPBOOK (Concept D inspired)
        ═══════════════════════════════════ */
        .scrapbook-gallery {
            padding: 80px 20px 100px;
            position: relative;
            background: var(--cream);
            overflow: hidden;
        }
        .scrapbook-gallery::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(212,165,116,0.15), transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(139,94,60,0.08), transparent 40%);
            pointer-events: none;
        }

        .scrapbook-gallery .section-head h2 {
            color: var(--dark-brown);
        }
        .scrapbook-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: var(--warm-brown);
            opacity: 0.7;
            margin-top: -24px; margin-bottom: 48px;
        }

        .masonry-grid {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 8px;
            gap: 20px;
        }

        .masonry-card {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 20px rgba(61,35,20,0.1);
            background: white;
        }
        .masonry-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(61,35,20,0.18);
        }

        /* Varying heights */
        .masonry-card.tall { grid-row: span 38; }
        .masonry-card.medium { grid-row: span 30; }
        .masonry-card.short { grid-row: span 24; }

        .masonry-card img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
        }

        .masonry-card .card-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 24px 16px 16px;
            background: linear-gradient(transparent, rgba(26,15,8,0.7));
        }
        .masonry-card .card-caption {
            font-family: 'Dancing Script', cursive;
            font-size: 18px;
            color: white;
            text-shadow: 0 1px 4px rgba(0,0,0,0.4);
        }

        /* Placeholder masonry cards */
        .masonry-card .card-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 10px;
            background:
                radial-gradient(circle at 50% 40%, rgba(212,165,116,0.1), transparent 60%),
                #faf3ea;
        }
        .masonry-card .card-placeholder .ph-emoji { font-size: 44px; }
        .masonry-card .card-placeholder .ph-text {
            font-family: 'Dancing Script', cursive;
            font-size: 15px; color: var(--warm-brown); opacity: 0.5;
        }

        /* Decorative tape strips on some cards */
        .masonry-card .tape {
            position: absolute;
            width: 60px; height: 20px;
            background: rgba(212,165,116,0.25);
            transform: rotate(-5deg);
            top: -6px; left: 20px;
            border-radius: 2px;
            z-index: 2;
        }
        .masonry-card:nth-child(3) .tape { transform: rotate(4deg); left: auto; right: 16px; }
        .masonry-card:nth-child(5) .tape { transform: rotate(-3deg); }

        .scrapbook-cta {
            text-align: center; margin-top: 48px;
        }
        .scrapbook-cta a {
            display: inline-flex; align-items: center; gap: 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600;
            color: var(--dark-brown); text-decoration: none;
            letter-spacing: 1px; text-transform: uppercase;
            padding: 12px 32px;
            border: 1.5px solid rgba(139,94,60,0.3);
            border-radius: 100px; transition: all 0.3s;
        }
        .scrapbook-cta a:hover {
            background: rgba(139,94,60,0.08);
            border-color: var(--warm-brown);
        }
        .scrapbook-cta a svg { width: 16px; height: 16px; fill: var(--dark-brown); }

        @media (max-width: 768px) {
            .masonry-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .masonry-card.tall { grid-row: span 28; }
            .masonry-card.medium { grid-row: span 22; }
            .masonry-card.short { grid-row: span 18; }
        }

        /* ═══════════════════════════════════
           OPTION C: BREAD BOARD DISPLAY
        ═══════════════════════════════════ */
        .breadboard-gallery {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            /* Dark wood table */
            background:
                linear-gradient(180deg, #1c1008 0%, #241610 50%, #1c1008 100%);
        }
        /* Subtle wood grain texture */
        .breadboard-gallery::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    rgba(139,94,60,0.02) 2px,
                    transparent 4px
                ),
                radial-gradient(ellipse at 50% 30%, rgba(244,200,122,0.06), transparent 50%);
            pointer-events: none;
        }

        .breadboard-gallery .section-head h2 { color: var(--cream); }

        .board-container {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }

        /* The cutting board */
        .cutting-board {
            background:
                linear-gradient(135deg,
                    #5a3e2b 0%, #6d4c35 20%, #5a3e2b 40%,
                    #6d4c35 60%, #5a3e2b 80%, #6d4c35 100%
                );
            border-radius: 20px;
            padding: 48px 40px;
            position: relative;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.05),
                inset 0 -1px 0 rgba(0,0,0,0.2);
        }
        /* Board grain */
        .cutting-board::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 20px;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    rgba(0,0,0,0.03) 1px,
                    transparent 3px
                );
            pointer-events: none;
        }
        /* Board edge bevel */
        .cutting-board::after {
            content: '';
            position: absolute; inset: 4px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.04);
            pointer-events: none;
        }

        .board-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .board-photo {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .board-photo:hover {
            transform: scale(1.04);
            z-index: 2;
        }

        .board-photo .img-wrap {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 6px 20px rgba(0,0,0,0.35);
        }
        .board-photo .img-wrap img {
            width: 100%; height: 220px;
            object-fit: cover; display: block;
            transition: all 0.5s;
        }
        .board-photo:hover .img-wrap img {
            transform: scale(1.05);
        }
        /* Warm vignette */
        .board-photo .img-wrap::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: 12px;
            box-shadow: inset 0 0 40px rgba(26,15,8,0.3);
            pointer-events: none;
        }

        .board-photo .img-wrap .placeholder {
            width: 100%; height: 220px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background:
                radial-gradient(circle at 50% 40%, rgba(212,165,116,0.08), transparent 60%),
                #3a2a1c;
            border-radius: 12px;
        }
        .board-photo .img-wrap .placeholder .ph-emoji { font-size: 40px; }
        .board-photo .img-wrap .placeholder .ph-text {
            font-family: 'Dancing Script', cursive;
            font-size: 13px; color: var(--golden); opacity: 0.4;
        }

        .board-caption {
            text-align: center;
            margin-top: 14px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 500;
            color: rgba(245,230,208,0.6);
            letter-spacing: 0.5px;
        }

        /* Featured center photo */
        .board-photo.featured .img-wrap img,
        .board-photo.featured .img-wrap .placeholder {
            height: 280px;
        }
        .board-photo.featured .board-caption {
            font-family: 'Dancing Script', cursive;
            font-size: 20px;
            color: var(--golden);
        }

        .board-cta {
            text-align: center; margin-top: 56px;
        }
        .board-cta a {
            display: inline-flex; align-items: center; gap: 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600;
            color: var(--golden); text-decoration: none;
            letter-spacing: 1px; text-transform: uppercase;
            padding: 12px 32px;
            border: 1.5px solid rgba(212,165,116,0.3);
            border-radius: 100px; transition: all 0.3s;
        }
        .board-cta a:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .board-cta a svg { width: 16px; height: 16px; fill: var(--golden); }

        @media (max-width: 768px) {
            .board-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .cutting-board { padding: 28px 20px; }
            .board-photo .img-wrap img,
            .board-photo.featured .img-wrap img,
            .board-photo .img-wrap .placeholder,
            .board-photo.featured .img-wrap .placeholder { height: 160px; }
        }

        /* ═══ SCROLL REVEAL ═══ */
        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <!-- Concept Nav -->
    <nav class="concept-nav">
        <a href="#option-a">A: Kitchen Window</a>
        <a href="#option-b">B: Scrapbook</a>
        <a href="#option-c">C: Bread Board</a>
    </nav>

    <!-- ═══════════════════════════════════════
         OPTION A: KITCHEN WINDOW SHELF
    ═══════════════════════════════════════ -->
    <div id="option-a">
        <div class="concept-label">
            <h1>Option A: Kitchen Window Shelf</h1>
            <p>Photos leaning on a rustic shelf with warm light spilling from above</p>
        </div>

        <section class="window-gallery">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="section-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="window-frame reveal">
                <div class="window-rays"></div>
                <div class="window-shelf">
                    <div class="shelf-bracket left"></div>
                    <div class="shelf-bracket right"></div>

                    <div class="shelf-photo">
                        <div class="frame">
                            <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                            <span class="caption">The signature boule</span>
                        </div>
                    </div>

                    <div class="shelf-photo">
                        <div class="frame">
                            <img src="/images/product-english-muffins.jpg" alt="English muffins">
                            <span class="caption">Griddle day!</span>
                        </div>
                    </div>

                    <div class="shelf-photo">
                        <div class="frame">
                            <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                            <span class="caption">Fall vibes</span>
                        </div>
                    </div>

                    <div class="shelf-photo">
                        <div class="frame">
                            <div class="placeholder">
                                <span class="ph-emoji">🫧</span>
                                <span class="ph-text">Biscotto bubbling</span>
                            </div>
                            <span class="caption">The starter</span>
                        </div>
                    </div>

                    <div class="shelf-photo">
                        <div class="frame">
                            <div class="placeholder">
                                <span class="ph-emoji">📦</span>
                                <span class="ph-text">Ready for pickup</span>
                            </div>
                            <span class="caption">Packed with care</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="window-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════
         OPTION B: RECIPE CARD SCRAPBOOK
    ═══════════════════════════════════════ -->
    <div id="option-b">
        <div class="concept-label">
            <h1>Option B: Scrapbook Gallery</h1>
            <p>Warm masonry layout inspired by Concept D's rounded cards with tape strips and captions</p>
        </div>

        <section class="scrapbook-gallery">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line" style="background: linear-gradient(90deg, transparent, var(--warm-brown), transparent);"></div>
            </div>
            <p class="scrapbook-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="masonry-grid reveal">
                <div class="masonry-card tall">
                    <div class="tape"></div>
                    <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                    <div class="card-overlay">
                        <span class="card-caption">The signature boule</span>
                    </div>
                </div>

                <div class="masonry-card medium">
                    <img src="/images/product-english-muffins.jpg" alt="English muffins">
                    <div class="card-overlay">
                        <span class="card-caption">Griddle day!</span>
                    </div>
                </div>

                <div class="masonry-card short">
                    <div class="tape"></div>
                    <div class="card-placeholder">
                        <span class="ph-emoji">🫧</span>
                        <span class="ph-text">Biscotto bubbling</span>
                    </div>
                </div>

                <div class="masonry-card medium">
                    <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                    <div class="card-overlay">
                        <span class="card-caption">Fall vibes</span>
                    </div>
                </div>

                <div class="masonry-card short">
                    <div class="tape"></div>
                    <div class="card-placeholder">
                        <span class="ph-emoji">📦</span>
                        <span class="ph-text">Packed with care</span>
                    </div>
                </div>
            </div>

            <div class="scrapbook-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════
         OPTION C: BREAD BOARD DISPLAY
    ═══════════════════════════════════════ -->
    <div id="option-c">
        <div class="concept-label">
            <h1>Option C: Bread Board Display</h1>
            <p>Photos arranged on a wooden cutting board with warm vignettes and editorial spacing</p>
        </div>

        <section class="breadboard-gallery">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="section-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="board-container reveal">
                <div class="cutting-board">
                    <div class="board-grid">
                        <div class="board-photo">
                            <div class="img-wrap">
                                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                            </div>
                            <p class="board-caption">The signature boule</p>
                        </div>

                        <div class="board-photo featured">
                            <div class="img-wrap">
                                <img src="/images/product-english-muffins.jpg" alt="English muffins">
                            </div>
                            <p class="board-caption">Griddle day!</p>
                        </div>

                        <div class="board-photo">
                            <div class="img-wrap">
                                <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                            </div>
                            <p class="board-caption">Fall vibes</p>
                        </div>

                        <div class="board-photo">
                            <div class="img-wrap">
                                <div class="placeholder">
                                    <span class="ph-emoji">🫧</span>
                                    <span class="ph-text">Biscotto bubbling</span>
                                </div>
                            </div>
                            <p class="board-caption">The starter</p>
                        </div>

                        <div class="board-photo">
                            <div class="img-wrap">
                                <div class="placeholder">
                                    <span class="ph-emoji">🍞</span>
                                    <span class="ph-text">Scoring day</span>
                                </div>
                            </div>
                            <p class="board-caption">The craft</p>
                        </div>

                        <div class="board-photo">
                            <div class="img-wrap">
                                <div class="placeholder">
                                    <span class="ph-emoji">📦</span>
                                    <span class="ph-text">Ready for pickup</span>
                                </div>
                            </div>
                            <p class="board-caption">Packed with care</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="board-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }});
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Nav active state
        const navLinks = document.querySelectorAll('.concept-nav a');
        const sections = ['option-a', 'option-b', 'option-c'];
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const link = document.querySelector(`.concept-nav a[href="#${e.target.id}"]`);
                    if (link) link.classList.add('active');
                }
            });
        }, { threshold: 0.3 });
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el) scrollObserver.observe(el);
        });
    </script>
</body>
</html>
