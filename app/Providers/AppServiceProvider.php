<?php

namespace App\Providers;

use App\Models\ContactSetting;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        // Share navigation services with header (cached 10 min, cleared by admin on save)
        View::composer('frontend.partials.header', function ($view) {
            $navServices = Cache::remember('nav.services', 600, function () {
                return Service::published()->orderBy('sort_order')->get();
            });
            $view->with('navServices', $navServices);
        });

        // Share footer services + contact settings (cached 10 min)
        View::composer('frontend.partials.footer', function ($view) {
            $footerServices = Cache::remember('footer.services', 600, function () {
                return Service::published()->orderBy('sort_order')->take(5)->get();
            });
            $footerContact = Cache::remember('footer.contact', 600, function () {
                return ContactSetting::instance();
            });
            $view->with(compact('footerServices', 'footerContact'));
        });
    }
}
