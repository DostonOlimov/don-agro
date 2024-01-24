<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabBayonnoma extends Model
{
    use HasFactory;

    protected $table = 'lab_bayonnoma';

    protected $fillable = [
        'lab_start_date',
        'date',
        'number',
        'test_result',
        'test_employee',
        'akt_id',
        'created_by',
    ];

    public function akt(): BelongsTo
    {
        return $this->belongsTo(AKT::class, 'akt_id', 'id');
    }
}
