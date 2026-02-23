<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CustomerNote extends Model
{
    protected $fillable = [
        'customer_email',
        'customer_name',
        'note',
        'is_important',
        'created_by',
    ];

    protected $casts = [
        'is_important' => 'boolean',
    ];

    public function scopeImportant(Builder $query): Builder
    {
        return $query->where('is_important', true);
    }

    public function scopeForCustomer(Builder $query, string $email): Builder
    {
        return $query->where('customer_email', $email);
    }
}
