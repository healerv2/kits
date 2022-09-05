@include('frontend.header')
@yield('content')
<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<a href="{{ url('/') }}">
								<img src="{{ url($settings->path_logo) }}" alt="logo" width="100" class="shadow-light rounded-circle">
							</a>
						</div>

						<div class="card card-primary">
							<div class="card-header"><h4>Reset Password</h4></div>

							<div class="card-body">
								@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
								@endif
								<p class="text-muted">We will send a link to reset your password</p>
								<form method="POST"  action="{{ route('password.update') }}">
									@csrf
									<input type="hidden" name="token" value="{{ $request->route('token') }}">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
										name="email" value="{{ $request->email ?? old('email') }}" required autocomplete="email" readonly autofocus placeholder="Masukkan Alamat Elamil">
										@error('email')
										<div class="alert alert-danger mt-2">
											<strong>{{ $message }}</strong>
										</div>
										@enderror
									</div>

									<div class="form-group">
										<label for="password">Password</label>
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
										name="password" required autocomplete="new-password" placeholder="Masukkan Password Baru">
										@error('password')
										<div class="alert alert-danger mt-2">
											<strong>{{ $message }}</strong>
										</div>
										@enderror
									</div>

									<div class="form-group">
										<label for="password-confirm">Konfirmasi Password</label>
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation"
										required autocomplete="new-password" placeholder="Masukkan Konfirmasi Password Baru">
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Reset Password
										</button>
									</div>
								</form>
							</div>
						</div>
						@include('frontend.copyright')
					</div>
				</div>
			</div>
		</section>
	</div>
	@include('frontend.footer')
</body>
</html>