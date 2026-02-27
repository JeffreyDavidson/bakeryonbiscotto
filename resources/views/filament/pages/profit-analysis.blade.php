<x-filament-panels::page>
    <style>
        .profit-wrap { max-width: 1400px; margin: 0 auto; }
        .profit-summary { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        @media (max-width: 768px) { .profit-summary { grid-template-columns: repeat(2, 1fr); } }
        .profit-filters { display: flex; flex-wrap: wrap; gap: 1rem; align-items: end; margin-bottom: 1.5rem; padding: 1rem; background: #fff; border: 1px solid #e8d0b0; border-radius: 12px; }
        .profit-filters label { font-size: 0.75rem; font-weight: 600; color: #6b4c3b; display: block; margin-bottom: 0.25rem; }
        .profit-filters select, .profit-filters input { border: 1px solid #e8d0b0; border-radius: 8px; padding: 0.45rem 0.75rem; font-size: 0.85rem; background: #fdf8f2; color: #3d2314; }
        .profit-table-wrap { background: #fff; border: 1px solid #e8d0b0; border-radius: 12px; overflow-x: auto; }
        .profit-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        .profit-table th { background: #3d2314; color: #fdf8f2; padding: 0.75rem 1rem; text-align: left; font-weight: 600; cursor: pointer; user-select: none; white-space: nowrap; }
        .profit-table th:hover { background: #6b4c3b; }
        .profit-table td { padding: 0.6rem 1rem; border-bottom: 1px solid #f0e6d8; color: #3d2314; }
        .profit-table tr:hover td { background: #fdf8f2; }
        .profit-table .text-right { text-align: right; }
        .sort-arrow { font-size: 0.7rem; margin-left: 0.3rem; }
        .margin-badge { display: inline-block; padding: 0.15rem 0.5rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem; }
        .margin-green { background: #dcfce7; color: #166534; }
        .margin-yellow { background: #fef9c3; color: #854d0e; }
        .margin-red { background: #fee2e2; color: #991b1b; }
        .margin-none { color: #9ca3af; }
    </style>

    @php
        $rows = $this->getProductsData();
        $summary = $this->getSummary($rows);
        $sortArrow = fn($col) => $this->sortBy === $col ? ($this->sortDir === 'asc' ? '▲' : '▼') : '';
    @endphp

    <div class="profit-wrap">
        {{-- Summary cards --}}
        <div class="profit-summary">
            <x-admin.stat-card
                label="Average Margin"
                :value="$summary['avg_margin'] !== null ? number_format($summary['avg_margin'], 1) . '%' : '—'"
                icon="heroicon-o-chart-bar"
            />
            <x-admin.stat-card
                label="Highest Margin"
                :value="$summary['highest'] ? $summary['highest']['name'] . ' (' . number_format($summary['highest']['margin'], 1) . '%)' : '—'"
                icon="heroicon-o-arrow-trending-up"
            />
            <x-admin.stat-card
                label="Lowest Margin"
                :value="$summary['lowest'] ? $summary['lowest']['name'] . ' (' . number_format($summary['lowest']['margin'], 1) . '%)' : '—'"
                icon="heroicon-o-arrow-trending-down"
            />
            <x-admin.stat-card
                label="Total Profit"
                :value="'$' . number_format($summary['total_profit'], 2)"
                icon="heroicon-o-banknotes"
            />
        </div>

        {{-- Filters --}}
        <div class="profit-filters">
            <div>
                <label>Category</label>
                <select wire:model.live="categoryId">
                    <option value="">All Categories</option>
                    @foreach($this->getCategories() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>From</label>
                <input type="date" wire:model.live="dateFrom" />
            </div>
            <div>
                <label>To</label>
                <input type="date" wire:model.live="dateTo" />
            </div>
        </div>

        {{-- Table --}}
        <div class="profit-table-wrap">
            <table class="profit-table">
                <thead>
                    <tr>
                        <th wire:click="sort('name')">Name <span class="sort-arrow">{{ $sortArrow('name') }}</span></th>
                        <th wire:click="sort('category')">Category <span class="sort-arrow">{{ $sortArrow('category') }}</span></th>
                        <th wire:click="sort('price')" class="text-right">Price <span class="sort-arrow">{{ $sortArrow('price') }}</span></th>
                        <th wire:click="sort('cost')" class="text-right">Cost <span class="sort-arrow">{{ $sortArrow('cost') }}</span></th>
                        <th wire:click="sort('profit')" class="text-right">Profit <span class="sort-arrow">{{ $sortArrow('profit') }}</span></th>
                        <th wire:click="sort('margin')" class="text-right">Margin <span class="sort-arrow">{{ $sortArrow('margin') }}</span></th>
                        <th wire:click="sort('units_sold')" class="text-right">Units Sold <span class="sort-arrow">{{ $sortArrow('units_sold') }}</span></th>
                        <th wire:click="sort('total_revenue')" class="text-right">Revenue <span class="sort-arrow">{{ $sortArrow('total_revenue') }}</span></th>
                        <th wire:click="sort('total_profit')" class="text-right">Total Profit <span class="sort-arrow">{{ $sortArrow('total_profit') }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row['name'] }}</td>
                            <td>{{ $row['category'] }}</td>
                            <td class="text-right">${{ number_format($row['price'], 2) }}</td>
                            <td class="text-right">{{ $row['cost'] !== null ? '$' . number_format($row['cost'], 2) : '—' }}</td>
                            <td class="text-right">{{ $row['profit'] !== null ? '$' . number_format($row['profit'], 2) : '—' }}</td>
                            <td class="text-right">
                                @if($row['margin'] !== null)
                                    <span class="margin-badge {{ $row['margin'] > 50 ? 'margin-green' : ($row['margin'] >= 30 ? 'margin-yellow' : 'margin-red') }}">
                                        {{ number_format($row['margin'], 1) }}%
                                    </span>
                                @else
                                    <span class="margin-none">—</span>
                                @endif
                            </td>
                            <td class="text-right">{{ number_format($row['units_sold']) }}</td>
                            <td class="text-right">${{ number_format($row['total_revenue'], 2) }}</td>
                            <td class="text-right">{{ $row['total_profit'] !== null ? '$' . number_format($row['total_profit'], 2) : '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;padding:2rem;color:#6b4c3b;">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>
