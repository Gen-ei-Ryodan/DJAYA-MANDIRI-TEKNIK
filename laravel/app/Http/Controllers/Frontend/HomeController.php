<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Article;
use App\Models\Contact;
use App\Models\HeroSection;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = cache()->remember('home.hero', 3600, fn () =>
            HeroSection::where('is_active', true)->latest()->first()
        );

        $about = cache()->remember('home.about', 3600, fn () =>
            AboutSection::where('is_active', true)->latest()->first()
        );

        $services = cache()->remember('home.services', 3600, fn () =>
            Service::where('is_active', true)->orderBy('order')->get()
        );

        $whyChooseUs = cache()->remember('home.why_choose_us', 3600, fn () =>
            WhyChooseUs::orderBy('order')->get()
        );

        $products = cache()->remember('home.featured_products', 3600, fn () =>
            Product::where('featured', true)->orderBy('order')->take(8)->get()
        );

        $projects = cache()->remember('home.featured_projects', 3600, fn () =>
            Project::where('featured', true)->latest()->take(6)->get()
        );

        $articles = cache()->remember('home.latest_articles', 3600, fn () =>
            Article::published()->latest('published_at')->take(3)->get()
        );

        $testimonials = cache()->remember('home.testimonials', 3600, fn () =>
            Testimonial::where('is_active', true)->orderBy('order')->get()
        );

        $contact = cache()->remember('home.contact', 3600, fn () =>
            Contact::where('is_active', true)->latest()->first()
        );

        $seo = app(SeoService::class)->getMeta('home');
        $settings = app(SettingService::class);

        return view('frontend.home', compact(
            'hero', 'about', 'services', 'whyChooseUs',
            'products', 'projects', 'articles', 'testimonials',
            'contact', 'seo', 'settings'
        ));
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:5000',
        ]);

        \App\Models\Message::create($validated);

        // Redirect to WhatsApp
        $whatsapp = app(SettingService::class)->getWhatsApp();
        $text = urlencode("Halo, saya {$validated['name']} ingin konsultasi mengenai penangkal petir.\n\nPesan: {$validated['message']}");

        return redirect()->away("https://wa.me/{$whatsapp}?text={$text}");
    }
}
