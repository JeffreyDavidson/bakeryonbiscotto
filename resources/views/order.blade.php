@extends('layouts.storefront', ['title' => 'Order | Bakery on Biscotto', 'active' => 'order'])

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
    <style>
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
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 40px;
        }
        .products-col {
            padding: 40px 0 80px;
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
            position: relative;
        }
        .product-card.is-favorite {
            border-color: rgba(220,38,38,0.25);
            box-shadow: 0 2px 12px rgba(220,38,38,0.08);
        }
        .favorite-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 10;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(8px);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            line-height: 1;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .favorite-btn:hover {
            transform: scale(1.15);
            background: rgba(255,255,255,0.95);
        }
        .favorite-btn.active {
            color: #dc2626;
            background: rgba(255,255,255,0.95);
        }
        .favorite-btn.active:hover {
            background: #fef2f2;
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
            background: transparent;
            color: var(--dark);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            padding: 0;
        }
        .qty-btn:disabled { opacity: 0.3; cursor: default; }
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
            padding: 40px 0 80px;
            position: sticky;
            top: 80px;
            align-self: start;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
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
        .form-input::placeholder { color: #8b7355; }
        textarea.form-input { resize: vertical; min-height: 80px; }

        .coupon-field {
            display: flex;
            border: 1.5px solid var(--golden);
            border-radius: 12px;
            overflow: hidden;
        }
        .coupon-field input {
            flex: 1;
            padding: 10px 12px;
            border: none !important;
            border-right: 1.5px solid var(--golden) !important;
            outline: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            background: var(--cream);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 0;
        }
        .coupon-field input::placeholder {
            text-transform: none;
            color: #8b7355;
        }
        .coupon-field button {
            padding: 12px 24px;
            background: var(--dark);
            color: var(--cream);
            border: none;
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s;
        }
        .coupon-field button:hover:not(:disabled) {
            background: var(--warm);
        }
        .coupon-field button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .coupon-field .coupon-remove {
            background: #dc2626;
            color: white;
        }
        .coupon-field .coupon-remove:hover {
            background: #b91c1c;
        }

        .toggle-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .toggle-option {
            position: relative;
            padding: 16px 14px;
            text-align: center;
            font-family: 'Lora', serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            background: var(--light);
            color: var(--warm);
            border: 2px solid rgba(139,94,60,0.12);
            border-radius: 12px;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .toggle-option:hover {
            border-color: var(--golden);
            background: rgba(212,165,116,0.08);
        }
        .toggle-option.active {
            background: rgba(212,165,116,0.12);
            border-color: var(--golden);
            color: var(--dark);
            font-weight: 600;
            box-shadow: 0 0 0 1px var(--golden);
        }
        .toggle-option .toggle-icon {
            font-size: 1.5rem;
            line-height: 1;
        }
        .toggle-option .toggle-label {
            font-size: 0.85rem;
            opacity: 0.6;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
        }
        .toggle-option.active .toggle-label {
            opacity: 0.8;
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
        .address-suggestions {
            position: absolute;
            top: calc(100% + 4px);
            left: 0; right: 0;
            background: var(--white);
            border: 1.5px solid rgba(139,94,60,0.15);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(61,35,20,0.12);
            z-index: 50;
            max-height: 200px;
            overflow-y: auto;
        }
        .address-suggestion {
            display: block;
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            border: none;
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--dark);
            cursor: pointer;
            transition: background 0.15s;
            border-bottom: 1px solid rgba(139,94,60,0.06);
        }
        .address-suggestion:last-child { border-bottom: none; }
        .address-suggestion:hover {
            background: rgba(212,165,116,0.1);
        }
        .time-slot-btn {
            padding: 8px 14px;
            border: 1.5px solid rgba(139,94,60,0.15);
            border-radius: 100px;
            background: var(--light);
            font-family: 'Inter', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm);
            cursor: pointer;
            transition: all 0.2s;
        }
        .time-slot-btn:hover {
            border-color: var(--golden);
            background: rgba(212,165,116,0.08);
        }
        .time-slot-btn.selected {
            background: var(--golden);
            border-color: var(--golden);
            color: var(--dark);
            font-weight: 600;
        }
        [x-cloak] { display: none !important; }

        /* ═══ BUNDLE PICKER ═══ */
        .bundle-overlay {
            position: fixed;
            inset: 0;
            background: rgba(42,26,14,0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .bundle-modal {
            background: var(--white);
            border-radius: 20px;
            padding: 32px;
            max-width: 480px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(61,35,20,0.25);
        }
        .bundle-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        .bundle-modal-header h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            color: var(--dark);
        }
        .bundle-close {
            width: 32px; height: 32px;
            border: none;
            background: var(--light);
            border-radius: 8px;
            font-size: 1.3rem;
            color: var(--warm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bundle-close:hover { background: var(--cream); }
        .bundle-modal-sub {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            color: var(--warm);
            margin-bottom: 20px;
        }
        .bundle-progress {
            height: 6px;
            background: var(--light);
            border-radius: 100px;
            overflow: hidden;
            margin-bottom: 6px;
        }
        .bundle-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--golden), var(--accent));
            border-radius: 100px;
            transition: width 0.3s ease;
        }
        .bundle-progress-text {
            font-size: 0.8rem;
            color: var(--warm);
            margin-bottom: 20px;
        }
        .bundle-options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .bundle-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: var(--light);
            border-radius: 12px;
            border: 1.5px solid transparent;
            transition: all 0.2s;
        }
        .bundle-option.has-qty {
            background: rgba(212,165,116,0.1);
            border-color: var(--golden);
        }
        .bundle-option-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--dark);
        }

        /* ═══ FOOTER ═══ */
        .footer {
            text-align: center;
            padding: 40px 24px;
            background: var(--dark);
            color: var(--cream);
        }
        .footer h3 { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; margin-bottom: 4px; }
        .tagline { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; opacity: 0.5; margin-bottom: 12px; }
        .footer-badge { font-size: 0.85rem; opacity: 0.5; margin-bottom: 16px; }
        .footer-info { font-size: 0.9rem; opacity: 0.6; }
        .footer-info a { color: var(--golden); text-decoration: none; }
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
        .footer-bottom {
            margin-top: 20px; padding-top: 20px;
            border-top: 1px solid rgba(245,230,208,0.06);
            font-size: 12px; color: rgba(245,230,208,0.2);
        }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 900px) {
            .order-layout {
                grid-template-columns: 1fr;
                height: auto;
            }
            .products-col {
                overflow-y: visible;
                padding: 24px 0;
            }
            .cart-sidebar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                z-index: 999;
                overflow-y: auto;
                padding: 0;
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
@endsection

@section('content')
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
                        <div class="product-card" :class="{ 'is-favorite': isFavorite({{ $product->id }}) }">
                            <button class="favorite-btn"
                                :class="{ 'active': isFavorite({{ $product->id }}) }"
                                @click="toggleFavorite({{ $product->id }})"
                                :title="isFavorite({{ $product->id }}) ? 'Remove from favorites' : 'Add to favorites'"
                                aria-label="Toggle favorite">
                                <span x-text="isFavorite({{ $product->id }}) ? '❤️' : '🤍'"></span>
                            </button>
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
                                    @if($product->is_bundle)
                                    <button class="add-btn" @click="openBundlePicker({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">
                                        Choose Flavors
                                    </button>
                                    @else
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
                                    @endif
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

                <div class="cart-body" aria-live="polite">
                    <div x-show="cart.length === 0" class="cart-empty">
                        <span>🛒</span>
                        Add some goodies to get started!
                    </div>

                    <template x-for="item in cart" :key="item.id">
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-name" x-text="item.name"></div>
                                <div class="cart-item-qty" x-text="'Qty: ' + item.qty"></div>
                                <template x-if="item.selections && item.selections.length">
                                    <div class="cart-item-selections" x-text="item.selections.join(', ')" style="font-size: 0.78rem; color: var(--warm); margin-top: 2px; font-style: italic;"></div>
                                </template>
                            </div>
                            <span class="cart-item-price" x-text="'$' + (item.price * item.qty).toFixed(2)"></span>
                            <button class="cart-item-remove" @click="removeItem(item.id)" title="Remove" :aria-label="'Remove ' + item.name + ' from cart'">✕</button>
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
                                <div class="cart-row" x-show="fulfillment === 'delivery' && deliveryTier">
                                    <span>Delivery Fee</span>
                                    <span x-text="deliveryFee() === 0 ? 'Free' : '$' + deliveryFee().toFixed(2)"></span>
                                </div>
                                <div class="cart-row" x-show="couponDiscount > 0" style="color: #16a34a;">
                                    <span>Discount <span x-show="couponLabel" x-text="'(' + couponLabel + ')'" style="font-size: 0.78rem;"></span></span>
                                    <span x-text="'-$' + couponDiscount.toFixed(2)"></span>
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
                <form x-show="cart.length > 0" class="order-form"
                      @submit.prevent>
                    @csrf

                    <div class="notice">
                        <span class="notice-icon">📅</span>
                        <span>Orders require at least <strong>2 days</strong> advance notice. Sourdough takes love and time!</span>
                    </div>

                    <h3 class="form-section-title">Your Info</h3>

                    <div class="form-group">
                        <label class="form-label" for="order-name">Name</label>
                        <input type="text" id="order-name" class="form-input" x-model="form.customer_name" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order-email">Email</label>
                        <input type="email" id="order-email" class="form-input" x-model="form.customer_email" placeholder="you@email.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order-phone">Phone</label>
                        <input type="tel" id="order-phone" class="form-input" x-model="form.customer_phone" @input="formatPhone" placeholder="(555) 123-4567" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order-birthday">Birthday <span style="font-weight: 400; text-transform: none; opacity: 0.6;">(optional — for special treats! 🎂)</span></label>
                        <div style="display: flex; gap: 8px;">
                            <select id="order-birthday-month" class="form-input" x-model="form.birthday_month" style="flex: 1;">
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select id="order-birthday-day" class="form-input" x-model="form.birthday_day" style="flex: 1;">
                                <option value="">Day</option>
                                <template x-for="d in 31" :key="d">
                                    <option :value="String(d).padStart(2, '0')" x-text="d"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <h3 class="form-section-title" style="margin-top: 24px;">Fulfillment</h3>

                    <div class="form-group">
                        <div class="toggle-group">
                            <button type="button" class="toggle-option" :class="{ active: fulfillment === 'pickup' }" @click="fulfillment = 'pickup'">
                                <span class="toggle-icon">🏠</span>
                                <span>Pickup</span>
                                <span class="toggle-label">Davenport, FL</span>
                            </button>
                            <button type="button" class="toggle-option" :class="{ active: fulfillment === 'delivery' }" @click="fulfillment = 'delivery'">
                                <span class="toggle-icon">🚗</span>
                                <span>Delivery</span>
                                <span class="toggle-label">Fee varies by distance</span>
                            </button>
                        </div>
                    </div>

                    <template x-if="fulfillment === 'delivery'">
                        <div x-data="addressAutocomplete()" x-init="initAC()">
                            <div class="form-group" style="position: relative;">
                                <label class="form-label" for="order-address">Delivery Address</label>
                                <input type="text" id="order-address" class="form-input" x-model="addressQuery" @input.debounce.400ms="searchAddress()" @click.outside="suggestions = []" placeholder="Start typing your address..." autocomplete="off" data-1p-ignore data-lpignore="true" data-form-type="other" required>
                                <div x-show="suggestions.length > 0" class="address-suggestions" x-cloak>
                                    <template x-for="(s, i) in suggestions" :key="i">
                                        <button type="button" class="address-suggestion" @click="selectAddress(s)" x-text="s.display"></button>
                                    </template>
                                </div>
                            </div>
                            <div x-show="deliveryCalcing" class="notice" style="justify-content: center;">
                                <span>Calculating delivery fee...</span>
                            </div>
                            <div x-show="deliveryError" class="notice" style="background: rgba(192,57,43,0.1);">
                                <span class="notice-icon">⚠️</span>
                                <span x-text="deliveryError" style="color: #c0392b;"></span>
                            </div>
                            <div x-show="deliveryTier && !deliveryCalcing && !deliveryError" class="notice">
                                <span class="notice-icon">🚗</span>
                                <span>
                                    <strong x-text="deliveryDistance"></strong> miles away —
                                    Delivery fee: <strong x-text="deliveryFee() === 0 ? 'Free!' : '$' + deliveryFee().toFixed(2)"></strong>
                                </span>
                            </div>
                        </div>
                    </template>

                    <div class="form-group" x-data="datePicker()" x-init="init()">
                        <label class="form-label">Requested Date &amp; Time</label>
                        <div class="date-picker-wrap">
                            <button type="button" class="form-input date-trigger" @click="open = !open" style="text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                                <span x-text="selectedLabel || 'Choose a date & time'" :style="selectedLabel ? '' : 'color: #b8a090'"></span>
                                <span style="font-size: 1.1rem;">📅</span>
                            </button>
                            <div class="date-dropdown" x-show="open" x-transition.opacity @click.outside="open = false" @keydown.escape.window="open = false" role="dialog" aria-label="Date and time picker" x-cloak>
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
                                                'selected': isSelectedDay(day),
                                                'today': isToday(day)
                                            }"
                                            :disabled="!isSelectable(day)"
                                            :aria-label="getDayLabel(day)"
                                            :aria-selected="isSelectedDay(day) ? 'true' : 'false'"
                                            @click="selectDay(day)"
                                            @keydown.arrow-right.prevent="$event.target.nextElementSibling?.focus()"
                                            @keydown.arrow-left.prevent="$event.target.previousElementSibling?.focus()">
                                            <span x-text="day"></span>
                                        </button>
                                    </template>
                                </div>

                                {{-- Time Slots --}}
                                <template x-if="pendingDate && dateBlocked">
                                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(139,94,60,0.1);">
                                        <p style="font-size: 0.9rem; font-weight: 600; color: #dc2626; text-align: center; padding: 12px; background: #fef2f2; border-radius: 8px;">
                                            This date is unavailable for orders. Please choose another day.
                                        </p>
                                    </div>
                                </template>
                                <template x-if="pendingDate && dateFull && !dateBlocked">
                                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(139,94,60,0.1);">
                                        <p style="font-size: 0.9rem; font-weight: 600; color: #dc2626; text-align: center; padding: 12px; background: #fef2f2; border-radius: 8px; margin-bottom: 12px;">
                                            FULL — This date has reached its order limit.
                                        </p>
                                        <template x-if="!waitlistSubmitted">
                                            <div style="background: #fffbf5; border: 1px solid rgba(139,94,60,0.15); border-radius: 10px; padding: 16px;">
                                                <p style="font-size: 0.85rem; font-weight: 600; color: var(--dark); margin-bottom: 10px; text-align: center;">
                                                    Want us to let you know if a spot opens up?
                                                </p>
                                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                                    <input type="text" x-model="waitlistName" placeholder="Your name" style="padding: 8px 12px; border: 1px solid rgba(139,94,60,0.2); border-radius: 6px; font-size: 0.85rem; font-family: inherit;">
                                                    <input type="email" x-model="waitlistEmail" placeholder="Email address" style="padding: 8px 12px; border: 1px solid rgba(139,94,60,0.2); border-radius: 6px; font-size: 0.85rem; font-family: inherit;">
                                                    <input type="text" x-model="waitlistPhone" placeholder="Phone (optional)" style="padding: 8px 12px; border: 1px solid rgba(139,94,60,0.2); border-radius: 6px; font-size: 0.85rem; font-family: inherit;">
                                                    <textarea x-model="waitlistInterest" placeholder="What were you hoping to order?" rows="2" style="padding: 8px 12px; border: 1px solid rgba(139,94,60,0.2); border-radius: 6px; font-size: 0.85rem; font-family: inherit; resize: vertical;"></textarea>
                                                    <button type="button" @click="submitWaitlist()" :disabled="!waitlistName || !waitlistEmail || waitlistSubmitting"
                                                        style="padding: 10px; background: var(--warm); color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: inherit;"
                                                        :style="(!waitlistName || !waitlistEmail) && 'opacity: 0.5; cursor: not-allowed'">
                                                        <span x-text="waitlistSubmitting ? 'Joining...' : 'Join Waitlist'"></span>
                                                    </button>
                                                </div>
                                                <template x-if="waitlistError">
                                                    <p style="color: #dc2626; font-size: 0.8rem; margin-top: 8px; text-align: center;" x-text="waitlistError"></p>
                                                </template>
                                            </div>
                                        </template>
                                        <template x-if="waitlistSubmitted">
                                            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 16px; text-align: center;">
                                                <p style="font-size: 0.9rem; font-weight: 600; color: #16a34a;">
                                                    You're on the waitlist! We'll email you if a spot opens up.
                                                </p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="pendingDate && !dateBlocked && !dateFull">
                                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(139,94,60,0.1);">
                                        <p style="font-size: 0.82rem; font-weight: 600; color: var(--warm); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">
                                            🕐 Pick a time for <span x-text="pendingDayLabel" style="color: var(--dark);"></span>
                                            <template x-if="capacityInfo && capacityInfo.remaining !== null">
                                                <span style="font-weight: 400; font-size: 0.75rem; opacity: 0.7;"> — <span x-text="capacityInfo.remaining"></span> slots left</span>
                                            </template>
                                        </p>
                                        <template x-if="capacityInfo && capacityInfo.holiday">
                                            <p style="font-size: 0.8rem; color: var(--accent); background: rgba(212,165,116,0.12); padding: 8px 12px; border-radius: 8px; margin-bottom: 10px; border-left: 3px solid var(--golden);">
                                                Holiday orders may require extra lead time.
                                                <template x-if="!capacityInfo.holiday.deadline_passed">
                                                    <span>Order by <span x-text="capacityInfo.holiday.deadline" style="font-weight: 600;"></span> for <span x-text="capacityInfo.holiday.name"></span>.</span>
                                                </template>
                                            </p>
                                        </template>
                                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                            <template x-for="slot in availableSlots" :key="slot.value">
                                                <button type="button"
                                                    class="time-slot-btn"
                                                    :class="{ 'selected': selectedTime === slot.value }"
                                                    @click="selectTime(slot)"
                                                    x-text="slot.label">
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <div class="cal-footer">
                                    <span>📌 Orders require 2 days advance notice</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="order-notes">Notes <span style="font-weight: 400; text-transform: none; opacity: 0.6;">(optional)</span></label>
                        <textarea id="order-notes" class="form-input" x-model="form.notes" placeholder="Any special requests or instructions..."></textarea>
                    </div>

                    {{-- Hidden fields for items --}}
                    <template x-for="(item, index) in cart" :key="'hidden-' + item.id">
                        <div>
                            <input type="hidden" :name="'items[' + index + '][product_id]'" :value="item.id">
                            <input type="hidden" :name="'items[' + index + '][quantity]'" :value="item.qty">
                            <template x-if="item.selections && item.selections.length">
                                <template x-for="(sel, si) in item.selections" :key="'sel-' + index + '-' + si">
                                    <input type="hidden" :name="'items[' + index + '][selections][' + si + ']'" :value="sel">
                                </template>
                            </template>
                        </div>
                    </template>
                    <input type="hidden" name="customer_name" :value="form.customer_name">
                    <input type="hidden" name="customer_email" :value="form.customer_email">
                    <input type="hidden" name="customer_phone" :value="form.customer_phone">
                    <input type="hidden" name="birthday" :value="(form.birthday_month && form.birthday_day) ? ('2000-' + form.birthday_month + '-' + form.birthday_day) : ''">
                    <input type="hidden" name="fulfillment_type" :value="fulfillment">
                    <input type="hidden" name="delivery_address" :value="form.delivery_address">
                    <input type="hidden" name="delivery_zip" :value="form.delivery_zip">
                    <input type="hidden" name="requested_date" :value="form.requested_date">
                    <input type="hidden" name="requested_time" :value="form.requested_time">
                    <input type="hidden" name="notes" :value="form.notes">

                    {{-- Coupon Code --}}
                    <div style="margin-top: 20px; border-top: 1px solid rgba(139,94,60,0.1); padding-top: 16px;">
                        <button type="button" @click="couponOpen = !couponOpen" style="background: none; border: none; cursor: pointer; font-family: 'Playfair Display', serif; font-size: 0.9rem; color: var(--warm); display: flex; align-items: center; gap: 6px; padding: 0;">
                            <span x-text="couponOpen ? '▾' : '▸'"></span>
                            Have a coupon code?
                        </button>
                        <div x-show="couponOpen" x-transition style="margin-top: 10px;">
                            <div class="coupon-field">
                                <input type="text" x-model="couponCode" placeholder="Enter coupon code" :disabled="couponApplied">
                                <button type="button" x-show="!couponApplied" @click="applyCoupon()" :disabled="couponLoading || !couponCode.trim()">
                                    <span x-show="!couponLoading">Apply</span>
                                    <span x-show="couponLoading">...</span>
                                </button>
                                <button type="button" class="coupon-remove" x-show="couponApplied" @click="removeCoupon()">
                                    Remove
                                </button>
                            </div>
                            <p x-show="couponError" x-text="couponError" style="color: #dc2626; font-size: 0.8rem; margin-top: 6px;"></p>
                            <p x-show="couponApplied" style="color: #16a34a; font-size: 0.8rem; margin-top: 6px;">
                                ✓ Coupon <strong x-text="couponCode"></strong> applied — <span x-text="couponLabel"></span>
                            </p>
                        </div>
                    </div>

                    <input type="hidden" name="coupon_id" :value="couponId">

                    <div x-show="formValid()" x-transition style="margin-top: 16px;">
                        <p style="font-size: 0.85rem; color: var(--warm); text-align: center; margin-bottom: 12px;">Pay securely with PayPal to complete your order</p>
                        <div id="paypal-button-container"></div>
                        <p style="font-size: 0.75rem; color: var(--warm); opacity: 0.6; text-align: center; margin-top: 12px; line-height: 1.5; font-style: italic;">* While certain items may not contain allergens, they are produced in an environment where allergens could be present. Please proceed with caution.</p>
                    </div>

                    <div x-show="!formValid()" style="margin-top: 16px;">
                        <button type="button" class="submit-btn" disabled>Complete all fields to pay</button>
                    </div>

                    <div x-show="paymentError" class="error-msg" style="margin-top: 12px; text-align: center;" x-text="paymentError"></div>

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

    {{-- BUNDLE PICKER MODAL --}}
    <div x-show="bundleModal" x-transition.opacity class="bundle-overlay" @click.self="bundleModal = false" @keydown.escape.window="bundleModal = false" x-cloak>
        <div class="bundle-modal" role="dialog" aria-modal="true" aria-label="Choose bundle flavors" @click.stop x-trap.noscroll="bundleModal">
            <div class="bundle-modal-header">
                <h3 x-text="'Choose ' + bundlePickCount + ' Flavors'"></h3>
                <button @click="bundleModal = false" class="bundle-close">&times;</button>
            </div>
            <p class="bundle-modal-sub">Pick your favorites for the <span x-text="bundleName"></span></p>
            <div class="bundle-progress">
                <div class="bundle-progress-bar" :style="'width: ' + (bundleSelected() / bundlePickCount * 100) + '%'"></div>
            </div>
            <p class="bundle-progress-text"><span x-text="bundleSelected()"></span> of <span x-text="bundlePickCount"></span> selected</p>

            <div class="bundle-options">
                <template x-for="opt in bundleOptions" :key="opt.id">
                    <div class="bundle-option" :class="{ 'has-qty': getBundleQty(opt.id) > 0 }">
                        <span class="bundle-option-name" x-text="opt.name"></span>
                        <div class="qty-control">
                            <button class="qty-btn" @click="decBundleQty(opt.id)" :disabled="getBundleQty(opt.id) === 0">−</button>
                            <span class="qty-value" :class="{ 'has-items': getBundleQty(opt.id) > 0 }" x-text="getBundleQty(opt.id)"></span>
                            <button class="qty-btn" @click="incBundleQty(opt.id)" :disabled="bundleSelected() >= bundlePickCount">+</button>
                        </div>
                    </div>
                </template>
            </div>

            <button class="submit-btn" :disabled="bundleSelected() !== bundlePickCount" @click="confirmBundle()" style="margin-top: 20px;">
                Add to Order
            </button>
        </div>
    </div>
    </div>

    </main>

    {{-- FOOTER --}}
@endsection

@section('scripts')
    <script>
        const bundleConfig = @json($bundles);

        function datePicker() {
            // Hours by day of week: 0=Sun, 1=Mon, 2=Tue, 3=Wed, 4=Thu, 5=Fri, 6=Sat
            const scheduleByDay = {
                0: { start: 10, end: 19 }, // Sunday 10am-7pm
                1: { start: 12, end: 19 }, // Monday 12pm-7pm
                2: { start: 12, end: 19 }, // Tuesday 12pm-7pm
                3: { start: 10, end: 19 }, // Wednesday 10am-7pm
                4: { start: 10, end: 16 }, // Thursday 10am-4pm
                5: { start: 10, end: 19 }, // Friday 10am-7pm
                6: { start: 14, end: 19 }, // Saturday 2pm-7pm
            };

            function formatHour12(h) {
                if (h === 12) return '12:00 PM';
                if (h > 12) return (h - 12) + ':00 PM';
                return h + ':00 AM';
            }

            function formatHour24(h) {
                return String(h).padStart(2, '0') + ':00';
            }

            function getSlotsForDay(dayOfWeek) {
                const sched = scheduleByDay[dayOfWeek];
                if (!sched) return [];
                const slots = [];
                for (let h = sched.start; h <= sched.end; h++) {
                    slots.push({ label: formatHour12(h), value: formatHour24(h) });
                }
                return slots;
            }

            return {
                open: false,
                month: null,
                year: null,
                selectedLabel: '',
                days: [],
                blanks: [],
                pendingDate: null,
                pendingDayLabel: '',
                availableSlots: [],
                dateBlocked: false,
                dateFull: false,
                capacityInfo: null,
                waitlistName: '',
                waitlistEmail: '',
                waitlistPhone: '',
                waitlistInterest: '',
                waitlistSubmitting: false,
                waitlistSubmitted: false,
                waitlistError: '',
                selectedTime: null,

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

                isSelectedDay(day) {
                    if (!this.pendingDate) return false;
                    const pd = new Date(this.pendingDate + 'T00:00:00');
                    return pd.getFullYear() === this.year && pd.getMonth() === this.month && pd.getDate() === day;
                },

                isToday(day) {
                    const now = new Date();
                    return now.getFullYear() === this.year && now.getMonth() === this.month && now.getDate() === day;
                },

                getDayLabel(day) {
                    const date = new Date(this.year, this.month, day);
                    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                    return days[date.getDay()] + ', ' + months[date.getMonth()] + ' ' + date.getDate() + ', ' + this.year;
                },

                selectDay(day) {
                    const date = new Date(this.year, this.month, day);
                    const y = date.getFullYear();
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const d = String(date.getDate()).padStart(2, '0');

                    this.pendingDate = y + '-' + m + '-' + d;
                    this.selectedTime = null;
                    this.dateBlocked = false;
                    this.dateFull = false;
                    this.capacityInfo = null;
                    this.waitlistSubmitted = false;
                    this.waitlistError = '';

                    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    const dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                    this.pendingDayLabel = dayNames[date.getDay()] + ', ' + months[date.getMonth()] + ' ' + date.getDate();

                    // Check capacity
                    fetch('/order/capacity/' + this.pendingDate)
                        .then(r => r.json())
                        .then(data => {
                            this.capacityInfo = data;
                            if (data.blocked) {
                                this.dateBlocked = true;
                                this.availableSlots = [];
                            } else if (!data.available) {
                                this.dateFull = true;
                                this.availableSlots = [];
                            } else {
                                this.availableSlots = getSlotsForDay(date.getDay());
                            }
                        })
                        .catch(() => {
                            this.availableSlots = getSlotsForDay(date.getDay());
                        });
                },

                async submitWaitlist() {
                    this.waitlistSubmitting = true;
                    this.waitlistError = '';
                    try {
                        const res = await fetch('/order/waitlist', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                customer_name: this.waitlistName,
                                customer_email: this.waitlistEmail,
                                customer_phone: this.waitlistPhone || null,
                                product_interest: this.waitlistInterest || null,
                                requested_date: this.pendingDate,
                            }),
                        });
                        const data = await res.json();
                        if (!res.ok) {
                            this.waitlistError = data.message || data.error || 'Something went wrong. Please try again.';
                        } else {
                            this.waitlistSubmitted = true;
                        }
                    } catch (e) {
                        this.waitlistError = 'Something went wrong. Please try again.';
                    } finally {
                        this.waitlistSubmitting = false;
                    }
                },
                selectTime(slot) {
                    this.selectedTime = slot.value;

                    const parent = this.$el.closest('.order-layout');
                    const form = Alpine.$data(parent);
                    form.form.requested_date = this.pendingDate;
                    form.form.requested_time = slot.value;

                    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    const dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                    const date = new Date(this.pendingDate + 'T00:00:00');
                    this.selectedLabel = dayNames[date.getDay()] + ', ' + months[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear() + ' at ' + slot.label;

                    this.open = false;
                }
            }
        }

        function orderPage() {
            return {
                cart: [],
                favorites: [],
                favoritesEmail: localStorage.getItem('bob_customer_email') || '',
                fulfillment: 'pickup',
                deliveryTier: null,
                deliveryDistance: null,
                deliveryCalcing: false,
                deliveryError: '',
                mobileCollapsed: window.innerWidth <= 900,
                submitting: false,
                paymentError: '',
                bundleModal: false,
                bundleProductId: null,
                bundleName: '',
                bundlePrice: 0,
                bundlePickCount: 4,
                bundleOptions: [],
                bundlePicks: {},
                couponOpen: false,
                couponCode: '',
                couponId: null,
                couponDiscount: 0,
                couponLabel: '',
                couponApplied: false,
                couponLoading: false,
                couponError: '',
                form: {
                    customer_name: '',
                    customer_email: '',
                    customer_phone: '',
                    birthday_month: '',
                    birthday_day: '',
                    delivery_address: '',
                    delivery_zip: '',
                    requested_date: '',
                    requested_time: '',
                    notes: '',
                },

                init() {
                    // Check for reorder param
                    const params = new URLSearchParams(window.location.search);
                    const reorderId = params.get('reorder');
                    if (reorderId) {
                        this.loadReorder(reorderId);
                    }

                    // Load favorites if we have a stored email
                    if (this.favoritesEmail) {
                        this.loadFavorites(this.favoritesEmail);
                    }
                    // Watch for email changes to load favorites
                    this.$watch('form.customer_email', (val) => {
                        if (val && val.includes('@') && val.includes('.')) {
                            localStorage.setItem('bob_customer_email', val);
                            this.favoritesEmail = val;
                            this.loadFavorites(val);
                        }
                    });
                },

                async loadReorder(orderId) {
                    try {
                        const res = await fetch(`/order/reorder/${orderId}`);
                        if (!res.ok) return;
                        const data = await res.json();

                        // Prefill customer info
                        this.form.customer_name = data.customer_name || '';
                        this.form.customer_email = data.customer_email || '';
                        this.form.customer_phone = data.customer_phone || '';

                        // Add items to cart
                        for (const item of data.items) {
                            this.cart.push({
                                id: item.product_id,
                                name: item.product_name,
                                price: parseFloat(item.unit_price),
                                quantity: item.quantity,
                                selections: item.selections || null,
                            });
                        }
                    } catch (e) {
                        console.warn('Could not load reorder data', e);
                    }
                },

                async loadFavorites(email) {
                    try {
                        const res = await fetch(`/favorites/${encodeURIComponent(email)}`);
                        const data = await res.json();
                        this.favorites = data.favorites || [];
                    } catch (e) {
                        console.warn('Could not load favorites', e);
                    }
                },

                isFavorite(productId) {
                    return this.favorites.includes(productId);
                },

                async toggleFavorite(productId) {
                    let email = this.favoritesEmail || this.form.customer_email;
                    if (!email || !email.includes('@')) {
                        email = prompt('Enter your email to save favorites:');
                        if (!email || !email.includes('@')) return;
                        this.favoritesEmail = email;
                        localStorage.setItem('bob_customer_email', email);
                        await this.loadFavorites(email);
                    }
                    try {
                        const res = await fetch('/favorites/toggle', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ email, product_id: productId }),
                        });
                        const data = await res.json();
                        if (data.favorited) {
                            if (!this.favorites.includes(productId)) this.favorites.push(productId);
                        } else {
                            this.favorites = this.favorites.filter(id => id !== productId);
                        }
                    } catch (e) {
                        console.warn('Could not toggle favorite', e);
                    }
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

                deliveryFee() {
                    if (this.fulfillment !== 'delivery') return 0;
                    if (this.deliveryTier === 'under5') return 0;
                    if (this.deliveryTier === '5to10') return 5;
                    if (this.deliveryTier === 'over10') return 10;
                    return 0;
                },

                total() {
                    return Math.max(0, this.subtotal() + this.deliveryFee() - this.couponDiscount);
                },

                async applyCoupon() {
                    if (!this.couponCode.trim()) return;
                    this.couponLoading = true;
                    this.couponError = '';
                    try {
                        const resp = await fetch('{{ route("order.apply-coupon") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                code: this.couponCode.trim(),
                                subtotal: this.subtotal(),
                            }),
                        });
                        const data = await resp.json();
                        if (data.error) {
                            this.couponError = data.error;
                        } else {
                            this.couponId = data.coupon_id;
                            this.couponDiscount = data.discount;
                            this.couponLabel = data.label;
                            this.couponCode = data.code;
                            this.couponApplied = true;
                        }
                    } catch (e) {
                        this.couponError = 'Something went wrong. Please try again.';
                    }
                    this.couponLoading = false;
                },

                removeCoupon() {
                    this.couponId = null;
                    this.couponDiscount = 0;
                    this.couponLabel = '';
                    this.couponApplied = false;
                    this.couponCode = '';
                    this.couponError = '';
                },

                openBundlePicker(id, name, price) {
                    const config = bundleConfig[id];
                    if (!config) return;
                    this.bundleProductId = id;
                    this.bundleName = name;
                    this.bundlePrice = price;
                    this.bundlePickCount = config.pick_count;
                    this.bundleOptions = config.options;
                    this.bundlePicks = {};
                    this.bundleModal = true;
                },

                getBundleQty(optId) {
                    return this.bundlePicks[optId] || 0;
                },

                bundleSelected() {
                    return Object.values(this.bundlePicks).reduce((s, v) => s + v, 0);
                },

                incBundleQty(optId) {
                    if (this.bundleSelected() >= this.bundlePickCount) return;
                    this.bundlePicks[optId] = (this.bundlePicks[optId] || 0) + 1;
                },

                decBundleQty(optId) {
                    if (!this.bundlePicks[optId]) return;
                    this.bundlePicks[optId]--;
                    if (this.bundlePicks[optId] <= 0) delete this.bundlePicks[optId];
                },

                confirmBundle() {
                    if (this.bundleSelected() !== this.bundlePickCount) return;
                    const selections = [];
                    for (const [optId, qty] of Object.entries(this.bundlePicks)) {
                        const opt = this.bundleOptions.find(o => o.id == optId);
                        if (opt) {
                            for (let i = 0; i < qty; i++) {
                                selections.push(opt.name);
                            }
                        }
                    }
                    const existing = this.cart.find(i => i.id === this.bundleProductId);
                    if (existing) {
                        existing.qty++;
                        existing.allSelections = existing.allSelections || [existing.selections];
                        existing.allSelections.push(selections);
                        existing.selections = existing.allSelections.flat();
                    } else {
                        this.cart.push({
                            id: this.bundleProductId,
                            name: this.bundleName,
                            price: this.bundlePrice,
                            qty: 1,
                            isBundle: true,
                            selections: selections,
                            allSelections: [selections],
                        });
                    }
                    this.bundleModal = false;
                    this.mobileCollapsed = false;
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

                formValid() {
                    const base = this.cart.length > 0
                        && this.form.customer_name.trim() !== ''
                        && this.form.customer_email.trim() !== ''
                        && this.form.customer_phone.trim() !== ''
                        && this.form.requested_date !== ''
                        && this.form.requested_time !== '';
                    if (this.fulfillment === 'delivery') {
                        return base && this.deliveryTier !== null;
                    }
                    return base;
                },

                getOrderData() {
                    return {
                        customer_name: this.form.customer_name,
                        customer_email: this.form.customer_email,
                        customer_phone: this.form.customer_phone,
                        birthday: (this.form.birthday_month && this.form.birthday_day) ? ('2000-' + this.form.birthday_month + '-' + this.form.birthday_day) : null,
                        fulfillment_type: this.fulfillment,
                        delivery_address: this.form.delivery_address,
                        delivery_zip: this.form.delivery_zip,
                        delivery_tier: this.deliveryTier,
                        requested_date: this.form.requested_date,
                        requested_time: this.form.requested_time,
                        notes: this.form.notes,
                        coupon_id: this.couponId,
                        items: this.cart.map(item => ({
                            product_id: item.id,
                            quantity: item.qty,
                            selections: item.selections || null,
                        })),
                    };
                }
            }
        }
    </script>

    <script>
        function addressAutocomplete() {
            return {
                addressQuery: '',
                suggestions: [],
                selectedCoords: null,

                initAC() {},

                async searchAddress() {
                    const q = this.addressQuery.trim();
                    if (q.length < 5) {
                        this.suggestions = [];
                        return;
                    }

                    try {
                        const resp = await fetch('https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(q) + '&format=json&addressdetails=1&countrycodes=us&viewbox=-82.2,28.7,-81.2,27.9&bounded=1&limit=5', {
                            headers: { 'Accept': 'application/json' }
                        });
                        const data = await resp.json();

                        this.suggestions = data
                            .filter(r => r.address && r.address.state === 'Florida')
                            .map(r => {
                                const a = r.address;
                                const street = [a.house_number, a.road].filter(Boolean).join(' ');
                                const city = a.city || a.town || a.village || a.hamlet || '';
                                const parts = [street, city, a.state, a.postcode].filter(Boolean);
                                return {
                                    display: parts.join(', '),
                                    lat: parseFloat(r.lat),
                                    lon: parseFloat(r.lon),
                                    street: street,
                                    city: city,
                                    zip: a.postcode || '',
                                };
                            })
                            .filter(s => s.street.length > 0);
                    } catch (e) {
                        this.suggestions = [];
                    }
                },

                selectAddress(s) {
                    this.addressQuery = s.display;
                    this.suggestions = [];
                    this.selectedCoords = { lat: s.lat, lon: s.lon };

                    // Update parent form
                    const parent = this.$el.closest('.order-layout');
                    const form = Alpine.$data(parent);
                    form.form.delivery_address = s.display;
                    form.form.delivery_zip = s.zip;

                    // Calculate distance with known coords
                    this.calcWithCoords(form, s.lat, s.lon);
                },

                async calcWithCoords(form, lat, lon) {
                    form.deliveryCalcing = true;
                    form.deliveryError = '';
                    form.deliveryTier = null;
                    form.deliveryDistance = null;

                    try {
                        const baseLon = -81.65249;
                        const baseLat = 28.31716;
                        const routeResp = await fetch('https://router.project-osrm.org/route/v1/driving/' + baseLon + ',' + baseLat + ';' + lon + ',' + lat + '?overview=false');
                        const routeData = await routeResp.json();

                        if (routeData.code !== 'Ok' || !routeData.routes.length) {
                            form.deliveryError = "Couldn't calculate driving distance. Please try a different address.";
                            form.deliveryCalcing = false;
                            return;
                        }

                        const meters = routeData.routes[0].legs[0].distance;
                        const miles = meters / 1609.34;

                        form.deliveryDistance = miles.toFixed(1);

                        if (miles < 5) {
                            form.deliveryTier = 'under5';
                        } else if (miles <= 10) {
                            form.deliveryTier = '5to10';
                        } else {
                            form.deliveryTier = 'over10';
                        }
                    } catch (e) {
                        form.deliveryError = "Couldn't calculate distance. Please try again.";
                    }

                    form.deliveryCalcing = false;
                }
            }
        }
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
    <script>
        // Wait for both Alpine and PayPal to be ready
        document.addEventListener('alpine:init', () => {
            // Small delay to ensure DOM is ready
            setTimeout(initPayPalButtons, 500);
        });

        function initPayPalButtons() {
            const container = document.getElementById('paypal-button-container');
            if (!container) {
                setTimeout(initPayPalButtons, 500);
                return;
            }

            paypal.Buttons({
                style: {
                    color: 'gold',
                    shape: 'pill',
                    label: 'pay',
                    height: 45,
                },

                createOrder: async function() {
                    const alpineEl = document.querySelector('.order-layout');
                    const data = Alpine.$data(alpineEl);

                    if (!data.formValid()) {
                        data.paymentError = 'Please fill in all required fields.';
                        throw new Error('Form not valid');
                    }

                    data.paymentError = '';
                    const orderData = data.getOrderData();

                    const response = await fetch('{{ route("order.paypal.create") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(orderData),
                    });

                    const text = await response.text();
                    let result;
                    try {
                        result = JSON.parse(text);
                    } catch (e) {
                        console.error('PayPal create response not JSON:', text.substring(0, 500));
                        data.paymentError = 'Payment service error. Please try again.';
                        throw new Error('Non-JSON response from server');
                    }

                    if (!response.ok || result.error) {
                        // Handle Laravel validation errors
                        if (result.errors) {
                            const firstError = Object.values(result.errors).flat()[0];
                            data.paymentError = firstError || result.message || 'Validation error.';
                        } else {
                            data.paymentError = result.error || result.message || 'Something went wrong.';
                        }
                        throw new Error(data.paymentError);
                    }

                    return result.id;
                },

                onApprove: async function(paypalData) {
                    const alpineEl = document.querySelector('.order-layout');
                    const data = Alpine.$data(alpineEl);
                    data.submitting = true;

                    const response = await fetch('{{ route("order.paypal.capture") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            paypal_order_id: paypalData.orderID,
                        }),
                    });

                    const result = await response.json();

                    if (result.success && result.redirect) {
                        window.location.href = result.redirect;
                    } else {
                        data.paymentError = result.error || 'Payment failed. Please try again.';
                        data.submitting = false;
                    }
                },

                onError: function(err) {
                    const alpineEl = document.querySelector('.order-layout');
                    const data = Alpine.$data(alpineEl);
                    data.paymentError = 'Something went wrong with PayPal. Please try again.';
                    data.submitting = false;
                    console.error('PayPal error:', err);
                },

                onCancel: function() {
                    const alpineEl = document.querySelector('.order-layout');
                    const data = Alpine.$data(alpineEl);
                    data.paymentError = '';
                    data.submitting = false;
                }
            }).render('#paypal-button-container');
        }
    </script>
@endsection
