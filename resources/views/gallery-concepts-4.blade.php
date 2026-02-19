<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Round 4</title>
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
            display: flex; justify-content: center; gap: 6px; flex-wrap: wrap;
            padding: 12px 20px;
            background: rgba(26,15,8,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .concept-nav a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 13px; font-weight: 600;
            color: var(--cream); text-decoration: none;
            padding: 6px 16px; border-radius: 100px;
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
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--golden); margin-bottom: 8px;
        }
        .concept-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; color: rgba(245,230,208,0.5);
            font-size: 15px; max-width: 520px; margin: 0 auto;
        }
        .divider {
            max-width: 200px; margin: 0 auto; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.3), transparent);
        }
        .section-head { text-align: center; margin-bottom: 16px; }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.4rem, 5vw, 3.5rem); font-weight: 700;
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
           N: COOLING RACK
           Wire rack grid with bread sitting on it
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

        /* The wire rack */
        .cooling-rack {
            max-width: 900px; margin: 0 auto;
            position: relative;
            padding: 40px 20px;
        }
        /* Horizontal wires */
        .cooling-rack::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 78px,
                    rgba(160,140,120,0.15) 78px,
                    rgba(160,140,120,0.15) 80px
                );
            pointer-events: none;
            z-index: 0;
        }
        /* Vertical wires */
        .cooling-rack::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 118px,
                    rgba(160,140,120,0.08) 118px,
                    rgba(160,140,120,0.08) 120px
                );
            pointer-events: none;
            z-index: 0;
        }

        /* Rack feet/legs */
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
            position: relative;
            z-index: 2;
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

        .rack-img .rack-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: radial-gradient(circle, rgba(212,165,116,0.06), transparent 60%), #1a1208;
        }
        .rack-img .rack-placeholder .ph-emoji { font-size: 40px; }
        .rack-img .rack-placeholder .ph-text {
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

        /* ═══════════════════════════════════
           O: KITCHEN WINDOW WITH SILL
           Looking through a window at bread photos
        ═══════════════════════════════════ */
        .window-sill-section {
            padding: 80px 20px 100px;
            position: relative; overflow: hidden;
            background: linear-gradient(180deg, #2a1c12 0%, var(--dark) 100%);
        }
        .window-sill-section .section-head h2 { color: var(--cream); }
        .ws-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .kitchen-window {
            max-width: 740px; margin: 0 auto;
            position: relative;
        }

        /* Window frame */
        .window-outer {
            background: linear-gradient(135deg, #5a4a38, #6d5a44, #5a4a38);
            border-radius: 8px;
            padding: 14px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            position: relative;
        }
        /* Wood grain on frame */
        .window-outer::before {
            content: '';
            position: absolute; inset: 0; border-radius: 8px;
            background: repeating-linear-gradient(0deg, transparent, rgba(0,0,0,0.02) 2px, transparent 4px);
            pointer-events: none;
        }

        .window-inner {
            background: rgba(200,220,240,0.04);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
        }

        /* Window panes — 2x2 grid + sill photo */
        .window-panes {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 6px;
            padding: 6px;
        }
        /* Mullion cross */
        .window-inner::before {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            left: 50%; transform: translateX(-50%);
            width: 6px;
            background: linear-gradient(180deg, #5a4a38, #6d5a44);
            z-index: 3;
        }
        .window-inner::after {
            content: '';
            position: absolute;
            left: 0; right: 0;
            top: 50%; transform: translateY(-50%);
            height: 6px;
            background: linear-gradient(90deg, #5a4a38, #6d5a44);
            z-index: 3;
        }

        .window-pane {
            overflow: hidden;
            border-radius: 2px;
            position: relative;
        }
        .window-pane img {
            width: 100%; height: 200px;
            object-fit: cover; display: block;
            transition: all 0.5s;
        }
        .window-pane:hover img { transform: scale(1.06); }

        /* Condensation / glass effect */
        .window-pane::after {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(circle at 30% 20%, rgba(255,255,255,0.04), transparent 40%),
                linear-gradient(180deg, rgba(255,255,255,0.02), transparent 30%);
            pointer-events: none;
        }

        .window-pane .wp-placeholder {
            width: 100%; height: 200px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(200,220,240,0.05), transparent 60%), #1a1a20;
        }
        .window-pane .wp-placeholder .ph-emoji { font-size: 36px; }
        .window-pane .wp-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 13px;
            color: rgba(245,230,208,0.25);
        }

        /* Windowsill */
        .window-ledge {
            margin-top: -4px;
            background: linear-gradient(180deg, #6d5a44, #5a4a38);
            padding: 16px 20px;
            border-radius: 0 0 8px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        /* Items on the sill */
        .sill-item {
            text-align: center;
        }
        .sill-item .sill-emoji {
            font-size: 28px;
            display: block;
            margin-bottom: 4px;
        }
        .sill-item .sill-text {
            font-family: 'Caveat', cursive;
            font-size: 12px;
            color: rgba(245,230,208,0.4);
        }

        /* Pane captions */
        .window-pane .pane-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0; z-index: 2;
            padding: 24px 10px 8px;
            background: linear-gradient(transparent, rgba(0,0,0,0.5));
            font-family: 'Caveat', cursive;
            font-size: 15px;
            color: white;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .window-pane:hover .pane-caption { opacity: 1; }

        /* Curtains */
        .curtain {
            position: absolute;
            top: 0; width: 60px; height: 100%;
            z-index: 4;
            pointer-events: none;
        }
        .curtain.left {
            left: -8px;
            background: linear-gradient(90deg,
                rgba(139,62,47,0.15),
                rgba(139,62,47,0.08) 60%,
                transparent
            );
        }
        .curtain.right {
            right: -8px;
            background: linear-gradient(270deg,
                rgba(139,62,47,0.15),
                rgba(139,62,47,0.08) 60%,
                transparent
            );
        }

        @media (max-width: 768px) {
            .window-pane img, .window-pane .wp-placeholder { height: 150px; }
        }

        /* ═══════════════════════════════════
           P: BREAD BASKET
           Woven basket texture holding photos
        ═══════════════════════════════════ */
        .basket-section {
            padding: 80px 20px 100px;
            background: var(--cream);
            position: relative; overflow: hidden;
        }
        .basket-section::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.12), transparent 60%);
            pointer-events: none;
        }
        .basket-section .section-head h2 { color: var(--dark-brown); }
        .basket-section .accent-line {
            background: linear-gradient(90deg, transparent, var(--warm-brown), transparent);
        }
        .bk-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: var(--warm-brown); opacity: 0.6;
            margin-bottom: 56px;
        }

        .bread-basket {
            max-width: 800px; margin: 0 auto;
            position: relative;
        }
        /* The basket */
        .basket-body {
            position: relative;
            border-radius: 24px;
            padding: 40px 32px;
            overflow: hidden;
            /* Woven texture */
            background:
                repeating-linear-gradient(
                    0deg,
                    #c9a87c 0px, #c9a87c 8px,
                    #b89468 8px, #b89468 16px
                );
            box-shadow:
                0 16px 50px rgba(61,35,20,0.2),
                inset 0 2px 0 rgba(255,255,255,0.15),
                inset 0 -4px 0 rgba(0,0,0,0.1);
        }
        /* Cross weave */
        .basket-body::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    transparent 0px, transparent 14px,
                    rgba(0,0,0,0.06) 14px, rgba(0,0,0,0.06) 16px
                );
            pointer-events: none;
        }
        /* Inner shadow for depth */
        .basket-body::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: 24px;
            box-shadow: inset 0 8px 20px rgba(0,0,0,0.12), inset 0 -4px 12px rgba(0,0,0,0.08);
            pointer-events: none;
        }

        /* Cloth lining peeking over edges */
        .basket-cloth {
            position: absolute;
            top: -8px; left: 30px; right: 30px;
            height: 20px;
            background: rgba(245,240,232,0.7);
            border-radius: 0 0 50% 50% / 0 0 100% 100%;
            z-index: 1;
        }

        .basket-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .basket-item {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .basket-item:hover {
            transform: translateY(-8px) scale(1.03);
            z-index: 5;
        }

        .basket-img {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            position: relative;
        }
        .basket-img img {
            width: 100%; height: 200px;
            object-fit: cover; display: block;
        }
        .basket-img .bk-placeholder {
            width: 100%; height: 200px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.08), transparent 60%), #f0e4d4;
        }
        .basket-img .bk-placeholder .ph-emoji { font-size: 36px; }
        .basket-img .bk-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 13px;
            color: var(--warm); opacity: 0.5;
        }

        /* Cloth napkin wrap effect on images */
        .basket-img::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: 12px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
            pointer-events: none;
        }

        .basket-caption {
            text-align: center;
            margin-top: 10px;
            font-family: 'Caveat', cursive;
            font-size: 16px;
            color: var(--brown);
        }

        /* Center item larger */
        .basket-item:nth-child(2) .basket-img img,
        .basket-item:nth-child(2) .basket-img .bk-placeholder { height: 240px; }

        @media (max-width: 768px) {
            .basket-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
            .basket-body { padding: 24px 16px; }
            .basket-img img, .basket-img .bk-placeholder,
            .basket-item:nth-child(2) .basket-img img,
            .basket-item:nth-child(2) .basket-img .bk-placeholder { height: 150px; }
        }

        /* ═══════════════════════════════════
           Q: OVEN DOOR
           Looking through an oven window
        ═══════════════════════════════════ */
        .oven-section {
            padding: 80px 20px 100px;
            background: #111;
            position: relative; overflow: hidden;
        }
        .oven-section .section-head h2 { color: var(--cream); }
        .oven-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .oven-door {
            max-width: 700px; margin: 0 auto;
            position: relative;
        }

        /* Oven body */
        .oven-body {
            background: linear-gradient(180deg, #2a2a2a, #222, #1a1a1a);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            position: relative;
        }
        /* Oven handle */
        .oven-handle {
            position: absolute;
            bottom: -16px; left: 50%; transform: translateX(-50%);
            width: 200px; height: 10px;
            background: linear-gradient(180deg, #555, #444, #555);
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        /* Oven window (the glass) */
        .oven-glass {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            /* Warm orange glow inside */
            background: radial-gradient(ellipse at 50% 60%, rgba(255,140,40,0.08), rgba(255,80,20,0.03), #0a0500);
        }
        /* Glass tint */
        .oven-glass::after {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 50%, transparent 40%, rgba(0,0,0,0.3)),
                linear-gradient(180deg, rgba(255,200,100,0.03), transparent 30%);
            pointer-events: none;
            z-index: 3;
            border-radius: 8px;
        }

        /* Warm glow pulsing */
        .oven-glow {
            position: absolute; inset: 0;
            border-radius: 8px;
            box-shadow: inset 0 0 80px rgba(255,120,30,0.06);
            animation: oven-pulse 3s infinite ease-in-out;
            pointer-events: none;
            z-index: 1;
        }
        @keyframes oven-pulse {
            0%, 100% { box-shadow: inset 0 0 80px rgba(255,120,30,0.04); }
            50% { box-shadow: inset 0 0 100px rgba(255,120,30,0.08); }
        }

        .oven-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            padding: 16px;
            position: relative;
            z-index: 2;
        }

        .oven-item {
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.4s;
            position: relative;
        }
        .oven-item:hover {
            transform: scale(1.05);
            z-index: 5;
            box-shadow: 0 0 30px rgba(255,120,30,0.15);
        }
        .oven-item img {
            width: 100%; height: 180px;
            object-fit: cover; display: block;
            /* Warm tint like oven light */
            filter: brightness(0.85) saturate(1.1) sepia(0.1);
            transition: filter 0.4s;
        }
        .oven-item:hover img {
            filter: brightness(1) saturate(1.1) sepia(0);
        }
        .oven-item .oven-placeholder {
            width: 100%; height: 180px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(255,120,30,0.05), transparent 60%), #0a0500;
        }
        .oven-item .oven-placeholder .ph-emoji { font-size: 36px; }
        .oven-item .oven-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 13px;
            color: rgba(255,180,100,0.3);
        }

        .oven-caption {
            text-align: center; padding: 8px;
            font-family: 'Caveat', cursive;
            font-size: 15px;
            color: rgba(255,200,140,0.5);
        }

        /* Temperature display */
        .oven-temp {
            position: absolute;
            top: -12px; right: 24px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: rgba(255,120,30,0.5);
            letter-spacing: 1px;
            z-index: 4;
        }

        /* Center item spans wider */
        .oven-item.oven-wide {
            grid-column: span 2;
        }
        .oven-item.oven-wide img,
        .oven-item.oven-wide .oven-placeholder { height: 220px; }

        @media (max-width: 768px) {
            .oven-grid { grid-template-columns: repeat(2, 1fr); }
            .oven-item.oven-wide { grid-column: span 2; }
            .oven-item img, .oven-item .oven-placeholder { height: 150px; }
            .oven-item.oven-wide img, .oven-item.oven-wide .oven-placeholder { height: 170px; }
        }

        /* ═══════════════════════════════════
           R: FLOUR-DUSTED TABLE
           Simple elegant dark table, photos with flour dust scatter
        ═══════════════════════════════════ */
        .flour-table-section {
            padding: 80px 20px 100px;
            position: relative; overflow: hidden;
            background: #1c1410;
        }
        .flour-table-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 50%);
            pointer-events: none;
        }
        .flour-table-section .section-head h2 { color: var(--cream); }
        .ft-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .flour-table {
            max-width: 900px; margin: 0 auto;
            position: relative;
        }

        /* Flour scatter across the table */
        .flour-scatter {
            position: absolute; inset: -20px; pointer-events: none; z-index: 0;
        }
        .flour-scatter span {
            position: absolute;
            background: rgba(245,230,208,0.06);
            border-radius: 50%;
        }
        .flour-scatter span:nth-child(1) { width: 200px; height: 200px; top: 5%; left: 0; filter: blur(40px); }
        .flour-scatter span:nth-child(2) { width: 150px; height: 150px; bottom: 10%; right: 5%; filter: blur(30px); }
        .flour-scatter span:nth-child(3) { width: 100px; height: 100px; top: 40%; left: 60%; filter: blur(20px); }

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
            transform: scale(1.03);
            z-index: 5;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .ft-item img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
        }
        .ft-item .ft-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
            min-height: 180px;
        }
        .ft-item .ft-placeholder .ph-emoji { font-size: 40px; }
        .ft-item .ft-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 14px;
            color: rgba(245,230,208,0.25);
        }

        .ft-item .ft-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 32px 14px 12px;
            background: linear-gradient(transparent, rgba(26,15,8,0.7));
        }
        .ft-item .ft-caption {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            color: var(--cream);
        }

        /* Hero item spans 2 rows */
        .ft-item.ft-hero {
            grid-row: span 2;
        }

        /* Small items */
        .ft-item.ft-small img,
        .ft-item.ft-small .ft-placeholder { height: 180px; }

        @media (max-width: 768px) {
            .ft-grid {
                grid-template-columns: 1fr 1fr;
            }
            .ft-item.ft-hero { grid-row: span 1; }
            .ft-item.ft-hero img { height: 220px; }
            .ft-item.ft-small img, .ft-item.ft-small .ft-placeholder { height: 160px; }
        }
    </style>
</head>
<body>

    <nav class="concept-nav">
        <a href="#option-n">N: Cooling Rack</a>
        <a href="#option-o">O: Kitchen Window</a>
        <a href="#option-p">P: Bread Basket</a>
        <a href="#option-q">Q: Oven Door</a>
        <a href="#option-r">R: Flour Table</a>
    </nav>

    <!-- ═══ N: COOLING RACK ═══ -->
    <div id="option-n">
        <div class="concept-label">
            <h1>Option N: Cooling Rack</h1>
            <p>Photos sitting on a wire cooling rack with subtle steam rising. Just out of the oven.</p>
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
                            <div class="rack-placeholder">
                                <span class="ph-emoji">🫧</span>
                                <span class="ph-text">Biscotto bubbling</span>
                            </div>
                        </div>
                        <p class="rack-caption">The starter</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <div class="rack-placeholder">
                                <span class="ph-emoji">🍞</span>
                                <span class="ph-text">Scoring day</span>
                            </div>
                        </div>
                        <p class="rack-caption">The craft</p>
                    </div>
                    <div class="rack-item">
                        <div class="rack-img">
                            <div class="rack-placeholder">
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

    <div class="divider"></div>

    <!-- ═══ O: KITCHEN WINDOW ═══ -->
    <div id="option-o">
        <div class="concept-label">
            <h1>Option O: Kitchen Window</h1>
            <p>A wooden window frame with mullions dividing four panes. Photos peek through like you're looking into the kitchen. Curtains on the sides, items on the windowsill.</p>
        </div>
        <section class="window-sill-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="ws-subtitle reveal">A peek through the kitchen window.</p>

            <div class="kitchen-window reveal">
                <div class="window-outer">
                    <div class="window-inner">
                        <div class="curtain left"></div>
                        <div class="curtain right"></div>
                        <div class="window-panes">
                            <div class="window-pane">
                                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                                <span class="pane-caption">The boule</span>
                            </div>
                            <div class="window-pane">
                                <img src="/images/product-english-muffins.jpg" alt="English muffins">
                                <span class="pane-caption">Griddle day</span>
                            </div>
                            <div class="window-pane">
                                <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                                <span class="pane-caption">Fall vibes</span>
                            </div>
                            <div class="window-pane">
                                <div class="wp-placeholder">
                                    <span class="ph-emoji">🫧</span>
                                    <span class="ph-text">Biscotto bubbling</span>
                                </div>
                                <span class="pane-caption">The starter</span>
                            </div>
                        </div>
                    </div>
                    <div class="window-ledge">
                        <div class="sill-item"><span class="sill-emoji">🌿</span><span class="sill-text">rosemary</span></div>
                        <div class="sill-item"><span class="sill-emoji">🍯</span><span class="sill-text">honey</span></div>
                        <div class="sill-item"><span class="sill-emoji">🌾</span><span class="sill-text">wheat</span></div>
                        <div class="sill-item"><span class="sill-emoji">🫙</span><span class="sill-text">starter</span></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ P: BREAD BASKET ═══ -->
    <div id="option-p">
        <div class="concept-label">
            <h1>Option P: Bread Basket</h1>
            <p>A woven basket with cloth lining, holding photos like fresh loaves. Warm cream background, tactile weave texture.</p>
        </div>
        <section class="basket-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="bk-subtitle reveal">Gathered fresh, just for you.</p>

            <div class="bread-basket reveal">
                <div class="basket-body">
                    <div class="basket-cloth"></div>
                    <div class="basket-grid">
                        <div class="basket-item">
                            <div class="basket-img">
                                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                            </div>
                            <p class="basket-caption">The boule</p>
                        </div>
                        <div class="basket-item">
                            <div class="basket-img">
                                <img src="/images/product-english-muffins.jpg" alt="English muffins">
                            </div>
                            <p class="basket-caption">Griddle day!</p>
                        </div>
                        <div class="basket-item">
                            <div class="basket-img">
                                <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                            </div>
                            <p class="basket-caption">Fall vibes</p>
                        </div>
                        <div class="basket-item">
                            <div class="basket-img">
                                <div class="bk-placeholder">
                                    <span class="ph-emoji">🫧</span>
                                    <span class="ph-text">Biscotto</span>
                                </div>
                            </div>
                            <p class="basket-caption">The starter</p>
                        </div>
                        <div class="basket-item">
                            <div class="basket-img">
                                <div class="bk-placeholder">
                                    <span class="ph-emoji">📦</span>
                                    <span class="ph-text">Ready!</span>
                                </div>
                            </div>
                            <p class="basket-caption">Packed with care</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ Q: OVEN DOOR ═══ -->
    <div id="option-q">
        <div class="concept-label">
            <h1>Option Q: Oven Door</h1>
            <p>Looking through the oven window. Warm orange glow pulsing, photos tinted like oven light. Temperature display in the corner. Literally fresh from the oven.</p>
        </div>
        <section class="oven-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="oven-subtitle reveal">Take a peek inside.</p>

            <div class="oven-door reveal">
                <div class="oven-body">
                    <span class="oven-temp">450°F</span>
                    <div class="oven-glass">
                        <div class="oven-glow"></div>
                        <div class="oven-grid">
                            <div class="oven-item oven-wide">
                                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                                <span class="oven-caption">The signature boule</span>
                            </div>
                            <div class="oven-item">
                                <img src="/images/product-english-muffins.jpg" alt="English muffins">
                                <span class="oven-caption">Griddle day</span>
                            </div>
                            <div class="oven-item">
                                <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                                <span class="oven-caption">Fall vibes</span>
                            </div>
                            <div class="oven-item">
                                <div class="oven-placeholder">
                                    <span class="ph-emoji">🫧</span>
                                    <span class="ph-text">Biscotto</span>
                                </div>
                                <span class="oven-caption">The starter</span>
                            </div>
                            <div class="oven-item">
                                <div class="oven-placeholder">
                                    <span class="ph-emoji">📦</span>
                                    <span class="ph-text">Ready!</span>
                                </div>
                                <span class="oven-caption">Packed</span>
                            </div>
                        </div>
                    </div>
                    <div class="oven-handle"></div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ R: FLOUR-DUSTED TABLE ═══ -->
    <div id="option-r">
        <div class="concept-label">
            <h1>Option R: Flour-Dusted Table</h1>
            <p>Clean and elegant. Dark wood table with flour dust scattered across. Photos in a magazine-style asymmetric layout. One large hero, smaller ones beside it.</p>
        </div>
        <section class="flour-table-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="ft-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="flour-table reveal">
                <div class="flour-scatter">
                    <span></span><span></span><span></span>
                </div>
                <div class="ft-grid">
                    <div class="ft-item ft-hero">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <div class="ft-overlay">
                            <span class="ft-caption">The signature boule</span>
                        </div>
                    </div>
                    <div class="ft-item ft-small">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <div class="ft-overlay">
                            <span class="ft-caption">Griddle day!</span>
                        </div>
                    </div>
                    <div class="ft-item ft-small">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <div class="ft-overlay">
                            <span class="ft-caption">Fall vibes</span>
                        </div>
                    </div>
                    <div class="ft-item ft-small">
                        <div class="ft-placeholder">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                    </div>
                    <div class="ft-item ft-small">
                        <div class="ft-placeholder">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
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
        const sections = ['option-n', 'option-o', 'option-p', 'option-q', 'option-r'];
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
