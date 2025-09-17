@extends('master')

@section('title', 'Register' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))

@section('style')
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css?ver=1.0.2') }}" />
@endsection

@section('content')
  <!-- Event Banner -->
  {{-- <div class="event-banner">
    <div class="event-banner-content">
      <img src="{{ asset('images/event-banner/3rd-GHA-SCAI-wordmark.svg') }}"
        alt="3rd GHA-SCAI SHOCK MIDDLE EAST KUWAIT - JAN 9-10, 2026" class="event-banner-logo">
    </div>
  </div> --}}

  @if ((Settings::get('registration_enabled') && !Auth::guard('web')->check()) || Settings::get('certificates_enabled'))
    <div class="registerContainer" id="registerContainer">
      <div class="registerMiddle">

        @if (Settings::get('registration_enabled') && !Auth::guard('web')->check())
          <h1 class="main-title">Registration</h1>

          <div class="register-options">
            <button class="register-option-button" data-registration="only_workshop">Workshop Registration Only</button>
            <button class="register-option-button" data-registration="only_conference">Meeting Registration Only</button>
            <button class="register-option-button" data-registration="conference_workshop">Meeting and Workshop
              Registration</button>
          </div>

          <div class="register-container" style="display: none;">
            <div class="close-register-container">
              <div class="register-close-button">
                <i class="fa fa-close"></i>
              </div>
            </div>
            <div class="registerBottomTitle">Personal & Contact Information</div>

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
                    {{-- <input type="hidden" name="onlyWorkshop" class="registerCheckboxReal"
                      value="{{ old('onlyWorkshop') ? old('onlyWorkshop') : '0' }}" /> --}}
                    <div class="registerCheckboxText">Attending a Workshop Only?</div>
                  </div>
                </div>
                <div class="registerOneInputContainer" id="workshopInput">
                  <input type="hidden" name="only_workshop" class="only-workshop-input" disabled value="1" />
                  <div class="registerOneInputLabel">Workshop</div>
                  <div class="multi-select-dropdown">
                    <div class="multi-select-input" id="workshopDropdown">
                      <span class="multi-select-placeholder" id="workshopPlaceholder">Select Workshops</span>
                      <span class="multi-select-count" id="workshopCount" style="display: none;">0 items
                        selected</span>
                      <i class="fas fa-chevron-down multi-select-arrow"></i>
                    </div>
                    <div class="multi-select-options" id="workshopOptions">
                      <div class="multi-select-category">Available Workshops</div>
                      @foreach ($workshops as $workshop)
                        <div class="multi-select-option {{ $workshop->places_left <= 0 ? 'disabled' : '' }}"
                          data-value="{{ $workshop->id }}" data-title="{{ $workshop->title }}">
                          <span class="option-text">{{ $workshop->title }}</span>
                          <div class="option-checkbox">
                            <input type="checkbox" name="workshops[]" value="{{ $workshop->id }}"
                              id="workshop-{{ $workshop->id }}" class="workshop-checkbox"
                              {{ is_array(old('workshops')) && in_array($workshop->id, old('workshops')) ? 'checked' : '' }}
                              {{ $workshop->places_left <= 0 ? 'disabled' : '' }} />
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="selected-workshops" id="selectedWorkshops">
                    <div class="selected-header">
                      <i class="fas fa-clock"></i>
                      <span>Selected Workshops</span>
                      <span class="selected-count" id="selectedCount">0</span>
                      <span class="clear-all" id="clearAllWorkshops">Clear All</span>
                    </div>
                    <div class="selected-items" id="selectedItems">
                      <!-- Selected items will be populated here -->
                    </div>
                  </div>
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
    </div>
  @endif
@stop

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/index.js?ver=1.4') }}"></script>
  <script>
    $(document).ready(function() {
      var workshopDisable = {
        2: 5,
        3: 6,
        5: 2,
        6: 3
      };
      var selectedWorkshops = [];

      // Initialize multi-select dropdown
      initMultiSelectDropdown();
      checkWorkshops();
      updateSelectedWorkshops();

      $(document).on('click', '.register-option-button', function() {
        $('.register-container').fadeIn();
        $('.register-options').hide();
        $('#registerContainer').addClass('bg-color');
        var registrationType = $(this).data('registration');

        $('.only-workshop-input').prop('disabled', true);
        $('#workshopInput').show();

        if (registrationType == 'only_workshop') {
          $('.only-workshop-input').prop('disabled', false);
        } else if (registrationType == 'only_conference') {
          $('#workshopInput').hide();
          console.log('hide');
        }
      });
      $(document).on('click', '.close-register-container', function() {
        $('.register-container').hide();
        $('.register-options').fadeIn();
        $('#registerContainer').removeClass('bg-color');
      });

      // Dropdown toggle functionality
      $('#workshopDropdown').on('click', function(e) {
        e.stopPropagation();
        toggleDropdown();
      });

      // Close dropdown when clicking outside
      $(document).on('click', function(e) {
        if (!$(e.target).closest('.multi-select-dropdown').length) {
          closeDropdown();
        }
      });

      // Option selection
      $(document).on('click', '.multi-select-option', function(e) {
        e.stopPropagation();
        if ($(this).hasClass('disabled')) return;

        var checkbox = $(this).find('.workshop-checkbox');
        var isChecked = checkbox.is(':checked');
        var id = checkbox.val();

        if (!isChecked) {
          checkbox.prop('checked', true);
          $(this).addClass('selected');

          // Handle workshop conflicts - disable conflicting workshops
          if (workshopDisable[id]) {
            $('#workshop-' + workshopDisable[id]).attr('disabled', true);
            $('#workshop-' + workshopDisable[id]).closest('.multi-select-option').addClass('disabled');
          }
        } else {
          checkbox.prop('checked', false);
          $(this).removeClass('selected');

          // Handle workshop conflicts - enable conflicting workshops
          if (workshopDisable[id]) {
            $('#workshop-' + workshopDisable[id]).attr('disabled', false);
            $('#workshop-' + workshopDisable[id]).closest('.multi-select-option').removeClass('disabled');
          }
        }

        handleWorkshopSelection(checkbox);
        updateSelectedWorkshops();
      });

      // Clear all functionality
      $('#clearAllWorkshops').on('click', function(e) {
        e.stopPropagation();
        clearAllWorkshops();
      });

      // Remove individual item
      $(document).on('click', '.remove-item', function(e) {
        e.stopPropagation();
        var workshopId = $(this).data('workshop-id');
        removeWorkshop(workshopId);
      });

      // Handle existing workshop checkbox changes
      $(document).on('change', '.workshop-checkbox', function() {
        var id = $(this).val();
        var optionElement = $(this).closest('.multi-select-option');

        if (workshopDisable[id]) {
          if ($(this).is(':checked') == false) {
            $('#workshop-' + workshopDisable[id]).attr('disabled', false);
            $('#workshop-' + workshopDisable[id]).closest('.multi-select-option').removeClass('disabled');
          } else {
            $('#workshop-' + workshopDisable[id]).attr('disabled', true);
            $('#workshop-' + workshopDisable[id]).closest('.multi-select-option').addClass('disabled');
          }
        }

        if ($(this).is(':checked')) {
          optionElement.addClass('selected');
        } else {
          optionElement.removeClass('selected');
        }

        handleWorkshopSelection($(this));
        updateSelectedWorkshops();
      });

      function initMultiSelectDropdown() {
        // Set initial state for pre-selected workshops
        $('.workshop-checkbox:checked').each(function() {
          $(this).closest('.multi-select-option').addClass('selected');
        });
      }

      function toggleDropdown() {
        var dropdown = $('#workshopOptions');
        var input = $('#workshopDropdown');

        if (dropdown.hasClass('show')) {
          closeDropdown();
        } else {
          openDropdown();
        }
      }

      function openDropdown() {
        $('#workshopOptions').addClass('show');
        $('#workshopDropdown').addClass('open');
      }

      function closeDropdown() {
        $('#workshopOptions').removeClass('show');
        $('#workshopDropdown').removeClass('open');
      }

      function handleWorkshopSelection(checkbox) {
        var workshopId = checkbox.val();
        var workshopTitle = checkbox.closest('.multi-select-option').data('title');
        var isChecked = checkbox.is(':checked');

        if (isChecked) {
          // Add to selected workshops
          var existingIndex = selectedWorkshops.findIndex(w => w.id === workshopId);
          if (existingIndex === -1) {
            selectedWorkshops.push({
              id: workshopId,
              title: workshopTitle
            });
          }
        } else {
          // Remove from selected workshops
          selectedWorkshops = selectedWorkshops.filter(w => w.id !== workshopId);
        }
      }

      function updateSelectedWorkshops() {
        var count = selectedWorkshops.length;
        var itemsContainer = $('#selectedItems');
        var countElement = $('#selectedCount');
        var placeholder = $('#workshopPlaceholder');
        var countDisplay = $('#workshopCount');

        // Update count display
        countElement.text(count);

        if (count > 0) {
          placeholder.hide();
          countDisplay.text(count + ' item' + (count > 1 ? 's' : '') + ' selected').show();
        } else {
          placeholder.show();
          countDisplay.hide();
        }

        // Update selected items display
        if (count === 0) {
          itemsContainer.html('<div class="empty">No workshops selected</div>');
        } else {
          var itemsHtml = '';

          selectedWorkshops.forEach(function(workshop) {
            itemsHtml += `
              <div class="selected-item">
                <div class="selected-item-info">
                  <div class="selected-item-title">${workshop.title}</div>
                </div>
                <div class="remove-item" data-workshop-id="${workshop.id}">×</div>
              </div>
            `;
          });

          itemsContainer.html(itemsHtml);
        }
      }

      function removeWorkshop(workshopId) {
        var checkbox = $('#workshop-' + workshopId);
        checkbox.prop('checked', false);
        checkbox.closest('.multi-select-option').removeClass('selected');

        handleWorkshopSelection(checkbox);
        updateSelectedWorkshops();
      }

      function clearAllWorkshops() {
        $('.workshop-checkbox').prop('checked', false);
        $('.multi-select-option').removeClass('selected');
        $('.multi-select-option').removeClass('disabled');
        $('.workshop-checkbox').attr('disabled', false);
        selectedWorkshops = [];
        updateSelectedWorkshops();
      }

      function checkWorkshops() {
        $('.workshop-checkbox').each(function() {
          var id = $(this).val();
          if (workshopDisable[id]) {
            if ($(this).is(':checked')) {
              $('#workshop-' + workshopDisable[id]).attr('disabled', true);
              $('#workshop-' + workshopDisable[id]).closest('.multi-select-option').addClass('disabled');
            }
          }
        });
      }
    });
  </script>
@stop
