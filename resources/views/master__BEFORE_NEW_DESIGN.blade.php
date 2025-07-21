<!doctype html>
<html class="no-js" lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>@yield('title', 'The Fourth Joint GHA/ESC Meeting')</title>
        <meta name="keywords" content="">
        
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="_token" content="{{ csrf_token() }}">
        <meta property="og:title" content="The Fourth Joint GHA/ESC Meeting" />
        <meta property="og:description" content="Join us at the Fourth Joint GHA/ESC Meeting. October 11-12, 2019.">
        <meta property="og:image" content="{{asset('icons/ghaesc-og.png')}}">

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
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div class="col-md-9 text-right">
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{url('/')}}" class="inner-link {{Request::is('/') ? 'active' : ''}}">Home</a></li>
                                <!--
                                <li><a href="{{url('/faculty')}}" class="inner-link {{Request::is('faculty') ? 'active' : ''}}">Faculty</a></li>
                                <li><a href="{{url('/sessions')}}" class="inner-link {{Request::is('sessions') ? 'active' : ''}}">Sessions</a></li>
                                <li><a href="{{url('/venue')}}" class="inner-link {{Request::is('venue') ? 'active' : ''}}">Venue</a></li>
                                -->
                                <li><a href="{{url('/registration')}}" class="inner-link {{Request::is('registration') ? 'active' : ''}}">Registration & CME</a></li>
                                <li><a href="{{url('/past-meetings')}}" class="inner-link {{Request::is('past-meetings') ? 'active' : ''}}">Past Meetings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')


        <footer>
            <div class="container-fluid footer-bottom">
                <div class="container">
                    <div class="row margin-three">
                        <div class="col-md-6 col-sm-12 col-xs-12 copyright text-left letter-spacing-1 sm-text-center">
                            <img src="{{asset('icons/favicon-96x96.png')}}" style="width:30px;"> Copyright© 2019 The Fourth Joint GHA/ESC Meeting.
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 copyright text-right letter-spacing-1 sm-text-center xs-margin-bottom-one">
                            Meeting Organized by <a href="{{url('http://zawaya.me')}}" target="_blank"><img src="{{asset('images/z-red.png')}}" style="width: 30px;"></a>
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
        <script type="text/javascript" src="{{asset('js/main.js')}}"></script>

        @yield('scripts')

    </body>
</html>
