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
            'active' => Tab::make('Active Orders')
                ->icon('heroicon-o-fire')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotIn('status', ['completed', 'cancelled']))
                ->badge(fn () => \App\Models\Order::active()->count() ?: null),

            'pending' => Tab::make('Pending')
                ->icon('heroicon-o-clock')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => \App\Models\Order::pending()->count() ?: null)
                ->badgeColor('warning'),

            'completed' => Tab::make('Completed')
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed')),

            'all' => Tab::make('All Orders')
                ->icon('heroicon-o-list-bullet'),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'active';
    }
}
