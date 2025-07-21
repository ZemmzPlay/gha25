<?php

namespace App\Http\Controllers;

use App\EventSession;
use App\EventSessionInterval;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Image;
use File;
use PDF;
use App;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionsController extends Controller
{

    public function intervalForm() {
        $interval = new EventSessionInterval();
        $user = Auth::guard('admin')->user();
        $sessions = EventSession::where('starts_at', '=', null)->get();
        return view('admin.sessions.interval-form', [
            'interval'  => $interval,
            'method'    => 'post',
            'user'      => $user,
            'sessions'  => $sessions
        ]);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'title'   => 'required|min:1|max:255',
        ]);

        $interval = new EventSessionInterval();
        $interval->fill($request->all());
        $interval->save();

        return redirect('admin/schedule/')->with('message', "Lecture <b>$interval->title</b> has been added.");
    }

    public function formEdit($id) {
        $user = Auth::guard('admin')->user();
        $interval = EventSessionInterval::find($id);
        $sessions = EventSession::where('starts_at', '=', null)->get();
        if(!$interval)
            abort(404);
        return view('admin.sessions.interval-form', [
            'interval'    => $interval,
            'method'    => 'put',
            'user'      => $user,
            'sessions'=> $sessions
        ]);
    }

    public function update($id, Request $request) {
        $interval = EventSessionInterval::find($id);
        if(!$interval)
            abort(404);
        $this->validate($request, [
            'title'   => 'required|min:1|max:255'
        ]);
        $interval->update($request->all());

        return redirect()->back()->with('message', "Lecture <b>$interval->title</b> has been updated.");

    }





}
