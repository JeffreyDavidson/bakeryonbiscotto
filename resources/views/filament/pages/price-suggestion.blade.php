<x-filament-panels::page>
    <style>
        .ps-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .ps-grid { grid-template-columns: 1fr 1fr; } }
        .ps-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .ps-field { margin-bottom: 1rem; }
        .ps-label {
            display: block; font-size: 0.7rem; font-weight: 700; color: #a08060;
            text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.375rem;
        }
        .ps-input {
            display: block; width: 100%; border-radius: 0.5rem;
            padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #3d2314;
            background: white; box-shadow: 0 0 0 1px #e8d0b0;
            border: none; outline: none; transition: box-shadow 0.15s;
        }
        .ps-input:focus {
            box-shadow: 0 0 0 1px #D4A574, 0 0 0 4px rgba(212,165,116,0.15);
        }
        .ps-input-wrap {
            display: flex; align-items: stretch; border-radius: 0.5rem;
            box-shadow: 0 0 0 1px #e8d0b0; overflow: hidden;
            transition: box-shadow 0.15s; background: white;
        }
        .ps-input-wrap:focus-within {
            box-shadow: 0 0 0 1px #D4A574, 0 0 0 4px rgba(212,165,116,0.15);
        }
        .ps-input-prefix {
            display: flex; align-items: center; padding: 0 0.625rem;
            background: #fdf8f2; color: #a08060; font-size: 0.875rem; font-weight: 600;
            border-right: 1px solid #e8d0b0;
        }
        .ps-input-inner {
            flex: 1; border: none; outline: none; padding: 0.5rem 0.75rem;
            font-size: 0.875rem; color: #3d2314; background: transparent;
            box-shadow: none;
        }
        .ps-range-track {
            width: 100%; height: 8px; -webkit-appearance: none; appearance: none;
            background: linear-gradient(90deg, #d4a574 {{ $margin }}%, #f3ebe0 {{ $margin }}%);
            border: none; border-radius: 4px; outline: none; cursor: pointer;
        }
        .ps-range-track::-webkit-slider-thumb {
            -webkit-appearance: none; width: 22px; height: 22px; border-radius: 50%;
            background: #3d2314; border: 3px solid #fdf8f2;
            box-shadow: 0 2px 6px rgba(61,35,20,0.3); cursor: pointer;
        }
        .ps-range-track::-moz-range-thumb {
            width: 22px; height: 22px; border-radius: 50%;
            background: #3d2314; border: 3px solid #fdf8f2;
            box-shadow: 0 2px 6px rgba(61,35,20,0.3); cursor: pointer;
        }
        .ps-quick-btns { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.75rem; }
        .ps-quick-btn {
            padding: 0.375rem 0.875rem; border-radius: 0.375rem; font-size: 0.8rem;
            font-weight: 600; cursor: pointer; transition: all 0.15s; border: 1px solid #e8d0b0;
            background: white; color: #4a3225;
        }
        .ps-quick-btn:hover { background: #fdf8f2; }
        .ps-quick-btn.active {
            background: #3d2314; color: #fdf8f2; border-color: #3d2314;
        }
        .ps-results-card {
            background: linear-gradient(135deg, #3d2314, #6b4c3b);
            border-radius: 0.75rem; padding: 1.5rem; color: #fdf8f2;
        }
        .ps-result-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 0.625rem 0; border-bottom: 1px solid rgba(253,248,242,0.12);
        }
        .ps-result-label { font-size: 0.8rem; opacity: 0.8; }
        .ps-result-value { font-weight: 700; font-size: 1rem; }
        .ps-result-total {
            display: flex; justify-content: space-between; align-items: center;
            padding: 0.875rem 0 0; border-top: 2px solid rgba(253,248,242,0.25); margin-top: 0.5rem;
        }
        .ps-result-total-label { font-size: 1.1rem; font-weight: 600; }
        .ps-result-total-value { font-size: 2rem; font-weight: 800; color: #f5e6d0; }
        .ps-breakdown-row {
            display: flex; justify-content: space-between; padding: 0.5rem 0;
            border-bottom: 1px solid #f3ebe0; font-size: 0.875rem; color: #4a3225;
        }
        .ps-breakdown-row:last-child { border-bottom: none; font-weight: 700; }
        .ps-breakdown-detail { font-size: 0.75rem; color: #a08060; }
    </style>

    <div class="ps-grid">
        {{-- Inputs --}}
        <x-admin.card title="Cost Inputs">
            <div style="padding: 1.25rem;">
                {{-- Ingredient Cost --}}
                <div class="ps-field">
                    <label class="ps-label">Ingredient Cost</label>
                    <div class="ps-input-wrap">
                        <span class="ps-input-prefix">$</span>
                        <input type="number" wire:model.live="ingredientCost" step="0.01" min="0" placeholder="0.00" class="ps-input-inner">
                    </div>
                </div>

                {{-- Labor --}}
                <div class="ps-2col">
                    <div class="ps-field">
                        <label class="ps-label">Labor Time (minutes)</label>
                        <div class="ps-input-wrap">
                            <span class="ps-input-prefix">⏱</span>
                            <input type="number" wire:model.live="laborMinutes" step="1" min="0" placeholder="0" class="ps-input-inner">
                        </div>
                    </div>
                    <div class="ps-field">
                        <label class="ps-label">Hourly Rate</label>
                        <div class="ps-input-wrap">
                            <span class="ps-input-prefix">$/hr</span>
                            <input type="number" wire:model.live="hourlyRate" step="0.50" min="0" placeholder="25.00" class="ps-input-inner">
                        </div>
                    </div>
                </div>

                {{-- Packaging --}}
                <div class="ps-field">
                    <label class="ps-label">Packaging Cost</label>
                    <div class="ps-input-wrap">
                        <span class="ps-input-prefix">$</span>
                        <input type="number" wire:model.live="packagingCost" step="0.01" min="0" placeholder="0.00" class="ps-input-inner">
                    </div>
                </div>

                {{-- Servings --}}
                <div class="ps-field">
                    <label class="ps-label">Servings / Yield</label>
                    <div class="ps-input-wrap">
                        <span class="ps-input-prefix">#</span>
                        <input type="number" wire:model.live="servings" step="1" min="1" placeholder="1" class="ps-input-inner">
                    </div>
                </div>

                {{-- Margin Slider --}}
                <div class="ps-field">
                    <label class="ps-label">
                        Desired Profit Margin
                        <span style="float: right; font-size: 0.875rem; font-weight: 800; color: #3d2314; text-transform: none; letter-spacing: normal;">{{ number_format($margin, 0) }}%</span>
                    </label>
                    <input type="range" wire:model.live="margin" min="0" max="95" step="1" class="ps-range-track">
                    <div class="ps-quick-btns">
                        @foreach([40, 50, 60, 75] as $m)
                            <button wire:click="setMargin({{ $m }})" class="ps-quick-btn {{ $margin == $m ? 'active' : '' }}">{{ $m }}%</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-admin.card>

        {{-- Results --}}
        <div>
            <div class="ps-results-card" style="margin-bottom: 1.5rem;">
                <div class="ps-result-row">
                    <span class="ps-result-label">Total Cost</span>
                    <span class="ps-result-value">${{ number_format($this->totalCost, 2) }}</span>
                </div>
                <div class="ps-result-row">
                    <span class="ps-result-label">Cost per Unit</span>
                    <span class="ps-result-value">${{ number_format($this->costPerUnit, 2) }}</span>
                </div>
                <div class="ps-result-row" style="border-bottom: none;">
                    <span class="ps-result-label">Profit per Unit</span>
                    <span class="ps-result-value">${{ number_format($this->profitPerUnit, 2) }}</span>
                </div>
                <div class="ps-result-total">
                    <span class="ps-result-total-label">Suggested Price</span>
                    <span class="ps-result-total-value">${{ number_format($this->suggestedPrice, 2) }}</span>
                </div>
            </div>

            <x-admin.card title="Cost Breakdown">
                <div style="padding: 1rem 1.25rem;">
                    <div class="ps-breakdown-row">
                        <span>Ingredients</span>
                        <span>${{ number_format($ingredientCost, 2) }}</span>
                    </div>
                    <div class="ps-breakdown-row">
                        <div>
                            <span>Labor</span>
                            <div class="ps-breakdown-detail">{{ $laborMinutes }} min × ${{ number_format($hourlyRate, 2) }}/hr</div>
                        </div>
                        <span>${{ number_format($laborMinutes / 60 * $hourlyRate, 2) }}</span>
                    </div>
                    <div class="ps-breakdown-row">
                        <span>Packaging</span>
                        <span>${{ number_format($packagingCost, 2) }}</span>
                    </div>
                    <div class="ps-breakdown-row">
                        <div>
                            <span>Total per Unit</span>
                            <div class="ps-breakdown-detail">${{ number_format($this->totalCost, 2) }} ÷ {{ number_format($servings, 0) }} servings</div>
                        </div>
                        <span>${{ number_format($this->costPerUnit, 2) }}</span>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>
</x-filament-panels::page>
