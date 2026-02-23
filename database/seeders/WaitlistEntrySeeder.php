<?php

namespace Database\Seeders;

use App\Models\WaitlistEntry;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WaitlistEntrySeeder extends Seeder
{
    public function run(): void
    {
        WaitlistEntry::query()->delete();

        $entries = [
            [
                'customer_name' => 'Patricia Reed',
                'customer_email' => 'patricia.reed@yahoo.com',
                'customer_phone' => '(407) 555-2489',
                'requested_date' => '2026-03-07',
                'product_interest' => 'Regular Loaf, Cheddar Cheese Loaf',
                'notes' => 'Saturday is full — wants pickup if spot opens',
                'status' => 'waiting',
                'notified_at' => null,
                'created_at' => '2026-02-20 14:30:00',
            ],
            [
                'customer_name' => 'Stephanie Coleman',
                'customer_email' => 'steph.coleman@gmail.com',
                'customer_phone' => '(321) 555-1823',
                'requested_date' => '2026-03-07',
                'product_interest' => '4-Pack of Mini Loaves',
                'notes' => null,
                'status' => 'waiting',
                'notified_at' => null,
                'created_at' => '2026-02-21 09:15:00',
            ],
            [
                'customer_name' => 'Brian Hayes',
                'customer_email' => 'brian.hayes@outlook.com',
                'customer_phone' => '(863) 555-1790',
                'requested_date' => '2026-03-06',
                'product_interest' => 'Chocolate Almond Chocolate Chip',
                'notes' => 'Wants delivery if possible',
                'status' => 'waiting',
                'notified_at' => null,
                'created_at' => '2026-02-22 16:45:00',
            ],
            [
                'customer_name' => 'Laura Nguyen',
                'customer_email' => 'laura.nguyen@gmail.com',
                'customer_phone' => '(863) 555-2034',
                'requested_date' => '2026-02-28',
                'product_interest' => 'Banana Walnut Bread',
                'notes' => null,
                'status' => 'notified',
                'notified_at' => '2026-02-23 10:00:00',
                'created_at' => '2026-02-19 11:20:00',
            ],
            [
                'customer_name' => 'Kevin O\'Brien',
                'customer_email' => 'kevin.obrien@gmail.com',
                'customer_phone' => '(407) 555-2178',
                'requested_date' => '2026-02-28',
                'product_interest' => 'Sourdough English Muffins 12ct',
                'notes' => 'Called to check availability',
                'status' => 'notified',
                'notified_at' => '2026-02-23 10:05:00',
                'created_at' => '2026-02-18 13:00:00',
            ],
            [
                'customer_name' => 'Carlos Martinez',
                'customer_email' => 'carlos.martinez@gmail.com',
                'customer_phone' => '(863) 555-2367',
                'requested_date' => '2026-02-22',
                'product_interest' => 'Regular Loaf',
                'notes' => 'Converted to order #BOB-WAITCONV1',
                'status' => 'converted',
                'notified_at' => '2026-02-20 09:00:00',
                'created_at' => '2026-02-17 15:30:00',
            ],
            [
                'customer_name' => 'Angela Davis',
                'customer_email' => 'angela.davis@icloud.com',
                'customer_phone' => '(321) 555-2234',
                'requested_date' => '2026-03-14',
                'product_interest' => 'Mozzarella Garlic Loaf, Cheddar Cheese Loaf',
                'notes' => 'Party on the 14th — needs at least 2 of each',
                'status' => 'waiting',
                'notified_at' => null,
                'created_at' => '2026-02-23 08:30:00',
            ],
        ];

        foreach ($entries as $entry) {
            WaitlistEntry::create($entry);
        }
    }
}
