<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeStage extends Model
{
    protected $fillable = [
        'recipe_id', 'name', 'hours_before', 'duration_minutes',
        'instructions', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'hours_before' => 'decimal:1',
            'duration_minutes' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
