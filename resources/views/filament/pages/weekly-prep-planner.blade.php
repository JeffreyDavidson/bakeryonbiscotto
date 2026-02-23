<x-filament-panels::page>
    <style>
        .prep-wrap { font-family: inherit; }
        .prep-header { background: #3d2314; color: #fdf8f2; padding: 1.25rem 1.5rem; border-radius: 0.75rem 0.75rem 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.75rem; }
        .prep-header h2 { margin: 0; font-size: 1.25rem; font-weight: 700; }
        .prep-nav { display: flex; align-items: center; gap: 0.5rem; }
        .prep-nav-btn { padding: 0.4rem 0.85rem; background: rgba(255,255,255,0.15); color: #fdf8f2; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.4rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: background 0.15s; }
        .prep-nav-btn:hover { background: rgba(255,255,255,0.25); }
        .prep-body { background: #fdf8f2; border: 2px solid #e8d0b0; border-top: 0; border-radius: 0 0 0.75rem 0.75rem; padding: 1.5rem; }
        .prep-section { margin-bottom: 1.5rem; }
        .prep-section-title { background: #6b4c3b; color: #fdf8f2; padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 700; margin-bottom: 0.75rem; }
        .prep-agg { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem; }
        .prep-agg-item { background: #fff; border: 2px solid #e8d0b0; border-radius: 0.5rem; padding: 0.5rem 0.85rem; font-size: 0.85rem; color: #3d2314; }
        .prep-agg-item strong { color: #6b4c3b; }
        .prep-day { margin-bottom: 1.25rem; }
        .prep-day-header { background: #e8d0b0; color: #3d2314; padding: 0.5rem 1rem; border-radius: 0.4rem; font-weight: 700; font-size: 0.9rem; margin-bottom: 0.5rem; display: flex; justify-content: space-between; }
        .prep-order { background: #fff; border: 1px solid #e8d0b0; border-radius: 0.4rem; padding: 0.65rem 1rem; margin-bottom: 0.4rem; font-size: 0.85rem; color: #3d2314; }
        .prep-order-head { font-weight: 600; margin-bottom: 0.25rem; display: flex; justify-content: space-between; }
        .prep-items { padding-left: 1rem; color: #6b4c3b; }
        .prep-empty { color: #6b4c3b; font-style: italic; padding: 0.5rem 1rem; font-size: 0.85rem; }
        .prep-status { display: inline-block; padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #dbeafe; color: #1e40af; }
        .status-baking { background: #ede9fe; color: #6d28d9; }
        .status-ready { background: #d1fae5; color: #065f46; }
        .status-delivered { background: #f3f4f6; color: #374151; }

        @media print {
            .fi-header, .fi-sidebar, .fi-topbar, nav, .prep-nav { display: none !important; }
            .prep-header { border-radius: 0; }
            .prep-body { border: none; border-radius: 0; }
            body { background: #fff !important; }
            .prep-wrap { margin: 0; }
        }
    </style>

    <div class="prep-wrap">
        <div class="prep-header">
            <h2>📋 Weekly Prep Planner</h2>
            <div class="prep-nav">
                <button wire:click="previousWeek" class="prep-nav-btn">← Previous</button>
                <button wire:click="thisWeek" class="prep-nav-btn">This Week</button>
                <button wire:click="nextWeek" class="prep-nav-btn">Next →</button>
            </div>
        </div>
        <div class="prep-body">
            {{-- Week range --}}
            @php
                $dates = $this->getWeekDates();
                $orders = $this->getOrders();
                $aggregates = $this->getAggregates();
            @endphp
            <p style="color: #6b4c3b; font-weight: 600; margin-bottom: 1rem;">
                {{ $dates[0]->format('M j') }} — {{ $dates[6]->format('M j, Y') }}
            </p>

            {{-- Aggregate grocery list --}}
            @if($aggregates->isNotEmpty())
                <div class="prep-section">
                    <div class="prep-section-title">🛒 Weekly Totals — What to Prep</div>
                    <div class="prep-agg">
                        @foreach($aggregates as $product => $qty)
                            <div class="prep-agg-item">
                                <strong>{{ $qty }}×</strong> {{ $product }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Day by day --}}
            @foreach($dates as $date)
                @php
                    $dayOrders = $orders->filter(fn ($o) => $o->requested_date->toDateString() === $date->toDateString());
                @endphp
                <div class="prep-day">
                    <div class="prep-day-header">
                        <span>{{ $date->format('l, M j') }}</span>
                        <span>{{ $dayOrders->count() }} order{{ $dayOrders->count() !== 1 ? 's' : '' }}</span>
                    </div>
                    @forelse($dayOrders as $order)
                        <div class="prep-order">
                            <div class="prep-order-head">
                                <span>{{ $order->order_number }} — {{ $order->customer_name }}
                                    @if($order->requested_time) · {{ $order->requested_time }} @endif
                                    · {{ ucfirst($order->fulfillment_type) }}
                                </span>
                                <span class="prep-status status-{{ $order->status }}">{{ $order->status }}</span>
                            </div>
                            <div class="prep-items">
                                @foreach($order->items as $item)
                                    {{ $item->quantity }}× {{ $item->product_name }}@if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="prep-empty">No orders for this day</div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
