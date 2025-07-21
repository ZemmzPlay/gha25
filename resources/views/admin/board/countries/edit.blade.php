@extends('admin.master')

@section('title', 'Edit Board Country')
@section('title2', 'Edit Board Country')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/board')}}">Board</a></li>
        <li><a href="{{url('admin/board/countries')}}">Board Countries</a></li>
            <li class="active">Edit Board Country</li>
    </ol>
@stop

@section('style')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}"> --}}
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                        Edit Board Country
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/board')}}"><i class="ti-arrow-left"></i></a>
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
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') ? old('name') : $country->name }}">
                    </div>
                </div>

                    <div class="form-group">
                        <label for="display_order" class="col-sm-3 control-label">Display Order</label>
                        <div class="col-sm-9">
                            <input id="display_order" type="text" class="form-control" name="display_order" required value="{{ old('display_order') ? old('display_order') : $country->display_order }}">
                        </div>
                    </div>
            </div>
        </form>
    </div>
@stop

@section('scripts')
@stop
