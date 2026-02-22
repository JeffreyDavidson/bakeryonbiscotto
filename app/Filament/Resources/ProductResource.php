<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-shopping-bag';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Product Details')
                ->icon('heroicon-o-shopping-bag')
                ->components([
                    \Filament\Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->preload(),
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('slug')
                        ->maxLength(255),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->rows(3),
                    \Filament\Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->step('0.01'),
                    \Filament\Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('products'),
                ]),

            \Filament\Schemas\Components\Section::make('Settings')
                ->icon('heroicon-o-adjustments-horizontal')
                ->components([
                    \Filament\Forms\Components\Toggle::make('is_available')
                        ->label('Available for ordering')
                        ->default(true),
                    \Filament\Forms\Components\Toggle::make('is_featured')
                        ->label('Featured product'),
                    \Filament\Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    \Filament\Forms\Components\TextInput::make('max_per_order')
                        ->numeric()
                        ->nullable()
                        ->helperText('Leave empty for no limit'),
                    \Filament\Forms\Components\TextInput::make('weekly_limit')
                        ->numeric()
                        ->nullable()
                        ->helperText('Max units she can bake per week'),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('')
                    ->circular()
                    ->width(40)
                    ->height(40),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Available')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->trueColor('warning')
                    ->falseIcon(''),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Available'),
            ])
            ->actions([
                Action::make('toggle_availability')
                    ->icon(fn (Product $record) => $record->is_available ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Product $record) => $record->is_available ? 'gray' : 'success')
                    ->label(fn (Product $record) => $record->is_available ? 'Hide' : 'Show')
                    ->action(fn (Product $record) => $record->update(['is_available' => !$record->is_available])),
                EditAction::make()
                    ->slideOver()
                    ->modalWidth('2xl'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
