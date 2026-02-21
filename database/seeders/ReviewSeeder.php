<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'name' => 'Kristen S.',
                'rating' => 5,
                'body' => "Bought some amazing goodies from Bakery on Biscotto! My dear friend Cassie sure knows how to bake amazing sourdough! I got the chocolate, chocolate chip loaf & the English muffins. They are going to be the perfect thank you gift for my parents who are watching our kids for us this week. Highly recommend her shop.",
                'favorite_bread' => null,
                'status' => 'approved',
            ],
            [
                'name' => 'Mike T.',
                'rating' => 5,
                'body' => "Cassie's chocolate chip sourdough changed my life. I'm not being dramatic. My family goes through a loaf in a single day and then immediately orders another.",
                'favorite_bread' => 'Chocolate Chip Sourdough',
                'status' => 'approved',
            ],
            [
                'name' => 'Kinsey M.',
                'rating' => 5,
                'body' => 'This bread!! Oh. My. Gosh! Amazing!! Def recommend the Parmesan rosemary sourdough! Amazing!',
                'favorite_bread' => 'Parmesan Rosemary Sourdough',
                'status' => 'approved',
            ],
            [
                'name' => 'Joe M.',
                'rating' => 5,
                'body' => "I fly to Florida every year just to have some of this lady's cooking! It doesn't get any better ☺️",
                'favorite_bread' => null,
                'status' => 'approved',
            ],
        ];

        foreach ($reviews as $review) {
            Review::updateOrCreate(
                ['name' => $review['name'], 'body' => $review['body']],
                $review
            );
        }
    }
}
