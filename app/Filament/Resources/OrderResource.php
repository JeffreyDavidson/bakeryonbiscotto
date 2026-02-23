<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action as TableAction;

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
            Section::make('Customer Info')
                ->icon('heroicon-o-user')
                ->components([
                    \Filament\Forms\Components\TextInput::make('customer_name')
                        ->required()
                        ->placeholder('Jane Smith')
                        ->prefixIcon('heroicon-o-user'),
                    \Filament\Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->required()
                        ->placeholder('jane@example.com')
                        ->prefixIcon('heroicon-o-envelope'),
                    \Filament\Forms\Components\TextInput::make('customer_phone')
                        ->placeholder('(555) 123-4567')
                        ->prefixIcon('heroicon-o-phone'),
                ])->columns(3),

            Section::make('Fulfillment')
                ->icon('heroicon-o-truck')
                ->components([
                    \Filament\Forms\Components\Select::make('fulfillment_type')
                        ->options(['pickup' => '📦 Pickup', 'delivery' => '🚗 Delivery'])
                        ->required()
                        ->default('pickup')
                        ->live(),
                    \Filament\Forms\Components\DatePicker::make('requested_date')
                        ->required()
                        ->default(now())
                        ->prefixIcon('heroicon-o-calendar'),
                    \Filament\Forms\Components\TextInput::make('requested_time')
                        ->label('Requested Time')
                        ->placeholder('e.g. 2:00 PM')
                        ->prefixIcon('heroicon-o-clock'),
                    \Filament\Forms\Components\Textarea::make('delivery_address')
                        ->visible(fn ($get) => $get('fulfillment_type') === 'delivery')
                        ->placeholder('Full delivery address')
                        ->rows(2)
                        ->columnSpanFull(),
                    \Filament\Forms\Components\TextInput::make('delivery_zip')
                        ->visible(fn ($get) => $get('fulfillment_type') === 'delivery')
                        ->placeholder('33837'),
                    \Filament\Forms\Components\TextInput::make('delivery_fee')
                        ->numeric()->prefix('$')->default(0)
                        ->visible(fn ($get) => $get('fulfillment_type') === 'delivery'),
                ])->columns(3),

            Section::make('Notes')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->components([
                    \Filament\Forms\Components\Textarea::make('notes')
                        ->hiddenLabel()
                        ->rows(3)
                        ->placeholder('Special instructions, allergies, etc.')
                        ->columnSpanFull(),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading("Orders")
            ->recordUrl(fn (Order $record) => static::getUrl('view', ['record' => $record]))
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable(['customer_name', 'customer_email'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_repeat')
                    ->label('')
                    ->width('1rem')
                    ->getStateUsing(function (Order $record) {
                        $count = Order::where('customer_email', $record->customer_email)
                            ->where('id', '!=', $record->id)
                            ->count();
                        return $count > 0 ? '🔄' : '';
                    })
                    ->tooltip(function (Order $record) {
                        $count = Order::where('customer_email', $record->customer_email)->count();
                        return $count > 1 ? "Repeat customer ({$count} orders)" : null;
                    }),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Items')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total')
                    ->money('usd')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('fulfillment_type')
                    ->badge()
                    ->color(fn (string $state) => $state === 'delivery' ? 'info' : 'gray')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->toggleable(),
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
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (string $state, Order $record) => match (true) {
                        $record->is_overdue => 'danger',
                        $state === 'paid' => 'success',
                        $state === 'unpaid' => 'warning',
                        $state === 'cancelled' => 'gray',
                        $state === 'refunded' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state, Order $record) => $record->is_overdue ? '⚠️ Overdue' : ucfirst($state))
                    ->toggleable(),
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
            ->filters([
                Tables\Filters\SelectFilter::make('fulfillment_type')
                    ->label('Fulfillment')
                    ->options([
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                    ]),
                Tables\Filters\Filter::make('requested_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('From'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('requested_date', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('requested_date', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) $indicators[] = 'From ' . \Carbon\Carbon::parse($data['from'])->format('M j, Y');
                        if ($data['until'] ?? null) $indicators[] = 'Until ' . \Carbon\Carbon::parse($data['until'])->format('M j, Y');
                        return $indicators;
                    }),
                Tables\Filters\TernaryFilter::make('has_notes')
                    ->label('Special Instructions')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('notes')->where('notes', '!=', ''),
                        false: fn ($query) => $query->where(fn ($q) => $q->whereNull('notes')->orWhere('notes', '')),
                    ),
            ])
            ->actions([
                TableAction::make('confirm')
                    ->icon('heroicon-o-check')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Order')
                    ->modalDescription(fn (Order $record) => "Confirm order {$record->order_number} for {$record->customer_name}?")
                    ->visible(fn (Order $record) => $record->status === 'pending')
                    ->action(fn (Order $record) => $record->update(['status' => 'confirmed'])),
                TableAction::make('baking')
                    ->icon('heroicon-o-fire')
                    ->color('primary')
                    ->label('Start Baking')
                    ->requiresConfirmation()
                    ->modalHeading('Start Baking')
                    ->modalDescription(fn (Order $record) => "Mark order {$record->order_number} as baking?")
                    ->visible(fn (Order $record) => $record->status === 'confirmed')
                    ->action(fn (Order $record) => $record->update(['status' => 'baking'])),
                TableAction::make('ready')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->label('Mark Ready')
                    ->requiresConfirmation()
                    ->modalHeading('Mark Ready')
                    ->modalDescription(fn (Order $record) => "Mark order {$record->order_number} as ready for {$record->fulfillment_type}?")
                    ->visible(fn (Order $record) => $record->status === 'baking')
                    ->action(fn (Order $record) => $record->update(['status' => 'ready'])),
                TableAction::make('complete')
                    ->label('Mark Delivered')
                    ->icon('heroicon-o-check-badge')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->modalHeading('Mark Delivered')
                    ->modalDescription(fn (Order $record) => "Mark order {$record->order_number} as delivered?")
                    ->visible(fn (Order $record) => $record->status === 'ready')
                    ->action(fn (Order $record) => $record->update([
                        'status' => 'delivered',
                        'delivered_at' => now(),
                    ])),
                \Filament\Actions\ViewAction::make()
                    ->url(fn (Order $record) => static::getUrl('view', ['record' => $record])),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No orders yet')
            ->emptyStateDescription('Orders will appear here when customers place them. 🧁')
            ->emptyStateIcon('heroicon-o-clipboard-document-list');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getRecordSubNavigation(\Filament\Resources\Pages\Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewOrder::class,
            Pages\EditOrder::class,
        ]);
    }
}
