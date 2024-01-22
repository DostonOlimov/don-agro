<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class AppForeignFile extends Model
{

    protected $table = 'app_file_foreign';

    const PATH_KARANTIN = 'public/foreign/karantin';
    const PATH_FITOSANITAR = 'public/foreign/fitosanitar';
    const PATH_M_SERTIFICAT = 'public/foreign/m_sertificat';
    const PATH_MAKIROVKA = 'public/foreign/markirovka';
    const PATH_INVOYS = 'public/foreign/invoys';
    const PATH_YUK_XATI = 'public/foreign/yuk_xati';
    const PATH_SMR = 'public/foreign/smr';

    public function getKarantinFileAttribute(){
        return self::PATH_KARANTIN . '/' .$this->karantin;
    }
    public function getFitosanitarFileAttribute(){
        return self::PATH_FITOSANITAR . '/' .$this->fitosanitar;
    }
    public function getSertificatFileAttribute(){
        return self::PATH_M_SERTIFICAT . '/' .$this->sertifikat;
    }
    public function getMarkirovkaFileAttribute(){
        return self::PATH_MAKIROVKA . '/' .$this->markirovka;
    }
    public function getInvoysFileAttribute(){
        return self::PATH_INVOYS . '/' .$this->invoys;
    }
    public function getYukXatiFileAttribute(){
        return self::PATH_YUK_XATI . '/' .$this->yuk_xati;
    }
    public function getSrmFileAttribute(){
        return self::PATH_SMR . '/' .$this->smr;
    }
}
