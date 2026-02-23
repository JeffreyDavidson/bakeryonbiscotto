<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use App\Services\PayPalService;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CheckPayPalPayments extends Command
{
    protected $signature = 'payments:check-paypal';
    protected $description = 'Check PayPal invoice statuses and update orders';

    public function handle(PayPalService $paypalService): int
    {
        $orders = Order::where('payment_status', 'unpaid')
            ->whereNotNull('paypal_invoice_id')
            ->get();

        $this->info("Checking {$orders->count()} unpaid PayPal orders...");

        foreach ($orders as $order) {
            try {
                $status = $paypalService->getInvoiceStatus($order->paypal_invoice_id);

                if ($status === 'PAID') {
                    $order->update([
                        'payment_status' => 'paid',
                        'paid_at' => now(),
                    ]);
                    $this->info("Order {$order->order_number} marked as paid.");
                    Log::info("PayPal payment received for order {$order->order_number}");
                } elseif ($status === 'CANCELLED') {
                    $order->update(['payment_status' => 'cancelled']);
                    $this->info("Order {$order->order_number} marked as cancelled.");
                    Log::info("PayPal invoice cancelled for order {$order->order_number}");
                }

                // Check for overdue
                if ($order->payment_status === 'unpaid' && $order->payment_deadline && Carbon::parse($order->payment_deadline)->isPast()) {
                    $this->warn("Order {$order->order_number} is OVERDUE!");

                    // Send notification to all admin users
                    $admins = User::all();
                    foreach ($admins as $admin) {
                        Notification::make()
                            ->title("⚠️ Overdue payment: Order {$order->order_number} - {$order->customer_name} (\${$order->total})")
                            ->danger()
                            ->sendToDatabase($admin);
                    }
                }
            } catch (\Exception $e) {
                $this->error("Error checking order {$order->order_number}: {$e->getMessage()}");
                Log::error("PayPal check failed for order {$order->order_number}", ['error' => $e->getMessage()]);
            }
        }

        $this->info('Done.');
        return self::SUCCESS;
    }
}
