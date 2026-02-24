<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background:#fdf8f2;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
    <div style="max-width:600px;margin:0 auto;padding:2rem 1rem;">
        {{-- Header --}}
        <div style="text-align:center;padding:1.5rem;background:linear-gradient(135deg,#3d2314,#6b4c3b);border-radius:12px 12px 0 0;">
            <h1 style="margin:0;color:white;font-size:1.5rem;">🧁 Bakery on Biscotto</h1>
        </div>

        {{-- Body --}}
        <div style="background:white;padding:2rem;border:1px solid #e8d0b0;border-top:none;border-radius:0 0 12px 12px;">
            <h2 style="color:#3d2314;margin-top:0;">Payment Reminder</h2>

            <p style="color:#6b4c3b;line-height:1.6;">
                Hi {{ $order->customer_name }},
            </p>

            <p style="color:#6b4c3b;line-height:1.6;">
                This is a friendly reminder that payment for your order is due <strong>tomorrow, {{ $order->payment_deadline->format('l, M j, Y') }}</strong>.
            </p>

            {{-- Order Summary --}}
            <div style="background:#fdf8f2;border:1px solid #e8d0b0;border-radius:8px;padding:1rem;margin:1.5rem 0;">
                <p style="margin:0 0 0.5rem;font-weight:700;color:#3d2314;">Order {{ $order->order_number }}</p>
                @foreach($order->items as $item)
                    <p style="margin:0.25rem 0;color:#6b4c3b;font-size:0.9rem;">
                        {{ $item->quantity }}x {{ $item->product_name }} — ${{ number_format($item->line_total, 2) }}
                    </p>
                @endforeach
                @if($order->delivery_fee > 0)
                    <p style="margin:0.25rem 0;color:#6b4c3b;font-size:0.9rem;">
                        Delivery Fee — ${{ number_format($order->delivery_fee, 2) }}
                    </p>
                @endif
                <hr style="border:none;border-top:1px solid #e8d0b0;margin:0.75rem 0;">
                <p style="margin:0;font-weight:700;color:#3d2314;font-size:1.1rem;">
                    Total: ${{ number_format($order->total, 2) }}
                </p>
            </div>

            {{-- Pay Button --}}
            @if($order->paypal_invoice_url)
                <div style="text-align:center;margin:1.5rem 0;">
                    <a href="{{ $order->paypal_invoice_url }}" style="display:inline-block;background:#8b5e3c;color:white;padding:0.75rem 2rem;border-radius:8px;text-decoration:none;font-weight:700;font-size:1rem;">
                        💳 Pay Now via PayPal
                    </a>
                </div>
            @endif

            <p style="color:#a08060;font-size:0.85rem;line-height:1.5;">
                If you've already made your payment, please disregard this email. Thank you for choosing Bakery on Biscotto! 🧁
            </p>
        </div>

        {{-- Footer --}}
        <div style="text-align:center;padding:1rem;color:#a08060;font-size:0.8rem;">
            Bakery on Biscotto · Davenport, FL
        </div>
    </div>
</body>
</html>
