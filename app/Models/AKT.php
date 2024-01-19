<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AKT extends Model
{
    use HasFactory;

    protected $table = 'AKT';

    public function decision(): BelongsTo
    {
        return $this->belongsTo(Decision::class, 'decision_id', 'id');
    }
}
