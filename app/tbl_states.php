<?php

namespace App;

use App\Models\Region;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\LogsActivity;

/**
 * @property $soato
 */
class tbl_states extends Authenticatable
{
    use LogsActivity;

    public function area(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
