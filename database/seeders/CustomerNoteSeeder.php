<?php

namespace Database\Seeders;

use App\Models\CustomerNote;
use Illuminate\Database\Seeder;

class CustomerNoteSeeder extends Seeder
{
    public function run(): void
    {
        CustomerNote::query()->delete();

        $notes = [
            ['customer_email' => 'tom.richards@outlook.com', 'customer_name' => 'Tom Richards', 'note' => 'Severe tree nut allergy — son has anaphylaxis risk. ALWAYS confirm no cross-contamination. Do NOT include almond products in same bag.', 'is_important' => true],
            ['customer_email' => 'rachel.torres@gmail.com', 'customer_name' => 'Rachel Torres', 'note' => 'Gluten sensitivity — always asks about GF options. Interested if we ever add GF sourdough.', 'is_important' => true],
            ['customer_email' => 'diane.murphy@icloud.com', 'customer_name' => 'Diane Murphy', 'note' => 'Diabetic — prefers low sugar options. Likes the regular sourdough and honey wheat best.', 'is_important' => true],
            ['customer_email' => 'sarah.mitchell@gmail.com', 'customer_name' => 'Sarah Mitchell', 'note' => 'Regular weekly customer — orders every Tuesday for Thursday pickup. Very reliable.', 'is_important' => false],
            ['customer_email' => 'sarah.mitchell@gmail.com', 'customer_name' => 'Sarah Mitchell', 'note' => 'Referred Nicole Brown and Karen White. Give her a thank-you with next order!', 'is_important' => false],
            ['customer_email' => 'karen.white@gmail.com', 'customer_name' => 'Karen White', 'note' => 'Owns a coffee shop downtown (The Daily Grind). Wholesale customer — gets 10 loaves/week at 15% discount.', 'is_important' => true],
            ['customer_email' => 'marcus.johnson@yahoo.com', 'customer_name' => 'Marcus Johnson', 'note' => 'Prefers delivery to back door — front porch gets too much sun.', 'is_important' => false],
            ['customer_email' => 'emily.watson@gmail.com', 'customer_name' => 'Emily Watson', 'note' => 'Referred by the Davenport Farmers Market. Became weekly English muffin subscriber.', 'is_important' => false],
            ['customer_email' => 'jessica.ramirez@gmail.com', 'customer_name' => 'Jessica Ramirez', 'note' => 'Dairy-free preference — check cheese products before including in bundles.', 'is_important' => true],
            ['customer_email' => 'david.chen@outlook.com', 'customer_name' => 'David Chen', 'note' => 'Loves hosting dinner parties. Great candidate for catering upsell.', 'is_important' => false],
            ['customer_email' => 'angela.davis@icloud.com', 'customer_name' => 'Angela Davis', 'note' => 'Works from home — available for delivery anytime. Very flexible with timing.', 'is_important' => false],
            ['customer_email' => 'carlos.martinez@gmail.com', 'customer_name' => 'Carlos Martinez', 'note' => 'Prefers Spanish-language text confirmations when possible. Very friendly!', 'is_important' => false],
            ['customer_email' => 'nicole.brown@icloud.com', 'customer_name' => 'Nicole Brown', 'note' => 'Referred by Sarah M. Ordered for wedding — potential repeat custom order customer.', 'is_important' => false],
        ];

        foreach ($notes as $note) {
            CustomerNote::create(array_merge(['created_by' => 'Cassie'], $note));
        }
    }
}
