<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationLabel = 'Coupons';

    protected static ?int $navigationSort = 5;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-ticket';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Section::make('Coupon Details')
                ->icon('heroicon-o-ticket')
                ->columns(2)
                ->columnSpanFull()
                ->components([
                    \Filament\Forms\Components\TextInput::make('code')
                        ->required()
                        ->maxLength(50)
                        ->unique(ignoreRecord: true)
                        ->placeholder('e.g. SUMMER20')
                        ->extraInputAttributes(['style' => 'text-transform: uppercase'])
                        ->suffixAction(
                            \Filament\Actions\Action::make('generate')
                                ->icon('heroicon-o-sparkles')
                                ->action(function ($set) {
                                    $set('code', strtoupper(Str::random(8)));
                                })
                        ),
                    \Filament\Forms\Components\Select::make('type')
                        ->options([
                            'percentage' => 'Percentage (%)',
                            'fixed_amount' => 'Fixed Amount ($)',
                        ])
                        ->required()
                        ->default('percentage')
                        ->live(),
                    \Filament\Forms\Components\TextInput::make('value')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->suffix(fn ($get) => $get('type') === 'percentage' ? '%' : '$')
                        ->placeholder(fn ($get) => $get('type') === 'percentage' ? 'e.g. 15' : 'e.g. 5.00'),
                    \Filament\Forms\Components\TextInput::make('minimum_order')
                        ->numeric()
                        ->prefix('$')
                        ->placeholder('No minimum')
                        ->helperText('Leave empty for no minimum'),
                    \Filament\Forms\Components\TextInput::make('max_uses')
                        ->numeric()
                        ->minValue(1)
                        ->placeholder('Unlimited')
                        ->helperText('Leave empty for unlimited uses'),
                    \Filament\Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->label('Active'),
                ]),

            Section::make('Schedule')
                ->icon('heroicon-o-calendar')
                ->columns(2)
                ->columnSpanFull()
                ->collapsible()
                ->components([
                    \Filament\Forms\Components\DateTimePicker::make('starts_at')
                        ->label('Starts At')
                        ->placeholder('Immediately'),
                    \Filament\Forms\Components\DateTimePicker::make('expires_at')
                        ->label('Expires At')
                        ->placeholder('Never'),
                ]),

            Section::make('Description')
                ->icon('heroicon-o-document-text')
                ->columnSpanFull()
                ->collapsible()
                ->collapsed()
                ->components([
                    \Filament\Forms\Components\Textarea::make('description')
                        ->hiddenLabel()
                        ->rows(3)
                        ->placeholder('Internal notes about this coupon...')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Coupons')
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Coupon code copied!'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Discount')
                    ->formatStateUsing(function (Coupon $record) {
                        if ($record->type === 'percentage') {
                            return number_format($record->value, 0) . '%';
                        }
                        return '$' . number_format($record->value, 2);
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('times_used')
                    ->label('Uses')
                    ->formatStateUsing(function (Coupon $record) {
                        $used = $record->times_used;
                        $max = $record->max_uses;
                        return $max ? "{$used} / {$max}" : "{$used} / ∞";
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Coupon $record) {
                        if (!$record->is_active) return 'Inactive';
                        if (!$record->isValid()) return 'Expired';
                        return 'Active';
                    })
                    ->color(fn (string $state) => match ($state) {
                        'Active' => 'success',
                        'Expired' => 'warning',
                        'Inactive' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('minimum_order')
                    ->label('Min Order')
                    ->money('usd')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Expires')
                    ->dateTime('M j, Y')
                    ->placeholder('Never')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('No coupons yet')
            ->emptyStateDescription('Create one to reward your customers')
            ->emptyStateIcon('heroicon-o-ticket');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
