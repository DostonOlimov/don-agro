<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CropData;
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

    public function crop_data() 
    {
        $cropData=CropData::with('name')->with('type')->get();
        // dd(request()->getHost());
        return response()->successJson($cropData);
    }
}
