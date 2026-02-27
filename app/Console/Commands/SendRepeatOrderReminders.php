<?php

namespace App\Console\Commands;

use App\Mail\RepeatOrderReminder;
use App\Models\CustomerReminder;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRepeatOrderReminders extends Command
{
    protected $signature = 'orders:send-repeat-reminders';

    protected $description = 'Send repeat order reminder emails to customers ~30 days after their last delivered order';

    public function handle(): int
    {
        if (Setting::get('send_repeat_reminders', '0') !== '1') {
            $this->info('Repeat order reminders are disabled.');
            return self::SUCCESS;
        }

        // Find the most recent delivered order per customer email,
        // delivered 28-32 days ago, with no reminder sent in the last 25 days.
        $orders = Order::where('status', 'delivered')
            ->whereNotNull('customer_email')
            ->whereNotNull('delivered_at')
            ->whereBetween('delivered_at', [now()->subDays(32), now()->subDays(28)])
            ->get()
            ->groupBy('customer_email')
            ->map(fn ($group) => $group->sortByDesc('delivered_at')->first());

        $count = 0;

        foreach ($orders as $order) {
            // Skip if we already sent a reminder for this customer recently
            $recentReminder = CustomerReminder::where('customer_email', $order->customer_email)
                ->where('type', 'repeat_order')
                ->where('sent_at', '>=', now()->subDays(25))
                ->exists();

            if ($recentReminder) {
                continue;
            }

            // Check they don't have a newer order (not yet in the 28-day window)
            $newerOrder = Order::where('customer_email', $order->customer_email)
                ->where('status', 'delivered')
                ->where('delivered_at', '>', $order->delivered_at)
                ->exists();

            if ($newerOrder) {
                continue;
            }

            $order->load('items');

            Mail::to($order->customer_email)->send(new RepeatOrderReminder($order));

            CustomerReminder::create([
                'customer_email' => $order->customer_email,
                'order_id' => $order->id,
                'type' => 'repeat_order',
                'sent_at' => now(),
            ]);

            $count++;
        }

        $this->info("Sent {$count} repeat order reminder(s).");

        return self::SUCCESS;
    }
}
