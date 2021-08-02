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

        // Gate nguồn đến
        Gate::define('nguonden_xem', function($user){
            return $user->ktphanquyen('nguonden_xem');
        });
        Gate::define('nguonden_them', function($user){
            return $user->ktphanquyen('nguonden_them');
        });
        Gate::define('nguonden_sua', function($user){
            return $user->ktphanquyen('nguonden_sua');
        });
        Gate::define('nguonden_xoa', function($user){
            return $user->ktphanquyen('nguonden_xoa');
        });

        // Gate nguồn đi
        Gate::define('nguondi_xem', function($user){
            return $user->ktphanquyen('nguondi_xem');
        });
        Gate::define('nguondi_them', function($user){
            return $user->ktphanquyen('nguondi_them');
        });
        Gate::define('nguondi_sua', function($user){
            return $user->ktphanquyen('nguondi_sua');
        });
        Gate::define('nguondi_xoa', function($user){
            return $user->ktphanquyen('nguondi_xoa');
        });

        // Gate lãnh đạo
        Gate::define('lanhdao_xem', function($user){
            return $user->ktphanquyen('lanhdao_xem');
        });
        Gate::define('lanhdao_them', function($user){
            return $user->ktphanquyen('lanhdao_them');
        });
        Gate::define('lanhdao_sua', function($user){
            return $user->ktphanquyen('lanhdao_sua');
        });
        Gate::define('lanhdao_xoa', function($user){
            return $user->ktphanquyen('lanhdao_xoa');
        });

        // Gate đơn vị
        Gate::define('donvi_xem', function($user){
            return $user->ktphanquyen('donvi_xem');
        });
        Gate::define('donvi_them', function($user){
            return $user->ktphanquyen('donvi_them');
        });
        Gate::define('donvi_sua', function($user){
            return $user->ktphanquyen('donvi_sua');
        });
        Gate::define('donvi_xoa', function($user){
            return $user->ktphanquyen('donvi_xoa');
        });

        // Gate chức năng
        Gate::define('chucnang_xem', function($user){
            return $user->ktphanquyen('chucnang_xem');
        });
        Gate::define('chucnang_them', function($user){
            return $user->ktphanquyen('chucnang_them');
        });
        Gate::define('chucnang_sua', function($user){
            return $user->ktphanquyen('chucnang_sua');
        });
        Gate::define('chucnang_xoa', function($user){
            return $user->ktphanquyen('chucnang_xoa');
        });

        // Gate phân quyền
        Gate::define('phanquyen_xem', function($user){
            return $user->ktphanquyen('phanquyen_xem');
        });
        Gate::define('phanquyen_them', function($user){
            return $user->ktphanquyen('phanquyen_them');
        });
        Gate::define('phanquyen_sua', function($user){
            return $user->ktphanquyen('phanquyen_sua');
        });
        Gate::define('phanquyen_xoa', function($user){
            return $user->ktphanquyen('phanquyen_xoa');
        });

        // Gate Loại tài khoản
        Gate::define('taikhoan_xem', function($user){
            return $user->ktphanquyen('taikhoan_xem');
        });
        Gate::define('taikhoan_them', function($user){
            return $user->ktphanquyen('taikhoan_them');
        });
        Gate::define('taikhoan_sua', function($user){
            return $user->ktphanquyen('taikhoan_sua');
        });
        Gate::define('taikhoan_xoa', function($user){
            return $user->ktphanquyen('taikhoan_xoa');
        });
    }
}
