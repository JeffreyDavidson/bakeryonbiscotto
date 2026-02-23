<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    protected $fillable = [
        'product_id', 'name', 'description', 'servings', 'prep_time_minutes', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'servings' => 'integer',
            'prep_time_minutes' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function getTotalCostAttribute(): float
    {
        return (float) $this->ingredients->sum(fn ($i) => $i->quantity * $i->cost_per_unit);
    }

    public function getCostPerServingAttribute(): float
    {
        return $this->servings > 0 ? $this->total_cost / $this->servings : 0;
    }

    public function getProfitMarginAttribute(): ?float
    {
        if (!$this->product || !$this->product->price || $this->product->price == 0) {
            return null;
        }

        return ($this->product->price - $this->cost_per_serving) / $this->product->price * 100;
    }
}
