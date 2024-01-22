<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class RequiredAmount extends Model
{
    use Compoships;

    protected $table = 'required_amount';
}
