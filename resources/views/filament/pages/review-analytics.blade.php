<x-filament-panels::page>
    <style>
        @media print {
            .fi-sidebar, .fi-topbar, .fi-header-heading-actions { display: none !important; }
            .fi-main { padding: 0 !important; }
        }
        .ra-grid { display: grid; gap: 1.5rem; }
        .ra-grid-3 { grid-template-columns: 1fr; }
        .ra-grid-2 { grid-template-columns: 1fr; }
        .ra-grid-4 { grid-template-columns: repeat(2, 1fr); }
        @media (min-width: 768px) { .ra-grid-4 { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 1024px) {
            .ra-grid-3 { grid-template-columns: 1fr 2fr; }
            .ra-grid-2 { grid-template-columns: repeat(2, 1fr); }
        }
        .ra-big-number { font-size: 3rem; font-weight: 700; color: #3d2314; line-height: 1; }
        .ra-stars { color: #d4a574; letter-spacing: -1px; font-size: 1.5rem; }
        .ra-label { font-size: 0.75rem; color: #6b4c3b; text-transform: uppercase; letter-spacing: 0.05em; }
        .ra-bar-track { background: #fdf8f2; border-radius: 0.25rem; height: 1.25rem; flex: 1; overflow: hidden; }
        .ra-bar-fill { background: linear-gradient(90deg, #d4a574, #c49054); height: 100%; border-radius: 0.25rem; transition: width 0.6s ease; min-width: 2px; }
        .ra-bar-row { display: flex; align-items: center; gap: 0.75rem; }
        .ra-bar-label { font-size: 0.875rem; font-weight: 500; width: 3.5rem; text-align: right; color: #3d2314; }
        .ra-bar-pct { font-size: 0.875rem; width: 3.5rem; text-align: right; color: #6b4c3b; }
        .ra-bar-count { font-size: 0.75rem; width: 2.5rem; text-align: right; color: #6b4c3b; }
        .ra-mini-stat { text-align: center; padding: 1rem; border-radius: 0.5rem; background: #fdf8f2; }
        .ra-mini-stat-value { font-size: 1.5rem; font-weight: 700; }
        .ra-sentiment-row { margin-bottom: 1rem; }
        .ra-sentiment-header { display: flex; justify-content: space-between; margin-bottom: 0.25rem; font-size: 0.875rem; font-weight: 500; }
        .ra-trend-container { display: flex; align-items: flex-end; justify-content: space-between; gap: 0.5rem; height: 160px; }
        .ra-trend-col { display: flex; flex-direction: column; align-items: center; flex: 1; }
        .ra-trend-count { font-size: 0.75rem; font-weight: 500; color: #3d2314; margin-bottom: 0.25rem; }
        .ra-trend-bar-wrap { width: 100%; display: flex; align-items: flex-end; height: 120px; }
        .ra-trend-bar { background: linear-gradient(180deg, #d4a574, #c49054); border-radius: 0.25rem 0.25rem 0 0; width: 100%; transition: height 0.6s ease; min-height: 4px; }
        .ra-trend-label { font-size: 0.75rem; color: #6b4c3b; margin-top: 0.25rem; text-align: center; }
        .ra-table { width: 100%; font-size: 0.875rem; border-collapse: collapse; }
        .ra-table th { text-align: left; padding: 0.5rem 0; font-weight: 600; color: #3d2314; border-bottom: 2px solid #e8d0b0; }
        .ra-table th:nth-child(2) { text-align: center; }
        .ra-table th:last-child { text-align: right; }
        .ra-table td { padding: 0.5rem 0; color: #6b4c3b; border-bottom: 1px solid #f5efe6; }
        .ra-table td:nth-child(2) { text-align: center; }
        .ra-table td:last-child { text-align: right; font-weight: 500; color: #3d2314; }
        .ra-rating-row { margin-bottom: 0.75rem; }
        .ra-rating-row-header { display: flex; justify-content: space-between; margin-bottom: 0.25rem; }
        .ra-rating-row-name { font-size: 0.875rem; color: #6b4c3b; }
        .ra-rating-row-value { font-size: 0.875rem; font-weight: 500; color: #3d2314; }
    </style>

    {{-- Row 1: Overall Rating + Distribution --}}
    <div class="ra-grid ra-grid-3">
        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Overall Rating" />
            </x-slot:header>
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1rem 0;">
                <div class="ra-big-number">{{ $averageRating }}</div>
                <div class="ra-stars" style="margin-top: 0.5rem;">
                    @for ($i = 1; $i <= 5; $i++)
                        {!! $i <= round($averageRating) ? '&#9733;' : '&#9734;' !!}
                    @endfor
                </div>
                <div class="ra-label" style="margin-top: 0.5rem;">Based on {{ $totalReviews }} reviews</div>
            </div>
        </x-admin.card>

        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Rating Distribution" />
            </x-slot:header>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                @foreach ($ratingDistribution as $stars => $data)
                    <div class="ra-bar-row">
                        <span class="ra-bar-label">{{ $stars }} star</span>
                        <div class="ra-bar-track">
                            <div class="ra-bar-fill" style="width: {{ max($data['percentage'], 0.5) }}%"></div>
                        </div>
                        <span class="ra-bar-pct">{{ $data['percentage'] }}%</span>
                        <span class="ra-bar-count">({{ $data['count'] }})</span>
                    </div>
                @endforeach
            </div>
        </x-admin.card>
    </div>

    {{-- Row 2: Stats --}}
    <div class="ra-grid ra-grid-4" style="margin-top: 1.5rem;">
        <div class="ra-mini-stat">
            <div class="ra-mini-stat-value" style="color: #3d2314;">{{ $totalReviews }}</div>
            <div class="ra-label">Total Reviews</div>
        </div>
        <div class="ra-mini-stat">
            <div class="ra-mini-stat-value" style="color: #16a34a;">{{ $approvedCount }}</div>
            <div class="ra-label">Approved</div>
        </div>
        <div class="ra-mini-stat">
            <div class="ra-mini-stat-value" style="color: #d97706;">{{ $pendingCount }}</div>
            <div class="ra-label">Pending</div>
        </div>
        <div class="ra-mini-stat">
            <div class="ra-mini-stat-value" style="color: #dc2626;">{{ $rejectedCount }}</div>
            <div class="ra-label">Rejected</div>
        </div>
    </div>

    {{-- Row 3: Sentiment + Monthly Trend --}}
    <div class="ra-grid ra-grid-2" style="margin-top: 1.5rem;">
        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Review Sentiment" />
            </x-slot:header>
            <div>
                <div class="ra-sentiment-row">
                    <div class="ra-sentiment-header">
                        <span style="color: #16a34a;">Positive (4-5 stars)</span>
                        <span style="color: #16a34a;">{{ $sentiment['positive'] }}%</span>
                    </div>
                    <div class="ra-bar-track">
                        <div style="width: {{ $sentiment['positive'] }}%; background: #16a34a; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
                <div class="ra-sentiment-row">
                    <div class="ra-sentiment-header">
                        <span style="color: #d97706;">Mixed (3 stars)</span>
                        <span style="color: #d97706;">{{ $sentiment['mixed'] }}%</span>
                    </div>
                    <div class="ra-bar-track">
                        <div style="width: {{ max($sentiment['mixed'], 0.5) }}%; background: #d97706; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
                <div class="ra-sentiment-row">
                    <div class="ra-sentiment-header">
                        <span style="color: #dc2626;">Negative (1-2 stars)</span>
                        <span style="color: #dc2626;">{{ $sentiment['negative'] }}%</span>
                    </div>
                    <div class="ra-bar-track">
                        <div style="width: {{ max($sentiment['negative'], 0.5) }}%; background: #dc2626; height: 100%; border-radius: 0.25rem;"></div>
                    </div>
                </div>
            </div>
        </x-admin.card>

        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Monthly Review Trend" />
            </x-slot:header>
            <div class="ra-trend-container">
                @foreach ($monthlyTrend as $month)
                    <div class="ra-trend-col">
                        <span class="ra-trend-count">{{ $month['count'] }}</span>
                        <div class="ra-trend-bar-wrap">
                            <div class="ra-trend-bar" style="height: {{ $maxMonthly > 0 ? max(($month['count'] / $maxMonthly) * 100, 3) : 3 }}%;"></div>
                        </div>
                        <span class="ra-trend-label">{{ \Illuminate\Support\Str::limit($month['month'], 7, '') }}</span>
                    </div>
                @endforeach
            </div>
        </x-admin.card>
    </div>

    {{-- Row 4: Bread Stats --}}
    @if ($breadStats->isNotEmpty())
    <div class="ra-grid ra-grid-2" style="margin-top: 1.5rem;">
        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Top Reviewed Breads" />
            </x-slot:header>
            <table class="ra-table">
                <thead>
                    <tr>
                        <th>Bread</th>
                        <th>Avg Rating</th>
                        <th>Reviews</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topBreads as $bread)
                        <tr>
                            <td>{{ $bread->favorite_bread }}</td>
                            <td>
                                <span class="ra-stars" style="font-size: 0.875rem;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {!! $i <= round($bread->avg_rating) ? '&#9733;' : '&#9734;' !!}
                                    @endfor
                                </span>
                                <span style="font-size: 0.75rem; color: #6b4c3b;">{{ $bread->avg_rating }}</span>
                            </td>
                            <td>{{ $bread->review_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-admin.card>

        <x-admin.card>
            <x-slot:header>
                <x-admin.card-header title="Rating by Bread Type" />
            </x-slot:header>
            <div>
                @foreach ($breadStats->sortByDesc('avg_rating')->take(10) as $bread)
                    <div class="ra-rating-row">
                        <div class="ra-rating-row-header">
                            <span class="ra-rating-row-name">{{ $bread->favorite_bread }}</span>
                            <span class="ra-rating-row-value">{{ $bread->avg_rating }} / 5</span>
                        </div>
                        <div class="ra-bar-track">
                            <div class="ra-bar-fill" style="width: {{ ($bread->avg_rating / 5) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-admin.card>
    </div>
    @endif
</x-filament-panels::page>
