<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('order')->paginate(12);
        $categories = ProductCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('products');

        return view('frontend.products.index', compact('products', 'categories', 'seo'));
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $settings = app(SettingService::class);
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $metaTitle = ($product->seo_title ?? $product->name) . ' | ' . $settings->getCompanyName();
        $metaDescription = $product->seo_description ?? Str::limit(strip_tags($product->description), 160);
        $ogImage = $product->thumbnail ? asset('storage/' . $product->thumbnail) : $settings->getLogo();

        $breadcrumbSchema = json_encode([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Produk', 'item' => route('products')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $product->name, 'item' => url()->current()],
        ]);

        $pageSchema = '<script type="application/ld+json">' . json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => Str::limit(strip_tags($product->description), 300),
            'image' => $ogImage,
            'category' => $product->category->name ?? 'Penangkal Petir',
            'brand' => [
                '@type' => 'Brand',
                'name' => $settings->getCompanyName(),
            ],
            'offers' => [
                '@type' => 'Offer',
                'availability' => 'https://schema.org/InStock',
                'priceCurrency' => 'IDR',
                'url' => url()->current(),
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

        return view('frontend.products.show', compact(
            'product', 'related',
            'metaTitle', 'metaDescription', 'ogImage',
            'breadcrumbSchema', 'pageSchema'
        ));
    }

    public function category(string $slug): View
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->orderBy('order')
            ->paginate(12);

        $categories = ProductCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('products');

        return view('frontend.products.index', compact('products', 'category', 'categories', 'seo'));
    }
}
