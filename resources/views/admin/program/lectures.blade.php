@extends('admin.master')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .loadingPanel {
            position: fixed;
            left: 0px;
            top: 0px;
            background: rgba(0,0,0,0.5);
            width: 100%;
            height: 100%;
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lds-circle {
            display: inline-block;
            transform: translateZ(1px);
        }
        .lds-circle > div {
            display: inline-block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            background: #fff;
            animation: lds-circle 2.4s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        @keyframes lds-circle {
          0%, 100% {
            animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
          }
          0% {
            transform: rotateY(0deg);
          }
          50% {
            transform: rotateY(1800deg);
            animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
          }
          100% {
            transform: rotateY(3600deg);
          }
        }
    </style>
@stop

@section('title')
    Session Lectures for {{$session->title}}
@stop

@section('title2')
    Session Lectures for {{$session->title}}
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/program')}}">Program Sessions</a></li>
        <li>{{$session->title}}</li>
    </ol>
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}">
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post">

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                    Session Lectures
                </h3>
            </div>

            <div class="widget-body">

                @if(Session::has('message'))
                    <div class="alert alert-success col-md-12" id="sessionAddedSuccessMsg">
                        {!! Session::get('message') !!}
                    </div>
                @endif


                <div class="loadingPanel hide">
                    <div class="lds-circle"><div></div></div>
                </div>

                <div class="alert alert-danger col-md-12 lecturesErrorsContainer hide">
                    <span class="lecturesErrorMsg"></span>
                    <ul class="lecturesErrors"></ul>
                </div>

                <div class="alert alert-success col-md-12 lecturesSuccessContainer hide"></div>

                <div class="allRowsLecture"> 
                    @include('admin.program.allRowsLecture', [$lectures, $speakers, $session])
                </div>

            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/program/lectures.js?ver=1.2')}}"></script>
@stop
