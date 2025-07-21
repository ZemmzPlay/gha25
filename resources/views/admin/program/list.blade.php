@extends('admin.master')

@section('title', 'Program')
@section('title2', 'Program')

@section('style')
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Program</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Session List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/moderator')}}" class="btn btn-primary btn-lg" style="margin-right: 8px;">Moderators</a>
                        <a href="{{url('admin/panelist')}}" class="btn btn-primary btn-lg" style="margin-right: 8px;">Panelist</a>
                        <a href="{{url('admin/speaker')}}" class="btn btn-primary btn-lg" style="margin-right: 8px;">Speakers</a>
                        <a href="{{url('admin/program/create')}}" class="btn btn-primary btn-lg">New Program Session</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="widget-body">

            @if(Session::has('message'))
                <div class="alert alert-success col-md-12">
                    {!! Session::get('message') !!}
                </div>
            @endif


            <table id="session-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sessions as $session)
                        <tr data-id="{{$session->id}}">
                            <td>{{$session->title}}</td>
                            <td>{{date('l F j', strtotime($session->session_date))}}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-default" href="{{url('/admin/program/'.$session->id.'/edit')}}">Edit</a>
                                <a class="btn btn-sm btn-default" href="{{url('/admin/program/'.$session->id.'/lectures')}}">Lectures</a>
                                <button class="btn btn-sm btn-danger delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@stop

@section('scripts')
    <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/program/list.js')}}"></script>
@stop