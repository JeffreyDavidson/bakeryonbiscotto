<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\OrderItem;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;

class BakingSheet extends Page
{
    protected string $view = 'filament.pages.baking-sheet';

    protected static ?string $title = 'Baking Sheet';

    protected static ?string $navigationLabel = 'Baking Sheet';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-printer';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    #[Url]
    public string $date = '';

    public function mount(): void
    {
        if (empty($this->date)) {
            $this->date = now()->format('Y-m-d');
        }
    }

    public function getBakingItemsProperty(): Collection
    {
        $orderIds = Order::whereDate('requested_date', $this->date)
            ->where('status', '!=', 'cancelled')
            ->pluck('id');

        if ($orderIds->isEmpty()) {
            return collect();
        }

        $items = OrderItem::whereIn('order_id', $orderIds)
            ->with('order:id,order_number,customer_name,fulfillment_type,requested_time,status')
            ->get();

        return $items->groupBy('product_name')->map(function ($group, $productName) {
            return (object) [
                'product_name' => $productName,
                'total_quantity' => $group->sum('quantity'),
                'order_numbers' => $group->pluck('order.order_number')->unique()->sort()->values()->all(),
            ];
        })->sortBy('product_name')->values();
    }

    public function getOrdersProperty(): Collection
    {
        return Order::whereDate('requested_date', $this->date)
            ->where('status', '!=', 'cancelled')
            ->with('items')
            ->orderBy('requested_time')
            ->get();
    }

    public function getStatsProperty(): object
    {
        $orders = $this->orders;
        return (object) [
            'total_orders' => $orders->count(),
            'total_items' => $orders->sum(fn ($o) => $o->items->sum('quantity')),
            'pickup_count' => $orders->where('fulfillment_type', 'pickup')->count(),
            'delivery_count' => $orders->where('fulfillment_type', 'delivery')->count(),
            'total_revenue' => $orders->sum('total'),
        ];
    }

    public function getFormattedDateProperty(): string
    {
        return Carbon::parse($this->date)->format('l, F j, Y');
    }

    public function getIsTodayProperty(): bool
    {
        return Carbon::parse($this->date)->isToday();
    }

    public function previousDay(): void
    {
        $this->date = Carbon::parse($this->date)->subDay()->format('Y-m-d');
    }

    public function nextDay(): void
    {
        $this->date = Carbon::parse($this->date)->addDay()->format('Y-m-d');
    }

    public function goToToday(): void
    {
        $this->date = now()->format('Y-m-d');
    }
}
