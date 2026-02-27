<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-favicons />
    @yield('meta')
    @php use App\Models\Setting; @endphp
    <title>{{ $title ?? Setting::get('business_name', 'Bakery on Biscotto') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    @yield('extra_fonts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --brand-900: #3d2314;
            --brand-800: #4a3225;
            --brand-700: #6b4c3b;
            --brand-600: #8b5e3c;
            --brand-500: #a08060;
            --brand-400: #c4a882;
            --brand-300: #d4a574;
            --brand-200: #e8d0b0;
            --brand-150: #f3ebe0;
            --brand-100: #f5e6d0;
            --brand-50: #fdf8f2;
            --accent-gold: #d4a574;
            --status-success: #16a34a;
            --status-danger: #dc2626;
            --status-warning: #d97706;

            --dark: var(--brand-900);
            --brown: var(--brand-600);
            --cream: var(--brand-100);
            --golden: var(--brand-300);
            --accent: #C17F4E;
            --light: var(--brand-50);
            --white: #FFFFFF;
            --warm: var(--brand-700);
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

        /* Navigation */
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

        /* Footer */
        .footer {
            background: var(--dark); position: relative; overflow: hidden;
            padding: 0 20px 40px; text-align: center;
        }
        .footer-gradient {
            height: 3px;
            background: linear-gradient(90deg, transparent 5%, var(--golden), var(--accent), var(--golden), transparent 95%);
            margin-bottom: 60px;
        }
        .footer h3 {
            font-family: 'Playfair Display', serif; font-size: 1.8rem;
            color: var(--cream); margin-bottom: 8px;
        }
        .footer .tagline {
            font-family: 'Dancing Script', cursive; font-size: 1.15rem;
            color: var(--golden); margin-bottom: 24px;
        }
        .footer-badge {
            display: inline-block; padding: 10px 28px;
            border: 1.5px solid rgba(212,165,116,0.25); border-radius: 100px;
            font-size: 13px; font-weight: 500; color: rgba(245,230,208,0.6);
            margin-bottom: 28px; letter-spacing: 0.5px;
        }
        .footer-info {
            font-size: 14px; color: rgba(245,230,208,0.4); line-height: 2.2;
        }
        .footer-info a {
            color: var(--golden); text-decoration: none; transition: color 0.3s;
        }
        .footer-info a:hover { color: var(--cream); }
        .footer-allergen {
            margin-top: 24px; font-size: 11px; color: rgba(245,230,208,0.35);
            max-width: 600px; margin-left: auto; margin-right: auto;
            line-height: 1.5; font-style: italic;
        }
        .footer-bottom {
            margin-top: 20px; padding-top: 20px;
            border-top: 1px solid rgba(245,230,208,0.06);
            font-size: 12px; color: rgba(245,230,208,0.2);
        }

        /* Floating Contact CTA */
        .floating-contact {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 900;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 22px;
            background: var(--dark);
            color: var(--cream);
            text-decoration: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 600;
            box-shadow: 0 6px 24px rgba(61,35,20,0.25);
            border: 1px solid rgba(212,165,116,0.15);
            transition: all 0.3s ease;
        }
        .floating-contact:hover {
            background: var(--brown);
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(61,35,20,0.3);
        }
        .fc-icon { font-size: 1.2rem; }
        .fc-text { letter-spacing: 0.3px; }
        @media (max-width: 600px) {
            .floating-contact {
                bottom: 20px; right: 20px;
                padding: 12px 18px;
                font-size: 0.85rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body @yield('body_attrs')>

    <x-main-nav active="{{ $active ?? 'home' }}" />

    <main id="main-content">
        @yield('content')
    </main>

    <x-site-footer />

    @yield('floating')

    @yield('scripts')
</body>
</html>
