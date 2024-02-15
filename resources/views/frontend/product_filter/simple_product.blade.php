<div class="col-lg-4 col-md-6 col-6">
    <div class="featured-product-block">
        <div class="featured-product-img">
            <a href="{{ route('show.product',['id' => $simple_pro->id, 'slug' => $simple_pro->slug]) }}" title="">
                @if($simple_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$simple_pro->thumbnail))
                            
                    <img class="img-fluid" src="{{ url('images/simple_products/'.$simple_pro->thumbnail) }}" alt="{{ $simple_pro->product_name }}">

                @else

                    <img class="img-fluid" title="{{ $simple_pro->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />

                @endif
            </a>
            <div class="overlay-bg"></div>
            <div class="featured-product-icon">
                <ul>
                    <li><a href="{{ route('show.product',['id' => $simple_pro->id, 'slug' => $simple_pro->slug]) }}" title="eye"><i data-feather="eye"></i></a></li>
                    
                    @auth

                        @if($simple_pro->type != 'ex_product')
                            
                            <li class="lnk wishlist active">
                                <a class="text-dark add_in_wish_simple" data-proid="{{ $simple_pro->id }}" data-status="{{ inwishlist($simple_pro->id) }}" data-toggle="tooltip" data-placement="right" title="{{__('Wishlist')}}" href="javascript:void(0)">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>

                        @endif

                    @endauth
                    <li>
                        <form method="POST" action="{{ $simple_pro->type == 'ex_product' ? $simple_pro->external_product_link : route('add.cart.simple',['pro_id' => $simple_pro->id, 'price' => $simple_pro->price, 'offerprice' => $simple_pro->offer_price]) }}" class="addSimpleCardFrom{{$simple_pro->id}}">
                            @csrf

                            <input name="qty" type="hidden" value="{{ $simple_pro->min_order_qty }}" max="{{ $simple_pro->max_order_qty }}" class="qty-section">

                            <a href="javascript:" onclick="addSimpleProCard({{$simple_pro->id}})" title="{{__('Add To Card')}}"><i data-feather="briefcase"></i></a>

                        </form>
                    </li>
                </ul>
            </div>
            @if($simple_pro['sale_tag'] !== NULL && $simple_pro['sale_tag'] != '')
            <div class="featured-product-badge">
                <span class="badge" style="background : {{ $simple_pro['sale_tag_color'] }} ; color : {{ $simple_pro['sale_tag_text_color'] }}">
                            
                    {{ $simple_pro['sale_tag'] }}

                </span>
            </div>
            @endif
        </div>
        <div class="featured-product-dtl">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-7 col-7">
                    <h6 class="featured-product-title truncate">
                        <a href="{{ route('show.product',['id' => $simple_pro->id, 'slug' => $simple_pro->slug]) }}">
                            {{ $simple_pro->product_name }}
                        </a> 
                    </h6>
                    <p>{{__('By')}} 
                        <a href="{{ route('store.view',['uuid' => $simple_pro->store->uuid ?? 0, 'title' => $simple_pro->store->name]) }}">{{ $simple_pro->store->name }} 
                            @if($simple_pro->store->verified_store) 
                            <div class="verified-icon">
                                <i data-feather="check-circle"></i>
                            </div>
                            @endif
                        </a>
                    </p>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-5 col-5">
                    <div class="featured-product-price">
                        @if($price_login == 0 || auth()->check())
                            @if($simple_pro->offer_price != 0)

                                <span>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{ price_format($simple_pro->offer_price * $conversion_rate) }}
                                </span>
                                <s>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{ price_format($simple_pro->price * $conversion_rate) }}
                                </s>

                            @else

                                <span>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{ price_format($simple_pro->price * $conversion_rate) }}
                                </span>

                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>