@extends('admin.master')

@section('title', 'Case Submissions')
@section('title2', 'Case Submissions')

@section('style')
  {{-- <link rel="stylesheet" href="{{ asset('css/admin/members.css') }}" /> --}}
@stop

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li class="active">Case Submissions</li>
  </ol>
@stop


@section('content')

  <div class="widget no-border">

    <div class="widget-heading">
      <div class="row">
        <div class="col-md-6">
          <h3 class="widget-title" style="margin-top:8px;">Case Submission List</h3>
        </div>
        <div class="col-md-6 text-right">
        </div>
      </div>
    </div>


    <div class="widget-body">

      @if (Session::has('message'))
        <div class="alert alert-success col-md-12">
          {!! Session::get('message') !!}
        </div>
      @endif


      <table id="case-submission-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

        <thead>
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Country</th>
            <th class="hidden">Hospital Name</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($caseSubmissions as $caseSubmission)
            <tr data-id="{{ $caseSubmission->id }}">
              <td>{{ $caseSubmission->name }}</td>
              <td>{{ $caseSubmission->phone_number }}</td>
              <td>{{ $caseSubmission->email }}</td>
              <td>{{ $caseSubmission->countryName }}</td>
              <td class="hidden">{{ $caseSubmission->hospital_name }}</td>
              <td class="text-right">
                <a class="btn btn-sm btn-default"
                  href="{{ url('/admin/case-submission/' . $caseSubmission->id) }}">View</a>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>

    </div>

  </div>
@stop

@section('scripts')
  {{-- <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script> --}}
  <script>
    var e = $("#case-submission-list").dataTable({
      pageLength: 20,
      colReorder: !0,
      buttons: ["copy", "excel", "pdf", "print"],
      aLengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
      ],
      order: [
        [0, "asc"]
      ],
      // dom: '<"top"<"pull-left"f>>rt<"bottom"p><"clear">',
      dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      searching: true,
      columnDefs: [{
        orderable: !1,
        targets: [3]
      }]
    });
  </script>
@stop
