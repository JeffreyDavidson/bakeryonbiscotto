<x-filament-panels::page>
    <style>
        .sl-controls { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .sl-date-input { padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; background: #fff; font-size: 0.875rem; color: #3d2314; }
        .sl-date-input:focus { outline: none; border-color: #D4A574; box-shadow: 0 0 0 3px rgba(212,165,116,0.15); }
        .sl-group-title { font-size: 1rem; font-weight: 700; color: #3d2314; padding: 0.875rem 1.5rem; background: #fdf8f2; border-bottom: 2px solid #e8d0b0; text-transform: uppercase; letter-spacing: 0.05em; }
        .sl-item { display: flex; align-items: center; gap: 1rem; padding: 0.625rem 1.5rem; border-bottom: 1px solid #f3ebe0; }
        .sl-item:last-child { border-bottom: none; }
        .sl-item-name { font-weight: 600; color: #3d2314; font-size: 0.925rem; flex: 1; }
        .sl-item-qty { font-weight: 700; color: #6b4c3b; font-size: 0.925rem; min-width: 5rem; text-align: right; }
        .sl-item-unit { color: #a08060; font-size: 0.85rem; min-width: 3rem; }
        .sl-item-check { width: 18px; height: 18px; accent-color: #6b4c3b; }
        .sl-quick-btns { display: flex; gap: 0.375rem; }
        .sl-quick-btn { padding: 0.375rem 0.75rem; border-radius: 0.375rem; border: 1px solid #e8d0b0; background: #fdf8f2; color: #6b4c3b; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.15s; }
        .sl-quick-btn:hover { background: #f5e6d0; border-color: #d4a574; }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header, .sl-controls { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            .sl-item-check-col { display: table-cell !important; }
            body { background: white !important; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid #3d2314;">
        <div>
            <div style="font-size: 1.5rem; font-weight: 800; color: #3d2314;">Shopping List</div>
            <div style="font-size: 1.125rem; color: #4a3225; font-weight: 600;">{{ $this->formattedRange }}</div>
        </div>
        <div style="text-align: right; font-size: 0.875rem; color: #a08060;">
            <div style="font-weight: 700; font-size: 1rem;">{{ $this->stats->total_items }} items</div>
            <div>{{ $this->stats->total_orders }} orders, {{ $this->stats->unique_products }} products</div>
        </div>
    </div>

    {{-- Controls --}}
    <div class="sl-controls no-print">
        <label style="font-size: 0.8rem; font-weight: 600; color: #6b4c3b;">From</label>
        <input type="date" wire:model.live="startDate" class="sl-date-input" />
        <label style="font-size: 0.8rem; font-weight: 600; color: #6b4c3b;">To</label>
        <input type="date" wire:model.live="endDate" class="sl-date-input" />

        <div class="sl-quick-btns">
            <button class="sl-quick-btn" wire:click="setTomorrow">Tomorrow</button>
            <button class="sl-quick-btn" wire:click="setNextThreeDays">3 Days</button>
            <button class="sl-quick-btn" wire:click="setThisWeek">7 Days</button>
        </div>

        <span style="font-size: 1.1rem; font-weight: 700; color: #3d2314;">{{ $this->formattedRange }}</span>

        <div style="margin-left: auto; display: flex; gap: 0.5rem;">
            <x-admin.btn variant="secondary" onclick="copyShoppingList()">Copy to Clipboard</x-admin.btn>
            <x-admin.btn variant="primary" onclick="window.print()">Print</x-admin.btn>
        </div>
    </div>

    @if($this->shoppingList->isEmpty())
        <x-admin.empty-state icon="heroicon-o-shopping-cart" title="No orders in this date range" subtitle="Try adjusting the date range or check back later." />
    @else
        {{-- Stats --}}
        <x-admin.stat-grid :cols="3" class="no-print">
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
