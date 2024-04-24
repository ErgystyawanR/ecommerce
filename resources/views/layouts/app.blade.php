<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />
    <title>{{ config('app.name') }}</title>
<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/fontawesome/css/all.min.css') }}">

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/components.css') }}">

 
    <!-- Start GA -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-94034622-3");
    </script>
    <!-- /END GA -->
  </head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('layouts.header')

            @include('layouts.sidebar')

            <div class="main-content">
              <section class="section">
                @yield('content')
              </section>
               
            </div>
        </div>
    </div>

   <!-- General JS Scripts -->
<script src="{{ asset('modules/jquery.min.js') }}"></script>
<script src="{{ asset('modules/popper.js') }}"></script>
<script src="{{ asset('modules/tooltip.js') }}"></script>
<script src="{{ asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('modules/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>
<script src="{{ asset('modules/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Libraries -->
<script src="{{ asset('modules/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('modules/chart.min.js') }}"></script>
<script src="{{ asset('modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
