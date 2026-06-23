<?php

namespace App\Services;

use App\Models\SeoMeta;

class SeoService
{
    public function getMeta(string $page): ?SeoMeta
    {
        return cache()->rememberForever("seo.{$page}", function () use ($page) {
            return SeoMeta::where('page', $page)->first();
        });
    }

    public function getTitle(string $page, string $default): string
    {
        $meta = $this->getMeta($page);
        return $meta?->meta_title ?: $default;
    }

    public function getDescription(string $page, string $default): string
    {
        $meta = $this->getMeta($page);
        return $meta?->meta_description ?: $default;
    }
}
