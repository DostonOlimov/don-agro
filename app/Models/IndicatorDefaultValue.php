<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndicatorDefaultValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'indicator_id',
        'generation_id',
        'value',
    ];

    public function indicator()
    {
        return $this->belongsTo(Indicator::class, 'indicator_id');
    }
    public function generation()
    {
        return $this->belongsTo(CropsGeneration::class, 'generation_id');
    }
}
