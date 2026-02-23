<x-filament-panels::page>
    <style>
        .dp-date-input { padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; background: #fff; font-size: 1rem; color: #3d2314; }
        .dp-date-input:focus { outline: none; border-color: #6b4c3b; box-shadow: 0 0 0 2px rgba(107,76,59,0.15); }
    </style>

    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        {{-- Controls --}}
        <x-admin.card :padding="false">
            <div style="padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <label style="font-weight: 600; color: #3d2314;">Delivery Date:</label>
                <input type="date" wire:model.live="date" class="dp-date-input">
                @if($this->deliveries->count() > 0)
                    <x-admin.action-btn variant="primary" href="{{ $this->optimizedRouteUrl }}" target="_blank" icon="🗺️" style="margin-left: auto;">
                        Optimize Route ({{ $this->deliveries->count() }} stops)
                    </x-admin.action-btn>
                @endif
            </div>
        </x-admin.card>

        {{-- Stats --}}
        <x-admin.stat-grid :cols="2" data-stat-grid>
            <x-admin.stat-card label="Total Deliveries" :value="$this->deliveries->count()" />
            <x-admin.stat-card label="Total Delivery Fees" :value="'$' . number_format($this->totalFees, 2)" />
        </x-admin.stat-grid>

        {{-- Table --}}
        <x-admin.card :title="'📦 Deliveries for ' . \Carbon\Carbon::parse($date)->format('l, M j, Y')">
            @if($this->deliveries->count() > 0)
                <x-admin.data-table data-admin-table>
                    <x-slot:head>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Fee</th>
                        <th>Directions</th>
                    </x-slot:head>
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
                                    <x-admin.action-btn variant="ghost" href="{{ $this->getDirectionsUrl($order->delivery_address) }}" target="_blank" style="font-size:0.8rem;padding:0.3rem 0.6rem;">Get Directions →</x-admin.action-btn>
                                @else —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </x-admin.data-table>
            @else
                <div style="text-align: center; color: #6b4c3b; padding: 3rem;">
                    🚗 No deliveries scheduled for this date.
                </div>
            @endif
        </x-admin.card>
    </div>
</x-filament-panels::page>
