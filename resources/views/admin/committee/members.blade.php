@extends('admin.master')

@section('title', 'Committee Members')
@section('title2', 'Committee Members')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/admin/members.css') }}" />
@stop

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li class="active">Committee Members</li>
  </ol>
@stop


@section('content')

  <div class="widget no-border">

    <div class="widget-heading">
      <div class="row">
        <div class="col-md-6">
          <h3 class="widget-title" style="margin-top:8px;">Member List</h3>
        </div>
        <div class="col-md-6 text-right">
          <div class="btn-group">
            <a href="{{ url('admin/committee/create') }}" class="btn btn-primary btn-lg">New Committee Member</a>
          </div>
          <div class="btn-group">
            <a href="{{ url('admin/committee/categories') }}" class="btn btn-purple btn-lg">Committee Categories</a>
          </div>
        </div>
      </div>
    </div>


    <div class="widget-body">

      @if (Session::has('message'))
        <div class="alert alert-success col-md-12">
          {!! Session::get('message') !!}
        </div>
      @endif


      <table id="member-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

        <thead>
          <tr>
            <th style="width:180px;"></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Category</th>
            <th>Date Added</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($members as $member)
            <tr data-id="{{ $member->id }}">
              <td style="width:180px; vertical-align: middle">
                <div class="img-container-list">
                  <img class="member-image" src="{{ asset($member->image_file) }}">
                </div>
              </td>
              <td>{{ $member->name ? $member->name : $member->first_name }}</td>
              <td>{{ $member->last_name }}</td>
              <td>{{ $member->category->name }}</td>
              <td>{{ $member->created_at->format('Y-m-d') }}</td>
              <td class="text-right">
                <a class="btn btn-sm btn-default" href="{{ url('/admin/committee/' . $member->id . '/edit') }}">Edit</a>
                <button class="btn btn-sm btn-danger delete" data-model="Committee">Delete</button>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>

    </div>

  </div>
@stop

@section('scripts')
  <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('build/js/page-content/e-commerce/member-list.js') }}"></script>
@stop
