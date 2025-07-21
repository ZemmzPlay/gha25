<!DOCTYPE html>
<html lang="en" style="height: 100%">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | GHAESC</title>
    <!-- PACE-->
    <link rel="stylesheet" type="text/css" href="../plugins/PACE/themes/blue/pace-theme-flash.css">
    <script type="text/javascript" src="../plugins/PACE/pace.min.js"></script>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="../plugins/bootstrap/dist/css/bootstrap.min.css">
    <!-- Fonts-->
    <link rel="stylesheet" type="text/css" href="../plugins/themify-icons/themify-icons.css">
    <!-- Primary Style-->
    <link rel="stylesheet" type="text/css" href="../build/css/first-layout.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://--> 
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

    <body style="/*background-image: url(../build/images/backgrounds/zawaya_office.jpg)*/ background-color: #F5fafa;" class="body-bg-full v2">
        <div class="container page-container">
            <div class="page-content">
                <div class="v2">
                    <div class="logo"><img src="{{asset('build/images/logo/Zemmz_blue.png')}}" alt="" style="max-width: 250px;"></div>
                    <p style="
                        font-weight: bolder;
                        color: #000232;
                        font-size: small;
                    ">Your online event management system
                    </p>
                        <form method="post" class="form-horizontal">
                            @if(count($errors) > 0)
                                <div class="alert alert-danger col-md-12">
                                    @if(count($errors) == 1)
                                        {{$errors->first()}}
                                    @else
                                        The following errors happened:
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif

                            {{csrf_field()}}


            <div class="form-group">
              <div class="col-xs-12">
                <input type="email" placeholder="E-mail" class="form-control" name="email" value="{{old('email')}}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <input type="password" placeholder="Password" class="form-control" name="password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <div class="checkbox-inline checkbox-custom pull-left">
                  <input id="exampleCheckboxRemember" type="checkbox" value="remember">
                  <label for="exampleCheckboxRemember" class="checkbox-muted text-muted">Remember me</label>
                </div>
                <div class="pull-right"><a href="#" class="inline-block form-control-static">Forgot your password?</a></div>
              </div>
            </div>
            <button type="submit" class="btn-lg btn btn-primary btn-rounded btn-block">Sign in</button>
          </form>


        </div>
      </div>
    </div>

    <!-- jQuery-->
    <script type="text/javascript" src="../plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap JavaScript-->
    <script type="text/javascript" src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>