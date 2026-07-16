<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityLanding;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CityLandingController extends Controller
{
    public function show(string $citySlug): View
    {
        $city = City::where('slug', $citySlug)->firstOrFail();
        $settings = app(SettingService::class);
        $cityName = $city->type . ' ' . $city->name;

        $landing = CityLanding::where('city_id', $city->id)
            ->where('is_active', true)
            ->first();

        $services = Service::where('is_active', true)->orderBy('order')->get();

        $products = cache()->remember("city.products.{$city->id}", 3600, fn () =>
            Product::where('featured', true)->orderBy('order')->take(6)->get()
        );

        $projects = cache()->remember("city.projects.{$city->id}", 3600, fn () =>
            Project::where('featured', true)
                ->when($city->name, fn ($q) => $q->where('location', 'like', "%{$city->name}%"))
                ->latest()
                ->take(4)
                ->get()
        );

        $metaTitle = $landing?->title
            ?? "Penangkal Petir {$cityName} | {$settings->getCompanyName()}";
        $metaDescription = $landing?->description
            ?? "Jasa pemasangan penangkal petir di {$cityName}, Jawa Timur. Konsultasi gratis! Teknisi profesional, material berkualitas SNI.";
        $canonicalUrl = route('city.landing', $citySlug);

        $breadcrumbSchema = json_encode([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => "Penangkal Petir {$cityName}", 'item' => $canonicalUrl],
        ]);

        $pageSchema = '<script type="application/ld+json">' . json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => "Jasa Penangkal Petir {$cityName}",
            'description' => Str::limit(strip_tags($metaDescription), 300),
            'provider' => ['@type' => 'Organization', 'name' => $settings->getCompanyName()],
            'areaServed' => ['@type' => 'City', 'name' => $city->name, 'sameAs' => "https://id.wikipedia.org/wiki/{$city->name}"],
            'address' => ['@type' => 'PostalAddress', 'addressLocality' => $city->name, 'addressRegion' => 'Jawa Timur', 'addressCountry' => 'ID'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

        return view('frontend.city.landing', compact(
            'city', 'landing', 'services', 'products', 'projects',
            'metaTitle', 'metaDescription', 'canonicalUrl',
            'breadcrumbSchema', 'pageSchema'
        ));
    }
}