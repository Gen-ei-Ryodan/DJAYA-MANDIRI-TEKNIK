<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'produk' => 'Produk',
                        'layanan' => 'Layanan',
                        'pemasangan' => 'Pemasangan',
                        'perawatan' => 'Perawatan',
                        'harga' => 'Harga',
                        'umum' => 'Umum',
                    ]),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}