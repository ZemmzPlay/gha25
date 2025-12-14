@extends('admin.master')

@section('title', 'Logs')
@section('title2', 'Logs')

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li class="active">Logs</li>
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

    {{-- Filters --}}
    <form method="GET" class="form-inline" style="margin-bottom:15px;">
      <div class="form-group mr-2">
        <label for="created_from" class="sr-only">From</label>
        <input type="datetime-local" id="created_from" name="created_from" class="form-control"
               value="{{ request('created_from') }}">
      </div>

      <div class="form-group mr-2">
        <label for="created_to" class="sr-only">To</label>
        <input type="datetime-local" id="created_to" name="created_to" class="form-control"
               value="{{ request('created_to') }}">
      </div>

      <div class="form-group mr-2">
        <input type="text" name="response_keyword" class="form-control" placeholder="Keyword in response_data"
               value="{{ request('response_keyword') }}">
      </div>

      <button type="submit" class="btn btn-primary btn-sm mr-2">Filter</button>
      <a href="{{ url('admin/logs') }}" class="btn btn-default btn-sm mr-2">Reset</a>

      @php
        $qs = request()->getQueryString();
        $exportUrlCsv = url('admin/logs/export') . ($qs ? '?'.$qs : '');
        $exportUrlXlsx = url('admin/logs/export-xlsx') . ($qs ? '?'.$qs : '');
      @endphp
      <a href="{{ $exportUrlCsv }}" class="btn btn-success btn-sm" title="Export request_data as CSV">Export CSV</a>
      <a href="{{ $exportUrlXlsx }}" class="btn btn-primary btn-sm" title="Export request_data as Excel">Export XLSX</a>
    </form>

    {{-- Counts: filtered total + selected --}}
    <div class="mb-2">
      <strong>Filtered:</strong> {{ $logs->total() }} &nbsp;|&nbsp;
      <strong>Selected:</strong> <span id="selected-count">0</span>
    </div>

    <table id="registration-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

      <thead>
        <tr>
          <th style="width:30px;"><input type="checkbox" id="select-all" title="Select all on this page"></th>
          <th>User</th>
          <th>Action</th>
          <th>Method</th>
          <th>IP</th>
          <th>Agent</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($logs as $log)
          <tr>
            <td><input type="checkbox" class="log-checkbox" data-id="{{ $log->id }}"></td>
            <td>{{ $log->user }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->method }}</td>
            <td>{{ $log->ip_address }}</td>
            <td>{{ $log->agent }}</td>
            <td>
              <a href="{{ url('admin/logs/' . $log->id) }}" class="btn btn-sm btn-info">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>

    {{-- pagination --}}
    <div class="row">
      <div class="col-md-12 text-center">
        {{ $logs->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </div>

  {{-- JS to maintain selected count and select-all on current page --}}
  <script>
    (function() {
      function updateSelectedCount() {
        var checked = document.querySelectorAll('.log-checkbox:checked').length;
        var el = document.getElementById('selected-count');
        if (el) el.textContent = checked;
      }

      document.addEventListener('DOMContentLoaded', function() {
        var selectAll = document.getElementById('select-all');
        if (selectAll) {
          selectAll.addEventListener('change', function() {
            var checked = !!this.checked;
            document.querySelectorAll('.log-checkbox').forEach(function(cb) {
              cb.checked = checked;
            });
            updateSelectedCount();
          });
        }

        document.querySelectorAll('.log-checkbox').forEach(function(cb) {
          cb.addEventListener('change', updateSelectedCount);
        });

        // initialize count on page load
        updateSelectedCount();
      });
    })();
  </script>

@stop
