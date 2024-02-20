<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryResultUsers extends Model
{
    protected $table = 'laboratory_result_users';

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
