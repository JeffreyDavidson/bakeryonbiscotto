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
            'store_timezone' => 'America/New_York',
            'revenue_cap' => '250000',
            'revenue_cap_label' => 'FL Cottage Food Annual Cap',

            // Branding
            'brand_color_900' => '#3d2314',
            'brand_color_800' => '#4a3225',
            'brand_color_700' => '#6b4c3b',
            'brand_color_600' => '#8b5e3c',
            'brand_color_500' => '#a08060',
            'brand_color_400' => '#c4a882',
            'brand_color_300' => '#d4a574',
            'brand_color_200' => '#e8d0b0',
            'brand_color_150' => '#f3ebe0',
            'brand_color_100' => '#f5e6d0',
            'brand_color_50' => '#fdf8f2',
            'store_logo' => '',
            'store_favicon' => '',

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
