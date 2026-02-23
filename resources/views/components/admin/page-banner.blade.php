@props(['title'])

<div style="display: flex; align-items: center; gap: 1.25rem; margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem; background: linear-gradient(135deg, #3d2314, #6b4c3b); border-radius: 0.75rem; flex-wrap: wrap;" {{ $attributes }}>
    <div style="flex: 1;">
        <span style="font-size: 1.375rem; font-weight: 800; color: white;">{{ $title }}</span>
    </div>
    @if($slot->isNotEmpty())
        <div style="margin-left: auto; text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 0.375rem;">
            {{ $slot }}
        </div>
    @endif
</div>
