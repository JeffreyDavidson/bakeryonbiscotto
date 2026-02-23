<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Component;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationLabel = 'Messages';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-envelope';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'Communication';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading("Messages")
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('subject')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    })
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M j, g:i A')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
                \Filament\Tables\Filters\Filter::make('date_range')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('From'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) $indicators[] = 'From ' . \Carbon\Carbon::parse($data['from'])->format('M j, Y');
                        if ($data['until'] ?? null) $indicators[] = 'Until ' . \Carbon\Carbon::parse($data['until'])->format('M j, Y');
                        return $indicators;
                    }),
                \Filament\Tables\Filters\TernaryFilter::make('has_orders')
                    ->label('Has Orders')
                    ->queries(
                        true: fn ($query) => $query->whereIn('email', \App\Models\Order::select('customer_email')),
                        false: fn ($query) => $query->whereNotIn('email', \App\Models\Order::select('customer_email')),
                    ),
            ])
            ->actions([
                Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->modalHeading(fn (ContactMessage $record) => '')
                    ->modalWidth('3xl')
                    ->slideOver()
                    ->modalContent(fn (ContactMessage $record) => view('filament.pages.contact-message-detail', [
                        'message' => $record,
                        'orders' => \App\Models\Order::where('customer_email', $record->email)
                            ->orderByDesc('created_at')
                            ->limit(10)
                            ->get(),
                    ]))
                    ->mountUsing(function (ContactMessage $record) {
                        if ($record->status === 'new') {
                            $record->update(['status' => 'read']);
                        }
                    })
                    ->modalFooterActions(fn (ContactMessage $record) => [
                        Actions\Action::make('replyViaEmail')
                            ->label('Reply via Email')
                            ->icon('heroicon-o-paper-airplane')
                            ->color('primary')
                            ->url(fn () => 'mailto:' . $record->email . '?subject=Re: ' . urlencode($record->subject))
                            ->openUrlInNewTab()
                            ->after(function () use ($record) {
                                if ($record->status !== 'replied') {
                                    $record->update([
                                        'status' => 'replied',
                                        'replied_at' => now(),
                                    ]);
                                }
                            }),
                        Actions\Action::make('close')
                            ->label('Close')
                            ->color('gray')
                            ->close(),
                    ]),
                Actions\Action::make('markRead')
                    ->label('Mark Read')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->action(fn (ContactMessage $record) => $record->update(['status' => 'read']))
                    ->visible(fn (ContactMessage $record) => $record->status === 'new'),
                Actions\Action::make('markReplied')
                    ->label('Mark Replied')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (ContactMessage $record) => $record->update([
                        'status' => 'replied',
                        'replied_at' => now(),
                    ]))
                    ->visible(fn (ContactMessage $record) => $record->status !== 'replied'),
            ])
            ->emptyStateHeading('No messages')
            ->emptyStateDescription('Contact form messages will appear here. 📬')
            ->emptyStateIcon('heroicon-o-envelope');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->columns(5)->components([
            \Filament\Schemas\Components\Grid::make(1)->schema([
                \Filament\Infolists\Components\TextEntry::make('name')
                    ->size('lg')
                    ->weight('bold'),
                \Filament\Infolists\Components\TextEntry::make('email')
                    ->icon('heroicon-o-envelope')
                    ->copyable(),
                \Filament\Infolists\Components\TextEntry::make('phone')
                    ->icon('heroicon-o-phone')
                    ->copyable()
                    ->default('—'),
                \Filament\Infolists\Components\TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    }),
                \Filament\Infolists\Components\TextEntry::make('created_at')
                    ->label('Received')
                    ->since(),
                \Filament\Infolists\Components\TextEntry::make('previous_messages')
                    ->label('Contact History')
                    ->state(function (ContactMessage $record): string {
                        $count = ContactMessage::where('email', $record->email)
                            ->where('id', '!=', $record->id)
                            ->count();

                        if ($count === 0) {
                            return 'First message';
                        }

                        return ($count + 1) . ' total messages';
                    })
                    ->icon('heroicon-o-chat-bubble-left-right'),
            ])->columnSpan(1),

            \Filament\Schemas\Components\Grid::make(1)->schema([
                \Filament\Infolists\Components\TextEntry::make('subject')
                    ->size('lg')
                    ->weight('bold'),
                \Filament\Infolists\Components\TextEntry::make('message')
                    ->prose()
                    ->hiddenLabel(),
            ])->columnSpan(2),

            \Filament\Schemas\Components\Grid::make(1)->schema([
                Section::make('Order History')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('order_history')
                            ->hiddenLabel()
                            ->state(function (ContactMessage $record): \Illuminate\Support\HtmlString {
                                $orders = \App\Models\Order::where('customer_email', $record->email)
                                    ->orderByDesc('created_at')
                                    ->limit(10)
                                    ->get();

                                if ($orders->isEmpty()) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<span style="color:#a08060;font-size:0.85rem;font-style:italic;">No previous orders</span>'
                                    );
                                }

                                $html = $orders->map(function ($order) {
                                    $date = $order->created_at->format('M j');
                                    $status = ucfirst($order->status);
                                    $statusColors = [
                                        'pending' => '#ca8a04',
                                        'confirmed' => '#2563eb',
                                        'baking' => '#9333ea',
                                        'ready' => '#16a34a',
                                        'delivered' => '#a08060',
                                        'cancelled' => '#dc2626',
                                    ];
                                    $color = $statusColors[$order->status] ?? '#a08060';

                                    return "<div style=\"padding:0.375rem 0;border-bottom:1px solid #f3ebe0;\">
                                        <div style=\"font-weight:600;font-size:0.85rem;color:#3d2314;\">{$order->order_number}</div>
                                        <div style=\"display:flex;justify-content:space-between;font-size:0.75rem;color:#a08060;margin-top:0.125rem;\">
                                            <span>\${$order->total}</span>
                                            <span style=\"color:{$color};\">{$status}</span>
                                            <span>{$date}</span>
                                        </div>
                                    </div>";
                                })->join('');

                                $count = $orders->count();
                                $totalSpent = '$' . number_format($orders->sum('total'), 2);

                                return new \Illuminate\Support\HtmlString(
                                    "<div style=\"font-size:0.75rem;color:#a08060;margin-bottom:0.5rem;\">{$count} orders · {$totalSpent} total</div>{$html}"
                                );
                            })
                            ->html(),
                    ]),
            ])->columnSpan(2),
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
