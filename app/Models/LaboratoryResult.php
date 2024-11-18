<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryResult extends Model
{

    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;
    const TYPE_5 = 5;

    protected $table = 'laboratory_results';

    protected $fillable = [
        'app_id',
        'class',
        'type',
        'subtype',
        'nature',
        'humidity',
        'falls_number',
        'kleykovina',
        'quality',
        'elak_number',
        'elak_result',
    ];
    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_1 => 'I',
            self::TYPE_2 => 'II',
            self::TYPE_3 => 'III',
            self::TYPE_4 => 'IV',
            self::TYPE_5 => 'V',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public static function getGroup($type = null)
    {
        $arr = [
            self::TYPE_1 => 'I',
            self::TYPE_2 => 'II',
            self::TYPE_3 => 'III',
            self::TYPE_4 => 'yuvilmadi',
            ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
}
