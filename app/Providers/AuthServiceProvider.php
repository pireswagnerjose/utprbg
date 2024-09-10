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
     */
    public function boot(): void
    {
        // somente administrador pode acessar
        Gate::define('admin', function (User $user) {
            if($user->level_access_id == 1){
                return true;
            }
        });

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
    }
}
