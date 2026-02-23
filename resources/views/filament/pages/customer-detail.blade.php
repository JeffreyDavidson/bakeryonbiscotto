<style>
    .cd-wrap { background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%; }
    .cd-card-body { padding: 0.875rem 1.25rem; }
    .cd-detail-row { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; }
    .cd-detail-row:last-child { border-bottom: none; }
    .cd-detail-label { font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.05em; }
    .cd-detail-value { color: #3d2314; font-weight: 500; }
    .cd-detail-value a { color: #8b5e3c; text-decoration: none; font-weight: 600; }
    .cd-detail-value a:hover { text-decoration: underline; }
    .cd-email-btn { display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.4rem 0.875rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; background: linear-gradient(135deg, #8b5e3c, #6b4c3b); color: white; border: none; }
    .cd-email-btn:hover { opacity: 0.9; }
    .cd-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1rem; }
    .cd-table { width: 100%; border-collapse: collapse; }
    .cd-table th { text-align: left; font-size: 0.65rem; font-weight: 600; color: #a08060; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.625rem 0.75rem; border-bottom: 1px solid #e8d0b0; background: #fdf8f2; }
    .cd-table td { padding: 0.75rem 0.75rem; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; color: #4a3225; vertical-align: middle; }
    .cd-table tr:last-child td { border-bottom: none; }
    .cd-table tr:hover td { background: #fdf8f2; }
    .cd-table .order-num { font-family: monospace; font-weight: 700; color: #3d2314; }
    .cd-table .total { font-weight: 700; color: #3d2314; }
    .cd-view-btn { display: inline-flex; align-items: center; padding: 0.3rem 0.625rem; border-radius: 0.375rem; font-size: 0.7rem; font-weight: 600; color: #6b4c3b; background: #fdf8f2; text-decoration: none; border: 1px solid #e8d0b0; }
    .cd-view-btn:hover { background: #f5e6d0; }
</style>

<div class="cd-wrap">
    {{-- Customer card --}}
    <x-admin.card>
        <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b);">
            <div style="width: 2.75rem; height: 2.75rem; border-radius: 9999px; background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0;">{{ strtoupper(substr($customer->customer_name, 0, 1)) }}</div>
            <div style="flex:1;">
                <div style="font-weight: 700; font-size: 1rem; color: white;">{{ $customer->customer_name }}</div>
                <div style="font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }} · Last order {{ $orders->first()?->created_at->diffForHumans() ?? 'N/A' }}</div>
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
    </x-admin.card>

    {{-- Stats --}}
    <div class="cd-stats">
        <x-admin.stat-card :label="Str::plural('Order', $customer->orders_count)" :value="$customer->orders_count" />
        <x-admin.stat-card label="Total Spent" :value="'$' . number_format($customer->total_spent, 2)" />
        <x-admin.stat-card label="Avg Order" :value="'$' . number_format($stats->avg_order_value, 2)" />
    </div>

    {{-- Orders --}}
    <x-admin.card>
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b);">
            <span style="font-size: 0.8rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.05em;">Order History</span>
            <span style="font-size: 0.7rem; font-weight: 700; color: #3d2314; background: #fef3c7; padding: 0.15rem 0.5rem; border-radius: 9999px;">{{ $orders->count() }}</span>
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
                        <td><x-admin.badge :type="$order->status" /></td>
                        <td><x-admin.badge :type="$order->fulfillment_type" /></td>
                        <td style="color:#a08060;font-size:0.8rem;">{{ $order->created_at->format('M j, Y') }}</td>
                        <td class="total" style="text-align:right;">${{ number_format($order->total, 2) }}</td>
                        <td style="text-align:right;"><a href="/admin/orders/{{ $order->id }}" class="cd-view-btn">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-admin.card>
</div>
