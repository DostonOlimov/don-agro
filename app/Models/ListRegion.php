<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListRegion extends Model
{
    protected $table = 'lists';
    public $timestamps = null;

    public function listAreas(): HasMany
    {
        return $this->hasMany(ListArea::class, 'int01');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type_id', 1)->where('state', 1);
        });
    }
}
