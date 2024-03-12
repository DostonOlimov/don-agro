<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\CropData;
use App\Models\CropsGeneration;
use App\Models\CropsType;
use App\Models\Region;
use App\Models\CropsName;
use App\tbl_states;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CropsNameController extends Controller
{
    public function index()
    {
        $title = 'Mahsulot nomini qo\'shish';
        $cropnames=CropsName::orderBy('id')->get();
        return view('crops_name.add', compact('title','cropnames'));
    }

    // vehiclebrand list
    public function list()
    {
        $title = 'Mahsulot nomlari';
        $crops = CropsName::orderBy('id')->get();

        return view('crops_name.list', compact('crops','title'));
    }

    // vehiclebrand store
    public function store(Request $request)
    {
        $name = $request->input('name');
        $parent_id = $request->input('parent_id')??null;
        $count = DB::table('crops_name')
            ->where('name', '=', $name)
            ->count();
        if ($count == 0) {
            $crop = new CropsName();
            $crop->name = $name;
            $crop->parent_id = $parent_id;
            $crop->kodtnved = $request->input('tnved');
            if (!empty($request->hasFile('image'))) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $file->move(public_path() . '/crops/', $file->getClientOriginalName());
                $crop->img = $filename;
            } else {
                $crop->img = null;
            }
            $crop->save();
            return redirect('crops_name/list')->with('message', 'Successfully Submitted');
        } else {
            return redirect('crops_name/add')->with('message', 'Duplicate Data');
        }
    }

    public function destory($id)
    {
        $this->authorize('setting_delete', User::class);
        $app = CropData::where('name_id', $id)->first();
        $name = CropsName::find($id);

        if ($app) {
            return redirect('crops_name/list')->with('message', 'Cannot Deleted');
        }
        // if(CropsGeneration::where('crop_id','=',$id)->get()){
        //     CropsGeneration::where('crop_id','=',$id)->delete();
        // }

        if ($name->img) {
            $oldImagePath = public_path('crops/' . $name->img);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $type=CropsType::where('crop_id', $id)->first();
        if($type){
            $type->delete();
        }
        $name->delete();

        return redirect('crops_name/list')->with('message', 'Successfully Deleted');
    }

    public function edit($id)
    {
        $crops=CropsName::query();
        $crops=$crops->findOrFail($id);
        $cropnames=$crops->orderBy('id')->get();
        return view('crops_name.edit', [
            'crops' => $crops,
            'cropnames' => $cropnames,
            'editid' => $id,
        ]);
    }

    // vehiclebrand update
    public function update(Request $request, $id)
    {
        $crop = CropsName::findOrFail($id);
        $crop->name = $request->input('name');
        $crop->parent_id = $request->input('parent_id')??null;
        $crop->kodtnved = $request->input('tnved');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/crops/', $filename);
            if (!is_null($crop->img)) {
                $oldImagePath = public_path() . '/crops/' . $crop->img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $crop->img = $filename;
        } else {
            $crop->img = $crop->img;
        }
        $crop->save();

        return redirect('crops_name/list')->with('message', 'Successfully Updated');
    }
}
