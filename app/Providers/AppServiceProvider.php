<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Utiliser Bootstrap pour la pagination
        Paginator::useBootstrap();

        // Partager des données avec toutes les vues
        View::composer('*', function ($view) {
            $view->with([
                'appName' => config('app.name', 'Act for Communities'),
                'currentLocale' => app()->getLocale(),
                'availableLocales' => config('laravellocalization.supportedLocales'),
            ]);
        });

        // Partager les informations de contact
        View::composer(['frontend.layouts.app', 'frontend.partials.footer'], function ($view) {
            $contactInfo = [
                'phones' => ['+237 696 740 438', '+237 698 288 072'],
                'office' => '+237 222 271 205',
                'email' => 'contact@act4communities.org',
                'address' => 'Garoua / Marouaré, Cameroun',
                'social' => [
                    'facebook' => '#',
                    'linkedin' => '#',
                    'twitter' => '#',
                ]
            ];

            $view->with('contactInfo', $contactInfo);
        });
    }
}
