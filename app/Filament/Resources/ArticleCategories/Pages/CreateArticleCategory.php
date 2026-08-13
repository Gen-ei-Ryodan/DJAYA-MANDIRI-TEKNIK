<?php

namespace App\Filament\Resources\ArticleCategories\Pages;

use App\Filament\Resources\ArticleCategories\ArticleCategoryResource;
use App\Models\ArticleCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateArticleCategory extends CreateRecord
{
    protected static string $resource = ArticleCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['order'] = (ArticleCategory::max('order') ?? 0) + 1;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
