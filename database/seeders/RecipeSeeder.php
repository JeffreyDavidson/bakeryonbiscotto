<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStage;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        RecipeStage::query()->delete();
        RecipeIngredient::query()->delete();
        Recipe::query()->delete();

        $products = Product::all()->keyBy('name');

        $recipes = [
            'Regular Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 120,
                'description' => 'Classic sourdough with overnight cold proof',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 500, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Water', 'quantity' => 350, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 10, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter with equal parts flour and water. Keep at room temp.'],
                    ['name' => 'Mix & autolyse', 'hours_before' => 24, 'duration_minutes' => 15, 'instructions' => 'Mix flour, water, and starter. Rest 30 min before adding salt.'],
                    ['name' => 'Bulk ferment & folds', 'hours_before' => 20, 'duration_minutes' => 240, 'instructions' => 'Stretch and fold every 30 min for first 2 hours, then let rise.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Pre-shape, bench rest 20 min, final shape, into banneton, into fridge.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Preheat Dutch oven 500°F. Score dough. Bake covered 20 min, uncovered 25 min at 450°F.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool on wire rack at least 1 hour. Bag and label.'],
                ],
            ],
            'Cheddar Cheese Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 130,
                'description' => 'Sharp cheddar sourdough with melty cheese pockets',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 500, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Water', 'quantity' => 340, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 10, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Sharp cheddar cheese', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.012],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix & autolyse', 'hours_before' => 24, 'duration_minutes' => 15, 'instructions' => 'Mix flour, water, starter. Add salt after 30 min rest.'],
                    ['name' => 'Add cheese & bulk ferment', 'hours_before' => 20, 'duration_minutes' => 240, 'instructions' => 'Fold in cubed cheddar during first stretch and fold. Continue folds every 30 min.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Shape, banneton, fridge overnight.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake in Dutch oven. Cheese may bubble out — that\'s the good part!'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool completely before bagging.'],
                ],
            ],
            'Mozzarella Garlic Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 135,
                'description' => 'Fresh mozzarella and roasted garlic sourdough',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 500, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Water', 'quantity' => 330, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 10, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Fresh mozzarella', 'quantity' => 170, 'unit' => 'g', 'cost_per_unit' => 0.015],
                    ['name' => 'Roasted garlic cloves', 'quantity' => 30, 'unit' => 'g', 'cost_per_unit' => 0.02],
                ],
                'stages' => [
                    ['name' => 'Roast garlic & feed starter', 'hours_before' => 36, 'duration_minutes' => 45, 'instructions' => 'Roast whole garlic head at 400°F for 40 min. Feed starter.'],
                    ['name' => 'Mix & bulk ferment', 'hours_before' => 24, 'duration_minutes' => 300, 'instructions' => 'Mix dough. Fold in mozzarella and roasted garlic during stretch and folds.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Shape carefully to keep cheese pockets intact. Cold proof overnight.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake in Dutch oven at 500°F then 450°F.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool on wire rack. Best eaten same day.'],
                ],
            ],
            'Chocolate Chip Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 120,
                'description' => 'Sweet sourdough loaded with chocolate chips',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 450, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Whole wheat flour', 'quantity' => 50, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Water', 'quantity' => 325, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 8, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Sugar', 'quantity' => 30, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Chocolate chips', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.008],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix dough', 'hours_before' => 24, 'duration_minutes' => 15, 'instructions' => 'Mix flours, water, sugar, starter. Add salt after rest.'],
                    ['name' => 'Add chips & bulk ferment', 'hours_before' => 20, 'duration_minutes' => 240, 'instructions' => 'Fold in chocolate chips gently during first fold. Continue folds.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Shape, banneton, fridge overnight.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake at 475°F. Slightly lower temp than plain to prevent chocolate burning.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool completely. Chocolate needs to set.'],
                ],
            ],
            'Cinnamon and Sugar Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 130,
                'description' => 'Warm cinnamon swirled sourdough with sugar coating',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 500, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Water', 'quantity' => 325, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 8, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Cinnamon', 'quantity' => 15, 'unit' => 'g', 'cost_per_unit' => 0.04],
                    ['name' => 'Brown sugar', 'quantity' => 60, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Butter', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.012],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix & bulk ferment', 'hours_before' => 24, 'duration_minutes' => 300, 'instructions' => 'Mix dough. Bulk ferment with folds.'],
                    ['name' => 'Roll & fill', 'hours_before' => 14, 'duration_minutes' => 30, 'instructions' => 'Roll out, spread butter, sprinkle cinnamon sugar. Roll up and shape. Cold proof.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake at 450°F in Dutch oven.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool and package.'],
                ],
            ],
            'Chocolate Chocolate Chip Loaf' => [
                'servings' => 1, 'prep_time_minutes' => 120,
                'description' => 'Double chocolate sourdough — cocoa dough with chocolate chips',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 430, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Cocoa powder', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.025],
                    ['name' => 'Water', 'quantity' => 340, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 8, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Sugar', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Chocolate chips', 'quantity' => 170, 'unit' => 'g', 'cost_per_unit' => 0.008],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix dough', 'hours_before' => 24, 'duration_minutes' => 20, 'instructions' => 'Mix flour with cocoa powder first. Add water, starter, sugar. Salt after rest.'],
                    ['name' => 'Add chips & bulk ferment', 'hours_before' => 20, 'duration_minutes' => 240, 'instructions' => 'Fold in chips. Continue folds every 30 min.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Shape and cold proof overnight.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake at 460°F. Watch closely — dark dough makes it hard to judge doneness.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool completely before slicing.'],
                ],
            ],
            'Chocolate Almond Chocolate Chip' => [
                'servings' => 1, 'prep_time_minutes' => 125,
                'description' => 'Chocolate sourdough with toasted almonds and chips',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 430, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Cocoa powder', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.025],
                    ['name' => 'Water', 'quantity' => 335, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Salt', 'quantity' => 8, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Sugar', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Chocolate chips', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.008],
                    ['name' => 'Toasted almonds', 'quantity' => 80, 'unit' => 'g', 'cost_per_unit' => 0.018],
                ],
                'stages' => [
                    ['name' => 'Toast almonds & feed starter', 'hours_before' => 36, 'duration_minutes' => 20, 'instructions' => 'Toast almonds at 350°F for 10 min. Cool. Feed starter.'],
                    ['name' => 'Mix & bulk ferment', 'hours_before' => 24, 'duration_minutes' => 300, 'instructions' => 'Mix cocoa dough. Fold in chips and almonds during folds.'],
                    ['name' => 'Shape & cold proof', 'hours_before' => 14, 'duration_minutes' => 20, 'instructions' => 'Shape and cold proof.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 50, 'instructions' => 'Bake at 460°F in Dutch oven.'],
                    ['name' => 'Cool & package', 'hours_before' => 1, 'duration_minutes' => 15, 'instructions' => 'Cool completely.'],
                ],
            ],
            'Honey Wheat Sourdough Sandwich Bread' => [
                'servings' => 1, 'prep_time_minutes' => 100,
                'description' => 'Soft honey wheat sourdough for sandwiches',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 300, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Whole wheat flour', 'quantity' => 200, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Water', 'quantity' => 310, 'unit' => 'g', 'cost_per_unit' => 0.0001],
                    ['name' => 'Sourdough starter', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Honey', 'quantity' => 40, 'unit' => 'g', 'cost_per_unit' => 0.015],
                    ['name' => 'Butter', 'quantity' => 30, 'unit' => 'g', 'cost_per_unit' => 0.012],
                    ['name' => 'Salt', 'quantity' => 9, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix & bulk ferment', 'hours_before' => 24, 'duration_minutes' => 300, 'instructions' => 'Mix dough with honey and softened butter. Bulk ferment with folds.'],
                    ['name' => 'Shape into loaf pan', 'hours_before' => 14, 'duration_minutes' => 15, 'instructions' => 'Shape into log, place in buttered loaf pan. Cold proof.'],
                    ['name' => 'Bake', 'hours_before' => 3, 'duration_minutes' => 40, 'instructions' => 'Bake at 375°F for 35-40 min until golden and hollow sounding.'],
                    ['name' => 'Cool & slice', 'hours_before' => 1, 'duration_minutes' => 20, 'instructions' => 'Cool in pan 10 min, remove, cool on rack. Slice and bag.'],
                ],
            ],
            'Sourdough English Muffins 6ct' => [
                'servings' => 6, 'prep_time_minutes' => 90,
                'description' => 'Griddle-cooked sourdough English muffins',
                'ingredients' => [
                    ['name' => 'Bread flour', 'quantity' => 350, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Milk', 'quantity' => 200, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Sourdough starter', 'quantity' => 75, 'unit' => 'g', 'cost_per_unit' => 0.003],
                    ['name' => 'Butter', 'quantity' => 25, 'unit' => 'g', 'cost_per_unit' => 0.012],
                    ['name' => 'Sugar', 'quantity' => 15, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Salt', 'quantity' => 7, 'unit' => 'g', 'cost_per_unit' => 0.001],
                    ['name' => 'Cornmeal', 'quantity' => 20, 'unit' => 'g', 'cost_per_unit' => 0.004],
                ],
                'stages' => [
                    ['name' => 'Feed starter', 'hours_before' => 36, 'duration_minutes' => 10, 'instructions' => 'Feed starter.'],
                    ['name' => 'Mix & overnight rise', 'hours_before' => 14, 'duration_minutes' => 15, 'instructions' => 'Mix dough. Cover and refrigerate overnight.'],
                    ['name' => 'Cut & proof', 'hours_before' => 4, 'duration_minutes' => 90, 'instructions' => 'Cut into rounds with biscuit cutter. Dust with cornmeal. Proof 1 hour.'],
                    ['name' => 'Griddle cook', 'hours_before' => 2, 'duration_minutes' => 30, 'instructions' => 'Cook on medium-low griddle 7 min per side. Should be golden with pale band in middle.'],
                    ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 15, 'instructions' => 'Cool on rack. Fork-split one to check doneness. Package in bags of 6.'],
                ],
            ],
            'Banana Bread' => [
                'servings' => 1, 'prep_time_minutes' => 75,
                'description' => 'Classic moist banana bread',
                'ingredients' => [
                    ['name' => 'All-purpose flour', 'quantity' => 280, 'unit' => 'g', 'cost_per_unit' => 0.0018],
                    ['name' => 'Ripe bananas', 'quantity' => 4, 'unit' => 'each', 'cost_per_unit' => 0.25],
                    ['name' => 'Butter', 'quantity' => 115, 'unit' => 'g', 'cost_per_unit' => 0.012],
                    ['name' => 'Sugar', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Eggs', 'quantity' => 2, 'unit' => 'each', 'cost_per_unit' => 0.30],
                    ['name' => 'Vanilla extract', 'quantity' => 5, 'unit' => 'ml', 'cost_per_unit' => 0.10],
                    ['name' => 'Baking soda', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Salt', 'quantity' => 3, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Prep & mix', 'hours_before' => 3, 'duration_minutes' => 20, 'instructions' => 'Mash bananas. Cream butter and sugar. Add eggs, vanilla, bananas. Fold in dry ingredients.'],
                    ['name' => 'Bake', 'hours_before' => 2, 'duration_minutes' => 60, 'instructions' => 'Bake at 350°F for 55-60 min. Toothpick should come out clean.'],
                    ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 20, 'instructions' => 'Cool in pan 10 min, then on rack. Wrap when fully cooled.'],
                ],
            ],
            'Banana Walnut Bread' => [
                'servings' => 1, 'prep_time_minutes' => 80,
                'description' => 'Classic banana bread loaded with toasted walnuts',
                'ingredients' => [
                    ['name' => 'All-purpose flour', 'quantity' => 280, 'unit' => 'g', 'cost_per_unit' => 0.0018],
                    ['name' => 'Ripe bananas', 'quantity' => 4, 'unit' => 'each', 'cost_per_unit' => 0.25],
                    ['name' => 'Butter', 'quantity' => 115, 'unit' => 'g', 'cost_per_unit' => 0.012],
                    ['name' => 'Sugar', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Eggs', 'quantity' => 2, 'unit' => 'each', 'cost_per_unit' => 0.30],
                    ['name' => 'Vanilla extract', 'quantity' => 5, 'unit' => 'ml', 'cost_per_unit' => 0.10],
                    ['name' => 'Walnuts', 'quantity' => 100, 'unit' => 'g', 'cost_per_unit' => 0.02],
                    ['name' => 'Baking soda', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Salt', 'quantity' => 3, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Toast walnuts & prep', 'hours_before' => 3.5, 'duration_minutes' => 25, 'instructions' => 'Toast walnuts at 350°F for 8 min. Cool and chop. Mix batter as banana bread.'],
                    ['name' => 'Bake', 'hours_before' => 2, 'duration_minutes' => 65, 'instructions' => 'Fold in walnuts. Bake at 350°F for 60-65 min.'],
                    ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 20, 'instructions' => 'Cool and wrap.'],
                ],
            ],
            'Pumpkin Chocolate Chip Bread' => [
                'servings' => 1, 'prep_time_minutes' => 80,
                'description' => 'Pumpkin spice bread studded with chocolate chips',
                'ingredients' => [
                    ['name' => 'All-purpose flour', 'quantity' => 260, 'unit' => 'g', 'cost_per_unit' => 0.0018],
                    ['name' => 'Pumpkin puree', 'quantity' => 240, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Sugar', 'quantity' => 200, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Vegetable oil', 'quantity' => 120, 'unit' => 'ml', 'cost_per_unit' => 0.005],
                    ['name' => 'Eggs', 'quantity' => 2, 'unit' => 'each', 'cost_per_unit' => 0.30],
                    ['name' => 'Cinnamon', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.04],
                    ['name' => 'Nutmeg', 'quantity' => 2, 'unit' => 'g', 'cost_per_unit' => 0.08],
                    ['name' => 'Chocolate chips', 'quantity' => 170, 'unit' => 'g', 'cost_per_unit' => 0.008],
                    ['name' => 'Baking soda', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Salt', 'quantity' => 3, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Mix & prep', 'hours_before' => 3, 'duration_minutes' => 20, 'instructions' => 'Mix wet ingredients, fold in dry, then chocolate chips.'],
                    ['name' => 'Bake', 'hours_before' => 2, 'duration_minutes' => 60, 'instructions' => 'Bake at 350°F for 55-60 min.'],
                    ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 20, 'instructions' => 'Cool and wrap.'],
                ],
            ],
            'Pumpkin Almond Chocolate Chip Bread' => [
                'servings' => 1, 'prep_time_minutes' => 85,
                'description' => 'Pumpkin bread with toasted almonds and chocolate chips',
                'ingredients' => [
                    ['name' => 'All-purpose flour', 'quantity' => 260, 'unit' => 'g', 'cost_per_unit' => 0.0018],
                    ['name' => 'Pumpkin puree', 'quantity' => 240, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Sugar', 'quantity' => 200, 'unit' => 'g', 'cost_per_unit' => 0.002],
                    ['name' => 'Vegetable oil', 'quantity' => 120, 'unit' => 'ml', 'cost_per_unit' => 0.005],
                    ['name' => 'Eggs', 'quantity' => 2, 'unit' => 'each', 'cost_per_unit' => 0.30],
                    ['name' => 'Cinnamon', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.04],
                    ['name' => 'Nutmeg', 'quantity' => 2, 'unit' => 'g', 'cost_per_unit' => 0.08],
                    ['name' => 'Chocolate chips', 'quantity' => 150, 'unit' => 'g', 'cost_per_unit' => 0.008],
                    ['name' => 'Toasted almonds', 'quantity' => 80, 'unit' => 'g', 'cost_per_unit' => 0.018],
                    ['name' => 'Baking soda', 'quantity' => 5, 'unit' => 'g', 'cost_per_unit' => 0.005],
                    ['name' => 'Salt', 'quantity' => 3, 'unit' => 'g', 'cost_per_unit' => 0.001],
                ],
                'stages' => [
                    ['name' => 'Toast almonds & mix', 'hours_before' => 3.5, 'duration_minutes' => 25, 'instructions' => 'Toast almonds. Mix batter, fold in chips and almonds.'],
                    ['name' => 'Bake', 'hours_before' => 2, 'duration_minutes' => 65, 'instructions' => 'Bake at 350°F for 60-65 min.'],
                    ['name' => 'Cool & package', 'hours_before' => 0.5, 'duration_minutes' => 20, 'instructions' => 'Cool and wrap.'],
                ],
            ],
        ];

        foreach ($recipes as $productName => $data) {
            $product = $products->get($productName);
            if (!$product) continue;

            $recipe = Recipe::create([
                'product_id' => $product->id,
                'name' => $productName,
                'servings' => $data['servings'],
                'prep_time_minutes' => $data['prep_time_minutes'],
                'description' => $data['description'],
            ]);

            foreach ($data['ingredients'] as $ing) {
                RecipeIngredient::create(array_merge(['recipe_id' => $recipe->id], $ing));
            }

            foreach ($data['stages'] as $i => $stage) {
                RecipeStage::create(array_merge([
                    'recipe_id' => $recipe->id,
                    'sort_order' => $i + 1,
                ], $stage));
            }
        }
    }
}
