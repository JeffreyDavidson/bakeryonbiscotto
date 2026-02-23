@props(['href', 'dayName', 'date', 'count', 'wireClick' => null])

<a href="{{ $href }}" @if($wireClick) wire:click.prevent="{{ $wireClick }}" @endif style="display: flex; flex-direction: column; align-items: center; padding: 0.625rem 1rem; border-radius: 0.5rem; background: #fdf8f2; border: 1px solid #e8d0b0; min-width: 4.5rem; cursor: pointer; text-decoration: none; transition: all 0.15s;" {{ $attributes }}>
    <span style="font-size: 0.7rem; font-weight: 600; color: #a08060; text-transform: uppercase;">{{ $dayName }}</span>
    <span style="font-size: 0.875rem; font-weight: 700; color: #3d2314;">{{ $date }}</span>
    <span style="font-size: 0.7rem; color: #8b5e3c; font-weight: 600; margin-top: 0.125rem;">{{ $count }}</span>
</a>
