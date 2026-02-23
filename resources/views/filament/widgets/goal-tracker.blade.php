<x-filament-widgets::widget>
    <div style="background: #fff; border: 1px solid #e8d0b0; border-radius: 12px; overflow: hidden;">
        <div style="background: linear-gradient(135deg, #3d2314, #6b4c3b); color: #fff; padding: 0.75rem 1.25rem; font-weight: 700; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center;">
            <span>🎯 Monthly Revenue Goal</span>
            <button wire:click="openEditModal" type="button" style="background: rgba(255,255,255,0.2); border: none; color: #fff; border-radius: 6px; padding: 0.25rem 0.75rem; cursor: pointer; font-size: 0.75rem; font-weight: 600;">
                Edit
            </button>
        </div>

        @php $data = $this->goalData; @endphp

        <div style="padding: 1.25rem;">
            <div style="font-size: 0.8rem; color: #8b5e3c; font-weight: 600; margin-bottom: 0.5rem;">
                {{ $data['month'] }}
            </div>

            {{-- Progress bar --}}
            <div style="background: #f5e6d0; border-radius: 999px; height: 24px; overflow: hidden; margin-bottom: 0.75rem;">
                <div style="background: linear-gradient(90deg, #6b4c3b, #3d2314); height: 100%; border-radius: 999px; width: {{ $data['percentage'] }}%; transition: width 0.5s ease; display: flex; align-items: center; justify-content: flex-end; padding-right: 8px; min-width: {{ $data['percentage'] > 5 ? '0' : '40' }}px;">
                    @if ($data['percentage'] > 10)
                        <span style="color: #fff; font-size: 0.7rem; font-weight: 700;">{{ $data['percentage'] }}%</span>
                    @endif
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: baseline;">
                <div>
                    <span style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: #3d2314;">
                        ${{ number_format($data['revenue'], 2) }}
                    </span>
                    <span style="font-size: 0.8rem; color: #8b5e3c;"> / ${{ number_format($data['goal'], 0) }}</span>
                </div>
                <span style="font-size: 1.1rem; font-weight: 700; color: {{ $data['percentage'] >= 100 ? '#16a34a' : '#3d2314' }};">
                    {{ $data['percentage'] }}%
                </span>
            </div>
        </div>
    </div>

    {{-- Edit modal --}}
    @if ($showEditModal)
        <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 50; display: flex; align-items: center; justify-content: center;" wire:click.self="closeEditModal">
            <div style="background: #fff; border-radius: 12px; border: 1px solid #e8d0b0; padding: 1.5rem; width: 360px; max-width: 90vw;">
                <div style="font-weight: 700; color: #3d2314; font-size: 1rem; margin-bottom: 1rem;">Edit Monthly Goal</div>
                <label style="font-size: 0.8rem; color: #6b4c3b; font-weight: 600; display: block; margin-bottom: 0.25rem;">Goal Amount ($)</label>
                <input type="number" wire:model="newGoal" step="100" min="0" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e8d0b0; border-radius: 8px; font-size: 0.9rem; margin-bottom: 1rem; outline: none;">
                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                    <button wire:click="closeEditModal" type="button" style="padding: 0.5rem 1rem; border: 1px solid #e8d0b0; background: #fdf8f2; border-radius: 8px; cursor: pointer; font-size: 0.8rem; font-weight: 600; color: #6b4c3b;">Cancel</button>
                    <button wire:click="saveGoal" type="button" style="padding: 0.5rem 1rem; border: none; background: #3d2314; color: #fff; border-radius: 8px; cursor: pointer; font-size: 0.8rem; font-weight: 600;">Save</button>
                </div>
            </div>
        </div>
    @endif
</x-filament-widgets::widget>
