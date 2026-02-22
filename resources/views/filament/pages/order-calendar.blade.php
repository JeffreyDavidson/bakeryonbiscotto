<x-filament-panels::page>
    {{-- Month navigation --}}
    <div class="flex items-center justify-between mb-6">
        <button wire:click="previousMonth" type="button" class="inline-flex items-center gap-1 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
            <x-heroicon-m-chevron-left class="h-4 w-4" />
            Prev
        </button>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $this->monthLabel }}</h2>
        <button wire:click="nextMonth" type="button" class="inline-flex items-center gap-1 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
            Next
            <x-heroicon-m-chevron-right class="h-4 w-4" />
        </button>
    </div>

    {{-- Calendar grid --}}
    <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
        {{-- Day headers --}}
        <div class="grid grid-cols-7 border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-700">
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                <div class="px-2 py-2 text-center text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">{{ $dayName }}</div>
            @endforeach
        </div>

        {{-- Weeks --}}
        @foreach($this->calendarData as $week)
            <div class="grid grid-cols-7 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                @foreach($week as $cell)
                    @if($cell === null)
                        <div class="min-h-[5rem] border-r border-gray-100 bg-gray-50/50 dark:border-gray-700 dark:bg-gray-800/50 last:border-r-0"></div>
                    @else
                        @php
                            $bg = match(true) {
                                $cell['count'] >= 3 => 'bg-primary-50 dark:bg-primary-900/20',
                                $cell['count'] >= 1 => 'bg-green-50 dark:bg-green-900/20',
                                default => '',
                            };
                            $isToday = $cell['date'] === now()->format('Y-m-d');
                        @endphp
                        <a
                            href="{{ \App\Filament\Resources\OrderResource::getUrl('index', ['tableSearch' => '', 'tableFilters' => []]) . '&tableFilters[requested_date][value]=' . $cell['date'] }}"
                            class="min-h-[5rem] border-r border-gray-100 dark:border-gray-700 last:border-r-0 p-2 {{ $bg }} hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors block"
                        >
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium {{ $isToday ? 'inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-600 text-white' : 'text-gray-700 dark:text-gray-300' }}">
                                    {{ $cell['day'] }}
                                </span>
                            </div>
                            @if($cell['count'] > 0)
                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">{{ $cell['count'] }} {{ Str::plural('order', $cell['count']) }}</span>
                                    <br>
                                    <span>${{ number_format($cell['revenue'], 0) }}</span>
                                </div>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
