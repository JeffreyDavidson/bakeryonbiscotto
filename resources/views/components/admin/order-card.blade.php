@props(['order'])

<div style="padding: 0.75rem 1rem; border-radius: 0.625rem; border: 1px solid #e8d0b0; margin-bottom: 0.625rem; transition: all 0.15s; background: #fdf8f2;" {{ $attributes }}>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.375rem;">
        <div style="display: flex; align-items: center; gap: 0.375rem; flex-wrap: wrap;">
            <span style="font-weight: 700; color: #3d2314; font-size: 0.875rem;">{{ $order->order_number }}</span>
            <x-admin.badge :type="$order->fulfillment_type" />
            <x-admin.badge :type="$order->status" />
        </div>
    </div>
    <div style="font-size: 0.8rem; color: #a08060; margin-bottom: 0.375rem;">
        👤 {{ $order->customer_name }}@if($order->fulfillment_type === 'delivery' && $order->delivery_address) · 📍 Delivery @endif
    </div>
    <div style="display: flex; flex-wrap: wrap; gap: 0.375rem;">
        @foreach($order->items as $item)
            <x-admin.pill color="brown">
                <span style="font-weight: 700; color: #92400e;">{{ $item->quantity }}×</span>
                <span style="color: #4a3225;">{{ $item->product_name }}</span>
            </x-admin.pill>
        @endforeach
    </div>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @endif
</div>
