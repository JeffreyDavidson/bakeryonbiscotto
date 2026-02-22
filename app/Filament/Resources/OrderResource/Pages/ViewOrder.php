<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\Page;

class ViewOrder extends Page
{
    protected static string $resource = OrderResource::class;

    protected static ?string $navigationLabel = 'View';

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected string $view = 'filament.pages.order-detail';

    public Order $record;

    public function mount(int|string $record): void
    {
        $this->record = Order::with('items')->findOrFail($record);
    }

    public function getTitle(): string
    {
        return '';
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
                    $this->record->update(['status' => 'confirmed']);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('baking')
                ->label('Start Baking')
                ->icon('heroicon-o-fire')
                ->color('primary')
                ->visible(fn () => $this->record->status === 'confirmed')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'baking']);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('ready')
                ->label('Mark Ready')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'baking')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'ready']);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('delivered')
                ->label('Mark Delivered')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn () => $this->record->status === 'ready')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update([
                        'status' => 'delivered',
                        'delivered_at' => now(),
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
                    $this->record->update([
                        'status' => 'cancelled',
                        'payment_status' => $data['payment_status'],
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\Action::make('edit')
                ->label('Edit Order')
                ->icon('heroicon-o-pencil')
                ->color('gray')
                ->url(fn () => static::getResource()::getUrl('edit', ['record' => $this->record])),
        ];
    }
}
