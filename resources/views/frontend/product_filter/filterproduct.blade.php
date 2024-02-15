<div class="col-lg-4 col-md-6 col-6">
    <div class="featured-product-block">
        <div class="featured-product-img">
            <a href="{{ $product->getURL($sub) }}" title="">
                @if(count($product->subvariants)>0)

                    @if(isset($sub->variantimages['main_image']))

                    <img class="img-fluid" src="{{url('variantimages/thumbnails/'.$sub->variantimages['main_image'])}}" alt="{{$sub->products->name}}" />

                    @endif

                @else

                    <img class="img-fluid" title="{{ $sub->name }}" src="{{url('images/no-image.png')}}" alt="{{__('No Image')}}" />

                @endif
            </a>
            <div class="overlay-bg"></div>
            <div class="featured-product-icon">
                <ul>
                    <li><a href="{{ $product->getURL($sub) }}" title="eye"><i data-feather="eye"></i></a></li>
                    @auth
                        @if(Auth::user()->wishlist()->count() < 1) 
                            <li class="lnk wishlist">
                                <a class="addtowish" mainid="{{ $product->id }}" title="{{ __('Add To WishList') }}" data-add="{{url('AddToWishList/'.$product->id)}}" title="{{ __('Add To WishList') }}"> <i data-feather="heart"></i></a>
                            </li>
                        @else

                            @php
                                $ifinwishlist = App\Wishlist::where('user_id',Auth::user()->id)->where('pro_id',$product->id)->first();
                            @endphp

                            @if(!empty($ifinwishlist))
                            <li class="lnk wishlist active">
                                <a class="addtowish add-wishlist" mainid="{{ $product->id }}" title="{{ __('Remove From Wishlist') }}" data-add="{{url('removeWishList/'.$product->id)}}"> <i data-feather="heart"></i>
                                </a>
                            </li>
                            @else
                            <li class="lnk wishlist">
                                <a title="{{ __('Add To WishList') }}" class="addtowish" mainid="{{ $product->id }}" data-add="{{url('AddToWishList/'.$product->id)}}"> <i data-feather="heart"></i> </a>
                            </li>
                            @endif

                        @endif
                    @endauth
                   
                    <li>
                        <form method="POST" action="{{route('add.product.cart',['id' => $product->id ,'variantid' =>$sub->id, 'varprice' => $show_price, 'varofferprice' => $convert_price ,'qty' =>$sub->min_order_qty])}}" class="addVariantProCard{{$product->id}}">
                            {{ csrf_field() }}
                            <a href="javascript:" onclick="addVariantProCard({{$product->id}})" title="{{__('Add to Card')}}"><i data-feather="briefcase"></i></a>
                        </form>
                    </li>
                </ul>
            </div>
            @if($product['sale_tag'] !== NULL && $product['sale_tag'] != '')
            <div class="featured-product-badge">               
                <span class="badge text-bg-primary">
                            
                    {{ $product['sale_tag'] }}

                </span>
            </div>
            @endif
        </div>
        <div class="featured-product-dtl">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7 col-7">
                    <h6 class="featured-product-title truncate">
                        <a href="{{ $product->getURL($sub) }}">{{$product->name}}
                            ({{ variantname($sub) }})
                        </a>
                    </h6>
                    <p>{{__('By')}} 
                        <a href="{{ route('store.view',['uuid' => $product->store->uuid ?? 0, 'title' => $product->store->name]) }}">{{ $product->store->name }} 
                            @if($product->store->verified_store)
                            <div class="verified-icon">
                                <i data-feather="check-circle"></i>
                            </div>
                            @endif
                        </a>
                    </p>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-5">
                    <div class="featured-product-price">
                        @if($price_login == 0 || auth()->check())
                              
                            @if($convert_price != 0)

                                <span>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{price_format($convert_price * $conversion_rate)}}
                                </span>
                                <s>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{price_format($show_price * $conversion_rate)}}
                                </s>

                            @else

                                <span>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    {{price_format($show_price * $conversion_rate)}}
                                </span>

                            @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>