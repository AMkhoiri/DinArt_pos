 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login3/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login3/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login3/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login3/css/style.css') }}">

      <title>DinArt - Login</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <!-- <div class="col-md-6 order-md-2">
          <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div> -->
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="form-block ">
                  <div class="mb-4">
                 <h3>Sign In to <strong>DinArt <span class="font-weight-normal" style="font-size: 16px;" >App</span></strong></h3>
              <p class="mb-4" style="text-transform: capitalize; font-size: 14px;">Masukkan akun sesuai akses yang anda inginkan.</p>
                </div>
                <form  class="validate-form" action="{{ route('login') }}" method="POST" >
              @csrf
                  {{-- <div class="form-group first">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username">

                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password">
                    
                  </div> --}}


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

                  
                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                      <input type="checkbox" checked="checked"/>
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                  </div>

                  {{-- <input type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-primary"> --}}
              <button  type="submit" class="btn btn-pill text-white btn-block btn-primary"{{--  style="margin-top: 40px !important;" --}} value="Log In">
                    {{ __('Log In') }} 
                    
              </button>

                  <span class="d-block text-center my-4 text-muted"> or sign in with</span>
                  
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
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>


  
    <script src="{{ asset('login3/js/jquery-3.3.1.min.js') }}"></script> 
    <script src="{{ asset('login3/js/popper.min.js') }}"></script>
    <script src="{{ asset('login3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login3/js/main.js') }}"></script>

      <!-- SweetAlert2 -->
    <script src="{{asset('dinart/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @include('sweetalert::alert')
  </body>
</html>