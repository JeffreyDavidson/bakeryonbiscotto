<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto - The Kitchen Table</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Source+Sans+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            line-height: 1.6;
            color: var(--dark-brown);
            background: var(--cream);
            overflow-x: hidden;
        }

        /* Concept Switcher Navigation */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(61, 35, 20, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .concept-nav a {
            color: var(--cream);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .concept-nav a:hover {
            background: var(--warm-brown);
            opacity: 1;
            transform: translateY(-1px);
        }

        .concept-nav a.active {
            background: var(--golden-tan);
            color: var(--dark-brown);
            opacity: 1;
        }

        /* Hero Section - Editorial Style */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--cream) 0%, #F0E1C9 100%);
            padding-top: 80px;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            z-index: 2;
            position: relative;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1rem;
            color: var(--dark-brown);
        }

        .hero-text .subtitle {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.5rem;
            color: var(--warm-brown);
            margin-bottom: 2rem;
        }

        .hero-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            color: var(--dark-brown);
            font-weight: 300;
        }

        .hero-image {
            position: relative;
            height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 20px 20px 60px rgba(61, 35, 20, 0.1);
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Text Overlay on Image */
        .image-overlay {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            background: linear-gradient(135deg, rgba(245, 230, 208, 0.95) 0%, rgba(245, 230, 208, 0.85) 100%);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(212, 165, 116, 0.3);
        }

        .image-overlay h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--dark-brown);
        }

        /* Editorial Grid - Masonry Style */
        .editorial-section {
            padding: 6rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1rem;
            color: var(--dark-brown);
        }

        .section-header p {
            font-size: 1.2rem;
            color: var(--warm-brown);
            font-style: italic;
        }

        .masonry-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 2rem;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 15px 15px 40px rgba(61, 35, 20, 0.08);
            transition: all 0.3s ease;
        }

        .masonry-item:hover {
            transform: translateY(-5px);
            box-shadow: 20px 25px 50px rgba(61, 35, 20, 0.15);
        }

        .masonry-item.tall {
            grid-row-end: span 2;
        }

        .masonry-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .masonry-item .content {
            padding: 2rem;
            background: white;
            position: relative;
        }

        .masonry-item h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark-brown);
        }

        .masonry-item .description {
            color: var(--warm-brown);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .masonry-item .price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: var(--dark-brown);
        }

        .price-tag {
            background: var(--golden-tan);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Recipe-Style Menu Cards */
        .recipe-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 15px 15px 40px rgba(61, 35, 20, 0.08);
            border-left: 6px solid var(--golden-tan);
            position: relative;
        }

        .recipe-card::before {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 30px;
            height: 30px;
            background: var(--golden-tan);
            border-radius: 50%;
            opacity: 0.3;
        }

        .recipe-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--dark-brown);
        }

        .recipe-card .ingredients {
            font-style: italic;
            color: var(--warm-brown);
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        /* Story Section */
        .story-section {
            background: linear-gradient(135deg, var(--dark-brown) 0%, var(--warm-brown) 100%);
            color: var(--cream);
            padding: 6rem 2rem;
            position: relative;
        }

        .story-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .story-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 2rem;
        }

        .story-content .story-text {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        /* Contact Section */
        .contact-section {
            padding: 4rem 2rem;
            background: var(--cream);
            text-align: center;
        }

        .contact-info {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--dark-brown);
        }

        .contact-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-item {
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 10px 10px 30px rgba(61, 35, 20, 0.06);
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .masonry-grid {
                grid-template-columns: 1fr;
            }

            .concept-nav {
                padding: 10px;
                gap: 8px;
            }

            .concept-nav a {
                padding: 6px 12px;
                font-size: 12px;
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
        <a href="/concept-d" class="active">D</a>
        <a href="/concept-e">E</a>
        <a href="/concept-f">F</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text fade-in-up">
                <h1>Bakery on Biscotto</h1>
                <div class="subtitle">Artisan Sourdough from Cassie's Kitchen</div>
                <p>Welcome to my kitchen table, where every loaf tells a story. Using my trusted starter "Biscotto," I craft authentic sourdough breads with the patience and care they deserve. Pull up a chair and taste the difference love makes.</p>
            </div>
            <div class="hero-image fade-in-up">
                <img src="/images/hero-banner.jpg" alt="Artisan sourdough bread on parchment">
                <div class="image-overlay">
                    <h3>Made with Love, Patience & Biscotto</h3>
                    <p>Every loaf is a work of art, fermented slowly for that perfect tang and texture.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Editorial Menu Section -->
    <section class="editorial-section">
        <div class="section-header fade-in-up">
            <h2>From Our Kitchen to Your Table</h2>
            <p>Each recipe perfected through countless kitchen sessions</p>
        </div>

        <div class="masonry-grid">
            <!-- Featured Products with Images -->
            <div class="masonry-item tall fade-in-up">
                <img src="/images/product-sourdough-boule.jpg" alt="Sourdough boule with beautiful ear">
                <div class="content">
                    <h3>Signature Sourdough Boule</h3>
                    <div class="description">Our classic round loaf with that perfect ear and golden crust. The foundation of everything we do, made with just flour, water, salt, and time.</div>
                    <div class="price">
                        <span>Regular Loaf</span>
                        <span class="price-tag">$10</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <img src="/images/product-english-muffins.jpg" alt="Sourdough English muffins on cooling rack">
                <div class="content">
                    <h3>Sourdough English Muffins</h3>
                    <div class="description">Nooks and crannies perfected. Toasted golden, they're perfect for weekend brunch or weekday mornings.</div>
                    <div class="price">
                        <span>6ct / 12ct</span>
                        <span class="price-tag">$8 / $15</span>
                    </div>
                </div>
            </div>

            <!-- Recipe-Style Cards for Other Products -->
            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>Cheddar Sourdough</h4>
                    <div class="ingredients">Sharp aged cheddar folded into tangy sourdough</div>
                    <div class="description">The richness of aged cheddar meets the complexity of sourdough fermentation. Every bite delivers that perfect balance of sharp and sour.</div>
                    <div class="price">
                        <span class="price-tag">$12</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>Mozzarella & Garlic</h4>
                    <div class="ingredients">Fresh mozzarella, roasted garlic, Italian herbs</div>
                    <div class="description">Melted mozzarella pockets and caramelized garlic make this loaf irresistible. Like pizza, but better.</div>
                    <div class="price">
                        <span class="price-tag">$14</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>Chocolate Chip</h4>
                    <div class="ingredients">Semi-sweet chocolate chips, sourdough tang</div>
                    <div class="description">The surprise favorite. The slight sourness enhances the chocolate's richness in ways you never expected.</div>
                    <div class="price">
                        <span class="price-tag">$12</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>Cinnamon Sugar</h4>
                    <div class="ingredients">Ceylon cinnamon, organic sugar swirl</div>
                    <div class="description">Weekend morning magic. The cinnamon swirl creates layers of sweetness throughout each slice.</div>
                    <div class="price">
                        <span class="price-tag">$14</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>Banana Walnut Bread</h4>
                    <div class="ingredients">Overripe bananas, toasted walnuts</div>
                    <div class="description">Grandma's recipe meets artisan technique. Moist, nutty, and full of banana flavor that develops over days.</div>
                    <div class="price">
                        <span class="price-tag">$15</span>
                    </div>
                </div>
            </div>

            <div class="masonry-item fade-in-up">
                <div class="recipe-card">
                    <h4>4-Pack Mini Loaf Sampler</h4>
                    <div class="ingredients">Choose any four varieties</div>
                    <div class="description">Can't decide? Don't. Try four different flavors in perfect mini portions. Mix and match to your heart's content.</div>
                    <div class="price">
                        <span class="price-tag">$25</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-content fade-in-up">
            <h2>Meet Biscotto</h2>
            <div class="story-text">
                My sourdough starter isn't just an ingredient—it's family. Named Biscotto after our address on Biscotto Circle, this living culture has been the heart of my bread for years. Fed daily, nurtured carefully, and always ready to transform simple flour into extraordinary loaves. 
            </div>
            <div class="story-text">
                Every morning in my Davenport kitchen, I listen to Biscotto bubble and grow, knowing that today's loaves will carry forward a tradition that's both ancient and uniquely ours.
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-info fade-in-up">
            <h3>From My Kitchen to Yours</h3>
            <p>Ready to bring home some artisan sourdough? Let's chat about your order.</p>
            
            <div class="contact-details">
                <div class="contact-item">
                    <h4>Email</h4>
                    <p>bakeryonbiscotto@gmail.com</p>
                </div>
                <div class="contact-item">
                    <h4>Follow Along</h4>
                    <p>@bakeryonbiscotto<br>Facebook & Instagram</p>
                </div>
                <div class="contact-item">
                    <h4>Location</h4>
                    <p>2339 Biscotto Cir<br>Davenport, FL 33897</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Staggered animation for masonry items
        setTimeout(() => {
            document.querySelectorAll('.masonry-item').forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(30px)';
                    item.style.transition = 'all 0.6s ease';
                    
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, index * 100);
                }, 500);
            });
        }, 100);
    </script>
</body>
</html>