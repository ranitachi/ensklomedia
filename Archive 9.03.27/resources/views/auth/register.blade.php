<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pendaftaran - Ensiklomedia</title>
        <meta name="keywords" content="ensiklomedia" />
        <meta name="description" content="Ensiklomedia">
        <meta name="author" content="Pustekkom Kemdikbud RI">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Owl Carousel Assets -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  type="text/css" />

        <!--Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,700|Roboto:300,400,500,700,900|Ubuntu:300,300i,400,400i,500,500i,700" rel="stylesheet">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="sing-up-page">
      <!--======= log_in_page =======-->
      <div id="log-in" class="site-form log-in-form">
      
      	<div id="log-in-head">
        	<h1>Sign Up</h1>
            <div id="logo"><a href="http://ensiklomedia.tve.kemdikbud.go.id/"><img src="{{ asset('assets/img/logo.png')}}" alt=""></a></div>
        </div>
        
        <div class="form-output">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Your Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Your Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
                
                <div class="form-group label-floating">
                    <label class="control-label">Confirm Your Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                
                <div class="remember">
                    <div class="checkbox">
                        <label>
                            <input name="optionsCheckboxes" type="checkbox">
                            Saya setuju dengan syarat dan ketentuan dari penggunaan Ensiklomedia.
                        </label>
                    </div>
                </div>
                
            <button type="submit" class="btn btn-lg btn-primary full-width">Daftar Sekarang!</button>

            <div class="or"></div>

                    <div class="row">
                        <a href="#" class="btn btn-lg bg-facebook col-lg-6 col-md-6 col-sm-6 col-xs-6 btn-icon-left"><i class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>
                        <a href="{{ url('login/google')}}" class="btn btn-lg bg-google col-lg-6 col-md-6 col-sm-6 col-xs-6 btn-icon-left"><i class="fa fa-google" aria-hidden="true"></i>Login with Google</a>
                    </div>
                    <p>Sudah Memiliki Akun ? <a href="{{URL::to('login')}}"> Login Disini!</a> </p>
                </form>
            </div>
      </div>
      <!--======= // log_in_page =======-->
	</body>


</html>
