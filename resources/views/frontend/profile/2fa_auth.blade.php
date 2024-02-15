@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   
<div style="background-color: #fff8f5">
    <!-- Home Start -->
    <section id="home" class="home-main-block product-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item">{{__('Account')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('2FA Auth')}}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{__('2FA Auth')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home End -->

    <!-- My Account Start -->
    <section id="my-account" class="my-account-main-block popular-item-main-block">
        <div class="container bg-white">
            <div class="row">
                <?php $active['active'] = '2Fa'; ?>
                @include('frontend.profile.sidebar',$active)
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="personal-info-block">
                            <div class="card-header">
                                <h3 class="section-title">{{ __('Enable 2 Factor Auth') }}</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.
                                </p>

                                @if($data['google2fa_url'] != '' )
                                    1. Scan this QR code with your Google Authenticator App:
                                @endif

                                @if($data['google2fa_url'] != '' )
                                    <div>
                                        {!! $data['google2fa_url'] !!}
                                    </div>
                                @endif
                                <hr>
                                @if($data['google2fa_url'] == '' )
                                    <form action="{{ url('/generate2faSecret') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">
                                                Generate Secret Key to Enable 2FA
                                            </button>
                                        </div>

                                    </form>
                                @endif

                                @if(auth()->user()->google2fa_secret != '' && auth()->user()->google2fa_enable == 0 )
                                    <form action="{{ url('/2fa-valid') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-normal">Enter pin from app or above code: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="one_time_password">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary mt-4">
                                                {{__('Enable 2FA Auth')}}
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                @if(auth()->user()->google2fa_enable == 1)
                                    <form action="{{ url('/disable-2fa') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label class="font-weight-normal">Enter current password to disable 2FA: <span class="text-danger">*</span></label>
                                            <input required type="password" placeholder="Enter current password" class="form-control @error('password') is-invalid @enderror" name="password">

                                            @error('password')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary mt-4">
                                                {{__('Disable 2FA Auth')}}
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account End -->

</div>
@endsection

