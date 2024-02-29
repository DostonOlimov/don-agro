<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Database\QueryException;
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
        $user = Application::withoutGlobalScopes()->with(['organization', 'prepared', 'crops.name', 'crops.type'])->whereYear('date', $year)
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

    public function app_edit(Request $request)
    {
        try {
            $rules = [
                'id' => 'required|numeric',
                'crop_data_id' => 'required|numeric',
                'app_type' => 'required|numeric',
                'user_id' => 'required|numeric',
                'organization_id' => 'required|numeric',
                'prepared_id' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->errorJson($validator->errors(), 422, 'Validation error');
            }

            $application = Application::findOrFail($request->input('id'));
            $application->update([
                'app_number' => 0,  //tastiqlangandan keyin oladi raqamni
                'crop_data_id' => $request->input('crop_data_id'),
                'organization_id' => $request->input('organization_id'),
                'prepared_id' => $request->input('prepared_id'),
                'type'  => $request->input('app_type'),
                // 'date'=>,   // o'zgartirsh mumkinmas ariza bergan sanasini
                // 'accepted_date', //null qabul qilingan vaqt
                // 'accepted_id' => , //null qabul qiluvchi id si
                // 'data'=>,   //
                'status' => Application::STATUS_FINISHED,
                'created_by' => $request->input('user_id'),
            ]);

            if (!$application) {
                return response()->errorJson(null, 404, 'Application ID Not found');
            }

            return response()->successJson($application, 200);
        } catch (QueryException $e) {
            // Check if the error is due to a foreign key constraint violation
            if ($e->errorInfo[1] == 1452) {
                // Handle foreign key constraint violation
                return response()->errorJson(null, 422, 'Foreign key constraint violation: The organization ID provided does not exist.');
            }

            // Handle other query exceptions if needed
            return response()->errorJson(null, 500, 'Database error: ' . $e->getMessage());
        }
    }
    public function app_delete(Request $request)
    {
        $id = $request->input('id');

        $application = Application::find($id);

        if (!$application) {
            return response()->errorJson(null, 404, 'Application not found');
        }

        $application->update(['status' => Application::STATUS_DELETED]);

        return response()->successJson($application, 200, 'Application deleted successfully');
    }
}
