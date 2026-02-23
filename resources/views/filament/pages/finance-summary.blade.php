<x-filament-panels::page>
    <style>
        .finance-wrap { max-width: 1200px; margin: 0 auto; }
        .finance-nav { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem; }
        .finance-nav button { background: #3d2314; color: #fff; border: none; border-radius: 8px; padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; }
        .finance-nav button:hover { background: #6b4c3b; }
        .finance-nav .year-label { font-family: "Playfair Display", serif; font-size: 1.5rem; color: #3d2314; font-weight: 700; min-width: 80px; text-align: center; }

        .summary-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        @media (max-width: 768px) { .summary-cards { grid-template-columns: repeat(2, 1fr); } }
        .summary-card { background: #fff; border: 1px solid #e8d0b0; border-radius: 12px; padding: 1.25rem; }
        .summary-card-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; color: #8b5e3c; font-weight: 600; margin-bottom: 0.25rem; }
        .summary-card-value { font-family: "Playfair Display", serif; font-size: 1.5rem; font-weight: 700; }
        .text-green { color: #16a34a; }
        .text-red { color: #dc2626; }
        .text-brown { color: #3d2314; }

        .finance-section { background: #fff; border: 1px solid #e8d0b0; border-radius: 12px; margin-bottom: 1.5rem; overflow: hidden; }
        .finance-section-header { background: linear-gradient(135deg, #3d2314, #6b4c3b); color: #fff; padding: 0.75rem 1.25rem; font-weight: 700; font-size: 0.9rem; }
        .finance-table { width: 100%; border-collapse: collapse; }
        .finance-table th { background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; padding: 0.625rem 1rem; text-align: left; border-bottom: 2px solid #d4a574; }
        .finance-table th.text-right, .finance-table td.text-right { text-align: right; }
        .finance-table td { padding: 0.625rem 1rem; border-bottom: 1px solid #f3ebe0; color: #3d2314; font-size: 0.85rem; }
        .finance-table tr:last-child td { border-bottom: none; }
        .finance-table tr:hover { background: rgba(245,230,208,0.3); }
        .finance-table .total-row td { background: #fdf8f2; font-weight: 700; border-top: 2px solid #d4a574; }

        .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding: 1.25rem; }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }
        .category-pill { display: flex; justify-content: space-between; align-items: center; background: #fdf8f2; border: 1px solid #e8d0b0; border-radius: 8px; padding: 0.75rem 1rem; }
        .category-pill-label { font-size: 0.8rem; color: #6b4c3b; font-weight: 600; }
        .category-pill-value { font-size: 0.9rem; color: #3d2314; font-weight: 700; }

        .cogs-note { padding: 1rem 1.25rem; background: #fdf8f2; border-top: 1px solid #e8d0b0; font-size: 0.8rem; color: #8b5e3c; }
        .cogs-note strong { color: #3d2314; }
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
            <div class="summary-card">
                <div class="summary-card-label">Order Revenue</div>
                <div class="summary-card-value text-brown">${{ number_format($this->yearTotals['order_income'], 2) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Other Income</div>
                <div class="summary-card-value text-brown">${{ number_format($this->yearTotals['other_income'], 2) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Total Expenses</div>
                <div class="summary-card-value text-red">${{ number_format($this->yearTotals['expenses'], 2) }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Net Profit</div>
                <div class="summary-card-value {{ $this->yearTotals['profit'] >= 0 ? 'text-green' : 'text-red' }}">
                    {{ $this->yearTotals['profit'] >= 0 ? '' : '-' }}${{ number_format(abs($this->yearTotals['profit']), 2) }}
                </div>
            </div>
        </div>

        {{-- Revenue cap tracker --}}
        @php $revCap = $this->revCap; @endphp
        <div class="finance-section" style="margin-bottom: 1.5rem;">
            <div class="finance-section-header" style="{{ $revCap['danger'] ? 'background: linear-gradient(135deg, #991b1b, #dc2626);' : ($revCap['warning'] ? 'background: linear-gradient(135deg, #92400e, #d97706);' : '') }}">
                🏠 Florida Cottage Food Revenue Cap — {{ $this->year }}
            </div>
            <div style="padding: 1.25rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="font-size: 0.85rem; color: #6b4c3b; font-weight: 600;">
                        ${{ number_format($revCap['total'], 2) }} of ${{ number_format($revCap['cap'], 0) }} ({{ $revCap['percentage'] }}%)
                    </span>
                    <span style="font-size: 0.85rem; color: {{ $revCap['danger'] ? '#dc2626' : ($revCap['warning'] ? '#d97706' : '#16a34a') }}; font-weight: 700;">
                        ${{ number_format($revCap['remaining'], 2) }} remaining
                    </span>
                </div>
                <div style="background: #f3ebe0; border-radius: 9999px; height: 12px; overflow: hidden;">
                    <div style="background: {{ $revCap['danger'] ? '#dc2626' : ($revCap['warning'] ? '#d97706' : '#8b5e3c') }}; height: 100%; border-radius: 9999px; width: {{ $revCap['percentage'] }}%; transition: width 0.3s ease;"></div>
                </div>
                @if($revCap['danger'])
                    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; font-size: 0.8rem; color: #991b1b;">
                        ⚠️ <strong>Warning:</strong> You're approaching the Florida cottage food annual revenue cap of $250,000. Exceeding this requires a food establishment license.
                    </div>
                @elseif($revCap['warning'])
                    <div style="margin-top: 0.75rem; padding: 0.75rem; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; font-size: 0.8rem; color: #92400e;">
                        📊 <strong>Heads up:</strong> You've passed 80% of the cottage food revenue cap. Great year!
                    </div>
                @endif
            </div>
        </div>

        {{-- Monthly breakdown --}}
        <div class="finance-section">
            <div class="finance-section-header">📊 Monthly Breakdown</div>
            <table class="finance-table">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th class="text-right">Orders</th>
                        <th class="text-right">Other Income</th>
                        <th class="text-right">Total Income</th>
                        <th class="text-right">Expenses</th>
                        <th class="text-right">Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->monthlyData as $month)
                        <tr>
                            <td>{{ $month['month_full'] }}</td>
                            <td class="text-right">${{ number_format($month['order_income'], 2) }}</td>
                            <td class="text-right">${{ number_format($month['other_income'], 2) }}</td>
                            <td class="text-right" style="font-weight:600;">${{ number_format($month['total_income'], 2) }}</td>
                            <td class="text-right text-red">${{ number_format($month['expenses'], 2) }}</td>
                            <td class="text-right {{ $month['profit'] >= 0 ? 'text-green' : 'text-red' }}" style="font-weight:700;">
                                {{ $month['profit'] >= 0 ? '' : '-' }}${{ number_format(abs($month['profit']), 2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td class="text-right">${{ number_format($this->yearTotals['order_income'], 2) }}</td>
                        <td class="text-right">${{ number_format($this->yearTotals['other_income'], 2) }}</td>
                        <td class="text-right">${{ number_format($this->yearTotals['total_income'], 2) }}</td>
                        <td class="text-right text-red">${{ number_format($this->yearTotals['expenses'], 2) }}</td>
                        <td class="text-right {{ $this->yearTotals['profit'] >= 0 ? 'text-green' : 'text-red' }}">
                            {{ $this->yearTotals['profit'] >= 0 ? '' : '-' }}${{ number_format(abs($this->yearTotals['profit']), 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Expense categories --}}
        <div class="finance-section">
            <div class="finance-section-header">📂 Expenses by Category</div>
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
                <div style="padding: 2rem; text-align: center; color: #a08060; font-style: italic;">
                    No expenses recorded for {{ $this->year }} yet.
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
