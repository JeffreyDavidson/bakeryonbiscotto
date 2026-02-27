<x-filament-panels::page>
    <style>
        .prep-day-today { border: 2px solid var(--brand-600) !important; }
        .prep-day-today > div:first-child { background: linear-gradient(135deg, var(--brand-600), var(--brand-700)) !important; }

        .prep-task { display: flex; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid var(--brand-150); align-items: flex-start; }
        .prep-task:last-child { border-bottom: none; }
        .prep-task:hover { background: rgba(245,230,208,0.3); }
        .prep-divider { width: 3px; background: var(--brand-200); border-radius: 999px; min-height: 50px; flex-shrink: 0; position: relative; }
        .prep-dot { position: absolute; top: 4px; left: 50%; transform: translateX(-50%); width: 10px; height: 10px; border-radius: 50%; border: 2px solid var(--brand-600); background: #fff; }

        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, button { display: none !important; }
            .fi-main { padding: 0 !important; margin: 0 !important; }
        }
    </style>

    <div style="max-width: 1200px; margin: 0 auto;">
        @php
            $weekStartDate = \Carbon\Carbon::parse($this->weekStart);
            $weekEndDate = $weekStartDate->copy()->addDays(6);
            $today = now()->toDateString();
        @endphp

        <x-admin.nav-controls :label="$weekStartDate->format('M j') . ' — ' . $weekEndDate->format('M j, Y')" prevClick="previousWeek" nextClick="nextWeek" prevLabel="← Prev" nextLabel="Next →">
            <x-slot:before>
                <x-admin.btn variant="secondary" wire:click="thisWeek">This Week</x-admin.btn>
            </x-slot:before>
        </x-admin.nav-controls>

        @php $stats = $this->weekStats; @endphp
        <x-admin.stat-grid :cols="3" data-stat-grid>
            <x-admin.stat-card label="Prep Tasks" :value="$stats['total_tasks']" />
            <x-admin.stat-card label="Est. Work Time" :value="$stats['total_hours'] . 'h'" />
            <x-admin.stat-card label="Products to Make" :value="$stats['unique_products']" />
        </x-admin.stat-grid>

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
                                <div style="min-width: 80px; text-align: right; flex-shrink: 0;">
                                    <div style="font-weight: 700; color: var(--brand-900); font-size: 0.9rem;">{{ $task['time'] }}</div>
                                    @if($task['duration'])
                                        <div style="font-size: 0.7rem; color: var(--brand-500); margin-top: 0.125rem;">~{{ $task['duration'] }} min</div>
                                    @endif
                                </div>
                                <div class="prep-divider"><div class="prep-dot"></div></div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 700; color: var(--brand-900); font-size: 0.9rem;">{{ $task['stage_name'] }}</div>
                                    <div style="font-size: 0.85rem; color: var(--brand-700); margin-top: 0.125rem;">
                                        {{ $task['product_name'] }}
                                        <x-admin.pill bg="var(--brand-100)" borderColor="var(--brand-100)" color="var(--brand-900)" style="font-weight:600;font-size:0.75rem;padding:0.1rem 0.5rem;">×{{ $task['quantity'] }}</x-admin.pill>
                                    </div>
                                    <div style="display: flex; gap: 0.75rem; margin-top: 0.375rem; font-size: 0.75rem; color: var(--brand-500); flex-wrap: wrap;">
                                        <span>📦 {{ $task['order_number'] }}</span>
                                        <span>👤 {{ $task['customer'] }}</span>
                                        <span>📅 Due: {{ $task['due'] }}</span>
                                        <x-admin.badge :type="$task['fulfillment']" />
                                    </div>
                                    @if($task['instructions'])
                                        <div style="font-size: 0.8rem; color: var(--brand-600); margin-top: 0.375rem; font-style: italic; background: var(--brand-50); padding: 0.375rem 0.625rem; border-radius: 6px; border-left: 3px solid var(--brand-300);">{{ $task['instructions'] }}</div>
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
