<?php

namespace App\Http\Controllers;

use App\AgendaActivity;
use Illuminate\Http\Request;

class AgendaActivitiesController extends Controller
{
    public function show($id = null) {
        if(!$id) abort(404, 'Page not found');
        $activity = AgendaActivity::find($id);
        if(!$activity) abort(404, 'There is no activity with an ID of ' . $id);
        $activity_starts_at = $activity->day->date;
        $activity_starts_at->setTime(substr($activity->start_time, 0,2), substr($activity->start_time, '3', '2'));
        return view('admin.content.activity', compact('activity', 'activity_starts_at'));
    }
}
