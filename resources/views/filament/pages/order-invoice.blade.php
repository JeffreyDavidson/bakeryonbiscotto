<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice — {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Georgia', serif; background: #fff; color: #3d2314; padding: 2rem; max-width: 800px; margin: 0 auto; }

        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 1.5rem; border-bottom: 3px solid #3d2314; margin-bottom: 1.5rem; }
        .brand h1 { font-size: 1.8rem; color: #3d2314; margin-bottom: 0.25rem; }
        .brand p { color: #6b4c3b; font-size: 0.85rem; }
        .invoice-meta { text-align: right; }
        .invoice-meta h2 { font-size: 1.4rem; color: #6b4c3b; text-transform: uppercase; letter-spacing: 0.1em; }
        .invoice-meta p { font-size: 0.85rem; color: #6b4c3b; margin-top: 0.25rem; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem; }
        .info-block h3 { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; color: #6b4c3b; margin-bottom: 0.4rem; border-bottom: 1px solid #e8d0b0; padding-bottom: 0.25rem; }
        .info-block p { font-size: 0.9rem; line-height: 1.5; }

        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .items-table th { background: #3d2314; color: #fdf8f2; padding: 0.6rem 0.75rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .items-table th:last-child, .items-table td:last-child { text-align: right; }
        .items-table th:nth-child(3), .items-table td:nth-child(3) { text-align: center; }
        .items-table td { padding: 0.6rem 0.75rem; border-bottom: 1px solid #e8d0b0; font-size: 0.9rem; }

        .totals { margin-left: auto; width: 280px; }
        .totals-row { display: flex; justify-content: space-between; padding: 0.4rem 0; font-size: 0.9rem; }
        .totals-row.total { border-top: 2px solid #3d2314; font-weight: 700; font-size: 1.1rem; padding-top: 0.6rem; margin-top: 0.25rem; }

        .footer { margin-top: 2.5rem; padding-top: 1rem; border-top: 1px solid #e8d0b0; text-align: center; color: #6b4c3b; font-size: 0.8rem; }
        .footer p { margin-bottom: 0.25rem; }

        .notes { background: #fdf8f2; border: 1px solid #e8d0b0; border-radius: 0.4rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 0.85rem; }
        .notes strong { color: #6b4c3b; }

        .print-btn { display: inline-block; padding: 0.6rem 1.5rem; background: #3d2314; color: #fdf8f2; border: none; border-radius: 0.4rem; font-size: 0.9rem; cursor: pointer; margin-bottom: 1.5rem; font-family: inherit; }
        .print-btn:hover { background: #6b4c3b; }

        @media print {
            .print-btn { display: none !important; }
            body { padding: 0; }
            @page { margin: 1.5cm; }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">🖨️ Print Invoice</button>

    <div class="invoice-header">
        <div class="brand">
            <h1>🍪 Bakery on Biscotto</h1>
            <p>Handcrafted with love</p>
        </div>
        <div class="invoice-meta">
            <h2>Invoice</h2>
            <p><strong>{{ $order->order_number }}</strong></p>
            <p>{{ $order->created_at->format('F j, Y') }}</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-block">
            <h3>Customer</h3>
            <p>
                <strong>{{ $order->customer_name }}</strong><br>
                {{ $order->customer_email }}<br>
                @if($order->customer_phone){{ $order->customer_phone }}<br>@endif
            </p>
        </div>
        <div class="info-block">
            <h3>Fulfillment</h3>
            <p>
                <strong>{{ ucfirst($order->fulfillment_type) }}</strong><br>
                Date: {{ $order->requested_date->format('M j, Y') }}
                @if($order->requested_time) at {{ $order->requested_time }}@endif<br>
                @if($order->fulfillment_type === 'delivery' && $order->delivery_address)
                    {{ $order->delivery_address }}
                    @if($order->delivery_zip) {{ $order->delivery_zip }}@endif
                @endif
                Status: <strong>{{ ucfirst($order->status) }}</strong>
            </p>
        </div>
    </div>

    @if($order->notes)
        <div class="notes">
            <strong>Notes:</strong> {{ $order->notes }}
        </div>
    @endif

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->line_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="totals-row">
            <span>Subtotal</span>
            <span>${{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->delivery_fee > 0)
            <div class="totals-row">
                <span>Delivery Fee</span>
                <span>${{ number_format($order->delivery_fee, 2) }}</span>
            </div>
        @endif
        <div class="totals-row total">
            <span>Total</span>
            <span>${{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>Bakery on Biscotto</strong></p>
        <p>Thank you for your order! 🍪</p>
        <p>Payment Status: {{ ucfirst($order->payment_status) }}</p>
    </div>
</body>
</html>
