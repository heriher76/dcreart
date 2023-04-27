<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.7.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.7.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{asset('/')}}assets/images/logo-dcreartdesign.png" type="image/x-icon">
  <meta name="description" content="">
  
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/parallax/jarallax.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/animatecss/animate.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/dropdown/css/style.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/socicon/css/styles.css">
  <link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="{{asset('/')}}assets/mobirise-assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="{{asset('/')}}assets/mobirise-assets/mobirise/css/mbr-additional.css" type="text/css">
  <!-- Meta Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1961243800885324');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=1961243800885324&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
  @yield('style')
</head>
<body>
    
@include('layouts.guest.navbar')

@yield('content')

@include('layouts.guest.footer')

<script src="{{asset('/')}}assets/mobirise-assets/bootstrap/js/bootstrap.bundle.min.js"></script>  
<script src="{{asset('/')}}assets/mobirise-assets/parallax/jarallax.js"></script>  
<script src="{{asset('/')}}assets/mobirise-assets/smoothscroll/smooth-scroll.js"></script>  <script src="{{asset('/')}}assets/mobirise-assets/ytplayer/index.js"></script>  
<script src="{{asset('/')}}assets/mobirise-assets/dropdown/js/navbar-dropdown.js"></script>  <script src="{{asset('/')}}assets/mobirise-assets/embla/embla.min.js"></script>  
<script src="{{asset('/')}}assets/mobirise-assets/embla/script.js"></script>
<script src="{{asset('/')}}assets/mobirise-assets/theme/js/script.js"></script>  
<script src="{{asset('/')}}assets/mobirise-assets/formoid/formoid.min.js"></script>  
  

  <input name="animation" type="hidden">

@yield('script')

  </body>
</html>