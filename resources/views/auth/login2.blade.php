<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('dinart.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login2/fonts/icomoon/style.css') }} ">

    <link rel="stylesheet" href="{{ asset('login2/css/owl.carousel.min.css') }} "> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login2/css/bootstrap.min.css') }} ">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login2/css/style.css') }} ">

    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/fontawesome-free/css/all.min.css')}}"> 

    <title>DinArt - Login</title>

    <style>
      .btn-primary{
        background-color: #017932 !important;
        border-radius: 25px;
        transition: all 0.3s ease 0s;
      }

       .btn-primary:hover{
          letter-spacing: 1px;
       }

      body{
        background-color: #ffffff;
      }

       input{ font-size: 13px !important; }




    </style>
  </head>
  <body>

  <div class="content pt-5" >
    <div class="container  pt-2 mt-0">
      <div class="row ">
        <div class="col-md-6 contents  mb-4" >
          {{-- <img src="  {{ asset('login2/images/log.png') }} " alt="Image" class="img-fluid"> --}}
          {{-- <img src="  {{ asset('dinart/dinart.png') }}  " alt="Image" width="220" class="img-fluid"> --}}


          <div class="row justify-content-center ">
            <div class="col-md-8 ">
              <div class="mb-4">
                 <img src="  {{ asset('dinart/dinart.png') }} " alt="Image" width="100" class="mb-4">
              <h3>Sign In to <strong>DinArt <span class="font-weight-normal" style="font-size: 16px;" >App</span></strong></h3>
              {{-- <p class="mb-4" style="text-transform: capitalize; font-size: 14px;">Masukkan akun sesuai akses yang anda inginkan.</p> --}}
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
                {{-- <i class="fas fa-eye form-control-feedback" style="cursor: pointer; color: #2c71da;"  onclick="seePassword()"></i> --}}

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
              </div>


              <button  type="submit" class="btn text-white pr-5 pl-5 btn-sm btn-primary btn-block" style="margin-top: 40px !important;" value="Log In">
              {{ __('Log In') }} <span class="fas fa-arrow-right ml-1" style="font-size: 13px;" ></span>
            </button>

            </form>

            </div>
          </div>
        </div>
        <div class="col-md-6   mt-0 ">
          
            <img src="  {{ asset('login2/images/log.png') }} " alt="Image" class="img-fluid">
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="{{ asset('login2/js/jquery-3.3.1.min.js') }} "></script>
    <script src="{{ asset('login2/js/popper.min.js') }} "></script>
    <script src="{{ asset('login2/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('login2/js/main.js') }} "></script>

    <!-- SweetAlert2 -->
    <script src="{{asset('dinart/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @include('sweetalert::alert')


    <script>
      function seePassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>


  </body>





</html>