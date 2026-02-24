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

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getUrl() => 'Baking Sheet',
        ];
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
            'pending_count' => $orders->where('status', 'pending')->count(),
            'confirmed_count' => $orders->where('status', 'confirmed')->count(),
            'baking_count' => $orders->where('status', 'baking')->count(),
            'ready_count' => $orders->where('status', 'ready')->count(),
            'delivered_count' => $orders->where('status', 'delivered')->count(),
        ];
    }

    public function getTimelineProperty(): Collection
    {
        return $this->orders->groupBy(function ($order) {
            if (!$order->requested_time) return 'No Time Set';
            return $order->requested_time;
        })->sortKeys();
    }

    public function getUpcomingDaysProperty(): Collection
    {
        $start = Carbon::parse($this->date)->addDay();
        $end = $start->copy()->addDays(6);

        return Order::whereBetween('requested_date', [$start, $end])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE(requested_date) as date, COUNT(*) as order_count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn ($row) => (object) [
                'date' => Carbon::parse($row->date),
                'order_count' => $row->order_count,
            ]);
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
