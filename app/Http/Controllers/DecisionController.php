<?php

namespace App\Http\Controllers;

use App\Models\AKT;
use App\Models\Application;
use App\Models\AppRequirement;
use App\Models\CropData;
use App\Models\Decision;
use App\Models\LabBayonnoma;
use App\Models\Laboratories;
use App\Models\Nds;
use App\Models\TestPrograms;
use App\tbl_activities;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DecisionController extends Controller
{
    //search
    public function search(Request $request)
    {
        $user = Auth::user();
        $city = $request->input('city');
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');

        $apps = Application::with('crops')
            ->with('crops.name')
            ->with('crops.type')
            ->with('organization')
            ->with('decision')
            ->with('tests.final_result')
            ->whereIn('status', [Application::STATUS_ACCEPTED, Application::STATUS_FINISHED]);

        if ($user->role == \App\Models\User::STATE_EMPLOYEE) {
            $user_city = $user->state_id;
            $apps = $apps->whereHas('organization', function ($query) use ($user_city) {
                $query->whereHas('city', function ($query) use ($user_city) {
                    $query->where('state_id', '=', $user_city);
                });
            });
        }
        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps = $apps->whereDate('date', '>=', $fromTime)
                ->whereDate('date', '<=', $tillTime);
        }
        if ($city) {
            $apps = $apps->whereHas('organization', function ($query) use ($city) {
                $query->whereHas('city', function ($query) use ($city) {
                    $query->where('state_id', '=', $city);
                });
            });
        }
        if ($crop) {
            $apps = $apps->whereHas('crops', function ($query) use ($crop) {
                $query->where('name_id', '=', $crop);
            });
        }
        $apps->when($request->input('s'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                if (is_numeric($searchQuery)) {
                    $query->orWhere('app_number', $searchQuery);
                } else {
                    $query->whereHas('crops.name', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    })->orWhereHas('crops.type', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                        // })->orWhereHas('crops.generation', function ($query) use ($searchQuery) {
                        //     $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    });
                }
            });
        });

        $apps = $apps->latest('app_number')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['till' => $request->input('till')])
            ->appends(['from' => $request->input('from')])
            ->appends(['city' => $request->input('city')])
            ->appends(['crop' => $request->input('crop')]);
        return view('decision.search', compact('apps', 'from', 'till', 'city', 'crop'));
    }
    //index
    public function add($id)
    {
        $app = Application::with("crops.type", "crops.name")->find($id);
        $qrCode = null;
        if ($nd = Nds::where('crop_id', '=', $app->crops->name->id)->first()) {
            $laboratories = Laboratories::get();
            $directors = User::where('role', '=', 55)->get();
            return view('decision.add', compact('app', 'nd', 'directors', 'laboratories', 'qrCode'));
        } else {
            return redirect('nds/list')->with('message', 'nds not found');
        }
    }

    //  store
    public function store(Request $request)
    {
        $userA = Auth::user();
        $this->authorize('create', User::class);
        $app_id = $request->input('app_id');
        $director_id = $request->input('director_id');
        $laboratory_id = $request->input('laboratory_id');
        $date = $request->input('date');
        $data = '';
        $requirements = AppRequirement::where('app_id', $app_id)->get();
        foreach ($requirements as $value) {
            $data .= $value->requirement->name . ', ';
        }

        $decision = new Decision();
        $decision->app_id = $app_id;
        $decision->director_id = $director_id;
        $decision->laboratory_id = $laboratory_id;
        $decision->requirement = $data;
        $decision->date = $date;
        $decision->created_by = $userA->id;
        $decision->status = Decision::STATUS_NEW;
        $decision->save();

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $decision->id;
        $active->action_type = 'new_decision';
        $active->action = "Yangi buyruq qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        $measure_type = CropData::getMeasureType(Application::find($app_id)->crops->measure_type);
        // $nds_type = Nds::getType(Application::find($app_id)->crops->name->nds->type_id);

        $nds = [];
        foreach (Nds::where('crop_id', Application::find($decision->app_id)->crops->name_id)->get() as $item) {
            $nds[] = Nds::getType($item->type_id) . " " . $item->number . " " . $item->name;
        }
        $nds=implode(",", $nds);

        return
            [
                'decision' => $decision->fresh(
                    [
                        'application.organization',
                        'laboratory', 'application.crops',
                        'application.crops.name',
                        'application.crops.name.nds',
                        'application.crops.type',
                        // 'application.crops.generation',
                        'director'
                    ]
                ),
                'measure_type' => $measure_type,
                'nds' => $nds
                // 'nds_type' => $nds_type,
            ];
    }

    public function destory($id)
    {
        $this->authorize('mydelete', Application::class);
        $decision = Decision::find($id);
        $test = TestPrograms::where('app_id', $decision->app_id)->first();
        if ($test) {
            $akt = AKT::where('test_program_id', $test->id)->first();
            if ($akt) {
                LabBayonnoma::where("akt_id", $akt->id)->delete();
                $akt->delete();
            }
            $test->delete();
        }
        Decision::destroy($id);
        return redirect('decision/search')->with('message', 'Successfully Deleted');
    }
    public function view($id)
    {
        $decision = Decision::with('director')
            ->with('application.organization')
            ->with('application.crops')
            ->with('application.crops.name')
            ->with('application.crops.name.nds')
            ->with('application.crops.type')
            // ->with('application.crops.generation')
            ->with('application.tests.result')
            ->with('laboratory')
            ->find($id);
        //create qr code
        $url = route('decision.view', $id);
        $qrCode = null;
        if ($decision->application->tests->result) {
            $qrCode = QrCode::size(100)->generate($url);
        }
        $measure_type = CropData::getMeasureType(Application::find($decision->app_id)->crops->measure_type);
        // $nds_type = Nds::getType(Application::find($decision->app_id)->crops->name->nds->type_id);

        $nds = [];
        foreach (Nds::where('crop_id', Application::find($decision->app_id)->crops->name_id)->get() as $item) {
            $nds[] = Nds::getType($item->type_id) . " " . $item->number . " " . $item->name;
        }
        $nds=implode(",", $nds);

        return view('decision.show', [
            'decision' => $decision,
            'measure_type' => $measure_type,
            // 'nds_type' => $nds_type,
            'nds' => $nds,
            'qrCode' => $qrCode
        ]);
    }

    // qaror sanasi bo'ycha validation
    public function between_date($decision_date)
    {
        $date = Carbon::parse($decision_date);
        $now = Carbon::now();

        if ($date->diffInDays($now) > 2) {
            return redirect('decision/search')->with('message', "The {$decision_date} must be within a two-day range");
        }
    }


    //    public function qaror($code)
    //    {
    //        $decision = Decision::with('director')
    //            ->with('application.organization')
    //            ->with('application.crops')
    //            ->with('application.crops.name')
    //            ->with('application.crops.name.nds')
    //            ->with('application.crops.type')
    //            ->with('application.crops.generation')
    //            ->with('application')
    //            ->with('laboratory')
    //            ->find($id);
    //        //create qr code
    //        $url = route('decision.view', $id);
    //        $qrCode = null;
    //        if($decision->code){
    //            $qrCode = QrCode::size(100)->generate($url);
    //        }
    //        $measure_type = CropData::getMeasureType(Application::find($decision->app_id)->crops->measure_type);
    //        $nds_type = Nds::getType(Application::find($decision->app_id)->crops->name->nds->type_id);
    //        return view('decision.show', [
    //            'decision' => $decision,
    //            'measure_type'=>$measure_type,
    //            'nds_type'=>$nds_type,
    //            'qrCode'=>$qrCode
    //        ]);
    //    }

}
