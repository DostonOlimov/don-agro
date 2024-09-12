<?php

namespace App\Http\Controllers;

use App\Models\AppForeignFile;
use App\Models\Application;
use App\Models\AppLocalFile;
use App\Models\AppRequirement;
use App\Models\AppStatusChanges;
use App\Models\CropData;
use App\Models\CropProduction;
use App\Models\CropProductionType;
use App\Models\OrganizationCompanies;
use App\Models\ProductionType;
use App\Models\Requirement;
use App\Rules\EditAppNumber;
use App\Rules\UniqueAppNumber;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\tbl_activities;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function applicationlist(Request $request)
    {
        $user = Auth::User();
        $city = $request->input('city');
        $crop = $request->input('crop');
        $from = $request->input('from');
        $till = $request->input('till');
        $ariza_turi = $request->input('ariza_turi');


        $apps = Application::with('organization')
            ->with('crops')
            ->with('crops.name')
            ->with('crops.country')
            ->with('tests.result')
            ->with('comment')
            ->with('crops.type');

        if ($user->role == \App\Models\User::STATE_EMPLOYEE) {
            $user_city = $user->state_id;
            $apps = $apps->whereHas('organization', function ($query) use ($user_city) {
                $query->whereHas('city', function ($query) use ($user_city) {
                    $query->where('state_id', '=', $user_city);
                });
            });
        }
        if ($from && $till) {
            $fromTime = join('-', array_reverse(explode('-', $from)));
            $tillTime = join('-', array_reverse(explode('-', $till)));
            $apps = $apps->whereDate('date', '>=', $fromTime)
                ->whereDate('date', '<=', $tillTime);
        }
        if ($city) {
            $apps = $apps->whereHas('organization', function ($query) use ($city) {
                $query->whereHas('city', function ($query) use ($city) {
                    $query->where('state_id', '=', $city);
                });
            });
        }
        if ($crop) {
            $apps = $apps->whereHas('crops', function ($query) use ($crop) {
                $query->where('name_id', '=', $crop);
            });
        }
        if ($ariza_turi) {
            $apps = $apps->where('type', '=', $ariza_turi);
        }
        $apps->when($request->input('s'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                if (is_numeric($searchQuery)) {
                    $query->orWhere('app_number', $searchQuery);
                } else {
                    $query->whereHas('crops.name', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    })->orWhereHas('crops.type', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                        // })->orWhereHas('crops.generation', function ($query) use ($searchQuery) {
                        //     $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    });
                }
            });
        });

        $apps = $apps->orderByRaw('app_number != 0, app_number desc, date desc')
            ->paginate(50)
            ->appends(['s' => $request->input('s')])
            ->appends(['till' => $request->input('till')])
            ->appends(['from' => $request->input('from')])
            ->appends(['city' => $request->input('city')])
            ->appends(['crop' => $request->input('crop')]);

        return view('application.list', compact('apps', 'from', 'till', 'city', 'crop', 'ariza_turi'));
    }


    // application addform

    public function addapplication()
    {
        $type = Application::getType();
        $names = DB::table('crops_name')->get()->toArray();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $measure_types = CropData::getMeasureType();
        $requirements = Requirement::get();
        $year = CropData::getYear();


        return view('application.add', compact('names', 'countries', 'measure_types', 'type', 'requirements', 'year'));
    }


    // application store

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dob' => 'required|date_format:d.m.Y',
            // 'app_number' =>['required', new UniqueAppNumber($request->input('dob'))],
        ]);
        $this->authorize('create', Application::class);
        $userA = Auth::user();
        $crop = new CropData();
        $crop->name_id = $request->input('name');
        $crop->type_id = $request->input('type') ?? null;
        // $crop->generation_id = $request->input('generation');
        $crop->country_id = $request->input('country');
        $crop->kodtnved = $request->input('tnved');
        $crop->measure_type = $request->input('measure_type');
        $crop->amount = $request->input('amount');
        $crop->year = $request->input('year');
        $crop->sxeme_number = $request->input('sxeme_number');
        $crop->save();
        $id = $crop->id;
        $requirements = $request->input('requirements');


        $app = new Application();
        $app->app_number =  $request->input('app_number');
        $app->crop_data_id = $id;
        $app->organization_id = $request->input('organization');
        $app->prepared_id = $request->input('prepared');
        $app->type = $request->input('app_type');
        $app->date = join('-', array_reverse(explode('.', $request->input('dob'))));
        $app->accepted_date =  join('-', array_reverse(explode('.', $request->input('dob'))));
        $app->accepted_id = $userA->id;
        $app->is_online = 0;
        $app->status = Application::STATUS_FINISHED;
        $app->data = $request->input('data');
        $app->created_by = $userA->id;
        $app->save();

        foreach ($requirements as $value) {
            $pro = new AppRequirement();
            $pro->app_id = $app->id;
            $pro->requirement_id = $value;
            $pro->save();
        }
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $app->id;
        $active->action_type = 'app_add';
        $active->action = "Ariza qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        return redirect('/application/list')->with('message', 'Successfully Submitted');
    }

    // application edit

    public function edit($id)
    {
        $editid = $id;
        $title = "Arizani o'zgartirish";
        $userA = Auth::user();
        $app = Application::find($editid);

        $type = Application::getType();
        $names = DB::table('crops_name')->get()->toArray();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $measure_types = CropData::getMeasureType();
        $requirements = Requirement::get();
        if ($app->is_online == 1 && $app->user && $app->user->role == \App\Models\User::ROLE_CUSTOMER) {
            return view('application.myedit', compact('app', 'type', 'names', 'countries', 'measure_types', 'title', 'requirements'));
        }
        $year = CropData::getYear();

        return view('application.edit', compact('app', 'type', 'names', 'countries', 'measure_types', 'title', 'requirements', 'year'));
    }


    // application update

    public function update($id, Request $request)
    {
        $userA = Auth::user();
        $app = Application::find($id);
        // if($app->status != Application::STATUS_NEW){
        //     $validated = $request->validate([
        //         'app_number' => [
        //             'required', new EditAppNumber($request->input('dob'),$id),
        //         ],
        //     ]);
        // }
        // if($app->user->role != \App\Models\User::ROLE_CUSTOMER or $app->user->role != \App\Models\User::ROLE_INSPECTION_DIROCTOR)
        // {
        //     $this->authorize('update', $app);
        // }
        $app->app_number =  $request->input('app_number');
        $app->organization_id = $request->input('organization');
        $app->prepared_id = $request->input('prepared');
        $app->type = $request->input('app_type');
        $app->date = join('-', array_reverse(explode('-', $request->input('dob'))));
        $app->data = $request->input('data');
        $app->is_online = 0;
        $app->save();

        $crop = CropData::find($app->crop_data_id);
        $crop->name_id = $request->input('name');
        $crop->type_id = $request->input('type');
        // $crop->generation_id = $request->input('generation');
        $crop->country_id = $request->input('country');
        $crop->kodtnved = $request->input('tnved');
        $crop->measure_type = $request->input('measure_type');
        $crop->amount = $request->input('amount');
        $crop->year = $request->input('year');
        $crop->sxeme_number = $request->input('sxeme_number');
        $crop->save();

        CropProductionType::where('crop_id', '=', $app->crop_data_id)->delete();

        AppRequirement::where('app_id', $id)->delete();
        $requirements = $request->input('requirements');
        if ($requirements) {
            foreach ($requirements as $value) {
                $pro = new AppRequirement();
                $pro->app_id = $id;
                $pro->requirement_id = $value;
                $pro->save();
            }
        }
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $app->id;
        $active->action_type = 'app_edit';
        $active->action = "Ariza O'zgartirildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        return redirect('/application/list')->with('message', 'Successfully Updated');
    }

    public function showapplication($id)
    {
        $user = Application::with(['tests.akt', 'organization'])->findOrFail($id);
        $requirements = AppRequirement::where('app_id', $id)->get();
        $company = OrganizationCompanies::with('city')->findOrFail($user->organization_id);
        $country = DB::table('tbl_countries')->find($user->crops->country_id);
        $country = $country->name ?? '';

        return view('application.show', compact('user', 'company', 'requirements', 'country'));
    }

    public function myapplications(Request $request)
    {
        $user = Auth::User();


        $apps = Application::where('created_by', $user->id)
            ->with('organization')
            ->with('crops')
            ->with('crops.name')
            ->with('crops.type');


        $apps->when($request->input('s'), function ($query, $searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                if (is_numeric($searchQuery)) {
                    $query->orWhere('app_number', $searchQuery);
                } else {
                    $query->whereHas('crops.name', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    })->orWhereHas('crops.type', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                        // })->orWhereHas('crops.generation', function ($query) use ($searchQuery) {
                        //     $query->where('name', 'like', '%' . addslashes($searchQuery) . '%');
                    });
                }
            });
        });

        $apps = $apps->latest('id')
            ->paginate(50)
            ->appends(['s' => $request->input('s')]);

        return view('front.application.list', compact('apps'));
    }

    public function myapplicationadd(Request $request)
    {
        $type = $request->input('type');
        $organization = $request->input('organization');
        $prepared = $request->input('prepared');
        $names = DB::table('crops_name')->get()->toArray();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $measure_types = CropData::getMeasureType();
        $year = CropData::getYear();

        return view('front.application.add', compact('organization', 'prepared', 'names', 'countries', 'measure_types', 'year', 'type'));
    }

    public function myapplicationstore(Request $request)
    {
        $userA = Auth::user();
        $type = $request->input('app_type');
        $crop = new CropData();
        $crop->name_id = $request->input('name');
        $crop->type_id = $request->input('type');
        // $crop->generation_id = $request->input('generation');
        $crop->country_id = $type == 1 ? 234 : $request->input('country');
        $crop->kodtnved = $request->input('tnved');
        $crop->party_number = $request->input('party_number');
        $crop->measure_type = $request->input('measure_type');
        $crop->amount = $request->input('amount');
        $crop->year = $request->input('year');
        $crop->sxeme_number = 7;
        $crop->save();
        $id = $crop->id;
        $requirements = $request->input('requirements');



        $app = new Application();
        $app->app_number =  0;
        $app->crop_data_id = $id;
        $app->organization_id = $request->input('organization');
        $app->prepared_id = $request->input('prepared');
        $app->type = $type;
        $app->date = date('Y-m-d');
        $app->data = $request->input('data');
        $app->status = Application::STATUS_NEW;
        $app->created_by = $userA->id;
        $app->save();

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $app->id;
        $active->action_type = 'app_add';
        $active->action = "Ariza qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        if ($type == 1) {
            return redirect('/application/my-file-local?app_id=' . $app->id)->with('message', 'Successfully Submitted');
        } elseif ($type == 2) {
            return redirect('/application/my-file-foreign?app_id=' . $app->id)->with('message', 'Successfully Submitted');
        } else {
            return redirect('/application/my-file-old?app_id=' . $app->id)->with('message', 'Successfully Submitted');
        }
    }

    public function myapplicationshow($id)
    {
        $user = Application::findOrFail($id);
        $requirements = AppRequirement::where('app_id', $id)->get();
        $company = OrganizationCompanies::with('city')->findOrFail($user->organization_id);

        return view('front.application.show', compact('user', 'company', 'requirements'));
    }
    // application edit

    public function myapplicationedit($id)
    {
        $editid = $id;
        $title = "Arizani o'zgartirish";
        $userA = Auth::user();
        $app = Application::find($editid);

        $type = Application::getType();
        $names = DB::table('crops_name')->get()->toArray();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $measure_types = CropData::getMeasureType();
        $year = CropData::getYear();
        $requirements = Requirement::get();

        return view('front.application.edit', compact('app', 'type', 'names', 'countries', 'measure_types', 'year',  'title', 'requirements'));
    }
    // application update

    public function myapplicationupdate($id, Request $request)
    {
        //
        $userA = Auth::user();
        $app = Application::find($id);
        $this->authorize('update', $app);

        $crop = CropData::find($app->crop_data_id);
        $crop->name_id = $request->input('name');
        $crop->type_id = $request->input('type');
        // $crop->generation_id = $request->input('generation');
        $crop->kodtnved = $request->input('tnved');
        $crop->party_number = $request->input('party_number');
        $crop->measure_type = $request->input('measure_type');
        $crop->amount = $request->input('amount');
        $crop->year = $request->input('year');
        $crop->save();
        CropProductionType::where('crop_id', '=', $app->crop_data_id)->delete();
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $app->id;
        $active->action_type = 'app_edit';
        $active->action = "Ariza O'zgartirildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        return redirect('/application/my-applications')->with('message', 'Successfully Updated');
    }
    public function addfilelocal(Request $request)
    {
        $app_id = $request->input('app_id');

        return view('front.application.add_file_local', compact('app_id'));
    }
    // public function addfilelocal_store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'a_dalolatnoma' => 'required',
    //         'a_xulosa' => 'required',
    //         'd_xulosa' => 'required',
    //         'markirovka' => 'required',
    //     ]);
    //     $userA = Auth::user();
    //     $app_id = $request->input('app_id');
    //     $app = new AppLocalFile();
    //     $app->app_id =  $app_id;

    //     $file1 = $request->file('a_dalolatnoma');
    //     $file2 = $request->file('a_xulosa');
    //     $file3 = $request->file('d_xulosa');
    //     $file4 = $request->file('markirovka');
    //     if ($file1) {
    //         $fileName1 = time() . '.' . $file1->extension();
    //         $destination1 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_A_DALOLATNOMA, $fileName1]);
    //         Storage::disk('local')->put($destination1, $file1->getContent());
    //         $app->a_dalolatnoma = $fileName1;
    //     }
    //     if ($file2) {
    //         $fileName2 = time() . '.' . $file2->extension();
    //         $destination2 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_A_XULOSA, $fileName2]);
    //         Storage::disk('local')->put($destination2, $file2->getContent());
    //         $app->a_xulosa = $fileName2;
    //     }
    //     if ($file3) {
    //         $fileName3 = time() . '.' . $file3->extension();
    //         $destination3 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_D_XULOSA, $fileName3]);
    //         Storage::disk('local')->put($destination3, $file3->getContent());
    //         $app->d_xulosa = $fileName3;
    //     }
    //     if ($file4) {
    //         $fileName4 = time() . '.' . $file4->extension();
    //         $destination4 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_MAKIROVKA, $fileName4]);
    //         Storage::disk('local')->put($destination4, $file4->getContent());
    //         $app->markirovka = $fileName4;
    //     }
    //     $app->save();

    //     $active = new tbl_activities;
    //     $active->ip_adress = $_SERVER['REMOTE_ADDR'];
    //     $active->user_id = $userA->id;
    //     $active->action_id = $app->id;
    //     $active->action_type = 'file_add';
    //     $active->action = "Local fiyl qo'shildi";
    //     $active->time = date('Y-m-d H:i:s');
    //     $active->save();

    //     return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    // }
    // public function filelocaledit(Request $request, $app_id)
    // {
    //     $app = Application::find($app_id);
    //     $files = AppLocalFile::where('app_id', '=', $app_id)
    //         ->first();
    //     if (!$files) {
    //         return view('front.application.add_file_local', compact('app_id', 'app'));
    //     }
    //     return view('front.application.file_local_edit', compact('files', 'app'));
    // }
    // public function filelocal_update(Request $request)
    // {
    //     $userA = Auth::user();
    //     $file_id = $request->input('file_id');
    //     $file1 = $request->file('a_dalolatnoma');
    //     $file2 = $request->file('a_xulosa');
    //     $file3 = $request->file('d_xulosa');
    //     $file4 = $request->file('markirovka');

    //     $files = AppLocalFile::find($file_id);

    //     if ($file1) {
    //         if ($files->a_dalolatnoma) {
    //             if (Storage::exists(AppLocalFile::PATH_A_DALOLATNOMA . '/' . $files->a_dalolatnoma)) {
    //                 Storage::delete(AppLocalFile::PATH_A_DALOLATNOMA . '/' . $files->a_dalolatnoma);
    //             }
    //         }
    //         $fileName1 = time() . '.' . $file1->extension();
    //         $destination1 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_A_DALOLATNOMA, $fileName1]);
    //         Storage::disk('local')->put($destination1, $file1->getContent());
    //         $files->a_dalolatnoma = $fileName1;
    //     }

    //     if ($file2) {
    //         if ($files->a_xulosa) {
    //             if (Storage::exists(AppLocalFile::PATH_A_XULOSA . '/' . $files->a_xulosa)) {
    //                 Storage::delete(AppLocalFile::PATH_A_XULOSA . '/' . $files->a_xulosa);
    //             }
    //         }
    //         $fileName2 = time() . '.' . $file2->extension();
    //         $destination2 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_A_XULOSA, $fileName2]);
    //         Storage::disk('local')->put($destination2, $file2->getContent());
    //         $files->a_xulosa = $fileName2;
    //     }
    //     if ($file3) {
    //         if ($files->d_xulosa) {
    //             if (Storage::exists(AppLocalFile::PATH_D_XULOSA . '/' . $files->d_xulosa)) {
    //                 Storage::delete(AppLocalFile::PATH_D_XULOSA . '/' . $files->d_xulosa);
    //             }
    //         }
    //         $fileName3 = time() . '.' . $file3->extension();
    //         $destination3 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_D_XULOSA, $fileName3]);
    //         Storage::disk('local')->put($destination3, $file3->getContent());
    //         $files->d_xulosa = $fileName3;
    //     }
    //     if ($file4) {
    //         if ($files->markirovka) {
    //             if (Storage::exists(AppLocalFile::PATH_MAKIROVKA . '/' . $files->markirovka)) {
    //                 Storage::delete(AppLocalFile::PATH_MAKIROVKA . '/' . $files->markirovka);
    //             }
    //         }
    //         $fileName4 = time() . '.' . $file4->extension();
    //         $destination4 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_MAKIROVKA, $fileName4]);
    //         Storage::disk('local')->put($destination4, $file4->getContent());
    //         $files->markirovka = $fileName4;
    //     }
    //     $files->save();

    //     $active = new tbl_activities;
    //     $active->ip_adress = $_SERVER['REMOTE_ADDR'];
    //     $active->user_id = $userA->id;
    //     $active->action_id = $files->id;
    //     $active->action_type = 'file_edit';
    //     $active->action = "Local fiyl o'zgartirildi";
    //     $active->time = date('Y-m-d H:i:s');
    //     $active->save();

    //     return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    // }
    // public function addfileforeign(Request $request)
    // {
    //     $app_id = $request->input('app_id');

    //     return view('front.application.add_file_foreign', compact('app_id'));
    // }
    // public function addfileforeign_store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'karantin' => 'required',
    //         'fitosanitar' => 'required',
    //         'm_sertificat' => 'required',
    //         'markirovka' => 'required',
    //     ]);
    //     $userA = Auth::user();
    //     $app_id = $request->input('app_id');
    //     $app = new AppForeignFile();
    //     $app->app_id =  $app_id;

    //     $file1 = $request->file('karantin');
    //     $file2 = $request->file('fitosanitar');
    //     $file3 = $request->file('m_sertificat');
    //     $file4 = $request->file('markirovka');
    //     $file5 = $request->file('invoys');
    //     $file6 = $request->file('yuk_xati');
    //     $file7 = $request->file('smr');
    //     if ($file1) {
    //         $fileName1 = time() . '.' . $file1->extension();
    //         $destination1 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_KARANTIN, $fileName1]);
    //         Storage::disk('local')->put($destination1, $file1->getContent());
    //         $app->karantin = $fileName1;
    //     }
    //     if ($file2) {
    //         $fileName2 = time() . '.' . $file2->extension();
    //         $destination2 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_FITOSANITAR, $fileName2]);
    //         Storage::disk('local')->put($destination2, $file2->getContent());
    //         $app->fitosanitar = $fileName2;
    //     }
    //     if ($file3) {
    //         $fileName3 = time() . '.' . $file3->extension();
    //         $destination3 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_M_SERTIFICAT, $fileName3]);
    //         Storage::disk('local')->put($destination3, $file3->getContent());
    //         $app->sertifikat = $fileName3;
    //     }
    //     if ($file4) {
    //         $fileName4 = time() . '.' . $file4->extension();
    //         $destination4 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_MAKIROVKA, $fileName4]);
    //         Storage::disk('local')->put($destination4, $file4->getContent());
    //         $app->markirovka = $fileName4;
    //     }
    //     if ($file5) {
    //         $fileName5 = time() . '.' . $file5->extension();
    //         $destination5 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_INVOYS, $fileName5]);
    //         Storage::disk('local')->put($destination5, $file5->getContent());
    //         $app->invoys = $fileName5;
    //     }
    //     if ($file6) {
    //         $fileName6 = time() . '.' . $file6->extension();
    //         $destination6 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_YUK_XATI, $fileName6]);
    //         Storage::disk('local')->put($destination6, $file6->getContent());
    //         $app->yuk_xati = $fileName6;
    //     }
    //     if ($file7) {
    //         $fileName7 = time() . '.' . $file7->extension();
    //         $destination7 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_SMR, $fileName7]);
    //         Storage::disk('local')->put($destination7, $file7->getContent());
    //         $app->smr = $fileName7;
    //     }
    //     $app->save();

    //     $active = new tbl_activities;
    //     $active->ip_adress = $_SERVER['REMOTE_ADDR'];
    //     $active->user_id = $userA->id;
    //     $active->action_id = $app->id;
    //     $active->action_type = 'foreign_file_add';
    //     $active->action = "Foreign fiyl qo'shildi";
    //     $active->time = date('Y-m-d H:i:s');
    //     $active->save();

    //     return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    // }
    // public function fileforeignedit(Request $request, $app_id)
    // {
    //     $app = Application::find($app_id);
    //     $files = AppForeignFile::where('app_id', '=', $app_id)
    //         ->first();
    //     if (!$files) {
    //         return view('front.application.add_file_foreign', compact('app_id', 'app'));
    //     }
    //     return view('front.application.file_foreign_edit', compact('files', 'app'));
    // }
    // public function fileforeign_update(Request $request)
    // {
    //     $userA = Auth::user();
    //     $file_id = $request->input('file_id');
    //     $file1 = $request->file('karantin');
    //     $file2 = $request->file('fitosanitar');
    //     $file3 = $request->file('m_sertificat');
    //     $file4 = $request->file('markirovka');
    //     $file5 = $request->file('invoys');
    //     $file6 = $request->file('yuk_xati');
    //     $file7 = $request->file('smr');

    //     $files = AppForeignFile::find($file_id);

    //     if ($file1) {
    //         if ($files->a_dalolatnoma) {
    //             if (Storage::exists(AppForeignFile::PATH_KARANTIN . '/' . $files->karantin)) {
    //                 Storage::delete(AppForeignFile::PATH_KARANTIN . '/' . $files->karantin);
    //             }
    //         }
    //         $fileName1 = time() . '.' . $file1->extension();
    //         $destination1 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_KARANTIN, $fileName1]);
    //         Storage::disk('local')->put($destination1, $file1->getContent());
    //         $files->karantin = $fileName1;
    //     }

    //     if ($file2) {
    //         if ($files->fitosanitar) {
    //             if (Storage::exists(AppForeignFile::PATH_FITOSANITAR . '/' . $files->fitosanitar)) {
    //                 Storage::delete(AppForeignFile::PATH_FITOSANITAR . '/' . $files->fitosanitar);
    //             }
    //         }
    //         $fileName2 = time() . '.' . $file2->extension();
    //         $destination2 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_FITOSANITAR, $fileName2]);
    //         Storage::disk('local')->put($destination2, $file2->getContent());
    //         $files->fitosanitar = $fileName2;
    //     }
    //     if ($file3) {
    //         if ($files->sertifikat) {
    //             if (Storage::exists(AppForeignFile::PATH_M_SERTIFICAT . '/' . $files->sertifikat)) {
    //                 Storage::delete(AppForeignFile::PATH_M_SERTIFICAT . '/' . $files->sertifikat);
    //             }
    //         }
    //         $fileName3 = time() . '.' . $file3->extension();
    //         $destination3 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_M_SERTIFICAT, $fileName3]);
    //         Storage::disk('local')->put($destination3, $file3->getContent());
    //         $files->sertifikat = $fileName3;
    //     }
    //     if ($file4) {
    //         if ($files->markirovka) {
    //             if (Storage::exists(AppForeignFile::PATH_MAKIROVKA . '/' . $files->markirovka)) {
    //                 Storage::delete(AppForeignFile::PATH_MAKIROVKA . '/' . $files->markirovka);
    //             }
    //         }
    //         $fileName4 = time() . '.' . $file4->extension();
    //         $destination4 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_MAKIROVKA, $fileName4]);
    //         Storage::disk('local')->put($destination4, $file4->getContent());
    //         $files->markirovka = $fileName4;
    //     }
    //     if ($file5) {
    //         if ($files->invoys) {
    //             if (Storage::exists(AppForeignFile::PATH_INVOYS . '/' . $files->invoys)) {
    //                 Storage::delete(AppForeignFile::PATH_INVOYS . '/' . $files->invoys);
    //             }
    //         }
    //         $fileName5 = time() . '.' . $file5->extension();
    //         $destination5 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_INVOYS, $fileName5]);
    //         Storage::disk('local')->put($destination5, $file5->getContent());
    //         $files->invoys = $fileName5;
    //     }
    //     if ($file6) {
    //         if ($files->yuk_xati) {
    //             if (Storage::exists(AppForeignFile::PATH_YUK_XATI . '/' . $files->yuk_xati)) {
    //                 Storage::delete(AppForeignFile::PATH_YUK_XATI . '/' . $files->yuk_xati);
    //             }
    //         }
    //         $fileName6 = time() . '.' . $file6->extension();
    //         $destination6 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_YUK_XATI, $fileName6]);
    //         Storage::disk('local')->put($destination6, $file6->getContent());
    //         $files->yuk_xati = $fileName6;
    //     }
    //     if ($file7) {
    //         if ($files->smr) {
    //             if (Storage::exists(AppForeignFile::PATH_SMR . '/' . $files->smr)) {
    //                 Storage::delete(AppForeignFile::PATH_SMR . '/' . $files->smr);
    //             }
    //         }
    //         $fileName7 = time() . '.' . $file7->extension();
    //         $destination7 = implode(DIRECTORY_SEPARATOR, [AppForeignFile::PATH_SMR, $fileName7]);
    //         Storage::disk('local')->put($destination7, $file7->getContent());
    //         $files->smr = $fileName7;
    //     }
    //     $files->save();

    //     $active = new tbl_activities;
    //     $active->ip_adress = $_SERVER['REMOTE_ADDR'];
    //     $active->user_id = $userA->id;
    //     $active->action_id = $files->id;
    //     $active->action_type = 'foreign_file_edit';
    //     $active->action = "Foreign fiyl o'zgartirildi";
    //     $active->time = date('Y-m-d H:i:s');
    //     $active->save();

    //     return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    // }
    public function addfileold(Request $request)
    {
        $app_id = $request->input('app_id');

        return view('front.application.add_file_old', compact('app_id'));
    }
    public function addfileold_store(Request $request)
    {
        $validated = $request->validate([
            'old_certificate' => 'required',
        ]);
        $userA = Auth::user();
        $app_id = $request->input('app_id');
        $app = new AppLocalFile();
        $app->app_id =  $app_id;

        $file1 = $request->file('old_certificate');

        if ($file1) {
            $fileName1 = time() . '.' . $file1->extension();
            $destination1 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_OLD_CERTIFICATE, $fileName1]);
            Storage::disk('local')->put($destination1, $file1->getContent());
            $app->certificate = $fileName1;
        }
        $app->save();

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $app->id;
        $active->action_type = 'old_file_add';
        $active->action = "Local fiyl qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    }
    public function fileoldedit(Request $request, $app_id)
    {
        $app = Application::find($app_id);
        $files = AppLocalFile::where('app_id', '=', $app_id)
            ->first();
        if (!$files) {
            return view('front.application.add_file_old', compact('app_id', 'app'));
        }
        return view('front.application.file_old_edit', compact('files', 'app'));
    }
    public function fileold_update(Request $request)
    {
        $userA = Auth::user();
        $file_id = $request->input('file_id');
        $file1 = $request->file('certificate');

        $files = AppLocalFile::find($file_id);

        if ($file1) {
            if ($files->certificate) {
                if (Storage::exists(AppLocalFile::PATH_OLD_CERTIFICATE . '/' . $files->certificate)) {
                    Storage::delete(AppLocalFile::PATH_OLD_CERTIFICATE . '/' . $files->certificate);
                }
            }
            $fileName1 = time() . '.' . $file1->extension();
            $destination1 = implode(DIRECTORY_SEPARATOR, [AppLocalFile::PATH_OLD_CERTIFICATE, $fileName1]);
            Storage::disk('local')->put($destination1, $file1->getContent());
            $files->certificate = $fileName1;
        }
        $files->save();

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $files->id;
        $active->action_type = 'old_file_edit';
        $active->action = "Local fiyl o'zgartirildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        return redirect('/application/my-applications')->with('message', 'Successfully Submitted');
    }
    public function myapplications_delete($id)
    {
        if (auth()->user()->role == "admin") {
            $app = Application::find($id);
            $app->status = Application::STATUS_DELETED;
            $app->save();
            return redirect('application/list')->with('message', 'Successfully Deleted');
        }

        $app = Application::find($id);
        $this->authorize('myupdate', $app);
        $this->authorize('delete', $app);
        $app->status = Application::STATUS_DELETED;
        $app->save();
        return redirect('application/my-applications')->with('message', 'Successfully Deleted');
    }
    public function accept($id)
    {
        $app = Application::find($id);
        $this->authorize('update', $app);
        $max_id = Application::max('app_number');
        $app->app_number = $max_id + 1;
        $app->status = Application::STATUS_ACCEPTED;
        $app->accepted_date = date('Y-m-d');
        $app->accepted_id = Auth::user()->id;
        $app->save();
        return redirect('application/list')->with('message', 'Successfully Submitted');
    }
    public function reject(Request $request, $id)
    {
        $app = Application::find($id);

        return view('application.reject', compact('app'));
    }
    public function reject_store(Request $request)
    {
        $app_id = $request->input('app_id');
        $reason = $request->input('reason');
        $app = Application::find($app_id);
        $this->authorize('accept', $app);
        $app->status = Application::STATUS_REJECTED;
        $app->save();
        $changes = new AppStatusChanges();
        $changes->app_id = $app_id;
        $changes->status = Application::STATUS_REJECTED;
        $changes->comment = $reason;
        $changes->user_id = Auth::user()->id;
        $changes->save();

        return redirect('application/list')->with('message', 'Successfully Submitted');
    }
}
