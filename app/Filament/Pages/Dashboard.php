<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BakingSheetWidget;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TodaysOrdersWidget;
use App\Filament\Widgets\PopularProductsWidget;
use App\Filament\Widgets\WeeklyRevenueChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Bakery Dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            TodaysOrdersWidget::class,
            BakingSheetWidget::class,
            WeeklyRevenueChart::class,
            PopularProductsWidget::class,
        ];
    }
}
