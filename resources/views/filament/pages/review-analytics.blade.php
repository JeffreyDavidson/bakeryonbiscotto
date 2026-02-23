<x-filament-panels::page>
    <style>
        @media print {
            .fi-sidebar, .fi-topbar, .fi-header-heading-actions { display: none !important; }
            .fi-main { padding: 0 !important; }
        }
        .analytics-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid #e8d0b0;
        }
        .dark .analytics-card {
            background: #1e1b18;
            border-color: #3d2314;
        }
        .analytics-card-header {
            font-size: 0.875rem;
            font-weight: 600;
            color: #3d2314;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e8d0b0;
        }
        .dark .analytics-card-header {
            color: #e8d0b0;
            border-bottom-color: #3d2314;
        }
        .stat-big-number {
            font-size: 3rem;
            font-weight: 700;
            color: #3d2314;
            line-height: 1;
        }
        .dark .stat-big-number {
            color: #d4a574;
        }
        .stat-label {
            font-size: 0.75rem;
            color: #6b4c3b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .dark .stat-label {
            color: #a08070;
        }
        .rating-bar-track {
            background: #fdf8f2;
            border-radius: 0.25rem;
            height: 1.25rem;
            flex: 1;
            overflow: hidden;
        }
        .dark .rating-bar-track {
            background: #2a2218;
        }
        .rating-bar-fill {
            background: linear-gradient(90deg, #d4a574, #c49054);
            height: 100%;
            border-radius: 0.25rem;
            transition: width 0.6s ease;
            min-width: 2px;
        }
        .star-display {
            color: #d4a574;
            letter-spacing: -1px;
        }
        .sentiment-positive { color: #16a34a; }
        .sentiment-mixed { color: #d97706; }
        .sentiment-negative { color: #dc2626; }
        .trend-bar {
            background: linear-gradient(180deg, #d4a574, #c49054);
            border-radius: 0.25rem 0.25rem 0 0;
            transition: height 0.6s ease;
            min-height: 4px;
        }
        .mini-stat {
            text-align: center;
            padding: 1rem;
            border-radius: 0.5rem;
            background: #fdf8f2;
        }
        .dark .mini-stat {
            background: #2a2218;
        }
    </style>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Overall Rating --}}
        <div class="analytics-card flex flex-col items-center justify-center text-center">
            <div class="analytics-card-header w-full">Overall Rating</div>
            <div class="stat-big-number mt-2">{{ $averageRating }}</div>
            <div class="star-display text-2xl mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($averageRating))
                        &#9733;
                    @elseif ($i - $averageRating < 1 && $i - $averageRating > 0)
                        &#9733;
                    @else
                        &#9734;
                    @endif
                @endfor
            </div>
            <div class="stat-label mt-2">Based on {{ $totalReviews }} reviews</div>
        </div>

        {{-- Rating Distribution --}}
        <div class="analytics-card lg:col-span-2">
            <div class="analytics-card-header">Rating Distribution</div>
            <div class="space-y-2">
                @foreach ($ratingDistribution as $stars => $data)
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium w-12 text-right" style="color: #3d2314;">{{ $stars }} star</span>
                        <div class="rating-bar-track">
                            <div class="rating-bar-fill" style="width: {{ max($data['percentage'], 0.5) }}%"></div>
                        </div>
                        <span class="text-sm w-16 text-right" style="color: #6b4c3b;">{{ $data['percentage'] }}%</span>
                        <span class="text-xs w-10 text-right" style="color: #6b4c3b;">({{ $data['count'] }})</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
        <div class="mini-stat">
            <div class="text-2xl font-bold" style="color: #3d2314;">{{ $totalReviews }}</div>
            <div class="stat-label">Total Reviews</div>
        </div>
        <div class="mini-stat">
            <div class="text-2xl font-bold" style="color: #16a34a;">{{ $approvedCount }}</div>
            <div class="stat-label">Approved</div>
        </div>
        <div class="mini-stat">
            <div class="text-2xl font-bold" style="color: #d97706;">{{ $pendingCount }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="mini-stat">
            <div class="text-2xl font-bold" style="color: #dc2626;">{{ $rejectedCount }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        {{-- Sentiment --}}
        <div class="analytics-card">
            <div class="analytics-card-header">Review Sentiment</div>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium sentiment-positive">Positive (4-5 stars)</span>
                        <span class="text-sm font-medium sentiment-positive">{{ $sentiment['positive'] }}%</span>
                    </div>
                    <div class="rating-bar-track">
                        <div style="width: {{ $sentiment['positive'] }}%; background: #16a34a; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium sentiment-mixed">Mixed (3 stars)</span>
                        <span class="text-sm font-medium sentiment-mixed">{{ $sentiment['mixed'] }}%</span>
                    </div>
                    <div class="rating-bar-track">
                        <div style="width: {{ max($sentiment['mixed'], 0.5) }}%; background: #d97706; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium sentiment-negative">Negative (1-2 stars)</span>
                        <span class="text-sm font-medium sentiment-negative">{{ $sentiment['negative'] }}%</span>
                    </div>
                    <div class="rating-bar-track">
                        <div style="width: {{ max($sentiment['negative'], 0.5) }}%; background: #dc2626; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Monthly Trend --}}
        <div class="analytics-card">
            <div class="analytics-card-header">Monthly Review Trend</div>
            <div class="flex items-end justify-between gap-2" style="height: 160px;">
                @foreach ($monthlyTrend as $month)
                    <div class="flex flex-col items-center flex-1">
                        <span class="text-xs font-medium mb-1" style="color: #3d2314;">{{ $month['count'] }}</span>
                        <div class="w-full flex items-end" style="height: 120px;">
                            <div class="trend-bar w-full" style="height: {{ $maxMonthly > 0 ? max(($month['count'] / $maxMonthly) * 100, 3) : 3 }}%;"></div>
                        </div>
                        <span class="text-xs mt-1 text-center" style="color: #6b4c3b;">{{ \Illuminate\Support\Str::limit($month['month'], 7, '') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Bread Stats Table --}}
    @if ($breadStats->isNotEmpty())
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="analytics-card">
            <div class="analytics-card-header">Top Reviewed Breads</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="border-bottom: 2px solid #e8d0b0;">
                            <th class="text-left py-2 font-semibold" style="color: #3d2314;">Bread</th>
                            <th class="text-center py-2 font-semibold" style="color: #3d2314;">Avg Rating</th>
                            <th class="text-right py-2 font-semibold" style="color: #3d2314;">Reviews</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topBreads as $bread)
                            <tr style="border-bottom: 1px solid #fdf8f2;">
                                <td class="py-2" style="color: #6b4c3b;">{{ $bread->favorite_bread }}</td>
                                <td class="text-center py-2">
                                    <span class="star-display">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($bread->avg_rating))
                                                &#9733;
                                            @else
                                                &#9734;
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-xs" style="color: #6b4c3b;">{{ $bread->avg_rating }}</span>
                                </td>
                                <td class="text-right py-2 font-medium" style="color: #3d2314;">{{ $bread->review_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Average Rating by Bread --}}
        <div class="analytics-card">
            <div class="analytics-card-header">Rating by Bread Type</div>
            <div class="space-y-3">
                @foreach ($breadStats->sortByDesc('avg_rating')->take(10) as $bread)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm" style="color: #6b4c3b;">{{ $bread->favorite_bread }}</span>
                            <span class="text-sm font-medium" style="color: #3d2314;">{{ $bread->avg_rating }} / 5</span>
                        </div>
                        <div class="rating-bar-track">
                            <div class="rating-bar-fill" style="width: {{ ($bread->avg_rating / 5) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</x-filament-panels::page>
