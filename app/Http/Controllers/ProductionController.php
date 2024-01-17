<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CropProduction;
use App\Models\ProductionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    public function index()
    {
        $title = 'Ishlab chiqarish turini qo\'shish';
        return view('production.add', compact('title'));
    }

    // vehiclebrand list
    public function list()
    {
        $title = 'Urug\'lik ekin nomlari';
        $crops = DB::table('production_type')->orderBy('id')->get();
        return view('production.list', compact('crops','title'));
    }

    // vehiclebrand store
    public function store(Request $request)
    {
        $name = $request->input('name');
        $count = DB::table('production_type')
            ->where('name', '=', $name)
            ->count();
        if ($count == 0) {
            DB::insert("insert into production_type (name) values (?)", [ $name]);
            return redirect('production/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('production/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('mydelete', Application::class);

        if(CropProduction::where('type_id','=',$id)->first())
        {
            return redirect('production/list')->with('message', 'Primary key index');
        }
        ProductionType::destroy($id);
        return redirect('production/list')->with('message', 'Successfully Deleted');
    }

    public function edit($id)
    {
        return view('production.edit', [
            'crops' => DB::table('production_type')->find($id),
            'editid' => $id,
        ]);
    }

    // vehiclebrand update
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        DB::update("update production_type set id = $id where name = ?", [$name]);

        return redirect('production/list')->with('message', 'Successfully Updated');
    }
}
