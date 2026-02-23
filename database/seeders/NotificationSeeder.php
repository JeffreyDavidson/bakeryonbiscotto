<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $notifications = [
            // New orders
            ['title' => 'New order BOB-KJ8RTMWP from Sarah Mitchell — $48.00', 'body' => 'Sourdough Loaf ×2, Cinnamon Rolls ×1', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 15],
            ['title' => 'New order BOB-QN3PLXVA from Mike Thompson — $136.00', 'body' => 'Custom Birthday Cake, Chocolate Chip Cookies ×2', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 45],
            ['title' => 'New order BOB-YT9HBWZK from Jessica Ramirez — $63.00', 'body' => 'Banana Bread ×3, Blueberry Muffins ×6', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 120],
            ['title' => 'New order BOB-FM2DSCAE from David Chen — $95.00', 'body' => 'Cookie Platter (Large), Brownie Box', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 200],
            ['title' => 'New order BOB-LW7XPNTG from Amanda Foster — $28.00', 'body' => 'Sourdough Loaf ×1', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 360],

            // Status changes
            ['title' => 'Order BOB-RSIEAAPJ moved to confirmed', 'body' => 'Velda Quitzon — 5 items, $148.00', 'icon' => 'heroicon-o-check', 'color' => 'info', 'ago' => 30],
            ['title' => 'Order BOB-MYXG7OBU moved to baking', 'body' => 'Sid Bednar MD — 2 items, $66.00', 'icon' => 'heroicon-o-fire', 'color' => 'warning', 'ago' => 90],
            ['title' => 'Order BOB-ZOCBWKII moved to ready', 'body' => 'Theron Cartwright — 4 items, $136.00', 'icon' => 'heroicon-o-check-circle', 'color' => 'success', 'ago' => 180],
            ['title' => 'Order BOB-XONZPHTC moved to delivered', 'body' => 'Mr. Tyrell Hagenes — 2 items, $63.00', 'icon' => 'heroicon-o-check-badge', 'color' => 'gray', 'ago' => 300],

            // Reviews
            ['title' => 'New 5-star review from Emily Watson', 'body' => '"The sourdough is absolutely incredible! Best I\'ve ever had."', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 60],
            ['title' => 'New 4-star review from James Parker', 'body' => '"Cinnamon rolls were delicious, delivery was a bit late."', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 240],
            ['title' => 'New 5-star review from Maria Gonzalez', 'body' => '"Ordered cookies for my daughter\'s birthday — everyone loved them!"', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 480],
            ['title' => 'New 3-star review from Robert Kim', 'body' => '"Good bread but packaging could be better."', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 720],

            // Contact messages
            ['title' => 'New message from Lisa Anderson: Catering inquiry', 'body' => '"Hi, I\'m interested in ordering for a corporate event next month..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 75],
            ['title' => 'New message from Tom Richards: Allergen question', 'body' => '"Do your brownies contain tree nuts? My son has an allergy..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 150],
            ['title' => 'New message from Karen White: Wholesale pricing', 'body' => '"I own a coffee shop and would love to carry your bread..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 400],

            // More orders for volume
            ['title' => 'New order BOB-RV4CJNHP from Chris Patel — $72.00', 'body' => 'Focaccia ×2, Olive Bread ×1, Garlic Knots ×12', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 500],
            ['title' => 'New order BOB-HK8MWZTQ from Nicole Brown — $155.00', 'body' => 'Wedding Cookie Favors (100 pcs)', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 600],
            ['title' => 'New order BOB-AS5GYDNW from Brian Lopez — $42.00', 'body' => 'Chocolate Chip Cookies ×2, Peanut Butter Cookies ×1', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 800],
            ['title' => 'New order BOB-WT6ELPXR from Samantha Lee — $89.00', 'body' => 'Sourdough Loaf ×1, Croissants ×6, Cinnamon Rolls ×1', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 1000],
        ];

        foreach ($notifications as $n) {
            $user->notifications()->create([
                'id' => Str::uuid(),
                'type' => 'Filament\\Notifications\\DatabaseNotification',
                'data' => [
                    'title' => $n['title'],
                    'body' => $n['body'],
                    'icon' => $n['icon'],
                    'iconColor' => $n['color'],
                    'status' => 'info',
                    'format' => 'filament',
                ],
                'created_at' => Carbon::now()->subMinutes($n['ago']),
                'updated_at' => Carbon::now()->subMinutes($n['ago']),
                'read_at' => $n['ago'] > 300 ? Carbon::now()->subMinutes($n['ago'] - 30) : null,
            ]);
        }
    }
}
