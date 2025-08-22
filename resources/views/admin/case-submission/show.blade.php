@extends('admin.master')

@section('style')
@stop

@section('title')
  Case Submission View
@stop

@section('title2')
  Case Submission View
@stop

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li><a href="{{ route('case-submission.index') }}">Case Submissions</a></li>
    <li class="active">Case Submission View</li>
  </ol>
@stop

@section('style')
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/flat.css') }}"> --}}
@stop

@section('content')
  <div class="widget" style="padding: 0 15px;">

    <div class="widget-heading clearfix">
      <h3 class="widget-title pull-left">
        Case Submission View
      </h3>
      <div class="pull-right">
        <a class="btn btn-default" href="{{ route('case-submission.index') }}"><i class="ti-arrow-left"></i></a>
      </div>
    </div>

    <div class="widget-body">

      <div>
        <label><strong>Name:</strong></label>
        <p>{{ $caseSubmission->name }}</p>
      </div>

      <div>
        <label><strong>Email:</strong></label>
        <p>{{ $caseSubmission->email }}</p>
      </div>

      <div>
        <label><strong>Phone Number:</strong></label>
        <p>{{ $caseSubmission->phone_number }}</p>
      </div>

      <div>
        <label><strong>Country:</strong></label>
        <p>{{ $caseSubmission->countryName }}</p>
      </div>

      <div>
        <label><strong>Hospital Name:</strong></label>
        <p>{{ $caseSubmission->hospital_name }}</p>
      </div>

      <div>
        <label><strong>Synopsis Case:</strong></label>
        <p>{{ $caseSubmission->synopsis_case }}</p>
      </div>

      @if ($caseSubmission->document)
        <div>
          <label><strong>Document:</strong></label>
          <p><a href="{{ route('case-submission.download', ['id' => $caseSubmission->id]) }}" target="_blank">Download
              Document</a></p>
        </div>
      @endif

    </div>
  </div>
@stop

@section('scripts')

@stop
