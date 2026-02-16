<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery on Biscotto - Your Neighborhood Bakery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --dark-brown: #3D2314;
            --warm-brown: #8B5E3C;
            --cream: #F5E6D0;
            --golden-tan: #D4A574;
            --soft-white: #FEFEFE;
            --light-gray: #F8F8F8;
            --medium-gray: #E5E5E5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark-brown);
            background: var(--soft-white);
            overflow-x: hidden;
        }

        /* Concept Switcher Navigation */
        .concept-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(254, 254, 254, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--medium-gray);
        }

        .concept-nav a {
            color: var(--dark-brown);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .concept-nav a:hover {
            background: var(--cream);
            border-color: var(--golden-tan);
            transform: translateY(-1px);
        }

        .concept-nav a.active {
            background: var(--golden-tan);
            color: var(--soft-white);
        }

        /* Hero Section - Friendly & Welcoming */
        .hero {
            background: linear-gradient(135deg, var(--cream) 0%, var(--light-gray) 100%);
            padding: 100px 2rem 4rem 2rem;
            text-align: center;
            position: relative;
        }

        .hero-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 1rem;
        }

        .hero .tagline {
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            color: var(--warm-brown);
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .hero .description {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 3rem auto;
            color: var(--dark-brown);
            opacity: 0.9;
        }

        .hero-image {
            max-width: 500px;
            margin: 2rem auto 0 auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(61, 35, 20, 0.1);
        }

        .hero-image img {
            width: 100%;
            height: auto;
        }

        /* Meet the Baker Section */
        .baker-section {
            padding: 6rem 2rem;
            background: var(--soft-white);
        }

        .baker-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .baker-content h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 1rem;
        }

        .baker-content .baker-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            color: var(--dark-brown);
        }

        .baker-content .signature {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            color: var(--warm-brown);
            margin-top: 2rem;
        }

        .baker-image {
            text-align: center;
        }

        .baker-image .placeholder {
            width: 300px;
            height: 300px;
            background: var(--cream);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--warm-brown);
            border: 3px solid var(--golden-tan);
            position: relative;
        }

        .baker-image .placeholder::after {
            content: '👩‍🍳';
            font-size: 4rem;
            position: absolute;
        }

        /* Location & Map Section */
        .location-section {
            background: var(--light-gray);
            padding: 6rem 2rem;
        }

        .location-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .location-container h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 3rem;
        }

        .location-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
            margin-top: 2rem;
        }

        .map-placeholder {
            background: var(--cream);
            height: 300px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--warm-brown);
            border: 2px solid var(--golden-tan);
            position: relative;
        }

        .map-placeholder::before {
            content: '🗺️';
            font-size: 3rem;
            position: absolute;
            top: 50px;
        }

        .location-info {
            text-align: left;
        }

        .location-info h3 {
            font-size: 1.5rem;
            color: var(--dark-brown);
            margin-bottom: 1rem;
        }

        .location-info p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: var(--dark-brown);
        }

        .location-info .highlight {
            background: var(--golden-tan);
            color: var(--soft-white);
            padding: 15px 20px;
            border-radius: 10px;
            margin-top: 2rem;
            font-weight: 600;
        }

        /* Menu Section - Clean & Organized */
        .menu-section {
            padding: 6rem 2rem;
            background: var(--soft-white);
        }

        .menu-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .menu-header h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 1rem;
        }

        .menu-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
        }

        .menu-category {
            background: var(--light-gray);
            padding: 2.5rem;
            border-radius: 20px;
            border-left: 5px solid var(--golden-tan);
        }

        .menu-category h3 {
            font-size: 1.5rem;
            color: var(--dark-brown);
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item-info h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-brown);
            margin-bottom: 0.3rem;
        }

        .menu-item-info p {
            font-size: 0.9rem;
            color: var(--warm-brown);
        }

        .menu-item-price {
            background: var(--golden-tan);
            color: var(--soft-white);
            padding: 8px 12px;
            border-radius: 15px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Customer Stories Section */
        .testimonials-section {
            background: var(--cream);
            padding: 6rem 2rem;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .testimonials-container h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 3rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial {
            background: var(--soft-white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(61, 35, 20, 0.05);
            position: relative;
        }

        .testimonial::before {
            content: '"';
            font-size: 4rem;
            color: var(--golden-tan);
            position: absolute;
            top: -10px;
            left: 20px;
            line-height: 1;
        }

        .testimonial-text {
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--warm-brown);
        }

        /* Instagram-Style Photo Grid */
        .photo-grid-section {
            padding: 6rem 2rem;
            background: var(--soft-white);
        }

        .photo-grid-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .photo-grid-container h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 3rem;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .photo-item {
            aspect-ratio: 1;
            background: var(--cream);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .photo-item:hover {
            transform: scale(1.05);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-item.placeholder {
            font-size: 2rem;
            color: var(--warm-brown);
            border: 2px dashed var(--golden-tan);
        }

        /* Interactive Order Form Concept */
        .order-section {
            background: var(--light-gray);
            padding: 6rem 2rem;
        }

        .order-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .order-container h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark-brown);
            margin-bottom: 2rem;
        }

        .order-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 3rem 0;
        }

        .order-step {
            background: var(--soft-white);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
        }

        .order-step .step-number {
            background: var(--golden-tan);
            color: var(--soft-white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .order-step h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--dark-brown);
        }

        .cta-button {
            display: inline-block;
            background: var(--golden-tan);
            color: var(--soft-white);
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .cta-button:hover {
            background: var(--warm-brown);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(61, 35, 20, 0.2);
        }

        /* Contact Section */
        .contact-section {
            background: var(--dark-brown);
            color: var(--cream);
            padding: 4rem 2rem;
            text-align: center;
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-container h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-item h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--golden-tan);
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

        .slide-in-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.8s ease;
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.8s ease;
        }

        .slide-in-left.visible,
        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .baker-container,
            .location-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .order-steps {
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

            .photo-grid {
                grid-template-columns: repeat(2, 1fr);
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
        <a href="/concept-e">E</a>
        <a href="/concept-f" class="active">F</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in-up">
            <h1>Welcome to Bakery on Biscotto</h1>
            <div class="tagline">Your Friendly Neighborhood Sourdough Bakery</div>
            <div class="description">
                Right here in Davenport, FL, we're baking up fresh sourdough with love, patience, and our treasured starter, Biscotto. 
                Every loaf tells the story of our community, our passion, and the magic that happens when neighbors come together over good bread.
            </div>
        </div>
        <div class="hero-image fade-in-up">
            <img src="/images/hero-banner.jpg" alt="Fresh sourdough bread from Bakery on Biscotto">
        </div>
    </section>

    <!-- Meet the Baker -->
    <section class="baker-section">
        <div class="baker-container">
            <div class="baker-content slide-in-left">
                <h2>Meet Cassie, Your Baker</h2>
                <div class="baker-text">
                    Hi there! I'm Cassie, and I'm so excited to share my passion for sourdough with our amazing Davenport community. 
                    What started as a hobby in my kitchen has grown into something beautiful—a way to bring neighbors together, one loaf at a time.
                </div>
                <div class="baker-text">
                    My starter, Biscotto (named after our street!), has been with me for years now. Every morning, I feed it, listen to it bubble, 
                    and plan the day's bakes. There's something magical about working with a living culture that connects us to bakers throughout history.
                </div>
                <div class="baker-text">
                    When you buy from Bakery on Biscotto, you're not just getting bread—you're getting a piece of our story, 
                    made with ingredients I'd use for my own family.
                </div>
                <div class="signature">With love & flour dust, Cassie ✨</div>
            </div>
            <div class="baker-image slide-in-right">
                <div class="placeholder">
                    <span>Cassie in her kitchen, hands covered in flour, smiling while shaping dough</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Map -->
    <section class="location-section">
        <div class="location-container fade-in-up">
            <h2>Find Us in the Neighborhood</h2>
            <div class="location-grid">
                <div class="map-placeholder slide-in-left">
                    <span>Interactive map showing 2339 Biscotto Cir, Davenport, FL with local landmarks and farmers markets</span>
                </div>
                <div class="location-info slide-in-right">
                    <h3>Right in Your Backyard</h3>
                    <p><strong>Address:</strong><br>2339 Biscotto Cir<br>Davenport, FL 33897</p>
                    <p><strong>Cottage Food Operation</strong><br>Operating under Florida cottage food laws, bringing you the freshest artisan sourdough from my licensed home kitchen.</p>
                    <p><strong>Local Delivery Available</strong><br>Serving Davenport, Haines City, and surrounding Polk County communities.</p>
                    <div class="highlight">
                        🚗 Local pickup available | 📦 Delivery within 15 miles | 🏪 Find us at select local markets
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu-section">
        <div class="menu-container">
            <div class="menu-header fade-in-up">
                <h2>What's Baking Today</h2>
                <p>Fresh baked daily with our signature sourdough starter, Biscotto</p>
            </div>

            <div class="menu-categories">
                <div class="menu-category fade-in-up">
                    <h3>🍞 Sourdough Loaves</h3>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Regular Loaf</h4>
                            <p>Classic sourdough perfection</p>
                        </div>
                        <div class="menu-item-price">$10</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Cheddar</h4>
                            <p>Sharp aged cheddar folded in</p>
                        </div>
                        <div class="menu-item-price">$12</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Mozzarella & Garlic</h4>
                            <p>Fresh mozz with roasted garlic</p>
                        </div>
                        <div class="menu-item-price">$14</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Chocolate Chip</h4>
                            <p>Sweet meets sour deliciousness</p>
                        </div>
                        <div class="menu-item-price">$12</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Cinnamon Sugar</h4>
                            <p>Weekend morning favorite</p>
                        </div>
                        <div class="menu-item-price">$14</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>4-Pack Mini Loaves</h4>
                            <p>Choose any 4 varieties</p>
                        </div>
                        <div class="menu-item-price">$25</div>
                    </div>
                </div>

                <div class="menu-category fade-in-up">
                    <h3>🥖 Other Fresh Breads</h3>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Sourdough English Muffins</h4>
                            <p>Perfect for toasting</p>
                        </div>
                        <div class="menu-item-price">$8 (6ct) / $15 (12ct)</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Honey Wheat Sandwich Bread</h4>
                            <p>Wholesome daily bread</p>
                        </div>
                        <div class="menu-item-price">$10</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Banana Bread</h4>
                            <p>Made with overripe bananas</p>
                        </div>
                        <div class="menu-item-price">$12</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Banana Walnut</h4>
                            <p>With toasted walnuts</p>
                        </div>
                        <div class="menu-item-price">$15</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <h4>Pumpkin Chocolate Chip</h4>
                            <p>Seasonal favorite</p>
                        </div>
                        <div class="menu-item-price">$12</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Stories -->
    <section class="testimonials-section">
        <div class="testimonials-container">
            <h2 class="fade-in-up">What Our Neighbors Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        Cassie's sourdough is absolutely incredible! The texture is perfect and the flavor is so complex. 
                        My family looks forward to our weekly pickup. It's become a tradition for us.
                    </div>
                    <div class="testimonial-author">— Sarah M., Haines City</div>
                </div>
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        I've never been a bread person until I tried Bakery on Biscotto. The cheddar loaf is my weakness! 
                        You can taste the love and care in every bite.
                    </div>
                    <div class="testimonial-author">— Mike D., Davenport</div>
                </div>
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        As someone with a sensitive stomach, I was amazed that I could eat Cassie's sourdough without any issues. 
                        The fermentation process really makes a difference!
                    </div>
                    <div class="testimonial-author">— Jennifer L., Polk County</div>
                </div>
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        The English muffins are a game changer for our weekend brunches. 
                        Perfectly crispy outside, soft inside, with those amazing nooks and crannies!
                    </div>
                    <div class="testimonial-author">— The Johnson Family</div>
                </div>
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        Supporting local businesses is important to us, and Bakery on Biscotto makes it easy. 
                        Fresh, delicious bread right in our neighborhood!
                    </div>
                    <div class="testimonial-author">— Tom & Rita, Davenport</div>
                </div>
                <div class="testimonial fade-in-up">
                    <div class="testimonial-text">
                        The mini loaf sampler is perfect for trying new flavors. 
                        My kids love the chocolate chip, and I'm obsessed with the cinnamon sugar!
                    </div>
                    <div class="testimonial-author">— Lisa R., Local Mom</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram-Style Photo Grid -->
    <section class="photo-grid-section">
        <div class="photo-grid-container">
            <h2 class="fade-in-up">Fresh from the Oven</h2>
            <p class="fade-in-up">Follow @bakeryonbiscotto for daily bread updates!</p>
            <div class="photo-grid">
                <div class="photo-item fade-in-up">
                    <img src="/images/product-sourdough-boule.jpg" alt="Fresh sourdough boule">
                </div>
                <div class="photo-item fade-in-up">
                    <img src="/images/product-english-muffins.jpg" alt="Sourdough English muffins">
                </div>
                <div class="photo-item placeholder fade-in-up">
                    🥖<br>Cheddar loaf cooling
                </div>
                <div class="photo-item placeholder fade-in-up">
                    🍞<br>Weekend baking prep
                </div>
                <div class="photo-item placeholder fade-in-up">
                    🫧<br>Biscotto starter bubbling
                </div>
                <div class="photo-item placeholder fade-in-up">
                    👩‍🍳<br>Cassie shaping dough
                </div>
                <div class="photo-item placeholder fade-in-up">
                    🏠<br>Cozy kitchen setup
                </div>
                <div class="photo-item placeholder fade-in-up">
                    📦<br>Happy customer pickup
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Order Concept -->
    <section class="order-section">
        <div class="order-container">
            <h2 class="fade-in-up">Ready to Order?</h2>
            <p class="fade-in-up">Getting your fresh sourdough is easy as 1-2-3!</p>
            
            <div class="order-steps">
                <div class="order-step fade-in-up">
                    <div class="step-number">1</div>
                    <h3>Choose Your Favorites</h3>
                    <p>Browse our menu and pick your loaves. Can't decide? Try the 4-pack sampler!</p>
                </div>
                <div class="order-step fade-in-up">
                    <div class="step-number">2</div>
                    <h3>Send Us an Email</h3>
                    <p>Drop us a line with your order. We'll confirm availability and pickup/delivery details.</p>
                </div>
                <div class="order-step fade-in-up">
                    <div class="step-number">3</div>
                    <h3>Fresh Bread, Happy You!</h3>
                    <p>Pick up your order or schedule delivery. Enjoy the best sourdough in Polk County!</p>
                </div>
            </div>
            
            <a href="mailto:bakeryonbiscotto@gmail.com?subject=Bread Order&body=Hi Cassie! I'd like to order:" class="cta-button fade-in-up">
                Start Your Order 📧
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container fade-in-up">
            <h2>Let's Stay Connected!</h2>
            <p>We'd love to hear from you and keep you updated on fresh bakes and local market schedules.</p>
            
            <div class="contact-grid">
                <div class="contact-item">
                    <h3>📧 Email</h3>
                    <p>bakeryonbiscotto@gmail.com</p>
                </div>
                <div class="contact-item">
                    <h3>📱 Social</h3>
                    <p>@bakeryonbiscotto<br>Facebook & Instagram</p>
                </div>
                <div class="contact-item">
                    <h3>🏠 Location</h3>
                    <p>2339 Biscotto Cir<br>Davenport, FL 33897</p>
                </div>
                <div class="contact-item">
                    <h3>🍞 Hours</h3>
                    <p>Orders by appointment<br>Local delivery available</p>
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

        // Observe all animated elements
        document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right').forEach(el => {
            observer.observe(el);
        });

        // Staggered animations for testimonials
        setTimeout(() => {
            const testimonials = document.querySelectorAll('.testimonial');
            testimonials.forEach((testimonial, index) => {
                setTimeout(() => {
                    testimonial.style.opacity = '0';
                    testimonial.style.transform = 'translateY(20px)';
                    testimonial.style.transition = 'all 0.6s ease';
                    
                    setTimeout(() => {
                        testimonial.style.opacity = '1';
                        testimonial.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 150);
            });
        }, 500);

        // Staggered animations for photo grid
        setTimeout(() => {
            const photos = document.querySelectorAll('.photo-item');
            photos.forEach((photo, index) => {
                setTimeout(() => {
                    photo.style.opacity = '0';
                    photo.style.transform = 'scale(0.8)';
                    photo.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        photo.style.opacity = '1';
                        photo.style.transform = 'scale(1)';
                    }, 50);
                }, index * 100);
            });
        }, 800);

        // Interactive menu item hover effects
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'var(--cream)';
                this.style.transform = 'translateX(5px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
                this.style.transform = 'translateX(0)';
            });
        });
    </script>
</body>
</html>