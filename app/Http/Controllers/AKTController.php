<?php

namespace App\Http\Controllers;

use App\Models\AKT;
use Carbon\Carbon;
use App\Models\CropData;
use App\Models\LabBayonnoma;
use App\Models\TestPrograms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\DB;

class AKTController extends Controller
{
    public function list(Request $request)
    {
        // $crop = $request->input('crop');
        // $from = $request->input('from');
        // $till = $request->input('till');
        $status = $request->input('status');

        $data = TestPrograms::with('application.crops.country', 'application.crops.name.nds', 'akt', 'final_result');

        if ($status) {
            if($status == 3){
                $data = $data->doesntHave('akt');
            }
            elseif($status == 1){
                $data = $data->has('akt');
                $data =$data->where('status', $status);
            }
            // elseif($status == 4){
            //     $data = $data->has('final_result');
            // }
            elseif($status==2){
                $data =$data->where('status','>=', $status);
            }
            else{
                $status=null;
            }

        }

        // if ($from && $till) {
        //     $fromTime = join('-', array_reverse(explode('-', $from)));
        //     $tillTime = join('-', array_reverse(explode('-', $till)));
        //     $data->whereHas('akt', function ($query) use ($fromTime,$tillTime) {
        //         $query->whereDate('make_date', '>=', $fromTime)
        //         ->orWhereDate('expiry_date', '<=', $tillTime);
        //     });

        // }
        // if ($crop) {
        //     $data = $data->whereHas('application.crops', function ($query) use ($crop) {
        //         $query->where('name_id', '=', $crop);
        //     });
        // }

        $data=$data->orderBy('id', 'desc')->paginate(50);
        // ->appends(['till' => $request->input('till')])
        // ->appends(['from' => $request->input('from')])
        // ->appends(['crop' => $request->input('crop')]);
        $amount = CropData::getMeasureType();

        return view('AKT.list', [
            "data"=>$data,
            "amount"=>$amount,
            // "from"=>$from,
            // "till"=>$till,
            // "crop"=>$crop,
            "status"=>$status,
        ]);
    }
    public function add($id)
    {
        $data = TestPrograms::with('application.organization.city.region', 'application.crops.name.nds', 'application.crops.country', 'akt')->find($id);
        $amount = CropData::getMeasureType();

        return view('AKT.add', compact('data', 'amount'));
    }
    public function store(Request $request)
    {
        if ($request->input('expiry_date')) {
            $akt_date = Carbon::createFromFormat('d.m.Y', $request->input('akt_date'))->format('Y-m-d');
            $make_date = Carbon::createFromFormat('d.m.Y', $request->input('make_date'))->format('Y-m-d');
            $expiry_date = Carbon::createFromFormat('d.m.Y', $request->input('expiry_date'))->format('Y-m-d');
        } else {
            $akt_date = Carbon::createFromFormat('d.m.Y', $request->input('akt_date'))->format('Y-m-d');
            $make_date = Carbon::createFromFormat('d.m.Y', $request->input('make_date'))->format('Y-m-d');
            $expiry_date = null;
        }
        $userA = Auth::user();
        $akt = new AKT();
        $akt->akt_date =  $akt_date;
        $akt->out_check =  $request->input('out_check');
        $akt->marker =  $request->input('marker');
        $akt->use_goal =  $request->input('use_goal');
        $akt->customer =  $request->input('customer');
        $akt->employee =  $request->input('employee');
        $akt->make_date =  $make_date;
        $akt->expiry_date =  $expiry_date;
        $akt->simple_size =  $request->input('simple_size');
        $akt->measure_type =  $request->input('measure_type');
        $akt->party_number =  $request->input('party_number');
        $akt->description =  $request->input('description');
        $akt->test_program_id =  $request->input('test_program_id');
        $akt->created_by = $userA->id;
        $akt->save();
        return redirect('/akt/list')->with('message', 'Successfully Submitted');
    }
    public function edit($id)
    {
        $data = AKT::with('test.application.organization.city.region', 'test.application.crops.name.nds', 'test.application.crops.country')->find($id);
        $amount = CropData::getMeasureType();
        $akt_date = Carbon::createFromFormat('Y-m-d', $data->akt_date)->format('d.m.Y');
        $make_date = Carbon::createFromFormat('Y-m-d', $data->make_date)->format('d.m.Y');
        if ($data->expiry_date) {
            $expiry_date = Carbon::createFromFormat('Y-m-d', $data->expiry_date)->format('d.m.Y');
        } else {
            $expiry_date = null;
        }

        return view('AKT.edit', compact('data', 'amount', 'akt_date', 'make_date', 'expiry_date'));
    }
    public function update(Request $request, $id)
    {
        if ($request->input('expiry_date')) {
            $akt_date = Carbon::createFromFormat('d.m.Y', $request->input('akt_date'))->format('Y-m-d');
            $make_date = Carbon::createFromFormat('d.m.Y', $request->input('make_date'))->format('Y-m-d');
            $expiry_date = Carbon::createFromFormat('d.m.Y', $request->input('expiry_date'))->format('Y-m-d');
        } else {
            $akt_date = Carbon::createFromFormat('d.m.Y', $request->input('akt_date'))->format('Y-m-d');
            $make_date = Carbon::createFromFormat('d.m.Y', $request->input('make_date'))->format('Y-m-d');
            $expiry_date = null;
        }

        $userA = Auth::user();
        $akt = AKT::find($id);
        $akt->akt_date =  $akt_date;
        $akt->out_check =  $request->input('out_check');
        $akt->marker =  $request->input('marker');
        $akt->use_goal =  $request->input('use_goal');
        $akt->customer =  $request->input('customer');
        $akt->employee =  $request->input('employee');
        $akt->make_date =  $make_date;
        $akt->expiry_date =  $expiry_date;
        $akt->simple_size =  $request->input('simple_size');
        $akt->measure_type =  $request->input('measure_type');
        $akt->party_number =  $request->input('party_number');
        $akt->description =  $request->input('description');
        $akt->test_program_id =  $request->input('test_program_id');
        $akt->created_by = $userA->id;
        $akt->save();
        return redirect('/akt/list')->with('message', 'Successfully Updated');
    }
    public function delete($id)
    {
        $this->authorize('setting_delete', User::class);
        $akt = AKT::find($id);
        if ($akt) {
            LabBayonnoma::where("akt_id", $akt)->delete();
            $akt->delete();
        }
        return redirect('/akt/list')->with('message', 'Successfully Deleted');
    }
}
