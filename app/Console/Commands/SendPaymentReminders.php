<?php

namespace App\Console\Commands;

use App\Mail\PaymentReminderMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPaymentReminders extends Command
{
    protected $signature = 'payments:send-reminders';
    protected $description = 'Send payment reminder emails for orders due tomorrow';

    public function handle(): int
    {
        $tomorrow = Carbon::tomorrow();

        $orders = Order::where('payment_status', 'unpaid')
            ->whereDate('payment_deadline', $tomorrow)
            ->where('payment_reminder_sent', false)
            ->get();

        $this->info("Found {$orders->count()} orders needing payment reminders...");

        foreach ($orders as $order) {
            try {
                Mail::to($order->customer_email)->send(new PaymentReminderMail($order));
                $order->update(['payment_reminder_sent' => true]);
                $this->info("Reminder sent for order {$order->order_number} to {$order->customer_email}");
                Log::info("Payment reminder sent for order {$order->order_number}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for {$order->order_number}: {$e->getMessage()}");
                Log::error("Payment reminder failed for order {$order->order_number}", ['error' => $e->getMessage()]);
            }
        }

        $this->info('Done.');
        return self::SUCCESS;
    }
}
