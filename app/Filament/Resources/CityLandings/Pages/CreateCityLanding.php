<?php

namespace App\Filament\Resources\CityLandings\Pages;

use App\Filament\Resources\CityLandings\CityLandingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCityLanding extends CreateRecord
{
    protected static string $resource = CityLandingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}