<?php

use App\Http\Controllers\Api\CertConnetionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group(['prefix' => 'customers'], function () {
//     Route::get('/', '\App\Http\Controllers\Api\Customercontroller@index')->name('customers.list');
//     Route::get('info', '\App\Http\Controllers\Api\Customercontroller@info')->name('customers.info');
// });

// Route::get('vehicles', '\App\Http\Controllers\Api\VehiclesController@index')->name('vehicles.list');

// Route::get('invoices', '\App\Http\Controllers\Api\InvoicesController@index')->name('invoices.list');
// Route::get('invoices/{id}', '\App\Http\Controllers\Api\InvoicesController@show')->name('invoices.show');

// Route::post('notifications/{notifiableType}/{notifiableId}', 'NotificationsController@store')->name('notifications.store');


Route::post('login', [CertConnetionController::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::post('cropName', [CertConnetionController::class, 'crop_name']);
    Route::get('cropType/{id}', [CertConnetionController::class, 'crop_type']);
    Route::post('organization_company', [CertConnetionController::class, 'organization_company']);
    Route::post('full_data', [CertConnetionController::class, 'full_data']);
    Route::get('apps_user', [CertConnetionController::class, 'apps_user']);
    Route::post('app_view', [CertConnetionController::class, 'app_view']);
});
