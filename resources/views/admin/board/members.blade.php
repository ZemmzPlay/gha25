@extends('admin.master')

@section('title', 'Board Members')
@section('title2', 'Board Members')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/members.css')}}" />
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Board Members</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Member List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/board/create')}}" class="btn btn-primary btn-lg">New Board Member</a>
                    </div>
                    <div class="btn-group">
                        <a href="{{url('admin/board/countries')}}" class="btn btn-purple btn-lg">Board Countries</a>
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


            <table id="member-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th style="width:80px;"></th>
                        <th>Name</th>
                        <th>Country</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($members as $member)
                        <tr data-id="{{$member->id}}">
                            <td style="vertical-align: middle">
                                <div class="img-container-list">
                                    @if($member->image_file && file_exists('images/board/'.$member->image_file))
                                        <img class="member-image" src="{{asset('images/board/'.$member->image_file)}}">
                                    @else
                                        <img class="member-image" src="{{asset('images/board/default_2.jpg')}}">
                                    @endif
                                </div>
                            </td>
                            <td>{{$member->name}}</td>
                            <td>{{$member->country->name}}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-default" href="{{url('/admin/board/'.$member->id.'/edit')}}">Edit</a>
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
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/board-member-list.js')}}"></script>
@stop