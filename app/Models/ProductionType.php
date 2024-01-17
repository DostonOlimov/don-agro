<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProductionType extends Authenticatable
{
    protected $table = 'production_type';
}
