<?php

namespace App\Filament\Resources\CityLandings;

use App\Filament\Resources\CityLandings\Pages\CreateCityLanding;
use App\Filament\Resources\CityLandings\Pages\EditCityLanding;
use App\Filament\Resources\CityLandings\Pages\ListCityLandings;
use App\Filament\Resources\CityLandings\Schemas\CityLandingForm;
use App\Filament\Resources\CityLandings\Tables\CityLandingsTable;
use App\Models\CityLanding;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CityLandingResource extends Resource
{
    protected static ?string $model = CityLanding::class;

    protected static \BackedEnum|string|null $navigationIcon = Heroicon::OutlinedGlobeAsiaAustralia;

    protected static ?string $navigationLabel = 'Landing Page Kota';

    protected static \UnitEnum|string|null $navigationGroup = 'SEO & Konten';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CityLandingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CityLandingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCityLandings::route('/'),
            'create' => CreateCityLanding::route('/create'),
            'edit' => EditCityLanding::route('/{record}/edit'),
        ];
    }
}