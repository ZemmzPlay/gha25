@extends('admin.master')

@section('title')
    @if($method == 'post')
        New Course
    @else
        Edit Course: {{$course->name_en}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Course
    @else
        Edit Course: {{$course->name_en}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/courses')}}">Courses</a></li>
        @if($method == 'post')
            <li class="active">New Course</li>
        @else
            <li>{{$course->name_en}}</li>
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
                        New Course
                    @else
                        Edit Course: {{$course->name_en}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/courses')}}"><i class="ti-arrow-left"></i></a>
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
                    <label for="name_en" class="col-sm-3 control-label">Name (English)</label>
                    <div class="col-sm-9">
                        <input id="name_en" type="text" class="form-control" name="name_en" value="{{$course->name_en}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name_ar" class="col-sm-3 control-label">Name (Arabic)</label>
                    <div class="col-sm-9">
                        <input id="name_ar" type="text" class="form-control" name="name_ar" value="{{$course->name_ar}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-9">
                        <select id="category" class="form-control" name="category_id" required>
                            <option value="">- Select a course category -</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ ($course->category_id == $category->id) ? "selected" : ""  }}>{{$category->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="vendor" class="col-sm-3 control-label">Vendor</label>
                    <div class="col-sm-9">
                        <select id="vendor" class="form-control" name="vendor_id">
                            <option value="">- Select a vendor -</option>
                            @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}" {{ ($course->vendor_id == $vendor->id) ? "selected" : ""  }}>{{$vendor->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description_en" class="col-sm-3 control-label">Description (English)</label>
                    <div class="col-sm-9">
                        <textarea id="description_en" class="form-control" name="description_en" rows="5">{{$course->description_en}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description_ar" class="col-sm-3 control-label">Description (Arabic)</label>
                    <div class="col-sm-9">
                        <textarea id="description_ar" class="form-control" name="description_ar" rows="5">{{$course->description_ar}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="default_price" class="col-sm-3 control-label">Default Price</label>
                    <div class="col-sm-9">
                        <input id="default_price" type="number" class="form-control" name="default_price" value="{{$course->default_price}}" step="0.01" min="0">
                    </div>
                </div>




            </div>
        </form>
    </div>
@stop
