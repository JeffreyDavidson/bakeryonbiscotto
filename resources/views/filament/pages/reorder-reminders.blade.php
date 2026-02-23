<x-filament-panels::page>
    @php
        $customers = $this->getCustomers();
        $criticalCount = $customers->where('days_since', '>=', 120)->count();
        $warningCount = $customers->where('days_since', '>=', 90)->where('days_since', '<', 120)->count();
        $mildCount = $customers->where('days_since', '<', 90)->count();
        $totalRevAtRisk = $customers->sum('total_spent');
    @endphp

    {{-- Page banner --}}
    <x-admin.page-banner title="🔔 Customer Reorder Reminders">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <label style="font-size: 0.85rem; color: rgba(255,255,255,0.7);">Inactive for</label>
            <select wire:model.live="threshold" style="padding: 0.4rem 0.75rem; border-radius: 0.5rem; border: 1px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.15); color: white; font-size: 0.85rem; font-weight: 600; cursor: pointer;">
                <option value="30" style="color: #3d2314;">30+ days</option>
                <option value="60" style="color: #3d2314;">60+ days</option>
                <option value="90" style="color: #3d2314;">90+ days</option>
                <option value="120" style="color: #3d2314;">120+ days</option>
            </select>
        </div>
    </x-admin.page-banner>

    @if($customers->isEmpty())
        <x-admin.empty-state
            icon="🎉"
            title="All customers are active!"
            subtitle="No one has been inactive for more than {{ $threshold }} days. Great retention!"
        />
    @else
        {{-- Stats --}}
        <x-admin.stat-grid :cols="4" data-stat-grid>
            <x-admin.stat-card label="Need Outreach" :value="$customers->count()" />
            <x-admin.stat-card label="Critical (120+ days)" :value="$criticalCount" color="#dc2626" />
            <x-admin.stat-card label="Warning (90+ days)" :value="$warningCount" color="#d97706" />
            <x-admin.stat-card label="Revenue at Risk" :value="'$' . number_format($totalRevAtRisk, 0)" color="#8b5e3c" />
        </x-admin.stat-grid>

        {{-- Customer table --}}
        <x-admin.card title="📋 Inactive Customers" :subtitle="$customers->count() . ' ' . Str::plural('customer', $customers->count())">
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th>Customer</th>
                    <th>Last Order</th>
                    <th>Days Inactive</th>
                    <th style="text-align: center;">Orders</th>
                    <th style="text-align: right;">Total Spent</th>
                    <th style="text-align: right;">Action</th>
                </x-slot:head>
                @foreach($customers as $customer)
                    @php
                        $urgency = $customer->days_since >= 120 ? 'cancelled' : ($customer->days_since >= 90 ? 'pending' : 'confirmed');
                    @endphp
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.625rem;">
                                <x-admin.avatar :name="$customer->customer_name" size="sm" />
                                <div>
                                    <div style="font-weight: 600; color: #3d2314;">{{ $customer->customer_name }}</div>
                                    <div style="font-size: 0.75rem; color: #a08060;">{{ $customer->customer_email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color: #6b4c3b;">{{ \Carbon\Carbon::parse($customer->last_order_date)->format('M j, Y') }}</td>
                        <td>
                            <x-admin.badge :type="$urgency" :label="$customer->days_since . ' days'" />
                        </td>
                        <td style="text-align: center; font-weight: 600;">{{ $customer->total_orders }}</td>
                        <td style="text-align: right; font-weight: 700; color: #3d2314;">${{ number_format($customer->total_spent, 2) }}</td>
                        <td style="text-align: right;">
                            @php
                                $subject = rawurlencode('We miss you at Bakery on Biscotto!');
                                $body = rawurlencode("Hi {$customer->customer_name},\n\nIt's been a while since your last visit and we miss you! We've been baking up some amazing new treats and would love to see you again.\n\nVisit us at bakeryonbiscotto.com to place your next order.\n\nWarmly,\nBakery on Biscotto 🍪");
                            @endphp
                            <x-admin.btn variant="primary" :href="'mailto:' . $customer->customer_email . '?subject=' . $subject . '&body=' . $body" icon="✉️" size="sm">
                                Send Reminder
                            </x-admin.btn>
                        </td>
                    </tr>
                @endforeach
            </x-admin.data-table>
        </x-admin.card>
    @endif
</x-filament-panels::page>
