@extends("frontend.layout.master")
@section('title','Emart | My Account')
@section("content")   

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
      </div>
    </div>
  </div>
</section>
<!-- Home End -->

<!-- My Account Start -->
<section id="my-account" class="my-account-main-block popular-item-main-block">
  <div class="container">
    <div class="row">
      <?php $active['active'] = ''; ?>
      @include('frontend.profile.sidebar',$active)
      <div class="col-lg-9 col-md-8">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade" id="v-password" role="tabpanel" aria-labelledby="v-password-tab" tabindex="0">@include('frontend.profile.change_password')</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- My Account End -->

@endsection

