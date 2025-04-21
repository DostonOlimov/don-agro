<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


/**
 * Class DriverLicence
 * @package App\Models
 *
 * @property string $code
 * @property string $name
 * @property string $soato
 */
class Region extends Model
{
    protected $table = 'tbl_states';

    protected $fillable = [
        'id', 'name','code'
    ];

    public static function getNavigationGroup(): ?string
    {
        return '📍 Location'; // This will group the resources under "Location"
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'state_id');
    }

    public function organization(): HasMany
    {
        return $this->hasMany(OrganizationCompanies::class, 'city_id');
    }
}
