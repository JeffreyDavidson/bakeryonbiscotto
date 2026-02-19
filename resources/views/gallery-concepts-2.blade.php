<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh from the Oven — Gallery Concepts Round 2</title>
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

        /* ═══ NAV ═══ */
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
            text-align: center;
            padding: 100px 20px 20px;
        }
        .concept-label h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            color: var(--golden);
            margin-bottom: 8px;
        }
        .concept-label p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            color: rgba(245,230,208,0.5);
            font-size: 15px;
            max-width: 500px; margin: 0 auto;
        }
        .divider {
            max-width: 200px; margin: 0 auto;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.3), transparent);
        }

        /* Shared */
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

        /* ═══════════════════════════════════
           D: FLOUR DUSTED DARKROOM
           Photos emerge from sepia, colorize on hover
        ═══════════════════════════════════ */
        .darkroom {
            padding: 80px 20px 100px;
            position: relative;
            background: #0d0805;
            overflow: hidden;
        }
        .darkroom::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 30%, rgba(180,80,40,0.04), transparent 60%);
            pointer-events: none;
        }
        .darkroom .section-head h2 { color: var(--cream); }
        .darkroom-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.35);
            margin-top: -24px; margin-bottom: 56px;
        }

        /* Floating flour dust */
        .flour-particles {
            position: absolute; inset: 0; pointer-events: none; overflow: hidden;
        }
        .flour-particles span {
            position: absolute;
            width: 3px; height: 3px;
            background: rgba(245,230,208,0.15);
            border-radius: 50%;
            animation: flour-float 8s infinite ease-in-out;
        }
        .flour-particles span:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 7s; }
        .flour-particles span:nth-child(2) { left: 25%; top: 60%; animation-delay: 1.2s; animation-duration: 9s; width: 2px; height: 2px; }
        .flour-particles span:nth-child(3) { left: 45%; top: 35%; animation-delay: 2.5s; animation-duration: 6s; }
        .flour-particles span:nth-child(4) { left: 65%; top: 70%; animation-delay: 0.8s; animation-duration: 10s; width: 4px; height: 4px; }
        .flour-particles span:nth-child(5) { left: 80%; top: 25%; animation-delay: 3s; animation-duration: 8s; }
        .flour-particles span:nth-child(6) { left: 55%; top: 80%; animation-delay: 1.8s; animation-duration: 7.5s; width: 2px; height: 2px; }
        .flour-particles span:nth-child(7) { left: 90%; top: 50%; animation-delay: 4s; animation-duration: 9s; }
        .flour-particles span:nth-child(8) { left: 35%; top: 15%; animation-delay: 2s; animation-duration: 11s; width: 2px; height: 2px; }
        @keyframes flour-float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            20% { opacity: 0.6; }
            50% { transform: translateY(-40px) translateX(15px); opacity: 0.3; }
            80% { opacity: 0.5; }
        }

        .darkroom-grid {
            max-width: 960px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .darkroom-photo {
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .darkroom-photo::before {
            content: '';
            position: absolute; inset: 0; z-index: 2;
            border: 1px solid rgba(212,165,116,0.1);
            border-radius: 4px;
            pointer-events: none;
            transition: border-color 0.4s;
        }
        .darkroom-photo:hover::before {
            border-color: rgba(212,165,116,0.3);
        }
        .darkroom-photo:hover {
            transform: scale(1.03);
            box-shadow: 0 16px 50px rgba(180,80,40,0.15), 0 0 40px rgba(212,165,116,0.06);
        }

        .darkroom-photo img {
            width: 100%; height: 260px;
            object-fit: cover; display: block;
            filter: sepia(0.6) brightness(0.7) contrast(1.1);
            transition: filter 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .darkroom-photo:hover img {
            filter: sepia(0) brightness(0.95) contrast(1.05);
        }
        /* Warm vignette */
        .darkroom-photo::after {
            content: '';
            position: absolute; inset: 0; z-index: 1;
            box-shadow: inset 0 0 60px rgba(13,8,5,0.5);
            border-radius: 4px;
            pointer-events: none;
            transition: box-shadow 0.6s;
        }
        .darkroom-photo:hover::after {
            box-shadow: inset 0 0 30px rgba(13,8,5,0.3);
        }

        .darkroom-photo .dr-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0; z-index: 3;
            padding: 40px 16px 14px;
            background: linear-gradient(transparent, rgba(13,8,5,0.8));
            font-family: 'Caveat', cursive;
            font-size: 17px;
            color: var(--cream);
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.4s;
        }
        .darkroom-photo:hover .dr-caption {
            opacity: 1;
            transform: translateY(0);
        }

        .darkroom-photo .dr-placeholder {
            width: 100%; height: 260px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background:
                radial-gradient(circle at 50% 40%, rgba(180,80,40,0.06), transparent 60%),
                #1a1008;
        }
        .darkroom-photo .dr-placeholder .ph-emoji {
            font-size: 40px;
            filter: sepia(0.6) brightness(0.8);
            transition: filter 0.6s;
        }
        .darkroom-photo:hover .dr-placeholder .ph-emoji {
            filter: sepia(0) brightness(1);
        }
        .darkroom-photo .dr-placeholder .ph-text {
            font-family: 'Caveat', cursive;
            font-size: 15px; color: rgba(245,230,208,0.3);
        }

        /* Larger featured */
        .darkroom-photo.dr-featured {
            grid-column: span 2;
        }
        .darkroom-photo.dr-featured img,
        .darkroom-photo.dr-featured .dr-placeholder { height: 320px; }

        .darkroom-cta { text-align: center; margin-top: 48px; }
        .darkroom-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.25);
        }
        .darkroom-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .darkroom-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .darkroom-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .darkroom-photo.dr-featured { grid-column: span 2; }
            .darkroom-photo img,
            .darkroom-photo .dr-placeholder { height: 180px; }
            .darkroom-photo.dr-featured img,
            .darkroom-photo.dr-featured .dr-placeholder { height: 220px; }
        }

        /* ═══════════════════════════════════
           E: VINTAGE FILM STRIP
           Horizontal scrolling film reel
        ═══════════════════════════════════ */
        .filmstrip-section {
            padding: 80px 0 100px;
            position: relative;
            background: #111;
            overflow: hidden;
        }
        .filmstrip-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 30% 50%, rgba(212,165,116,0.04), transparent 50%),
                radial-gradient(ellipse at 70% 50%, rgba(212,165,116,0.03), transparent 40%);
            pointer-events: none;
        }
        .filmstrip-section .section-head { padding: 0 20px; }
        .filmstrip-section .section-head h2 { color: var(--cream); }
        .filmstrip-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.35);
            margin-top: -24px; margin-bottom: 56px;
            padding: 0 20px;
        }

        .filmstrip-container {
            position: relative;
            padding: 0 40px;
        }

        .filmstrip {
            display: flex;
            gap: 0;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 20px 0;
        }
        .filmstrip::-webkit-scrollbar { display: none; }

        /* The actual film strip */
        .film-reel {
            display: flex;
            background: #1a1a1a;
            border-top: 3px solid #222;
            border-bottom: 3px solid #222;
            position: relative;
            padding: 0;
        }

        /* Sprocket holes */
        .film-reel::before,
        .film-reel::after {
            content: '';
            position: absolute;
            left: 0; right: 0;
            height: 12px;
            background: repeating-linear-gradient(90deg,
                transparent,
                transparent 30px,
                #2a2a2a 30px,
                #2a2a2a 32px,
                transparent 32px,
                transparent 52px,
                rgba(245,230,208,0.06) 52px,
                rgba(245,230,208,0.06) 60px,
                transparent 60px,
                transparent 62px,
                #2a2a2a 62px,
                #2a2a2a 64px,
                transparent 64px
            );
            z-index: 2;
        }
        .film-reel::before { top: 0; }
        .film-reel::after { bottom: 0; }

        .film-frame {
            flex-shrink: 0;
            width: 280px;
            padding: 24px 16px;
            position: relative;
            scroll-snap-align: center;
            border-right: 2px solid #2a2a2a;
        }

        .film-frame img {
            width: 100%; height: 320px;
            object-fit: cover; display: block;
            border-radius: 2px;
            transition: all 0.4s;
        }
        .film-frame:hover img {
            box-shadow: 0 0 30px rgba(212,165,116,0.15);
        }
        .film-frame .film-placeholder {
            width: 100%; height: 320px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background: #151515;
            border-radius: 2px;
        }
        .film-frame .film-placeholder .ph-emoji { font-size: 40px; }
        .film-frame .film-placeholder .ph-text {
            font-family: 'Caveat', cursive;
            font-size: 14px; color: rgba(245,230,208,0.25);
        }

        .film-caption {
            text-align: center;
            margin-top: 12px;
            font-family: 'Caveat', cursive;
            font-size: 16px;
            color: rgba(245,230,208,0.5);
        }

        /* Frame number */
        .film-frame .frame-num {
            position: absolute;
            top: 28px; right: 22px;
            font-family: 'Courier New', monospace;
            font-size: 10px;
            color: rgba(245,230,208,0.15);
            letter-spacing: 1px;
        }

        .filmstrip-cta { text-align: center; margin-top: 48px; padding: 0 20px; }
        .filmstrip-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.25);
        }
        .filmstrip-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
        }
        .filmstrip-cta .gallery-cta svg { fill: var(--golden); }

        /* Scroll hint arrows */
        .scroll-hint {
            text-align: center; margin-top: 16px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 13px;
            color: rgba(245,230,208,0.2);
            letter-spacing: 2px;
        }

        @media (max-width: 768px) {
            .film-frame { width: 220px; }
            .film-frame img,
            .film-frame .film-placeholder { height: 250px; }
        }

        /* ═══════════════════════════════════
           F: CHALKBOARD WALL
           Chalk-drawn frames, doodles, pinned photos
        ═══════════════════════════════════ */
        .chalkboard {
            padding: 80px 20px 100px;
            position: relative;
            overflow: hidden;
            /* Dark green chalkboard */
            background: #1a2418;
        }
        /* Chalk dust texture */
        .chalkboard::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(255,255,255,0.02), transparent 40%),
                radial-gradient(ellipse at 80% 60%, rgba(255,255,255,0.015), transparent 40%),
                radial-gradient(ellipse at 50% 90%, rgba(255,255,255,0.01), transparent 30%);
            pointer-events: none;
        }
        /* Wooden frame around chalkboard */
        .chalkboard::after {
            content: '';
            position: absolute; inset: 0;
            border: 12px solid #3a2a1c;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.3);
            pointer-events: none;
        }

        .chalkboard .section-head h2 {
            color: rgba(255,255,255,0.85);
            /* Chalk texture effect */
            text-shadow: 0 0 1px rgba(255,255,255,0.3);
        }
        .chalkboard .accent-line {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            height: 1px;
        }
        .chalk-subtitle {
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 20px;
            color: rgba(255,255,255,0.35);
            margin-top: -20px; margin-bottom: 56px;
        }

        .chalk-grid {
            max-width: 900px; margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: 20px;
            gap: 16px;
            position: relative;
        }

        .chalk-photo {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .chalk-photo:hover {
            transform: scale(1.04) rotate(0deg) !important;
            z-index: 10;
        }

        /* Chalk-drawn frame around each */
        .chalk-photo .chalk-frame {
            position: absolute; inset: -8px; z-index: 0;
            border: 2px dashed rgba(255,255,255,0.12);
            border-radius: 2px;
            pointer-events: none;
        }

        /* Pushpin */
        .chalk-photo .pushpin {
            position: absolute;
            top: -8px; left: 50%; transform: translateX(-50%);
            z-index: 5;
            width: 16px; height: 16px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 35%, #d44, #a22);
            box-shadow: 0 2px 4px rgba(0,0,0,0.4), 0 1px 0 rgba(255,255,255,0.2) inset;
        }
        .chalk-photo:nth-child(2) .pushpin { background: radial-gradient(circle at 40% 35%, #4a4, #282); }
        .chalk-photo:nth-child(3) .pushpin { background: radial-gradient(circle at 40% 35%, #dd4, #aa2); }
        .chalk-photo:nth-child(5) .pushpin { background: radial-gradient(circle at 40% 35%, #48d, #26a); }

        .chalk-photo img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
            position: relative; z-index: 1;
        }
        .chalk-photo .ck-placeholder {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: #2a3628;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
            position: relative; z-index: 1;
        }
        .chalk-photo .ck-placeholder .ph-emoji { font-size: 36px; }
        .chalk-photo .ck-placeholder .ph-text {
            font-family: 'Caveat', cursive;
            font-size: 13px; color: rgba(255,255,255,0.25);
        }

        .chalk-photo .chalk-caption {
            position: absolute;
            bottom: -28px; left: 0; right: 0;
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 16px;
            color: rgba(255,255,255,0.4);
            z-index: 3;
            text-shadow: 0 0 2px rgba(255,255,255,0.1);
        }

        /* Layout positions */
        .chalk-photo:nth-child(1) { grid-column: 1 / 5; grid-row: 1 / 12; transform: rotate(-2deg); }
        .chalk-photo:nth-child(2) { grid-column: 5 / 9; grid-row: 2 / 14; transform: rotate(1.5deg); }
        .chalk-photo:nth-child(3) { grid-column: 9 / 13; grid-row: 1 / 10; transform: rotate(-1deg); }
        .chalk-photo:nth-child(4) { grid-column: 2 / 6; grid-row: 14 / 24; transform: rotate(2deg); }
        .chalk-photo:nth-child(5) { grid-column: 7 / 12; grid-row: 13 / 22; transform: rotate(-1.5deg); }

        /* Chalk doodles */
        .chalk-doodle {
            position: absolute;
            pointer-events: none;
            z-index: 0;
        }
        .chalk-doodle svg {
            stroke: rgba(255,255,255,0.08);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
        }

        .chalkboard-cta { text-align: center; margin-top: 48px; position: relative; z-index: 5; }
        .chalkboard-cta .gallery-cta {
            color: rgba(255,255,255,0.7);
            border: 1.5px solid rgba(255,255,255,0.15);
        }
        .chalkboard-cta .gallery-cta:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.3);
        }
        .chalkboard-cta .gallery-cta svg { fill: rgba(255,255,255,0.7); }

        @media (max-width: 768px) {
            .chalk-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: auto;
                gap: 24px;
            }
            .chalk-photo:nth-child(1),
            .chalk-photo:nth-child(2),
            .chalk-photo:nth-child(3),
            .chalk-photo:nth-child(4),
            .chalk-photo:nth-child(5) {
                grid-column: auto; grid-row: auto;
            }
            .chalk-photo img, .chalk-photo .ck-placeholder { height: 180px; }
            .chalk-photo:nth-child(5) { grid-column: span 2; }
            .chalk-photo:nth-child(5) img, .chalk-photo:nth-child(5) .ck-placeholder { height: 160px; }
        }

        /* ═══════════════════════════════════
           G: STAINED GLASS WINDOW
           Arched panels with warm light
        ═══════════════════════════════════ */
        .stained-glass-section {
            padding: 80px 20px 100px;
            position: relative;
            background: var(--dark);
            overflow: hidden;
        }
        /* Light streaming through */
        .stained-glass-section::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 50% 20%, rgba(244,200,122,0.08), transparent 50%),
                radial-gradient(ellipse at 30% 60%, rgba(180,120,60,0.04), transparent 40%),
                radial-gradient(ellipse at 70% 60%, rgba(180,120,60,0.04), transparent 40%);
            pointer-events: none;
        }
        .stained-glass-section .section-head h2 { color: var(--cream); }
        .sg-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: rgba(245,230,208,0.35);
            margin-top: -24px; margin-bottom: 56px;
        }

        .sg-window {
            max-width: 900px; margin: 0 auto;
            display: flex;
            gap: 16px;
            justify-content: center;
            align-items: flex-end;
            position: relative;
        }

        /* Each panel */
        .sg-panel {
            flex: 1;
            max-width: 200px;
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .sg-panel:hover {
            transform: translateY(-8px);
        }
        /* Center panel taller */
        .sg-panel.sg-center { max-width: 240px; }

        /* The arch shape */
        .sg-arch {
            position: relative;
            overflow: hidden;
            border-radius: 100px 100px 4px 4px;
            box-shadow:
                0 0 0 3px rgba(107,76,59,0.6),
                0 0 0 6px rgba(61,35,20,0.4),
                0 8px 30px rgba(0,0,0,0.4),
                inset 0 0 40px rgba(244,200,122,0.05);
        }
        .sg-panel:hover .sg-arch {
            box-shadow:
                0 0 0 3px rgba(212,165,116,0.6),
                0 0 0 6px rgba(107,76,59,0.4),
                0 16px 50px rgba(0,0,0,0.5),
                0 0 60px rgba(244,200,122,0.08),
                inset 0 0 40px rgba(244,200,122,0.08);
        }

        .sg-arch img {
            width: 100%; height: 360px;
            object-fit: cover; display: block;
            transition: all 0.6s;
        }
        .sg-panel.sg-center .sg-arch img,
        .sg-panel.sg-center .sg-arch .sg-placeholder { height: 420px; }
        .sg-panel:hover .sg-arch img {
            transform: scale(1.05);
        }

        .sg-arch .sg-placeholder {
            width: 100%; height: 360px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            background:
                radial-gradient(circle at 50% 30%, rgba(244,200,122,0.08), transparent 60%),
                #1a1208;
        }
        .sg-arch .sg-placeholder .ph-emoji { font-size: 40px; }
        .sg-arch .sg-placeholder .ph-text {
            font-family: 'Dancing Script', cursive;
            font-size: 13px; color: rgba(245,230,208,0.25);
        }

        /* Warm light glow overlay */
        .sg-arch::after {
            content: '';
            position: absolute; inset: 0;
            background:
                linear-gradient(180deg, rgba(244,200,122,0.06), transparent 40%, transparent 70%, rgba(26,15,8,0.3));
            pointer-events: none;
            transition: all 0.5s;
        }
        .sg-panel:hover .sg-arch::after {
            background:
                linear-gradient(180deg, rgba(244,200,122,0.12), transparent 40%, transparent 70%, rgba(26,15,8,0.15));
        }

        /* Lead came divider line */
        .sg-arch::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            width: 1px; height: 100%;
            background: linear-gradient(180deg,
                rgba(107,76,59,0.3),
                rgba(107,76,59,0.1) 30%,
                transparent 50%
            );
            z-index: 2;
            pointer-events: none;
        }

        .sg-caption {
            text-align: center;
            margin-top: 16px;
            font-family: 'Dancing Script', cursive;
            font-size: 17px;
            color: rgba(245,230,208,0.5);
            transition: color 0.3s;
        }
        .sg-panel:hover .sg-caption { color: var(--golden); }

        .sg-cta { text-align: center; margin-top: 56px; }
        .sg-cta .gallery-cta {
            color: var(--golden);
            border: 1.5px solid rgba(212,165,116,0.25);
        }
        .sg-cta .gallery-cta:hover {
            background: rgba(212,165,116,0.08);
            border-color: var(--golden);
            box-shadow: 0 0 30px rgba(212,165,116,0.08);
        }
        .sg-cta .gallery-cta svg { fill: var(--golden); }

        @media (max-width: 768px) {
            .sg-window { flex-wrap: wrap; gap: 20px; }
            .sg-panel, .sg-panel.sg-center { max-width: 45%; flex: 0 0 45%; }
            .sg-arch img, .sg-arch .sg-placeholder,
            .sg-panel.sg-center .sg-arch img,
            .sg-panel.sg-center .sg-arch .sg-placeholder { height: 260px; }
        }

        /* ═══════════════════════════════════
           H: INSTAGRAM MIRROR
           Styled like an IG profile grid
        ═══════════════════════════════════ */
        .ig-section {
            padding: 80px 20px 100px;
            position: relative;
            background: var(--cream);
            overflow: hidden;
        }
        .ig-section .section-head h2 { color: var(--dark-brown); }
        .ig-section .accent-line {
            background: linear-gradient(90deg, transparent, var(--warm-brown), transparent);
        }
        .ig-subtitle {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: var(--warm-brown); opacity: 0.6;
            margin-top: -24px; margin-bottom: 40px;
        }

        .ig-profile {
            max-width: 560px; margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(61,35,20,0.1);
            overflow: hidden;
        }

        /* Profile header */
        .ig-header {
            display: flex; align-items: center; gap: 24px;
            padding: 28px 28px 20px;
        }
        .ig-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--warm-brown));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Dancing Script', cursive;
            font-size: 28px; color: white;
            flex-shrink: 0;
            box-shadow: 0 0 0 3px white, 0 0 0 5px var(--golden);
        }
        .ig-info h3 {
            font-family: 'Inter', sans-serif;
            font-size: 16px; font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 4px;
        }
        .ig-info p {
            font-size: 13px;
            color: var(--warm-brown);
            line-height: 1.5;
        }
        .ig-info .ig-handle {
            font-size: 12px;
            color: var(--golden);
            margin-bottom: 6px;
        }

        .ig-stats {
            display: flex; gap: 24px;
            padding: 0 28px 16px;
            border-bottom: 1px solid rgba(139,94,60,0.1);
        }
        .ig-stat {
            text-align: center;
        }
        .ig-stat strong {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 16px; font-weight: 700;
            color: var(--dark-brown);
        }
        .ig-stat span {
            font-size: 11px;
            color: var(--warm-brown);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Grid tabs */
        .ig-tabs {
            display: flex; justify-content: center;
            border-bottom: 1px solid rgba(139,94,60,0.1);
        }
        .ig-tab {
            flex: 1; text-align: center;
            padding: 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--warm-brown);
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }
        .ig-tab.active {
            color: var(--dark-brown);
            border-bottom-color: var(--dark-brown);
        }

        /* Photo grid */
        .ig-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3px;
        }
        .ig-cell {
            aspect-ratio: 1;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }
        .ig-cell img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: all 0.3s;
        }
        .ig-cell:hover img {
            transform: scale(1.08);
            brightness: 0.85;
        }
        .ig-cell .ig-overlay {
            position: absolute; inset: 0;
            background: rgba(61,35,20,0.5);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s;
        }
        .ig-cell:hover .ig-overlay { opacity: 1; }
        .ig-cell .ig-overlay span {
            color: white; font-size: 14px;
            display: flex; align-items: center; gap: 6px;
        }

        .ig-cell .ig-ph {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: #faf3ea;
        }
        .ig-cell .ig-ph .ph-emoji { font-size: 32px; }
        .ig-cell .ig-ph .ph-text {
            font-family: 'Caveat', cursive;
            font-size: 12px; color: var(--warm-brown); opacity: 0.4;
        }

        /* Follow button */
        .ig-follow {
            padding: 20px 28px;
            text-align: center;
        }
        .ig-follow a {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--warm-brown), var(--golden));
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 14px; font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(139,94,60,0.2);
        }
        .ig-follow a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139,94,60,0.3);
        }
        .ig-follow a svg { width: 16px; height: 16px; fill: white; }

        /* ═══ SCROLL REVEAL ═══ */
        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <nav class="concept-nav">
        <a href="#option-d">D: Darkroom</a>
        <a href="#option-e">E: Film Strip</a>
        <a href="#option-f">F: Chalkboard</a>
        <a href="#option-g">G: Stained Glass</a>
        <a href="#option-h">H: Instagram</a>
    </nav>

    <!-- ═══ D: FLOUR DUSTED DARKROOM ═══ -->
    <div id="option-d">
        <div class="concept-label">
            <h1>Option D: Flour Dusted Darkroom</h1>
            <p>Photos emerge from warm sepia tones and come alive with color on hover. Floating flour particles.</p>
        </div>
        <section class="darkroom">
            <div class="flour-particles">
                <span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span>
            </div>
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="darkroom-subtitle reveal">A peek into our kitchen and what's baking today.</p>
            <div class="darkroom-grid reveal">
                <div class="darkroom-photo dr-featured">
                    <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                    <span class="dr-caption">The signature boule</span>
                </div>
                <div class="darkroom-photo">
                    <img src="/images/product-english-muffins.jpg" alt="English muffins">
                    <span class="dr-caption">Griddle day!</span>
                </div>
                <div class="darkroom-photo">
                    <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                    <span class="dr-caption">Fall vibes</span>
                </div>
                <div class="darkroom-photo">
                    <div class="dr-placeholder">
                        <span class="ph-emoji">🫧</span>
                        <span class="ph-text">Biscotto bubbling</span>
                    </div>
                    <span class="dr-caption">The starter</span>
                </div>
                <div class="darkroom-photo">
                    <div class="dr-placeholder">
                        <span class="ph-emoji">📦</span>
                        <span class="ph-text">Ready for pickup</span>
                    </div>
                    <span class="dr-caption">Packed with care</span>
                </div>
            </div>
            <div class="darkroom-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ E: VINTAGE FILM STRIP ═══ -->
    <div id="option-e">
        <div class="concept-label">
            <h1>Option E: Vintage Film Strip</h1>
            <p>A horizontal film reel with sprocket holes and frame numbers. Scroll to explore.</p>
        </div>
        <section class="filmstrip-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="filmstrip-subtitle reveal">A peek into our kitchen and what's baking today.</p>
            <div class="filmstrip-container reveal">
                <div class="filmstrip">
                    <div class="film-reel">
                        <div class="film-frame">
                            <span class="frame-num">001</span>
                            <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                            <p class="film-caption">The signature boule</p>
                        </div>
                        <div class="film-frame">
                            <span class="frame-num">002</span>
                            <img src="/images/product-english-muffins.jpg" alt="English muffins">
                            <p class="film-caption">Griddle day!</p>
                        </div>
                        <div class="film-frame">
                            <span class="frame-num">003</span>
                            <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                            <p class="film-caption">Fall vibes</p>
                        </div>
                        <div class="film-frame">
                            <span class="frame-num">004</span>
                            <div class="film-placeholder">
                                <span class="ph-emoji">🫧</span>
                                <span class="ph-text">Biscotto bubbling</span>
                            </div>
                            <p class="film-caption">The starter</p>
                        </div>
                        <div class="film-frame">
                            <span class="frame-num">005</span>
                            <div class="film-placeholder">
                                <span class="ph-emoji">🍞</span>
                                <span class="ph-text">Scoring day</span>
                            </div>
                            <p class="film-caption">The craft</p>
                        </div>
                        <div class="film-frame">
                            <span class="frame-num">006</span>
                            <div class="film-placeholder">
                                <span class="ph-emoji">📦</span>
                                <span class="ph-text">Ready for pickup</span>
                            </div>
                            <p class="film-caption">Packed with care</p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="scroll-hint reveal">← scroll →</p>
            <div class="filmstrip-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ F: CHALKBOARD WALL ═══ -->
    <div id="option-f">
        <div class="concept-label">
            <h1>Option F: Chalkboard Wall</h1>
            <p>Dark green chalkboard with wooden frame, colorful pushpins, and chalk-drawn doodles.</p>
        </div>
        <section class="chalkboard">
            <!-- Chalk doodles -->
            <div class="chalk-doodle" style="top: 15%; left: 8%;">
                <svg width="60" height="40" viewBox="0 0 60 40">
                    <path d="M5 35 C15 5, 25 5, 30 20 C35 35, 45 35, 55 5"/>
                </svg>
            </div>
            <div class="chalk-doodle" style="top: 60%; right: 6%;">
                <svg width="50" height="50" viewBox="0 0 50 50">
                    <circle cx="25" cy="25" r="15"/>
                    <path d="M25 10 L25 2 M25 48 L25 40 M10 25 L2 25 M48 25 L40 25"/>
                </svg>
            </div>
            <div class="chalk-doodle" style="bottom: 20%; left: 5%;">
                <svg width="40" height="60" viewBox="0 0 40 60">
                    <path d="M20 55 C10 40, 5 25, 20 5 C35 25, 30 40, 20 55Z"/>
                    <line x1="20" y1="55" x2="20" y2="60"/>
                </svg>
            </div>

            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="chalk-subtitle reveal">~ a peek behind the scenes ~</p>

            <div class="chalk-grid reveal">
                <div class="chalk-photo">
                    <div class="chalk-frame"></div>
                    <div class="pushpin"></div>
                    <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                    <span class="chalk-caption">The signature boule</span>
                </div>
                <div class="chalk-photo">
                    <div class="chalk-frame"></div>
                    <div class="pushpin"></div>
                    <img src="/images/product-english-muffins.jpg" alt="English muffins">
                    <span class="chalk-caption">Griddle day!</span>
                </div>
                <div class="chalk-photo">
                    <div class="chalk-frame"></div>
                    <div class="pushpin"></div>
                    <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                    <span class="chalk-caption">Fall vibes</span>
                </div>
                <div class="chalk-photo">
                    <div class="chalk-frame"></div>
                    <div class="pushpin"></div>
                    <div class="ck-placeholder">
                        <span class="ph-emoji">🫧</span>
                        <span class="ph-text">Biscotto bubbling</span>
                    </div>
                    <span class="chalk-caption">The starter</span>
                </div>
                <div class="chalk-photo">
                    <div class="chalk-frame"></div>
                    <div class="pushpin"></div>
                    <div class="ck-placeholder">
                        <span class="ph-emoji">📦</span>
                        <span class="ph-text">Packed with care</span>
                    </div>
                    <span class="chalk-caption">Ready for you</span>
                </div>
            </div>

            <div class="chalkboard-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ G: STAINED GLASS WINDOW ═══ -->
    <div id="option-g">
        <div class="concept-label">
            <h1>Option G: Stained Glass Window</h1>
            <p>Photos framed in arched cathedral panels with warm light glowing through. Reverent and beautiful.</p>
        </div>
        <section class="stained-glass-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="sg-subtitle reveal">A peek into our kitchen and what's baking today.</p>
            <div class="sg-window reveal">
                <div class="sg-panel">
                    <div class="sg-arch">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                    </div>
                    <p class="sg-caption">The signature boule</p>
                </div>
                <div class="sg-panel">
                    <div class="sg-arch">
                        <div class="sg-placeholder">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Biscotto bubbling</span>
                        </div>
                    </div>
                    <p class="sg-caption">The starter</p>
                </div>
                <div class="sg-panel sg-center">
                    <div class="sg-arch">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                    </div>
                    <p class="sg-caption">Griddle day!</p>
                </div>
                <div class="sg-panel">
                    <div class="sg-arch">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                    </div>
                    <p class="sg-caption">Fall vibes</p>
                </div>
                <div class="sg-panel">
                    <div class="sg-arch">
                        <div class="sg-placeholder">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Ready for pickup</span>
                        </div>
                    </div>
                    <p class="sg-caption">Packed with care</p>
                </div>
            </div>
            <div class="sg-cta reveal">
                <a href="https://instagram.com/bakeryonbiscotto" target="_blank" class="gallery-cta">
                    Follow Our Journey
                    <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══ H: INSTAGRAM MIRROR ═══ -->
    <div id="option-h">
        <div class="concept-label">
            <h1>Option H: Instagram Mirror</h1>
            <p>A mini Instagram profile card with photo grid, follower count, and follow button. Familiar and modern.</p>
        </div>
        <section class="ig-section">
            <div class="section-head reveal">
                <h2>Fresh from the Oven</h2>
                <div class="accent-line"></div>
            </div>
            <p class="ig-subtitle reveal">A peek into our kitchen and what's baking today.</p>

            <div class="ig-profile reveal">
                <div class="ig-header">
                    <div class="ig-avatar">B</div>
                    <div class="ig-info">
                        <div class="ig-handle">@bakeryonbiscotto</div>
                        <h3>Bakery on Biscotto</h3>
                        <p>Handcrafted sourdough from our cottage kitchen 🍞<br>Four Corners, FL</p>
                    </div>
                </div>
                <div class="ig-stats">
                    <div class="ig-stat">
                        <strong>42</strong>
                        <span>Posts</span>
                    </div>
                    <div class="ig-stat">
                        <strong>1.2k</strong>
                        <span>Followers</span>
                    </div>
                    <div class="ig-stat">
                        <strong>89</strong>
                        <span>Following</span>
                    </div>
                </div>
                <div class="ig-tabs">
                    <div class="ig-tab active">▦ Posts</div>
                    <div class="ig-tab">♡ Tagged</div>
                </div>
                <div class="ig-grid">
                    <div class="ig-cell">
                        <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule">
                        <div class="ig-overlay"><span>♡ 47</span></div>
                    </div>
                    <div class="ig-cell">
                        <img src="/images/product-english-muffins.jpg" alt="English muffins">
                        <div class="ig-overlay"><span>♡ 62</span></div>
                    </div>
                    <div class="ig-cell">
                        <img src="/images/product-pumpkin-bread.jpg" alt="Pumpkin bread">
                        <div class="ig-overlay"><span>♡ 38</span></div>
                    </div>
                    <div class="ig-cell">
                        <div class="ig-ph">
                            <span class="ph-emoji">🫧</span>
                            <span class="ph-text">Starter day</span>
                        </div>
                    </div>
                    <div class="ig-cell">
                        <div class="ig-ph">
                            <span class="ph-emoji">🍞</span>
                            <span class="ph-text">Scoring</span>
                        </div>
                    </div>
                    <div class="ig-cell">
                        <div class="ig-ph">
                            <span class="ph-emoji">📦</span>
                            <span class="ph-text">Pickup day</span>
                        </div>
                    </div>
                </div>
                <div class="ig-follow">
                    <a href="https://instagram.com/bakeryonbiscotto" target="_blank">
                        Follow on Instagram
                        <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
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

        // Nav active state
        const navLinks = document.querySelectorAll('.concept-nav a');
        const sections = ['option-d', 'option-e', 'option-f', 'option-g', 'option-h'];
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
