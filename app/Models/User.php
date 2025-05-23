<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Level;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App
 *
 * @property string $name
 * @property string $role
 * @property string $status
 * @property-read array $region_ids
 * @property-read array $area_ids
 * @property-read Level $level
 */
class User extends Authenticatable
{
    use HasApiTokens;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const ROLE_CUSTOMER = 30;
    const STATE_EMPLOYEE = 45;
    const ROLE_CITY_EMPLOYEE = 54;
    const ROLE_SERTIFICATE_DIRECTOR = 55;
    const ROLE_ADMIN_EMPLOYEE = 50;
    const ROLE_INSPECTION_DIROCTOR = 60;

    const ROLE_LABORATORY_DIRECTOR = 90;
    const ROLE_LABORATORY_ADMIN = 99;
    const ROLE_LABORATORY_EMPLOYEE = 91;

    const BRANCH_INSPECTION = 1;
    const BRANCH_SERTIFICATE = 2;
    const BRANCH_LABORATORY = 3;
    const BRANCH_ACCOUNTANT = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $guarded = ['status'];

    protected $appends = [
        'full_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'role');
    }

    public function getRegionIdsAttribute()
    {
        return array_filter(explode(',', $this->state_id));
    }

    public function getAreaIdsAttribute()
    {
        return array_filter(explode(',', $this->city_id));
    }

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function access(): BelongsTo
    {
        return $this->belongsTo(tbl_accessrights::class, 'role');
    }

    public static function getTypeId()
    {
        return static::STATUS_ACTIVE;
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'state_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('status', static::getTypeId());
        });

        static::creating(function ($model) {
            $model->status = $model->getTypeId();
        });
    }
}
