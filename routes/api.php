<?php

use App\Http\Controllers\Api\AppOnlineController;
use App\Http\Controllers\Api\CertConnetionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Place the login route outside of the auth:sanctum middleware group
Route::post('/v1/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

// Protected routes
Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum' // Apply the auth:sanctum middleware to the group
], function () {
    Route::apiResource('applications', ApplicationController::class);
    Route::apiResource('files', ApplicationFileController::class);
    Route::apiResource('states', StateController::class);
    Route::apiResource('cities', CityController::class);
    Route::apiResource('factories', FactoryController::class);
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('crop_types', CropTypeController::class);
    Route::apiResource('crop_generations', CropGenerationController::class);
    Route::apiResource('crop_names', CropNameController::class);
    Route::apiResource('crop_data', CropDataController::class);
});
