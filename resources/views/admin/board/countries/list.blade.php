@extends('admin.master')

@section('title', 'Board Countries')
@section('title2', 'Board Countries')

@section('style')
{{-- <link rel="stylesheet" href="{{asset('css/admin/countries.css')}}" /> --}}
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/board')}}">Board</a></li>
        <li class="active">Board Countries</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Country List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/board/countries/create')}}" class="btn btn-primary btn-lg">New Country</a>
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


            <table id="country-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Display Order</th>
                        <th class="text-center">Board Members</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($countries as $country)
                    <tr data-id="{{$country->id}}">
                        <td>{{$country->name}}</td>
                        <td class="text-center">{{$country->display_order}}</td>
                        <td class="text-center">{{ count($country->members )}}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-default" href="{{url('/admin/board/countries/'.$country->id)}}">Edit</a>
                            <button class="btn btn-sm btn-danger delete" @if(count($country->members) != 0) disabled title="Cannot delete, Contains Board Members" @endif>Delete</button>
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
    <script type="text/javascript" src="{{asset('js/admin/boardCountry/list.js')}}"></script>
@stop