<?php

namespace App\Http\Controllers;

use App\CaseSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseSubmissionController extends Controller
{
    /**
     * Display a listing of the case submissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $caseSubmissions = CaseSubmission::all();
        return view('admin.case-submission.index', compact('caseSubmissions'));
    }

    /**
     * Display the specified case submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        $caseSubmission = CaseSubmission::findOrFail($id);
        return view('admin.case-submission.show', compact('caseSubmission'));
    }

    /**
     * Download the document associated with the specified case submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadDocument($id)
    {
        $caseSubmission = CaseSubmission::findOrFail($id);
        // Get the document from storage
        $file = Storage::path('public/case_submissions/' . $caseSubmission->document);
        return response()->download($file);
    }
}
