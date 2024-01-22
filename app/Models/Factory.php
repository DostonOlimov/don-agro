<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use Compoships;

    protected $table = 'vehicle_factories';
}
