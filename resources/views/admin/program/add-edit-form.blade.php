@extends('admin.master')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('title')
    @if($method == 'post')
        New Program Session
    @else
        Edit Session: {{$session->title}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Program Session
    @else
        Edit Session: {{$session->title}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/program')}}">Program Sessions</a></li>
        @if($method == 'post')
            <li class="active">New Program Session</li>
        @else
            <li>{{$session->title}}</li>
        @endif
    </ol>
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}">
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                    @if($method == 'post')
                        New Program Session
                    @else
                        Edit Session: {{$session->title}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/program')}}"><i class="ti-arrow-left"></i></a>
                </div>
            </div>

            <div class="widget-body">

                @if(count($errors) > 0)
                    <div class="alert alert-danger col-md-12">
                        @if(count($errors) == 1)
                            {{$errors->first()}}
                        @else
                            The following errors happened:
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success col-md-12">
                        {!! Session::get('message') !!}
                    </div>
                @endif

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input id="name" type="text" class="form-control" name="title" required value="{{(isset($session) ? $session->title : '')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input id="date" type="date" class="form-control" name="session_date" required value="{{(isset($session) ? $session->session_date : '')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_time" class="col-sm-3 control-label">Start time</label>
                    <div class="col-sm-9">
                        <input id="start_time" type="time" class="form-control" name="start_time" value="{{(isset($session) ? substr($session->start_time, 0, -3) : '')}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_time" class="col-sm-3 control-label">End time</label>
                    <div class="col-sm-9">
                        <input id="end_time" type="time" class="form-control" name="end_time" value="{{(isset($session) ? substr($session->end_time, 0, -3) : '')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="moderator" class="col-sm-3 control-label">Moderator</label>
                    <div class="col-sm-9">
                        <select id="moderator" name="moderator_id" class="form-control">
                            <option value="">Select Moderator</option>
                            @foreach($moderators as $moderator)
                                <option value="{{$moderator->id}}" {{(isset($session) && $moderator->id == $session->moderator_id) ? "selected" : ""}}>{{$moderator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="facilitated" class="col-sm-3 control-label">facilitated</label>
                    <div class="col-sm-9">
                        <select id="facilitated" name="facilitated[]" class="form-control" multiple="multiple">
                            @foreach($moderators as $moderator)
                                <option value="{{$moderator->id}}" {{(in_array($moderator->id,$selected_facilitated)) ? "selected" : ""}}>{{$moderator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="panelist" class="col-sm-3 control-label">Panelist</label>
                    <div class="col-sm-9">
                        <select id="panelist" name="panelist_id[]" class="form-control" multiple="multiple">
                            @foreach($panelists as $panelist)
                                <option value="{{$panelist->id}}" {{(in_array($panelist->id,$selected_panelist)) ? "selected" : ""}}>{{$panelist->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/program/add-edit-form.js?ver=1.1')}}"></script>
@stop
