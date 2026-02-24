<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeIngredient extends Model
{
    protected $fillable = ['recipe_id', 'name', 'quantity', 'unit', 'cost_per_unit'];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:4',
            'cost_per_unit' => 'decimal:2',
        ];
    }

    public const UNITS = [
        'oz' => 'oz',
        'lb' => 'lb',
        'cup' => 'cup',
        'tbsp' => 'tbsp',
        'tsp' => 'tsp',
        'each' => 'each',
        'g' => 'g',
        'kg' => 'kg',
        'ml' => 'ml',
        'l' => 'l',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
