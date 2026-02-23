<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'description', 'vendor', 'amount', 'date',
        'receipt', 'notes', 'is_recurring', 'recurring_frequency',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
            'is_recurring' => 'boolean',
        ];
    }

    public const CATEGORIES = [
        'ingredients' => 'Ingredients (COGS)',
        'packaging' => 'Packaging & Supplies (COGS)',
        'equipment' => 'Equipment',
        'delivery_gas' => 'Delivery & Gas',
        'marketing' => 'Marketing & Advertising',
        'licenses_permits' => 'Licenses & Permits',
        'utilities' => 'Utilities (Kitchen)',
        'supplies' => 'Office & General Supplies',
        'other' => 'Other',
    ];

    // Tax groupings for Schedule C
    public const TAX_GROUPS = [
        'cogs' => ['ingredients', 'packaging'],
        'car_truck' => ['delivery_gas'],
        'advertising' => ['marketing'],
        'legal_professional' => ['licenses_permits'],
        'utilities' => ['utilities'],
        'other' => ['equipment', 'supplies', 'other'],
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
