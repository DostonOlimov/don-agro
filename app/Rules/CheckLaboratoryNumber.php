<?php

namespace App\Rules;

use App\Models\Application;
use App\Models\LaboratoryNumbers;
use Illuminate\Contracts\Validation\Rule;

class CheckLaboratoryNumber implements Rule
{
    protected $count;
    protected $year;
    protected $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tests, $type = null)
    {
        $this->count = $tests->akt[0]->party_number;
        // $this->type = $type;
        if (session('year')) {
            $this->year = session('year');
        } else {
            $this->year = date('Y');
        }
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
        for ($i = $value; $i < $value + $this->count; $i++) {
            if (LaboratoryNumbers::where('number', $i)->where('year', $this->year)
                // ->where('laboratory_category_type',$this->type)
                ->first()
            ) {
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
