<?php

namespace App;

use App\Models\Area;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_cities extends Authenticatable
{
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
