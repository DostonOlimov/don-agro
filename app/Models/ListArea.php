<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListArea extends Model
{
    protected $table = 'lists';
    public $timestamps = null;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type_id', 2)->where('state', 1);
        });
    }
}
