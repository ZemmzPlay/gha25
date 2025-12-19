@extends('master')

@section('title', 'Location' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/location.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/all.css') }}" />
@endsection

@section('content')

  <div id="location" class="location home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <!-- Hero Section -->
      <div class="location-hero animate-fade-in">
        <h1 class="main-title">Location of the Meeting</h1>
        <h2 class="second-title">The Regency Hotel</h2>
      </div>

      <!-- Location Info Cards -->
      <div class="location-info animate-fade-in">
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fa-solid fa-map-marker-alt"></i>
          </div>
          <h4>Address</h4>
          <p>The Regency Hotel, Kuwait City, Kuwait</p>
        </div>

        <div class="info-card">
          <div class="info-card-icon">
            <i class="fa-solid fa-phone"></i>
          </div>
          <h4>Contact</h4>
          <p>+965 2225 5555</p>
        </div>

        <div class="info-card">
          <div class="info-card-icon">
            <i class="fa-solid fa-clock"></i>
          </div>
          <h4>Check-in</h4>
          <p>Available 24/7</p>
        </div>
      </div>

      <div class="note">
        <p>
          <strong>Note:</strong> Guest accommodation is not provided for this event. Rooms may be booked via The Regency Hotel at standard
          rates; no discounts apply. Please be aware that the Convention Center is a separate facility with no direct
          access to the beach.
        </p>
      </div>

      <!-- Map Section -->
      <div class="map-container animate-fade-in">
        <!-- <div class="map-header">
                  <h3><i class="fa-solid fa-location-dot"></i> Interactive Map</h3>
              </div> -->
        <div class="map-wrapper">
          <div class="map">
            <i class="fa-solid fa-spinner fa-spin fa-4x"></i>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.831461473419!2d48.0889497!3d29.316619099999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf75fd1fddcdcd%3A0xa103f04ef540450f!2sThe%20Regency%20Hotel!5e0!3m2!1sen!2slb!4v1753868527682!5m2!1sen!2slb"
              class="map-embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
        <div class="map-actions">
          <a href="https://maps.app.goo.gl/tikBeRtdgMyau32U8" class="btn-direction" target="_blank">
            <i class="fa-solid fa-directions"></i>
            Get Directions
          </a>
          <a href="https://www.google.com/maps/search/The+Regency+Hotel+Kuwait" class="btn-secondary" target="_blank">
            <i class="fa-solid fa-external-link-alt"></i>
            View on Google Maps
          </a>
        </div>
      </div>

      <!-- Additional Information -->
      <!-- <div class="additional-info animate-fade-in">
              <h3>Hotel Information</h3>
              <div class="info-grid">
                  <div class="info-item">
                      <i class="fa-solid fa-wifi"></i>
                      <span>Free WiFi Available</span>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-car"></i>
                      <span>Valet Parking</span>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-utensils"></i>
                      <span>Restaurant & Bar</span>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-dumbbell"></i>
                      <span>Fitness Center</span>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-swimming-pool"></i>
                      <span>Swimming Pool</span>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-concierge-bell"></i>
                      <span>24/7 Concierge</span>
                  </div>
              </div>
          </div> -->
    </div>
  </div>
@section('scripts')
  <script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
@endsection
@stop
