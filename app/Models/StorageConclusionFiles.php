<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageConclusionFiles extends Model
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;
    protected $table = 'storage_conclusion_files_data';

    protected $fillable = [
        'id',
        'number',
        'name',
        'conclusion_id',
        'type',
        'date',
        'state_id',
        'comment',
    ];

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_1 => 'Metal sig\'im',
            self::TYPE_2 => 'Ochiq joy',
            self::TYPE_3 => 'Yopiq joy',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

}
