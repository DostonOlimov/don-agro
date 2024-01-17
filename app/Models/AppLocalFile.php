<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class AppLocalFile extends Model
{
    protected $table = 'app_file_local';

    const PATH_A_DALOLATNOMA = 'public/a_dalolatnoma';
    const PATH_A_XULOSA = 'public/a_xulosa';
    const PATH_D_XULOSA = 'public/d_xulosa';
    const PATH_MAKIROVKA = 'public/markirovka';
    const PATH_OLD_CERTIFICATE = 'public/old_certificate';

    public function getADalolatnomaFileAttribute(){
        return self::PATH_A_DALOLATNOMA . '/' .$this->a_dalolatnoma;
    }
    public function getAXulosaFileAttribute(){
        return self::PATH_A_XULOSA . '/' .$this->a_xulosa;
    }
    public function getDXulosaFileAttribute(){
        return self::PATH_D_XULOSA . '/' .$this->d_xulosa;
    }
    public function getMarkirovkaFileAttribute(){
        return self::PATH_MAKIROVKA . '/' .$this->markirovka;
    }
    public function getOldCertificateFileAttribute(){
        return self::PATH_OLD_CERTIFICATE . '/' .$this->certificate;
    }

}
