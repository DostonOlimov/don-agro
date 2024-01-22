<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ListPaymentType
 * @package App\Models
 *
 * @property-read string $route
 * @property-read PaymentCategory $paymentCategory
 */
class ListPaymentType extends Model
{
    protected $table = 'lists';
    public $timestamps = null;

    public function paymentCategory(): BelongsTo
    {
        return $this->belongsTo(PaymentCategory::class, 'int01', 'id');
    }

    protected static function boot()
    {
        static::addGlobalScope(function ($query) {
            $query->where('type_id', 11)->where('state', 1);
        });

        parent::boot();
    }
}
