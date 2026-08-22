<?php

namespace App\Providers;

use App\Models\ContactSetting;
use App\Models\Service;
use Illuminate\Pagination\Paginator;
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

        // Render every ->links() call with this project's own paginator markup.
        //
        // Laravel's built-in default is Tailwind-based and this project ships no
        // Tailwind, so admin views calling ->links() with no argument produced
        // unstyled markup whose inline chevron SVGs had no width/height rule and
        // blew up to full size. The frontend already passed this view explicitly;
        // making it the default fixes all 22 admin index/trash pages at once,
        // without editing each one.
        //
        // defaultSimpleView is deliberately left alone: the devmantra view reads
        // $elements, which a simple paginator does not provide. Nothing in this
        // app uses simplePaginate() today — if that changes, that view needs its
        // own template rather than this one.
        Paginator::defaultView('vendor.pagination.devmantra');

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
