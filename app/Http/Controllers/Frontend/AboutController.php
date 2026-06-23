<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Services\SeoService;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutSection::where('is_active', true)->latest()->first();
        $seo = app(SeoService::class)->getMeta('about');

        return view('frontend.about', compact('about', 'seo'));
    }
}
