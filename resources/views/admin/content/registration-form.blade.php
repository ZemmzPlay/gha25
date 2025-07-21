@extends('admin.master')

@section('title')
    Registration & CME
@stop

@section('title2')
    Edit Registration & CME page
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Registration & CMEr</li>

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
                <h3 class="widget-title pull-left">Registration & CME</h3>
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
                    <label for="registraton_text" class="col-sm-3 control-label">Registration</label>
                    <div class="col-sm-9">
                        <textarea id="registraton_text" class="form-control" name="registration_text" rows="5">{{$registration_text}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cme_text" class="col-sm-3 control-label">CME</label>
                    <div class="col-sm-9">
                    <textarea id="cme_text" class="form-control" name="cme_text" rows="5">{{$cme_text}}</textarea>
                    </div>
                </div>




            </div>
        </form>
    </div>
@stop
