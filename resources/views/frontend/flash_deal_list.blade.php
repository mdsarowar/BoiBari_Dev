@extends("frontend.layout.master")
@section('title','Emart | Flash Deal List')
@section("content")   
<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Flash Deals')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ __('Flash Deals') }}</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->
<div id="flash-deal-bg" class="flashdeal-bg-main-block flash-deal-list-main-block">
    <div class="container">
        <div class="row">
            @if($deals)
                @foreach($deals as $deal)
                <div class="col-lg-3">
                    <a href="{{ route('flashdeals.view',['id' => $deal->id, 'slug' => str_slug($deal->title,'-')]) }}" title="{{$deal->title}}">
                        <div class="card flash-deal-list-page border-hover">
                            <div class="border-hover-two">
                                <div class="flash-deal-list-page-img">
                                    <img src="{{ url('images/flashdeals/'.$deal->background_image) }}" class="img-fluid" alt="{{$deal->title}}">
                                </div>
                                <div class="card-body buttons">
                                    <h4 class="mb-3">{{$deal->title}}</h4>
                                    <p class="card-text"><b>{{__("Sale Start Date:")}}</b> {{ date('d-m-Y @ h:i A',strtotime($deal->start_date)) }}</p>
                                    <p class="card-text"><b>{{__("Sale End Date:")}}</b> {{ date('d-m-Y @ h:i A',strtotime($deal->end_date)) }}</p>
                                    <a href="{{ route('flashdeals.view',['id' => $deal->id, 'slug' => str_slug($deal->title,'-')]) }}" class="btn btn-primary"> {{__("View Deal")}}</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
            <div class="text-center">
                <h3>{{ __("No deals") }}</h3>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection