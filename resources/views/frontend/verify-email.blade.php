@include('frontend.header')
@yield('content')
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              Verify Your Email Address
            </div>

            <div class="card card-primary">
              <div class="card-body">
               @if (session('status') == 'verification-link-sent')
               <div class="alert alert-success text-center">A new email verification link has been emailed to you!</div>
               @endif
               <div class="section-title">Hay Bestie!</div>
               <p class="section-lead">Before proceeding, please check your email for a verification link.</p>
               <p class="section-lead">If you did not receive the email</p>                
               <form method="POST" action="{{ route('verification.send') }}" method="post">
                @csrf
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-lg btn-round btn-primary">
                    Resend verification link
                  </button>
                </div>
              </form>
              <div class="mt-5 text-muted text-center">
                <a href="{{ url('/') }}">Back</a>
              </div>
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