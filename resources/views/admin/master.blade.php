<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{asset('icon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('icon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('icon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('icon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('icon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('icon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('icon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('icon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/apple-icon-180x180.png')}}"> --}}
    <link rel="icon" type="image/png" href="{{asset('icon/favicon-32x32.png')}}">
    <link rel="manifest" href="{{asset('icon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('icon/ms-icon-144x144.png')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/PACE/themes/blue/pace-theme-flash.css')}}">
    <script type="text/javascript" src="{{asset('plugins/PACE/pace.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animo.js/animate-animo.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/SpinKit/css/spinners/7-three-bounce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables.net-colreorder-bs/css/colReorder.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/css/first-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}">
  @yield('style')
    <!--[if lt IE 9]>
        <script type="text/javascript" src="{{url('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
      <script type="text/javascript" src="{{url('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
  </head>
  <body data-sidebar-color="sidebar-light" class="sidebar-light claro">
    <header>


      <a href="{{url('/')}}" class="brand pull-left"><img src="{{asset('images/Global/Zemmz_white.png')}}" alt="" width="130"></a><a href="javascript:;" role="button" class="hamburger-menu pull-left"><span></span></a>

      <ul class="notification-bar list-inline pull-right">
        <li class="visible-lg visible-md">
          <a href="{{ url('/') }}" class="btn btn-info mr-15 mt-15" target="_blank"><i class="ti-eye mr-5"></i>View Website</a>
        </li>

        <li class="dropdown visible-lg visible-md">
            <a id="dropdownMenu2" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle header-icon">
            <div class="media mt-0">
              <div class="media-right media-middle pl-0">
                  <i class="ti-settings mr-5"></i>
              </div>
            </div></a>
          <ul aria-labelledby="dropdownMenu2" class="dropdown-menu dropdown-menu-right fs-12 animated fadeInDown">
            <li><a href="{{url('admin/logout')}}"><i class="ti-power-off mr-5"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <div class="main-container">

      <aside data-mcs-theme="minimal-dark" style="background-image: url({{asset('build/images/backgrounds/14.jpg')}})" class="main-sidebar mCustomScrollbar">

        <ul class="list-unstyled navigation mb-20 mt-20">
          <li class="sidebar-category pt-0">Main</li>
          <li><a href="{{url('/admin')}}" class="bubble {{Request::is('admin') ? 'active' : Request::url()}}"><i class="ti-home"></i><span class="sidebar-title">Dashboard</span></a></li>
          <li><a href="{{url('/admin/registrations')}}" class="{{Request::is('admin/registrations*') ? 'active' : Request::url()}}"><i class="ti-user"></i><span>Registrations</span></a></li>
          <li><a href="{{url('/admin/draw')}}" class="{{Request::is('admin/draw*') ? 'active' : Request::url()}}"><i class="ti-wand"></i><span>Draw</span></a></li>
          <li><a href="{{url('/admin/evaluation')}}" class="{{Request::is('admin/evaluation*') ? 'active' : Request::url()}}"><i class="ti-bar-chart"></i><span>Evaluation</span></a></li>
          <li><a href="{{url('/admin/questions')}}" class="{{Request::is('admin/questions*') ? 'active' : Request::url()}}"><i class="ti-help-alt"></i><span>Questions</span></a></li>
          <li><a href="{{url('/admin/exhibitors')}}" class="{{Request::is('admin/exhibitors*') ? 'active' : Request::url()}}"><i class="ti-help-alt"></i><span>Exhibitors</span></a></li>


        </ul>

          <ul class="list-unstyled navigation mb-20">

              <li class="sidebar-category pt-0">Content</li>
              <li><a href="{{url('/admin/faculty')}}" class="{{Request::is('admin/faculty*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-accounts-outline"></i><span>Faculty</span></a></li>
              <li><a href="{{url('/admin/committee')}}" class="{{Request::is('admin/committee*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-accounts-outline"></i><span>Committee</span></a></li>

              <li><a href="{{url('/admin/board')}}" class="{{Request::is('admin/board*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-accounts-outline"></i><span>Board</span></a></li>

              <li><a href="{{url('/admin/program')}}" class="{{Request::is('admin/program*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-accounts-outline"></i><span>Program</span></a></li>

              <li><a href="{{url('/admin/slideshow')}}" class="{{Request::is('admin/slideshow*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-accounts-outline"></i><span>Slideshow</span></a></li>

              <li><a href="{{url('/admin/registration')}}" class="{{(Request::is('admin/registration*') && !Request::is('admin/registrations*')) ? 'active' : Request::url()}}"><i class="zmdi zmdi-account-box-o"></i><span>Registration & CME</span></a></li>
              <li><a href="{{url('/admin/message')}}" class="{{Request::is('admin/message*') ? 'active' : ''}}"><i class="zmdi zmdi-comment-more"></i><span>Message</span></a></li>
              <li><a href="{{url('/admin/blog/posts')}}" class="{{Request::is('admin/blog*') ? 'active' : ''}}"><i class="zmdi zmdi-file-text"></i><span>Blog Posts</span></a></li>
            {{-- <li><a href="{{url('/admin/schedule')}}" class="{{(Request::is('admin/schedule*') && !Request::is('admin/schedule')) ? 'active' : Request::url()}}"><i class="zmdi zmdi-calendar"></i><span>Schedule</span></a></li> --}}
            {{-- <li><a href="{{url('/admin/abstract')}}" class="{{(Request::is('admin/abstract*')) ? 'active' : Request::url()}}"><i class="zmdi zmdi-file-text"></i><span>Abstract</span></a></li> --}}
            <li><a href="{{url('/admin/page-content')}}" class="{{(Request::is('admin/page-content*')) ? 'active' : Request::url()}}"><i class="zmdi zmdi-format-size"></i><span>Page Content</span></a></li>

            <li><a href="{{url('/admin/registrants-bulk')}}" class="{{(Request::is('admin/registrants-bulk*')) ? 'active' : Request::url()}}"><i class="zmdi zmdi-format-size"></i><span>Registrants Bulk</span></a></li>
            <li><a href="{{url('/admin/case-submission')}}" class="{{Request::is('admin/case-submission*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-file-text"></i><span>Case Submission</span></a></li>

          </ul>

        <ul class="list-unstyled navigation mb-20">

          <li class="sidebar-category pt-0">Settings</li>
          <li><a href="{{url('/admin/logs')}}" class="{{Request::is('admin/logs*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-file-text"></i><span>Logs</span></a></li>
          <li><a href="{{url('/admin/settings')}}" class="{{Request::is('admin/settings*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-settings"></i><span>Settings</span></a></li>
          <li><a href="{{url('/admin/payment-gateway')}}" class="{{Request::is('admin/payment-gateway*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-settings"></i><span>Payment Gateway</span></a></li>
          <li><a href="{{url('/admin/mail')}}" class="{{Request::is('admin/mail*') ? 'active' : Request::url()}}"><i class="zmdi zmdi-settings"></i><span>Send Mail</span></a></li>
        </ul>

      </aside>
      <!-- Main Sidebar end-->
      <div class="page-container">
        <div class="page-header clearfix">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="mt-0 mb-5">@yield('title2')</h4>
              @yield('breadcrumps')
            </div>

          </div>
        </div>
        <div class="page-content container-fluid">


          @yield('content')

        </div>
      </div>

    </div>
    <!-- Demo Settings start-->

    <!-- Demo Settings end-->
    <!-- jQuery-->
    <script type="text/javascript" src="{{asset('plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap JavaScript-->
    <script type="text/javascript" src="{{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Malihu Scrollbar-->
    <script type="text/javascript" src="{{asset('plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Animo.js-->
    <script type="text/javascript" src="{{asset('plugins/animo.js/animo.min.js')}}"></script>
    <!-- Bootstrap Progressbar-->
    <script type="text/javascript" src="{{asset('plugins/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- Toastr-->
    <script type="text/javascript" src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <!-- MomentJS-->
    <script type="text/javascript" src="{{asset('plugins/moment/min/moment.min.js')}}"></script>
    <!-- jQuery BlockUI-->
    <script type="text/javascript" src="{{asset('plugins/blockUI/jquery.blockUI.js')}}"></script>
    <!-- jQuery Counter Up-->
    <script type="text/javascript" src="{{asset('plugins/jquery-waypoints/waypoints.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/Counter-Up/jquery.counterup.min.js')}}"></script>



    <!-- DataTables-->
    <script type="text/javascript" src="{{asset('plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jszip/dist/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/pdfmake/build/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/pdfmake/build/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <!-- jQuery UI-->
    <script type="text/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Custom JS-->
    <script type="text/javascript" src="{{asset('build/js/first-layout/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('build/js/first-layout/demo.js')}}"></script>
    @yield('scripts')
  </body>
</html>