<?php

namespace App\Rules;

use App\Models\Application;
use Illuminate\Contracts\Validation\Rule;

class EditAppNumber implements Rule
{
    protected $year;
    protected $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date,$id)
    {
        $new_date = \DateTime::createFromFormat("d-m-Y", $date);
        $this->year = $new_date->format('Y');
        $this->id = $id;
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
        return !Application::where('app_number', $value)
            ->whereYear('date', $this->year)
            ->where('id', '<>', $this->id)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "<p style=\"color:red\">Ariza raqami noto'g'ti shaklda kiritilgan yoki oldindan mavjud</p>";
    }
}
