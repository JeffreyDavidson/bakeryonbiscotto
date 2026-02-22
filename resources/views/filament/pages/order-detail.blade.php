<style>
    .order-detail { font-family: inherit; }
    .order-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .order-header h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }
    .order-header .order-number {
        font-family: monospace;
        font-size: 0.875rem;
        color: #6b7280;
        background: #f3f4f6;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
    }
    .order-header .order-date {
        font-size: 0.875rem;
        color: #9ca3af;
        margin-left: auto;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 1rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .status-pending { background: #fef9c3; color: #a16207; }
    .status-confirmed { background: #dbeafe; color: #1e40af; }
    .status-baking { background: #ede9fe; color: #6d28d9; }
    .status-ready { background: #d1fae5; color: #065f46; }
    .status-delivered { background: #f3f4f6; color: #374151; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .order-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .order-layout { grid-template-columns: 1fr; }
    }

    .card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        background: #fafafa;
    }
    .card-header h3 {
        font-size: 0.875rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
    }
    .card-body { padding: 1rem 1.25rem; }
    .card-body-flush { padding: 0; }

    /* Items table */
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th {
        text-align: left;
        font-size: 0.7rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .items-table th:last-child,
    .items-table td:last-child { text-align: right; }
    .items-table td {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }
    .items-table tr:last-child td { border-bottom: none; }
    .items-table .qty-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.75rem;
        height: 1.75rem;
        border-radius: 0.375rem;
        background: #fef3c7;
        font-size: 0.8rem;
        font-weight: 700;
        color: #92400e;
    }
    .items-table .product-name { font-weight: 600; color: #111827; }
    .items-table .unit-price { color: #9ca3af; font-size: 0.8rem; }
    .items-table .line-total { font-weight: 600; color: #111827; }

    /* Summary rows */
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    .summary-row.border-top { border-top: 1px solid #e5e7eb; }
    .summary-row .label { color: #6b7280; }
    .summary-row .value { font-weight: 600; color: #374151; }
    .summary-row.total {
        padding: 0.75rem 1rem;
        border-top: 2px solid #e5e7eb;
        background: #fafafa;
    }
    .summary-row.total .label { font-weight: 700; color: #111827; font-size: 1rem; }
    .summary-row.total .value { font-weight: 800; color: #059669; font-size: 1.25rem; }

    /* Sidebar info rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.625rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .info-row:last-child { border-bottom: none; }
    .info-row .label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        flex-shrink: 0;
    }
    .info-row .value {
        font-size: 0.875rem;
        color: #111827;
        text-align: right;
        word-break: break-word;
    }
    .info-row .value a {
        color: #2563eb;
        text-decoration: none;
    }
    .info-row .value a:hover { text-decoration: underline; }

    /* Fulfillment badge */
    .fulfillment-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .fulfillment-delivery { background: #dbeafe; color: #1e40af; }
    .fulfillment-pickup { background: #f3f4f6; color: #374151; }

    /* Payment badge */
    .payment-badge {
        display: inline-flex;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .payment-paid { background: #d1fae5; color: #065f46; }
    .payment-refunded { background: #fef9c3; color: #a16207; }
    .payment-cancelled { background: #fee2e2; color: #991b1b; }

    /* Notes */
    .notes-text {
        font-size: 0.875rem;
        color: #374151;
        line-height: 1.5;
        white-space: pre-wrap;
    }
    .notes-empty {
        font-size: 0.875rem;
        color: #d1d5db;
        font-style: italic;
    }

    /* Timeline dot */
    .timeline-dot {
        display: inline-block;
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 9999px;
        margin-right: 0.5rem;
    }
</style>

<div class="order-detail">
    {{-- Header --}}
    <div class="order-header">
        <span class="order-number">{{ $record->order_number }}</span>
        <span class="status-badge status-{{ $record->status }}">{{ ucfirst($record->status) }}</span>
        @if($record->status === 'cancelled' && $record->payment_status)
            <span class="payment-badge payment-{{ $record->payment_status }}">{{ ucfirst($record->payment_status) }}</span>
        @endif
        <span class="order-date">
            Placed {{ $record->created_at->format('M j, Y \a\t g:i A') }}
        </span>
    </div>

    <div class="order-layout">
        {{-- LEFT COLUMN --}}
        <div>
            {{-- Items --}}
            <div class="card">
                <div class="card-header">
                    <h3>Items</h3>
                    <span style="font-size:0.8rem;color:#6b7280;">{{ $record->items->sum('quantity') }} {{ $record->items->sum('quantity') === 1 ? 'item' : 'items' }}</span>
                </div>
                <div class="card-body-flush">
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th style="width:3rem;text-align:center;">Qty</th>
                                <th>Product</th>
                                <th style="width:6rem;">Unit Price</th>
                                <th style="width:6rem;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($record->items as $item)
                                <tr>
                                    <td style="text-align:center;">
                                        <span class="qty-badge">{{ $item->quantity }}</span>
                                    </td>
                                    <td>
                                        <span class="product-name">{{ $item->product_name }}</span>
                                    </td>
                                    <td class="unit-price">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="line-total">${{ number_format($item->line_total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="border-top:1px solid #e5e7eb;">
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="value">${{ number_format($record->subtotal, 2) }}</span>
                        </div>
                        @if($record->fulfillment_type === 'delivery')
                            <div class="summary-row">
                                <span class="label">Delivery Fee</span>
                                <span class="value">${{ number_format($record->delivery_fee, 2) }}</span>
                            </div>
                        @endif
                        <div class="summary-row total">
                            <span class="label">Total</span>
                            <span class="value">${{ number_format($record->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment --}}
            <div class="card">
                <div class="card-header">
                    <h3>Payment</h3>
                    <span class="payment-badge payment-{{ $record->payment_status ?? 'paid' }}">
                        {{ ucfirst($record->payment_status ?? 'paid') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="label">Paid at</span>
                        <span class="value">{{ $record->paid_at?->format('M j, Y g:i A') ?? '—' }}</span>
                    </div>
                    @if($record->stripe_payment_intent)
                        <div class="info-row">
                            <span class="label">PayPal ID</span>
                            <span class="value" style="font-family:monospace;font-size:0.8rem;">{{ $record->stripe_payment_intent }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Notes --}}
            <div class="card">
                <div class="card-header">
                    <h3>Notes</h3>
                </div>
                <div class="card-body">
                    @if($record->notes)
                        <div class="notes-text">{{ $record->notes }}</div>
                    @else
                        <div class="notes-empty">No notes for this order.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div>
            {{-- Customer --}}
            <div class="card">
                <div class="card-header">
                    <h3>Customer</h3>
                </div>
                <div class="card-body">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-weight:700;color:#92400e;font-size:1rem;flex-shrink:0;">
                            {{ strtoupper(substr($record->customer_name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:700;color:#111827;">{{ $record->customer_name }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="label">Email</span>
                        <span class="value"><a href="mailto:{{ $record->customer_email }}">{{ $record->customer_email }}</a></span>
                    </div>
                    @if($record->customer_phone)
                        <div class="info-row">
                            <span class="label">Phone</span>
                            <span class="value"><a href="tel:{{ $record->customer_phone }}">{{ $record->customer_phone }}</a></span>
                        </div>
                    @endif
                    @php
                        $orderCount = \App\Models\Order::where('customer_email', $record->customer_email)->count();
                        $totalSpent = \App\Models\Order::where('customer_email', $record->customer_email)
                            ->whereNotIn('status', ['cancelled'])
                            ->sum('total');
                    @endphp
                    <div class="info-row">
                        <span class="label">Orders</span>
                        <span class="value">{{ $orderCount }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Total Spent</span>
                        <span class="value" style="font-weight:700;color:#059669;">${{ number_format($totalSpent, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Fulfillment --}}
            <div class="card">
                <div class="card-header">
                    <h3>Fulfillment</h3>
                    <span class="fulfillment-badge fulfillment-{{ $record->fulfillment_type }}">
                        @if($record->fulfillment_type === 'delivery')
                            🚗 Delivery
                        @else
                            📦 Pickup
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="label">Date</span>
                        <span class="value">{{ $record->requested_date->format('l, M j, Y') }}</span>
                    </div>
                    @if($record->requested_time)
                        <div class="info-row">
                            <span class="label">Time</span>
                            <span class="value">
                                @if(preg_match('/^\d{1,2}:\d{2}$/', $record->requested_time))
                                    {{ date('g:i A', strtotime($record->requested_time)) }}
                                @else
                                    {{ $record->requested_time }}
                                @endif
                            </span>
                        </div>
                    @endif
                    @if($record->fulfillment_type === 'delivery')
                        <div class="info-row">
                            <span class="label">Address</span>
                            <span class="value">{{ $record->delivery_address }}</span>
                        </div>
                        @if($record->delivery_zip)
                            <div class="info-row">
                                <span class="label">Zip</span>
                                <span class="value">{{ $record->delivery_zip }}</span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Timeline --}}
            <div class="card">
                <div class="card-header">
                    <h3>Timeline</h3>
                </div>
                <div class="card-body">
                    <div style="font-size:0.8rem;color:#6b7280;display:flex;flex-direction:column;gap:0.5rem;">
                        <div>
                            <span class="timeline-dot" style="background:#10b981;"></span>
                            <strong>Ordered</strong> — {{ $record->created_at->format('M j, g:i A') }}
                        </div>
                        @if($record->paid_at)
                            <div>
                                <span class="timeline-dot" style="background:#059669;"></span>
                                <strong>Paid</strong> — {{ $record->paid_at->format('M j, g:i A') }}
                            </div>
                        @endif
                        @if($record->delivered_at)
                            <div>
                                <span class="timeline-dot" style="background:#6b7280;"></span>
                                <strong>Delivered</strong> — {{ $record->delivered_at->format('M j, g:i A') }}
                            </div>
                        @endif
                        @if($record->status === 'cancelled')
                            <div>
                                <span class="timeline-dot" style="background:#ef4444;"></span>
                                <strong>Cancelled</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
