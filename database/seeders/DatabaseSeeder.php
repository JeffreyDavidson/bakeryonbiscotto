<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            RecipeSeeder::class,
            ExpenseSeeder::class,
            IncomeSeeder::class,
            ContactMessageSeeder::class,
            NotificationSeeder::class,
            HolidaySeeder::class,
            CustomerNoteSeeder::class,
            CustomerFavoriteSeeder::class,
            CapacityLimitSeeder::class,
            WaitlistEntrySeeder::class,
        ]);
    }
}
