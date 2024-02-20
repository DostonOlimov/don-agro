<?php

namespace App\Models;

use App\Models\Traits\HasAttachment;
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
class LaboratoryFinalResults  extends Model

{
    protected $table = 'laboratory_final_results';


    public function test_program(): BelongsTo
    {
        return $this->belongsTo(TestPrograms::class, 'test_program_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function result_users()
    {
        return $this->hasMany(LaboratoryResultUsers::class,'results_id','id');
    }
    protected static function boot()
    {
        $year =  session('year') ?  session('year') : date('Y');
        static::addGlobalScope(function ($query) use($year) {
            $query->whereHas('test_program', function ($query) use ($year) {
                $query->whereHas('application', function ($query) use ($year) {
                    $query->whereYear('date', $year);
                });
            });
        });

        parent::boot();
    }

}
