@extends('admin.master')

@section('title', 'Settings')
@section('title2', 'Settings')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .imageFrameContainer {
            border:1px solid #ddd;
            display:inline-block;
            padding: 3px;
            margin-left: 15px;
        }
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
            width: 200px;
            -webkit-clip-path: circle(50%);
            clip-path: circle(50%);
            height: auto;
        }
    </style>
@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
    <li><a href="{{url('admin')}}">Dashboard</a></li>
    <li class="active">Settings</li>
</ol>
@stop


@section('content')
<div class="widget" style="padding: 0 15px;">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="widget-heading clearfix">
            <h3 class="widget-title pull-left">Settings</h3>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
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
                <label class="col-sm-3 control-label">Faculty Enable/Disable</label>
                <div class="col-sm-9">
                    <div class="has-success">
                        <div class="switch mt-0">
                            <input id="facutlyEnableDisable" name="facutlyEnableDisable" type="checkbox" value="1" {{(Settings::get('facutlyEnableDisable')) ? "checked" : ""}}>
                            <label for="facutlyEnableDisable" class="switch-success"></label>
                        </div>
                    </div>
                </div>
            </div>



            <!-- /////////////// password /////////////// -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Enable password</label>
                <div class="col-sm-9">
                    <div class="has-success">
                        <div class="switch mt-0">
                            <input id="enablePassword" name="enablePassword" type="checkbox" value="1" {{($configuration->enablePassword == 1) ? "checked" : ""}}>
                            <label for="enablePassword" class="switch-success"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Website Password</label>
                <div class="col-sm-9">
                    <input type="text" id="website_password" class="form-control" name="website_password" value="{{$configuration->website_password}}" />
                </div>
            </div>
            <!-- /////////////// password /////////////// -->



            <div class="form-group">
                <label for="payment_status" class="col-sm-3 control-label">Payment status</label>
                <div class="col-sm-9">
                    <select id="payment_status" name="payment_status" class="form-control">
                        <option value="test" {{($configuration->payment_status == 'test') ? 'selected' : ''}}>Test</option>
                        <option value="live" {{($configuration->payment_status == 'live') ? 'selected' : ''}}>Live</option>
                    </select>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">Website title</label>
                <div class="col-sm-9">
                    <input type="text" id="website_title" class="form-control" name="website_title" value="{{$configuration->website_title}}" />
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label">Logo</label>
                <label class="imageFrameContainer">
                    <div class="img-container-list">
                        <img src="{{($configuration->logo == '') ? asset('images/global/noImage.jpg') : asset('images/'.$configuration->logo)}}" class="imageHolder">
                    </div>
                    <input type="file" name="logo" class="imageInput" style="display: none;">
                </label>
                <br/>
                <p class="col-md-3 col-md-offset-3">
                    Please be informed that any picture that you will upload will be resized to 341x96 pixels.
                </p>
            </div>





            <p>Live Conference Settings</p>
            <div class="form-group">
                <label class="col-sm-3 control-label">Enable Live Conference</label>
                <div class="col-sm-9">
                    <div class="has-success">
                        <div class="switch mt-0">
                            <input id="enableLiveConference" name="enableLiveConference" type="checkbox" value="1" {{($configuration->enableLiveConference == 1) ? "checked" : ""}}>
                            <label for="enableLiveConference" class="switch-success"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Enable Questions</label>
                <div class="col-sm-9">
                    <div class="has-success">
                        <div class="switch mt-0">
                            <input id="enableLiveConferenceQuestions" name="enableLiveConferenceQuestions" type="checkbox" value="1" {{($configuration->enableLiveConferenceQuestions == 1) ? "checked" : ""}}>
                            <label for="enableLiveConferenceQuestions" class="switch-success"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Broadcast Link</label>
                <div class="col-sm-9">
                    <input type="text" id="broadcastLink" class="form-control" name="broadcastLink" value="{{$configuration->broadcastLink}}" />
                </div>
            </div>


        </div>
    </form>
</div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/settings.js')}}"></script>
@stop