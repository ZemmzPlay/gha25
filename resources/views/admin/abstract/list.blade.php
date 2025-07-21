@extends('admin.master')

@section('title', 'Abstracts')
@section('title2', 'Abstracts')

@section('style')
{{-- <link rel="stylesheet" href="{{asset('css/admin/abstracts.css')}}" /> --}}
@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li class="active">Abstracts</li>
</ol>
@stop


@section('content')

<div class="widget no-border">

  <div class="widget-heading">
    <div class="row">
      <div class="col-md-6">
        <h3 class="widget-title" style="margin-top:8px;">Abstracts List</h3>
      </div>
    </div>
  </div>

  <div class="widget-body">

    @if(Session::has('message'))
    <div class="alert alert-success col-md-12">
      {!! Session::get('message') !!}
    </div>
    @endif


    <table id="abstract-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th class="text-right">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($abstracts as $abstract)
        <tr>
          <td>{{ $abstract->full_name }}</td>
          <td>{{ $abstract->email }}</td>
          <td class="text-right">
            <button class="btn btn-sm btn-default view-abstract" data-toggle="modal" data-target="#myModal" data-id="{{$abstract->id}}">View</button>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Absrtact View</h4>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@stop

@section('scripts')
<script src="{{asset('js/admin/abstract/list.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/member-list.js')}}"></script> --}}
@stop