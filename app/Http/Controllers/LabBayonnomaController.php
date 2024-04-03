<?php

namespace App\Http\Controllers;

use App\Models\AKT;
use App\Models\LabBayonnoma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabBayonnomaController extends Controller
{
    function list(Request $request)
    {
        $data = AKT::with(
            'test.application.organization.city.region',
            'test.application.decision.laboratory',
            'test.application.crops.name.nds',
            'lab_bayonnoma',
            'test.final_result'
        )
            ->whereHas('test.application.decision.laboratory');

        $status = $request->input('status');

        if ($status) {
            if ($status == 3) {
                $data = $data->doesntHave('lab_bayonnoma');
            } elseif ($status == 1) {
                $data = $data->has('lab_bayonnoma');
            } elseif ($status == "Muvofiq") {
                $data = $data->whereHas('lab_bayonnoma', function ($query) {
                    $query->where('test_result', 'Muvofiq');
                });
            }elseif ($status == "Nomuvofiq") {
                $data = $data->whereHas('lab_bayonnoma', function ($query) {
                    $query->where('test_result', 'Nomuvofiq');
                });
            }
            // elseif($status == 4){
            //     $data = $data->has('test.final_result');
            // }
            else {
                $status = null;
            }
        }

        $data = $data->orderBy('id', 'desc')->paginate(50);

        return view('lab_bayonnoma.list', compact('data', 'status'));
    }
    function add($id)
    {
        $data = AKT::with('test.application.organization.city.region', 'test.application.decision.laboratory', 'test.application.crops.name.nds', 'test.laboratory_results.users')->find($id);

        return view('lab_bayonnoma.add', compact('data'));
    }
    function store(Request $request)
    {
        $lab_start_date = Carbon::createFromFormat('d.m.Y', $request->input('lab_start_date'))->format('Y-m-d');
        $date = Carbon::createFromFormat('d.m.Y', $request->input('date'))->format('Y-m-d');

        $userA = Auth::user();
        $lab_bayonnoma = new LabBayonnoma();
        $lab_bayonnoma->lab_start_date =  $lab_start_date;
        $lab_bayonnoma->date =  $date;
        $lab_bayonnoma->number =  $request->input('number');
        $lab_bayonnoma->test_result =  $request->input('test_result');
        $lab_bayonnoma->test_employee =  $request->input('test_employee');
        $lab_bayonnoma->akt_id =  $request->input('akt_id');
        // $lab_bayonnoma->description =  $request->input('description') ?? '';
        $lab_bayonnoma->created_by = $userA->id;
        $lab_bayonnoma->save();

        return redirect('/lab_bayonnoma/list')->with('message', 'Successfully Submitted');
    }
    function edit($id)
    {
        $data = LabBayonnoma::with('akt.test.application.organization.city.region', 'akt.test.application.decision.laboratory', 'akt.test.application.crops.name.nds')->find($id);
        $lab_start_date = Carbon::createFromFormat('Y-m-d', $data->lab_start_date)->format('d.m.Y');
        $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d.m.Y');

        return view('lab_bayonnoma.edit', compact('data', 'lab_start_date', 'date'));
    }
    function update(Request $request, $id)
    {
        $lab_start_date = Carbon::createFromFormat('d.m.Y', $request->input('lab_start_date'))->format('Y-m-d');
        $date = Carbon::createFromFormat('d.m.Y', $request->input('date'))->format('Y-m-d');

        $userA = Auth::user();
        $lab_bayonnoma = LabBayonnoma::find($id);
        $lab_bayonnoma->lab_start_date =  $lab_start_date;
        $lab_bayonnoma->date =  $date;
        $lab_bayonnoma->number =  $request->input('number');
        $lab_bayonnoma->test_result =  $request->input('test_result');
        $lab_bayonnoma->test_employee =  $request->input('test_employee');
        $lab_bayonnoma->akt_id =  $request->input('akt_id');
        // $lab_bayonnoma->description =  $request->input('description') ?? '';
        $lab_bayonnoma->created_by = $userA->id;
        $lab_bayonnoma->save();

        return redirect('/lab_bayonnoma/list')->with('message', 'Successfully Updated');
    }
    function delete($id)
    {
        $this->authorize('setting_delete', User::class);
        $factory = LabBayonnoma::where('id', '=', $id)->delete();
        return redirect('/lab_bayonnoma/list')->with('message', 'Successfully Deleted');
    }
}
