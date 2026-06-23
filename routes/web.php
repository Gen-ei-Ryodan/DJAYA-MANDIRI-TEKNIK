<?php

use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'storeMessage'])->name('contact.send');

// Services
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Products
Route::get('/produk', [ProductController::class, 'index'])->name('products');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/kategori-produk/{slug}', [ProductController::class, 'category'])->name('products.category');

// Projects
Route::get('/project', [ProjectController::class, 'index'])->name('projects');
Route::get('/project/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/kategori-project/{slug}', [ProjectController::class, 'category'])->name('projects.category');

// Articles
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kategori-artikel/{slug}', [ArticleController::class, 'category'])->name('articles.category');

// Contact
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
});
