@props(['label', 'prevClick' => null, 'nextClick' => null, 'prevLabel' => '←', 'nextLabel' => '→'])

<div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 1.5rem;" {{ $attributes }}>
    @if($prevClick)
        <button wire:click="{{ $prevClick }}" type="button" style="display: inline-flex; align-items: center; gap: 0.375rem; background: #3d2314; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: background 0.15s;">{{ $prevLabel }}</button>
    @endif
    @if(isset($before))
        {{ $before }}
    @endif
    <span style="font-size: 1.5rem; font-weight: 700; color: #3d2314; min-width: 120px; text-align: center;">{{ $label }}</span>
    @if(isset($after))
        {{ $after }}
    @endif
    @if($nextClick)
        <button wire:click="{{ $nextClick }}" type="button" style="display: inline-flex; align-items: center; gap: 0.375rem; background: #3d2314; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: background 0.15s;">{{ $nextLabel }}</button>
    @endif
</div>
