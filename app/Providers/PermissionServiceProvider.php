<?php

namespace App\Providers;

use Gate;
use App\Permission;
use App\Permissions;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::get()->map(function ($permission){
            Gate::define($permission->name, function ($user) use ($permission){
                return $user->hasPermissionTo($permission);
            });
        });
    }
}
