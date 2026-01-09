@extends('admin.master')

@section('title', 'Create Exhibitors')
@section('title2', 'Create Exhibitors')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
<style type="text/css">
  .iti { width: 100%; }
</style>
@endsection

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li><a href="{{url('admin/exhibitors')}}">Exhibitors</a></li>
  <li class="active">Create Exhibitors</li>
</ol>
@stop


@section('content')
<div class="widget" style="padding: 0 15px;">

  <input type="hidden" id="company-space" value="{{ route('exhibitors.company.space') }}">

  <form class="form-horizontal" action="{{ route('exhibitors.create') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="widget-heading clearfix">
      <h3 class="widget-title pull-left">
        Create Exhibitors
      </h3>
      <div class="pull-right">
        <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
        <a class="btn btn-default" href="{{url('admin/exhibitors')}}"><i class="ti-arrow-left"></i></a>
      </div>
    </div>

    <div class="widget-body">

      @if ($errors->has('space'))
      <div class="alert alert-danger col-md-12">
        {{ $errors->first('space') }}
      </div>
      @endif

      @if(Session::has('message'))
      <div class="alert alert-success col-md-12">
        {!! Session::get('message') !!}
      </div>
      @endif

      {{-- First Name --}}
      <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
        <label for="firstName" class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-9">
          <input id="firstName" type="text" class="form-control" name="firstName" required autofocus value="{{ old('firstName') }}">

          @if ($errors->has('firstName'))
          <span class="help-block">
            <strong>{{ $errors->first('firstName') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- First Name --}}

      {{-- Last Name --}}
      <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
        <label for="lastName" class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-9">
          <input id="lastName" type="text" class="form-control" name="lastName" required autofocus value="{{ old('lastName') }}">

          @if ($errors->has('lastName'))
          <span class="help-block">
            <strong>{{ $errors->first('lastName') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Last Name --}}


      {{-- Email --}}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
          <input id="email" type="email" class="form-control" name="email" autofocus value="{{ old('email') }}">

          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Email --}}

      {{-- Phone --}}
      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-9">
          <input id="phone" type="tel" class="form-control" name="phone" autofocus value="{{ old('phone') }}">
          <span id="phone-error" class="error"></span>
          <p id="output"></p>
          <input type="hidden" name="phoneCode" id="phoneCode" value="{{ old('phoneCode') }}" />

          @if ($errors->has('phone'))
          <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Phone --}}

      {{-- Company --}}
      <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
        <label for="company" class="col-sm-3 control-label">Company</label>
        <div class="col-sm-9">
          <select class="form-control" name="company" id="company" required>
            <option value="">Select A Company</option>
            @foreach($companies as $company)
            <option value="{{$company['id']}}" {{(old('company') == $company['id']) ? 'selected' : ''}}>{{$company['title']}}</option>
            @endforeach
          </select>

          <span id="company-places">Places Left: <span>0</span></span>

          @if ($errors->has('company'))
          <span class="help-block">
            <strong>{{ $errors->first('company') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Company --}}

    </div>
  </form>
</div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/registrants.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '#company', function(event) {
      event.preventDefault();
      /* Act on the event */
      url = $('#company-space').val();
      $.ajax({
        url: url,
        type: 'POST',
        data: {_token: $('meta[name="_token"]').attr('content'), id: $(this).val()},
      })
      .done(function(data) {
        $("#company-places span").html(data);
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    });
  });
</script>
@endsection
@stop


