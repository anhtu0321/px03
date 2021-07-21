<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanhDao extends Model
{
    use SoftDeletes;
    protected $table = "lanh_dao";
}
