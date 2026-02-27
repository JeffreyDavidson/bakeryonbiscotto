<?php

namespace App\Console\Commands;

use App\Mail\BirthdayDiscount;
use App\Models\Coupon;
use App\Models\CustomerProfile;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendBirthdayDiscounts extends Command
{
    protected $signature = 'customers:send-birthday-discounts';
    protected $description = 'Send birthday discount coupons to customers whose birthday is today';

    public function handle(): int
    {
        if (Setting::get('birthday_program_enabled', '0') !== '1') {
            $this->info('Birthday program is disabled.');
            return self::SUCCESS;
        }

        $discountPercent = (int) Setting::get('birthday_discount_percent', '15');

        $customers = CustomerProfile::birthdayToday()
            ->where(function ($q) {
                $q->whereNull('birthday_reminder_sent_at')
                  ->orWhere('birthday_reminder_sent_at', '<', now()->startOfYear());
            })
            ->get();

        $sent = 0;

        foreach ($customers as $customer) {
            try {
                $code = 'BDAY-' . strtoupper(Str::random(6));

                $coupon = Coupon::create([
                    'code' => $code,
                    'description' => "Birthday discount for {$customer->name}",
                    'type' => 'percentage',
                    'value' => $discountPercent,
                    'minimum_order' => null,
                    'max_uses' => 1,
                    'times_used' => 0,
                    'starts_at' => now(),
                    'expires_at' => now()->addDays(7),
                    'is_active' => true,
                ]);

                Mail::to($customer->email)->send(new BirthdayDiscount($customer, $coupon));

                $customer->update(['birthday_reminder_sent_at' => now()]);
                $sent++;

                $this->info("Sent birthday discount to {$customer->email}");
            } catch (\Exception $e) {
                $this->error("Failed for {$customer->email}: {$e->getMessage()}");
                report($e);
            }
        }

        $this->info("Done. Sent {$sent} birthday discount(s).");
        return self::SUCCESS;
    }
}
