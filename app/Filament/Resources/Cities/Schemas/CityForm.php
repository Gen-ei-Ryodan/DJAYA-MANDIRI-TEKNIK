<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->label('Provinsi')
                    ->relationship('province', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Kota')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'Kota' => 'Kota',
                        'Kabupaten' => 'Kabupaten',
                    ])
                    ->required(),
                TextInput::make('meta_title')
                    ->label('SEO Title')
                    ->placeholder('Penangkal Petir Surabaya | DJAYA MANDIRI TEKNIK')
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->label('SEO Description')
                    ->placeholder('Jasa penangkal petir di Surabaya...')
                    ->columnSpanFull(),
                TextInput::make('meta_keywords')
                    ->label('SEO Keywords')
                    ->placeholder('penangkal petir surabaya, jasa penangkal petir surabaya')
                    ->columnSpanFull(),
            ]);
    }
}