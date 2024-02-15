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
    
        @include('frontend.layout.header')
        @include('sweet::alert')
        <!-- home start -->
        @yield('content')

        <!-- Login Code -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-close-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              </div>
              <div class="modal-body">
                <div class="login-modal-block">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="true" title="login">Login</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup-tab-pane" type="button" role="tab" aria-controls="signup-tab-pane" aria-selected="false" title="sign up">Sign Up</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                        <div class="login-block">
                          <div class="social-login-block">
                              <h6 class="social-login-title">{{__('Enter your credentials to login account')}}</h6>
                              <ul>
                                @if($configs->fb_login_enable=='1')
                                  <li><a href="{{url('login/facebook')}}" title="{{__('Facebook')}}"><img src="{{ url('frontend/assets/images/login/facebook.png') }}" class="img-fluid" alt="{{__('Facebook')}}"></a></li>
                                @endif
                                @if($configs->google_login_enable=='1')
                                  <li><a href="{{url('login/google')}}" title="{{__('Google')}}"><img src="{{ url('frontend/assets/images/login/google.png') }}" class="img-fluid" alt="{{__('Google')}}"></a></li>
                                @endif
                                @if($configs->twitter_enable == 1)
                                  <li><a href="{{url('login/twitter')}}" title="{{__('Twitter')}}"><img src="{{ url('frontend/assets/images/login/twitter.png') }}" class="img-fluid" alt="{{__('Twitter')}}"></a></li>
                                @endif
                                @if(env('ENABLE_GITLAB') == 1 )
                                  <li><a href="{{url('login/gitlab')}}" title="{{__('Github')}}"><img src="{{ url('frontend/assets/images/login/github.png') }}" class="img-fluid" alt="{{__('Github')}}"></a></li>
                                @endif
                                @if($configs->linkedin_enable=='1')
                                  <li><a href="{{url('login/linkedin')}}" title="{{__('Linkedin')}}"><img src="{{ url('frontend/assets/images/login/linkedin.png') }}" class="img-fluid" alt="{{__('Linkedin')}}"></a></li>
                                @endif
                                @if($configs->amazon_enable=='1')
                                  <li><a href="{{url('login/amazon')}}" title="{{__('Amazon Pay')}}"><img src="{{ url('frontend/assets/images/login/amazon-pay.png') }}" class="img-fluid" alt="{{__('Amazon Pay')}}"></a></li>
                                @endif
                              </ul>
                              <h2><span>Or</span></h2>
                          </div>
                          
                            <form novalidate id="loginform" method="POST" class="form register-form outer-top-xs" role="form" action="{{ route('login') }}">
                              @csrf
                                @if(Module::has('MimSms') && Module::find('MimSms')->isEnabled() && env('MIM_SMS_OTP_ENABLE') == 1 && env('DEFAULT_SMS_CHANNEL') == 'mim')
                                    @include('mimsms::auth.login')
                                @elseif(Module::has('Exabytes') && Module::find('Exabytes')->isEnabled() && env('DEFAULT_SMS_CHANNEL') == 'exabytes')
                                    @include('exabytes::auth.login')
                                @else
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">{{__('Username/E-mail address')}}*</label>
                                  <input required type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" autofocus id="exampleInputEmail1" aria-describedby="emailHelp">
                                  @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="mb-3">
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                      <label for="exampleInputPassword1" class="form-label">{{__('Password')}}*</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                      <div class="forgot-password">
                                      <a href="{{ route('password.request') }}" title="forgot password" data-bs-toggle="modal" data-bs-target="#resetModal">{{__('Forgot Password')}}</a>
                                    </div>
                                  </div>
                                </div>
                                <input required type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputPassword1">
                                <span toggle="#exampleInputPassword1" class="fa-regular fa-eye field-icon toggle-password"></span>
                                @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                                </div>
                                <div class="mb-3 form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                  <label class="form-check-label" for="exampleCheck1">{{__('Remember Information')}}</label>
                                </div>
                                <button class="btn btn-primary" type="submit">{{__('Login')}}</button>
                              
                                <div class="sign-up-acc">{{__('Not an account')}}? <a href="{{ route('register') }}" title="register">{{__('Register')}}</a></div>
                            </form>
                          @endif
                        </div>
                      </div>
                      
                    <div class="tab-pane fade" id="signup-tab-pane" role="tabpanel" aria-labelledby="signup-tab" tabindex="0">
                        @php
                            require_once(base_path().'/app/Http/Controllers/price.php');
                            $userterm = App\TermsSettings::firstWhere('key','user-register-term');
                        @endphp
                        @php
                            if(isset($selected_language) && $selected_language->rtl_available == 1){
                                $class = 'offset-md-1';
                            }else{
                                $class = 'offset-md-3';
                            }
                        @endphp
                        <div class="login-block">
                        <form role="form" method="POST" action="{{ route('register') }}" novalidate>
                          @csrf
                          @if(Module::has('MimSms') && Module::find('MimSms')->isEnabled() && env('MIM_SMS_OTP_ENABLE') == 1 && env('DEFAULT_SMS_CHANNEL') == 'mim')
                              @include('mimsms::auth.register')
                          @elseif(Module::has('Exabytes') && Module::find('Exabytes')->isEnabled() && env('DEFAULT_SMS_CHANNEL') == 'exabytes')
                              @include('exabytes::auth.register')
                          @else
                          <div class="social-login-block">
                              <h6 class="social-login-title">{{__('Enter your credentials to login account')}}</h6>
                              <ul>
                                @if($configs->fb_login_enable=='1')
                                  <li><a href="{{url('login/facebook')}}" title="{{__('Facebook')}}"><img src="{{ url('frontend/assets/images/login/facebook.png') }}" class="img-fluid" alt="{{__('Facebook')}}"></a></li>
                                @endif
                                @if($configs->google_login_enable=='1')
                                  <li><a href="{{url('login/google')}}" title="{{__('Google')}}"><img src="{{ url('frontend/assets/images/login/google.png') }}" class="img-fluid" alt="{{__('Google')}}"></a></li>
                                @endif
                                @if($configs->twitter_enable == 1)
                                  <li><a href="{{url('login/twitter')}}" title="{{__('Twitter')}}"><img src="{{ url('frontend/assets/images/login/twitter.png') }}" class="img-fluid" alt="{{__('Twitter')}}"></a></li>
                                @endif
                                @if(env('ENABLE_GITLAB') == 1 )
                                  <li><a href="{{url('login/gitlab')}}" title="{{__('Github')}}"><img src="{{ url('frontend/assets/images/login/github.png') }}" class="img-fluid" alt="{{__('Github')}}"></a></li>
                                @endif
                                @if($configs->linkedin_enable=='1')
                                  <li><a href="{{url('login/linkedin')}}" title="{{__('Linkedin')}}"><img src="{{ url('frontend/assets/images/login/linkedin.png') }}" class="img-fluid" alt="{{__('Linkedin')}}"></a></li>
                                @endif
                                @if($configs->amazon_enable=='1')
                                  <li><a href="{{url('login/amazon')}}" title="{{__('Amazon Pay')}}"><img src="{{ url('frontend/assets/images/login/amazon-pay.png') }}" class="img-fluid" alt="{{__('Amazon Pay')}}"></a></li>
                                @endif
                              </ul>
                              <h2><span>Or</span></h2>
                          </div>
                              <div class="mb-3">
                                <label for="exampleInputName2" class="form-label">{{__('Name')}}*</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputName2" aria-describedby="emailHelp">
                                @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span> 
                                @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail2" class="form-label">{{__('email')}}*</label>
                                <input type="text" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail2" aria-describedby="emailHelp" name="email" required autofocus>
                                @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span> 
                                @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputphonecode2" class="form-label">{{__('Mobile No.')}}*</label>
                                <!-- <input type="text" value="{{ old('phonecode') }}" class="form-control {{ $errors->has('phonecode') ? ' is-invalid' : '' }}" id="exampleInputphonecode2" aria-describedby="phonecodeHelp" name="phonecode" required> -->
                                <input required pattern="[0-9]+" title="{{ __('Please enter valid mobile no') }}." value="{{ old('mobile') }}" type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"  required>
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword2" class="form-label">{{__('Password')}}*</label>
                                <input required type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="exampleInputPassword2">
                                <span toggle="#exampleInputPassword2" class="fa-regular fa-eye field-icon toggle-password"></span>
                                @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span> 
                                @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword3" class="form-label">{{__('Create Password')}}*</label>
                                <input type="password" class="form-control" name="password_confirmation" id="cpassword">
                                <span toggle="#cpassword" class="fa-regular fa-eye field-icon toggle-password"></span>
                              </div>
                              @if($aff_system && $aff_system->enable_affilate == 1)
                              <div class="mb-3">
                                  <div class="form-group">
                                      <label class="info-title" for="exampleInputEmail1">{{ __('ReferCode') }} </label>
                                      <input value="{{ app('request')->input('refercode') ?? old('refercode') }}" type="text" name="refer_code"
                                          class="{{ $errors->has('refercode') ? ' is-invalid' : '' }} form-control" />

                                      @if ($errors->has('refercode'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('refercode') }}</strong>
                                      </span>
                                      @endif
                                  </div>
                              </div>
                              @endif


                              @if($genrals_settings && $genrals_settings->captcha_enable == 1)

                              <div class="mb-3">
                                  <div class="form-group">
                                      {!! no_captcha()->display() !!}
                                  </div>

                                  @error('g-recaptcha-response')
                                  <p class="text-danger"><b>{{ $message }}</b></p>
                                  @enderror
                              </div>

                              @endif
                              <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="eula" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">I agree with the terms & conditions.</label>
                              </div>
                              <input type="submit" value="Sign Up" class="form-control btn btn-primary">
                              <div class="sign-up-acc">Already have an account? <a href="#" title="login"> Login</a></div>
                          </form>
                          @endif
                        </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-close-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              </div>
              <div class="modal-body">
                <div class="login-modal-block">
                  <h4 class="reset-title">Reset Password</h4>
                  <div class="login-block">
                    @if(Module::has('MimSms') && Module::find('MimSms')->isEnabled() && env('MIM_SMS_OTP_ENABLE') == 1 && env('DEFAULT_SMS_CHANNEL') == 'mim')
                        @include('mimsms::auth.forgetpassword')
                    @elseif(Module::has('Exabytes') && Module::find('Exabytes')->isEnabled() && env('DEFAULT_SMS_CHANNEL') == 'exabytes')
                        @include('exabytes::auth.forgetpassword')
                    @else
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      <div class="social-login-block">
                        <div class="mb-3">
                          <div id="emailHelp" class="form-text mb-3">Enter your email address or mobile number to reset password.</div>
                            <label for="exampleInputEmail1" class="form-label">E-mail*</label>
                            <input required="" value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('email'))
                              <span class="invalid-feedback text-danger" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                            @endif
                          </div>                         
                        </div>
                        <input type="submit" value="Send Password Reset Link" class="form-control">
                      </div>
                    </form>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Login End -->
        
        <!-- Start Footer Section -->
        @include('frontend.layout.footer')
        <!-- End Footer Section -->
        
        @if(env('GOOGLE_TAG_MANAGER_ID') != '' && env('GOOGLE_TAG_MANAGER_ENABLED') == true)
        @include('googletagmanager::body')
        @endif

        @if(env('FACEBOOK_PIXEL_ID') != '')
        @include('facebook-pixel::body')
        @endif

        <!-- End -->
        <!-- Display GDPR7 Cokkie message -->
        @include('cookieConsent::index')
        @notify_js
        @notify_render
        @php
          $last_cat = 0;
          $first_cat = 0;
          $price_login = App\Genral::first()->login;
          $price_array = array();
          $convert_price = 0;
          $show_price = 0;
          $s_product = App\SimpleProduct::query();
          $get_simple_products = array();
        @endphp
        <!-- Messenger Bubble -->
        @if(Request::ip() != '::1' && env('MESSENGER_CHAT_BUBBLE_URL') != '')
        <script src="{{ env('MESSENGER_CHAT_BUBBLE_URL') }}" async></script>
        @endif
        <script>
            var sendurl = @json(route('ajaxsearch'));
            var rightclick = @json($rightclick);
            var inspect = @json($inspect);
            let baseUrl = @json(url('/'));
            // var crate = @json($conversion_rate);
            var exist = @json(url('shop'));
            var setstart = @json(url('setstart'));
        </script>
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
        @include('frontend.categoryfilterscript')
        @include('frontend.filters.headscript')
        @include('frontend.filters.bottomscript')
        <script>
            $(document).ready(function(){

                $('.product-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.product-slider-nav'
                });

                $('.product-slider-nav').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: true,
                    asNavFor: '.product-slider',
                    centerMode: false,
                    focusOnSelect: true,
                    prevArrow: ".thumb-prev",
                    nextArrow: ".thumb-next",
                });
                
            }); 

            function searchInput() {
                if($('#ipad_vsearch').val()){
                    $('#searchSubmit').submit();
                }                
            }
        </script>
        <script>
      jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa-solid fa-chevron-up"></i></div><div class="quantity-button quantity-down"><i class="fa-solid fa-chevron-down"></i></div></div>').insertAfter('.quantity input');
      jQuery('.quantity').each(function() {
        var spinner = jQuery(this),
          input = spinner.find('input[type="number"]'),
          btnUp = spinner.find('.quantity-up'),
          btnDown = spinner.find('.quantity-down'),
          min = input.attr('min'),
          max = input.attr('max');

        btnUp.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue >= max) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue + 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });

        btnDown.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue <= min) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue - 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });

      });
    </script>
    <script>
      $('.add_in_wish_simple').on('click',function(){
      
          var status = $(this).data('status');
          var proid = $(this).data('proid');
          
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url : '{{ route("add.simple.pro.in.wishlist") }}',
              method : 'GET',
              data : {proid : proid},
              success : function(response){
                  console.log('response',response);
                  if(response.status == 'success'){
                      toastr.success(response.msg,'Success');
                  }else{
                      toastr.error(response.msg,'Failed');
                  }
              }
          });


      });
    </script>
    <script>
      function addSimpleProCard(spid) {
        var formcls = '.addSimpleCardFrom'+spid;
        var formurl = $(formcls).attr('action'); 
  
        $.ajax({
            url : formurl,
            method : 'Post',
            data : $(formcls).serialize(),
            success : function(response){
                if(response.status == 'success'){
                    toastr.success(response.msg,'Success');
                    $('.cart_count').text(response.cart_count);
                }else{
                    toastr.error(response.msg,'Failed');
                }
            }
        });
      }
    </script>
    <script>
      function add_in_wish_variant(proid) {
        
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url : '{{ route("AddToWishListVariant") }}',
              method : 'Post',
              data : {proid : proid},
              success : function(response){
                  if(response.status == 'success'){
                      toastr.success(response.msg,'Success');
                  }else{
                      toastr.error(response.msg,'Failed');
                  }
              }
          });
      }
    </script>
    <script>
      function addVariantProCard(id) {
        var formcls = '.addVariantProCard'+id;
        var formurl = $(formcls).attr('action');  
        $.ajax({
            url : formurl,
            method : 'Post',
            data : $(formcls).serialize(),
            success : function(response){
                if(response.status == 'success'){
                    toastr.success(response.msg,'Success');
                    $('.cart_count').text(response.cart_count);
                }else{
                    toastr.error(response.msg,'Failed');
                }                
            }
        });
      }
    </script>
    <script>
      	$(".search-field-new").autocomplete({
          source: function(request, response) {
            var x = '';
            $.ajax({
              url: '{{ route("search-on-time") }}',
              data: {
                catid: x,
                search: request.term
              },
              dataType: "json",
              success: function(data) {
                var resp = $.map(data, function(obj) {
                  return {
                    label: obj.value,
                    value: obj.value,
                    img: obj.img,
                    url: obj.url
                  }
                });
                response(resp);
              }
            });
          },
          select: function(event, ui) {
            if(ui.item.value != 'No Result found') {
              event.preventDefault();
              location.href = ui.item.url;
            } else {
              return false;
            }
          },
          html: true,
          open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
          },
        }).autocomplete("instance")._renderItem = function(ul, item) {
          return $("<li><div><img src='" + item.img + "' class='img-fluid' height='50px' width='50px'><span>" + item.value + "</span></div></li>").appendTo(ul);
        };
    </script>
      @yield('script')
    </body>
</html>