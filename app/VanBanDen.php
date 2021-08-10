<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VanBanDen extends Model
{
    protected $table = 'van_ban_den';
    protected function nguondens(){
        return $this->belongsTo('App\NguonDen','id_nguon_den');
    }
}
