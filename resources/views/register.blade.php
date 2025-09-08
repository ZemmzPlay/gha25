@extends('master')

@section('title', 'Register' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))

@section('style')
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css?ver=1.0.1') }}" />
@endsection

@section('content')

  @if ((Settings::get('registration_enabled') && !Auth::guard('web')->check()) || Settings::get('certificates_enabled'))
    <div class="registerContainer" id="registerContainer">
      <div class="registerMiddle">

        @if (Settings::get('registration_enabled') && !Auth::guard('web')->check())
          <div class="registerTopTitle">
            <div class="registerTopTitleText">Registration</div>
            {{-- <div class="registerTopTitleLine"></div> --}}
          </div>
          <div class="registerBottomTitle">Personal & Contract Information</div>

          @if (count($errors) > 0)
            <div class="alert alert-danger"
              style="border-radius: 0;color: red;background: rgba(255,255,255,0.8);margin-bottom: 0;margin-top: 10px;border-width: 0;border-left: 5px solid red;">
              <strong>Error:</strong>
              @if (count($errors) == 1)
                <br>{{ $errors->first() }}
              @else
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
          @endif

          <form method="post" id="registerForm" action="{{ route('registrations.create') }}">
            {{ csrf_field() }}
            <div class="registerInputsContainer">
              <div class="registerOneInputContainer" id="titleInput">
                <div class="registerOneInputLabel">Title</div>
                <select name="title" class="registerOneInputValue" required>
                  <option value="">* Title</option>
                  <option value="Prof" {{ old('title') && old('title') == 'Prof' ? 'selected' : '' }}>Prof</option>
                  <option value="Dr" {{ old('title') && old('title') == 'Dr' ? 'selected' : '' }}>Dr</option>
                  <option value="Mr" {{ old('title') && old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                  <option value="Mrs" {{ old('title') && old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                  <option value="Miss" {{ old('title') && old('title') == 'Miss' ? 'selected' : '' }}>Miss</option>
                </select>
              </div>
              <div class="registerOneInputContainer" id="firstNameInput">
                <div class="registerOneInputLabel">First</div>
                <input type="text" name="first_name" class="registerOneInputValue" placeholder="Name"
                  value="{{ old('first_name') }}" required />
              </div>
              <div class="registerOneInputContainer" id="lastNameInput">
                <div class="registerOneInputLabel">Last</div>
                <input type="text" name="last_name" class="registerOneInputValue" placeholder="Name"
                  value="{{ old('last_name') }}" required />
              </div>
              <!-- <div class="registerOneInputContainer" id="emptySpaceInput"></div> -->
              <div class="registerOneInputContainer" id="specialityInput">
                <div class="registerOneInputLabel">Speciality</div>
                <input type="text" name="speciality" class="registerOneInputValue" placeholder="Speciality"
                  value="{{ old('speciality') }}" required />
              </div>
              <div class="registerOneInputContainer" id="countryInput">
                <div class="registerOneInputLabel">Country</div>
                <select name="country" class="registerOneInputValue select2-country" required>
                  <option value="">* Country</option>
                  @php
                    $countries = config('countries');
                  @endphp
                  @foreach ($countries as $countryCode => $countryData)
                    <option value="{{ $countryData['name'] }}"
                      {{ old('country') && old('country') == $countryData['name'] ? 'selected' : '' }}
                      data-flag="{{ strtolower($countryCode) }}">
                      {{ $countryData['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="registerOneInputContainer" id="cityInput">
                <div class="registerOneInputLabel">City</div>
                <input type="text" name="city" class="registerOneInputValue" placeholder="Kuwait"
                  value="{{ old('city') }}" required />
              </div>
              <div class="registerOneInputContainer" id="emailInput">
                <div class="registerOneInputLabel">Email</div>
                <input type="text" name="email" class="registerOneInputValue" placeholder="emailid@domain.com"
                  value="{{ old('email') }}" required />
              </div>
              <div class="registerOneInputContainer" id="numberInput">
                <div class="registerOneInputLabel">Number</div>
                <div class="twoInputsPhone">
                  <select name="countryCode" class="twoInputsPhoneSmall select2-phone" required>
                    @php
                      $countries = config('countries');
                    @endphp
                    @foreach ($countries as $countryCode => $countryData)
                      <option value="+{{ $countryData['code'] }}"
                        {{ (old('countryCode') && old('countryCode') == '+' . $countryData['code']) || (!old('countryCode') && $countryCode == 'KW') ? 'selected' : '' }}
                        data-flag="{{ strtolower($countryCode) }}">
                        +{{ $countryData['code'] }} ({{ $countryData['name'] }})
                      </option>
                    @endforeach
                  </select>
                  <input type="text" name="mobile" class="twoInputsPhoneNumber" placeholder="5000 9876"
                    value="{{ old('mobile') }}" required />
                </div>
              </div>
              <div class="registerOneInputContainer" id="emptySpaceInput"></div>
            </div>

            {{-- <div class="virtualAccessSection">
						<div class="registerOneInputContainer">
							<div class="virtualAccessContainer">
								<div class="virtualAccessFreeText"><b>Free</b> Virtual Access<br />for Palestine and Yemen <img src="{{ asset('images/home/pal.png') }}" width="30" alt="Palestine" /> <img src="{{ asset('images/home/yem.png') }}" width="30" alt="Yemen" /></div>
							</div>
						</div>
					</div> --}}


            {{-- <div class="virtualAccessSection">
						<div class="registerOneInputContainer" id="virtualAccessInput">
							<div class="virtualAccessContainer">
								<div data-element="virtualAccess" class="registerCheckbox {{(old('virtualAccess') && old('virtualAccess') == '1') ? 'registerCheckboxChecked' : ''}}"></div> <!-- registerCheckboxChecked -->
								<input type="hidden" name="virtualAccess" class="registerCheckboxReal" value="{{(old('virtualAccess')) ? old('virtualAccess') : '0'}}" />
								<div class="registerCheckboxText">Virtual Access Only<br /><span>By selecting Virtual Access Only, you will <b>exclusively</b> have online access to the meeting</span></div>
							</div>
						</div>
					</div> --}}<input type="hidden" name="virtualAccess" class="registerCheckboxReal"
              value="{{ old('virtualAccess') ? old('virtualAccess') : '0' }}" />


            <div class="workshopSection">
              {{-- <div class="workshopTitleSection">Workshop Registration</div> --}}
              <div class="registerOneInputContainer hidden" id="onlyWorkshopInput">
                <div class="onlyWorkshopContainer">
                  <div data-element="onlyWorkshop"
                    class="registerCheckbox {{ old('onlyWorkshop') && old('onlyWorkshop') == '1' ? 'registerCheckboxChecked' : '' }}">
                  </div> <!-- registerCheckboxChecked -->
                  <input type="hidden" name="onlyWorkshop" class="registerCheckboxReal"
                    value="{{ old('onlyWorkshop') ? old('onlyWorkshop') : '0' }}" />
                  <div class="registerCheckboxText">Attending a Workshop Only?</div>
                </div>
              </div>
              <div class="registerOneInputContainer" id="workshopInput">
                <div class="registerOneInputLabel">Workshop</div>
                <select name="workshops[]" id="workshop-multiselect" class="registerOneInputValue workshop-multiselect" multiple>
                  @foreach ($workshops as $workshop)
                    <option value="{{ $workshop->id }}" 
                            {{ is_array(old('workshops')) && in_array($workshop->id, old('workshops')) ? 'selected' : '' }}
                            {{ $workshop->places_left <= 0 ? 'disabled' : '' }}
                            data-places="{{ $workshop->places_left }}">
                      {{ $workshop->title }}{{ $workshop->places_left <= 0 ? ' (Full)' : '' }}
                    </option>
                  @endforeach
                </select>
                {{-- <select name="workshop_id" class="registerOneInputValue">
                  <option value="" data-price="0">Select Workshop</option>
                  @if (count($workshops))
                    @foreach ($workshops as $workshop)
                      <option value="{{ $workshop->id }}" data-price="{{ $workshop->price }}"
                        {{ old('workshop_id') && old('workshop_id') == $workshop->id ? 'selected' : '' }}>
                        {{ $workshop->title }}</option>
                    @endforeach
                  @endif
                </select> --}}
              </div>
            </div>

            <div class="registerButtonContainerOut">
              <div class="registerButtonContainer" id="registerSubmitButton">
                <div class="registerButtonLeft">Register</div>
                <input type="hidden" name="receive_updates" class="registerCheckboxReal"
                  value="{{ old('receive_updates') ? old('receive_updates') : '1' }}" />
                {{-- <div class="registerButtonRight"> --}}
                <?php
                // $normalPricePayClass = '';
                // $specialPriceFreeClass = 'hide';
                // if (old('countryCode') && (old('countryCode') == '+967' || old('countryCode') == '+970')) {
                //     $normalPricePayClass = 'hide';
                //     $specialPriceFreeClass = '';
                // }
                ?>
                {{-- <div class="registerButtonRightText {{ $normalPricePayClass }}" id="normalPricePay">KD <span
                      class="finalRegistrationPrice">{{ old('virtualAccess') && old('virtualAccess') == '1' ? '10' : 20 }}</span>
                  </div>
                  <div class="registerButtonRightText {{ $specialPriceFreeClass }}" id="specialPriceFree">Free</div>
                  <div class="registerButtonRightIcon"><i class="fa-solid fa-chevron-right"></i></div>
                </div> --}}
              </div>
              <div class="termsText">By registering you agree to the <a href="{{ url('/terms-and-conditions') }}"
                  target="_blank"><u>Terms & Conditions</u></a> of the 3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10
                2026 registration guidelines.</div>
            </div>
            {{-- <div class="registerCheckboxContainer">
						<div data-element="" class="registerCheckbox {{(old('receive_updates') && old('receive_updates') == '0') ? '' : 'registerCheckboxChecked'}}"></div> <!-- registerCheckboxChecked -->
						<input type="hidden" name="receive_updates" class="registerCheckboxReal" value="{{(old('receive_updates')) ? old('receive_updates') : '1'}}" />
						<div class="registerCheckboxText">I would like to receive meeting updates and news.</div>
					</div> --}}
          </form>
        @endif



        @if (Settings::get('certificates_enabled') && !Settings::get('registration_enabled'))

          <div class="registerTopTitle" id="CertificateTopTitle">
            <div class="registerTopTitleText">Certificate</div>
            <div class="registerTopTitleLine"></div>
          </div>

          <form method="post" id="certificateForm" action="{{ route('registration.verify') }}">
            {{ csrf_field() }}

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

            <div class="certificateTitleID">Please use your registration ID (in the confirmation email) to claim your
              certificate.</div>
            <input type="hidden" name="request_type" value="certificate">
            <div class="registerOneInputContainer" id="IDInput">
              <input type="text" name="id" class="registerOneInputValue" placeholder="* Your ID"
                value="{{ old('id') }}" required />
            </div>
            <input type="submit" class="certificateClaimButton" value="Claim" />
          </form>
        @endif

      </div>
    </div>
  @endif
@stop

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/index.js?ver=1.4') }}"></script>
  <script>
    $(document).ready(function() {
      var workshopDisable = {2: 5, 3: 6, 5: 2, 6: 3};
      
      // Initialize Select2 multiselect
      $('#workshop-multiselect').select2({
        placeholder: 'Select workshops...',
        allowClear: true,
        width: '100%',
        closeOnSelect: false
      });
      
      // Handle workshop conflicts
      $('#workshop-multiselect').on('select2:select', function (e) {
        var selectedId = e.params.data.id;
        handleWorkshopConflict(selectedId, true);
      });
      
      $('#workshop-multiselect').on('select2:unselect', function (e) {
        var unselectedId = e.params.data.id;
        handleWorkshopConflict(unselectedId, false);
      });
      
      function handleWorkshopConflict(workshopId, isSelected) {
        if(workshopDisable[workshopId]) {
          var conflictId = workshopDisable[workshopId];
          var $conflictOption = $('#workshop-multiselect option[value="' + conflictId + '"]');
          
          if (isSelected) {
            // If current workshop is selected, disable conflicting workshop
            $conflictOption.prop('disabled', true);
            // Remove conflicting workshop if it was selected
            $('#workshop-multiselect').val(function() {
              return $(this).val().filter(function(val) {
                return val != conflictId;
              });
            }).trigger('change');
          } else {
            // If current workshop is unselected, enable conflicting workshop
            $conflictOption.prop('disabled', false);
          }
        }
      }
      
      // Check initial state
      checkInitialWorkshops();
      
      function checkInitialWorkshops() {
        var selectedValues = $('#workshop-multiselect').val();
        if (selectedValues) {
          selectedValues.forEach(function(workshopId) {
            handleWorkshopConflict(workshopId, true);
          });
        }
      }
    });
  </script>
@stop
