<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BakeryOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $pendingOrders = Order::pending()->count();
        $activeOrders = Order::active()->count();
        $todaysRevenue = Order::where('payment_status', 'paid')
            ->whereDate('paid_at', today())
            ->sum('total');
        $pendingReviews = Review::pending()->count();

        return [
            Stat::make('Active Orders', $activeOrders)
                ->description($pendingOrders > 0 ? "{$pendingOrders} need confirmation" : 'All confirmed')
                ->icon('heroicon-o-clipboard-document-list')
                ->color($pendingOrders > 0 ? 'warning' : 'success'),
            Stat::make("Today's Revenue", '$' . number_format($todaysRevenue, 2))
                ->description('From paid orders')
                ->icon('heroicon-o-banknotes')
                ->color('success'),
            Stat::make('Products Available', Product::available()->count())
                ->description(Product::count() . ' total products')
                ->icon('heroicon-o-shopping-bag')
                ->color('primary'),
            Stat::make('Pending Reviews', $pendingReviews)
                ->description($pendingReviews > 0 ? 'Awaiting approval' : 'All caught up!')
                ->icon('heroicon-o-star')
                ->color($pendingReviews > 0 ? 'warning' : 'gray'),
        ];
    }
}
