<?php

namespace App\Http\Controllers;

use App\Models\CropsName;
use App\Models\Indicator;
use App\Models\LaboratoryIndicators;
use App\Models\LaboratoryNumbers;
use App\Models\LaboratoryResult;
use Illuminate\Http\Request;

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
        $indicators = Indicator::where('crop_id', $id)
            ->get();
        return view('laboratory_results.indicator', compact('indicators', 'id'));
    }
    public function indicator_view($indicator_id, $number_id, Request $request)
    {
        $test_id = $request->input('test_id');
        $numbers = LaboratoryNumbers::with('test_program.indicators')
            ->with('test_program.application.crops')
            ->with('results')
            ->whereHas('test_program.application.crops', function ($query) use ($number_id) {
                $query->where('name_id', '=', $number_id);
            })
            ->whereHas('test_program.indicators', function ($query) use ($indicator_id) {
                $query->where('indicator_id', '=', $indicator_id);
            });
        if ($test_id) {
            $numbers = $numbers->whereHas('test_program', function ($query) use ($test_id) {
                $query->where('id', $test_id);
            });
        }

        $numbers = $numbers->paginate(50);
        $indicators = LaboratoryIndicators::with('childs')
            ->with('parent')
            ->with('indicators')
            ->whereHas('indicators', function ($query) use ($indicator_id) {
                $query->where('indicator_id', '=', $indicator_id);
            })
            ->get();
        $value_indicators = LaboratoryIndicators::with('childs')
            ->with('parent')
            ->with('indicators')
            ->whereHas('indicators', function ($query) use ($indicator_id) {
                $query->where('indicator_id', '=', $indicator_id);
            })
            ->where('type', '!=', '0')
            ->orderBy('type')
            ->get();
        return view('laboratory_results.indicator_view', compact('numbers', 'indicators', 'value_indicators', 'number_id'));
    }
    public function save_result(Request $request)
    {
        $this->authorize('add_param', \App\Models\LaboratoryResult::class);
        $indicator_id = $request->input('indicator_id');
        $number_id = $request->input('number_id');
        $value = $request->input('value');
        $result = LaboratoryResult::where('laboratory_indicator_id', $indicator_id)
            ->where('number_id', $number_id)
            ->first();
        if ($value >= 0 and $value <= 100000) {
            if ($result) {
                $result->value = $value;
                $result->updated_by = auth()->user()->id;
                $result->save();
            } else {
                $new_result = new LaboratoryResult();
                $new_result->laboratory_indicator_id = $indicator_id;
                $new_result->number_id = $number_id;
                $new_result->value = $value;
                $new_result->created_by = auth()->user()->id;
                $new_result->save();
            }
        }

        return response()->json(['message' => 'Answer saved successfully']);
    }
}
