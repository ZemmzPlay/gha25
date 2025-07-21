@extends('master')

@section('title', 'Faculty | GHAESC')

@section('content')
        <section id="faculty" class="faculty home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200">
            <div class="container">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">

                        @foreach($categories as $category)
                            <h1 class="section-title" style="margin-bottom: 15px;font-family: CircularBook, sans-serif;font-size: 20px;">{{$category->name}}</h1>

                            <div class="row">
                                @foreach($category->members->sortBy('display_order') as $member)
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <div class="doctor">
                                            <a href="#modal-popup{{$member->id}}" class="popup-with-move-anim">
                                                <div class="img-container">
                                                    @if($member->image_file)
                                                    <img src="{{asset('images/faculty/'.$member->image_file)}}">
                                                    @else
                                                        <img src="{{asset('images/faculty/default.jpg')}}">
                                                    @endif
                                                </div>
                                                <div class="doctor-info">
                                                    <span>{{$member->name}}</span>
                                                </div>
                                            </a>
                                        </div>

                                        @if($member->bio)

                                        <div id="modal-popup{{$member->id}}" class="zoom-anim-dialog mfp-hide col-lg-5 col-md-7 col-sm-7 col-xs-11 center-col bg-white text-center modal-popup-main">
                                            <div class="row">
                                                <div class="col-md-12 text-left col-xs-12">
                                                    <p class="margin-four" style="max-height: 300px; overflow-y: auto; font-size: 14px;">
                                                        @if($member->image_file)
                                                            <img src="{{asset('images/faculty/'.$member->image_file)}}" style="width:100px; float:left; margin-right: 20px;">
                                                        @else
                                                            <img src="{{asset('images/faculty/default.jpg')}}" style="width:100px; float:left; margin-right: 20px;">
                                                        @endif
                                                        <span class="slider-subtitle5 black-text" style="margin-bottom: 10px;">{{$member->name}}</span>
                                                        {!! nl2br($member->bio) !!}
                                                    </p>
                                                    <a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                    </div>
                                @endforeach
                            </div>
                        @endforeach



                    </div>
                    <!-- end section title -->
                </div>


            </div>
        </section>
@stop


