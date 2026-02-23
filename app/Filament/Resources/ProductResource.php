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
                ->columns(2)
                ->components([
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Sourdough Loaf')
                        ->prefixIcon('heroicon-o-tag')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                        ->columnSpanFull(),
                    \Filament\Forms\Components\TextInput::make('slug')
                        ->maxLength(255)
                        ->helperText('Auto-generated from name. Edit to override.')
                        ->prefixIcon('heroicon-o-link'),
                    \Filament\Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->preload()
                        ->prefixIcon('heroicon-o-folder'),
                    \Filament\Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->step('0.01')
                        ->placeholder('12.00'),
                    \Filament\Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->prefixIcon('heroicon-o-arrows-up-down'),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->rows(3)
                        ->placeholder('Describe this product...')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\Placeholder::make('current_image')
                        ->label('Current Image')
                        ->visible(fn ($record) => $record?->image)
                        ->content(fn ($record) => new \Illuminate\Support\HtmlString(
                            '<img src="' . asset($record->image) . '" style="max-height:150px;border-radius:0.5rem;border:1px solid #e8d0b0;" />'
                        ))
                        ->columnSpanFull(),
                    \Filament\Forms\Components\FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->visibility('public')
                        ->helperText('Upload a new image to replace the current one')
                        ->columnSpanFull(),
                ]),

            \Filament\Schemas\Components\Section::make('Availability')
                ->icon('heroicon-o-adjustments-horizontal')
                ->columns(2)
                ->components([
                    \Filament\Forms\Components\Toggle::make('is_available')
                        ->label('Available for ordering')
                        ->default(true),
                    \Filament\Forms\Components\Toggle::make('is_featured')
                        ->label('Featured product'),
                    \Filament\Forms\Components\TextInput::make('max_per_order')
                        ->numeric()
                        ->nullable()
                        ->placeholder('No limit')
                        ->helperText('Max per single order')
                        ->prefixIcon('heroicon-o-shopping-cart'),
                    \Filament\Forms\Components\TextInput::make('weekly_limit')
                        ->numeric()
                        ->nullable()
                        ->placeholder('No limit')
                        ->helperText('Max baked per week')
                        ->prefixIcon('heroicon-o-calendar'),
                    \Filament\Forms\Components\DatePicker::make('seasonal_start')
                        ->label('Season Start')
                        ->native(false)
                        ->prefixIcon('heroicon-o-play')
                        ->helperText('Leave blank for year-round'),
                    \Filament\Forms\Components\DatePicker::make('seasonal_end')
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
            ->heading("🧁 Products")
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
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Available')
                    ->boolean()
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
                            $q->where(function ($q2) use ($today) {
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
                    ->action(fn (Product $record) => $record->update(['is_available' => !$record->is_available])),
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
