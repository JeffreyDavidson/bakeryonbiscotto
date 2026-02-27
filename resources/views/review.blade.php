<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-favicons />
    <title>Leave a Review | Bakery on Biscotto</title>
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

        /* Skip to main content */
        .skip-to-main {
            position: absolute; top: -100px; left: 50%; transform: translateX(-50%);
            background: var(--dark); color: var(--cream); padding: 12px 24px;
            border-radius: 0 0 8px 8px; font-family: 'Inter', sans-serif;
            font-size: 14px; font-weight: 600; text-decoration: none;
            z-index: 10000; transition: top 0.3s ease;
        }
        .skip-to-main:focus { top: 0; outline: 2px solid var(--golden); outline-offset: 2px; }

        /* Focus styles */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible, [tabindex]:focus-visible {
            outline: 2px solid var(--golden); outline-offset: 2px;
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
        .footer-info a { color: var(--golden); text-decoration: none; transition: color 0.3s; }
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

        /* Hero */
        .review-hero {
            padding: 160px 24px 80px;
            text-align: center;
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }
        .review-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 20% 50%, rgba(212,165,116,0.12), transparent),
                radial-gradient(ellipse 500px 350px at 80% 50%, rgba(193,127,78,0.08), transparent);
            pointer-events: none;
        }
        .review-hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.8rem, 6vw, 4rem);
            color: var(--cream);
            margin-bottom: 16px;
            position: relative;
        }
        .review-hero p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            color: var(--golden);
            max-width: 480px;
            margin: 0 auto;
            position: relative;
            opacity: 0.85;
        }

        /* Form */
        .review-wrap {
            max-width: 600px;
            margin: -40px auto 80px;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }
        .review-form-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 8px 40px rgba(61,35,20,0.08);
            border: 1px solid rgba(212,165,116,0.15);
        }
        .review-form-card h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            color: var(--dark);
            text-align: center;
            margin-bottom: 8px;
        }
        .review-form-card .form-sub {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 15px;
            color: var(--warm);
            text-align: center;
            margin-bottom: 28px;
        }
        .review-form-card label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 6px;
        }
        .review-form-card input,
        .review-form-card textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(139,94,60,0.2);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--dark);
            background: var(--light);
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            margin-bottom: 20px;
        }
        .review-form-card input:focus,
        .review-form-card textarea:focus {
            border-color: var(--golden);
            box-shadow: 0 0 0 3px rgba(212,165,116,0.15);
        }
        .review-form-card textarea { resize: vertical; min-height: 100px; }
        .review-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .star-rating {
            display: flex; gap: 4px; margin-bottom: 20px;
            justify-content: center;
        }
        .star-rating input { display: none; }
        .star-rating label {
            font-size: 32px;
            color: rgba(139,94,60,0.2);
            cursor: pointer;
            transition: color 0.2s, transform 0.2s;
            margin: 0;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label { transform: scale(1.1); }
        .star-rating input:checked ~ label { color: var(--golden); }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            color: var(--white);
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(193,127,78,0.3);
        }
        .review-success {
            text-align: center;
            padding: 40px 20px;
        }
        .review-success .check { font-size: 48px; margin-bottom: 16px; }
        .review-success h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .review-success p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            color: var(--warm);
            line-height: 1.6;
        }
        .review-success .fb-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 24px;
            background: #1877F2;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .review-success .fb-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(24,119,242,0.3);
        }
        .form-error {
            color: #c0392b;
            font-size: 12px;
            margin-top: -16px;
            margin-bottom: 12px;
        }

        @media (max-width: 600px) {
            .review-form-card { padding: 28px 20px; }
            .review-form-row { grid-template-columns: 1fr; }
            .star-rating label { font-size: 28px; }
}
    </style>
</head>
<body>

    <x-main-nav />

    <main id="main-content">
        <section class="review-hero">
            <h1>We'd Love Your Feedback</h1>
            <p>Your kind words mean the world to a small bakery like ours.</p>
        </section>

        <div class="review-wrap">
            <div class="review-form-card">
                @if(session('review_submitted'))
                    <div class="review-success">
                        <div class="check">🤍</div>
                        <h3>Thank you so much!</h3>
                        <p>Your review has been submitted and will appear on our page once approved. We appreciate you taking the time!</p>
                        <a href="https://facebook.com/bakeryonbiscotto" target="_blank" class="fb-link">
                            Also leave us a review on Facebook →
                        </a>
                    </div>
                @else
                    <h3>Tried our bread?</h3>
                    <p class="form-sub">We'd love to hear what you think!</p>

                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf

                        <div class="star-rating" x-data="{ rating: 5 }">
                            <template x-for="star in [5,4,3,2,1]" :key="star">
                                <div>
                                    <input type="radio" :id="'star-' + star" name="rating" :value="star" x-model="rating">
                                    <label :for="'star-' + star" @click="rating = star"
                                        :style="star <= rating ? 'color: var(--golden)' : ''">★</label>
                                </div>
                            </template>
                        </div>

                        <div class="review-form-row">
                            <div>
                                <label for="review-name">Your Name *</label>
                                <input type="text" id="review-name" name="name" required value="{{ old('name') }}" placeholder="Jane D.">
                                @error('name') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="review-bread">Favorite Bread</label>
                                <input type="text" id="review-bread" name="favorite_bread" value="{{ old('favorite_bread') }}" placeholder="Chocolate Chip Loaf">
                            </div>
                        </div>

                        <label for="review-body">Your Review *</label>
                        <textarea id="review-body" name="body" required placeholder="Tell us what you loved...">{{ old('body') }}</textarea>
                        @error('body') <p class="form-error">{{ $message }}</p> @enderror

                        <label for="review-email">Email <span style="font-weight:400;color:var(--warm);">(optional, won't be displayed)</span></label>
                        <input type="email" id="review-email" name="email" value="{{ old('email') }}" placeholder="jane@email.com">

                        <button type="submit" class="submit-btn">Submit Review</button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <x-site-footer />
</body>
</html>
