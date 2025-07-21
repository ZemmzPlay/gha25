<?php

namespace App\Http\Controllers;

use App\Panelist;
use Illuminate\Http\Request;

class PanelistController extends Controller
{
    public function getIndex() {
        $panelists = Panelist::all();
        return view('admin.panelist.list', compact('panelists'));
    }

    public function getCreate() {
        return view('admin.panelist.add-edit-form', ['method' => "post"]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $panelist = new Panelist();
        $panelist->fill($request->all());
        $panelist->save();

        return redirect('admin/panelist/')->with('message', "Panelist <b>$panelist->name</b> has been added.");
    }

    public function getEdit($id) {
        $panelist = Panelist::find($id);
        if(!$panelist) abort(404);

        return view('admin.panelist.add-edit-form', [
            'panelist'         => $panelist,
            'method'            => "put"
        ]);
    }

    public function postEdit($id, Request $request) {
        $panelist = Panelist::find($id);
        if(!$panelist) abort(404);

        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $panelist->update($request->all());   
        return redirect()->back()->with('message', "Panelist <b>$panelist->name</b> has been updated.");
    }

}
