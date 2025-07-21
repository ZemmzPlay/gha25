@extends('master')

@section('title', 'Exhibitors' .(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
<link rel="stylesheet" href="{{asset('css/registrants.css')}}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
@endsection

@section('content')
<div id="location" class="location home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
  <div class="container">
    <div class="row" style="margin-bottom: 5rem;">
      <div class="col-md-12">

        <div class="main-container">

          <div class="section">
            <h2 class="second-title">Sponsor/Exhibitor Registration</h2>
            <p class="text-description"></p>
          </div>

          <form method="post" action="{{ route('pages.saveExhibitors') }}">
              {{csrf_field()}}

              @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
              @endif
              
              @if(count($errors) > 0)
              <div class="alert alert-danger col-md-12">
                @if(count($errors) == 1)
                {{$errors->first()}}
                @else
                The following errors happened:
                <ul>
                  @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>
                @endif
              </div>
              @endif

              {{-- Information --}}
              <div class="section">
                <hr />

                <div class="row">

                  <div class="col-md-12 row">
                    <div class="form-group col-md-4{{ $errors->has('firstName') ? ' has-error' : '' }}">
                      <label class="form-label" for="firstName">First Name</label>
                      <input type="text" name="firstName" value="{{ old('firstName') }}" id="firstName" placeholder="First Name" class="form-control" autofocus required>
                      
                      @if ($errors->has('firstName'))
                      <span class="help-block">
                        <strong>{{ $errors->first('firstName') }}</strong>
                      </span>
                      @endif
                    </div>

                    <div class="form-group col-md-4{{ $errors->has('lastName') ? ' has-error' : '' }}">
                      <label class="form-label" for="lastName">Last Name</label>
                      <input type="text" name="lastName" value="{{ old('lastName') }}" id="lastName" placeholder="Last Name" class="form-control" autofocus required>
                      
                      @if ($errors->has('lastName'))
                      <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                      </span>
                      @endif
                    </div>

                    <div class="form-group col-md-4{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="email@email.com" class="form-control" autofocus required>
                      
                      @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-12 row">
                    <div class="form-group col-md-4{{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label class="form-label" for="phone">Mobile Number</label>
                      <input type="tel" name="phone" id="phone" value="{{ old('phoneCode') ? '+' . old('phoneCode') : '' }}{{ old('phone') }}" class="form-control" autofocus required  aria-describedby="phone-error" />
                      <span id="phone-error" class="error"></span>
                      <p id="output"></p>
                      <input type="hidden" name="phoneCode" id="phoneCode" value="{{ old('phoneCode') }}" />
                      
                      @if ($errors->has('phone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                      @endif
                    </div>

                    <div class="form-group col-md-4{{ $errors->has('company') ? ' has-error' : '' }}">
                      <label class="form-label" for="company">Company<span class="text-danger">*</span></label>
                      <select class="form-control" name="company" id="company" required>
                        <option value="">Select A Company</option>
                        @foreach($companies as $company)
                          <option value="{{$company['id']}}" {{(old('company') == $company['id']) ? 'selected' : ''}}>{{$company['title']}}</option>
                        @endforeach
                      </select>

                      @if ($errors->has('company'))
                      <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                      </span>
                      @endif
                    </div>

                  </div>

                </div>
              </div>


              {{-- Information --}}
              <div class="submit">
                <button class="btn btn-template">Submit</button>
              </div>

          </form>
        </div>
      </div>
      <!-- end section title -->
    </div>


  </div>
</div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/registrants.js')}}"></script>
@endsection
@stop


