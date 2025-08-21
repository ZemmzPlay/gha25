@extends('master')

@section('title', 'Sponsors' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sponsors.css') }}" />
@endsection

@section('content')
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
