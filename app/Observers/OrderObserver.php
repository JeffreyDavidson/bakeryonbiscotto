<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use Filament\Notifications\Notification;

class OrderObserver
{
    public function created(Order $order): void
    {
        $users = User::all();

        Notification::make()
            ->title('New Order Received')
            ->body("New order {$order->order_number} from {$order->customer_name} — \${$order->total}")
            ->icon('heroicon-o-shopping-bag')
            ->success()
            ->sendToDatabase($users);
    }

    public function updated(Order $order): void
    {
        if ($order->isDirty('status')) {
            $users = User::all();

            Notification::make()
                ->title('Order Status Updated')
                ->body("Order {$order->order_number} moved to {$order->status}")
                ->icon('heroicon-o-arrow-path')
                ->info()
                ->sendToDatabase($users);
        }
    }
}
