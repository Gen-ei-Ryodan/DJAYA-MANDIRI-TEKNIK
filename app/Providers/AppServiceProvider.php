<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\SeoMeta;
use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function ($app) {
            return new SettingService();
        });
    }

    public function boot(): void
    {
        // Share settings globally for all views (used in layout)
        View::composer('*', function ($view) {
            $view->with('settings', app(SettingService::class));
        });
    }
}
