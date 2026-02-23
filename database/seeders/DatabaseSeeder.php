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
            ProductSeeder::class,
            ReviewSeeder::class,
            OrderSeeder::class,
            ContactMessageSeeder::class,
            RecipeSeeder::class,
            ExpenseSeeder::class,
            IncomeSeeder::class,
            NotificationSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
