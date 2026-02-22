<x-filament-panels::page>
    <style>
        .bs-controls { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .bs-nav-btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; padding: 0.5rem; color: #374151; cursor: pointer; }
        .bs-nav-btn:hover { background: #f9fafb; }
        .bs-print-btn { display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 0.5rem; background: #dc8a29; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 600; color: white; border: none; cursor: pointer; margin-left: auto; }
        .bs-print-btn:hover { background: #c77b24; }
        .bs-date-label { font-size: 1.125rem; font-weight: 600; color: #111827; }
        .bs-today-btn { display: inline-flex; align-items: center; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; padding: 0.5rem 0.75rem; font-size: 0.875rem; font-weight: 500; color: #374151; cursor: pointer; }

        .bs-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .bs-stat { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; padding: 1rem 1.25rem; }
        .bs-stat-label { font-size: 0.7rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; }
        .bs-stat-value { margin-top: 0.25rem; font-size: 1.75rem; font-weight: 700; color: #111827; }
        .bs-stat-value.blue { color: #2563eb; }
        .bs-stat-value.amber { color: #d97706; }

        .bs-card { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; overflow: hidden; margin-bottom: 1.5rem; }
        .bs-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; }
        .bs-card-header.warm { background: linear-gradient(to right, #fffbeb, #fff7ed); }
        .bs-card-header.cool { background: linear-gradient(to right, #eff6ff, #eef2ff); }
        .bs-card-title { font-size: 1.125rem; font-weight: 700; color: #111827; }
        .bs-card-subtitle { font-size: 0.875rem; font-weight: 400; color: #6b7280; }

        .bs-table { width: 100%; border-collapse: collapse; }
        .bs-table thead th { padding: 0.75rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f3f4f6; }
        .bs-table thead th.center { text-align: center; }
        .bs-table tbody td { padding: 1rem 1.5rem; }
        .bs-table tbody tr { border-bottom: 1px solid #f3f4f6; }
        .bs-table tbody tr:hover { background: #f9fafb; }
        .bs-product-name { font-weight: 600; color: #111827; font-size: 1rem; }
        .bs-qty-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 3rem; border-radius: 9999px; background: #fef3c7; padding: 0.375rem 0.75rem; font-size: 1.125rem; font-weight: 700; color: #92400e; }
        .bs-qty-total { background: #292524; color: white; }
        .bs-order-tag { display: inline-flex; align-items: center; border-radius: 0.375rem; background: #f3f4f6; padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 500; color: #4b5563; margin: 0.125rem; }
        .bs-table tfoot td { padding: 1rem 1.5rem; border-top: 2px solid #e5e7eb; font-weight: 700; color: #111827; }
        .bs-table tfoot td.center { text-align: center; }

        .bs-order { padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; }
        .bs-order:last-child { border-bottom: none; }
        .bs-order:hover { background: #f9fafb; }
        .bs-order-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 0.5rem; }
        .bs-order-badges { display: flex; align-items: center; gap: 0.5rem; }
        .bs-order-num { font-weight: 700; color: #111827; }
        .bs-badge { display: inline-flex; align-items: center; border-radius: 0.375rem; padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 500; }
        .bs-badge-pickup { background: #eff6ff; color: #1d4ed8; }
        .bs-badge-delivery { background: #fffbeb; color: #b45309; }
        .bs-badge-pending { background: #fefce8; color: #a16207; }
        .bs-badge-confirmed { background: #eff6ff; color: #1d4ed8; }
        .bs-badge-baking { background: #faf5ff; color: #7c3aed; }
        .bs-badge-ready { background: #f0fdf4; color: #15803d; }
        .bs-badge-delivered { background: #f3f4f6; color: #374151; }
        .bs-order-time { font-size: 0.875rem; font-weight: 600; color: #374151; }
        .bs-order-customer { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem; }
        .bs-order-items { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .bs-item-pill { display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.5rem; background: #f3f4f6; padding: 0.375rem 0.625rem; font-size: 0.875rem; }
        .bs-item-qty { font-weight: 700; color: #92400e; }
        .bs-item-name { color: #374151; }

        .bs-empty { border-radius: 0.75rem; border: 2px dashed #d1d5db; background: white; padding: 3rem; text-align: center; }
        .bs-empty-icon { font-size: 3rem; margin-bottom: 1rem; }
        .bs-empty-title { font-size: 1.125rem; font-weight: 500; color: #111827; }
        .bs-empty-subtitle { font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header, .bs-controls, .bs-stats { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            .print-check { display: table-cell !important; }
            body { background: white !important; }
            .bs-card { break-inside: avoid; box-shadow: none; border: 1px solid #ccc; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #333;">
        <div>
            <div style="font-size: 1.5rem; font-weight: 700;">🧁 Baking Sheet</div>
            <div style="color: #666;">{{ $this->formattedDate }}</div>
        </div>
        <div style="text-align: right; font-size: 0.875rem; color: #666;">
            <div>{{ $this->stats->total_orders }} orders · {{ $this->stats->total_items }} items</div>
            <div>{{ $this->stats->pickup_count }} pickup · {{ $this->stats->delivery_count }} delivery</div>
        </div>
    </div>

    {{-- Controls --}}
    <div class="bs-controls no-print">
        <button wire:click="previousDay" class="bs-nav-btn">◀</button>
        <input type="date" wire:model.live="date" style="border-radius: 0.5rem; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem;" />
        <button wire:click="nextDay" class="bs-nav-btn">▶</button>
        @unless($this->isToday)
            <button wire:click="goToToday" class="bs-today-btn">Today</button>
        @endunless
        <span class="bs-date-label">{{ $this->formattedDate }}</span>
        <button onclick="window.print()" class="bs-print-btn">🖨️ Print</button>
    </div>

    @if($this->bakingItems->isEmpty())
        <div class="bs-empty">
            <div class="bs-empty-icon">🧁</div>
            <div class="bs-empty-title">No orders for this day</div>
            <div class="bs-empty-subtitle">Enjoy the day off! 🎉</div>
        </div>
    @else
        {{-- Stats --}}
        <div class="bs-stats no-print">
            <div class="bs-stat">
                <div class="bs-stat-label">Orders</div>
                <div class="bs-stat-value">{{ $this->stats->total_orders }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Total Items</div>
                <div class="bs-stat-value">{{ $this->stats->total_items }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Pickups</div>
                <div class="bs-stat-value blue">{{ $this->stats->pickup_count }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Deliveries</div>
                <div class="bs-stat-value amber">{{ $this->stats->delivery_count }}</div>
            </div>
        </div>

        {{-- Baking checklist --}}
        <div class="bs-card">
            <div class="bs-card-header warm">
                <span class="bs-card-title">🧁 What to Bake</span>
                <span class="bs-card-subtitle">({{ $this->bakingItems->count() }} products)</span>
            </div>
            <table class="bs-table">
                <thead>
                    <tr>
                        <th class="print-check" style="display: none; width: 40px;"></th>
                        <th>Product</th>
                        <th class="center" style="width: 7rem;">Quantity</th>
                        <th>Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->bakingItems as $item)
                        <tr>
                            <td class="print-check" style="display: none;"><input type="checkbox" style="width: 18px; height: 18px;" /></td>
                            <td><span class="bs-product-name">{{ $item->product_name }}</span></td>
                            <td style="text-align: center;"><span class="bs-qty-badge">{{ $item->total_quantity }}</span></td>
                            <td>
                                @foreach($item->order_numbers as $num)
                                    <span class="bs-order-tag">{{ $num }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="print-check" style="display: none;"></td>
                        <td>Total</td>
                        <td class="center"><span class="bs-qty-badge bs-qty-total">{{ $this->bakingItems->sum('total_quantity') }}</span></td>
                        <td style="font-weight: 400; color: #6b7280;">{{ $this->stats->total_orders }} orders</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Order details --}}
        <div class="bs-card">
            <div class="bs-card-header cool">
                <span class="bs-card-title">📋 Order Details</span>
                <span class="bs-card-subtitle">(by pickup/delivery time)</span>
            </div>
            @foreach($this->orders as $order)
                <div class="bs-order">
                    <div class="bs-order-header">
                        <div class="bs-order-badges">
                            <span class="bs-order-num">{{ $order->order_number }}</span>
                            <span class="bs-badge {{ $order->fulfillment_type === 'delivery' ? 'bs-badge-delivery' : 'bs-badge-pickup' }}">
                                {{ ucfirst($order->fulfillment_type) }}
                            </span>
                            <span class="bs-badge bs-badge-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <span class="bs-order-time">{{ $order->requested_time ?? 'No time set' }}</span>
                    </div>
                    <div class="bs-order-customer">
                        👤 {{ $order->customer_name }}
                    </div>
                    <div class="bs-order-items">
                        @foreach($order->items as $item)
                            <span class="bs-item-pill">
                                <span class="bs-item-qty">{{ $item->quantity }}×</span>
                                <span class="bs-item-name">{{ $item->product_name }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>
