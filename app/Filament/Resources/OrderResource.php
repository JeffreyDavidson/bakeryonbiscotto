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
                                    'pending' => 'background:#fef9c3;color:#a16207;',
                                    'confirmed' => 'background:#dbeafe;color:#1e40af;',
                                    'baking' => 'background:#ede9fe;color:#6d28d9;',
                                    'ready' => 'background:#d1fae5;color:#065f46;',
                                    'delivered' => 'background:#f3f4f6;color:#374151;',
                                    'cancelled' => 'background:#fee2e2;color:#991b1b;',
                                ];
                                $style = $colors[$record->status] ?? 'background:#f3f4f6;color:#374151;';
                                $label = ucfirst($record->status);
                                $html = "<div style=\"text-align:center;\">
                                    <span style=\"display:inline-flex;align-items:center;padding:0.5rem 1.25rem;border-radius:9999px;font-size:1rem;font-weight:700;{$style}\">{$label}</span>";

                                if ($record->status === 'cancelled' && $record->payment_status) {
                                    $psLabel = ucfirst($record->payment_status);
                                    $psStyle = $record->payment_status === 'refunded'
                                        ? 'background:#d1fae5;color:#065f46;'
                                        : 'background:#fef9c3;color:#a16207;';
                                    $html .= "<br><span style=\"display:inline-flex;align-items:center;padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.75rem;font-weight:600;margin-top:0.5rem;{$psStyle}\">{$psLabel}</span>";
                                }

                                $html .= "</div>";
                                return new \Illuminate\Support\HtmlString($html);
                            }),
                    ]),

                    Section::make('Order Summary')->components([
                        \Filament\Forms\Components\Placeholder::make('summary_display')
                            ->hiddenLabel()
                            ->content(function (Order $record): \Illuminate\Support\HtmlString {
                                $rows = [];

                                $rows[] = "<div style=\"display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid #f3f4f6;\">
                                    <span style=\"font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;\">Order #</span>
                                    <span style=\"font-family:monospace;font-weight:700;color:#111827;\">{$record->order_number}</span>
                                </div>";

                                $rows[] = "<div style=\"display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid #f3f4f6;\">
                                    <span style=\"font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;\">Subtotal</span>
                                    <span style=\"color:#374151;\">\$" . number_format($record->subtotal, 2) . "</span>
                                </div>";

                                if ($record->fulfillment_type === 'delivery') {
                                    $rows[] = "<div style=\"display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid #f3f4f6;\">
                                        <span style=\"font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;\">Delivery Fee</span>
                                        <span style=\"color:#374151;\">\$" . number_format($record->delivery_fee, 2) . "</span>
                                    </div>";
                                }

                                $rows[] = "<div style=\"display:flex;justify-content:space-between;padding:0.75rem 0;border-bottom:1px solid #e5e7eb;\">
                                    <span style=\"font-size:0.875rem;font-weight:700;color:#111827;\">Total</span>
                                    <span style=\"font-size:1.25rem;font-weight:800;color:#059669;\">\$" . number_format($record->total, 2) . "</span>
                                </div>";

                                $paidAt = $record->paid_at?->format('M j, Y g:i A') ?? 'Not paid';
                                $paidColor = $record->paid_at ? '#059669' : '#dc2626';
                                $rows[] = "<div style=\"display:flex;justify-content:space-between;padding:0.5rem 0;\">
                                    <span style=\"font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;\">Paid</span>
                                    <span style=\"font-size:0.8rem;color:{$paidColor};font-weight:500;\">{$paidAt}</span>
                                </div>";

                                return new \Illuminate\Support\HtmlString(implode('', $rows));
                            }),
                    ]),

                    Section::make('Items')->components([
                        \Filament\Forms\Components\Placeholder::make('items_list')
                            ->hiddenLabel()
                            ->content(function (Order $record): \Illuminate\Support\HtmlString {
                                if ($record->items->isEmpty()) {
                                    return new \Illuminate\Support\HtmlString('<div style="text-align:center;color:#9ca3af;padding:1rem;">No items</div>');
                                }

                                $items = $record->items->map(function ($item) {
                                    return "<div style=\"display:flex;align-items:center;justify-content:space-between;padding:0.625rem 0.75rem;border-bottom:1px solid #f3f4f6;\">
                                        <div style=\"display:flex;align-items:center;gap:0.5rem;\">
                                            <span style=\"display:inline-flex;align-items:center;justify-content:center;min-width:1.75rem;height:1.75rem;border-radius:0.375rem;background:#fef3c7;font-size:0.8rem;font-weight:700;color:#92400e;\">{$item->quantity}</span>
                                            <span style=\"font-weight:500;color:#111827;font-size:0.875rem;\">{$item->product_name}</span>
                                        </div>
                                        <span style=\"font-weight:600;color:#374151;font-size:0.875rem;\">\$" . number_format($item->line_total, 2) . "</span>
                                    </div>";
                                })->join('');

                                $total = $record->items->sum('quantity');
                                $footer = "<div style=\"display:flex;justify-content:space-between;padding:0.625rem 0.75rem;background:#f9fafb;border-radius:0 0 0.5rem 0.5rem;\">
                                    <span style=\"font-size:0.8rem;color:#6b7280;\">{$total} " . ($total === 1 ? 'item' : 'items') . "</span>
                                    <span style=\"font-weight:700;color:#111827;\">\$" . number_format($record->subtotal, 2) . "</span>
                                </div>";

                                return new \Illuminate\Support\HtmlString(
                                    "<div style=\"border:1px solid #e5e7eb;border-radius:0.5rem;overflow:hidden;\">{$items}{$footer}</div>"
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
