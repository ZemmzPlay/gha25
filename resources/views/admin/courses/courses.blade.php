@extends('admin.master')

@section('title', 'Courses')
@section('title2', 'Courses')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Courses</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Course List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/courses/create')}}" class="btn btn-primary btn-lg">New Course</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="widget-body">

            @if(Session::has('message'))
                <div class="alert alert-success col-md-12">
                    {!! Session::get('message') !!}
                </div>
            @endif


            <table id="course-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th>Classes</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($courses as $course)
                        <tr data-id="{{$course->id}}">
                            <td>
                                <a href="{{url('admin/courses/'.$course->id)}}" class="customer-name">{{$course->name_en}}</a>
                                @if($course->name_ar)
                                    <br>
                                    <span style="font-size: smaller;color: #bbb;">{{$course->name_ar}}</span>
                                @endif
                            </td>
                            <td>{{$course->category->name_en}}</td>
                            <td>{{ ($course->vendor) ? $course->vendor->name_en : "N/A"}}</td>
                            <td>{{$course->sessions->count()}}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-success add" href="{{url('/admin/courses/'.$course->id.'/create')}}">New class</a>
                                <a class="btn btn-sm btn-default" href="{{url('/admin/courses/'.$course->id.'/edit')}}">Edit</a>
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
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/course-list.js')}}"></script>


@stop