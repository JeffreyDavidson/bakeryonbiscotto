<x-filament-panels::page>
    <style>
        .finance-wrap { max-width: 1200px; margin: 0 auto; }
        .finance-nav { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem; }
        .finance-nav button { background: var(--brand-900); color: #fff; border: none; border-radius: 8px; padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; }
        .finance-nav button:hover { background: var(--brand-700); }
        .finance-nav .year-label { font-family: "Playfair Display", serif; font-size: 1.5rem; color: var(--brand-900); font-weight: 700; min-width: 80px; text-align: center; }

        .summary-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        @media (max-width: 768px) { .summary-cards { grid-template-columns: repeat(2, 1fr); } }
        .text-green { color: var(--status-success); }
        .text-red { color: var(--status-danger); }
        .text-brown { color: var(--brand-900); }

        .finance-section { background: #fff; border: 1px solid var(--brand-200); border-radius: 12px; margin-bottom: 1.5rem; overflow: hidden; }
        [data-admin-table] .text-right { text-align: right; }
        [data-admin-table] .total-row td { background: var(--brand-50); font-weight: 700; border-top: 2px solid var(--brand-300); }

        .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding: 1.25rem; }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }
        .category-pill { display: flex; justify-content: space-between; align-items: center; background: var(--brand-50); border: 1px solid var(--brand-200); border-radius: 8px; padding: 0.75rem 1rem; }
        .category-pill-label { font-size: 0.8rem; color: var(--brand-700); font-weight: 600; }
        .category-pill-value { font-size: 0.9rem; color: var(--brand-900); font-weight: 700; }

        .cogs-note { padding: 1rem 1.25rem; background: var(--brand-50); border-top: 1px solid var(--brand-200); font-size: 0.8rem; color: var(--brand-600); }
        .cogs-note strong { color: var(--brand-900); }
    </style>

    <div class="finance-wrap">
        {{-- Year navigation --}}
        <div class="finance-nav">
            <button wire:click="previousYear" type="button">← {{ $this->year - 1 }}</button>
            <span class="year-label">{{ $this->year }}</span>
            <button wire:click="nextYear" type="button">{{ $this->year + 1 }} →</button>
        </div>

        {{-- Summary cards --}}
        <div class="summary-cards">
            <x-admin.stat-card label="Order Revenue" :value="'$' . number_format($this->yearTotals['order_income'], 2)" color="var(--brand-900)" />
            <x-admin.stat-card label="Other Income" :value="'$' . number_format($this->yearTotals['other_income'], 2)" color="var(--brand-900)" />
            <x-admin.stat-card label="Total Expenses" :value="'$' . number_format($this->yearTotals['expenses'], 2)" color="var(--status-danger)" />
            <x-admin.stat-card label="Net Profit" :value="($this->yearTotals['profit'] >= 0 ? '' : '-') . '$' . number_format(abs($this->yearTotals['profit']), 2)" :color="$this->yearTotals['profit'] >= 0 ? 'var(--status-success)' : 'var(--status-danger)'" />
        </div>

        {{-- Revenue cap tracker --}}
        @php $revCap = $this->revCap; @endphp
        <div class="finance-section" style="margin-bottom: 1.5rem;">
            <div data-admin-gradient-header style="{{ $revCap['danger'] ? 'background: linear-gradient(135deg, var(--status-danger-dark), var(--status-danger));' : ($revCap['warning'] ? 'background: linear-gradient(135deg, var(--status-warning-dark), var(--status-warning));' : '') }}">
                <span data-header-title>Florida Cottage Food Revenue Cap — {{ $this->year }}</span>
            </div>
            <div style="padding: 1.25rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="font-size: 0.85rem; color: var(--brand-700); font-weight: 600;">
                        ${{ number_format($revCap['total'], 2) }} of ${{ number_format($revCap['cap'], 0) }} ({{ $revCap['percentage'] }}%)
                    </span>
                    <span style="font-size: 0.85rem; color: {{ $revCap['danger'] ? 'var(--status-danger)' : ($revCap['warning'] ? 'var(--status-warning)' : 'var(--status-success)') }}; font-weight: 700;">
                        ${{ number_format($revCap['remaining'], 2) }} remaining
                    </span>
                </div>
                <div style="background: var(--brand-150); border-radius: 9999px; height: 12px; overflow: hidden;">
                    <div style="background: {{ $revCap['danger'] ? 'var(--status-danger)' : ($revCap['warning'] ? 'var(--status-warning)' : 'var(--brand-600)') }}; height: 100%; border-radius: 9999px; width: {{ $revCap['percentage'] }}%; transition: width 0.3s ease;"></div>
                </div>
                @if($revCap['danger'])
                    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; font-size: 0.8rem; color: var(--status-danger-dark);">
                        ⚠️ <strong>Warning:</strong> You're approaching the Florida cottage food annual revenue cap of $250,000. Exceeding this requires a food establishment license.
                    </div>
                @elseif($revCap['warning'])
                    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; font-size: 0.8rem; color: var(--status-warning-dark);">
                        ⚠️ <strong>Heads up:</strong> You've passed 80% of the cottage food revenue cap. Great year!
                    </div>
                @endif
            </div>
        </div>

        {{-- Monthly breakdown --}}
        <div class="finance-section">
            <div data-admin-gradient-header>
                <span data-header-title>Monthly Breakdown</span>
            </div>
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th style="text-align:left;">Month</th>
                    <th class="text-right" style="text-align:right;">Orders</th>
                    <th class="text-right" style="text-align:right;">Other Income</th>
                    <th class="text-right" style="text-align:right;">Total Income</th>
                    <th class="text-right" style="text-align:right;">Expenses</th>
                    <th class="text-right" style="text-align:right;">Profit</th>
                </x-slot:head>
                @foreach($this->monthlyData as $month)
                    <tr>
                        <td>{{ $month['month_full'] }}</td>
                        <td style="text-align:right;">${{ number_format($month['order_income'], 2) }}</td>
                        <td style="text-align:right;">${{ number_format($month['other_income'], 2) }}</td>
                        <td style="text-align:right; font-weight:600;">${{ number_format($month['total_income'], 2) }}</td>
                        <td style="text-align:right; color:var(--status-danger);">${{ number_format($month['expenses'], 2) }}</td>
                        <td style="text-align:right; font-weight:700; color:{{ $month['profit'] >= 0 ? 'var(--status-success)' : 'var(--status-danger)' }};">
                            {{ $month['profit'] >= 0 ? '' : '-' }}${{ number_format(abs($month['profit']), 2) }}
                        </td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td>Total</td>
                    <td style="text-align:right;">${{ number_format($this->yearTotals['order_income'], 2) }}</td>
                    <td style="text-align:right;">${{ number_format($this->yearTotals['other_income'], 2) }}</td>
                    <td style="text-align:right;">${{ number_format($this->yearTotals['total_income'], 2) }}</td>
                    <td style="text-align:right; color:var(--status-danger);">${{ number_format($this->yearTotals['expenses'], 2) }}</td>
                    <td style="text-align:right; color:{{ $this->yearTotals['profit'] >= 0 ? 'var(--status-success)' : 'var(--status-danger)' }};">
                        {{ $this->yearTotals['profit'] >= 0 ? '' : '-' }}${{ number_format(abs($this->yearTotals['profit']), 2) }}
                    </td>
                </tr>
            </x-admin.data-table>
        </div>

        {{-- Expense categories --}}
        <div class="finance-section">
            <div data-admin-gradient-header>
                <span data-header-title>Expenses by Category</span>
            </div>
            @if(count($this->expenseByCategory) > 0)
                <div class="category-grid">
                    @foreach($this->expenseByCategory as $cat)
                        <div class="category-pill">
                            <span class="category-pill-label">{{ $cat['label'] }}</span>
                            <span class="category-pill-value">${{ number_format($cat['total'], 2) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="cogs-note">
                    💡 <strong>Cost of Goods Sold (COGS):</strong> ${{ number_format($this->cogs, 2) }} — This includes Ingredients + Packaging and is deducted directly from revenue on Schedule C.
                </div>
            @else
                <div style="padding: 2rem; text-align: center; color: var(--brand-500); font-style: italic;">
                    No expenses recorded for {{ $this->year }} yet.
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
