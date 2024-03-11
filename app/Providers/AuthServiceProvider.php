<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('user-management', function ($user) {
            // Logic to check if user has user management permission
            // foreach($user->roles as $role){
            //     foreach($role->permissions as $p){
            //         if($p->name !== "user-management")
            //         {
            //             dd($user->hasPermissionTo('user-management'));
            //             return $user->hasPermissionTo('user-management');
            //         }else{
            //             return redirect('/dashboard');      
            //         }
            //     }
            // }
            foreach(auth()->user()->roles as $r)
            {
                foreach($r->permissions as $p)
                {
                    if($p->name != "user-management")
                    {
                        return redirect('/dashboard');
                    }else{
                        return redirect('/users');
                    }
                }
            }
            
        });
    }
}
