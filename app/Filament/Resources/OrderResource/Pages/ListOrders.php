<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->icon('heroicon-o-list-bullet'),

            'pending' => Tab::make('Pending')
                ->icon('heroicon-o-clock')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => \App\Models\Order::where('status', 'pending')->count() ?: null)
                ->badgeColor('warning'),

            'confirmed' => Tab::make('Confirmed')
                ->icon('heroicon-o-check')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'confirmed'))
                ->badge(fn () => \App\Models\Order::where('status', 'confirmed')->count() ?: null)
                ->badgeColor('info'),

            'baking' => Tab::make('Baking')
                ->icon('heroicon-o-fire')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'baking'))
                ->badge(fn () => \App\Models\Order::where('status', 'baking')->count() ?: null)
                ->badgeColor('primary'),

            'ready' => Tab::make('Ready')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'ready'))
                ->badge(fn () => \App\Models\Order::where('status', 'ready')->count() ?: null)
                ->badgeColor('success'),

            'delivered' => Tab::make('Delivered')
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'delivered')),

            'cancelled' => Tab::make('Cancelled')
                ->icon('heroicon-o-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled')),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'pending';
    }
}
