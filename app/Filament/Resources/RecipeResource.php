<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
        return $schema->columns(1)->components([
            Section::make('Recipe Details')
                ->icon('heroicon-o-beaker')
                ->description('Basic recipe information')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-tag')
                        ->placeholder('e.g. Classic Sourdough Loaf')
                        ->columnSpanFull(),
                    Select::make('product_id')
                        ->label('Linked Product')
                        ->relationship('product', 'name')
                        ->searchable()
                        ->preload()
                        ->prefixIcon('heroicon-o-link')
                        ->placeholder('Optional — link to a product for margin calculation')
                        ->columnSpanFull(),
                    TextInput::make('servings')
                        ->required()
                        ->numeric()
                        ->default(1)
                        ->minValue(1)
                        ->prefixIcon('heroicon-o-squares-2x2')
                        ->placeholder('1'),
                    TextInput::make('prep_time_minutes')
                        ->label('Prep Time (minutes)')
                        ->numeric()
                        ->minValue(0)
                        ->prefixIcon('heroicon-o-clock')
                        ->placeholder('e.g. 120'),
                    Textarea::make('description')
                        ->rows(3)
                        ->placeholder('Describe the recipe — technique notes, variations, etc.')
                        ->columnSpanFull(),
                    Textarea::make('notes')
                        ->rows(2)
                        ->placeholder('Personal notes, tips, lessons learned...')
                        ->columnSpanFull(),
                ]),
            Section::make('Ingredients')
                ->icon('heroicon-o-list-bullet')
                ->description('What goes into this recipe')
                ->columnSpanFull()
                ->components([
                    Repeater::make('ingredients')
                        ->relationship()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->placeholder('e.g. All-purpose flour'),
                            TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->step('0.01')
                                ->minValue(0),
                            Select::make('unit')
                                ->required()
                                ->options(RecipeIngredient::UNITS),
                            TextInput::make('cost_per_unit')
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
            Section::make('Prep Stages')
                ->icon('heroicon-o-clock')
                ->description('Define each stage working backwards from pickup/delivery time')
                ->columnSpanFull()
                ->components([
                    Repeater::make('stages')
                        ->relationship()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->placeholder('e.g. Feed starter, Mix dough, Bake'),
                            TextInput::make('hours_before')
                                ->label('Hours Before Pickup')
                                ->required()
                                ->numeric()
                                ->step('0.5')
                                ->minValue(0)
                                ->suffix('hrs')
                                ->helperText('How many hours before the order is due'),
                            TextInput::make('duration_minutes')
                                ->label('Duration')
                                ->numeric()
                                ->default(30)
                                ->suffix('min'),
                            TextInput::make('instructions')
                                ->placeholder('Optional notes for this stage'),
                        ])
                        ->columns(4)
                        ->defaultItems(0)
                        ->addActionLabel('Add Stage')
                        ->orderColumn('sort_order')
                        ->reorderable(),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Recipes')
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
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1).'%' : '—')
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
