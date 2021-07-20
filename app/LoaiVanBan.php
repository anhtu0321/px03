<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LoaiVanBan extends Model
{
    use SoftDeletes;
    protected $table = 'loai_van_ban';
}
