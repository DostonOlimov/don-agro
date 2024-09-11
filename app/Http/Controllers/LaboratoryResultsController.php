<?php

namespace App\Http\Controllers;

use App\Models\CropsName;
use App\Models\Indicator;
use App\Models\LaboratoryFinalResults;
use App\Models\LaboratoryIndicators;
use App\Models\LaboratoryNumbers;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryResultUsers;
use App\Models\TestProgramIndicators;
use App\Models\TestPrograms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaboratoryResultsController extends Controller
{

    //  list
    public function list(Request $request)
    {
        $user = Auth::user();
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');

        $apps = TestPrograms::with('application')
            ->with('application.crops.name')
            ->with('application.crops.type')
            ->with('application.organization')
            ->with('final_result')
            ->with('status_change')
            ->with('laboratory_numbers');
        // ->whereNotNull('code');
        $apps->where('status', '>=', TestPrograms::STATUS_SEND);
        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps->whereHas('application', function ($query) use ($fromTime, $tillTime) {
                $apps = $query->whereDate('date', '>=', $fromTime)
                    ->whereDate('date', '<=', $tillTime);
            });
        }
        if ($crop) {
            $apps = $apps->whereHas('application.crops', function ($query) use ($crop) {
                $query->where('name_id', '=', $crop);
            });
        }
        $apps->when($request->input('s'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                if (is_numeric($searchQuery)) {
                    $query->whereHas('application', function ($query) use ($searchQuery) {
                        $query->where('app_number', $searchQuery);
                    });
                } else {
                    $query->whereHas('application.crops.name', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    })->orWhereHas('application.crops.type', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    });
                }
            });
        });

        $tests = $apps->orderBy('status')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['till' => $request->input('till')])
            ->appends(['from' => $request->input('from')])
            ->appends(['crop' => $request->input('crop')]);
        return view('laboratory_results.list', compact('tests', 'from', 'till', 'crop'));
    }

    public function indicator($id)
    {
        $crop = CropsName::find($id);
        $indicators = Indicator::with('nds.crops')->whereHas('nds.crops', function ($query) use ($id){
            $query->where('id',$id);
        })->get();
        // dd($indicators);
        return view('laboratory_results.indicator', compact('indicators', 'id'));
    }
    public function indicator_view($indicator_id, $number_id, Request $request)
    {
        $test_id = $request->input('test_id');
        // $numbers = LaboratoryNumbers::with('test_program')
        //     ->with('test_program.application')
        //     ->with('results')
        //     ->whereHas('test_program.application.crops', function ($query) use ($number_id) {
        //         $query->where('name_id', '=', $number_id);
        //     })
        //     ->whereHas('test_program.indicators', function ($query) use ($indicator_id) {
        //         $query->where('indicator_id', '=', $indicator_id);
        //     });                                                                                                       ///labaratoriya number
        // if ($test_id) {
        //     $numbers = $numbers->whereHas('test_program', function ($query) use ($test_id) {
        //         $query->where('id', $test_id);
        //     });
        // }
        // $numbers = $numbers->orderBy('number', 'desc')->paginate(50);
        $numbers=null;
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

    //show
    public function show($test_id)
    {
        $test = TestPrograms::with('indicators')
            ->with('laboratory_numbers')
            ->find($test_id);
        $crop_id = optional(optional($test->application)->crops)->name->id;

        return view('laboratory_results.view', compact('test', 'crop_id'));
    }
    //add
    public function add($test_id)
    {
        $test = TestPrograms::with('indicators')
            ->with('laboratory_numbers')
            ->find($test_id);
        $crop_id = optional(optional($test->application)->crops)->name->id;

        return view('laboratory_results.add', compact('test', 'crop_id'));
    }

    public function store(Request $request)
    {
        $userA = Auth::user();
        $id = $request->input('id');
        $test = TestPrograms::find($id);
        $indicators = TestProgramIndicators::where('test_program_id', $id)
            ->get();

        foreach ($indicators as $indicator) {

            $value =  $request->input('value' . $indicator->id);
            $default = 0;
            $addition_value = $indicator->indicator->default_value()->where('generation_id',$test->application->crops->type_id)->first();
            if($addition_value){
                $default = $addition_value->value;
            }else{
                $default = $indicator->indicator->value;
            }

            if(optional($indicator->indicator)->measure_type == 1){
                $t = $default <= $value;
            }else{
                $t = $default >= $value;
            }

            $indicator->result = $value;
            $indicator->type = $t ? 1 : 0;
            $indicator->save();
        }

        return redirect('/laboratory-results/list')->with('message', 'Successfully Submitted');
    }

    //edit
    public function edit($test_id)
    {
        $test = TestPrograms::with('indicators')
            ->with('laboratory_numbers')
            ->find($test_id);
        $crop_id = optional(optional($test->application)->crops)->name->id;

        return view('laboratory_results.edit', compact('test', 'crop_id'));
    }

    public function update(Request $request)
    {
        $userA = Auth::user();
        $id = $request->input('id');
        $test = TestPrograms::find($id);
        $indicators = TestProgramIndicators::where('test_program_id', $id)
            ->get();

        foreach ($indicators as $indicator) {

            $value =  $request->input('value' . $indicator->id);
            $default = 0;
            $addition_value = $indicator->indicator->default_value()->where('generation_id',$test->application->crops->type_id)->first();
            if($addition_value){
                $default = $addition_value->value;
            }else{
                $default = $indicator->indicator->value;
            }

            if(optional($indicator->indicator)->measure_type == 1){
                $t = $default <= $value;
            }else{
                $t = $default >= $value;
            }

            $indicator->result = $value;
            $indicator->type = $t ? 1 : 0;
            $indicator->save();
        }

        return redirect('/laboratory-results/list')->with('message', 'Successfully Submitted');
    }

}
