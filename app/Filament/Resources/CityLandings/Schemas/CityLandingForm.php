<?php

namespace App\Filament\Resources\CityLandings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CityLandingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('city_id')
                    ->label('Kota')
                    ->relationship('city', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->label('Judul Halaman')
                    ->placeholder('Penangkal Petir Surabaya')
                    ->helperText('Judul yang ditampilkan di hero section'),
                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->placeholder('Solusi proteksi petir profesional...'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Konten Khusus')
                    ->helperText('Konten unik per kota, bisa dikosongkan')
                    ->columnSpanFull(),
                FileUpload::make('hero_image')
                    ->image()
                    ->directory('city-landings')
                    ->disk('public'),
                TextInput::make('cta_text')
                    ->label('Teks Tombol CTA')
                    ->default('Konsultasi Sekarang'),
                TextInput::make('cta_url')
                    ->label('URL Tombol CTA')
                    ->default('https://wa.me/6285704307095'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}