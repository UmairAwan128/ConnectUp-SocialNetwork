<!DOCTYPE html>

<html>
<head>
 
<!--
      ==============================================
      Title and Meta Tags
      ===============================================
    -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignIn</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />

    		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.html">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.html">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.html">

        <link href="{{ asset('img/logo.html') }}" rel="stylesheet">
    
	    <!-- ==============================================
		CSS
		=============================================== -->
     
        <link type="text/css" href="{{ asset('css/demos/photo.css') }}" rel="stylesheet">
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
        {{-- <script src="{{ asset('js/modernizr-custom.html') }}" defer></script> --}}
   
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    
</head>


<body>

<section class="login">
      <div class="container">
        <div class="banner-content">

            <h1>C<i class="fa fa-smile"></i>nnectUp</h1>

          <h3 class="form-signin-heading">Please sign in</h3>

          <form method="POST" class="form-signin" action="{{ route('login') }}">
            @csrf


            <div class="form-group">
                
                <input id="email" value="usawan@gmail.com" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span style="color:white;"  class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            
            </div>
  
            <div class="form-group">
                
                <input value="123456789" id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span style="color:white;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
  

              <button
                class="kafe-btn kafe-btn-mint btn-block"
                type="submit"
                name="login"
                id="signin"
                style="margin-bottom:10px;"
                >
                Sign in
              </button>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
             </div>

              <a class="btn btn-dark " href="{{ route('register') }}" role="button"
                >Don't have an account yet? Register Here.</a
              >

              @if (Route::has('password.request'))
                <a class="btn btn-dark" class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif

        </form>

        </div>
        <!-- /. banner-content -->
      </div>
      <!-- /.container -->
    </section>

</body>
</html>






