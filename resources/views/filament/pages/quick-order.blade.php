<style>
    .quick-order-header {
        display: flex; align-items: center; gap: 1rem;
        margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #3d2314, #6b4c3b);
        border-radius: 0.75rem;
    }
    .quick-order-header h1 { font-size: 1.375rem; font-weight: 800; color: #FFFFFF !important; margin: 0; }
    .quick-order-header .subtitle { font-size: 0.8rem; color: rgba(255,255,255,0.6); }
    .quick-order-submit {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 2rem; margin-top: 1rem;
        background: linear-gradient(135deg, #3d2314, #6b4c3b);
        color: white; border: none; border-radius: 0.5rem;
        font-size: 1rem; font-weight: 700; cursor: pointer; transition: opacity 0.15s;
    }
    .quick-order-submit:hover { opacity: 0.9; }
</style>

<x-filament-panels::page>
    <div class="quick-order-header">
        <div>
            <h1>🧁 Create Quick Order</h1>
            <div class="subtitle">Create an order on behalf of a customer</div>
        </div>
    </div>

    {{ $this->form }}

    <button type="button" wire:click="submit" class="quick-order-submit">
        🧾 Create Order
    </button>
</x-filament-panels::page>
