<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const STATUS_CREATED = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_DELIVERED = 2;
    const STATUS_DELIVERY_ERROR = 5;
    const STATUS_REJECTED = 8;
    const STATUS_INCORRECT_PHONE = 12;
    const STATUS_NO_ANSWER = -400;
    const STATUS_WHOOPS = 7;

    const STATUSES = [
        self::STATUS_CREATED,
        self::STATUS_SUBMITTED,
        self::STATUS_DELIVERED,
        self::STATUS_DELIVERY_ERROR,
        self::STATUS_REJECTED,
        self::STATUS_INCORRECT_PHONE,
        self::STATUS_NO_ANSWER,
        self::STATUS_WHOOPS,
    ];

    protected $fillable = [
        'type_id',
        'phone',
        'text',
        'object_id',
        'send_at',
        'status',
    ];

    protected $dates = [
        'send_at',
        'delivered_at'
    ];

    protected $attributes = [
        'priority' => 0,
        'status' => self::STATUS_CREATED,
    ];

    public function inspection()
    {
        return $this->belongsTo(VehicleInspection::class, 'object_id');
    }
}
