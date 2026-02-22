<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Components\Component;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationLabel = 'Reviews';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-star';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Review::pending()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return Review::pending()->count() > 0 ? 'warning' : null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Forms\Components\TextInput::make('name')->required()->maxLength(100),
            \Filament\Forms\Components\TextInput::make('email')->email()->maxLength(255),
            \Filament\Forms\Components\Select::make('rating')
                ->options([5 => '5 Stars', 4 => '4 Stars', 3 => '3 Stars', 2 => '2 Stars', 1 => '1 Star'])
                ->required(),
            \Filament\Forms\Components\Textarea::make('body')->required()->maxLength(1000)->columnSpanFull(),
            \Filament\Forms\Components\TextInput::make('favorite_bread')->maxLength(100),
            \Filament\Forms\Components\Select::make('status')
                ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->trueColor('warning')
                    ->falseIcon('')
                    ->width('1rem'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => new \Illuminate\Support\HtmlString(
                        str_repeat('<span style="color:#d97706;font-size:1rem;">★</span>', $state) .
                        str_repeat('<span style="color:#e8d0b0;font-size:1rem;">★</span>', 5 - $state)
                    ))
                    ->sortable(),
                Tables\Columns\TextColumn::make('body')->limit(50)->wrap(),
                Tables\Columns\TextColumn::make('favorite_bread')->label('Fav Bread'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']),
            ])
            ->actions([
                Action::make('feature')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->label('Highlight')
                    ->visible(fn (Review $record) => $record->status === 'approved' && !$record->is_featured)
                    ->action(function (Review $record) {
                        Review::where('is_featured', true)->update(['is_featured' => false]);
                        $record->update(['is_featured' => true]);
                    }),
                Action::make('unfeature')
                    ->icon('heroicon-s-star')
                    ->color('gray')
                    ->label('Remove Highlight')
                    ->visible(fn (Review $record) => $record->is_featured)
                    ->action(fn (Review $record) => $record->update(['is_featured' => false])),
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Review $record) => $record->status !== 'approved')
                    ->action(fn (Review $record) => $record->update(['status' => 'approved'])),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Review $record) => $record->status !== 'rejected')
                    ->action(fn (Review $record) => $record->update(['status' => 'rejected'])),
                EditAction::make()->slideOver()->modalWidth('2xl'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
        ];
    }
}
