<style>
    .cd-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
    .cd-avatar { width: 2.75rem; height: 2.75rem; border-radius: 9999px; background: linear-gradient(135deg, #92400e, #b45309); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1rem; flex-shrink: 0; }
    .cd-info-line { font-size: 0.85rem; color: #6b7280; }
    .cd-info-line a { color: #2563eb; text-decoration: none; }

    .cd-stats { display: flex; gap: 1rem; margin-bottom: 1.25rem; }
    .cd-stat { flex: 1; text-align: center; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; }
    .cd-stat-val { font-size: 1.25rem; font-weight: 800; color: #111827; }
    .cd-stat-val.green { color: #059669; }
    .cd-stat-lbl { font-size: 0.65rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.125rem; }

    .cd-orders-title { font-size: 0.8rem; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .cd-order-row { display: flex; align-items: center; justify-content: space-between; padding: 0.625rem 0; border-bottom: 1px solid #f3f4f6; font-size: 0.85rem; }
    .cd-order-row:last-child { border-bottom: none; }
    .cd-order-num { font-family: monospace; font-weight: 600; color: #111827; }
    .cd-order-date { color: #9ca3af; font-size: 0.8rem; }
    .cd-badge { display: inline-flex; padding: 0.15rem 0.4rem; border-radius: 0.25rem; font-size: 0.6rem; font-weight: 600; text-transform: uppercase; }
    .cd-badge-pending { background: #fef9c3; color: #a16207; }
    .cd-badge-confirmed { background: #dbeafe; color: #1e40af; }
    .cd-badge-baking { background: #ede9fe; color: #6d28d9; }
    .cd-badge-ready { background: #d1fae5; color: #065f46; }
    .cd-badge-delivered { background: #f3f4f6; color: #374151; }
    .cd-badge-cancelled { background: #fee2e2; color: #991b1b; }
    .cd-order-total { font-weight: 700; color: #111827; }
</style>

<div>
    <div class="cd-header">
        <div class="cd-avatar">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</div>
        <div>
            <div class="cd-info-line"><a href="mailto:{{ $customer->customer_email }}">{{ $customer->customer_email }}</a></div>
            @if($customer->customer_phone)
                <div class="cd-info-line">{{ $customer->customer_phone }}</div>
            @endif
            <div class="cd-info-line" style="font-size:0.75rem;color:#9ca3af;">
                Since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }}
            </div>
        </div>
    </div>

    <div class="cd-stats">
        <div class="cd-stat">
            <div class="cd-stat-val">{{ $customer->orders_count }}</div>
            <div class="cd-stat-lbl">Orders</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-val green">${{ number_format($customer->total_spent, 2) }}</div>
            <div class="cd-stat-lbl">Total Spent</div>
        </div>
    </div>

    <div class="cd-orders-title">Orders</div>
    @foreach($orders as $order)
        <div class="cd-order-row">
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <span class="cd-order-num">{{ $order->order_number }}</span>
                <span class="cd-badge cd-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                <span class="cd-order-date">{{ $order->created_at->format('M j, Y') }}</span>
            </div>
            <span class="cd-order-total">${{ number_format($order->total, 2) }}</span>
        </div>
    @endforeach
</div>
