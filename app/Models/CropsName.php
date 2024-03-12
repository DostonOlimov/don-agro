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
 */
class CropsName extends Model
{
    const IMAGE_PATH = '/img/crops/';

    protected $table = 'crops_name';

    protected $fillable = [
        'id', 'name',
    ];
    // public function parent()
    // {
    //     return $this->hasMany(CropsName::class, 'id', 'parent_id');
    // }
    public function crop_data()
    {
        return $this->hasMany(CropData::class,'name_id','id');
    }
    public function nds()
    {
        return $this->hasMany(Nds::class,'crop_id','id');
    }
    public function areas(): HasMany
    {
        return $this->hasMany(CropsType::class, 'crop_id');
    }

    public function listRegion(): HasMany
    {
        return $this->hasMany(CropsGeneration::class, 'crop_id');
    }

    public function getImgUrlAttribute(){
        return self::IMAGE_PATH.$this->img;
    }
}
