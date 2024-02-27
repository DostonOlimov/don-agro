<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function PHPUnit\Framework\isNull;

class OrganizationCompanies extends Model
{
    protected $fillable = [
        'name', 
        'city_id',
        'address',
        'owner_name',
        'phone_number',
        'inn',
    ];
    public function city()
    {
        return $this->belongsTo(Area::class, 'city_id');
    }
    public function application(): HasMany
    {
        return $this->hasMany(Application::class, 'organization_id');
    }
    public function getTotalAmountAttribute()
    {
        return $this->application->sum(function ($application) {

                if(!array_key_exists('year',$_GET) or empty($_GET['year']) ) {
                    return $application->crops->measure_type == 2 ? 0.001 * $application->crops->amount
                        : $application->crops->amount;
                }
                else {
                    return $application->crops->year == $_GET['year'] ?
                        ($application->crops->measure_type == 2 ? 0.001 * $application->crops->amount
                            : $application->crops->amount) : 0;
                }
        });
    }
    public function getCertificatAmountAttribute()
    {
        return $this->application->sum(function ($application) {
            $type = optional(optional($application->tests)->result)->type;
            if(!array_key_exists('year',$_GET) or empty($_GET['year']) ) {
                return $type ===2 ? (($application->crops->measure_type == 2)
                        ? 0.001 * $application->crops->amount
                        : $application->crops->amount) : 0;
            }else{
                return ($type === 2 and $application->crops->year == $_GET['year']) ? (($application->crops->measure_type == 2)
                    ? 0.001 * $application->crops->amount
                    : $application->crops->amount) : 0;
            }

        });
    }
    public function getDefectedAmountAttribute()
    {
        return $this->application->sum(function ($application) {
            $type = optional(optional($application->tests)->result)->type;
            if(!array_key_exists('year',$_GET) or empty($_GET['year']) ) {
                return $type === 0 ? (($application->crops->measure_type == 2)
                    ? 0.001 * $application->crops->amount
                    : $application->crops->amount) : 0;
            }else{
                return ($type === 0 and $application->crops->year == $_GET['year']) ? (($application->crops->measure_type == 2)
                    ? 0.001 * $application->crops->amount
                    : $application->crops->amount) : 0;
            }

        });
    }
    public function getProgressAmountAttribute()
    {

        return $this->application->sum(function ($application) {
            $type = optional(optional($application->tests)->result)->type;
            if(!array_key_exists('year',$_GET) or empty($_GET['year']) ) {
                return $type === null ? (($application->crops->measure_type == 2)
                    ? 0.001 * $application->crops->amount
                    : $application->crops->amount) : 0;
            }else{
                return ($type === null and $application->crops->year == $_GET['year']) ? (($application->crops->measure_type == 2)
                    ? 0.001 * $application->crops->amount
                    : $application->crops->amount) : 0;
            }

        });
    }
}
