<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.7.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.7.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{asset('/')}}assets/images/logo.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <link rel="stylesheet" href="{{asset('/')}}assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/dropdown/css/style.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/socicon/css/styles.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="{{asset('/')}}assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="{{asset('/')}}assets/mobirise/css/mbr-additional.css" type="text/css">

  
  
  
</head>
<body>
  
@include('layouts.navbar.user')

@yield('content')

@include('layouts.footer.user')

{{-- <section class="display-7" style="padding: 0;align-items: center;justify-content: center;flex-wrap: wrap;    align-content: center;display: flex;position: relative;height: 4rem;"><a href="https://mobiri.se/1012361" style="flex: 1 1;height: 4rem;position: absolute;width: 100%;z-index: 1;"><img alt="" style="height: 4rem;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="></a><p style="margin: 0;text-align: center;" class="display-7">Created with &#8204;</p><a style="z-index:1" href="https://mobirise.com/builder/no-code-website-builder.html">Website Design Program</a></section> --}}
<script src="{{asset('/')}}assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}assets/smoothscroll/smooth-scroll.js"></script>
<script src="{{asset('/')}}assets/ytplayer/index.js"></script>
<script src="{{asset('/')}}assets/dropdown/js/navbar-dropdown.js"></script>
<script src="{{asset('/')}}assets/embla/embla.min.js"></script>
<script src="{{asset('/')}}assets/embla/script.js"></script>
<script src="{{asset('/')}}assets/theme/js/script.js"></script>
<script src="{{asset('/')}}assets/formoid/formoid.min.js"></script>  
  
  
</body>
</html>