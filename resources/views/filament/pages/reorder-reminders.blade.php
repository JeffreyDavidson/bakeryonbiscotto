<x-filament-panels::page>
    <style>
        .reorder-wrap { font-family: inherit; }
        .reorder-controls { display: flex; align-items: center; gap: 0.75rem; }
        .reorder-select { padding: 0.35rem 0.6rem; border-radius: 0.4rem; border: 1px solid #e8d0b0; background: #fdf8f2; color: #3d2314; font-size: 0.85rem; }
        .reorder-table { width: 100%; border-collapse: collapse; }
        .reorder-table th { background: #6b4c3b; color: #fdf8f2; padding: 0.75rem 1rem; text-align: left; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .reorder-table td { padding: 0.75rem 1rem; border-bottom: 1px solid #e8d0b0; font-size: 0.9rem; color: #3d2314; }
        .reorder-table tr:last-child td { border-bottom: none; }
        .reorder-table tr:hover td { background: #f5ead8; }
        .reorder-badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-warn { background: #f59e0b; color: #fff; }
        .badge-danger { background: #ef4444; color: #fff; }
        .badge-crit { background: #7f1d1d; color: #fff; }
        .reorder-btn { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.85rem; background: #6b4c3b; color: #fdf8f2; border-radius: 0.5rem; font-size: 0.8rem; font-weight: 600; text-decoration: none; transition: background 0.15s; }
        .reorder-btn:hover { background: #3d2314; color: #fdf8f2; }
        .reorder-count { background: rgba(255,255,255,0.2); padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.85rem; margin-left: 0.5rem; }
    </style>

    <div class="reorder-wrap">
        <x-admin.card>
            <div style="background: #3d2314; color: #fdf8f2; padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 1.25rem; font-weight: 700;">
                    🔔 Customer Reorder Reminders
                    <span class="reorder-count">{{ $this->getCustomers()->count() }} customers</span>
                </h2>
                <div class="reorder-controls">
                    <label style="font-size: 0.85rem;">Inactive for</label>
                    <select wire:model.live="threshold" class="reorder-select">
                        <option value="30">30+ days</option>
                        <option value="60">60+ days</option>
                        <option value="90">90+ days</option>
                        <option value="120">120+ days</option>
                    </select>
                </div>
            </div>
            @if($this->getCustomers()->isEmpty())
                <div style="text-align: center; padding: 3rem; color: #6b4c3b; font-size: 1rem;">
                    🎉 All customers have ordered within the last {{ $threshold }} days!
                </div>
            @else
                <table class="reorder-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Last Order</th>
                            <th>Days Inactive</th>
                            <th>Total Orders</th>
                            <th>Total Spent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->getCustomers() as $customer)
                            <tr>
                                <td style="font-weight: 600;">{{ $customer->customer_name }}</td>
                                <td>{{ $customer->customer_email }}</td>
                                <td>{{ \Carbon\Carbon::parse($customer->last_order_date)->format('M j, Y') }}</td>
                                <td>
                                    <span class="reorder-badge {{ $customer->days_since >= 120 ? 'badge-crit' : ($customer->days_since >= 90 ? 'badge-danger' : 'badge-warn') }}">
                                        {{ $customer->days_since }} days
                                    </span>
                                </td>
                                <td>{{ $customer->total_orders }}</td>
                                <td>${{ number_format($customer->total_spent, 2) }}</td>
                                <td>
                                    @php
                                        $subject = rawurlencode('We miss you at Bakery on Biscotto!');
                                        $body = rawurlencode("Hi {$customer->customer_name},\n\nIt's been a while since your last visit and we miss you! We've been baking up some amazing new treats and would love to see you again.\n\nVisit us at bakeryonbiscotto.com to place your next order.\n\nWarmly,\nBakery on Biscotto 🍪");
                                    @endphp
                                    <a href="mailto:{{ $customer->customer_email }}?subject={{ $subject }}&body={{ $body }}" class="reorder-btn">
                                        ✉️ Send Reminder
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </x-admin.card>
    </div>
</x-filament-panels::page>
