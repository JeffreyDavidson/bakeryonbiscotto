<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Revenue goals (existing)
            'monthly_revenue_goal' => '5000',
            'yearly_revenue_goal' => '50000',

            // Store Information
            'business_name' => 'Bakery on Biscotto',
            'tagline' => 'Freshly baked with love',
            'store_phone' => '',
            'store_email' => '',
            'store_address' => '',
            'operating_hours' => "Mon-Fri: 7am - 6pm\nSat: 8am - 4pm\nSun: Closed",
            'social_instagram' => '',
            'social_facebook' => '',
            'social_tiktok' => '',
            'owner_name' => 'Cassie',
            'store_city' => 'Davenport',
            'store_state' => 'FL',
            'store_state_full' => 'Florida',
            'revenue_cap' => '250000',
            'revenue_cap_label' => 'FL Cottage Food Annual Cap',

            // Order Settings
            'minimum_order_amount' => '0',
            'max_advance_order_days' => '14',
            'default_prep_time_hours' => '24',
            'auto_confirm_orders' => '0',

            // Delivery Settings
            'delivery_enabled' => '1',
            'delivery_radius_miles' => '10',
            'delivery_fee_tiers' => '0-5:5.00,5-10:8.00,10+:12.00',
            'free_delivery_minimum' => '50',

            // Notification Settings
            'send_order_emails' => '1',
            'send_review_followup_emails' => '1',
            'admin_notification_email' => '',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
