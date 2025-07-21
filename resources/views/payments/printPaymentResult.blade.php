<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <link rel="stylesheet" href="{{ asset('css/all.css') }}"> --}}
  <link href="{{asset('css/print.css')}}" rel="stylesheet" media="print" type="text/css">
  <title></title>
</head>
<body>
<section class="main-content animate slow-mo even fadeIn no-padding-top no-padding-bottom" data-anim-type="fadeIn" data-anim-delay="200">
  <div class="container">
    <div class="row result-container">
      <div class="col-md-8">
        @if($result == 'success')
        <div class="main-title-container">
          <div class="">
            <h1 class="main-title"><span>Thank you for Registering</span> <i class="fas fa-check-circle text-green"></i></h1>
          </div>
        </div>
        <h3 class="purchase-text">Your Registration is Confirmed. You should be receiving email address shortly with your registration details.</h3>
        <div class="registration-id-container">
          <h2 class="registration-id">"Your Registration ID is {{$registration_id}}"</h2>
        </div>
        <div>
          <h3>In case you didn't receive the confirmation email, please contact us and mention your ID number.</h3>
        </div>
        <div class="contact">
          <h3>Do not hesitate to contact us by email on <a href="mailto:conferences@zawaya.me">conferences@zawaya.me</a> or by phone on <a href="tel:+96522467780">+96522467780</a> </h3>
        </div>
        @elseif($result == 'failed')
        <i class="fas fa-times fa-5x text-danger"></i>
        <h1 class="text-danger">Sorry</h1>
        <h3 class="purchase-text">The Payment Failed</h3>
        @endif
      </div>
    </div>
  </div>
</div>
</section>
  <script type="text/javascript" src="{{asset('js/all.js')}}"></script>
</body>
</html>