@extends('admin.master')

@section('title', 'View Exhibitor')
@section('title2', 'View Exhibitor')

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li><a href="{{url('admin/exhibitors')}}">Exhibitors</a></li>
  <li class="active">View Exhibitor</li>
</ol>
@stop


@section('content')
<div class="widget" style="padding: 0 15px;">

  <input type="hidden" id="company-space" value="{{ route('exhibitors.company.space') }}">

  <div class="widget-heading clearfix">
    <h3 class="widget-title pull-left">
      Create Exhibitors
    </h3>
      <div class="pull-right">
        {{-- <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button> --}}
        <a class="btn btn-default" href="{{url('admin/exhibitors')}}"><i class="ti-arrow-left"></i></a>
      </div>
    </div>

    <div class="widget-body">

      {{-- First Name --}}
      <div class="row">
        <label class="col-sm-3"><strong>First Name</strong></label>
        <label class="col-sm-9">{{ $exhibitor->first_name }}</label>
      </div>
      {{-- First Name --}}
      <hr>
      {{-- Last Name --}}
      <div class="row">
        <label class="col-sm-3"><strong>Last Name</strong></label>
        <label class="col-sm-9">{{ $exhibitor->last_name }}</label>
      </div>
      {{-- Last Name --}}
      <hr>
      {{-- Email --}}
      <div class="row">
        <label class="col-sm-3"><strong>Email</strong></label>
        <label class="col-sm-9">{{ $exhibitor->email }}</label>
      </div>
      {{-- Email --}}
      <hr>
      {{-- Phone --}}
      <div class="row">
        <label class="col-sm-3"><strong>Phone</strong></label>
        <label class="col-sm-9">{{ $exhibitor->phone_code }}{{ $exhibitor->phone }}</label>
      </div>
      {{-- Phone --}}
      <hr>
      {{-- Company --}}
      <div class="row">
        <label class="col-sm-3"><strong>Company</strong></label>
        <label class="col-sm-9">{{ $exhibitor->company->title }}</label>
      </div>
      {{-- Company --}}
      <hr>
      {{-- Created By --}}
      <div class="row">
        <label class="col-sm-3"><strong>Created By</strong></label>
        <label class="col-sm-9">{{ $exhibitor->created_by }}</label>
      </div>
      {{-- Created By --}}
      <hr>
      {{-- Created At --}}
      <div class="row">
        <label class="col-sm-3"><strong>Created At</strong></label>
        <label class="col-sm-9">{{ $exhibitor->created_at->format('Y-m-d H:i') }}</label>
      </div>
      {{-- Created At --}}

    </div>
</div>
@stop


