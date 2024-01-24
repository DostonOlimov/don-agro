<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratories extends Model
{
    protected $table = 'laboratories';

    public function decision()
    {
        return $this->hasMany(Decision::class, 'laboratory_id');
    }
}
