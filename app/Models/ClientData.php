<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;

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


    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_1 => 'vagon',
            self::TYPE_2 => 'avtotransport',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getMarkerExist($type = null)
    {
        $arr = [
            self::TYPE_1 => 'mavjud',
            self::TYPE_2 => 'mavjud emas',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }


}
