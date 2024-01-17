<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $service
 * @property string $free_service
 */
class Document extends Model
{
    const SERVICE_CERTIFICATE = 'certificate';
    const SERVICE_DRIVER_LICENSE = 'driver-license';
    const SERVICE_NUMBER = 'number';
    const SERVICE_REGISTRATION = 'registration';
    const SERVICE_TECHPASSPORT = 'technical-passport';

    const SERVICES = [
        self::SERVICE_CERTIFICATE,
        self::SERVICE_DRIVER_LICENSE,
        self::SERVICE_NUMBER,
        self::SERVICE_REGISTRATION,
        self::SERVICE_TECHPASSPORT,
    ];
}
