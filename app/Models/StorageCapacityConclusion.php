<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageCapacityConclusion extends Model
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;

    const STATUS_NEW = 1;
    const STATUS_REJECTED = 2;
    const STATUS_ACCEPTED = 3;
    const STATUS_FINISHED = 4;
    const STATUS_DELETED = 5;

    const RESULT_MUVOFIQ = 1;
    const RESULT_NOMUVOFIQ = 2;

    protected $table = 'storage_capacity_conclusions';

    protected $fillable = [
        'id',
        'number',
        'organization_id',
        'measure_type',
        'type',
        'given_date',
        'valid_date',
        'director_id',
        'result',
        'status',
        'capacity',
        'comment',
    ];

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_1 => 'Metal sig\'im',
            self::TYPE_2 => 'Ochiq maydon',
            self::TYPE_3 => 'Elevator',
            self::TYPE_4 => 'Omborxona',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

}
