<?php

namespace App\Console\Commands;

use App\Mail\FollowUpReview;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendFollowUpReviews extends Command
{
    protected $signature = 'orders:send-follow-ups';

    protected $description = 'Send follow-up review emails for orders completed 24+ hours ago';

    public function handle(): int
    {
        $orders = Order::where('status', 'completed')
            ->where('follow_up_sent', false)
            ->whereNotNull('delivered_at')
            ->where('delivered_at', '<=', now()->subHours(24))
            ->whereNotNull('customer_email')
            ->get();

        $count = 0;

        foreach ($orders as $order) {
            Mail::to($order->customer_email)->send(new FollowUpReview($order));

            $order->update(['follow_up_sent' => true]);

            $count++;

            $this->info("Sent follow-up to {$order->customer_email} for order {$order->order_number}");
        }

        $this->info("Done. Sent {$count} follow-up email(s).");

        return self::SUCCESS;
    }
}
