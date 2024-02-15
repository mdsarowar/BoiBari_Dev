<!-- Footer Start -->
<footer class="footer-main-block ">
  <div class="footer-block-one">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-6">
              <div class="footer-block">
                <h5 class="footer-title">{{ $footer3_widget->footer2 }}</h5>
                <ul>

                  @if(Auth::check())
                    <li><a href="{{url('profile')}}" title="My Account">{{ __('My Account') }}</a></li>
                    <li><a href="{{url('order')}}" title="Order History">{{ __('Order History') }}</a></li>
                  @endif

                  @if(isset($genrals_settings) && $genrals_settings['vendor_enable'] == 1)
                    @if(Auth::check())
                      @if(Auth::user()->role_id != 'a' && !Auth::user()->store)
                      <li class="last"><a href="{{ route('applyforseller') }}" title="{{ __('Apply for Seller Account') }}">{{ __('Apply for Seller Account') }}</a></li>
                      @endif
                    @else
                      <li class="last"><a href="{{ route('applyforseller') }}" title="{{ __('Apply for Seller Account') }}">{{ __('Apply for Seller Account') }}</a></li>
                    @endif
                  @endif

                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6">
              <div class="footer-block">
                <h5 class="footer-title">{{ $footer3_widget->footer3 }}</h5>
                <ul>
                  <li class="last"><a href="{{ route('hdesk') }}" title="{{ __('Help Center') }}">{{ __('Help Center') }}</a></li>
                  <li class="last"><a href="{{ route('track.order') }}" title="{{ __("Track Order") }}">{{ __('Track Order') }}</a></li>

                  @foreach($widget3items as $foo)
             
                  <li>
                    @if($foo->link_by == 'page' && isset($foo->gotopage['slug']))
                    <a title="{{ $foo->title }}" href="{{ route('page.slug',$foo->gotopage['slug']) }}">
                      {{ $foo->title }}
                    </a>
                    @else
                    <a title="{{ $foo->title }}" href="{{ $foo->url }}">
                      {{ $foo->title }}
                    </a>
                    @endif
                  </li>
                  @endforeach

                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6">
              <div class="footer-block">
                <h5 class="footer-title">{{ $footer3_widget->footer4 }}</h5>
                <ul>
                  <li><a href="{{url('faq')}}" title="Faq">{{ __("FAQ's") }}</a></li>
                  <li><a href="{{ route('contact.us') }}" title="{{ __("ContactUs") }}">{{ __('Contact Us') }}</a></li>
                  @foreach($widget4items as $foo)
                  
                  <li>
                    @if($foo->link_by == 'page' && isset($foo->gotopage['slug']))
                    <a title="{{ $foo->title }}" href="{{ route('page.slug',$foo->gotopage['slug']) }}">
                      {{ $foo->title }}
                    </a>
                    @else
                    <a target="__blank" title="{{ $foo->title }}" href="{{ $foo->url }}">
                      {{ $foo->title }}
                    </a>
                    @endif
                  </li>
                  @endforeach

                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6">
              <div class="footer-block">
                <h5 class="footer-title">Connect</h5>
                <ul>

                  @if(!empty($genrals_settings->address))
                  <li><a href="#" title="Address"><i data-feather="map-pin"></i>{{$genrals_settings->address}}</a></li>
                  @endif

                  @if(!empty($genrals_settings->mobile))
                  <li><a href="tel:{{$genrals_settings->mobile}}" title="Mobile No."><i data-feather="phone-call"></i>{{$genrals_settings->mobile}}</a></li>
                  @endif

                  @if(!empty($genrals_settings->email))
                  <li><a href="mailto:{{$genrals_settings->email}}" title="Email"><i data-feather="globe"></i>{{$genrals_settings->email}}</a></li>
                  @endif

                </ul>
              </div>
            </div>
          </div>
        </div>
{{--        <div class="col-lg-3">--}}
{{--          <div class="social-link-block">--}}
{{--            <h5 class="footer-title">{{__('Social Links')}}</h5>--}}
{{--            <ul>--}}

{{--              @foreach($socials as $social)--}}

{{--                @if($social->url=='https://facebook.com' || $social->url=='http://facebook.com')--}}
{{--                <li><a target="_blank" href="{{$social->url}}" title="facebook"><i data-feather="facebook"></i></a></li>--}}
{{--                @endif--}}

{{--                @if($social->url=='https://twitter.com' || $social->url=='http://twitter.com')--}}
{{--                <li><a target="_blank" href="{{$social->url}}" title="twitter"><i data-feather="twitter"></i></a></li>--}}
{{--                @endif--}}

{{--                @if($social->url=='https://instagram.com' || $social->url=='http://instagram.com')--}}
{{--                <li><a target="_blank" href="{{$social->url}}" title="instagram"><i data-feather="instagram"></i></a></li>--}}
{{--                @endif--}}

{{--                @if($social->url=='https://youtube.com' || $social->url=='http://youtube.com')--}}
{{--                <li><a target="_blank" href="{{$social->url}}" title="youtube"><i data-feather="youtube"></i></a></li>--}}
{{--                @endif--}}

{{--                @if($social->url=='https://linkedin.com' || $social->url=='http://linkedin.com')--}}
{{--                <li><a target="_blank" href="{{$social->url}}" title="linkedin"><i data-feather="linkedin"></i></a></li>--}}
{{--                @endif--}}

{{--              @endforeach--}}

{{--            </ul>--}}
{{--          </div>--}}
{{--          <div class="app-link-block">--}}
{{--            <h5 class="footer-title">App Links</h5>--}}
{{--            <ul>--}}
{{--              <li><a href="#" title=""><img src="{{url('frontend/assets/images/app/google_play.png') }}" class="img-fluid" alt=""></a></li>--}}
{{--              <li><a href="#" title=""><img src="{{url('frontend/assets/images/app/app_store.png') }}" class="img-fluid" alt=""></a></li>--}}
{{--            </ul>--}}
{{--          </div>--}}
{{--        </div>--}}
      </div>
    </div>
  </div>
  <div class="footer-block-two">
    <div class="container">
      <div class="footer-logo-des">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="footer-logo">
              @if($front_logo)
              <a href="{{url('/')}}" title="{{$title}}"><img src="{{url('images/genral/footer/'.$front_logo)}}" class="img-fluid" alt="{{$title}}"></a>
              @endif
            </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="footer-des">
              <p>{{App\Footer::first()?App\Footer::first()->content:''}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tiny-footer">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12">
            <p> @if(isset($Copyright)) {{ $Copyright }}@endif</p>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div id="footer-payment-slider" class="footer-payment-slider-block owl-carousel owl-theme">
              <div class="item">
                @if($Api_settings->paypal_enable=='1')
                <a target="__blank" href="https://paypal.com" title="Paypal"><img src="{{ url('images/payment/paypal.png') }}" class="img-fluid" alt="Paypal"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->stripe_enable=='1')
                <a title="Stripe" target="__blank" href="https://stripe.com/"><img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="Stripe"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->braintree_enable=='1')
                <a title="Braintree" target="__blank" href="https://braintreepayments.com/"><img src="{{ url('images/payment/braintree.png') }}" class="img-fluid" alt="Braintree"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->paystack_enable=='1')
                <a title="Braintree" target="__blank" href="https://paystack.com/"><img src="{{ url('images/payment/paystack.png') }}" class="img-fluid" alt="Paystack"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->paytm_enable=='1')
                <a title="Paytm" target="__blank" href="https://paytm.com/"><img src="{{ url('images/payment/paytm.png') }}" class="img-fluid" alt="Paytm"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->razorpay=='1')
                <a title="Razorpay" target="__blank" href="https://razorpay.com/"><img src="{{ url('images/payment/razorpay.png') }}" class="img-fluid" alt="Razorpay"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->instamojo_enable=='1')
                <a title="Instamojo" target="__blank" href="https://instamojo.com/"><img src="{{ url('images/payment/instamojo.png') }}" class="img-fluid" alt="Instamojo"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->payu_enable=='1')
                <a title="Payumoney" target="__blank" href="https://payu.com/"><img src="{{ url('images/payment/payumoney.png') }}" class="img-fluid" alt="Payumoney"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->payhere_enable=='1')
                <a title="Payhere" target="__blank" href="https://payhere.com/"><img src="{{ url('images/payment/payhere.png') }}" class="img-fluid" alt="Payhere"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->omise_enable=='1')
                <a title="Omise" target="__blank" href="https://omise.com/"><img src="{{ url('images/payment/omise.png') }}" class="img-fluid" alt="Omise"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->cashfree_enable=='1')
                <a title="Cashfree" target="__blank" href="https://cashfree.com/"><img src="{{ url('images/payment/cashfree.png') }}" class="img-fluid" alt="Cashfree"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->moli_enable=='1')
                <a title="Mollie" target="__blank" href="https://mollie.com/"><img src="{{ url('images/payment/mollie.png') }}" class="img-fluid" alt="Mollie"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->rave_enable=='1')
                <a title="Rave" target="__blank" href="https://dashboard.flutterwave.com/"><img src="{{ url('images/payment/rave.png') }}" class="img-fluid" alt="Rave"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->skrill_enable=='1')
                <a title="Skrill" target="__blank" href="https://skrill.com/"><img src="{{ url('images/payment/skrill.png') }}" class="img-fluid" alt="Skrill"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->sslcommerze_enable=='1')
{{--                <a title="sslcommerz" target="__blank" href="https://sslcommerz.com/"><img src="{{ url('images/payment/sslcommerz.png') }}" class="img-fluid" alt="sslcommerz"></a>--}}
                @endif
              </div>
              <div class="item">
                @if($Api_settings->enable_amarpay=='1')
                <a title="aamarpay" target="__blank" href="https://aamarpay.com/"><img src="{{ url('images/payment/aamarpay.png') }}" class="img-fluid" alt="aamarpay"></a>
                @endif
              </div>
              <div class="item">
                @if($Api_settings->iyzico_enable=='1')
                <a title="Iyzico" target="__blank" href="https://iyzico.com/"><img src="{{ url('images/payment/iyzico.png') }}" class="img-fluid" alt="Iyzico"></a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer End -->