@extends('admin.master')

@section('title', 'Z Events Management System')
@section('title2', 'Z Events Management System')

@section('style')
    <style>
        .suggestion {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .suggestion:last-child {
            border: none;
        }
    </style>
@stop

@section('breadcrumps')
    <p class="text-muted mb-0">{{date("l, d F Y")}}</p>
@stop

@section('content')

    <div class="row">

        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Program Rating</h3>
                </div>

                <div class="widget-body">
                    @foreach($questions as $question)
                        <div class="suggestion">
                            ({{round($question->average,2)}}) {{$question->question}}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">This program</h3>
                </div>

                <div class="widget-body">
                    @foreach($general_questions as $question)
                        <div class="suggestion">
                            ({{$question->registrations->count()}}) {{$question->question}}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Suggestions</h3>
                </div>

                <div class="widget-body">
                    @foreach($suggestions as $suggestion)
                        @if($suggestion->suggestion)
                            <div class="suggestion">
                                {{$suggestion->suggestion}}
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>


        </div>


        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Comments</h3>
                </div>

                <div class="widget-body">
                    @foreach($comments as $suggestion)
                        @if($suggestion->comment)
                            <div class="suggestion">
                                {{$suggestion->comment}}
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>


        </div>

        <div class="col-md-4">

        </div>




    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            var switchCertificates = $('#switchCertificates');
            var switchCertificatesStatus;
            var switchRegistration = $('#switchRegistration');
            var switchRegistrationStatus;

            switchCertificates.on('change', function() {
                if($(this).prop('checked') == false) {
                    switchCertificatesStatus = 0;
                } else {
                    switchCertificatesStatus = 1
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/settings",
                    cache: false,
                    data: {
                        key: 'certificates',
                        value: switchCertificatesStatus
                    }
                });
            });

            switchRegistration.on('change', function() {
                if($(this).prop('checked') == false) {
                    switchRegistrationStatus = 0;
                } else {
                    switchRegistrationStatus = 1
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/settings",
                    cache: false,
                    data: {
                        key: 'registration',
                        value: switchRegistrationStatus
                    }
                });
            });
        });
    </script>
@stop