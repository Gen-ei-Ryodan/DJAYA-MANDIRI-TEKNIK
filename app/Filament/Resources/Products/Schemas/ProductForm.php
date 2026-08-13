<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih kategori'),
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state, ?Product $record) =>
                        $set('slug', static::uniqueSlug($state, $record))
                    ),
                TextInput::make('slug')
                    ->readOnly()
                    ->helperText('Slug dibuat otomatis dari nama produk.'),
                FileUpload::make('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->directory('products')
                    ->disk('public'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Textarea::make('specification')
                    ->label('Spesifikasi')
                    ->columnSpanFull(),
                Toggle::make('featured')
                    ->label('Produk Unggulan')
                    ->required(),
            ]);
    }

    protected static function uniqueSlug(?string $name, ?Product $record): string
    {
        $base = Str::slug($name ?? '');

        if ($base === '') {
            return '';
        }

        $slug = $base;
        $i = 2;

        while (Product::query()
            ->where('slug', $slug)
            ->when($record?->getKey(), fn ($query, $id) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}