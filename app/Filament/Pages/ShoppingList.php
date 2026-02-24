<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Recipe;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;

class ShoppingList extends Page
{
    protected string $view = 'filament.pages.shopping-list';

    protected static ?string $title = 'Shopping List';

    protected static ?string $navigationLabel = 'Shopping List';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-shopping-cart';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getUrl() => 'Shopping List',
        ];
    }

    #[Url]
    public string $startDate = '';

    #[Url]
    public string $endDate = '';

    public function mount(): void
    {
        if (empty($this->startDate)) {
            $this->startDate = now()->format('Y-m-d');
        }
        if (empty($this->endDate)) {
            $this->endDate = now()->addDays(7)->format('Y-m-d');
        }
    }

    public function getOrdersProperty(): Collection
    {
        return Order::whereBetween('requested_date', [$this->startDate, $this->endDate])
            ->whereIn('status', ['confirmed', 'baking'])
            ->with('items')
            ->get();
    }

    public function getStatsProperty(): object
    {
        $orders = $this->orders;
        return (object) [
            'total_orders' => $orders->count(),
            'total_items' => $orders->sum(fn ($o) => $o->items->sum('quantity')),
            'unique_products' => $orders->flatMap(fn ($o) => $o->items->pluck('product_name'))->unique()->count(),
        ];
    }

    public function getShoppingListProperty(): Collection
    {
        $orders = $this->orders;

        if ($orders->isEmpty()) {
            return collect();
        }

        // Aggregate order items by product
        $productQuantities = collect();
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $key = $item->product_id ?? $item->product_name;
                if ($productQuantities->has($key)) {
                    $productQuantities[$key] = (object) [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'quantity' => $productQuantities[$key]->quantity + $item->quantity,
                    ];
                } else {
                    $productQuantities[$key] = (object) [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'quantity' => $item->quantity,
                    ];
                }
            }
        }

        // Load recipes for products that have them
        $productIds = $productQuantities->pluck('product_id')->filter()->unique()->values();
        $recipes = Recipe::whereIn('product_id', $productIds)
            ->with('ingredients')
            ->get()
            ->keyBy('product_id');

        // Aggregate ingredients
        $ingredients = collect();
        $uncategorized = collect();

        foreach ($productQuantities as $pq) {
            $recipe = $pq->product_id ? ($recipes[$pq->product_id] ?? null) : null;

            if ($recipe && $recipe->ingredients->isNotEmpty()) {
                foreach ($recipe->ingredients as $ingredient) {
                    $key = strtolower($ingredient->name) . '|' . strtolower($ingredient->unit ?? '');
                    $scaledQty = (float) $ingredient->quantity * $pq->quantity;

                    if ($ingredients->has($key)) {
                        $existing = $ingredients[$key];
                        $existing->quantity += $scaledQty;
                        $ingredients[$key] = $existing;
                    } else {
                        $ingredients[$key] = (object) [
                            'name' => $ingredient->name,
                            'quantity' => $scaledQty,
                            'unit' => $ingredient->unit ?? '',
                        ];
                    }
                }
            } else {
                $uncategorized->push((object) [
                    'name' => $pq->product_name,
                    'quantity' => $pq->quantity,
                    'unit' => 'each',
                ]);
            }
        }

        // Group: ingredients sorted alphabetically, then uncategorized
        $grouped = collect();

        if ($ingredients->isNotEmpty()) {
            $grouped['Ingredients'] = $ingredients->sortBy(fn ($i) => strtolower($i->name))->values();
        }

        if ($uncategorized->isNotEmpty()) {
            $grouped['Products (No Recipe)'] = $uncategorized->sortBy(fn ($i) => strtolower($i->name))->values();
        }

        return $grouped;
    }

    public function getClipboardTextProperty(): string
    {
        $lines = [];
        $lines[] = 'Shopping List: ' . Carbon::parse($this->startDate)->format('M j') . ' - ' . Carbon::parse($this->endDate)->format('M j, Y');
        $lines[] = str_repeat('-', 40);

        foreach ($this->shoppingList as $group => $items) {
            $lines[] = '';
            $lines[] = strtoupper($group);
            foreach ($items as $item) {
                $qty = $this->formatQuantity($item->quantity);
                $lines[] = "  [ ] {$qty} {$item->unit} — {$item->name}";
            }
        }

        return implode("\n", $lines);
    }

    public function formatQuantity(float $qty): string
    {
        return $qty == intval($qty) ? number_format($qty, 0) : number_format($qty, 2);
    }

    public function getFormattedRangeProperty(): string
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        if ($start->month === $end->month && $start->year === $end->year) {
            return $start->format('M j') . ' – ' . $end->format('j, Y');
        }

        return $start->format('M j') . ' – ' . $end->format('M j, Y');
    }

    public function setThisWeek(): void
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->addDays(7)->format('Y-m-d');
    }

    public function setNextThreeDays(): void
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->addDays(3)->format('Y-m-d');
    }

    public function setTomorrow(): void
    {
        $this->startDate = now()->addDay()->format('Y-m-d');
        $this->endDate = now()->addDay()->format('Y-m-d');
    }
}
