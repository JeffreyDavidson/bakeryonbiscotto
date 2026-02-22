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
            \Filament\Schemas\Components\Grid::make(3)->schema([
                \Filament\Schemas\Components\Grid::make(1)->schema([
                    Section::make('Customer Info')->components([
                        \Filament\Forms\Components\TextInput::make('customer_name')->required(),
                        \Filament\Forms\Components\TextInput::make('customer_email')->email()->required(),
                        \Filament\Forms\Components\TextInput::make('customer_phone'),
                    ]),

                    Section::make('Fulfillment')->components([
                        \Filament\Forms\Components\Select::make('fulfillment_type')
                            ->options(['pickup' => 'Pickup', 'delivery' => 'Delivery'])
                            ->required()
                            ->live(),
                        \Filament\Forms\Components\DatePicker::make('requested_date')->required(),
                        \Filament\Forms\Components\TextInput::make('requested_time')->label('Requested Time'),
                        \Filament\Forms\Components\Textarea::make('delivery_address')
                            ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                        \Filament\Forms\Components\TextInput::make('delivery_zip')
                            ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                        \Filament\Forms\Components\TextInput::make('delivery_fee')
                            ->numeric()->prefix('$')->default(0)
                            ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                    ])->columns(2),

                    Section::make('Notes')->components([
                        \Filament\Forms\Components\Textarea::make('notes')->hiddenLabel()->rows(3),
                    ])->collapsible(),
                ])->columnSpan(2),

                \Filament\Schemas\Components\Grid::make(1)->schema([
                    Section::make('Status')->components([
                        \Filament\Forms\Components\Placeholder::make('status_badge')
                            ->hiddenLabel()
                            ->content(function (Order $record): \Illuminate\Support\HtmlString {
                                $colors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                    'baking' => 'bg-purple-100 text-purple-800',
                                    'ready' => 'bg-green-100 text-green-800',
                                    'delivered' => 'bg-gray-100 text-gray-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $color = $colors[$record->status] ?? 'bg-gray-100 text-gray-800';
                                $label = ucfirst($record->status);
                                $badge = "<span class=\"inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {$color}\">{$label}</span>";

                                if ($record->status === 'cancelled' && $record->payment_status) {
                                    $psLabel = ucfirst($record->payment_status);
                                    $psColor = $record->payment_status === 'refunded'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-yellow-100 text-yellow-800';
                                    $badge .= " <span class=\"inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {$psColor} ml-2\">{$psLabel}</span>";
                                }

                                return new \Illuminate\Support\HtmlString($badge);
                            }),
                    ]),

                    Section::make('Order Summary')->components([
                        \Filament\Forms\Components\Placeholder::make('order_number_display')
                            ->label('Order #')
                            ->content(fn (Order $record): string => $record->order_number),
                        \Filament\Forms\Components\Placeholder::make('subtotal_display')
                            ->label('Subtotal')
                            ->content(fn (Order $record): string => '$' . number_format($record->subtotal, 2)),
                        \Filament\Forms\Components\Placeholder::make('delivery_fee_display')
                            ->label('Delivery Fee')
                            ->content(fn (Order $record): string => '$' . number_format($record->delivery_fee, 2))
                            ->visible(fn (Order $record): bool => $record->fulfillment_type === 'delivery'),
                        \Filament\Forms\Components\Placeholder::make('total_display')
                            ->label('Total')
                            ->content(fn (Order $record): string => '$' . number_format($record->total, 2)),
                        \Filament\Forms\Components\Placeholder::make('paid_at_display')
                            ->label('Paid At')
                            ->content(fn (Order $record): string => $record->paid_at?->format('M j, Y g:i A') ?? 'Not paid'),
                    ]),

                    Section::make('Items')->components([
                        \Filament\Forms\Components\Placeholder::make('items_list')
                            ->hiddenLabel()
                            ->content(function (Order $record): \Illuminate\Support\HtmlString {
                                $items = $record->items->map(function ($item) {
                                    return "<div class=\"flex justify-between py-1\">
                                        <span>{$item->quantity}× {$item->product_name}</span>
                                        <span class=\"font-medium\">\${$item->line_total}</span>
                                    </div>";
                                })->join('');

                                return new \Illuminate\Support\HtmlString(
                                    $items ?: '<span class="text-gray-400">No items</span>'
                                );
                            }),
                    ]),
                ])->columnSpan(1),
            ]),
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
                        'delivered' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
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
                    ->label('Mark Delivered')
                    ->icon('heroicon-o-check-badge')
                    ->color('gray')
                    ->visible(fn (Order $record) => $record->status === 'ready')
                    ->action(fn (Order $record) => $record->update([
                        'status' => 'delivered',
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
