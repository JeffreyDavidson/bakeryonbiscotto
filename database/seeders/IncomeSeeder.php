<?php

namespace Database\Seeders;

use App\Models\Income;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        $incomes = [
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market - bread and pastries', 'amount' => 185.00, 'date' => '2026-01-11'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market - cookies and brownies', 'amount' => 142.50, 'date' => '2026-01-25'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market - Valentine specials', 'amount' => 267.00, 'date' => '2026-02-08'],
            ['source' => 'farmers_market', 'description' => 'Davenport Farmers Market - assorted baked goods', 'amount' => 198.00, 'date' => '2026-02-22'],

            ['source' => 'cash_sale', 'description' => 'Neighbor order - birthday cake', 'amount' => 45.00, 'date' => '2026-01-14'],
            ['source' => 'cash_sale', 'description' => 'Co-worker cookie platter', 'amount' => 35.00, 'date' => '2026-02-03'],
            ['source' => 'cash_sale', 'description' => 'Church bake sale contribution (sold out)', 'amount' => 88.00, 'date' => '2026-02-16'],

            ['source' => 'custom_order', 'description' => 'Custom wedding cookie favors (200 pcs)', 'amount' => 320.00, 'date' => '2026-01-30', 'notes' => 'Referred by Sarah M. — royal icing sugar cookies'],
            ['source' => 'custom_order', 'description' => 'Baby shower cupcake tower', 'amount' => 95.00, 'date' => '2026-02-18'],

            ['source' => 'paypal_direct', 'description' => 'PayPal invoice - office catering order', 'amount' => 175.00, 'date' => '2026-02-06'],
            ['source' => 'paypal_direct', 'description' => 'PayPal invoice - repeat customer bulk cookies', 'amount' => 120.00, 'date' => '2026-02-19'],
        ];

        foreach ($incomes as $income) {
            Income::create(array_merge([
                'notes' => null,
            ], $income));
        }
    }
}
