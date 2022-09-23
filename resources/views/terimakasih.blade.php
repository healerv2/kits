<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> {{ $title }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{url('')}}/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{url('')}}/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h2>KITS Peduli. </h2>
            <h2>Mengucapkan Terima Kasih</h2>
            <div class="page-description">
            	Terimakasih atas donasi yang telah Anda berikan, Insya Allah donasi akan kami sampaikan kepada orang-orang yang membutuhkan, Semoga menjadi Amal Jariyah dan Allah memberi keberkahan atas apa yang Anda berikan.
            </div>
            <div class="page-search">
              <div class="mt-3">
                <a href="{{ route('dashboard') }}">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Dev By <a href="#">Fokal-IT</a>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
 {{--  <script src="{{url('')}}/assets/modules/jquery.min.js"></script>
  <script src="{{url('')}}/assets/modules/popper.js"></script>
  <script src="{{url('')}}/assets/modules/tooltip.js"></script>
  <script src="{{url('')}}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{url('')}}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{url('')}}/assets/modules/moment.min.js"></script>
  <script src="{{url('')}}/assets/js/stisla.js"></script> --}}
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{url('')}}/assets/js/scripts.js"></script>
  <script src="{{url('')}}/assets/js/custom.js"></script>
</body>
</html>