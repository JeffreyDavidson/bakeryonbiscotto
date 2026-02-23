<?php

namespace Database\Seeders;

use App\Models\Income;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        Income::query()->delete();

        $incomes = [
            // Farmers market cash sales (monthly)
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — September sales', 'amount' => 342.00, 'date' => '2025-09-27'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — October sales', 'amount' => 418.50, 'date' => '2025-10-25'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — November sales', 'amount' => 385.00, 'date' => '2025-11-22'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — December (holiday rush!)', 'amount' => 567.00, 'date' => '2025-12-20', 'notes' => 'Best market day ever — sold out by 11am'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — January sales', 'amount' => 285.00, 'date' => '2026-01-25'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market — February sales', 'amount' => 312.50, 'date' => '2026-02-22'],

            // Tips
            ['source' => 'tips', 'description' => 'Tips from delivery orders — Q4 2025', 'amount' => 78.00, 'date' => '2025-12-31'],
            ['source' => 'tips', 'description' => 'Tips from delivery orders — Jan 2026', 'amount' => 32.00, 'date' => '2026-01-31'],
            ['source' => 'tips', 'description' => 'Tips from delivery orders — Feb 2026', 'amount' => 24.00, 'date' => '2026-02-20'],

            // Catering / custom orders (cash or direct payment)
            ['source' => 'custom_order', 'description' => 'Custom wedding cookie favors (200 pcs) — deposit', 'amount' => 160.00, 'date' => '2025-10-15', 'notes' => 'Referred by Sarah M. — final payment via online order'],
            ['source' => 'custom_order', 'description' => 'Office holiday party bread basket (12 loaves)', 'amount' => 145.00, 'date' => '2025-12-12'],
            ['source' => 'custom_order', 'description' => 'Baby shower cupcake tower — Venmo payment', 'amount' => 95.00, 'date' => '2026-01-18'],
            ['source' => 'custom_order', 'description' => 'Custom birthday cake consultation fee', 'amount' => 25.00, 'date' => '2026-02-05', 'notes' => 'Applied to final order total'],

            // Cash sales (non-market)
            ['source' => 'cash_sale', 'description' => 'Neighbor order — Thanksgiving rolls (5 dozen)', 'amount' => 65.00, 'date' => '2025-11-25'],
            ['source' => 'cash_sale', 'description' => 'Co-worker cookie platter', 'amount' => 35.00, 'date' => '2026-01-03'],
            ['source' => 'cash_sale', 'description' => 'Church bake sale contribution (sold out)', 'amount' => 88.00, 'date' => '2026-02-16'],

            // Direct payments
            ['source' => 'paypal_direct', 'description' => 'PayPal — office catering order (weekly bread delivery)', 'amount' => 175.00, 'date' => '2026-02-06'],
            ['source' => 'paypal_direct', 'description' => 'PayPal — repeat customer bulk cookies', 'amount' => 120.00, 'date' => '2026-02-19'],
        ];

        foreach ($incomes as $income) {
            Income::create(array_merge([
                'notes' => null,
            ], $income));
        }
    }
}
