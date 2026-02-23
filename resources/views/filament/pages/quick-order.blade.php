<style>
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
    <x-admin.page-banner title="🧁 Create Quick Order">
        <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Create an order on behalf of a customer</span>
    </x-admin.page-banner>

    {{ $this->form }}

    <button type="button" wire:click="submit" class="quick-order-submit">
        🧾 Create Order
    </button>
</x-filament-panels::page>
