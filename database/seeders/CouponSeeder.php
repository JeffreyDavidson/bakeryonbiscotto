<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::query()->delete();

        $coupons = [
            [
                'code' => 'WELCOME10',
                'description' => '10% off your first order',
                'type' => 'percentage',
                'value' => 10.00,
                'minimum_order' => null,
                'max_uses' => null,
                'times_used' => 14,
                'starts_at' => '2025-09-01 00:00:00',
                'expires_at' => null,
                'is_active' => true,
            ],
            [
                'code' => 'HOLIDAY20',
                'description' => '20% off holiday special',
                'type' => 'percentage',
                'value' => 20.00,
                'minimum_order' => 30.00,
                'max_uses' => 100,
                'times_used' => 47,
                'starts_at' => '2025-12-15 00:00:00',
                'expires_at' => '2026-01-02 23:59:59',
                'is_active' => false,
            ],
            [
                'code' => 'FREEDELIVERY',
                'description' => '$10 off delivery (free delivery on orders $50+)',
                'type' => 'fixed_amount',
                'value' => 10.00,
                'minimum_order' => 50.00,
                'max_uses' => null,
                'times_used' => 8,
                'starts_at' => '2026-01-01 00:00:00',
                'expires_at' => null,
                'is_active' => true,
            ],
            [
                'code' => 'LOYALTY15',
                'description' => '15% off for loyal customers',
                'type' => 'percentage',
                'value' => 15.00,
                'minimum_order' => null,
                'max_uses' => 50,
                'times_used' => 23,
                'starts_at' => '2025-10-01 00:00:00',
                'expires_at' => null,
                'is_active' => true,
            ],
            [
                'code' => 'SPRING25',
                'description' => '25% off spring collection',
                'type' => 'percentage',
                'value' => 25.00,
                'minimum_order' => 25.00,
                'max_uses' => 75,
                'times_used' => 0,
                'starts_at' => '2026-03-20 00:00:00',
                'expires_at' => '2026-04-30 23:59:59',
                'is_active' => true,
            ],
            [
                'code' => 'FRIENDS5',
                'description' => '$5 off — share with friends!',
                'type' => 'fixed_amount',
                'value' => 5.00,
                'minimum_order' => null,
                'max_uses' => null,
                'times_used' => 31,
                'starts_at' => '2025-09-01 00:00:00',
                'expires_at' => null,
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
