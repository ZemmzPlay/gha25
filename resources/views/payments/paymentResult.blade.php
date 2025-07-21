@extends('master')

@section('title', 'Payment Result'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))

@section('style')
<link rel="stylesheet" href="{{asset('css/paymentResult.css')}}" />
@endsection

@section('content')
<section class="main-content animate slow-mo even fadeIn no-padding-top no-padding-bottom" data-anim-type="fadeIn" data-anim-delay="200">
  <input type="hidden" id="printURL" value="{{ url('/register/payment-result/' . $result . '/' . $registration_id . '/print') }}">
  <div class="container">
    <div class="row result-container">
      <div class="col-md-8">
        @if($result == 'success')

        <div class="main-title-container">
          <div class="">
            <h1 class="main-title"><span>Thank you for Registering</span> <i class="fas fa-check-circle text-green"></i></h1>
          </div>
          <div class="button-section">
            <button class=""><i class="fa-regular fa-floppy-disk"></i></button>
            <button class="print"><i class="fa-solid fa-print"></i></button>
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
        <div class="main-title-container">
          <div class="">
            <h1 class="failed-main-title text-danger"><span>Payment failed</span> <i class="fa-solid fa-circle-xmark"></i></h1>
          </div>
        </div>
        <h3 class="payment-failed">The Payment Failed.</h3>
        <div class="contact">
          <h3>Please try again, If you face any difficulties kindly contact us by email on <a href="mailto:conferences@zawaya.me">conferences@zawaya.me</a> or by phone on <a href="tel:+96522467780">+96522467780</a> </h3>
          <a href="{{ url('/#register') }}" class="btn btn-success">Try Again</a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</section>
@section('scripts')
  <script type="text/javascript" src="{{asset('js/jQuery.print.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '.print', function(event) {
      event.preventDefault();
      /* Act on the event */
      // window.print();
      // let CSRF_TOKEN = $('meta[name="_token"').attr('content');

      $.ajax({
        url: $('#printURL').val(),
        type: 'POST',
        data: {_token: $('meta[name="_token"').attr('content')},
      })
      .done(function(viewContent) {
        // console.log("success");
        // window.print(viewContent);
        // viewContent.print();
        $.print(viewContent);
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

  //     let CSRF_TOKEN = $('meta[name="_token"').attr('content');

  //     $.ajaxSetup({
  //       url: $('#printURL').val(),
  //       type: 'POST',
  //       data: {
  //         _token: CSRF_TOKEN,
  //       },
  //       beforeSend: function() {
  //         console.log('printing ...');
  //       },
  //       complete: function() {
  //         console.log('printed!');
  //       }
  //     });

  //     $.ajax({
  //       success: function(viewContent) {
  //     $.print(viewContent); // This is where the script calls the printer to print the viwe's content.
  //   }
  // });
      
    });
  });
</script>
@endsection
@endsection
