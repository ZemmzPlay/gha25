@extends('master')

@section('title', 'Registrants' .(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
<link rel="stylesheet" href="{{asset('css/registrants.css')}}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
@endsection

@section('content')
<div id="location" class="location home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
  <div class="container">
    <div class="row" style="margin-bottom: 5rem;">
      <div class="col-md-12">

        {{-- <h1 class="main-title" style="text-transform: none; margin-bottom: 15px;font-family: CircularBook, sans-serif; font-size: 50px; line-height: normal;">Location of the Meeting</h1> --}}

        <div class="main-container">

          <div class="section">
            <h2 class="second-title">Bulk Registration</h2>
            <p class="text-description"></p>
          </div>

          <form method="post" action="{{ route('pages.saveRegistrants') }}" enctype="multipart/form-data" id="registrantsForm">
            {{csrf_field()}}

            <div class="section">
              <a href="{{ url('bulk/download/template') }}" class="btn-template">Download Registration Sheet <i class="fa-regular fa-file-lines"></i></a>
            </div>

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
             {{--  <h2 class="second-title">1) Information</h2>
              <p class="text-description">The submitting author is either the main or one of the co-authors who will be presenting this submission at the educational activity. This author needs to be listed once again in the next section.</p> --}}
              <hr />

              <div class="row">

                <div class="col-md-12 row">
                  <div class="form-group col-md-4{{ $errors->has('fullName') ? ' has-error' : '' }}">
                    <label class="form-label" for="full_name">Full Name</label>
                    <input type="text" name="fullName" value="{{ old('fullName') }}" id="full_name" placeholder="Full Name" class="form-control" autofocus required>
                    
                    @if ($errors->has('fullName'))
                    <span class="help-block">
                      <strong>{{ $errors->first('fullName') }}</strong>
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

                  <div class="form-group col-md-4{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label class="form-label" for="phone">Mobile Number</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phoneCode') ? '+' . old('phoneCode') : '' }}{{ old('phone') }}" class="form-control" autofocus required  aria-describedby="phone-error" />
                    <span id="phone-error" class="error"></span>
                    <p id="output"></p>
                    <input type="hidden" name="phoneCode" id="phoneCode" />
                    
                    @if ($errors->has('phone'))
                    <span class="help-block">
                      <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

              </div>
            </div>
            {{-- Information --}}

            {{-- Upload --}}
            <div class="section">
              <h2 class="second-title">Upload File</h2>

                <div class="text-second form-group {{ $errors->has('registrantsFile') ? ' has-error' : '' }}">
                  <label class="form-label" for="registrantsFile">Upload File - (excel document)</label>
                  <div>
                    <label type="button" for="registrantsFile" class="btn btn-file">Choose File</label> <label class="file-name">Select File to Upload</label>
                  </div>
                  <input type="file" name="registrantsFile" id="registrantsFile" class="form-control required" style="display: none;" autofocus required aria-describedby="registrantsFileError" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">                  {{-- <span class="error" id="registrantsFile-error">This field is required</span> --}}
                  <div>Max. file size: 128 MB.</div>
                  <div class="text-sm">Please use the downloaded registration excel file above, and make sure to upload the correct file to avoid any delays.</div>

                  <span class="error" id="registrantsFileError">This field is required</span>

                  @if ($errors->has('registrantsFile'))
                  <span class="help-block">
                    <strong>{{ $errors->first('registrantsFile') }}</strong>
                  </span>
                  @endif
                </div>

              </div>
              {{-- Upload --}}
              <div class="submit">
                <button class="btn btn-template">Submit</button>
              </div>

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


