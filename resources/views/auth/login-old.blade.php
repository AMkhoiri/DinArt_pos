<!DOCTYPE html>
<html lang="en">
<head>
	<title>dinArt - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('login_template/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/bootstrap/css/bootstrap.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/animate/animate.css') }} ">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/css-hamburgers/hamburgers.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/animsition/css/animsition.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/select2/select2.min.css') }} ">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/vendor/daterangepicker/daterangepicker.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/css/util.css') }} ">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_template/css/main.css') }} ">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w"  method="POST" action="{{ route('login') }}">
					 @csrf
					<span class="login100-form-title p-b-51">
						Login
						<h6 style="" >dinArt</h6>
					</span>



					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input id="username" type="text" class="input100 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" spellcheck="false" autofocus>
						<span class="focus-input100"></span>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" spellcheck="false">
						<span class="focus-input100"></span>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
					</div>

					
					
					
					
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							{{ __('Login') }}
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/jquery/jquery-3.2.1.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/animsition/js/animsition.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/bootstrap/js/popper.js') }} "></script>
	<script src="{{ asset('login_template/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/select2/select2.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/daterangepicker/moment.min.js') }} "></script>
	<script src="{{ asset('login_template/vendor/daterangepicker/daterangepicker.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/vendor/countdowntime/countdowntime.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_template/js/main.js') }} "></script>


	@include('sweetalert::alert')

</body>
</html>