<?php

namespace App\Providers;

use Gate;
use App\Permission;
use App\Permissions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

        Blade::directive('role', function ($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";

/*            return "<?php echo 'Hello ' . {$role}; ?>";*/
        });

        Blade::directive('endrole', function ($role){
            return '<?php endif; ?>';
        });
    }
}
