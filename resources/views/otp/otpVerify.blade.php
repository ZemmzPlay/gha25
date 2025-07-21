@extends('master')

@section('title', 'Verify OTP'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))

@section('style')
<link rel="stylesheet" href="{{asset('css/otpVerify.css')}}" />
@endsection

@section('content')
    <section class="main-content animate slow-mo even fadeIn no-padding-top no-padding-bottom" data-anim-type="fadeIn" data-anim-delay="200">
        <div class="container">

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <div class="success-message">
                    {{ session('message') }}
                </div>
            @endif
            

            <form method="post" action="{{route('registrations.otpVerify', Crypt::encrypt($paymentData->id))}}">
                {{csrf_field()}}
                <div class="verifyOTPContainer">
                    <div class="titleOtp titleOtpTop">Enter the verification code you just received to verify your phone number: {{$registration->countryCode}}{{$registration->mobile}}</div>
                    <input type="text" name="otpCode" class="inputOTP" placeholder="verification code" required />
                    <input type="submit" value="VERIFY CODE" class="verifyCodeSubmit" />
                    <div class="resendCodeText">Didn't receive code? <a href="{{url('/register/resend-otp-code/'.Crypt::encrypt($paymentData->id))}}">Resend</a></div>
                    <div class="lineSep"></div>
                </div>
            </form>


            <form method="post" action="{{route('registrations.updatePhoneNumber', Crypt::encrypt($paymentData->id))}}">
                {{csrf_field()}}

                <div class="wrongNumberContainer" id="wrongNumberButtonPart">
                    <div class="titleOtp">Wrong phone number?</div>
                    <input class="changeNumberButton" id="showChangeNumber" type="button" value="CHANGE NUMBER" />
                </div>

                <div class="wrongNumberContainer hide" id="wrongNumberInputPart">
                    <div class="titleOtp">Modify your phone number</div>
                    <div class="changeNumberInputContainer">
                        <div class="changeNumberInputCountryCode">{{$registration->countryCode}}</div>
                        <input class="changeNumberInputPhone" type="text" placeholder="Your number" name="mobile" value="{{$registration->mobile}}" required />
                    </div>
                    <input class="changeNumberButton" type="submit" value="CHANGE NUMBER" />
                </div>
            </form>

        </div>
    </section>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#showChangeNumber").click(function(){
                $("#wrongNumberButtonPart").addClass("hide");
                $("#wrongNumberInputPart").removeClass("hide");
            });
        });
    </script>
@endsection
