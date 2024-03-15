<?php

namespace App\Rules;

use App\Models\LaboratoryFinalResults;
use Illuminate\Contracts\Validation\Rule;

class CheckTestLaboratoryNumber implements Rule
{
    protected $count;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tests)
    {
        $this->count = $tests->test_program->akt[0]->party_number;
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
            if (LaboratoryFinalResults::where('number', $i)
                ->first()
            ) {
                return false;
            } else {
                $rejectData = LaboratoryFinalResults::with('test_program.akt')
                    ->whereRaw('number = (select max(number) from laboratory_final_results)')
                    ->first();
                $max_number = $rejectData->number + $rejectData->test_program->akt[0]->party_number + 1;
                if ($max_number > $value) {
                    return false;
                }
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
        // return `<p style="color:red">Bunday sinov bayonnoma raqami oldindan ro'yxatdan o'tgan</p>`;
    }
}
