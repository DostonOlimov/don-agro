<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CropData;
use Illuminate\Support\Facades\Validator;
use App\Models\CropsName;
use App\Models\CropsType;
use App\Models\OrganizationCompanies;
use App\Models\PreparedCompanies;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Array_;

class CertConnetionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('login');
    }
    public function login(Request $request)
    {
        $params = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($params)) {
            return response()->json('bizda bunday user yoq');
        }


        $token = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => $token]);
    }

    public function crop_name()
    {
        $cropData = CropsName::get();
        // dd(request()->getHost());
        return response()->successJson($cropData);
    }
    public function crop_type(Request $request)
    {
        $name_id = $request->id;
        if ($name_id) {
            $cropData = CropsType::where('crop_id', $name_id)->get();

            return response()->successJson($cropData);
        }
        return abort(404);
    }

    public function organization_company(Request $request)
    {
        // unset($data['id']);
        $data = $request->all()['data'];

        if (isset($data['inn'])) {
            $model = OrganizationCompanies::where('inn', $data['inn'])->first();

            if ($model) {
                return response()->json($model->id);
            } else {
                $data = OrganizationCompanies::create($data);
                return response()->json($data->id);
            }
        } else {
            return response()->json(null);
        }
    }
    public function prepared_company(Request $request)
    {
        $name = $request->input('name');
        $country_id = $request->input('country_id');
        $state_id = $request->input('state_id');

        if ($name !== null) {
            $model = PreparedCompanies::where('name', 'like', $name)
                ->where('country_id', $country_id)
                ->where('state_id', $state_id)
                ->first();

            if ($model) {
                return response()->json($model->id);
            } else {
                $newModel = PreparedCompanies::create([
                    'name' => $name,
                    'country_id' => $country_id,
                    'state_id' => $state_id,
                ]);
                return response()->json($newModel->id);
            }
        } else {
            return response()->json(null);
        }
    }

    public function full_data(Request $request)
    {
        $rules = [
            'app_type' => 'required|numeric',
            'name_id' => 'required|numeric',
            'type_id' => 'nullable|numeric',
            'kodtnved' => 'required|numeric',
            'country_id' => 'required|numeric',
            'measure_type' => 'required|numeric',
            'amount' => 'required|numeric',
            'year' => 'required|numeric',
            'sxema_number' => 'required|numeric',
            'inn' => 'required|digits:9',
            'user_id' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'prepared_id' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->errorJson($validator->errors(), 422, 'Validation error');
        }



        $userA = Auth::user();
        $crop = CropData::create([
            'name_id' => $request->input('name_id'),
            'type_id' => $request->input('type_id') ?? null,
            'kodtnved' => $request->input('kodtnved'),
            'measure_type' => $request->input('measure_type'),
            'amount' => $request->input('amount'),
            'sxeme_number' => $request->input('sxema_number'),
            'year' => $request->input('year'),
            'country_id' => $request->input('country_id'),
        ]);
        if (!$crop) {
            return response()->errorJson(null, 422, 'Crop not created');
        }

        $now = Carbon::now()->format('Y-m-d');
        $application = Application::create([
            'app_number' => 0,  //tastiqlangandan keyin oladi raqamni
            'crop_data_id' => $crop->id,
            'organization_id' => $request->input('organization_id'),
            'prepared_id' => $request->input('prepared_id'),
            'type'  => $request->input('app_type'),
            'date' => $now,
            // 'accepted_date', //null qabul qilingan vaqt
            // 'accepted_id' => , //null qabul qiluvchi id si
            // 'data',
            'status' => Application::STATUS_FINISHED,
            'created_by' => $request->input('user_id'),
        ]);

        if ($application) {
            $active = new tbl_activities();
            $active->ip_adress = $_SERVER['REMOTE_ADDR'];
            $active->user_id = $userA->id;
            $active->action_id = $application->id;
            $active->action_type = 'from_agrocert_app_add';
            $active->action = "Ariza qo'shildi Urug'dan";
            $active->time = date('Y-m-d H:i:s');
            $active->save();
            return response()->successJson(['application' => $application, 'crop' => $crop], 201);
        }
        return response()->errorJson(null, 422, 'Application not created');
    }
}
