<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition(): array
    {
        $subjects = [
            'Custom order inquiry',
            'Do you ship?',
            'Allergen question',
            'Bulk order for event',
            'Catering for birthday party',
            'Gluten-free options?',
            'Can I place a standing weekly order?',
            'Wholesale pricing?',
        ];

        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->optional(0.5)->phoneNumber(),
            'subject' => fake()->randomElement($subjects),
            'message' => fake()->paragraph(3),
            'status' => fake()->randomElement(['new', 'new', 'read', 'replied']),
            'replied_at' => fn (array $attrs) => $attrs['status'] === 'replied'
                ? fake()->dateTimeBetween('-1 month', 'now')
                : null,
        ];
    }
}
