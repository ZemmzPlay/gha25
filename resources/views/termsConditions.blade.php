@extends('master')

@section('title', '3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT')
@section('style')
<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
<link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
<link rel="stylesheet" href="{{asset('css/termsConditions.css')}}" />
@endsection

@section('content')
    <!-- Event Banner -->
    <div class="event-banner">
        <div class="event-banner-content">
            <h2 class="event-title">3<sup>rd</sup> GHA-SCAI SHOCK MIDDLE EAST KUWAIT - JAN 9-10, 2026</h2>
        </div>
    </div>

<div id="faculty" class="faculty home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">

                <h1 class="main-title">Terms & Conditions</h1>

                <div class="conatiner">
                    {!! $terms !!}
                </div>

            </div>
            <!-- end section title -->
        </div>


    </div>
</div>
@section('scripts')
@endsection
@stop


