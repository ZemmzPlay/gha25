@extends('master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css?ver=1.0.1') }}" />
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
            {{-- <a href="{{ $link }}" target="_blank">
              <button class="oneSlideButton {{ $slideshow->buttonTheme == 2 ? 'oneSlideButtonLight' : '' }}">Add to
                Calendar <i class="fa-solid fa-calendar-days"></i></button>
            </a> --}}
          @endif
          <img class="oneSlideImage" src="{{ asset('images/slideshow/' . $slideshow->image) }}" alt="Logo">
          <img class="oneSlideImageMobile" src="{{ asset('images/slideshow/' . $slideshow->image_mobile) }}"
            alt="Logo">
        </div>
      @endforeach
    </div>
  @endif



  <div class="ourMessageContainer">
    <div class="ourMessageMiddleContainer">
      <div class="ourMessageLeft">
        <div class="onePerson">
          <img class="ourMessageImage" src="{{ asset('images/home/chairman.png') }}" alt="Prof. Mohammad Zubaid" />
          <div class="ourMessageNamePos">
            <div class="ourMessageName">Prof. Mohammad Zubaid</div>
            <div class="ourMessagePos">Meeting Co-Chair</div>
          </div>
        </div>
        <div class="onePerson">
          <img class="ourMessageImage" src="{{ asset('images/home/doctor.png') }}" alt="Prof. Mohammad Zubaid" />
          <div class="ourMessageNamePos">
            <div class="ourMessageName">Dr. Babar Basir</div>
            <div class="ourMessagePos">Meeting Co-Chair</div>
          </div>
        </div>

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
        <div class="registration-container">
          <a href="{{ url('/register') }}">
            <button class="registration-button">Register Now</button>
          </a>
        </div>
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

  {{-- Who Should Attend & Endorsed By Section --}}
  <div class="attendees-endorsed-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="who-should-attend">
            <h2 class="section-title">Who should attend</h2>
            <ul class="attendee-list">
              <li>Interventional and General Cardiologist</li>
              <li>Intensivists</li>
              <li>Cardiac Surgeons</li>
              <li>Cardiac Anesthetists</li>
              <li>Fellows-In-Training</li>
              <li>CCU, ICU and Cath Lab Nurses</li>
              <li>Cath Lab Technicians</li>
            </ul>
            <div class="event-details">
              <div class="event-detail-item">
                <i class="fa fa-calendar"></i>
                <span class="event-label">When:</span>
                <span class="event-value">09th - 10th January, 2026</span>
              </div>
              <div class="event-detail-item">
                <i class="fa fa-map-marker-alt"></i>
                <span class="event-label">Where:</span>
                <span class="event-value">The Regency Hotel, 25 Al-Ta'awen St, Kuwait</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="endorsed-by">
            <h2 class="section-title">Endorsed by</h2>
            <div class="endorsed-logos-container">
              <div class="endorsed-logo">
                <img src="{{ asset('images/home/endo2.png') }}" alt="Kuwait Heart Foundation" />
              </div>
              <div class="endorsed-logo">
                <img src="{{ asset('images/home/endo3.png') }}" alt="Oman Heart Association" />
              </div>
              <div class="endorsed-logo">
                <img src="{{ asset('images/home/endo/GIS-Black.png') }}" alt="Gulf Intervention Society" />
              </div>
            </div>
          </div>
        </div>
      </div>
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
  <!-- <div class="sponsors-container">
    <h1 class="sponsors-text">endorsed by</h1>
    <div class="sponsors-image-container">
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo2.png') }}" alt="Endorsed 1" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo3.png') }}" alt="Endorsed 2" />
      </div>
      <div class="sponsors-image-div">
        <img class="sponsors-image" src="{{ asset('images/home/endo/GIS-Black.png') }}" alt="Endorsed 3" />
      </div>
    </div>
  </div> -->

  @include('all-sponsors')

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
