<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $sourdoughLoaves = Category::updateOrCreate(
            ['slug' => 'sourdough-loaves'],
            ['name' => 'Sourdough Loaves', 'sort_order' => 1]
        );

        $sourdoughBreads = Category::updateOrCreate(
            ['slug' => 'sourdough-breads'],
            ['name' => 'Sourdough Breads', 'sort_order' => 2]
        );

        $otherBreads = Category::updateOrCreate(
            ['slug' => 'other-breads'],
            ['name' => 'Other Breads', 'sort_order' => 3]
        );

        $bundles = Category::updateOrCreate(
            ['slug' => 'bundles'],
            ['name' => 'Bundles & Deals', 'sort_order' => 4]
        );

        // Sourdough Loaves
        $loaves = [
            ['name' => 'Regular Sourdough Loaf', 'price' => 8.00, 'sort_order' => 1, 'description' => 'Classic sourdough with a crispy crust and soft, tangy interior.'],
            ['name' => 'Chocolate Sourdough', 'price' => 10.00, 'sort_order' => 2, 'description' => 'Rich chocolate swirled into our signature sourdough.'],
            ['name' => 'Chocolate Chip Sourdough', 'price' => 10.00, 'sort_order' => 3, 'description' => 'Loaded with chocolate chips for a sweet twist on sourdough.'],
            ['name' => 'Chocolate Almond Chip Sourdough', 'price' => 10.00, 'sort_order' => 4, 'description' => 'Chocolate chips and crunchy almonds in every bite.'],
            ['name' => 'Cheddar Cheese Sourdough', 'price' => 10.00, 'sort_order' => 5, 'description' => 'Sharp cheddar baked right into the dough.'],
            ['name' => 'Parmesan Rosemary Sourdough', 'price' => 10.00, 'sort_order' => 6, 'description' => 'Savory parmesan and fresh rosemary in a rustic loaf.'],
            ['name' => 'Jalapeño Cheddar Sourdough', 'price' => 10.00, 'sort_order' => 7, 'description' => 'Spicy jalapeños and melty cheddar for a kick.'],
        ];

        foreach ($loaves as $loaf) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($loaf['name'])],
                array_merge($loaf, ['category_id' => $sourdoughLoaves->id, 'is_available' => true])
            );
        }

        // Sourdough Breads
        $breads = [
            ['name' => 'Sourdough English Muffins (6-pack)', 'price' => 8.00, 'sort_order' => 1, 'description' => 'Six perfectly nook-and-cranny English muffins.'],
            ['name' => 'Sourdough Sandwich Bread', 'price' => 8.00, 'sort_order' => 2, 'description' => 'Soft sliced sourdough perfect for sandwiches and toast.'],
        ];

        foreach ($breads as $bread) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($bread['name'])],
                array_merge($bread, ['category_id' => $sourdoughBreads->id, 'is_available' => true])
            );
        }

        // Other Breads
        $others = [
            ['name' => 'Pumpkin Almond Chocolate Chip Bread', 'price' => 10.00, 'sort_order' => 1, 'description' => 'Seasonal pumpkin bread with almonds and chocolate chips.'],
            ['name' => 'Banana Bread', 'price' => 8.00, 'sort_order' => 2, 'description' => 'Classic homemade banana bread, moist and delicious.'],
            ['name' => 'Honey Wheat Sandwich Bread', 'price' => 8.00, 'sort_order' => 3, 'description' => 'Lightly sweet honey wheat, great for everyday sandwiches.'],
        ];

        foreach ($others as $other) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($other['name'])],
                array_merge($other, ['category_id' => $otherBreads->id, 'is_available' => true])
            );
        }

        // Bundle
        Product::updateOrCreate(
            ['slug' => '4-pack-sourdough-loaves'],
            [
                'category_id' => $bundles->id,
                'name' => '4-Pack Sourdough Loaves',
                'price' => 25.00,
                'sort_order' => 1,
                'is_available' => true,
                'is_featured' => true,
                'description' => 'Pick any 4 sourdough loaves and save! Mix and match your favorites.',
            ]
        );
    }
}
