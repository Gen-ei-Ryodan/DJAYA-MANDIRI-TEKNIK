<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\SeoService;
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
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'related'));
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
