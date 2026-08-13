<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
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
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state, ?Article $record) =>
                        $set('slug', static::uniqueSlug($state, $record))
                    ),
                TextInput::make('slug')
                    ->readOnly()
                    ->helperText('Slug dibuat otomatis dari judul artikel.'),
                FileUpload::make('thumbnail')
                    ->label('Photo')
                    ->image()
                    ->imageEditor()
                    ->directory('articles')
                    ->disk('public'),
                Textarea::make('content')
                    ->label('Isi Artikel')
                    ->rows(15)
                    ->columnSpanFull(),
            ]);
    }

    protected static function uniqueSlug(?string $title, ?Article $record): string
    {
        $base = Str::slug($title ?? '');

        if ($base === '') {
            return '';
        }

        $slug = $base;
        $i = 2;

        while (Article::query()
            ->where('slug', $slug)
            ->when($record?->getKey(), fn ($query, $id) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}