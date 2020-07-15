{{-- @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Login') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="form-group row">
							<label for="username" class="col-md-4 col-form-label text-md-right">Username or Email</label>

							<div class="col-md-6">
								<input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

								@error('username')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

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

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Login') }}
								</button>

								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection --}}

{{-- @section('content')	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form  action="{{ route('login') }}" method="POST" class="login100-form validate-form" >
					{{ csrf_field() }}

					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username">
						<span class="focus-input100"></span>
						<span class="label-input100" for="username">Email or Username</span>

						@error('username')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
						@enderror

					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" id="password" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100" for="password">Password</span>

						@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
						@enderror

					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1" {{ old('remember') ? 'checked' : '' }}>
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type=submit class="login100-form-btn">
							Login
						</button>
					</div>
					
				</form>

					<div class="login100-more" style="background-image: url('img/products/cappucino.jpg');">
				</div>
			</div>
		</div>
	</div>
@endsection --}}

@extends('layouts.new')
@section('content')

<meta charset="utf-8">

<style>
	*{
	box-sizing: border-box;
}
body{
	margin: 0;
	height: 100vh;
	width: 100vw;
	overflow: hidden;
	font-weight: 700;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #555;
	background: #ecf0f3;
}
.login-div{
	width: 430px;
	height: 700px;
	padding: 60px 35px 35px 35px;
	border-radius: 40px;
	background: #ecf0f3;
	box-shadow: 13px 13px 20px #cbced1,
				-13px -13px  20px #ffffff;
}
.logo {
  background:url('img/logocafe.png');
  width:100px;
  height: 100px;
  border-radius: 50%;
  margin:0 auto;
  box-shadow: 
  /* logo shadow */
  0px 0px 2px #5f5f5f,
  /* offset */
  0px 0px 0px 5px #ecf0f3,
  /*bottom right */
  8px 8px 15px #a7aaaf,
  /* top left */
  -8px -8px 15px #ffffff
  ;
}
.title {
  text-align: center;
  font-size: 28px;
  padding-top: 24px;
  letter-spacing: 0.5px;
}
.sub-title {
  text-align: center;
  font-size: 15px;
  padding-top: 7px;
  letter-spacing: 3px;
}
.fields {
  width: 100%;
  padding: 75px 5px 5px 5px;
}
.fields input {
  border: none;
  outline:none;
  background: none;
  font-size: 18px;
  color: #555;
  padding:20px 10px 20px 5px;
}
.username, .password {
  margin-bottom: 30px;
  border-radius: 25px;
  padding-left: 20px;
  box-shadow: inset 8px 8px 8px #cbced1,
              inset -8px -8px 8px #ffffff;
}
.fields svg {
  height: 22px;
  margin:0 10px -3px 25px;
}
.signin-button {
  outline: none;
  border:none;
  cursor: pointer;
  width:100%;
  height: 60px;
  border-radius: 30px;
  font-size: 20px;
  font-weight: 700;
  font-family: 'Lato', sans-serif;
  color:#fff;
  text-align: center;
  background: #24cfaa;
  box-shadow: 3px 3px 8px #b1b1b1,
              -3px -3px 8px #ffffff;
  transition: 0.5s;
}
.signin-button:hover {
  background:#2fdbb6;
}
.signin-button:active {
  background:#1da88a;
}
.link {
  padding-top: 20px;
  text-align: center;
}
.link a {
  text-decoration: none;
  color:#aaa;
  font-size: 15px;
}
</style>

<form  action="{{ route('login') }}" method="POST" >
	{{ csrf_field() }}
		
		<div class="login-div">
			<div class="logo"></div>
		  		<div class="title">Dalgona Coffee</div>
		  		<div class="sub-title">Cafe</div>
		  	<div class="fields">
			    <div class="username">
			    	<i class="fa fa-user" aria-hidden="true"><input type="username" id="username" name="username" placeholder="username or email"  value="{{ old('username') }}" required autocomplete="off"/></i>

			    	@error('username')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
					@enderror

			    </div>
			    
			    <div class="password">
			    	<i class="fa fa-lock" aria-hidden="true"><input type="password" placeholder="password"  id="password" name="password"/></i>

			    	@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
					@enderror

			    </div>
		  	</div>
		  
		  <button class="signin-button">Login</button>
		  
		  <div class="link">
		    <a href="#">Forgot password?</a> or <a href="#">Sign up</a>
		  </div>
		
		</div>
</form>
@endsection