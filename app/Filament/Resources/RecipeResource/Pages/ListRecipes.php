<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->modalWidth('2xl'),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            static::getResource()::getUrl() => 'Recipes',
        ];
    }
}
