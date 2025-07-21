@extends('admin.master')

@section('title', 'Slideshow')
@section('title2', 'Slideshow')

@section('style')
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Slideshow</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Slideshow List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/slideshow/create')}}" class="btn btn-primary btn-lg">New Slideshow</a>
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


            <table id="slideshow-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($slideshows as $slideshow)
                        <tr data-id="{{$slideshow->id}}">
                            <td>{{$slideshow->title}}</td>
                            <td>{{date('d M Y', strtotime($slideshow->start_date))}}</td>
                            <td>{{date('H i', strtotime($slideshow->start_time))}}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-default" href="{{url('/admin/slideshow/'.$slideshow->id.'/edit')}}">Edit</a>
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
    <script type="text/javascript" src="{{asset('js/admin/slideshow/list.js')}}"></script>
@stop