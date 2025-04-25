<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StorageCapacityConclusion extends Model
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;

    const MEASURE_TYPE_1 = 1;
    const MEASURE_TYPE_2 = 2;

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
    public static function getMeasureType($type = null)
    {
        $arr = [
            self::MEASURE_TYPE_1 => 'm²',
            self::MEASURE_TYPE_2 => 'm³',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getResult($type = null)
    {
        $arr = [
            self::RESULT_MUVOFIQ => 'muvofiq',
            self::RESULT_NOMUVOFIQ => 'nomuvofiq',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function organization(): HasOne
    {
        return $this->hasOne(OrganizationCompanies::class, 'id','organization_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(StorageConclusionFiles::class, 'conclusion_id');
    }

}
