<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('orders:send-follow-ups')->hourly();
Schedule::command('payments:check-paypal')->hourly();
Schedule::command('payments:send-reminders')->dailyAt('14:00'); // 9am ET
Schedule::command('customers:send-birthday-discounts')->dailyAt('12:00'); // 7am ET
Schedule::command('orders:send-repeat-reminders')->dailyAt('15:00'); // 10am ET
