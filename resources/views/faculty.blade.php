@extends('master')

@section('title', 'Faculty'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))
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
  .doctor-info #doctor-name {
    white-space: nowrap;
  }
  
  .doctor-country .flag-icon {
    width: 16px;
    height: 12px;
    display: inline-block;
    vertical-align: middle;
    flex-shrink: 0;
    margin-right: 2px;
  }
  
  .doctor-info > span:first-child {
    white-space: normal;
    overflow: visible;
    text-overflow: unset;
    display: block;
    width: 100%;
    word-wrap: break-word;
    line-height: 1.2;
  }
  
  /* Mobile display adjustments */
  @media (max-width: 768px) {
    .doctor-info > span:first-child {
      font-size: 12px;
      min-height: 2.4em;
    }
  }
  
  /* Extra small mobile devices */
  @media (max-width: 413px) {
    .doctor-info > span:first-child {
      font-size: 10px !important;
      min-height: 2.4em;
    }
  }
  
  /* Ensure doctor info container can accommodate wrapped text */
  @media (max-width: 768px) {
    .doctor-info {
      min-height: 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
  }
</style>
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

                <h1 class="main-title">faculty {{-- - {{ $pageContent->website_title }} --}}</h1>
                <div id="faculty-members">
                    <div style="padding: 0 50px;">
                        <div class="row">
                            @forelse($allMembers->sortBy('last_name') as $member)
                            <div class="col-md-2 col-sm-4 col-xs-6 doctor-container">
                                <div class="doctor">
                                    <a class="modal-member-popup" data-id="{{ $member->id }}">
                                        <div class="img-container">
                                            @if($member->image_file && file_exists('images/faculty/'.$member->image_file))
                                            <img class="member-image" src="{{asset('images/faculty/'.$member->image_file)}}">
                                            @else
                                            <img class="member-image" src="{{asset('images/faculty/default_2.jpg')}}">
                                            @endif
                                        </div>
                                        <div class="doctor-info">
                                            <span id="doctor-name">{{$member->name ? $member->name : $member->first_name . " " . $member->last_name}}</span>
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
    <script>
        $(document).ready(function() {
            // // Smart name display for mobile screens
            // function adjustNamesForScreen() {
            //     $('.doctor-info > span:first-child').each(function() {
            //         var $span = $(this);
            //         var originalText = $span.data('original-text') || $span.text().trim();
                    
            //         // Store original text if not already stored
            //         if (!$span.data('original-text')) {
            //             $span.data('original-text', originalText);
            //         }
                    
            //         if (window.innerWidth <= 768) {
            //             // On mobile, show only first part of the name
            //             var words = originalText.split(' ');
                        
            //             if (words.length >= 3) {
            //                 // For 3+ word names, show first 2 words
            //                 var displayText = words[0] + ' ' + words[1];
            //                 $span.text(displayText);
            //             } else if (words.length === 2) {
            //                 // For 2-word names, show first word only
            //                 $span.text(words[0]);
            //             } else {
            //                 // For single word names, show as is
            //                 $span.text(originalText);
            //             }
            //         } else {
            //             // On desktop, show full name
            //             $span.text(originalText);
            //         }
            //     });
            // }
            
            // // Apply on page load with a small delay to ensure DOM is ready
            // setTimeout(function() {
            //     adjustNamesForScreen();
            // }, 100);
            
            // // Apply on window resize
            // $(window).resize(function() {
            //     adjustNamesForScreen();
            // });
        });
    </script>
@endsection
@stop


