@extends('master')

@section('title', 'Faculty | GHAESC')
@section('style')
<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
<link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
<link rel="stylesheet" href="{{asset('css/termsConditions.css')}}" />
@endsection

@section('content')
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


