<?php

namespace App\Http\Controllers;

use App\Moderator;
use App\Panelist;
use App\Speaker;
use App\Session;
use App\SessionLecture;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function getIndex() {
        $sessions = Session::all();
        return view('admin.program.list', compact('sessions'));
    }

    public function getCreate() {
        $moderators = Moderator::all();
        $panelists = Panelist::all();
        $selected_panelist = array();

        return view('admin.program.add-edit-form', [
            'selected_panelist'    => $selected_panelist,
            'moderators'           => $moderators,
            'panelists'            => $panelists,
            'method'               => "post"
        ]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'title'           => 'required|min:1|max:255',
            'session_date'    => 'required|date|date_format:Y-m-d',
            'start_time'      => 'required|date_format:H:i',
            'end_time'        => 'required|date_format:H:i',
            'moderator_id'    => 'sometimes|nullable|integer|exists:moderators,id',
            'panelist_id'     => 'sometimes|nullable|array',
            'panelist_id.*'   => 'sometimes|nullable|integer|exists:panelist,id'
        ]);

        $request['start_time'] .= ":00";
        $request['end_time'] .= ":00";


        $request['total_lecture'] = "2";
        $request['lecture_duration'] = "30";

        $session = new Session();
        // $session->fill($request->all());
        $session->fill($request->except('panelist_id'));
        $session->save();

        if(isset($request['panelist_id']) && count($request['panelist_id']))
        {
            $panelist_ids = $request->only('panelist_id');
            $session->panelists()->attach($panelist_ids['panelist_id']);
        }

        return redirect('admin/program/'.$session->id.'/lectures')->with('message', "Program <b>$session->title</b> has been added.");
    }

    public function getEdit($id) {
        $session = Session::find($id);
        if(!$session) abort(404);

        $lectures = $session->lectures;
        // dd($lectures);
        $speakers = Speaker::all();
        $moderators = Moderator::all();
        $panelists = Panelist::all();
        $selected_panelist = array_pluck($session->panelists, 'id');

        return view('admin.program.add-edit-form', [
            'selected_panelist' => $selected_panelist,
            'lectures'          => $lectures,
            'speakers'          => $speakers,
            'session'           => $session,
            'moderators'        => $moderators,
            'panelists'         => $panelists,
            'method'            => "put"
        ]);
    }

    public function postEdit($id, Request $request) {
        $session = Session::find($id);
        if(!$session) abort(404);

        $this->validate($request, [
            'title'           => 'required|min:1|max:255',
            'session_date'    => 'required|date|date_format:Y-m-d',
            'start_time'      => 'required|date_format:H:i',
            'end_time'        => 'required|date_format:H:i',
            'moderator_id'    => 'sometimes|nullable|integer|exists:moderators,id',
            'panelist_id'     => 'sometimes|nullable|array',
            'panelist_id.*'   => 'sometimes|nullable|integer|exists:panelist,id'
        ]);

        $request['start_time'] .= ":00";
        $request['end_time'] .= ":00";


        $request['total_lecture'] = "2";
        $request['lecture_duration'] = "30";
        
        // $session->update($request->all());
        $session->update($request->except('panelist_id'));

        if(isset($request['panelist_id']))
        {
            $panelist_ids = $request->only('panelist_id');
            $session->panelists()->sync($panelist_ids['panelist_id']);
        }
        else
        {
            $session->panelists()->sync([]);
        }
            
        
        return redirect()->back()->with('message', "Program <b>$session->title</b> has been updated.");
    }

    public function getLectures($id) {
        $session = Session::find($id);
        if(!$session) abort(404);

        $lectures = $session->lectures;
        $speakers = Speaker::all();

        return view('admin.program.lectures', [
            'lectures'          => $lectures,
            'speakers'          => $speakers,
            'session'           => $session
        ]);
    }

    public function postLecturesEdit(Request $request) {

        $this->validate($request, [
            'session_lectures_id' => 'required|integer|exists:session_lectures,id',
            'lecture_title'       => 'required|min:1|max:255',
            'lecture_start_time'  => 'required|date_format:H:i',
            'lecture_end_time'    => 'required|date_format:H:i',
            'speaker_id'          => 'sometimes|nullable|array',
            'speaker_id.*'        => 'sometimes|nullable|integer|exists:speakers,id',
            'lecture_parts'       => 'sometimes|nullable'
        ]);

        $request['lecture_start_time'] .= ":00";
        $request['lecture_end_time'] .= ":00";


        ////// update session lecture value //////
        $session_lectures = SessionLecture::find($request['session_lectures_id']);
        $session_lectures->update($request->except('session_lectures_id', 'speaker_id'));

        if(isset($request['speaker_id']))
        {
            $speaker_ids = $request->only('speaker_id');
            $session_lectures->speakers()->sync($speaker_ids['speaker_id']);
        }
        else
        {
            $session_lectures->speakers()->sync([]);
        }
        ////// update session lecture value //////

        return [
            'success' => true
        ];
    }

    public function postLecturesSave(Request $request) {

        $this->validate($request, [
            'session_id' => 'required|integer|exists:sessions,id',
            'lecture_title'       => 'required|min:1|max:255',
            'lecture_start_time'  => 'required|date_format:H:i',
            'lecture_end_time'    => 'required|date_format:H:i',
            'speaker_id'          => 'sometimes|nullable|array',
            'speaker_id.*'        => 'sometimes|nullable|integer|exists:speakers,id',
            'lecture_parts'       => 'sometimes|nullable'
        ]);

        $request['lecture_start_time'] .= ":00";
        $request['lecture_end_time'] .= ":00";


        ////// add session lecture value //////
        $session_lectures = new SessionLecture();
        $session_lectures->fill($request->except('speaker_id'));
        $session_lectures->save();

        if(isset($request['speaker_id']) && is_array($request['speaker_id']) && count($request['speaker_id']))
        {
            $speaker_ids = $request->only('speaker_id');
            $session_lectures->speakers()->attach($speaker_ids['speaker_id']);
        }
        ////// add session lecture value //////


        ///// load the Lectures per session /////
        $session = Session::find($request['session_id']);
        $lectures = $session->lectures;
        $speakers = Speaker::all();
        $allRowsLecture = view('admin.program.allRowsLecture', [
            'lectures'          => $lectures,
            'speakers'          => $speakers,
            'session'           => $session
        ])->render();
        ///// load the Lectures per session /////

        return [
            'success' => true,
            'allRowsLecture' => $allRowsLecture
        ];
    }

    
    public function postLecturesDelete(Request $request) {

        $this->validate($request, [
            'session_lectures_id' => 'required|integer|exists:session_lectures,id'
        ]);

        ////// update session lecture value //////
        $id = $request['session_lectures_id'];
        SessionLecture::destroy($id);
        ////// update session lecture value //////

        return [
            'success' => true
        ];
    }

}
