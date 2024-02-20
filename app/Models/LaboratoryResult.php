<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryResult extends Model
{

    protected $table = 'laboratory_results';

    protected $fillable = ['number_id', 'laboratory_indicator_id', 'value'];

    public function number()
    {
        return $this->belongsTo(LaboratoryNumbers::class,'id','number_id');
    }

    public function indicator()
    {
        return $this->belongsTo(LaboratoryIndicators::class,'laboratory_indicator_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

}
