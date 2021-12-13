<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>We Access</title>

  <!-- Favicons -->
  <link href="{{asset('Dashio/img/favicon.png')}}" rel="icon">
  <link href="{{asset('Dashio/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="{{asset('Dashio/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!--external css-->
  <link href="{{asset('Dashio/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{asset('Dashio/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('Dashio/css/style-responsive.css')}}" rel="stylesheet">
  
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
        <div class="container">
            <form method="POST" action="{{ route('login') }}" class="form-login">
                @csrf
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control" placeholder="User ID">
                    <br>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    <br>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                    <hr>
                </div>
            </form>
        </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('Dashio/lib/jquery/jquery.min.js')}}"></script>
  <script src="l{{asset('Dashio/ib/bootstrap/js/bootstrap.min.js')}}"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="{{asset('Dashio/lib/jquery.backstretch.min.js')}}"></script>
  <script>
    $.backstretch("{{asset('Dashio/img/login-bg.jpg')}}", {
      speed: 500
    });
  </script>
</body>

</html>
