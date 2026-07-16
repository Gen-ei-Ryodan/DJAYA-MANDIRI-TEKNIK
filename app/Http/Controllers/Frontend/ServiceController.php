<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('services');

        return view('frontend.services.index', compact('services', 'seo'));
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $seo = app(SeoService::class)->getMeta('services');
        $settings = app(\App\Services\SettingService::class);

        // Ambil layanan terkait (lainnya)
        $related = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $metaTitle = $service->title . ' | ' . $settings->getCompanyName();
        $metaDescription = Str::limit(strip_tags($service->description), 160);

        $breadcrumbSchema = json_encode([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan', 'item' => route('services')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $service->title, 'item' => url()->current()],
        ]);

        $pageSchema = '<script type="application/ld+json">' . json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service->title,
            'description' => Str::limit(strip_tags($service->description), 300),
            'provider' => [
                '@type' => 'Organization',
                'name' => $settings->getCompanyName(),
            ],
            'areaServed' => 'Jawa Timur',
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

        return view('frontend.services.show', compact(
            'service', 'seo', 'related',
            'metaTitle', 'metaDescription', 'breadcrumbSchema', 'pageSchema'
        ));
    }
}
