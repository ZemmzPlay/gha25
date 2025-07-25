@extends('master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css?ver=2.2') }}" />
@stop

@section('content')

  @if (count($slideshows))
    <div class="slideshowContainer owl-carousel owl-theme" id="owl-carousel">

      @foreach ($slideshows as $slideshow)
        <div class="oneSlide carousel-item">
          @if ($slideshow->active)
            <?php
            $date = str_replace('-', '', substr($slideshow->start_date, 0, 10)) . 'T' . str_replace(':', '', $slideshow->start_time);
            $link = 'https://www.google.com/calendar/render?action=TEMPLATE&text=' . $slideshow->title . '&details=' . $slideshow->details . '&location=' . $slideshow->location . '&dates=' . $date . '/' . $date;
            ?>
            <a href="{{ $link }}" target="_blank">
              <button class="oneSlideButton {{ $slideshow->buttonTheme == 2 ? 'oneSlideButtonLight' : '' }}">Add to
                Calendar <i class="fa-solid fa-calendar-days"></i></button>
            </a>
          @endif
          <img class="oneSlideImage" src="{{ asset('images/slideshow/' . $slideshow->image) }}" alt="Logo">
          <img class="oneSlideImageMobile" src="{{ asset('images/slideshow/' . $slideshow->image_mobile) }}"
            alt="Logo">
        </div>
      @endforeach
    </div>
  @endif



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
                <select name="country" class="registerOneInputValue" required>
                  <option value="">* Country</option>
                  <option value="Kuwait" {{ old('country') && old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait
                  </option>
                  <option value="Saudi Arabia"
                    {{ old('country') && old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                  <option value="Iran" {{ old('country') && old('country') == 'Iran' ? 'selected' : '' }}>Iran
                  </option>
                  <option value="Egypt" {{ old('country') && old('country') == 'Egypt' ? 'selected' : '' }}>Egypt
                  </option>
                  <option value="Qatar" {{ old('country') && old('country') == 'Qatar' ? 'selected' : '' }}>Qatar
                  </option>
                  <option value="United Arab Emirates"
                    {{ old('country') && old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab
                    Emirates</option>
                  <option value="Syria" {{ old('country') && old('country') == 'Syria' ? 'selected' : '' }}>Syria
                  </option>
                  <option value="Iraq" {{ old('country') && old('country') == 'Iraq' ? 'selected' : '' }}>Iraq
                  </option>
                  <option value="Jordan" {{ old('country') && old('country') == 'Jordan' ? 'selected' : '' }}>Jordan
                  </option>
                  <option value="Lebanon" {{ old('country') && old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon
                  </option>
                  <option value="Tunisia" {{ old('country') && old('country') == 'Tunisia' ? 'selected' : '' }}>Tunisia
                  </option>
                  <option value="Morocco" {{ old('country') && old('country') == 'Morocco' ? 'selected' : '' }}>Morocco
                  </option>
                  <option value="Yemen" {{ old('country') && old('country') == 'Yemen' ? 'selected' : '' }}>Yemen
                  </option>
                  <option value="Bahrain" {{ old('country') && old('country') == 'Bahrain' ? 'selected' : '' }}>Bahrain
                  </option>
                  <option value="Oman" {{ old('country') && old('country') == 'Oman' ? 'selected' : '' }}>Oman
                  </option>
                  <option value="Algeria" {{ old('country') && old('country') == 'Algeria' ? 'selected' : '' }}>Algeria
                  </option>
                  <option value="Libya" {{ old('country') && old('country') == 'Libya' ? 'selected' : '' }}>Libya
                  </option>
                  <option value="Palestine" {{ old('country') && old('country') == 'Palestine' ? 'selected' : '' }}>
                    Palestine</option>
                  <option value="Sudan" {{ old('country') && old('country') == 'Sudan' ? 'selected' : '' }}>Sudan
                  </option>
                  <option value="Djibouti" {{ old('country') && old('country') == 'Djibouti' ? 'selected' : '' }}>
                    Djibouti</option>
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
                  <select name="countryCode" class="twoInputsPhoneSmall" required>
                    <option value="+965" {{ old('countryCode') && old('countryCode') == '+965' ? 'selected' : '' }}>
                      +965 (Kuwait)</option>
                    <option value="+966" {{ old('countryCode') && old('countryCode') == '+966' ? 'selected' : '' }}>
                      +966 (Saudi Arabia)</option>
                    <option value="+98" {{ old('countryCode') && old('countryCode') == '+98' ? 'selected' : '' }}>
                      +98 (Iran)</option>
                    <option value="+20" {{ old('countryCode') && old('countryCode') == '+20' ? 'selected' : '' }}>
                      +20 (Egypt)</option>
                    <option value="+974" {{ old('countryCode') && old('countryCode') == '+974' ? 'selected' : '' }}>
                      +974 (Qatar)</option>
                    <option value="+971" {{ old('countryCode') && old('countryCode') == '+971' ? 'selected' : '' }}>
                      +971 (United Arab Emirates)</option>
                    <option value="+963" {{ old('countryCode') && old('countryCode') == '+963' ? 'selected' : '' }}>
                      +963 (Syria)</option>
                    <option value="+964" {{ old('countryCode') && old('countryCode') == '+964' ? 'selected' : '' }}>
                      +964 (Iraq)</option>
                    <option value="+962" {{ old('countryCode') && old('countryCode') == '+962' ? 'selected' : '' }}>
                      +962 (Jordan)</option>
                    <option value="+961" {{ old('countryCode') && old('countryCode') == '+961' ? 'selected' : '' }}>
                      +961 (Lebanon)</option>
                    <option value="+216" {{ old('countryCode') && old('countryCode') == '+216' ? 'selected' : '' }}>
                      +216 (Tunisia)</option>
                    <option value="+212" {{ old('countryCode') && old('countryCode') == '+212' ? 'selected' : '' }}>
                      +212 (Morocco)</option>
                    <option value="+967" {{ old('countryCode') && old('countryCode') == '+967' ? 'selected' : '' }}>
                      +967 (Yemen)</option>
                    <option value="+973" {{ old('countryCode') && old('countryCode') == '+973' ? 'selected' : '' }}>
                      +973 (Bahrain)</option>
                    <option value="+968" {{ old('countryCode') && old('countryCode') == '+968' ? 'selected' : '' }}>
                      +968 (Oman)</option>
                    <option value="+213" {{ old('countryCode') && old('countryCode') == '+213' ? 'selected' : '' }}>
                      +213 (Algeria)</option>
                    <option value="+218" {{ old('countryCode') && old('countryCode') == '+218' ? 'selected' : '' }}>
                      +218 (Libya)</option>
                    <option value="+970" {{ old('countryCode') && old('countryCode') == '+970' ? 'selected' : '' }}>
                      +970 (Palestine)</option>
                    <option value="+249" {{ old('countryCode') && old('countryCode') == '+249' ? 'selected' : '' }}>
                      +249 (Sudan)</option>
                    <option value="+253" {{ old('countryCode') && old('countryCode') == '+253' ? 'selected' : '' }}>
                      +253 (Djibouti)</option>
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
					</div> --}}


            <div class="workshopSection" style="display: none;">
              <div class="workshopTitleSection">Workshop Registration</div>
              <div class="registerOneInputContainer" id="onlyWorkshopInput">
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
                <select name="workshop_id" class="registerOneInputValue">
                  <option value="" data-price="0">Select Workshop</option>
                  <?php
                  $workshops = [];
                  ?>
                  @if (count($workshops))
                    @foreach ($workshops as $workshop)
                      <option value="{{ $workshop->id }}" data-price="{{ $workshop->price }}"
                        {{ old('workshop_id') && old('workshop_id') == $workshop->id ? 'selected' : '' }}>
                        {{ $workshop->title }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>

            <div class="registerButtonContainerOut">
              <div class="registerButtonContainer" id="registerSubmitButton">
                <div class="registerButtonLeft">Register & Proceed to Payment</div>
                <div class="registerButtonRight">
                  <?php
                  $normalPricePayClass = '';
                  $specialPriceFreeClass = 'hide';
                  if (old('countryCode') && (old('countryCode') == '+967' || old('countryCode') == '+970')) {
                      $normalPricePayClass = 'hide';
                      $specialPriceFreeClass = '';
                  }
                  ?>
                  <div class="registerButtonRightText {{ $normalPricePayClass }}" id="normalPricePay">KD <span
                      class="finalRegistrationPrice">{{ old('virtualAccess') && old('virtualAccess') == '1' ? '10' : 20 }}</span>
                  </div>
                  <div class="registerButtonRightText {{ $specialPriceFreeClass }}" id="specialPriceFree">Free</div>
                  <div class="registerButtonRightIcon"><i class="fa-solid fa-chevron-right"></i></div>
                </div>
              </div>
              <div class="termsText">By registering you agree to the <a href="{{ url('/terms-and-conditions') }}"
                  target="_blank"><u>Terms & Conditions</u></a> of the 15th GHA Meeting registration guidelines.</div>
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




  <div class="ourMessageContainer">
    <div class="ourMessageMiddleContainer">
      <div class="ourMessageLeft">
        <!-- <div class="onePerson"> -->
        <img class="ourMessageImage" src="{{ asset('images/home/chairman.png') }}" alt="Prof. Mohammad Zubaid" />
        <div class="ourMessageNamePos">
          <div class="ourMessageName">Prof. Mohammad Zubaid - Dr. Mohammad Al Jarallah</div>
          <div class="ourMessagePos">Meeting Co-Chairs</div>
        </div>
        <!-- </div> -->

        <!-- <div class="onePerson">
                   <img class="ourMessageImage" src="{{ asset('images/home/IMG1.png') }}" alt="Prof. Mohammad Zubaid" />
                   <div class="ourMessageNamePos">
                    <div class="ourMessageName">Prof. Mohammad Zubaid</div>
                    <div class="ourMessagePos">Meeting Co-Chair</div>
                   </div>
                  </div> -->

      </div>
      <div class="ourMessageRight">
        <div class="ourMessageTitle">{{ Settings::get('message_title') }}</div>
        <div class="ourMessageText">{!! nl2br(Settings::get('message')) !!}</div>
      </div>
    </div>
  </div>

  <div class="news-line">
    <div class="news-line-text">
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
      <span>3RD GHA - SCAI SHOCK MIDDLE EAST KUWAIT JAN 9-10 2026</span>
      <span> | </span>
    </div>
  </div>

  {{-- Organized --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">Organized by</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo1.png') }}" alt="Organized 1" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/SCAI.png') }}" alt="Organized 2" />
      </div>
    </div>
  </div>

  {{-- endorsement --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">endorsed by</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo2.png') }}" alt="Endorsed 2" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo3.png') }}" alt="Endorsed 3" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo/endo4.jpg') }}" alt="Endorsed 4" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo/endo5.jpg') }}" alt="Endorsed 5" />
      </div>
    </div>
  </div>

  {{-- Title sponsor --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">Title sponsor</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo1.png') }}" alt="Organized 1" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/SCAI.png') }}" alt="Organized 2" />
      </div>
    </div>
  </div>

  {{-- Gold sponsor --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">Gold sponsor</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo1.png') }}" alt="Organized 1" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/SCAI.png') }}" alt="Organized 2" />
      </div>
    </div>
  </div>

  {{-- silver sponsor --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">silver sponsor</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo1.png') }}" alt="Organized 1" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/SCAI.png') }}" alt="Organized 2" />
      </div>
    </div>
  </div>

  {{-- support sponsor --}}
  <div class="sponsors-container">
    <h1 class="sponsors-text">support sponsor</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo2.png') }}" alt="Endorsed 2" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo3.png') }}" alt="Endorsed 3" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo/endo4.jpg') }}" alt="Endorsed 4" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo/endo5.jpg') }}" alt="Endorsed 5" />
      </div>
    </div>
  </div>

  {{-- <div class="sponsorsContainer">
    <div class="sponsorsTitleHeader">
      <h1 class="sponsorsTitleText">Sponsors</h1>
      <div class="sponsorsTitleLine"></div>
    </div>
    <div class="allSponsors">
      <div class="oneSponsor">
        <div class="sponsor-title">Title Sponsor</div>
        <div class="titleSponsorImage">
          <img src="{{ asset('images/home/222.png') }}" alt="Med vision" />
        </div>
      </div>
      <div class="oneSponsor">
        <div class="sponsor-title">Gold Sponsor</div>
        <div class="goldSponsorImage">
          <img src="{{ asset('images/home/3.png') }}" alt="VIATRIS" />
        </div>
      </div>
      <div class="oneSponsor">
        <div class="sponsor-title">Silver Sponsor</div>
        <div class="silverSponsorContainerImage">
          <div class="silverSponsorImage">
            <img src="{{ asset('images/home/4.png') }}" alt="Pfizer" />
          </div>
          <div class="silverSponsorImage">
            <img src="{{ asset('images/home/6.png') }}" alt="Abbott" />
          </div>
          <div class="silverSponsorImage">
            <img src="{{ asset('images/home/7.png') }}" alt="saja" />
          </div>
        </div>
      </div>
      <div class="oneSponsor">

        <div class="industryParkSponsor">
          <div class="sponsor-title">Industry Park Sponsors</div>
          <div class="industryParkSponsorContainerImage">
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/atc.jpg') }}" alt="atc" />
            </div>
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/14.png') }}" alt="Beshara" />
            </div>
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/Najmat.jpg') }}" alt="Najmat" />
            </div>
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/bsbc.jpg') }}" alt="BSBC" />
            </div>
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/Central-Circle.jpg') }}" alt="Central Circle" />
            </div>
            <div class="industryParkSponsorImage">
              <img src="{{ asset('images/home/bilingual.jpg') }}" alt="Mezzan" />
            </div>
          </div>
        </div>

        <div class="publicSponsor">
          <div class="sponsor-title">Public Day Sponsor</div>
          <div class="publicSponsorImage">
            <img src="{{ asset('images/home/8.png') }}" alt="Merck" />
          </div>
        </div>

        <div class="supportSponsor">
          <div class="sponsor-title">Support Sponsor</div>
          <div class="supportSponsorContainerImage">
            <div class="supportSponsorImage">
              <img src="{{ asset('images/home/13.png') }}" alt="AstraZeneca" />
            </div>
            <div class="supportSponsorImage">
              <img src="{{ asset('images/home/Organon-Logo.svg') }}" alt="Organon" />
            </div>
            <div class="supportSponsorImage">
              <img src="{{ asset('images/home/Warba.jpg') }}" alt="Warba" />
            </div>
            <div class="supportSponsorImage">
              <img src="{{ asset('images/home/BIOTRONIK.jpg') }}" alt="BIOTRONIK" />
            </div>
            <div class="supportSponsorImage">
              <img src="{{ asset('images/home/ahc_logo.jpg') }}" alt="ahc" />
            </div>
          </div>
        </div>

      </div>
    </div>
  </div> --}}
@stop

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/index.js?ver=1.4') }}"></script>
@stop
