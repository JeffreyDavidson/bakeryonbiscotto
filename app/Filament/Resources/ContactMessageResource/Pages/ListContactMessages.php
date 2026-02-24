<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->icon('heroicon-o-inbox'),

            'new' => Tab::make('New')
                ->icon('heroicon-o-bell-alert')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'new'))
                ->badge(fn () => ContactMessage::where('status', 'new')->count() ?: null)
                ->badgeColor('warning'),

            'read' => Tab::make('Read')
                ->icon('heroicon-o-eye')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'read'))
                ->badge(fn () => ContactMessage::where('status', 'read')->count() ?: null)
                ->badgeColor('info'),

            'replied' => Tab::make('Replied')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'replied'))
                ->badge(fn () => ContactMessage::where('status', 'replied')->count() ?: null)
                ->badgeColor('success'),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return ContactMessage::where('status', 'new')->exists() ? 'new' : 'all';
    }
}
