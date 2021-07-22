<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function chucNangCha(){
        return $this->belongsTo('App\Permission','parent_id','id');
    }
}
