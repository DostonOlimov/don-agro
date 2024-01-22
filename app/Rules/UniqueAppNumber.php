<?php

namespace App\Rules;

use App\Models\Application;
use Illuminate\Contracts\Validation\Rule;

class UniqueAppNumber implements Rule
{
    public $year;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        $new_date = \DateTime::createFromFormat("d.m.Y", $date);
        $this->year = $new_date->format('Y');
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
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Ariza raqami noto'g'ti shaklda kiritilgan yoki oldindan mavjud";
    }
}
