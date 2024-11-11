<?php

namespace App\Http\Controllers\Admin;

use App\Models\OwnershipForm;
use Illuminate\Http\Request;

class OwnershipFormsController extends Controller
{
    public function index()
    {
        return view('admin.ownership-forms.list', ['forms' => OwnershipForm::get()]);
    }

    public function destroy($id)
    {
        OwnershipForm::destroy($id);

        return redirect()->route('admin.ownership-forms.index')->with('message', 'O\'chirildi');
    }

    public function edit($id)
    {
        return view('admin.ownership-forms.edit', [
            'ownershipForm' => OwnershipForm::find($id),
        ]);
    }

    public function create()
    {
        return view('admin.ownership-forms.edit', [
            'ownershipForm' => new OwnershipForm,
        ]);
    }

    public function update(Request $request, $id)
    {
        $of = OwnershipForm::find($id);
        $of->name = $request->name;
        $of->save();

        return redirect()->route('admin.ownership-forms.index')->with('message', 'Yangilandi');
    }

    public function store(Request $request)
    {
        $of = new OwnershipForm;
        $of->name = $request->name;
        $of->save();

        return redirect()->route('admin.ownership-forms.index')->with('message', 'Yaratildi');
    }
}
