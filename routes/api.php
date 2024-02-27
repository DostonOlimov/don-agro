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
});
