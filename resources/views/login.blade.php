@extends('master')

@section('title', 'Login'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))


@section('style')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
@stop


@section('content')
    <div class="loginContainerOut">
        <div class="topLoginImage">
            <img class="topLoginImageDesktop" src="{{ asset('images/global/Sign_In_Desktop_Banners.png') }}" alt="login-image" />
            <img class="topLoginImageMobile" src="{{ asset('images/global/Sign_In_Mobile_Banners.png') }}" alt="login-image-mobile" />
        </div>

        <div class="loginContainer">
            <div class="loginTitle">
                <div class="loginTitleText">Log in</div>
                <div class="loginTitleLine"></div>
            </div>

            <form method="POST" action="{{ url('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="loginInputsContainer">
                    <div class="oneInputContainer">
                        <label for="email">Email</label>
                        <input id="email" placeholder="emailid@domain.com" type="email" name="email" value="{{OLD('email')}}" required>
                    </div>

                    <div class="oneInputContainer">
                        <label for="phone_code">Number</label>
                        <div class="phoneContainer">
                            <select name="phone_code" id="phone_code" required>
                                @foreach([
                                    '+965' => 'Kuwait',
                                    '+966' => 'Saudi Arabia',
                                    '+98' => 'Iran',
                                    '+20' => 'Egypt',
                                    '+974' => 'Qatar',
                                    '+971' => 'United Arab Emirates',
                                    '+963' => 'Syria',
                                    '+964' => 'Iraq',
                                    '+962' => 'Jordan',
                                    '+961' => 'Lebanon',
                                    '+216' => 'Tunisia',
                                    '+212' => 'Morocco',
                                    '+967' => 'Yemen',
                                    '+973' => 'Bahrain',
                                    '+968' => 'Oman',
                                    '+213' => 'Algeria',
                                    '+218' => 'Libya',
                                    '+970' => 'Palestine',
                                    '+249' => 'Sudan',
                                    '+253' => 'Djibouti'
                                ] as $code => $country)
                                    <option value="{{ $code }}" {{(OLD('phone_code') && OLD('phone_code') == $code) ? 'selected' : ''}}>{{ $code }} ({{ $country }})</option>
                                @endforeach
                            </select>
                            <input type="text" id="phone_number" value="{{OLD('phone_number')}}" name="phone_number" placeholder="5000 9876" required>
                        </div>
                    </div>

                    <div class="oneInputContainer">
                        <label for="id">ID</label>
                        <input id="id" placeholder="Your ID" type="text" name="id" value="{{OLD('id')}}" required>
                    </div>
                </div>

                <button class="submitButton" type="submit">Login</button>
            </form>
        </div>
    </div>
@stop


@section('scripts')
@stop

