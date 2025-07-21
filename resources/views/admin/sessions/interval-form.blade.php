@extends('admin.master')

@section('title')
    @if($method == 'post')
        New Lecture
    @else
        Edit Lecture: {{$interval->title}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Lecture
    @else
        Edit Lecture: {{$interval->title}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/schedule')}}">Schedule</a></li>
        @if($method == 'post')
            <li class="active">New Lecture</li>
        @else
            <li>Edit Lecture - {{$interval->title}}</li>
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
                        New Lecture
                    @else
                        Edit Lecture - {{$interval->title}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/sessions')}}"><i class="ti-arrow-left"></i></a>
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
                        <label for="price" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input id="title" type="text" class="form-control" name="title" value="{{($interval->title)}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="session" class="col-sm-3 control-label">Session</label>
                        <div class="col-sm-9">
                            <select id="session" class="form-control" name="event_session_id">
                                @foreach($sessions as $session)
                                    <option value="{{$session->id}}" {{$session->id == $interval->event_session_id ? "selected" : ""}}>{{$session->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label for="start_at" class="col-sm-3 control-label">Start time</label>
                    <div class="col-sm-9">
                        <input id="start_at" type="time" class="form-control" name="starts_at" value="{{$interval->starts_at}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ends_at" class="col-sm-3 control-label">End time</label>
                    <div class="col-sm-9">
                        <input id="ends_at" type="time" class="form-control" name="ends_at" value="{{$interval->ends_at}}">
                    </div>
                </div>


                <div class="form-group">
                    <label for="speaker" class="col-sm-3 control-label">Speaker</label>
                    <div class="col-sm-9">
                        <input id="speaker" type="text" class="form-control" name="speaker" value="{{$interval->speaker}}">
                    </div>
                </div>

                    <div class="form-group">
                        <label for="display_order" class="col-sm-3 control-label">Display order</label>
                        <div class="col-sm-9">
                            <input id="display_order" type="number" class="form-control" name="display_order" value="{{$interval->display_order}}" min="1">
                        </div>
                    </div>



            </div>
        </form>
    </div>
@stop
