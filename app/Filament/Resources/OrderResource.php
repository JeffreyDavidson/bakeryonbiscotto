<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action as TableAction;
use Filament\Infolists;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = 'Orders';

    protected static ?int $navigationSort = 3;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-clipboard-document-list';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Shop';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Order::active()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return Order::pending()->count() > 0 ? 'warning' : 'success';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Customer Info')->components([
                \Filament\Forms\Components\TextInput::make('customer_name')->required(),
                \Filament\Forms\Components\TextInput::make('customer_email')->email()->required(),
                \Filament\Forms\Components\TextInput::make('customer_phone'),
            ])->columns(3),

            Section::make('Order Details')->components([
                \Filament\Forms\Components\Select::make('fulfillment_type')
                    ->options(['pickup' => 'Pickup', 'delivery' => 'Delivery'])
                    ->required(),
                \Filament\Forms\Components\DatePicker::make('requested_date')->required(),
                \Filament\Forms\Components\TextInput::make('requested_time')->label('Requested Time'),
                \Filament\Forms\Components\Textarea::make('delivery_address')
                    ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                \Filament\Forms\Components\TextInput::make('delivery_zip')
                    ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                \Filament\Forms\Components\TextInput::make('delivery_fee')
                    ->numeric()->prefix('$')->default(0),
                \Filament\Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ])->columns(2),

            Section::make('Status')->components([
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'baking' => 'Baking',
                        'ready' => 'Ready',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->required(),
                \Filament\Forms\Components\Select::make('payment_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'refunded' => 'Refunded',
                    ])->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Items'),
                Tables\Columns\TextColumn::make('total')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fulfillment_type')
                    ->badge()
                    ->color(fn (string $state) => $state === 'delivery' ? 'info' : 'gray')
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('requested_date')
                    ->label('Requested Date & Time')
                    ->formatStateUsing(function ($record) {
                        $date = $record->requested_date->format('M j, Y');
                        if (! $record->requested_time) return $date;
                        $time = $record->requested_time;
                        // Convert 24h format (e.g. "16:00") to 12h
                        if (preg_match('/^\d{1,2}:\d{2}$/', $time) && !str_contains($time, 'AM') && !str_contains($time, 'PM')) {
                            $time = date('g:i A', strtotime($time));
                        }
                        return $date . ' at ' . $time;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'baking' => 'primary',
                        'ready' => 'success',
                        'completed' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'baking' => 'Baking',
                        'ready' => 'Ready',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                TableAction::make('confirm')
                    ->icon('heroicon-o-check')
                    ->color('info')
                    ->visible(fn (Order $record) => $record->status === 'pending')
                    ->action(fn (Order $record) => $record->update(['status' => 'confirmed'])),
                TableAction::make('baking')
                    ->icon('heroicon-o-fire')
                    ->color('primary')
                    ->label('Start Baking')
                    ->visible(fn (Order $record) => $record->status === 'confirmed')
                    ->action(fn (Order $record) => $record->update(['status' => 'baking'])),
                TableAction::make('ready')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->label('Mark Ready')
                    ->visible(fn (Order $record) => $record->status === 'baking')
                    ->action(fn (Order $record) => $record->update(['status' => 'ready'])),
                TableAction::make('complete')
                    ->icon('heroicon-o-check-badge')
                    ->color('gray')
                    ->visible(fn (Order $record) => $record->status === 'ready')
                    ->action(fn (Order $record) => $record->update([
                        'status' => 'completed',
                        'delivered_at' => now(),
                    ])),
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
