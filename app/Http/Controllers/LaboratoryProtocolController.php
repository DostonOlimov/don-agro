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
use App\Rules\CheckTestLaboratoryNumber;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LaboratoryProtocolController extends Controller
{

    public function list(Request $request)
    {
        $user = Auth::user();
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');
        $status = $request->input('status');

        $apps = TestPrograms::with('application')
            ->with('application.crops.name')
            ->with('application.crops.type')
            ->with('application.organization')
            ->with('akt')                                    ///labaratoriya number
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
        if ($status) {
            if ($status == 6) {
                $apps = $apps->where('status', $status);
            } elseif ($status == 5) {
                $check = $apps->whereHas('laboratory_results', function ($query) {
                    $query->whereNotNull('number');
                })->exists();

                if ($check) {
                    $apps = $apps->where('status', $status);
                }
            } elseif ($status == 1) {
                $apps = $apps->whereHas('laboratory_results', function ($query) {
                    $query->where('number', '=', null);
                });
            }
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
        return view('laboratory_protocol.list', compact('tests', 'from', 'till', 'crop', 'status'));
    }
    public function add($id)
    {
        $test = TestPrograms::with(['laboratory_results', 'application'])
            ->find($id);
        $year = null;
        if (session('year')) {
            $year = session('year');
        } else {
            $year = date('Y');
        }
        $rejectData = (DB::select('
        SELECT
            lfr.id,
            lfr.number,
            a.party_number,
            MAX(lfr.number) as `max_number`
        FROM
            laboratory_final_results lfr
        JOIN
            AKT a ON lfr.test_program_id = a.test_program_id
        WHERE
            YEAR(lfr.end_date) = ' . $year . '
            AND lfr.number IS NOT NULL
        GROUP BY
            lfr.id, lfr.number, a.party_number
        ORDER BY
            `max_number` DESC;
    '));
        $max_number = null;
        if ($rejectData) {
            /*($rejectData[0]->number > 1) ? $checkOne = $rejectData[0]->number :*/
            $checkOne = $rejectData[0]->number - 1;
            $max_number = $rejectData[0]->party_number + $checkOne;
        }
        // dd($rejectData);
        return view('laboratory_protocol.add', compact('test', 'max_number'));
    }
    public function store(Request $request)
    {
        $userA = Auth::user();
        $test_id = $request->input('test_id');
        $number = $request->input('number');
        $type = $request->input('type');
        //  $this->authorize('create', Application::class);
        $test = LaboratoryFinalResults::with(['test_program.akt', 'test_program.application'])->where('test_program_id', $test_id)
            ->first();
        $validated = $request->validate([
            'number' => [
                'required', new CheckTestLaboratoryNumber($test),
            ],
        ]);
        $test->number = $number;
        $test->date = join('-', array_reverse(explode('-', $request->input('date'))));
        $test->save();

        return redirect('/laboratory-protocol/list')->with('message', 'Successfully Submitted');
    }
    public function view($id)
    {
        $test = TestPrograms::with('laboratory_results')
            // ->with('laboratory_numbers')                            ///  laboratory_numbers
            ->with('laboratory_results.result_users.users')
            ->with('application.organization.city')
            ->with('application.crops')
            ->with('akt')
            ->find($id);

        $start_date = Carbon::createFromFormat('Y-m-d', $test->laboratory_results->start_date)->format('d.m.Y');
        $end_date = Carbon::createFromFormat('Y-m-d', $test->laboratory_results->end_date)->format('d.m.Y');

        $nds_type = $test->application->crops->name->nds;
        // $indicators = TestProgramIndicators::where('test_program_id', '=', $id)
        //     ->with('tests')
        //     ->whereHas('indicator', function ($query) {
        //         $query->where('pre_name', '!=', 0);
        //     })
        //     ->get();

        $indicators = TestProgramIndicators::with('indicator.nds.crops')->with('tests')
            ->where('test_program_id', '=', $id)
            ->whereHas('indicator', function ($query) {
                $query->where('pre_name', '!=', 0);
            })->get()
            ->filter(function ($indicator) {
                return $indicator->indicator->nds && $indicator->indicator->nds->type_id !== null;
            })
            ->groupBy(function ($indicator) {
                return $indicator->indicator->nds->type_id;
            });
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

    public function indicator_norm()
    {
        $indicators = Indicator::with('nds.crops')
            // ->whereHas('nds.crops', function ($query) use ($id){
            //     $query->where('id',$id);
            // })
            ->get();
        return view('indicator_norm.list', compact('indicators'));
    }
    public function indicator_norm_modify($id)
    {
        $crops = CropsName::get();
        return view('indicator_norm.modify', [
            'type' => Indicator::findOrFail($id),
            'editid' => $id,
            'crops' => $crops
        ]);
    }

    public function indicator_norm_update(Request $request, $id)
    {
        $type = Indicator::findOrFail($id);
        $type->name = $request->input('name') ?? $type->name;
        $type->nd_name = $request->input('nd_name') ?? $type->nd_name;
        $type->nds_id = $request->input('nds_id') ?? $type->nds_id;
        $type->value = $request->input('value');
        $type->measure_type = $request->input('measure_type');
        $type->comment = $request->input('comment');
        $type->save();

        return redirect('indicator_norm/list')->with('message', 'Successfully Updated');
    }
}
