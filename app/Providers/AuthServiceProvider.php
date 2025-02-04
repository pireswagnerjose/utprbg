<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

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
        Gate::before(function ($user, $ability) {
            if ($user->abilities()->contains($ability)) {
                return true;
            }
        });

        
        // somente administrador pode acessar
        // Gate::define('admin', function (User $user) {
        //     if($user->level_access_id == 1){
        //         return true;
        //     }
        // });

        // somente administrador e chefe de cartório pode acessar
        Gate::define('admin-cartorio_admin', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2){
                return true;
            }
        });

        // somente administrador, chefe de cartório e servidor do cartório pode acessar
        Gate::define('admin-cartorio_admin-cartorio_user', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2 or
                $user->level_access_id == 3){
                return true;
            }
        });

        // somente administrador, chefe de cartório, servidor do cartório e escolta pode acessar
        Gate::define('admin-cartorio_admin-cartorio_user-escolta', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2 or
                $user->level_access_id == 3 or
                $user->level_access_id == 4
                ){
                return true;
            }
        });

        // somente administrador, chefe de cartório, servidor do cartório e pad pode acessar
        Gate::define('admin-cartorio_admin-cartorio_user-pad', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2 or
                $user->level_access_id == 3 or
                $user->level_access_id == 5
                ){
                return true;
            }
        });

        // Todos os usuários podem acessar
        Gate::define('guest', function (User $user,) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2 or
                $user->level_access_id == 3 or
                $user->level_access_id == 4 or
                $user->level_access_id == 5 or
                $user->level_access_id == 6
                ){
                return true;
            }
        });

        // somente administrador e recepcao e usuários pode acessar
        Gate::define('admin-recepcao-guest', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 6 or
                $user->level_access_id == 7
                ){
                return true;
            }
        });

        // somente administrador e recepcao pode acessar
        Gate::define('admin-recepcao', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 7
                ){
                return true;
            }
        });

        // somente administrador e recepcao pode acessar
        Gate::define('admin-saude-guest', function (User $user) {
            if(
                $user->level_access_id == 1 or
                $user->level_access_id == 2 or
                $user->level_access_id == 3 or
                $user->level_access_id == 4 or
                $user->level_access_id == 5 or
                $user->level_access_id == 6 or
                $user->level_access_id == 8
                ){
                return true;
            }
        });
    }
}
