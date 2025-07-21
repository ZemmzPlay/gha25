@extends('admin.master')

@section('title', 'Classes')
@section('title2', 'Classes')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Classes</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Class List</h3>
                </div>
                <div class="col-md-6 text-right">

                </div>
            </div>
        </div>


        <div class="widget-body">

            @if(Session::has('message'))
                <div class="alert alert-success col-md-12">
                    {!! Session::get('message') !!}
                </div>
            @endif


            <table id="session-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Starts</th>
                        <th>Ends</th>
                        <th>Seats</th>
                        <th>Seats Available</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sessions as $session)
                        <tr data-id="{{$session->id}}">
                            <td>
                                <a href="#">{{$session->course->name_en}}</a>
                                @if($session->course->name_ar)
                                    <br>
                                    <span style="font-size: smaller;color: #bbb;">{{$session->course->name_ar}}</span>
                                @endif
                            </td>
                            <td>{{$session->start_date}}</td>
                            <td>{{$session->end_date}}</td>
                            <td>{{$session->seats}}</td>
                            <td>{{$session->seats_available}}</td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-danger delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@stop

@section('scripts')
    <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/class-list.js')}}"></script>


@stop