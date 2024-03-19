<?php

namespace App\Rules;

use App\Models\LaboratoryFinalResults;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckTestLaboratoryNumber implements Rule
{
    protected $count;
    protected $year;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($test)
    {
        $this->count = $test;
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

        $rejectData = DB::select('
                SELECT
                    lfr.id,
                    lfr.number,
                    a.party_number,
                    MAX(lfr.number) as `max_number`
                FROM
                    laboratory_final_results lfr
                JOIN
                    laboratory_numbers ln ON lfr.test_program_id = ln.test_program_id
                JOIN
                    AKT a ON lfr.test_program_id = a.test_program_id
                WHERE
                    ln.year = ' . $this->year . '
                    AND lfr.number IS NOT NULL
                GROUP BY
                    lfr.id, lfr.number, a.party_number
                ORDER BY
                    `max_number` DESC;
            ');
        if ($rejectData) {
            /* ($rejectData[0]->number > 1) ? $checkOne = 0 :*/
            $checkOne = -1;
            $max_allowed_number = $rejectData[0]->max_number + $rejectData[0]->party_number + $checkOne;
            if ($value > $max_allowed_number) {
                return true;
            } else {
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
        // return `<p style="color:red">Bunday sinov bayonnoma raqami oldindan ro'yxatdan o'tgan</p>`;
    }
}
