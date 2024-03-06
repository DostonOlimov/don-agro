<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppStatusChanges;
use App\Models\CropData;
use App\Models\CropProductionType;
use App\Models\CropsName;
use App\Models\Decision;
use App\Models\Indicator;
use App\Models\Laboratories;
use App\Models\LaboratoryFinalResults;
use App\Models\LaboratoryNumbers;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryResultUsers;
use App\Models\Nds;
use App\Models\ProductionType;
use App\Models\TestProgramIndicators;
use App\Models\TestPrograms;
use App\Models\TestProgramStatusChanges;
use App\Rules\CheckLaboratoryNumber;
use App\tbl_activities;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestProgramsLaboratoryController extends Controller
{
    //search
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
        $apps->where('status','>=',TestPrograms::STATUS_SEND);
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

        $tests = $apps->latest('id')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['till' => $request->input('till')])
            ->appends(['from' => $request->input('from')])
            ->appends(['crop' => $request->input('crop')]);
        return view('test_laboratory.list', compact('tests', 'from', 'till', 'crop'));
    }

    public function accept($id)
    {
        $app = TestPrograms::find($id);

        return view('test_laboratory.accept', compact('app'));
    }
    public function accept_store(Request $request)
    {
        $this->authorize('accept', TestPrograms::class);

        $id = $request->input('id');
        $number = $request->input('number');
        $type = $request->input('type') ?? null;
        $test = TestPrograms::with('akt')->find($id);
        $validated = $request->validate([
            'number' => [
                'required', new CheckLaboratoryNumber($test, $type),
            ],
        ]);


        for ($i = $number; $i < $number + $test->akt[0]->party_number; $i++) {
            $num = new LaboratoryNumbers();
            $num->number = $i;
            $num->test_program_id = $id;
            $num->laboratory_category_type = $type;
            $num->year = $test->application->getYear();
            $num->save();
        }

        $test->status = TestPrograms::STATUS_ACCEPTED;
        $test->save();

        $changes = new TestProgramStatusChanges();
        $changes->test_program_id  = $test->id;
        $changes->status_type = TestPrograms::STATUS_ACCEPTED;
        $changes->employee_id = Auth::user()->id;
        $changes->save();

        return redirect('tests-laboratory/list')->with('message', 'Successfully Submitted');
    }

    public function reject(Request $request, $id)
    {
        $app = Application::find($id);

        return view('test_laboratory.reject', compact('app'));
    }
    public function reject_store(Request $request)
    {
        $this->authorize('accept', TestPrograms::class);
        $id = $request->input('id');
        $comment = $request->input('comment');
        $test = TestPrograms::find($id);
        $test->status = TestPrograms::STATUS_REJECTED;
        $test->save();
        $changes = new TestProgramStatusChanges();
        $changes->test_program_id  = $test->id;
        $changes->status_type = TestPrograms::STATUS_REJECTED;
        $changes->comment = $comment;
        $changes->employee_id = Auth::user()->id;
        $changes->save();

        return redirect('tests-laboratory/list')->with('message', 'Successfully Submitted');
    }
    public function report(Request $request)
    {
        $user = Auth::user();
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');

        $apps= TestPrograms::with('application')
            ->with('application.crops.name')
            ->with('application.crops.type')
            ->with('application.organization')
            ->with('final_result')
            ->with('status_change')
            ->where('status',TestPrograms::STATUS_ACCEPTED);
        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps->whereHas('application', function ($query) use ($fromTime,$tillTime) {
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

        $tests = $apps->latest('id')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['till' => $request->input('till')])
            ->appends(['from' => $request->input('from')])
            ->appends(['crop' => $request->input('crop')]);
        return view('test_laboratory.report', compact('tests','from','till','crop'));
    }

    // bilmadim lekin ishlatmadim
    public function report_view($test_id)
    {
        $test = TestPrograms::with('indicators')
            ->with('laboratory_numbers')
            ->with('laboratory_numbers.results')
            ->with('laboratory_numbers.results.users')
            ->find($test_id);
        $originusers = [];

        foreach($test->laboratory_numbers as $mynumbers)
        {
            foreach($mynumbers->results as $myresult){
                $originusers[] = [
                    'id'=>$myresult->users->id,
                    'fullname'=>  $myresult->users->name . ' ' .$myresult->users->lastname,
                ];
            }
        }

        $flattenedArray = call_user_func_array('array_merge', $originusers);

        $uniqueElements = array_unique(array_map('serialize', $originusers));

        $users = array_map('unserialize', $uniqueElements);


        $crop_id = optional(optional($test->application)->crops)->name->id;
        return view('test_laboratory.report_view', compact('test','crop_id','users'));
    }

    //index
    public function add($test_id)
    {
        $test = TestPrograms::with('indicators')
            ->with('laboratory_numbers')
            ->find($test_id);
        $crop_id = optional(optional($test->application)->crops)->name->id;

            return view('test_laboratory.add', compact('test','crop_id'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data' =>['required'],
        ]);
     //   $this->authorize('create', User::class);
        $userA = Auth::user();
        $id = $request->input('id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $harorat = $request->input('harorat');
        $namlik = $request->input('namlik');
        $checkbox = $request->input('checkbox');
        $data = $request->input('data');
        $type = $request->input('type');

        $tests = new LaboratoryFinalResults();
        $tests->test_program_id = $id;
        $tests->end_date = join('-', array_reverse(explode('-', $end_date)));
        $tests->start_date = join('-', array_reverse(explode('-', $start_date)));
        $tests->harorat = $harorat;
        $tests->namlik = $namlik;
        $tests->quality = $type;
        $tests->data = $data;
        $tests->user_id = $userA->id;
        $tests->save();

        $amounts = [];
        if(!empty($checkbox)) {
            foreach ($checkbox as $check) {
                $amounts[] = [
                    'results_id' => $tests->id,
                    'user_id' => $check,
                ];
            }
        }
        DB::transaction(function () use ($amounts) {
            LaboratoryResultUsers::insert($amounts);
        });
        $indicators = TestProgramIndicators::where('test_program_id',$id)
            ->get();
        foreach($indicators as $indicator){
                $indicator->result = $request->input('value'.$indicator->id);
                $indicator->type = $request->input('type'.$indicator->id) ?? 1;
                $indicator->save();
        }
        $test_program = TestPrograms::find($id);
        $test_program->status = TestPrograms::STATUS_FINISHED;
        $test_program->save();

        return redirect('/tests-laboratory/report')->with('message', 'Successfully Submitted');


    }

}
