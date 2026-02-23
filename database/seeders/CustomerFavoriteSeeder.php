<?php

namespace Database\Seeders;

use App\Models\CustomerFavorite;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CustomerFavoriteSeeder extends Seeder
{
    public function run(): void
    {
        CustomerFavorite::query()->delete();

        $products = Product::all()->keyBy('name');

        $favorites = [
            'sarah.mitchell@gmail.com' => ['Regular Loaf', 'Sourdough English Muffins 6ct', 'Honey Wheat Sourdough Sandwich Bread'],
            'mike.thompson@yahoo.com' => ['Chocolate Chip Loaf', 'Chocolate Chocolate Chip Loaf'],
            'jessica.ramirez@gmail.com' => ['Banana Bread', 'Regular Loaf'],
            'david.chen@outlook.com' => ['4-Pack of Mini Loaves', 'Mozzarella Garlic Loaf'],
            'amanda.foster@gmail.com' => ['Cheddar Cheese Loaf', 'Regular Loaf'],
            'emily.watson@gmail.com' => ['Sourdough English Muffins 6ct', 'Sourdough English Muffins 12ct'],
            'maria.gonzalez@gmail.com' => ['Chocolate Chocolate Chip Loaf', 'Banana Bread'],
            'priya.sharma@gmail.com' => ['Mozzarella Garlic Loaf', 'Regular Loaf', 'Cheddar Cheese Loaf'],
            'karen.white@gmail.com' => ['Regular Loaf'],
            'marcus.johnson@yahoo.com' => ['Sourdough English Muffins 6ct', 'Chocolate Chip Loaf'],
            'laura.nguyen@gmail.com' => ['Pumpkin Chocolate Chip Bread', 'Pumpkin Almond Chocolate Chip Bread'],
            'brian.hayes@outlook.com' => ['Chocolate Almond Chocolate Chip', 'Cinnamon and Sugar Loaf'],
            'angela.davis@icloud.com' => ['Cheddar Cheese Loaf', 'Mozzarella Garlic Loaf'],
            'carlos.martinez@gmail.com' => ['Regular Loaf', 'Banana Walnut Bread'],
            'nicole.brown@icloud.com' => ['Pumpkin Almond Chocolate Chip Bread', '4-Pack of Mini Loaves'],
        ];

        foreach ($favorites as $email => $productNames) {
            foreach ($productNames as $name) {
                $product = $products->get($name);
                if ($product) {
                    CustomerFavorite::create([
                        'customer_email' => $email,
                        'product_id' => $product->id,
                    ]);
                }
            }
        }
    }
}
