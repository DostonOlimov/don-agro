<?php

namespace App\Http\Controllers;


use App\Models\Indicator;
use App\tbl_states;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\CropsName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndicatorController extends Controller
{
    public function index()
    {
        $title = 'Sifat ko\'rsatkichi qo\'shish';
        $crops = CropsName::get();
        return view('indicator.add', compact('title','crops'));
    }

    //  list
    public function list()
    {
        $title = 'Sifat ko\'rsatkichlari';
        $types = Indicator::with('nds.crops')->orderBy('id','desc')->get();
        return view('indicator.list', compact('types','title'));
    }

    //  store
    public function store(Request $request)
    {
        $name = $request->input('name');
        $nd_name = $request->input('nd_name');
        $nds = $request->input('nds_id');
        $count = DB::table('quality_indacators')
            ->where('name', '=', $name)
            ->where('nds_id','=',$nds)
            ->count();
        if ($count == 0) {
            $type = new Indicator();
            $type->name = $name;
            $type->nd_name = $nd_name;
            $type->nds_id = $nds;
            $type->value = $request->input('value');
            $type->measure_type = $request->input('measure_type');
            $type->comment = $request->input('comment');
            $type->save();
            return redirect('indicator/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('indicator/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('setting_delete', User::class);
        if(Auth::user()->id != 1){
            return redirect('indicator/list')->with('message', 'Cannot Deleted');
        }
        Indicator::destroy($id);
        return redirect('indicator/list')->with('message', 'Successfully Deleted');
    }

    public function edit($id)
    {
        $crops = CropsName::get();
        return view('indicator.edit', [
            'type' => Indicator::findOrFail($id),
            'editid' => $id,
            'crops' => $crops
        ]);
    }

    // vehiclebrand update
    public function update(Request $request, $id)
    {
        $type = Indicator::findOrFail($id);
        $type->name = $request->input('name');
        $type->nd_name = $request->input('nd_name');
        $type->nds_id = $request->input('nds_id');
        $type->value = $request->input('value');
        $type->measure_type = $request->input('measure_type');
        $type->comment = $request->input('comment');
        $type->save();

        return redirect('indicator/list')->with('message', 'Successfully Updated');
    }
}
