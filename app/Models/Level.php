<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Level
 * @package App\Models
 *
 * @property string $position
 * @property string $status
 */
class Level extends Model
{
    protected $table = 'tbl_accessrights';

    const LEVEL_COUNTRY = 'country';
    const LEVEL_REGION = 'region';
    const LEVEL_DISTRICT = 'district';
    const LEVELS = [
        self::LEVEL_COUNTRY,
        self::LEVEL_REGION,
        self::LEVEL_DISTRICT,
    ];
}
