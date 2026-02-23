<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::query()->delete();

        $now = Carbon::parse('2026-02-23');

        $messages = [
            // Unread
            ['name' => 'Lisa Anderson', 'email' => 'lisa.anderson@gmail.com', 'phone' => '(863) 555-0923', 'subject' => 'Catering for corporate event', 'message' => "Hi Cassie! I'm planning a corporate luncheon for about 50 people on March 15th. We'd love to have an assortment of your sourdough loaves and some English muffins. Can you handle an order that size? What would pricing look like? Thanks!", 'status' => 'new', 'created_at' => $now->copy()->subHours(3)],
            ['name' => 'Tom Richards', 'email' => 'tom.richards@outlook.com', 'phone' => '(321) 555-1045', 'subject' => 'Allergen question — tree nuts', 'message' => "Hi there, my son has a severe tree nut allergy. I see you have several products with almonds. Can you tell me if the non-almond products are made on the same equipment? We need to be really careful about cross-contamination. Thanks for understanding!", 'status' => 'new', 'created_at' => $now->copy()->subHours(8)],
            ['name' => 'Rebecca Adams', 'email' => 'rebecca.adams@gmail.com', 'phone' => null, 'subject' => 'Custom birthday cake?', 'message' => "Do you make custom birthday cakes? My daughter turns 7 next month and she's obsessed with unicorns. Would love a unicorn-themed cake if you do custom orders! Budget is around $60-80.", 'status' => 'new', 'created_at' => $now->copy()->subHours(18)],
            ['name' => 'Daniel Foster', 'email' => 'daniel.foster@yahoo.com', 'phone' => '(407) 555-3456', 'subject' => 'Delivery area question', 'message' => "Hi! I live in Clermont — is that within your delivery area? I found your page on Instagram and everything looks amazing. If you don't deliver here, is there a pickup option?", 'status' => 'new', 'created_at' => $now->copy()->subDays(1)],

            // Read
            ['name' => 'Maria Gonzalez', 'email' => 'maria.gonzalez@gmail.com', 'phone' => '(407) 555-1123', 'subject' => 'Just wanted to say THANK YOU!', 'message' => "Cassie, I just wanted to reach out and say thank you! The chocolate chocolate chip loaf I ordered for my daughter's birthday was an absolute hit. Everyone was asking where I got it. You've got a customer for life! 🎂❤️", 'status' => 'read', 'created_at' => $now->copy()->subDays(3)],
            ['name' => 'Karen White', 'email' => 'karen.white@gmail.com', 'phone' => '(321) 555-1456', 'subject' => 'Wholesale pricing discussion', 'message' => "Hi Cassie! We spoke at the farmers market last Saturday. I own The Daily Grind coffee shop on Main St and I'd love to carry your sourdough. Can we set up a time to discuss wholesale pricing and a weekly delivery schedule?", 'status' => 'read', 'created_at' => $now->copy()->subDays(5)],
            ['name' => 'James Parker', 'email' => 'james.parker@yahoo.com', 'phone' => null, 'subject' => 'Weekly standing order?', 'message' => "Is it possible to set up a recurring weekly order? I'd like to get 1 regular loaf and 6 English muffins every Thursday. Would make my life so much easier not having to remember to order each week!", 'status' => 'read', 'created_at' => $now->copy()->subDays(7)],

            // Replied
            ['name' => 'Priya Sharma', 'email' => 'priya.sharma@gmail.com', 'phone' => '(407) 555-1389', 'subject' => 'Do you ship?', 'message' => "My parents live in Georgia and I want to send them some of your sourdough for their anniversary. Do you ship outside of Florida? If not, any plans to start?", 'status' => 'replied', 'replied_at' => $now->copy()->subDays(8), 'created_at' => $now->copy()->subDays(10)],
            ['name' => 'Stephanie Coleman', 'email' => 'steph.coleman@gmail.com', 'phone' => '(321) 555-1823', 'subject' => 'Gluten-free options?', 'message' => "Hi! I love everything on your menu but I recently found out I'm gluten intolerant. Do you have any gluten-free options or plans to add some? I miss good bread so much!", 'status' => 'replied', 'replied_at' => $now->copy()->subDays(12), 'created_at' => $now->copy()->subDays(14)],
            ['name' => 'Robert Kim', 'email' => 'robert.kim@yahoo.com', 'phone' => '(407) 555-0891', 'subject' => 'Delivery packaging feedback', 'message' => "Hey Cassie, I got my delivery today and the bread was slightly squished. The taste was still great but maybe a sturdier box would help? Just some friendly feedback — I'll definitely keep ordering!", 'status' => 'replied', 'replied_at' => $now->copy()->subDays(18), 'created_at' => $now->copy()->subDays(20)],
            ['name' => 'Amanda Foster', 'email' => 'amanda.foster@gmail.com', 'phone' => '(863) 555-0411', 'subject' => 'Easter pre-order?', 'message' => "Hi! Easter is coming up and I'd love to pre-order some sourdough for our family dinner. Do you have a special Easter menu or should I just order from the regular menu? Looking for something special for about 12 people.", 'status' => 'replied', 'replied_at' => $now->copy()->subDays(2), 'created_at' => $now->copy()->subDays(4)],
            ['name' => 'Chris Patel', 'email' => 'chris.patel@gmail.com', 'phone' => '(407) 555-0523', 'subject' => 'Bulk order for office', 'message' => "Hi Cassie! I want to order bread for my office — about 15 people. Thinking a mix of regular loaves and English muffins. Is there a bulk discount? We'd probably want this monthly.", 'status' => 'read', 'created_at' => $now->copy()->subDays(6)],
        ];

        foreach ($messages as $msg) {
            ContactMessage::create(array_merge(['replied_at' => null], $msg));
        }
    }
}
