<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Traits\LogsActivity;
use Illuminate\Support\Collection;

/**
 * Class Customer
 * @package App\Models
 *
 * @property int $id
 * @property int $inn
 * @property int $pinfl
 * @property int $id_number
 * @property string $name
 * @property string $lastname
 * @property string $middlename
 * @property string $type
 * @property int $birthplace_id
 * @property int $city_id
 *
 * @property-read string $full_name
 * @property-read string $f_name
 * @property-read string $tax_id
 * @property string $category_ids
 * @property-read string $passport_id
 * @property-read string $clean_phone
 * @property-read string $location_name
 * @property-read Area $area
 * @property-read Area $birthPlace
 * @property-read OwnershipForm $ownershipForm
 * @property-read Vehicle[]|Collection $vehicles
 */
class Customer extends Model
{
    use LogsActivity;

    const TYPE_PHYSICAL = 'physical';
    const TYPE_LEGAL = 'legal';
    const TYPES = [
        self::TYPE_PHYSICAL,
        self::TYPE_LEGAL,
    ];

    const STATE_INACTIVE = 'inactive';
    const STATE_ACTIVE = 'active';
    const STATE_LIQUIDATED = 'liquidated';
    const STATE_REMOVED = 'removed';
    const STATES = [
        self::STATE_INACTIVE => 0,
        self::STATE_ACTIVE => 1,
        self::STATE_LIQUIDATED => 2,
        self::STATE_REMOVED => 3,
    ];
    const EDITABLE_STATES = [
        self::STATE_INACTIVE => 0,
        self::STATE_ACTIVE => 1,
    ];

    protected $fillable = [
        'pinfl',
        'inn',
        'status',
        'birthplace_id',
    ];

    protected $appends = ['full_name'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'city_id');
    }

    public function birthPlace()
    {
        return $this->belongsTo(Area::class, 'birthplace_id');
    }

    public function ownershipForm(): BelongsTo
    {
        return $this->belongsTo(OwnershipForm::class, 'form');
    }

    public function driverLicenses()
    {
        return $this->hasMany(DriverLicence::class, 'owner_id');
    }

    public function driverLicense(): HasOne
    {
        return $this->hasOne(DriverLicence::class, 'owner_id')->where('status', 'active')->latest();
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'owner_id');
    }

    public function getFullNameAttribute()
    {
        return $this->type === self::TYPE_LEGAL ? $this->name : implode(' ', [$this->lastname, $this->name, $this->middlename]);
    }

    public function getTaxIdAttribute()
    {
        return $this->pinfl ?: $this->id_number ?: $this->inn;
    }

    public function getCategoryIdsAttribute()
    {
        return array_filter(array_map('intval', explode(',', $this->category ?? '')));
    }

    public function setCategoryIdsAttribute(array $val)
    {
        return $this->category = implode(',', $val);
    }

    public function getPassportIdAttribute()
    {
        return $this->passport_series . $this->passport_number;
    }

    public function getCleanPhoneAttribute()
    {
        return cleanPhone($this->mobile);
    }

    public function getLocationNameAttribute()
    {
        return $this->area->region->name . ', ' . $this->area->name;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', static::STATES[static::STATE_ACTIVE]);
    }

    public function isLegal(): bool
    {
        return $this->type === self::TYPE_LEGAL;
    }
}
