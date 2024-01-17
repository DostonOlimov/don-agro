<?php

namespace App;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tbl_activities extends Model
{
    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'owner_id');
    }

    public function causer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
