@extends('master')

@section('title', 'About Us' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
@endsection

@section('content')
<!-- Event Banner -->
<div class="event-banner">
    <div class="event-banner-content">
      <img src="{{ asset('images/event-banner/3rd-GHA-SCAI-wordmark.svg') }}" alt="3rd GHA-SCAI SHOCK MIDDLE EAST KUWAIT - JAN 9-10, 2026" class="event-banner-logo">
    </div>
</div>

  <div id="about" class="about home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">Gulf Heart Association (GHA) {{-- - {{ $pageContent->website_title }} --}}</h1>

          <p class="description">
            GHA is a leading, non-profit, professional, regional, cardiology organization that was
            established in Doha, Qatar in January 2002. It is governed by a board represented by colleagues from the
            cardiac societies of Kingdom of Bahrain, Kingdom of Saudi Arabia, Kuwait, Qatar, Sultanate of Oman, United
            Arab Emirates, Yemen and Iraq. Over the past two decades, the GHA has successfully brought together the
            cardiologists from across the region. It has established collaboration with regional and international cardiac
            societies. It has led the way in enabling regional research.
          </p>
          <p class="description">
            The GHA aims to improve the quality of cardiac care in the GCC states through its
            educational activities. The current collaboration with SCAI to establish GHA-SCAI SHOCK MENA meeting
            highlights what GHA aims for
          </p>
          <div class="description">
            <ul>
              <li>Raising the standard of cardiac care in the GCC states.</li>
              <li>Conduct scientific conferences and symposia.</li>
              <li>Carry on scientific research on cardiovascular diseases.</li>
              <li>Publish professional periodicals (Heart Views is GHA’s official journal).</li>
              <li>Create professional, educational, and social ties among members of GHA.</li>
              <li>Collaborate with international cardiology institutions and professional societies.</li>
              <li>Establish criteria for GCC cardiovascular specialists to meet high standards of competence and
                expertise.</li>
              <li>Work with GCC governments to create prevention programs aimed at reducing cardiovascular diseases.</li>
            </ul>
          </div>

          <h1 class="main-title">Society for Cardiovascular Angiography & Interventions (SCAI)</h1>

          <p class="description">
            SCAI is the only professional medical society in the US dedicated solely to interventional cardiology. They
            provide the tools and resources you need at each stage of your career to deliver the best patient care. From
            providing you with clinical guidelines, education, and representation to professional recognition and research
            opportunities, wherever you are located around the world, SCAI is your home.
          </p>

          <h1 class="main-title hidden">Board Members Of The Gulf Heart Association {{-- - {{ $pageContent->website_title }} --}}</h1>

          <div class="row hidden">
            @forelse($countries as $country)
              <div class="col-md-6" style="padding: 0 50px;">
                <h1 class="section-title">{{ $country->name }}</h1>

                <div class="row">
                  @forelse($country->members->sortBy('display_order') as $member)
                    <div class="col-md-4 col-sm-4 col-xs-6 doctor-container">
                      <div class="doctor">
                        <div class="img-container">
                          <i class="fa-solid fa-spinner fa-spin fa-2x"></i>
                          @if ($member->image_file && file_exists('images/board/' . $member->image_file))
                            <img class="member-image" src="{{ asset('images/board/' . $member->image_file) }}">
                          @else
                            <img class="member-image" src="{{ asset('images/board/default_2.jpg') }}">
                          @endif
                        </div>
                        <div class="doctor-info">
                          <span>{{ $member->name ? $member->name : $member->first_name . ' ' . $member->last_name }}</span>
                        </div>
                      </div>

                    </div>
                  @empty
                    <div class="col-md-12">
                      <label>No Board Members Found</label>
                    </div>
                  @endforelse
                </div>
              </div>
            @empty
              <div class="col-md-12">
                <label>No Countries Found</label>
              </div>
            @endforelse
          </div>

        </div>
        <!-- end section title -->
      </div>

      <div class="bottom-link">
        <a href="https://gulfheart.org/">
          <p>Learn More on the Gulf Heart Association Website
          </p>
        </a>
      </div>


    </div>
  </div>
  @section('scripts')
  @endsection
@stop
