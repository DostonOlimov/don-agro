<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PreparedCompanies extends Model
{
    protected $fillable = [
        'name',
        'country_id',
        'state_id',
    ];
    public function region()
    {
        return $this->belongsTo(Region::class, 'state_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
