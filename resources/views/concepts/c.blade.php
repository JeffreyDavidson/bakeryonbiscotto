<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunday Morning - Bakery on Biscotto</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&family=Caveat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --soft-peach: #F9E5D0;
            --coral: #FF8A80;
            --mint: #A8E6CF;
            --lavender: #E1BEE7;
            --sunny: #FFE082;
            --rose: #F8BBD9;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--soft-peach) 0%, var(--cream) 50%, #FFF8E7 100%);
            overflow-x: hidden;
        }

        /* Concept Navigation */
        .concept-nav {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 1000;
            display: flex;
            gap: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 16px 20px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212,165,116,0.2);
        }

        .concept-nav a {
            color: var(--dark-brown);
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .concept-nav a.active {
            background: linear-gradient(135deg, var(--coral) 0%, var(--rose) 100%);
            color: white;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 5px 15px rgba(248,187,217,0.4);
        }

        .concept-nav a:hover:not(.active) {
            background: linear-gradient(135deg, var(--mint) 0%, var(--lavender) 100%);
            color: var(--dark-brown);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255,224,130,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(168,230,207,0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(248,187,217,0.3) 0%, transparent 50%),
                linear-gradient(135deg, var(--soft-peach) 0%, var(--cream) 100%);
        }

        .floating-elements {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            background: linear-gradient(135deg, var(--sunny) 0%, var(--coral) 100%);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            background: linear-gradient(135deg, var(--mint) 0%, var(--lavender) 100%);
            top: 60%;
            right: 15%;
            animation-delay: 2s;
            width: 80px;
            height: 80px;
        }

        .floating-element:nth-child(3) {
            background: linear-gradient(135deg, var(--rose) 0%, var(--coral) 100%);
            bottom: 25%;
            left: 20%;
            animation-delay: 4s;
            width: 40px;
            height: 40px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 30px;
        }

        .hero h1 {
            font-family: 'Caveat', cursive;
            font-size: clamp(3.5rem, 10vw, 7rem);
            color: var(--dark-brown);
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.1;
            transform: translateY(50px);
            opacity: 0;
            animation: bounceInUp 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.3s forwards;
        }

        .hero-tagline {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            color: var(--warm-brown);
            margin-bottom: 40px;
            font-weight: 500;
            transform: translateY(50px);
            opacity: 0;
            animation: bounceInUp 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.6s forwards;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            transform: translateY(50px);
            opacity: 0;
            animation: bounceInUp 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.9s forwards;
        }

        .btn {
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn:before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.2) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn:hover:before {
            opacity: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--coral) 0%, var(--rose) 100%);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--mint) 0%, var(--lavender) 100%);
            color: var(--dark-brown);
        }

        .btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        @keyframes bounceInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            60% {
                opacity: 1;
                transform: translateY(-10px);
            }
            80% {
                transform: translateY(5px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Biscotto Character Section */
        .biscotto-section {
            padding: 100px 30px;
            text-align: center;
            background: 
                radial-gradient(circle at 30% 20%, rgba(255,224,130,0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(168,230,207,0.2) 0%, transparent 50%);
        }

        .biscotto-card {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 60px 50px;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            border: 3px solid rgba(212,165,116,0.3);
        }

        .biscotto-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                from 0deg,
                transparent 0deg,
                rgba(255,224,130,0.1) 90deg,
                rgba(168,230,207,0.1) 180deg,
                rgba(248,187,217,0.1) 270deg,
                transparent 360deg
            );
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        .biscotto-content {
            position: relative;
            z-index: 1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .biscotto-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden-tan) 0%, var(--warm-brown) 100%);
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Caveat', cursive;
            font-size: 3rem;
            color: white;
            font-weight: 700;
            box-shadow: 0 15px 30px rgba(212,165,116,0.3);
            position: relative;
            animation: pulse 3s ease-in-out infinite;
        }

        .biscotto-avatar::after {
            content: '✨';
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 2rem;
            animation: twinkle 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes twinkle {
            0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.7; transform: scale(1.2) rotate(180deg); }
        }

        .biscotto-title {
            font-family: 'Caveat', cursive;
            font-size: 3rem;
            color: var(--dark-brown);
            margin-bottom: 25px;
            font-weight: 700;
        }

        .biscotto-story {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--warm-brown);
            margin-bottom: 20px;
        }

        /* Stats Counter */
        .stats-section {
            padding: 80px 30px;
            background: linear-gradient(135deg, var(--dark-brown) 0%, var(--warm-brown) 100%);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            padding: 40px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.4s ease;
        }

        .stat-item:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .stat-number {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--sunny);
            display: block;
            margin-bottom: 15px;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Customer Favorites */
        .favorites-section {
            padding: 100px 30px;
            text-align: center;
        }

        .section-title {
            font-family: 'Caveat', cursive;
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: var(--dark-brown);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .section-subtitle {
            font-size: 1.3rem;
            color: var(--warm-brown);
            margin-bottom: 60px;
            font-weight: 500;
        }

        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .favorite-card {
            background: white;
            padding: 40px 30px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 2px solid rgba(212,165,116,0.1);
            position: relative;
            overflow: hidden;
        }

        .favorite-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--coral) 0%, var(--rose) 50%, var(--lavender) 100%);
            transition: left 0.6s ease;
        }

        .favorite-card:hover::before {
            left: 0;
        }

        .favorite-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .favorite-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .favorite-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-brown);
            line-height: 1.3;
        }

        .favorite-rating {
            display: flex;
            gap: 3px;
            align-items: center;
            font-size: 1.2rem;
        }

        .star {
            color: var(--sunny);
        }

        .favorite-price {
            font-family: 'Caveat', cursive;
            font-size: 2rem;
            color: var(--warm-brown);
            font-weight: 700;
            margin: 15px 0;
        }

        .favorite-description {
            font-size: 1rem;
            line-height: 1.7;
            color: #666;
            margin-bottom: 20px;
        }

        .favorite-reviews {
            font-size: 0.9rem;
            color: var(--coral);
            font-weight: 600;
            font-style: italic;
        }

        /* Menu Grid */
        .menu-section {
            padding: 100px 30px;
            background: 
                radial-gradient(circle at 20% 40%, rgba(168,230,207,0.2) 0%, transparent 60%),
                radial-gradient(circle at 80% 60%, rgba(255,224,130,0.2) 0%, transparent 60%);
        }

        .menu-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-category {
            background: white;
            padding: 50px 40px;
            border-radius: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: 3px solid rgba(212,165,116,0.2);
            position: relative;
            overflow: hidden;
        }

        .menu-category::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, var(--mint) 0%, var(--sunny) 50%, var(--coral) 100%);
        }

        .category-title {
            font-family: 'Caveat', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px dashed rgba(212,165,116,0.3);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: linear-gradient(90deg, rgba(168,230,207,0.1) 0%, rgba(255,224,130,0.1) 100%);
            margin: 0 -20px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 20px;
        }

        .item-info h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 5px;
        }

        .item-info p {
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
        }

        .item-price {
            font-family: 'Caveat', cursive;
            font-size: 1.8rem;
            color: var(--warm-brown);
            font-weight: 700;
        }

        /* Instagram-style Gallery */
        .gallery-section {
            padding: 100px 30px;
            background: linear-gradient(135deg, var(--cream) 0%, white 100%);
        }

        .instagram-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 40px auto 0;
        }

        .insta-post {
            aspect-ratio: 1;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .insta-post:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .insta-post img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .insta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(255,138,128,0.8) 0%, rgba(248,187,217,0.8) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .insta-post:hover .insta-overlay {
            opacity: 1;
        }

        .insta-likes {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .placeholder-post {
            background: linear-gradient(135deg, var(--mint) 0%, var(--lavender) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Caveat', cursive;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Newsletter Section */
        .newsletter-section {
            padding: 100px 30px;
            background: linear-gradient(135deg, var(--coral) 0%, var(--rose) 100%);
            text-align: center;
            color: white;
        }

        .newsletter-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-title {
            font-family: 'Caveat', cursive;
            font-size: 3.5rem;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .newsletter-text {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .newsletter-form {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 400px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            min-width: 200px;
            padding: 16px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            background: rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .newsletter-input::placeholder {
            color: rgba(255,255,255,0.8);
        }

        .newsletter-btn {
            padding: 16px 32px;
            background: white;
            color: var(--coral);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Contact Section */
        .contact-section {
            padding: 100px 30px;
            text-align: center;
            background: white;
        }

        .contact-card {
            max-width: 700px;
            margin: 0 auto;
            background: linear-gradient(135deg, var(--soft-peach) 0%, var(--cream) 100%);
            padding: 60px 50px;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            border: 3px solid rgba(212,165,116,0.3);
        }

        .contact-title {
            font-family: 'Caveat', cursive;
            font-size: 3rem;
            color: var(--dark-brown);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .contact-info {
            font-size: 1.2rem;
            line-height: 2;
            color: var(--warm-brown);
            margin-bottom: 40px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .social-badges {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-badge {
            background: linear-gradient(135deg, var(--mint) 0%, var(--lavender) 100%);
            color: var(--dark-brown);
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .social-badge:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .concept-nav {
                position: relative;
                top: 0;
                right: 0;
                margin: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .menu-categories {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .newsletter-form {
                flex-direction: column;
                gap: 15px;
            }

            .newsletter-input {
                min-width: auto;
            }

            .biscotto-card,
            .contact-card {
                padding: 40px 30px;
                border-radius: 30px;
            }

            .floating-element {
                display: none;
            }
        }

        /* Custom animations for counters */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-count {
            animation: countUp 0.6s ease-out;
        }
    </style>
</head>
<body x-data="{ 
    loaves: 0, 
    customers: 0, 
    years: 0, 
    smiles: 0,
    animateCounters: false
}">
    
    <!-- Concept Navigation -->
    <div class="concept-nav">
        <a href="/">The Bakehouse</a>
        <a href="/concept-b">Modern Artisan</a>
        <a href="/concept-c" class="active">Sunday Morning</a>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        <div class="hero-content">
            <h1>Sunday Morning Vibes ☀️</h1>
            <p class="hero-tagline">Where every day feels like a cozy Sunday morning with fresh bread and warm smiles</p>
            <div class="hero-buttons">
                <a href="#favorites" class="btn btn-primary">See Our Favorites ⭐</a>
                <a href="#menu" class="btn btn-secondary">Browse Menu 🍞</a>
            </div>
        </div>
    </section>

    <!-- Biscotto Character Section -->
    <section class="biscotto-section">
        <div class="biscotto-card">
            <div class="biscotto-content">
                <div class="biscotto-avatar">
                    Biscotto
                </div>
                <h2 class="biscotto-title">Meet Our Star! 🌟</h2>
                <p class="biscotto-story">
                    Hey there, beautiful humans! I'm Biscotto, your friendly neighborhood sourdough starter, and I'm absolutely OBSESSED with making your mornings better! 🥖✨
                </p>
                <p class="biscotto-story">
                    Born and raised in sunny Florida, I've been bubbling with excitement since day one! Every morning, Cassie feeds me the good stuff (organic flour and spring water - I'm fancy like that! 💅), and together we create magic in the kitchen.
                </p>
                <p class="biscotto-story">
                    I love meeting new friends and turning simple ingredients into something that makes people smile. That's my superpower! Want to be bread besties? 🤝
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Counter Section -->
    <section class="stats-section" 
             x-intersect.once="
                setTimeout(() => {
                    let loavesCount = 0;
                    let customersCount = 0;
                    let yearsCount = 0;
                    let smilesCount = 0;
                    
                    const loavesInterval = setInterval(() => {
                        if (loavesCount < 2847) {
                            loavesCount += 47;
                            loaves = Math.min(loavesCount, 2847);
                        } else clearInterval(loavesInterval);
                    }, 50);
                    
                    const customersInterval = setInterval(() => {
                        if (customersCount < 524) {
                            customersCount += 8;
                            customers = Math.min(customersCount, 524);
                        } else clearInterval(customersInterval);
                    }, 80);
                    
                    const yearsInterval = setInterval(() => {
                        if (yearsCount < 1) {
                            years = 1;
                        }
                        clearInterval(yearsInterval);
                    }, 1000);
                    
                    const smilesInterval = setInterval(() => {
                        if (smilesCount < 10000) {
                            smilesCount += 147;
                            smiles = Math.min(smilesCount, 10000);
                        } else clearInterval(smilesInterval);
                    }, 40);
                    
                    animateCounters = true;
                }, 300)
             ">
        <div class="stats-grid">
            <div class="stat-item" :class="{ 'animate-count': animateCounters }">
                <span class="stat-number" x-text="loaves"></span>
                <span class="stat-label">Loaves Baked</span>
            </div>
            <div class="stat-item" :class="{ 'animate-count': animateCounters }">
                <span class="stat-number" x-text="customers"></span>
                <span class="stat-label">Happy Customers</span>
            </div>
            <div class="stat-item" :class="{ 'animate-count': animateCounters }">
                <span class="stat-number" x-text="years"></span>
                <span class="stat-label">Years of Love</span>
            </div>
            <div class="stat-item" :class="{ 'animate-count': animateCounters }">
                <span class="stat-number" x-text="smiles + '+'"></span>
                <span class="stat-label">Smiles Created</span>
            </div>
        </div>
    </section>

    <!-- Customer Favorites Section -->
    <section class="favorites-section" id="favorites">
        <h2 class="section-title">Customer Favorites 💕</h2>
        <p class="section-subtitle">These are the loaves our community absolutely adores!</p>
        
        <div class="favorites-grid">
            <div class="favorite-card">
                <div class="favorite-header">
                    <h3 class="favorite-name">Chocolate Chip Sourdough</h3>
                    <div class="favorite-rating">
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                    </div>
                </div>
                <div class="favorite-price">$12</div>
                <p class="favorite-description">
                    Belgian dark chocolate meets tangy sourdough in this perfect marriage of sweet and sour. It's like a warm hug in bread form!
                </p>
                <div class="favorite-reviews">"My kids fight over the last slice!" - Sarah M.</div>
            </div>

            <div class="favorite-card">
                <div class="favorite-header">
                    <h3 class="favorite-name">English Muffins</h3>
                    <div class="favorite-rating">
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                    </div>
                </div>
                <div class="favorite-price">$8 / $15</div>
                <p class="favorite-description">
                    Hand-shaped and griddle-cooked to perfection. Those nooks and crannies are perfect for holding all the butter and jam your heart desires!
                </p>
                <div class="favorite-reviews">"Better than store-bought by a mile!" - Mike R.</div>
            </div>

            <div class="favorite-card">
                <div class="favorite-header">
                    <h3 class="favorite-name">Cinnamon Sugar Sourdough</h3>
                    <div class="favorite-rating">
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                        <span class="star">⭐</span>
                    </div>
                </div>
                <div class="favorite-price">$14</div>
                <p class="favorite-description">
                    Weekend morning magic! Ceylon cinnamon swirled with organic sugar creates the most heavenly breakfast bread. Toast it and thank us later!
                </p>
                <div class="favorite-reviews">"Sunday mornings just got better!" - Emma K.</div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu-section" id="menu">
        <h2 class="section-title">Our Daily Menu 📋</h2>
        <p class="section-subtitle">Fresh-baked goodness made with love every single day</p>
        
        <div class="menu-categories">
            <div class="menu-category">
                <h3 class="category-title">Sourdough Loafs 🍞</h3>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Regular Loaf</h4>
                        <p>Our classic - simple, perfect, pure sourdough magic</p>
                    </div>
                    <span class="item-price">$10</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Cheddar</h4>
                        <p>Sharp Vermont cheddar brings the comfort vibes</p>
                    </div>
                    <span class="item-price">$12</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Mozzarella and Garlic</h4>
                        <p>Fresh mozz + roasted garlic = pure heaven</p>
                    </div>
                    <span class="item-price">$14</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Chocolate Chip ⭐ Customer Fave!</h4>
                        <p>Belgian dark chocolate chips in tangy sourdough</p>
                    </div>
                    <span class="item-price">$12</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Cinnamon and Sugar ⭐ Customer Fave!</h4>
                        <p>Weekend vibes with Ceylon cinnamon swirls</p>
                    </div>
                    <span class="item-price">$14</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Chocolate, Chocolate Chip</h4>
                        <p>Double chocolate dreams come true!</p>
                    </div>
                    <span class="item-price">$12</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Chocolate Almond, Chocolate Chip</h4>
                        <p>Premium almonds meet chocolate paradise</p>
                    </div>
                    <span class="item-price">$15</span>
                </div>
                
                <div class="menu-item" style="background: linear-gradient(90deg, rgba(255,138,128,0.1) 0%, rgba(248,187,217,0.1) 100%); margin: 20px -20px; padding: 25px 20px; border-radius: 20px; border: 2px dashed var(--coral);">
                    <div class="item-info">
                        <h4>🎉 4 Pack Mini Loafs - Mix & Match!</h4>
                        <p>Choose any 4 varieties - perfect for trying everything!</p>
                    </div>
                    <span class="item-price">$25</span>
                </div>
            </div>

            <div class="menu-category">
                <h3 class="category-title">Other Breads 🥖</h3>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Sourdough Honey Wheat Sandwich Bread</h4>
                        <p>Whole wheat + wildflower honey = sandwich perfection</p>
                    </div>
                    <span class="item-price">$10</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Sourdough English Muffins ⭐ Customer Fave!</h4>
                        <p>Hand-shaped, griddle-cooked, nook-and-cranny perfection</p>
                    </div>
                    <span class="item-price">$8 / $15</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Banana Bread</h4>
                        <p>Ripe bananas + warm spices = comfort food gold</p>
                    </div>
                    <span class="item-price">$12</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Banana Walnut Bread</h4>
                        <p>All the banana love plus crunchy walnuts</p>
                    </div>
                    <span class="item-price">$15</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Pumpkin Chocolate Chip Bread</h4>
                        <p>Fall flavors meet chocolate chips - cozy vibes only</p>
                    </div>
                    <span class="item-price">$12</span>
                </div>
                
                <div class="menu-item">
                    <div class="item-info">
                        <h4>Pumpkin Almond Chocolate Chip Bread</h4>
                        <p>The ultimate autumn indulgence with toasted almonds</p>
                    </div>
                    <span class="item-price">$15</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram Gallery Section -->
    <section class="gallery-section" id="gallery">
        <h2 class="section-title">Our Instagram Moments 📸</h2>
        <p class="section-subtitle">Follow @bakeryonbiscotto for daily bread inspo!</p>
        
        <div class="instagram-grid">
            <div class="insta-post">
                <img src="/images/product-sourdough-boule.jpg" alt="Beautiful Sourdough Boule">
                <div class="insta-overlay">
                    <div class="insta-likes">❤️ 284 likes</div>
                </div>
            </div>
            <div class="insta-post">
                <img src="/images/product-english-muffins.jpg" alt="Fresh English Muffins">
                <div class="insta-overlay">
                    <div class="insta-likes">❤️ 192 likes</div>
                </div>
            </div>
            <div class="insta-post placeholder-post">
                Behind the Scenes! 🎬
            </div>
            <div class="insta-post placeholder-post">
                Biscotto's Daily Feed 🥣
            </div>
            <div class="insta-post placeholder-post">
                Customer Smiles 😊
            </div>
            <div class="insta-post placeholder-post">
                Recipe Sneak Peeks 👀
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2 class="newsletter-title">Join the Bread Fam! 💌</h2>
            <p class="newsletter-text">
                Get first dibs on new flavors, behind-the-scenes content with Biscotto, and maybe a special discount or two! We promise not to spam you - just the good stuff! ✨
            </p>
            <form class="newsletter-form">
                <input type="email" placeholder="your.email@awesome.com" class="newsletter-input">
                <button type="submit" class="newsletter-btn">Count Me In! 🙌</button>
            </form>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-card">
            <h2 class="contact-title">Come Say Hi! 👋</h2>
            <div class="contact-info">
                <p><strong>Cassie's Cottage Food Operation</strong></p>
                <p>🏠 2339 Biscotto Cir, Davenport, FL 33897</p>
                <p>📧 bakeryonbiscotto@gmail.com</p>
                <p style="margin-top: 30px; font-style: italic; color: var(--coral);">
                    "From our kitchen to yours - spreading joy one loaf at a time!" 💕
                </p>
            </div>
            <div class="social-badges">
                <a href="#" class="social-badge">Facebook 📘</a>
                <a href="#" class="social-badge">Instagram 📷</a>
                <a href="#" class="social-badge">Say Hello! 👋</a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add some fun hover effects to cards
        document.querySelectorAll('.favorite-card, .menu-category').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>