<style>
    .quick-order-page {
        font-family: inherit;
    }
    .quick-order-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #3d2314, #6b4c3b);
        border-radius: 0.75rem;
    }
    .quick-order-header h1 {
        font-size: 1.375rem;
        font-weight: 800;
        color: #FFFFFF !important;
        margin: 0;
    }
    .quick-order-header .subtitle {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
    }
    .quick-order-form-card {
        background: white;
        border: 1px solid #e8d0b0;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .quick-order-totals {
        background: #fdf8f2;
        border: 1px solid #e8d0b0;
        border-radius: 0.75rem;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
    }
    .quick-order-totals .total-row {
        display: flex;
        justify-content: space-between;
        padding: 0.375rem 0;
        font-size: 0.875rem;
        color: #6b4c3b;
    }
    .quick-order-totals .total-row.grand {
        border-top: 2px solid #e8d0b0;
        margin-top: 0.5rem;
        padding-top: 0.75rem;
        font-size: 1.125rem;
        font-weight: 800;
        color: #3d2314;
    }
    .quick-order-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #3d2314, #6b4c3b);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.15s;
    }
    .quick-order-submit:hover { opacity: 0.9; }
</style>

@php
    $products = \App\Models\Product::where('is_available', true)->orderBy('name')->get();
    $priceMap = $products->pluck('price', 'id')->toArray();
@endphp

<x-filament-panels::page>
    <div class="quick-order-page" x-data="{
        prices: {{ json_encode($priceMap) }},
        fulfillmentType: $wire.entangle('data.fulfillment_type'),
        getPrice(productId) {
            return parseFloat(this.prices[productId] || 0);
        },
        getSubtotal() {
            let total = 0;
            document.querySelectorAll('[data-repeater-item]').forEach(item => {
                const select = item.querySelector('select');
                const qtyInput = item.querySelector('input[type=number]');
                if (select && qtyInput) {
                    const price = this.getPrice(select.value);
                    const qty = parseInt(qtyInput.value) || 0;
                    total += price * qty;
                }
            });
            return total;
        },
        getDeliveryFee() {
            return this.fulfillmentType === 'delivery' ? 5.00 : 0;
        },
        formatMoney(val) {
            return '$' + val.toFixed(2);
        }
    }">
        <div class="quick-order-header">
            <div>
                <h1>🧁 Create Quick Order</h1>
                <div class="subtitle">Create an order on behalf of a customer</div>
            </div>
        </div>

        <form wire:submit="submit">
            <div class="quick-order-form-card">
                {{ $this->form }}
            </div>

            <div class="quick-order-totals"
                 x-init="$watch('fulfillmentType', () => $el.querySelector('.subtotal-val') && $nextTick(() => $el.click()))"
                 @click.self="$forceUpdate">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span class="subtotal-val" x-text="formatMoney(getSubtotal())"></span>
                </div>
                <template x-if="getDeliveryFee() > 0">
                    <div class="total-row">
                        <span>Delivery Fee</span>
                        <span x-text="formatMoney(getDeliveryFee())"></span>
                    </div>
                </template>
                <div class="total-row grand">
                    <span>Total</span>
                    <span x-text="formatMoney(getSubtotal() + getDeliveryFee())"></span>
                </div>
            </div>

            <button type="submit" class="quick-order-submit">
                🧾 Create Order
            </button>
        </form>
    </div>
</x-filament-panels::page>
