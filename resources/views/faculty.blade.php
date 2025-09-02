@extends('master')

@section('title', 'Faculty'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
<link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
<link rel="stylesheet" href="{{asset('css/faculty.css')}}" />
<link rel="stylesheet" href="{{ asset('plugins/flag-icon-css/css/flag-icon.min.css') }}" />
<style>
  .doctor-country {
    display: flex !important;
    align-items: center;
    justify-content: center;
  }
  
  .doctor-country .flag-icon {
    width: 16px;
    height: 12px;
    display: inline-block;
    vertical-align: middle;
    flex-shrink: 0;
    margin-right: 2px;
  }
</style>
@endsection

@section('content')
<div id="faculty" class="faculty home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">

                <h1 class="main-title">faculty {{-- - {{ $pageContent->website_title }} --}}</h1>
                <div id="faculty-members">
                    @foreach($categories as $category)
                    <div style="padding: 0 50px;">
                        <h1 class="section-title" style="margin-bottom: 15px;font-family: CircularBook, sans-serif;font-size: 20px; color: var(--primary-color); font-weight: bold;">{{$category->name}}</h1>

                        <div class="row">
                            @forelse($category->members->sortBy(function($member) {
                                // First sort by whether they have an image (images first), then by creation date (newest first), then by last name
                                return [$member->image_file ? 0 : 1, -strtotime($member->created_at), $member->last_name];
                            }) as $member)
                            <div class="col-md-2 col-sm-4 col-xs-6 doctor-container">
                                <div class="doctor">
                                    <a class="modal-member-popup" data-id="{{ $member->id }}">
                                        <div class="img-container">
                                            <i class="fa-solid fa-spinner fa-spin fa-2x"></i>
                                            @if($member->image_file && file_exists('images/faculty/'.$member->image_file))
                                            <img class="member-image" src="{{asset('images/faculty/'.$member->image_file)}}">
                                            @else
                                            <img class="member-image" src="{{asset('images/faculty/default_2.jpg')}}">
                                            @endif
                                        </div>
                                        <div class="doctor-info">
                                            <span>{{$member->name ? $member->name : $member->first_name . " " . $member->last_name}}</span>
                                            <span class="doctor-country">
                                              @if($member->country)
                                                <span class="flag-icon flag-icon-{{ strtolower($member->country) }}"></span>
                                                {{$member->country_name}}
                                              @else
                                                {{$member->country_name}}
                                              @endif
                                            </span>
                                        </div>
                                    </a>
                                </div>

                                {{-- @if($member->bio) --}}

                                {{-- <div id="modal-popup{{$member->id}}" class="zoom-anim-dialog mfp-hide col-lg-5 col-md-7 col-sm-7 col-xs-11 center-col bg-white text-center modal-popup-main">
                                    <div class="row">
                                        <div class="col-md-12 text-left col-xs-12">
                                            <div class="" style="max-height: 300px; overflow-y: auto; font-size: 14px; display: flex; align-items: flex-end;">
                                                @if($member->image_file && file_exists('images/faculty/'.$member->image_file))
                                                <img src="{{asset('images/faculty/'.$member->image_file)}}" style="width:100px; float:left; margin-right: 20px; border: 2px solid #000000;">
                                                @else
                                                <img src="{{asset('images/faculty/default.jpg')}}" style="width:100px; float:left; margin-right: 20px; border: 2px solid #000000;">
                                                @endif
                                                <span class="slider-subtitle5 black-text" style="margin-bottom: 10px;">{{$member->name ? $member->name : $member->first_name . " " . $member->last_name}}
                                                </span>
                                            </div>
                                            <div class="margin-four">
                                                {!! $member->bio ? nl2br($member->bio) : "No Bio Found!" !!}
                                            </div>
                                            <a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- @endif --}}


                            </div>
                            @empty
                            <div class="col-md-12">
                                <label>No Faculty Member Found</label>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @endforeach
                </div>

                <div id="modal-popup{{-- {{$member->id}} --}}" class="zoom-anim-dialog mfp-hide col-lg-5 col-md-7 col-sm-7 col-xs-11 center-col bg-white text-center modal-popup-main">
                    <div class="row">
                        <div class="col-md-12 text-left col-xs-12 bio-wait text-center">
                            Loading Bio...
                        </div>
                        <div class="col-md-12 text-left col-xs-12 bio-info">
                            <div class="" style="max-height: 300px; overflow-y: auto; font-size: 14px; display: flex; align-items: flex-end;">
                                {{-- @if($member->image_file && file_exists('images/faculty/'.$member->image_file))
                                <img src="{{asset('images/faculty/'.$member->image_file)}}" style="width:100px; float:left; margin-right: 20px; border: 2px solid #000000;">
                                @else
                                <img src="{{asset('images/faculty/default.jpg')}}" style="width:100px; float:left; margin-right: 20px; border: 2px solid #000000;">
                                @endif
                                <span class="slider-subtitle5 black-text" style="margin-bottom: 10px;">{{$member->name ? $member->name : $member->first_name . " " . $member->last_name}}
                                </span> --}}
                                <img src="" class="member-bio-image">
                                <span class="slider-subtitle5 black-text member-bio-name" style="margin-bottom: 10px;">
                                </span>
                            </div>
                            <div class="margin-four bio">
                                {{-- {!! $member->bio ? nl2br($member->bio) : "No Bio Found!" !!} --}}
                            </div>
                            <a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end section title -->
        </div>


    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/faculty.js')}}"></script>
@endsection
@stop


