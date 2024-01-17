<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Area
 * @package App\Models
 *
 * @property int $id
 */
class AppRequirement extends Model
{
    protected $table = 'app_requirements';

    public function app()
    {
        return $this->belongsTo(Application::class, 'app_id');
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }

}
