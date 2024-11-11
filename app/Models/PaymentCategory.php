<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PaymentCategory
 * @package App\Models
 *
 * @property-read string $route
 */
class PaymentCategory extends Model
{
    protected $table = 'lists';
    public $timestamps = null;

    protected $fillable = [
        'category_id',
        'type_id',
        'tin',
    ];

    public function paymentTypes(): HasMany
    {
        return $this->hasMany(PaymentType::class, 'category', 'val01');
    }

    public function listPaymentTypes(): HasMany
    {
        return $this->hasMany(ListPaymentType::class, 'int01', 'id');
    }

    public function getRouteAttribute()
    {
        return $this->val03;
    }

    protected static function boot()
    {
        static::addGlobalScope(function ($query) {
            $query->where([['type_id', 10], ['state', 1]]);
        });

        parent::boot();
    }
}
