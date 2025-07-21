@extends('admin.master')

@section('title')
    @if($method == 'post')
        New Slideshow
    @else
        Edit Slideshow: {{$slideshow->title}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Slideshow
    @else
        Edit Slideshow: {{$slideshow->title}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/slideshow')}}">Slideshows</a></li>
        @if($method == 'post')
            <li class="active">New Slideshow</li>
        @else
            <li>{{$slideshow->title}}</li>
        @endif
    </ol>
@stop

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .img-container-list {
            background: #DDDDDC;
            -webkit-clip-path: circle(50%);
            clip-path: circle(50%);
            margin: 0 auto;
            padding: 1px;
            overflow: auto;
        }

        .img-container-list img {
            display: block;
            width: 100%;
            -webkit-clip-path: circle(50%);
            clip-path: circle(50%);
            height: auto;
        }
        .errorMsg {
            color: red;
            font-style: italic;
        }
    </style>
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                    @if($method == 'post')
                        New Slideshow
                    @else
                        Edit Slideshow: {{$slideshow->title}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/slideshow')}}"><i class="ti-arrow-left"></i></a>
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
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input id="title" type="text" class="form-control" name="title" required value="{{(isset($slideshow) ? $slideshow->title : ((old('title')) ? old('title') : ''))}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="details" class="col-sm-3 control-label">Details</label>
                    <div class="col-sm-9">
                        <input id="details" type="text" class="form-control" name="details" required value="{{(isset($slideshow) ? $slideshow->details : ((old('details')) ? old('details') : ''))}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="location" class="col-sm-3 control-label">Location</label>
                    <div class="col-sm-9">
                        <input id="location" type="text" class="form-control" name="location" required value="{{(isset($slideshow) ? $slideshow->location : ((old('location')) ? old('location') : ''))}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_date" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input id="start_date" type="date" class="form-control" name="start_date" required value="{{(isset($slideshow) ? $slideshow->start_date : ((old('start_date')) ? old('start_date') : ''))}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_time" class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                        <input id="start_time" type="time" class="form-control" name="start_time" value="{{(isset($slideshow) ? substr($slideshow->start_time, 0, -3) : ((old('start_time')) ? old('start_time') : ''))}}" required>
                    </div>
                </div>


                <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Image</label>
                    <label for="image" style="border:1px solid #ddd; display:inline-block; padding: 3px; margin-left: 15px;">
                        <div class="img-container-list">
                            <img src="{{(!isset($slideshow)) ? asset('images/slideshow/default_2.jpg') : asset('images/slideshow/'.$slideshow->image)}}" id="imageShow" style="width: 200px;">
                        </div>
                        <input type="file" name="image" id="image" style="display: none;">
                    </label>
                    <br/>
                    <p class="col-md-3 col-md-offset-3">
                        Recommended picture size is 1920x600 pixels and should be (jpeg, jpg, bmp, png).
                    </p>
                    @if($errors->has('image'))
                        <p class="col-md-12 col-md-offset-3 errorMsg">{{ $errors->first('image') }}</p>
                    @endif
                </div>


                <div class="form-group">
                    <label for="image_mobile" class="col-sm-3 control-label">Image Mobile</label>
                    <label for="image_mobile" style="border:1px solid #ddd; display:inline-block; padding: 3px; margin-left: 15px;">
                        <div class="img-container-list">
                            <img src="{{(!isset($slideshow)) ? asset('images/slideshow/default_2.jpg') : asset('images/slideshow/'.$slideshow->image_mobile)}}" id="imageMobileShow" style="width: 200px;">
                        </div>
                        <input type="file" name="image_mobile" id="image_mobile" style="display: none;">
                    </label>
                    <br/>
                    <p class="col-md-3 col-md-offset-3">
                        Recommended picture size is 664x600 pixels and should be (jpeg, jpg, bmp, png).
                    </p>
                    @if($errors->has('image_mobile'))
                        <p class="col-md-12 col-md-offset-3 errorMsg">{{ $errors->first('image_mobile') }}</p>
                    @endif
                </div>

                <?php
                $oldActive = '1';
                if(old('title') && !old('active')) $oldActive = '0';
                ?>

                <div class="form-group">
                    <label for="active" class="col-sm-3 control-label">Calendar</label>
                    <div class="col-sm-9">
                        <select id="active" name="active" class="form-control">
                            <option value="1" {{(isset($slideshow) && $slideshow->active == 1) ? "selected" : (($oldActive == '1') ? "selected" : "")}}>On</option>
                            <option value="0" {{(isset($slideshow) && $slideshow->active == 0) ? "selected" : (($oldActive == '0') ? "selected" : "")}}>Off</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="buttonTheme" class="col-sm-3 control-label">Calendar Button Theme</label>
                    <div class="col-sm-9">
                        <select id="buttonTheme" name="buttonTheme" class="form-control">
                            <option value="1" {{(isset($slideshow) && $slideshow->buttonTheme == 1) ? "selected" : ((old('buttonTheme') && old('buttonTheme') == '1') ? "selected" : "")}}>Dark</option>
                            <option value="2" {{(isset($slideshow) && $slideshow->buttonTheme == 2) ? "selected" : ((old('buttonTheme') && old('buttonTheme') == '2') ? "selected" : "")}}>Light</option>
                        </select>
                    </div>
                </div>

            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/slideshow/add-edit-form.js')}}"></script>
@stop
