<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Area
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property int $crop_id
 */
class SertificateNds extends Model
{
    protected $table = 'sertificate_nds';

    public function crops()
    {
        return $this->belongsTo(CropsName::class, 'crop_id');
    }

}
