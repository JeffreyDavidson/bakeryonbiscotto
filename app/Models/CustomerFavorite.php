<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerFavorite extends Model
{
    protected $fillable = ['customer_email', 'product_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function scopeForCustomer($query, string $email)
    {
        return $query->where('customer_email', $email);
    }
}
