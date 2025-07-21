@extends('admin.master')

@section('title', 'Exhibitors')
@section('title2', 'Exhibitors')

@section('style')
{{-- <link rel="stylesheet" href="{{asset('css/admin/members.css')}}" /> --}}
@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li class="active">Exhibitors</li>
</ol>
@stop


@section('content')

<div class="widget no-border">

  <input type="hidden" id="exhibitors-url" value="{{ route('exhibitors.list') }}">
  <input type="hidden" id="exhibitors-print-url" value="{{ url('admin/exhibitors/print/') }}">
  <input type="hidden" id="exhibitors-view-url" value="{{ url('admin/exhibitors/view/') }}">

  <div class="widget-heading">
    <div class="row">
      <div class="col-md-6">
        <h3 class="widget-title" style="margin-top:8px;">Exhibitors List</h3>
      </div>
      <div class="col-md-6 text-right">
        <div class="btn-group">
          <a href="{{url('admin/exhibitors/create')}}" class="btn btn-primary btn-lg">New Exhibitor</a>
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


    <table id="exhibitors-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

    </table>

  </div>

</div>
@stop

@section('scripts')
<script src="{{asset('js/admin/exhibitors/list.js?ver=1.1')}}"></script>
@stop