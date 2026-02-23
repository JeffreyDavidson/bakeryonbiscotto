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
            // New orders — unread
            ['title' => 'New order BOB-KJ8RTMWP', 'body' => 'Sarah Mitchell ordered Sourdough Loaf ×2, Cinnamon Rolls ×1 — $48.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 15, 'read' => false],
            ['title' => 'New order BOB-QN3PLXVA', 'body' => 'Mike Thompson ordered Custom Birthday Cake, Chocolate Chip Cookies ×2 — $136.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 45, 'read' => false],
            ['title' => 'New order BOB-YT9HBWZK', 'body' => 'Jessica Ramirez ordered Banana Bread ×3, Blueberry Muffins ×6 — $63.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 120, 'read' => false],

            // Status changes — unread
            ['title' => 'Order BOB-RSIEAAPJ confirmed', 'body' => 'Velda Quitzon — 5 items, $148.00', 'icon' => 'heroicon-o-check', 'color' => 'info', 'ago' => 30, 'read' => false],
            ['title' => 'Order BOB-MYXG7OBU is baking', 'body' => 'Sid Bednar MD — 2 items, $66.00', 'icon' => 'heroicon-o-fire', 'color' => 'warning', 'ago' => 90, 'read' => false],

            // Reviews — unread
            ['title' => 'New 5-star review', 'body' => 'Emily Watson: "The sourdough is absolutely incredible! Best I\'ve ever had."', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 60, 'read' => false],
            ['title' => 'New 3-star review', 'body' => 'Robert Kim: "Good bread but packaging could be better."', 'icon' => 'heroicon-o-star', 'color' => 'danger', 'ago' => 75, 'read' => false],

            // Messages — unread
            ['title' => 'New message: Catering inquiry', 'body' => 'Lisa Anderson: "Hi, I\'m interested in ordering for a corporate event..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 50, 'read' => false],

            // Older — read
            ['title' => 'New order BOB-FM2DSCAE', 'body' => 'David Chen ordered Cookie Platter (Large), Brownie Box — $95.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 200, 'read' => true],
            ['title' => 'Order BOB-ZOCBWKII ready for pickup', 'body' => 'Theron Cartwright — 4 items, $136.00', 'icon' => 'heroicon-o-check-circle', 'color' => 'success', 'ago' => 180, 'read' => true],
            ['title' => 'Order BOB-XONZPHTC delivered', 'body' => 'Mr. Tyrell Hagenes — 2 items, $63.00', 'icon' => 'heroicon-o-check-badge', 'color' => 'gray', 'ago' => 300, 'read' => true],
            ['title' => 'New 5-star review', 'body' => 'Maria Gonzalez: "Ordered cookies for my daughter\'s birthday — everyone loved them!"', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 480, 'read' => true],
            ['title' => 'New 4-star review', 'body' => 'James Parker: "Cinnamon rolls were delicious, delivery was a bit late."', 'icon' => 'heroicon-o-star', 'color' => 'warning', 'ago' => 240, 'read' => true],
            ['title' => 'New message: Allergen question', 'body' => 'Tom Richards: "Do your brownies contain tree nuts? My son has an allergy..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 150, 'read' => true],
            ['title' => 'New message: Wholesale pricing', 'body' => 'Karen White: "I own a coffee shop and would love to carry your bread..."', 'icon' => 'heroicon-o-envelope', 'color' => 'primary', 'ago' => 400, 'read' => true],
            ['title' => 'New order BOB-LW7XPNTG', 'body' => 'Amanda Foster ordered Sourdough Loaf ×1 — $28.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 360, 'read' => true],
            ['title' => 'New order BOB-RV4CJNHP', 'body' => 'Chris Patel ordered Focaccia ×2, Olive Bread ×1 — $72.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 500, 'read' => true],
            ['title' => 'New order BOB-HK8MWZTQ', 'body' => 'Nicole Brown ordered Wedding Cookie Favors (100 pcs) — $155.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 600, 'read' => true],
            ['title' => 'New order BOB-AS5GYDNW', 'body' => 'Brian Lopez ordered Chocolate Chip Cookies ×2 — $42.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 800, 'read' => true],
            ['title' => 'New order BOB-WT6ELPXR', 'body' => 'Samantha Lee ordered Sourdough Loaf ×1, Croissants ×6 — $89.00', 'icon' => 'heroicon-o-shopping-bag', 'color' => 'success', 'ago' => 1000, 'read' => true],
        ];

        foreach ($notifications as $n) {
            $createdAt = Carbon::now()->subMinutes($n['ago']);

            $user->notifications()->create([
                'id' => Str::uuid(),
                'type' => 'Filament\\Notifications\\DatabaseNotification',
                'data' => [
                    'actions' => [],
                    'body' => $n['body'],
                    'color' => $n['color'],
                    'duration' => 'persistent',
                    'icon' => $n['icon'],
                    'iconColor' => $n['color'],
                    'status' => 'info',
                    'title' => $n['title'],
                    'view' => null,
                    'viewData' => [],
                    'format' => 'filament',
                ],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'read_at' => $n['read'] ? $createdAt->copy()->addMinutes(15) : null,
            ]);
        }
    }
}
