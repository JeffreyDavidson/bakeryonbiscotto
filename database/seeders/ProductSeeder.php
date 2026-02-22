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

        $sourdoughLoaves = Category::create(['name' => 'Sourdough Loaves', 'slug' => 'sourdough-loaves', 'sort_order' => 1]);
        $otherSourdough = Category::create(['name' => 'Other Sourdough Breads', 'slug' => 'other-sourdough-breads', 'sort_order' => 2]);
        $otherBreads = Category::create(['name' => 'Other Breads', 'slug' => 'other-breads', 'sort_order' => 3]);

        // === Sourdough Loaves ===
        $loaves = [
            ['name' => 'Regular Loaf', 'price' => 10.00, 'sort_order' => 1, 'is_featured' => true, 'image' => 'images/product-sourdough-boule.jpg', 'description' => 'Classic sourdough with a crispy crust and soft, tangy interior. The one that started it all.'],
            ['name' => 'Cheddar Cheese Loaf', 'price' => 12.00, 'sort_order' => 2, 'image' => 'images/product-cheddar-cheese-loaf.jpg', 'description' => 'Sharp cheddar baked right into the dough. Melty pockets in every slice.'],
            ['name' => 'Mozzarella Garlic Loaf', 'price' => 14.00, 'sort_order' => 3, 'description' => 'Fresh mozzarella and roasted garlic. Your kitchen will smell incredible.'],
            ['name' => 'Chocolate Chip Loaf', 'price' => 12.00, 'sort_order' => 4, 'image' => 'images/product-chocolate-chip.jpg', 'description' => 'Loaded with chocolate chips for a sweet twist on sourdough.'],
            ['name' => 'Cinnamon and Sugar Loaf', 'price' => 14.00, 'sort_order' => 5, 'description' => 'Warm cinnamon swirls with sweet sugar. Weekend mornings were made for this.'],
            ['name' => 'Chocolate Chocolate Chip Loaf', 'price' => 12.00, 'sort_order' => 6, 'image' => 'images/product-chocolate-sourdough.jpg', 'description' => 'Cocoa in the dough, chips throughout. For the true chocolate lovers.'],
            ['name' => 'Chocolate Almond Chocolate Chip', 'price' => 15.00, 'sort_order' => 7, 'image' => 'images/product-chocolate-almond-chip.jpg', 'description' => 'Toasted almonds join the chocolate celebration. Crunchy, rich, and indulgent.'],
            ['name' => '4-Pack of Mini Loaves', 'price' => 25.00, 'sort_order' => 8, 'is_featured' => true, 'is_bundle' => true, 'bundle_pick_count' => 4, 'bundle_category_id' => '__LOAVES__', 'image' => 'images/product-4pack-sourdough-loaves.jpg', 'description' => "Can't choose? Don't. Pick any 4 flavors in perfectly portioned mini loaves."],
        ];

        foreach ($loaves as $loaf) {
            if (isset($loaf['bundle_category_id']) && $loaf['bundle_category_id'] === '__LOAVES__') {
                $loaf['bundle_category_id'] = $sourdoughLoaves->id;
            }
            Product::create(array_merge([
                'category_id' => $sourdoughLoaves->id,
                'slug' => \Illuminate\Support\Str::slug($loaf['name']),
                'is_available' => true,
                'is_featured' => false,
                'image' => null,
            ], $loaf));
        }

        // === Other Sourdough Breads ===
        $sourdoughBreads = [
            ['name' => 'Honey Wheat Sourdough Sandwich Bread', 'price' => 10.00, 'sort_order' => 1, 'image' => 'images/product-honey-wheat-sandwich.jpg', 'description' => 'Soft, wholesome, and perfect for sandwiches. Honey sweetness with a sourdough twist.'],
            ['name' => 'Sourdough English Muffins 6ct', 'price' => 8.00, 'sort_order' => 2, 'is_featured' => true, 'image' => 'images/product-english-muffins.jpg', 'description' => 'Those perfect nooks and crannies. Griddle-cooked and ready for toasting.'],
            ['name' => 'Sourdough English Muffins 12ct', 'price' => 15.00, 'sort_order' => 3, 'image' => 'images/product-english-muffins.jpg', 'description' => 'A dozen of our famous sourdough English muffins. Stock up!'],
        ];

        foreach ($sourdoughBreads as $bread) {
            Product::create(array_merge([
                'category_id' => $otherSourdough->id,
                'slug' => \Illuminate\Support\Str::slug($bread['name']),
                'is_available' => true,
                'is_featured' => false,
                'image' => null,
            ], $bread));
        }

        // === Other Breads ===
        $others = [
            ['name' => 'Banana Bread', 'price' => 12.00, 'sort_order' => 1, 'image' => 'images/product-banana-bread.jpg', 'description' => 'Classic homemade banana bread, moist and delicious.'],
            ['name' => 'Banana Walnut Bread', 'price' => 15.00, 'sort_order' => 2, 'description' => 'Our classic banana bread loaded with crunchy toasted walnuts.'],
            ['name' => 'Pumpkin Chocolate Chip Bread', 'price' => 12.00, 'sort_order' => 3, 'description' => 'Warm pumpkin spice studded with chocolate chips. Seasonal magic.'],
            ['name' => 'Pumpkin Almond Chocolate Chip Bread', 'price' => 15.00, 'sort_order' => 4, 'is_featured' => true, 'image' => 'images/product-pumpkin-bread.jpg', 'description' => 'Pumpkin spice, toasted almonds, and chocolate chips. The ultimate fall loaf.'],
        ];

        foreach ($others as $other) {
            Product::create(array_merge([
                'category_id' => $otherBreads->id,
                'slug' => \Illuminate\Support\Str::slug($other['name']),
                'is_available' => true,
                'is_featured' => false,
                'image' => null,
            ], $other));
        }
    }
}
