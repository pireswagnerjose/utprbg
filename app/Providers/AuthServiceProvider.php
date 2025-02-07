<?php

namespace App\Providers;

use App\Models\User;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     * 1 - ADMINISTRADOR
     * 2 - CARTORIO_ADMIN
     * 3 - CARTORIO_USER
     * 4 - ESCOLTA
     * 5 - PAD
     * 6 - USUARIO
     * 7 - RECEPCAO
     * 8 - SAUDE
     */
    public function boot(): void
    {
        Gate::before(function (User $user, $ability) {
            if ($user->abilities()->contains($ability)) {
                return true;
            }
        });
    }
}
