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

        // Clear existing notifications so we don't duplicate
        $user->notifications()->delete();

        $notifications = [
            // === UNREAD (8) — these show in the bell dropdown ===

            // New orders
            [
                'title' => 'New order received!',
                'body' => 'Sarah Mitchell ordered Sourdough Loaf ×2, Cinnamon Rolls ×1 — $48.00 (Pickup, tomorrow at 2:00 PM)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 12,
                'read' => false,
            ],
            [
                'title' => 'New order received!',
                'body' => 'Mike Thompson ordered Custom Birthday Cake, Chocolate Chip Cookies ×2 — $136.00 (Delivery to Davenport)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 38,
                'read' => false,
            ],
            [
                'title' => 'New order received!',
                'body' => 'Jessica Ramirez ordered Banana Bread ×3, Blueberry Muffins ×6 — $63.00 (Pickup, Friday at 10:00 AM)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 95,
                'read' => false,
            ],

            // Status change
            [
                'title' => 'Order ready for pickup',
                'body' => 'BOB-RSIEAAPJ for Velda Quitzon — 5 items, $148.00. Customer has been notified.',
                'icon' => 'heroicon-o-check-circle',
                'color' => 'success',
                'ago' => 25,
                'read' => false,
            ],

            // Reviews
            [
                'title' => 'New 5-star review!',
                'body' => 'Emily Watson: "The sourdough is absolutely incredible! Best I\'ve ever had. Will be ordering weekly."',
                'icon' => 'heroicon-o-star',
                'color' => 'warning',
                'ago' => 55,
                'read' => false,
            ],
            [
                'title' => 'New 3-star review',
                'body' => 'Robert Kim: "Good bread but the packaging was a bit crushed on delivery. Taste was great though!"',
                'icon' => 'heroicon-o-star',
                'color' => 'danger',
                'ago' => 72,
                'read' => false,
            ],

            // Messages
            [
                'title' => 'New message: Catering inquiry',
                'body' => 'Lisa Anderson: "Hi! I\'m planning a corporate event for 50 people next month. Do you do large orders?"',
                'icon' => 'heroicon-o-envelope',
                'color' => 'primary',
                'ago' => 42,
                'read' => false,
            ],
            [
                'title' => 'New message: Allergen question',
                'body' => 'Tom Richards: "Do your brownies contain tree nuts? My son has a severe allergy and we want to be safe."',
                'icon' => 'heroicon-o-envelope',
                'color' => 'primary',
                'ago' => 68,
                'read' => false,
            ],

            // === READ (12) — older activity ===

            // Orders
            [
                'title' => 'New order received!',
                'body' => 'David Chen ordered Cookie Platter (Large), Brownie Box — $95.00 (Delivery)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 180,
                'read' => true,
            ],
            [
                'title' => 'New order received!',
                'body' => 'Amanda Foster ordered Sourdough Loaf ×1 — $28.00 (Pickup, Saturday)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 360,
                'read' => true,
            ],
            [
                'title' => 'New order received!',
                'body' => 'Chris Patel ordered Focaccia ×2, Olive Bread ×1 — $72.00 (Pickup)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 500,
                'read' => true,
            ],
            [
                'title' => 'New order received!',
                'body' => 'Nicole Brown ordered Wedding Cookie Favors (100 pcs) — $155.00 (Delivery)',
                'icon' => 'heroicon-o-shopping-bag',
                'color' => 'success',
                'ago' => 720,
                'read' => true,
            ],

            // Status changes
            [
                'title' => 'Order delivered',
                'body' => 'BOB-XONZPHTC for Mr. Tyrell Hagenes — 2 items, $63.00. Delivered successfully.',
                'icon' => 'heroicon-o-check-badge',
                'color' => 'gray',
                'ago' => 300,
                'read' => true,
            ],
            [
                'title' => 'Order is baking',
                'body' => 'BOB-MYXG7OBU for Sid Bednar — 2 items, $66.00. Started baking.',
                'icon' => 'heroicon-o-fire',
                'color' => 'warning',
                'ago' => 240,
                'read' => true,
            ],

            // Reviews
            [
                'title' => 'New 5-star review!',
                'body' => 'Maria Gonzalez: "Ordered cookies for my daughter\'s birthday — everyone loved them! Beautiful packaging too."',
                'icon' => 'heroicon-o-star',
                'color' => 'warning',
                'ago' => 480,
                'read' => true,
            ],
            [
                'title' => 'New 4-star review',
                'body' => 'James Parker: "Cinnamon rolls were absolutely delicious. Delivery was about 20 min late but worth the wait."',
                'icon' => 'heroicon-o-star',
                'color' => 'warning',
                'ago' => 600,
                'read' => true,
            ],
            [
                'title' => 'New 5-star review!',
                'body' => 'Priya Sharma: "Found you at the farmers market and now I\'m hooked! The jalapeño cheddar is life-changing."',
                'icon' => 'heroicon-o-star',
                'color' => 'warning',
                'ago' => 900,
                'read' => true,
            ],

            // Messages
            [
                'title' => 'New message: Wholesale pricing',
                'body' => 'Karen White: "I own a coffee shop downtown and would love to carry your sourdough. Can we discuss pricing?"',
                'icon' => 'heroicon-o-envelope',
                'color' => 'primary',
                'ago' => 400,
                'read' => true,
            ],
            [
                'title' => 'New message: Thank you!',
                'body' => 'Diane Murphy: "Just wanted to say the bread at the market last Saturday was phenomenal. You made our weekend!"',
                'icon' => 'heroicon-o-envelope',
                'color' => 'primary',
                'ago' => 800,
                'read' => true,
            ],
            [
                'title' => 'New message: Custom order request',
                'body' => 'Rachel Torres: "Can you make a gluten-free birthday cake? My husband\'s 40th is coming up next month."',
                'icon' => 'heroicon-o-envelope',
                'color' => 'primary',
                'ago' => 1200,
                'read' => true,
            ],
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
                'read_at' => $n['read'] ? $createdAt->copy()->addMinutes(rand(5, 30)) : null,
            ]);
        }
    }
}
