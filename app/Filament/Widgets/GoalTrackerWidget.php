<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Setting;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class GoalTrackerWidget extends Widget
{
    protected static string $view = 'filament.widgets.goal-tracker';

    protected int | string | array $columnSpan = 1;

    public bool $showEditModal = false;

    public string $newGoal = '';

    public function mount(): void
    {
        $this->newGoal = Setting::get('monthly_revenue_goal', '5000');
    }

    public function openEditModal(): void
    {
        $this->newGoal = Setting::get('monthly_revenue_goal', '5000');
        $this->showEditModal = true;
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
    }

    public function saveGoal(): void
    {
        Setting::set('monthly_revenue_goal', $this->newGoal);
        $this->showEditModal = false;
    }

    public function getGoalDataProperty(): array
    {
        $goal = (float) Setting::get('monthly_revenue_goal', 5000);
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $revenue = (float) Order::whereBetween('created_at', [$start, $end])
            ->whereNotIn('status', ['cancelled'])
            ->sum('total');

        $percentage = $goal > 0 ? min(round($revenue / $goal * 100, 1), 100) : 0;

        return [
            'month' => now()->format('F Y'),
            'goal' => $goal,
            'revenue' => $revenue,
            'percentage' => $percentage,
        ];
    }
}
