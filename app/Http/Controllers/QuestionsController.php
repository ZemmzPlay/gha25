<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConferenceQuestions;
use App\Configuration;
use App\Session;

class QuestionsController extends Controller
{
  public function list()
  {
    $currentAndNextSession = $this->fetchCurrentAndNextSession(true);
    $sessions = $currentAndNextSession['allSessions'];
    
    // return $sessions;

    $questionEnable = Configuration::select('enableLiveConferenceQuestions')->first();

    // $sessions = ConferenceQuestions::select('session_id')->groupBy('session_id')->get();

    return view('admin.questions.list', ['sessions' => $sessions, 'questionEnable' => $questionEnable]);
  }

  // public function view($session_id)
  // {
  //   return view('admin.questions.view', ['session_id' => $session_id]);
  // }

  public function getQuestions(Request $request)
  {
    $questions = ConferenceQuestions::where('id', '>', $request->last_id)->where('session_id', $request->session_id)->orderBy('created_at', 'DESC')->get();

    $questions_id = array();

    foreach ($questions as $question)
    {
      array_push($questions_id, $question->id);
    }

    if(count($questions))
      $last_id = $questions->first()->id;
    else
      $last_id = $request->last_id;

    return ['data' => view('admin.questions.questions', ['questions' => $questions])->render(), 'last_id' => $last_id, 'questions_id' => $questions_id];
  }

  public function answerQuestions(Request $request)
  {
    $question = ConferenceQuestions::find($request->id);

    $question->answered = $question->answered ? 0 : 1;

    $question->update();
  }

  public function enableQuestions(Request $request)
  {
    $questionEnable = Configuration::first();
    // return [$request->enabled];

    if($request->enabled == "true")
    {
      $questionEnable->enableLiveConferenceQuestions = 1;
    }
    else
    {
      $questionEnable->enableLiveConferenceQuestions = 0;
    }

    $questionEnable->save();
  }

  public function fetchCurrentAndNextSession($fetchSessions = false) {
    $currentSessionDateTime = null;
    $previousSessionDateTime  = null;
    $nextSessionDateTime = null;
    $nextSessionSeconds = null;


    $allSessions = $this->fetchSessions();
    $largestTimeDiff = -1;
    $smallestTimeDiff = PHP_INT_MAX;
    foreach ($allSessions as $oneSessionKey => $oneSession)
    {
      $localTime = date('Y-m-d H:i:s');
      $date_time_from = $oneSession['date_time_from'];
      $date_time_to = $oneSession['date_time_to'];


      $localTimestamp = strtotime($localTime);
      $fromTimestamp = strtotime($date_time_from);
      $toTimestamp = strtotime($date_time_to);


            /// fetch current session ///
      if ($localTimestamp >= $fromTimestamp && $localTimestamp <= $toTimestamp) {
        $currentSessionDateTime = $oneSession['date_time_from'];
      }
            /// fetch current session ///

            //// fetch the previous session datetime ////
      if ($fromTimestamp < $localTimestamp) {
        if ($previousSessionDateTime === null || $fromTimestamp > strtotime($previousSessionDateTime)) {
          $previousSessionDateTime = $date_time_from;
        }
      }
            //// fetch the previous session datetime ////

            //// fetch the next session datetime ////
      $timeDiffNext = $fromTimestamp - $localTimestamp;
      if ($timeDiffNext > 0 && $timeDiffNext < $smallestTimeDiff) {
        $smallestTimeDiff = $timeDiffNext;
        $nextSessionDateTime = $date_time_from;
      }
            //// fetch the next session datetime ////
    }


        //// fetch the next session in seconds ////
    if($nextSessionDateTime != null)
    {
      $currentDateTime = date('Y-m-d H:i:s');
      $specificTimestamp = strtotime($nextSessionDateTime);
      $currentTimestamp = strtotime($currentDateTime);
      $nextSessionSeconds = $specificTimestamp - $currentTimestamp;
    }
        //// fetch the next session in seconds ////


        /// if session is done then show the last active one ///
    if($currentSessionDateTime == null)
      $currentSessionDateTime = $previousSessionDateTime;
        /// if session is done then show the last active one ///


        /// if no session active yet then show the next one ///
    if($currentSessionDateTime == null)
      $currentSessionDateTime = $nextSessionDateTime;
        /// if no session active yet then show the next one ///


    if($currentSessionDateTime != null)
      $currentSessionDateTime = date('Y_m_d_H_i', strtotime($currentSessionDateTime));

    $dataToBeReturned = [
      "currentSessionDateTime" => $currentSessionDateTime,
      "nextSessionSeconds" => $nextSessionSeconds
    ];

    if($fetchSessions) $dataToBeReturned['allSessions'] = $allSessions;

    return $dataToBeReturned;
  }
  private function fetchSessions() {
    $dates = Session::orderBy('session_date')->orderBy('start_time')->get()->groupBy('session_date');

    $allSessions = [];
    foreach ($dates as $date => $sessions)
    {
      if($date != '2023-12-13')
      {
        if(count($sessions))
        {
          foreach ($sessions as $session)
          {
            if (
              (strpos($session->title, 'Session') !== false) || 
              (strpos($session->title, 'session') !== false) || 
              (strpos($session->title, 'Awards') !== false) || 
              (strpos($session->title, 'awards') !== false) || 
              (strpos($session->title, 'Closing') !== false) || 
              (strpos($session->title, 'closing') !== false)
            )
            {
              $oneSession = [];
              $oneSession['id'] = $session->id;
              $oneSession['date'] = $date;
              $oneSession['title'] = $session->title;
              if(isset($session->moderator)) $oneSession['moderator'] = $session->moderator->name;


                            //// get panelist ////
              $panelistText = "";
              $panelists = $session->panelists;
              foreach ($panelists as $panelistkey => $panelist) {
                $panelistText .= $panelist->name;
                if($panelistkey < count($panelists) - 1) $panelistText .= ", ";
              }
              if($panelistText != "") $oneSession['panelists'] = $panelistText;
                            //// get panelist ////



                            /// lectures ///
              $lecturesTimes = [];
              $allLectures = [];
              $lectures = $session->lectures;
              if(count($lectures))
              {
                foreach ($session->lectures as $lecture)
                {
                                    //// fetch speakers ////
                  $speakerText = "";
                  $speakers = $lecture->speakers;
                  foreach ($speakers as $speakerkey => $speaker)
                  {
                    $speakerText .= $speaker->name;
                    if($speakerkey < count($speakers) - 1) $speakerText .= ", ";
                  }
                                    //// fetch speakers ////

                  $oneLecture = [];
                  $oneLecture['lecture_start_time'] = $lecture->lecture_start_time;
                  $oneLecture['lecture_end_time'] = $lecture->lecture_end_time;
                  $oneLecture['lecture_title'] = $lecture->lecture_title;
                  if($speakerText != "") $oneLecture['speakers'] = $speakerText;
                  $allLectures[] = $oneLecture;

                  $lecturesTimes[] = $lecture->lecture_start_time;
                  $lecturesTimes[] = $lecture->lecture_end_time;
                }
              }
              if(count($allLectures)) $oneSession['lectures'] = $allLectures;
              if(count($lecturesTimes))
              {
                $oneSession['start_time_from_lectures'] = min($lecturesTimes);
                $oneSession['end_time_from_lectures'] = max($lecturesTimes);
              }
                            /// lectures ///


              $oneSession['start_time'] = $session->start_time;
              $oneSession['end_time'] = $session->end_time;

              $oneSession['date_time_from'] = (isset($oneSession['start_time_from_lectures'])) ? $date.' '.$oneSession['start_time_from_lectures'] : $date.' '.$session->start_time;
              $oneSession['date_time_to'] = (isset($oneSession['end_time_from_lectures'])) ? $date.' '.$oneSession['end_time_from_lectures'] : $date.' '.$session->end_time;


              $allSessions[] = $oneSession;
            }
          }
        }
      }
    }


        //// temp for testing ////
        // $allSessions = [];
        // $allSessions[] = [
        //     "id" => 1,
        //     "title" => "Session 1",
        //     "moderator" => "Abbas",
        //     "date_time_from" => "2023-11-07 09:30:00",
        //     "date_time_to" => "2023-11-07 15:05:00"
        // ];
        // $allSessions[] = [
        //     "id" => 2,
        //     "title" => "Session 2",
        //     "moderator" => "Samir",
        //     "date_time_from" => "2023-11-07 15:10:00",
        //     "date_time_to" => "2023-11-07 17:51:00"
        // ];
        // $allSessions[] = [
        //     "id" => 3,
        //     "title" => "Session 3",
        //     "moderator" => "Mounir",
        //     "date_time_from" => "2023-11-07 17:52:00",
        //     "date_time_to" => "2023-11-07 17:54:00"
        // ];
        // $allSessions[] = [
        //     "id" => 4,
        //     "title" => "Session 4",
        //     "moderator" => "Akram",
        //     "date_time_from" => "2023-11-07 17:55:00",
        //     "date_time_to" => "2023-11-07 19:23:00"
        // ];
        //// temp for testing ////


    return $allSessions;
  }
}
