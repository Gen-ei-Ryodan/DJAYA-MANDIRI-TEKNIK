<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('background_video'),
                FileUpload::make('background_image')
                    ->image()
                    ->directory('hero')
                    ->disk('public'),
                Textarea::make('statistics')
                    ->columnSpanFull(),
                TextInput::make('button1_text')
                    ->required()
                    ->default('Konsultasi Sekarang'),
                TextInput::make('button1_url')
                    ->required()
                    ->default(url('#contact')),
                TextInput::make('button2_text')
                    ->required()
                    ->default('Lihat Project'),
                TextInput::make('button2_url')
                    ->required()
                    ->default('#projects'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
