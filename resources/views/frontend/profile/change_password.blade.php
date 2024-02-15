@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   
<div style="background-color: #fff8f5">

    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item">{{__('Account')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Change Password')}}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{ __('Change Password') }}</h3>
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
                <?php $active['active'] = 'ChangePassword'; ?>
                @include('frontend.profile.sidebar',$active)
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="personal-info-block">
                            <div class="card-header">
                                <h3 class="section-title">{{ __('Change Password') }}</h3>
                            </div>
                            <div class="card-body">
                                <form id="form1" action="{{ route('pass.update',$user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-30">
                                                <label for="old_password" class="form-label">{{ __('Old Password') }} : <span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input required="" type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="{{ __('Enter old password') }}" name="old_password" id="old_password" />
                                                    <span class="input-group-text oldpassword"><i class="fa fa-eye oldeye" aria-hidden="true"></i></span>
                                                </div>
                                                @error('old_password')
                                                <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-30">
                                                <label for="password" class="form-label">{{ __('Password') }} : <span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input required="" id="password" min="6" max="255" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter Password') }}" name="password" minlength="8" />
                                                    <span class="input-group-text password"><i class="fa fa-eye pwdeye" aria-hidden="true"></i></span>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-30">
                                                <label for="confirm_password" class="form-label">{{ __('Confirm Password') }} : <span class="required">*</span></label>
                                                <div class="input-group">
                                                    <input required="" id="confirm_password" type="password" class="form-control" placeholder="{{ __('Re-enter-password') }}" name="password_confirmation" minlength="8" />
                                                    <span class="input-group-text conpassword"><i class="fa fa-eye coneye" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-btn">
                                                <input @if(env('DEMO_LOCK')==0) type="submit" @else title="disabled" type="button" title="This action is disabled in demo !" @endif value="{{ __('Update Password') }}" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
@section('script')
<script>
    $(document).on('click', '.oldpassword', function() {
        $('.oldeye').toggleClass("fa-eye fa-eye-slash");
        var input = $("#old_password");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

    $(document).on('click', '.password', function() {
        $('.pwdeye').toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

    $(document).on('click', '.conpassword', function() {
        $('.coneye').toggleClass("fa-eye fa-eye-slash");
        var input = $("#confirm_password");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
</script>
@endsection

