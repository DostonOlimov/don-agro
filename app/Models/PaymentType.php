<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $payment
 *
 * @property-read ListPaymentType $listPaymentType
 */
class PaymentType extends Model
{
//    use SoftDeletes;

    protected $table = 'tbl_payment_types';

    public function listPaymentType(): HasOne
    {
        return $this->hasOne(ListPaymentType::class, 'int03', 'id');
    }
}
