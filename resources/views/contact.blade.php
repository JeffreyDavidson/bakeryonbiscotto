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
        .main-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 500;
            color: var(--cream); text-decoration: none;
            padding: 10px 24px; border-radius: 100px;
            transition: all 0.3s ease;
        }
        .main-nav a:hover { background: rgba(212,165,116,0.2); color: var(--golden); }
        .main-nav a.active { background: var(--golden); color: var(--dark); font-weight: 600; }

        /* ═══ HERO ═══ */
        .hero {
            padding: 140px 24px 60px;
            text-align: center;
            background: linear-gradient(180deg, var(--cream) 0%, var(--light) 100%);
        }
        .hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.5rem, 6vw, 4rem);
            color: var(--dark);
            margin-bottom: 12px;
        }
        .hero p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            color: var(--warm);
            max-width: 500px;
            margin: 0 auto;
        }

        /* ═══ CONTENT ═══ */
        .contact-layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 60px 24px 80px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        /* ═══ INFO SIDE ═══ */
        .info-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(139,94,60,0.1);
            box-shadow: 0 4px 24px rgba(61,35,20,0.06);
        }
        .info-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--dark);
            margin-bottom: 24px;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }
        .info-item:last-child { margin-bottom: 0; }
        .info-icon {
            width: 44px; height: 44px;
            background: var(--cream);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .info-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--warm);
            margin-bottom: 4px;
        }
        .info-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            color: var(--dark);
            line-height: 1.4;
        }
        .info-value a {
            color: var(--accent);
            text-decoration: none;
        }
        .info-value a:hover { text-decoration: underline; }

        .info-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
            margin: 28px 0;
        }

        .hours-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 8px 20px;
            font-size: 0.95rem;
        }
        .hours-day { color: var(--warm); font-weight: 500; }
        .hours-time {
            font-family: 'Cormorant Garamond', serif;
            color: var(--dark);
            text-align: right;
        }

        /* ═══ FORM SIDE ═══ */
        .form-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(139,94,60,0.1);
            box-shadow: 0 4px 24px rgba(61,35,20,0.06);
        }
        .form-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--dark);
            margin-bottom: 24px;
        }
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--warm);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(139,94,60,0.15);
            border-radius: 12px;
            background: var(--light);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--golden);
            box-shadow: 0 0 0 3px rgba(212,165,116,0.15);
        }
        .form-input::placeholder { color: #b8a090; }
        textarea.form-input { resize: vertical; min-height: 120px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: var(--dark);
            color: var(--cream);
            border: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .submit-btn:hover { background: var(--brown); }

        .success-msg {
            background: rgba(34,197,94,0.08);
            border: 1.5px solid rgba(34,197,94,0.2);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            color: #166534;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-msg {
            color: #c0392b;
            font-size: 0.82rem;
            margin-top: 4px;
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

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 768px) {
            .contact-layout {
                grid-template-columns: 1fr;
                gap: 32px;
                padding: 40px 24px 60px;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="main-nav">
        <a href="/">Home</a>
        <a href="/#menu">Menu</a>
        <a href="/contact" class="active">Contact</a>
    </nav>

    <section class="hero">
        <h1>Get in Touch</h1>
        <p>Have a question, special request, or just want to say hello? We'd love to hear from you.</p>
    </section>

    <div class="contact-layout">
        {{-- INFO --}}
        <div class="info-card">
            <h2>Bakery Info</h2>

            <div class="info-item">
                <div class="info-icon">📍</div>
                <div>
                    <div class="info-label">Location</div>
                    <div class="info-value">Davenport, FL<br>Four Corners & Greater Orlando Area</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📧</div>
                <div>
                    <div class="info-label">Email</div>
                    <div class="info-value"><a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a></div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📱</div>
                <div>
                    <div class="info-label">Social</div>
                    <div class="info-value"><a href="https://www.facebook.com/bakeryonbiscotto" target="_blank">Facebook</a></div>
                </div>
            </div>

            <div class="info-divider"></div>

            <h2>Order Info</h2>

            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div>
                    <div class="info-label">Lead Time</div>
                    <div class="info-value">Please order at least 2 days in advance. Sourdough takes love and time!</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">🚗</div>
                <div>
                    <div class="info-label">Pickup & Delivery</div>
                    <div class="info-value">Pickup available in Davenport. Delivery available in the greater Orlando area.</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">🍞</div>
                <div>
                    <div class="info-label">Custom Orders</div>
                    <div class="info-value">Have something special in mind? Send us a message and we'll do our best!</div>
                </div>
            </div>
        </div>

        {{-- FORM --}}
        <div class="form-card">
            <h2>Send a Message</h2>

            @if(session('success'))
                <div class="success-msg">
                    <span>✅</span> Thanks for reaching out! We'll get back to you as soon as we can.
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-input" placeholder="Your name" value="{{ old('name') }}" required>
                        @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="you@email.com" value="{{ old('email') }}" required>
                        @error('email') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone <span style="font-weight: 400; text-transform: none; opacity: 0.6;">(optional)</span></label>
                        <input type="tel" name="phone" class="form-input" placeholder="(555) 123-4567" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-input" placeholder="What's this about?" value="{{ old('subject') }}" required>
                        @error('subject') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-input" placeholder="Tell us what's on your mind..." required>{{ old('message') }}</textarea>
                    @error('message') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Bakery on Biscotto. <a href="/">Back to Home</a></p>
    </footer>
</body>
</html>
