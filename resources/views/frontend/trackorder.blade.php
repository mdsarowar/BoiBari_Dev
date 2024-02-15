@extends("frontend.layout.master")
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}"/>
@endsection
@section('title','BoiBari | Track Order')
@section("content") 


    <!-- Home Start -->
    <section id="home" class="home-main-block product-home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb" class="breadcrumb-main-block">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}" title="{{__('Home')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('Track Order')}}</li>
              </ol>
            </nav>
            <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
              <div class="breadcrumb-nav">
                <h3 class="breadcrumb-title">{{__('Track Order')}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Home End -->

        <!-- Track Start -->
    <section id="track" class="track-main-block">
      <div class="container">
         <!-- Track Start -->
        <div class="mb-1" id="trackorder">
            <track-order :trackid="'{{ app('request')->input('trackingid') }}'"></track-order>
        </div>
      </div>
    </section>
    <!-- Track End -->




@endsection
@section('script')
   <script>var baseURL = @json(url('/'));</script>
   <script src="{{ url('js/trackorder.js') }}"></script>
@endsection