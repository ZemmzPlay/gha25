@extends('master')

@section('title', 'Contact Us' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')
<!-- Event Banner -->
<div class="event-banner">
    <div class="event-banner-content">
      <img src="{{ asset('images/event-banner/3rd-GHA-SCAI-wordmark.svg') }}" alt="3rd GHA-SCAI SHOCK MIDDLE EAST KUWAIT - JAN 9-10, 2026" class="event-banner-logo">
    </div>
</div>

  <div id="contact-us"
    class="contact-us home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="main-title">Contact Us</h1>
          
          <p class="description">
            We're here to help! If you have any questions, need further information, or would like to get in touch with our team, please don't hesitate to reach out to us.
          </p>

          <div class="contact-info-container">
            <div class="contact-info-grid">
              <div class="contact-item">
                <div class="contact-icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <h3 class="contact-title">Email Us</h3>
                <div class="contact-content">
                  <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
                  <p>Send us an email and we'll respond within 24 hours</p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon">
                  <i class="fa fa-phone"></i>
                </div>
                <h3 class="contact-title">Call Us</h3>
                <div class="contact-content">
                  <a href="tel:+96522467780">+965 2246 7780</a>
                  <p>Available during business hours (9 AM - 5 PM)</p>
                </div>
              </div>
            </div>
          </div>

          <div class="additional-info">
            <h3>Need Immediate Assistance?</h3>
            <p>For urgent matters or technical support, please call us directly. Our team is committed to providing you with the best possible service and support.</p>
            <p>We look forward to hearing from you and helping with any questions you may have about the 3RD GHA - SCAI SHOCK MIDDLE EAST conference.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
