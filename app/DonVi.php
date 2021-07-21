<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;

class DonVi extends Model
{
    use SoftDelete;
    protected $table = 'don_vi';
}
