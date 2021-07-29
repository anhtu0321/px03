<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullname', 'username', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role','user_roles','user_id','role_id');
    }
    public function ktphanquyen($key_code){
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permission = $role->permissions;
            if($permission->contains('key_code',$key_code)){
                return true;
            }
        }
        return false;
    }
}
