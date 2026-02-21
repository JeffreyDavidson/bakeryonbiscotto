<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price',
        'image', 'is_available', 'is_featured', 'sort_order',
        'max_per_order', 'weekly_limit',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        // Support both storage uploads and direct public paths
        if (str_starts_with($this->image, 'images/') || str_starts_with($this->image, '/images/')) {
            return asset(ltrim($this->image, '/'));
        }

        return asset('storage/' . $this->image);
    }
}
