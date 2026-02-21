<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Bakery on Biscotto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
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
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: var(--light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }
        .confirmation {
            max-width: 560px;
            width: 100%;
            text-align: center;
        }
        .check-circle {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--golden), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2.5rem;
            animation: pop 0.5s ease;
        }
        @keyframes pop {
            0% { transform: scale(0); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }
        h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            color: var(--warm);
            margin-bottom: 32px;
        }
        .order-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid rgba(139,94,60,0.1);
            box-shadow: 0 4px 24px rgba(61,35,20,0.08);
            padding: 32px;
            text-align: left;
            margin-bottom: 32px;
        }
        .order-number {
            font-family: 'Playfair Display', serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(139,94,60,0.06);
            font-size: 0.95rem;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: var(--warm); }
        .detail-value { font-weight: 500; color: var(--dark); }
        .items-section { margin-top: 20px; }
        .items-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--dark);
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 0.9rem;
        }
        .item-name { color: var(--dark); }
        .item-price { color: var(--accent); font-weight: 500; }
        .total-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
            margin: 16px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        .note-box {
            background: rgba(212,165,116,0.1);
            border-radius: 12px;
            padding: 16px;
            margin-top: 20px;
            font-size: 0.9rem;
            color: var(--warm);
            line-height: 1.5;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: var(--dark);
            color: var(--cream);
            text-decoration: none;
            border-radius: 100px;
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.3s;
        }
        .back-link:hover { background: var(--brown); }
    </style>
</head>
<body>
    <div class="confirmation">
        <div class="check-circle">✓</div>
        <h1>Order Received!</h1>
        <p class="subtitle">Payment received! We've got your order and we're excited to start baking for you.</p>

        <div class="order-card">
            <div class="order-number">Order {{ $order->order_number }}</div>

            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $order->customer_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Requested Date</span>
                <span class="detail-value">{{ $order->requested_date->format('l, F j, Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">{{ $order->fulfillment_type === 'delivery' ? 'Delivery' : 'Pickup' }}</span>
                <span class="detail-value">
                    @if($order->fulfillment_type === 'delivery')
                        {{ $order->delivery_address }}
                    @else
                        We'll reach out with pickup details
                    @endif
                </span>
            </div>

            <div class="items-section">
                <h3 class="items-title">Items</h3>
                @foreach($order->items as $item)
                <div class="item-row">
                    <span class="item-name">
                        {{ $item->product_name }} &times; {{ $item->quantity }}
                        @if($item->selections)
                            <br><em style="font-size: 0.82rem; color: var(--warm);">({{ implode(', ', $item->selections) }})</em>
                        @endif
                    </span>
                    <span class="item-price">${{ number_format($item->line_total, 2) }}</span>
                </div>
                @endforeach
            </div>

            @if($order->delivery_fee > 0)
            <div class="item-row" style="font-size: 0.9rem;">
                <span class="detail-label">Delivery Fee</span>
                <span class="item-price">${{ number_format($order->delivery_fee, 2) }}</span>
            </div>
            @endif

            <div class="total-divider"></div>
            <div class="total-row">
                <span>Total</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>

            <div class="note-box">
                📧 A confirmation email has been sent to <strong>{{ $order->customer_email }}</strong>. Cassie will reach out if she has any questions about your order!
            </div>
        </div>

        <a href="/" class="back-link">← Back to Home</a>
    </div>
</body>
</html>
