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

<x-filament-panels::page>
    <div class="quick-order-page">
        <div class="quick-order-header">
            <div>
                <h1>🧁 Create Quick Order</h1>
                <div class="subtitle">Create an order on behalf of a customer</div>
            </div>
        </div>

        <div class="quick-order-form-card">
            {{ $this->form }}
        </div>

        <div class="quick-order-totals">
            <div class="total-row">
                <span>Subtotal</span>
                <span>Calculated on submit</span>
            </div>
        </div>

        <button type="button" wire:click="submit" class="quick-order-submit">
            🧾 Create Order
        </button>
    </div>
</x-filament-panels::page>
