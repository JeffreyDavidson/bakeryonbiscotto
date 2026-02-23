<x-filament-panels::page>
    <style>
        .prep-wrap { max-width: 1200px; margin: 0 auto; }
        .prep-nav { display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1.5rem; }
        .prep-nav button { background: #3d2314; color: #fff; border: none; border-radius: 8px; padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; }
        .prep-nav button:hover { background: #6b4c3b; }
        .prep-nav button.secondary { background: #e8d0b0; color: #3d2314; }
        .prep-nav button.secondary:hover { background: #d4a574; }
        .prep-nav .week-label { font-family: "Playfair Display", serif; font-size: 1.25rem; color: #3d2314; font-weight: 700; min-width: 200px; text-align: center; }

        .prep-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        @media (max-width: 768px) { .prep-stats { grid-template-columns: 1fr; } }

        .prep-day-today { border: 2px solid #8b5e3c !important; }
        .prep-day-today > div:first-child { background: linear-gradient(135deg, #8b5e3c, #6b4c3b) !important; }

        .prep-task { display: flex; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid #f3ebe0; align-items: flex-start; }
        .prep-task:last-child { border-bottom: none; }
        .prep-task:hover { background: rgba(245,230,208,0.3); }

        .prep-time { min-width: 80px; text-align: right; flex-shrink: 0; }
        .prep-time-value { font-weight: 700; color: #3d2314; font-size: 0.9rem; }
        .prep-time-duration { font-size: 0.7rem; color: #a08060; margin-top: 0.125rem; }

        .prep-divider { width: 3px; background: #e8d0b0; border-radius: 999px; min-height: 50px; flex-shrink: 0; position: relative; }
        .prep-dot { position: absolute; top: 4px; left: 50%; transform: translateX(-50%); width: 10px; height: 10px; border-radius: 50%; border: 2px solid #8b5e3c; background: #fff; }

        .prep-details { flex: 1; }
        .prep-stage-name { font-weight: 700; color: #3d2314; font-size: 0.9rem; }
        .prep-product { font-size: 0.85rem; color: #6b4c3b; margin-top: 0.125rem; }
        .prep-product .qty { background: #f5e6d0; padding: 0.1rem 0.5rem; border-radius: 4px; font-weight: 600; font-size: 0.75rem; color: #3d2314; margin-left: 0.25rem; }
        .prep-meta { display: flex; gap: 0.75rem; margin-top: 0.375rem; font-size: 0.75rem; color: #a08060; flex-wrap: wrap; }
        .prep-meta span { display: inline-flex; align-items: center; gap: 0.25rem; }
        .prep-instructions { font-size: 0.8rem; color: #8b5e3c; margin-top: 0.375rem; font-style: italic; background: #fdf8f2; padding: 0.375rem 0.625rem; border-radius: 6px; border-left: 3px solid #d4a574; }

        .prep-badge { display: inline-block; padding: 0.1rem 0.5rem; border-radius: 999px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; }
        .prep-badge-pickup { background: #f3ebe0; color: #6b4c3b; }
        .prep-badge-delivery { background: #dbeafe; color: #1d4ed8; }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, .prep-nav, button { display: none !important; }
            .fi-main { padding: 0 !important; margin: 0 !important; }
        }
    </style>

    <div class="prep-wrap">
        {{-- Week navigation --}}
        @php
            $weekStartDate = \Carbon\Carbon::parse($this->weekStart);
            $weekEndDate = $weekStartDate->copy()->addDays(6);
            $today = now()->toDateString();
        @endphp
        <div class="prep-nav">
            <button wire:click="previousWeek" type="button">← Prev</button>
            <button wire:click="thisWeek" type="button" class="secondary">This Week</button>
            <span class="week-label">{{ $weekStartDate->format('M j') }} — {{ $weekEndDate->format('M j, Y') }}</span>
            <button wire:click="nextWeek" type="button">Next →</button>
        </div>

        {{-- Stats --}}
        @php $stats = $this->weekStats; @endphp
        <div class="prep-stats">
            <x-admin.stat-card label="Prep Tasks" :value="$stats['total_tasks']" />
            <x-admin.stat-card label="Est. Work Time" :value="$stats['total_hours'] . 'h'" />
            <x-admin.stat-card label="Products to Make" :value="$stats['unique_products']" />
        </div>

        {{-- Timeline by day --}}
        @php $timeline = $this->prepTimeline; @endphp

        @if(empty($timeline))
            <x-admin.empty-state icon="📋" title="No prep tasks this week" subtitle="Either no orders are scheduled, or recipes don't have prep stages defined yet. Add stages to your recipes under Tools → Recipes to see the prep timeline." />
        @else
            @for($i = 0; $i < 7; $i++)
                @php
                    $date = $weekStartDate->copy()->addDays($i);
                    $dateStr = $date->toDateString();
                    $dayTasks = $timeline[$dateStr] ?? [];
                    $isToday = $dateStr === $today;
                @endphp

                @if(!empty($dayTasks))
                    <x-admin.card :title="$date->format('l, M j') . ($isToday ? ' — Today' : '')" :subtitle="count($dayTasks) . ' ' . str('task')->plural(count($dayTasks))" class="{{ $isToday ? 'prep-day-today' : '' }}">
                        @foreach($dayTasks as $task)
                            <div class="prep-task">
                                <div class="prep-time">
                                    <div class="prep-time-value">{{ $task['time'] }}</div>
                                    @if($task['duration'])
                                        <div class="prep-time-duration">~{{ $task['duration'] }} min</div>
                                    @endif
                                </div>
                                <div class="prep-divider"><div class="prep-dot"></div></div>
                                <div class="prep-details">
                                    <div class="prep-stage-name">{{ $task['stage_name'] }}</div>
                                    <div class="prep-product">
                                        {{ $task['product_name'] }}
                                        <span class="qty">×{{ $task['quantity'] }}</span>
                                    </div>
                                    <div class="prep-meta">
                                        <span>📦 {{ $task['order_number'] }}</span>
                                        <span>👤 {{ $task['customer'] }}</span>
                                        <span>📅 Due: {{ $task['due'] }}</span>
                                        <span class="prep-badge prep-badge-{{ $task['fulfillment'] }}">{{ ucfirst($task['fulfillment']) }}</span>
                                    </div>
                                    @if($task['instructions'])
                                        <div class="prep-instructions">{{ $task['instructions'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </x-admin.card>
                @endif
            @endfor
        @endif
    </div>
</x-filament-panels::page>
