<x-filament-panels::page>
    <style>
        .trends-table { width: 100%; border-collapse: collapse; }
        .trends-table th { background: #f5e6d0; color: #3d2314; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; padding: 0.625rem 1rem; text-align: left; border-bottom: 2px solid #d4a574; }
        .trends-table th.text-right { text-align: right; }
        .trends-table td { padding: 0.625rem 1rem; border-bottom: 1px solid #f3ebe0; color: #3d2314; font-size: 0.85rem; }
        .trends-table td.text-right { text-align: right; }
        .trends-table tr:last-child td { border-bottom: none; }
        .trends-table tr:hover { background: rgba(245,230,208,0.3); }
        .trend-up { color: #16a34a; font-weight: 700; }
        .trend-down { color: #dc2626; font-weight: 700; }
        .trend-flat { color: #8b5e3c; font-weight: 600; }
    </style>

    <div style="max-width: 1200px; margin: 0 auto;">
        <x-admin.nav-controls :label="$this->monthLabel" prevClick="previousMonth" nextClick="nextMonth" prevLabel="← Previous" nextLabel="Next →" />

        @forelse ($this->trendsData as $group)
            <x-admin.card :title="$group['category']">
                <table class="trends-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-right">{{ $this->prevMonthLabel }}</th>
                            <th class="text-right">{{ $this->monthLabel }}</th>
                            <th class="text-right">Change</th>
                            <th class="text-right">Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group['products'] as $product)
                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td class="text-right">{{ $product['previous'] }}</td>
                                <td class="text-right">{{ $product['current'] }}</td>
                                <td class="text-right">
                                    <span class="trend-{{ $product['trend'] }}">{{ $product['change'] > 0 ? '+' : '' }}{{ $product['change'] }}%</span>
                                </td>
                                <td class="text-right">
                                    <span class="trend-{{ $product['trend'] }}" style="font-size:1rem;">{{ $product['trend'] === 'up' ? '↑' : ($product['trend'] === 'down' ? '↓' : '→') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-admin.card>
        @empty
            <x-admin.empty-state icon="📊" title="No order data found for this period" subtitle="Try navigating to a different month." />
        @endforelse
    </div>
</x-filament-panels::page>
