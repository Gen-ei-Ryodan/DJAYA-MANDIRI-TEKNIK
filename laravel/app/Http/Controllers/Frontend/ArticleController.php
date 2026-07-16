<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\SeoService;
use App\Services\SettingService;
use Illuminate\Support\Str;
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
        $settings = app(SettingService::class);
        $latest = Article::published()
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $metaTitle = ($article->seo_title ?? $article->title) . ' | ' . $settings->getCompanyName();
        $metaDescription = $article->seo_description ?? Str::limit(strip_tags($article->excerpt ?? $article->content), 160);
        $ogImage = $article->thumbnail ? asset('storage/' . $article->thumbnail) : $settings->getLogo();
        $ogType = 'article';

        $breadcrumbSchema = json_encode([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Artikel', 'item' => route('articles')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $article->title, 'item' => url()->current()],
        ]);

        $articleDate = $article->published_at ? $article->published_at->toIso8601String() : now()->toIso8601String();
        $pageSchema = '<script type="application/ld+json">' . json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => Str::limit(strip_tags($article->excerpt ?? $article->content), 300),
            'image' => $article->thumbnail ? asset('storage/' . $article->thumbnail) : $settings->getLogo(),
            'datePublished' => $articleDate,
            'dateModified' => $article->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => $settings->getCompanyName(),
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

        return view('frontend.articles.show', compact(
            'article', 'latest',
            'metaTitle', 'metaDescription', 'ogImage', 'ogType',
            'breadcrumbSchema', 'pageSchema'
        ));
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
