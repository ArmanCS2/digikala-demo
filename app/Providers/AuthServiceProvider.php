<?php

namespace App\Providers;

use App\Models\User\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        try {
            Permission::get()->map(function ($permission){
                Gate::define($permission->name,function ($user)use ($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch (\Exception $e){
            report($e);
            return false;
        }

        Blade::directive('role',function ($role){
            return "<?php if (auth()->check() && auth()->user()->hasRole($role)) { ?>" ;
        });

        Blade::directive('endrole',function (){
            return "<?php } ?>" ;
        });

        Blade::directive('permission',function ($permissionName){
            return "<?php if (auth()->check() && auth()->user()->hasPermissionName($permissionName)) { ?>" ;
        });

        Blade::directive('endpermission',function (){
            return "<?php } ?>" ;
        });
    }
}
