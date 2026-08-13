<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
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
                    ->afterStateUpdated(fn (Set $set, ?string $state, ?Project $record) =>
                        $set('slug', static::uniqueSlug($state, $record))
                    ),
                TextInput::make('slug')
                    ->readOnly()
                    ->helperText('Slug dibuat otomatis dari judul project.'),
                FileUpload::make('thumbnail')
                    ->label('Foto')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->imageEditor()
                    ->directory('projects')
                    ->disk('public')
                    ->columnSpanFull(),
                TextInput::make('location')
                    ->label('Lokasi'),
                TextInput::make('year')
                    ->label('Tahun'),
                TextInput::make('client')
                    ->label('Klien'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Toggle::make('featured')
                    ->label('Project Unggulan')
                    ->required(),
            ]);
    }

    protected static function uniqueSlug(?string $title, ?Project $record): string
    {
        $base = Str::slug($title ?? '');

        if ($base === '') {
            return '';
        }

        $slug = $base;
        $i = 2;

        while (Project::query()
            ->where('slug', $slug)
            ->when($record?->getKey(), fn ($query, $id) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}