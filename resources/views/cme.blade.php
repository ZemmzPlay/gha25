@extends('master')

@section('title', 'CME' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
@endsection

@section('content')

  <div id="cme" class="cme home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">CME Accreditation</h1>

          <div class="cme-content">
            <h2 class="cme-subtitle">KIMS CEPD Continuing Medical Education (CME) Accreditation</h2>
            
            <p class="description">
              This event has been accredited by the KIMS CEPD Center for Continuing Education and Professional Development for CME points.
            </p>
            
            <p class="description">
              Attendees of the meeting will be eligible to download their official CME certificate. Once the meeting has concluded, you can access the certificate by completing a brief survey on this website.
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
