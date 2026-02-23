<?php

namespace App\Filament\Resources\CapacityLimitResource\Pages;

use App\Filament\Resources\CapacityLimitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCapacityLimits extends ListRecords
{
    protected static string $resource = CapacityLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->modalWidth('2xl'),
        ];
    }
}
