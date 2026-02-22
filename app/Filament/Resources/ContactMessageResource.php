<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Component;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationLabel = 'Messages';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-envelope';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'Communication';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M j, g:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
            ])
            ->actions([
                Actions\ViewAction::make()
                    ->modalWidth('2xl'),
                Actions\Action::make('markRead')
                    ->label('Mark Read')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->action(fn (ContactMessage $record) => $record->update(['status' => 'read']))
                    ->visible(fn (ContactMessage $record) => $record->status === 'new'),
                Actions\Action::make('markReplied')
                    ->label('Mark Replied')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (ContactMessage $record) => $record->update([
                        'status' => 'replied',
                        'replied_at' => now(),
                    ]))
                    ->visible(fn (ContactMessage $record) => $record->status !== 'replied'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->columns(3)->schema([
                \Filament\Infolists\Components\TextEntry::make('name'),
                \Filament\Infolists\Components\TextEntry::make('email')
                    ->copyable(),
                \Filament\Infolists\Components\TextEntry::make('phone')
                    ->copyable()
                    ->default('—'),
                \Filament\Infolists\Components\TextEntry::make('subject')
                    ->weight('bold')
                    ->columnSpan(2),
                \Filament\Infolists\Components\TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    }),
                \Filament\Infolists\Components\TextEntry::make('message')
                    ->prose()
                    ->columnSpanFull(),
                \Filament\Infolists\Components\TextEntry::make('created_at')
                    ->label('Received')
                    ->dateTime('M j, Y \a\t g:i A'),
            ]),
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
