<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\SeoService;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::published()
            ->latest('published_at')
            ->paginate(9);

        $categories = ArticleCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('articles');

        return view('frontend.articles.index', compact('articles', 'categories', 'seo'));
    }

    public function show(string $slug): View
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();
        $latest = Article::published()
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.articles.show', compact('article', 'latest'));
    }

    public function category(string $slug): View
    {
        $category = ArticleCategory::where('slug', $slug)->firstOrFail();
        $articles = Article::published()
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        $categories = ArticleCategory::orderBy('order')->get();
        $seo = app(SeoService::class)->getMeta('articles');

        return view('frontend.articles.index', compact('articles', 'category', 'categories', 'seo'));
    }
}
