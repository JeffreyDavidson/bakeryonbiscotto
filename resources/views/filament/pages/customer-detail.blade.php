<style>
    .cd-wrap { background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%; }

    /* Customer card */
    .cd-card { border: 1px solid #e8d0b0; border-radius: 0.75rem; overflow: hidden; margin-bottom: 1rem; background: white; }
    .cd-card-banner { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b); }
    .cd-avatar { width: 2.75rem; height: 2.75rem; border-radius: 9999px; background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0; }
    .cd-card-banner .cd-name { font-weight: 700; font-size: 1rem; color: white; }
    .cd-card-banner .cd-since { font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem; }
    .cd-card-body { padding: 0.875rem 1.25rem; }
    .cd-detail-row { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; }
    .cd-detail-row:last-child { border-bottom: none; }
    .cd-detail-label { font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.05em; }
    .cd-detail-value { color: #3d2314; font-weight: 500; }
    .cd-detail-value a { color: #8b5e3c; text-decoration: none; font-weight: 600; }
    .cd-detail-value a:hover { text-decoration: underline; }

    /* Email button */
    .cd-email-btn { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.4rem 0.875rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; background: linear-gradient(135deg, #8b5e3c, #6b4c3b); color: white; border: none; }
    .cd-email-btn:hover { opacity: 0.9; }

    /* Stats */
    .cd-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1rem; }
    .cd-stat { text-align: center; padding: 1rem 0.5rem; border-radius: 0.625rem; background: white; border: 1px solid #e8d0b0; }
    .cd-stat-val { font-size: 1.5rem; font-weight: 800; color: #3d2314; line-height: 1; }
    .cd-stat-lbl { font-size: 0.6rem; font-weight: 700; color: #a08060; text-transform: uppercase; letter-spacing: 0.075em; margin-top: 0.375rem; }

    /* Orders table */
    .cd-orders-card { border: 1px solid #e8d0b0; border-radius: 0.75rem; overflow: hidden; background: white; }
    .cd-orders-header { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b); }
    .cd-orders-title { font-size: 0.8rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.05em; }
    .cd-count { font-size: 0.7rem; font-weight: 700; color: #3d2314; background: #fef3c7; padding: 0.15rem 0.5rem; border-radius: 9999px; }

    .cd-table { width: 100%; border-collapse: collapse; }
    .cd-table th { text-align: left; font-size: 0.65rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.625rem 0.75rem; border-bottom: 1px solid #e8d0b0; background: #fdf8f2; }
    .cd-table td { padding: 0.75rem 0.75rem; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; color: #4a3225; vertical-align: middle; }
    .cd-table tr:last-child td { border-bottom: none; }
    .cd-table tr:hover td { background: #fdf8f2; }
    .cd-table .order-num { font-family: monospace; font-weight: 700; color: #3d2314; }
    .cd-table .total { font-weight: 700; color: #3d2314; }

    .cd-badge { display: inline-flex; padding: 0.2rem 0.5rem; border-radius: 9999px; font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; }
    .cd-badge-pending { background: #fef3c7; color: #92400e; }
    .cd-badge-confirmed { background: #e8d0b0; color: #3d2314; }
    .cd-badge-baking { background: #fde68a; color: #78350f; }
    .cd-badge-ready { background: #d1fae5; color: #065f46; }
    .cd-badge-delivered { background: #f3ebe0; color: #6b4c3b; }
    .cd-badge-cancelled { background: #fee2e2; color: #991b1b; }

    .cd-view-btn { display: inline-flex; align-items: center; padding: 0.3rem 0.625rem; border-radius: 0.375rem; font-size: 0.7rem; font-weight: 600; color: #6b4c3b; background: #fdf8f2; text-decoration: none; border: 1px solid #e8d0b0; }
    .cd-view-btn:hover { background: #f5e6d0; }
</style>

<div class="cd-wrap">
    {{-- Customer card --}}
    <div class="cd-card">
        <div class="cd-card-banner">
            <div class="cd-avatar">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</div>
            <div style="flex:1;">
                <div class="cd-name">{{ $customer->customer_name }}</div>
                <div class="cd-since">Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }} · Last order {{ $orders->first()?->created_at->diffForHumans() ?? 'N/A' }}</div>
            </div>
            <a href="mailto:{{ $customer->customer_email }}" class="cd-email-btn">✉️ Email</a>
        </div>
        <div class="cd-card-body">
            <div class="cd-detail-row">
                <span class="cd-detail-label">Email</span>
                <span class="cd-detail-value"><a href="mailto:{{ $customer->customer_email }}">{{ $customer->customer_email }}</a></span>
            </div>
            @if($customer->customer_phone)
                <div class="cd-detail-row">
                    <span class="cd-detail-label">Phone</span>
                    <span class="cd-detail-value"><a href="tel:{{ $customer->customer_phone }}">{{ $customer->customer_phone }}</a></span>
                </div>
            @endif
        </div>
    </div>

    {{-- Stats --}}
    <div class="cd-stats">
        <div class="cd-stat">
            <div class="cd-stat-val">{{ $customer->orders_count }}</div>
            <div class="cd-stat-lbl">{{ Str::plural('Order', $customer->orders_count) }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-val">${{ number_format($customer->total_spent, 2) }}</div>
            <div class="cd-stat-lbl">Total Spent</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-val">${{ number_format($stats->avg_order_value, 2) }}</div>
            <div class="cd-stat-lbl">Avg Order</div>
        </div>
    </div>

    {{-- Orders --}}
    <div class="cd-orders-card">
        <div class="cd-orders-header">
            <span class="cd-orders-title">Order History</span>
            <span class="cd-count">{{ $orders->count() }}</span>
        </div>
        <table class="cd-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th style="text-align:right;">Total</th>
                    <th style="width:3.5rem;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="order-num">{{ $order->order_number }}</td>
                        <td><span class="cd-badge cd-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td><span class="cd-badge cd-badge-{{ $order->fulfillment_type === 'delivery' ? 'confirmed' : 'delivered' }}">{{ ucfirst($order->fulfillment_type) }}</span></td>
                        <td style="color:#a08060;font-size:0.8rem;">{{ $order->created_at->format('M j, Y') }}</td>
                        <td class="total" style="text-align:right;">${{ number_format($order->total, 2) }}</td>
                        <td style="text-align:right;"><a href="/admin/orders/{{ $order->id }}" class="cd-view-btn">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
