<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'monthly_revenue_goal'],
            ['value' => '5000']
        );
        Setting::updateOrCreate(
            ['key' => 'yearly_revenue_goal'],
            ['value' => '50000']
        );
        Setting::updateOrCreate(
            ['key' => 'send_order_emails'],
            ['value' => '1']
        );
    }
}
