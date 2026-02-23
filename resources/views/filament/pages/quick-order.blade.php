<x-filament-panels::page>
    <x-admin.page-banner title="🧁 Create Quick Order">
        <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Create an order on behalf of a customer</span>
    </x-admin.page-banner>

    {{ $this->form }}

    <x-admin.action-btn variant="dark" wire:click="submit" icon="🧾" style="padding: 0.75rem 2rem; margin-top: 1rem; font-size: 1rem; font-weight: 700;">
        Create Order
    </x-admin.action-btn>
</x-filament-panels::page>
