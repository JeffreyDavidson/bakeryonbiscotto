<?php

namespace Database\Seeders;

use App\Models\CapacityLimit;
use Illuminate\Database\Seeder;

class CapacityLimitSeeder extends Seeder
{
    public function run(): void
    {
        CapacityLimit::query()->delete();

        // Day of week defaults (0=Sunday, 6=Saturday)
        $weekdays = [
            ['day_of_week' => 0, 'max_orders' => 0, 'is_blocked' => true, 'notes' => 'Closed Sundays'],
            ['day_of_week' => 1, 'max_orders' => 10, 'is_blocked' => false, 'notes' => null],
            ['day_of_week' => 2, 'max_orders' => 10, 'is_blocked' => false, 'notes' => null],
            ['day_of_week' => 3, 'max_orders' => 10, 'is_blocked' => false, 'notes' => null],
            ['day_of_week' => 4, 'max_orders' => 10, 'is_blocked' => false, 'notes' => null],
            ['day_of_week' => 5, 'max_orders' => 15, 'is_blocked' => false, 'notes' => 'Fridays are popular'],
            ['day_of_week' => 6, 'max_orders' => 15, 'is_blocked' => false, 'notes' => 'Farmers market day'],
        ];

        foreach ($weekdays as $day) {
            CapacityLimit::create($day);
        }

        // Block a specific upcoming date
        CapacityLimit::create([
            'specific_date' => '2026-03-09',
            'max_orders' => 0,
            'is_blocked' => true,
            'notes' => 'Family vacation — no orders this day',
        ]);
    }
}
