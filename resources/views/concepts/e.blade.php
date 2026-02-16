<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto - Flour & Fire</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --charcoal: #2C2C2C;
            --deep-black: #1A1A1A;
        }

        body {
            font-family: 'Lora', serif;
            line-height: 1.6;
            color: var(--cream);
            background: var(--deep-black);
            overflow-x: hidden;
        }

        /* Concept Switcher Navigation */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(212, 165, 116, 0.2);
        }

        .concept-nav a {
            color: var(--cream);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 0.7;
            border: 1px solid transparent;
        }

        .concept-nav a:hover {
            border-color: var(--golden-tan);
            opacity: 1;
            transform: translateY(-1px);
        }

        .concept-nav a.active {
            background: var(--golden-tan);
            color: var(--deep-black);
            opacity: 1;
        }

        /* Flour Particles Animation */
        .flour-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: var(--cream);
            border-radius: 50%;
            opacity: 0;
            animation: float-and-fade 8s infinite linear;
        }

        @keyframes float-and-fade {
            0% {
                opacity: 0;
                transform: translateY(100vh) rotate(0deg);
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                opacity: 0;
                transform: translateY(-100px) rotate(360deg);
            }
        }

        /* Hero Section - Cinematic */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--deep-black) 0%, var(--charcoal) 50%, var(--dark-brown) 100%);
            padding-top: 80px;
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            max-width: 1000px;
            padding: 0 2rem;
            position: relative;
        }

        .hero-content h1 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(3rem, 8vw, 7rem);
            font-weight: 700;
            line-height: 0.9;
            margin-bottom: 2rem;
            color: var(--cream);
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-content .subtitle {
            font-family: 'Lora', serif;
            font-style: italic;
            font-size: clamp(1.2rem, 3vw, 2rem);
            color: var(--golden-tan);
            margin-bottom: 3rem;
            font-weight: 300;
        }

        .hero-content .tagline {
            font-size: clamp(0.9rem, 2vw, 1.2rem);
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto 3rem auto;
            color: var(--cream);
            opacity: 0.9;
        }

        /* Parallax Sections */
        .parallax-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            z-index: 2;
        }

        .parallax-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(61, 35, 20, 0.9) 100%);
            z-index: 1;
        }

        .parallax-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Tasting Menu Style Product Display */
        .menu-section {
            background: var(--deep-black);
            padding: 8rem 0;
            position: relative;
            z-index: 2;
        }

        .menu-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .menu-header {
            text-align: center;
            margin-bottom: 6rem;
        }

        .menu-header h2 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }

        .menu-header p {
            font-size: 1.2rem;
            color: var(--golden-tan);
            font-style: italic;
        }

        .menu-grid {
            display: grid;
            gap: 4rem;
        }

        .menu-item {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 3rem;
            align-items: center;
            padding: 3rem 0;
            border-bottom: 1px solid rgba(212, 165, 116, 0.2);
            position: relative;
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease;
        }

        .menu-item.reverse {
            grid-template-columns: 2fr 1fr;
        }

        .menu-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item-image {
            width: 100%;
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.4);
        }

        .menu-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .menu-item:hover .menu-item-image img {
            transform: scale(1.05);
        }

        .menu-item-content h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 2.2rem;
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .menu-item-content .description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--cream);
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .menu-item-content .price {
            display: inline-block;
            background: linear-gradient(135deg, var(--golden-tan) 0%, var(--warm-brown) 100%);
            color: var(--deep-black);
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 1.3rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Featured Product Cards */
        .featured-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin: 4rem 0;
        }

        .featured-card {
            background: var(--charcoal);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.6s ease;
            border: 1px solid rgba(212, 165, 116, 0.1);
        }

        .featured-card:hover {
            transform: translateY(-10px);
            border-color: var(--golden-tan);
            box-shadow: 0 20px 40px rgba(212, 165, 116, 0.1);
        }

        .featured-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.1), transparent);
            transition: left 0.8s ease;
        }

        .featured-card:hover::before {
            left: 100%;
        }

        .featured-card h4 {
            font-family: 'Oswald', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .featured-card .ingredients {
            color: var(--golden-tan);
            font-style: italic;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .featured-card .card-price {
            background: var(--golden-tan);
            color: var(--deep-black);
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        /* Story Section */
        .story-section {
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--dark-brown) 100%);
            padding: 8rem 2rem;
            text-align: center;
        }

        .story-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .story-content h2 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            margin-bottom: 2rem;
            letter-spacing: 2px;
        }

        .story-content .story-text {
            font-size: 1.3rem;
            line-height: 1.8;
            color: var(--cream);
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Contact Section */
        .contact-section {
            background: var(--deep-black);
            padding: 6rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
        }

        .contact-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-content h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--cream);
            text-transform: uppercase;
            margin-bottom: 3rem;
            letter-spacing: 1px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .contact-item {
            background: var(--charcoal);
            padding: 2rem;
            border-radius: 15px;
            border: 1px solid rgba(212, 165, 116, 0.1);
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            border-color: var(--golden-tan);
            transform: translateY(-5px);
        }

        .contact-item h4 {
            font-family: 'Oswald', sans-serif;
            font-size: 1.2rem;
            color: var(--golden-tan);
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        /* Animations */
        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease;
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s ease;
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .slide-in-left.visible,
        .slide-in-right.visible,
        .fade-in-up.visible {
            opacity: 1;
            transform: translate(0);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .menu-item,
            .menu-item.reverse {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .concept-nav {
                padding: 10px;
                gap: 8px;
            }

            .concept-nav a {
                padding: 6px 12px;
                font-size: 12px;
            }

            .featured-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Concept Switcher Navigation -->
    <nav class="concept-nav">
        <a href="/">A</a>
        <a href="/concept-b">B</a>
        <a href="/concept-c">C</a>
        <a href="/concept-d">D</a>
        <a href="/concept-e" class="active">E</a>
        <a href="/concept-f">F</a>
    </nav>

    <!-- Flour Particles -->
    <div class="flour-particles" id="flourParticles"></div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="fade-in-up">Flour & Fire</h1>
            <div class="subtitle fade-in-up">Where Artistry Meets Ancient Craft</div>
            <div class="tagline fade-in-up">
                In the quiet hours before dawn, magic happens. Flour transforms through fire, 
                patience becomes perfection, and every loaf tells the story of time, tradition, and the living culture we call Biscotto.
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="parallax-section" style="background-image: url('/images/hero-banner.jpg');">
        <div class="parallax-overlay"></div>
        <div class="parallax-content">
            <div class="featured-cards">
                <div class="featured-card fade-in-up">
                    <h4>The Signature</h4>
                    <div class="ingredients">Pure sourdough perfection</div>
                    <p>Our classic loaf—the foundation of everything we create. Made with only the essential elements: flour, water, salt, and the living culture that breathes life into every slice.</p>
                    <div class="card-price">$10</div>
                </div>
                <div class="featured-card fade-in-up">
                    <h4>The Elevated</h4>
                    <div class="ingredients">Premium ingredients, artisan technique</div>
                    <p>Cheddar aged to perfection, mozzarella that melts like silk, chocolate that deepens with each fermented hour. These are not just flavors—they are experiences.</p>
                    <div class="card-price">$12-15</div>
                </div>
                <div class="featured-card fade-in-up">
                    <h4>The Collection</h4>
                    <div class="ingredients">Four mini masterpieces</div>
                    <p>Why choose one when you can experience four? Our mini loaf collection lets you taste the full spectrum of what flour and fire can create.</p>
                    <div class="card-price">$25</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section - Tasting Menu Style -->
    <section class="menu-section">
        <div class="menu-container">
            <div class="menu-header fade-in-up">
                <h2>The Tasting Experience</h2>
                <p>Each loaf, a chapter in the story of sourdough</p>
            </div>

            <div class="menu-grid">
                <!-- Featured with Images -->
                <div class="menu-item slide-in-left">
                    <div class="menu-item-image">
                        <img src="/images/product-sourdough-boule.jpg" alt="Perfect sourdough boule">
                    </div>
                    <div class="menu-item-content">
                        <h3>The Foundation</h3>
                        <div class="description">
                            Our signature sourdough boule—where it all begins. The perfect ear, the golden crust that sings when it cools, 
                            the crumb that's both tender and structured. This is not just bread; this is the embodiment of time, patience, and living culture.
                        </div>
                        <div class="price">$10</div>
                    </div>
                </div>

                <div class="menu-item reverse slide-in-right">
                    <div class="menu-item-content">
                        <h3>English Muffin Mastery</h3>
                        <div class="description">
                            Hand-shaped and griddle-kissed, these aren't your ordinary English muffins. The sourdough tang elevates every nook and cranny, 
                            creating the perfect vessel for morning rituals and weekend indulgence.
                        </div>
                        <div class="price">$8 / $15</div>
                    </div>
                    <div class="menu-item-image">
                        <img src="/images/product-english-muffins.jpg" alt="Sourdough English muffins">
                    </div>
                </div>

                <!-- Text-based menu items for dramatic effect -->
                <div class="menu-item slide-in-left">
                    <div class="menu-item-content" style="grid-column: span 2; text-align: center;">
                        <h3>The Flavor Journey</h3>
                        <div class="featured-cards" style="margin-top: 2rem;">
                            <div class="featured-card">
                                <h4>Cheddar</h4>
                                <div class="ingredients">Sharp aged cheddar</div>
                                <div class="card-price">$12</div>
                            </div>
                            <div class="featured-card">
                                <h4>Mozzarella & Garlic</h4>
                                <div class="ingredients">Fresh mozzarella, roasted garlic</div>
                                <div class="card-price">$14</div>
                            </div>
                            <div class="featured-card">
                                <h4>Chocolate Chip</h4>
                                <div class="ingredients">Semi-sweet chocolate</div>
                                <div class="card-price">$12</div>
                            </div>
                            <div class="featured-card">
                                <h4>Cinnamon Sugar</h4>
                                <div class="ingredients">Ceylon cinnamon swirl</div>
                                <div class="card-price">$14</div>
                            </div>
                            <div class="featured-card">
                                <h4>Banana Walnut</h4>
                                <div class="ingredients">Overripe bananas, toasted walnuts</div>
                                <div class="card-price">$15</div>
                            </div>
                            <div class="featured-card">
                                <h4>Honey Wheat</h4>
                                <div class="ingredients">Sourdough meets wholesome wheat</div>
                                <div class="card-price">$10</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-content fade-in-up">
            <h2>The Fire Within</h2>
            <div class="story-text">
                Before the sun rises, while the world sleeps, I tend to the fire. Not the flames in the oven, but the fire within—
                the living culture that transforms simple ingredients into extraordinary experiences.
            </div>
            <div class="story-text">
                Biscotto is more than a starter; it's a partner in creation, a living testament to the ancient art of fermentation. 
                Each bubble, each rise, each perfectly timed fold brings us closer to that moment when flour becomes art.
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-content fade-in-up">
            <h3>Begin Your Journey</h3>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">Ready to experience what flour and fire can create together?</p>
            
            <div class="contact-grid">
                <div class="contact-item">
                    <h4>Order</h4>
                    <p>bakeryonbiscotto@gmail.com</p>
                </div>
                <div class="contact-item">
                    <h4>Follow</h4>
                    <p>@bakeryonbiscotto<br>Facebook & Instagram</p>
                </div>
                <div class="contact-item">
                    <h4>Visit</h4>
                    <p>2339 Biscotto Cir<br>Davenport, FL 33897</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Flour particles animation
        function createParticles() {
            const container = document.getElementById('flourParticles');
            const particleCount = 20;

            setInterval(() => {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size and position
                const size = Math.random() * 4 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 2 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                
                container.appendChild(particle);
                
                // Remove particle after animation
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, 10000);
            }, 400);
        }

        // Start particles
        createParticles();

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right, .menu-item').forEach(el => {
            observer.observe(el);
        });

        // Staggered animations for cards
        setTimeout(() => {
            document.querySelectorAll('.featured-card').forEach((card, index) => {
                setTimeout(() => {
                    card.style.transform = 'translateY(0)';
                    card.style.opacity = '1';
                }, index * 200);
            });
        }, 500);

        // Parallax effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax-section');
            
            parallaxElements.forEach((element, index) => {
                const speed = 0.5;
                const yPos = -(scrolled * speed);
                element.style.backgroundPositionY = yPos + 'px';
            });
        });
    </script>
</body>
</html>