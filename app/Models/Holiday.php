<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'name',
        'date',
        'order_deadline',
        'prep_start',
        'max_orders',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'order_deadline' => 'date',
            'prep_start' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('date', '>=', Carbon::today())->orderBy('date');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function daysUntilDeadline(): int
    {
        return (int) Carbon::today()->diffInDays($this->order_deadline, false);
    }

    public function isDeadlinePassed(): bool
    {
        return $this->order_deadline->isPast();
    }

    public function orderCount(): int
    {
        return Order::whereDate('requested_date', $this->date)->count();
    }

    /**
     * Find a holiday on or near a given date (within $days).
     */
    public static function nearDate(Carbon $date, int $days = 2): ?self
    {
        return static::active()
            ->whereBetween('date', [
                $date->copy()->subDays($days),
                $date->copy()->addDays($days),
            ])
            ->first();
    }
}
