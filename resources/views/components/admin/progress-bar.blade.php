@props(['segments' => [], 'label' => null, 'showLegend' => true])

<div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; padding: 1rem 1.25rem; border-radius: 0.75rem; background: white; border: 1px solid #e8d0b0;" {{ $attributes }}>
    @if($label)
        <span style="font-size: 0.75rem; color: #a08060; white-space: nowrap;">{{ $label }}</span>
    @endif
    <div style="flex: 1; height: 0.625rem; border-radius: 9999px; background: #f3ebe0; overflow: hidden; display: flex;">
        @foreach($segments as $seg)
            @if($seg['percent'] > 0)
                <div style="height: 100%; width: {{ $seg['percent'] }}%; background: {{ $seg['color'] }}; transition: width 0.3s;"></div>
            @endif
        @endforeach
    </div>
    @if($showLegend)
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            @foreach($segments as $seg)
                @if(($seg['count'] ?? 0) > 0)
                    <span style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; color: #6b4c3b;">
                        <span style="width: 0.5rem; height: 0.5rem; border-radius: 9999px; background: {{ $seg['color'] }};"></span>
                        {{ $seg['count'] }} {{ $seg['label'] }}
                    </span>
                @endif
            @endforeach
        </div>
    @endif
</div>
