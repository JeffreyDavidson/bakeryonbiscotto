<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WaitlistEntry extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'requested_date',
        'product_interest',
        'notes',
        'status',
        'notified_at',
    ];

    protected function casts(): array
    {
        return [
            'requested_date' => 'date',
            'notified_at' => 'datetime',
        ];
    }

    // Scopes

    public function scopeWaiting(Builder $query): Builder
    {
        return $query->where('status', 'waiting');
    }

    public function scopeForDate(Builder $query, Carbon|string $date): Builder
    {
        return $query->whereDate('requested_date', Carbon::parse($date));
    }

    // Methods

    public function markNotified(): void
    {
        $this->update([
            'status' => 'notified',
            'notified_at' => now(),
        ]);
    }

    public function markConverted(): void
    {
        $this->update([
            'status' => 'converted',
        ]);
    }
}
