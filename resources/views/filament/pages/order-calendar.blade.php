<x-filament-panels::page>
    <style>
        .cal-grid { border-radius: 0.75rem; border: 1px solid #e8d0b0; background: white; overflow: hidden; }
        .cal-header { display: grid; grid-template-columns: repeat(7, 1fr); border-bottom: 2px solid #d4a574; background: linear-gradient(135deg, #3d2314, #6b4c3b); }
        .cal-header-cell { padding: 0.625rem; text-align: center; font-size: 0.75rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.05em; }
        .cal-week { display: grid; grid-template-columns: repeat(7, 1fr); border-bottom: 1px solid #f3ebe0; }
        .cal-week:last-child { border-bottom: none; }
        .cal-cell { min-height: 6rem; padding: 0.5rem; border-right: 1px solid #f3ebe0; transition: all 0.15s; }
        .cal-cell:last-child { border-right: none; }
        .cal-cell:hover { background: #fdf8f2; }
        .cal-cell.empty { background: #fafaf8; }
        .cal-cell.empty:hover { background: #fafaf8; }
        .cal-cell.has-orders { cursor: pointer; text-decoration: none; display: block; color: inherit; }
        .cal-cell.light { background: #fdf8f2; }
        .cal-cell.busy { background: #f5e6d0; }
        .cal-cell.light:hover { background: #f5e6d0; }
        .cal-cell.busy:hover { background: #e8d0b0; }
        .cal-day { font-size: 0.875rem; font-weight: 500; color: #4a3225; margin-bottom: 0.375rem; }
        .cal-day.today { display: inline-flex; align-items: center; justify-content: center; width: 1.75rem; height: 1.75rem; border-radius: 9999px; background: #8b5e3c; color: white; font-weight: 700; }
    </style>

    <x-admin.nav-controls :label="$this->monthLabel" prevClick="previousMonth" nextClick="nextMonth" prevLabel="◀ Prev" nextLabel="Next ▶" />

    @php
        $totalOrders = 0; $totalRevenue = 0; $busyDay = null; $busyDayCount = 0; $daysWithOrders = 0;
        foreach ($this->calendarData as $week) {
            foreach ($week as $cell) {
                if ($cell !== null && $cell['count'] > 0) {
                    $totalOrders += $cell['count']; $totalRevenue += $cell['revenue']; $daysWithOrders++;
                    if ($cell['count'] > $busyDayCount) { $busyDayCount = $cell['count']; $busyDay = $cell['day']; }
                }
            }
        }
    @endphp

    <x-admin.stat-grid :cols="$busyDay ? 4 : 3" data-stat-grid>
        <x-admin.stat-card label="Total Orders" :value="$totalOrders" />
        <x-admin.stat-card label="Revenue" :value="'$' . number_format($totalRevenue, 0)" />
        <x-admin.stat-card label="Active Days" :value="$daysWithOrders" />
        @if($busyDay)
            <x-admin.stat-card label="Busiest Day" :value="$busyDay . 'th'" />
        @endif
    </x-admin.stat-grid>

    <div class="cal-grid">
        <div class="cal-header">
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                <div class="cal-header-cell">{{ $dayName }}</div>
            @endforeach
        </div>
        @foreach($this->calendarData as $week)
            <div class="cal-week">
                @foreach($week as $cell)
                    @if($cell === null)
                        <div class="cal-cell empty"></div>
                    @else
                        @php
                            $cellClass = 'cal-cell';
                            if ($cell['count'] >= 3) $cellClass .= ' busy';
                            elseif ($cell['count'] >= 1) $cellClass .= ' light';
                            $isToday = $cell['date'] === now()->format('Y-m-d');
                        @endphp
                        @if($cell['count'] > 0)
                            <a href="/admin/baking-sheet?date={{ $cell['date'] }}" class="{{ $cellClass }} has-orders">
                        @else
                            <div class="{{ $cellClass }}">
                        @endif
                            <div class="cal-day {{ $isToday ? 'today' : '' }}">{{ $cell['day'] }}</div>
                            @if($cell['count'] > 0)
                                <div style="margin-top:0.25rem;">
                                    <div style="font-size:0.75rem;font-weight:700;color:#3d2314;">{{ $cell['count'] }} {{ Str::plural('order', $cell['count']) }}</div>
                                    <div style="font-size:0.7rem;color:#a08060;margin-top:0.125rem;">${{ number_format($cell['revenue'], 0) }}</div>
                                    <div style="display:flex;gap:0.25rem;margin-top:0.375rem;">
                                        @for($i = 0; $i < min($cell['count'], 5); $i++)
                                            <div style="width:0.375rem;height:0.375rem;border-radius:9999px;background:#8b5e3c;"></div>
                                        @endfor
                                        @if($cell['count'] > 5)
                                            <div style="width:0.375rem;height:0.375rem;border-radius:9999px;background:#e8d0b0;"></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @if($cell['count'] > 0) </a> @else </div> @endif
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
