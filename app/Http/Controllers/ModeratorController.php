<?php

namespace App\Http\Controllers;

use App\Moderator;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function getIndex() {
        $moderators = Moderator::all();
        return view('admin.moderator.list', compact('moderators'));
    }

    public function getCreate() {
        return view('admin.moderator.add-edit-form', ['method' => "post"]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $moderator = new Moderator();
        $moderator->fill($request->all());
        $moderator->save();

        return redirect('admin/moderator/')->with('message', "Moderator <b>$moderator->name</b> has been added.");
    }

    public function getEdit($id) {
        $moderator = Moderator::find($id);
        if(!$moderator) abort(404);

        return view('admin.moderator.add-edit-form', [
            'moderator'         => $moderator,
            'method'            => "put"
        ]);
    }

    public function postEdit($id, Request $request) {
        $moderator = Moderator::find($id);
        if(!$moderator) abort(404);

        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $moderator->update($request->all());   
        return redirect()->back()->with('message', "Moderator <b>$moderator->name</b> has been updated.");
    }

}
