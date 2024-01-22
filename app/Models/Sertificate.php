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

 */
class Sertificate  extends Model

{
    use  LogsActivity;

    protected $table = 'sertificates';


    public function final_result(): BelongsTo
    {
        return $this->belongsTo(FinalResult::class, 'final_result_id', 'id');
    }
    protected static function boot()
    {
        $year =  session('year') ?  session('year') : date('Y');
        static::addGlobalScope(function ($query) use($year) {
            $query->whereHas('final_result', function ($query) use ($year) {
                $query->whereHas('test_program', function ($query) use ($year) {
                    $query->whereHas('application', function ($query) use ($year) {
                        $query->whereYear('date', $year);
                    });
                });
            });
        });

        parent::boot();
    }

}
