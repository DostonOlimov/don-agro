<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppStatusChanges;
use App\Models\CropData;
use App\Models\CropProductionType;
use App\Models\Decision;
use App\Models\Indicator;
use App\Models\Laboratories;
use App\Models\LaboratoryNumbers;
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
        $city = $request->input('city');
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');

        $apps= TestPrograms::with('application')
            ->with('application.crops.name')
            ->with('application.crops.type')
            ->with('application.organization')
            ->with('final_result')
            ->whereNotNull('code');
        if ($user->role == \App\Models\User::STATE_EMPLOYEE) {
            $user_city = $user->state_id;
            $apps = $apps->whereHas('application.organization', function ($query) use ($user_city) {
                $query->whereHas('city', function ($query) use ($user_city) {
                    $query->where('state_id', '=', $user_city);
                });
            });
        }
        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps->whereHas('application', function ($query) use ($fromTime,$tillTime) {
                $apps = $query->whereDate('date', '>=', $fromTime)
                    ->whereDate('date', '<=', $tillTime);
            });
        }
        if ($city) {
            $apps = $apps->whereHas('application.organization', function ($query) use ($city) {
                $query->whereHas('city', function ($query) use ($city) {
                    $query->where('state_id', '=', $city);
                });
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
                    })->orWhereHas('application.crops.generation', function ($query) use ($searchQuery) {
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
            ->appends(['city' => $request->input('city')])
            ->appends(['crop' => $request->input('crop')]);
        return view('test_laboratory.list', compact('tests','from','till','city','crop'));
    }

    public function accept($id)
    {
        $app = TestPrograms::find($id);

        return view('test_laboratory.accept',compact('app'));
    }
    public function accept_store(Request $request)
    {
        $this->authorize('accept', TestPrograms::class);

        $id = $request->input('id');
        $number = $request->input('number');
        $test = TestPrograms::find($id);

        $validated = $request->validate([
            'number' => [
                'required', new CheckLaboratoryNumber($test->count),
            ],
        ]);

        for($i=$number;$i < $number + 2*$test->count;$i++){
            $num = new LaboratoryNumbers();
            $num->number = $i;
            $num->test_program_id = $id;
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

        return view('test_laboratory.reject',compact('app'));
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

}
