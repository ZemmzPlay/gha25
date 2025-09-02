@extends('master')

@section('title', 'Contact Us' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/sponsors.css') }}" />
@endsection

@section('content')
  <div id="contact-us"
    class="contact-us home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">Contact Us</h1>

          <p class="description">
            If you have any questions or need further information, please feel free to reach out to us
          </p>

          <p class="description">
            <strong>Email:</strong> <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a><br>
            <strong>Phone:</strong> <a href="tel:+96522467780">+965 2246 7780</a><br>

        </div>
      </div>
    </div>
  </div>
@stop
