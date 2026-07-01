<?php

namespace App\Filament\Resources\SeoMetas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SeoMetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page')
                    ->required(),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')
                    ->columnSpanFull(),
                TextInput::make('keywords'),
                TextInput::make('og_title'),
                Textarea::make('og_description')
                    ->columnSpanFull(),
                FileUpload::make('og_image')
                    ->image()
                    ->directory('seo-metas')
                    ->disk('public'),
                TextInput::make('twitter_card')
                    ->required()
                    ->default('summary_large_image'),
                TextInput::make('canonical_url')
                    ->label('Canonical URL')
                    ->placeholder(url('/') . '/halaman')
                    ->columnSpanFull(),
                Select::make('robots')
                    ->label('Robots Meta')
                    ->options([
                        'index,follow' => 'index, follow',
                        'noindex,follow' => 'noindex, follow',
                        'index,nofollow' => 'index, nofollow',
                        'noindex,nofollow' => 'noindex, nofollow',
                    ])
                    ->default('index,follow'),
            ]);
    }
}
