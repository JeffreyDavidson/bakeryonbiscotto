<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CustomerProfile extends Model
{
    protected $fillable = ['email', 'name', 'birthday', 'birthday_reminder_sent_at'];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'birthday_reminder_sent_at' => 'datetime',
        ];
    }

    public function scopeHasBirthday(Builder $query): Builder
    {
        return $query->whereNotNull('birthday');
    }

    public function scopeBirthdayToday(Builder $query): Builder
    {
        return $query->whereNotNull('birthday')
            ->whereMonth('birthday', now()->month)
            ->whereDay('birthday', now()->day);
    }

    public function scopeBirthdayThisMonth(Builder $query): Builder
    {
        return $query->whereNotNull('birthday')
            ->whereMonth('birthday', now()->month);
    }
}
