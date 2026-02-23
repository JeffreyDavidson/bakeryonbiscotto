<?php

namespace App\Filament\Pages;

use App\Models\Order;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;

class WeeklyPrepPlanner extends Page
{
    protected string $view = 'filament.pages.weekly-prep-planner';

    protected static ?string $title = 'Weekly Prep Planner';

    protected static ?string $navigationLabel = 'Prep Planner';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-clipboard-document-check';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    #[Url]
    public string $weekStart = '';

    public function mount(): void
    {
        if (empty($this->weekStart)) {
            $this->weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        }
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '' => 'Weekly Prep Planner',
        ];
    }

    public function previousWeek(): void
    {
        $this->weekStart = Carbon::parse($this->weekStart)->subWeek()->toDateString();
    }

    public function nextWeek(): void
    {
        $this->weekStart = Carbon::parse($this->weekStart)->addWeek()->toDateString();
    }

    public function thisWeek(): void
    {
        $this->weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
    }

    public function getWeekDates(): array
    {
        $start = Carbon::parse($this->weekStart);
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $start->copy()->addDays($i);
        }
        return $dates;
    }

    public function getOrders(): \Illuminate\Support\Collection
    {
        $start = Carbon::parse($this->weekStart);
        $end = $start->copy()->addDays(6);

        return Order::with('items')
            ->whereBetween('requested_date', [$start->toDateString(), $end->toDateString()])
            ->whereNotIn('status', ['cancelled'])
            ->orderBy('requested_date')
            ->orderBy('requested_time')
            ->get();
    }

    public function getAggregates(): \Illuminate\Support\Collection
    {
        $orders = $this->getOrders();

        return $orders->flatMap->items
            ->groupBy('product_name')
            ->map(fn ($items) => $items->sum('quantity'))
            ->sortDesc();
    }
}
