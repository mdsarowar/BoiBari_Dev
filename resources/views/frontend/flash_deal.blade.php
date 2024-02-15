@extends("frontend.layout.master")
@section('title','Emart | Flash Deal Detail')
@section("content")   
    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item">{{__('Flash Deals')}}</li>
                            <li class="breadcrumb-item" aria-current="page">{{ $deal->title }}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                    <div class="breadcrumb-nav">
                        <h3 class="breadcrumb-title">{{ $deal->title }}</h3>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Deal Bg Start -->
    <div id="flash-deal-bg" class="flashdeal-bg-main-block">
      <div class="container">
        <div class="flashdeal-bg-block">
          <div class="flashdeal-bg-block-img">
            <img src="{{ url('frontend/assets/images/flash_deals/flash-deal-bg.png')}}" class="img-fluid" alt="{{$deal->title}}">
            <div class="flashdeal-bg-dtl">
              <div class="row">
                <div class="col-lg-8">
                  <div class="featured-countdown">
                    <div id="countdown">
                      <ul>
                        <li><span id="days"></span>Days</li>
                        <li><span id="hours"></span>Hours</li>
                        <li><span id="minutes"></span>Min</li>
                        <li><span id="seconds"></span>Sec</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="flashdeal-bg-img">
                    <img src="{{ url('images/flashdeals/'.$deal->background_image) }}" class="img-fluid" alt="{{$deal->title}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Flash Deal Bg End -->
    
    <!-- Flash Deal Start -->
    <section id="flash-deal-dtl" class="flash-deal-dtl-main-block">
        <div class="container">
            <div class="row">
                @forelse($deal->saleitems as $item)
                <div class="col-lg-3">
                    <div class="flash-deal-dtl-block">
                        @if(isset($item->variant))
                            <div class="flash-deal-dtl-img">
                                @if(isset($item->variant->variantimages))
                                <a href="{{ App\Helpers\ProductUrl::getUrl($item->variant->id) }}" title="{{$item->variant->products->name}}">
                                    <img src="{{ url('variantimages/'.$item->variant->variantimages->main_image) }}" class="img-fluid" alt="{{$item->variant->products->name}}">
                                </a>
                                @endif
                                <div class="overlay-bg"></div>
                                <div class="featured-product-icon">
                                    <ul>
                                        <li><a href="{{ App\Helpers\ProductUrl::getUrl($item->variant?$item->variant->id:'') }}" title="eye"><i data-feather="eye"></i></a></li>
                                        @auth
                                            @if(Auth::user()->wishlist()->count() < 1) 
                                                <li class="lnk wishlist">
                                                    <a class="addtowish" mainid="{{ $item->variant->id }}" title="{{ __('Add To WishList') }}" data-add="{{url('AddToWishList/'.$item->variant->id)}}" title="{{ __('Add To WishList') }}"> <i data-feather="heart"></i></a>
                                                </li>
                                            @else

                                                @php
                                                    $ifinwishlist = App\Wishlist::where('user_id',Auth::user()->id)->where('pro_id',$item->variant->id)->first();
                                                @endphp

                                                @if(!empty($ifinwishlist))
                                                <li class="lnk wishlist active">
                                                    <a class="addtowish" mainid="{{ $item->variant->id }}" title="{{ __('Remove From Wishlist') }}" data-add="{{url('removeWishList/'.$item->variant->id)}}"> <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                                @else
                                                <li class="lnk wishlist">
                                                <a title="{{ __('Add To WishList') }}" class="addtowish" mainid="{{ $item->variant->id }}" data-add="{{url('AddToWishList/'.$item->variant->id)}}"> <i data-feather="heart"></i> </a>
                                                </li>
                                                @endif

                                            @endif
                                        @endauth
                                        <li>
                                            
                                            <form method="POST" action="{{route('add.product.cart',['id' => $item->variant->products->id ,'variantid' =>$item->variant->products->id, 'varprice' => $item->variant->products->vender_price?$item->variant->products->vender_price:"0"  , 'varofferprice' => $item->variant->products->vender_offer_price?$item->variant->products->vender_offer_price:"0" ,'qty' =>'1'])}}" class="addVariantProCard{{$item->variant->products->id}}">
                                                {{ csrf_field() }}
                                                <a href="javascript:" onclick="addVariantProCard({{$item->variant->products->id}})" title="{{__('Add to Card')}}"><i data-feather="briefcase"></i></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flash-deal-dtl-detail">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="flash-deal-dtl-title"><a href="{{ App\Helpers\ProductUrl::getUrl($item->variant->id) }}" title="{{$item->variant->products->name}}">{{substr($item->variant->products->name, 0,20)}}</a></h6>
                                            <p>{{ substr(strip_tags($item->variant->products->des), 0, 30)}}{{strlen(strip_tags($item->variant->products->des))>30 ? '...' : ""}}</p>
                                            <div class="flash-deal-dtl-offer">
                                                <span class="badge text-bg-warning">Upto : {{ $item->discount }}% ({{ $item->discount_type }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if(isset($item->simple_product))
                            <div class="flash-deal-dtl-img">
                                <a href="{{ route('show.product',['id' => $item->simple_product->id, 'slug' => $item->simple_product->slug]) }}" title="{{ $item->simple_product->thumbnail }}">
                                    <img src="{{ url('images/simple_products/'.$item->simple_product->thumbnail) }}" class="img-fluid" alt="{{ $item->simple_product->thumbnail }}">
                                </a>
                                <div class="overlay-bg"></div>
                                <div class="flash-deal-dtl-icon">
                                    <ul>
                                        <li><a href="{{ route('show.product',['id' => $item->simple_product->id, 'slug' => $item->simple_product->slug]) }}" title="eye"><i data-feather="eye"></i></a></li>
                                        @auth

                                        @if($item->type != 'ex_product')
                                            <li>
                                                <a class="add_in_wish_simple" data-proid="{{ $item->id }}" data-status="{{ inwishlist($item->id) }}" data-toggle="tooltip" data-placement="right" title="{{__('Wishlist')}}" href="javascript:void(0)">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @endauth
                                        <li>
                                            <form method="POST" action="{{ $item->type == 'ex_product' ? $item->external_product_link : route('add.cart.simple',['pro_id' => $item->simple_product->id, 'price' => $item->simple_product->price, 'offerprice' => $item->simple_product->offer_price]) }}" class="addSimpleCardFrom{{$item->simple_product->id}}">
                                                @csrf
                                                <input name="qty" type="hidden" value="{{ $item->min_order_qty }}" max="{{ $item->max_order_qty }}" class="qty-section">
                                                <a href="javascript:" onclick="addSimpleProCard({{$item->simple_product->id}})" title="{{__('Add To Card')}}"><i data-feather="briefcase"></i></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flash-deal-dtl-detail">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="flash-deal-dtl-title"><a href="{{ route('show.product',['id' => $item->simple_product->id, 'slug' => $item->simple_product->slug]) }}" title="{{ $item->simple_product->product_name }}">{{ substr($item->simple_product->product_name, 0, 20) }}</a></h6>
                                            <p>{{ substr(strip_tags($item->simple_product->product_detail), 0, 30)}}{{strlen(strip_tags($item->simple_product->product_detail))>30 ? '...' : ""}}</p>
                                            <div class="flash-deal-dtl-offer">
                                                <span class="badge text-bg-warning">Upto {{ $item->discount }}% ({{ $item->discount_type }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Flash Deal End -->

@endsection
@section('script')
<script>
    (function () {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        let birthday = "{{ date('M d, Y h:i:s',strtotime($deal->end_date)) }}",
            countDown = new Date(birthday).getTime(),
            x = setInterval(function () {

                let now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / (day)),
                    document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                if (distance < 0) {
                    let headline = document.getElementById("headline"),
                        countdown = document.getElementById("countdown"),
                        content = document.getElementById("content");

                    headline.innerText = "It's my birthday!";
                    countdown.style.display = "none";
                    content.style.display = "block";

                    clearInterval(x);
                }
                //seconds
            }, 0)
    }());
</script>
@endsection
