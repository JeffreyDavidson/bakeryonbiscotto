<style>
    .cd-header { display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 0.75rem; margin-bottom: 1rem; }
    .cd-avatar { width: 3rem; height: 3rem; border-radius: 9999px; background: linear-gradient(135deg, #92400e, #b45309); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0; }
    .cd-name { font-weight: 700; font-size: 1rem; color: #111827; margin-bottom: 0.125rem; }
    .cd-info-line { font-size: 0.825rem; color: #6b7280; line-height: 1.4; }
    .cd-info-line a { color: #2563eb; text-decoration: none; }
    .cd-info-line a:hover { text-decoration: underline; }
    .cd-since { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }
    .cd-actions { display: flex; gap: 0.5rem; margin-left: auto; }
    .cd-btn { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.4rem 0.75rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; border: 1px solid #d1d5db; color: #374151; background: white; cursor: pointer; }
    .cd-btn:hover { background: #f3f4f6; }

    .cd-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1.25rem; }
    .cd-stat { text-align: center; padding: 0.875rem 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.625rem; background: white; }
    .cd-stat-val { font-size: 1.5rem; font-weight: 800; color: #111827; line-height: 1; }
    .cd-stat-val.green { color: #059669; }
    .cd-stat-val.amber { color: #d97706; }
    .cd-stat-lbl { font-size: 0.65rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.375rem; }

    .cd-table { width: 100%; border-collapse: collapse; }
    .cd-table th { text-align: left; font-size: 0.7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.625rem 0.5rem; border-bottom: 2px solid #e5e7eb; }
    .cd-table th:last-child { text-align: right; }
    .cd-table td { padding: 0.75rem 0.5rem; border-bottom: 1px solid #f3f4f6; font-size: 0.85rem; color: #374151; vertical-align: middle; }
    .cd-table tr:hover { background: #fafafa; }
    .cd-table .order-num { font-family: monospace; font-weight: 700; color: #111827; }
    .cd-table .total { font-weight: 700; color: #111827; text-align: right; }

    .cd-badge { display: inline-flex; padding: 0.2rem 0.5rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.025em; }
    .cd-badge-pending { background: #fef9c3; color: #a16207; }
    .cd-badge-confirmed { background: #dbeafe; color: #1e40af; }
    .cd-badge-baking { background: #ede9fe; color: #6d28d9; }
    .cd-badge-ready { background: #d1fae5; color: #065f46; }
    .cd-badge-delivered { background: #f3f4f6; color: #374151; }
    .cd-badge-cancelled { background: #fee2e2; color: #991b1b; }

    .cd-view-btn { display: inline-flex; align-items: center; padding: 0.3rem 0.625rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #2563eb; background: #eff6ff; text-decoration: none; border: 1px solid #bfdbfe; }
    .cd-view-btn:hover { background: #dbeafe; }

    .cd-section-title { font-size: 0.8rem; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.625rem; display: flex; align-items: center; gap: 0.5rem; }
    .cd-count { font-size: 0.7rem; font-weight: 600; color: white; background: #6b7280; padding: 0.1rem 0.4rem; border-radius: 9999px; }
</style>

<div>
    {{-- Contact card --}}
    <div class="cd-header">
        <div class="cd-avatar">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</div>
        <div style="flex:1;">
            <div class="cd-info-line"><a href="mailto:{{ $customer->customer_email }}">{{ $customer->customer_email }}</a></div>
            @if($customer->customer_phone)
                <div class="cd-info-line"><a href="tel:{{ $customer->customer_phone }}">{{ $customer->customer_phone }}</a></div>
            @endif
            <div class="cd-since">Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }}</div>
        </div>
        <div class="cd-actions">
            <a href="mailto:{{ $customer->customer_email }}" class="cd-btn">✉️ Email</a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="cd-stats">
        <div class="cd-stat">
            <div class="cd-stat-val">{{ $customer->orders_count }}</div>
            <div class="cd-stat-lbl">{{ Str::plural('Order', $customer->orders_count) }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-val green">${{ number_format($customer->total_spent, 2) }}</div>
            <div class="cd-stat-lbl">Total Spent</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-val amber">${{ number_format($stats->avg_order_value, 2) }}</div>
            <div class="cd-stat-lbl">Avg Order</div>
        </div>
    </div>

    {{-- Orders table --}}
    <div class="cd-section-title">Order History <span class="cd-count">{{ $orders->count() }}</span></div>
    <table class="cd-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align:right;">Total</th>
                <th style="width:4rem;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="order-num">{{ $order->order_number }}</td>
                    <td><span class="cd-badge cd-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td style="color:#9ca3af;">{{ $order->created_at->format('M j, Y') }}</td>
                    <td class="total">${{ number_format($order->total, 2) }}</td>
                    <td style="text-align:right;"><a href="/admin/orders/{{ $order->id }}" class="cd-view-btn">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
