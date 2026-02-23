<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all()->keyBy('name');

        // Sourdough Loaf
        if ($product = $products->get('Sourdough Loaf') ?? $products->first()) {
            $recipe = Recipe::create([
                'product_id' => $product->id,
                'name' => 'Sourdough Loaf',
                'servings' => 1,
                'prep_time_minutes' => 120,
                'description' => 'Classic sourdough with overnight cold proof',
            ]);

            $recipe->stages()->createMany([
                ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter with equal parts flour and water. Keep at room temp.', 'sort_order' => 1],
                ['name' => 'Mix & autolyse', 'hours_before' => 24, 'duration_minutes' => 15, 'instructions' => 'Mix flour, water, and starter. Rest 30 min before adding salt.', 'sort_order' => 2],
                ['name' => 'Bulk ferment & folds', 'hours_before' => 20, 'duration_minutes' => 240, 'instructions' => 'Stretch and fold every 30 min for first 2 hours, then let rise.', 'sort_order' => 3],
                ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Pre-shape, bench rest 20 min, final shape, into banneton, into fridge.', 'sort_order' => 4],
                ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Preheat Dutch oven 500°F. Score dough. Bake covered 20 min, uncovered 25 min at 450°F.', 'sort_order' => 5],
                ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool on wire rack at least 1 hour. Slice if requested, bag and label.', 'sort_order' => 6],
            ]);
        }

        // Cinnamon Rolls
        if ($product = $products->get('Cinnamon Rolls') ?? $products->skip(1)->first()) {
            $recipe = Recipe::create([
                'product_id' => $product->id,
                'name' => 'Cinnamon Rolls',
                'servings' => 12,
                'prep_time_minutes' => 60,
                'description' => 'Soft yeasted rolls with cream cheese frosting',
            ]);

            $recipe->stages()->createMany([
                ['name' => 'Make dough & overnight rise', 'hours_before' => 14, 'duration_minutes' => 30, 'instructions' => 'Mix dough, knead until smooth. Cover and refrigerate overnight.', 'sort_order' => 1],
                ['name' => 'Roll, fill & cut', 'hours_before' => 4, 'duration_minutes' => 25, 'instructions' => 'Roll dough into rectangle, spread butter-cinnamon-sugar filling, roll tight, cut into 12.', 'sort_order' => 2],
                ['name' => 'Proof', 'hours_before' => 3, 'duration_minutes' => 60, 'instructions' => 'Place in greased pan. Cover and proof until doubled, about 45-60 min.', 'sort_order' => 3],
                ['name' => 'Bake', 'hours_before' => 1.5, 'duration_minutes' => 25, 'instructions' => 'Bake 350°F for 22-25 min until golden. Should sound hollow when tapped.', 'sort_order' => 4],
                ['name' => 'Frost & package', 'hours_before' => 0.5, 'duration_minutes' => 15, 'instructions' => 'Spread cream cheese frosting while warm. Box when slightly cooled.', 'sort_order' => 5],
            ]);
        }

        // Chocolate Chip Cookies
        if ($product = $products->get('Chocolate Chip Cookies') ?? $products->skip(2)->first()) {
            $recipe = Recipe::create([
                'product_id' => $product->id,
                'name' => 'Chocolate Chip Cookies',
                'servings' => 24,
                'prep_time_minutes' => 30,
                'description' => 'Brown butter chocolate chip with sea salt',
            ]);

            $recipe->stages()->createMany([
                ['name' => 'Brown butter & mix dough', 'hours_before' => 14, 'duration_minutes' => 25, 'instructions' => 'Brown butter, cool slightly. Cream with sugars, add eggs, fold in dry + chips. Refrigerate overnight.', 'sort_order' => 1],
                ['name' => 'Scoop & bake', 'hours_before' => 2, 'duration_minutes' => 45, 'instructions' => 'Scoop dough balls, sprinkle sea salt. Bake 375°F for 10-12 min. Do NOT overbake.', 'sort_order' => 2],
                ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 15, 'instructions' => 'Cool on rack 10 min. Package in bags or boxes with label.', 'sort_order' => 3],
            ]);
        }
    }
}
