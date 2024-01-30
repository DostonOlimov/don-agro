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
 * @property int $type_id
 * @property string $number
 */
class Nds extends Model
{
    protected $table = 'nds';

    const TYPE_DST= 1;
    const TYPE_GOST = 2;
    const TYPE_UZTR= 3;
    const TYPE_MTR = 4;


    public function crops()
    {
        return $this->belongsTo(CropsName::class, 'crop_id');
    }

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_DST => "O`z DSt",
            self::TYPE_GOST => 'ГОСТ',
            self::TYPE_UZTR => 'UzTR',
            self::TYPE_MTR => 'MTR',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public function getFullNameAttribute()
    {
        return self::getType($this->type_id).' '.$this->number;
    }

}
