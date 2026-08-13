<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\SeoMeta;
use App\Services\SettingService;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Make the public storage disk resolve URLs from the current request host,
        // so storage links follow the host/port the site is actually served on.
        if (! $this->app->runningInConsole()) {
            config()->set('filesystems.disks.public.url', url('/storage'));
        }

        // Share settings globally for all views (used in layout)
        View::composer('*', function ($view) {
            $view->with('settings', app(SettingService::class));
        });
    }
}
