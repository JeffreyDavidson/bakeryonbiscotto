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
        <div style="display: flex; align-items: center; gap: 0.625rem;">
            <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Inactive for</span>
            <select wire:model.live="threshold" style="appearance: none; -webkit-appearance: none; padding: 0.4rem 2rem 0.4rem 0.875rem; border-radius: 9999px; border: 1px solid rgba(255,255,255,0.25); background: rgba(255,255,255,0.15) url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22white%22 stroke-width=%222.5%22><polyline points=%226 9 12 15 18 9%22/></svg>') no-repeat right 0.625rem center; background-size: 0.75rem; color: white; font-size: 0.8rem; font-weight: 600; cursor: pointer; min-width: 7rem;">
                <option value="30" style="color: #3d2314; background: white;">30+ days</option>
                <option value="60" style="color: #3d2314; background: white;">60+ days</option>
                <option value="90" style="color: #3d2314; background: white;">90+ days</option>
                <option value="120" style="color: #3d2314; background: white;">120+ days</option>
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
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Customer</th>
                        <th style="text-align: left; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Last Order</th>
                        <th style="text-align: left; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Days Inactive</th>
                        <th style="text-align: center; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Orders</th>
                        <th style="text-align: right; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Total Spent</th>
                        <th style="text-align: right; padding: 0.75rem 1rem; background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; border-bottom: 2px solid #d4a574;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        @php
                            $urgency = $customer->days_since >= 120 ? 'cancelled' : ($customer->days_since >= 90 ? 'pending' : 'confirmed');
                        @endphp
                        <tr style="border-bottom: 1px solid #f3ebe0;" onmouseover="this.style.background='rgba(245,230,208,0.3)'" onmouseout="this.style.background='none'">
                            <td style="padding: 0.75rem 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.625rem;">
                                    <x-admin.avatar :name="$customer->customer_name" size="sm" />
                                    <div>
                                        <div style="font-weight: 600; color: #3d2314; font-size: 0.875rem;">{{ $customer->customer_name }}</div>
                                        <div style="font-size: 0.75rem; color: #a08060;">{{ $customer->customer_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 0.75rem 1rem; color: #3d2314; font-size: 0.85rem;">{{ \Carbon\Carbon::parse($customer->last_order_date)->format('M j, Y') }}</td>
                            <td style="padding: 0.75rem 1rem;">
                                <x-admin.badge :type="$urgency" :label="$customer->days_since . ' days'" />
                            </td>
                            <td style="padding: 0.75rem 1rem; text-align: center; font-weight: 600; color: #3d2314;">{{ $customer->total_orders }}</td>
                            <td style="padding: 0.75rem 1rem; text-align: right; font-weight: 700; color: #3d2314;">${{ number_format($customer->total_spent, 2) }}</td>
                            <td style="padding: 0.75rem 1rem; text-align: right;">
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
                </tbody>
            </table>
        </x-admin.card>
    @endif
</x-filament-panels::page>
