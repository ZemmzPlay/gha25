@extends('admin.master')

@section('title', 'Z Events Management System')
@section('title2', 'Z Events Management System')

@section('breadcrumps')
    <p class="text-muted mb-0">{{date("l, d F Y")}}</p>
@stop

@section('content')

    <div class="row">


        <div class="col-md-4">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Random Draw</h3>
                </div>

                <div class="widget-body">

                    <button class="btn btn-block btn-success btn-lg" id="pickBtn">Pick a random name</button>

                </div>

            </div>


        </div>


        <div class="col-md-8">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">The winner is..</h3>
                </div>
                <div class="widget-body">

                    <h4 id="winnerName">Click on the button to the left.</h4>

                </div>

            </div>


        </div>

    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            var pickBtn = $('#pickBtn');
            var winnerName = $('#winnerName');

            pickBtn.on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/draw",
                    cache: false,
                    success: function(data) {
                        let name = (data.first_name) ? data.first_name + " " + data.last_name : "No one has attended this event yet";
                        winnerName.text(name);
                    }
                });
            });


        });
    </script>
@stop