<style>
    .cd-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; padding: 1.25rem; background: #f9fafb; border-radius: 0.75rem; margin-bottom: 1.5rem; }
    .cd-stat { }
    .cd-stat-label { font-size: 0.7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; }
    .cd-stat-value { font-size: 1rem; font-weight: 600; color: #111827; margin-top: 0.125rem; }
    .cd-stat-value.big { font-size: 1.5rem; font-weight: 800; }
    .cd-stat-value.green { color: #059669; }
    .cd-stat-value.blue { color: #2563eb; }

    .cd-section-title { font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: 0.75rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e5e7eb; }

    .cd-order { border: 1px solid #e5e7eb; border-radius: 0.625rem; padding: 1rem; margin-bottom: 0.75rem; transition: all 0.15s; background: white; }
    .cd-order:hover { border-color: #d1d5db; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
    .cd-order:last-child { margin-bottom: 0; }
    .cd-order-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem; }
    .cd-order-left { display: flex; align-items: center; gap: 0.5rem; }
    .cd-order-num { font-family: monospace; font-size: 0.875rem; font-weight: 700; color: #111827; }
    .cd-order-date { font-size: 0.8rem; color: #6b7280; }
    .cd-order-right { display: flex; align-items: center; gap: 0.75rem; }
    .cd-order-total { font-size: 1rem; font-weight: 700; color: #111827; }

    .cd-badge { display: inline-flex; align-items: center; border-radius: 0.375rem; padding: 0.2rem 0.5rem; font-size: 0.7rem; font-weight: 600; }
    .cd-badge-pending { background: #fef9c3; color: #a16207; }
    .cd-badge-confirmed { background: #dbeafe; color: #1e40af; }
    .cd-badge-baking { background: #ede9fe; color: #6d28d9; }
    .cd-badge-ready { background: #d1fae5; color: #065f46; }
    .cd-badge-delivered { background: #f3f4f6; color: #374151; }
    .cd-badge-cancelled { background: #fee2e2; color: #991b1b; }

    .cd-items { display: flex; flex-wrap: wrap; gap: 0.375rem; }
    .cd-item { display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.375rem; background: #f3f4f6; padding: 0.25rem 0.5rem; font-size: 0.8rem; }
    .cd-item-qty { font-weight: 700; color: #92400e; }
    .cd-item-name { color: #374151; }
</style>

<div>
    {{-- Customer stats --}}
    <div class="cd-grid">
        <div class="cd-stat">
            <div class="cd-stat-label">Email</div>
            <div class="cd-stat-value">{{ $customer->customer_email }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">Phone</div>
            <div class="cd-stat-value">{{ $customer->customer_phone ?? '—' }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">Customer Since</div>
            <div class="cd-stat-value">{{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">Total Orders</div>
            <div class="cd-stat-value big blue">{{ $customer->orders_count }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">Total Spent</div>
            <div class="cd-stat-value big green">${{ number_format($customer->total_spent, 2) }}</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">Avg Order Value</div>
            <div class="cd-stat-value big">${{ number_format($stats->avg_order_value, 2) }}</div>
        </div>
    </div>

    {{-- Order history --}}
    <div class="cd-section-title">📦 Order History ({{ $orders->count() }})</div>
    @forelse($orders as $order)
        <div class="cd-order">
            <div class="cd-order-header">
                <div class="cd-order-left">
                    <span class="cd-order-num">{{ $order->order_number }}</span>
                    <span class="cd-badge cd-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    <span class="cd-order-date">{{ $order->created_at->format('M j, Y') }}</span>
                </div>
                <div class="cd-order-right">
                    <span class="cd-order-total">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
            @if($order->items->count())
                <div class="cd-items">
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
        <div style="text-align: center; color: #9ca3af; padding: 2rem;">No orders found.</div>
    @endforelse
</div>
