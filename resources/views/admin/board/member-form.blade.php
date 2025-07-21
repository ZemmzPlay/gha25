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
    @if($method == 'post')
        New Board Member
    @else
        Edit Board Member: {{$member->name}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Board Member
    @else
        Edit Board Member: {{$member->name}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/board')}}">Board Members</a></li>
        @if($method == 'post')
            <li class="active">New Board Member</li>
        @else
            <li>{{$member->name}}</li>
        @endif
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
                    @if($method == 'post')
                        New Board Member
                    @else
                        Edit Board Member: {{$member->name}}
                    @endif
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
                        <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') ? old('name') : $member->name}}">
                    </div>
                </div>


     

                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <select id="country" name="country_id" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{($country->id == $member->country_id) ? "selected" : ""}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="display_order" class="col-sm-3 control-label">Display Order</label>
                    <div class="col-sm-9">
                        <input id="display_order" type="text" class="form-control" name="display_order" required value="{{$member->display_order}}">
                    </div>
                </div>


                <div class="form-group">
                    <label for="image_file" class="col-sm-3 control-label">Image</label>
                    <label for="image_file" style="border:1px solid #ddd; display:inline-block; padding: 3px; margin-left: 15px;">

                        @if(!$member->image_file)
                            <div class="img-container-list">
                                <img src="{{asset('images/board/default_2.jpg')}}" id="BoardMemberImage" style="width: 200px;">
                            </div>
                            <input type="file" name="image_file" id="image_file" style="display: none;">
                        @else
                            <div class="img-container-list">
                                <img src="{{asset('images/board/'.$member->image_file)}}" id="BoardMemberImage" style="width: 200px;">
                            </div>
                            <input type="file" name="image_file" id="image_file" style="display: none;">
                        @endif
                    </label>
                    <br/>
                    <p class="col-md-3 col-md-offset-3">
                        Please be informed that any picture that you will upload will be resized to 387x446 pixels.
                    </p>
                </div>




            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#BoardMemberImage').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_file").change(function(){
            readURL(this);
        });
        $(document).ready(function() {
            $('#permission_id').select2({
                placeholder: "Select Permission"
            });
        });
    </script>

@stop
