<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Gallery Concepts Round 3</title>
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
            --candle: #f4c87a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0d0805;
            color: var(--cream);
        }

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
            border-color: var(--golden);
            color: var(--golden);
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
        .section-head { text-align: center; margin-bottom: 48px; }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.4rem, 5vw, 3.5rem);
            font-weight: 700;
        }
        .accent-line {
            width: 100px; height: 2px; margin: 16px auto;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
        }
        .ig-cta svg { width: 16px; height: 16px; }
        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════════
           I: RECIPE BOX
           Old wooden recipe box with tabbed index cards
        ═══════════════════════════════════ */
        .recipe-box-section {
            padding: 80px 20px 100px;
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }
        .recipe-box-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 30%, rgba(244,200,122,0.06), transparent 50%),
                radial-gradient(ellipse at 30% 80%, rgba(139,94,60,0.04), transparent 40%);
            pointer-events: none;
        }
        .recipe-box-section .section-head h2 { color: var(--cream); }
        .rb-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.35);
            margin-top: -24px; margin-bottom: 56px;
        }

        .recipe-box {
            max-width: 800px; margin: 0 auto;
            position: relative;
        }
        /* The wooden box */
        .box-body {
            background:
                linear-gradient(170deg, #5a3e2b 0%, #6d4c35 30%, #5a3e2b 60%, #4a3020 100%);
            border-radius: 8px 8px 12px 12px;
            padding: 32px 28px 36px;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.06),
                inset 0 -2px 0 rgba(0,0,0,0.2);
            position: relative;
        }
        /* Wood grain */
        .box-body::before {
            content: '';
            position: absolute; inset: 0; border-radius: 8px 8px 12px 12px;
            background: repeating-linear-gradient(
                95deg, transparent, rgba(0,0,0,0.03) 1px, transparent 3px
            );
            pointer-events: none;
        }
        /* Little metal clasp */
        .box-clasp {
            position: absolute;
            top: -6px; left: 50%; transform: translateX(-50%);
            width: 40px; height: 12px;
            background: linear-gradient(180deg, #a89070, #7a6450);
            border-radius: 4px 4px 0 0;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.3);
        }
        .box-clasp::after {
            content: '';
            position: absolute;
            top: 3px; left: 50%; transform: translateX(-50%);
            width: 8px; height: 4px;
            border-radius: 2px;
            background: #635040;
        }

        /* Index card tabs sticking up */
        .card-tabs {
            display: flex; justify-content: center;
            gap: 4px; margin-bottom: -4px;
            position: relative; z-index: 2;
        }
        .card-tab {
            padding: 8px 20px;
            background: var(--parchment);
            border-radius: 6px 6px 0 0;
            font-family: 'Caveat', cursive;
            font-size: 15px;
            color: var(--brown);
            cursor: pointer;
            border: 1px solid rgba(139,94,60,0.15);
            border-bottom: none;
            transition: all 0.3s;
            position: relative;
        }
        .card-tab.active {
            background: #faf3ea;
            color: var(--dark-brown);
            font-weight: 600;
            padding-bottom: 12px;
            z-index: 3;
        }
        .card-tab:hover:not(.active) {
            background: #f5ead8;
        }

        /* The visible recipe card */
        .recipe-cards {
            position: relative;
        }
        .recipe-card-item {
            display: none;
            background: #faf3ea;
            border-radius: 4px;
            padding: 28px;
            min-height: 280px;
            position: relative;
            box-shadow: inset 0 0 30px rgba(139,94,60,0.05);
        }
        .recipe-card-item.active { display: flex; gap: 28px; align-items: center; }

        /* Ruled lines on card */
        .recipe-card-item::before {
            content: '';
            position: absolute; inset: 0;
            background: repeating-linear-gradient(
                180deg,
                transparent,
                transparent 31px,
                rgba(139,94,60,0.08) 31px,
                rgba(139,94,60,0.08) 32px
            );
            pointer-events: none;
        }
        /* Red margin line */
        .recipe-card-item::after {
            content: '';
            position: absolute;
            top: 0; bottom: 0; left: 72px;
            width: 1px;
            background: rgba(200,80,80,0.15);
            pointer-events: none;
        }

        .rc-photo {
            flex-shrink: 0;
            width: 220px; height: 220px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            position: relative; z-index: 1;
        }
        .rc-photo img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .rc-photo .rc-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: radial-gradient(circle at 50% 40%, rgba(212,165,116,0.08), transparent 60%), #f0e4d4;
        }
        .rc-photo .rc-placeholder .ph-emoji { font-size: 48px; }
        .rc-photo .rc-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 15px;
            color: var(--warm); opacity: 0.5;
        }

        .rc-details {
            flex: 1;
            position: relative; z-index: 1;
        }
        .rc-details h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 28px; color: var(--dark-brown);
            margin-bottom: 8px;
        }
        .rc-details .rc-tagline {
            font-family: 'Caveat', cursive;
            font-size: 17px; color: var(--warm-brown);
            margin-bottom: 16px;
        }
        .rc-details .rc-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; line-height: 1.7;
            color: var(--brown);
        }

        /* Stacked cards behind */
        .card-stack {
            position: relative;
        }
        .card-stack::before,
        .card-stack::after {
            content: '';
            position: absolute; left: 4px; right: 4px;
            height: 100%;
            background: var(--parchment);
            border-radius: 4px;
            z-index: -1;
        }
        .card-stack::before {
            bottom: -4px;
            transform: rotate(0.5deg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .card-stack::after {
            bottom: -8px;
            transform: rotate(-0.3deg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            left: 8px; right: 8px;
        }

        .rb-cta {
            text-align: center; margin-top: 48px;
        }
        .gallery-cta {
            display: inline-flex; align-items: center; gap: 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600;
            text-decoration: none;
            letter-spacing: 1px; text-transform: uppercase;
            padding: 12px 32px;
            border-radius: 100px; transition: all 0.3s;
        }
        .gallery-cta svg { width: 16px; height: 16px; }
        .rb-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.25);
        }
        .rb-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .rb-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .recipe-card-item.active { flex-direction: column; }
            .rc-photo { width: 100%; height: 200px; }
            .card-tab { font-size: 13px; padding: 6px 12px; }
        }

        /* ═══════════════════════════════════
           J: FRIDGE DOOR
           Photos held with magnets on a fridge
        ═══════════════════════════════════ */
        .fridge-section {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            /* Fridge surface */
            background: linear-gradient(175deg, #e8e4df 0%, #d8d4cf 50%, #ccc8c3 100%);
        }
        /* Subtle brushed metal texture */
        .fridge-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,0.03) 1px,
                    transparent 2px
                ),
                radial-gradient(ellipse at 40% 30%, rgba(255,255,255,0.3), transparent 50%);
            pointer-events: none;
        }
        /* Fridge handle hint */
        .fridge-handle {
            position: absolute;
            right: 30px; top: 50%; transform: translateY(-50%);
            width: 8px; height: 120px;
            background: linear-gradient(90deg, #b8b4af, #ccc8c3, #b8b4af);
            border-radius: 4px;
            box-shadow: -2px 0 8px rgba(0,0,0,0.1), 2px 0 4px rgba(255,255,255,0.3);
        }

        .fridge-section .section-head h2 {
            color: var(--dark-brown);
            text-shadow: 0 1px 0 rgba(255,255,255,0.5);
        }
        .fridge-section .accent-line {
            background: linear-gradient(90deg, transparent, var(--warm-brown), transparent);
        }
        .fridge-subtitle {
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 20px;
            color: var(--warm);
            margin-top: -20px; margin-bottom: 56px;
        }

        .fridge-photos {
            max-width: 800px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: 16px;
            gap: 0;
            position: relative;
        }

        .fridge-photo {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1;
        }
        .fridge-photo:hover {
            z-index: 10;
            transform: scale(1.06) rotate(0deg) !important;
        }

        /* Photo with white border like printed */
        .fp-frame {
            background: white;
            padding: 6px 6px 28px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.08);
            position: relative;
        }
        .fp-frame img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .fp-frame .fp-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: #faf5ef;
        }
        .fp-frame .fp-placeholder .ph-emoji { font-size: 32px; }
        .fp-frame .fp-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 12px;
            color: var(--warm); opacity: 0.4;
        }
        .fp-caption {
            position: absolute;
            bottom: 6px; left: 6px; right: 6px;
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 13px; color: var(--warm);
        }

        /* Fridge magnets */
        .fridge-magnet {
            position: absolute;
            z-index: 5;
            width: 28px; height: 28px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2), inset 0 1px 0 rgba(255,255,255,0.4);
        }
        .magnet-red { background: radial-gradient(circle at 40% 35%, #e55, #b33); }
        .magnet-blue { background: radial-gradient(circle at 40% 35%, #58d, #36a); }
        .magnet-green { background: radial-gradient(circle at 40% 35%, #5b5, #393); }
        .magnet-yellow { background: radial-gradient(circle at 40% 35%, #ed5, #cb3); }
        .magnet-orange { background: radial-gradient(circle at 40% 35%, #e84, #c62); }

        /* Letter magnets spelling "YUM" */
        .letter-magnets {
            position: absolute;
            display: flex; gap: 4px;
            z-index: 6;
        }
        .letter-magnet {
            width: 32px; height: 36px;
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Inter', sans-serif;
            font-size: 18px; font-weight: 800;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        /* Layout positions */
        .fridge-photo:nth-child(1) {
            grid-column: 1 / 6; grid-row: 1 / 14;
            transform: rotate(-3deg);
        }
        .fridge-photo:nth-child(2) {
            grid-column: 5 / 10; grid-row: 3 / 18;
            transform: rotate(2deg);
        }
        .fridge-photo:nth-child(3) {
            grid-column: 9 / 13; grid-row: 1 / 12;
            transform: rotate(-1.5deg);
        }
        .fridge-photo:nth-child(4) {
            grid-column: 1 / 5; grid-row: 16 / 26;
            transform: rotate(1deg);
        }
        .fridge-photo:nth-child(5) {
            grid-column: 8 / 13; grid-row: 14 / 25;
            transform: rotate(-2deg);
        }

        .fridge-cta {
            text-align: center; margin-top: 48px; position: relative; z-index: 5;
        }
        .fridge-cta .gallery-cta {
            color: var(--dark-brown);
            border: 1.5px solid rgba(139,94,60,0.3);
        }
        .fridge-cta .gallery-cta:hover {
            background: rgba(139,94,60,0.08);
            border-color: var(--warm-brown);
        }
        .fridge-cta .gallery-cta svg { fill: var(--dark-brown); }

        @media (max-width: 768px) {
            .fridge-photos {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: auto;
                gap: 20px;
            }
            .fridge-photo:nth-child(1),
            .fridge-photo:nth-child(2),
            .fridge-photo:nth-child(3),
            .fridge-photo:nth-child(4),
            .fridge-photo:nth-child(5) {
                grid-column: auto; grid-row: auto;
                transform: rotate(0deg);
            }
            .fp-frame img, .fp-frame .fp-placeholder { height: 160px; }
            .fridge-handle { display: none; }
            .letter-magnets { display: none; }
        }

        /* ═══════════════════════════════════
           K: KITCHEN COUNTER
           Overhead view of a counter with scattered photos
        ═══════════════════════════════════ */
        .counter-section {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            /* Butcher block / warm wood */
            background: #4a3828;
        }
        .counter-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    rgba(255,220,160,0.02) 1px,
                    transparent 4px
                ),
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.08), transparent 60%);
            pointer-events: none;
        }
        .counter-section .section-head h2 { color: var(--cream); }
        .counter-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.4);
            margin-top: -24px; margin-bottom: 56px;
        }

        .counter-scene {
            max-width: 900px; margin: 0 auto;
            position: relative;
            min-height: 500px;
        }

        /* Scattered photos on counter */
        .counter-photo {
            position: absolute;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .counter-photo:hover {
            z-index: 20;
            transform: rotate(0deg) scale(1.1) !important;
        }
        .cp-frame {
            background: white;
            padding: 8px 8px 36px;
            box-shadow:
                0 8px 28px rgba(0,0,0,0.3),
                0 2px 6px rgba(0,0,0,0.15);
            position: relative;
        }
        .cp-frame img {
            display: block; object-fit: cover;
        }
        .cp-frame .cp-placeholder {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.06), transparent 60%), #f8f0e4;
        }
        .cp-frame .cp-placeholder .ph-emoji { font-size: 36px; }
        .cp-frame .cp-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 12px;
            color: var(--warm); opacity: 0.5;
        }
        .cp-caption {
            position: absolute;
            bottom: 8px; left: 8px; right: 8px;
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 14px; color: var(--warm);
        }

        /* Props scattered on counter */
        .counter-prop {
            position: absolute;
            pointer-events: none;
            z-index: 1;
        }
        /* Flour dusting */
        .flour-dust {
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(245,230,208,0.08), transparent 70%);
            border-radius: 50%;
        }
        /* Wheat sprig */
        .wheat-sprig {
            font-size: 32px;
            opacity: 0.3;
            filter: sepia(1) brightness(0.8);
        }

        /* Photo positions */
        .counter-photo:nth-child(1) {
            top: 20px; left: 5%;
            transform: rotate(-6deg);
        }
        .counter-photo:nth-child(1) .cp-frame img,
        .counter-photo:nth-child(1) .cp-frame .cp-placeholder { width: 200px; height: 200px; }

        .counter-photo:nth-child(2) {
            top: 0; left: 35%;
            transform: rotate(3deg);
        }
        .counter-photo:nth-child(2) .cp-frame img,
        .counter-photo:nth-child(2) .cp-frame .cp-placeholder { width: 240px; height: 280px; }

        .counter-photo:nth-child(3) {
            top: 40px; right: 5%;
            transform: rotate(-2deg);
        }
        .counter-photo:nth-child(3) .cp-frame img,
        .counter-photo:nth-child(3) .cp-frame .cp-placeholder { width: 190px; height: 190px; }

        .counter-photo:nth-child(4) {
            bottom: 40px; left: 10%;
            transform: rotate(4deg);
        }
        .counter-photo:nth-child(4) .cp-frame img,
        .counter-photo:nth-child(4) .cp-frame .cp-placeholder { width: 180px; height: 180px; }

        .counter-photo:nth-child(5) {
            bottom: 20px; right: 15%;
            transform: rotate(-3.5deg);
        }
        .counter-photo:nth-child(5) .cp-frame img,
        .counter-photo:nth-child(5) .cp-frame .cp-placeholder { width: 200px; height: 220px; }

        .counter-cta {
            text-align: center; margin-top: 48px; position: relative; z-index: 10;
        }
        .counter-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.3);
        }
        .counter-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .counter-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .counter-scene { min-height: auto; }
            .counter-photo {
                position: relative !important;
                top: auto !important; left: auto !important;
                right: auto !important; bottom: auto !important;
                margin: 12px auto;
                display: block;
                width: fit-content;
            }
            .counter-photo:nth-child(1) .cp-frame img, .counter-photo:nth-child(1) .cp-frame .cp-placeholder,
            .counter-photo:nth-child(2) .cp-frame img, .counter-photo:nth-child(2) .cp-frame .cp-placeholder,
            .counter-photo:nth-child(3) .cp-frame img, .counter-photo:nth-child(3) .cp-frame .cp-placeholder,
            .counter-photo:nth-child(4) .cp-frame img, .counter-photo:nth-child(4) .cp-frame .cp-placeholder,
            .counter-photo:nth-child(5) .cp-frame img, .counter-photo:nth-child(5) .cp-frame .cp-placeholder {
                width: 260px; height: 200px;
            }
            .counter-prop { display: none; }
        }

        /* ═══════════════════════════════════
           L: COOKIE JAR / MASON JAR SHELF
           A pantry shelf with mason jars and photos
        ═══════════════════════════════════ */
        .pantry-section {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            background: var(--dark);
        }
        .pantry-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 20%, rgba(244,200,122,0.06), transparent 50%);
            pointer-events: none;
        }
        .pantry-section .section-head h2 { color: var(--cream); }
        .pantry-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.35);
            margin-top: -24px; margin-bottom: 56px;
        }

        .pantry-shelves {
            max-width: 800px; margin: 0 auto;
        }

        .pantry-shelf {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 24px;
            padding: 0 20px 12px;
            position: relative;
            margin-bottom: 48px;
        }
        /* Shelf board */
        .pantry-shelf::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 10px;
            background: linear-gradient(180deg, #6B4C3B, #4a3428);
            border-radius: 2px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }

        .pantry-item {
            position: relative;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .pantry-item:hover {
            transform: translateY(-8px);
            z-index: 5;
        }

        /* Mason jar shape */
        .mason-jar {
            position: relative;
            width: 160px;
        }
        /* Jar lid */
        .jar-lid {
            width: 80%; margin: 0 auto;
            height: 16px;
            background: linear-gradient(180deg, #a89070, #8a7460, #a89070);
            border-radius: 4px 4px 0 0;
            box-shadow: 0 -1px 3px rgba(0,0,0,0.2);
            position: relative; z-index: 2;
        }
        .jar-lid::after {
            content: '';
            position: absolute;
            bottom: -3px; left: -4px; right: -4px;
            height: 6px;
            background: linear-gradient(180deg, #908070, #7a6a5a);
            border-radius: 2px;
        }
        /* Jar body */
        .jar-body {
            background: rgba(245,240,232,0.12);
            border: 2px solid rgba(245,240,232,0.08);
            border-radius: 0 0 16px 16px;
            padding: 8px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(2px);
        }
        /* Glass reflection */
        .jar-body::before {
            content: '';
            position: absolute;
            top: 0; left: 8px;
            width: 30%; height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.06), transparent);
            pointer-events: none;
        }

        .jar-body img {
            width: 100%; height: 160px;
            object-fit: cover; display: block;
            border-radius: 0 0 10px 10px;
            opacity: 0.9;
        }
        .jar-body .jar-placeholder {
            width: 100%; height: 160px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            border-radius: 0 0 10px 10px;
        }
        .jar-body .jar-placeholder .ph-emoji { font-size: 36px; opacity: 0.6; }
        .jar-body .jar-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 12px;
            color: rgba(245,230,208,0.3);
        }

        /* Label on jar */
        .jar-label {
            margin-top: 12px;
            font-family: 'Caveat', cursive;
            font-size: 15px;
            color: rgba(245,230,208,0.5);
        }

        /* Non-jar pantry items for variety */
        .pantry-decoration {
            font-size: 40px;
            opacity: 0.3;
            padding: 0 8px;
        }

        .pantry-cta {
            text-align: center; margin-top: 48px;
        }
        .pantry-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.25);
        }
        .pantry-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .pantry-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .pantry-shelf { flex-wrap: wrap; gap: 16px; }
            .mason-jar { width: 130px; }
            .jar-body img, .jar-body .jar-placeholder { height: 130px; }
            .pantry-decoration { display: none; }
        }

        /* ═══════════════════════════════════
           M: KITCHEN TABLE SPREAD
           Overhead flat-lay with gingham cloth and dishes
        ═══════════════════════════════════ */
        .flatlay-section {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            /* Warm wood underneath */
            background: #3a2a1c;
        }
        .flatlay-section .section-head h2 { color: var(--cream); }
        .flatlay-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.4);
            margin-top: -24px; margin-bottom: 56px;
        }

        .flatlay-table {
            max-width: 800px; margin: 0 auto;
            position: relative;
        }

        /* Gingham tablecloth peeking out */
        .gingham {
            position: absolute;
            width: 300px; height: 300px;
            background:
                repeating-conic-gradient(
                    rgba(180,60,60,0.08) 0% 25%,
                    transparent 0% 50%
                ) 0 0 / 20px 20px,
                rgba(245,230,208,0.06);
            border-radius: 4px;
            transform: rotate(12deg);
            z-index: 0;
        }
        .gingham.g1 { top: -20px; left: -40px; }
        .gingham.g2 { bottom: -30px; right: -20px; width: 250px; height: 250px; transform: rotate(-8deg); }

        /* Photo "plates" — circular frames */
        .plate-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 32px;
            position: relative;
            z-index: 2;
        }

        .plate-item {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .plate-item:hover {
            transform: scale(1.08);
            z-index: 10;
        }

        /* The plate rim */
        .plate-ring {
            width: 200px; height: 200px;
            border-radius: 50%;
            padding: 12px;
            background: linear-gradient(135deg,
                rgba(245,240,235,0.9),
                rgba(230,225,218,0.9)
            );
            box-shadow:
                0 8px 24px rgba(0,0,0,0.2),
                inset 0 2px 4px rgba(255,255,255,0.3),
                inset 0 -2px 4px rgba(0,0,0,0.05);
            position: relative;
        }
        /* Plate rim detail */
        .plate-ring::before {
            content: '';
            position: absolute; inset: 6px;
            border-radius: 50%;
            border: 1px solid rgba(212,165,116,0.15);
            pointer-events: none;
        }
        /* Gold rim accent */
        .plate-ring::after {
            content: '';
            position: absolute; inset: 3px;
            border-radius: 50%;
            border: 1px solid rgba(212,165,116,0.1);
            pointer-events: none;
        }

        .plate-ring img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            border-radius: 50%;
        }
        .plate-ring .plate-placeholder {
            width: 100%; height: 100%;
            border-radius: 50%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.06), transparent 60%), #f0e8de;
        }
        .plate-ring .plate-placeholder .ph-emoji { font-size: 36px; }
        .plate-ring .plate-placeholder .ph-text {
            font-family: 'Caveat', cursive; font-size: 12px;
            color: var(--warm); opacity: 0.5;
        }

        .plate-caption {
            text-align: center;
            margin-top: 12px;
            font-family: 'Caveat', cursive;
            font-size: 16px;
            color: rgba(245,230,208,0.5);
        }

        /* Different plate sizes */
        .plate-item:nth-child(2) .plate-ring { width: 220px; height: 220px; }
        .plate-item:nth-child(4) .plate-ring { width: 180px; height: 180px; }

        .flatlay-cta {
            text-align: center; margin-top: 56px; position: relative; z-index: 5;
        }
        .flatlay-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.3);
        }
        .flatlay-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .flatlay-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .plate-ring,
            .plate-item:nth-child(2) .plate-ring,
            .plate-item:nth-child(4) .plate-ring { width: 160px; height: 160px; }
            .gingham { display: none; }
        }
    </style>
</head>
<body>

    <nav class="concept-nav">
        <a href="#option-i">I: Recipe Box</a>
        <a href="#option-j">J: Fridge Door</a>
        <a href="#option-k">K: Kitchen Counter</a>
        <a href="#option-l">L: Pantry Shelf</a>
        <a href="#option-m">M: Table Spread</a>
    </nav>

    <!-- ═══ I: RECIPE BOX ═══ -->
    <div id="option-i">
        <div class="concept-label">
            <h1>Option I: Grandma's Recipe Box</h1>
            <p>A wooden recipe box with tabbed index cards. Click tabs to flip through photos on ruled cards with a red margin line.</p>
        </div>
        <section class="recipe-box-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="rb-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="recipe-box reveal" x-data="{ tab: 'boule' }">
                <div class="card-tabs">
                    <div class="card-tab" :class="tab === 'boule' && 'active'" @click="tab = 'boule'">Boule</div>
                    <div class="card-tab" :class="tab === 'muffins' && 'active'" @click="tab = 'muffins'">Muffins</div>
                    <div class="card-tab" :class="tab === 'pumpkin' && 'active'" @click="tab = 'pumpkin'">Pumpkin</div>
                    <div class="card-tab" :class="tab === 'starter' && 'active'" @click="tab = 'starter'">Starter</div>
                    <div class="card-tab" :class="tab === 'pickup' && 'active'" @click="tab = 'pickup'">Pickup</div>
                </div>
                <div class="box-body">
                    <div class="box-clasp"></div>
                    <div class="card-stack">
                        <div class="recipe-cards">
                            <div class="recipe-card-item" :class="tab === 'boule' && 'active'">
                                <div class="rc-photo">
                                    <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                                </div>
                                <div class="rc-details">
                                    <h3>The Signature Boule</h3>
                                    <div class="rc-tagline">Where it all started</div>
                                    <div class="rc-desc">Our classic round loaf. That golden crust, that perfect ear, that soft tangy crumb inside. This is the one that made Cassie fall in love with baking.</div>
                                </div>
                            </div>
                            <div class="recipe-card-item" :class="tab === 'muffins' && 'active'">
                                <div class="rc-photo">
                                    <img src="/images/product-english-muffins.jpg" alt="English muffins">
                                </div>
                                <div class="rc-details">
                                    <h3>Griddle Day!</h3>
                                    <div class="rc-tagline">Nooks and crannies perfected</div>
                                    <div class="rc-desc">The whole kitchen smells amazing when these hit the griddle. Toasted golden, split open, and loaded with butter. Weekday mornings or Sunday brunch, these are always the first to sell out.</div>
                                </div>
                            </div>
                            <div class="recipe-card-item" :class="tab === 'pumpkin' && 'active'">
                                <div class="rc-photo">
                                    <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                                </div>
                                <div class="rc-details">
                                    <h3>Fall Vibes</h3>
                                    <div class="rc-tagline">A seasonal favorite</div>
                                    <div class="rc-desc">Pumpkin, almonds, and chocolate chips. This one disappears fast when autumn rolls around. Warm from the oven with a cup of coffee is the only way to enjoy it.</div>
                                </div>
                            </div>
                            <div class="recipe-card-item" :class="tab === 'starter' && 'active'">
                                <div class="rc-photo">
                                    <div class="rc-placeholder">
                                        <span class="ph-emoji">🫧</span>
                                        <span class="ph-text">Biscotto bubbling</span>
                                    </div>
                                </div>
                                <div class="rc-details">
                                    <h3>Meet Biscotto</h3>
                                    <div class="rc-tagline">The heart of every loaf</div>
                                    <div class="rc-desc">Our sourdough starter, Biscotto, is the beginning of everything we bake. Fed daily, always bubbling, and the secret ingredient you can taste in every bite.</div>
                                </div>
                            </div>
                            <div class="recipe-card-item" :class="tab === 'pickup' && 'active'">
                                <div class="rc-photo">
                                    <div class="rc-placeholder">
                                        <span class="ph-emoji">📦</span>
                                        <span class="ph-text">Ready for you</span>
                                    </div>
                                </div>
                                <div class="rc-details">
                                    <h3>Packed with Care</h3>
                                    <div class="rc-tagline">From our kitchen to yours</div>
                                    <div class="rc-desc">Every order is wrapped and packed by hand. Pickup from our kitchen or delivery right to your door in the Four Corners and greater Orlando area.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rb-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ J: FRIDGE DOOR ═══ -->
    <div id="option-j">
        <div class="concept-label">
            <h1>Option J: Fridge Door</h1>
            <p>Photos held up with colorful magnets on a brushed-metal fridge. Letter magnets, overlapping snapshots, that lived-in kitchen feel.</p>
        </div>
        <section class="fridge-section">
            <div class="fridge-handle"></div>
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="fridge-subtitle reveal">~ our kitchen, your table ~</p>

            <div class="fridge-photos reveal">
                <!-- Letter magnets -->
                <div class="letter-magnets" style="top: -10px; left: 45%;">
                    <span class="letter-magnet" style="background: #e55;">Y</span>
                    <span class="letter-magnet" style="background: #58d;">U</span>
                    <span class="letter-magnet" style="background: #ed5; color: #665;">M</span>
                </div>

                <div class="fridge-photo">
                    <div class="fridge-magnet magnet-red" style="top: -10px; left: 30%;"></div>
                    <div class="fp-frame">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule" style="height: 180px;">
                        <span class="fp-caption">The boule!</span>
                    </div>
                </div>

                <div class="fridge-photo">
                    <div class="fridge-magnet magnet-blue" style="top: -8px; right: 20%;"></div>
                    <div class="fridge-magnet magnet-yellow" style="top: -8px; left: 15%;"></div>
                    <div class="fp-frame">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins" style="height: 220px;">
                        <span class="fp-caption">Griddle day 🔥</span>
                    </div>
                </div>

                <div class="fridge-photo">
                    <div class="fridge-magnet magnet-green" style="top: -10px; left: 40%;"></div>
                    <div class="fp-frame">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread" style="height: 160px;">
                        <span class="fp-caption">Fall fave 🎃</span>
                    </div>
                </div>

                <div class="fridge-photo">
                    <div class="fridge-magnet magnet-orange" style="top: -10px; left: 35%;"></div>
                    <div class="fp-frame">
                        <div class="fp-placeholder" style="height: 150px;">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto</span>
                        </div>
                        <span class="fp-caption">The starter</span>
                    </div>
                </div>

                <div class="fridge-photo">
                    <div class="fridge-magnet magnet-red" style="top: -10px; left: 50%;"></div>
                    <div class="fp-frame">
                        <div class="fp-placeholder" style="height: 160px;">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Ready!</span>
                        </div>
                        <span class="fp-caption">Packed with love</span>
                    </div>
                </div>
            </div>

            <div class="fridge-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ K: KITCHEN COUNTER ═══ -->
    <div id="option-k">
        <div class="concept-label">
            <h1>Option K: Kitchen Counter</h1>
            <p>Overhead view of a butcher-block counter with polaroids scattered among flour dustings and wheat sprigs.</p>
        </div>
        <section class="counter-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="counter-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="counter-scene reveal">
                <!-- Props -->
                <div class="counter-prop flour-dust" style="top: 10%; right: 10%;"></div>
                <div class="counter-prop flour-dust" style="bottom: 5%; left: 5%; width: 150px; height: 150px;"></div>
                <div class="counter-prop wheat-sprig" style="top: 50%; left: 2%; transform: rotate(-20deg);">🌾</div>
                <div class="counter-prop wheat-sprig" style="bottom: 10%; right: 3%; transform: rotate(15deg); font-size: 28px;">🌾</div>

                <div class="counter-photo">
                    <div class="cp-frame">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <span class="cp-caption">The boule</span>
                    </div>
                </div>

                <div class="counter-photo">
                    <div class="cp-frame">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <span class="cp-caption">Griddle day!</span>
                    </div>
                </div>

                <div class="counter-photo">
                    <div class="cp-frame">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <span class="cp-caption">Fall vibes 🎃</span>
                    </div>
                </div>

                <div class="counter-photo">
                    <div class="cp-frame">
                        <div class="cp-placeholder">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto</span>
                        </div>
                        <span class="cp-caption">The starter</span>
                    </div>
                </div>

                <div class="counter-photo">
                    <div class="cp-frame">
                        <div class="cp-placeholder">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Ready!</span>
                        </div>
                        <span class="cp-caption">Packed with care</span>
                    </div>
                </div>
            </div>

            <div class="counter-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ L: PANTRY SHELF ═══ -->
    <div id="option-l">
        <div class="concept-label">
            <h1>Option L: Pantry Shelf</h1>
            <p>Photos peeking through mason jars sitting on rustic wooden shelves. Jar lids, glass reflections, that cozy pantry feeling.</p>
        </div>
        <section class="pantry-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="pantry-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="pantry-shelves reveal">
                <div class="pantry-shelf">
                    <div class="pantry-item">
                        <div class="mason-jar">
                            <div class="jar-lid"></div>
                            <div class="jar-body">
                                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                            </div>
                        </div>
                        <p class="jar-label">The boule</p>
                    </div>
                    <div class="pantry-decoration">🌾</div>
                    <div class="pantry-item">
                        <div class="mason-jar">
                            <div class="jar-lid"></div>
                            <div class="jar-body">
                                <img src="/images/product-english-muffins.jpg" alt="English muffins">
                            </div>
                        </div>
                        <p class="jar-label">Griddle day</p>
                    </div>
                    <div class="pantry-decoration">🫙</div>
                    <div class="pantry-item">
                        <div class="mason-jar">
                            <div class="jar-lid"></div>
                            <div class="jar-body">
                                <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                            </div>
                        </div>
                        <p class="jar-label">Fall vibes</p>
                    </div>
                </div>
                <div class="pantry-shelf">
                    <div class="pantry-item">
                        <div class="mason-jar">
                            <div class="jar-lid"></div>
                            <div class="jar-body">
                                <div class="jar-placeholder">
                                    <span class="ph-emoji">🫧</span>
                                    <span class="ph-text">Bubbling</span>
                                </div>
                            </div>
                        </div>
                        <p class="jar-label">Biscotto</p>
                    </div>
                    <div class="pantry-decoration">🍯</div>
                    <div class="pantry-item">
                        <div class="mason-jar">
                            <div class="jar-lid"></div>
                            <div class="jar-body">
                                <div class="jar-placeholder">
                                    <span class="ph-emoji">📦</span>
                                    <span class="ph-text">Ready!</span>
                                </div>
                            </div>
                        </div>
                        <p class="jar-label">Packed with care</p>
                    </div>
                </div>
            </div>

            <div class="pantry-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ M: KITCHEN TABLE SPREAD ═══ -->
    <div id="option-m">
        <div class="concept-label">
            <h1>Option M: Kitchen Table Spread</h1>
            <p>An overhead flat-lay with photos served on plates, gingham cloth peeking underneath, gold rim details. Sunday dinner vibes.</p>
        </div>
        <section class="flatlay-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="flatlay-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="flatlay-table reveal">
                <div class="gingham g1"></div>
                <div class="gingham g2"></div>

                <div class="plate-grid">
                    <div class="plate-item">
                        <div class="plate-ring">
                            <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        </div>
                        <p class="plate-caption">The boule</p>
                    </div>
                    <div class="plate-item">
                        <div class="plate-ring">
                            <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        </div>
                        <p class="plate-caption">Griddle day!</p>
                    </div>
                    <div class="plate-item">
                        <div class="plate-ring">
                            <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        </div>
                        <p class="plate-caption">Fall vibes</p>
                    </div>
                    <div class="plate-item">
                        <div class="plate-ring">
                            <div class="plate-placeholder">
                                <span class="ph-emoji">🫧</span>
                                <span class="ph-text">Biscotto</span>
                            </div>
                        </div>
                        <p class="plate-caption">The starter</p>
                    </div>
                    <div class="plate-item">
                        <div class="plate-ring">
                            <div class="plate-placeholder">
                                <span class="ph-emoji">📦</span>
                                <span class="ph-text">Ready!</span>
                            </div>
                        </div>
                        <p class="plate-caption">Packed with care</p>
                    </div>
                </div>
            </div>

            <div class="flatlay-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js" defer></script>
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }});
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        const navLinks = document.querySelectorAll('.concept-nav a');
        const sections = ['option-i', 'option-j', 'option-k', 'option-l', 'option-m'];
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
