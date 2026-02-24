<?php

namespace App\Filament\Pages;

use App\Models\Order;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;

class OrderCalendar extends Page
{
    protected string $view = 'filament.pages.order-calendar';

    protected static ?string $title = 'Order Calendar';

    protected static ?string $navigationLabel = 'Order Calendar';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-calendar-days';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getUrl() => 'Order Calendar',
        ];
    }

    #[Url]
    public int $month = 0;

    #[Url]
    public int $year = 0;

    public function mount(): void
    {
        if ($this->month === 0) {
            $this->month = (int) now()->format('m');
        }
        if ($this->year === 0) {
            $this->year = (int) now()->format('Y');
        }
    }

    public function previousMonth(): void
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->month = (int) $date->format('m');
        $this->year = (int) $date->format('Y');
    }

    public function nextMonth(): void
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->month = (int) $date->format('m');
        $this->year = (int) $date->format('Y');
    }

    public function getCalendarDataProperty(): array
    {
        $start = Carbon::createFromDate($this->year, $this->month, 1);
        $end = $start->copy()->endOfMonth();

        $orders = Order::whereBetween('requested_date', [$start, $end])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE(requested_date) as date, COUNT(*) as count, SUM(total) as revenue')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $startDayOfWeek = $start->dayOfWeek; // 0=Sun
        $daysInMonth = $start->daysInMonth;

        $weeks = [];
        $day = 1;
        $week = array_fill(0, 7, null);

        // Fill first week
        for ($i = $startDayOfWeek; $i < 7 && $day <= $daysInMonth; $i++) {
            $dateStr = sprintf('%04d-%02d-%02d', $this->year, $this->month, $day);
            $orderData = $orders->get($dateStr);
            $week[$i] = [
                'day' => $day,
                'date' => $dateStr,
                'count' => $orderData?->count ?? 0,
                'revenue' => $orderData?->revenue ?? 0,
            ];
            $day++;
        }
        $weeks[] = $week;

        // Fill remaining weeks
        while ($day <= $daysInMonth) {
            $week = array_fill(0, 7, null);
            for ($i = 0; $i < 7 && $day <= $daysInMonth; $i++) {
                $dateStr = sprintf('%04d-%02d-%02d', $this->year, $this->month, $day);
                $orderData = $orders->get($dateStr);
                $week[$i] = [
                    'day' => $day,
                    'date' => $dateStr,
                    'count' => $orderData?->count ?? 0,
                    'revenue' => $orderData?->revenue ?? 0,
                ];
                $day++;
            }
            $weeks[] = $week;
        }

        return $weeks;
    }

    public function getMonthLabelProperty(): string
    {
        return Carbon::createFromDate($this->year, $this->month, 1)->format('F Y');
    }

    public function getOrdersUrlForDate(string $date): string
    {
        return route('filament.admin.resources.orders.index', [
            'tableFilters' => ['requested_date' => ['date' => $date]],
        ]);
    }
}
