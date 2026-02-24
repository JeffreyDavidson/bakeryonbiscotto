<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderNote;
use BackedEnum;
use Filament\Actions;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ViewOrder extends Page
{
    use InteractsWithRecord;

    protected static string $resource = OrderResource::class;

    protected static ?string $navigationLabel = 'View';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-eye';

    protected string $view = 'filament.pages.order-detail';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->record->load(['items', 'orderNotes.user']);
    }

    public function getBreadcrumbs(): array
    {
        return [
            OrderResource::getUrl() => 'Orders',
            static::getResource()::getUrl('view', ['record' => $this->record]) => $this->record->order_number,
            'View',
        ];
    }

    public function getTitle(): string
    {
        return 'Order ' . $this->record->order_number;
    }

    public function getHeading(): string
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('confirm')
                ->label('Confirm Order')
                ->icon('heroicon-o-check')
                ->color('info')
                ->visible(fn () => $this->record->status === 'pending')
                ->requiresConfirmation()
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update(['status' => 'confirmed']);
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'status_change',
                        'content' => 'Status changed from ' . ucfirst($oldStatus) . ' to Confirmed',
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('baking')
                ->label('Start Baking')
                ->icon('heroicon-o-fire')
                ->color('primary')
                ->visible(fn () => $this->record->status === 'confirmed')
                ->requiresConfirmation()
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update(['status' => 'baking']);
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'status_change',
                        'content' => 'Status changed from ' . ucfirst($oldStatus) . ' to Baking',
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('ready')
                ->label('Mark Ready')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'baking')
                ->requiresConfirmation()
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update(['status' => 'ready']);
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'status_change',
                        'content' => 'Status changed from ' . ucfirst($oldStatus) . ' to Ready',
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('delivered')
                ->label('Mark Delivered')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn () => $this->record->status === 'ready')
                ->requiresConfirmation()
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'delivered',
                        'delivered_at' => now(),
                    ]);
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'status_change',
                        'content' => 'Status changed from ' . ucfirst($oldStatus) . ' to Delivered',
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('cancel')
                ->label('Cancel Order')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => ! in_array($this->record->status, ['delivered', 'cancelled']))
                ->requiresConfirmation()
                ->modalHeading('Cancel this order?')
                ->modalDescription('This will mark the order as cancelled.')
                ->form([
                    \Filament\Forms\Components\Select::make('payment_status')
                        ->label('Payment Status')
                        ->options([
                            'paid' => 'Paid (no refund yet)',
                            'cancelled' => 'Cancelled',
                            'refunded' => 'Refunded',
                        ])
                        ->default('paid')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'cancelled',
                        'payment_status' => $data['payment_status'],
                    ]);
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'status_change',
                        'content' => 'Status changed from ' . ucfirst($oldStatus) . ' to Cancelled',
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('add_note')
                ->label('Add Note')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('gray')
                ->form([
                    \Filament\Forms\Components\Textarea::make('content')
                        ->label('Note')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (array $data) {
                    OrderNote::create([
                        'order_id' => $this->record->id,
                        'user_id' => auth()->id(),
                        'type' => 'note',
                        'content' => $data['content'],
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('printInvoice')
                ->label('Print Invoice')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn () => route('admin.orders.invoice', $this->record))
                ->openUrlInNewTab(),

            Actions\Action::make('reorder')
                ->label('Reorder')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->url(fn () => \App\Filament\Pages\QuickOrder::getUrl() . '?reorder=' . $this->record->id),

            Actions\Action::make('edit')
                ->label('Edit Order')
                ->icon('heroicon-o-pencil')
                ->color('gray')
                ->url(fn () => static::getResource()::getUrl('edit', ['record' => $this->record])),
        ];
    }
}
