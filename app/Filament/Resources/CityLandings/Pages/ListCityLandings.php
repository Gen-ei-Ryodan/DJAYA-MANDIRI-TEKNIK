<?php

namespace App\Filament\Resources\CityLandings\Pages;

use App\Filament\Resources\CityLandings\CityLandingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCityLandings extends ListRecords
{
    protected static string $resource = CityLandingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}