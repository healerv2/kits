@include('frontend.header')
@yield('content')
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <a href="{{ url('/') }}">
                <img src="{{ url($settings->path_logo) }}" alt="logo" width="100" class="shadow-light rounded-circle">
              </a>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @else
                    <div class="invalid-feedback" role="alert">
                      Please fill in your name
                    </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
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

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" required autocomplete="new-password" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password-confirm" class="d-block">Password Confirmation</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>
                  <div class="form-divider">
                    Data Informasi
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Status</label>
                      <select name="status_akun" class="form-control selectric">
                        <option>==Pilih Status==</option>
                        <option value="alumni">Alumni</option>
                        <option value="siswa">Siswa</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Nomor HP</label>
                      <input type="number" name="phone" id="phone" class="form-control" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Angkatan</label>
                       <select class="form-control" name="angkatan_id" id="angkatan_id" required="">
                      <option>==Pilih Angkatan==</option>
                      @foreach($angkatan as $value)
                      <option value="{{ $value->id }}">{{ $value->nama_angkatan }}</option>
                      @endforeach
                    </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Tahun Lulus (contoh : 2015)</label>
                      <input type="number" name="tahun_lulus" id="tahun_lulus" class="form-control" required="">
                    </div>
                  </div>
                  {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div> --}}
                  <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                      {!! RecaptchaV3::field('register') !!}
                      @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Sudah punya akun? <a href="{{ route('login') }}">Login Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('frontend.footer')
</body>
</html>