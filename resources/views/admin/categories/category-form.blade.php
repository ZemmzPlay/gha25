@extends('admin.master')

@section('title')
    @if($method == 'post')
        New Category
    @else
        Edit Category: {{$category->name_en}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Category
    @else
        Edit Category: {{$category->name_en}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/categories')}}">Categories</a></li>
        @if($method == 'post')
            <li class="active">New Category</li>
        @else
            <li>{{$category->name_en}}</li>
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
                        New Category
                    @else
                        Edit Category: {{$category->name_en}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/categories')}}"><i class="ti-arrow-left"></i></a>
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
                    <label for="title" class="col-sm-3 control-label">Name (English)</label>
                    <div class="col-sm-9">
                        <input id="title" type="text" class="form-control" name="name_en" value="{{$category->name_en}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Name (Arabic)</label>
                    <div class="col-sm-9">
                        <input id="title" type="text" class="form-control" name="name_ar" value="{{$category->name_ar}}">
                    </div>
                </div>




            </div>
        </form>
    </div>
@stop
