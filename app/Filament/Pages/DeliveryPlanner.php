<?php

namespace App\Filament\Pages;

use App\Models\Order;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;

class DeliveryPlanner extends Page
{
    protected string $view = 'filament.pages.delivery-planner';

    protected static ?string $title = 'Delivery Planner';

    protected static ?string $navigationLabel = 'Delivery Planner';

    protected static ?int $navigationSort = 6;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-map-pin';
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
            $this->date = now()->toDateString();
        }
    }

    public function getDeliveriesProperty(): Collection
    {
        return Order::where('fulfillment_type', 'delivery')
            ->whereDate('requested_date', $this->date)
            ->orderBy('requested_time')
            ->get();
    }

    public function getTotalFeesProperty(): float
    {
        return $this->deliveries->sum('delivery_fee');
    }

    public function getOptimizedRouteUrlProperty(): string
    {
        $origin = '28.31716,-81.65249';
        $addresses = $this->deliveries
            ->filter(fn ($o) => !empty($o->delivery_address))
            ->pluck('delivery_address')
            ->map(fn ($a) => urlencode($a))
            ->toArray();

        if (empty($addresses)) {
            return '#';
        }

        $stops = implode('/', $addresses);

        return "https://www.google.com/maps/dir/{$origin}/{$stops}";
    }

    public function getDirectionsUrl(string $address): string
    {
        $origin = '28.31716,-81.65249';

        return "https://www.google.com/maps/dir/{$origin}/" . urlencode($address);
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '' => 'Delivery Planner',
        ];
    }
}
