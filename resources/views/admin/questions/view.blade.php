@extends('admin.master')

@section('title', 'Question Sessions')
@section('title2', 'Question Sessions')

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li><a href="{{url('admin/questions')}}">Question Sessions</a></li>
  <li class="active">Questions View</li>
</ol>
@stop


@section('content')

<div class="widget no-border">

  <div class="widget-heading">
    <div class="row">
      <div class="col-md-6">
        <h3 class="widget-title" style="margin-top:8px;">Questions View</h3>
      </div>
      <div class="col-md-6 text-right">
      </div>
    </div>
  </div>

  <div class="widget-body">
    <input type="hidden" id="get-questions" value="{{ route('questions.get') }}">
    <input type="hidden" id="answer-question" value="{{ route('questions.answer') }}">
    <input type="hidden" id="session-id" value="{{ $session_id }}">
    <input type="hidden" id="last-id" value="0">

    <div>
      <table class="table">
        <thead>
          <tr>
            <th>Answered</th>
            <th>Name</th>
            <th>Question</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody class="table-body">
          
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/admin/questions/questions.js')}}"></script>
@stop