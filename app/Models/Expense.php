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
        'packaging' => 'Packaging & Labels (COGS)',
        'equipment' => 'Equipment',
        'delivery_gas' => 'Delivery & Gas',
        'marketing' => 'Marketing & Advertising',
        'booth_fees' => 'Farmers Market Booth Fees',
        'education' => 'Classes & Education',
        'supplies' => 'General Supplies',
        'other' => 'Other',
    ];

    // Tax groupings for Schedule C
    public const TAX_GROUPS = [
        'cogs' => ['ingredients', 'packaging'],
        'car_truck' => ['delivery_gas'],
        'advertising' => ['marketing'],
        'other_deductions' => ['booth_fees', 'education'],
        'other' => ['equipment', 'supplies', 'other'],
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
