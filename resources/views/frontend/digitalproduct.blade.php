@extends("frontend.layout.master")
@section('title', "BoiBari | $product->product_name")
@section('meta_tags')
  <link rel="canonical" href="{{ url()->full() }}" />
  <meta name="robots" content="all">
  <meta property="og:title" content="{{ $product->product_name }}" />
  <meta name="keywords" content="{{ $product->tags ?? ''}}">
  <meta property="og:description" content="{{substr(strip_tags($product->product_detail), 0, 100)}}{{strlen(strip_tags( $product->product_detail))>100 ? '...' : ""}}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url()->full() }}" />
  <meta property="og:image" content="{{ url('images/simple_products/'.$product->thumbnail) }}" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:description" content="{{substr(strip_tags($product->product_detail), 0, 100)}}{{strlen(strip_tags( $product->product_detail))>100 ? '...' : ""}}" />
  <meta name="twitter:site" content="{{ url()->full() }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Drift Zoom CSS -->
  <link rel="stylesheet" href="{{ url('css/vendor/drift-basic.min.css') }}">
  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
@endsection
@section("content")
<div style="background-color: #fff8f5">

  {{--  {{session()->get('guest_cart')}}--}}

  <section id="home" class="home-main-block product-home ">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb" class="breadcrumb-main-block">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>

            </ol>
          </nav>
          <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
            <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">
                @if(!empty($product->childcat->title))
                  {{$product->childcat->title ?? ''}}
                @else
                  {{ $product->category->title ?? '' }}
                @endif
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home End -->

  <!-- Product Start -->
  <section id="product" class="product-main-block">
    <div class="container bg-white">
      <div class="row">
        <div class="col-lg-5">
          <div class="product-des-img-block">
            <div class="slick-slider-block">
              <div class="slider slider-for">
                <div id="single-product-gallery-item">
                  @isset($product->productGallery)
                    <a href="{{ url('images/simple_products/gallery/'.$product->productGallery[0]['image']) }}" data-title="{{ $product->product_name }}">
                      <img src="{{ url('images/simple_products/gallery/'.$product->productGallery[0]['image']) }}" data-zoom="{{ url('images/simple_products/gallery/'.$product->productGallery[0]['image']) }}" class="img-fluid thumb_pro_img img img-fluid zoom-img " alt="">
                    </a>
                  @endisset
                </div>
              </div>
              <div class="slider slider-nav">
                @isset($product->productGallery)
                  @if(count($product->productGallery) > 1)
                    @foreach($product->productGallery as $gallery)
                      <div>
                        <a href="javascript:">
                          <img onclick="changeImage2('{{ url('images/simple_products/gallery/'.$gallery->image) }}')" alt='productimage' class="img-fluid" src="{{ url('images/simple_products/gallery/'.$gallery->image) }}">
                        </a>
                      </div>
                    @endforeach
                  @endif
                @endisset
              </div>
            </div>
          </div>
          <div id="details-container"></div>
        </div>
        <div class="col-lg-3 ">
          <div class="deals-dtl-block">
            <div class="deals-avail-block">
              <span>{{ __('Availability') }} :</span>
              @if($product->pre_order == 1 && $product->product_avbl_date > date('Y-m-d h:i:s'))
                <div class="deal-avail-text text-warning">{{ __("Available for pre-order") }}</div>
              @else
                <div class="deal-avail-text {{ $product->stock == 0 ? "text-danger" : "text-success"}}"> {{ $product->stock == 0 ? __("Out of Stock") : __("In Stock") }}</div>
              @endif
            </div>

            <h3 class="deals-dtl-title">{{$product->product_name}} </h3>
            @if($product->selling_start_at <= date("Y-m-d H:i:s"))
            @else
              <h3 class="text-warning">{{ __('ComingSoon') }}</h3>
            @endif
            <?php

            $review_t = 0;

            $price_t = 0;

            $value_t = 0;

            $sub_total = 0;

            $count = count($product->reviews);

            $onlyrev = array();

            foreach ($product->reviews->where('status','1') as $review) {
              $review_t = $review->qty * 5;
              $price_t = $review->price * 5;
              $value_t = $review->value * 5;
              $sub_total = $sub_total + $review_t + $price_t + $value_t;
            }

            $count = ($count * 3) * 5;

            if ($count != "" && $count != 0) {
              $rat = $sub_total / $count;

              $ratings_var = ($rat * 100) / 5;

              $overallrating = ($ratings_var / 2) / 10;
            }

            ?>

            @php
              $count = 0;
            @endphp
            @if(isset($overallrating))
              @if(isset($ratings_var))
                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%;" class="star-ratings-sprite-rating"></span></div>
              @endif
              <span>{{  $count =  count($product->reviews) }} {{ __('Ratings and') }} {{ $reviewcount }} {{ __('Reviews') }}</span>
            @else
              <span>{{__('No Rating')}}</span>
            @endif

            <div class="deals-dtl-price">
              @if($product->pre_order == 1 && $product->product_avbl_date > date('Y-m-d h:i:s'))
                <ul>
                  <li class="deals-price">
                    <i class="{{ session()->get('currency')['value'] }}"></i> {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price)  }}
                  </li>
                  @if($product->offer_price != 0)
                    <li><s> <i class="{{ session()->get('currency')['value'] }}"></i> {{ price_format($product->price ) }}<s></li>
                  @endif
                  <li class="deals-price-off">
                    @if($product->preorder_type == 'partial')

                      @php
                        echo '<p class="text-primary"> (Pay '.$product->partial_payment_per.'% of product price now and rest amount pay when product is available).</p>';
                        $price   = $product->offer_price != 0 ? $product->offer_price : $product->price;
                        $d_price = ($price * $product->partial_payment_per / 100);
                        $d_price = price_format($d_price);
                        $print_price = '<i class="'.session()->get('currency')['value'].'"></i>';
                        echo "<h4 class='text-info'>Pre order payable amount ";
                        echo '<span class="">'.$print_price.$d_price.'</span></h4>';

                      @endphp


                    @endif
                  </li>
                </ul>
              @else
                <ul>

                  <li class="deals-price">
                    <!--price-->
                    <i class="{{ session()->get('currency')['value'] }}"></i>
                    {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price )  }}
                  </li>
                  @if($product->offer_price != 0)
                    <li>
                      <s>
                        <i class="{{ session()->get('currency')['value'] }}"></i> {{ price_format($product->price ) }}
                      </s>
                    </li>
                  @endif
                  <li class="deals-price-off">
                    @if($product->offer_price != 0)
                      @php

                        $getdisprice = ($product->price) - ($product->offer_price);
                        $gotdis = $getdisprice/($product->price );
                        $offamount = round($gotdis*100);

                      @endphp
                      &nbsp;{{ $offamount }}% {{__("off")}}
                    @endif
                    &nbsp;<i data-toggle="tooltip" data-placement="left" title="{{ $product->tax == '' ? __('Taxes Not Included') : __('Taxes Included') }}" data-feather="alert-circle"></i>
                  </li>
                </ul>
              @endif
            </div>
            @if(isset($cashback_settings) && $cashback_settings->enable == 1)
              <div class="alert alert-success mb-30" role="alert">
                {{ __("Buy now and earn cashback in your wallet") }} {{ $cashback_settings->discount_type }}  @if($cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ sprintf("%.2f", $cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $cashback_settings->discount.'%' }}</b> @endif
              </div>
            @endif
            <div class="deals-dtl-offers">
              {{--                <div class="row">--}}
              {{--                  <div class="col-lg-6 mb-10">--}}
              {{--                    <div class="deals-size">--}}
              {{--                      <h6 class="deals-size-title">{{ __('By') }} :--}}
              {{--                          <span>--}}
              {{--                            <a href="{{ route('store.view',['uuid' => $product->store->uuid ?? 0, 'title' => $product->store->name]) }}">--}}
              {{--                              {{ $product->store->name }} --}}
              {{--                              @if($product->store->verified_store) --}}
              {{--                              <i title="Verified" class="text-green fa fa-check-circle"></i> --}}
              {{--                              @endif--}}
              {{--                            </a>--}}
              {{--                          </span>--}}
              {{--                      </h6>--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  <div class="col-lg-6 mb-10">--}}
              {{--                    <div class="deals-size">--}}
              {{--                      <h6 class="deals-size-title">{{__('Brand')}} : <span>{{$product->brand->name ?? ''}}</span> </h6>                      --}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  @if(isset($product->key_features))--}}
              {{--                    @if(isset($product->sizechart) && $product->size_chart != '' && $product->sizechart->status == 1)--}}
              {{--                      <div class="col-lg-6">--}}
              {{--                        <div class="deal-size-chart mb-30">--}}
              {{--                          <h6 class="deals-size-title">Size :--}}
              {{--                            <span class="deal-size-chart-btn">--}}
              {{--                              <a href="javascript:"  class="btn btn-primary" data-toggle="modal" data-target="#previewModal"><i data-feather="bar-chart"></i>{{__('View Size Chart')}}</a>--}}
              {{--                            </span>--}}
              {{--                          </h6>--}}
              {{--                        </div>--}}
              {{--                      </div>--}}
              {{--                    @endif--}}
              {{--                  @endif--}}
              {{--                </div>--}}


              <div class="deals-btn">
                <ul>
                  <li>
                    @if($product->stock != 0)
                      @if($product->pre_order == 1 && $product->product_avbl_date > date('Y-m-d h:i:s'))

                        @if($product->preorder_type == 'partial')
                          @php
                            $price   = $product->offer_price != 0 ? $product->offer_price : $product->price;
                            $d_price = ($price * $product->partial_payment_per / 100);
                          @endphp
                        @endif

                        <form action="{{ route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $d_price ?? $product->offer_price]) }}" method="POST">
                          @csrf
                          <div>
                            <div class="cart-quantity">
                              <div class="quant-input">
                                <input type="hidden" value="1" name="qty" min="1" max="1" class="qty-section">
                              </div>
                            </div>
                            <div class="add-btn mb-30">
                              @if($product->type == 'ex_product')
                                <a href="{{ $product->external_product_link }}" role="button" class="btn btn-primary"> {{__("Buy Now")}} <span class="sr-only">(current)</span>
                                </a>
                              @else
                                <button type="submit" class="btn btn-primary">
                                  {{__("Pre-order now")}}
                                </button>
                              @endif
                            </div>
                          </div>
                        </form>

                      @else

                        <form action="{{ route('add.cart.simple.product',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => (isset($d_price)) ? $d_price : (($product->offer_price != 0 || $product->offer_price != '') ? $product->offer_price : 0)]) }}" method="POST">
                          @csrf
                          <div>
                            <div class="cart-quantity mb-30">
                              <div class="quant-input">
                                <input type="hidden" value="1" name="qty" min="{{ $product->min_order_qty }}" max="{{ $product->max_order_qty != '' ? $product->max_order_qty : ''}}" maxorders="null" class="qty-section">
                              </div>
                            </div>
                            <div class="add-btn mb-30">
                              @if($product->type == 'ex_product')
                                <a href="{{ $product->external_product_link }}" role="button" class="btn btn-primary"> {{__("Buy Now")}} <span class="sr-only">(current)</span>
                                </a>
                              @else
                                <button type="submit" class="btn btn-primary">
                                  {{__("Buy Now")}}
                                </button>
                              @endif
                            </div>
                          </div>
                        </form>

                      @endif
                    @else
                      @if($product->stock == 0)
                        <button type="button" data-target="#notifyMe" data-toggle="modal" class="btn btn-primary">{{ __("NOTIFY ME") }}</button>
                      @endif
                    @endif
                  </li>
                  <li class="deals-icon bg-dark ">
                    <form method="POST"
                          action="{{ $product->type == 'ex_product' ? $product->external_product_link : route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $product->offer_price]) }}"
                          class="addSimpleCardFrom{{$product->id}}">
                      @csrf

                      <input name="qty" type="hidden"
                             value="{{ $product->min_order_qty }}"
                             max="{{ $product->max_order_qty }}"
                             class="qty-section">

                      <a id="go_to_cart_page" href="javascript:" class="text-light"
                         onclick="addSimpleProCard({{$product->id}})"
                         data-bs-toggle="tooltip" data-bs-placement="left"
                         data-bs-title="{{__('Add To Cart')}}"><i
                                data-feather="shopping-cart"></i> Add To Cart</a>

                    </form>
                  </li>


                </ul>
                <div class="row mt-0">
                  <div class="col-md-12">
                    {{--                      @if($product->type != 'ex_product')--}}
                    <ul>

{{--                      <li class="deals-icon">--}}
                        {{--                            <button type="button" class="btn btn-primary" data-toggle="modal" data-placement="left" title="Share" data-target="#pdfmodal">--}}
                        {{--                              {{__("Show")}}--}}
                        {{--                            </button>--}}
                        <button type="button" class="btn btn-primary p-2 m-0" data-bs-toggle="modal" data-bs-target="#pdfmodal">
                          একটু পড়ে দেখুন
                        </button>
{{--                      </li>--}}
                      <li class="deals-icon"><a class="add_in_wish_simple" data-proid="{{ $product->id }}" data-status="{{ inwishlist($product->id) }}" data-toggle="tooltip" data-placement="right" title="{{ inwishlist($product->id) == false ? __("Add To WishList") :  __("Remove From Wishlist") }}" href="javascript:void(0)"><i data-feather="heart"></i></a></li>
                      <li class="deals-icon"><a href="javascript:" data-toggle="modal" data-placement="right" title="Share" data-target="#sharemodal"><i data-feather="share-2"></i></a></li>

                    </ul>

                    {{--                       / @php--}}
                    {{--                        $m=0;--}}
                    {{--                        @endphp--}}

                    {{--                        @if(!empty(Session::get('comparison')))--}}

                    {{--                          @foreach(Session::get('comparison') as $p)--}}

                    {{--                            @if($p['proid'] == $product->id)--}}
                    {{--                              @php--}}
                    {{--                              $m = 1;--}}
                    {{--                              break;--}}
                    {{--                              @endphp--}}
                    {{--                            @else--}}
                    {{--                              @php--}}
                    {{--                              $m = 0;--}}
                    {{--                              @endphp--}}
                    {{--                            @endif--}}

                    {{--                          @endforeach--}}

                    {{--                        @endif--}}
                    {{--                      <li class="deals-icon">--}}
                    {{--                        <a href="javascript:"--}}
                    {{--                           onclick="addSimpleProCard({{$product->id}})"--}}
                    {{--                           data-bs-toggle="tooltip" data-bs-placement="left"--}}
                    {{--                           data-bs-title="{{__('Add To Cart')}}"><i--}}
                    {{--                                  data-feather="shopping-cart"></i></a>--}}
                    {{--                      </li>--}}
                    <!-- Share Modal -->
                    <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <div class="share-content modal-body">
                            @php
                              //                                Jorenvh\Share\Providers\ShareServiceProvider::Page(url()->full(),null,[],'<div class="row fs-2">', '</div>')->facebook();
                                                                echo Share::Page(url()->full(),null,[],'<div class="row fs-2">', '</div>')
                                                                ->facebook()
                                                                ->twitter()
                                                                ->telegram()
                                                                ->whatsapp();
                            @endphp
                          </div>

                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->


                    <!-- pdf Modal -->
                    <div class="modal fade" id="pdfmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$product->product_name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="share-content modal-body">
                            @if(($product->product_file != null))
                              <embed src="{{ asset('digitalproducts/files/'.$product->product_file)  }}" width="100%" height="2100px" />
                            @else
                              <h4>File Not Uploded here!!!</h4>
                            @endif
                            {{--                              @isset($product->product_file)--}}
                            {{--                               --}}
                            {{--                              @endisset--}}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{--                              <button type="button" class="btn btn-primary">Save changes</button>--}}
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- End Modal -->
                    {{--                      @endif--}}
                  </div>
                </div>
              </div>

              @if($pincodesystem == 1)
                <div class="deals-delivery-code">
                  <h6 class="delivery-title">{{__('Delivery Details')}}</h6>
                  <form id="myForm" method="post">
                    {{csrf_field()}}
                    <div class="form-group">

                      <div class="input-group mb-3">
                        <input placeholder="{{ __('Enter Pincode') }}" required class="pincode-input form-control"
                               onchange="SubmitFormData()" type="text" id="deliveryPinCode" value="">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                              <i id="marker-map" class="fa fa-map-marker"></i>
                            </span>
                        </div>
                      </div>

                      <span id="pincodeResponce"></span>
                    </div>
                  </form>
                </div>
              @endif
              <div>
                <p></p>
                <div class="description-heading">{{ __('Other Services') }}</div>
                <div class="price-container info-container">
                  <div class="delivery-detail text-center">
                    <div class="row">
                      @if($product->cod_avbl == 1)
                        <div class="col-lg-3 col-4">
                          <div class="image">
                            <img src="{{url('/images/icon-cod.png')}}" class="img-fluid" alt="img">
                          </div>
                          <div class="detail text-center">{{ __('Pay on Delivery') }}</div>
                        </div>
                      @endif
                      @if($product->return_avbl == 1)
                        <div class="col-lg-3 col-4">
                          <div data-toggle="modal" data-target="#returnmodal" class="image">
                            <img src="{{url('/images/icon-returns.png')}}" class="img-fluid" alt="img">
                          </div>
                          <div class="detail">{{ $product->returnPolicy?$product->returnPolicy->days:'' }} {{ __('Days Return') }} </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="returnmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                          aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="myModalLabel">{{ $product->returnPolicy?$product->returnPolicy->name:'' }}</h5>
                              </div>
                              <div class="modal-body">
                                {!! $product->returnPolicy?$product->returnPolicy->des:'' !!}
                              </div>

                            </div>
                          </div>
                        </div>
                      @else
                        <div class="col-lg-3 col-4">
                          <div data-toggle="modal" data-target="#returnmodal" class="image">
                            <img src="{{url('/images/icon-returns.png')}}" class="img-fluid" alt="img">
                          </div>
                          <div class="detail">{{ __('No Return') }}</div>
                        </div>
                      @endif
                      @if($product->free_shipping == 1)
                        <div class="col-lg-4 col-4">
                          <div class="image">
                            <img src="{{url('/images/icon-delivered.png')}}" class="img-fluid" alt="img">
                          </div>
                          <div class="detail">{{config('app.name')}} {{ __('Free Delivery') }}</div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="deals-highlight">
                  <h6 class="delivery-title">{{ __('Highlight') }}</h6>
                  <ul>
                    <li>{!! $product->key_features !!}</li>
                  </ul>
                </div>
                @if(isset($product->key_features))
                  <div class="report-text">
                    <a href="#reportproduct" data-toggle="modal">
                      <i data-feather="flag"></i>{{ __('Report Product') }}.
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          {{--            <div class="col-lg-12" >--}}
          <div class="row">
            <div class="col-md-12">
              <div class="card bg-primary mb-2">
                <div class="card-body">
                  <h4 class="text-light">Related product</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            @if(isset($latest_products))
              @foreach($latest_products as $key => $featured_pro)
                {{--                    @if(!$key==0)--}}
                <div class="col-lg-6 col-md-6 col-6">
                  <div class="featured-product-block">
                    <div class="featured-product-img">
                      <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}" title="">
                        @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                          <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                               class="img-fluid"
                               alt="{{__($featured_pro->product_name)}}"
                               style="height: 200px">
                        @else
                          <img class="img-fluid"
                               title="{{ $featured_pro->product_name }}"
                               src="{{url('images/no-image.png')}}" alt="No Image"
                               style="height: 200px">
                        @endif
                      </a>
                      <div class="featured-product-icon">
                        <ul>
                          <li>
                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                               data-bs-toggle="tooltip" data-bs-placement="left"
                               data-bs-title="{{__('View')}}"><i
                                      data-feather="eye"></i></a></li>
                          @auth

                            @if($featured_pro->type != 'ex_product')

                              @if(inwishlist($featured_pro->id))
                                <li>
                                  <a class="add_in_wish_simple add-wishlist"
                                     data-proid="{{ $featured_pro->id }}"
                                     data-bs-status="{{ inwishlist($featured_pro->id) }}"
                                     data-bs-toggle="tooltip"
                                     data-bs-placement="left"
                                     data-bs-title="{{__('Wishlist')}}"
                                     href="javascript:void(0)">
                                    <i data-feather="heart"></i>
                                  </a>
                                </li>
                              @else
                                <li>
                                  <a class="add_in_wish_simple"
                                     data-proid="{{ $featured_pro->id }}"
                                     data-bs-status="{{ inwishlist($featured_pro->id) }}"
                                     data-bs-toggle="tooltip"
                                     data-bs-placement="left"
                                     data-bs-title="{{__('Wishlist')}}"
                                     href="javascript:void(0)">
                                    <i data-feather="heart"></i>
                                  </a>
                                </li>
                              @endif

                            @endif

                          @endauth
                          <li>
                            <form method="POST"
                                  action="{{ $featured_pro->type == 'ex_product' ? $featured_pro->external_product_link : route('add.cart.simple',['pro_id' => $featured_pro->id, 'price' => $featured_pro->price, 'offerprice' => $featured_pro->offer_price]) }}"
                                  class="addSimpleCardFrom{{$featured_pro->id}}">
                              @csrf

                              <input name="qty" type="hidden"
                                     value="{{ $featured_pro->min_order_qty }}"
                                     max="{{ $featured_pro->max_order_qty }}"
                                     class="qty-section">

                              <a href="javascript:"
                                 onclick="addSimpleProCard({{$featured_pro->id}})"
                                 data-bs-toggle="tooltip" data-bs-placement="left"
                                 data-bs-title="{{__('Add To Cart')}}"><i
                                        data-feather="shopping-cart"></i></a>

                            </form>
                          </li>
                          {{--                                                            <li>--}}
                          {{--                                                                <a href="{{ route('compare.product',$featured_pro->id) }}"--}}
                          {{--                                                                   data-bs-toggle="tooltip" data-bs-placement="left"--}}
                          {{--                                                                   data-bs-title="Compare"><i data-feather="anchor"></i></a>--}}
                          {{--                                                            </li>--}}
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
                          <h6 class="featured-product-title truncate"><a
                                    href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                    title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                          </h6>

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
                {{--                    @endif--}}
              @endforeach
            @else

            @endif
          </div>
          {{--            </div>--}}
        </div>
      </div>
    </div>
  </section>
  <!-- Product End -->


  <!-- Product Description Start -->
  <section id="product-description" class="product-description-main-block">
    <div class="container bg-white">
      <div class="row">
        <div class="col-lg-7 col-12">
          <div class="des-feature-review-block">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" href="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">{{__('Description')}}</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-features-tab" data-bs-toggle="pill" href="#pills-features" type="button" role="tab" aria-controls="pills-features" aria-selected="false">{{__('Product Specifications')}}</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" href="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">{{__('Reviews and Rating')}}</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-comments-tab" data-bs-toggle="pill" href="#pills-comments" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">{{ count($product->comments) }} {{__('Comments') }}</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="v-pro-faqs-tab" data-bs-toggle="pill" href="#v-pro-faqs" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">{{__('FAQs') }}</a>
              </li>
              @if($product->frames()->count())
                <li class="nav-item" role="presentation">
                  <a class="nav-link"  id="v-tab-pro-360" data-toggle="pill" href="#v-tab-pro-360-tour" role="tab" aria-controls="v-tab-pro-360-tour" aria-selected="false">{{ __('Product 360째 Tour') }}</a>
                </li>
              @endif

            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                <div class="description-block">
                  @if($product->product_detail != '')

                    {!! $product->product_detail !!}

                  @else
                    <h4>{{ __('No Description') }}</h4>
                  @endif

                  <hr>
                  <p>
                    <b>{{ __('Tags') }}:</b>
                    @php
                      $x = explode(',', $product->product_tags);
                    @endphp
                    @foreach($x as $tag)
                      <span class=""><i data-feather="tag"></i> {{ $tag }}</span>
                    @endforeach
                  </p>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-features" role="tabpanel" aria-labelledby="pills-features-tab" tabindex="0">
                <div class="features-block-fullscreen">
                  <div class="row">

                    <div class="col">
                      <div class="feature-block">
                        <div class="feature-dtl">

                          @if(count($product->specs)>0)

                            <table class="table">
                              <tbody>
                              @foreach($product->specs as $spec)
                                <tr>
                                  <th scope="row" class="bg-light bg-gradient">{{ $spec->prokeys }}</th>
                                  <td>{{ $spec->provalues }}</td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                          @else
                            <h4>
                              {{ __('No Specifications') }}
                            </h4>
                          @endif

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              @if($product->frames()->count())
                <div class="tab-pane fade" id="v-tab-pro-360-tour" role="tabpanel" aria-labelledby="v-tab-pro-360-tour" tabindex="0">
                  <h5>
                    {{__("Move your mouse left or right to rotate the image")}}
                  </h5>

                  <div style="margin-left: -80px" id="produdct360tour">

                  </div>
                </div>
              @endif

              @if($product->type != 'ex_product')
                <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">

                  @auth

                    @php
                      $purchased = App\Order::whereJsonContains('simple_pro_ids',$product->id)->where('user_id',Auth::user()->id)->first();

                      $findproinorder = 0;
                      $alreadyrated = $product->reviews->where('user',Auth::user()->id)->first();
                    @endphp



                    @if($purchased)
                      @if(isset($alreadyrated))


                        <h5>
                          {{ __('Your Review') }}
                        </h5>
                        <hr>
                        <div class="customer-reviews-block">
                          <div class="row">
                            <div class="col-lg-2 col-md-2 col-3">
                              <div class="customer-reviews-img">
                                @if($alreadyrated->users->image !='')
                                  <img src="{{ url('/images/user/'.$alreadyrated->users->image) }}" alt=""
                                       class="img-fluid rounded-circle">
                                @else
                                  <img class="img-fluid rounded-circle"
                                       src="{{ Avatar::create($alreadyrated->users->name)->toBase64() }}">
                                @endif
                              </div>
                            </div>

                            <div class="col-lg-10 col-md-10 col-9">
                              <div class="customer-review-dtl">
                                <div class="row mb-3">
                                  <div class="col-lg-6 col-md-6 col-6">
                                    <h5 class="customer-title">{{ $alreadyrated->users->name }}</h5>
                                      <?php

                                      $user_count = count([$alreadyrated]);
                                      $user_sub_total = 0;
                                      $user_review_t = $alreadyrated->price * 5;
                                      $user_price_t = $alreadyrated->price * 5;
                                      $user_value_t = $alreadyrated->value * 5;
                                      $user_sub_total = $user_sub_total + $user_review_t + $user_price_t + $user_value_t;

                                      $user_count = ($user_count * 3) * 5;
                                      $rat1 = $user_sub_total / $user_count;
                                      $ratings_var1 = ($rat1 * 100) / 5;

                                      ?>
                                    <div class="pull-left">
                                      <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%"
                                                                             class="star-ratings-sprite-rating"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-6">
                                    <small class="pull-right rating-date">On
                                      {{ date('jS M Y',strtotime($alreadyrated->created_at)) }}
                                      @if($alreadyrated->status == 1)
                                        <span class="badge badge-success font-weight-bold"><i class="fa fa-check"
                                                                                              aria-hidden="true"></i> {{ __('Approved') }}</span>
                                      @else
                                        <span class="badge badge-success font-weight-bold"><i class="fa fa-info-circle"
                                                                                              aria-hidden="true"></i> {{ __('Pending') }}</span>
                                      @endif
                                    </small>
                                  </div>
                                </div>
                                <p><span class="font-weight500">{{ $alreadyrated->review }}</span></p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <hr>
                        <!-- <a title="{{ __("View all reviews") }}" class="font-weight-bold pull-right" href="{{ route('allreviews',['id' => $product->id, 'type' => 's']) }}">{{ __('View All Reviews') }}</a> -->
                        <h5 class="title">{{ __('Recent Reviews') }}</h5>

                        <hr>

                        <div class="row">

                          <div class="col-lg-4 col-md-3">
                            <div class="overall-rating-main-block">
                              <div class="overall-rating-block text-center">
                                @php
                                  if(!isset($overallrating)){
                                  $overallrating = 0;
                                  }
                                @endphp
                                <h1>{{ round($overallrating,1) }}</h1>
                                <div class="overall-rating-title">{{ __('Overall Rating') }}</div>
                                <div class="rating">
                                  @php
                                    $review_t = 0;
                                    $price_t = 0;
                                    $value_t = 0;
                                    $sub_total = 0;
                                    $sub_total = 0;
                                    $reviews2 = App\UserReview::where('simple_pro_id', $product->id)->where('status',
                                    '1')->get();
                                  @endphp
                                  @if(!empty($reviews2[0]))

                                    @php

                                      $count = App\UserReview::where('status', '1')->where('simple_pro_id',
                                      $product->id)->count();

                                      foreach ($reviews2 as $review) {
                                        $review_t = $review->price * 5;
                                        $price_t = $review->price * 5;
                                        $value_t = $review->value * 5;
                                        $sub_total = $sub_total + $review_t + $price_t + $value_t;
                                      }

                                      $count = ($count * 3) * 5;
                                      $rat = $sub_total / $count;
                                      $ratings_var2 = ($rat * 100) / 5;

                                    @endphp


                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%"
                                                                           class="star-ratings-sprite-rating"></span></div>


                                  @else
                                    <div class="text-center">
                                      {{ __('No Rating') }}
                                    </div>
                                  @endif
                                </div>
                                <div class="total-review">{{$count =  count($product->reviews->where('status','1'))}}
                                  {{ __('Ratings &') }}
                                  {{$reviewcount}} {{ __('reviews') }}</div>
                              </div>
                              <div class="overall-rating-block">
                                <div class="stat-levels">
                                  <label>{{ __('Quality') }}</label>
                                  <div class="stat-1 stat-bar">
                                <span class="stat-bar-rating" role="stat-bar"
                                      style="width: {{ $qualityprogress }}%;">{{ $qualityprogress }}%</span>
                                  </div>
                                  <label>{{ __('Price') }}</label>
                                  <div class="stat-2 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-one" role="stat-bar"
                                      style="width: {{ $priceprogress }}%;">{{ $priceprogress }}%</span>
                                  </div>
                                  <label>{{ __('Value') }}</label>
                                  <div class="stat-3 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-two" role="stat-bar"
                                      style="width: {{ $valueprogress }}%;">{{ $valueprogress }}%</span>
                                  </div>
                                </div>
                              </div>
                              @if($overallrating>3.9)
                                <div class="overall-rating-block satisfied-customer-block text-center">
                                  <h3>100%</h3>
                                  <div class="overall-rating-title">{{ __('Satisfied Customer') }}</div>
                                  <p>{{ __('All Customers give this product 4 and 5 Star Rating') }}.</p>
                                </div>
                              @endif
                            </div>
                          </div>

                          <div class="col-lg-8 col-md-9">
                            <!-- All reviews will show here-->
                            @foreach($product->reviews->take(5) as $review)

                              @if($review->status == "1")
                                <div class="customer-reviews-block">
                                  <div class="row">
                                    <div class="col-lg-3 col-md-2 col-3">
                                      <div class="customer-reviews-img">
                                        @if($review->users->image !='')
                                          <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                               class=" rounded-circle img-fluid">
                                        @else
                                          <img class="rounded-circle img-fluid"
                                               src="{{ Avatar::create($review->users->name)->toBase64() }}">
                                        @endif
                                      </div>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-9">
                                      <div class="customer-review-dtl">
                                        <div class="row mb-3">
                                          <div class="col-lg-6 col-md-6 col-6">
                                            <h5 class="customer-title">{{ $review->users->name }}</h5>
                                              <?php
                                              $user_count = count([$review]);
                                              $user_sub_total = 0;
                                              $user_review_t = $review->price * 5;
                                              $user_price_t = $review->price * 5;
                                              $user_value_t = $review->value * 5;
                                              $user_sub_total = $user_sub_total + $user_review_t + $user_price_t + $user_value_t;

                                              $user_count = ($user_count * 3) * 5;
                                              $rat1 = $user_sub_total / $user_count;
                                              $ratings_var1 = ($rat1 * 100) / 5;

                                              ?>
                                            <div class="pull-left">
                                              <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%"
                                                                                     class="star-ratings-sprite-rating"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-6">
                                            <small class="pull-right rating-date">{{ __('On') }}
                                              {{ date('jS M Y',strtotime($review->created_at)) }}</small>
                                          </div>
                                        </div>
                                        <p><span class="font-weight500">{{ $review->review }}</span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                            <!--end-->
                          </div>
                        </div>


                      @else
                        <h5>{{ __('Be the first one to rate this product') }}</h5>
                        <hr>
                        @php
                          if(!isset($overallrating)){
                          $overallrating = 0;
                          }
                        @endphp
                        <div class="row">
                          <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="overall-rating-main-block">
                              <div class="overall-rating-block text-center">
                                <h1>{{ round($overallrating,1) }}</h1>
                                <div class="overall-rating-title">{{ __('Overall Rating') }}</div>
                                <div class="rating">
                                  @php
                                    $review_t = 0;
                                    $price_t = 0;
                                    $value_t = 0;
                                    $sub_total = 0;
                                    $sub_total = 0;
                                    $reviews2 = App\UserReview::where('simple_pro_id', $product->id)->where('status',
                                    '1')->get();
                                  @endphp @if(!empty($reviews2[0]))
                                    @php
                                      $count = App\UserReview::where('status', '1')->where('simple_pro_id',
                                      $product->id)->count();
                                      foreach ($reviews2 as $review) {
                                      $review_t = $review->price * 5;
                                      $price_t = $review->price * 5;
                                      $value_t = $review->value * 5;
                                      $sub_total = $sub_total + $review_t + $price_t + $value_t;
                                      }
                                      $count = ($count * 3) * 5;
                                      $rat = $sub_total / $count;
                                      $ratings_var2 = ($rat * 100) / 5;
                                    @endphp


                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%"
                                                                           class="star-ratings-sprite-rating"></span></div>


                                  @else
                                    <div class="text-center">
                                      {{ __('No Rating') }}
                                    </div>
                                  @endif
                                </div>
                                <div class="total-review">{{$count =  count($product->reviews)}} Ratings & {{$reviewcount}}
                                  reviews</div>
                              </div>
                              <div class="overall-rating-block">
                                <div class="stat-levels">
                                  <label>{{ __('Quality') }}</label>
                                  <div class="stat-1 stat-bar">
                                <span class="stat-bar-rating" role="stat-bar"
                                      style="width: {{ $qualityprogress }}%;">{{ $qualityprogress }}%</span>
                                  </div>
                                  <label>{{ __('Price') }}</label>
                                  <div class="stat-2 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-one" role="stat-bar"
                                      style="width: {{ $priceprogress }}%;">{{ $priceprogress }}%</span>
                                  </div>
                                  <label>{{ __('Value') }}</label>
                                  <div class="stat-3 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-two" role="stat-bar"
                                      style="width: {{ $valueprogress }}%;">{{ $valueprogress }}%</span>
                                  </div>
                                </div>
                              </div>
                              @if($overallrating>3.9)
                                <div class="overall-rating-block satisfied-customer-block text-center">
                                  <h3>100%</h3>
                                  <div class="overall-rating-title">{{ __('Satisfied Customer') }}</div>
                                  <p>{{ __('All Customers give this product 4 and 5 Star Rating') }}.</p>
                                </div>
                              @endif
                            </div>
                          </div>

                          <div class="col-lg-8 col-md-9 product-add-review">
                            <div class="review-table">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                  <tr>
                                    <th class="cell-label">&nbsp;</th>
                                    <th>1 star</th>
                                    <th>2 stars</th>
                                    <th>3 stars</th>
                                    <th>4 stars</th>
                                    <th>5 stars</th>
                                  </tr>
                                  </thead>
                                  <form class="cnt-form" method="post"
                                        action="{{ route("simpleproduct.rating",$product->id) }}">
                                    @csrf
                                    <input type="hidden" name="simple_product" value="simple_product">
                                    <div class="required">{{$errors->first('quality')}}</div>
                                    <div class="required">{{$errors->first('Price')}}</div>
                                    <div class="required">{{$errors->first('Value')}}</div>
                                    <tbody>
                                    <tr>
                                      <td class="cell-label">{{ __('Quality') }} <span class="required">*</span>
                                      </td>
                                      <td><input type="radio" name="quality" class="radio" value="1"></td>
                                      <td><input type="radio" name="quality" class="radio" value="2"></td>
                                      <td><input type="radio" name="quality" class="radio" value="3"></td>
                                      <td><input type="radio" name="quality" class="radio" value="4"></td>
                                      <td><input type="radio" name="quality" class="radio" value="5"></td>
                                    </tr>
                                    <tr>
                                      <td class="cell-label">{{ __('Price') }} <span class="required">*</span>
                                      </td>
                                      <td><input type="radio" name="Price" class="radio" value="1"></td>
                                      <td><input type="radio" name="Price" class="radio" value="2"></td>
                                      <td><input type="radio" name="Price" class="radio" value="3"></td>
                                      <td><input type="radio" name="Price" class="radio" value="4"></td>
                                      <td><input type="radio" name="Price" class="radio" value="5"></td>
                                    </tr>
                                    <tr>
                                      <td class="cell-label">{{ __('Value') }} <span class="required">*</span>
                                      </td>
                                      <td><input type="radio" name="Value" class="radio" value="1"></td>
                                      <td><input type="radio" name="Value" class="radio" value="2"></td>
                                      <td><input type="radio" name="Value" class="radio" value="3"></td>
                                      <td><input type="radio" name="Value" class="radio" value="4"></td>
                                      <td><input type="radio" name="Value" class="radio" value="5"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- /.table .table-bordered -->
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.review-table -->
                            <div class="review-form">
                              <div class="form-container">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="hidden" class="form-control txt" id="exampleInputName" name="name" value="
                                  @if(Auth::check()) {{auth()->user()->id}} @endif" placeholder="">
                                      <div class="text-red">{{$errors->first('name')}}</div>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="margin-left15"
                                             for="exampleInputReview">{{ __('Review') }}:</label>
                                      <textarea class="form-control text-rev" name="review" id="exampleInputReview" rows="5"
                                                cols="50" placeholder=""></textarea>
                                    </div>
                                  </div>
                                </div><!-- /.row -->
                                <div class="action text-right">
                                  <button class="btn btn-primary btn-upper">{{ __('SUBMIT REVIEW') }}</button>
                                </div><!-- /.action -->
                                </form><!-- /.cnt-form -->
                              </div><!-- /.form-container -->
                            </div><!-- /.review-form -->
                          </div>
                        </div>
                        <!-- /.product-add-review -->
                        <h5>{{ __('Recent Reviews') }}</h5>

                        <hr>

                        @if($product->reviews()->where('status','1')->count())
                          @foreach($product->reviews->take(5) as $review)

                            @if($review->status == "1")
                              <div class="row">

                                <div class="col-md-1">
                                  @if($review->users->image !='')
                                    <img src="{{ url('/images/user/'.$review->users->image) }}" alt="" width="70px" height="70px"
                                         class="rounded-circle">
                                  @else
                                    <img width="70px" height="70px" src="{{ Avatar::create($review->users->name)->toBase64() }}"
                                         class="rounded-circle">
                                  @endif
                                </div>

                                <div class="col-md-10">
                                  <p>
                                    <b><i>{{ $review->users->name }}</i></b>
                                    <?php

                                    $user_count = count([$review]);
                                    $user_sub_total = 0;
                                    $user_review_t = $review->price * 5;
                                    $user_price_t = $review->price * 5;
                                    $user_value_t = $review->value * 5;
                                    $user_sub_total = $user_sub_total + $user_review_t + $user_price_t + $user_value_t;

                                    $user_count = ($user_count * 3) * 5;
                                    $rat1 = $user_sub_total / $user_count;
                                    $ratings_var1 = ($rat1 * 100) / 5;

                                    ?>
                                  <div class="pull-left">
                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%"
                                                                           class="star-ratings-sprite-rating"></span>
                                    </div>
                                  </div>

                                  <small class="pull-right rating-date">{{ __('On') }}
                                    {{ date('jS M Y',strtotime($review->created_at)) }}</small>
                                  <br>
                                  <span class="font-weight500">{{ $review->review }}</span>
                                  </p>
                                </div>

                              </div>
                              <hr>
                            @endif

                          @endforeach
                        @else
                          <h5><i class="fa fa-star"></i> {{ __('Be the first one to rate this product') }}</h5>
                        @endif

                      @endif
                    @else
                      <h5>{{ __('Please Purchase This Product to rate it') }}</h5>
                      <hr>
                      <h5>{{ __('Recent Reviews') }}</h5>
                      <hr>
                      @if(count($product->reviews)>0)

                        @if(!isset($overallrating))
                          @php
                            $overallrating = 0;
                          @endphp
                        @endif
                        <div class="row">

                          <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="overall-rating-main-block">
                              <div class="overall-rating-block text-center">
                                <h1>{{ round($overallrating,1) }}</h1>
                                <div class="overall-rating-title">{{ __('OverallRating') }}</div>
                                <div class="rating">
                                  @php
                                    $review_t = 0;
                                    $price_t = 0;
                                    $value_t = 0;
                                    $sub_total = 0;
                                    $sub_total = 0;
                                    $reviews2 = App\UserReview::where('status', '1')->where('simple_pro_id',
                                    $product->id)->where('status', '1')->get();
                                  @endphp @if(!empty($reviews2[0]))
                                    @php
                                      $count = App\UserReview::where('status', '1')->where('simple_pro_id',
                                      $product->id)->count();
                                      foreach ($reviews2 as $review) {
                                      $review_t = $review->price * 5;
                                      $price_t = $review->price * 5;
                                      $value_t = $review->value * 5;
                                      $sub_total = $sub_total + $review_t + $price_t + $value_t;
                                      }
                                      $count = ($count * 3) * 5;
                                      $rat = $sub_total / $count;
                                      $ratings_var2 = ($rat * 100) / 5;
                                    @endphp


                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%"
                                                                           class="star-ratings-sprite-rating"></span></div>


                                  @else
                                    <div class="text-center">
                                      {{ __('No Rating') }}
                                    </div>
                                  @endif
                                </div>
                                <div class="total-review">{{$count =  count($product->reviews)}} Ratings & {{$reviewcount}}
                                  {{ __('reviews') }}</div>
                              </div>
                              <div class="overall-rating-block">
                                <div class="stat-levels">
                                  <label>{{ __('Quality') }}</label>
                                  <div class="stat-1 stat-bar">
                                <span class="stat-bar-rating" role="stat-bar"
                                      style="width: {{ $qualityprogress }}%;">{{ $qualityprogress }}%</span>
                                  </div>
                                  <label>{{ __('Price') }}</label>
                                  <div class="stat-2 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-one" role="stat-bar"
                                      style="width: {{ $priceprogress }}%;">{{ $priceprogress }}%</span>
                                  </div>
                                  <label>{{ __('Value') }}</label>
                                  <div class="stat-3 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-two" role="stat-bar"
                                      style="width: {{ $valueprogress }}%;">{{ $valueprogress }}%</span>
                                  </div>
                                </div>
                              </div>
                              @if($overallrating>3.9)
                                <div class="overall-rating-block satisfied-customer-block text-center">
                                  <h3>100%</h3>
                                  <div class="overall-rating-title">{{ __('Satisfied Customer') }}</div>
                                  <p>{{ __('All Customers give this product 4 and 5 Star Rating') }}</p>
                                </div>
                              @endif
                            </div>
                          </div>

                          <div class="col-lg-8 col-md-9">
                            @foreach($product->reviews->take(5) as $review)

                              @if($review->status == "1")
                                <div class="customer-reviews-block">
                                  <div class="row">
                                    <div class="col-lg-2 col-md-2 col-3">
                                      <div class="customer-reviews-img">
                                        @if($review->users->image !='')
                                          <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                               class=" rounded-circle img-fluid">
                                        @else
                                          <img class="rounded-circle img-fluid"
                                               src="{{ Avatar::create($review->users->name)->toBase64() }}">
                                        @endif
                                      </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-9">
                                      <div class="customer-review-dtl">
                                        <div class="row mb-3">
                                          <div class="col-lg-6 col-md-6 col-6">
                                            <h5 class="customer-title">{{ $review->users->name }}</h5>
                                              <?php
                                              $user_count = count([$review]);
                                              $user_sub_total = 0;
                                              $user_review_t = $review->price * 5;
                                              $user_price_t = $review->price * 5;
                                              $user_value_t = $review->value * 5;
                                              $user_sub_total = $user_sub_total + $user_review_t + $user_price_t + $user_value_t;

                                              $user_count = ($user_count * 3) * 5;
                                              $rat1 = $user_sub_total / $user_count;
                                              $ratings_var1 = ($rat1 * 100) / 5;
                                              ?>
                                            <div class="pull-left">
                                              <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%"
                                                                                     class="star-ratings-sprite-rating"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-6">
                                            <small class="pull-right rating-date">{{ __('On') }}
                                              {{ date('jS M Y',strtotime($review->created_at)) }}</small>
                                          </div>
                                        </div>
                                        <p><span class="font-weight500">{{ $review->review }}</span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                        </div>
                      @else
                        <h5><i class="fa fa-star"></i> {{ __('Be the first one to rate this product') }}</h5>
                      @endif
                    @endif

                  @else
                    <h5>{{ __('Please') }} <a href="{{ route('login') }}">{{ __('Login') }}</a>
                      {{ __('Be the first one to rate this product') }}</h5>

                    @if(count($product->reviews)>0)
                      <hr>
                      <h5>{{ __('Recent Reviews') }}</h5>

                      <hr>
                      <div class="row">

                        <div class="col-lg-4 col-md-3 col-sm-3">
                          <div class="overall-rating-main-block">
                            <div class="overall-rating-block text-center">
                              <h1>{{ round($overallrating,1) }}</h1>
                              <div class="overall-rating-title">{{ __('Overall Rating') }}</div>
                              <div class="rating">
                                @php
                                  $review_t = 0;
                                  $price_t = 0;
                                  $value_t = 0;
                                  $sub_total = 0;
                                  $sub_total = 0;
                                  $reviews2 = App\UserReview::where('simple_pro_id', $product->id)->where('status',
                                  '1')->get();
                                @endphp @if(!empty($reviews2[0]))
                                  @php
                                    $count = App\UserReview::where('status', '1')->where('simple_pro_id',
                                    $product->id)->count();
                                    foreach ($reviews2 as $review) {
                                    $review_t = $review->price * 5;
                                    $price_t = $review->price * 5;
                                    $value_t = $review->value * 5;
                                    $sub_total = $sub_total + $review_t + $price_t + $value_t;
                                    }
                                    $count = ($count * 3) * 5;
                                    $rat = $sub_total / $count;
                                    $ratings_var2 = ($rat * 100) / 5;
                                  @endphp


                                  <div class="star-ratings-sprite">
                                <span style="width:<?php echo $ratings_var; ?>%"
                                      class="star-ratings-sprite-rating"></span>
                                  </div>


                                @else
                                  <div class="text-center">
                                    {{ __('No Rating') }}
                                  </div>
                                @endif
                              </div>
                              <div class="total-review">{{$count =  count($product->reviews)}} Ratings & {{$reviewcount}}
                                reviews</div>
                            </div>
                            <div class="overall-rating-block">
                              <div class="stat-levels">
                                <label>{{ __('Quality') }}</label>
                                <div class="stat-1 stat-bar">
                                <span class="stat-bar-rating" role="stat-bar"
                                      style="width: {{ $qualityprogress }}%;">{{ $qualityprogress }}%</span>
                                </div>
                                <label>{{ __('Price') }}</label>
                                <div class="stat-2 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-one" role="stat-bar"
                                      style="width: {{ $priceprogress }}%;">{{ $priceprogress }}%</span>
                                </div>
                                <label>{{ __('Value') }}</label>
                                <div class="stat-3 stat-bar">
                                <span class="stat-bar-rating stat-bar-rating-two" role="stat-bar"
                                      style="width: {{ $valueprogress }}%;">{{ $valueprogress }}%</span>
                                </div>
                              </div>
                            </div>
                            @if($overallrating>3.9)
                              <div class="overall-rating-block satisfied-customer-block text-center">
                                <h3>100%</h3>
                                <div class="overall-rating-title">{{ __('Satisfied Customer') }}</div>
                                <p>{{ __('All Customers give this product 4 and 5 Star Rating') }}</p>
                              </div>
                            @endif
                          </div>
                        </div>

                        <div class="col-lg-8 col-md-9">
                          @foreach($product->reviews->take(5) as $review)

                            @if($review->status == "1")
                              <div class="customer-reviews-block">
                                <div class="row">
                                  <div class="col-lg-2 col-md-2 col-3">
                                    <div class="customer-reviews-img">
                                      @if($review->users->image !='')
                                        <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                             class=" rounded-circle img-fluid">
                                      @else
                                        <img class="rounded-circle img-fluid"
                                             src="{{ Avatar::create($review->users->name)->toBase64() }}">
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-9">
                                    <div class="customer-review-dtl">
                                      <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-6">
                                          <h5 class="customer-title">{{ $review->users->name }}</h5>
                                            <?php

                                            $user_count = count([$review]);
                                            $user_sub_total = 0;
                                            $user_review_t = $review->price * 5;
                                            $user_price_t = $review->price * 5;
                                            $user_value_t = $review->value * 5;
                                            $user_sub_total = $user_sub_total + $user_review_t + $user_price_t + $user_value_t;

                                            $user_count = ($user_count * 3) * 5;
                                            $rat1 = $user_sub_total / $user_count;
                                            $ratings_var1 = ($rat1 * 100) / 5;

                                            ?>
                                          <div class="pull-left">
                                            <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%"
                                                                                   class="star-ratings-sprite-rating"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                          <small class="pull-right rating-date">{{ __('On') }}
                                            {{ date('jS M Y',strtotime($review->created_at)) }}</small>
                                        </div>
                                        <p><span class="font-weight500">{{ $review->review }}</span>]</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    @endif
                  @endauth

                </div>
              @endif

              <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab" tabindex="0">
                <h3><i class="fa fa-comments-o"></i> {{ __('Recent Comments') }}</h3>
                <hr>
                @forelse($product->comments->sortByDesc('id')->take(5) as $key=> $comment)

                  <div class="customer-reviews-block">
                    <div class="row">
                      <div class="col-lg-2 col-md-2 col-3">
                        <div class="customer-reviews-img">
                          <img src="{{ Avatar::create($comment->name)->toGravatar() }}" class="align-self-center mr-3" alt="{{ $comment->name }}">
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-10 col-9">
                        <div class="customer-review-dtl">
                          <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-6">
                              <h5 class="customer-title">{{ $comment->name }}</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                              <small class="float-right">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                          </div>
                          <p class="mb-0">
                            {!! $comment->comment !!}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="appendComment">

                  </div>

                @empty

                  <h4><i class="fa fa-trophy"></i> {{ __("No Comment Product") }}</h4>

                @endforelse

                @if(count($product->comments) > 5)

                  <p></p>
                  <div class="remove-row">
                    <button data-simpleproduct="yes" data-proid="{{ $product->id }}" data-id="{{ $comment->id }}" class="btn-more btn btn-info btn-sm">{{ __('Load More') }}</button>
                  </div>
                  <p></p>

                @endif
                <hr>
                <h5 class="card-title mb-30">{{ __('Leave A Comment') }}</h5>

                <form action="{{ route('post.comment') }}" method="POST" novalidate class="needs-validation">
                  @csrf



                  <div class="form-group mb-20">
                    <label>{{ __('Name') }}: <span class="text-red">*</span></label>
                    <input value="{{ old('name') }}" required autofocus name="name" type="text" class="form-control"">
                    <span class=" text-red">{{$errors->first('name')}}</span>
                  </div>

                  <div class="form-group mb-20">

                    <label>{{ __("Email") }}: <span class="text-red">*</span></label>
                    <input value="{{ old('email') }}" required name="email" type="email" class="form-control"
                           aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                      else.</small>
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <span class="text-red">{{$errors->first('email')}}</span>
                  </div>



                  <div class="form-group mb-20">
                    <label>{{ __('Comment') }}: <span class="text-red">*</span></label>
                    <textarea name="comment" required placeholder="{{ __('Comment') }}"
                              class="form-control" rows="3" cols="30">{{ old('comment') }}</textarea>
                    <span class="text-red">{{$errors->first('comment')}}</span>
                  </div>

                  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>



              </div>
              <div class="tab-pane fade" id="v-pro-faqs" role="tabpanel" aria-labelledby="v-pro-faqs-tab" tabindex="0">
                @forelse($product->faq as $qid => $fq)
                  <h5>[Q.{{ $qid+1 }}] {{ $fq->question }}</h5>
                  <p class="h6">{!! $fq->answer !!}</p>
                  <hr>
                @empty

                  <h4>{{ __('NO FAQ') }}</h4>

                @endforelse
              </div>

            </div>
          </div>
        </div>
        @if(isset($product->relsetting) && count($product->relsetting)>0)
          <div class="col-lg-5 col-12">
            @if(isset($product->relsetting))
              <div class="related-product-des">
                <h3 class="related-title">{{__('Related Product')}}</h3>
                @if($product->relsetting->status == '1')
                  @if(isset($product->relproduct))
                    @foreach($product->relproduct->related_pro as $relpro)
                      @php
                        $relproduct = App\Product::find($relpro);
                      @endphp
                      @if(isset($relproduct))
                        @foreach($relproduct->subvariants as $orivar)
                          @if($orivar->def == '1')
                            @php
                              $var_name_count = count($orivar['main_attr_id']);

                              $name = array();
                              $var_name;
                              $newarr = array();

                              for($i = 0; $i<$var_name_count; $i++){

                                $var_id=$orivar['main_attr_id'][$i];
                                $var_name[$i]=$orivar['main_attr_value'][$var_id];
                                $name[$i]=App\ProductAttributes::where('id',$var_id)->first();

                              }


                              try {
                                  $url = url('details') . '/'. str_slug($relproduct->name,'-')  .'/' . $relproduct->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0] . '&' . $name[1]['attr_name'] . '=' . $var_name[1];
                              } catch (\Exception $e) {
                                  $url = url('details') . '/' .str_slug($relproduct->name,'-')  .'/' . $relproduct->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0];
                              }

                            @endphp
                            <div class="related-block">
                              <div class="row">
                                <div class="col-lg-10 col-md-10 col-9">
                                  <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5">
                                      <div class="related-img {{ $orivar->stock ==0 ? "pro-img-box" : ""}}">
                                        <a href="{{$url}}" title="{{$relproduct->name}}">
                                          @if(count($relproduct->subvariants)>0)
                                            @if(isset($orivar->variantimages['image2']))
                                              <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" src="{{url('/variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" alt="{{$relproduct->name}}">
                                            @endif
                                          @else
                                            <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" title="{{ $relproduct->name }}" src="{{url('/images/no-image.png')}}" alt="No Image" />
                                        @endif
                                      </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7">
                                      <div class="related-dtl">
                                        <h6 class="title"><a href="{{$url}}" title="title="{{$orivar->products?$orivar->products->name:''}}"">{{substr($relproduct->name, 0, 20)}}{{strlen($relproduct->name)>20 ? '...' : ""}}</a></h6>
                                        @if($orivar->stock == 0)
                                          <h5 align="center" class="oottext">{{__('Out of stock')}}</h5>
                                        @endif

                                        @if($orivar->stock != 0 && $orivar->products->selling_start_at != null && $orivar->products->selling_start_at >= date('Y-m-d H:i:s'))
                                          <h5 align="center" class="oottext2">{{__('Coming Soon')}} !</h5>
                                        @endif
                                        <!-- /.image -->

                                        @if($relproduct->featured=="1")
                                          <div class="tag hot"><span>{{ __('Hot') }}</span></div>
                                        @elseif($product->offer_price=="1")
                                          <div class="tag sale"><span>{{ __('Sale') }}</span></div>
                                        @else
                                          <div class="tag new"><span>{{ __('New') }}</span></div>
                                        @endif
                                        <div class="row">
                                          <div class="col-lg-12 col-md-12">
                                            @php
                                              $reviews = ProductRating::getReview($relpro);
                                            @endphp

                                            @if($reviews != 0)
                                              <div class="pull-left">
                                                <div class="star-ratings-sprite"><span style="width:<?php echo $reviews; ?>%"
                                                                                       class="star-ratings-sprite-rating"></span></div>
                                              </div>
                                            @else
                                              <div class="no-rating">{{'No Rating'}}</div>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-3">
                                  <div class="related-price">
                                    @if($price_login == '0' || Auth::check())

                                      @php

                                        $result = ProductPrice::getprice($relproduct, $orivar)->getData();

                                      @endphp


                                      @if($result->offerprice == 0)
                                        <span class="price"><i class="{{session()->get('currency')['value']}}"></i> {{ sprintf("%.2f",$result->mainprice*$conversion_rate) }}</span>
                                      @else
                                        <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{ price_format($result->offerprice*$conversion_rate) }}</span>
                                        <span class="price-before-discount"><i class="{{session()->get('currency')['value']}}"></i>{{  price_format($result->mainprice*$conversion_rate)  }}</span>
                                      @endif

                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  @endif
                @else
                  @foreach($product->subcategory->products()->where('status','1')->get() as $relpro)
                    @if(isset($product->subcategory->products))
                      @foreach($relpro->subvariants as $orivar)

                        @if($orivar->def == '1' && $product->id != $orivar->products->id)

                          @php
                            $var_name_count = count($orivar['main_attr_id']);

                            $name = array();
                            $var_name;
                            $newarr = array();
                            for($i = 0; $i<$var_name_count; $i++){ $var_id=$orivar['main_attr_id'][$i];
                              $var_name[$i]=$orivar['main_attr_value'][$var_id];
                              $name[$i]=App\ProductAttributes::where('id',$var_id)->first();

                              }
                              try {
                                  $url = url('details') . '/'. str_slug($relpro->name,'-')  .'/' . $relpro->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0] . '&' . $name[1]['attr_name'] . '=' . $var_name[1];
                              } catch (\Exception $e) {
                                  $url = url('details') . '/' .str_slug($relpro->name,'-')  .'/' . $relpro->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0];
                              }
                          @endphp
                          <div class="related-block">
                            <div class="row">
                              <div class="col-lg-10 col-md-10 col-9">
                                <div class="row">
                                  <div class="col-lg-4 col-md-4 col-5">
                                    <div class="related-img {{ $orivar->stock ==0 ? "pro-img-box" : ""}}">
                                      <a href="{{$url}}" title="{{$product->name}}">
                                        @if(count($product->subvariants))

                                          @if(isset($orivar->variantimages['image2']))
                                            <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" src="{{url('/variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" alt="{{$product->name}}">
                                          @endif

                                        @else
                                          <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" title="{{ $product->name }}" src="{{url('/images/no-image.png')}}" alt="No Image" />
                                        @endif
                                      </a>
                                    </div>
                                  </div>
                                  <div class="col-lg-8 col-md-8 col-7">
                                    <div class="related-dtl">
                                      <h6 class="title"><a href="{{$url}}" title="{{$product->name}}">{{substr($relpro->name, 0, 20)}}{{strlen($relpro->name)>20 ? '...' : ""}}</a></h6>
                                      @if($orivar->stock == 0)
                                        <h5 align="center" class="oottext">{{ __('Out of stock') }} </h5>
                                      @endif

                                      @if($orivar->stock != 0 && $orivar->products->selling_start_at != null && $orivar->products->selling_start_at >= date('Y-m-d H:i:s'))
                                        <h5 align="center" class="oottext2"> {{ __('Coming Soon') }}</h5>
                                      @endif

                                      @if($product->featured=="1")
                                        <div class="tag hot"><span> {{ __('Hot') }} </span></div>
                                      @elseif($product->offer_price=="1")
                                        <div class="tag sale"><span> {{ __('Sale') }} </span></div>
                                      @else
                                        <div class="tag new"><span> {{ __('New') }} </span></div>
                                      @endif
                                      <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                          @php
                                            $reviews = ProductRating::getReview($relpro);
                                          @endphp

                                          @if($reviews != 0)
                                            <div class="pull-left">
                                              <div class="star-ratings-sprite"><span style="width:<?php echo $reviews; ?>%" class="star-ratings-sprite-rating"></span></div>
                                            </div>
                                          @else
                                            <div class="no-rating">{{'No Rating'}}</div>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-3">
                                <div class="related-price">
                                  @if($price_login == '0' || Auth::check())

                                    @php

                                      $result = ProductPrice::getprice($relpro, $orivar)->getData();

                                    @endphp

                                    @if($result->offerprice == 0)
                                      <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{price_format($result->mainprice*$conversion_rate) }}</span>
                                    @else
                                      <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{ price_format($result->offerprice*$conversion_rate) }}</span>
                                      <span class="price-before-discount"><i class="{{session()->get('currency')['value']}}"></i>{{  price_format($result->mainprice*$conversion_rate)  }}</span>
                                    @endif

                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif

                      @endforeach
                    @endif
                  @endforeach
                @endif
              </div>
            @endif
          </div>
        @endif
      </div>
    </div>
  </section>
  <!-- Product Description End -->

  <!-- Product Description Start -->

  <section id="customer-support" class="customer-support-main-block">
    <div class="container bg-white">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="customer-support-block">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-3">
                <div class="support-img">
                  <img src="{{ url('frontend/assets/images/support/shipping icon.png')}}" class="img-fluid" alt="">
                </div>
              </div>
              <div class="col-lg-9 col-md-8 col-9">
                <h5 class="support-title">{{ __('Fast Delivery') }}</h5>
                <p title="{{ __('With our partnered courier services your product will be delivered fast') }}">{{ __('With our partnered courier services..') }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="customer-support-block">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-3">
                <div class="support-img">
                  <img src="{{ url('frontend/assets/images/support/quality.png')}}" class="img-fluid" alt="">
                </div>
              </div>
              <div class="col-lg-9 col-md-8 col-9">
                <h5 class="support-title">{{ __('Quality Assurance') }}</h5>
                <p>{{ __('With') }} {{ config('app.name') }} {{ __('Quality') }}.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="customer-support-block">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-3">
                <div class="support-img">
                  <img src="{{ url('frontend/assets/images/support/protection.png')}}" class="img-fluid" alt="">
                </div>
              </div>
              <div class="col-lg-9 col-md-8 col-9">
                <h5 class="support-title">{{ __('Purchase Protection') }}</h5>
                <p>{{ __('Payement Gateway') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Product Description Start -->

  <!-- Report Product Modal -->
  <div class="modal fade" id="reportproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title p-2" id="myModalLabel">{{ __('Report Product') }} {{ $product->name }}</h5>
        </div>

        <div class="modal-body">
          <form action="{{ route('rep.pro',$product->id) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="simple_product" value="yes">
            <div class="form group">
              <label>{{ __('Subject') }}: <span class="text-red">*</span></label>
              <input required type="text" name="title" class="form-control" placeholder="{{ __('Why you reporting the prdouct enter title') }}">
            </div>
            <br>
            <div class="form-group">
              <label>{{ __('Email') }}: <span class="text-red">*</span></label>
              <input name="email" required type="email" class="form-control" name="email" placeholder="{{ __('Enter your email address') }}">
            </div>

            <div class="form-group">
              <label>{{ __('Description') }}: <span class="text-red">*</span></label>
              <textarea required class="form-control" placeholder="{{ __('Briefdescriptionofyourissue') }}" name="des" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn text-white btn-md bg-primary">{{ __('SUBMIT FOR REVIEW') }}</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="notifyMe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="p-1 modal-title" id="exampleModalLabel">{{__('Notify me')}}</h5>

        </div>
        <div class="modal-body">
          <form action="{{ url("/subscribe/for/product/stock/".$product->id) }}" method="POST" class="notifyForm">
            @csrf
            <p class="help-block text-dark">
              {{__("Please enter your email to get notified")}}
            </p>
            <div class="form-group">
              <label>Email: <span class="text-red">*</span></label>
              <input name="email" type="email" class="form-control" placeholder="{{ __("Enter your email") }}" required>
            </div>

            <div class="form-group">
              <button type="submit" class="text-light btn btn-md btn-primary">
                {{__("Submit")}}
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Size chart modal -->
  @if(isset($product->sizechart) && $product->size_chart != '' && $product->sizechart->status == 1)
    <div class="modal fade" id="previewModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="p-2 modal-title">
              {{__('Preview')}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body previewTable">
            @include('admin.sizechart.previewtable',['template' => $product->sizechart])
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger-rgba" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- size chart model end -->

</div >


  @endsection
  @section('script')
  <!-- Lightbox JS -->
  <script src="{{ url('js/lightbox.min.js') }}"></script>
  <script src="{{url('front/vendor/js/additional-methods.min.js')}}"></script>
  <!-- Drfit ZOOM JS -->
{{--  <script src="{{ url('front/vendor/js/drift.min.js') }}"></script>--}}
  <script src="{{ url('js/share.js') }}"></script>
{{--  <script>--}}
{{--    var baseUrl = @json(url('/'));--}}
{{--  </script>--}}
  <script src='https://unpkg.com/spritespin@x.x.x/release/spritespin.js' type='text/javascript'></script>
  <script src="{{ url('js/detailpage.js') }}"></script>
  <script>
    var owl = $("#productgalleryItems");
    owl.owlCarousel({
      responsive: {
        0: {
          items: 3
        },
        600: {
          items: 3
        },
        1100: {
          items: 4
        }
      },
      slideSpeed: 300,
      autoPlay: true,
      smartSpeed: 1500,
      margin: 10,
      rtl: false,
      loop: true,
      video: true,
      nav: true,
      rewindNav: true,
      navText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"]
    });

    $("#single-product-gallery-item").on('mouseover',function() {
        $('#details-container').css('z-index', '9999');
    });
        
    $("#single-product-gallery-item").on('mouseout',function() {
      $('#details-container').css('z-index', '0');
    });

    // driftzoom();

    // function driftzoom() {
    //
    //   new Drift(document.querySelector('.drift-demo-trigger'), {
    //     paneContainer: document.querySelector('#details-container'),
    //     inlinePane: 500,
    //     inlineOffsetY: -85,
    //     containInline: true,
    //     hoverBoundingBox: true,
    //     zoomFactor: 3,
    //     handleTouch: false,
    //     showWhitespaceAtEdges: false
    //   });
    // }

    

    $(function(){

     

      var id = '{{ $product->id }}';

        setTimeout(() => {
          

          $.ajax({
              url : '{{ url("/simple_product/360/images") }}',
              type : 'GET',
              dataType : 'json',
              data : {id : id},
              success : function(response){

                $("#produdct360tour").spritespin({
                    // path to the source images.
                      frames : 35,
                      animate : true,
                      responsive : false,
                      loop : false,
                      orientation : 180,
                      reverse : false,
                      detectSubsampling : true,
                      source: response,
                      width   : 600,  // width in pixels of the window/frame
                      height  : 500,  // height in pixels of the window/frame
                });

              }
          });

        }, 2500);

    });
  </script>
  @endsection