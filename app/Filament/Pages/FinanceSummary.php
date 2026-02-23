<?php

namespace App\Filament\Pages;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Order;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;

class FinanceSummary extends Page
{
    protected string $view = 'filament.pages.finance-summary';

    protected static ?string $title = 'Finance Summary';

    protected static ?string $navigationLabel = 'Summary';

    protected static ?int $navigationSort = 0;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-chart-bar';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Finances';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getUrl() => 'Finance Summary',
        ];
    }

    #[Url]
    public int $year = 0;

    public function mount(): void
    {
        if ($this->year === 0) {
            $this->year = now()->year;
        }
    }

    public function previousYear(): void
    {
        $this->year--;
    }

    public function nextYear(): void
    {
        $this->year++;
    }

    public function getMonthlyDataProperty(): array
    {
        $months = [];

        for ($m = 1; $m <= 12; $m++) {
            $start = Carbon::create($this->year, $m, 1)->startOfMonth();
            $end = $start->copy()->endOfMonth();

            $orderIncome = Order::whereBetween('created_at', [$start, $end])
                ->whereNotIn('status', ['cancelled'])
                ->sum('total');

            $otherIncome = Income::whereBetween('date', [$start, $end])
                ->sum('amount');

            $expenses = Expense::whereBetween('date', [$start, $end])
                ->sum('amount');

            $months[] = [
                'month' => $start->format('M'),
                'month_full' => $start->format('F'),
                'order_income' => (float) $orderIncome,
                'other_income' => (float) $otherIncome,
                'total_income' => (float) $orderIncome + (float) $otherIncome,
                'expenses' => (float) $expenses,
                'profit' => (float) $orderIncome + (float) $otherIncome - (float) $expenses,
            ];
        }

        return $months;
    }

    public function getYearTotalsProperty(): array
    {
        $start = Carbon::create($this->year, 1, 1)->startOfYear();
        $end = $start->copy()->endOfYear();

        $orderIncome = (float) Order::whereBetween('created_at', [$start, $end])
            ->whereNotIn('status', ['cancelled'])
            ->sum('total');

        $otherIncome = (float) Income::whereBetween('date', [$start, $end])
            ->sum('amount');

        $expenses = (float) Expense::whereBetween('date', [$start, $end])
            ->sum('amount');

        return [
            'order_income' => $orderIncome,
            'other_income' => $otherIncome,
            'total_income' => $orderIncome + $otherIncome,
            'expenses' => $expenses,
            'profit' => $orderIncome + $otherIncome - $expenses,
        ];
    }

    public function getExpenseByCategoryProperty(): array
    {
        $start = Carbon::create($this->year, 1, 1)->startOfYear();
        $end = $start->copy()->endOfYear();

        return Expense::whereBetween('date', [$start, $end])
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($row) => [
                'category' => $row->category,
                'label' => Expense::CATEGORIES[$row->category] ?? ucfirst($row->category),
                'total' => (float) $row->total,
            ])
            ->toArray();
    }

    public function getCogsProperty(): float
    {
        $start = Carbon::create($this->year, 1, 1)->startOfYear();
        $end = $start->copy()->endOfYear();

        return (float) Expense::whereBetween('date', [$start, $end])
            ->whereIn('category', Expense::TAX_GROUPS['cogs'])
            ->sum('amount');
    }
}
