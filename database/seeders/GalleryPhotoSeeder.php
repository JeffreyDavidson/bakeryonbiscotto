<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['title' => 'The signature boule', 'image_path' => '', 'category' => 'products', 'sort_order' => 1],
            ['title' => 'Dark chocolate sourdough', 'image_path' => '', 'category' => 'products', 'sort_order' => 2],
            ['title' => 'Chocolate chip', 'image_path' => '', 'category' => 'products', 'sort_order' => 3],
            ['title' => 'Chocolate almond chip', 'image_path' => '', 'category' => 'products', 'sort_order' => 4],
            ['title' => 'Honey wheat sandwich', 'image_path' => '', 'category' => 'products', 'sort_order' => 5],
            ['title' => 'Morning prep', 'image_path' => '', 'category' => 'kitchen', 'sort_order' => 6],
            ['title' => 'Fresh out of the oven', 'image_path' => '', 'category' => 'kitchen', 'sort_order' => 7],
            ['title' => 'Farmers market day', 'image_path' => '', 'category' => 'events', 'sort_order' => 8],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::create($photo);
        }
    }
}
