<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CropProduction;
use App\Models\CropsName;
use App\Models\FinalResult;
use App\Models\Indicator;
use App\Models\LaboratoryFinalResults;
use App\Models\LaboratoryIndicators;
use App\Models\LaboratoryNumbers;
use App\Models\LaboratoryResult;
use App\Models\Sertificate;
use App\Models\TestProgramIndicators;
use App\Models\TestPrograms;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LaboratoryProtocolController extends Controller
{

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
            ->with('laboratory_results')
            ->where(function ($query) {
                $query->where('status', TestPrograms::STATUS_FINISHED)
                    ->orWhere('status', TestPrograms::STATUS_DELETED);
            });
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
            ->appends(['crop' => $request->input('crop')]);
        return view('laboratory_protocol.list', compact('tests', 'from', 'till', 'crop'));
    }
    public function add($id)
    {
        $test = TestPrograms::with('laboratory_results')
            ->find($id);
        return view('laboratory_protocol.add', compact('test'));
    }
    public function store(Request $request)
    {
        $userA = Auth::user();
        //  $this->authorize('create', Application::class);
        $test_id = $request->input('test_id');
        $number = $request->input('number');
        $type = $request->input('type');

        $test = LaboratoryFinalResults::where('test_program_id', $test_id)
            ->first();
        $test->number = $number;
        $test->date = join('-', array_reverse(explode('-', $request->input('date'))));
        $test->save();

        return redirect('/laboratory-protocol/list')->with('message', 'Successfully Submitted');
    }
    public function view($id)
    {
        $test = TestPrograms::with('laboratory_results')
            ->with('laboratory_numbers')
            ->with('laboratory_results.result_users.users')
            ->with('application.organization.city')
            ->with('application.crops')
            ->with('akt')
            ->find($id);

        $start_date = Carbon::createFromFormat('Y-m-d', $test->laboratory_results->start_date)->format('d.m.Y');
        $end_date = Carbon::createFromFormat('Y-m-d', $test->laboratory_results->end_date)->format('d.m.Y');

        $nds_type = $test->application->crops->name->nds;
        $indicators = TestProgramIndicators::where('test_program_id', '=', $id)
            ->with('tests')
            ->whereHas('indicator', function ($query) {
                $query->where('pre_name', '!=', 0);
            })
            ->get();
        $production_type = CropProduction::where('crop_id', $test->application->crop_data_id)->get();
        $qrCode = null;
        if ($test->status == 6) {
            $url = route('lab.view', $id);
            $qrCode = QrCode::size(100)->generate($url);
        }

        return view('laboratory_protocol.view', compact('test', 'nds_type', 'indicators', 'production_type', 'start_date', 'end_date', 'qrCode'));
    }

    function change_status($id)
    {
        $crop = TestPrograms::find($id);
        $crop->status = 6;
        $crop->save();

        return redirect('/laboratory-protocol/list');
    }
}
