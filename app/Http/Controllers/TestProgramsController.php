<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
use App\tbl_activities;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestProgramsController extends Controller
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
            ->with('tests')
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
        return view('tests.search', compact('apps', 'from', 'till', 'city', 'crop'));
    }
    //index
    public function add($id)
    {
        $app = Application::with('crops.name.nds')->find($id);

        if ($nd = Nds::where('crop_id', '=', $app->crops->name->id)->first()) {
            $measure_types = CropData::getMeasureType();
            unset($measure_types[1]);
            $directors = User::where('role', '=', 55)->get();
            $indicators = Indicator::where('crop_id', '=', $app->crops->name->id)
                ->get();
            return view('tests.add', compact('app', 'nd', 'directors', 'measure_types', 'indicators'));
        } else {
            return redirect('nds/list')->with('message', 'nds not found');
        }
    }

    //  store
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $userA = Auth::user();
        $app_id = $request->input('app_id');
        $director_id = $request->input('director_id');
        // $count = $request->input('count');
        // $measure_type = $request->input('measure_type');
        // $amount = $request->input('amount');
        $checkbox = $request->input('checkbox');
        $data = $request->input('data');

        $tests = new TestPrograms();
        $tests->app_id = $app_id;
        // $tests->count = $count;
        // $tests->measure_type = $measure_type;
        // $tests->weight = $amount;
        $tests->extra_data = $data;
        $tests->director_id = $director_id;
        $tests->save();

        if (!empty($checkbox)) {
            foreach ($checkbox as $check) {
                $ch = new TestProgramIndicators();
                $ch->indicator_id = $check;
                $ch->test_program_id = $tests->id;
                $ch->save();
            }
        }
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $tests->id;
        $active->action_type = 'new_tests';
        $active->action = "Yangi sinov dasturi qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        return redirect('/tests/search')->with('message', 'Successfully Submitted');
    }

    public function edit($id)
    {
        $editid = $id;
        $userA = Auth::user();
        $test = TestPrograms::find($editid);
        $app = Application::with('crops.name.nds')->find($test->app_id);

        $measure_types = CropData::getMeasureType();
        $directors = User::where('role', '=', 55)->get();
        $indicators = Indicator::where('crop_id', '=', $app->crops->name->id)
            ->get();

        return view('tests.edit', compact('app', 'test', 'directors', 'indicators', 'measure_types'));
    }


    // application update

    public function update($id, Request $request)
    {
        $this->authorize('update', User::class);
        $userA = Auth::user();
        $app_id = $request->input('app_id');
        $director_id = $request->input('director_id');
        // $count = $request->input('count');
        // $measure_type = $request->input('measure_type');
        // $amount = $request->input('amount');
        $checkbox = $request->input('checkbox');
        $data = $request->input('data');

        $tests = TestPrograms::find($id);
        $tests->app_id = $app_id;
        // $tests->count = $count;
        // $tests->measure_type = $measure_type;
        // $tests->weight = $amount;
        $tests->extra_data = $data;
        $tests->director_id = $director_id;
        $tests->save();
        TestProgramIndicators::where('test_program_id', '=', $id)
            ->delete();
        if (!empty($checkbox)) {
            foreach ($checkbox as $check) {
                $ch = new TestProgramIndicators();
                $ch->indicator_id = $check;
                $ch->test_program_id = $tests->id;
                $ch->save();
            }
        }

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $tests->id;
        $active->action_type = 'edit_test';
        $active->action = "Sinov dasturi yangilandi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        return redirect('/tests/search')->with('message', 'Successfully Updated');
    }


    public function destory($id)
    {
        $this->authorize('delete', User::class);
        Decision::destroy($id);
        return redirect('test/search')->with('message', 'Successfully Deleted');
    }
    public function view($id)
    {
        $tests = TestPrograms::with('director')
            ->with('application.crops')
            ->with('application.crops.name')
            ->with('application.crops.name.nds')
            ->with('application.crops.type')
            // ->with('application.crops.generation')
            ->with('application')
            ->find($id);
        $indicators = TestProgramIndicators::where('test_program_id', '=', $id)
            ->with('indicator')
            ->with('tests')
            ->get();
        $url = route('tests.view', $id);
        $qrCode = null;
        if ($tests->code) {
            $qrCode = QrCode::size(100)->generate($url);
        }

        $measure_type = (Application::find($tests->app_id)->crops->name->measure_type == 2) ? "dona" : "kg";
        $nds_type = Nds::getType(Application::find($tests->app_id)->crops->name->nds->type_id);
        return view('tests.show', [
            'decision' => $tests,
            'measure_type' => $measure_type,
            'nds_type' => $nds_type,
            'indicators' => $indicators,
            'qrCode' => $qrCode
        ]);
    }

    // send test programs to laboratory
    public function send($id)
    {
        $userA = Auth::user();
        $test = TestPrograms::find($id);
        $this->authorize('send', $test);

        $app = Application::find($test->app_id);
        $decision = Decision::where('app_id', $app->id)->first();
        //code for test programs and decisions decesion start with 2 and test_program start with 3
        $code1 = 30000000 + ($app->getYear() - 2000) * 100000 + $test->id;
        $code2 = 20000000 + ($app->getYear() - 2000) * 100000 + $decision->id;

        //desicion save
        $decision->code = $code2;
        $decision->save();

        $test->code = $code1;
        $test->save();

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $test->id;
        $active->action_type = 'sent_test';
        $active->action = "Sinov dasturi laboratoriyaga yuborildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();


        return redirect('tests/search')->with('message', 'Successfully Submitted');
    }

    public function lab_view($id)
    {
        $tests = TestPrograms::with('director')
            ->with('application.crops')
            ->with('application.crops.name')
            ->with('application.crops.name.nds')
            ->with('application.crops.type')
            // ->with('application.crops.generation')
            ->with('application')
            ->find($id);
        $indicators = TestProgramIndicators::where('test_program_id', '=', $id)
            ->with('indicator')
            ->with('tests')
            ->get();
        $url = route('tests.view', $id);
        $qrCode = null;
        if ($tests->code) {
            $qrCode = QrCode::size(100)->generate($url);
        }
        $max_number = LaboratoryNumbers::max('number');

        $measure_type = (Application::find($tests->app_id)->crops->name->measure_type == 2) ? "dona" : "kg";
        $nds_type = Nds::getType(Application::find($tests->app_id)->crops->name->nds->type_id);
        return view('tests.lab_view', [
            'decision' => $tests,
            'measure_type' => $measure_type,
            'nds_type' => $nds_type,
            'indicators' => $indicators,
            'qrCode' => $qrCode,
            'max_number' => $max_number
        ]);
    }
}
