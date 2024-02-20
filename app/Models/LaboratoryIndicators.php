<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryIndicators extends Model
{

    protected $table = 'laboratory_indicators';

    public function indicators(): BelongsTo
    {
        return $this->belongsTo(Indicator::class, 'indicator_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(LaboratoryIndicators::class,'parent_id','id');
    }
    public function childs()
    {
        return $this->hasMany(LaboratoryIndicators::class,'parent_id','id');
    }
    public function results()
    {
        return $this->hasMany(LaboratoryResult::class,'laboratory_indicator_id','id');
    }
}
