@extends('frontend.layout.master')
@section('title',"Emart | Featured Products")
@section('content')


<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Featured Product')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/') ?>/frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ __('Featured Product') }}</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->
<!-- Home End --> 
<section id="product" class="product-main-block">
    <div class="container">
        <div class="row">
            @foreach($products as $key => $featured_pro)
                <div class="col-lg-4 col-md-4 col-6">
                    <div class="featured-product-block">
                        <div class="featured-product-img">
                            <a href="javascript:" title="">
                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}" class="img-fluid" alt="{{__($featured_pro->product_name)}}">
                                @else
                                <img class="img-fluid" title="{{ $featured_pro->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                                @endif
                            </a>
                            <div class="overlay-bg"></div>
                            <div class="featured-product-icon">
                                <ul>
                                    <li><a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}" title="eye"><i data-feather="eye"></i></a></li>
                                    @auth

                                        @if($featured_pro->type != 'ex_product')
                                            
                                            <li>
                                                <a class="add_in_wish_simple" data-proid="{{ $featured_pro->id }}" data-status="{{ inwishlist($featured_pro->id) }}" data-toggle="tooltip" data-placement="right" title="{{__('Wishlist')}}" href="javascript:void(0)">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>

                                        @endif

                                    @endauth
                                    <li>
                                        <form method="POST" action="{{ $featured_pro->type == 'ex_product' ? $featured_pro->external_product_link : route('add.cart.simple',['pro_id' => $featured_pro->id, 'price' => $featured_pro->price, 'offerprice' => $featured_pro->offer_price]) }}" class="addSimpleCardFrom{{$featured_pro->id}}">
                                            @csrf

                                            <input name="qty" type="hidden" value="{{ $featured_pro->min_order_qty }}" max="{{ $featured_pro->max_order_qty }}" class="qty-section">

                                            <a href="javascript:" onclick="addSimpleProCard({{$featured_pro->id}})" title="{{__('Add To Card')}}"><i data-feather="briefcase"></i></a>

                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured-product-badge">
                                @if($featured_pro->offer_price != 0)
                                    @php
                                        $conversion_rate = 1;
                                        $getdisprice = ($featured_pro->price*$conversion_rate) - ($featured_pro->offer_price * $conversion_rate);
                                        $gotdis = $getdisprice/($featured_pro->price * $conversion_rate);
                                        $offamount = round($gotdis*100);

                                    @endphp
                                    <span class="badge text-bg-warning">{{ $offamount }}% {{__("off")}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="featured-product-dtl">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h6 class="featured-product-title truncate"><a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}" title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a></h6>
                                    <p>By <span>{{__($featured_pro->store?$featured_pro->store->name:'')}}</span></p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="featured-product-price">
                                        <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                        {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection