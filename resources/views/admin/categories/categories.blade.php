@extends('admin.master')

@section('title', 'Categories')
@section('title2', 'Categories')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Categories</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Category List</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/categories/create')}}" class="btn btn-primary btn-lg">New Category</a>
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


            <table id="customer-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Courses</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr data-id="{{$category->id}}">
                            <td>
                                <a href="{{url('admin/categories/'.$category->id)}}" class="customer-name">{{$category->name_en}}</a>
                                @if($category->name_ar)
                                    <br>
                                    <span style="font-size: smaller;color: #bbb;">{{$category->name_ar}}</span>
                                @endif
                            </td>
                            <td>{{$category->courses->count()}}</td>
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
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/customer-list.js')}}"></script>


@stop