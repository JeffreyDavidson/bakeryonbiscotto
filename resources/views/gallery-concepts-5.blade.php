<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Round 5</title>
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
            font-size: 15px; max-width: 560px; margin: 0 auto;
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
           S: FLOUR TABLE v2 (fixed — visible flour)
           Dark table with real flour dust splatters
        ═══════════════════════════════════ */
        .flour-table-v2 {
            padding: 80px 20px 100px;
            position: relative; overflow: hidden;
            background: #1c1410;
        }
        /* Wood grain texture */
        .flour-table-v2::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(85deg, transparent, rgba(80,55,35,0.04) 1px, transparent 3px),
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 50%);
            pointer-events: none;
        }
        .flour-table-v2 .section-head h2 { color: var(--cream); }
        .ft2-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .ft2-container {
            max-width: 900px; margin: 0 auto;
            position: relative;
        }

        /* Visible flour dust patches */
        .flour-patch {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }
        .flour-patch::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245,235,220,0.2), rgba(245,235,220,0.08) 40%, transparent 70%);
        }
        /* Scattered small dots of flour */
        .flour-patch::after {
            content: '';
            position: absolute;
            width: 200%; height: 200%;
            top: -50%; left: -50%;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(245,235,220,0.35) 1px, transparent 1px),
                radial-gradient(circle at 60% 15%, rgba(245,235,220,0.25) 1.5px, transparent 1.5px),
                radial-gradient(circle at 80% 60%, rgba(245,235,220,0.3) 1px, transparent 1px),
                radial-gradient(circle at 40% 70%, rgba(245,235,220,0.2) 2px, transparent 2px),
                radial-gradient(circle at 10% 80%, rgba(245,235,220,0.25) 1px, transparent 1px),
                radial-gradient(circle at 70% 40%, rgba(245,235,220,0.3) 1.5px, transparent 1.5px),
                radial-gradient(circle at 30% 50%, rgba(245,235,220,0.15) 2px, transparent 2px),
                radial-gradient(circle at 90% 20%, rgba(245,235,220,0.2) 1px, transparent 1px),
                radial-gradient(circle at 50% 90%, rgba(245,235,220,0.25) 1.5px, transparent 1.5px);
            pointer-events: none;
        }

        .flour-patch.fp1 { width: 300px; height: 280px; top: -30px; left: -20px; }
        .flour-patch.fp2 { width: 250px; height: 220px; bottom: -20px; right: 0; }
        .flour-patch.fp3 { width: 180px; height: 160px; top: 40%; left: 55%; }
        .flour-patch.fp4 { width: 120px; height: 120px; top: 20%; right: 15%; }

        /* Flour handprint */
        .flour-handprint {
            position: absolute;
            bottom: 20px; left: 60px;
            font-size: 48px;
            opacity: 0.08;
            transform: rotate(-15deg);
            z-index: 1;
            pointer-events: none;
        }

        /* Rolling pin flour trail */
        .flour-trail {
            position: absolute;
            top: 50%; right: -40px;
            width: 180px; height: 40px;
            background: linear-gradient(90deg, rgba(245,235,220,0.1), rgba(245,235,220,0.03), transparent);
            transform: rotate(-5deg);
            z-index: 1;
            pointer-events: none;
        }

        .ft2-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .ft2-item {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ft2-item:hover {
            transform: scale(1.03); z-index: 5;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .ft2-item img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .ft2-item .ft2-ph {
            width: 100%; height: 100%; min-height: 180px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
        }
        .ft2-item .ft2-ph .ph-emoji { font-size: 40px; }
        .ft2-item .ft2-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 14px;
            color: rgba(245,230,208,0.25);
        }
        .ft2-item .ft2-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 32px 14px 12px;
            background: linear-gradient(transparent, rgba(26,15,8,0.7));
        }
        .ft2-item .ft2-caption {
            font-family: 'Caveat', cursive; font-size: 18px; color: var(--cream);
        }
        .ft2-item.ft2-hero { grid-row: span 2; }

        @media (max-width: 768px) {
            .ft2-grid { grid-template-columns: 1fr 1fr; }
            .ft2-item.ft2-hero { grid-row: span 1; }
            .ft2-item.ft2-hero img { height: 220px; }
            .ft2-item img, .ft2-item .ft2-ph { min-height: 160px; }
            .flour-patch { display: none; }
        }

        /* ═══════════════════════════════════
           T: PARALLAX SCROLL REVEAL
           Inspired by luxury fashion lookbooks.
           Photos reveal on scroll with parallax depth.
        ═══════════════════════════════════ */
        .parallax-gallery {
            padding: 80px 0 100px;
            background: var(--dark);
            position: relative; overflow: hidden;
        }
        .parallax-gallery .section-head { padding: 0 20px; }
        .parallax-gallery .section-head h2 { color: var(--cream); }
        .px-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
            padding: 0 20px;
        }

        .px-strip {
            max-width: 900px; margin: 0 auto;
            padding: 0 20px;
        }

        .px-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            align-items: stretch;
        }
        .px-row.reverse { flex-direction: row-reverse; }

        .px-item {
            overflow: hidden;
            border-radius: 8px;
            position: relative;
            flex: 1;
        }
        .px-item.wide { flex: 2; }

        .px-item img {
            width: 100%; height: 280px;
            object-fit: cover; display: block;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .px-item:hover img { transform: scale(1.06); }

        .px-item .px-ph {
            width: 100%; height: 280px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
        }
        .px-item .px-ph .ph-emoji { font-size: 40px; }
        .px-item .px-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 14px;
            color: rgba(245,230,208,0.25);
        }

        /* Caption slides up on hover */
        .px-item .px-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 40px 16px 14px;
            background: linear-gradient(transparent, rgba(26,15,8,0.75));
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px; font-weight: 500;
            color: var(--cream);
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .px-item:hover .px-caption { transform: translateY(0); }

        /* Stagger reveal on scroll */
        .px-row .px-item { opacity: 0; transform: translateY(40px); }
        .px-row.visible .px-item {
            opacity: 1; transform: translateY(0);
            transition: opacity 0.6s, transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .px-row.visible .px-item:nth-child(2) { transition-delay: 0.15s; }
        .px-row.visible .px-item:nth-child(3) { transition-delay: 0.3s; }

        @media (max-width: 768px) {
            .px-row, .px-row.reverse { flex-direction: column; }
            .px-item img, .px-item .px-ph { height: 200px; }
            .px-item .px-caption { transform: translateY(0); }
        }

        /* ═══════════════════════════════════
           U: RUSTIC CORKBOARD
           Inspired by cafe/wine bar tasting boards.
           Cork texture, washi tape, thumbtacks, handwritten notes.
        ═══════════════════════════════════ */
        .corkboard-section {
            padding: 80px 20px 100px;
            position: relative; overflow: hidden;
            /* Cork color */
            background: #b8956a;
        }
        /* Cork texture */
        .corkboard-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(circle at 15% 25%, rgba(0,0,0,0.04), transparent 3%),
                radial-gradient(circle at 45% 60%, rgba(0,0,0,0.03), transparent 2%),
                radial-gradient(circle at 75% 35%, rgba(0,0,0,0.04), transparent 3%),
                radial-gradient(circle at 30% 80%, rgba(0,0,0,0.03), transparent 2%),
                radial-gradient(circle at 85% 75%, rgba(0,0,0,0.04), transparent 2.5%),
                radial-gradient(circle at 55% 15%, rgba(0,0,0,0.03), transparent 2%),
                radial-gradient(circle at 65% 90%, rgba(0,0,0,0.04), transparent 3%),
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.03), transparent 3%),
                radial-gradient(circle at 90% 45%, rgba(255,255,255,0.02), transparent 2%);
            pointer-events: none;
        }
        /* Wooden frame */
        .corkboard-section::after {
            content: '';
            position: absolute; inset: 0;
            border: 14px solid #5a4030;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.15), 0 0 20px rgba(0,0,0,0.2);
            pointer-events: none;
        }

        .corkboard-section .section-head h2 {
            color: var(--dark-brown);
            text-shadow: 0 1px 0 rgba(255,255,255,0.2);
        }
        .corkboard-section .accent-line {
            background: linear-gradient(90deg, transparent, rgba(61,35,20,0.3), transparent);
        }
        .cork-subtitle {
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 22px;
            color: rgba(61,35,20,0.5);
            margin-bottom: 48px;
        }

        .cork-photos {
            max-width: 850px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: 18px;
            gap: 0;
            position: relative;
            z-index: 1;
        }

        .cork-photo {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cork-photo:hover {
            z-index: 10;
            transform: scale(1.05) rotate(0deg) !important;
        }

        .cork-frame {
            background: white;
            padding: 6px 6px 24px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            position: relative;
        }
        .cork-frame img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .cork-frame .cork-ph {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 4px;
            background: #faf5ef;
        }
        .cork-frame .cork-ph .ph-emoji { font-size: 32px; }
        .cork-frame .cork-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 12px;
            color: var(--warm); opacity: 0.4;
        }

        .cork-caption {
            position: absolute;
            bottom: 4px; left: 6px; right: 6px;
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 13px; color: var(--brown);
        }

        /* Washi tape */
        .washi-tape {
            position: absolute; z-index: 3;
            width: 60px; height: 18px;
            border-radius: 1px;
            opacity: 0.75;
        }
        .washi-cream { background: repeating-linear-gradient(45deg, rgba(212,165,116,0.4), rgba(212,165,116,0.4) 3px, rgba(212,165,116,0.25) 3px, rgba(212,165,116,0.25) 6px); }
        .washi-red { background: repeating-linear-gradient(45deg, rgba(180,80,70,0.35), rgba(180,80,70,0.35) 3px, rgba(180,80,70,0.2) 3px, rgba(180,80,70,0.2) 6px); }
        .washi-green { background: repeating-linear-gradient(45deg, rgba(80,140,80,0.3), rgba(80,140,80,0.3) 3px, rgba(80,140,80,0.18) 3px, rgba(80,140,80,0.18) 6px); }

        /* Thumbtack */
        .thumbtack {
            position: absolute; z-index: 4;
            width: 14px; height: 14px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.25);
        }
        .tack-red { background: radial-gradient(circle at 40% 35%, #d44, #a22); }
        .tack-gold { background: radial-gradient(circle at 40% 35%, #daa, #a87); }
        .tack-green { background: radial-gradient(circle at 40% 35%, #4a4, #282); }

        /* Handwritten sticky note */
        .sticky-note {
            position: absolute; z-index: 2;
            background: #fff8a8;
            padding: 12px 14px;
            font-family: 'Caveat', cursive;
            font-size: 15px;
            color: #554;
            transform: rotate(-3deg);
            box-shadow: 2px 3px 8px rgba(0,0,0,0.12);
            line-height: 1.4;
        }

        /* Photo positions */
        .cork-photo:nth-child(1) {
            grid-column: 1 / 6; grid-row: 1 / 13;
            transform: rotate(-2.5deg);
        }
        .cork-photo:nth-child(2) {
            grid-column: 5 / 9; grid-row: 2 / 15;
            transform: rotate(1.5deg);
        }
        .cork-photo:nth-child(3) {
            grid-column: 9 / 13; grid-row: 1 / 11;
            transform: rotate(-1deg);
        }
        .cork-photo:nth-child(4) {
            grid-column: 2 / 6; grid-row: 15 / 25;
            transform: rotate(2deg);
        }
        .cork-photo:nth-child(5) {
            grid-column: 7 / 12; grid-row: 14 / 24;
            transform: rotate(-2deg);
        }

        @media (max-width: 768px) {
            .cork-photos {
                display: flex; flex-wrap: wrap;
                justify-content: center; gap: 16px;
            }
            .cork-photo { width: 45%; }
            .cork-frame img, .cork-frame .cork-ph { height: 150px; }
            .sticky-note { display: none; }
        }

        /* ═══════════════════════════════════
           V: SPLIT SCREEN SCROLL
           Inspired by fashion/editorial. Left side fixed text,
           right side scrollable photo stack.
        ═══════════════════════════════════ */
        .split-gallery {
            padding: 0;
            background: var(--dark);
            position: relative; overflow: hidden;
        }
        .split-inner {
            max-width: 1000px; margin: 0 auto;
            display: flex;
            min-height: 600px;
        }
        .split-left {
            flex: 0 0 35%;
            padding: 80px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .split-left h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.2rem, 4vw, 3rem);
            color: var(--cream);
            margin-bottom: 12px;
        }
        .split-left .sl-line {
            width: 60px; height: 2px;
            background: var(--golden);
            margin-bottom: 20px;
        }
        .split-left p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: rgba(245,230,208,0.45);
            line-height: 1.7;
        }
        .split-left .photo-count {
            margin-top: 32px;
            font-family: 'Caveat', cursive;
            font-size: 16px;
            color: rgba(245,230,208,0.25);
        }

        .split-right {
            flex: 1;
            padding: 40px 20px 40px 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sr-photo {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s;
        }
        .sr-photo:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .sr-photo img {
            width: 100%; height: 300px;
            object-fit: cover; display: block;
            transition: transform 0.5s;
        }
        .sr-photo:hover img { transform: scale(1.04); }

        .sr-photo .sr-ph {
            width: 100%; height: 300px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
        }
        .sr-photo .sr-ph .ph-emoji { font-size: 44px; }
        .sr-photo .sr-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 15px;
            color: rgba(245,230,208,0.25);
        }

        .sr-photo .sr-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 32px 16px 14px;
            background: linear-gradient(transparent, rgba(26,15,8,0.6));
            font-family: 'Caveat', cursive;
            font-size: 18px;
            color: var(--cream);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .sr-photo:hover .sr-caption { opacity: 1; }

        @media (max-width: 768px) {
            .split-inner { flex-direction: column; }
            .split-left {
                position: relative; height: auto;
                padding: 60px 20px 20px;
                text-align: center;
            }
            .split-left .sl-line { margin: 0 auto 20px; }
            .split-right { padding: 20px; }
            .sr-photo img, .sr-photo .sr-ph { height: 220px; }
        }

        /* ═══════════════════════════════════
           W: HOVER REVEAL GRID
           Inspired by agency portfolios. Minimal grid,
           photos are muted/dark until hover reveals full color.
           Cursor spotlight effect.
        ═══════════════════════════════════ */
        .hover-reveal-section {
            padding: 80px 20px 100px;
            background: #111;
            position: relative; overflow: hidden;
        }
        .hover-reveal-section .section-head h2 { color: var(--cream); }
        .hr-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 17px;
            color: rgba(245,230,208,0.35);
            margin-bottom: 56px;
        }

        .hr-grid {
            max-width: 900px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 4px;
        }

        .hr-cell {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .hr-cell img {
            width: 100%; height: 240px;
            object-fit: cover; display: block;
            filter: brightness(0.3) saturate(0);
            transition: filter 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .hr-cell:hover img {
            filter: brightness(1) saturate(1);
        }
        .hr-cell .hr-ph {
            width: 100%; height: 240px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: #0a0a0a;
            transition: background 0.5s;
        }
        .hr-cell:hover .hr-ph {
            background: #1a1208;
        }
        .hr-cell .hr-ph .ph-emoji {
            font-size: 36px;
            filter: brightness(0.4);
            transition: filter 0.5s;
        }
        .hr-cell:hover .hr-ph .ph-emoji { filter: brightness(1); }
        .hr-cell .hr-ph .ph-text {
            font-family: 'Caveat', cursive; font-size: 13px;
            color: rgba(245,230,208,0.15);
            transition: color 0.5s;
        }
        .hr-cell:hover .hr-ph .ph-text { color: rgba(245,230,208,0.35); }

        /* Caption */
        .hr-cell .hr-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 32px 12px 12px;
            background: linear-gradient(transparent, rgba(0,0,0,0.6));
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; font-weight: 500;
            color: white;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s;
        }
        .hr-cell:hover .hr-caption {
            opacity: 1; transform: translateY(0);
        }

        /* Cursor glow */
        .hr-grid-wrap {
            position: relative;
        }
        .hr-cursor-glow {
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(244,200,122,0.06), transparent 60%);
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 3;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .hr-grid-wrap:hover .hr-cursor-glow { opacity: 1; }

        /* First item spans 2 cols */
        .hr-cell.hr-hero {
            grid-column: span 2;
        }
        .hr-cell.hr-hero img, .hr-cell.hr-hero .hr-ph { height: 300px; }

        @media (max-width: 768px) {
            .hr-grid { grid-template-columns: repeat(2, 1fr); }
            .hr-cell.hr-hero { grid-column: span 2; }
            .hr-cell img, .hr-cell .hr-ph { height: 180px; }
            .hr-cell.hr-hero img, .hr-cell.hr-hero .hr-ph { height: 200px; }
            .hr-cell img { filter: brightness(0.9) saturate(0.8); }
        }
    </style>
</head>
<body>

    <nav class="concept-nav">
        <a href="#option-s">S: Flour Table v2</a>
        <a href="#option-t">T: Parallax Scroll</a>
        <a href="#option-u">U: Corkboard</a>
        <a href="#option-v">V: Split Screen</a>
        <a href="#option-w">W: Hover Reveal</a>
    </nav>

    <!-- ═══ S: FLOUR TABLE v2 ═══ -->
    <div id="option-s">
        <div class="concept-label">
            <h1>Option S: Flour-Dusted Table (Fixed)</h1>
            <p>The same dark wood table, but now with visible flour dust patches, scattered flour speckles, and a faint handprint. You can see the flour this time.</p>
        </div>
        <section class="flour-table-v2">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="ft2-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="ft2-container reveal">
                <div class="flour-patch fp1"></div>
                <div class="flour-patch fp2"></div>
                <div class="flour-patch fp3"></div>
                <div class="flour-patch fp4"></div>
                <div class="flour-handprint">🤚</div>
                <div class="flour-trail"></div>

                <div class="ft2-grid">
                    <div class="ft2-item ft2-hero">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <div class="ft2-overlay"><span class="ft2-caption">The signature boule</span></div>
                    </div>
                    <div class="ft2-item">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <div class="ft2-overlay"><span class="ft2-caption">Griddle day!</span></div>
                    </div>
                    <div class="ft2-item">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <div class="ft2-overlay"><span class="ft2-caption">Fall vibes</span></div>
                    </div>
                    <div class="ft2-item">
                        <div class="ft2-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                    </div>
                    <div class="ft2-item">
                        <div class="ft2-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ T: PARALLAX SCROLL REVEAL ═══ -->
    <div id="option-t">
        <div class="concept-label">
            <h1>Option T: Staggered Scroll Reveal</h1>
            <p>Inspired by luxury fashion lookbooks. Photos stagger in as you scroll, alternating wide and narrow. Clean, editorial, modern.</p>
        </div>
        <section class="parallax-gallery">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="px-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="px-strip">
                <div class="px-row reveal">
                    <div class="px-item wide">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <span class="px-caption">The signature boule</span>
                    </div>
                    <div class="px-item">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <span class="px-caption">Griddle day!</span>
                    </div>
                </div>
                <div class="px-row reverse reveal">
                    <div class="px-item wide">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <span class="px-caption">Fall vibes</span>
                    </div>
                    <div class="px-item">
                        <div class="px-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                    </div>
                </div>
                <div class="px-row reveal">
                    <div class="px-item">
                        <div class="px-ph">
                            <span class="ph-emoji">🍞</span>
                            <span class="ph-text">Scoring day</span>
                        </div>
                    </div>
                    <div class="px-item">
                        <div class="px-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
                    </div>
                    <div class="px-item">
                        <div class="px-ph">
                            <span class="ph-emoji">🌾</span>
                            <span class="ph-text">Fresh flour</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ U: CORKBOARD ═══ -->
    <div id="option-u">
        <div class="concept-label">
            <h1>Option U: Rustic Corkboard</h1>
            <p>Inspired by cafe tasting boards and wine bars. Real cork texture with wooden frame, washi tape strips, thumbtacks, a handwritten sticky note. Lived-in, warm, personal.</p>
        </div>
        <section class="corkboard-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="cork-subtitle reveal">~ what's baking this week ~</p>

            <div class="cork-photos reveal">
                <!-- Sticky note -->
                <div class="sticky-note" style="grid-column: 5 / 8; grid-row: 16 / 20; z-index: 8;">
                    bake day = best day ☀️<br>- Cassie
                </div>

                <div class="cork-photo">
                    <div class="washi-tape washi-cream" style="top: -8px; left: 20%; transform: rotate(-8deg);"></div>
                    <div class="thumbtack tack-red" style="top: -6px; right: 20%;"></div>
                    <div class="cork-frame">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule" style="height: 180px;">
                        <span class="cork-caption">The boule</span>
                    </div>
                </div>

                <div class="cork-photo">
                    <div class="thumbtack tack-gold" style="top: -6px; left: 40%;"></div>
                    <div class="cork-frame">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins" style="height: 210px;">
                        <span class="cork-caption">Griddle day!</span>
                    </div>
                </div>

                <div class="cork-photo">
                    <div class="washi-tape washi-red" style="top: -8px; left: 15%; transform: rotate(5deg);"></div>
                    <div class="cork-frame">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread" style="height: 160px;">
                        <span class="cork-caption">Fall vibes</span>
                    </div>
                </div>

                <div class="cork-photo">
                    <div class="washi-tape washi-green" style="top: -8px; right: 10%; transform: rotate(-4deg);"></div>
                    <div class="cork-frame">
                        <div class="cork-ph" style="height: 160px;">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto</span>
                        </div>
                        <span class="cork-caption">The starter</span>
                    </div>
                </div>

                <div class="cork-photo">
                    <div class="thumbtack tack-green" style="top: -6px; left: 45%;"></div>
                    <div class="cork-frame">
                        <div class="cork-ph" style="height: 150px;">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Ready!</span>
                        </div>
                        <span class="cork-caption">Packed with care</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ V: SPLIT SCREEN ═══ -->
    <div id="option-v">
        <div class="concept-label">
            <h1>Option V: Split Screen Scroll</h1>
            <p>Inspired by fashion editorial sites. Left side stays fixed with the heading and description while you scroll through a vertical stack of photos on the right. Clean and modern.</p>
        </div>
        <section class="split-gallery">
            <div class="split-inner">
                <div class="split-left">
                    <h2>Fresh from the Oven</h2>
                    <div class="sl-line"></div>
                    <p>A peek into our kitchen and what's baking today. Every loaf shaped by hand, every batch baked with care.</p>
                    <div class="photo-count">5 photos</div>
                </div>
                <div class="split-right">
                    <div class="sr-photo">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <span class="sr-caption">The signature boule</span>
                    </div>
                    <div class="sr-photo">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <span class="sr-caption">Griddle day!</span>
                    </div>
                    <div class="sr-photo">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <span class="sr-caption">Fall vibes</span>
                    </div>
                    <div class="sr-photo">
                        <div class="sr-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                        <span class="sr-caption">The starter</span>
                    </div>
                    <div class="sr-photo">
                        <div class="sr-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
                        <span class="sr-caption">Ready for you</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ W: HOVER REVEAL ═══ -->
    <div id="option-w">
        <div class="concept-label">
            <h1>Option W: Hover Reveal Grid</h1>
            <p>Inspired by agency portfolios. All photos are dark and desaturated. Hover over one and it blooms to full color with a warm cursor glow. Dramatic reveal effect.</p>
        </div>
        <section class="hover-reveal-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="hr-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="hr-grid-wrap reveal">
                <div class="hr-cursor-glow" id="hrGlow"></div>
                <div class="hr-grid" id="hrGrid">
                    <div class="hr-cell hr-hero">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <span class="hr-caption">The signature boule</span>
                    </div>
                    <div class="hr-cell">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <span class="hr-caption">Griddle day!</span>
                    </div>
                    <div class="hr-cell">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <span class="hr-caption">Fall vibes</span>
                    </div>
                    <div class="hr-cell">
                        <div class="hr-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                        <span class="hr-caption">The starter</span>
                    </div>
                    <div class="hr-cell">
                        <div class="hr-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Packed with care</span>
                        </div>
                        <span class="hr-caption">Ready for you</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }});
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Parallax row reveal
        const rowObserver = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); rowObserver.unobserve(e.target); }});
        }, { threshold: 0.2 });
        document.querySelectorAll('.px-row').forEach(el => rowObserver.observe(el));

        // Hover reveal cursor glow
        const hrGrid = document.getElementById('hrGrid');
        const hrGlow = document.getElementById('hrGlow');
        if (hrGrid && hrGlow) {
            hrGrid.parentElement.addEventListener('mousemove', (e) => {
                const rect = hrGrid.parentElement.getBoundingClientRect();
                hrGlow.style.left = (e.clientX - rect.left) + 'px';
                hrGlow.style.top = (e.clientY - rect.top) + 'px';
            });
        }

        // Nav active
        const navLinks = document.querySelectorAll('.concept-nav a');
        const sections = ['option-s', 'option-t', 'option-u', 'option-v', 'option-w'];
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
