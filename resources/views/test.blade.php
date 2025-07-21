@extends('admin.master')

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
    </style>
@stop

@section('title')
    Send Email
@stop

@section('title2')
    Send Email
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Send Email</li>
    </ol>
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}">
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                    Send Email
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <!-- <a class="btn btn-default" href="{{url('admin/faculty')}}"><i class="ti-arrow-left"></i></a> -->
                    <!-- <a class="btn btn-default" href="{{url('test/mail')}}">Mail</a> -->
                    <!-- <a class="btn btn-default" href="{{url('test/delete')}}">Delete</a> -->
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
                    <label for="id" class="col-sm-3 control-label">ID</label>
                    <div class="col-sm-9">
                        <input id="id" type="text" class="form-control" name="id" value="{{ old('id') ? old('id') : ''}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="id" class="col-sm-3 control-label">OR</label>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') ? old('email') : ''}}">
                    </div>
                </div>


                <!-- <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') ? old('name') : ''}}">
                    </div>
                </div> -->



                <!-- <div class="form-group">
                    <label for="image_file" class="col-sm-3 control-label">Image</label>
                    <label for="image_file" style="border:1px solid #ddd; display:inline-block; padding: 3px; margin-left: 15px;">

                        <div class="img-container-list">
                            <img src="{{asset('images/faculty/default_2.jpg')}}" id="FacultyMemberImage" style="width: 200px;">
                        </div>
                        <input type="file" name="image_file" id="image_file" style="display: none;">

                    </label>
                    <br/>
                    <p class="col-md-3 col-md-offset-3">
                        Please be informed that any picture that you will upload will be resized to 387x446 pixels.
                    </p>
                </div> -->




            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function (e) {
        //             $('#FacultyMemberImage').attr('src', e.target.result);

        //         }

        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        // $("#image_file").change(function(){
        //     readURL(this);
        // });
    </script>

@stop