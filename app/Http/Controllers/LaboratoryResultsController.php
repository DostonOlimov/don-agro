<?php

namespace App\Http\Controllers;

use App\Models\CropsName;
use App\Models\Indicator;
use App\Models\LaboratoryNumbers;

class LaboratoryResultsController extends Controller
{

    //  list
    public function list()
    {
        $crops = CropsName::orderBy('id')->get();
        return view('laboratory_results.list', compact('crops'));
    }

    public function indicator($id)
    {
        $crop = CropsName::find($id);
        $indicators = Indicator::where('crop_id',$id)
            ->where('pre_name',1)
            ->get();
        return view('laboratory_results.indicator', compact('indicators','id'));
    }
    public function indicator_view($indicator_id,$crop)
    {
        $numbers = LaboratoryNumbers::with('test_program')
            ->with('test_program.application')
            ->whereHas('test_program.application.crops', function ($query) use ($crop) {
                  $query->where('name_id', '=', $crop);
              })
            ->get();

        return view('laboratory_results.indicator_view', compact('numbers'));
    }
}
