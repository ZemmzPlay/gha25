@extends('master')

@section('title', 'Login'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))


@section('style')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
@stop


@section('content')

    <div class="loginContainerOut">
        {{-- <div class="topLoginImage">
            <img class="topLoginImageDesktop" src="{{ asset('images/global/Sign_In_Desktop_Banners.png') }}" alt="login-image" />
            <img class="topLoginImageMobile" src="{{ asset('images/global/Sign_In_Mobile_Banners.png') }}" alt="login-image-mobile" />
        </div> --}}

        <div class="loginContainer">
            <div class="loginTitle">
                <div class="loginTitleText">Log in</div>
                {{-- <div class="loginTitleLine"></div> --}}
            </div>

            <form method="POST" action="{{ url('login') }}" class="loginForm">
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
                            <select name="phone_code" id="phone_code" class="select2-phone" required>
                                @php
                                    $countries = config('countries');
                                @endphp
                                @foreach($countries as $countryCode => $countryData)
                                    <option value="+{{ $countryData['code'] }}" {{ (old('phone_code') && old('phone_code') == '+'.$countryData['code']) || (!old('phone_code') && $countryCode == 'KW') ? 'selected' : '' }} data-flag="{{ strtolower($countryCode) }}">
                                        +{{ $countryData['code'] }} ({{ $countryData['name'] }})
                                    </option>
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

