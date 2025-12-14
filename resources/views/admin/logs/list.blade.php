@extends('admin.master')

@section('title', 'Registrations')
@section('title2', 'Registrations')

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li class="active">Registrations</li>
  </ol>
@stop


@section('content')

  <div class="widget no-border">
    <div class="widget-heading">
      <div class="row">
        <div class="col-md-6">
          <h3 class="widget-title" style="margin-top:8px;">Logs List</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="widget-body">

    <table id="registration-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

      <thead>
        <tr>
          <th>User</th>
          <th>Action</th>
          <th>Method</th>
          <th>IP</th>
          <th>Agent</th>
          {{-- <th>Actions</th> --}}
        </tr>
      </thead>

      <tbody>
        @foreach ($logs as $log)
          <tr>
            <td>{{ $log->user }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->method }}</td>
            <td>{{ $log->ip_address }}</td>
            <td>{{ $log->agent }}</td>
            {{-- <td>
              <a href="{{ url('admin/logs/' . $log->id . '/edit') }}" class="btn btn-sm btn-info">Edit</a>
            </td> --}}
          </tr>
        @endforeach
      </tbody>

    </table>

    {{-- add link --}}
    <div class="row">
      <div class="col-md-12 text-center">
        {{ $logs->links() }}
      </div>
    </div>
  </div>

@stop
