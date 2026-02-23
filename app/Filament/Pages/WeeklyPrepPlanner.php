<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\Recipe;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;

class WeeklyPrepPlanner extends Page
{
    protected string $view = 'filament.pages.weekly-prep-planner';

    protected static ?string $title = 'Prep Planner';

    protected static ?string $navigationLabel = 'Prep Planner';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-clipboard-document-check';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    #[Url]
    public string $weekStart = '';

    public function mount(): void
    {
        if (empty($this->weekStart)) {
            $this->weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        }
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getUrl() => 'Prep Planner',
        ];
    }

    public function previousWeek(): void
    {
        $this->weekStart = Carbon::parse($this->weekStart)->subWeek()->toDateString();
    }

    public function nextWeek(): void
    {
        $this->weekStart = Carbon::parse($this->weekStart)->addWeek()->toDateString();
    }

    public function thisWeek(): void
    {
        $this->weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
    }

    /**
     * Build a timeline of prep tasks grouped by day.
     * Works backwards from each order's requested date/time using recipe stages.
     */
    public function getPrepTimelineProperty(): array
    {
        $start = Carbon::parse($this->weekStart);
        $end = $start->copy()->addDays(6)->endOfDay();

        // Get orders for this week + a few days ahead (stages might prep this week for next week orders)
        $orders = Order::with('items')
            ->whereBetween('requested_date', [$start->toDateString(), $end->copy()->addDays(3)->toDateString()])
            ->whereNotIn('status', ['cancelled', 'delivered'])
            ->orderBy('requested_date')
            ->orderBy('requested_time')
            ->get();

        // Load all recipes with stages, keyed by product_id
        $recipesByProduct = Recipe::with('stages')
            ->whereNotNull('product_id')
            ->get()
            ->keyBy('product_id');

        $tasks = [];

        foreach ($orders as $order) {
            // Determine order due datetime
            $dueDate = $order->requested_date->copy();
            if ($order->requested_time) {
                $timeParts = explode(':', $order->requested_time);
                $dueDate->setTime((int) $timeParts[0], (int) ($timeParts[1] ?? 0));
            } else {
                $dueDate->setTime(12, 0); // default noon
            }

            foreach ($order->items as $item) {
                $recipe = $recipesByProduct[$item->product_id] ?? null;

                if ($recipe && $recipe->stages->isNotEmpty()) {
                    foreach ($recipe->stages as $stage) {
                        $taskTime = $dueDate->copy()->subHours((float) $stage->hours_before);

                        // Only include tasks that fall within this week
                        if ($taskTime->lt($start) || $taskTime->gt($end->endOfDay())) {
                            continue;
                        }

                        $tasks[] = [
                            'datetime' => $taskTime,
                            'day' => $taskTime->toDateString(),
                            'time' => $taskTime->format('g:i A'),
                            'stage_name' => $stage->name,
                            'duration' => $stage->duration_minutes,
                            'instructions' => $stage->instructions,
                            'product_name' => $item->product_name,
                            'quantity' => $item->quantity,
                            'order_number' => $order->order_number,
                            'order_id' => $order->id,
                            'due' => $dueDate->format('D M j, g:i A'),
                            'fulfillment' => $order->fulfillment_type,
                            'customer' => $order->customer_name,
                            'hours_before' => $stage->hours_before,
                        ];
                    }
                } else {
                    // No recipe/stages — just show as a generic prep task the day before
                    $taskTime = $dueDate->copy()->subHours(12);

                    if ($taskTime->gte($start) && $taskTime->lte($end->endOfDay())) {
                        $tasks[] = [
                            'datetime' => $taskTime,
                            'day' => $taskTime->toDateString(),
                            'time' => $taskTime->format('g:i A'),
                            'stage_name' => 'Prep & Bake',
                            'duration' => null,
                            'instructions' => null,
                            'product_name' => $item->product_name,
                            'quantity' => $item->quantity,
                            'order_number' => $order->order_number,
                            'order_id' => $order->id,
                            'due' => $dueDate->format('D M j, g:i A'),
                            'fulfillment' => $order->fulfillment_type,
                            'customer' => $order->customer_name,
                            'hours_before' => 12,
                        ];
                    }
                }
            }
        }

        // Sort by datetime
        usort($tasks, fn ($a, $b) => $a['datetime']->timestamp <=> $b['datetime']->timestamp);

        // Group by day
        $grouped = [];
        foreach ($tasks as $task) {
            $grouped[$task['day']][] = $task;
        }

        return $grouped;
    }

    /**
     * Summary stats for the week
     */
    public function getWeekStatsProperty(): array
    {
        $timeline = $this->prepTimeline;
        $totalTasks = 0;
        $totalMinutes = 0;
        $products = [];

        foreach ($timeline as $day => $tasks) {
            $totalTasks += count($tasks);
            foreach ($tasks as $task) {
                $totalMinutes += $task['duration'] ?? 0;
                $key = $task['product_name'];
                $products[$key] = ($products[$key] ?? 0) + $task['quantity'];
            }
        }

        return [
            'total_tasks' => $totalTasks,
            'total_hours' => round($totalMinutes / 60, 1),
            'unique_products' => count($products),
            'products' => $products,
        ];
    }
}
