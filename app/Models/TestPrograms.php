<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Area
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property int $crop_id
 */
class TestPrograms  extends Model

{
    use  LogsActivity;

    const STATUS_NEW = 1;
    const STATUS_SEND = 2;
    const STATUS_ACCEPTED = 3;
    const STATUS_REJECTED = 4;
    const STATUS_FINISHED = 5;
    const STATUS_DELETED = 6;

    protected $table = 'test_programs';

    protected $fillable = [
        'app_id',
        'count',
        'measure_type',
        'weigth',
        'created_by',
        'updated_by',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'app_id', 'id');
    }

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratories::class, 'laboratory_id', 'id');
    }
    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class, 'director_id', 'id');
    }
    public function result(): BelongsTo
    {
        return $this->belongsTo(FinalResult::class, 'id', 'test_program_id');
    }
    public function indicators()
    {
        return $this->hasMany(TestProgramIndicators::class, 'test_program_id' , 'id');
    }
    public function laboratory_numbers()
    {
        return $this->hasMany(LaboratoryNumbers::class,'test_program_id','id');
    }
    public function akt()
    {
        return $this->hasMany(AKT::class, 'test_program_id', 'id');
    }
    public function final_result(): BelongsTo
    {
        return $this->belongsTo(FinalResult::class, 'id', 'test_program_id');
    }
    public function status_change(): BelongsTo
    {
        return $this->belongsTo(TestProgramStatusChanges::class, 'id', 'test_program_id');
    }
    public static function getStatus($type = null)
    {
        $arr = [
            self::STATUS_NEW => 'Yangi ariza  ',
            self::STATUS_SEND => 'Yangi ariza  ',
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
    public function getStatusNameAttribute()
    {
        return self::getStatus($this->status);
    }
    public function getStatusColorAttribute()
    {
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
        }elseif($this->status == self::STATUS_SEND){
            return 'warning';
        }
    }
    protected static function boot()
    {
        $year =  session('year') ?  session('year') : date('Y');
        static::addGlobalScope(function ($query) use ($year) {
            $query->whereHas('application', function ($query) use ($year) {
                $query->whereYear('date', $year);
            });
        });

        parent::boot();
    }
}
