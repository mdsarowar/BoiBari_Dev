@extends("frontend.layout.master")
@section('title','Emart | Contact us')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
        <nav aria-label="breadcrumb" class="breadcrumb-main-block">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Contact Form') }}</li>
            </ol>
        </nav>
        <div class="about-breadcrumb-block contact-breadcrumb" style="background-image: url('frontend/assets/images/contact/contact_bg.png');">
            <div class="overlay-bg"></div>
            <div class="breadcrumb-nav">
                <h3 class="breadcrumb-title">{{ __('Contact Form') }}</h3>
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
                <h4 class="strategy-title">We’re here available for you 24/7</h4>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et.</p>
            </div>
        </div>
    </div>
</section>
<!-- Strategy End -->

<!-- Contact Start -->
<section id="contact-us" class="contact-us-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="contact-us-block">
                    <div class="contact-img">
                        <img src="{{ url('frontend/assets/images/contact/map-location.png') }}" class="img-fluid" alt="">
                    </div>
                    <div><a href="#" title="Address">{{ $settings['address'] }}</a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="contact-us-block">
                    <div class="contact-img">
                        <img src="{{ url('frontend/assets/images/contact/phone.png') }}" class="img-fluid" alt="">
                    </div>
                    <div><a href="tel:+{{ $settings['mobile'] }}" title="Phone No.">{{ $settings['mobile'] }}</a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="contact-us-block">
                    <div class="contact-img">
                        <img src="{{ url('frontend/assets/images/contact/email.png') }}" class="img-fluid" alt="">
                    </div>
                    <div><a href="mailto: {{ $settings['email'] }}" title="Email">{{ $settings['email'] }}</a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="contact-us-block">
                    <div class="contact-img">
                        <img src="{{ url('frontend/assets/images/contact/world-wide-web.png') }}" class="img-fluid" alt="">
                    </div>
                    <div><a href="mailto: {{ $settings['email'] }}" title="Email">{{ $settings['email'] }}</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact End -->

<!-- Contact Form Start -->
<section id="contact-form" class="contact-form-main-block">
    <div class="container">
        <div class="contact-form-block">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h3 class="section-title">{{__('Drop Message')}}</h3>
                    <form action="{{ route('get.connect') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="mb-3">

                                    <label for="firstname" class="form-label">{{ __('Your Name') }}</label>
                                    <input required name="name" type="text" class="@error('name') 'is-invalid' @enderror form-control unicase-form-control text-input" id="name" value="{{ old('name') }}" placeholder="{{ __('Enter Name') }}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mb-3">

                                    <label class="form-label" for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input required name="email" type="email" class="@error('email') 'is-invalid' @enderror form-control unicase-form-control text-input" id="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mb-3">

                                    <label class="form-label" for="mobile">{{ __('Mobile No.') }}</label>
                                    <input type="number" class="@error('mobile') 'is-invalid' @enderror form-control unicase-form-control text-input" id="mobile" value="{{ old('mobile') }}" placeholder="{{ __('Enter Mobile No.') }}">
                                    @error('mobile')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mb-3">

                                    <label class="form-label" for="subject">{{ __('Subject') }}: <span class="text-danger">*</span></label>
                                    <input required name="subject" required type="text" class="@error('subject') 'is-invalid' @enderror form-control unicase-form-control text-input" id="subject" value="{{ old('subject') }}" placeholder="{{ __('Please Enter Subject') }}">
                                    @error('subject')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="mb-3">

                                    <label class="form-label" for="message">{{ __('Message') }}<span class="text-danger">*</span></label>
                                    <textarea rows="5" cols="30" name="message" required placeholder="{{ __('Please Enter Message') }}" class="form-control @error('message') 'is-invalid' @enderror unicase-form-control" id="message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="contact-form-btn">
                                    <input type="submit" class="btn btn-primary" value="Send Message">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form End -->
<section id="contact-form" class="contact-form-main-block">
    <div class="container">
        <div class="contact-form-block">
            <div class="row">
                <iframe width="600" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=450&amp;hl=en&amp;q={{ $settings['address'] }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- Map Start -->
<section id="map-block" class="map-main-block">
    <div class="container">
        <!-- <div id="map"></div> -->
    </div>
</section>
<!-- Map End -->

@endsection