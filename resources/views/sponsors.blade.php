@extends('master')

@section('title', 'Sponsors' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
@section('style')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sponsors.css') }}" />
@endsection

@section('content')
<!-- Event Banner -->
<div class="event-banner">
    <div class="event-banner-content">
      <img src="{{ asset('images/event-banner/3rd-GHA-SCAI-wordmark.svg') }}" alt="3rd GHA-SCAI SHOCK MIDDLE EAST KUWAIT - JAN 9-10, 2026" class="event-banner-logo">
    </div>
</div>

  <div id="sponsors"
    class="sponsors home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">Sponsors</h1>

        </div>
      </div>

      @include('all-sponsors')
    </div>
  </div>
@stop
