<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    protected $table = 'client_data';

    protected $fillable = [
        'app_id',
        'transport_type',
        'vagon_number',
        'yuk_xati',
        'sender_name',
        'sender_station',
        'reciever_station',
        'sender_address',
        'company_marker',
    ];


}
