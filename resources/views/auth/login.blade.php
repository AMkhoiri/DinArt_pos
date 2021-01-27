 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="icon" type="image/png" href="{{ asset('dinart.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login3/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login3/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login3/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login3/css/style.css') }}">

      <title>DinArt - Login</title>


      <style>

      	body{
      		background-color: #f6f6f6 !important;
      	} 

            .form-block {
                box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 11.3px 10.9px rgba(0, 0, 0, 0.072),
                0 23.8px 22.4px rgba(0, 0, 0, 0.086),
                0 40px 30px rgba(0, 0, 0, 0.12)
                ;

                border-radius: 10px;
                
              }



              .btn-primary{
                background-color: #0fbf84;
              }
                .btn-primary:hover{
                background-color: #04a972;
                /*font-weight: bold;*/
              }

              .problem:hover{
              	color: black  !important;
              }

              input{
              	font-size: 14px !important;
              }

      </style>  
  </head>
  <body>
  

  
  <div class="content pt-5">
    <div class="container">
      <div class="row justify-content-center">
        
        <div class="col-md-6 contents ">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="form-block " style="padding-top:40px; padding-bottom:40px;  padding-right: 40px; padding-left: 40px;">
                  <div class="mb-4">
                    <img src="  {{ asset('dinart/dinart.png') }} " alt="Image" width="50" class="mb-3">
                 <h4>Sign In to <strong>DinArt <span class="font-weight-normal" style="font-size: 14px;" >App</span></strong></h4>
              <p class="mb-4" style="text-transform: capitalize; font-size: 12px;">Masukkan akun sesuai akses yang anda inginkan.</p>
                </div>
                <form  class="validate-form" action="{{ route('login') }}" method="POST" >
              @csrf
                  <div class="form-group first"  data-validate = "Username is required">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control  mb-4" name="username" value="{{ old('username') }}" required autocomplete="username"  spellcheck="false" autofocus>

                          @error('username')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                    </div>
                    <div class="form-group last mb-4 "  data-validate = "Password is required">
                      <label for="password">Password</label>
                      <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror  " name="password"   required autocomplete="current-password" spellcheck="false">

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror 
                      
                    </div>

                  
                  <div class="d-flex mb-5 align-items-center" >
                    <label class="control control--checkbox mb-0" style="font-size: 12px !important;"><span class="caption" style="font-size: 12px !important;">Remember me</span>
                      <input type="checkbox" checked="checked"/>
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="#" style="font-size: 12px !important;" class="forgot-pass">Forgot Password</a></span> 
                  </div>

              <button  type="submit" class="btn btn-pill text-white btn-block btn-primary" style="font-size: 15px !important;" value="Log In">
                    {{ __('Log In') }} 
              </button>

                  {{-- <span class="d-block text-center my-4 text-muted"> or sign in with</span> --}}

                  <p class="d-block text-center my-4 text-muted ">  <a class="problem" data-toggle="tooltip" data-placement="top" title="send an email"  style="text-decoration: none; color:grey; font-size: 12px;" href="mailto:ahmad.m.khoiri@gmail.com">You have a problem?</a> </p>
                  {{-- 
                  <div class="social-login text-center">
                    <a href="#" class="facebook">
                      <span class="icon-facebook mr-3"></span> 
                    </a>
                    <a href="#" class="twitter">
                      <span class="icon-twitter mr-3"></span> 
                    </a>
                    <a href="#" class="google">
                      <span class="icon-google mr-3"></span> 
                    </a>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>


</script>

  
    <script src="{{ asset('login3/js/jquery-3.3.1.min.js') }}"></script> 
    <script src="{{ asset('login3/js/popper.min.js') }}"></script>
    <script src="{{ asset('login3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login3/js/main.js') }}"></script>

      <!-- SweetAlert2 -->
    <script src="{{asset('dinart/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @include('sweetalert::alert')

    {{-- declare bootstrap tooltip --}}
<script type="text/javascript">

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  </body>
</html>