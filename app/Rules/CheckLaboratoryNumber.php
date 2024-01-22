<?php

namespace App\Rules;

use App\Models\Application;
use App\Models\LaboratoryNumbers;
use Illuminate\Contracts\Validation\Rule;

class CheckLaboratoryNumber implements Rule
{
    protected $count;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        for($i=$value;$i<$value+2*$this->count;$i++){
            if(LaboratoryNumbers::where('number',$i)->first()){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "<p style=\"color:red\">Bunday raqamlar oldindan ro'yxatdan o'tgan</p>";
    }
}
