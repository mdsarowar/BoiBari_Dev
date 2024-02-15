@extends("frontend.layout.master")
@section('title','Boibari | My Account')
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
                              <li class="breadcrumb-item active" aria-current="page">{{__('Account')}}</li>
                          </ol>
                      </nav>
                      <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                          <div class="breadcrumb-nav">
                              <h3 class="breadcrumb-title">{{__('Account')}}</h3>
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
                  <?php $active['active'] = 'Info'; ?>
                  @include('frontend.profile.sidebar',$active)
                  <div class="col-lg-9 col-md-8">
                      <div class="tab-content" id="v-pills-tabContent">

                          <div class="personal-info-block">
                              <div>
                                  <h3 class="section-title">{{ __('Personal Information') }}</h3>
                              </div>
                              <div>
                                  <form method="post" action="{{url('update_profile/'.$user->id)}}" enctype="multipart/form-data">
                                      {{csrf_field()}}
                                      <div class="row">
                                          <div class="col-lg-6 col-md-6">
                                              <div class="mb-30">
                                                  <label for="firstname" class="form-label">{{ __('UserName') }} : <span class="required">*</span></label>
                                                  <input autofocus type="text" id="firstname" required name="name" value="{{$user->name}}" class="form-control" placeholder="Please enter User name">
                                                  <span class="required">{{$errors->first('name')}}</span>
                                              </div>
                                          </div>
                                          {{--                                <div class="col-lg-6 col-md-6">--}}
                                          {{--                                    <div class="mb-30">--}}
                                          {{--                                        <label for="lastname" class="form-label">{{ __('Email') }} : <span class="required">*</span></label>--}}
                                          {{--                                        <input autofocus type="text" id="lastname" required name="email" value="{{$user->email}}" class="form-control" placeholder="Please enter email">--}}
                                          {{--                                        <span class="required">{{$errors->first('email')}}</span>--}}
                                          {{--                                    </div>--}}
                                          {{--                                </div>--}}
                                          <div class="col-lg-6 col-md-6">
                                              <div class="mb-30">
                                                  <label for="mob" class="form-label">{{ __('Mobile No.') }} <span class="required">*</span></label>
                                                  <input placeholder="Please enter mobile no" type="text" id="mob" name="mobile" value="{{$user->mobile}}" class="form-control">
                                                  <span class="required">{{$errors->first('mobile')}}</span>
                                              </div>
                                          </div>
                                          {{--                                <div class="col-lg-6 col-md-6">--}}
                                          {{--                                    <div class="mb-30">--}}
                                          {{--                                        <label for="phone" class="form-label">{{ __('Phone No.') }}</label>--}}
                                          {{--                                        <input placeholder="Please enter Phone no" type="text" id="phone" name="phone" value="{{$user->phone}} " class="form-control">--}}
                                          {{--                                    </div>--}}
                                          {{--                                </div>--}}
                                          @include('frontend.bdlocation')
                                          <div class="col-lg-6 col-md-6">
                                              <div class="mb-30">
                                                  <label for="profile" class="form-label">{{ __('Profile') }}</label>
                                                  <input type="file" id="profile" name="image" onchange="readURL(this);" class="form-control">
                                              </div><br>
                                              <div class="thumbnail-img-block mb-3">
                                                  <img id="image-pre" class="img-fluid" alt="">
                                              </div>
                                          </div>
                                          <div class="col-lg-12">
                                              <div class="contact-form-btn">
                                                  <input type="submit" value="Update Profile" class="btn btn-primary">
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
@section("script")
<script>
    $('.thumbnail-img-block').hide();
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.thumbnail-img-block').show();
          $('#image-pre').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
@endsection
