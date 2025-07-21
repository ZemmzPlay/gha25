@extends('admin.master')

@section('title', 'Panelist')
@section('title2', 'Panelist')

@section('style')
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/program')}}">Program</a></li>
        <li class="active">Panelist</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Panelist List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/panelist/create')}}" class="btn btn-primary btn-lg">New Panelist</a>
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


            <table id="panelist-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($panelists as $panelist)
                        <tr data-id="{{$panelist->id}}">
                            <td>{{$panelist->name}}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-default" href="{{url('/admin/panelist/'.$panelist->id.'/edit')}}">Edit</a>
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
    <script type="text/javascript" src="{{asset('js/admin/panelist/list.js')}}"></script>
@stop