<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    public function run(): void
    {
        $holidays = [
            [
                'name' => 'Easter',
                'date' => '2026-04-05',
                'order_deadline' => '2026-03-30',
                'prep_start' => '2026-03-31',
                'max_orders' => 40,
                'notes' => 'Easter cakes, hot cross buns, spring cookies',
            ],
            [
                'name' => "Mother's Day",
                'date' => '2026-05-10',
                'order_deadline' => '2026-05-05',
                'prep_start' => '2026-05-06',
                'max_orders' => 50,
                'notes' => 'Heart-shaped cakes, floral cupcakes, gift boxes',
            ],
            [
                'name' => "Father's Day",
                'date' => '2026-06-21',
                'order_deadline' => '2026-06-16',
                'prep_start' => '2026-06-17',
                'max_orders' => 30,
                'notes' => null,
            ],
            [
                'name' => 'Independence Day',
                'date' => '2026-07-04',
                'order_deadline' => '2026-06-29',
                'prep_start' => '2026-06-30',
                'max_orders' => 35,
                'notes' => 'Red, white & blue themed treats',
            ],
            [
                'name' => 'Halloween',
                'date' => '2026-10-31',
                'order_deadline' => '2026-10-25',
                'prep_start' => '2026-10-26',
                'max_orders' => 45,
                'notes' => 'Spooky cookies, pumpkin treats, themed cakes',
            ],
            [
                'name' => 'Thanksgiving',
                'date' => '2026-11-26',
                'order_deadline' => '2026-11-20',
                'prep_start' => '2026-11-21',
                'max_orders' => 60,
                'notes' => 'Pies, rolls, fall-themed desserts',
            ],
            [
                'name' => 'Christmas',
                'date' => '2026-12-25',
                'order_deadline' => '2026-12-18',
                'prep_start' => '2026-12-19',
                'max_orders' => 60,
                'notes' => 'Holiday cookies, yule logs, gingerbread',
            ],
            [
                'name' => "Valentine's Day",
                'date' => '2027-02-14',
                'order_deadline' => '2027-02-09',
                'prep_start' => '2027-02-10',
                'max_orders' => 50,
                'notes' => 'Heart-shaped everything, chocolate boxes, red velvet',
            ],
        ];

        foreach ($holidays as $holiday) {
            Holiday::updateOrCreate(
                ['name' => $holiday['name'], 'date' => $holiday['date']],
                array_merge($holiday, ['is_active' => true])
            );
        }
    }
}
