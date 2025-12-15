@extends('admin.master')

@section('title', 'Logs Details')
@section('title2', 'Logs Details')

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li><a href="{{ url('admin/logs') }}">Logs</a></li>
    <li class="active">Logs Details</li>
  </ol>
@stop

@section('content')

  <div class="widget no-border">
    <div class="widget-heading">
      <div class="row">
        <div class="col-md-6">
          <h3 class="widget-title" style="margin-top:8px;">Logs Details</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="widget-body">
    {{-- Basic info --}}
    <div class="row">
      <div class="col-md-6">
        <p><strong>User:</strong> {{ $log->user }}</p>
        <p><strong>Action:</strong> {{ $log->action }}</p>
        <p><strong>Method:</strong> {{ $log->method }}</p>
        <p><strong>URL:</strong> <a href="{{ $log->url }}" target="_blank">{{ $log->url }}</a></p>
        <p><strong>IP Address:</strong> {{ $log->ip_address }}</p>
        <p><strong>Agent:</strong> {{ $log->agent }}</p>
        <p><strong>Status:</strong> {{ $log->status_code }}</p>
        <p><strong>Created:</strong> {{ $log->created_at }}</p>
      </div>
    </div>

    {{-- Request / Response data --}}
    @php
      $pretty = function($raw) {
          if (empty($raw)) return '';
          $decoded = json_decode($raw);
          return $decoded ? json_encode($decoded, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) : $raw;
      };
    @endphp

    <div class="row" style="margin-top:15px;">
      <div class="col-md-6">
        <h5>Request Data</h5>
        <pre style="background:#f8f9fa;padding:10px;border:1px solid #eee;white-space:pre-wrap;">{{ $pretty($log->request_data) }}</pre>
      </div>
      <div class="col-md-6">
        <h5>Response Data</h5>
        <pre style="background:#f8f9fa;padding:10px;border:1px solid #eee;white-space:pre-wrap;">{{ $pretty($log->response_data) }}</pre>
      </div>
      <div class="col-md-6">
        <h5>Request Header</h5>
        <pre style="background:#f8f9fa;padding:10px;border:1px solid #eee;white-space:pre-wrap;">{{ $pretty($log->request_headers) }}</pre>
      </div>
      <div class="col-md-6">
        <h5>Response Header</h5>
        <pre style="background:#f8f9fa;padding:10px;border:1px solid #eee;white-space:pre-wrap;">{{ $pretty($log->response_headers) }}</pre>
      </div>
    </div>

    <div style="margin-top:10px;">
      <p><strong>Raw User Agent:</strong> <small>{{ $log->user_agent }}</small></p>
    </div>

  </div>

@stop
