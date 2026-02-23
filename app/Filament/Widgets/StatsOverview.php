<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        return [
            Stat::make("Today's Orders", Order::whereDate('requested_date', $today)->count())
                ->icon('heroicon-o-shopping-bag')
                ->color('primary'),

            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make("This Week's Revenue", '$' . number_format(
                (float) Order::where('status', '!=', 'cancelled')
                    ->whereBetween('requested_date', [$weekStart, Carbon::now()->endOfWeek()])
                    ->sum('total'),
                2
            ))
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Total Customers', Order::distinct('customer_email')->count('customer_email'))
                ->icon('heroicon-o-users')
                ->color('info'),
        ];
    }
}
