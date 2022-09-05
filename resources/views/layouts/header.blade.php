<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title> {{ $title }} </title>

  <link rel="icon" href="{{url('')}}/icon/favicon.ico">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{url('')}}/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{url('')}}/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/bootstrap-social/bootstrap-social.css">
    <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{url('')}}/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/modules/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{url('')}}/assets/css/components.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
          </form>
          <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ url(auth()->user()->foto ?? '') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi,  {{ Auth::user()->name }}</div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged</div>
               <div class="dropdown-divider"></div>
                 <a href="{{ route('users.profil') }}" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger" onclick="$('#logout-form').submit()">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
          @csrf
        </form>