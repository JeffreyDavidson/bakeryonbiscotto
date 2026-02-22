<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $breads = [
            'Regular Sourdough', 'Cheddar Cheese Loaf', 'Chocolate Chip Sourdough',
            'English Muffins', 'Banana Bread', 'Honey Wheat Sandwich Bread',
            'Cinnamon and Sugar Loaf', 'Chocolate Chocolate Chip',
        ];

        return [
            'name' => fake()->firstName() . ' ' . fake()->randomLetter() . '.',
            'email' => fake()->safeEmail(),
            'rating' => fake()->randomElement([4, 4, 5, 5, 5, 5]),
            'body' => fake()->randomElement([
                "Absolutely incredible bread! The crust is perfect and the inside is so soft.",
                "Best sourdough I've ever had. My whole family is hooked.",
                "Ordered for a party and everyone kept asking where I got this bread!",
                "The chocolate chip loaf is dangerous — I could eat the whole thing in one sitting.",
                "So glad we found Bakery on Biscotto. We order every week now.",
                "Fresh, delicious, and made with love. You can taste the difference.",
                "The English muffins are restaurant quality. Better, actually.",
                "Bought some for my neighbors and now they're ordering their own!",
                "Perfect gift for the holidays. Everyone loved it.",
                "We drove 30 minutes to pick up our order and it was absolutely worth it.",
            ]),
            'favorite_bread' => fake()->optional(0.6)->randomElement($breads),
            'status' => fake()->randomElement(['approved', 'approved', 'approved', 'pending']),
            'is_featured' => false,
        ];
    }

    public function approved(): static
    {
        return $this->state(['status' => 'approved']);
    }

    public function pending(): static
    {
        return $this->state(['status' => 'pending']);
    }
}
