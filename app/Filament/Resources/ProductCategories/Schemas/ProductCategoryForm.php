<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Nama kategori ini sudah digunakan. Silakan gunakan nama lain.',
                    ])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state, ?ProductCategory $record) =>
                        $set('slug', static::uniqueSlug($state, $record))
                    ),
                TextInput::make('slug')
                    ->readOnly()
                    ->helperText('Slug dibuat otomatis dari nama kategori.')
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Slug sudah digunakan, sistem akan menambahkan akhiran angka.',
                    ]),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('product-categories')
                    ->disk('public'),
            ]);
    }

    protected static function uniqueSlug(?string $name, ?ProductCategory $record): string
    {
        $base = Str::slug($name ?? '');

        if ($base === '') {
            return '';
        }

        $slug = $base;
        $i = 2;

        while (ProductCategory::query()
            ->where('slug', $slug)
            ->when($record?->getKey(), fn ($query, $id) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}