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
							<div class="card-header"><h4>Masukan Kode 2FA Ya Bestie !!!</h4></div>

							<div class="card-body">
								@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
								@endif
								<form method="POST" action="{{ route('two-factor.login') }}">
									@csrf
									<div class="form-group">
										<label for="email">Code 2FA</label>
										<input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">

										@error('code')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Submit
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