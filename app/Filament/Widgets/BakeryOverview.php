<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BakeryOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalReviews = Review::approved()->count();
        $pendingReviews = Review::pending()->count();
        $avgRating = Review::approved()->avg('rating');

        return [
            Stat::make('Approved Reviews', $totalReviews)
                ->description('Showing on the site')
                ->icon('heroicon-o-star')
                ->color('success'),
            Stat::make('Pending Reviews', $pendingReviews)
                ->description('Awaiting your approval')
                ->icon('heroicon-o-clock')
                ->color($pendingReviews > 0 ? 'warning' : 'gray'),
            Stat::make('Average Rating', $avgRating ? number_format($avgRating, 1) . ' ⭐' : 'No reviews yet')
                ->description($totalReviews > 0 ? "Based on {$totalReviews} reviews" : 'Submit your site to get started!')
                ->icon('heroicon-o-heart')
                ->color('primary'),
        ];
    }
}
