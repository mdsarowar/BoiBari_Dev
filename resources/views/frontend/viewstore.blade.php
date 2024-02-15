@extends("frontend.layout.master")
@section('title',"Emart | $store->name")
@section("content")   

    <!-- Home Start -->
<section id="home" class="home-main-block product-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Store')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
    <!-- Home End -->

<!-- Store breadcumb Start -->
<div id="store-breadcumb" class="store-breadcumb-main-block">
    <div class="container">
        <div class="store-breadcumb-img">
            <img src="{{ $store->cover_photo != '' && file_exists(public_path().'/images/store/cover_photo/'.$store->cover_photo) ? url('images/store/cover_photo/'.$store->cover_photo) : url('images/default_cover_store.jpg') }}" class="img-fluid" alt="">
            <div class="store-breadcumb-dtl">
                <h1 class="breadcumb-title"> {{ filter_var($store->name) }}
                @if($store->verified_store == '1') 
                    <small title="{{__('Verified')}}"><i data-feather="check-circle"></i> </small> 
                @endif    
                </h1>
                
                @if($store->description !='')
                    <p> {!! $store->description !!} </p>
                @endif
                <ul>
                    <li><a href="javascript:" title="{{__('Address')}}"><i data-feather="map-pin"></i>{{ $store['address'] }} {{ $store->city['name'] }}, {{ $store->state['name'] }}, {{ $store->country['nicename'] }}, {{ $store->pin_code }}</a></li>
                    <li><a href="tel:{{ $store['mobile'] }}" title="{{__('Mobile No.')}}"><i data-feather="phone-call"></i>{{ $store['mobile'] }}</a></li>
                    <li><a href="mailto:{{ filter_var($store->email) }}" title="{{__('Email')}}"><i data-feather="mail"></i>{{ filter_var($store->email) }}</a></li>
                </ul>
          </div>
        </div>
    </div>
</div>
<!-- Store breadcumb End -->

    <!-- Store Start -->
<div id="store" class="store-main-block">
    <div class="container mb-30 mt-3">
        <button class="btn btn-primary btn-grid"><i data-feather="grid"></i>{{__('Grid View')}}</button>
        <button class="btn btn-danger btn-list"><i data-feather="list"></i>{{__('List View')}}</button>
    </div>
    <div class="container grid-container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="featured-product-block">
                        <div class="featured-product-img">
                            <img src="{{ $product['thumbnail'] }}" alt="{{ $product['productname'] }}" class="img-fluid card-img-top">
                            <div class="overlay-bg"></div>
                            <div class="featured-product-icon">
                                <ul>
                                    <li><a href="{{ $product['producturl'] }}" title="{{__('View Product')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>
                                    @if(isset($product['selling_start_at']) && $product['stock'] != 0 && $product['selling_start_at'] != null && $product['selling_start_at'] >= date('Y-m-d'))
                                    @else 

                                        @if($price_login != 1 || Auth::check())
                                            @if($product['stock'] !== 0)
                                                @if($product['product_type'] == 'v')
                                                    <li><a href="javascript:" class="addtowish" mainid="{{ $product['productid'] }}" title="{{ __('Add To WishList') }}" data-add="{{url('AddToWishList/'.$product['productid'])}}" title="{{ __('Add To WishList') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></a></li>
                                                    <li>
                                                        <form method="POST" action="{{ route('add.cart',['id' => $product['productid'] ,'variantid' => $product['variantid'], 'varprice' => $product['mainprice'], 'varofferprice' => $product['offerprice'] ,'qty' => $product['min_order_qty']])}}" class="addVariantProCard{{$product['productid']}}">
                                                            {{ csrf_field() }}
                                                            <a href="javascript:" onclick="addVariantProCard({{$product['productid']}})" title="{{__('Add to Card')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></a>
                                                        </form>                                                        
                                                    </li>
                                                @else
                                                    <li><a href="javascript:" class="add_in_wish_simple" data-proid="{{ $product['productid'] }}" data-status="{{ inwishlist($product['productid']) }}" title="{{__('Wishlist')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></a></li>
                                                    <li>
                                                        <form method="POST" action="{{ $product['type'] == 'ex_product' ? $product['external_product_link'] : route('add.cart.simple',['pro_id' => $product['productid'], 'price' => $product['mainprice'], 'offerprice' => $d_price ?? $product['offerprice']]) }}">
                                                            @csrf

                                                            <input name="qty" type="hidden" value="1" class="qty-section">

                                                            <a href="javascript:" onclick="addSimpleProCard({{$product['productid']}})" title="{{__('Add to Card')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></a>

                                                        </form>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif

                                    @endif
                                </ul>
                            </div>
                            <div class="store-badges">
                            @if($product['stock'] == 0)
                                <span class="badge text-bg-danger">{{__('Out Of Stock')}}</span>
                            @endif
                            @if(isset($product['pre_order']) && $product['pre_order'] == 1 && $product['product_avbl_date'] >= date('Y-m-d'))
                                <span class="badge text-bg-secondary">{{__('Available for preorder')}}</span>
                            @endif
                            @if($product['product_type'] == 'v' && $product['stock'] != 0 && $product['selling_start_at'] != null && $products['selling_start_at'] >= date('Y-m-d'))
                                <span class="badge text-bg-success">{{__('Coming Soon')}}</span>
                            @endif
                            </div>
                            @if($product['sale_tag'] !== NULL && $product['sale_tag'] != '')
                            <div class="featured-product-badge">
                                <span class="badge text-bg-primary">{{ $product['sale_tag'] }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="featured-product-dtl">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h6 class="featured-product-title truncate">{{ filter_var($product['productname']) }}</h6>
                                </div>
                                <div class="col-lg-5">
                                    @if($price_login == '0' || Auth::check())

                                        <div class="featured-product-price">
                                            
                                            
                                            @if($product['offerprice'] == 0)

                                            <i class="{{session()->get('currency')['value']}}"></i> {{ sprintf("%.2f",(int)$product['mainprice']*(int)$conversion_rate) }}
                                                
                                            @else

                                            <i class="{{session()->get('currency')['value']}}"></i> {{ sprintf("%.2f",(int)$product['offerprice']*(int)$conversion_rate) }}
                                            <br>
                                                
                                               <s><i class="{{session()->get('currency')['value']}}"></i> {{sprintf("%.2f",(int)$product['mainprice']*(int)$conversion_rate)  }}</s>

                                            @endif

                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>{!! $products->appends(Request::except('page'))->links() !!}</div>
    </div>
</div>
    <!-- Store End -->

@endsection
@section("script") 
<script>
      function showList(e) {
        var $gridCont = $('.grid-container');
        e.preventDefault();
        $gridCont.hasClass('list-view') ? $gridCont.removeClass('list-view') : $gridCont.addClass('list-view');
      }
      function gridList(e) {
        var $gridCont = $('.grid-container')
        e.preventDefault();
        $gridCont.removeClass('list-view');
      }

      $(document).on('click', '.btn-grid', gridList);
      $(document).on('click', '.btn-list', showList);
</script>
@endsection