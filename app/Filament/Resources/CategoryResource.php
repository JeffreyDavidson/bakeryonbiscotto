<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-tag';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make('Category Details')
                ->icon('heroicon-o-tag')
                ->description('Name and URL for this category')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(100)
                        ->prefixIcon('heroicon-o-tag')
                        ->placeholder('e.g. Breads, Pastries, Cookies')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->maxLength(100)
                        ->prefixIcon('heroicon-o-link')
                        ->helperText('Auto-generated from name. Edit to override.'),
                    TextInput::make('description')
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-document-text')
                        ->placeholder('A short description for the storefront')
                        ->columnSpanFull(),
                ]),
            Section::make('Settings')
                ->icon('heroicon-o-cog-6-tooth')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->helperText('Inactive categories are hidden from the order page'),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->prefixIcon('heroicon-o-arrows-up-down')
                        ->helperText('Lower numbers appear first'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Categories')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->placeholder('—')->limit(40)->toggleable(),
                Tables\Columns\TextColumn::make('products_count')
                    ->counts('products')
                    ->label('Products')
                    ->sortable()
                    ->badge()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only')
                    ->placeholder('All'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Action::make('toggle_active')
                    ->icon(fn (Category $record) => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Category $record) => $record->is_active ? 'gray' : 'success')
                    ->label(fn (Category $record) => $record->is_active ? 'Deactivate' : 'Activate')
                    ->action(fn (Category $record) => $record->update(['is_active' => ! $record->is_active])),
                EditAction::make()->slideOver()->modalWidth('2xl'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
        ];
    }
}
