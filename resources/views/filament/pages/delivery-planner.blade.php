<x-filament-panels::page>
    <style>
        .dp-date-input { padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; background: #fff; font-size: 1rem; color: #3d2314; }
        .dp-date-input:focus { outline: none; border-color: #6b4c3b; box-shadow: 0 0 0 2px rgba(107,76,59,0.15); }
        .dp-table { width: 100%; border-collapse: collapse; }
        .dp-table th { text-align: left; padding: 0.75rem 1rem; background: #6b4c3b; color: #fdf8f2; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .dp-table td { padding: 0.75rem 1rem; border-bottom: 1px solid #e8d0b0; font-size: 0.9rem; color: #3d2314; }
        .dp-table tr:hover td { background: rgba(232,208,176,0.2); }
        .dp-link { color: #6b4c3b; text-decoration: underline; font-weight: 600; font-size: 0.85rem; }
        .dp-link:hover { color: #3d2314; }
        .dp-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.2rem; border-radius: 8px; background: #6b4c3b; color: #fdf8f2; font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: background 0.15s; }
        .dp-btn:hover { background: #3d2314; color: #fdf8f2; }
    </style>

    <div class="space-y-6">
        {{-- Controls --}}
        <x-admin.card>
            <div style="padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <label style="font-weight: 600; color: #3d2314;">Delivery Date:</label>
                <input type="date" wire:model.live="date" class="dp-date-input">
                @if($this->deliveries->count() > 0)
                    <a href="{{ $this->optimizedRouteUrl }}" target="_blank" class="dp-btn" style="margin-left: auto;">
                        🗺️ Optimize Route ({{ $this->deliveries->count() }} stops)
                    </a>
                @endif
            </div>
        </x-admin.card>

        {{-- Stats --}}
        <div class="grid grid-cols-2 gap-4">
            <x-admin.stat-card label="Total Deliveries" :value="$this->deliveries->count()" />
            <x-admin.stat-card label="Total Delivery Fees" :value="'$' . number_format($this->totalFees, 2)" />
        </div>

        {{-- Table --}}
        <x-admin.card :title="'📦 Deliveries for ' . \Carbon\Carbon::parse($date)->format('l, M j, Y')">
            @if($this->deliveries->count() > 0)
                <div style="overflow-x: auto;">
                    <table class="dp-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Fee</th>
                                <th>Directions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->deliveries as $order)
                                <tr>
                                    <td style="font-weight: 600;">{{ $order->order_number }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td style="max-width: 250px;">{{ $order->delivery_address }}</td>
                                    <td>{{ $order->requested_time ?? '—' }}</td>
                                    <td><x-admin.badge :type="$order->status" /></td>
                                    <td>${{ number_format($order->delivery_fee, 2) }}</td>
                                    <td>
                                        @if($order->delivery_address)
                                            <a href="{{ $this->getDirectionsUrl($order->delivery_address) }}" target="_blank" class="dp-link">Get Directions →</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; color: #6b4c3b; padding: 3rem;">
                    🚗 No deliveries scheduled for this date.
                </div>
            @endif
        </x-admin.card>
    </div>
</x-filament-panels::page>
