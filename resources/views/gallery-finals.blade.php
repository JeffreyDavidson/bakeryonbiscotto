<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Final Two</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Dancing+Script:wght@400;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500&family=Caveat:wght@400;500;600&display=swap" rel="stylesheet">
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
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0d0805; color: var(--cream); }

        .concept-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            display: flex; justify-content: center; gap: 8px;
            padding: 14px 20px;
            background: rgba(26,15,8,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .concept-nav a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px; font-weight: 600;
            color: var(--cream); text-decoration: none;
            padding: 8px 24px; border-radius: 100px;
            border: 1px solid rgba(212,165,116,0.2);
            transition: all 0.3s;
        }
        .concept-nav a:hover, .concept-nav a.active {
            background: rgba(212,165,116,0.15);
            border-color: var(--golden); color: var(--golden);
        }
        .concept-label {
            text-align: center; padding: 100px 20px 20px;
        }
        .concept-label h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--golden); margin-bottom: 8px;
        }
        .concept-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; color: rgba(245,230,208,0.5);
            font-size: 16px; max-width: 560px; margin: 0 auto;
        }
        .divider {
            max-width: 300px; margin: 40px auto; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.3), transparent);
        }
        .section-head { text-align: center; margin-bottom: 16px; }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.4rem, 5vw, 3.5rem); font-weight: 700;
            color: var(--cream);
        }
        .accent-line {
            width: 100px; height: 2px; margin: 16px auto;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════════
           OPTION A: FLOUR-DUSTED TABLE (Enhanced)
        ═══════════════════════════════════ */
        .flour-table {
            padding: 80px 20px 100px;
            position: relative; overflow: hidden;
            background: #1c1410;
        }
        /* Wood grain texture — more visible */
        .flour-table::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(85deg, transparent, rgba(80,55,35,0.06) 1px, transparent 3px),
                repeating-linear-gradient(88deg, transparent, rgba(60,40,25,0.04) 2px, transparent 5px),
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 50%);
            pointer-events: none;
        }
        .ft-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .ft-container {
            max-width: 900px; margin: 0 auto;
            position: relative;
        }

        /* ── FLOUR DUST PATCHES (much more visible) ── */
        .flour-patch {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }
        /* Main glow — brighter */
        .flour-patch::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 50%;
            background: radial-gradient(circle,
                rgba(245,235,220,0.35) 0%,
                rgba(245,235,220,0.18) 30%,
                rgba(245,235,220,0.06) 55%,
                transparent 75%
            );
        }
        /* Scattered specks — larger, more visible */
        .flour-patch::after {
            content: '';
            position: absolute;
            width: 250%; height: 250%;
            top: -75%; left: -75%;
            background-image:
                radial-gradient(circle at 18% 28%, rgba(245,235,220,0.6) 1.5px, transparent 1.5px),
                radial-gradient(circle at 55% 12%, rgba(245,235,220,0.5) 2px, transparent 2px),
                radial-gradient(circle at 82% 55%, rgba(245,235,220,0.55) 1.5px, transparent 1.5px),
                radial-gradient(circle at 38% 68%, rgba(245,235,220,0.45) 2.5px, transparent 2.5px),
                radial-gradient(circle at 12% 78%, rgba(245,235,220,0.5) 1.5px, transparent 1.5px),
                radial-gradient(circle at 72% 38%, rgba(245,235,220,0.55) 2px, transparent 2px),
                radial-gradient(circle at 28% 48%, rgba(245,235,220,0.4) 3px, transparent 3px),
                radial-gradient(circle at 88% 22%, rgba(245,235,220,0.45) 2px, transparent 2px),
                radial-gradient(circle at 48% 88%, rgba(245,235,220,0.5) 2px, transparent 2px),
                radial-gradient(circle at 65% 75%, rgba(245,235,220,0.35) 2.5px, transparent 2.5px),
                radial-gradient(circle at 8% 45%, rgba(245,235,220,0.55) 1.5px, transparent 1.5px),
                radial-gradient(circle at 42% 15%, rgba(245,235,220,0.4) 2px, transparent 2px);
            pointer-events: none;
        }

        .flour-patch.fp1 { width: 320px; height: 300px; top: -40px; left: -30px; }
        .flour-patch.fp2 { width: 280px; height: 250px; bottom: -30px; right: -10px; }
        .flour-patch.fp3 { width: 200px; height: 180px; top: 35%; left: 50%; }
        .flour-patch.fp4 { width: 150px; height: 140px; top: 15%; right: 10%; }
        .flour-patch.fp5 { width: 160px; height: 150px; bottom: 30%; left: 20%; }

        /* ── FLOUR HANDPRINT — more visible ── */
        .flour-handprint {
            position: absolute;
            bottom: 30px; left: 50px;
            width: 70px; height: 80px;
            z-index: 1;
            pointer-events: none;
            transform: rotate(-15deg);
        }
        /* Palm */
        .flour-handprint::before {
            content: '';
            position: absolute;
            bottom: 0; left: 10px;
            width: 50px; height: 45px;
            border-radius: 50% 50% 45% 45%;
            background: radial-gradient(circle, rgba(245,235,220,0.22), rgba(245,235,220,0.08) 60%, transparent 80%);
        }
        /* Fingers (simplified as smudge) */
        .flour-handprint::after {
            content: '';
            position: absolute;
            top: 0; left: 5px;
            width: 60px; height: 40px;
            background:
                radial-gradient(ellipse at 15% 60%, rgba(245,235,220,0.18) 4px, transparent 4px),
                radial-gradient(ellipse at 35% 40%, rgba(245,235,220,0.2) 4px, transparent 4px),
                radial-gradient(ellipse at 55% 30%, rgba(245,235,220,0.18) 4px, transparent 4px),
                radial-gradient(ellipse at 75% 45%, rgba(245,235,220,0.16) 4px, transparent 4px),
                radial-gradient(ellipse at 90% 65%, rgba(245,235,220,0.14) 3px, transparent 3px);
        }

        /* ── ROLLING PIN FLOUR TRAIL — much more visible ── */
        .flour-trail {
            position: absolute;
            top: 45%; right: -20px;
            width: 220px; height: 60px;
            transform: rotate(-5deg);
            z-index: 1;
            pointer-events: none;
        }
        /* Main streak */
        .flour-trail::before {
            content: '';
            position: absolute;
            top: 10px; left: 0; right: 0;
            height: 30px;
            background: linear-gradient(90deg,
                rgba(245,235,220,0.3),
                rgba(245,235,220,0.2) 30%,
                rgba(245,235,220,0.12) 60%,
                rgba(245,235,220,0.04) 85%,
                transparent
            );
            border-radius: 20px;
        }
        /* Edge splatter from the roll */
        .flour-trail::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 5% 20%, rgba(245,235,220,0.4) 2px, transparent 2px),
                radial-gradient(circle at 15% 80%, rgba(245,235,220,0.3) 2.5px, transparent 2.5px),
                radial-gradient(circle at 25% 10%, rgba(245,235,220,0.35) 1.5px, transparent 1.5px),
                radial-gradient(circle at 35% 70%, rgba(245,235,220,0.25) 2px, transparent 2px),
                radial-gradient(circle at 45% 30%, rgba(245,235,220,0.3) 2px, transparent 2px),
                radial-gradient(circle at 55% 60%, rgba(245,235,220,0.2) 1.5px, transparent 1.5px),
                radial-gradient(circle at 65% 15%, rgba(245,235,220,0.15) 2px, transparent 2px);
        }

        /* ── SCATTERED INDIVIDUAL FLOUR SPECKS across entire section ── */
        .flour-specks {
            position: absolute; inset: 0;
            pointer-events: none;
            z-index: 1;
        }
        .flour-specks span {
            position: absolute;
            background: rgba(245,235,220,0.5);
            border-radius: 50%;
        }
        /* Individual specks scattered across the table */
        .flour-specks span:nth-child(1) { width: 3px; height: 3px; top: 12%; left: 8%; }
        .flour-specks span:nth-child(2) { width: 2px; height: 2px; top: 25%; left: 32%; }
        .flour-specks span:nth-child(3) { width: 4px; height: 4px; top: 8%; left: 65%; opacity: 0.4; }
        .flour-specks span:nth-child(4) { width: 2px; height: 2px; top: 55%; left: 12%; }
        .flour-specks span:nth-child(5) { width: 3px; height: 3px; top: 70%; left: 45%; opacity: 0.35; }
        .flour-specks span:nth-child(6) { width: 2px; height: 2px; top: 40%; left: 88%; }
        .flour-specks span:nth-child(7) { width: 4px; height: 3px; top: 85%; left: 25%; opacity: 0.3; }
        .flour-specks span:nth-child(8) { width: 2px; height: 2px; top: 18%; left: 78%; }
        .flour-specks span:nth-child(9) { width: 3px; height: 3px; top: 62%; left: 72%; opacity: 0.4; }
        .flour-specks span:nth-child(10) { width: 2px; height: 2px; top: 35%; left: 55%; }
        .flour-specks span:nth-child(11) { width: 3px; height: 2px; top: 78%; left: 82%; opacity: 0.35; }
        .flour-specks span:nth-child(12) { width: 2px; height: 3px; top: 48%; left: 5%; }
        .flour-specks span:nth-child(13) { width: 4px; height: 4px; top: 22%; left: 42%; opacity: 0.25; }
        .flour-specks span:nth-child(14) { width: 2px; height: 2px; top: 90%; left: 58%; }
        .flour-specks span:nth-child(15) { width: 3px; height: 3px; top: 5%; left: 92%; opacity: 0.3; }

        /* ── DUSTING LINE — like someone wiped a finger through flour ── */
        .flour-swipe {
            position: absolute;
            top: 75%; left: 15%;
            width: 180px; height: 12px;
            z-index: 1;
            pointer-events: none;
            transform: rotate(3deg);
        }
        .flour-swipe::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg,
                transparent,
                rgba(28,20,16,0.6) 10%,
                rgba(28,20,16,0.8) 30%,
                rgba(28,20,16,0.8) 70%,
                rgba(28,20,16,0.6) 90%,
                transparent
            );
            border-radius: 6px;
        }
        /* Flour pushed to the edges of the swipe */
        .flour-swipe::after {
            content: '';
            position: absolute;
            top: -4px; left: 0; right: 0; bottom: -4px;
            background:
                linear-gradient(90deg,
                    transparent 5%,
                    rgba(245,235,220,0.25) 10%,
                    transparent 15%,
                    transparent 85%,
                    rgba(245,235,220,0.2) 90%,
                    transparent 95%
                ),
                linear-gradient(180deg,
                    rgba(245,235,220,0.2),
                    transparent 30%,
                    transparent 70%,
                    rgba(245,235,220,0.2)
                );
            border-radius: 6px;
        }

        .ft-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .ft-item {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ft-item:hover {
            transform: scale(1.03); z-index: 5;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .ft-item img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .ft-item .ft-ph {
            width: 100%; height: 100%; min-height: 180px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
        }
        .ft-item .ft-ph .ph-emoji { font-size: 40px; }
        .ft-item .ft-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 14px;
            color: rgba(245,230,208,0.25);
        }
        .ft-item .ft-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 32px 14px 12px;
            background: linear-gradient(transparent, rgba(26,15,8,0.7));
        }
        .ft-item .ft-caption {
            font-family: 'Caveat', cursive; font-size: 18px; color: var(--cream);
        }
        .ft-item.ft-hero { grid-row: span 2; }

        @media (max-width: 768px) {
            .ft-grid { grid-template-columns: 1fr 1fr; }
            .ft-item.ft-hero { grid-row: span 1; }
            .ft-item.ft-hero img { height: 220px; }
            .ft-item img, .ft-item .ft-ph { min-height: 160px; }
            .flour-patch.fp3, .flour-patch.fp4, .flour-patch.fp5 { display: none; }
            .flour-swipe { display: none; }
        }

        /* ═══════════════════════════════════
           OPTION B: COOLING RACK
        ═══════════════════════════════════ */
        .cooling-rack-section {
            padding: 80px 20px 100px;
            background: var(--dark);
            position: relative; overflow: hidden;
        }
        .cooling-rack-section::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.05), transparent 60%);
            pointer-events: none;
        }
        .cooling-rack-section .section-head h2 { color: var(--cream); }
        .cr-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .cooling-rack {
            max-width: 900px; margin: 0 auto;
            position: relative;
            padding: 40px 20px;
        }
        /* Horizontal wires */
        .cooling-rack::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 78px,
                    rgba(160,140,120,0.15) 78px,
                    rgba(160,140,120,0.15) 80px
                );
            pointer-events: none; z-index: 0;
        }
        /* Vertical wires */
        .cooling-rack::after {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 118px,
                    rgba(160,140,120,0.08) 118px,
                    rgba(160,140,120,0.08) 120px
                );
            pointer-events: none; z-index: 0;
        }

        .rack-foot {
            position: absolute; bottom: -8px;
            width: 24px; height: 8px;
            background: linear-gradient(180deg, #706050, #504030);
            border-radius: 0 0 4px 4px;
        }
        .rack-foot.left { left: 40px; }
        .rack-foot.right { right: 40px; }

        .rack-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            position: relative; z-index: 2;
        }

        .rack-item {
            text-align: center;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rack-item:hover { transform: translateY(-6px); }

        .rack-img {
            width: 100%; height: 220px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.35);
            position: relative;
        }
        .rack-img img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        /* Steam effect */
        .rack-img::after {
            content: '';
            position: absolute;
            top: -20px; left: 20%; right: 20%;
            height: 40px;
            background: radial-gradient(ellipse at 50% 100%, rgba(245,230,208,0.08), transparent 70%);
            pointer-events: none;
            animation: steam-rise 3s infinite ease-out;
        }
        @keyframes steam-rise {
            0% { opacity: 0; transform: translateY(0) scaleX(1); }
            50% { opacity: 0.6; }
            100% { opacity: 0; transform: translateY(-20px) scaleX(1.3); }
        }

        .rack-img .rack-ph {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: radial-gradient(circle, rgba(212,165,116,0.06), transparent 60%), #1a1208;
        }
        .rack-img .rack-ph .ph-emoji { font-size: 40px; }
        .rack-img .rack-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 14px;
            color: rgba(245,230,208,0.3);
        }

        .rack-caption {
            margin-top: 14px;
            font-family: 'Caveat', cursive;
            font-size: 18px;
            color: rgba(245,230,208,0.5);
        }

        @media (max-width: 768px) {
            .rack-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
            .rack-img { height: 170px; }
        }
    </style>
</head>
<body>

    <nav class="concept-nav">
        <a href="#flour-table">Flour-Dusted Table</a>
        <a href="#cooling-rack">Cooling Rack</a>
    </nav>

    <!-- ═══ FLOUR-DUSTED TABLE (Enhanced) ═══ -->
    <div id="flour-table">
        <div class="concept-label">
            <h1>Flour-Dusted Table</h1>
            <p>Dark wood table covered in visible flour dust patches, scattered specks, a rolling pin trail with flour pushed to its edges, a finger swipe through flour, and a faint handprint. Magazine-style asymmetric photo layout.</p>
        </div>

        <section class="flour-table">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="ft-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="ft-container reveal">
                <!-- Flour dust patches -->
                <div class="flour-patch fp1"></div>
                <div class="flour-patch fp2"></div>
                <div class="flour-patch fp3"></div>
                <div class="flour-patch fp4"></div>
                <div class="flour-patch fp5"></div>

                <!-- Individual scattered specks -->
                <div class="flour-specks">
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                </div>

                <!-- Rolling pin flour trail -->
                <div class="flour-trail"></div>

                <!-- Finger swipe through flour -->
                <div class="flour-swipe"></div>

                <!-- Handprint -->
                <div class="flour-handprint"></div>

                <div class="ft-grid">
                    <div class="ft-item ft-hero">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <div class="ft-overlay"><span class="ft-caption">The signature boule</span></div>
                    </div>
                    <div class="ft-item">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <div class="ft-overlay"><span class="ft-caption">Griddle day!</span></div>
                    </div>
                    <div class="ft-item">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <div class="ft-overlay"><span class="ft-caption">Fall vibes</span></div>
                    </div>
                    <div class="ft-item">
                        <div class="ft-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                    </div>
                    <div class="ft-item">
                        <div class="ft-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ COOLING RACK ═══ -->
    <div id="cooling-rack">
        <div class="concept-label">
            <h1>Cooling Rack</h1>
            <p>Photos sitting on a wire cooling rack with subtle steam rising. Wire grid pattern behind, metal feet at the bottom. Just pulled these out.</p>
        </div>

        <section class="cooling-rack-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="cr-subtitle reveal">Just pulled these out. Still warm.</p>

            <div class="cooling-rack reveal">
                <div class="rack-foot left"></div>
                <div class="rack-foot right"></div>
                <div class="rack-grid">
                    <div class="rack-item">
                        <div class="rack-img">
                            <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        </div>
                        <p class="rack-caption">The signature boule</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        </div>
                        <p class="rack-caption">Griddle day!</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        </div>
                        <p class="rack-caption">Fall vibes</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <div class="rack-ph">
                                <span class="ph-emoji">🫧</span>
                                <span class="ph-text">Biscotto bubbling</span>
                            </div>
                        </div>
                        <p class="rack-caption">The starter</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <div class="rack-ph">
                                <span class="ph-emoji">🍞</span>
                                <span class="ph-text">Scoring day</span>
                            </div>
                        </div>
                        <p class="rack-caption">The craft</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <div class="rack-ph">
                                <span class="ph-emoji">📦</span>
                                <span class="ph-text">Ready for you</span>
                            </div>
                        </div>
                        <p class="rack-caption">Packed with care</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }});
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        const navLinks = document.querySelectorAll('.concept-nav a');
        const sections = ['flour-table', 'cooling-rack'];
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
