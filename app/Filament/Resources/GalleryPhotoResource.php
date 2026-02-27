<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryPhotoResource\Pages;
use App\Models\GalleryPhoto;
use BackedEnum;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryPhotoResource extends Resource
{
    protected static ?string $model = GalleryPhoto::class;

    protected static ?string $navigationLabel = 'Gallery Photos';

    protected static ?int $navigationSort = 10;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-photo';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            \Filament\Schemas\Components\Section::make('Photo Details')
                ->icon('heroicon-o-photo')
                ->description('Upload and configure gallery photo')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    \Filament\Forms\Components\FileUpload::make('image_path')
                        ->label('Image')
                        ->image()
                        ->directory('gallery')
                        ->disk('public')
                        ->required()
                        ->columnSpanFull()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio(null),
                    \Filament\Forms\Components\TextInput::make('title')
                        ->maxLength(255)
                        ->placeholder('Photo title (optional)'),
                    \Filament\Forms\Components\Select::make('category')
                        ->options([
                            'products' => 'Products',
                            'kitchen' => 'Kitchen',
                            'events' => 'Events',
                            'custom' => 'Custom',
                        ])
                        ->placeholder('Select category'),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->maxLength(500)
                        ->rows(3)
                        ->placeholder('Optional description')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->prefixIcon('heroicon-o-arrows-up-down'),
                    \Filament\Forms\Components\Toggle::make('is_visible')
                        ->label('Visible')
                        ->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Gallery Photos')
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->width(60)
                    ->height(60)
                    ->circular(false),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Untitled'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'products' => 'success',
                        'kitchen' => 'warning',
                        'events' => 'info',
                        'custom' => 'gray',
                        default => 'gray',
                    })
                    ->placeholder('None'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'products' => 'Products',
                        'kitchen' => 'Kitchen',
                        'events' => 'Events',
                        'custom' => 'Custom',
                    ]),
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Visibility'),
            ])
            ->actions([
                EditAction::make()->slideOver()->modalWidth('2xl'),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                \Filament\Actions\BulkAction::make('toggle_visibility')
                    ->label('Toggle Visibility')
                    ->icon('heroicon-o-eye')
                    ->requiresConfirmation()
                    ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                        $records->each(fn (GalleryPhoto $record) => $record->update(['is_visible' => !$record->is_visible]));
                    }),
            ])
            ->emptyStateHeading('No gallery photos yet')
            ->emptyStateDescription('Upload photos to populate the gallery page.')
            ->emptyStateIcon('heroicon-o-photo');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryPhotos::route('/'),
        ];
    }
}
