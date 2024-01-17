<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use Compoships;

    protected $table = 'tbl_colors';
}
