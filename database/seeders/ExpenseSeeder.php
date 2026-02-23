<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $expenses = [
            // Ingredients
            ['category' => 'ingredients', 'description' => 'Flour, sugar, butter, eggs', 'vendor' => 'Publix', 'amount' => 67.43, 'date' => '2026-01-05', 'business_percentage' => 80],
            ['category' => 'ingredients', 'description' => 'Chocolate chips, vanilla extract, cocoa powder', 'vendor' => 'Costco', 'amount' => 42.18, 'date' => '2026-01-12'],
            ['category' => 'ingredients', 'description' => 'Cream cheese, heavy cream, powdered sugar', 'vendor' => 'Publix', 'amount' => 38.92, 'date' => '2026-01-19', 'business_percentage' => 75],
            ['category' => 'ingredients', 'description' => 'Specialty sprinkles and food coloring', 'vendor' => 'Amazon', 'amount' => 24.99, 'date' => '2026-01-25'],
            ['category' => 'ingredients', 'description' => 'Bulk flour and sugar restock', 'vendor' => 'Costco', 'amount' => 89.50, 'date' => '2026-02-01'],
            ['category' => 'ingredients', 'description' => 'Butter, eggs, milk, yeast', 'vendor' => 'Publix', 'amount' => 53.27, 'date' => '2026-02-08', 'business_percentage' => 70],
            ['category' => 'ingredients', 'description' => 'Seasonal berries and fruit', 'vendor' => 'Publix', 'amount' => 31.60, 'date' => '2026-02-14'],
            ['category' => 'ingredients', 'description' => 'Almond flour, coconut oil, honey', 'vendor' => 'Whole Foods', 'amount' => 47.85, 'date' => '2026-02-20'],

            // Packaging
            ['category' => 'packaging', 'description' => 'Bakery boxes (50 pack)', 'vendor' => 'Amazon', 'amount' => 34.99, 'date' => '2026-01-08'],
            ['category' => 'packaging', 'description' => 'Parchment paper, cupcake liners, tissue paper', 'vendor' => 'Amazon', 'amount' => 22.47, 'date' => '2026-01-22'],
            ['category' => 'packaging', 'description' => 'Custom stickers and labels', 'vendor' => 'Sticker Mule', 'amount' => 59.00, 'date' => '2026-02-03'],
            ['category' => 'packaging', 'description' => 'Ribbon and twine', 'vendor' => 'Michaels', 'amount' => 15.88, 'date' => '2026-02-15'],

            // Delivery & Gas
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries', 'vendor' => 'Shell', 'amount' => 45.00, 'date' => '2026-01-15'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries', 'vendor' => 'Shell', 'amount' => 38.50, 'date' => '2026-02-10'],

            // Equipment
            ['category' => 'equipment', 'description' => 'New silicone baking mats (set of 4)', 'vendor' => 'Amazon', 'amount' => 18.99, 'date' => '2026-01-10'],
            ['category' => 'equipment', 'description' => 'Piping tips and bags set', 'vendor' => 'Amazon', 'amount' => 29.99, 'date' => '2026-02-05'],

            // Marketing
            ['category' => 'marketing', 'description' => 'Instagram promoted post', 'vendor' => 'Meta', 'amount' => 25.00, 'date' => '2026-01-20'],
            ['category' => 'marketing', 'description' => 'Business cards (250 qty)', 'vendor' => 'Vistaprint', 'amount' => 19.99, 'date' => '2026-02-12'],

            // Booth Fees
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth rental', 'vendor' => 'Davenport Farmers Market', 'amount' => 35.00, 'date' => '2026-01-11', 'is_recurring' => true, 'recurring_frequency' => 'weekly'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth rental', 'vendor' => 'Davenport Farmers Market', 'amount' => 35.00, 'date' => '2026-01-25'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth rental', 'vendor' => 'Davenport Farmers Market', 'amount' => 35.00, 'date' => '2026-02-08'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth rental', 'vendor' => 'Davenport Farmers Market', 'amount' => 35.00, 'date' => '2026-02-22'],

            // Supplies
            ['category' => 'supplies', 'description' => 'Cleaning supplies, dish soap, sponges', 'vendor' => 'Publix', 'amount' => 16.43, 'date' => '2026-01-18'],
            ['category' => 'supplies', 'description' => 'Printer ink for labels', 'vendor' => 'Staples', 'amount' => 32.99, 'date' => '2026-02-17'],
        ];

        foreach ($expenses as $expense) {
            Expense::create(array_merge([
                'is_recurring' => false,
                'recurring_frequency' => null,
                'notes' => null,
                'business_percentage' => 100,
            ], $expense));
        }
    }
}
