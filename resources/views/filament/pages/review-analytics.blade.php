<x-filament-panels::page>
    <style>
        @media print {
            .fi-sidebar, .fi-topbar, .fi-header-heading-actions { display: none !important; }
            .fi-main { padding: 0 !important; }
        }
        .ra-top-row { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        @media (min-width: 1024px) { .ra-top-row { grid-template-columns: 1fr 2fr; } }
        .ra-two-col { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .ra-two-col { grid-template-columns: 1fr 1fr; } }
        .ra-big-number { font-size: 3.5rem; font-weight: 800; color: var(--brand-900); line-height: 1; }
        .ra-stars { color: var(--brand-300); letter-spacing: -1px; font-size: 1.75rem; margin-top: 0.5rem; }
        .ra-bar-row { display: flex; align-items: center; gap: 0.75rem; }
        .ra-bar-label { font-size: 0.875rem; font-weight: 600; width: 3rem; text-align: right; color: var(--brand-800); }
        .ra-bar-track { flex: 1; height: 1.25rem; border-radius: 0.25rem; background: var(--brand-50); overflow: hidden; }
        .ra-bar-fill { height: 100%; border-radius: 0.25rem; background: linear-gradient(90deg, var(--brand-300), #c49054); transition: width 0.6s ease; min-width: 2px; }
        .ra-bar-pct { font-size: 0.8rem; font-weight: 600; width: 3rem; text-align: right; color: var(--brand-800); }
        .ra-bar-count { font-size: 0.75rem; width: 2rem; text-align: right; color: var(--brand-500); }
        .ra-sentiment-row { margin-bottom: 1rem; }
        .ra-sentiment-header { display: flex; justify-content: space-between; margin-bottom: 0.375rem; font-size: 0.875rem; font-weight: 600; }
        .ra-sentiment-track { height: 0.625rem; border-radius: 9999px; background: var(--brand-150); overflow: hidden; }
        .ra-sentiment-fill { height: 100%; border-radius: 9999px; transition: width 0.6s ease; }
        .ra-trend-container { display: flex; align-items: flex-end; justify-content: space-between; gap: 0.5rem; height: 180px; padding-top: 0.5rem; }
        .ra-trend-col { display: flex; flex-direction: column; align-items: center; flex: 1; height: 100%; justify-content: flex-end; }
        .ra-trend-count { font-size: 0.75rem; font-weight: 700; color: var(--brand-900); margin-bottom: 0.25rem; }
        .ra-trend-bar { background: linear-gradient(180deg, var(--brand-300), #c49054); border-radius: 0.375rem 0.375rem 0 0; width: 100%; transition: height 0.6s ease; min-height: 4px; }
        .ra-trend-label { font-size: 0.7rem; color: var(--brand-500); margin-top: 0.375rem; text-align: center; font-weight: 500; }
        .ra-bread-bar { margin-bottom: 0.75rem; }
        .ra-bread-header { display: flex; justify-content: space-between; margin-bottom: 0.25rem; }
        .ra-bread-name { font-size: 0.875rem; color: var(--brand-800); }
        .ra-bread-value { font-size: 0.875rem; font-weight: 700; color: var(--brand-900); }
    </style>

    {{-- Row 1: Overall Rating + Distribution --}}
    <div class="ra-top-row">
        <x-admin.card title="Overall Rating">
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem 1rem;">
                <div class="ra-big-number">{{ $averageRating }}</div>
                <div class="ra-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        {!! $i <= round($averageRating) ? '&#9733;' : '&#9734;' !!}
                    @endfor
                </div>
                <div style="margin-top: 0.75rem; font-size: 0.7rem; font-weight: 700; color: var(--brand-500); text-transform: uppercase; letter-spacing: 0.08em;">Based on {{ $totalReviews }} reviews</div>
            </div>
        </x-admin.card>

        <x-admin.card title="Rating Distribution">
            <div style="display: flex; flex-direction: column; gap: 0.625rem; padding: 1rem 1.25rem;">
                @foreach ($ratingDistribution as $stars => $data)
                    <div class="ra-bar-row">
                        <span class="ra-bar-label">{{ $stars }} ★</span>
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
    <x-admin.stat-grid :cols="4" data-stat-grid>
        <x-admin.stat-card label="Total Reviews" :value="$totalReviews" color="var(--brand-900)" />
        <x-admin.stat-card label="Approved" :value="$approvedCount" color="var(--status-success)" />
        <x-admin.stat-card label="Pending" :value="$pendingCount" color="var(--status-warning)" />
        <x-admin.stat-card label="Rejected" :value="$rejectedCount" color="var(--status-danger)" />
    </x-admin.stat-grid>

    {{-- Row 3: Sentiment + Monthly Trend --}}
    <div class="ra-two-col">
        <x-admin.card title="Review Sentiment">
            <div style="padding: 1rem 1.25rem;">
                <div class="ra-sentiment-row">
                    <div class="ra-sentiment-header">
                        <span style="color: var(--status-success);">Positive (4-5 stars)</span>
                        <span style="color: var(--status-success);">{{ $sentiment['positive'] }}%</span>
                    </div>
                    <div class="ra-sentiment-track">
                        <div class="ra-sentiment-fill" style="width: {{ $sentiment['positive'] }}%; background: var(--status-success);"></div>
                    </div>
                </div>
                <div class="ra-sentiment-row">
                    <div class="ra-sentiment-header">
                        <span style="color: var(--status-warning);">Mixed (3 stars)</span>
                        <span style="color: var(--status-warning);">{{ $sentiment['mixed'] }}%</span>
                    </div>
                    <div class="ra-sentiment-track">
                        <div class="ra-sentiment-fill" style="width: {{ max($sentiment['mixed'], 0.5) }}%; background: var(--status-warning);"></div>
                    </div>
                </div>
                <div class="ra-sentiment-row" style="margin-bottom: 0;">
                    <div class="ra-sentiment-header">
                        <span style="color: var(--status-danger);">Negative (1-2 stars)</span>
                        <span style="color: var(--status-danger);">{{ $sentiment['negative'] }}%</span>
                    </div>
                    <div class="ra-sentiment-track">
                        <div class="ra-sentiment-fill" style="width: {{ max($sentiment['negative'], 0.5) }}%; background: var(--status-danger);"></div>
                    </div>
                </div>
            </div>
        </x-admin.card>

        <x-admin.card title="Monthly Review Trend">
            <div style="padding: 1rem 1.25rem;">
                <div class="ra-trend-container">
                    @foreach ($monthlyTrend as $month)
                        <div class="ra-trend-col">
                            <span class="ra-trend-count">{{ $month['count'] }}</span>
                            <div style="width: 100%; flex: 1; display: flex; align-items: flex-end;">
                                <div class="ra-trend-bar" style="height: {{ $maxMonthly > 0 ? max(($month['count'] / $maxMonthly) * 100, 3) : 3 }}%;"></div>
                            </div>
                            <span class="ra-trend-label">{{ \Illuminate\Support\Str::limit($month['month'], 7, '') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-admin.card>
    </div>

    {{-- Row 4: Bread Stats --}}
    @if ($breadStats->isNotEmpty())
    <div class="ra-two-col" style="margin-top: 1.5rem;">
        <x-admin.card title="Top Reviewed Breads">
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th>Bread</th>
                    <th style="text-align: center;">Avg Rating</th>
                    <th style="text-align: right;">Reviews</th>
                </x-slot:head>
                @foreach ($topBreads as $bread)
                    <tr>
                        <td style="font-weight: 600;">{{ $bread->favorite_bread }}</td>
                        <td style="text-align: center;">
                            <span style="color: var(--brand-300); letter-spacing: -1px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    {!! $i <= round($bread->avg_rating) ? '&#9733;' : '&#9734;' !!}
                                @endfor
                            </span>
                            <span style="font-size: 0.75rem; color: var(--brand-500); margin-left: 0.25rem;">{{ $bread->avg_rating }}</span>
                        </td>
                        <td style="text-align: right; font-weight: 700;">{{ $bread->review_count }}</td>
                    </tr>
                @endforeach
            </x-admin.data-table>
        </x-admin.card>

        <x-admin.card title="Rating by Bread Type">
            <div style="padding: 1rem 1.25rem;">
                @foreach ($breadStats->sortByDesc('avg_rating')->take(10) as $bread)
                    <div class="ra-bread-bar">
                        <div class="ra-bread-header">
                            <span class="ra-bread-name">{{ $bread->favorite_bread }}</span>
                            <span class="ra-bread-value">{{ $bread->avg_rating }} / 5</span>
                        </div>
                        <div class="ra-bar-track" style="height: 0.625rem;">
                            <div class="ra-bar-fill" style="width: {{ ($bread->avg_rating / 5) * 100 }}%; height: 100%; border-radius: 9999px;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-admin.card>
    </div>
    @endif
</x-filament-panels::page>
