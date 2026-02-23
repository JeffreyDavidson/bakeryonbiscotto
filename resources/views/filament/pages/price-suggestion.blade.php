<x-filament-panels::page>
    <style>
        .price-card { background: #fdf8f2; border: 1px solid #e8d0b0; border-radius: 12px; padding: 1.5rem; }
        .price-header { background: #3d2314; color: #fdf8f2; padding: 1rem 1.5rem; border-radius: 10px 10px 0 0; margin: -1.5rem -1.5rem 1.5rem; font-size: 1.1rem; font-weight: 600; }
        .price-input-group { margin-bottom: 1rem; }
        .price-input-group label { display: block; font-weight: 600; color: #3d2314; margin-bottom: 0.25rem; font-size: 0.875rem; }
        .price-input-group input, .price-input-group input[type=range] { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; background: #fff; font-size: 1rem; color: #3d2314; }
        .price-input-group input:focus { outline: none; border-color: #6b4c3b; box-shadow: 0 0 0 2px rgba(107,76,59,0.15); }
        .price-input-group input[type=range] { padding: 0; height: 8px; -webkit-appearance: none; appearance: none; background: #e8d0b0; border: none; border-radius: 4px; }
        .price-input-group input[type=range]::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; border-radius: 50%; background: #6b4c3b; cursor: pointer; }
        .result-card { background: #3d2314; color: #fdf8f2; border-radius: 12px; padding: 1.5rem; }
        .result-row { display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid rgba(253,248,242,0.15); }
        .result-row:last-child { border-bottom: none; }
        .result-label { opacity: 0.85; font-size: 0.875rem; }
        .result-value { font-weight: 700; font-size: 1.1rem; }
        .result-highlight { font-size: 1.5rem; color: #f5e6d0; }
        .margin-btn { display: inline-block; padding: 0.4rem 1rem; border-radius: 8px; background: #6b4c3b; color: #fdf8f2; font-weight: 600; font-size: 0.85rem; cursor: pointer; border: 2px solid transparent; transition: all 0.15s; }
        .margin-btn:hover { background: #3d2314; }
        .margin-btn.active { border-color: #f5e6d0; background: #3d2314; }
    </style>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Inputs --}}
        <div class="price-card">
            <div class="price-header">🧮 Cost Inputs</div>

            <div class="price-input-group">
                <label>Ingredient Cost ($)</label>
                <input type="number" wire:model.live="ingredientCost" step="0.01" min="0" placeholder="0.00">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="price-input-group">
                    <label>Labor Time (minutes)</label>
                    <input type="number" wire:model.live="laborMinutes" step="1" min="0" placeholder="0">
                </div>
                <div class="price-input-group">
                    <label>Hourly Rate ($)</label>
                    <input type="number" wire:model.live="hourlyRate" step="0.50" min="0" placeholder="25.00">
                </div>
            </div>

            <div class="price-input-group">
                <label>Packaging Cost ($)</label>
                <input type="number" wire:model.live="packagingCost" step="0.01" min="0" placeholder="0.00">
            </div>

            <div class="price-input-group">
                <label>Servings / Yield</label>
                <input type="number" wire:model.live="servings" step="1" min="1" placeholder="1">
            </div>

            <div class="price-input-group">
                <label>Desired Profit Margin: {{ number_format($margin, 0) }}%</label>
                <input type="range" wire:model.live="margin" min="0" max="95" step="1">
            </div>

            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <span>Quick Margin:</span>
                @foreach([40, 50, 60, 75] as $m)
                    <button type="button" wire:click="setMargin({{ $m }})" class="margin-btn {{ $margin == $m ? 'active' : '' }}">{{ $m }}%</button>
                @endforeach
            </div>
        </div>

        {{-- Results --}}
        <div>
            <div class="result-card">
                <div style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">📊 Results</div>

                <div class="result-row">
                    <span class="result-label">Total Cost</span>
                    <span class="result-value">${{ number_format($this->totalCost, 2) }}</span>
                </div>
                <div class="result-row">
                    <span class="result-label">Cost per Unit</span>
                    <span class="result-value">${{ number_format($this->costPerUnit, 2) }}</span>
                </div>
                <div class="result-row" style="border-bottom: 2px solid rgba(253,248,242,0.3); padding-bottom: 1rem;">
                    <span class="result-label">Profit per Unit</span>
                    <span class="result-value">${{ number_format($this->profitPerUnit, 2) }}</span>
                </div>
                <div class="result-row" style="padding-top: 1rem;">
                    <span class="result-label" style="font-size: 1.1rem; opacity: 1;">Suggested Price</span>
                    <span class="result-value result-highlight">${{ number_format($this->suggestedPrice, 2) }}</span>
                </div>
            </div>

            <div class="price-card" style="margin-top: 1rem;">
                <div style="font-weight: 600; color: #3d2314; margin-bottom: 0.75rem;">💡 Cost Breakdown</div>
                <div style="font-size: 0.875rem; color: #6b4c3b; line-height: 1.8;">
                    Ingredients: ${{ number_format($ingredientCost, 2) }}<br>
                    Labor: ${{ number_format($laborMinutes / 60 * $hourlyRate, 2) }} ({{ $laborMinutes }} min × ${{ number_format($hourlyRate, 2) }}/hr)<br>
                    Packaging: ${{ number_format($packagingCost, 2) }}<br>
                    <strong>Total: ${{ number_format($this->totalCost, 2) }} ÷ {{ number_format($servings, 0) }} servings = ${{ number_format($this->costPerUnit, 2) }}/unit</strong>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
