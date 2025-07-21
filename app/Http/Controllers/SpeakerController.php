<?php

namespace App\Http\Controllers;

use App\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function getIndex() {
        $speakers = Speaker::all();
        return view('admin.speaker.list', compact('speakers'));
    }

    public function getCreate() {
        return view('admin.speaker.add-edit-form', ['method' => "post"]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $speaker = new Speaker();
        $speaker->fill($request->all());
        $speaker->save();

        return redirect('admin/speaker/')->with('message', "Speaker <b>$speaker->name</b> has been added.");
    }

    public function getEdit($id) {
        $speaker = Speaker::find($id);
        if(!$speaker) abort(404);

        return view('admin.speaker.add-edit-form', [
            'speaker'         => $speaker,
            'method'            => "put"
        ]);
    }

    public function postEdit($id, Request $request) {
        $speaker = Speaker::find($id);
        if(!$speaker) abort(404);

        $this->validate($request, [
            'name' => 'required|min:1|max:255'
        ]);

        $speaker->update($request->all());
        return redirect()->back()->with('message', "Speaker <b>$speaker->name</b> has been updated.");
    }

}
