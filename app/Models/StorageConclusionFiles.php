<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Symfony\Component\String\s;

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
            self::TYPE_1 => 'Mulk huquqini tasdiqlovchi organning davlat orderi',
            self::TYPE_2 => 'O\'rganish va boholash dalolatnomasi',
            self::TYPE_3 => 'FVBning xulosasi',
            self::TYPE_4 => 'SESning xulosasi',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public function getTypeByRegion($type = null): ?string
    {
        switch ($this->type) {
            case self::TYPE_1:
                return  $this->state->name . ' kadastr bo\'limi';
            case self::TYPE_2:
                return 'Markazning '. $this->state->name . ' ishchi guruhi';
           case self::TYPE_3:
               return $this->state->name . 'ning FVBsi';
          case self::TYPE_4:
              return $this->state->name . 'ning SES bo\'limi';

        }
        return null;
    }

    public function state():BelongsTo
    {
        return $this->belongsTo(Region::class,'state_id');
    }

}
