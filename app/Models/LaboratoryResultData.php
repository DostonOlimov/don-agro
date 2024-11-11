<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryResultData extends Model
{

    protected $table = 'laboratory_result_data';

    protected $fillable = [
        'app_id',
        'name',
        'value',
        'type',
    ];


}
