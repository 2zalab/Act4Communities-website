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
                'phones' => ['+237 694813985'],
                'office' => '+237 682487583',
                'email' => 'contact@act4communities.org',
                'address' => 'Garoua / Marouaré, Cameroun',
                'social' => [
                    'facebook' => 'https://web.facebook.com/act4communities',
                    'linkedin' => 'https://www.linkedin.com/in/action-pour-le-d%C3%A9veloppement-communautaire-295545210/',
                    'twitter' => 'https://x.com/ActionLe654',
                    'instagral'=>'https://www.instagram.com/actforcommunities/',
                ]
            ];

            $view->with('contactInfo', $contactInfo);
        });
    }
}
