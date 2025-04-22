<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\Customercontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/home', ['middleware' => 'auth', 'uses' => '\App\Http\Controllers\HomeController@dashboard']);
        Route::get('/', ['middleware' => 'auth', 'uses' => '\App\Http\Controllers\HomeController@dashboard']);


        Route::post('/register-store', '\App\Http\Controllers\AuthController@store')->name('register.store');
        Route::post('/change-language', [LanguageController::class, 'changeLanguage']);
        Route::post('/change-year', [LanguageController::class, 'changeYear']);

        //Dashboard
        Route::get('/home', ['middleware' => 'auth', 'uses' => '\App\Http\Controllers\HomeController@dashboard']);
        Route::get('/about/{id}', [\App\Http\Controllers\DashboardController::class, 'about']);
        Route::get('/all', [\App\Http\Controllers\DashboardController::class, 'all']);

        //profile
        // Route::get('/instruction', '\App\Http\Controllers\Customercontroller@instruction');
        Route::get('/full-report', '\App\Http\Controllers\ReportController@report')->name('report.full_report');
        // Route::get('/region-report', '\App\Http\Controllers\ReportController@region_report')->name('report.region_report');
        // Route::get('/company-report', '\App\Http\Controllers\ReportController@company_report')->name('report.company_report');
        Route::get('/export', '\App\Http\Controllers\ReportController@excel_export')->name('excel.export');
        Route::get('/city-export', '\App\Http\Controllers\ReportController@excel_city_export')->name('excel.city');
        // Route::get('/sign', '\App\Http\Controllers\Customercontroller@sign');
        Route::post('/save-amount', [\App\Http\Controllers\ReportController::class, 'save_amount'])->name('save.required_amount');



        Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
            Route::get('/list', [UserController::class, 'userslist']);
            Route::get('/list/{id}', [UserController::class, 'usershow']);
            Route::get('/get', [UserController::class, 'get_users']);
        });
        //employee module
        Route::get('/attachments/{id}/download', '\App\Http\Controllers\AttachmentsController@download')->name('attachment.download');

        Route::group(['prefix' => 'employee'], function () {
            Route::get('/list', ['as' => 'listemployeee', 'uses' => '\App\Http\Controllers\employeecontroller@employeelist']);
            Route::get('/add', ['as' => 'addemployeee', 'uses' => '\App\Http\Controllers\employeecontroller@addemployee']);
            Route::post('/store', ['as' => 'storeemployeee', 'uses' => '\App\Http\Controllers\employeecontroller@store']);
            Route::get('/edit/{id}', ['as' => 'editemployeee', 'uses' => '\App\Http\Controllers\employeecontroller@edit']);
            Route::patch('/edit/update/{id}', '\App\Http\Controllers\employeecontroller@update');
            Route::get('/view/{id}', '\App\Http\Controllers\employeecontroller@showemployer');
            Route::get('/list/delete/{id}', ['as' => '/employee/list/delete/{id}', 'uses' => '\App\Http\Controllers\employeecontroller@destory']);
            Route::get('/free_service', ['as' => '/employee/free_service', 'uses' => '\App\Http\Controllers\employeecontroller@free_service']);
            Route::get('/paid_service', ['as' => '/employee/paid_service', 'uses' => '\App\Http\Controllers\employeecontroller@paid_service']);
            Route::get('/repeat_service', ['as' => '/employee/repeat_service', 'uses' => '\App\Http\Controllers\employeecontroller@repeat_service']);
        });
        //settings
        Route::group(['prefix' => 'setting', 'middleware' => 'auth'], function () {

            Route::get('/list', ['as' => 'listlanguage', 'uses' => [LanguageController::class, 'index']]);

            //language
            Route::get('language/direction/list', ['as' => 'listlanguagedirection', 'uses' => [LanguageController::class, 'index1']]);
            Route::post('language/direction/store', ['as' => 'storelanguagedirection', 'uses' => [LanguageController::class, 'store1']]);
            //accessrights
            Route::get('accessrights/add', '\App\Http\Controllers\Accessrightscontroller@addposition');
            Route::post('accessrights/addstore',  '\App\Http\Controllers\Accessrightscontroller@storeposition');
            Route::get('accessrights/list',  '\App\Http\Controllers\Accessrightscontroller@index');
            Route::get('accessrights/list/edit/{id}',  '\App\Http\Controllers\Accessrightscontroller@edit');
            Route::get('accessrights/list/delete/{id}', '\App\Http\Controllers\Accessrightscontroller@delete');
            Route::GET('/accessrights/change_role',  '\App\Http\Controllers\Accessrightscontroller@change_role');

            //general_setting
            // Route::get('general_setting/list', 'GeneralController@index');
            // Route::post('general_setting/store', 'GeneralController@store');

            //currancy
            // Route::post('currancy/store', 'Timezonecontroller@currancy');

            Route::get('/getrole', '\App\Http\Controllers\employeecontroller@getrole');
            // Route::get('messages', 'Admin\MessagesController@index')->name('messages.index');
        });
        //Country City State ajax
        Route::get('/getstatefromcountry', '\App\Http\Controllers\CountryAjaxcontroller@getstate');
        Route::get('/getcityfromstate', '\App\Http\Controllers\CountryAjaxcontroller@getcity')->name('areas.list');
        Route::get('/getnds', '\App\Http\Controllers\CountryAjaxcontroller@getnds')->name('nds.list');
        Route::get('/getcities', '\App\Http\Controllers\CountryAjaxcontroller@getcitiesjson');
        Route::post('/edit-city', '\App\Http\Controllers\CountryAjaxcontroller@edit_city');
        Route::post('/add-city', '\App\Http\Controllers\CountryAjaxcontroller@add_city');
        Route::get('/getcityfromsearch', '\App\Http\Controllers\CountryAjaxcontroller@getcityfromsearch');
        Route::post('/update-state', '\App\Http\Controllers\CountryAjaxcontroller@update_state');

        //Craps ajax
        Route::get('/gettypefromname', '\App\Http\Controllers\CropAjaxController@gettype');
        Route::get('/getgenerationfromname', '\App\Http\Controllers\CropAjaxController@getgeneration');
        Route::get('/getkodtnved/{id}', '\App\Http\Controllers\CropAjaxController@getkodtnved');
        Route::get('/getcompany', '\App\Http\Controllers\CropAjaxController@getcompany')->name('get.company');


        // Cities
        Route::group(['prefix' => 'cities', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\CitiesController@index');
            Route::get('/list', '\App\Http\Controllers\CitiesController@list');
            Route::post('/store', '\App\Http\Controllers\CitiesController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\CitiesController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\CitiesController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\CitiesController@update');
        });
        // Laboratories
        Route::group(['prefix' => 'laboratories', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\LaboratoryController@create');
            Route::get('/list', '\App\Http\Controllers\LaboratoryController@index');
            Route::post('/store', '\App\Http\Controllers\LaboratoryController@store');
            Route::get('/delete/{id}', '\App\Http\Controllers\LaboratoryController@destory');
            Route::get('/edit/{id}', '\App\Http\Controllers\LaboratoryController@edit');
            Route::post('/update/{id}', '\App\Http\Controllers\LaboratoryController@update');
        });
        // Decision Makers
        Route::group(['prefix' => 'decision_maker', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\DecisionMakerController@create');
            Route::get('/list', '\App\Http\Controllers\DecisionMakerController@index');
            Route::post('/store', '\App\Http\Controllers\DecisionMakerController@store');
            Route::get('/delete/{id}', '\App\Http\Controllers\DecisionMakerController@destory');
            Route::get('/edit/{id}', '\App\Http\Controllers\DecisionMakerController@edit');
            Route::post('/update/{id}', '\App\Http\Controllers\DecisionMakerController@update');
        });

        //States
        Route::group(['prefix' => 'states', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\StatesController@index');
            Route::get('/list', '\App\Http\Controllers\StatesController@list');
            Route::post('/store', '\App\Http\Controllers\StatesController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\StatesController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\StatesController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\StatesController@update');
        });

        //Organization Companies
        Route::group(['prefix' => 'organization', 'middleware' => 'auth'], function () {
            Route::get('/add/{id}', '\App\Http\Controllers\OrganizationCompaniesController@add');
            Route::get('/view/{id}', '\App\Http\Controllers\OrganizationCompaniesController@show');
            Route::get('/list', '\App\Http\Controllers\OrganizationCompaniesController@list');
            Route::post('/store', '\App\Http\Controllers\OrganizationCompaniesController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\OrganizationCompaniesController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\OrganizationCompaniesController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\OrganizationCompaniesController@update');
            Route::get('/search_by_name', '\App\Http\Controllers\OrganizationCompaniesController@search');

            Route::get('/my-organization-add', '\App\Http\Controllers\OrganizationCompaniesController@myorganizationadd')->name('myorganizationadd');
            Route::post('/my-organization-store', '\App\Http\Controllers\OrganizationCompaniesController@myorganizationstore')->name('myorganizationstore');
            Route::get('/my-organization-view/{id}', '\App\Http\Controllers\OrganizationCompaniesController@myorganizationview')->name('myorganizationview');
            Route::get('/my-organization-edit/{id}', '\App\Http\Controllers\OrganizationCompaniesController@myorganizationedit')->name('myorganizationedit');
            Route::post('/my-organization-update/{id}', '\App\Http\Controllers\OrganizationCompaniesController@myorganizationupdate')->name('myorganizationupdate');
        });
        //Prepared Companies
        Route::group(['prefix' => 'prepared', 'middleware' => 'auth'], function () {
            Route::get('/add/{id}', '\App\Http\Controllers\PreparedCompaniesController@add');
            Route::get('/list', '\App\Http\Controllers\PreparedCompaniesController@list');
            Route::post('/store', '\App\Http\Controllers\PreparedCompaniesController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\PreparedCompaniesController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\PreparedCompaniesController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\PreparedCompaniesController@update');
            Route::get('/search_by_name', '\App\Http\Controllers\PreparedCompaniesController@search');

            Route::get('/my-prepared-add/{id}', '\App\Http\Controllers\PreparedCompaniesController@mypreparedadd')->name('mypreparedadd');
            Route::post('/my-prepared-store', '\App\Http\Controllers\PreparedCompaniesController@mypreparedstore')->name('mypreparedstore');
        });
        //Crops name
        Route::group(['prefix' => 'crops_name', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\CropsNameController@index');
            Route::get('/list', '\App\Http\Controllers\CropsNameController@list');
            Route::post('/store', '\App\Http\Controllers\CropsNameController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\CropsNameController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\CropsNameController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\CropsNameController@update');
        });
        //Crops type
        Route::group(['prefix' => 'crops_type', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\CropsTypeController@index');
            Route::get('/list', '\App\Http\Controllers\CropsTypeController@list');
            Route::post('/store', '\App\Http\Controllers\CropsTypeController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\CropsTypeController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\CropsTypeController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\CropsTypeController@update');
        });
        //Crops generation
        // Route::group(['prefix' => 'crops_generation', 'middleware' => 'auth'], function () {
        //     Route::get('/add', '\App\Http\Controllers\CropsGenerationController@index');
        //     Route::get('/list', '\App\Http\Controllers\CropsGenerationController@list');
        //     Route::post('/store', '\App\Http\Controllers\CropsGenerationController@store');
        //     Route::get('/list/delete/{id}', '\App\Http\Controllers\CropsGenerationController@destory');
        //     Route::get('/list/edit/{id}', '\App\Http\Controllers\CropsGenerationController@edit');
        //     Route::post('/list/edit/update/{id}', '\App\Http\Controllers\CropsGenerationController@update');
        // });

        //Nds
        Route::group(['prefix' => 'nds', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\NdsController@index');
            Route::get('/list', '\App\Http\Controllers\NdsController@list');
            Route::post('/store', '\App\Http\Controllers\NdsController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\NdsController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\NdsController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\NdsController@update');
        });
        //Crops type
        Route::group(['prefix' => 'indicator', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\IndicatorController@index');
            Route::get('/list', '\App\Http\Controllers\IndicatorController@list');
            Route::post('/store', '\App\Http\Controllers\IndicatorController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\IndicatorController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\IndicatorController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\IndicatorController@update');
        });


        //Requirements
        Route::group(['prefix' => 'requirement', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\RequirementController@index');
            Route::get('/list', '\App\Http\Controllers\RequirementController@list');
            Route::post('/store', '\App\Http\Controllers\RequirementController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\RequirementController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\RequirementController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\RequirementController@update');
        });
        //applications
        Route::group(['prefix' => 'application'], function () {
            Route::get('/list', ['as' => 'listapplication', 'uses' => '\App\Http\Controllers\ApplicationController@applicationlist']);
            Route::get('/my-applications', ['as' => 'myapplications', 'uses' => '\App\Http\Controllers\ApplicationController@myapplications']);

            Route::get('/add', ['as' => 'addapplication', 'uses' => '\App\Http\Controllers\ApplicationController@addapplication']);
            Route::get('/my-application-add', ['as' => 'myapplicationadd', 'uses' => '\App\Http\Controllers\ApplicationController@myapplicationadd']);

            Route::post('/store', ['as' => 'storeapplication', 'uses' => '\App\Http\Controllers\ApplicationController@store']);
            Route::post('/my-application-store', ['as' => 'myapplicationstore', 'uses' => '\App\Http\Controllers\ApplicationController@myapplicationstore']);

            Route::get('/edit/{id}', ['as' => 'editapplication', 'uses' => '\App\Http\Controllers\ApplicationController@edit']);
            Route::get('/my-application-edit/{id}', ['as' => 'myapplicationedit', 'uses' => '\App\Http\Controllers\ApplicationController@myapplicationedit']);

            Route::patch('/edit/update/{id}', '\App\Http\Controllers\ApplicationController@update');
            Route::patch('/my-application-edit/update/{id}', '\App\Http\Controllers\ApplicationController@myapplicationupdate');

            Route::get('/view/{id}', '\App\Http\Controllers\ApplicationController@showapplication');
            Route::get('/my-application-view/{id}', '\App\Http\Controllers\ApplicationController@myapplicationshow');

            Route::get('/list/delete/{id}', ['as' => '/application/list/delete/{id}', 'uses' => '\App\Http\Controllers\ApplicationController@destory']);

            Route::get('/my-file-local', ['as' => '/application/addfilelocal', 'uses' => '\App\Http\Controllers\ApplicationController@addfilelocal']);
            Route::post('/my-file-local-store', ['as' => '/application/addfilelocalstore', 'uses' => '\App\Http\Controllers\ApplicationController@addfilelocal_store']);
            Route::get('/my-file-foreign', ['as' => '/application/addfileforeign', 'uses' => '\App\Http\Controllers\ApplicationController@addfileforeign']);
            Route::post('/my-file-foreign-store', ['as' => '/application/addfileforeignstore', 'uses' => '\App\Http\Controllers\ApplicationController@addfileforeign_store']);
            Route::get('/my-file-old', ['as' => '/application/addfileold', 'uses' => '\App\Http\Controllers\ApplicationController@addfileold']);
            Route::post('/my-file-old-store', ['as' => '/application/addfileoldstore', 'uses' => '\App\Http\Controllers\ApplicationController@addfileold_store']);

            Route::get('/my-file-local-edit/{id}', ['as' => '/application/filelocaledit', 'uses' => '\App\Http\Controllers\ApplicationController@filelocaledit']);
            Route::post('/my-file-local-update', ['as' => '/application/filelocalupdate', 'uses' => '\App\Http\Controllers\ApplicationController@filelocal_update']);
            Route::get('/my-file-foreign-edit/{id}', ['as' => '/application/fileforeignedit', 'uses' => '\App\Http\Controllers\ApplicationController@fileforeignedit']);
            Route::post('/my-file-foreign-update', ['as' => '/application/fileforeignupdate', 'uses' => '\App\Http\Controllers\ApplicationController@fileforeign_update']);
            Route::get('/my-file-old-edit/{id}', ['as' => '/application/fileolddit', 'uses' => '\App\Http\Controllers\ApplicationController@fileoldedit']);
            Route::post('/my-file-old-update', ['as' => '/application/fileoldupdate', 'uses' => '\App\Http\Controllers\ApplicationController@fileold_update']);

            Route::get('/my-application-delete/{id}', ['as' => '/application/myapplicationdelete', 'uses' => '\App\Http\Controllers\ApplicationController@myapplications_delete']);
            Route::get('/accept/{id}', ['as' => '/application/accept', 'uses' => '\App\Http\Controllers\ApplicationController@accept']);
            Route::get('/reject/{id}', ['as' => '/application/reject', 'uses' => '\App\Http\Controllers\ApplicationController@reject']);
            Route::post('/reject/store', ['as' => '/application/rejectstore', 'uses' => '\App\Http\Controllers\ApplicationController@reject_store']);
        });
        //Crops data
        Route::group(['prefix' => 'crops', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\CropDataController@add');
            Route::get('/list', '\App\Http\Controllers\CropDataController@list');
            Route::post('/store', '\App\Http\Controllers\CropDataController@store');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\CropDataController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\CropDataController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\CropDataController@update');
        });
        //Decision
        Route::group(['prefix' => 'decision', 'middleware' => 'auth'], function () {
            Route::get('search', 'App\Http\Controllers\DecisionController@search');
            Route::get('/add/{id}', '\App\Http\Controllers\DecisionController@add');
            Route::get('/list', '\App\Http\Controllers\DecisionController@list');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\DecisionController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\DecisionController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\DecisionController@update');
        });
        Route::get('decision/create', '\App\Http\Controllers\DecisionController@create')->name('decision.create');
        Route::post('decision/store', '\App\Http\Controllers\DecisionController@store')->name('decision.store');
        Route::get('decision/report', '\App\Http\Controllers\DecisionController@report')->name('decision.report');
        Route::get('decision/report/export', '\App\Http\Controllers\DecisionController@export')->name('decision.report.export');
        // Route::resource('decision/payments', '\App\Http\Controllers\PaymentsController', ['as' => 'decision']);
        Route::get('decision/{invoice_id}/serve', '\App\Http\Controllers\DecisionController@serve')->name('decision.serve');
        Route::get('decision/{id}/redo', '\App\Http\Controllers\DecisionController@redo')->name('decision.redo');
        Route::get('decision/view/{id}', '\App\Http\Controllers\DecisionController@view')->name('decision.view');
        //Test programs
        Route::group(['prefix' => 'tests', 'middleware' => 'auth'], function () {
            Route::get('/search', '\App\Http\Controllers\TestProgramsController@search');
            Route::get('/add/{id}', '\App\Http\Controllers\TestProgramsController@add');
            Route::get('/list', '\App\Http\Controllers\TestProgramsController@list');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\TestProgramsController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\TestProgramsController@edit');
            Route::get('/send/{id}', '\App\Http\Controllers\TestProgramsController@send');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\TestProgramsController@update');
            Route::get('/view/{id}', '\App\Http\Controllers\TestProgramsController@view')->name('tests.view');
            Route::get('/laboratory-view/{id}', '\App\Http\Controllers\TestProgramsController@lab_view');
            Route::post('/store', '\App\Http\Controllers\TestProgramsController@store')->name('tests.store');
        });

        // Akt otbora start
        Route::group(['prefix' => 'akt', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\AKTController@list')->name('akt.list');
            Route::get('/add/{id}', ['as' => '/add', 'uses' => '\App\Http\Controllers\AKTController@add']);
            Route::post('/store', ['as' => '/store', 'uses' => '\App\Http\Controllers\AKTController@store']);
            Route::get('/edit/{id}', ['as' => '/edit', 'uses' => '\App\Http\Controllers\AKTController@edit']);
            Route::post('/update/{id}', ['as' => 'update', 'uses' => '\App\Http\Controllers\AKTController@update']);
            Route::get('/delete/{id}', ['as' => 'delete', 'uses' => '\App\Http\Controllers\AKTController@delete']);
        });
        // Akt otbora end

        // LabBayonnoma otbora start
        Route::group(['prefix' => 'lab_bayonnoma', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\LabBayonnomaController@list')->name('lab_bayonnoma.list');
            Route::get('/add/{id}', ['as' => '/lab_bayonnoma/create', 'uses' => '\App\Http\Controllers\LabBayonnomaController@add']);
            Route::post('/store', ['as' => '/lab_bayonnoma/store', 'uses' => '\App\Http\Controllers\LabBayonnomaController@store']);
            Route::get('/edit/{id}', ['as' => '/lab_bayonnoma/edit', 'uses' => '\App\Http\Controllers\LabBayonnomaController@edit']);
            Route::post('/update/{id}', ['as' => '/lab_bayonnoma/update', 'uses' => '\App\Http\Controllers\LabBayonnomaController@update']);
            Route::get('/delete/{id}', ['as' => '/lab_bayonnoma/delete', 'uses' => '\App\Http\Controllers\LabBayonnomaController@delete']);
        });
        // LabBayonnoma otbora end

        //Test programs
        Route::group(['prefix' => 'tests-laboratory', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\TestProgramsLaboratoryController@list')->name('test_laboratory.list');
            Route::get('/accept/{id}', ['as' => '/tests/accept','uses' => '\App\Http\Controllers\TestProgramsLaboratoryController@accept']);
            Route::get('/reject/{id}', ['as' => '/tests/reject','uses' => '\App\Http\Controllers\TestProgramsLaboratoryController@reject']);
            Route::post('/accept/store', ['as' => 'tests.acceptstore','uses' => '\App\Http\Controllers\TestProgramsLaboratoryController@accept_store']);
            Route::post('/reject/store', ['as' => 'tests.rejectstore','uses' => '\App\Http\Controllers\TestProgramsLaboratoryController@reject_store']);
            Route::get('/report', '\App\Http\Controllers\TestProgramsLaboratoryController@report');
            Route::get('/report-view/{id}', '\App\Http\Controllers\TestProgramsLaboratoryController@report_view');
            Route::get('/add/{id}', '\App\Http\Controllers\TestProgramsLaboratoryController@add');
            Route::post('/store', '\App\Http\Controllers\TestProgramsLaboratoryController@store')->name('tests_laboratory.store');
        });


        //Laboratory results
        Route::group(['prefix' => 'laboratory-results', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\LaboratoryResultsController@list');
            Route::get('/indicator/{id}', '\App\Http\Controllers\LaboratoryResultsController@indicator');
            Route::get('/view/{id}', '\App\Http\Controllers\LaboratoryResultsController@show');
            Route::get('/add/{id}', '\App\Http\Controllers\LaboratoryResultsController@add');
            Route::post('/store', '\App\Http\Controllers\LaboratoryResultsController@store');
            Route::get('/edit/{id}', '\App\Http\Controllers\LaboratoryResultsController@edit');
            Route::post('/update', '\App\Http\Controllers\LaboratoryResultsController@update');
            Route::get('/indicator-view/{indicator_id}/{crop_id}', '\App\Http\Controllers\LaboratoryResultsController@indicator_view');
            Route::post('/save-result', [\App\Http\Controllers\LaboratoryResultsController::class, 'save_result'])->name('save.laboratory_result');
        });

        //Laboratory results
        Route::group(['prefix' => 'laboratory-protocol', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\LaboratoryProtocolController@list');
            Route::get('/add/{id}', '\App\Http\Controllers\LaboratoryProtocolController@add');
            Route::get('/view/{id}', '\App\Http\Controllers\LaboratoryProtocolController@view')->name('lab.view');
            Route::post('/store', '\App\Http\Controllers\LaboratoryProtocolController@store');
            Route::get('/change/{id}', '\App\Http\Controllers\LaboratoryProtocolController@change_status');
        });
        //Laboratory indicator norm
        Route::group(['prefix' => 'indicator_norm', 'middleware' => 'auth'], function () {
            Route::get('/list', '\App\Http\Controllers\LaboratoryProtocolController@indicator_norm')->name('indicator_norm');
            Route::get('/list/modify/{id}', '\App\Http\Controllers\LaboratoryProtocolController@indicator_norm_modify');
            Route::put('/list/modify/update/{id}', '\App\Http\Controllers\LaboratoryProtocolController@indicator_norm_update');
        });
        //Final results
        Route::group(['prefix' => 'final_results', 'middleware' => 'auth'], function () {
            Route::get('/search', '\App\Http\Controllers\FinalResultsController@search');
            Route::get('/add/{id}', '\App\Http\Controllers\FinalResultsController@add');
            Route::get('/list', '\App\Http\Controllers\FinalResultsController@list');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\FinalResultsController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\FinalResultsController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\FinalResultsController@update');
            Route::get('/view/{id}', '\App\Http\Controllers\FinalResultsController@view');
            Route::post('/store', '\App\Http\Controllers\FinalResultsController@store');
        });
        //Sertificates
        Route::group(['prefix' => 'sertificate', 'middleware' => 'auth'], function () {
            Route::get('/search', '\App\Http\Controllers\SertificateController@search');
            Route::get('/add/{id}', '\App\Http\Controllers\SertificateController@add');
            Route::get('/list', '\App\Http\Controllers\SertificateController@list');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\SertificateController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\SertificateController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\SertificateController@update');
            Route::get('/view/{id}', '\App\Http\Controllers\SertificateController@view');
            Route::post('/store', '\App\Http\Controllers\SertificateController@store');
        });
        //final decisions
        Route::group(['prefix' => 'final_decision', 'middleware' => 'auth'], function () {
            Route::get('/search', '\App\Http\Controllers\FinalDecisionController@search');
            Route::get('/list', '\App\Http\Controllers\FinalDecisionController@list');
            Route::get('/view/{id}', '\App\Http\Controllers\FinalDecisionController@view');
        });
        //Clients
        Route::group(['prefix' => 'clients', 'middleware' => 'auth'], function () {
            Route::get('/add', '\App\Http\Controllers\ClientsController@index');
            Route::get('/list', '\App\Http\Controllers\ClientsController@list');
            Route::post('/store', '\App\Http\Controllers\ClientsController@store');
            Route::get('/search_by_name', '\App\Http\Controllers\ClientsController@search_by_name');
            Route::get('/list/delete/{id}', '\App\Http\Controllers\ClientsController@destory');
            Route::get('/list/edit/{id}', '\App\Http\Controllers\ClientsController@edit');
            Route::post('/list/edit/update/{id}', '\App\Http\Controllers\ClientsController@update');
        });

        //sifat sertificates online
        Route::group(['prefix' => 'sifat-sertificates'], function () {
            Route::get('/list', ['as'=>'/sifat-sertificates/list', 'uses' => '\App\Http\Controllers\SifatSertificateController@applicationList']);
            Route::get('/add/{id}', ['as'=>'sifat-sertificates.add', 'uses' => '\App\Http\Controllers\SifatSertificateController@addApplication']);
            Route::post('/store', ['uses' => '\App\Http\Controllers\SifatSertificateController@store']);
            Route::get('/add_result/{id}', ['as'=>'sifat-sertificates.add_result', 'uses' => '\App\Http\Controllers\SifatSertificateController@addResult']);
            Route::post('/result_store', ['uses' => '\App\Http\Controllers\SifatSertificateController@ResultStore']);
            Route::get('/add_client/{id}', ['as'=>'sifat-sertificates.add_client', 'uses' => '\App\Http\Controllers\SifatSertificateController@addClientData']);
            Route::post('/client_store', ['uses' => '\App\Http\Controllers\SifatSertificateController@ClientDataStore']);

            Route::get('/edit/{id}', [ 'uses' => '\App\Http\Controllers\SifatSertificateController@edit'])->name('sifat_sertificate.edit');
            Route::get('/edit-data/{id}', [ 'uses' => '\App\Http\Controllers\SifatSertificateController@editData']);
            Route::post('/update', '\App\Http\Controllers\SifatSertificateController@update')->name('sifat_sertificate/update');
            Route::get('/view/{id}', '\App\Http\Controllers\SifatSertificateController@showapplication')->name('sifat_sertificate.view');
            Route::get('/list/delete/{id}', ['as' => '/sifat-sertificates/list/delete/{id}', 'uses' => '\App\Http\Controllers\SifatSertificateController@destory']);
            Route::get('/accept/{id}', ['as' => '/sifat-sertificates/accept', 'uses' => '\App\Http\Controllers\SifatSertificateController@accept']);
            Route::get('/reject/{id}', ['as' => '/sifat-sertificates/reject', 'uses' => '\App\Http\Controllers\SifatSertificateController@reject']);

            Route::get('/client-edit/{id}', [ 'uses' => '\App\Http\Controllers\SifatSertificateController@clientEdit']);
            Route::post('/client-update', '\App\Http\Controllers\SifatSertificateController@clientUpdate')->name('sifat_sertificate/client_update');
            Route::get('/result-edit/{id}', [ 'uses' => '\App\Http\Controllers\SifatSertificateController@resultEdit']);
            Route::post('/result-update', '\App\Http\Controllers\SifatSertificateController@resultUpdate')->name('sifat_sertificate/result_update');

            Route::get('/sertificate/{id}/download', '\App\Http\Controllers\SifatSertificateController@download')->name('sifat_sertificate.download');

        });

         //sifat sertificates online
         Route::group(['prefix' => 'storage-conclusion'], function () {
            Route::get('/list', ['as'=>'/storage-conclusion/list', 'uses' => '\App\Http\Controllers\StorageConclusionController@applicationList']);
            Route::get('/add/{id}', ['as'=>'storage-conclusion.add', 'uses' => '\App\Http\Controllers\StorageConclusionController@addApplication']);
            Route::post('/store', ['uses' => '\App\Http\Controllers\StorageConclusionController@store']);
            Route::get('/add_result/{id}', ['as'=>'storage-conclusion.add_result', 'uses' => '\App\Http\Controllers\StorageConclusionController@addResult']);
            Route::post('/result_store', ['uses' => '\App\Http\Controllers\StorageConclusionController@ResultStore']);
         
            Route::get('/edit/{id}', [ 'uses' => '\App\Http\Controllers\StorageConclusionController@edit'])->name('storage_conclusion.edit');
            Route::get('/edit-data/{id}', [ 'uses' => '\App\Http\Controllers\StorageConclusionController@editData']);
            Route::post('/update', '\App\Http\Controllers\StorageConclusionController@update')->name('storage_conclusion/update');
            Route::get('/view/{id}', '\App\Http\Controllers\StorageConclusionController@showapplication')->name('storage_conclusion.view');
            Route::get('/accept/{id}', ['as' => '/storage-conclusion/accept', 'uses' => '\App\Http\Controllers\StorageConclusionController@accept']);
            Route::get('/reject/{id}', ['as' => '/storage-conclusion/reject', 'uses' => '\App\Http\Controllers\StorageConclusionController@reject']);

            Route::get('/client-edit/{id}', [ 'uses' => '\App\Http\Controllers\StorageConclusionController@clientEdit']);
            Route::post('/client-update', '\App\Http\Controllers\StorageConclusionController@clientUpdate')->name('storage_conclusion/client_update');
            Route::get('/result-edit/{id}', [ 'uses' => '\App\Http\Controllers\StorageConclusionController@resultEdit']);
            Route::post('/result-update', '\App\Http\Controllers\StorageConclusionController@resultUpdate')->name('storage_conclusion/result_update');

            Route::get('/sertificate/{id}/download', '\App\Http\Controllers\StorageConclusionController@download')->name('storage_conclusion.download');

        });

    }

);
