<div style="background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%;">
    {{-- Customer card --}}
    <x-admin.card>
        <div data-admin-gradient-header style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.5rem;">
            <x-admin.avatar :name="$customer->customer_name" />
            <div style="flex:1;">
                <div data-header-title style="font-weight: 700; font-size: 1rem; color: white;">{{ $customer->customer_name }}</div>
                <div style="font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }} · Last order {{ $orders->first()?->created_at->diffForHumans() ?? 'N/A' }}</div>
            </div>
            <x-admin.btn variant="primary" href="mailto:{{ $customer->customer_email }}" icon="✉️" style="padding: 0.4rem 0.875rem; font-size: 0.75rem;">Email</x-admin.btn>
        </div>
        <div style="padding: 0.875rem 1.25rem;">
            <x-admin.info-row label="Email" :value="$customer->customer_email" :href="'mailto:' . $customer->customer_email" />
            @if($customer->customer_phone)
                <x-admin.info-row label="Phone" :value="$customer->customer_phone" :href="'tel:' . $customer->customer_phone" />
            @endif
        </div>
    </x-admin.card>

    {{-- Stats --}}
    <x-admin.stat-grid :cols="3" data-stat-grid>
        <x-admin.stat-card :label="Str::plural('Order', $customer->orders_count)" :value="$customer->orders_count" />
        <x-admin.stat-card label="Total Spent" :value="'$' . number_format($customer->total_spent, 2)" />
        <x-admin.stat-card label="Avg Order" :value="'$' . number_format($stats->avg_order_value, 2)" />
    </x-admin.stat-grid>

    {{-- Orders --}}
    <x-admin.card title="Order History" :subtitle="(string) $orders->count()">
        <x-admin.data-table data-admin-table>
            <x-slot:head>
                <th>Order</th>
                <th>Status</th>
                <th>Type</th>
                <th>Date</th>
                <th style="text-align:right;">Total</th>
                <th style="width:3.5rem;"></th>
            </x-slot:head>
            @foreach($orders as $order)
                <tr>
                    <td style="font-family:monospace;font-weight:700;color:#3d2314;">{{ $order->order_number }}</td>
                    <td><x-admin.badge :type="$order->status" /></td>
                    <td><x-admin.badge :type="$order->fulfillment_type" /></td>
                    <td style="color:#a08060;font-size:0.8rem;">{{ $order->created_at->format('M j, Y') }}</td>
                    <td style="text-align:right;font-weight:700;color:#3d2314;">${{ number_format($order->total, 2) }}</td>
                    <td style="text-align:right;"><x-admin.btn variant="ghost" href="/admin/orders/{{ $order->id }}" style="padding:0.3rem 0.625rem;font-size:0.7rem;">View</x-admin.btn></td>
                </tr>
            @endforeach
        </x-admin.data-table>
    </x-admin.card>
</div>
