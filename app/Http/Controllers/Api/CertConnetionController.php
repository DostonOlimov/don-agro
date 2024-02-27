<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\CropsName;
use App\Models\CropsType;
use App\Models\OrganizationCompanies;
use Illuminate\Http\Request;

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
        $rules = [
            "name" => 'required|string|max:255',
            "city_id" => 'required|numeric',
            "address" => 'required|string|max:255',
            "owner_name" => 'required|string|max:255',
            "phone_number" => 'required|string|max:15',
            "inn" => 'required|digits:9',
        ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->errorJson( $validator->errors(), 422, 'Validation error');
    }

    $model = OrganizationCompanies::create([
        'name' => $request->input('name'),
        'city_id' => $request->input('city_id'),
        'address' => $request->input('address'),
        'owner_name' => $request->input('owner_name'),
        'phone_number' => $request->input('phone_number'),
        'inn' => $request->input('inn'),
    ]);

    return response()->successJson($model,201);
    }
}
