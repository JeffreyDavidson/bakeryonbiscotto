@props(['label', 'value', 'color' => '#3d2314'])

<div style="border-radius: 0.75rem; border: 1px solid #e8d0b0; background: white; padding: 1rem 1.25rem; text-align: center; transition: all 0.15s;" {{ $attributes }}>
    <div style="font-size: 0.65rem; font-weight: 700; color: #a08060; text-transform: uppercase; letter-spacing: 0.08em;">{{ $label }}</div>
    <div style="margin-top: 0.25rem; font-size: 1.5rem; font-weight: 800; color: {{ $color }}; line-height: 1;">{{ $value }}</div>
</div>
