@extends('master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <style>
        .owl-prev:focus, .owl-next:focus {
            outline: none;
        }

        .owl-prev {
            height: 100px;
            position: absolute;
            top: 40%;
            left: 0;
            display: block!IMPORTANT;
            border:0;
            margin: 0 !important;
            opacity: .5;
        }

        .owl-next {
            height: 100px;
            position: absolute;
            top: 40%;
            right: 0;
            display: block!IMPORTANT;
            border:0;
            margin: 0 !important;
            opacity: .5;
        }

        .owl-next .fa, .owl-prev .fa {
            margin: 0;
        }
        .owl-prev i, .owl-next i {
            transition: ease-in-out all 500ms;
            color: #fff;
            font-size: 30px;
        }

        .owl-prev:hover, .owl-next:hover {
            background: #d61e42 !important;
            opacity: 1;
        }

        .owl-prev:hover i, .owl-next:hover i {

        }

        .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
            background: #d61e42;
            padding: 0 10px !important;
            border-radius: 0;
            transition: ease-in-out all 250ms;

        }

         .owl-thumb-item {
             width: 14.2857%;
             border: none;
             background: #ddd;
             outline:none;
             padding:0;
         }
         .owl-thumb-item img {

         }
        .owl-thumb-item:nth-child(10n) {
            border-right:0;
        }
        .owl-theme .owl-nav {
            margin-top: 0;
        }


        @media (max-width: 991px) {
            .owl-thumbs {
                display: none;

            }
        }

        @media (max-width: 570px) {
            .section-title {
                line-height: normal !important;
                font-size: 20px !important;
            }
            .date, .country {
                font-size: 32px !important;
            }
            .booklet-info img {
                width: 90px;
            }
            .booklet-text {
                padding-right:0 !important;
                line-height: normal !important;
                margin-top: 0 !important;
            }
            .booklet-text span {
                font-size: 30px !important;
            }
            .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
                padding: 0 4px !important;
            }
            .owl-prev i, .owl-next i {
                transform: scale(1,3);
            }
            .owl-prev:hover i, .owl-next:hover i {
                transform: scale(2,6);
                color: #fff;
            }
        }

        @media (max-width: 450px) {

            .item {
                padding: 0 25px;
            }
        }

    </style>
@stop

@section('content')

    <section class="home-section about animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200" style="border-left:15px solid; border-color: #D61B42; margin-bottom: 50px;">
        <div class="container" style="padding-top: 0 !important; padding-bottom: 0 !important;">
            <div class="main-banner">
                <div class="text-container" style="background: #d61e42 right center no-repeat; padding: 50px 0;">
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #fff;">
                            <h1 class="section-title white-text" style="font-size: 50px; line-height: 50px; padding-left: 35px; font-family: CircularBold, sans-serif">
                                The First Joint<br/>
                                GHA/ESC Meeting<br/>
                                <span class="date" style="font-size: 40px; font-family: CircularBold, sans-serif">October 6-7, 2017</span><br/>
                                <span class="country" style="font-size: 40px; font-family: 'Circular Std', sans-serif">Kuwait</span>
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <div class="booklet-info" style="padding-right:35px;">
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <div class="booklet-text" style="padding-left: 35px; line-height: 40px; color: #fff; margin-top:40px; padding-right: 60px;">
                                            <span style="font-size: 40px; font-family: 'Circular Std', sans-serif;">
                                                Take a look at last years program.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <a href="{{asset('files/GHAESC-Book-2017.pdf')}}" download><img src="{{asset('images/booklet.png')}}" style="width: 150px;"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="about" class="animate slow-mo even fadeIn no-padding-bottom no-padding-top" data-anim-type="fadeIn" data-anim-delay="200" style="border-left: 15px solid;border-color: #D61B42; margin-bottom: 50px;">
        <div class="container">
            <div class="owl-carousel owl-theme">
                <div class="item" data-slider-id="1"><img src="{{asset('images/2017/1.jpg')}}"></div>
                <div class="item" data-slider-id="2"><img src="{{asset('images/2017/2.jpg')}}"></div>
                <div class="item" data-slider-id="3"><img src="{{asset('images/2017/3.jpg')}}"></div>
                <div class="item" data-slider-id="4"><img src="{{asset('images/2017/4.jpg')}}"></div>
                <div class="item" data-slider-id="5"><img src="{{asset('images/2017/5.jpg')}}"></div>
                <div class="item" data-slider-id="6"><img src="{{asset('images/2017/6.jpg')}}"></div>
                <div class="item" data-slider-id="7"><img src="{{asset('images/2017/7.jpg')}}"></div>
                <div class="item" data-slider-id="8"><img src="{{asset('images/2017/8.jpg')}}"></div>
                <div class="item" data-slider-id="9"><img src="{{asset('images/2017/9.jpg')}}"></div>
                <div class="item" data-slider-id="10"><img src="{{asset('images/2017/10.jpg')}}"></div>
                <div class="item" data-slider-id="11"><img src="{{asset('images/2017/11.jpg')}}"></div>
                <div class="item" data-slider-id="12"><img src="{{asset('images/2017/12.jpg')}}"></div>
                <div class="item" data-slider-id="13"><img src="{{asset('images/2017/13.jpg')}}"></div>
            </div>
            <div class="owl-thumbs"></div>
        </div>
    </section>



@stop

@section('scripts')
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/owl.carousel2.thumbs@0.1.8/dist/owl.carousel2.thumbs.min.js')}}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            thumbs: true,
            thumbsPrerendered: false,
            thumbImage: true,
            loop:true,
            dots: false,
            nav:true,
            navText: ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
            center: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
@stop




