@extends('admin.master')


@section('title')
    {{$activity->title}}
@stop

@section('title2')
    Managing Agenda Activity
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/schedule')}}">Schedule</a></li>
        <li class="active">{{$activity->title}}</li>
    </ol>
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app/css/flat.css')}}">
    <style>
        table.dataTable {
            margin-bottom:30px !important;
            border: 1px solid #eee;
        }
    </style>
@stop

@section('content')
    <div class="widget no-border">
        <div class="widget-body pl-0 pr-0 pt-0">
            <h2 class="mb-20">{{$activity->title}}</h2>

            <div class="row">
                <div class="col-md-6">

                    <div class="widget no-border p-30 bg-danger mb-10">
                        <div class="media">
                            <div class="media-left media-middle pr-20"><i class="ti-alarm-clock fs-60"></i></div>
                            <div class="media-body media-middle">
                                <div class="fs-20 fw-300">{{$activity_starts_at->diffForHumans()}}</div>
                                <p class="mb-0">{{$activity->day->date->format('l - d F Y')}}, {{$activity->start_time}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="widget no-border p-30 bg-primary">
                        <div class="media">
                            <div class="media-left media-middle pr-20"><i class="ti-cup fs-60"></i></div>
                            <div class="media-body media-middle">
                                <div class="fs-20 fw-300">2 CME points</div>
                                <p class="mb-0">Total number of CME points accredited for this session</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="widget">
                        <div class="widget-body">
                            <p class="fs-16 fw-500 mb-5">Attendance</p>
                            <p class="text-muted">Use the below controls to track your audience</p>

                            <input type="hidden" id="activity-id" value="{{$activity->id}}">

                            <div role="tabpanel">
                                <ul role="tablist" class="nav nav-pills nav-justified mb-0">
                                    <li role="presentation" class="active">
                                        <a id="checkin-tab" href="#checkin" role="tab" data-toggle="tab" aria-controls="checkin" aria-expanded="true" class="btn"><span class="zmdi zmdi-arrow-in"></span> Checking IN</a>
                                    </li><li role="presentation" class="">
                                        <a id="checkout-tab" href="#checkout" role="tab" data-toggle="tab" aria-controls="checkout" aria-expanded="false" class="btn"><span class="zmdi zmdi-arrow-out"></span> Checking OUT</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="checkin" role="tabpanel" aria-labelledby="checkin-tab" class="tab-pane fade active in">
                                        <input type="text" class="form-control input-lg barCodeInput" style="border-radius: 0; border-color:#5cb85c;" placeholder="Scan attendee's ID for CHECK-IN" data-type="checkin">
                                    </div>
                                    <div id="checkout" role="tabpanel" aria-labelledby="checkout-tab" class="tab-pane fade">
                                        <input type="text" class="form-control input-lg barCodeInput" style="border-radius: 0; border-color:#5cb85c;" placeholder="Scan attendee's ID for CHECK-OUT" data-type="checkout">
                                    </div>
                                </div>
                            </div>

<!--
                            <ul class="list-unstyled mb-0">
                                <li class="mt-15">
                                    <div class="block clearfix mb-5"><span class="pull-left fs-12">Checked-in attendees</span><span class="pull-right label label-outline label-success">65%</span></div>
                                    <div class="progress progress-xs mb-0">
                                        <div role="progressbar" data-transitiongoal="65" class="progress-bar progress-bar-success" style="width: 65%;" aria-valuenow="65"></div>
                                    </div>
                                </li>

                            </ul>

                            -->
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/schedule.js')}}"></script>
@stop
