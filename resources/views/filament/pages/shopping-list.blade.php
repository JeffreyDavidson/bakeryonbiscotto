<x-filament-panels::page>
    <style>
        .sl-controls {
            display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
            padding: 1rem 1.25rem;
        }
        .sl-date-wrap {
            display: flex; align-items: stretch; border-radius: 0.5rem;
            box-shadow: 0 0 0 1px #e8d0b0; overflow: hidden; background: white;
            transition: box-shadow 0.15s;
        }
        .sl-date-wrap:focus-within {
            box-shadow: 0 0 0 1px #D4A574, 0 0 0 4px rgba(212,165,116,0.15);
        }
        .sl-date-prefix {
            display: flex; align-items: center; padding: 0 0.625rem;
            background: #fdf8f2; color: #a08060; font-size: 0.7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.05em;
            border-right: 1px solid #e8d0b0; white-space: nowrap;
        }
        .sl-date-input {
            border: none; outline: none; padding: 0.5rem 0.75rem;
            font-size: 0.875rem; color: #3d2314; background: transparent; box-shadow: none;
        }
        .sl-quick-btns { display: flex; gap: 0.375rem; }
        .sl-quick-btn {
            padding: 0.375rem 0.75rem; border-radius: 0.375rem;
            border: 1px solid #e8d0b0; background: white; color: #4a3225;
            font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.15s;
        }
        .sl-quick-btn:hover { background: #fdf8f2; border-color: #d4a574; }
        .sl-range-label {
            font-size: 1rem; font-weight: 700; color: #3d2314;
        }
        .sl-actions { margin-left: auto; display: flex; gap: 0.5rem; }
        .sl-group-title {
            font-size: 0.7rem; font-weight: 700; color: #a08060;
            text-transform: uppercase; letter-spacing: 0.08em;
            padding: 0.75rem 1.25rem; background: #fdf8f2;
            border-bottom: 1px solid #f3ebe0;
        }
        .sl-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 1.25rem; border-bottom: 1px solid #f3ebe0;
            transition: background 0.1s;
        }
        .sl-item:hover { background: #fdf8f2; }
        .sl-item:last-child { border-bottom: none; }
        .sl-item-check {
            width: 1.125rem; height: 1.125rem; accent-color: #6b4c3b;
            border-radius: 0.25rem; cursor: pointer; flex-shrink: 0;
        }
        .sl-item-qty {
            font-weight: 800; color: #3d2314; font-size: 0.875rem;
            min-width: 4rem; text-align: right;
        }
        .sl-item-unit {
            color: #a08060; font-size: 0.8rem; font-weight: 500;
            min-width: 3rem;
        }
        .sl-item-name {
            font-weight: 600; color: #4a3225; font-size: 0.875rem; flex: 1;
        }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            body { background: white !important; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid #3d2314;">
        <div>
            <div style="font-size: 1.5rem; font-weight: 800; color: #3d2314;">Shopping List</div>
            <div style="font-size: 1rem; color: #4a3225; font-weight: 600;">{{ $this->formattedRange }}</div>
        </div>
        <div style="text-align: right; font-size: 0.875rem; color: #a08060;">
            <div style="font-weight: 700; font-size: 1rem;">{{ $this->stats->total_items }} items</div>
            <div>{{ $this->stats->total_orders }} orders, {{ $this->stats->unique_products }} products</div>
        </div>
    </div>

    {{-- Controls --}}
    <x-admin.card :padding="false" class="no-print" style="margin-bottom: 1.5rem;">
        <div class="sl-controls">
            <div class="sl-date-wrap">
                <span class="sl-date-prefix">From</span>
                <input type="date" wire:model.live="startDate" class="sl-date-input" />
            </div>
            <div class="sl-date-wrap">
                <span class="sl-date-prefix">To</span>
                <input type="date" wire:model.live="endDate" class="sl-date-input" />
            </div>

            <div class="sl-quick-btns">
                <button class="sl-quick-btn" wire:click="setTomorrow">Tomorrow</button>
                <button class="sl-quick-btn" wire:click="setNextThreeDays">3 Days</button>
                <button class="sl-quick-btn" wire:click="setThisWeek">7 Days</button>
            </div>

            <span class="sl-range-label">{{ $this->formattedRange }}</span>

            <div class="sl-actions">
                <x-admin.btn onclick="copyShoppingList()" style="background: white; color: #4a3225; border: 1px solid #e8d0b0;">Copy to Clipboard</x-admin.btn>
                <x-admin.btn onclick="window.print()" style="background: linear-gradient(135deg, #3d2314, #6b4c3b); color: white; border: none;">Print</x-admin.btn>
            </div>
        </div>
    </x-admin.card>

    @if($this->shoppingList->isEmpty())
        <x-admin.empty-state icon="heroicon-o-shopping-cart" title="No orders in this date range" subtitle="Try adjusting the date range or check back later." />
    @else
        {{-- Stats --}}
        <x-admin.stat-grid :cols="3" data-stat-grid class="no-print">
            <x-admin.stat-card label="Orders" :value="$this->stats->total_orders" />
            <x-admin.stat-card label="Total Items" :value="$this->stats->total_items" color="#6b4c3b" />
            <x-admin.stat-card label="Unique Products" :value="$this->stats->unique_products" color="#8b5e3c" />
        </x-admin.stat-grid>

        {{-- Shopping list --}}
        @php
            $totalIngredients = $this->shoppingList->sum(fn ($items) => $items->count());
        @endphp
        <x-admin.card title="Shopping List" :subtitle="$totalIngredients . ' items to buy'">
            @foreach($this->shoppingList as $group => $items)
                <div class="sl-group-title">{{ $group }}</div>
                @foreach($items as $item)
                    <div class="sl-item">
                        <input type="checkbox" class="sl-item-check" />
                        <span class="sl-item-qty">{{ $this->formatQuantity($item->quantity) }}</span>
                        <span class="sl-item-unit">{{ $item->unit }}</span>
                        <span class="sl-item-name">{{ $item->name }}</span>
                    </div>
                @endforeach
            @endforeach
        </x-admin.card>
    @endif

    <script>
        function copyShoppingList() {
            const text = @js($this->clipboardText);
            navigator.clipboard.writeText(text).then(() => {
                const btn = event.target;
                const original = btn.textContent;
                btn.textContent = 'Copied!';
                setTimeout(() => btn.textContent = original, 2000);
            });
        }
    </script>
</x-filament-panels::page>
