@extends('master')

@section('title', 'Location' .(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
    <link rel="stylesheet" href="{{asset('css/location.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.css')}}" />
@endsection

@section('content')
<div id="location" class="location home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
        <div class="row" style="margin-bottom: 5rem;">
            <div class="col-md-12">

                <h1 class="main-title" style="text-transform: none; margin-bottom: 15px; font-size: 50px; line-height: normal;">Location of the Meeting</h1>

                {{-- <div class="map-container">
                    <div class="map">
                        <i class="fa-solid fa-spinner fa-spin fa-4x"></i>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3480.530393075318!2d47.99311751046!3d29.266752547057916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf9966b0d31b51%3A0xfdf7dedf5fa1ffd1!2sGrand%20Hyatt%20Kuwait!5e0!3m2!1sen!2slb!4v1687768848833!5m2!1sen!2slb" width="100%" height="450" class="map-embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="map-details">
                        <h2 class="second-title">Grand Hyatt Kuwait</h2>
                        <h4 class="fourth-title">360 Mall, Zahra</h4>
                        <a href="https://maps.google.com/maps/dir//Grand+Hyatt+Kuwait+360+Mall+Zahra+47451+Kuwait/@29.2667359,47.9955531,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x3fcf9966b0d31b51:0xfdf7dedf5fa1ffd1" class="btn btn-direction" target="_blank"><i class="fa-regular fa-map"></i>Get Directions</a>
                    </div>
                </div> --}}

            </div>
            <!-- end section title -->
        </div>


    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{asset('js/all.js')}}"></script>
@endsection
@stop


