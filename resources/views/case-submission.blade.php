@extends('master')

@section('title', 'Case Submission' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/case-submission.css') }}" />
@endsection

@section('content')
  <div id="case-submission"
    class="case-submission home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">Case Submission</h1>

          <p class="description">
            Please fill out the form below to submit your case for consideration. Ensure all fields are completed
            accurately.
          </p>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form action="{{ route('pages.case-submission') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="name">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
              @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="email">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="phone_number">Your Phone Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" required>
              @if ($errors->has('phone_number'))
                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="hospital_name">Hospital Name</label>
              <input type="text" class="form-control" id="hospital_name" name="hospital_name" required>
              @if ($errors->has('hospital_name'))
                <span class="text-danger">{{ $errors->first('hospital_name') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="country">Country</label>
              <select class="form-control" id="country" name="country" required>
                @foreach ($countries as $code => $country)
                  <option value="{{ $code }}">{{ $country['name'] }}</option>
                @endforeach
              </select>
              @if ($errors->has('country'))
                <span class="text-danger">{{ $errors->first('country') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="synopsis_case">Synopsis Case</label>
              <textarea class="form-control" id="synopsis_case" name="synopsis_case" rows="5" required></textarea>
              @if ($errors->has('synopsis_case'))
                <span class="text-danger">{{ $errors->first('synopsis_case') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="document">Upload Supporting Documents</label>
              <div class="file-upload-container">
                <span id="file-name" class="file-name-display">No file chosen</span>
                <label for="document" class="choose-file-btn">Choose File</label>
                <input type="file" class="form-control-file hidden" id="document" name="document" accept=".pdf,.doc,.docx">
              </div>
              @if ($errors->has('document'))
                <span class="text-danger">{{ $errors->first('document') }}</span>
              @endif
            </div>

            <button type="submit" class="submit-btn">Submit Case</button>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('document').addEventListener('change', function(e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
      document.getElementById('file-name').textContent = fileName;
    });
  </script>
@stop
