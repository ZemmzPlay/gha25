@extends('admin.master')

@section('title', 'Question Sessions')
@section('title2', 'Question Sessions')

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li class="active">Question Sessions</li>
</ol>
@stop

@section('style')
<link href="{{ asset('css/admin/questions.css') }}" rel="stylesheet" />
@stop


@section('content')

<div class="widget no-border">

  <div class="widget-heading">
    <div class="row">
      <div class="col-md-6">
        <h3 class="widget-title" style="margin-top:8px;">Question Sessions List</h3>
      </div>
      <div class="col-md-6 text-right">

      </div>
    </div>
  </div>


  <div class="widget-body">

    @if(Session::has('message'))
    <div class="alert alert-success col-md-12">
      {!! Session::get('message') !!}
    </div>
    @endif

    <input type="hidden" id="get-questions" value="{{ route('questions.get') }}">
    <input type="hidden" id="answer-question" value="{{ route('questions.answer') }}">
    <input type="hidden" id="enable-question" value="{{ route('questions.enable') }}">
    {{-- <input type="hidden" id="session-id" value="{{ $session_id }}"> --}}
    <input type="hidden" id="last-id" value="0">

    <div class="form-group">
      <label class="col-sm-3 control-label">Questions</label>
      <div class="col-sm-9">
        <div class="has-success">
          <div class="switch mt-0">
            <input id="questionsEnable" name="questionsEnable" type="checkbox" {{ ($questionEnable->enableLiveConferenceQuestions) ? "checked" : ""}}>
            <label for="questionsEnable" class="switch-success"></label>
          </div>
        </div>
      </div>
    </div>

    @foreach($sessions as $session)
    <div class="sessions-questions">
      <div class="sessions">
        <label>{{ $session["title"] }}</label>
        <button class="btn btn-primary view-question" type="button" data-id="{{ $session["id"] }}" {{-- data-toggle="collapse" --}} {{-- data-target="#question-{{ $session->session_id }}" aria-expanded="true" aria-controls="question-{{ $session->session_id }}" --}}>
          View
        </button>
      </div>
      <div class="questions collapse" id="questions-{{ $session["id"] }}">
        <div class="card card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Answered</th>
                <th>Name</th>
                <th>Question</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody class="table-questions" id="table-body-{{ $session["id"] }}">

            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endforeach


    {{-- <table id="session-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

      <thead>
        <tr>
          <th>Title</th>
          <th class="text-right">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($sessions as $session)
        <tr>
          <td>
            {{ $session->session->title }}
          </td>
          <td class="text-right">
            <a href="{{ route('questions.view', $session->session_id) }}"><button class="btn btn-sm btn-second">Questions</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table> --}}

  </div>

</div>
@stop

@section('scripts')
{{-- <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/class-list.js')}}"></script> --}}
<script src="{{asset('js/admin/questions/questions.js')}}"></script>


@stop