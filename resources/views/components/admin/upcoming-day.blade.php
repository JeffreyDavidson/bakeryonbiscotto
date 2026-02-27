@props(['href', 'dayName', 'date', 'count', 'wireClick' => null])

<a href="{{ $href }}" @if($wireClick) wire:click.prevent="{{ $wireClick }}" @endif style="display: flex; flex-direction: column; align-items: center; padding: 0.625rem 1rem; border-radius: 0.5rem; background: var(--brand-50); border: 1px solid var(--brand-200); min-width: 4.5rem; cursor: pointer; text-decoration: none; transition: all 0.15s;" {{ $attributes }}>
    <span style="font-size: 0.7rem; font-weight: 600; color: var(--brand-500); text-transform: uppercase;">{{ $dayName }}</span>
    <span style="font-size: 0.875rem; font-weight: 700; color: var(--brand-900);">{{ $date }}</span>
    <span style="font-size: 0.7rem; color: var(--brand-600); font-weight: 600; margin-top: 0.125rem;">{{ $count }}</span>
</a>
