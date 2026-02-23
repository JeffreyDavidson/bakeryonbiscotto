<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CapacityLimit extends Model
{
    protected $fillable = [
        'day_of_week',
        'specific_date',
        'max_orders',
        'is_blocked',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'specific_date' => 'date',
            'is_blocked' => 'boolean',
            'day_of_week' => 'integer',
            'max_orders' => 'integer',
        ];
    }

    /**
     * Get the capacity limit for a given date (specific date takes priority over day-of-week).
     */
    public static function forDate(Carbon|string $date): ?self
    {
        $date = Carbon::parse($date);

        // Specific date override takes priority
        $specific = static::whereDate('specific_date', $date)->first();
        if ($specific) {
            return $specific;
        }

        // Fall back to recurring day-of-week (0=Monday ... 6=Sunday, matching Carbon->dayOfWeekIso - 1)
        return static::where('day_of_week', $date->dayOfWeekIso - 1)->first();
    }

    /**
     * Check if a date is available for orders.
     */
    public static function isAvailable(Carbon|string $date): bool
    {
        $limit = static::forDate($date);

        if (!$limit) {
            return true; // No limit set = open
        }

        if ($limit->is_blocked) {
            return false;
        }

        if ($limit->max_orders <= 0) {
            return true; // 0 means unlimited when not blocked
        }

        return static::ordersOnDate($date) < $limit->max_orders;
    }

    /**
     * Get remaining order slots for a date.
     */
    public static function remainingSlots(Carbon|string $date): int
    {
        $limit = static::forDate($date);

        if (!$limit) {
            return PHP_INT_MAX; // No limit
        }

        if ($limit->is_blocked) {
            return 0;
        }

        if ($limit->max_orders <= 0) {
            return PHP_INT_MAX;
        }

        return max(0, $limit->max_orders - static::ordersOnDate($date));
    }

    /**
     * Count non-cancelled orders on a given date.
     */
    protected static function ordersOnDate(Carbon|string $date): int
    {
        return Order::whereDate('requested_date', Carbon::parse($date))
            ->where('status', '!=', 'cancelled')
            ->count();
    }

    /**
     * Get capacity usage percentage for a date (null if no limit set).
     */
    public static function usagePercent(Carbon|string $date): ?float
    {
        $limit = static::forDate($date);

        if (!$limit || $limit->max_orders <= 0) {
            return null;
        }

        if ($limit->is_blocked) {
            return 100.0;
        }

        return min(100, (static::ordersOnDate($date) / $limit->max_orders) * 100);
    }
}
