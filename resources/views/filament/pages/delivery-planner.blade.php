<x-filament-panels::page>
    <style>
        .dp-card { background: #fdf8f2; border: 1px solid #e8d0b0; border-radius: 12px; overflow: hidden; }
        .dp-header { background: #3d2314; color: #fdf8f2; padding: 1rem 1.5rem; font-size: 1.1rem; font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
        .dp-body { padding: 1.5rem; }
        .dp-date-input { padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; background: #fff; font-size: 1rem; color: #3d2314; }
        .dp-date-input:focus { outline: none; border-color: #6b4c3b; box-shadow: 0 0 0 2px rgba(107,76,59,0.15); }
        .dp-table { width: 100%; border-collapse: collapse; }
        .dp-table th { text-align: left; padding: 0.75rem 1rem; background: #6b4c3b; color: #fdf8f2; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .dp-table td { padding: 0.75rem 1rem; border-bottom: 1px solid #e8d0b0; font-size: 0.9rem; color: #3d2314; }
        .dp-table tr:hover td { background: rgba(232,208,176,0.2); }
        .dp-badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize; }
        .dp-badge-pending { background: #fef3c7; color: #92400e; }
        .dp-badge-confirmed { background: #dbeafe; color: #1e40af; }
        .dp-badge-baking { background: #e8d0b0; color: #3d2314; }
        .dp-badge-ready { background: #d1fae5; color: #065f46; }
        .dp-badge-delivered { background: #e5e7eb; color: #374151; }
        .dp-badge-cancelled { background: #fee2e2; color: #991b1b; }
        .dp-link { color: #6b4c3b; text-decoration: underline; font-weight: 600; font-size: 0.85rem; }
        .dp-link:hover { color: #3d2314; }
        .dp-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.2rem; border-radius: 8px; background: #6b4c3b; color: #fdf8f2; font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: background 0.15s; }
        .dp-btn:hover { background: #3d2314; color: #fdf8f2; }
        .dp-stat { text-align: center; }
        .dp-stat-value { font-size: 1.5rem; font-weight: 700; color: #3d2314; }
        .dp-stat-label { font-size: 0.8rem; color: #6b4c3b; text-transform: uppercase; letter-spacing: 0.05em; }
    </style>

    <div class="space-y-6">
        {{-- Controls --}}
        <div class="dp-card">
            <div class="dp-body" style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <label style="font-weight: 600; color: #3d2314;">Delivery Date:</label>
                <input type="date" wire:model.live="date" class="dp-date-input">

                @if($this->deliveries->count() > 0)
                    <a href="{{ $this->optimizedRouteUrl }}" target="_blank" class="dp-btn" style="margin-left: auto;">
                        🗺️ Optimize Route ({{ $this->deliveries->count() }} stops)
                    </a>
                @endif
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="dp-card">
                <div class="dp-body dp-stat">
                    <div class="dp-stat-value">{{ $this->deliveries->count() }}</div>
                    <div class="dp-stat-label">Total Deliveries</div>
                </div>
            </div>
            <div class="dp-card">
                <div class="dp-body dp-stat">
                    <div class="dp-stat-value">${{ number_format($this->totalFees, 2) }}</div>
                    <div class="dp-stat-label">Total Delivery Fees</div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="dp-card">
            <div class="dp-header">
                📦 Deliveries for {{ \Carbon\Carbon::parse($date)->format('l, M j, Y') }}
            </div>
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
                                    <td>
                                        <span class="dp-badge dp-badge-{{ $order->status }}">{{ $order->status }}</span>
                                    </td>
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
                <div class="dp-body" style="text-align: center; color: #6b4c3b; padding: 3rem;">
                    🚗 No deliveries scheduled for this date.
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
