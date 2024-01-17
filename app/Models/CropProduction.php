<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CropProduction extends Model
{
    protected $table = 'crop_production';

    public function type()
    {
        return $this->belongsTo(ProductionType::class, 'type_id');
    }
}
