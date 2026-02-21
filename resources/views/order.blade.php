<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order | Bakery on Biscotto</title>
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

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
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
        .order-hero {
            padding: 140px 24px 60px;
            text-align: center;
            background: linear-gradient(180deg, var(--cream) 0%, var(--light) 100%);
            position: relative;
        }
        .order-hero h1 {
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.5rem, 6vw, 4rem);
            color: var(--dark);
            margin-bottom: 12px;
        }
        .order-hero p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            color: var(--warm);
            max-width: 500px;
            margin: 0 auto;
        }

        /* ═══ MAIN LAYOUT ═══ */
        .order-layout {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px 80px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 40px;
            align-items: start;
        }

        /* ═══ PRODUCT GRID ═══ */
        .category-section { margin-bottom: 40px; }
        .category-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--golden);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .category-title::before {
            content: '✦';
            color: var(--golden);
            font-size: 0.9rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid rgba(139,94,60,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(61,35,20,0.06);
        }
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(61,35,20,0.12);
        }

        .product-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: var(--cream);
        }
        .product-img-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--cream), var(--parchment));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .product-info {
            padding: 20px;
        }
        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }
        .product-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.95rem;
            color: var(--warm);
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .product-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent);
        }

        .qty-control {
            display: inline-flex;
            align-items: stretch;
            gap: 0;
            border: 1.5px solid var(--golden);
            border-radius: 100px;
            overflow: hidden;
            height: 36px;
            background: var(--cream);
        }
        .qty-btn {
            width: 36px;
            border: none;
            background: var(--cream);
            color: var(--dark);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            line-height: 1;
        }
        .qty-btn:hover { background: var(--golden); }
        .qty-btn:disabled { opacity: 0.3; cursor: default; }
        .qty-btn:disabled:hover { background: var(--cream); }
        .qty-value {
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            line-height: 1;
        }
        .qty-value.has-items { color: var(--accent); }

        .add-btn {
            padding: 8px 20px;
            background: transparent;
            color: var(--golden);
            border: 1.5px solid var(--golden);
            border-radius: 100px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .add-btn:hover { background: var(--golden); color: var(--white); }

        /* ═══ CART SIDEBAR ═══ */
        .cart-sidebar {
            position: sticky;
            top: 80px;
        }
        .cart-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid rgba(139,94,60,0.1);
            box-shadow: 0 4px 24px rgba(61,35,20,0.08);
            overflow: visible;
        }
        .cart-header {
            background: var(--dark);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 20px 20px 0 0;
        }
        .cart-header h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            color: var(--cream);
        }
        .cart-count {
            background: var(--golden);
            color: var(--dark);
            width: 28px; height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .cart-body { padding: 24px; }
        .cart-empty {
            text-align: center;
            padding: 30px 0;
            color: var(--warm);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
        }
        .cart-empty span { font-size: 2.5rem; display: block; margin-bottom: 10px; }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(139,94,60,0.08);
        }
        .cart-item:last-child { border-bottom: none; }
        .cart-item-info { flex: 1; }
        .cart-item-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--dark);
        }
        .cart-item-qty {
            font-size: 0.82rem;
            color: var(--warm);
            margin-top: 2px;
        }
        .cart-item-price {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--accent);
            margin-left: 16px;
        }
        .cart-item-remove {
            margin-left: 12px;
            background: none;
            border: none;
            color: #c0a080;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 4px;
            transition: color 0.2s;
        }
        .cart-item-remove:hover { color: #c0392b; }

        .cart-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
            margin: 16px 0;
        }

        .cart-totals {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .cart-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            color: var(--warm);
        }
        .cart-row.total {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            padding-top: 8px;
            border-top: 2px solid var(--golden);
        }

        /* ═══ ORDER FORM ═══ */
        .order-form {
            margin-top: 24px;
            padding: 24px;
            border-top: 1px solid rgba(139,94,60,0.1);
        }
        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 16px;
        }
        .form-group {
            margin-bottom: 16px;
        }
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
        textarea.form-input { resize: vertical; min-height: 80px; }

        .toggle-group {
            display: flex;
            border-radius: 12px;
            border: 1.5px solid rgba(139,94,60,0.15);
            overflow: hidden;
        }
        .toggle-option {
            flex: 1;
            padding: 12px;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            background: var(--light);
            color: var(--warm);
            border: none;
            transition: all 0.3s;
        }
        .toggle-option.active {
            background: var(--golden);
            color: var(--dark);
            font-weight: 600;
        }

        .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: var(--dark);
            color: var(--cream);
            border: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .submit-btn:hover { background: var(--brown); }
        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 12px 16px;
            background: rgba(212,165,116,0.1);
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 0.85rem;
            color: var(--warm);
            line-height: 1.4;
        }
        .notice-icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }

        .error-msg {
            color: #c0392b;
            font-size: 0.82rem;
            margin-top: 4px;
        }

        /* ═══ DATE PICKER ═══ */
        .date-picker-wrap { position: relative; }
        .date-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0; right: 0;
            background: var(--white);
            border-radius: 16px;
            border: 1.5px solid rgba(139,94,60,0.12);
            box-shadow: 0 12px 40px rgba(61,35,20,0.15);
            padding: 20px;
            z-index: 50;
        }
        .cal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .cal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--dark);
        }
        .cal-nav {
            width: 32px; height: 32px;
            border: none;
            background: var(--light);
            border-radius: 8px;
            font-size: 1.2rem;
            color: var(--warm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .cal-nav:hover { background: var(--cream); color: var(--dark); }
        .cal-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            margin-bottom: 6px;
        }
        .cal-wd {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--warm);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 0;
        }
        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }
        .cal-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            cursor: pointer;
            transition: all 0.2s;
        }
        .cal-day:hover:not(.disabled):not(.empty) {
            background: var(--cream);
        }
        .cal-day.empty { cursor: default; }
        .cal-day.disabled {
            color: #d0c4b8;
            cursor: not-allowed;
        }
        .cal-day.disabled:hover { background: transparent; }
        .cal-day.selected {
            background: var(--golden);
            color: var(--dark);
            font-weight: 700;
        }
        .cal-day.today:not(.selected) {
            border: 1.5px solid var(--golden);
        }
        .cal-footer {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(139,94,60,0.08);
            font-size: 0.78rem;
            color: var(--warm);
            text-align: center;
        }
        [x-cloak] { display: none !important; }

        /* ═══ FOOTER ═══ */
        .order-footer {
            text-align: center;
            padding: 40px 24px;
            background: var(--dark);
            color: var(--cream);
        }
        .order-footer p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            opacity: 0.7;
        }
        .order-footer a { color: var(--golden); text-decoration: none; }
        .order-footer a:hover { text-decoration: underline; }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 900px) {
            .order-layout {
                grid-template-columns: 1fr;
            }
            .cart-sidebar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                z-index: 999;
            }
            .cart-card {
                border-radius: 20px 20px 0 0;
                max-height: 80vh;
                overflow-y: auto;
            }
            .cart-collapsed .cart-body,
            .cart-collapsed .order-form { display: none; }
            .cart-collapsed .cart-header { cursor: pointer; }
            .mobile-total {
                display: flex;
                align-items: center;
                gap: 8px;
                color: var(--golden);
                font-family: 'Playfair Display', serif;
                font-weight: 600;
            }
            .order-layout { padding-bottom: 100px; }
        }
        @media (min-width: 901px) {
            .mobile-total { display: none; }
            .cart-toggle-btn { display: none; }
        }
        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    {{-- NAV --}}
    <nav class="main-nav">
        <a href="/">Home</a>
        <a href="/#menu">Menu</a>
        <a href="/order" class="active">Order</a>
    </nav>

    {{-- HERO --}}
    <section class="order-hero">
        <h1>Place Your Order</h1>
        <p>Everything baked fresh to order. Please allow at least 2 days for your handcrafted sourdough.</p>
    </section>

    {{-- MAIN --}}
    <div class="order-layout" x-data="orderPage()">
        {{-- PRODUCTS --}}
        <div class="products-col">
            @foreach($categories as $category)
                @if($category->products->count())
                <div class="category-section">
                    <h2 class="category-title">{{ $category->name }}</h2>
                    <div class="product-grid">
                        @foreach($category->products as $product)
                        <div class="product-card">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-img">
                            @else
                                <div class="product-img-placeholder">🍞</div>
                            @endif
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                @if($product->description)
                                    <div class="product-desc">{{ $product->description }}</div>
                                @endif
                                <div class="product-bottom">
                                    <span class="product-price">${{ number_format($product->price, 0) }}</span>
                                    <div x-show="getQty({{ $product->id }}) === 0">
                                        <button class="add-btn" @click="addItem({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">
                                            Add
                                        </button>
                                    </div>
                                    <div class="qty-control" x-show="getQty({{ $product->id }}) > 0" x-cloak>
                                        <button class="qty-btn" @click="decrementItem({{ $product->id }})">−</button>
                                        <span class="qty-value has-items" x-text="getQty({{ $product->id }})"></span>
                                        <button class="qty-btn" @click="addItem({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})" :disabled="getQty({{ $product->id }}) >= {{ $product->max_per_order ?? 20 }}">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        {{-- CART SIDEBAR --}}
        <div class="cart-sidebar" :class="{ 'cart-collapsed': mobileCollapsed }">
            <div class="cart-card">
                <div class="cart-header" @click="mobileCollapsed = !mobileCollapsed">
                    <h2>Your Order</h2>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span class="mobile-total" x-show="cart.length > 0" x-text="'$' + total().toFixed(2)"></span>
                        <span class="cart-count" x-text="cartCount()"></span>
                    </div>
                </div>

                <div class="cart-body">
                    <div x-show="cart.length === 0" class="cart-empty">
                        <span>🛒</span>
                        Add some goodies to get started!
                    </div>

                    <template x-for="item in cart" :key="item.id">
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-name" x-text="item.name"></div>
                                <div class="cart-item-qty" x-text="'Qty: ' + item.qty"></div>
                            </div>
                            <span class="cart-item-price" x-text="'$' + (item.price * item.qty).toFixed(2)"></span>
                            <button class="cart-item-remove" @click="removeItem(item.id)" title="Remove">✕</button>
                        </div>
                    </template>

                    <template x-if="cart.length > 0">
                        <div>
                            <div class="cart-divider"></div>
                            <div class="cart-totals">
                                <div class="cart-row">
                                    <span>Subtotal</span>
                                    <span x-text="'$' + subtotal().toFixed(2)"></span>
                                </div>
                                <div class="cart-row" x-show="fulfillment === 'delivery'">
                                    <span>Delivery Fee</span>
                                    <span>$5.00</span>
                                </div>
                                <div class="cart-row total">
                                    <span>Total</span>
                                    <span x-text="'$' + total().toFixed(2)"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- ORDER FORM --}}
                <form method="POST" action="{{ route('order.store') }}" x-show="cart.length > 0" class="order-form"
                      @submit.prevent="submitOrder">
                    @csrf

                    <div class="notice">
                        <span class="notice-icon">📅</span>
                        <span>Orders require at least <strong>2 days</strong> advance notice. Sourdough takes love and time!</span>
                    </div>

                    <h3 class="form-section-title">Your Info</h3>

                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-input" x-model="form.customer_name" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" x-model="form.customer_email" placeholder="you@email.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-input" x-model="form.customer_phone" @input="formatPhone" placeholder="(555) 123-4567" required>
                    </div>

                    <h3 class="form-section-title" style="margin-top: 24px;">Fulfillment</h3>

                    <div class="form-group">
                        <div class="toggle-group">
                            <button type="button" class="toggle-option" :class="{ active: fulfillment === 'pickup' }" @click="fulfillment = 'pickup'">🏠 Pickup</button>
                            <button type="button" class="toggle-option" :class="{ active: fulfillment === 'delivery' }" @click="fulfillment = 'delivery'">🚗 Delivery (+$5)</button>
                        </div>
                    </div>

                    <template x-if="fulfillment === 'delivery'">
                        <div>
                            <div class="form-group">
                                <label class="form-label">Delivery Address</label>
                                <input type="text" class="form-input" x-model="form.delivery_address" placeholder="123 Main St, Davenport FL" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">ZIP Code</label>
                                <input type="text" class="form-input" x-model="form.delivery_zip" placeholder="33837" required>
                            </div>
                        </div>
                    </template>

                    <div class="form-group" x-data="datePicker()" x-init="init()">
                        <label class="form-label">Requested Date</label>
                        <div class="date-picker-wrap">
                            <button type="button" class="form-input date-trigger" @click="open = !open" style="text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                                <span x-text="selectedLabel || 'Choose a date'" :style="selectedLabel ? '' : 'color: #b8a090'"></span>
                                <span style="font-size: 1.1rem;">📅</span>
                            </button>
                            <div class="date-dropdown" x-show="open" x-transition.opacity @click.outside="open = false" x-cloak>
                                <div class="cal-header">
                                    <button type="button" class="cal-nav" @click="prevMonth">‹</button>
                                    <span class="cal-title" x-text="monthYear"></span>
                                    <button type="button" class="cal-nav" @click="nextMonth">›</button>
                                </div>
                                <div class="cal-weekdays">
                                    <template x-for="d in ['Su','Mo','Tu','We','Th','Fr','Sa']">
                                        <span class="cal-wd" x-text="d"></span>
                                    </template>
                                </div>
                                <div class="cal-grid">
                                    <template x-for="blank in blanks"><span class="cal-day empty"></span></template>
                                    <template x-for="day in days">
                                        <button type="button"
                                            class="cal-day"
                                            :class="{
                                                'disabled': !isSelectable(day),
                                                'selected': isSelected(day),
                                                'today': isToday(day)
                                            }"
                                            :disabled="!isSelectable(day)"
                                            @click="selectDay(day)">
                                            <span x-text="day"></span>
                                        </button>
                                    </template>
                                </div>
                                <div class="cal-footer">
                                    <span>📌 Orders require 2 days advance notice</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Notes <span style="font-weight: 400; text-transform: none; opacity: 0.6;">(optional)</span></label>
                        <textarea class="form-input" x-model="form.notes" placeholder="Any special requests or instructions..."></textarea>
                    </div>

                    {{-- Hidden fields for items --}}
                    <template x-for="(item, index) in cart" :key="'hidden-' + item.id">
                        <div>
                            <input type="hidden" :name="'items[' + index + '][product_id]'" :value="item.id">
                            <input type="hidden" :name="'items[' + index + '][quantity]'" :value="item.qty">
                        </div>
                    </template>
                    <input type="hidden" name="customer_name" :value="form.customer_name">
                    <input type="hidden" name="customer_email" :value="form.customer_email">
                    <input type="hidden" name="customer_phone" :value="form.customer_phone">
                    <input type="hidden" name="fulfillment_type" :value="fulfillment">
                    <input type="hidden" name="delivery_address" :value="form.delivery_address">
                    <input type="hidden" name="delivery_zip" :value="form.delivery_zip">
                    <input type="hidden" name="requested_date" :value="form.requested_date">
                    <input type="hidden" name="notes" :value="form.notes">

                    <button type="submit" class="submit-btn" :disabled="submitting">
                        <span x-show="!submitting">Place Order</span>
                        <span x-show="submitting">Placing Order...</span>
                    </button>

                    @if($errors->any())
                        <div style="margin-top: 12px;">
                            @foreach($errors->all() as $error)
                                <p class="error-msg">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="order-footer">
        <p>&copy; {{ date('Y') }} Bakery on Biscotto. <a href="/">Back to Home</a></p>
    </footer>

    <script>
        function datePicker() {
            return {
                open: false,
                month: null,
                year: null,
                selectedLabel: '',
                days: [],
                blanks: [],

                init() {
                    const d = new Date();
                    d.setDate(d.getDate() + 2);
                    this.month = d.getMonth();
                    this.year = d.getFullYear();
                    this.buildCalendar();
                },

                get monthYear() {
                    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    return months[this.month] + ' ' + this.year;
                },

                get minDate() {
                    const d = new Date();
                    d.setDate(d.getDate() + 2);
                    d.setHours(0,0,0,0);
                    return d;
                },

                buildCalendar() {
                    const firstDay = new Date(this.year, this.month, 1).getDay();
                    const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                    this.blanks = Array(firstDay).fill(0);
                    this.days = Array.from({length: daysInMonth}, (_, i) => i + 1);
                },

                prevMonth() {
                    if (this.month === 0) { this.month = 11; this.year--; }
                    else { this.month--; }
                    this.buildCalendar();
                },

                nextMonth() {
                    if (this.month === 11) { this.month = 0; this.year++; }
                    else { this.month++; }
                    this.buildCalendar();
                },

                isSelectable(day) {
                    const date = new Date(this.year, this.month, day);
                    date.setHours(0,0,0,0);
                    return date >= this.minDate;
                },

                isSelected(day) {
                    const parent = this.$el.closest('[x-data]');
                    const form = Alpine.$data(parent.closest('.order-layout'));
                    if (!form || !form.form.requested_date) return false;
                    const sel = new Date(form.form.requested_date + 'T00:00:00');
                    return sel.getFullYear() === this.year && sel.getMonth() === this.month && sel.getDate() === day;
                },

                isToday(day) {
                    const now = new Date();
                    return now.getFullYear() === this.year && now.getMonth() === this.month && now.getDate() === day;
                },

                selectDay(day) {
                    const date = new Date(this.year, this.month, day);
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');
                    const iso = y + '-' + m + '-' + d;

                    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                    this.selectedLabel = days[date.getDay()] + ', ' + months[date.getMonth()] + ' ' + date.getDate() + ', ' + y;

                    const parent = this.$el.closest('.order-layout');
                    const form = Alpine.$data(parent);
                    form.form.requested_date = iso;

                    this.open = false;
                }
            }
        }

        function orderPage() {
            return {
                cart: [],
                fulfillment: 'pickup',
                mobileCollapsed: window.innerWidth <= 900,
                submitting: false,
                form: {
                    customer_name: '',
                    customer_email: '',
                    customer_phone: '',
                    delivery_address: '',
                    delivery_zip: '',
                    requested_date: '',
                    notes: '',
                },

                get minDate() {
                    const d = new Date();
                    d.setDate(d.getDate() + 2);
                    return d.toISOString().split('T')[0];
                },

                addItem(id, name, price) {
                    const existing = this.cart.find(i => i.id === id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cart.push({ id, name, price, qty: 1 });
                    }
                    this.mobileCollapsed = false;
                },

                decrementItem(id) {
                    const item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.qty--;
                        if (item.qty <= 0) {
                            this.cart = this.cart.filter(i => i.id !== id);
                        }
                    }
                },

                removeItem(id) {
                    this.cart = this.cart.filter(i => i.id !== id);
                },

                getQty(id) {
                    const item = this.cart.find(i => i.id === id);
                    return item ? item.qty : 0;
                },

                cartCount() {
                    return this.cart.reduce((sum, i) => sum + i.qty, 0);
                },

                subtotal() {
                    return this.cart.reduce((sum, i) => sum + (i.price * i.qty), 0);
                },

                total() {
                    return this.subtotal() + (this.fulfillment === 'delivery' ? 5 : 0);
                },

                formatPhone(e) {
                    let digits = e.target.value.replace(/\D/g, '').substring(0, 10);
                    let formatted = '';
                    if (digits.length > 0) formatted = '(' + digits.substring(0, 3);
                    if (digits.length >= 3) formatted += ') ';
                    if (digits.length > 3) formatted += digits.substring(3, 6);
                    if (digits.length >= 6) formatted += '-' + digits.substring(6);
                    this.form.customer_phone = formatted;
                },

                submitOrder() {
                    this.submitting = true;
                    this.$el.closest('form').submit();
                }
            }
        }
    </script>
</body>
</html>
