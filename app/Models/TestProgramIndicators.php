<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


/**
 * Class DriverLicence
 * @package App\Models
 *
 * @property string $code
 * @property string $name
 * @property string $soato
 */
class TestProgramIndicators extends Model
{
    protected $table = 'test_program_indicators';

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class, 'indicator_id', 'id');
    }
    public function tests(): BelongsTo
    {
        return $this->belongsTo(TestPrograms::class, 'test_program_id', 'id');
    }
}
