<x-filament-panels::page>
    <style>
        .bs-controls { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .bs-nav-btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; padding: 0.5rem 0.75rem; color: #374151; cursor: pointer; font-size: 1rem; transition: all 0.15s; }
        .bs-nav-btn:hover { background: #f3f4f6; border-color: #9ca3af; }
        .bs-print-btn { display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 0.5rem; background: #92400e; padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: white; border: none; cursor: pointer; margin-left: auto; transition: all 0.15s; }
        .bs-print-btn:hover { background: #78350f; }
        .bs-date-label { font-size: 1.25rem; font-weight: 700; color: #111827; }
        .bs-today-btn { display: inline-flex; align-items: center; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; color: #374151; cursor: pointer; transition: all 0.15s; }
        .bs-today-btn:hover { background: #f3f4f6; }

        /* Progress bar */
        .bs-progress { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; padding: 1rem 1.25rem; border-radius: 0.75rem; background: white; border: 1px solid #e5e7eb; }
        .bs-progress-bar { flex: 1; height: 0.625rem; border-radius: 9999px; background: #f3f4f6; overflow: hidden; display: flex; }
        .bs-progress-seg { height: 100%; transition: width 0.3s; }
        .bs-progress-pending { background: #fbbf24; }
        .bs-progress-confirmed { background: #60a5fa; }
        .bs-progress-baking { background: #a78bfa; }
        .bs-progress-ready { background: #34d399; }
        .bs-progress-delivered { background: #9ca3af; }
        .bs-progress-label { font-size: 0.75rem; color: #6b7280; white-space: nowrap; }
        .bs-progress-legend { display: flex; gap: 1rem; flex-wrap: wrap; }
        .bs-legend-item { display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; color: #4b5563; }
        .bs-legend-dot { width: 0.5rem; height: 0.5rem; border-radius: 9999px; }

        /* Stats */
        .bs-stats { display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.75rem; margin-bottom: 1.5rem; }
        .bs-stat { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; padding: 1rem 1.25rem; text-align: center; transition: all 0.15s; }
        .bs-stat:hover { border-color: #d1d5db; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .bs-stat-label { font-size: 0.65rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; }
        .bs-stat-value { margin-top: 0.25rem; font-size: 2rem; font-weight: 800; color: #111827; line-height: 1; }
        .bs-stat-value.blue { color: #2563eb; }
        .bs-stat-value.amber { color: #d97706; }
        .bs-stat-value.green { color: #059669; }

        /* Cards */
        .bs-card { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; overflow: hidden; margin-bottom: 1.5rem; }
        .bs-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between; }
        .bs-card-header.warm { background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); }
        .bs-card-header.cool { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); }
        .bs-card-header.green { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); }
        .bs-card-title { font-size: 1.125rem; font-weight: 700; color: #111827; }
        .bs-card-subtitle { font-size: 0.8rem; font-weight: 500; color: #6b7280; background: rgba(255,255,255,0.6); padding: 0.25rem 0.625rem; border-radius: 9999px; }

        /* Baking table */
        .bs-table { width: 100%; border-collapse: collapse; }
        .bs-table thead th { padding: 0.75rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #f3f4f6; }
        .bs-table thead th.center { text-align: center; }
        .bs-table tbody td { padding: 0.875rem 1.5rem; vertical-align: middle; }
        .bs-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.1s; }
        .bs-table tbody tr:last-child { border-bottom: none; }
        .bs-table tbody tr:hover { background: #fefce8; }
        .bs-product-name { font-weight: 600; color: #111827; font-size: 0.95rem; }
        .bs-product-category { font-size: 0.75rem; color: #9ca3af; margin-top: 0.125rem; }
        .bs-qty-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 3.25rem; border-radius: 0.5rem; background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 0.5rem 0.875rem; font-size: 1.25rem; font-weight: 800; color: #92400e; box-shadow: 0 1px 2px rgba(146,64,14,0.15); }
        .bs-qty-total { background: linear-gradient(135deg, #292524, #44403c); color: #fef3c7; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
        .bs-order-tag { display: inline-flex; align-items: center; border-radius: 0.375rem; background: #f3f4f6; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; color: #4b5563; margin: 0.125rem; border: 1px solid #e5e7eb; }
        .bs-table tfoot td { padding: 1rem 1.5rem; border-top: 2px solid #e5e7eb; }

        /* Timeline */
        .bs-timeline-slot { padding: 0.75rem 1.5rem; border-bottom: 1px solid #f3f4f6; }
        .bs-timeline-slot:last-child { border-bottom: none; }
        .bs-timeline-time { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 700; color: #111827; margin-bottom: 0.75rem; padding: 0.375rem 0.875rem; background: #f3f4f6; border-radius: 0.5rem; }
        .bs-timeline-time-icon { font-size: 1rem; }

        .bs-order { padding: 0.75rem 1rem; border-radius: 0.625rem; border: 1px solid #e5e7eb; margin-bottom: 0.625rem; transition: all 0.15s; background: #fafafa; }
        .bs-order:last-child { margin-bottom: 0; }
        .bs-order:hover { border-color: #d1d5db; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        .bs-order-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.375rem; }
        .bs-order-badges { display: flex; align-items: center; gap: 0.375rem; flex-wrap: wrap; }
        .bs-order-num { font-weight: 700; color: #111827; font-size: 0.875rem; }
        .bs-badge { display: inline-flex; align-items: center; border-radius: 0.375rem; padding: 0.2rem 0.5rem; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.02em; }
        .bs-badge-pickup { background: #dbeafe; color: #1e40af; }
        .bs-badge-delivery { background: #fef3c7; color: #92400e; }
        .bs-badge-pending { background: #fef9c3; color: #a16207; }
        .bs-badge-confirmed { background: #dbeafe; color: #1e40af; }
        .bs-badge-baking { background: #ede9fe; color: #6d28d9; }
        .bs-badge-ready { background: #d1fae5; color: #065f46; }
        .bs-badge-delivered { background: #f3f4f6; color: #374151; }
        .bs-order-customer { font-size: 0.8rem; color: #6b7280; margin-bottom: 0.375rem; }
        .bs-order-items { display: flex; flex-wrap: wrap; gap: 0.375rem; }
        .bs-item-pill { display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.375rem; background: white; padding: 0.25rem 0.5rem; font-size: 0.8rem; border: 1px solid #e5e7eb; }
        .bs-item-qty { font-weight: 700; color: #92400e; }
        .bs-item-name { color: #374151; }

        /* Upcoming */
        .bs-upcoming { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .bs-upcoming-day { display: flex; flex-direction: column; align-items: center; padding: 0.625rem 1rem; border-radius: 0.5rem; background: #f9fafb; border: 1px solid #e5e7eb; min-width: 4.5rem; cursor: pointer; text-decoration: none; transition: all 0.15s; }
        .bs-upcoming-day:hover { background: #fefce8; border-color: #fbbf24; }
        .bs-upcoming-dayname { font-size: 0.7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; }
        .bs-upcoming-date { font-size: 0.875rem; font-weight: 700; color: #111827; }
        .bs-upcoming-count { font-size: 0.7rem; color: #92400e; font-weight: 600; margin-top: 0.125rem; }

        /* Empty state */
        .bs-empty { border-radius: 0.75rem; border: 2px dashed #d1d5db; background: white; padding: 4rem 2rem; text-align: center; }
        .bs-empty-icon { font-size: 3.5rem; margin-bottom: 1rem; }
        .bs-empty-title { font-size: 1.25rem; font-weight: 600; color: #111827; }
        .bs-empty-subtitle { font-size: 0.875rem; color: #6b7280; margin-top: 0.375rem; }

        @media (max-width: 768px) {
            .bs-stats { grid-template-columns: repeat(2, 1fr); }
        }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header, .bs-controls, .bs-stats, .bs-progress { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            .print-check { display: table-cell !important; }
            body { background: white !important; }
            .bs-card { break-inside: avoid; box-shadow: none; }
            .bs-order { background: white; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid #92400e;">
        <div>
            <div style="font-size: 1.5rem; font-weight: 800; color: #92400e;">🧁 Baking Sheet</div>
            <div style="font-size: 1.125rem; color: #374151; font-weight: 600;">{{ $this->formattedDate }}</div>
        </div>
        <div style="text-align: right; font-size: 0.875rem; color: #666;">
            <div style="font-weight: 700; font-size: 1rem;">{{ $this->stats->total_items }} items</div>
            <div>{{ $this->stats->total_orders }} orders — {{ $this->stats->pickup_count }} pickup, {{ $this->stats->delivery_count }} delivery</div>
        </div>
    </div>

    {{-- Controls --}}
    <div class="bs-controls no-print">
        <button wire:click="previousDay" class="bs-nav-btn">◀</button>
        <input type="date" wire:model.live="date" style="border-radius: 0.5rem; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; font-size: 0.875rem;" />
        <button wire:click="nextDay" class="bs-nav-btn">▶</button>
        @unless($this->isToday)
            <button wire:click="goToToday" class="bs-today-btn">↩ Today</button>
        @endunless
        <span class="bs-date-label">{{ $this->formattedDate }}</span>
        <button onclick="window.print()" class="bs-print-btn">🖨️ Print Baking Sheet</button>
    </div>

    @if($this->bakingItems->isEmpty())
        <div class="bs-empty">
            <div class="bs-empty-icon">🧁</div>
            <div class="bs-empty-title">No orders for this day</div>
            <div class="bs-empty-subtitle">Enjoy the day off! 🎉</div>
        </div>

        @if($this->upcomingDays->isNotEmpty())
            <div class="bs-card no-print" style="margin-top: 1.5rem;">
                <div class="bs-card-header green">
                    <span class="bs-card-title">📅 Upcoming Days with Orders</span>
                </div>
                <div style="padding: 1rem 1.5rem;">
                    <div class="bs-upcoming">
                        @foreach($this->upcomingDays as $day)
                            <a href="?date={{ $day->date->format('Y-m-d') }}" class="bs-upcoming-day" wire:click.prevent="$set('date', '{{ $day->date->format('Y-m-d') }}')">
                                <span class="bs-upcoming-dayname">{{ $day->date->format('D') }}</span>
                                <span class="bs-upcoming-date">{{ $day->date->format('M j') }}</span>
                                <span class="bs-upcoming-count">{{ $day->order_count }} {{ Str::plural('order', $day->order_count) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- Order progress bar --}}
        @php
            $total = $this->stats->total_orders;
            $pPending = $total > 0 ? ($this->stats->pending_count / $total * 100) : 0;
            $pConfirmed = $total > 0 ? ($this->stats->confirmed_count / $total * 100) : 0;
            $pBaking = $total > 0 ? ($this->stats->baking_count / $total * 100) : 0;
            $pReady = $total > 0 ? ($this->stats->ready_count / $total * 100) : 0;
            $pDelivered = $total > 0 ? ($this->stats->delivered_count / $total * 100) : 0;
        @endphp
        <div class="bs-progress no-print">
            <div class="bs-progress-label">Progress</div>
            <div class="bs-progress-bar">
                @if($pDelivered > 0)<div class="bs-progress-seg bs-progress-delivered" style="width: {{ $pDelivered }}%"></div>@endif
                @if($pReady > 0)<div class="bs-progress-seg bs-progress-ready" style="width: {{ $pReady }}%"></div>@endif
                @if($pBaking > 0)<div class="bs-progress-seg bs-progress-baking" style="width: {{ $pBaking }}%"></div>@endif
                @if($pConfirmed > 0)<div class="bs-progress-seg bs-progress-confirmed" style="width: {{ $pConfirmed }}%"></div>@endif
                @if($pPending > 0)<div class="bs-progress-seg bs-progress-pending" style="width: {{ $pPending }}%"></div>@endif
            </div>
            <div class="bs-progress-legend">
                @if($this->stats->pending_count > 0)<span class="bs-legend-item"><span class="bs-legend-dot" style="background:#fbbf24;"></span> {{ $this->stats->pending_count }} Pending</span>@endif
                @if($this->stats->confirmed_count > 0)<span class="bs-legend-item"><span class="bs-legend-dot" style="background:#60a5fa;"></span> {{ $this->stats->confirmed_count }} Confirmed</span>@endif
                @if($this->stats->baking_count > 0)<span class="bs-legend-item"><span class="bs-legend-dot" style="background:#a78bfa;"></span> {{ $this->stats->baking_count }} Baking</span>@endif
                @if($this->stats->ready_count > 0)<span class="bs-legend-item"><span class="bs-legend-dot" style="background:#34d399;"></span> {{ $this->stats->ready_count }} Ready</span>@endif
                @if($this->stats->delivered_count > 0)<span class="bs-legend-item"><span class="bs-legend-dot" style="background:#9ca3af;"></span> {{ $this->stats->delivered_count }} Delivered</span>@endif
            </div>
        </div>

        {{-- Stats --}}
        <div class="bs-stats no-print">
            <div class="bs-stat">
                <div class="bs-stat-label">Orders</div>
                <div class="bs-stat-value">{{ $this->stats->total_orders }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Items to Bake</div>
                <div class="bs-stat-value amber">{{ $this->stats->total_items }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Pickups</div>
                <div class="bs-stat-value blue">{{ $this->stats->pickup_count }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Deliveries</div>
                <div class="bs-stat-value amber">{{ $this->stats->delivery_count }}</div>
            </div>
            <div class="bs-stat">
                <div class="bs-stat-label">Revenue</div>
                <div class="bs-stat-value green">${{ number_format($this->stats->total_revenue, 0) }}</div>
            </div>
        </div>

        {{-- Baking checklist --}}
        <div class="bs-card">
            <div class="bs-card-header warm">
                <span class="bs-card-title">🧁 What to Bake</span>
                <span class="bs-card-subtitle">{{ $this->bakingItems->count() }} products · {{ $this->bakingItems->sum('total_quantity') }} total</span>
            </div>
            <table class="bs-table">
                <thead>
                    <tr>
                        <th class="print-check" style="display: none; width: 40px;"></th>
                        <th>Product</th>
                        <th class="center" style="width: 7rem;">Qty</th>
                        <th>For Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->bakingItems as $item)
                        <tr>
                            <td class="print-check" style="display: none; padding: 0.875rem 0.75rem;"><input type="checkbox" style="width: 18px; height: 18px;" /></td>
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
                        <td style="font-weight: 700; color: #111827;">Total</td>
                        <td style="text-align: center;"><span class="bs-qty-badge bs-qty-total">{{ $this->bakingItems->sum('total_quantity') }}</span></td>
                        <td style="color: #6b7280; font-size: 0.875rem;">across {{ $this->stats->total_orders }} orders</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Order timeline grouped by time --}}
        <div class="bs-card">
            <div class="bs-card-header cool">
                <span class="bs-card-title">📋 Order Timeline</span>
                <span class="bs-card-subtitle">{{ $this->stats->total_orders }} orders by time slot</span>
            </div>
            @foreach($this->timeline as $timeSlot => $orders)
                <div class="bs-timeline-slot">
                    <div class="bs-timeline-time">
                        <span class="bs-timeline-time-icon">🕐</span>
                        {{ $timeSlot }}
                        <span style="font-weight: 400; color: #6b7280; font-size: 0.8rem;">— {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}</span>
                    </div>
                    @foreach($orders as $order)
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
                            </div>
                            <div class="bs-order-customer">👤 {{ $order->customer_name }}@if($order->fulfillment_type === 'delivery' && $order->delivery_address) · 📍 Delivery @endif</div>
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
            @endforeach
        </div>

        {{-- Upcoming days --}}
        @if($this->upcomingDays->isNotEmpty())
            <div class="bs-card no-print">
                <div class="bs-card-header green">
                    <span class="bs-card-title">📅 Coming Up Next</span>
                </div>
                <div style="padding: 1rem 1.5rem;">
                    <div class="bs-upcoming">
                        @foreach($this->upcomingDays as $day)
                            <a href="?date={{ $day->date->format('Y-m-d') }}" class="bs-upcoming-day" wire:click.prevent="$set('date', '{{ $day->date->format('Y-m-d') }}')">
                                <span class="bs-upcoming-dayname">{{ $day->date->format('D') }}</span>
                                <span class="bs-upcoming-date">{{ $day->date->format('M j') }}</span>
                                <span class="bs-upcoming-count">{{ $day->order_count }} {{ Str::plural('order', $day->order_count) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
</x-filament-panels::page>
