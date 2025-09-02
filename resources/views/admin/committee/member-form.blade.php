@extends('admin.master')

@section('style')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .img-container-list {
      background: #DDDDDC;
      -webkit-clip-path: circle(50%);
      clip-path: circle(50%);
      margin: 0 auto;
      padding: 1px;
      overflow: auto;
    }

    .img-container-list img {
      display: block;
      width: 100%;
      -webkit-clip-path: circle(50%);
      clip-path: circle(50%);
      height: auto;
    }
  </style>
@stop

@section('title')
  @if ($method == 'post')
    New Committee Member
  @else
    Edit Committee Member: {{ $member->name }}
  @endif
@stop

@section('title2')
  @if ($method == 'post')
    New Committee Member
  @else
    Edit Committee Member: {{ $member->name }}
  @endif
@stop

@section('breadcrumps')
  <ol class="breadcrumb mb-0">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li><a href="{{ url('admin/committee') }}">Committee Members</a></li>
    @if ($method == 'post')
      <li class="active">New Committee Member</li>
    @else
      <li>{{ $member->name }}</li>
    @endif
  </ol>
@stop

@section('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/flat.css') }}">
@stop

@section('content')
  <div class="widget" style="padding: 0 15px;">

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="widget-heading clearfix">
        <h3 class="widget-title pull-left">
          @if ($method == 'post')
            New Committee Member
          @else
            Edit Committee Member: {{ $member->name }}
          @endif
        </h3>
        <div class="pull-right">
          <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
          <a class="btn btn-default" href="{{ url('admin/committee') }}"><i class="ti-arrow-left"></i></a>
        </div>
      </div>

      <div class="widget-body">

        @if (count($errors) > 0)
          <div class="alert alert-danger col-md-12">
            @if (count($errors) == 1)
              {{ $errors->first() }}
            @else
              The following errors happened:
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        @endif

        @if (Session::has('message'))
          <div class="alert alert-success col-md-12">
            {!! Session::get('message') !!}
          </div>
        @endif


        <div class="form-group">
          <label for="first_name" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
            <input id="first_name" type="text" class="form-control" name="first_name" required
              value="{{ old('first_name') ? old('first_name') : $member->first_name }}">
          </div>
        </div>


        <div class="form-group">
          <label for="last_name" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input id="last_name" type="text" class="form-control" name="last_name" required
              value="{{ old('last_name') ? old('last_name') : $member->last_name }}">
          </div>
        </div>


        <div class="form-group">
          <label for="subtitle" class="col-sm-3 control-label">Subtitle</label>
          <div class="col-sm-9">
            <input id="subtitle" type="text" class="form-control" name="subtitle" required
              value="{{ old('subtitle') ? old('subtitle') : $member->subtitle }}">
          </div>
        </div>

        <div class="form-group">
          <label for="country" class="col-sm-3 control-label">Country</label>
          <div class="col-sm-9">
            <select id="country" name="country" class="form-control">
              @foreach ($countries as $code => $country)
                <option value="{{ $code }}"
                  {{ $code == $member->country ? 'selected' : '' }}>{{ $country['name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="category" class="col-sm-3 control-label">Category</label>
          <div class="col-sm-9">
            <select id="category" name="committee_category_id" class="form-control">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                  {{ $category->id == $member->committee_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="display_order" class="col-sm-3 control-label">Display Order</label>
          <div class="col-sm-9">
            <input id="display_order" type="text" class="form-control" name="display_order" required
              value="{{ $member->display_order }}">
          </div>
        </div>


        <div class="form-group">
          <label for="image" class="col-sm-3 control-label">Image</label>
          <label for="image" style="border:1px solid #ddd; display:inline-block; padding: 3px; margin-left: 15px;">

            <div class="img-container-list">
              @if($member->image && file_exists(public_path('images/committees/' . $member->image)))
                <img src="{{ asset('images/committees/' . $member->image) }}" id="CommitteeMemberImage" style="width: 200px;">
              @else
                <img src="{{ asset('images/committees/default_2.jpg') }}" id="CommitteeMemberImage" style="width: 200px;">
              @endif
            </div>
            <input type="file" name="image" id="image" style="display: none;">
          </label>
          <br />
          <p class="col-md-3 col-md-offset-3">
            Please be informed that any picture that you will upload will be resized to 387x446 pixels.
          </p>
        </div>




      </div>
    </form>
  </div>
@stop

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#CommitteeMemberImage').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#image").change(function() {
      readURL(this);
    });
    $(document).ready(function() {});
  </script>

@stop
