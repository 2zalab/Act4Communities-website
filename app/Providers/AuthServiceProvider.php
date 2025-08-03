<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
   public function boot()
    {
        $this->registerPolicies();

        // Définir les gates pour l'administration
        Gate::define('access-admin', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        Gate::define('manage-users', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-settings', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
