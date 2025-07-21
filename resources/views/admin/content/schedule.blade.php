@extends('admin.master')


@section('title')
    Event Schedule
@stop

@section('title2')
    Review and edit the event calendar
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Event Schedule</li>
    </ol>
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}">
    <style>
        table.dataTable {
            margin-bottom:30px !important;
            border: 1px solid #eee;
        }
    </style>
@stop

@section('content')
    <div class="widget no-border">
        <div class="widget-body pl-0 pt-0">

            @foreach($days as $day)
                <h1 class="mt-0 pb-5" style="border-bottom:1px dashed #ddd;">{{$day->date->format('l')}}<small style="font-size:12px; margin-top:20px;" class="pull-right">{{$day->date->format('d/m/Y')}}</small></h1>
                <table style="width: 100%" class="table table-hover dt-responsive nowrap schedule table-striped">

                    <thead>
                    <tr>
                        <th>Starts</th>
                        <th>Ends</th>
                        <th>Subject</th>
                        <th>Check-ins</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($day->activities as $activity)
                        <tr data-id="{{$activity->id}}">
                            <td>{{$activity->start_time}}</td>
                            <td>{{$activity->end_time}}</td>
                            <td>{!! $activity->title !!}</td>
                            <td>{{$activity->registrations()->count()}}</td>
                            <td class="text-right">
                                <a href="{{route('activities.single', ['id' => $activity->id])}}" class="btn btn-xs btn-default">Attendance</a>
                                <div class="btn-group">
                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-xs dropdown-toggle"><span class="ti-more"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('admin/schedule/'.$activity->id.'/edit')}}">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @endforeach


    </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/schedule.js')}}"></script>
@stop
