
<!DOCTYPE html>
<html>
<head>
    	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SignUp</title>
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
       <div class="banner-content" style="margin-top: 40px;">
	   
        <h1>C<i class="fa fa-smile"></i>nnectUp</h1>
         <h3 class="form-signin-heading">Please register</h3>

        <form method="POST" action="{{ route('register') }}"  class="form-signin">
          
            @csrf

           <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                    <input name="f_name" type="text" placeholder="First Name" class="form-control" value="" required autofocus>
                </div>
          
              </div> 
                <div class="col-lg-6">
                  <div class="form-group">
                    <input name="l_name" type="text" placeholder="Last Name" class="form-control" value="" required>
                </div>
              </div> 
           </div>
           
           <div class="form-group">
               <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

               @if ($errors->has('email'))
                   <span class="invalid-feedback" role="alert">
                       <strong  style="color:white;" >{{ $errors->first('email') }}</strong>
                   </span>
               @endif

      
            </div>
        
           <div class="form-group">
             <input id="password" type="password" value="123456789" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

             @if ($errors->has('password'))
                 <span class="invalid-feedback" role="alert">
                     <strong style="color:white;">{{ $errors->first('password') }}</strong>
                 </span>
             @endif
     
            </div>
     
            <div class="form-group">
                <input id="password-confirm" type="password" value="123456789" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
            </div>
        
           <div class="form-group">
           <select class="form-control" id="countryDropDown" name="country" required="required">
            @if(count($countries) > 0)
                <option disabled>Select Country</option>
                @foreach($countries as $country)
                {{-- reset($countries)  gets the first element of the array --}}
                    @if($country === reset($countries))  
                          <option selected id="{{$country->id}}">{{$country->name}}</option>
                    @else
                          <option id="{{$country->id}}">{{$country->name}}</option>   
                    @endif  
                @endforeach
           @else
              <option disabled>No Countires Found</option>
           @endif
           
             </select>
            </div>
            
            <div class="form-group">
                <select class="form-control" name="gender" required="required">
                    @if(count($genders) > 0)
                        <option disabled>Select Gender</option>
                    @foreach($genders as $gender)
                 {{-- reset($genders)  gets the first element of the array --}}
                          @if($gender === reset($genders))  
                             <option selected id="{{$gender->id}}">{{$gender->name}}</option>
                          @else
                             <option id="{{$gender->id}}">{{$gender->name}}</option>
                          @endif
                    @endforeach
                    @else
                      <option disabled>No Genders Found</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="date" id="birthday" name="birthday" class="form-control" placeholder="your BirthDay" required="required"/>
            </div>
           
	       <button type="submit" class="kafe-btn kafe-btn-mint btn-block">
            {{ __('Sign Up') }}
           </button>
	   </form>   
           <a class="btn btn-dark " href="signin.php" role="button">Already have an account? Click Here.</a>

    </div><!--/. banner-content -->
      </div><!-- /.container -->
     </section> 
</body>

</html>
