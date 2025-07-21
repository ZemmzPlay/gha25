<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>@yield('title', 'The Second Joint GHA/ESC Meeting')</title>
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="_token" content="{{ csrf_token() }}">


    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('icons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('icons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('icons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('icons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('icons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('icons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('icons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('icons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('icons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('icons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('icons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{asset('css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/et-line-icons.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/extralayers.css')}}" />
    <link rel="stylesheet" href="{{asset('css/settings.css')}}" />
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('css/full-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('css/text-effect.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
    <!--[if IE]>
    <link rel="stylesheet" href="{{asset('css/style-ie.css')}}" />
    <![endif]-->
    <!--[if IE]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <![endif]-->

    <style>
        tr td:first-child {
            font-size: 12px;
        }

        ::-webkit-scrollbar { width:3px }
        ::-webkit-scrollbar-track { -webkit-box-shadow: none; -moz-box-shadow:none; box-shadow:none; }
        ::-webkit-scrollbar-thumb { background:#D61B42; -webkit-box-shadow:none; -moz-box-shadow:none; box-shadow:none; }
        ::-webkit-scrollbar-thumb:window-inactive { background:rgba(210,210,210,.4) }

        /* jQuery Countdown styles 1.6.3. */
        .hasCountdown {
            border: 1px solid #fff;
            overflow: auto;
            padding: 20px 0;
        }
        .countdown_rtl {
            direction: rtl;
        }
        .countdown_holding span {
            color: #fff;
        }
        .countdown_row {
            clear: both;
            width: 100%;
            padding: 0px 2px;
            text-align: center;
        }
        .countdown_show1 .countdown_section {
            width: 98%;
        }
        .countdown_show2 .countdown_section {
            width: 48%;
        }
        .countdown_show3 .countdown_section {
            width: 32.5%;
        }
        .countdown_show4 .countdown_section {
            width: 24.5%;
        }
        .countdown_show5 .countdown_section {
            width: 19.5%;
        }
        .countdown_show6 .countdown_section {
            width: 16.25%;
        }
        .countdown_show7 .countdown_section {
            width: 14%;
        }
        .countdown_section {
            display: block;
            float: left;
            font-size: 26px;
            text-align: center;
        }
        .countdown_amount {
            font-size: 200%;
        }
        .countdown_descr {
            display: block;
            width: 100%;
        }

    </style>

    @yield('style')
    @routes()
</head>
<body>



<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom no-transition" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <a class="logo-light" href="{{url('/')}}"><img alt="" src="{{asset('images/ghaesc-logo.png')}}" class="logo" /></a>
                <a class="logo-dark" href="{{url('/')}}"><img alt="" src="{{asset('images/ghaesc-logo.png')}}" class="logo" /></a>
            </div>
        </div>
    </div>
</nav>



<section id="about" class="home-section about animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container" style="padding-top:0 !important;">
        <div class="main-banner" style="border-left:15px solid; border-color: #D61B42;">
            <div class="text-container" style="background: url({{asset('images/home-bg.png')}}) right center no-repeat; margin-left:20px;">

                <div class="row">
                    <div class="col-md-6 col-sm-6 title-section">
                        <h1 class="section-title white-text" style="font-family: 'CircularBlack', sans-serif">
                            The Second Joint<br/>
                            GHA/ESC Meeting<br/>
                            <span class="date">October 12-13, 2018</span>
                        </h1>
                    </div>

                    <div class="col-md-6">
                        <div class="maintenance-section" style="width: 100%;padding: 20px;background: rgba(190, 30, 38, 0.74);">
                            <p>As you can the mess around, we are busy arranging stuff, moving things around, and getting your registration forms ready for you.</p>
                            <p>We will be ready to have you here again in:</p>
                            <div id="defaultCountdown"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section id="sponsors" class="sponsors animate slow-mo even fadeIn no-padding-bottom no-padding-top main-section" data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container" style="padding-top:0 !important;">
        <div class="logos" style="border-left:15px solid #D61B42; padding-left: 35px;">
            <div class="row">
                <div class="col-sm-6 sponsors-group">
                    <h3 class="section-title" style="font-family: CircularBook, sans-serif; font-size: 20px;">Supported by:</h3>
                    <div class="row">
                        <div class="col-sm-4 col-xs-6 text-center sponsor"><a href=" http://www.gulfheart.org" target="_blank"><img src="{{asset('images/sponsors/gha.png')}}"></a></div>
                        <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/esc.png')}}"></a></div>
                    </div>
                </div>
                <div class="col-sm-6 sponsors-group">
                    <h3 class="section-title" style="font-family: CircularBook, sans-serif; font-size: 20px;">Supported by:</h3>
                    <div class="row">
                        <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/sanofi.png')}}"></a></div>
                        <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/novartis.png')}}"></a></div>
                        <div class="col-sm-4 col-xs-6 text-center sponsor"><a href="http://www.escardio.org" target="_blank"><img src="{{asset('images/sponsors/AstraZeneca.png')}}"></a></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>



<footer>
    <div class="container-fluid footer-bottom">
        <div class="container">
            <div class="row margin-three">
                <div class="col-md-6 col-sm-12 col-xs-12 copyright text-left letter-spacing-1 sm-text-center">
                    <img src="{{asset('icons/favicon-96x96.png')}}" style="width:30px;"> Copyright© 2018 The Second Joint GHA/ESC Meeting.
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 copyright text-right letter-spacing-1 sm-text-center xs-margin-bottom-one">
                    Meeting Organized by <img src="{{asset('images/z-black.png')}}" style="width: 15px;">
                </div>
            </div>

        </div>
    </div>
    <a href="javascript:;" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
</footer>


<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-hover-dropdown.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/skrollr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.viewport.mini.js')}}"></script>
<script type="text/javascript" src="{{asset('js/smooth-scroll.js')}}"></script>

<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ2DF6uahY5rublsPwcbkTJXEHnv0c6g0&sensor=false&#038;ver=3.0'></script>

<script type="text/javascript" src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/page-scroll.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popup-gallery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/text-effect.js')}}"></script>
<script type="text/javascript" src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script type="text/javascript">
    $(function()
    {
        var austDay = new Date();
        austDay = new Date(2018 , 7, 4, 12, 0);
        $('#defaultCountdown').countdown(
            {
                until: austDay
            });
        $('#year').text(austDay.getFullYear());
    });
</script>

@yield('scripts')

</body>
</html>
