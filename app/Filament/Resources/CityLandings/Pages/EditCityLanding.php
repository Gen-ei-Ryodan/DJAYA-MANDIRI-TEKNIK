<?php

namespace App\Filament\Resources\CityLandings\Pages;

use App\Filament\Resources\CityLandings\CityLandingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCityLanding extends EditRecord
{
    protected static string $resource = CityLandingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}