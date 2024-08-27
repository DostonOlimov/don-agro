<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ApplicationFilter;
use App\Http\Resources\V1\AppForeignFileResource;
use App\Http\Resources\V1\ApplicationCollection;
use App\Http\Resources\V1\ApplicationResource;
use App\Http\Resources\V1\CropDataResource;
use App\Models\AppForeignFile;
use App\Models\Application;
use App\Models\CropData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class ApplicationFileController extends Controller
{

    public function store(Request $request)
    {
        // Define validation rules with camelCase attribute names
        $rules = [
            'appId' => 'required|exists:applications,id',
            'filePath' => 'required',
        ];

        // Define custom validation messages
        $messages = [
            'required' => 'The :attribute field is mandatory and cannot be left empty.',
            'exists' => 'The selected :attribute is invalid.',
            // Add other custom messages here
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        // Create a new company record
        $application = AppForeignFile::create([
            'app_id' => $validatedData['appId'],
            'sess_file' =>  $validatedData['filePath'],
        ]);

        // Return the created company as a resource
        return $this->successResponse(
            new AppForeignFileResource($application),
            'Application file created successfully',
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, $id)
    {
        try {
            // Define validation rules with camelCase attribute names
            $rules = [
                'appId' => 'required|exists:applications,id',
                'filePath' => 'required',
            ];

            // Define custom validation messages
            $messages = [
                'required' => 'The :attribute field is mandatory and cannot be left empty.',
                'exists' => 'The selected :attribute is invalid.',
                // Add other custom messages here
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validatedData = $validator->validated();

            // Find the existing company record
            $company = AppForeignFile::findOrFail($id);

            // Update the company record
            $company->update([
                'app_id' => $validatedData['appId'],
                'sess_file' =>   $validatedData['filePath'],
            ]);

            // Return the updated company as a resource
            return $this->successResponse(
                new AppForeignFileResource($company),
                'Application file updated successfully'
            );

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

