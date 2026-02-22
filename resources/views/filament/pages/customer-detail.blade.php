<style>
    .cd-contact { display: flex; gap: 1rem; padding: 1rem 1.25rem; background: #f9fafb; border-radius: 0.75rem; margin-bottom: 1rem; align-items: center; }
    .cd-avatar { width: 3rem; height: 3rem; border-radius: 9999px; background: linear-gradient(135deg, #92400e, #b45309); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0; }
    .cd-contact-info { flex: 1; }
    .cd-contact-row { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #374151; margin-bottom: 0.25rem; }
    .cd-contact-row:last-child { margin-bottom: 0; }
    .cd-contact-icon { font-size: 0.875rem; width: 1.25rem; text-align: center; }
    .cd-contact-since { font-size: 0.75rem; color: #9ca3af; }

    .cd-kpis { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1.5rem; }
    .cd-kpi { text-align: center; padding: 1rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; }
    .cd-kpi-value { font-size: 1.75rem; font-weight: 800; line-height: 1; }
    .cd-kpi-value.green { color: #059669; }
    .cd-kpi-value.blue { color: #2563eb; }
    .cd-kpi-value.amber { color: #d97706; }
    .cd-kpi-label { font-size: 0.7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.375rem; }
    .cd-kpi-sub { font-size: 0.75rem; color: #6b7280; margin-top: 0.125rem; }

    .cd-divider { height: 2px; background: linear-gradient(to right, #e5e7eb, transparent); margin-bottom: 1rem; }
    .cd-section-title { font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
    .cd-section-count { font-size: 0.75rem; font-weight: 600; color: #6b7280; background: #f3f4f6; padding: 0.125rem 0.5rem; border-radius: 9999px; }

    .cd-order { border: 1px solid #e5e7eb; border-radius: 0.625rem; margin-bottom: 0.625rem; overflow: hidden; transition: all 0.15s; }
    .cd-order:hover { border-color: #d1d5db; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
    .cd-order:last-child { margin-bottom: 0; }
    .cd-order-top { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; background: white; }
    .cd-order-left { display: flex; align-items: center; gap: 0.5rem; }
    .cd-order-num { font-family: monospace; font-size: 0.8rem; font-weight: 700; color: #111827; }
    .cd-order-date { font-size: 0.8rem; color: #9ca3af; }
    .cd-order-total { font-size: 1rem; font-weight: 700; color: #111827; }

    .cd-badge { display: inline-flex; align-items: center; border-radius: 0.375rem; padding: 0.2rem 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
    .cd-badge-pending { background: #fef9c3; color: #a16207; }
    .cd-badge-confirmed { background: #dbeafe; color: #1e40af; }
    .cd-badge-baking { background: #ede9fe; color: #6d28d9; }
    .cd-badge-ready { background: #d1fae5; color: #065f46; }
    .cd-badge-delivered { background: #f3f4f6; color: #374151; }
    .cd-badge-cancelled { background: #fee2e2; color: #991b1b; }
    .cd-badge-pickup { background: #dbeafe; color: #1e40af; }
    .cd-badge-delivery { background: #fef3c7; color: #92400e; }

    .cd-order-items { display: flex; flex-wrap: wrap; gap: 0.375rem; padding: 0.625rem 1rem; background: #fafafa; border-top: 1px solid #f3f4f6; }
    .cd-item { display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.375rem; background: white; padding: 0.25rem 0.5rem; font-size: 0.8rem; border: 1px solid #e5e7eb; }
    .cd-item-qty { font-weight: 700; color: #92400e; }
    .cd-item-name { color: #374151; }

    .cd-empty { text-align: center; color: #9ca3af; padding: 2rem; font-size: 0.875rem; }
    .cd-close-btn { display: block; width: 100%; margin-top: 1.5rem; padding: 0.625rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; color: #374151; font-size: 0.875rem; font-weight: 500; cursor: pointer; text-align: center; transition: all 0.15s; }
    .cd-close-btn:hover { background: #f3f4f6; }
</style>

<div>
    {{-- Contact card --}}
    <div class="cd-contact">
        <div class="cd-avatar">
            {{ strtoupper(substr($customer->customer_name, 0, 1)) }}
        </div>
        <div class="cd-contact-info">
            <div class="cd-contact-row">
                <span class="cd-contact-icon">✉️</span>
                {{ $customer->customer_email }}
            </div>
            <div class="cd-contact-row">
                <span class="cd-contact-icon">📱</span>
                {{ $customer->customer_phone ?? '—' }}
            </div>
            <div class="cd-contact-since">
                Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }}
                · {{ \Carbon\Carbon::parse($stats->first_order_date)->diffForHumans(null, false, false, 1) }}
            </div>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="cd-kpis">
        <div class="cd-kpi">
            <div class="cd-kpi-value blue">{{ $customer->orders_count }}</div>
            <div class="cd-kpi-label">{{ Str::plural('Order', $customer->orders_count) }}</div>
        </div>
        <div class="cd-kpi">
            <div class="cd-kpi-value green">${{ number_format($customer->total_spent, 2) }}</div>
            <div class="cd-kpi-label">Total Spent</div>
        </div>
        <div class="cd-kpi">
            <div class="cd-kpi-value amber">${{ number_format($stats->avg_order_value, 2) }}</div>
            <div class="cd-kpi-label">Avg Order</div>
        </div>
    </div>

    {{-- Order history --}}
    <div class="cd-divider"></div>
    <div class="cd-section-title">
        📦 Order History
        <span class="cd-section-count">{{ $orders->count() }}</span>
    </div>

    @forelse($orders as $order)
        <div class="cd-order">
            <div class="cd-order-top">
                <div class="cd-order-left">
                    <span class="cd-order-num">{{ $order->order_number }}</span>
                    <span class="cd-badge cd-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    <span class="cd-badge cd-badge-{{ $order->fulfillment_type }}">{{ ucfirst($order->fulfillment_type) }}</span>
                    <span class="cd-order-date">{{ $order->created_at->format('M j, Y') }}</span>
                </div>
                <span class="cd-order-total">${{ number_format($order->total, 2) }}</span>
            </div>
            @if($order->items->count())
                <div class="cd-order-items">
                    @foreach($order->items as $item)
                        <span class="cd-item">
                            <span class="cd-item-qty">{{ $item->quantity }}×</span>
                            <span class="cd-item-name">{{ $item->product_name }}</span>
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="cd-empty">No orders found.</div>
    @endforelse
</div>
