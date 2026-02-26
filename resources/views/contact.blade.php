<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Bakery on Biscotto</title>
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
        }

        /* Skip to main content link */
        .skip-to-main {
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark);
            color: var(--cream);
            padding: 12px 24px;
            border-radius: 0 0 8px 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            z-index: 10000;
            transition: top 0.3s ease;
        }
        .skip-to-main:focus {
            top: 0;
            outline: 2px solid var(--golden);
            outline-offset: 2px;
        }

        /* Focus styles for all interactive elements */
        a:focus-visible,
        button:focus-visible,
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible,
        [tabindex]:focus-visible {
            outline: 2px solid var(--golden);
            outline-offset: 2px;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        /* ═══ NAV ═══ */
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
        .nav-links {
            display: flex; align-items: center; gap: 4px;
        }
        .main-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 500;
            color: var(--cream); text-decoration: none;
            padding: 10px 24px; border-radius: 100px;
            transition: all 0.3s ease;
        }
        .main-nav a:hover { background: rgba(212,165,116,0.2); color: var(--golden); }
        .main-nav a.active { background: var(--golden); color: var(--dark); font-weight: 600; }
        .nav-hamburger {
            display: none; background: none; border: none; cursor: pointer;
            padding: 8px; flex-direction: column; gap: 5px;
        }
        .nav-hamburger span {
            display: block; width: 24px; height: 2px;
            background: var(--cream); border-radius: 2px;
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .main-nav {
                top: 8px; left: 12px; right: 12px;
                transform: none; border-radius: 16px;
                padding: 12px 16px;
                flex-wrap: wrap; justify-content: flex-end;
            }
            .nav-links {
                display: none; width: 100%;
                flex-direction: column; gap: 0; padding-top: 12px;
            }
            .nav-open .nav-links { display: flex; }
            .main-nav a {
                padding: 12px 16px; border-radius: 12px;
                font-size: 15px; width: 100%; text-align: center;
            }
            .nav-hamburger { display: flex; }
            .nav-open .nav-hamburger span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
            .nav-open .nav-hamburger span:nth-child(2) { opacity: 0; }
            .nav-open .nav-hamburger span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }
        }

        /* ═══ HERO — Full-width parchment banner ═══ */
        .hero {
            padding: 160px 24px 80px;
            text-align: center;
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 20% 50%, rgba(212,165,116,0.12), transparent),
                radial-gradient(ellipse 500px 350px at 80% 50%, rgba(193,127,78,0.08), transparent);
            pointer-events: none;
        }
        .hero-flour {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .flour-dot {
            position: absolute;
            width: 3px; height: 3px;
            background: rgba(245,230,208,0.15);
            border-radius: 50%;
        }
        .hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(3rem, 7vw, 4.5rem);
            color: var(--cream);
            margin-bottom: 16px;
            position: relative;
        }
        .hero p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            color: var(--golden);
            max-width: 480px;
            margin: 0 auto;
            position: relative;
            opacity: 0.85;
        }
        .hero-flourish {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
            position: relative;
        }
        .hf-line {
            width: 60px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--golden));
        }
        .hf-line:last-child {
            background: linear-gradient(90deg, var(--golden), transparent);
        }
        .hf-star { color: var(--golden); font-size: 0.9rem; }

        /* ═══ MAIN ═══ */
        .contact-wrap {
            max-width: 1100px;
            margin: -40px auto 0;
            padding: 0 24px 80px;
            position: relative;
            z-index: 2;
        }

        /* ═══ FORM CARD — Parchment envelope style ═══ */
        .envelope {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(61,35,20,0.12);
            border: 1px solid rgba(212,165,116,0.15);
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* Left: Form */
        .envelope-form {
            padding: 48px;
            position: relative;
        }
        .envelope-form::after {
            content: '';
            position: absolute;
            top: 48px; bottom: 48px; right: 0;
            width: 1px;
            background: linear-gradient(180deg, transparent, var(--golden), transparent);
        }
        .form-heading {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .form-sub {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            color: var(--warm);
            margin-bottom: 32px;
        }
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--warm);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(139,94,60,0.12);
            border-radius: 12px;
            background-color: var(--light);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            transition: all 0.3s ease;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--golden);
            box-shadow: 0 0 0 3px rgba(212,165,116,0.12);
            background-color: var(--white);
            background: var(--white);
        }
        .form-input::placeholder { color: #8b7355; }
        textarea.form-input { resize: vertical; min-height: 130px; }
        .custom-select {
            user-select: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-right: 14px;
        }
        .subject-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            margin-top: 4px;
            background: var(--light);
            border: 1.5px solid rgba(139,94,60,0.12);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(61,35,20,0.08);
        }
        .subject-option {
            padding: 11px 16px;
            cursor: pointer;
            font-family: 'Lora', serif;
            font-size: 0.95rem;
            color: var(--dark);
            transition: background 0.15s;
            border-bottom: 1px solid rgba(212,165,116,0.15);
        }
        .subject-option:last-child { border-bottom: none; }
        .subject-option:hover { background: rgba(212,165,116,0.2); }
        .subject-option.active { background: rgba(212,165,116,0.35); font-weight: 600; }
        .dropdown-enter { transition: opacity 0.15s ease, transform 0.15s ease; }
        .dropdown-enter-start { opacity: 0; transform: translateY(-4px); }
        .dropdown-enter-end { opacity: 1; transform: translateY(0); }
        .dropdown-leave { transition: opacity 0.1s ease; }
        .dropdown-leave-start { opacity: 1; }
        .dropdown-leave-end { opacity: 0; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .submit-wrap { margin-top: 8px; }
        .submit-btn {
            width: 100%;
            padding: 15px 24px;
            background: var(--dark);
            color: var(--cream);
            border: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.15), transparent);
            transition: left 0.5s;
        }
        .submit-btn:hover { background: var(--brown); }
        .submit-btn:hover::before { left: 100%; }

        .success-msg {
            background: linear-gradient(135deg, rgba(34,197,94,0.06), rgba(34,197,94,0.02));
            border: 1.5px solid rgba(34,197,94,0.15);
            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 24px;
            color: #166534;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            line-height: 1.4;
        }
        .success-icon {
            width: 36px; height: 36px;
            background: rgba(34,197,94,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .error-msg {
            color: #c0392b;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* Right: Info panel */
        .envelope-info {
            padding: 48px;
            background: linear-gradient(165deg, var(--light) 0%, rgba(245,230,208,0.3) 100%);
            position: relative;
        }

        .info-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-heading::before {
            content: '✦';
            color: var(--golden);
            font-size: 0.8rem;
        }

        .info-block {
            margin-bottom: 28px;
        }
        .info-block:last-child { margin-bottom: 0; }
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
        }
        .info-item:last-child { margin-bottom: 0; }
        .info-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--dark), var(--brown));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(61,35,20,0.15);
        }
        .info-icon svg {
            width: 20px; height: 20px;
            stroke: var(--golden);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .info-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--golden);
            margin-bottom: 3px;
        }
        .info-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            color: var(--dark);
            line-height: 1.4;
        }
        .info-value a {
            color: var(--accent);
            text-decoration: none;
            border-bottom: 1px solid rgba(193,127,78,0.3);
            transition: border-color 0.3s;
        }
        .info-value a:hover { border-color: var(--accent); }

        .info-divider {
            height: 1px;
            background: linear-gradient(90deg, var(--golden), transparent);
            margin: 28px 0;
            opacity: 0.4;
        }

        /* Handwritten note at bottom */
        .handwritten-note {
            margin-top: 32px;
            padding: 20px 24px;
            background: var(--white);
            border-radius: 12px;
            border: 1px solid rgba(212,165,116,0.15);
            position: relative;
            box-shadow: 0 2px 8px rgba(61,35,20,0.04);
        }
        .handwritten-note::before {
            content: '"';
            position: absolute;
            top: 8px; left: 16px;
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            color: var(--golden);
            opacity: 0.3;
            line-height: 1;
        }
        .handwritten-note p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            color: var(--warm);
            font-style: italic;
            line-height: 1.5;
            padding-left: 8px;
        }
        .handwritten-note .sig {
            font-family: 'Dancing Script', cursive;
            font-size: 1.1rem;
            color: var(--accent);
            margin-top: 10px;
            font-style: normal;
            padding-left: 8px;
        }

        /* ═══ FOOTER ═══ */
        .footer {
            text-align: center;
            padding: 40px 24px;
            background: var(--dark);
            color: var(--cream);
        }
        .footer p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            opacity: 0.7;
        }
        .footer a { color: var(--golden); text-decoration: none; }
        .footer a:hover { text-decoration: underline; }
        .footer-allergen {
            margin-top: 24px;
            font-size: 11px;
            color: rgba(245,230,208,0.35);
            max-width: 600px;
            margin-left: auto; margin-right: auto;
            line-height: 1.5;
            font-style: italic;
        }
        .footer-badge { font-size: 0.85rem; opacity: 0.5; margin-bottom: 16px; }
        .footer-info { font-size: 0.9rem; opacity: 0.6; }
        .footer-info a { color: var(--golden); text-decoration: none; }
        .footer-bottom {
            margin-top: 20px; padding-top: 20px;
            border-top: 1px solid rgba(245,230,208,0.06);
            font-size: 12px; color: rgba(245,230,208,0.2);
        }
        .tagline { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; opacity: 0.5; margin-bottom: 12px; }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 800px) {
            .envelope {
                grid-template-columns: 1fr;
            }
            .envelope-form::after { display: none; }
            .envelope-form { padding: 32px 24px; }
            .envelope-info { padding: 32px 24px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .hero { padding: 130px 24px 60px; }
            .contact-wrap { margin-top: -24px; }
        }
    </style>
</head>
<body>
    <x-main-nav active="contact" />

    {{-- HERO --}}
    <main id="main-content">
    <section class="hero">
        <div class="hero-flour">
            @for($i = 0; $i < 40; $i++)
            <div class="flour-dot" style="top: {{ rand(5,95) }}%; left: {{ rand(2,98) }}%; width: {{ rand(2,5) }}px; height: {{ rand(2,5) }}px; opacity: {{ rand(8,25) / 100 }};"></div>
            @endfor
        </div>
        <h1>Let's Talk</h1>
        <p>Questions, custom orders, or just want to chat about bread? We're all ears.</p>
        <div class="hero-flourish">
            <span class="hf-line"></span>
            <span class="hf-star">✦</span>
            <span class="hf-line"></span>
        </div>
    </section>

    {{-- MAIN --}}
    <div class="contact-wrap">
        <div class="envelope">
            {{-- FORM SIDE --}}
            <div class="envelope-form">
                <h2 class="form-heading">Send a Message</h2>
                <p class="form-sub">We'll get back to you as soon as we can.</p>

                @if(session('success'))
                    <div class="success-msg">
                        <div class="success-icon">✓</div>
                        <span>Thanks for reaching out! We'll get back to you soon.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="contact-name">Name</label>
                            <input type="text" id="contact-name" name="name" class="form-input" placeholder="Your name" value="{{ old('name') }}" required>
                            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact-email">Email</label>
                            <input type="email" id="contact-email" name="email" class="form-input" placeholder="you@email.com" value="{{ old('email') }}" required>
                            @error('email') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="contact-phone">Phone <span style="font-weight: 400; text-transform: none; opacity: 0.5;">(optional)</span></label>
                            <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="(555) 123-4567" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group" style="position: relative; z-index: 10;" x-data="{ open: false, selected: '{{ old('subject', '') }}', options: ['General Question', 'Feedback', 'Other'], focusIndex: -1 }" @click.away="open = false" @keydown.escape="open = false">
                            <label class="form-label" id="subject-label">Subject</label>
                            <input type="hidden" name="subject" :value="selected" required>
                            <div class="form-input custom-select"
                                 role="combobox"
                                 tabindex="0"
                                 aria-labelledby="subject-label"
                                 :aria-expanded="open ? 'true' : 'false'"
                                 aria-haspopup="listbox"
                                 aria-controls="subject-listbox"
                                 @click="open = !open"
                                 @keydown.enter.prevent="open = !open"
                                 @keydown.space.prevent="open = !open"
                                 @keydown.arrow-down.prevent="open = true; focusIndex = Math.min(focusIndex + 1, options.length - 1)"
                                 @keydown.arrow-up.prevent="focusIndex = Math.max(focusIndex - 1, 0)">
                                <span :style="selected ? '' : 'opacity: 0.5'" x-text="selected || 'Choose a topic...'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#8B5E3C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" :style="open ? 'transform: rotate(180deg)' : ''" style="transition: transform 0.2s; flex-shrink: 0;" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div x-show="open" x-transition:enter="dropdown-enter" x-transition:enter-start="dropdown-enter-start" x-transition:enter-end="dropdown-enter-end" x-transition:leave="dropdown-leave" x-transition:leave-start="dropdown-leave-start" x-transition:leave-end="dropdown-leave-end" class="subject-dropdown" role="listbox" id="subject-listbox" aria-labelledby="subject-label">
                                <template x-for="(opt, idx) in options" :key="opt">
                                    <div @click="selected = opt; open = false" @keydown.enter.prevent="selected = opt; open = false" x-text="opt" class="subject-option" :class="{ 'active': selected === opt }" role="option" :aria-selected="selected === opt ? 'true' : 'false'" tabindex="0"></div>
                                </template>
                            </div>
                            @error('subject') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="contact-message">Message</label>
                        <textarea id="contact-message" name="message" class="form-input" placeholder="What's on your mind..." required>{{ old('message') }}</textarea>
                        @error('message') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="submit-wrap">
                        <button type="submit" class="submit-btn">Send Message ✦</button>
                    </div>
                </form>
            </div>

            {{-- INFO SIDE --}}
            <div class="envelope-info">
                <h3 class="info-heading">Get in Touch</h3>

                <div class="info-block">
                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value">Davenport, FL<br>Four Corners & Greater Orlando</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,7 12,13 2,7"/></svg></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value"><a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24"><path d="M18 2H15C13.3431 2 12 3.34315 12 5V8H9V12H12V22H16V12H19L20 8H16V5.5C16 5.22386 16.2239 5 16.5 5H18V2Z"/></svg></div>
                        <div>
                            <div class="info-label">Social</div>
                            <div class="info-value"><a href="https://www.facebook.com/bakeryonbiscotto" target="_blank">Facebook</a></div>
                        </div>
                    </div>
                </div>

                <div class="info-divider"></div>

                <h3 class="info-heading">Before You Order</h3>

                <div class="info-block">
                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                        <div>
                            <div class="info-label">Lead Time</div>
                            <div class="info-value">2+ days in advance. Great sourdough can't be rushed!</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24"><path d="M3 9l4-4 4 4"/><path d="M7 5v14"/><path d="M21 15l-4 4-4-4"/><path d="M17 19V5"/></svg></div>
                        <div>
                            <div class="info-label">Pickup & Delivery</div>
                            <div class="info-value">Pickup in Davenport. Delivery in greater Orlando area.</div>
                        </div>
                    </div>
                </div>

                {{-- MAP --}}
                <div style="margin-top: 28px; border-radius: 14px; overflow: hidden; border: 1px solid rgba(212,165,116,0.15); box-shadow: 0 2px 8px rgba(61,35,20,0.06);">
                    <iframe
                        title="Map showing Davenport, Florida location"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112284.7!2d-81.65!3d28.16!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88dd7d5a0b6f3b55%3A0x82a8b8a0f7e7a0c0!2sDavenport%2C%20FL!5e0!3m2!1sen!2sus!4v1"
                        width="100%" height="180" style="border:0; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="handwritten-note">
                    <p>Every loaf is made with care, from feeding the starter to pulling it out of the oven. I love what I do, and I'd love to bake for you.</p>
                    <div class="sig">- Cassie</div>
                </div>
            </div>
        </div>
    </div>

    </main>

    <x-site-footer />
</body>
</html>
