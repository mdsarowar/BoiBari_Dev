@extends("frontend.layout.master")
@section('title','Emart | About us')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('About')}} {{__('Us')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block" style="background-image: url('frontend/assets/images/about/about-bg.png');">
                    <div class="overlay-bg"></div>
                    <div class="breadcrumb-nav">
                        <h3 class="breadcrumb-title">{{__('About')}} {{__('Us')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

<!-- Strategy Start -->
<section id="strategy" class="strategy-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="strategy-title">We’re here with the Best Strategy to help you with Ecommerce Website</h4>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et.</p>
            </div>
        </div>
    </div>
</section>
<!-- Strategy End -->

@if(!empty($footer3_widget ))
<!-- Customer Support Start -->
<section id="customer-support" class="customer-support-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="customer-support-block">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="support-img">
                                <img src="{{ url('frontend/assets/images/support/shipping icon.png') }}" class="img-fluid shipping-img" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="support-dtl">
                                <h5 class="support-title">{{ $footer3_widget->shiping }}</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="customer-support-block">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="support-img">
                                <img src="{{ url('frontend/assets/images/support/headset-solid.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="support-dtl">
                                <h5 class="support-title">{{ $footer3_widget->mobile }}</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="customer-support-block">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="support-img">
                                <img src="{{ url('frontend/assets/images/support/security.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="support-dtl">
                                <h5 class="support-title">{{ $footer3_widget->return }}</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="customer-support-block">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="support-img">
                                <img src="{{ url('frontend/assets/images/support/money.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="support-dtl">
                                <h5 class="support-title">{{ $footer3_widget->money }}</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Customer Support End -->
@endif

<!-- Mission Vission Start -->
<section id="mission-vission" class="mission-vission-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="mission-vission-img">
                    <img src="{{ url('frontend/assets/images/about/vision-mission.png') }}" class="img-fluid" alt="">
                    <div class="top"></div>
                    <div class="right"></div>
                    <div class="left"></div>
                    <div class="bottom"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mission-vission-dtl">
                    <div class="mission-block">
                        <h4 class="mission-vission-title">Our Mission</h4>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyii eirmoiiiioi por invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet cliii ta iiokasd gubergrena iiokasdioi ta iiokasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sitaiiii.</p>
                    </div>
                    <div class="vission-block">
                        <h4 class="mission-vission-title">Our Vission</h4>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyii eirmoiiiioi por invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet cliii ta iiokasd gubergrena iiokasdioi ta iiokasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sitaiiii.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Mission Vission End -->

<!-- About Count Start -->
<section id="about-count" class="about-count-main-block">
    <div class="container">
    <div class="row g-0">
        <div class="col-lg-4 col-md-4">
        <div class="about-count-block">
            <ul>
            <li class="js-num">1.2</li>
            <li>Million +</li>
            </ul>
            <p>Product Option</p>
        </div>
        </div>
        <div class="col-lg-4 col-md-4">
        <div class="about-count-block">
            <ul>
            <li class="js-num">1</li>
            <li>Million +</li>
            </ul>
            <p>New Buyer</p>
        </div>
        </div>
        <div class="col-lg-4 col-md-4">
        <div class="about-count-block">
            <ul>
            <li class="js-num">100</li>
            <li>Billion +</li>
            </ul>
            <p>Selling all over the world</p>
        </div>
        </div>
    </div>
    </div>
</section>
<!-- About Count End -->

<!-- Our Team Start -->
<section id="our-team" class="our-team-main-block">
    <div class="container">
    <h3 class="section-title">Our Team</h3>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6">
        <div class="our-team-block">
            <div class="our-team-img">
            <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_01.png') }}" class="img-fluid" alt=""></a>
            </div>
            <div class="our-team-dtl">
            <h4 class="our-team-title"><a href="#" title="Mittali Jain">Mittali Jain</a></h4>
            <p>Graphic Designer</p>
            </div>
            <div class="our-team-hover-block">
            <div class="our-team-hover-img">
                <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_hover_01.png') }}" class="img-fluid" alt=""></a>
                <p>She is excellent in logics and have good skills in coding and have command in various languages.</p>
            </div>
            <div class="our-team-social-login">
                <ul>
                <li><a href="#" title="facebook"><i data-feather="facebook"></i></a></li>
                <li><a href="#" title="instagram"><i data-feather="instagram"></i></a></li>
                <li><a href="#" title="linkedin"><i data-feather="linkedin"></i></a></li>
                </ul>
            </div>
            <div class="our-team-hover-dtl">
                <h6 class="our-team-title"><a href="#" title="Mittali Jain">Mittali Jain</a></h6>
                <p>Graphic Designer</p>
            </div>
            </div>
        </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
        <div class="our-team-block">
            <div class="our-team-img">
            <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_02.png') }}" class="img-fluid" alt=""></a>
            </div>
            <div class="our-team-dtl">
            <h4 class="our-team-title"><a href="#" title="Kia Singhania">Kia Singhania</a></h4>
            <p>Developer</p>
            </div>
            <div class="our-team-hover-block">
            <div class="our-team-hover-img">
                <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_hover_02.png') }}" class="img-fluid" alt=""></a>
                <p>She is excellent in logics and have good skills in coding and have command in various languages.</p>
            </div>
            <div class="our-team-social-login">
                <ul>
                <li><a href="#" title="facebook"><i data-feather="facebook"></i></a></li>
                <li><a href="#" title="instagram"><i data-feather="instagram"></i></a></li>
                <li><a href="#" title="linkedin"><i data-feather="linkedin"></i></a></li>
                </ul>
            </div>
            <div class="our-team-hover-dtl">
                <h6 class="our-team-title"><a href="#" title="Kia Singhania">Kia Singhania</a></h6>
                <p>Developer</p>
            </div>
            </div>
        </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="our-team-block">
                <div class="our-team-img">
                <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_03.png') }}" class="img-fluid" alt=""></a>
                </div>
                <div class="our-team-dtl">
                <h4 class="our-team-title"><a href="#" title="Aryaman Kedia">Aryaman Kedia</a></h4>
                <p>Developer</p>
                </div>
                <div class="our-team-hover-block">
                <div class="our-team-hover-img">
                    <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_hover_03.png') }}" class="img-fluid" alt=""></a>
                    <p>She is excellent in logics and have good skills in coding and have command in various languages.</p>
                </div>
                <div class="our-team-social-login">
                    <ul>
                    <li><a href="#" title="facebook"><i data-feather="facebook"></i></a></li>
                    <li><a href="#" title="instagram"><i data-feather="instagram"></i></a></li>
                    <li><a href="#" title="linkedin"><i data-feather="linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="our-team-hover-dtl">
                    <h6 class="our-team-title"><a href="#" title="Aryaman Kedia">Aryaman Kedia</a></h6>
                    <p>Developer</p>
                </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="our-team-block">
                <div class="our-team-img">
                <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_04.png') }}" class="img-fluid" alt=""></a>
                </div>
                <div class="our-team-dtl">
                <h4 class="our-team-title"><a href="#" title="Aarish Ray">Aarish Ray</a></h4>
                <p>Web Designer</p>
                </div>
                <div class="our-team-hover-block">
                <div class="our-team-hover-img">
                    <a href="#" title=""><img src="{{ url('frontend/assets/images/our_team/our_team_hover_04.png') }}" class="img-fluid" alt=""></a>
                    <p>She is excellent in logics and have good skills in coding and have command in various languages.</p>
                </div>
                <div class="our-team-social-login">
                    <ul>
                    <li><a href="#" title="facebook"><i data-feather="facebook"></i></a></li>
                    <li><a href="#" title="instagram"><i data-feather="instagram"></i></a></li>
                    <li><a href="#" title="linkedin"><i data-feather="linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="our-team-hover-dtl">
                    <h6 class="our-team-title"><a href="#" title="Aarish Ray">Aarish Ray</a></h6>
                    <p>Web Designer</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Team End -->

@if($stores && count($stores))
<!-- Clients Start -->
<section id="clients" class="clients-main-block">
    <div class="container">
    <div class="row">
        <h3 class="section-title">Our Clients</h3>
        <div id="clients-slider" class="clients-slider-main-block owl-carousel owl-theme">
        @foreach($stores as $key => $store)
            @if($store->store_logo != '' && file_exists(public_path().'/images/store/'.$store->store_logo))
            <div class="item">
            <div class="clients-slider-block">
                <div class="clients-slider-img">
                <a href="javascript:" title="{{__($store->name)}}">
                    <img src="{{ url('/images/store/'.$store->store_logo) }}" class="img-fluid" alt="{{__('Store Logo')}}">
                </a>
                </div>
            </div>
            </div>
            @endif
        @endforeach
        </div>
    </div>
    </div>
</section>
<!-- Clients End -->
@endif

@php
$enable_newsletter_widget = App\Widgetsetting::where('name','newsletter')->first();
@endphp

@if($enable_newsletter_widget->home == '1' && isset($enable_newsletter_widget) || $enable_newsletter_widget->shop ==
"1")
<!-- Newspaper Start -->
<section id="newsletter" class="newsletter-main-block">
    <div class="container">
    <div class="row g-0">
        <div class="col-lg-6">
        <div class="newsletter-block">
            <h1 class="newsletter-title">@lang("news letter heading")</h1>
            <p>@lang("news letter words")</p>
            <div class="newsletter-mail">
            <form method="post" action="{{url('newsletter')}}">
                @csrf
                <input type="email" name="email" id="email" placeholder="Your Email" class="form-control">
                <button class="btn" type="submit"><i data-feather="send"></i></button>
            </form>
            <label>
                <input type="checkbox" checked="checked" name="subscribe">I agree with the terms and conditions
            </label>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="newsletter-img">
            <img src="frontend/assets/images/newsletter/newsletter.png" class="img-fluid" alt="">
            <div class="newsletter-dtl">
            <div class="code">CODE- NEW20</div>
            <p>Get 20% Off</p>
            <h4 class="title">On Sunglasses</h4>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!-- Newspaper End -->
@endif

@endsection