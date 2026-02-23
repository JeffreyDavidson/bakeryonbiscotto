<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationLabel = 'Recipes';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-beaker';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Recipe Details')
                ->icon('heroicon-o-beaker')
                ->components([
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\Select::make('product_id')
                        ->label('Linked Product')
                        ->relationship('product', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Optional — link to a product for margin calculation'),
                    \Filament\Forms\Components\TextInput::make('servings')
                        ->required()
                        ->numeric()
                        ->default(1)
                        ->minValue(1),
                    \Filament\Forms\Components\TextInput::make('prep_time_minutes')
                        ->label('Prep Time (minutes)')
                        ->numeric()
                        ->minValue(0),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->rows(3),
                    \Filament\Forms\Components\Textarea::make('notes')
                        ->rows(2),
                ]),
            \Filament\Schemas\Components\Section::make('Ingredients')
                ->icon('heroicon-o-list-bullet')
                ->components([
                    \Filament\Forms\Components\Repeater::make('ingredients')
                        ->relationship()
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->required()
                                ->placeholder('e.g. All-purpose flour'),
                            \Filament\Forms\Components\TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->step('0.01')
                                ->minValue(0),
                            \Filament\Forms\Components\Select::make('unit')
                                ->required()
                                ->options(RecipeIngredient::UNITS),
                            \Filament\Forms\Components\TextInput::make('cost_per_unit')
                                ->label('Cost per Unit')
                                ->required()
                                ->numeric()
                                ->prefix('$')
                                ->step('0.01')
                                ->minValue(0),
                        ])
                        ->columns(4)
                        ->defaultItems(1)
                        ->addActionLabel('Add Ingredient')
                        ->reorderable(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('servings')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_cost')
                    ->label('Total Cost')
                    ->money('usd')
                    ->sortable(query: fn ($query, string $direction) => $query)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('cost_per_serving')
                    ->label('Cost / Serving')
                    ->money('usd')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('profit_margin')
                    ->label('Margin %')
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1) . '%' : '—')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('has_product')
                    ->label('Linked to Product')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('product_id'),
                        false: fn ($query) => $query->whereNull('product_id'),
                    ),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
