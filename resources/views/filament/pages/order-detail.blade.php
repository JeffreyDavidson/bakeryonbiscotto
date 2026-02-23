<style>
    .order-detail { font-family: inherit; }
    .order-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .order-layout { grid-template-columns: 1fr; }
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3ebe0;
        background: #fdf8f2;
    }
    .card-header h3 {
        font-size: 0.875rem;
        font-weight: 700;
        color: #4a3225;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
    }
    .card-body { padding: 1rem 1.25rem; }
    .card-body-flush { padding: 0; }

    /* Items table */
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th {
        text-align: left; font-size: 0.7rem; font-weight: 600; color: #a08060;
        text-transform: uppercase; letter-spacing: 0.05em; padding: 0.75rem 1rem;
        background: #fdf8f2; border-bottom: 1px solid #e5e7eb;
    }
    .items-table th:last-child, .items-table td:last-child { text-align: right; }
    .items-table td { padding: 0.75rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; }
    .items-table tr:last-child td { border-bottom: none; }
    .items-table .qty-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 1.75rem; height: 1.75rem; border-radius: 0.375rem; background: #fef3c7; font-size: 0.8rem; font-weight: 700; color: #92400e; }
    .items-table .product-name { font-weight: 600; color: #3d2314; }
    .items-table .unit-price { color: #9ca3af; font-size: 0.8rem; }
    .items-table .line-total { font-weight: 600; color: #111827; }

    /* Summary rows */
    .summary-row { display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-size: 0.875rem; }
    .summary-row .label { color: #a08060; }
    .summary-row .value { font-weight: 600; color: #3d2314; }
    .summary-row.total { padding: 0.75rem 1rem; border-top: 2px solid #e8d0b0; background: #fdf8f2; }
    .summary-row.total .label { font-weight: 700; color: #3d2314; font-size: 1rem; }
    .summary-row.total .value { font-weight: 800; color: #8b5e3c; font-size: 1.25rem; }

    /* Sidebar info rows */
    .info-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 0.625rem 0; border-bottom: 1px solid #f3ebe0; }
    .info-row:last-child { border-bottom: none; }
    .info-row .label { font-size: 0.75rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.025em; flex-shrink: 0; }
    .info-row .value { font-size: 0.875rem; color: #3d2314; text-align: right; word-break: break-word; }
    .info-row .value a { color: #8b5e3c; text-decoration: none; }
    .info-row .value a:hover { text-decoration: underline; }

    /* Status badge (pill variant for header) */
    .status-badge { display: inline-flex; align-items: center; padding: 0.375rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-confirmed { background: #e8d0b0; color: #3d2314; }
    .status-baking { background: #fde68a; color: #78350f; }
    .status-ready { background: #d1fae5; color: #065f46; }
    .status-delivered { background: #f3ebe0; color: #6b4c3b; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    /* Fulfillment badge */
    .fulfillment-badge { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
    .fulfillment-delivery { background: #e8d0b0; color: #3d2314; }
    .fulfillment-pickup { background: #fdf8f2; color: #6b4c3b; }

    /* Payment badge */
    .payment-badge { display: inline-flex; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
    .payment-paid { background: #d1fae5; color: #065f46; }
    .payment-refunded { background: #fef9c3; color: #a16207; }
    .payment-cancelled { background: #fee2e2; color: #991b1b; }

    .notes-text { font-size: 0.875rem; color: #4a3225; line-height: 1.5; white-space: pre-wrap; }
    .notes-empty { font-size: 0.875rem; color: #d1d5db; font-style: italic; }
    .timeline-dot { display: inline-block; width: 0.5rem; height: 0.5rem; border-radius: 9999px; margin-right: 0.5rem; }
</style>

<div class="order-detail">
    {{-- Header --}}
    <x-admin.page-banner title="">
        <x-slot:title>
            <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap; width: 100%;">
                <div>
                    <span style="font-size: 0.65rem; font-weight: 600; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.1em; display: block;">Order</span>
                    <span style="font-family: monospace; font-size: 1.375rem; font-weight: 800; color: white; letter-spacing: 0.05em;">{{ $record->order_number }}</span>
                </div>
                <div style="margin-left: auto; text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 0.375rem;">
                    <span class="status-badge status-{{ $record->status }}">{{ ucfirst($record->status) }}</span>
                    @if($record->status === 'cancelled' && $record->payment_status)
                        <span class="payment-badge payment-{{ $record->payment_status }}">{{ ucfirst($record->payment_status) }}</span>
                    @endif
                    <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">
                        Placed {{ $record->created_at->format('M j, Y \a\t g:i A') }}
                    </span>
                </div>
            </div>
        </x-slot:title>
    </x-admin.page-banner>

    <div class="order-layout">
        {{-- LEFT COLUMN --}}
        <div>
            {{-- Items --}}
            <x-admin.card>
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
                                    <td style="text-align:center;"><span class="qty-badge">{{ $item->quantity }}</span></td>
                                    <td><span class="product-name">{{ $item->product_name }}</span></td>
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
            </x-admin.card>

            {{-- Payment --}}
            <x-admin.card>
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
            </x-admin.card>

            {{-- Notes --}}
            <x-admin.card>
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
            </x-admin.card>
        </div>

        {{-- RIGHT COLUMN --}}
        <div>
            {{-- Customer --}}
            <x-admin.card>
                <div class="card-header">
                    <h3>Customer</h3>
                </div>
                <div class="card-body">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:linear-gradient(135deg,#8b5e3c,#6b4c3b);display:flex;align-items:center;justify-content:center;font-weight:700;color:white;font-size:1rem;flex-shrink:0;">
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
            </x-admin.card>

            {{-- Fulfillment --}}
            <x-admin.card>
                <div class="card-header">
                    <h3>Fulfillment</h3>
                    <span class="fulfillment-badge fulfillment-{{ $record->fulfillment_type }}">
                        @if($record->fulfillment_type === 'delivery') 🚗 Delivery @else 📦 Pickup @endif
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
            </x-admin.card>

            {{-- Timeline --}}
            <x-admin.card>
                <div class="card-header">
                    <h3>Timeline</h3>
                </div>
                <div class="card-body">
                    <div style="font-size:0.8rem;color:#6b7280;display:flex;flex-direction:column;gap:0.5rem;">
                        <div>
                            <span class="timeline-dot" style="background:#8b5e3c;"></span>
                            <strong>Ordered</strong> — {{ $record->created_at->format('M j, g:i A') }}
                        </div>
                        @if($record->paid_at)
                            <div>
                                <span class="timeline-dot" style="background:#8b5e3c;"></span>
                                <strong>Paid</strong> — {{ $record->paid_at->format('M j, g:i A') }}
                            </div>
                        @endif
                        @if($record->delivered_at)
                            <div>
                                <span class="timeline-dot" style="background:#6b4c3b;"></span>
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
            </x-admin.card>

            {{-- Activity / Notes --}}
            <x-admin.card>
                <div class="card-header">
                    <h3>Activity Log</h3>
                    <span style="font-size:0.75rem;color:#a08060;">{{ $record->notes->count() }} {{ $record->notes->count() === 1 ? 'entry' : 'entries' }}</span>
                </div>
                <div class="card-body">
                    @if($record->notes->count() > 0)
                        <div style="display:flex;flex-direction:column;gap:0;">
                            @foreach($record->notes->sortByDesc('created_at') as $note)
                                <div style="position:relative;padding-left:1.5rem;padding-bottom:1rem;border-left:2px solid #e8d0b0;margin-left:0.25rem;">
                                    <div style="position:absolute;left:-0.4375rem;top:0.125rem;width:0.75rem;height:0.75rem;border-radius:9999px;border:2px solid {{ $note->type === 'status_change' ? '#8b5e3c' : ($note->type === 'system' ? '#9ca3af' : '#6b4c3b') }};background:{{ $note->type === 'status_change' ? '#fef3c7' : ($note->type === 'system' ? '#f3f4f6' : '#fdf8f2') }};"></div>
                                    <div style="margin-left:0.5rem;">
                                        @if($note->type === 'status_change')
                                            <span style="display:inline-block;padding:0.125rem 0.5rem;border-radius:9999px;background:#fef3c7;color:#92400e;font-size:0.675rem;font-weight:600;text-transform:uppercase;letter-spacing:0.025em;margin-bottom:0.25rem;">Status Change</span>
                                        @elseif($note->type === 'system')
                                            <span style="display:inline-block;padding:0.125rem 0.5rem;border-radius:9999px;background:#f3f4f6;color:#6b7280;font-size:0.675rem;font-weight:600;text-transform:uppercase;letter-spacing:0.025em;margin-bottom:0.25rem;">System</span>
                                        @endif
                                        <div style="font-size:0.8125rem;color:#3d2314;line-height:1.4;">{{ $note->content }}</div>
                                        <div style="font-size:0.7rem;color:#a08060;margin-top:0.25rem;">
                                            {{ $note->user?->name ?? 'System' }} · {{ $note->created_at->format('M j, g:i A') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="font-size:0.8rem;color:#d1d5db;font-style:italic;">No activity yet.</div>
                    @endif
                </div>
            </x-admin.card>
        </div>
    </div>
</div>
