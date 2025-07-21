<?php

namespace App\Http\Controllers;

use App\EventDay;
use Illuminate\Http\Request;
use Auth;
use App\Registration;
use App\GeneralQuestion;
use App\Question;
use App\PageContent;
use App\Workshop;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('admin', ['except' => [
            'getLogin',
            'postLogin'
        ]]);
    }

    public function getIndex() {
        $user = Auth::guard('admin')->user();
        $registration_count = Registration::where('onlyWorkshop', 0)->whereHas('Payment', function($query) {
            $query->where('paid_status', 1);
        })->count();
        $workshops = Workshop::all();
        $certificate_downloads = Registration::where('answered', '=', '1')->get()->count();
        $attendees = Registration::whereAttended(1)->get()->count();
        return view('admin.index', compact('user', 'registration_count', 'certificate_downloads', 'attendees', 'workshops'));
    }

    public function getLogin() {
        return view('admin.login-v2');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email'     =>  'required|min:3|max:254|email',
            'password'  =>  'required'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect('/admin');
        }

        return redirect()->back()->withErrors('The information you entered are invalid. Please try again.')->withInput();
    }

    public function getLogout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function getEvaluation() {
        $user = Auth::guard('admin')->user();
        $suggestions = Registration::where('suggestion', '!=', '""')->get();
        $comments = Registration::where('comment', '!=', '""')->get();
        $general_questions = GeneralQuestion::all();
        $questions = Question::all();

        return view('admin.evaluation', compact('user', 'general_questions', 'questions', 'comments','suggestions'));
    }


    public function drawPage() {
        $user = Auth::guard('admin')->user();
        $registration_count = Registration::count();
        return view('admin.draw', compact('user', 'registration_count'));
    }

    public function schedule(){
        $user = Auth::guard('admin')->user();
        $days = EventDay::all();
        return view('admin.content.schedule', compact('user', 'days'));
    }

    public function pageContent()
    {
        $pageContent = PageContent::first();

        return view('admin.pageContent', compact('pageContent'));
    }

    public function updatePageContent(Request $request)
    {
        $pageContent = PageContent::first();

        $pageContent->terms = $request->terms;

        $pageContent->save();

        return view('admin.pageContent', compact('pageContent'));
    }


}
