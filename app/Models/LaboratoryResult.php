<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryResult extends Model
{

    protected $table = 'laboratory_results';

    protected $fillable = [
        'app_id',
        'class',
        'type',
        'subtype',
        'nature',
        'humidity',
        'falls_number',
        'kleykovina',
        'quality',
        'elak_number',
        'elak_result',
    ];


}
