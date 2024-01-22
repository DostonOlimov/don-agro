<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CropData;
use App\Models\ProductionType;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\tbl_activities;


class CropDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $user = Auth::User();
        $apps = Application::with('crops')->get();
        return view('crops.list', compact('apps'));
    }


    // crops addform

    public function add()
    {
        $names = DB::table('crops_name')->get()->toArray();
        $countries = DB::table('tbl_countries')->get()->toArray();
        $measure_types = CropData::getMeasureType();
        $year = CropData::getYear();

        return view('crops.add', compact('names', 'countries','measure_types','year'));

    }


    // crops store

    public function store(Request $request)
    {
        $this->authorize('create', new User);
        $validated = $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
        ]);
        $firstname = $request->input('firstname');
        $email = $request->input('email');

        $password = $request->input('password');

        if (getDateFormat() == 'm-d-Y') {
            $dob = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dob'))));
        } else {
            $dob = date('Y-m-d', strtotime($request->input('dob')));
        }

        $user = new User;
        $user->name = $firstname;
        $user->lastname = $request->input('lastname');
        $user->display_name = $request->input('displayname');
        $user->gender = $request->input('gender');
        $user->birth_date = join('-', array_reverse(explode('-', $request->input('dob'))));
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->mobile_no = $request->input('mobile');
        $user->address = $request->input('address');
        if (!empty($request->hasFile('image'))) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/crops/', $file->getClientOriginalName());
            $user->image = $filename;
        } else {
            $user->image = 'avtar.png';
        }
        $user->role = $request->input('role');
        $user->save();
        $last_id = DB::table('users')->orderBy('id', 'desc')->get()->first();
        $userA = Auth::user();
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $last_id->id;
        $active->action_type = 'user_added';
        $active->action = "Foydalanuvchi qo'shildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        return redirect('/crops/list')->with('message', 'Successfully Submitted');

    }


    public function getrole(Request $request)
    {
        $position = $request->input('position');
        $role = DB::table('tbl_accessrights')->where('id', '=', $position)->get()->first();
        echo $role->position;
    }


    // crops edit

    public function edit($id)
    {
        $editid = $id;
        $title = "Xodimni o'zgartirish";
        $user = User::find($editid);

        $this->authorize('edit', $user);

        if ($user->role != 'admin') {
            $position = DB::table('tbl_accessrights')->where('id', '=', intval($user->role))->get()->first();
            if (!empty($position)) {
                if ($position->position == 'district') {
                    $state = DB::table('tbl_states')->get()->toArray();
                    $cities = DB::table('tbl_cities')->get()->toArray();
                } elseif ($position->position == 'country') {
                    $state = DB::table('tbl_states')->where(function ($query) use ($user) {
                        foreach (explode(',', $user->state_id) as $city) {
                            $query->orWhere('tbl_states.id', '=', $city);
                        }
                    })->get()->toArray();
                    $cities = DB::table('tbl_cities')->where('id', '=', $user->city_id)->get()->toArray();
                } elseif ($position->position == 'region') {
                    $state = DB::table('tbl_states')->where('id', '=', $user->state_id)->get()->toArray();
                    $cities = DB::table('tbl_cities')->where('id', $user->city_id)->get()->toArray();
                }
            }
        }
        $country = DB::table('tbl_countries')->get()->toArray();

        $position = DB::table('tbl_accessrights')->where('id', '=', intval($user->role))->get()->first();
        $roles = DB::table('tbl_accessrights')->where('status', '=', 'active')->get()->toArray();
        return view('crops.edit', compact('country', 'state', 'cities', 'user', 'editid', 'roles', 'position', 'title'));
    }


    // crops update

    public function update($id, Request $request)
    {
        $this->authorize('edit', User::findOrFail($id));

        $firstname = $request->input('firstname');
        $email = $request->input('email');
        $password = $request->input('password');

        if (getDateFormat() == 'm-d-Y') {
            $dob = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dob'))));
        } else {
            $dob = date('Y-m-d', strtotime($request->input('dob')));
        }
        $userold = DB::table('users')->where('id', '=', $id)->get()->first();
        if ($userold->role == 'admin') {
            $role = 'admin';
        } else {
            $role = $request->input('role');
        }
        $user = User::find($id);
        $user->name = $firstname;
        $user->lastname = $request->input('lastname');
        $user->display_name = $request->input('displayname');
        $user->gender = $request->input('gender');
        $user->birth_date = join('-', array_reverse(explode('-', $request->input('dob'))));
        $user->email = $email;
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->mobile_no = $request->input('mobile');
        $user->address = $request->input('address');
        if (!empty($request->hasFile('image'))) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/crops/', $file->getClientOriginalName());
            $user->image = $filename;
        }
        $user->role = $role;
        $user->save();

        $userA = Auth::user();
        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = $userA->id;
        $active->action_id = $id;
        $active->action_type = 'user_edit';
        $active->action = "Foydalanuvchi O'zgartrildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();
        return redirect('/crops/list')->with('message', 'Successfully Updated');

    }

    public function showemployer($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', User::class);

        return view('crops.show', compact('user'));
    }

    public function destory($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit', $user);

        $active = new tbl_activities;
        $active->ip_adress = $_SERVER['REMOTE_ADDR'];
        $active->user_id = auth()->id();
        $active->action_id = $id;
        $active->action_type = 'user_deleted';
        $active->action = "Inspektor O'chirildi";
        $active->time = date('Y-m-d H:i:s');
        $active->save();

        $user->delete();

        return redirect('crops/list')->with('message', 'Successfully Deleted');
    }

}

