<?php

namespace App\Http\Controllers;

use App\Models\Laboratories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratories = DB::table('laboratories')->get();

        return view('laboratories.list', compact('laboratories'));
    }
    public function create()  {
        return view('laboratories.add');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $certificate = $request->input('certificate');
        $address = $request->input('address');
        $count = DB::table('laboratories')->where('name', '=', $name)->count();

        if ($count == 0) {
            $laboratory = new Laboratories();
            $laboratory->name = $name;
            $laboratory->certificate = $certificate;
            $laboratory->address = $address;
            $laboratory->save();
            return redirect('laboratories/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('laboratories/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('setting_delete', User::class);
        $factory = DB::table('laboratories')->where('id', '=', $id)->delete();
        return redirect('laboratories/list')->with('message', 'Successfully Deleted');
    }


    public function edit($id)
    {
        $laboratory = DB::table('laboratories')->where('id', '=', $id)->get()->first();
        return view('laboratories.edit', compact('laboratory'));
    }


    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $certificate = $request->input('certificate');
        $address = $request->input('address');
        $laboratory = Laboratories::find($id);
        $laboratory->name = $name;
        $laboratory->certificate = $certificate;
        $laboratory->address = $address;
        $laboratory->save();
        return redirect('laboratories/list')->with('message', 'Successfully Updated');
    }
}
