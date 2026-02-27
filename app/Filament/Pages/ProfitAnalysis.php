<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;

class ProfitAnalysis extends Page
{
    protected string $view = 'filament.pages.profit-analysis';

    protected static ?string $title = 'Profit Analysis';

    protected static ?string $navigationLabel = 'Profit Analysis';

    protected static ?int $navigationSort = 3;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-chart-bar-square';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    #[Url]
    public ?int $categoryId = null;

    #[Url]
    public ?string $dateFrom = null;

    #[Url]
    public ?string $dateTo = null;

    #[Url]
    public string $sortBy = 'name';

    #[Url]
    public string $sortDir = 'asc';

    public function mount(): void
    {
        if (!$this->dateFrom) {
            $this->dateFrom = now()->subDays(30)->format('Y-m-d');
        }
        if (!$this->dateTo) {
            $this->dateTo = now()->format('Y-m-d');
        }
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }

    public function getCategories(): \Illuminate\Support\Collection
    {
        return Category::orderBy('name')->pluck('name', 'id');
    }

    public function getProductsData(): array
    {
        $products = Product::with(['recipe.ingredients', 'category'])
            ->when($this->categoryId, fn ($q) => $q->where('category_id', $this->categoryId))
            ->get();

        $salesQuery = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', '!=', 'cancelled')
            ->when($this->dateFrom, fn ($q) => $q->where('orders.requested_date', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->where('orders.requested_date', '<=', $this->dateTo))
            ->selectRaw('order_items.product_id, SUM(order_items.quantity) as units_sold, SUM(order_items.line_total) as total_revenue')
            ->groupBy('order_items.product_id')
            ->get()
            ->keyBy('product_id');

        $rows = $products->map(function (Product $product) use ($salesQuery) {
            $recipe = $product->recipe;
            $cost = $recipe ? $recipe->cost_per_serving : null;
            $price = (float) $product->price;
            $margin = ($cost !== null && $price > 0) ? (($price - $cost) / $price * 100) : null;
            $profit = ($cost !== null) ? ($price - $cost) : null;

            $sales = $salesQuery->get($product->id);
            $unitsSold = $sales ? (int) $sales->units_sold : 0;
            $totalRevenue = $sales ? (float) $sales->total_revenue : 0;
            $totalProfit = ($profit !== null) ? $profit * $unitsSold : null;

            return [
                'name' => $product->name,
                'category' => $product->category?->name ?? '—',
                'price' => $price,
                'cost' => $cost,
                'profit' => $profit,
                'margin' => $margin,
                'units_sold' => $unitsSold,
                'total_revenue' => $totalRevenue,
                'total_profit' => $totalProfit,
            ];
        })->toArray();

        // Sort
        usort($rows, function ($a, $b) {
            $key = $this->sortBy;
            $va = $a[$key] ?? 0;
            $vb = $b[$key] ?? 0;
            $cmp = is_string($va) ? strcasecmp($va, $vb) : ($va <=> $vb);
            return $this->sortDir === 'asc' ? $cmp : -$cmp;
        });

        return $rows;
    }

    public function getSummary(array $rows): array
    {
        $withMargin = array_filter($rows, fn ($r) => $r['margin'] !== null);
        $avgMargin = count($withMargin) > 0 ? array_sum(array_column($withMargin, 'margin')) / count($withMargin) : null;

        $highest = null;
        $lowest = null;
        foreach ($withMargin as $r) {
            if ($highest === null || $r['margin'] > $highest['margin']) $highest = $r;
            if ($lowest === null || $r['margin'] < $lowest['margin']) $lowest = $r;
        }

        $totalProfit = array_sum(array_map(fn ($r) => $r['total_profit'] ?? 0, $rows));

        return [
            'avg_margin' => $avgMargin,
            'highest' => $highest,
            'lowest' => $lowest,
            'total_profit' => $totalProfit,
        ];
    }
}
