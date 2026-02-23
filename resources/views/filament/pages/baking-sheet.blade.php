<x-filament-panels::page>
    <style>
        .bs-controls { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; }

        /* Baking table extras */
        .bs-product-name { font-weight: 600; color: #3d2314; font-size: 0.95rem; }

        /* Timeline slot */
        .bs-timeline-slot { padding: 0.75rem 1.5rem; border-bottom: 1px solid #f3f4f6; }
        .bs-timeline-slot:last-child { border-bottom: none; }
        .bs-timeline-time { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 700; color: #3d2314; margin-bottom: 0.75rem; padding: 0.375rem 0.875rem; background: #fdf8f2; border: 1px solid #e8d0b0; border-radius: 0.5rem; }

        /* Upcoming days */
        .bs-upcoming { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .bs-upcoming-day { display: flex; flex-direction: column; align-items: center; padding: 0.625rem 1rem; border-radius: 0.5rem; background: #fdf8f2; border: 1px solid #e8d0b0; min-width: 4.5rem; cursor: pointer; text-decoration: none; transition: all 0.15s; }
        .bs-upcoming-day:hover { background: #f5e6d0; border-color: #d4a574; }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header, .bs-controls { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            .print-check { display: table-cell !important; }
            body { background: white !important; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid #92400e;">
        <div>
            <div style="font-size: 1.5rem; font-weight: 800; color: #3d2314;">🧁 Baking Sheet</div>
            <div style="font-size: 1.125rem; color: #374151; font-weight: 600;">{{ $this->formattedDate }}</div>
        </div>
        <div style="text-align: right; font-size: 0.875rem; color: #666;">
            <div style="font-weight: 700; font-size: 1rem;">{{ $this->stats->total_items }} items</div>
            <div>{{ $this->stats->total_orders }} orders — {{ $this->stats->pickup_count }} pickup, {{ $this->stats->delivery_count }} delivery</div>
        </div>
    </div>

    {{-- Controls --}}
    <div class="bs-controls no-print">
        <x-admin.btn variant="secondary" wire:click="previousDay">◀</x-admin.btn>
        <input type="date" wire:model.live="date" style="border-radius: 0.5rem; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; font-size: 0.875rem;" />
        <x-admin.btn variant="secondary" wire:click="nextDay">▶</x-admin.btn>
        @unless($this->isToday)
            <x-admin.btn variant="ghost" wire:click="goToToday">↩ Today</x-admin.btn>
        @endunless
        <span style="font-size: 1.25rem; font-weight: 700; color: #3d2314;">{{ $this->formattedDate }}</span>
        <x-admin.btn variant="primary" size="lg" onclick="window.print()" icon="🖨️" style="margin-left: auto;">Print Baking Sheet</x-admin.btn>
    </div>

    @if($this->bakingItems->isEmpty())
        <x-admin.empty-state icon="🧁" title="No orders for this day" subtitle="Enjoy the day off! 🎉" />

        @if($this->upcomingDays->isNotEmpty())
            <x-admin.card title="📅 Upcoming Days with Orders" class="no-print" style="margin-top: 1.5rem;">
                <div style="padding: 1rem 1.5rem;">
                    <div class="bs-upcoming">
                        @foreach($this->upcomingDays as $day)
                            <a href="?date={{ $day->date->format('Y-m-d') }}" class="bs-upcoming-day" wire:click.prevent="$set('date', '{{ $day->date->format('Y-m-d') }}')">
                                <span style="font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase;">{{ $day->date->format('D') }}</span>
                                <span style="font-size: 0.875rem; font-weight: 700; color: #3d2314;">{{ $day->date->format('M j') }}</span>
                                <span style="font-size: 0.7rem; color: #8b5e3c; font-weight: 600; margin-top: 0.125rem;">{{ $day->order_count }} {{ Str::plural('order', $day->order_count) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </x-admin.card>
        @endif
    @else
        {{-- Order progress bar --}}
        @php
            $total = $this->stats->total_orders;
            $segments = [
                ['percent' => $total > 0 ? $this->stats->delivered_count / $total * 100 : 0, 'color' => '#3d2314', 'count' => $this->stats->delivered_count, 'label' => 'Delivered'],
                ['percent' => $total > 0 ? $this->stats->ready_count / $total * 100 : 0, 'color' => '#34d399', 'count' => $this->stats->ready_count, 'label' => 'Ready'],
                ['percent' => $total > 0 ? $this->stats->baking_count / $total * 100 : 0, 'color' => '#6b4c3b', 'count' => $this->stats->baking_count, 'label' => 'Baking'],
                ['percent' => $total > 0 ? $this->stats->confirmed_count / $total * 100 : 0, 'color' => '#8b5e3c', 'count' => $this->stats->confirmed_count, 'label' => 'Confirmed'],
                ['percent' => $total > 0 ? $this->stats->pending_count / $total * 100 : 0, 'color' => '#d4a574', 'count' => $this->stats->pending_count, 'label' => 'Pending'],
            ];
        @endphp
        <x-admin.progress-bar :segments="$segments" label="Progress" class="no-print" />

        {{-- Stats --}}
        <x-admin.stat-grid :cols="5" class="no-print">
            <x-admin.stat-card label="Orders" :value="$this->stats->total_orders" />
            <x-admin.stat-card label="Items to Bake" :value="$this->stats->total_items" color="#6b4c3b" />
            <x-admin.stat-card label="Pickups" :value="$this->stats->pickup_count" color="#8b5e3c" />
            <x-admin.stat-card label="Deliveries" :value="$this->stats->delivery_count" color="#6b4c3b" />
            <x-admin.stat-card label="Revenue" :value="'$' . number_format($this->stats->total_revenue, 0)" color="#8b5e3c" />
        </x-admin.stat-grid>

        {{-- Baking checklist --}}
        <x-admin.card title="🧁 What to Bake" :subtitle="$this->bakingItems->count() . ' products · ' . $this->bakingItems->sum('total_quantity') . ' total'">
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th class="print-check" style="display: none; width: 40px;"></th>
                    <th>Product</th>
                    <th style="text-align: center; width: 7rem;">Qty</th>
                    <th>For Orders</th>
                </x-slot:head>
                @foreach($this->bakingItems as $item)
                    <tr>
                        <td class="print-check" style="display: none; padding: 0.875rem 0.75rem;"><input type="checkbox" style="width: 18px; height: 18px;" /></td>
                        <td><span class="bs-product-name">{{ $item->product_name }}</span></td>
                        <td style="text-align: center;"><x-admin.pill color="amber" size="lg">{{ $item->total_quantity }}</x-admin.pill></td>
                        <td>
                            @foreach($item->order_numbers as $num)
                                <x-admin.pill color="brown">{{ $num }}</x-admin.pill>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                <x-slot:foot>
                    <tr>
                        <td class="print-check" style="display: none;"></td>
                        <td style="font-weight: 700; color: #111827; padding: 1rem;">Total</td>
                        <td style="text-align: center; padding: 1rem;"><x-admin.pill color="dark" size="lg">{{ $this->bakingItems->sum('total_quantity') }}</x-admin.pill></td>
                        <td style="color: #6b7280; font-size: 0.875rem; padding: 1rem;">across {{ $this->stats->total_orders }} orders</td>
                    </tr>
                </x-slot:foot>
            </x-admin.data-table>
        </x-admin.card>

        {{-- Order timeline grouped by time --}}
        <x-admin.card title="🕐 Today's Schedule" :subtitle="$this->stats->total_orders . ' orders by time slot'">
            @foreach($this->timeline as $timeSlot => $orders)
                <div class="bs-timeline-slot">
                    <div class="bs-timeline-time">
                        <span>🕐</span>
                        {{ $timeSlot }}
                        <span style="font-weight: 400; color: #6b7280; font-size: 0.8rem;">— {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}</span>
                    </div>
                    @foreach($orders as $order)
                        <x-admin.order-card :order="$order" />
                    @endforeach
                </div>
            @endforeach
        </x-admin.card>

        {{-- Upcoming days --}}
        @if($this->upcomingDays->isNotEmpty())
            <x-admin.card title="📅 Coming Up Next" class="no-print">
                <div style="padding: 1rem 1.5rem;">
                    <div class="bs-upcoming">
                        @foreach($this->upcomingDays as $day)
                            <a href="?date={{ $day->date->format('Y-m-d') }}" class="bs-upcoming-day" wire:click.prevent="$set('date', '{{ $day->date->format('Y-m-d') }}')">
                                <span style="font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase;">{{ $day->date->format('D') }}</span>
                                <span style="font-size: 0.875rem; font-weight: 700; color: #3d2314;">{{ $day->date->format('M j') }}</span>
                                <span style="font-size: 0.7rem; color: #8b5e3c; font-weight: 600; margin-top: 0.125rem;">{{ $day->order_count }} {{ Str::plural('order', $day->order_count) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </x-admin.card>
        @endif
    @endif
</x-filament-panels::page>
