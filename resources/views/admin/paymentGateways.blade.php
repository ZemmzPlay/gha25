@extends('admin.master')

@section('title', 'Payment Gateways')
@section('title2', 'Payment Gateways')

@section('style')

@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
    <li><a href="{{url('admin')}}">Dashboard</a></li>
    <li class="active">Payment Gateways</li>
</ol>
@stop


@section('content')
<div class="widget" style="padding: 0 15px;">
    <form class="form-horizontal" method="post">
        {{csrf_field()}}

        <div class="widget-heading clearfix">
            <h3 class="widget-title pull-left">Payment Gateways</h3>
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

            @if($selected_payment_gateway == 1)
                <div class="form-group">
                    <label class="col-sm-3 control-label">Secret Key Test</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="secret_key_test" value="{{(isset($test_creds['secret_key'])) ? $test_creds['secret_key'] : ''}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Public Key Test</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="public_key_test" value="{{(isset($test_creds['public_key'])) ? $test_creds['public_key'] : ''}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Secret Key Live</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="secret_key_live" value="{{(isset($live_creds['secret_key'])) ? $live_creds['secret_key'] : ''}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Public Key Live</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="public_key_live" value="{{(isset($live_creds['public_key'])) ? $live_creds['public_key'] : ''}}" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">merchantID</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="merchantID" value="{{(isset($live_creds['merchantID'])) ? $live_creds['merchantID'] : ''}}" />
                    </div>
                </div>
            @elseif($selected_payment_gateway == 2)
                <div class="form-group">
                    <label class="col-sm-3 control-label">URL Test</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="url_test" value="{{(isset($test_creds['url'])) ? $test_creds['url'] : ''}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Key Test</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="key_test" value="{{(isset($test_creds['key'])) ? $test_creds['key'] : ''}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">URL Live</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="url_live" value="{{(isset($live_creds['url'])) ? $live_creds['url'] : ''}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Key Live</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="key_live" value="{{(isset($live_creds['key'])) ? $live_creds['key'] : ''}}" />
                    </div>
                </div>
            @endif

                


        </div>
    </form>
</div>
@stop

@section('scripts')
@stop