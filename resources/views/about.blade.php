@extends('master')

@section('title', 'About'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
<link rel="stylesheet" href="{{asset('css/about.css')}}" />
@endsection

@section('content')
<div id="about" class="about home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">

                <h1 class="main-title">Gulf Heart Association (GHA) {{-- - {{ $pageContent->website_title }} --}}</h1>

                <p class="description">The first GCC Cardiovascular Symposium on January 15 – 17, 2002 provided an opportunity for Gulf cardiologists, cardiovascular surgeons, and other cardiovascular specialists in the GCC states to meet, exchange ideas and build bridges for scientific and medical cooperation. During that meeting, we proposed to establish a professional society which we called Gulf Heart Association (GHA). The proposal was unanimously and enthusiastically endorsed by the entire group of cardiovascular specialists present during that meeting and so the GHA was born on January 16, 2002. Over three years the GHA became a landmark accomplishment for the GCC states.</p>

                <h1 class="main-title">Board Members Of The Gulf Heart Association {{-- - {{ $pageContent->website_title }} --}}</h1>

                <div class="row">
                    @forelse($countries as $country)
                    <div class="col-md-6" style="padding: 0 50px;">
                        <h1 class="section-title">{{$country->name}}</h1>

                        <div class="row">
                            @forelse($country->members->sortBy('display_order') as $member)
                            <div class="col-md-4 col-sm-4 col-xs-6 doctor-container">
                                <div class="doctor">
                                    <div class="img-container">
                                        <i class="fa-solid fa-spinner fa-spin fa-2x"></i>
                                        @if($member->image_file && file_exists('images/board/'.$member->image_file))
                                        <img class="member-image" src="{{asset('images/board/'.$member->image_file)}}">
                                        @else
                                        <img class="member-image" src="{{asset('images/board/default_2.jpg')}}">
                                        @endif
                                    </div>
                                    <div class="doctor-info">
                                        <span>{{$member->name ? $member->name : $member->first_name . " " . $member->last_name}}</span>
                                    </div>
                                </div>

                            </div>
                            @empty
                            <div class="col-md-12">
                                <label>No Board Members Found</label>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <label>No Countries Found</label>
                    </div>
                    @endforelse
                </div>

            </div>
            <!-- end section title -->
        </div>

        <div class="bottom-link">
            <a href="https://gulfheart.org/">
                <p>Learn More on the Gulf Heart Association Website
                </p>
            </a>
        </div>


    </div>
</div>
@section('scripts')
@endsection
@stop


