<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();
        Category::query()->delete();

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
            ['name' => 'Regular Sourdough Loaf', 'price' => 8.00, 'sort_order' => 1, 'is_featured' => true, 'image' => 'images/product-sourdough-boule.jpg', 'description' => 'Classic sourdough with a crispy crust and soft, tangy interior. The one that started it all.'],
            ['name' => 'Chocolate Sourdough', 'price' => 10.00, 'sort_order' => 2, 'image' => 'images/product-chocolate-sourdough.jpg', 'description' => 'Rich chocolate swirled into our signature sourdough.'],
            ['name' => 'Chocolate Chip Sourdough', 'price' => 10.00, 'sort_order' => 3, 'image' => 'images/product-chocolate-chip.jpg', 'description' => 'Loaded with chocolate chips for a sweet twist on sourdough.'],
            ['name' => 'Chocolate Almond Chip Sourdough', 'price' => 10.00, 'sort_order' => 4, 'image' => 'images/product-chocolate-almond-chip.jpg', 'description' => 'Chocolate chips and crunchy almonds in every bite.'],
            ['name' => 'Cheddar Cheese Sourdough', 'price' => 10.00, 'sort_order' => 5, 'image' => 'images/product-cheddar-cheese-loaf.jpg', 'description' => 'Sharp cheddar baked right into the dough.'],
            ['name' => 'Parmesan Rosemary Sourdough', 'price' => 10.00, 'sort_order' => 6, 'description' => 'Savory parmesan and fresh rosemary in a rustic loaf.'],
        ];

        foreach ($loaves as $loaf) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($loaf['name'])],
                array_merge(['category_id' => $sourdoughLoaves->id, 'is_available' => true, 'is_featured' => false, 'image' => null], $loaf)
            );
        }

        // Sourdough Breads
        $breads = [
            ['name' => 'Sourdough English Muffins (6-pack)', 'price' => 8.00, 'sort_order' => 1, 'is_featured' => true, 'image' => 'images/product-english-muffins.jpg', 'description' => 'Those perfect nooks and crannies. Griddle-cooked and ready for toasting.'],
            ['name' => 'Honey Wheat Sourdough Sandwich Bread', 'price' => 8.00, 'sort_order' => 2, 'image' => 'images/product-honey-wheat-sandwich.jpg', 'description' => 'Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.'],
        ];

        foreach ($breads as $bread) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($bread['name'])],
                array_merge(['category_id' => $sourdoughBreads->id, 'is_available' => true, 'is_featured' => false, 'image' => null], $bread)
            );
        }

        // Other Breads
        $others = [
            ['name' => 'Pumpkin Almond Chocolate Chip Bread', 'price' => 10.00, 'sort_order' => 1, 'is_featured' => true, 'image' => 'images/product-pumpkin-bread.jpg', 'description' => 'Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.'],
            ['name' => 'Banana Bread', 'price' => 8.00, 'sort_order' => 2, 'image' => 'images/product-banana-bread.jpg', 'description' => 'Classic homemade banana bread, moist and delicious.'],
            ['name' => 'Banana Walnut Bread', 'price' => 15.00, 'sort_order' => 3, 'description' => 'Our classic banana bread loaded with crunchy toasted walnuts.'],
        ];

        foreach ($others as $other) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($other['name'])],
                array_merge(['category_id' => $otherBreads->id, 'is_available' => true, 'is_featured' => false, 'image' => null], $other)
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
                'image' => 'images/product-4pack-sourdough-loaves.jpg',
                'description' => 'Pick any 4 sourdough loaves and save! Mix and match your favorites.',
            ]
        );
    }
}
