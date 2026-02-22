<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class WeeklyRevenueChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = "This Week's Revenue";

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $period = CarbonPeriod::create($start, $end);

        $labels = [];
        $data = [];

        foreach ($period as $date) {
            $labels[] = $date->format('D');
            $data[] = (float) Order::where('status', '!=', 'cancelled')
                ->whereDate('requested_date', $date)
                ->sum('total');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue ($)',
                    'data' => $data,
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
