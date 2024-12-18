<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Area
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property int $crop_id
 */
class SertificateLaboratories extends Model
{
    protected $table = 'sertificate_laboratories';

    public function director()
    {
        return $this->belongsTo(User::class, 'director_id','id');
    }

}
