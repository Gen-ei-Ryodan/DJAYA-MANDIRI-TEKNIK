<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\SeoService;
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
        return view('frontend.services.show', compact('service'));
    }
}
