<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

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
                    $this->refreshFormData(['status']);
                }),

            Actions\Action::make('baking')
                ->label('Start Baking')
                ->icon('heroicon-o-fire')
                ->color('primary')
                ->visible(fn () => $this->record->status === 'confirmed')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'baking']);
                    $this->refreshFormData(['status']);
                }),

            Actions\Action::make('ready')
                ->label('Mark Ready')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'baking')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'ready']);
                    $this->refreshFormData(['status']);
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
                    $this->refreshFormData(['status']);
                }),

            Actions\Action::make('cancel')
                ->label('Cancel Order')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => ! in_array($this->record->status, ['delivered', 'cancelled']))
                ->requiresConfirmation()
                ->modalHeading('Cancel this order?')
                ->modalDescription('This will mark the order as cancelled. You can then mark the payment as refunded if needed.')
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
                    $this->refreshFormData(['status']);
                }),
        ];
    }
}
