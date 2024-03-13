@extends("frontend.layout.master")
@section('title','BoiBari | Home')
@section("content")
    <div class="" style="background-color: #fff8f5">

        @if($offersettings && $offersettings->enable_popup=='1' && Cookie::get('popup') == '')
            <!-- Modal Start -->
            <div id="homemodal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="modal-home-img"
                                         style="background-image: url('<?= URL::to('/'); ?>/images/offerpopup/{{$offersettings->image}}');"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="modal-home-block text-center">
                                        <h3 class="section-title"
                                            style="color: {{ $offersettings->heading_color }};">{{$offersettings?$offersettings->heading:''}}</h3>
                                        <h4 class="section-sub-title"
                                            style="color: {{ $offersettings->subheading_color }};">{{$offersettings?$offersettings->subheading:''}}</h4>
                                        <p style="color: {{ $offersettings->description_text_color }};">{{$offersettings?$offersettings->description:''}}</p>
                                        @if($offersettings->enable_button=='1' && $offersettings->button_text)
                                            <a href="{{$offersettings?$offersettings->button_link:''}}"
                                               class="btn btn-primary"
                                               title="{{$offersettings?$offersettings->button_text:''}}"
                                               style="color: {{ $offersettings->button_color }};"><span
                                                        style="color: {{ $offersettings->button_text_color }};">{{$offersettings?$offersettings->button_text:''}}</span></a>
                                        @endif
                                        <div class="form-check">
                                            <input class="form-check-input offerpop_not_show" type="checkbox"
                                                   name="do_not_show_me" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Don't show me this
                                                popup
                                                again !</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End -->
        @endif

        <!-- Home Start [slider] -->
        <section id="home" class="home-main-block" data-aos="fade-left" style="margin-top:54px">
            <div class="container-fluid">
                <div class="row g-0">
                    {{--                <div class="col-xl-3 col-lg-3"></div>--}}
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="fade-home-slider">
                            @foreach($sliders as $key => $slider)
                                <div class="item">
                                    <div class="home-image">
                                        <img src="{{url('images/slider/'.$slider->image)}}" class="img-fluid" alt=""
                                        >
                                    </div>
                                    <div class="home-block" data-aos="fade-up">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="home-title-block">
                                                    <h3 class="home-title"
                                                        style="color: {{ $slider->headingtextcolor }};">{{ $slider->heading }}</h3>
                                                    <h6 class="home-sub-title"
                                                        style="color: {{ $slider->subheadingcolor }};">{{ $slider->topheading }}</h6>
                                                </div>
                                                <div class="home-dtl">
                                                    <p style="color: {{ $slider->short_description_color }};">{{ $slider->short_description }}</p>
                                                    @if($slider->call_support_status=='1')
                                                        <div class="home-contact">
                                                            <div class="contact-icon">
                                                                <i data-feather="phone-call"
                                                                   style="color: {{ $slider->call_icon_color }};"></i>
                                                            </div>
                                                            <div class="contact-dtl">
                                                                <h6 class="contact-title"
                                                                    style="color: {{ $slider->call_title_color }};">{{ $slider->call_title }}</h6>
                                                                <p style="color: {{ $slider->call_no_color }};">{{ $slider->call_no }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Home End -->


        @if(!empty($top_categories))
            <!-- Top Categories Start -->
            <section id="customer-support" class="customer-support-main-block p-3 pc">
                <div class="container front">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row " style="height: 50px;">
                                <div class="col-lg-6">
                                    <h3 class="section-title ">{{__('Top Categories')}} </h3>
                                </div>
                                <div class="col-lg-6">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_category')}}" type="button" class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{--                    @if($footer3_widget->shiping)--}}
                                @foreach($top_categories as $cat)
                                    <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 20px">
                                        <div class="customer-support-block border-hover" data-aos="fade-right">
                                            <div class="border-hover-two ">
                                                <a href="{{route('all_product',[$cat->id,'main'])}}">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-4">
                                                            <div class="support-img">
                                                                {{--                                                    <img src="{{ url('frontend/assets/images/support/shipping icon.png') }}"--}}
                                                                @if($cat->image != '' && file_exists(public_path() . '/images/category/' . $cat->image))
                                                                    <img src="{{ url('images/category/'.$cat->image) }}"
                                                                         class="img-fluid shipping-img"
                                                                         alt="{{__($cat->title)}}">
                                                                @else
                                                                    <img class="img-fluid shipping-img"
                                                                         title="{{__($cat->title)}}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"/>
                                                                @endif
                                                                {{--                                                         class="img-fluid shipping-img" alt="">--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-8">
                                                            <div class="support-dtl">
                                                                <h5 class="support-title">{{ $cat->title }}</h5>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Top Categories End -->
        @endif

        @if(count($top_selles))

            <!-- Top seller Start -->
            <section id="top-seller" class="feature-brand-main-block p-3">
                <div class="container pc">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row " style="height: 50px;">
                                <div class="col-lg-6 py-4">
                                    <h3 class="section-title">{{__('Top Seller Books')}}</h3>
                                </div>
                                <div class="col-lg-6 py-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_product')}}" type="button" class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ml-5 mr-5">
                                <div class="col-lg-12">
                                    <div id="topseler-slider"
                                         class="featured-brand-slidersr-main-block owl-carousel owl-theme">

                                        @foreach($top_selles as $featured_pro)
                                            <div class="item m-2" data-aos="fade-right">
                                                <div class="featured-brand-block border-hover">
                                                    <div class="border-hover-two">
                                                        <div class="featured-product-img ">
                                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                               title="">
                                                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                                                    <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                                                                         class="img-fluid"
                                                                         alt="{{__($featured_pro->product_name)}}"
                                                                         style="height: 220px;width:100%">
                                                                @else
                                                                    <img class="img-fluid"
                                                                         title="{{ $featured_pro->product_name }}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"
                                                                         style="height: 200px">
                                                                @endif
                                                            </a>
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
                                                                <div class="col-lg-12">
                                                                    <h6 class="featured-product-title truncate"><a
                                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                                    </h6>
                                                                    <p class="store-name fs-9">By:
                                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- -------------------- Change Mizan--------------------- -->

                                                            <div class="col-md-12  text-center">
                                                                <div class="featured-product-price text-center fs-6 ">
                                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                                    <!-- <s>{{ $featured_pro->price != 0 && $featured_pro->price != '' ? price_format($featured_pro->price) :  price_format($featured_pro->price)  }}</s>  -->
                                                                    {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 text-center featured_custom_cart">
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
                                                                           data-bs-toggle="tooltip"
                                                                           data-bs-placement="left"
                                                                           data-bs-title="{{__('Add To Cart')}}"> Add to
                                                                            Cart <i
                                                                                    data-feather="shopping-cart"></i></a>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- -------------------- Change Mizan--------------------- -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-white mobile">
                    <div class="row ">
                        <div class="col-8 py-4">
                            <h3 class="section-title">{{__('Top Seller Books')}}</h3>
                        </div>
                        <div class="col-4 py-4 float-right">
                            <div class="view-all-btn">
                                <a href="{{route('all_product')}}" type="button" class="btn btn-primary"
                                   title="{{__('View All')}}">{{__('View All')}}</a>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        @if($top_selles)
                            @foreach($top_selles as $key => $featured_pro)
                                <div class="col-lg-3 col-6">
                                    <div class="featured-product-block">
                                        <div class="featured-product-img">
                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                               title="">
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
                                                <div class="col-12">
                                                    <h6 class="featured-product-title truncate"><a
                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                    </h6>
                                                    <p class="store-name fs-7">By:
                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8  text-start">
                                                        <div class="featured-product-price text-start fs-6 ">
                                                            <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                            {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                        </div>

                                                    </div>
                                                    <div class="col-4 text-end ">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                        @php
                                            $conversion_rate = 1;
                                        @endphp
                                    @endif
                                </div>
                    </div>
            </section>
            <!-- Top Seller End -->
        @endif

        @if(!empty($featured_products))
            <!-- Feature Products Start -->
            <section id="feature-brand" class="feature-brand-main-block p-3">
                <div class="container pc">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px;">
                                <div class="col-lg-6 py-4">
                                    <h3 class="section-title ">{{__('Featured Products')}}</h3>
                                </div>
                                <div class="col-lg-6 py-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_product')}}" type="button" class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="featured-brand-slider"
                                         class="featured-brand-slider-main-block owl-carousel owl-theme">
                                        @foreach($featured_products as $featured_pro)
                                            <div class="item" data-aos="fade-right">
                                                <div class="featured-brand-block border-hover">
                                                    <div class="border-hover-two">
                                                        <div class="featured-product-img">
                                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                               title="">
                                                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                                                    <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                                                                         class="img-fluid"
                                                                         alt="{{__($featured_pro->product_name)}}"
                                                                         style="height: 200px">
                                                                @else
                                                                    <img class="img-fluid"
                                                                         title="{{ $featured_pro->product_name }}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"
                                                                         style="height: 200px">
                                                                @endif
                                                            </a>

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
                                                        <!-- -------------- Change Mizan---------------- -->
                                                        <div class="featured-product-dtl">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h6 class="featured-product-title truncate"><a
                                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                                    </h6>
                                                                    <p class="store-name fs-9">By:
                                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12  text-center">
                                                                <div class="featured-product-price text-center fs-6 ">
                                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                                    {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 text-center featured_custom_cart">
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
                                                                           data-bs-toggle="tooltip"
                                                                           data-bs-placement="left"
                                                                           data-bs-title="{{__('Add To Cart')}}"><i
                                                                                    data-feather="shopping-cart"></i>
                                                                            Add To Cart </a>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- -------------- Change Mizan---------------- -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-white mobile">
                    <div class="row ">
                        <div class="col-8 py-4">
                            <h3 class="section-title">{{__('Featured Products')}}</h3>
                        </div>
                        <div class="col-4 py-4 float-right">
                            <div class="view-all-btn">
                                <a href="{{route('all_product')}}" type="button" class="btn btn-primary"
                                   title="{{__('View All')}}">{{__('View All')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($featured_products)
                            @foreach($featured_products as $key => $featured_pro)
                                <div class="col-lg-3 col-6">
                                    <div class="featured-product-block">
                                        <div class="featured-product-img">
                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                               title="">
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
                                                <div class="col-12">
                                                    <h6 class="featured-product-title truncate"><a
                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                    </h6>
                                                    <p class="store-name fs-9">By:
                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8  text-start">
                                                    <div class="featured-product-price text-start fs-6 ">
                                                        <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                        {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                    </div>

                                                </div>
                                                <div class="col-4 text-end ">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $conversion_rate = 1;
                            @endphp
                        @endif
                    </div>
                </div>
            </section>
            <!-- Feature Products End -->
        @endif


        @if(isset($job_1))
            <!-- BCS Books Start -->
            <section id="feature-brand" class="feature-brand-main-block p-3">
                <div class="container  pc">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px">
                                <div class="col-lg-6 pt-4">
                                    <h3 class="section-title ">{{__($jobsubs[0]->title)}}</h3>
                                </div>
                                <div class="col-lg-6 pt-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_product',[$jobsubs[0]->id,'sub'])}}" type="button"
                                           class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="bcs-book-slider"
                                         class="featured-brand-slider-main-block owl-carousel owl-theme">
                                        @foreach($job_1 as $featured_pro)
                                            <div class="item" data-aos="fade-right">
                                                <div class="featured-brand-block border-hover">
                                                    <div class="border-hover-two">
                                                        <div class="featured-product-img">
                                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                               title="">
                                                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                                                    <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                                                                         class="img-fluid"
                                                                         alt="{{__($featured_pro->product_name)}}"
                                                                         style="height: 200px">
                                                                @else
                                                                    <img class="img-fluid"
                                                                         title="{{ $featured_pro->product_name }}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"
                                                                         style="height: 200px">
                                                                @endif
                                                            </a>
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
                                                                <div class="col-lg-12">
                                                                    <h6 class="featured-product-title truncate"><a
                                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                                    </h6>
                                                                    <p class="store-name fs-9">By:
                                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                                    </p>
                                                                </div>
                                                            </div>



                                                         <!-- -------------------- Change Mizan--------------------- -->

                                                         <div class="col-md-12  text-center">
                                                                <div class="featured-product-price text-center fs-6 ">
                                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                                   <!-- <s>{{ $featured_pro->price != 0 && $featured_pro->price != '' ? price_format($featured_pro->price) :  price_format($featured_pro->price)  }}</s>  -->
                                                                   {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center featured_custom_cart">
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
                                                                                data-feather="shopping-cart"></i> Add to Cart </a>

                                                                </form>
                                                            </div>
                                                        </div>
                        <!-- -------------------- Change Mizan--------------------- -->



                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="container bg-white mobile">
                    <div class="row mb-2">
                        <div class="col-8 pt-4">
                            <h3 class="section-title ">{{__($jobsubs[0]->title)}}</h3>
                        </div>
                        <div class="col-4 pt-4 float-right">
                            <div class="view-all-btn">
                                <a href="{{route('all_product',[$jobsubs[0]->id,'sub'])}}" type="button"
                                   class="btn btn-primary"
                                   title="{{__('View All')}}">{{__('View All')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($job_1)
                            @foreach($job_1 as $key => $featured_pro)
                                <div class="col-lg-3 col-6">
                                    <div class="featured-product-block">
                                        <div class="featured-product-img">
                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                               title="">
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
                                                <div class="col-12">
                                                    <h6 class="featured-product-title truncate"><a
                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                    </h6>
                                                    <p class="store-name fs-9">By:
                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="col-12  text-center">

                                                <div class="featured-product-price text-center fs-6 ">
                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                    {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                </div>


                                            </div>
                                            
                                        <div class="col-12  text-center">
                                               
                                               <div class="featured-product-price text-center fs-6 ">
                                                   <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                   {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                               </div>
                                             

                                           </div>
                                        <div class="row">
                                            <div class="col-12 text-center featured_custom_cart">
                                               
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
                                                                data-feather="shopping-cart"></i>Add To Cart</a>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        @php
                            $conversion_rate = 1;
                        @endphp
                    @endif
                </div>
            </section>
            <!-- BCS Books End -->
        @endif


        @if(count($deals) && $deals)
            <!-- Flash Deal Start -->
            <section id="flash-deal" class="flash-deal-main-block p-3">
                <div class="container pc">
                    <h3 class="section-title">{{__('Flash Deals')}} <i data-feather="zap"></i></h3>
                    <div class="fade-home-slider">
                        @foreach($deals as $deal)
                            <div class="item">
                                <a href="{{ route('flashdeals.view',['id' => $deal->id, 'slug' => str_slug($deal->title,'-')]) }}"
                                   title="{{$deal->title}}">
                                    <div class="flashdeal-bg-block">
                                        <div class="flashdeal-bg-block-img">
                                            <img src="{{ url('frontend/assets/images/flash_deals/flash-deal-bg.png')}}"
                                                 class="img-fluid" alt="{{$deal->title}}">
                                            <div class="flashdeal-bg-dtl">
                                                <div class="row">
                                                    <div class="col-lg-8" data-aos="fade-right">
                                                        <h4 class="section-title">{{$deal->title}}</h4>
                                                        <div class="badge text-bg-warning sale-date">{{date('d', strtotime($deal->start_date))}}
                                                            <sup>st</sup>{{date('F', strtotime($deal->start_date))}}
                                                            - {{date('d', strtotime($deal->end_date))}}
                                                            <sup>th</sup> {{date('F', strtotime($deal->end_date))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4" data-aos="fade-left">
                                                        <div class="flashdeal-bg-img">
                                                            <img src="{{ url('images/flashdeals/'.$deal->background_image) }}"
                                                                 class="img-fluid" alt="{{$deal->title}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- Flash Deal End -->
        @endif

        @if(!empty($authors))
            <!-- Authors Start -->
            <section id="customer-support" class="customer-support-main-block p-3 pc ">
                <div class="container ">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px">
                                <div class="col-lg-6 pt-4">
                                    <h3 class="section-title ">{{__('Author')}}</h3>
                                </div>
                                <div class="col-lg-6 pt-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_authors')}}" type="button" class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{--                    @if($footer3_widget->shiping)--}}
                                @foreach($authors as $author)
                                    <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 20px">
                                        <div class="customer-support-block border-hover" data-aos="fade-right">
                                            <div class="border-hover-two">
                                                <a href="{{route('all_product',[$author->id,'author'])}}">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-4">
                                                            <div class="support-img">
                                                                {{--                                                    <img src="{{ url('frontend/assets/images/support/shipping icon.png') }}"--}}
                                                                @if($author->image != '' && file_exists(public_path() . '/images/Author/' . $author->image))
                                                                    <img src="{{ url('images/Author/'.$author->image) }}"
                                                                         class="img-fluid shipping-img"
                                                                         alt="{{__($author->title)}}">
                                                                @else
                                                                    <img class="img-fluid shipping-img"
                                                                         title="{{__($author->title)}}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"/>
                                                                @endif
                                                                {{--                                                         class="img-fluid shipping-img" alt="">--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-8">
                                                            <div class="support-dtl">
                                                                <h5 class="support-title">{{ $author->title }}</h5>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>
            </section>
            <!-- Authors End -->
        @endif


        @if(isset($job_2))
            <!-- Bank Books Start -->
            <section id="feature-brand" class="feature-brand-main-block p-3">
                <div class="container pc">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px">
                                <div class="col-lg-6 pt-4">
                                    <h3 class="section-title ">{{__($jobsubs[1]->title)}}</h3>
                                </div>
                                <div class="col-lg-6 pt-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_product',[$jobsubs[1]->id,'sub'])}}" type="button"
                                           class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="bank-book-slider"
                                         class="featured-brand-slider-main-block owl-carousel owl-theme">
                                        @foreach($job_2 as $featured_pro)
                                            <div class="item" data-aos="fade-right">
                                                <div class="featured-brand-block border-hover">
                                                    <div class="border-hover-two">
                                                        <div class="featured-product-img">
                                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                               title="">
                                                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                                                    <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                                                                         class="img-fluid"
                                                                         alt="{{__($featured_pro->product_name)}}"
                                                                         style="height: 200px">
                                                                @else
                                                                    <img class="img-fluid"
                                                                         title="{{ $featured_pro->product_name }}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"
                                                                         style="height: 200px">
                                                                @endif
                                                            </a>
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
                                                                <div class="col-lg-12">
                                                                    <h6 class="featured-product-title truncate"><a
                                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                                    </h6>
                                                                    <p class="store-name fs-9">By:
                                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                           

                        <!-- -------------------- Change Mizan--------------------- -->

                                                            <div class="col-md-12  text-center">
                                                                <div class="featured-product-price text-center fs-6 ">
                                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                                   <!-- <s>{{ $featured_pro->price != 0 && $featured_pro->price != '' ? price_format($featured_pro->price) :  price_format($featured_pro->price)  }}</s>  -->
                                                                   {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center featured_custom_cart">
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
                                                                       data-bs-title="{{__('Add To Cart')}}"> Add to Cart <i
                                                                                data-feather="shopping-cart"></i></a>

                                                                </form>
                                                            </div>
                                                        </div>
                        <!-- -------------------- Change Mizan--------------------- -->


                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-white mobile">
                    <div class="row mb-2">
                        <div class="col-8 pt-4 ">
                            <h3 class="section-title ">{{__($jobsubs[1]->title)}}</h3>
                        </div>
                        <div class="col-4 pt-4  float-right">
                            <div class="view-all-btn">
                                <a href="{{route('all_product',[$jobsubs[1]->id,'sub'])}}" type="button"
                                   class="btn btn-primary"
                                   title="{{__('View All')}}">{{__('View All')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($job_2))
                            @foreach($job_2 as $key => $featured_pro)
                                <div class="col-lg-3 col-6">
                                    <div class="featured-product-block">
                                        <div class="featured-product-img">
                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                               title="">
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
                                                <div class="col-12">
                                                    <h6 class="featured-product-title truncate"><a
                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                    </h6>
                                                    <p class="store-name fs-9">By:
                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8  text-start">
                                                    <div class="featured-product-price text-start fs-6 ">
                                                        <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                        {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                    </div>

                                                </div>
                                                <div class="col-4 text-end ">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $conversion_rate = 1;
                            @endphp
                        @endif
                    </div>
                </div>
            </section>
            <!-- Bank Books End -->
        @endif

        @if(isset($job_3))
            <!-- Academic Start -->
            <section id="feature-brand" class="feature-brand-main-block p-3">
                <div class="container pc">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px">
                                <div class="col-lg-6 pt-4">
                                    <h3 class="section-title ">{{__($jobsubs[2]->title)}}</h3>
                                </div>
                                <div class="col-lg-6 pt-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_product',[$jobsubs[2]->id,'sub'])}}" type="button"
                                           class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="academic-slider"
                                         class="featured-brand-slider-main-block owl-carousel owl-theme">
                                        @foreach($job_3 as $featured_pro)
                                            <div class="item" data-aos="fade-right">
                                                <div class="featured-brand-block border-hover">
                                                    <div class="border-hover-two">
                                                        <div class="featured-product-img">
                                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                               title="">
                                                                @if($featured_pro->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$featured_pro->thumbnail))
                                                                    <img src="{{ url('images/simple_products/'.$featured_pro->thumbnail) }}"
                                                                         class="img-fluid"
                                                                         alt="{{__($featured_pro->product_name)}}"
                                                                         style="height: 200px">
                                                                @else
                                                                    <img class="img-fluid"
                                                                         title="{{ $featured_pro->product_name }}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"
                                                                         style="height: 200px">
                                                                @endif
                                                            </a>
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
                                                                <div class="col-lg-12">
                                                                    <h6 class="featured-product-title truncate"><a
                                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                                    </h6>
                                                                    <p class="store-name fs-9">By:
                                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                          



                                                         <!-- -------------------- Change Mizan--------------------- -->

                                                            <div class="col-md-12  text-center">
                                                                <div class="featured-product-price text-center fs-6 ">
                                                                    <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                                   <!-- <s>{{ $featured_pro->price != 0 && $featured_pro->price != '' ? price_format($featured_pro->price) :  price_format($featured_pro->price)  }}</s>  -->
                                                                   {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center featured_custom_cart">
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
                                                                       data-bs-title="{{__('Add To Cart')}}"> Add to Cart <i
                                                                                data-feather="shopping-cart"></i></a>

                                                                </form>
                                                            </div>
                                                        </div>
                        <!-- -------------------- Change Mizan--------------------- -->

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="container bg-white mobile">
                    <div class="row mb-2">
                        <div class="col-8 pt-4">
                            <h3 class="section-title ">{{__($jobsubs[2]->title)}}</h3>
                        </div>
                        <div class="col-4 pt-4 float-right">
                            <div class="view-all-btn">
                                <a href="{{route('all_product',[$jobsubs[2]->id,'sub'])}}" type="button"
                                   class="btn btn-primary"
                                   title="{{__('View All')}}">{{__('View All')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($job_3))
                            @foreach($job_3 as $key => $featured_pro)
                                <div class="col-lg-3 col-6">
                                    <div class="featured-product-block">
                                        <div class="featured-product-img">
                                            <a href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                               title="">
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
                                                <div class="col-12">
                                                    <h6 class="featured-product-title truncate"><a
                                                                href="{{ route('show.product',['id' => $featured_pro->id, 'slug' => $featured_pro->slug]) }}"
                                                                title="{{__($featured_pro->product_name)}}">{{__($featured_pro->product_name)}}</a>
                                                    </h6>
                                                    <p class="store-name fs-9">By:
                                                        {{__($featured_pro->author_id?$featured_pro->author->title:'')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8  text-start">
                                                    <div class="featured-product-price text-start fs-6 ">
                                                        <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                        {{ $featured_pro->offer_price != 0 && $featured_pro->offer_price != '' ? price_format($featured_pro->offer_price) :  price_format($featured_pro->price)  }}
                                                    </div>

                                                </div>
                                                <div class="col-4 text-end ">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $conversion_rate = 1;
                            @endphp
                        @endif
                    </div>
                </div>
            </section>
            <!-- Academic End -->
        @endif

        @if(!empty($publishers))
            <!-- Publisher Start -->
            <section id="customer-support" class="customer-support-main-block p-3 pc">
                <div class="container ">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-white border-0">
                            <div class="row" style="height: 50px">
                                <div class="col-lg-6 pt-4">
                                    <h3 class="section-title ">{{__('Publisher')}}</h3>
                                </div>
                                <div class="col-lg-6 pt-4">
                                    <div class="view-all-btn">
                                        <a href="{{route('all_publishers')}}" type="button" class="btn btn-primary"
                                           title="{{__('View All')}}">{{__('View All')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($publishers as $publisher)
                                    <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 20px">
                                        <div class="customer-support-block border-hover " data-aos="fade-right">
                                            <div class="border-hover-two">
                                                <a href="{{route('all_product',[$publisher->id,'publish'])}}">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-4">
                                                            <div class="support-img">
                                                                {{--                                                    <img src="{{ url('frontend/assets/images/support/shipping icon.png') }}"--}}
                                                                @if($publisher->image != '' && file_exists(public_path() . '/images/Publishers/' . $publisher->image))
                                                                    <img src="{{ url('images/Publishers/'.$publisher->image) }}"
                                                                         class="img-fluid shipping-img"
                                                                         alt="{{__($publisher->title)}}">
                                                                @else
                                                                    <img class="img-fluid shipping-img"
                                                                         title="{{__($publisher->title)}}"
                                                                         src="{{url('images/no-image.png')}}"
                                                                         alt="No Image"/>
                                                                @endif
                                                                {{--                                                         class="img-fluid shipping-img" alt="">--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-8">
                                                            <div class="support-dtl">
                                                                <h5 class="support-title">{{ $publisher->title }}</h5>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>
            </section>
            <!-- Publisher End -->
        @endif

        <!-- three_layout_banners -->
        @if(isset($three_layout_banners) && $three_layout_banners)
            <section id="offer-one" class="offer-one-main-block">

        @endif

        @if(count($categories_tab))

        @endif


    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.categorylist').show();
        });
    </script>
    <script>
        $('.offerpop_not_show').on('change', function () {

            if ($(this).is(":checked")) {
                var opt = 1;
            } else {
                var opt = 0;
            }

            $.ajax({
                type: 'GET',
                url: '{{ route("offer.pop.not.show") }}',
                data: {opt: opt},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            // $(".owl-carousel").owlCarousel();
            var owl = $('.owl1-carousel');
            // console.log('sar');
            owl.owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 100,
                autoplayHoverPause: true
            });
            // $('.play').on('click',function(){
            //     owl.trigger('play.owl.autoplay',[1000])
            // })
            // $('.stop').on('click',function(){
            //     owl.trigger('stop.owl.autoplay')
            // })
        });
    </script>

@endsection