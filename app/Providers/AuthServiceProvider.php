<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate Loại văn bản
        Gate::define('loaivanban_xem', function($user){
            return $user->ktphanquyen('loaivanban_xem');
        });
        Gate::define('loaivanban_them', function($user){
            return $user->ktphanquyen('loaivanban_them');
        });
        Gate::define('loaivanban_sua', function($user){
            return $user->ktphanquyen('loaivanban_sua');
        });
        Gate::define('loaivanban_xoa', function($user){
            return $user->ktphanquyen('loaivanban_xoa');
        });
    }
}
