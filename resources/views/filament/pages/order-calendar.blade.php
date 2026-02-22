<x-filament-panels::page>
    <style>
        .cal-nav { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .cal-nav-btn { display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background: white; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; color: #374151; cursor: pointer; transition: all 0.15s; }
        .cal-nav-btn:hover { background: #f3f4f6; border-color: #9ca3af; }
        .cal-month { font-size: 1.5rem; font-weight: 700; color: #111827; }

        .cal-grid { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: white; overflow: hidden; }
        .cal-header { display: grid; grid-template-columns: repeat(7, 1fr); border-bottom: 2px solid #e5e7eb; background: #f9fafb; }
        .cal-header-cell { padding: 0.625rem; text-align: center; font-size: 0.75rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; }
        .cal-week { display: grid; grid-template-columns: repeat(7, 1fr); border-bottom: 1px solid #f3f4f6; }
        .cal-week:last-child { border-bottom: none; }

        .cal-cell { min-height: 6rem; padding: 0.5rem; border-right: 1px solid #f3f4f6; transition: all 0.15s; position: relative; }
        .cal-cell:last-child { border-right: none; }
        .cal-cell:hover { background: #fffbeb; }
        .cal-cell.empty { background: #fafafa; }
        .cal-cell.empty:hover { background: #fafafa; }
        .cal-cell.has-orders { cursor: pointer; text-decoration: none; display: block; color: inherit; }
        .cal-cell.light { background: #f0fdf4; }
        .cal-cell.busy { background: #eff6ff; }
        .cal-cell.light:hover { background: #dcfce7; }
        .cal-cell.busy:hover { background: #dbeafe; }

        .cal-day { font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem; }
        .cal-day.today { display: inline-flex; align-items: center; justify-content: center; width: 1.75rem; height: 1.75rem; border-radius: 9999px; background: #92400e; color: white; font-weight: 700; }

        .cal-orders { margin-top: 0.25rem; }
        .cal-order-count { font-size: 0.75rem; font-weight: 700; color: #111827; }
        .cal-order-revenue { font-size: 0.7rem; color: #6b7280; margin-top: 0.125rem; }
        .cal-order-dots { display: flex; gap: 0.25rem; margin-top: 0.375rem; }
        .cal-dot { width: 0.375rem; height: 0.375rem; border-radius: 9999px; background: #92400e; }
        .cal-dot.extra { background: #d1d5db; }

        .cal-summary { display: flex; gap: 1.5rem; margin-top: 1rem; padding: 1rem 1.25rem; border-radius: 0.75rem; background: white; border: 1px solid #e5e7eb; }
        .cal-summary-item { text-align: center; }
        .cal-summary-value { font-size: 1.5rem; font-weight: 700; color: #111827; }
        .cal-summary-label { font-size: 0.7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; }
    </style>

    {{-- Navigation --}}
    <div class="cal-nav">
        <button wire:click="previousMonth" class="cal-nav-btn">◀ Prev</button>
        <span class="cal-month">{{ $this->monthLabel }}</span>
        <button wire:click="nextMonth" class="cal-nav-btn">Next ▶</button>
    </div>

    {{-- Monthly summary --}}
    @php
        $totalOrders = 0;
        $totalRevenue = 0;
        $busyDay = null;
        $busyDayCount = 0;
        foreach ($this->calendarData as $week) {
            foreach ($week as $cell) {
                if ($cell !== null && $cell['count'] > 0) {
                    $totalOrders += $cell['count'];
                    $totalRevenue += $cell['revenue'];
                    if ($cell['count'] > $busyDayCount) {
                        $busyDayCount = $cell['count'];
                        $busyDay = $cell['day'];
                    }
                }
            }
        }
        $daysWithOrders = 0;
        foreach ($this->calendarData as $week) {
            foreach ($week as $cell) {
                if ($cell !== null && $cell['count'] > 0) $daysWithOrders++;
            }
        }
    @endphp
    <div class="cal-summary">
        <div class="cal-summary-item">
            <div class="cal-summary-value">{{ $totalOrders }}</div>
            <div class="cal-summary-label">Total Orders</div>
        </div>
        <div class="cal-summary-item">
            <div class="cal-summary-value">${{ number_format($totalRevenue, 0) }}</div>
            <div class="cal-summary-label">Revenue</div>
        </div>
        <div class="cal-summary-item">
            <div class="cal-summary-value">{{ $daysWithOrders }}</div>
            <div class="cal-summary-label">Active Days</div>
        </div>
        @if($busyDay)
        <div class="cal-summary-item">
            <div class="cal-summary-value">{{ $busyDay }}th</div>
            <div class="cal-summary-label">Busiest Day</div>
        </div>
        @endif
    </div>

    {{-- Calendar --}}
    <div class="cal-grid" style="margin-top: 1rem;">
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
                                <div class="cal-orders">
                                    <div class="cal-order-count">{{ $cell['count'] }} {{ Str::plural('order', $cell['count']) }}</div>
                                    <div class="cal-order-revenue">${{ number_format($cell['revenue'], 0) }}</div>
                                    <div class="cal-order-dots">
                                        @for($i = 0; $i < min($cell['count'], 5); $i++)
                                            <div class="cal-dot"></div>
                                        @endfor
                                        @if($cell['count'] > 5)
                                            <div class="cal-dot extra"></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @if($cell['count'] > 0)
                            </a>
                        @else
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
