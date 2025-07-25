<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <?php
  ///// config /////
  if (!isset($configuration)) {
      $configuration = App\Configuration::first();
  }
  ///// config /////
  ?>

  <title>@yield('title', $configuration->website_title)</title>
  <meta name="keywords" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
  <meta name="_token" content="{{ csrf_token() }}">
  {{-- <meta property="og:title" content="The Fourth Joint GHA/ESC Meeting" /> --}}
  <meta property="og:title"
    content="{{ isset($configuration) && isset($configuration->website_title) ? $configuration->website_title : '15th GHA Meeting in Collaboration with KHF | Kuwait December 2023' }}" />
  {{-- <meta property="og:description" content="Join us at the Fourth Joint GHA/ESC Meeting. October 11-12, 2019."> --}}
  <meta property="og:image" content="{{ asset('images/' . $configuration->logo) }}">
  {{-- <meta property="og:image" content="{{asset('icons/ghaesc-og.png')}}"> --}}

  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('metas')

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('icons/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('icons/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('icons/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('icons/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('icons/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icons/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('icons/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icons/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-icon-180x180.png') }}">
  <!-- <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('icons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('icons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}"> -->
  <link rel="icon" type="image/png" href="{{ asset('icons/1Artboard1.png') }}">
  <link rel="manifest" href="{{ asset('icons/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('icons/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/colors.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css?ver=1.1') }}" />

  @yield('style')
</head>

<body>
  <header>
    <div class="header-content">
      @if ($configuration->logo != '')
        <a href="{{ url('/') }}">
          <img class="logo" src="{{ asset('images/' . $configuration->logo) }}" alt="Logo" />
        </a>
      @endif
      <nav id="desktop-menu">
        <ul>
          <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'menu-active' : '' }}">home</a></li>
          <!-- <li><a href="{{ url('/terms-and-conditions') }}" class="{{ request()->is('terms-and-conditions') ? 'menu-active' : '' }}">terms & conditions</a></li> -->
          @if (Settings::get('facutlyEnableDisable'))
            <li><a href="{{ url('/faculty') }}"
                class="{{ request()->is('faculty') ? 'menu-active' : '' }}">faculty</a></li>
          @endif
          <li><a href="{{ url('/blog') }}"
              class="{{ request()->is('blog') || request()->is('post/*') ? 'menu-active' : '' }}">News</a></li>
          <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'menu-active' : '' }}">about</a></li>
          <li><a href="{{ url('/program') }}" class="{{ request()->is('program') ? 'menu-active' : '' }}">program</a>
          </li>
          <li><a href="{{ url('/location') }}" class="{{ request()->is('location') ? 'menu-active' : '' }}">where</a>
          </li>
          {{-- <li><a href="{{ url('/abstracts') }}" class="{{ request()->is('abstracts') ? 'menu-active' : '' }}">abstracts</a></li> --}}
          <!-- <li><a href="{{ url('/more-info') }}" class="{{ request()->is('more-info') ? 'menu-active' : '' }}">more info</a></li> -->
          @if (Auth::guard('web')->check())
            @if ($configuration->enableLiveConference)
              <li><a href="{{ url('/watch-live') }}"
                  class="{{ request()->is('watch-live') ? 'menu-active' : '' }}">watch here</a></li>
            @endif
            <li><a href="{{ url('/logout') }}">logout</a></li>
          @else
            <li><a href="{{ url('/login') }}" class="{{ request()->is('login') ? 'menu-active' : '' }}">login</a>
            </li>
            <li><a href="{{ Route::currentRouteName() == 'pages.index' ? '#' : url('/') . '#register' }}"
                class="special-menu-last slideToRegisterMenu">register now <svg width="23" height="24"
                  viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.7947 5.25096C12.1876 4.858 12.8248 4.858 13.2177 5.25096L19.2552 11.2885C19.6482 11.6814 19.6482 12.3185 19.2552 12.7115L13.2177 18.749C12.8248 19.142 12.1876 19.142 11.7947 18.749C11.4017 18.356 11.4017 17.7189 11.7947 17.326L16.1144 13.0062L4.4562 13.0062C3.90047 13.0062 3.44995 12.5557 3.44995 12C3.44995 11.4442 3.90047 10.9937 4.4562 10.9937H16.1144L11.7947 6.67401C11.4017 6.28105 11.4017 5.64393 11.7947 5.25096Z"
                    fill="white" />
                </svg>
              </a></li>
          @endif


        </ul>
      </nav>
      <div id="mobile-menu">
        <div class="menu-icon">
          <div></div>
          <div></div>
          <div></div>
        </div>
        <nav class="sliding-menu">
          <div class="sliding-menu-in">
            <a class="back-icon" href="#">
              <i class="fa-solid fa-chevron-left"></i>
            </a>
            <ul>
              @if (!Auth::guard('web')->check())
                <li><a href="{{ Route::currentRouteName() == 'pages.index' ? '#' : url('/') . '#register' }}"
                    class="slideToRegisterMenuMobile">register now</a></li>
              @endif

              <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'menu-active' : '' }}">home</a></li>
              <!-- <li><a href="{{ url('/terms-and-conditions') }}" class="{{ request()->is('terms-and-conditions') ? 'menu-active' : '' }}">terms & conditions</a></li> -->
              @if (Settings::get('facutlyEnableDisable'))
                <li><a href="{{ url('/faculty') }}"
                    class="{{ request()->is('faculty') ? 'menu-active' : '' }}">faculty</a></li>
              @endif
              <li><a href="{{ url('/blog') }}"
                  class="{{ request()->is('blog') || request()->is('post/*') ? 'menu-active' : '' }}">News</a></li>
              <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'menu-active' : '' }}">about</a>
              </li>
              <li><a href="{{ url('/program') }}"
                  class="{{ request()->is('program') ? 'menu-active' : '' }}">program</a></li>
              <li><a href="{{ url('/location') }}"
                  class="{{ request()->is('location') ? 'menu-active' : '' }}">where</a></li>
              {{-- <li><a href="{{ url('/abstracts') }}" class="{{ request()->is('abstracts') ? 'menu-active' : '' }}">abstracts</a></li> --}}
              <!-- <li><a href="{{ url('/more-info') }}" class="{{ request()->is('more-info') ? 'menu-active' : '' }}">more info</a></li> -->

              @if (Auth::guard('web')->check())
                @if ($configuration->enableLiveConference)
                  <li><a href="{{ url('/watch-live') }}"
                      class="{{ request()->is('watch-live') ? 'menu-active' : '' }}">watch here</a></li>
                @endif
                <li><a href="{{ url('/logout') }}">logout</a></li>
              @else
                <li><a href="{{ url('/login') }}"
                    class="{{ request()->is('login') ? 'menu-active' : '' }}">login</a></li>
              @endif

            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>

  @yield('content')


  <footer>
    {{-- <div class="footerTopLine"></div>
    <div class="footerLogos">
      <img src="{{ asset('images/global/gulfHeartAssociation.png') }}" alt="Gulf Heart Association" />
      <img src="{{ asset('images/global/kuwaitHeartFoundation.png') }}" alt="Kuwait Heart Foundation" />
    </div> --}}
    <div class="footerBottom">
      <div class="footerText">© Gulf Heart Association 2025 -3rd gha scai shock middle east conference.</div>
      <div class="byData">
        <div class="organizedBy">
          <div class="organizedByText">Meeting organized by</div>
          <div><img src="{{ asset('images/global/Zawaya_white.png') }}" alt="Zawaya Conferences" /></div>
        </div>
        <div style="font-size: 25px;">
          |
        </div>
        <div class="builtOn">
          <div class="builtOnText">Built on</div>
          <div><img src="{{ asset('images/global/Zemmz_white.png') }}" alt="Zemmz" /></div>
        </div>
      </div>
    </div>
  </footer>


  <script type="text/javascript" src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

  @yield('scripts')

</body>

</html>
