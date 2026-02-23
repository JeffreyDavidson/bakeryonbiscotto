<?php

namespace Database\Seeders;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::query()->delete();

        $reviews = [
            // Original 4 reviews
            ['name' => 'Kristen S.', 'rating' => 5, 'body' => "Bought some amazing goodies from Bakery on Biscotto! My dear friend Cassie sure knows how to bake amazing sourdough! I got the chocolate, chocolate chip loaf & the English muffins. They are going to be the perfect thank you gift for my parents who are watching our kids for us this week. Highly recommend her shop.", 'favorite_bread' => null, 'status' => 'approved', 'days_ago' => 120],
            ['name' => 'Mike T.', 'rating' => 5, 'body' => "Cassie's chocolate chip sourdough changed my life. I'm not being dramatic. My family goes through a loaf in a single day and then immediately orders another.", 'favorite_bread' => 'Chocolate Chip Loaf', 'status' => 'approved', 'days_ago' => 98],
            ['name' => 'Kinsey M.', 'rating' => 5, 'body' => 'This bread!! Oh. My. Gosh! Amazing!! Def recommend the Parmesan rosemary sourdough! Amazing!', 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 85],
            ['name' => 'Joe M.', 'rating' => 5, 'body' => "I fly to Florida every year just to have some of this lady's cooking! It doesn't get any better ☺️", 'favorite_bread' => null, 'status' => 'approved', 'days_ago' => 150],

            // New reviews
            ['name' => 'Sarah Mitchell', 'rating' => 5, 'body' => "I've been ordering weekly for 3 months and the quality is always perfect. The Regular Loaf is my family's staple now. We can't go back to store-bought!", 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 45],
            ['name' => 'Emily Watson', 'rating' => 5, 'body' => "The sourdough English muffins are absolutely incredible! Best I've ever had. Perfectly tangy with those amazing nooks and crannies. Will be ordering weekly.", 'favorite_bread' => 'Sourdough English Muffins 6ct', 'status' => 'approved', 'days_ago' => 30],
            ['name' => 'Jessica Ramirez', 'rating' => 4, 'body' => "Love the banana bread — so moist and flavorful. Only reason for 4 stars is I wish you offered a gluten-free version! Everything else is wonderful.", 'favorite_bread' => 'Banana Bread', 'status' => 'approved', 'days_ago' => 67],
            ['name' => 'David Chen', 'rating' => 5, 'body' => "Ordered the 4-pack of mini loaves for a dinner party. Every single guest asked where I got the bread. You just made me the most popular host in the neighborhood!", 'favorite_bread' => '4-Pack of Mini Loaves', 'status' => 'approved', 'days_ago' => 55],
            ['name' => 'Amanda Foster', 'rating' => 5, 'body' => "The Cheddar Cheese Loaf is dangerously good. I've tried making sourdough at home and it never comes close. Thank you for saving me the trouble and delivering perfection!", 'favorite_bread' => 'Cheddar Cheese Loaf', 'status' => 'approved', 'days_ago' => 40],
            ['name' => 'Robert Kim', 'rating' => 3, 'body' => "Good bread but the packaging was a bit crushed on delivery. Taste was great though! The cinnamon and sugar loaf was delicious. Would order again with pickup instead.", 'favorite_bread' => 'Cinnamon and Sugar Loaf', 'status' => 'approved', 'days_ago' => 22],
            ['name' => 'Maria Gonzalez', 'rating' => 5, 'body' => "Ordered the chocolate chocolate chip loaf for my daughter's birthday — everyone loved it! Beautiful packaging too. Cassie even included a handwritten note. So special!", 'favorite_bread' => 'Chocolate Chocolate Chip Loaf', 'status' => 'approved', 'days_ago' => 33],
            ['name' => 'James Parker', 'rating' => 4, 'body' => "Honey wheat sandwich bread is absolutely delicious. Best sandwich bread I've had. Delivery was about 20 min late but totally worth the wait.", 'favorite_bread' => 'Honey Wheat Sourdough Sandwich Bread', 'status' => 'approved', 'days_ago' => 48],
            ['name' => 'Priya Sharma', 'rating' => 5, 'body' => "Found you at the Davenport farmers market and now I'm hooked! The mozzarella garlic loaf is life-changing. My husband literally does a happy dance when he sees the bag.", 'favorite_bread' => 'Mozzarella Garlic Loaf', 'status' => 'approved', 'days_ago' => 60],
            ['name' => 'Karen White', 'rating' => 5, 'body' => "I own a coffee shop and we've been carrying Bakery on Biscotto sourdough for two months. Our customers RAVE about it. Best decision I made for my business.", 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 25],
            ['name' => 'Diane Murphy', 'rating' => 4, 'body' => "The banana walnut bread is divine! I brought it to my book club and everyone wanted the recipe. I just smiled and said it's a secret 😄", 'favorite_bread' => 'Banana Walnut Bread', 'status' => 'approved', 'days_ago' => 72],
            ['name' => 'Brian Hayes', 'rating' => 5, 'body' => "My wife surprised me with the chocolate almond chocolate chip loaf for Father's Day. I'm still thinking about it weeks later. Absolutely phenomenal.", 'favorite_bread' => 'Chocolate Almond Chocolate Chip', 'status' => 'approved', 'days_ago' => 18],
            ['name' => 'Stephanie Coleman', 'rating' => 3, 'body' => "The bread itself was tasty but my order took longer than expected. Communication could be better — I wasn't sure when it would arrive. Once I got it though, the quality was there.", 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 52],
            ['name' => 'Marcus Johnson', 'rating' => 5, 'body' => "Been ordering the English muffins every week. My kids won't eat any other brand now. You've ruined us for grocery store muffins forever — and we thank you!", 'favorite_bread' => 'Sourdough English Muffins 6ct', 'status' => 'approved', 'days_ago' => 14],
            ['name' => 'Laura Nguyen', 'rating' => 5, 'body' => "The pumpkin chocolate chip bread is seasonal perfection! I ordered 3 loaves and froze two. They thaw beautifully. Can't wait for fall to come back around.", 'favorite_bread' => 'Pumpkin Chocolate Chip Bread', 'status' => 'approved', 'days_ago' => 80],
            ['name' => 'Carlos Martinez', 'rating' => 4, 'body' => "Great sourdough! Reminds me of the bread my abuela used to make. The regular loaf is excellent — crispy outside, soft inside. Will keep ordering.", 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 38],
            ['name' => 'Patricia Reed', 'rating' => 2, 'body' => "I was excited to try but my loaf arrived kind of flat and dense. Not sure if it was an off batch? The flavor was okay but not what I expected for the price. Might try again.", 'favorite_bread' => 'Regular Loaf', 'status' => 'approved', 'days_ago' => 90],
            ['name' => 'Angela Davis', 'rating' => 5, 'body' => "Ordered the cheddar cheese loaf and mozzarella garlic loaf for game day. Biggest hit of the party! Everyone was asking about it. Already planning my next order.", 'favorite_bread' => 'Cheddar Cheese Loaf', 'status' => 'approved', 'days_ago' => 28],
            ['name' => 'Tom Richards', 'rating' => 4, 'body' => "Really good bread. Appreciate that Cassie lists all ingredients clearly — super important for my son's allergies. The chocolate chip loaf was a safe treat he loved!", 'favorite_bread' => 'Chocolate Chip Loaf', 'status' => 'approved', 'days_ago' => 42],
            ['name' => 'Lisa Anderson', 'rating' => 5, 'body' => "I hosted a brunch and served the honey wheat sandwich bread for little tea sandwiches. So many compliments! Cassie is the real deal. Supporting local never tasted so good.", 'favorite_bread' => 'Honey Wheat Sourdough Sandwich Bread', 'status' => 'approved', 'days_ago' => 16],
            ['name' => 'Rachel Torres', 'rating' => 1, 'body' => "Unfortunately my order was wrong — received plain sourdough instead of the cinnamon sugar I ordered. Reached out to Cassie and she's making it right, but was disappointing.", 'favorite_bread' => 'Cinnamon and Sugar Loaf', 'status' => 'approved', 'days_ago' => 95],

            // Pending reviews (recent)
            ['name' => 'Kevin O\'Brien', 'rating' => 5, 'body' => "Just got my first order today — the 4-pack of mini loaves. Already devoured the chocolate chip one. This is going to be a weekly thing!", 'favorite_bread' => '4-Pack of Mini Loaves', 'status' => 'pending', 'days_ago' => 2],
            ['name' => 'Nicole Brown', 'rating' => 4, 'body' => "Ordered the pumpkin almond chocolate chip bread for a holiday gathering. It was a beautiful loaf and tasted amazing. The almonds add such a nice texture.", 'favorite_bread' => 'Pumpkin Almond Chocolate Chip Bread', 'status' => 'pending', 'days_ago' => 3],
            ['name' => 'Chris Patel', 'rating' => 5, 'body' => "Third order this month. The regular loaf never disappoints. I've converted at least 5 friends to Bakery on Biscotto. Keep doing what you're doing, Cassie!", 'favorite_bread' => 'Regular Loaf', 'status' => 'pending', 'days_ago' => 1],
            ['name' => 'Sandra Lee', 'rating' => 3, 'body' => "Bread was good but a bit overpriced compared to what I expected. The English muffins were great though — perfectly chewy.", 'favorite_bread' => 'Sourdough English Muffins 6ct', 'status' => 'pending', 'days_ago' => 5],
            ['name' => 'Michael R.', 'rating' => 5, 'body' => "Incredible sourdough. My wife and I fight over the last slice every single time. The crust is perfect!", 'favorite_bread' => 'Regular Loaf', 'status' => 'pending', 'days_ago' => 4],

            // Featured reviews
            ['name' => 'Linda Thompson', 'rating' => 5, 'body' => "I've lived in Davenport for 20 years and this is the best bakery we've ever had. Cassie pours her heart into every loaf. The chocolate chocolate chip is my weakness!", 'favorite_bread' => 'Chocolate Chocolate Chip Loaf', 'status' => 'approved', 'is_featured' => true, 'days_ago' => 10],
            ['name' => 'Jennifer Hall', 'rating' => 5, 'body' => "Found Bakery on Biscotto through a neighbor's recommendation. Now our whole street orders together! The mini loaf 4-pack is perfect for trying everything.", 'favorite_bread' => '4-Pack of Mini Loaves', 'status' => 'approved', 'is_featured' => true, 'days_ago' => 7],
        ];

        $now = Carbon::parse('2026-02-23');

        foreach ($reviews as $review) {
            $daysAgo = $review['days_ago'];
            unset($review['days_ago']);

            Review::create(array_merge([
                'is_featured' => false,
                'created_at' => $now->copy()->subDays($daysAgo),
                'updated_at' => $now->copy()->subDays($daysAgo),
            ], $review));
        }
    }
}
