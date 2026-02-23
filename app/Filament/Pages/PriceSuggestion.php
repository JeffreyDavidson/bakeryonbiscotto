<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class PriceSuggestion extends Page
{
    protected string $view = 'filament.pages.price-suggestion';

    protected static ?string $title = 'Price Suggestion';

    protected static ?string $navigationLabel = 'Price Suggestion';

    protected static ?int $navigationSort = 5;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-calculator';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    public float $ingredientCost = 0;
    public float $laborMinutes = 0;
    public float $hourlyRate = 25;
    public float $packagingCost = 0;
    public float $margin = 50;
    public float $servings = 1;

    public function setMargin(float $value): void
    {
        $this->margin = $value;
    }

    public function getTotalCostProperty(): float
    {
        return $this->ingredientCost + ($this->laborMinutes / 60 * $this->hourlyRate) + $this->packagingCost;
    }

    public function getCostPerUnitProperty(): float
    {
        return $this->servings > 0 ? $this->totalCost / $this->servings : 0;
    }

    public function getSuggestedPriceProperty(): float
    {
        return $this->margin < 100 && $this->margin >= 0
            ? $this->costPerUnit / (1 - $this->margin / 100)
            : 0;
    }

    public function getProfitPerUnitProperty(): float
    {
        return $this->suggestedPrice - $this->costPerUnit;
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '' => 'Price Suggestion',
        ];
    }
}
