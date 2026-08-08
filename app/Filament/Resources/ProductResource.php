<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

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
        return $schema->columns(1)->components([
            Section::make('Product Details')
                ->icon('heroicon-o-shopping-bag')
                ->description('Name, pricing, and images')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Sourdough Loaf')
                        ->prefixIcon('heroicon-o-tag')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state)))
                        ->columnSpanFull(),
                    TextInput::make('slug')
                        ->maxLength(255)
                        ->helperText('Auto-generated from name. Edit to override.')
                        ->prefixIcon('heroicon-o-link'),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->preload()
                        ->prefixIcon('heroicon-o-folder'),
                    TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->step('0.01')
                        ->placeholder('12.00'),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->prefixIcon('heroicon-o-arrows-up-down'),
                    Textarea::make('description')
                        ->rows(3)
                        ->placeholder('Describe this product...')
                        ->columnSpanFull(),
                    Placeholder::make('current_image')
                        ->label('Current Image')
                        ->visible(fn ($record) => $record?->image)
                        ->content(fn ($record) => new HtmlString(
                            '<img src="'.asset($record->image).'" style="max-height:150px;border-radius:0.5rem;border:1px solid #e8d0b0;" />'
                        ))
                        ->columnSpanFull(),
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->visibility('public')
                        ->helperText('Upload a new image to replace the current one')
                        ->columnSpanFull(),
                ]),

            Section::make('Availability')
                ->icon('heroicon-o-adjustments-horizontal')
                ->description('Stock limits and seasonal scheduling')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    Toggle::make('is_available')
                        ->label('Available for ordering')
                        ->default(true),
                    Toggle::make('is_featured')
                        ->label('Featured product'),
                    TextInput::make('max_per_order')
                        ->numeric()
                        ->nullable()
                        ->placeholder('No limit')
                        ->helperText('Max per single order')
                        ->prefixIcon('heroicon-o-shopping-cart'),
                    TextInput::make('weekly_limit')
                        ->numeric()
                        ->nullable()
                        ->placeholder('No limit')
                        ->helperText('Max baked per week')
                        ->prefixIcon('heroicon-o-calendar'),
                    DatePicker::make('seasonal_start')
                        ->label('Season Start')
                        ->native(false)
                        ->prefixIcon('heroicon-o-play')
                        ->helperText('Leave blank for year-round'),
                    DatePicker::make('seasonal_end')
                        ->label('Season End')
                        ->native(false)
                        ->prefixIcon('heroicon-o-stop')
                        ->helperText('Leave blank for year-round'),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Products')
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('')
                    ->circular()
                    ->width(40)
                    ->height(40),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('recipe.cost_per_serving')
                    ->label('Cost')
                    ->money('usd')
                    ->placeholder('—')
                    ->sortable(query: fn ($query, string $direction) => $query)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('recipe.profit_margin')
                    ->label('Margin')
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1).'%' : '—')
                    ->color(fn ($state) => match (true) {
                        $state === null => 'gray',
                        $state > 50 => 'success',
                        $state >= 30 => 'warning',
                        default => 'danger',
                    })
                    ->badge()
                    ->sortable(query: fn ($query, string $direction) => $query)
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Available')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('favorites_count')
                    ->label('♥')
                    ->counts('favorites')
                    ->sortable()
                    ->badge()
                    ->color('danger')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->trueColor('warning')
                    ->falseIcon('')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_seasonal')
                    ->label('Seasonal')
                    ->boolean()
                    ->trueIcon('heroicon-s-calendar-days')
                    ->trueColor('warning')
                    ->falseIcon('')
                    ->getStateUsing(fn (Product $record) => $record->is_seasonal)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Available'),
                Tables\Filters\TernaryFilter::make('seasonal')
                    ->label('Seasonal')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('seasonal_start')->orWhereNotNull('seasonal_end'),
                        false: fn ($query) => $query->whereNull('seasonal_start')->whereNull('seasonal_end'),
                    ),
                Tables\Filters\TernaryFilter::make('in_season')
                    ->label('In Season')
                    ->queries(
                        true: fn ($query) => $query->where(function ($q) {
                            $today = now()->toDateString();
                            $q->where(function ($q2) {
                                $q2->whereNull('seasonal_start')->whereNull('seasonal_end');
                            })->orWhere(function ($q2) use ($today) {
                                $q2->where('seasonal_start', '<=', $today)->where('seasonal_end', '>=', $today);
                            })->orWhere(function ($q2) use ($today) {
                                $q2->where('seasonal_start', '<=', $today)->whereNull('seasonal_end');
                            })->orWhere(function ($q2) use ($today) {
                                $q2->whereNull('seasonal_start')->where('seasonal_end', '>=', $today);
                            });
                        }),
                        false: fn ($query) => $query->where(function ($q) {
                            $today = now()->toDateString();
                            $q->where('seasonal_start', '>', $today)
                                ->orWhere('seasonal_end', '<', $today);
                        }),
                    ),
            ])
            ->actions([
                Action::make('toggle_availability')
                    ->icon(fn (Product $record) => $record->is_available ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Product $record) => $record->is_available ? 'gray' : 'success')
                    ->label(fn (Product $record) => $record->is_available ? 'Hide' : 'Show')
                    ->action(fn (Product $record) => $record->update(['is_available' => ! $record->is_available])),
                EditAction::make()
                    ->slideOver()
                    ->modalWidth('2xl'),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No products yet')
            ->emptyStateDescription('Add your first product to start taking orders! 🍞')
            ->emptyStateIcon('heroicon-o-shopping-bag');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
