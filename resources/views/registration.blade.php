@extends('master')

@section('title', 'Registration & CME | GHAESC')

@section('style')
    <style>
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
    </style>
@stop

@section('content')

        <section id="registration" class="registration home-section animate slow-mo even fadeIn no-padding-top no-padding-bottom" data-anim-type="fadeIn" data-anim-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div style="padding-left: 35px; border-left: 15px solid #D61E42">
                            <h2 style="margin-bottom: 15px;font-family: CircularBlack, sans-serif;font-size: 20px;">Registration</h2>
                            <p class="text-justify" style="margin-bottom: 20px; font-size: 16px;line-height: 20px;">
                                {!! nl2br($registration_text) !!}
                            </p>
                        </div>
                        <div style="padding-left: 35px; border-left: 15px solid #D61E42">
                            <h2 style="margin-bottom: 15px;font-family: CircularBlack, sans-serif;font-size: 20px;">CME</h2>
                            <p class="text-justify" style="margin-bottom: 20px; font-size: 16px;line-height: 20px;">
                                {!! nl2br($cme_text) !!}
                            </p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        @if(Settings::get('certificates_enabled'))
                            <form class="registration-form" method="post" style="background: #BE1E26; width:100%; float:right; padding: 20px;" action="{{route('registration.verify')}}">
                                <h1 style="color:white; text-transform: capitalize; margin-bottom:20px;">Certificate</h1>
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
                                        <div class="col-md-12"><input name="id" placeholder="* Your ID" class="form-control" required=""></div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-block btn-lg" style="display: block !important; margin:0;">Claim</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @endif

                        @if(Settings::get('registration_enabled'))
                                <form class="registration-form" method="post" style="width:100%; padding: 20px; background: rgb(190, 30, 38);" action="{{route('registrations.create')}}">

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
                    </div>
                </div>
            </div>
        </section>
@stop

