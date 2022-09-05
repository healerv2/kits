@include('frontend.header')
<body>
  <div id="app">
    @yield('content')
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
              {{-- <div class="login-brand">
                <a href="{{ url('/') }}">
                  <img src="{{ url($settings->path_logo) }}" alt="logo" width="200">
                </a>
              </div> --}}
              <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
              @endif
              <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                  <label for="email" >Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"autocomplete="email" tabindex="1" required autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @else
                  <div class="invalid-feedback" role="alert">
                    Please fill in your email
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                  <div class="d-block">
                   <label for="password" class="control-label">Password</label>
                   <div class="float-right">
                    <a href="{{ route('password.request') }}" class="text-small">
                      Lupa Password?
                    </a>
                  </div>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @else
                <div class="invalid-feedback">
                  Please fill in your password
                </div>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-5 text-muted text-center">
          Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@include('frontend.footer')
</body>
</html>