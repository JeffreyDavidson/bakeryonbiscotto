<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        OrderItem::query()->delete();
        Order::query()->delete();

        $products = Product::all();
        if ($products->isEmpty()) {
            $this->command->warn('No products found. Run ProductSeeder first.');
            return;
        }

        $coupons = Coupon::all()->keyBy('code');

        // 25 consistent Florida customers
        $customers = [
            ['name' => 'Sarah Mitchell', 'email' => 'sarah.mitchell@gmail.com', 'phone' => '(407) 555-0142'],
            ['name' => 'Mike Thompson', 'email' => 'mike.thompson@yahoo.com', 'phone' => '(863) 555-0198'],
            ['name' => 'Jessica Ramirez', 'email' => 'jess.ramirez@gmail.com', 'phone' => '(321) 555-0267'],
            ['name' => 'David Chen', 'email' => 'david.chen@outlook.com', 'phone' => '(407) 555-0334'],
            ['name' => 'Amanda Foster', 'email' => 'amanda.foster@gmail.com', 'phone' => '(863) 555-0411'],
            ['name' => 'Chris Patel', 'email' => 'chris.patel@gmail.com', 'phone' => '(407) 555-0523'],
            ['name' => 'Nicole Brown', 'email' => 'nicole.brown@icloud.com', 'phone' => '(321) 555-0687'],
            ['name' => 'Emily Watson', 'email' => 'emily.watson@gmail.com', 'phone' => '(863) 555-0745'],
            ['name' => 'Robert Kim', 'email' => 'robert.kim@yahoo.com', 'phone' => '(407) 555-0891'],
            ['name' => 'Lisa Anderson', 'email' => 'lisa.anderson@gmail.com', 'phone' => '(863) 555-0923'],
            ['name' => 'Tom Richards', 'email' => 'tom.richards@outlook.com', 'phone' => '(321) 555-1045'],
            ['name' => 'Maria Gonzalez', 'email' => 'maria.gonzalez@gmail.com', 'phone' => '(407) 555-1123'],
            ['name' => 'James Parker', 'email' => 'james.parker@yahoo.com', 'phone' => '(863) 555-1267'],
            ['name' => 'Priya Sharma', 'email' => 'priya.sharma@gmail.com', 'phone' => '(407) 555-1389'],
            ['name' => 'Karen White', 'email' => 'karen.white@gmail.com', 'phone' => '(321) 555-1456'],
            ['name' => 'Diane Murphy', 'email' => 'diane.murphy@icloud.com', 'phone' => '(863) 555-1534'],
            ['name' => 'Rachel Torres', 'email' => 'rachel.torres@gmail.com', 'phone' => '(407) 555-1678'],
            ['name' => 'Brian Hayes', 'email' => 'brian.hayes@outlook.com', 'phone' => '(863) 555-1790'],
            ['name' => 'Stephanie Coleman', 'email' => 'steph.coleman@gmail.com', 'phone' => '(321) 555-1823'],
            ['name' => 'Marcus Johnson', 'email' => 'marcus.johnson@yahoo.com', 'phone' => '(407) 555-1956'],
            ['name' => 'Laura Nguyen', 'email' => 'laura.nguyen@gmail.com', 'phone' => '(863) 555-2034'],
            ['name' => 'Kevin O\'Brien', 'email' => 'kevin.obrien@gmail.com', 'phone' => '(407) 555-2178'],
            ['name' => 'Angela Davis', 'email' => 'angela.davis@icloud.com', 'phone' => '(321) 555-2234'],
            ['name' => 'Carlos Martinez', 'email' => 'carlos.martinez@gmail.com', 'phone' => '(863) 555-2367'],
            ['name' => 'Patricia Reed', 'email' => 'patricia.reed@yahoo.com', 'phone' => '(407) 555-2489'],
        ];

        $deliveryAddresses = [
            '1247 Biscotto Dr, Davenport, FL 33837',
            '892 Orange Blossom Trail, Kissimmee, FL 34741',
            '3456 Cypress Gardens Blvd, Winter Haven, FL 33884',
            '567 Champions Gate Blvd, Davenport, FL 33896',
            '2134 US-27, Haines City, FL 33844',
            '445 Posner Blvd, Davenport, FL 33837',
            '789 Loughman Rd, Davenport, FL 33896',
            '1023 Sand Mine Rd, Davenport, FL 33897',
            '3321 Ronald Reagan Pkwy, Davenport, FL 33837',
            '678 Ridgewood Lakes Blvd, Davenport, FL 33896',
        ];

        $deliveryZips = ['33837', '33896', '33897', '34741', '33884', '33844'];

        $timeSlots = ['9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'];

        $notes = [
            null, null, null, null, null, null, null, // mostly no notes
            'Please leave on porch',
            'Ring doorbell when arriving',
            'Call when 5 min away',
            'Gift — please include a note saying "Happy Birthday!"',
            'No nuts please',
            'Extra crispy crust if possible',
            'Sliced please!',
        ];

        // Generate 100 orders spread over 6 months
        $now = Carbon::parse('2026-02-23');
        $sixMonthsAgo = $now->copy()->subMonths(6);

        // Status distribution: 65 delivered, 10 confirmed, 8 baking, 7 ready, 5 pending, 5 cancelled
        $statusPool = array_merge(
            array_fill(0, 65, 'delivered'),
            array_fill(0, 10, 'confirmed'),
            array_fill(0, 8, 'baking'),
            array_fill(0, 7, 'ready'),
            array_fill(0, 5, 'pending'),
            array_fill(0, 5, 'cancelled'),
        );
        shuffle($statusPool);

        for ($i = 0; $i < 100; $i++) {
            $status = $statusPool[$i];
            $customer = $customers[array_rand($customers)];
            $fulfillment = fake()->randomElement(['pickup', 'pickup', 'pickup', 'delivery', 'delivery']); // 60/40
            $deliveryFee = $fulfillment === 'delivery' ? fake()->randomElement([5.00, 8.00, 10.00]) : 0;

            // Older orders = delivered/cancelled, recent = mix
            if (in_array($status, ['delivered', 'cancelled'])) {
                $createdAt = Carbon::createFromTimestamp(rand($sixMonthsAgo->timestamp, $now->copy()->subDays(3)->timestamp));
            } elseif (in_array($status, ['pending', 'confirmed'])) {
                $createdAt = Carbon::createFromTimestamp(rand($now->copy()->subDays(7)->timestamp, $now->timestamp));
            } else {
                $createdAt = Carbon::createFromTimestamp(rand($now->copy()->subDays(3)->timestamp, $now->timestamp));
            }

            $requestedDate = $createdAt->copy()->addDays(rand(1, 7));
            if ($status === 'pending' || $status === 'confirmed') {
                $requestedDate = $now->copy()->addDays(rand(1, 14)); // future dates
            }

            // Pick items
            $itemCount = rand(1, 4);
            $selectedProducts = $products->random(min($itemCount, $products->count()));
            $subtotal = 0;
            $items = [];

            foreach ($selectedProducts as $product) {
                $qty = rand(1, 3);
                $lineTotal = $product->price * $qty;
                $subtotal += $lineTotal;
                $items[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $qty,
                    'line_total' => $lineTotal,
                ];
            }

            // Maybe apply coupon (20% chance)
            $couponId = null;
            $discountAmount = 0;
            if (rand(1, 5) === 1 && $coupons->isNotEmpty()) {
                $coupon = $coupons->random();
                $couponId = $coupon->id;
                if ($coupon->type === 'percentage') {
                    $discountAmount = round($subtotal * ($coupon->value / 100), 2);
                } else {
                    $discountAmount = min($coupon->value, $subtotal);
                }
            }

            $total = max(0, $subtotal - $discountAmount + $deliveryFee);

            $order = Order::create([
                'order_number' => 'BOB-' . strtoupper(Str::random(8)),
                'customer_name' => $customer['name'],
                'customer_email' => $customer['email'],
                'customer_phone' => $customer['phone'],
                'fulfillment_type' => $fulfillment,
                'delivery_address' => $fulfillment === 'delivery' ? $deliveryAddresses[array_rand($deliveryAddresses)] : null,
                'delivery_zip' => $fulfillment === 'delivery' ? $deliveryZips[array_rand($deliveryZips)] : null,
                'delivery_fee' => $deliveryFee,
                'requested_date' => $requestedDate->toDateString(),
                'requested_time' => $timeSlots[array_rand($timeSlots)],
                'notes' => $notes[array_rand($notes)],
                'subtotal' => $subtotal,
                'total' => $total,
                'discount_amount' => $discountAmount,
                'coupon_id' => $couponId,
                'status' => $status,
                'payment_status' => $status === 'cancelled' ? fake()->randomElement(['cancelled', 'refunded']) : 'paid',
                'paid_at' => $status !== 'cancelled' ? $createdAt : null,
                'delivered_at' => $status === 'delivered' ? $createdAt->copy()->addDays(rand(1, 3)) : null,
                'follow_up_sent' => $status === 'delivered' ? (bool) rand(0, 1) : false,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            foreach ($items as $item) {
                OrderItem::create(array_merge(['order_id' => $order->id], $item));
            }
        }
    }
}
