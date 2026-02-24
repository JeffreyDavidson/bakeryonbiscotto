<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::query()->delete();

        $expenses = [
            // === INGREDIENTS (COGS) — spread over 6 months ===
            ['category' => 'ingredients', 'description' => 'Flour (50lb), sugar (25lb), salt', 'vendor' => 'Costco', 'amount' => 78.50, 'date' => '2025-09-03', 'business_percentage' => 100],
            ['category' => 'ingredients', 'description' => 'Butter (10lb), eggs (5 doz), milk', 'vendor' => 'Publix', 'amount' => 62.18, 'date' => '2025-09-10', 'business_percentage' => 75],
            ['category' => 'ingredients', 'description' => 'Chocolate chips, cocoa powder, vanilla extract', 'vendor' => 'Costco', 'amount' => 45.99, 'date' => '2025-09-18'],
            ['category' => 'ingredients', 'description' => 'Cheddar cheese, mozzarella, garlic', 'vendor' => 'Publix', 'amount' => 38.42, 'date' => '2025-09-25', 'business_percentage' => 80],
            ['category' => 'ingredients', 'description' => 'Flour, sugar, yeast restock', 'vendor' => 'Costco', 'amount' => 92.30, 'date' => '2025-10-05'],
            ['category' => 'ingredients', 'description' => 'Pumpkin puree, cinnamon, nutmeg, allspice', 'vendor' => 'Publix', 'amount' => 34.67, 'date' => '2025-10-12'],
            ['category' => 'ingredients', 'description' => 'Bananas, walnuts, almonds', 'vendor' => 'Publix', 'amount' => 28.90, 'date' => '2025-10-20', 'business_percentage' => 85],
            ['category' => 'ingredients', 'description' => 'Butter, eggs, heavy cream', 'vendor' => 'Publix', 'amount' => 55.73, 'date' => '2025-11-02', 'business_percentage' => 70],
            ['category' => 'ingredients', 'description' => 'Holiday baking supplies — bulk flour, sugars, chocolate', 'vendor' => 'Costco', 'amount' => 134.50, 'date' => '2025-11-15'],
            ['category' => 'ingredients', 'description' => 'Specialty items: almond flour, coconut oil, honey', 'vendor' => 'Whole Foods', 'amount' => 47.85, 'date' => '2025-11-28'],
            ['category' => 'ingredients', 'description' => 'Christmas baking mega haul', 'vendor' => 'Costco', 'amount' => 156.20, 'date' => '2025-12-08'],
            ['category' => 'ingredients', 'description' => 'Cream cheese, powdered sugar, sprinkles', 'vendor' => 'Publix', 'amount' => 42.15, 'date' => '2025-12-18', 'business_percentage' => 80],
            ['category' => 'ingredients', 'description' => 'Flour, sugar, butter, eggs — January restock', 'vendor' => 'Costco', 'amount' => 89.50, 'date' => '2026-01-05'],
            ['category' => 'ingredients', 'description' => 'Chocolate chips, vanilla, cocoa', 'vendor' => 'Costco', 'amount' => 42.18, 'date' => '2026-01-12'],
            ['category' => 'ingredients', 'description' => 'Cream cheese, heavy cream, powdered sugar', 'vendor' => 'Publix', 'amount' => 38.92, 'date' => '2026-01-19', 'business_percentage' => 75],
            ['category' => 'ingredients', 'description' => 'Seasonal berries and fruit', 'vendor' => 'Publix', 'amount' => 31.60, 'date' => '2026-02-14'],
            ['category' => 'ingredients', 'description' => 'Bulk flour and sugar restock', 'vendor' => 'Costco', 'amount' => 95.00, 'date' => '2026-02-01'],
            ['category' => 'ingredients', 'description' => 'Butter, eggs, milk, yeast', 'vendor' => 'Publix', 'amount' => 53.27, 'date' => '2026-02-08', 'business_percentage' => 70],
            ['category' => 'ingredients', 'description' => 'Almond flour, coconut oil, honey', 'vendor' => 'Whole Foods', 'amount' => 47.85, 'date' => '2026-02-20'],

            // === PACKAGING ===
            ['category' => 'packaging', 'description' => 'Bakery boxes (50 pack)', 'vendor' => 'Amazon', 'amount' => 34.99, 'date' => '2025-09-08'],
            ['category' => 'packaging', 'description' => 'Bread bags with twist ties (100ct)', 'vendor' => 'Amazon', 'amount' => 18.50, 'date' => '2025-10-15'],
            ['category' => 'packaging', 'description' => 'Custom stickers and labels (500ct)', 'vendor' => 'Sticker Mule', 'amount' => 59.00, 'date' => '2025-11-03'],
            ['category' => 'packaging', 'description' => 'Holiday gift boxes, tissue paper, ribbon', 'vendor' => 'Michaels', 'amount' => 43.67, 'date' => '2025-12-01'],
            ['category' => 'packaging', 'description' => 'Parchment paper, cupcake liners', 'vendor' => 'Amazon', 'amount' => 22.47, 'date' => '2026-01-08'],
            ['category' => 'packaging', 'description' => 'Bakery boxes reorder (75 pack)', 'vendor' => 'Amazon', 'amount' => 48.99, 'date' => '2026-01-22'],
            ['category' => 'packaging', 'description' => 'Valentine\'s themed packaging', 'vendor' => 'Amazon', 'amount' => 27.50, 'date' => '2026-02-03'],
            ['category' => 'packaging', 'description' => 'Ribbon, twine, and thank-you cards', 'vendor' => 'Michaels', 'amount' => 15.88, 'date' => '2026-02-15'],

            // === DELIVERY / GAS ===
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — September', 'vendor' => 'Shell', 'amount' => 42.00, 'date' => '2025-09-30'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — October', 'vendor' => 'Shell', 'amount' => 38.50, 'date' => '2025-10-31'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — November', 'vendor' => 'BP', 'amount' => 45.00, 'date' => '2025-11-30'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — December (heavy month)', 'vendor' => 'Shell', 'amount' => 62.00, 'date' => '2025-12-31'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — January', 'vendor' => 'Shell', 'amount' => 45.00, 'date' => '2026-01-31'],
            ['category' => 'delivery_gas', 'description' => 'Gas for deliveries — February', 'vendor' => 'BP', 'amount' => 38.50, 'date' => '2026-02-20'],

            // === BOOTH FEES ===
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Sep', 'vendor' => 'Davenport Farmers Market', 'amount' => 140.00, 'date' => '2025-09-30', 'notes' => '4 Saturdays'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Oct', 'vendor' => 'Davenport Farmers Market', 'amount' => 140.00, 'date' => '2025-10-31'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Nov', 'vendor' => 'Davenport Farmers Market', 'amount' => 140.00, 'date' => '2025-11-30'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Dec', 'vendor' => 'Davenport Farmers Market', 'amount' => 175.00, 'date' => '2025-12-31', 'notes' => '5 Saturdays'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Jan', 'vendor' => 'Davenport Farmers Market', 'amount' => 140.00, 'date' => '2026-01-31'],
            ['category' => 'booth_fees', 'description' => 'Davenport Farmers Market booth — Feb', 'vendor' => 'Davenport Farmers Market', 'amount' => 140.00, 'date' => '2026-02-22'],

            // === EQUIPMENT ===
            ['category' => 'equipment', 'description' => 'KitchenAid Pro mixer (refurbished)', 'vendor' => 'Amazon', 'amount' => 289.99, 'date' => '2025-09-01', 'business_percentage' => 90],
            ['category' => 'equipment', 'description' => 'Baking sheets (set of 6)', 'vendor' => 'Amazon', 'amount' => 42.99, 'date' => '2025-09-15'],
            ['category' => 'equipment', 'description' => 'Banneton proofing baskets (4 pack)', 'vendor' => 'Amazon', 'amount' => 32.99, 'date' => '2025-10-02'],
            ['category' => 'equipment', 'description' => 'Digital kitchen scale', 'vendor' => 'Amazon', 'amount' => 24.99, 'date' => '2025-10-20'],
            ['category' => 'equipment', 'description' => 'New silicone baking mats (set of 4)', 'vendor' => 'Amazon', 'amount' => 18.99, 'date' => '2026-01-10'],
            ['category' => 'equipment', 'description' => 'Bread lame scoring tool', 'vendor' => 'Amazon', 'amount' => 12.99, 'date' => '2026-02-05'],

            // === MARKETING ===
            ['category' => 'marketing', 'description' => 'Business cards (500 qty)', 'vendor' => 'Vistaprint', 'amount' => 29.99, 'date' => '2025-09-05'],
            ['category' => 'marketing', 'description' => 'Instagram promoted posts — Oct', 'vendor' => 'Meta', 'amount' => 50.00, 'date' => '2025-10-31'],
            ['category' => 'marketing', 'description' => 'Flyers for farmers market (200 qty)', 'vendor' => 'Staples', 'amount' => 35.00, 'date' => '2025-11-10'],
            ['category' => 'marketing', 'description' => 'Holiday promo — Instagram & Facebook ads', 'vendor' => 'Meta', 'amount' => 75.00, 'date' => '2025-12-05'],
            ['category' => 'marketing', 'description' => 'Instagram promoted post — January', 'vendor' => 'Meta', 'amount' => 25.00, 'date' => '2026-01-20'],
            ['category' => 'marketing', 'description' => 'Business cards reorder (250 qty)', 'vendor' => 'Vistaprint', 'amount' => 19.99, 'date' => '2026-02-12'],

            // === SUPPLIES ===
            ['category' => 'supplies', 'description' => 'Cleaning supplies, dish soap, sponges', 'vendor' => 'Publix', 'amount' => 16.43, 'date' => '2025-10-18', 'business_percentage' => 60],
            ['category' => 'supplies', 'description' => 'Printer ink for labels', 'vendor' => 'Staples', 'amount' => 32.99, 'date' => '2025-12-17'],
            ['category' => 'supplies', 'description' => 'Cleaning supplies restock', 'vendor' => 'Publix', 'amount' => 18.75, 'date' => '2026-01-18', 'business_percentage' => 60],
            ['category' => 'supplies', 'description' => 'Printer paper and ink', 'vendor' => 'Staples', 'amount' => 28.99, 'date' => '2026-02-17'],
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
