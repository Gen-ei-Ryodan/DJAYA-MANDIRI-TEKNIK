<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\SeoService;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contact = Contact::where('is_active', true)->latest()->first();
        $seo = app(SeoService::class)->getMeta('contact');

        return view('frontend.contact', compact('contact', 'seo'));
    }
}
