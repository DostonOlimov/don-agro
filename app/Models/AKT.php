<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AKT extends Model
{
    use HasFactory;

    protected $table = 'AKT';

    protected $fillable = [
        'test_program_id',
        'akt_date',
        'out_check',
        'marker',
        'use_goal',
        'customer',
        'employee',
        'make_date',
        'expiry_date',
        'simple_size',
        'lab_size',
        'measure_type',
        'party_number',
        'description',
        'created_by',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(TestPrograms::class, 'test_program_id', 'id');
    }
    public function lab_bayonnoma()
    {
        return $this->hasMany(LabBayonnoma::class, 'akt_id');
    }
}
