<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CropData;
use App\Models\CropsName;
use App\Models\CropsType;
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

        if(!auth()->attempt($params)){
            return response()->json('bizda bunday user yoq');
        }


        $token = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => $token]);
    }

    public function crop_name()
    {
        $cropData=CropsName::get();
        // dd(request()->getHost());
        return response()->successJson($cropData);
    }
    public function crop_type(Request $request)
    {
        $name_id=$request->id;
        if($name_id){
            $cropData=CropsType::where('crop_id', $name_id)->get();

            return response()->successJson($cropData);
        }
        return abort(404);
    }
}
