<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(selected_lang()->rtl_available == 1) dir="rtl" @endif>
    <head>
      @if(env('GOOGLE_TAG_MANAGER_ID') != '' && env('GOOGLE_TAG_MANAGER_ENABLED') == true)
        @include('googletagmanager::head')
      @endif

      @if(env('FACEBOOK_PIXEL_ID') != '')
      @include('facebook-pixel::head')
      @endif

      <style>
        :root {
          --background_blue_bg_color: #108BEA;
          --background_dark_blue_bg_color: #157ed2;
          --background_light_blue_bg_color: #0f6cb2;
          --background_black_bg_color: #2E353B;
          --background_white_bg_color: #FFF;
          --background_grey_bg_color: #e9e9de;
          --background_yellow_bg_color: #fdd922;
          --background_green_bg_color: #157ed2;
          --background_pink_bg_color: #ff7878;
          --text_white_color: #FFF;
          --text_black_color: #333;
          --text_light_black_color: #666;
          --text_blue_color: #157ed2;
          --text_yellow_color: #FDD922;
          --text_grey_color: #9a9a9a;
          --text_dark_grey_color: #abafb1;
          --text_dark_blue_color: #147ED2;
          --text_green_color: #12CCA7;
          --text_pink_color: #000;
        }

        img.lazy :not(hover-image) {
          background-image: url('//via.placeholder.com/200x200.png?text=loading');
          background-repeat: no-repeat;
          background-position: 50% 50%;
        }
      </style>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all">
        @yield('meta_tags')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="fallback_locale" content="{{ config('app.fallback_locale') }}">
        <!-- Theme Header Color -->
        <title>@yield('title') </title>
        @if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' && env('PWA_ENABLE') == 1)
          @laravelPWA
        @endif
        <link rel="icon" type="image/icon" href="{{url('images/genral/'.$fevicon)}}"> <!-- favicon-icon -->
        
        @if(selected_lang()->rtl_available == 1)
        <link rel="stylesheet" href="{{ url('frontend/assets/css/bootstrap.rtl.min.css') }}">
        @else
        <link rel="stylesheet" href="{{ url('frontend/assets/css/bootstrap.min.css') }}"> 
        @endif
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> <!-- google font -->
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/vendor/owl_carousel/css/owl.carousel.min.css') }}"> <!-- owl carousel css -->
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/vendor/owl_carousel/css/owl.theme.default.min.css') }}"> <!-- owl theme default css -->
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/vendor/slick/css/slick.css') }}"/> <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/vendor/slick/css/slick-theme.css') }}"> <!-- slick theme css -->
       
        @if(selected_lang()->rtl_available == 1)
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/css/style.rtl.css') }}">
        @else
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/css/style.css') }}">
        @endif
        <link rel="stylesheet" type="text/css" href="{{ url('frontend/assets/vendor/font_awesome/css/all.min.css') }}"/> <!-- font awesome css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    </head>
    <body>
    
        @include('sweet::alert')
        <!-- home start -->
        @yield('content')

        <!-- End -->
        <script src="{{ url('js/master.js') }}"></script>
        
        <!-- Default Front JS -->
        @if(selected_lang()->rtl_available == 1)
        <!-- RTL OWL JS-->
        <script src="{{url('front/js/default.js')}}"></script>

        @else
        <!-- LTR OWL JS-->
        <script src="{{url('front/js/scripts.min.js')}}"></script>
        @endif

        @if(file_exists(public_path().'/js/custom-js.js'))
        <script defer src="{{url('js/custom-js.js')}}"></script>
        @endif
        <!-- Sweetalert JS -->
        <script src="{{ url('front/vendor/js/sweetalert.min.js') }}"></script>
                
        <!-- New Frontend Javascript Start -->
        <!-- jquery js-->
        <!-- <script type="text/javascript" src="{{ url('frontend/assets/js/jquery.min.js') }}"></script>  -->
        <script type="text/javascript" src="{{ url('frontend/assets/js/popper.min.js') }}"></script> <!-- popper js-->
        <script type="text/javascript" src="{{ url('frontend/assets/js/bootstrap.bundle.min.js') }}"></script> 
        <script type="text/javascript" src="{{ url('frontend/assets/vendor/owl_carousel/js/owl.carousel.min.js') }}"></script> <!-- owl carousel js-->
        <script type="text/javascript" src="{{ url('frontend/assets/vendor/feather/feather.min.js') }}"></script> <!-- feather js-->
        <script type="text/javascript" src="{{ url('frontend/assets/vendor/slick/js/slick.min.js') }}"></script> <!-- slick min js-->
        <script type="text/javascript" src="{{ url('js/detailpage.js') }}"></script>
        
        @if(selected_lang()->rtl_available == 1)
        <!-- RTL OWL JS-->
        <script type="text/javascript" src="{{ url('frontend/assets/js/theme.rtl.js') }}"></script> 

        @else
        <!-- LTR OWL JS-->
        <script type="text/javascript" src="{{ url('frontend/assets/js/theme.js') }}"></script>
        @endif

        <script type="text/javascript" src="{{ url('frontend/assets/js/frontmaster.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        
        @yield('script')
    </body>
</html>