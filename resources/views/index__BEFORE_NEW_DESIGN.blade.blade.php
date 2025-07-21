@extends('master')

@section('style')
    <style>
        .welcome-author {
            text-align: left;
        }

        form .form-control {
            background: transparent;
            padding:5px 0;
            border-width: 0 0 1px 0;
            color: #cccccc;
            border-color: #cccccc;
            margin-bottom: 5px;
            border-radius: 0 !important;
        }

        form .form-control:focus {
            border-color: #fff;
        }

        form h2 {
            margin-bottom:0 !important;
            margin-top:10px !important;
        }


        @media (max-width: 991px) {
            .welcome {
            }
        }

        @media (max-width: 450px) {
            .welcome-author {
                font-size: 10px !important;
                text-align: left;
                line-height: 14px;
            }
        }

    </style>
@stop

@section('content')

    <section id="about" class="home-section about animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
        <div class="container" style="padding-top:0 !important;">
            <div class="main-banner" style="border-left:15px solid; border-color: #D61B42;">
                <div class="text-container" style="background: url({{asset('images/home-bg.png')}}) right center no-repeat; margin-left:20px;">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 title-section">
                            <h1 class="section-title white-text" style="font-family: 'CircularBlack', sans-serif">
                                The Fourth Joint<br/>
                                GHA/ESC Meeting<br/>
                                <span class="date">October 09-10, 2020</span>
                            </h1>
                        </div>
                        <div class="col-md-6 col-sm-6 registration-section">
                            @if(Settings::get('registration_enabled'))
                            <form class="registration-form" method="post" style="width:100%; padding: 20px; background: rgba(190, 30, 38, 0.74);" action="{{route('registrations.create')}}">

                                @if(count($errors) > 0)
                                    <h1 style="color:white; text-transform: capitalize; margin-bottom:0; font-family: 'CircularBook', 'sans-serif'; font-size: 22px; line-height: normal">Registration</h1>
                                    <div class="alert alert-danger" style="border-radius: 0;color: red;background: rgba(255,255,255,0.8);margin-bottom: 0;margin-top: 10px;border-width: 0;border-left: 5px solid red;">
                                        <strong>Error:</strong>
                                        @if(count($errors) == 1)
                                            <br>{{$errors->first()}}
                                        @else
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endif
                                @if(Session::has('message'))
                                    <h1 style="color:white; text-transform: capitalize; margin-bottom:0; font-family: 'CircularBook', 'sans-serif'; font-size: 22px; line-height: normal">Thank you</h1>
                                        <p style="color:  #fff;margin-top: 20px;">
                                            Your registration is confirmed. You should be receiving an email address shortly with your registration details.
                                            <br><br>
                                            Your registration ID is {{Session::get('id')}}. In case you didn't receive the confirmation email, please contact us and mention your ID number.</p>
                                @else
                                    @if(!count($errors))
                                            <h1 style="color:white; text-transform: capitalize; margin-bottom:0; font-family: 'CircularBook', 'sans-serif'; font-size: 22px; line-height: normal">Registration</h1>
                                    @endif
                                    <div class="row">

                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            <h2 style="color:white; text-transform: capitalize; margin-bottom:10px; font-family: 'CircularBook', 'sans-serif'; font-size: 16px;">Personal Information</h2>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12 registration-field" style="padding-right: 5px;">
                                                    <select id="title" class="form-control" style="-webkit-appearance: none; -moz-appearance: none;border-radius: 0; background: transparent url({{asset('images/dropdown-arrow.png')}}) no-repeat 100% center; margin-bottom: 10px;" name="title" required>
                                                        <option value="">* Title</option>
                                                        <option value="Prof">Prof</option>
                                                        <option value="Dr">Dr</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 registration-field" style="padding-right: 5px; padding-left: 5px;"><input type="text" id="firstName" name="first_name" placeholder="* First Name" class="form-control" required autocomplete="notready"></div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 registration-field" style="padding-left: 5px;"><input type="text" name="last_name" id="lastName" placeholder="* Last Name" class="form-control" required autocomplete="notready"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6 registration-field" style="padding-right: 5px;"><input type="text" name="speciality" id="speciality" placeholder="* Speciality" class="form-control" required autocomplete="notready"></div>
                                                <div class="col-md-8 col-sm-8 col-xs-6 registration-field" style="padding-left: 5px;"><input type="text" name="department" id="hospital" placeholder="* Hospital / Center" class="form-control" required autocomplete="notready"></div>
                                            </div>
                                            <h2 style="color:white; text-transform: capitalize; margin-bottom:10px; font-family: 'CircularBook', 'sans-serif'; font-size: 16px;">Contact Details</h2>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6 registration-field" style="padding-right: 5px;"><input id="mobile" type="tel" name="mobile" placeholder="* Mobile" class="form-control" required autocomplete="notready"></div>
                                                <div class="col-md-8 col-sm-8 col-xs-6 registration-field" style="padding-left: 5px;"><input id="email" type="email" name="email" placeholder="* Email" class="form-control" required autocomplete="notready"></div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block btn-lg" style="display: block !important; margin:10px 0 0 0;" id="registrationBtn">Register Now</button>

                                        </div>

                                    </div>
                                @endif
                            </form>
                            @endif

                                @if(Settings::get('certificates_enabled'))
                                    <form class="registration-form" method="post" style="background: rgba(190, 30, 38, 0.74); width:100%; float:right; padding: 20px;" action="{{route('registration.verify')}}">
                                        <h1 style="color:white; text-transform: capitalize; margin-bottom:20px;">Certificate</h1>
                                        <p>Please use your registration ID (in the confirmation email) to claim your certificate.</p>
                                        <div class="row">
                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger col-md-12">
                                                    @if(count($errors) == 1)
                                                        {{$errors->first()}}
                                                    @else
                                                        The following errors happened:
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{$error}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endif
                                            {{csrf_field()}}

                                            @if(Session::has('message'))
                                                <div class="alert alert-success col-md-12">
                                                    {!! Session::get('message') !!}
                                                </div>
                                            @else
                                                {{csrf_field()}}
                                                <input type="hidden" name="request_type" value="certificate">
                                                <div class="col-md-12"><input name="id" placeholder="* Your ID" class="form-control" required="" style="margin-bottom: 20px;"></div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary btn-block btn-lg" style="display: block !important; margin:0;">Claim</button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                @endif
                                @if(!Settings::get('registration_enabled') && !Settings::get('certificates_enabled'))

                                <h1 style="font-family: 'CircularBook', sans-serif; color: #fff; font-weight: normal;">2019 recap</h1>
                                <p>Checkout the recap video below to get a glance on a few moments of the Third Joint GHA/ESC Meeting - 2019</p>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/x4_Zap65XTg?controls=0&rel=0&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <section id="faculty" class="faculty animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
        <div class="container" style="padding-top:0 !important;">
            <div class="message" style="border-left:15px solid #D61B42; padding-left: 35px;">
                <div class="row" style="margin-bottom: 20px;">

                    <div class="col-md-6 col-md-push-6">
                        <div class="home-faculty" style="padding-top: 10px;">
                            <h3 class="section-title" style="margin-bottom: 15px; font-family: CircularBook, sans-serif; font-size: 20px;">Meeting Directors:</h3>
                            <div class="row">

                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="doctor">
                                        <a href="#">
                                            <div class="img-container">
                                                <img src="{{asset('images/faculty/2.jpg')}}">
                                            </div>
                                            <div class="doctor-info">
                                                <span>Prof. Mohammad Zubaid</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="doctor">
                                        <a href="#">
                                            <div class="img-container">
                                                <img src="{{asset('images/faculty/1.jpg')}}">
                                            </div>
                                            <div class="doctor-info">
                                                <span>Prof. J Zamorano</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <h3 class="section-title" style="margin-bottom: 15px; font-family: CircularBook, sans-serif; font-size: 20px;">Meeting Co-Directors:</h3>
                            <div class="row">

                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="doctor">
                                        <a href="#">
                                            <div class="img-container">
                                                <img src="{{asset('images/faculty/3.jpg')}}">
                                            </div>
                                            <div class="doctor-info">
                                                <span>Dr. Alawi Alsheikh-Ali</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="doctor">
                                        <a href="#">
                                            <div class="img-container">
                                                <img src="{{asset('images/faculty/4.jpg')}}">
                                            </div>
                                            <div class="doctor-info">
                                                <span>Dr. Mohammad Al Jarallah</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-pull-6">
                        <div class="welcome">
                            <h1>DEAR COLLEAGUES,</h1>
                            <p>
                                {!! nl2br(Settings::get('message')) !!}
                            </p>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p style="font-size: smaller;" class="welcome-author">
                                        Professor Mohammad Zubaid<br>
                                        Immediate Past President,<br>GHA
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p style="font-size: smaller;" class="welcome-author">
                                        Professor J Zamorano<br>
                                        Vice President ESC<br>for Global Affairs
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section>

    <!--

    <section id="faculty" class="faculty animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
        <div class="container" style="padding-top:0 !important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="home-faculty" style="border-left:15px solid #D61B42; padding-left: 35px;">
                        <h3 class="section-title text-center" style="margin-bottom: 15px; font-family: CircularBold, sans-serif; font-size: 40px;">Sign up for the latest news!</h3>
                        <div class="row">
                            <div class="col-md-8 col-md-push-2 col-sm-10 col-sm-push-1 col-xs-12">
                                <form>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="emailInput" style="border: 2px solid #d61e42; padding: 12px 15px;" placeholder="Your Valid E-mail Address">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary no-margin-right" id="addEmail" type="button" style="padding: 13px 20px; outline: none;">Submit</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    -->

    <section id="sponsors" class="sponsors animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
        <div class="container" style="padding-top:0 !important;">
            <div class="logos" style="border-left:15px solid #D61B42; padding-left: 35px;">
                <div class="row">
                    <div class="col-sm-6 sponsors-group">
                        <h3 class="section-title" style="font-family: CircularBook, sans-serif; font-size: 20px;">Supported by:</h3>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 text-center sponsor"><a href=" http://www.gulfheart.org" target="_blank"><img src="{{asset('images/sponsors/gha.png')}}"></a></div>
                            <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/esc.png')}}"></a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 sponsors-group">
                        <h3 class="section-title" style="font-family: CircularBook, sans-serif; font-size: 20px;">Supported by:</h3>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/sanofi.png')}}"></a></div>
<!--
     <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/novartis.png')}}"></a></div>
                            <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/AstraZeneca.png')}}"></a></div>
-->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script>
        $(document).ready(function() {
            let addEmailBtn = $('#addEmail');
            let registrationBtn = $('#registrationBtn');

            let emailInput  = $('#emailInput');
            let email       = "";

            //Registration fields
            let title_field         = $('#title');
            let first_name_field    = $('#firstName');
            let last_name_field     = $('#lastName');
            let speciality_field    = $('#speciality');
            let hospital_field      = $('#hospital');
            let mobile_field        = $('#mobile');
            let email_field         = $('#email');

            addEmailBtn.on('click', function() {
                email       = emailInput.val();
                if(!email) alert('Please enter an email address.');
                else {
                    addEmailBtn.html('Loading..');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: route('emails.create'),
                        method: "POST",
                        cache: false,
                        data: {
                            email: email
                        },
                        success: function(response) {
                            addEmailBtn.html('Submit');
                            emailInput.val("");
                            swal('Great!', "Thank you for subscribing. We will get back to you soon with the latest updates.", 'success');
                        },
                        error: function(jqXhr, json, errorThrown) {
                            let request_errors = jqXhr.responseText;
                            request_errors = request_errors.substring(request_errors.indexOf("{"));
                            request_errors = JSON.parse(request_errors);
                            console.log(request_errors);
                            swal('Validation Failed', request_errors.status.errors + "", "error");
                            addEmailBtn.html('Submit');
                            emailInput.val("");
                        }
                    });
                }
            });
            registrationBtn.on('click', function() {
                registrationBtn.html('<img src="{{asset('images/loading-ring.svg')}}" style= "width: 20px;"> Registering ..');
            });


        });
    </script>
@stop




