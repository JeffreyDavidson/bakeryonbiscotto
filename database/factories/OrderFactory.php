<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $fulfillment = fake()->randomElement(['pickup', 'delivery']);
        $deliveryFee = $fulfillment === 'delivery'
            ? fake()->randomElement([0, 5.00, 10.00])
            : 0;
        $subtotal = fake()->randomFloat(2, 10, 150);
        $status = fake()->randomElement(['pending', 'confirmed', 'baking', 'ready', 'delivered', 'cancelled']);
        $createdAt = fake()->dateTimeBetween('-2 months', 'now');
        $requestedDate = fake()->dateTimeBetween($createdAt, '+2 weeks');

        $timeSlots = [
            '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
            '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM',
            '5:00 PM', '6:00 PM', '7:00 PM',
        ];

        return [
            'order_number' => 'BOB-' . strtoupper(Str::random(8)),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'fulfillment_type' => $fulfillment,
            'delivery_address' => $fulfillment === 'delivery' ? fake()->address() : null,
            'delivery_zip' => $fulfillment === 'delivery' ? fake()->postcode() : null,
            'delivery_fee' => $deliveryFee,
            'requested_date' => $requestedDate,
            'requested_time' => fake()->randomElement($timeSlots),
            'notes' => fake()->optional(0.3)->sentence(),
            'subtotal' => $subtotal,
            'total' => $subtotal + $deliveryFee,
            'status' => $status,
            'payment_status' => $status === 'cancelled' ? fake()->randomElement(['cancelled', 'refunded']) : 'paid',
            'paid_at' => $status !== 'cancelled' ? $createdAt : null,
            'delivered_at' => $status === 'delivered' ? fake()->dateTimeBetween($createdAt, 'now') : null,
            'follow_up_sent' => $status === 'delivered' ? fake()->boolean(40) : false,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function pending(): static
    {
        return $this->state(['status' => 'pending', 'payment_status' => 'paid', 'delivered_at' => null]);
    }

    public function delivered(): static
    {
        return $this->state(fn () => [
            'status' => 'delivered',
            'payment_status' => 'paid',
            'delivered_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(['status' => 'cancelled', 'payment_status' => 'refunded', 'delivered_at' => null]);
    }
}
