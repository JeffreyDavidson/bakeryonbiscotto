<?php

namespace App\Filament\Pages;

use App\Models\Review;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewAnalytics extends Page
{
    protected string $view = 'filament.pages.review-analytics';

    protected static ?string $navigationLabel = 'Review Analytics';

    protected static ?string $title = 'Review Analytics';

    protected static ?int $navigationSort = 20;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-chart-bar';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Communication';
    }

    public function getViewData(): array
    {
        $reviews = Review::query();
        $totalReviews = (clone $reviews)->count();
        $approvedCount = (clone $reviews)->where('status', 'approved')->count();
        $pendingCount = (clone $reviews)->where('status', 'pending')->count();
        $rejectedCount = (clone $reviews)->where('status', 'rejected')->count();
        $averageRating = $totalReviews > 0 ? round((clone $reviews)->avg('rating'), 1) : 0;

        // Rating distribution
        $ratingDistribution = [];
        $ratingCounts = Review::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        for ($i = 5; $i >= 1; $i--) {
            $count = $ratingCounts[$i] ?? 0;
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $totalReviews > 0 ? round(($count / $totalReviews) * 100, 1) : 0,
            ];
        }

        // Sentiment
        $positiveCount = Review::whereBetween('rating', [4, 5])->count();
        $mixedCount = Review::where('rating', 3)->count();
        $negativeCount = Review::whereBetween('rating', [1, 2])->count();

        $sentiment = [
            'positive' => $totalReviews > 0 ? round(($positiveCount / $totalReviews) * 100, 1) : 0,
            'mixed' => $totalReviews > 0 ? round(($mixedCount / $totalReviews) * 100, 1) : 0,
            'negative' => $totalReviews > 0 ? round(($negativeCount / $totalReviews) * 100, 1) : 0,
        ];

        // Monthly trend (last 6 months)
        $monthlyTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = Review::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $monthlyTrend[] = [
                'month' => $date->format('M Y'),
                'count' => $count,
            ];
        }
        $maxMonthly = max(array_column($monthlyTrend, 'count') ?: [1]);

        // Favorite breads analytics (replacing product analytics)
        $breadStats = Review::select('favorite_bread', DB::raw('count(*) as review_count'), DB::raw('round(avg(rating), 1) as avg_rating'))
            ->whereNotNull('favorite_bread')
            ->where('favorite_bread', '!=', '')
            ->groupBy('favorite_bread')
            ->orderByDesc('review_count')
            ->get();

        $topBreads = $breadStats->take(10);

        return [
            'totalReviews' => $totalReviews,
            'approvedCount' => $approvedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'averageRating' => $averageRating,
            'ratingDistribution' => $ratingDistribution,
            'sentiment' => $sentiment,
            'monthlyTrend' => $monthlyTrend,
            'maxMonthly' => $maxMonthly ?: 1,
            'topBreads' => $topBreads,
            'breadStats' => $breadStats,
        ];
    }
}
