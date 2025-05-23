<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;

    const STATUS_NEW = 1;
    const STATUS_REJECTED = 2;
    const STATUS_ACCEPTED = 3;
    const STATUS_FINISHED = 4;
    const STATUS_DELETED = 5;

    protected $table = 'applications';


    protected $fillable = [
        'id',
        'app_number',
        'crop_data_id',
        'organization_id',
        'prepared_id',
        'type',
        'app_type',
        'date',
        'accepted_date',
        'accepted_id',
        'data',
        'status',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function crops()
    {
        return $this->belongsTo(CropData::class, 'crop_data_id');
    }

    public function organization()
    {
        return $this->belongsTo(OrganizationCompanies::class, 'organization_id');
    }

    public function prepared()
    {
        return $this->belongsTo(PreparedCompanies::class, 'prepared_id');
    }
    public function tests()
    {
        return $this->belongsTo(TestPrograms::class, 'id','app_id');
    }
    public function decision()
    {
        return $this->belongsTo(Decision::class, 'id','app_id');
    }
    public function foreign_file()
    {
        return $this->belongsTo(AppForeignFile::class, 'id','app_id');
    }
    public function comment()
    {
        return $this->belongsTo(AppStatusChanges::class, 'id','app_id');
    }
    public function client_data()
    {
        return $this->belongsTo(ClientData::class, 'id','app_id');
    }
    public function laboratory_result()
    {
        return $this->belongsTo(LaboratoryResult::class, 'id','app_id');
    }
    public function laboratory_result_data()
    {
        return $this->hasMany(LaboratoryResultData::class,'app_id' ,'id');
    }
    public function sifat_sertificate()
    {
        return $this->belongsTo(SifatSertificates::class,'id','app_id');
    }

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_1 => 'Maxalliy ishlab chiqarish uchun',
            self::TYPE_2 => 'Import qilingan mahsulotlar uchun',
            self::TYPE_3 => 'Eski hosil uchun',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public static function getStatus($type = null)
    {
        $arr = [
            self::STATUS_NEW => 'Yangi ariza',
            self::STATUS_ACCEPTED => 'Qabul qilingan',
            self::STATUS_REJECTED => 'Rad etilgan',
            self::STATUS_FINISHED => 'Yakunlangan',
            self::STATUS_DELETED => 'O\'chirilgan',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public function getStatusNameAttribute(){
        return self::getStatus($this->status);
    }
    public function getStatusColorAttribute(){
         if($this->status == self::STATUS_NEW){
             return 'warning';
        }elseif($this->status == self::STATUS_REJECTED){
             return 'danger';
         }elseif($this->status == self::STATUS_ACCEPTED){
             return 'success';
         }elseif($this->status == self::STATUS_DELETED){
             return 'danger';
         }elseif($this->status == self::STATUS_FINISHED){
             return 'secondary';
         }
    }
    public function getYear()
    {
        $new_date = \DateTime::createFromFormat("Y-d-m", $this->date);
        $year = $new_date->format('Y');
        return (int)$year;
    }
    protected static function boot()
    {
        $year =  session('year') ?  session('year') : date('Y');

        static::addGlobalScope(function ($query) use($year) {
            $query->where('status','!=', self::STATUS_DELETED)
                ->whereYear('date',$year);
        });
        // Ensure the user is authenticated
        if ($user = auth()->user()) {
            // Add global scope for filtering by user's state if in branch state
            if ($user->role == User::ROLE_CITY_EMPLOYEE) {
                static::addGlobalScope('cityStateScope', function ($query) use ($user) {
                    $query->whereHas('organization.city', function ($query) use ($user) {
                        $query->where('state_id', $user->state_id);
                    });
                });
            }
        }

        parent::boot();
    }


}
