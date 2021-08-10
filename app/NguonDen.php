<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguonDen extends Model
{
    use SoftDeletes;
    protected $table = 'nguon_den';
    protected function vanbandens(){
        return $this->hasMany('App\VanBanDen', 'id_nguon_den');
    }
}
