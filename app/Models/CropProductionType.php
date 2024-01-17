<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CropProductionType extends Authenticatable
{
    protected $table = 'crop_production';
}
