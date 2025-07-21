@extends('master')

@section('title', 'Abstract' .(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
<link rel="stylesheet" href="{{asset('css/abstract.css')}}" />
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
            <h2 class="second-title">Abstract Submission Form</h2>
            <p class="text-description">By completing the form below, you will be successfully submitting your Abstract ePoster. Selected abstracts will be displayed during the period of the meeting from December 14 - 16, 2023. In addition to the public display for the meeting attendees, the selected posters will be also be displayed on the website.
              <br/>
              <br/>
            Additionally, all selected abstracts will be presented to a jury for the selection of the the winning submissions, as well as, public voting on the website for a Peoples Choice Award.</p>
          </div>

          <form method="post" action="{{ route('pages.saveAbstract') }}" enctype="multipart/form-data" id="abstractForm">
            {{csrf_field()}}

            <div class="section">
              <a href="{{ url('abstracts/download/template') }}" class="btn-template">Download Poster Template <i class="fa-regular fa-file-lines"></i></a>
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

            {{-- Author's Information --}}
            <div class="section">
              <h2 class="second-title">1) Author's Information</h2>
              <p class="text-description">The submitting author is either the main or one of the co-authors who will be presenting this submission at the educational activity. This author needs to be listed once again in the next section.</p>
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

                <div class="col-md-12 row">
                  <div class="form-group col-md-4{{ $errors->has('authorInstitution') ? ' has-error' : '' }}">
                    <label class="form-label" for="authorInstitution">Author Institution</label>
                    <input type="text" name="authorInstitution" value="{{ old('authorInstitution') }}" id="authorInstitution" class="form-control" autofocus required>

                    @if ($errors->has('authorInstitution'))
                    <span class="help-block">
                      <strong>{{ $errors->first('authorInstitution') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label class="form-label" for="city">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" id="city" class="form-control" autofocus required>

                    @if ($errors->has('city'))
                    <span class="help-block">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4{{ $errors->has('countryResidence') ? ' has-error' : '' }}">
                    <label class="form-label" for="countryResidence">Country of Residence<span class="text-danger">*</span></label>
                    {{-- <input type="text" name="countryResidence" id="countryResidence" class="form-control" autofocus> --}}
                    <select class="form-control" name="countryResidence" id="countryResidence">
                      <option value="">Select A Country</option>
                      @foreach($countries as $key => $country)
                      <option value="{{ $key }}">{{ $country['name'] }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('countryResidence'))
                    <span class="help-block">
                      <strong>{{ $errors->first('countryResidence') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

              </div>
            </div>
            {{-- Author's Information --}}

            {{-- Abstract --}}
            <div class="section">
              <h2 class="second-title">2) Abstract</h2>
              <p class="text-description">The abstract minimum word count should be 200 and must not exceed 500 words. No bullet points will be accepted. Please do not copy paste text directly from a PDF due to formatting purposes. Please do not place your section headers, e.g. “Introduction” in the sectional fields below</p>
              <hr />

              <div class="row">

                <div class="col-md-12 row">
                  <div class="form-group col-md-6{{ $errors->has('abstractTitle') ? ' has-error' : '' }}">
                    <label class="form-label" for="abstractTitle">Abstract Title</label>
                    <input type="text" name="abstractTitle" value="{{ old('abstractTitle') }}" id="abstractTitle" class="form-control" autofocus required>

                    @if ($errors->has('abstractTitle'))
                    <span class="help-block">
                      <strong>{{ $errors->first('abstractTitle') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-6{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label class="form-label" for="category">Choose Category</label>
                    <select name="category" id="category" class="form-control">
                      <option value="Arrythmias and Clinical EP">Arrythmias and Clinical EP</option>
                      <option value="Heart Failure">Heart Failure</option>
                      <option value="CAD &amp; Interventional Cardiology">CAD &amp; Interventional Cardiology</option>
                      <option value="Imaging &amp; Valvular Diseases">Imaging &amp; Valvular Diseases</option>
                      <option value="Prevention">Prevention</option>
                      <option value="Acute Cardiac Care">Acute Cardiac Care</option>
                      <option value="Congenital Heart Disease">Congenital Heart Disease</option>
                    </select>

                    @if ($errors->has('category'))
                    <span class="help-block">
                      <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                {{-- <div class="form-group col-md-6{{ $errors->has('statement') ? ' has-error' : '' }}">
                  <label class="form-label" for="statement">Purpose Statement</label>
                  <select name="statement" id="statement" class="form-control">
                    <option value="Background">Background</option>
                    <option value="Introduction">Introduction</option>
                    <option value="Objective(s)">Objective(s)</option>
                  </select>

                  <label class="text-sm text-second">Please select purpose statement in the dropdown above</label>
                  @if ($errors->has('statement'))
                  <span class="help-block">
                    <strong>{{ $errors->first('statement') }}</strong>
                  </span>
                  @endif
                </div> --}}


              </div>

              <div class="">

                <div class="form-group {{ $errors->has('purposeStatement') ? ' has-error' : '' }}">
                  <label class="form-label" for="purposeStatement">Background & Objectives:</label>
                  <textarea name="purposeStatement" id="purposeStatement" class="form-control" required>{{ old('purposeStatement') }}</textarea>

                  @if ($errors->has('purposeStatement'))
                  <span class="help-block">
                    <strong>{{ $errors->first('purposeStatement') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('methods') ? ' has-error' : '' }}">
                  <label class="form-label" for="methods">Methods:</label>
                  <textarea name="methods" id="methods" class="form-control" required>{{ old('methods') }}</textarea>

                  @if ($errors->has('methods'))
                  <span class="help-block">
                    <strong>{{ $errors->first('methods') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('results') ? ' has-error' : '' }}">
                  <label class="form-label" for="results">Result(s):</label>
                  <textarea name="results" id="results" class="form-control" required>{{ old('results') }}</textarea>

                  @if ($errors->has('results'))
                  <span class="help-block">
                    <strong>{{ $errors->first('results') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('conclusions') ? ' has-error' : '' }}">
                  <label class="form-label" for="conclusions">Conclusion(s):</label>
                  <textarea name="conclusions" id="conclusions" class="form-control" required>{{ old('conclusions') }}</textarea>

                  @if ($errors->has('conclusions'))
                  <span class="help-block">
                    <strong>{{ $errors->first('conclusions') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="text-second form-group {{ $errors->has('abstractFile') ? ' has-error' : '' }}">
                  <label class="form-label" for="abstractFile">Upload Abstract File</label>
                  <div>
                    <label type="button" for="abstractFile" class="btn btn-file">Choose File</label> <label class="file-name">Select File to Upload</label>
                  </div>
                  <input type="file" name="abstractFile" id="abstractFile" class="form-control required" style="display: none;" autofocus required aria-describedby="abstractFileError">                  {{-- <span class="error" id="abstractFile-error">This field is required</span> --}}
                  <div>Max. file size: 128 MB.</div>
                  <div class="text-sm">Download the template from above, and upload your complete scientific abstract that might include your research tables, charts, and images.</div>

                  <span class="error" id="abstractFileError">This field is required</span>

                  @if ($errors->has('abstractFile'))
                  <span class="help-block">
                    <strong>{{ $errors->first('abstractFile') }}</strong>
                  </span>
                  @endif
                </div>

              </div>

            </div>
            {{-- Abstract --}}

            {{-- Disclosure --}}
            <div class="section">
              <h2 class="second-title">3) Disclosure</h2>
              <hr />

              <div class="question-1 questions">
                <label class="text-third">The submitted abstract has been viewed by all authors and they agree to its content and to its presentation at the educational activity.</label>
                <div>
                  <div class="text-second"><input type="radio" value="yes" @if(old("question1") == "yes") checked @endif name="question1" required aria-describedby="question1-error"> <label>Yes</label></div>
                  <div class="text-second"><input type="radio" value="no" @if(old("question1") == "no") checked @endif name="question1" required aria-describedby="question1-error"> <label>No</label></div>
                </div>
                <span id="question1-error" class="error"></span>
              </div>

              <div class="question-2 questions">
                <label class="text-third">This submission is in accordance with Research and Ethical guidelines in respective countries and has appropriate institutional ethics approval.</label>
                <div>
                  <div class="text-second"><input type="radio" value="yes" @if(old("question2") == "yes") checked @endif name="question2" required aria-describedby="question2-error"> <label>Yes</label></div>
                  <div class="text-second"><input type="radio" value="no" @if(old("question2") == "no") checked @endif name="question2" required aria-describedby="question2-error"> <label>No</label></div>
                </div>
                <span id="question2-error" class="error"></span>
              </div>

              <div class="question-3 questions">
                <label class="text-third">Any conflict of interests interfering with this submitted work will be stated during the presentation.</label>
                <div>
                  <div class="text-second"><input type="radio" value="yes" @if(old("question3") == "yes") checked @endif name="question3" required aria-describedby="question3-error"> <label>Yes</label></div>
                  <div class="text-second"><input type="radio" value="no" @if(old("question3") == "no") checked @endif name="question3" required aria-describedby="question3-error"> <label>No</label></div>
                </div>
                <span id="question3-error" class="error"></span>
              </div>


              <div class="question-4 questions">
                <label class="text-third">The contents of our presentations are ours alone. The educational activity neither endorses nor disclaims the conclusions, interpretations or opinions expressed by the authors and co-authors of this abstract.</label>
                <div>
                  <div class="text-second"><input type="radio" value="yes" @if(old("question4") == "yes") checked @endif name="question4" required aria-describedby="question4-error"> <label>Yes</label></div>
                  <div class="text-second"><input type="radio" value="no" @if(old("question4") == "no") checked @endif name="question4" required aria-describedby="question4-error"> <label>No</label></div>
                </div>
                <span id="question4-error" class="error"></span>
              </div>

              <p class="text-second">
                The presenting authors will receive an acceptance or rejection email within 10-14 days. Acceptance letters will come from abstracts@zawaya.me kindly mark this email as a safe sender.
                <br>
                <br>
                Once accepted, authors must confirm receipt within 5 days. For any deadline extensions, announcements will be made on the meeting’s website or by email for all submissions made. Visit the dedicated meeting’s website for further details.
              </p>

            </div>
            {{-- Disclosure --}}

            <div class="submit">
              <button class="btn btn-success">Submit</button>
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
<script type="text/javascript" src="{{asset('js/abstract.js')}}"></script>
@endsection
@stop


