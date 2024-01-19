<?php

namespace App\Http\Controllers;

use App\Models\DecisionMaker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DecisionMakerController extends Controller
{
    public function index()
    {
        $decision_makers = DB::table('decision_makers')->get();

        return view('decision_maker.list', compact('decision_makers'));
    }
    public function create()  {
        return view('decision_maker.add');
    }

    public function store(Request $request)
    {

        $name = $request->input('name');
        $status = $request->input('status')??1;
        $count = DB::table('decision_makers')->where('name', '=', $name)->count();

        if ($count == 0) {
            $decision_makers = new DecisionMaker();
            $decision_makers->name = $name;
            $decision_makers->status = $status;
            $decision_makers->save();
            return redirect('decision_maker/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('decision_maker/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('setting_delete', User::class);
        $factory = DB::table('decision_makers')->where('id', '=', $id)->delete();
        return redirect('decision_maker/list')->with('message', 'Successfully Deleted');
    }


    public function edit($id)
    {
        $decision_maker = DB::table('decision_makers')->where('id', '=', $id)->get()->first();
        return view('decision_maker.edit', compact('decision_maker'));
    }


    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $status = $request->input('status')??1;
        $decision_makers = DecisionMaker::find($id);
        $decision_makers->name = $name;
        $decision_makers->status = $status;
        $decision_makers->save();
        return redirect('decision_maker/list')->with('message', 'Successfully Updated');
    }
}
