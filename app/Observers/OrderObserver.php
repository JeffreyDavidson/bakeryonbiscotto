<?php

namespace App\Observers;

use App\Mail\OrderConfirmation;
use App\Mail\OrderStatusBaking;
use App\Mail\OrderStatusCancelled;
use App\Mail\OrderStatusDelivered;
use App\Mail\OrderStatusReady;
use App\Models\Order;
use App\Models\OrderNote;
use App\Models\Setting;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

            $this->sendStatusEmail($order);
        }
    }

    protected function sendStatusEmail(Order $order): void
    {
        // Check if email notifications are enabled
        if (Setting::get('send_order_emails', '1') !== '1') {
            return;
        }

        // Only send if customer has an email
        if (empty($order->customer_email)) {
            return;
        }

        $order->loadMissing('items');

        $mailable = match ($order->status) {
            'confirmed' => new OrderConfirmation($order),
            'baking' => new OrderStatusBaking($order),
            'ready' => new OrderStatusReady($order),
            'delivered' => new OrderStatusDelivered($order),
            'cancelled' => new OrderStatusCancelled($order),
            default => null,
        };

        if (! $mailable) {
            return;
        }

        try {
            Mail::to($order->customer_email)->send($mailable);

            // Log the notification in order notes
            OrderNote::create([
                'order_id' => $order->id,
                'user_id' => null,
                'type' => 'system',
                'content' => 'Email notification sent: Order ' . ucfirst($order->status),
            ]);

            $order->updateQuietly(['last_notification_sent_at' => now()]);

            Log::info("Order status email sent", [
                'order' => $order->order_number,
                'status' => $order->status,
                'email' => $order->customer_email,
            ]);
        } catch (\Throwable $e) {
            Log::error("Failed to send order status email", [
                'order' => $order->order_number,
                'status' => $order->status,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
