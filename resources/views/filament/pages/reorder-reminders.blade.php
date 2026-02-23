<x-filament-panels::page>
    <style>
        .reorder-select { padding: 0.35rem 0.6rem; border-radius: 0.4rem; border: 1px solid #e8d0b0; background: #fdf8f2; color: #3d2314; font-size: 0.85rem; }
    </style>

    <x-admin.card>
        <div style="background: #3d2314; color: #fdf8f2; padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: 700;">
                🔔 Customer Reorder Reminders
                <x-admin.badge type="default" :label="$this->getCustomers()->count() . ' customers'" rounded style="background:rgba(255,255,255,0.2);color:#fdf8f2;margin-left:0.5rem;font-size:0.85rem;" />
            </h2>
            <div style="display:flex;align-items:center;gap:0.75rem;">
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
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Last Order</th>
                    <th>Days Inactive</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                    <th>Action</th>
                </x-slot:head>
                @foreach($this->getCustomers() as $customer)
                    <tr>
                        <td style="font-weight: 600;">{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ \Carbon\Carbon::parse($customer->last_order_date)->format('M j, Y') }}</td>
                        <td>
                            <x-admin.badge
                                :type="$customer->days_since >= 120 ? 'critical' : ($customer->days_since >= 90 ? 'danger' : 'warn')"
                                :label="$customer->days_since . ' days'"
                                rounded
                            />
                        </td>
                        <td>{{ $customer->total_orders }}</td>
                        <td>${{ number_format($customer->total_spent, 2) }}</td>
                        <td>
                            @php
                                $subject = rawurlencode('We miss you at Bakery on Biscotto!');
                                $body = rawurlencode("Hi {$customer->customer_name},\n\nIt's been a while since your last visit and we miss you! We've been baking up some amazing new treats and would love to see you again.\n\nVisit us at bakeryonbiscotto.com to place your next order.\n\nWarmly,\nBakery on Biscotto 🍪");
                            @endphp
                            <x-admin.action-btn variant="primary" href="mailto:{{ $customer->customer_email }}?subject={{ $subject }}&body={{ $body }}" icon="✉️" style="padding:0.4rem 0.85rem;font-size:0.8rem;">
                                Send Reminder
                            </x-admin.action-btn>
                        </td>
                    </tr>
                @endforeach
            </x-admin.data-table>
        @endif
    </x-admin.card>
</x-filament-panels::page>
