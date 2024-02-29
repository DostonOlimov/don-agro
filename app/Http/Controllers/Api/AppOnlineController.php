<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppOnlineController extends Controller
{


    public function apps_user(Request $request)
    {
        $id = $request->input('id');
        $page = $request->input('page') ?? 1;
        $rows = 10;
        $year =  $request->input('year');
        $user = Application::withoutGlobalScopes()->with(['organization', 'prepared', 'crops.name','crops.type'])->whereYear('date', $year)
            ->where('created_by', $id)
            ->paginate($rows, ['*'], 'page', $page);

        if (!isset($user)) {
            return response()->json(null);
        }
        return response()->json($user);
    }
    public function app_view(Request $request)
    {
        $rules = [
            'user_id' => 'required|numeric',
            'app_id' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->errorJson($validator->errors(), 422, 'Validation error');
        }

        $user_id = $request->input('user_id');
        $app_id = $request->input('app_id');

        $user = Application::with(['organization', 'prepared', 'crops.name.type'])->where('created_by', $user_id)->where('id', $app_id)->first();

        return response()->successJson($user, 200);
    }
}
