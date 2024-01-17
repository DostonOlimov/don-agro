<?php

namespace App\Http\Controllers;

use App\Models\AppRequirement;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use App\Models\Requirement;

class RequirementController extends Controller
{
    public function index()
    {
        $title = 'Talab etiluvchi hujjatlarni qo\'shish';
        return view('requirement.add', compact('title'));
    }

    // vehiclebrand list
    public function list()
    {
        $title = '';
        $crops = DB::table('requirements')->orderBy('id')->get();
        return view('requirement.list', compact('crops','title'));
    }

    // vehiclebrand store
    public function store(Request $request)
    {
        $name = $request->input('name');
        $count = DB::table('requirements')
            ->where('name', '=', $name)
            ->count();
        if ($count == 0) {
            DB::insert("insert into requirements (name) values (?)", [ $name]);
            return redirect('requirement/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('requirement/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('setting_delete', User::class);
        if(AppRequirement::where('requirement_id','=',$id)->first()){
            return redirect('requirement/list')->with('message', 'Primary key index');
        }
        Requirement::destroy($id);
        return redirect('requirement/list')->with('message', 'Successfully Deleted');
    }

    public function edit($id)
    {
        return view('requirement.edit', [
            'crops' => DB::table('requirements')->find($id),
            'editid' => $id,
        ]);
    }

    // vehiclebrand update
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $req = Requirement::find($id);
        $req->name = $name;
        $req->save();
        return redirect('requirement/list')->with('message', 'Successfully Updated');
    }
}
