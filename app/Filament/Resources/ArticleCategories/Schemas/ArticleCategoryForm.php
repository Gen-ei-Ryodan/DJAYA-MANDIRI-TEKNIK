<?php

namespace App\Filament\Resources\ArticleCategories\Schemas;

use App\Models\ArticleCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleCategoryForm
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
                    ->afterStateUpdated(fn (Set $set, ?string $state, ?ArticleCategory $record) =>
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
                TextInput::make('order')
                    ->hidden()
                    ->numeric()
                    ->default(fn () => (ArticleCategory::max('order') ?? 0) + 1),
            ]);
    }

    protected static function uniqueSlug(?string $name, ?ArticleCategory $record): string
    {
        $base = Str::slug($name ?? '');

        if ($base === '') {
            return '';
        }

        $slug = $base;
        $i = 2;

        while (ArticleCategory::query()
            ->where('slug', $slug)
            ->when($record?->getKey(), fn ($query, $id) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}