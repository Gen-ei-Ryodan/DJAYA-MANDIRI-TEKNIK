<?php

namespace App\Services;

use App\Models\Article;
use App\Models\City;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Collection;

class InternalLinkingService
{
    /**
     * Get all active city links for landing pages.
     */
    public function getCityLinks(): Collection
    {
        return cache()->remember('internal_links.cities', 3600, fn () =>
            City::orderBy('type')->orderBy('name')->get()->map(fn ($city) => [
                'label' => $city->type . ' ' . $city->name,
                'slug' => $city->slug,
                'url' => route('city.landing', $city->slug),
            ])
        );
    }

    /**
     * Get related city landing pages (excluding current).
     */
    public function getRelatedCities(string $currentSlug, int $limit = 8): Collection
    {
        return $this->getCityLinks()
            ->where('slug', '!=', $currentSlug)
            ->take($limit);
    }

    /**
     * Get major cities (Kota type only) for navbar/footer.
     */
    public function getMajorCities(int $limit = 5): Collection
    {
        return cache()->remember('internal_links.major_cities', 3600, fn () =>
            City::where('type', 'Kota')
                ->orderBy('name')
                ->take($limit)
                ->get()
                ->map(fn ($city) => [
                    'label' => 'Penangkal Petir ' . $city->name,
                    'slug' => $city->slug,
                    'url' => route('city.landing', $city->slug),
                ])
        );
    }

    /**
     * Get related articles by category.
     */
    public function getRelatedArticles(?int $categoryId, int $excludeId, int $limit = 3): Collection
    {
        return Article::published()
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->where('id', '!=', $excludeId)
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    /**
     * Get related projects matching a city name.
     */
    public function getCityProjects(string $cityName, int $limit = 3): Collection
    {
        return Project::where('featured', true)
            ->where('location', 'like', "%{$cityName}%")
            ->latest()
            ->take($limit)
            ->get();
    }
}