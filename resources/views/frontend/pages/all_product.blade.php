@extends("frontend.layout.master")
{{--@php--}}

{{--    /** Seo of category pages */--}}

{{--      if(request()->keyword){--}}
{{--          $title      = __('Showing all results for :keyword',['keyword' => request()->keyword]);--}}
{{--          $seodes     = $title;--}}
{{--      }--}}
{{--      else if($chid)--}}
{{--      {--}}
{{--          $findchid = App\Grandcategory::find($chid);--}}
{{--          $title    = __(':title - All products | ',['title' => $findchid?$findchid->title:'']);--}}
{{--          $seodes   = strip_tags($findchid?$findchid->description:'');--}}
{{--          $seoimage = url('images/grandcategory/'.$findchid?$findchid->image:'');--}}
{{--      }--}}
{{--      else if($sid)--}}
{{--      {--}}
{{--          $findsubcat = App\Subcategory::find($sid);--}}
{{--          $title      = __(':title - All products | ',['title' => $findsubcat?$findsubcat->title:'']);--}}
{{--          $seodes     = strip_tags($findsubcat?$findsubcat->description:'');--}}
{{--          $seoimage   = url('images/subcategory/'.$findsubcat?$findsubcat->image:'');--}}

{{--      }else{--}}

{{--          $findcat    = App\Category::find($catid);--}}
{{--          $title      = __(':title - All products | ',['title' => $findcat?$findcat->title:'']);--}}
{{--          $seodes     = strip_tags($findcat?$findcat->description:'');--}}
{{--          if($findcat && $findcat->image){--}}
{{--            $seoimage   = url('images/category/'.$findcat?$findcat->image:'');--}}
{{--          } else {--}}
{{--            $seoimage   = url('images/category/');;--}}
{{--          }--}}


{{--      }--}}

{{--    /* End */--}}

{{--@endphp--}}

{{--@section('meta_tags')--}}
{{--    <main id="seo_section">--}}
{{--        <link rel="canonical" href="{{ url()->full() }}" />--}}
{{--        <meta name="robots" content="all">--}}
{{--        <meta property="og:title" content="{{ $title }}" />--}}
{{--        <meta name="keywords" content="{{ $title }}">--}}
{{--        <meta property="og:description" content="{{ $seodes }}" />--}}
{{--        <meta property="og:type" content="website" />--}}
{{--        <meta property="og:url" content="{{ url()->full() }}" />--}}

{{--        <meta name="twitter:card" content="summary" />--}}
{{--        <meta name="twitter:description" content="{{ $seodes }}" />--}}
{{--        <meta name="twitter:site" content="{{ url()->full() }}" />--}}
{{--    </main>--}}
{{--@endsection--}}

@section('title','Boibari | All Product')
@section("content")

   <div style="background-color: #fff8f5">
       <!-- Home Start -->
       <section id="home" class="home-main-block">
           <div class="container">
               <div class="row">
                   <div class="col-lg-12">
                       <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                           <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{ __('Home') }}</a></li>
                               <li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
                           </ol>
                       </nav>
                       <div class="about-breadcrumb-block wishlist-breadcrumb" style=" background-color: #6a9c23">
                           <div class="breadcrumb-nav">
                               <h3 class="breadcrumb-title text-light">{{ __(' Products') }}</h3>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- Home End -->

       <!-- Prodcut Start -->
       <section id="product-filter" class="product-filter-main-block">
           <div class="container bg-white pc">
               <div class="row">
                   <div class="col-lg-3 col-md-4">
                       <div class="product-filter-sidebar">
                           <form id="filterform" action="{{route('filter_product')}}" method="get" class="submitForm">
                               @csrf
                               {{--                            <input type="hidden" name="category" value="{{$catid?$catid:Session::get('category_id')}}">--}}
                               <div class="accordion" id="accordionExample">

                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                       <div class="accordion-header" id="headingcategory">
                                           <h4 class="section-title accordion-button" type="button"
                                               data-bs-toggle="collapse" data-bs-target="#collapsecategory"
                                               aria-expanded="true"
                                               aria-controls="collapsecategory">Category</h4>
                                           <div id="collapsecategory" class="accordion-collapse collapse show"
                                                aria-labelledby="headingcategory" data-bs-parent="#accordionExample">
                                               <div class="accordion-body acccordion_scroll">
                                                   <ul>
                                                       @foreach(App\Category::where('status','1')->get() as $key => $category)
                                                           <li>
                                                               <label class="address-checkbox mb-15">{{$category->title }}
                                                                   <input {{isset($selectcategories)?(in_array($category->id,$selectcategories)) ?'checked':'':'' }} type="checkbox"
                                                                          id="br{{ $category->id }}" onclick="submitForm()"
                                                                          name="categories[]" value="{{ $category->id }}">
                                                                   <span class="checkmark"></span>
                                                               </label>
                                                           </li>
                                                       @endforeach
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                       <div class="accordion-header" id="headingauthor">
                                           <h4 class="section-title accordion-button" type="button"
                                               data-bs-toggle="collapse" data-bs-target="#collapseauthor"
                                               aria-expanded="true"
                                               aria-controls="collapseauthor">Author</h4>
                                           <div id="collapseauthor" class="accordion-collapse collapse show"
                                                aria-labelledby="headingauthor" data-bs-parent="#accordionExample">
                                               <div class="accordion-body acccordion_scroll">
                                                   <ul>
                                                       @foreach(App\Author::where('status','1')->get() as $key => $author)
                                                           <li>
                                                               <label class="address-checkbox mb-15">{{$author->title }}
                                                                   <input {{isset($selectauthors)?(in_array($author->id,$selectauthors)) ?'checked':'':'' }} type="checkbox"
                                                                          id="br{{ $author->id }}" onclick="submitForm()"
                                                                          name="authors[]" value="{{ $author->id }}">
                                                                   <span class="checkmark"></span>
                                                               </label>
                                                           </li>
                                                       @endforeach
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                       <div class="accordion-header" id="headingpublisher">
                                           <h4 class="section-title accordion-button" type="button"
                                               data-bs-toggle="collapse" data-bs-target="#collapsepublisher"
                                               aria-expanded="true"
                                               aria-controls="collapsepublisher">Publisher</h4>
                                           <div id="collapsepublisher" class="accordion-collapse collapse show"
                                                aria-labelledby="headingpublisher" data-bs-parent="#accordionExample">
                                               <div class="accordion-body acccordion_scroll">
                                                   <ul>
                                                       @foreach(App\Publisher::where('status','1')->get() as $key => $publisher)
                                                           <li>
                                                               <label class="address-checkbox mb-15">{{$publisher->title }}
                                                                   <input {{isset($selectpublishers)?(in_array($publisher->id,$selectpublishers)) ?'checked':'':'' }} type="checkbox"
                                                                          id="br{{ $publisher->id }}"
                                                                          onclick="submitForm()" name="publishers[]"
                                                                          value="{{ $publisher->id }}">
                                                                   <span class="checkmark"></span>
                                                               </label>
                                                           </li>
                                                       @endforeach
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product-filter-img">
                                   <img src="{{ url('frontend/assets/images/product/offer.png') }}" class="img-fluid"
                                        alt="img not found">
                               </div>
                           </form>
                       </div>
                   </div>
                   <div class="col-lg-9 col-md-8">
                       <div class="row">
                           {{--                                                @include('frontend.product_filter.product')--}}
                           @if($products)
                               @foreach($products as $product)
                                   <div class="col-lg-3 col-md-4 col-4">
                                       <div class="featured-product-block">
                                           <div class="featured-product-img">
                                               <a style="height: 257px" href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="">
                                                   @if($product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$product->thumbnail))

                                                       <img style="height: 300px" class="img-fluid pt-2 pb-2"
                                                            src="{{ url('images/simple_products/'.$product->thumbnail) }}"
                                                            alt="{{ $product->product_name }}">

                                                   @else

                                                       <img style="height: 300px" class="img-fluid pt-2 pb-2" title=""
                                                            src="{{url('images/no-image.png')}}" alt="No Image"/>

                                                   @endif
                                               </a>

                                               {{--                                            <div class="featured-product-icon">--}}
                                               {{--                                                <ul>--}}
                                               {{--                                                    <li>--}}
                                               {{--                                                        <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}"--}}
                                               {{--                                                           title="eye"><i data-feather="eye"></i></a></li>--}}

                                               {{--                                                    @auth--}}

                                               {{--                                                        @if($product->type != 'ex_product')--}}

                                               {{--                                                            <li class="lnk wishlist active">--}}
                                               {{--                                                                <a class="text-dark add_in_wish_simple"--}}
                                               {{--                                                                   data-proid="{{ $product->id }}"--}}
                                               {{--                                                                   data-status="{{ inwishlist($product->id) }}"--}}
                                               {{--                                                                   data-toggle="tooltip" data-placement="right"--}}
                                               {{--                                                                   title="{{__('Wishlist')}}" href="javascript:void(0)">--}}
                                               {{--                                                                    <i data-feather="heart"></i>--}}
                                               {{--                                                                </a>--}}
                                               {{--                                                            </li>--}}

                                               {{--                                                        @endif--}}

                                               {{--                                                    @endauth--}}
                                               {{--                                                    <li>--}}
                                               {{--                                                        <form method="POST"--}}
                                               {{--                                                              action="{{ $product->type == 'ex_product' ? $product->external_product_link : route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $product->offer_price]) }}"--}}
                                               {{--                                                              class="addSimpleCardFrom{{$product->id}}">--}}
                                               {{--                                                            @csrf--}}

                                               {{--                                                            <input name="qty" type="hidden"--}}
                                               {{--                                                                   value="{{ $product->min_order_qty }}"--}}
                                               {{--                                                                   max="{{ $product->max_order_qty }}"--}}
                                               {{--                                                                   class="qty-section">--}}

                                               {{--                                                            <a href="javascript:"--}}
                                               {{--                                                               onclick="addSimpleProCard({{$product->id}})"--}}
                                               {{--                                                               title="{{__('Add To Card')}}"><i--}}
                                               {{--                                                                        data-feather="briefcase"></i></a>--}}

                                               {{--                                                        </form>--}}
                                               {{--                                                    </li>--}}
                                               {{--                                                </ul>--}}
                                               {{--                                            </div>--}}
                                               @if($product['sale_tag'] !== NULL && $product['sale_tag'] != '')
                                                   <div class="featured-product-badge">
                                                <span class="badge" style="background : {{ $product['sale_tag_color'] }} ; color : {{ $product['sale_tag_text_color'] }}">
                                                       {{ $product['sale_tag'] }}
                                                </span>
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="featured-product-dtl">
                                               <div class="row">
                                                   <div class="col-xl-12 col-lg-12">
                                                       <h6 class="featured-product-title truncate">
                                                           <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}">
                                                               {{ $product->product_name }}
                                                           </a>
                                                       </h6>
                                                       <p class="store-name fs-9">By:
                                                           {{__($product->author_id?$product->author->title:'')}}
                                                       </p>

                                                       {{--                                                    <p>{{__('By')}}--}}
                                                       {{--                                                        <a href="{{ route('store.view',['uuid' => $product->store->uuid ?? 0, 'title' => $product->store->name]) }}">{{ $product->store->name }}--}}
                                                       {{--                                                            @if($product->store->verified_store)--}}
                                                       {{--                                                                <div class="verified-icon">--}}
                                                       {{--                                                                    <i data-feather="check-circle"></i>--}}
                                                       {{--                                                                </div>--}}
                                                       {{--                                                            @endif--}}
                                                       {{--                                                        </a>--}}
                                                       {{--                                                    </p>--}}
                                                   </div>
                                                   {{--                                                <div class="col-xl-4 col-lg-5 col-md-5 col-5">--}}
                                                   {{--                                                    <div class="featured-product-price">--}}
                                                   {{--                                                        @if($price_login == 0 || auth()->check())--}}
                                                   {{--                                                            @if($product->offer_price != 0)--}}
                                                   {{--                                                                <span>--}}
                                                   {{--                                                                    <i class="{{session()->get('currency')['value']}}"></i>--}}
                                                   {{--                                                                     <h4 class="text-primary fw-bold" >{{ price_format($product->offer_price ) }}</h4>--}}
                                                   {{--                                                                </span>--}}
                                                   {{--                                                                <span>--}}
                                                   {{--                                                                    <h5 class="text-danger"><del>{{ price_format($product->price ) }}</del></h5>--}}
                                                   {{--                                                                    <i class="{{session()->get('currency')['value']}}"></i>--}}
                                                   {{--                                                                    {{ price_format($product->price ) }}--}}
                                                   {{--                                                                </span>--}}

                                                   {{--                                                            @else--}}
                                                   {{--                                                            <h4 class="text-primary fw-bold" >{{ price_format($product->price ) }}</h4>--}}
                                                   {{--                                                                <span>--}}
                                                   {{--                                                                    <i class="{{session()->get('currency')['value']}}"></i>--}}
                                                   {{--                                                                    {{ price_format($product->price ) }}--}}
                                                   {{--                                                                </span>--}}
                                                   {{--                                                            @endif--}}
                                                   {{--                                                        @endif--}}
                                                   {{--                                                    </div>--}}
                                                   {{--                                                </div>--}}
                                               </div>
                                               <div class="row">
                                                   {{--                                                    <div class="col-lg-12">--}}
                                                   <div class="col-md-8  text-start">
                                                       {{--                                                            <div class="col-lg-4">--}}
                                                       <div class="featured-product-price text-start fs-6 ">
                                                           <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                           {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price)  }}
                                                           <del class="text-danger">{{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->price) :  ''  }}</del>
                                                       </div>
                                                       {{--                                                            </div>--}}

                                                       {{--                                                            <div class="col-lg-4">--}}
                                                       {{--                                                                @if($featured_pro->offer_price != 0)--}}
                                                       {{--                                                                    @php--}}
                                                       {{--                                                                        $conversion_rate = 1;--}}
                                                       {{--                                                                        $getdisprice = ($featured_pro->price*$conversion_rate) - ($featured_pro->offer_price * $conversion_rate);--}}
                                                       {{--                                                                        $gotdis = $getdisprice/($featured_pro->price * $conversion_rate);--}}
                                                       {{--                                                                        $offamount = round($gotdis*100);--}}
                                                       {{--                                                                    @endphp--}}
                                                       {{--                                                                    <span class="badge text-bg-warning">{{ $offamount }}% {{__("off")}}</span>--}}
                                                       {{--                                                                @endif--}}
                                                       {{--                                                            </div>--}}

                                                   </div>
                                                   {{--                                                        <div class="col-lg-4 text-center">--}}
                                                   {{--                                                            @if($featured_pro->offer_price != 0)--}}
                                                   {{--                                                                @php--}}
                                                   {{--                                                                    $conversion_rate = 1;--}}
                                                   {{--                                                                    $getdisprice = ($featured_pro->price*$conversion_rate) - ($featured_pro->offer_price * $conversion_rate);--}}
                                                   {{--                                                                    $gotdis = $getdisprice/($featured_pro->price * $conversion_rate);--}}
                                                   {{--                                                                    $offamount = round($gotdis*100);--}}

                                                   {{--                                                                @endphp--}}
                                                   {{--                                                                <span class="badge text-bg-warning">{{ $offamount }}% {{__("off")}}</span>--}}
                                                   {{--                                                            @endif--}}
                                                   {{--                                                        </div>--}}
                                                   <div class="col-md-4 text-end ">
                                                       {{--                                                            <div class="row">--}}
                                                       {{--                                                                <div class="col-lg-6">--}}
                                                       <form method="POST"
                                                             action="{{ $product->type == 'ex_product' ? $product->external_product_link : route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $product->offer_price]) }}"
                                                             class="addSimpleCardFrom{{$product->id}}">
                                                           @csrf

                                                           <input name="qty" type="hidden"
                                                                  value="{{ $product->min_order_qty }}"
                                                                  max="{{ $product->max_order_qty }}"
                                                                  class="qty-section">

                                                           <a href="javascript:"
                                                              onclick="addSimpleProCard({{$product->id}})"
                                                              data-bs-toggle="tooltip" data-bs-placement="left"
                                                              data-bs-title="{{__('Add To Cart')}}"><i
                                                                       data-feather="shopping-cart"></i></a>

                                                       </form>
                                                       {{--                                                                </div>--}}
                                                       {{--                                                            </div>--}}
                                                   </div>
                                                   {{--                                                    </div>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                           @endif


                       </div>
                   </div>
               </div>
           </div>
           <div class="container bg-white mobile">
               <div class="row">
                   <div class="col-lg-3 col-md-4">
                       <!-- Button trigger modal -->
                       <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                           Filter Product
                       </button>

                       <!-- Modal -->
                       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <div class="product-filter-sidebar">
                                           <form id="filterform" action="{{route('filter_product')}}" method="get" class="mobilesubmitForm">
                                               @csrf
                                               {{--                            <input type="hidden" name="category" value="{{$catid?$catid:Session::get('category_id')}}">--}}
                                               <div class="accordion" id="accordionExample">

                                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                                       <div class="accordion-header" id="headingcategory">
                                                           <h4 class="section-title accordion-button" type="button"
                                                               data-bs-toggle="collapse" data-bs-target="#collapsecategory"
                                                               aria-expanded="true"
                                                               aria-controls="collapsecategory">Category</h4>
                                                           <div id="collapsecategory" class="accordion-collapse collapse show"
                                                                aria-labelledby="headingcategory" data-bs-parent="#accordionExample">
                                                               <div class="accordion-body acccordion_scroll">
                                                                   <ul>
                                                                       @foreach(App\Category::where('status','1')->get() as $key => $category)
                                                                           <li>
                                                                               <label class="address-checkbox mb-15">{{$category->title }}
                                                                                   <input {{isset($selectcategories)?(in_array($category->id,$selectcategories)) ?'checked':'':'' }} type="checkbox"
                                                                                          id="br{{ $category->id }}" onclick="mobilesubmit()"
                                                                                          name="categories[]" value="{{ $category->id }}">
                                                                                   <span class="checkmark"></span>
                                                                               </label>
                                                                           </li>
                                                                       @endforeach
                                                                   </ul>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                                       <div class="accordion-header" id="headingauthor">
                                                           <h4 class="section-title accordion-button" type="button"
                                                               data-bs-toggle="collapse" data-bs-target="#collapseauthor"
                                                               aria-expanded="true"
                                                               aria-controls="collapseauthor">Author</h4>
                                                           <div id="collapseauthor" class="accordion-collapse collapse show"
                                                                aria-labelledby="headingauthor" data-bs-parent="#accordionExample">
                                                               <div class="accordion-body acccordion_scroll">
                                                                   <ul>
                                                                       @foreach(App\Author::where('status','1')->get() as $key => $author)
                                                                           <li>
                                                                               <label class="address-checkbox mb-15">{{$author->title }}
                                                                                   <input {{isset($selectauthors)?(in_array($author->id,$selectauthors)) ?'checked':'':'' }} type="checkbox"
                                                                                          id="br{{ $author->id }}" onclick="mobilesubmit()"
                                                                                          name="authors[]" value="{{ $author->id }}">
                                                                                   <span class="checkmark"></span>
                                                                               </label>
                                                                           </li>
                                                                       @endforeach
                                                                   </ul>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="product-filter-block checkout-personal-dtl accordion-item">
                                                       <div class="accordion-header" id="headingpublisher">
                                                           <h4 class="section-title accordion-button" type="button"
                                                               data-bs-toggle="collapse" data-bs-target="#collapsepublisher"
                                                               aria-expanded="true"
                                                               aria-controls="collapsepublisher">Publisher</h4>
                                                           <div id="collapsepublisher" class="accordion-collapse collapse show"
                                                                aria-labelledby="headingpublisher" data-bs-parent="#accordionExample">
                                                               <div class="accordion-body acccordion_scroll">
                                                                   <ul>
                                                                       @foreach(App\Publisher::where('status','1')->get() as $key => $publisher)
                                                                           <li>
                                                                               <label class="address-checkbox mb-15">{{$publisher->title }}
                                                                                   <input {{isset($selectpublishers)?(in_array($publisher->id,$selectpublishers)) ?'checked':'':'' }} type="checkbox"
                                                                                          id="br{{ $publisher->id }}"
                                                                                          onclick="mobilesubmit()" name="publishers[]"
                                                                                          value="{{ $publisher->id }}">
                                                                                   <span class="checkmark"></span>
                                                                               </label>
                                                                           </li>
                                                                       @endforeach
                                                                   </ul>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="product-filter-img">
                                                   <img src="{{ url('frontend/assets/images/product/offer.png') }}" class="img-fluid"
                                                        alt="">
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       {{--                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="col-lg-9 col-md-8">
                       <div class="row">
                           {{--                                                @include('frontend.product_filter.product')--}}
                           @if($products)
                               @foreach($products as $product)
                                   <div class="col-6">
                                       <div class="featured-product-block">
                                           <div class="featured-product-img">

                                               <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="">
                                                   @if($product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$product->thumbnail))

                                                       <img class="img-fluid "
                                                            src="{{ url('images/simple_products/'.$product->thumbnail) }}"
                                                            alt="{{ $product->product_name }}">

                                                   @else

                                                       <img class="img-fluid" title=""
                                                            src="{{url('images/no-image.png')}}" alt="No Image"/>

                                                   @endif
                                               </a>
                                               {{--                                            <div class="overlay-bg"></div>--}}
                                               {{--                                            <div class="featured-product-icon">--}}
                                               {{--                                                <ul>--}}
                                               {{--                                                    <li>--}}
                                               {{--                                                        <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}"--}}
                                               {{--                                                           title="eye"><i data-feather="eye"></i></a></li>--}}

                                               {{--                                                    @auth--}}

                                               {{--                                                        @if($product->type != 'ex_product')--}}

                                               {{--                                                            <li class="lnk wishlist active">--}}
                                               {{--                                                                <a class="text-dark add_in_wish_simple"--}}
                                               {{--                                                                   data-proid="{{ $product->id }}"--}}
                                               {{--                                                                   data-status="{{ inwishlist($product->id) }}"--}}
                                               {{--                                                                   data-toggle="tooltip" data-placement="right"--}}
                                               {{--                                                                   title="{{__('Wishlist')}}" href="javascript:void(0)">--}}
                                               {{--                                                                    <i data-feather="heart"></i>--}}
                                               {{--                                                                </a>--}}
                                               {{--                                                            </li>--}}

                                               {{--                                                        @endif--}}

                                               {{--                                                    @endauth--}}
                                               {{--                                                    <li>--}}
                                               {{--                                                        <form method="POST"--}}
                                               {{--                                                              action="{{ $product->type == 'ex_product' ? $product->external_product_link : route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $product->offer_price]) }}"--}}
                                               {{--                                                              class="addSimpleCardFrom{{$product->id}}">--}}
                                               {{--                                                            @csrf--}}

                                               {{--                                                            <input name="qty" type="hidden"--}}
                                               {{--                                                                   value="{{ $product->min_order_qty }}"--}}
                                               {{--                                                                   max="{{ $product->max_order_qty }}"--}}
                                               {{--                                                                   class="qty-section">--}}

                                               {{--                                                            <a href="javascript:"--}}
                                               {{--                                                               onclick="addSimpleProCard({{$product->id}})"--}}
                                               {{--                                                               title="{{__('Add To Card')}}"><i--}}
                                               {{--                                                                        data-feather="briefcase"></i></a>--}}

                                               {{--                                                        </form>--}}
                                               {{--                                                    </li>--}}
                                               {{--                                                </ul>--}}
                                               {{--                                            </div>--}}
                                               @if($product['sale_tag'] !== NULL && $product['sale_tag'] != '')
                                                   <div class="featured-product-badge">
                                                <span class="badge" style="background : {{ $product['sale_tag_color'] }} ; color : {{ $product['sale_tag_text_color'] }}">
                                                       {{ $product['sale_tag'] }}
                                                </span>
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="featured-product-dtl">
                                               <div class="row">
                                                   <div class="col-xl-12 col-lg-12 col-md-12">
                                                       <h6 class="featured-product-title truncate fw-bold">
                                                           <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}">
                                                               {{ $product->product_name }}
                                                           </a>
                                                       </h6>

                                                       {{--                                                    <p>{{__('By')}}--}}
                                                       {{--                                                        <a href="{{ route('store.view',['uuid' => $product->store->uuid ?? 0, 'title' => $product->store->name]) }}">{{ $product->store->name }}--}}
                                                       {{--                                                            @if($product->store->verified_store)--}}
                                                       {{--                                                                <div class="verified-icon">--}}
                                                       {{--                                                                    <i data-feather="check-circle"></i>--}}
                                                       {{--                                                                </div>--}}
                                                       {{--                                                            @endif--}}
                                                       {{--                                                        </a>--}}
                                                       {{--                                                    </p>--}}
                                                   </div>

                                               </div>
                                               <div class="row">
                                                   <div class="col-md-12  text-start">
                                                       <p class="store-name fs-9">By:
                                                           {{__($product->author_id?$product->author->title:'')}}
                                                       </p>
                                                   </div>
                                               </div>
                                               <div class="row">
                                                   {{--                                                    <div class="col-lg-12">--}}
                                                   <div class="col-md-12  text-start">
                                                       {{--                                                            <div class="col-lg-4">--}}
                                                       <div class="featured-product-price text-start fs-5 ">
                                                           <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                           {{--                                                        {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price)  }}--}}
                                                           <del class="text-danger h12">{{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->price) :  ''  }}</del>
                                                       </div>
                                                       {{--                                                            </div>--}}

                                                       {{--                                                                    @if($featured_pro->offer_price != 0)--}}
                                                       {{--                                                                    @php--}}
                                                       {{--                                                                        $conversion_rate = 1;--}}
                                                       {{--                                                                        $getdisprice = ($featured_pro->price*$conversion_rate) - ($featured_pro->offer_price * $conversion_rate);--}}
                                                       {{--                                                                        $gotdis = $getdisprice/($featured_pro->price * $conversion_rate);--}}
                                                       {{--                                                                        $offamount = round($gotdis*100);--}}
                                                       {{--                                                                    @endphp--}}
                                                       {{--                                                                    <span class="badge text-bg-warning">{{ $offamount }}% {{__("off")}}</span>--}}
                                                       {{--                                                                @endif--}}
                                                       {{--                                                            </div>--}}

                                                   </div>
                                                   {{--                                                        <div class="col-lg-4 text-center">--}}
                                                   {{--                                                            @if($featured_pro->offer_price != 0)--}}
                                                   {{--                                                                @php--}}
                                                   {{--                                                                    $conversion_rate = 1;--}}
                                                   {{--                                                                    $getdisprice = ($featured_pro->price*$conversion_rate) - ($featured_pro->offer_price * $conversion_rate);--}}
                                                   {{--                                                                    $gotdis = $getdisprice/($featured_pro->price * $conversion_rate);--}}
                                                   {{--                                                                    $offamount = round($gotdis*100);--}}

                                                   {{--                                                                @endphp--}}
                                                   {{--                                                                <span class="badge text-bg-warning">{{ $offamount }}% {{__("off")}}</span>--}}
                                                   {{--                                                            @endif--}}
                                                   {{--                                                        </div>--}}
                                               </div>

                                               <div class="row">
                                                   <div class="col-8 text-start">
                                                       <div class="featured-product-price text-start fs-6">
                                                           <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                                                           {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price)  }}
                                                           {{--                                                        <del class="text-danger h12">{{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->price) :  ''  }}</del>--}}
                                                       </div>
                                                   </div>
                                                   <div class="col-4 text-end">
                                                       <form method="POST"
                                                             action="{{ $product->type == 'ex_product' ? $product->external_product_link : route('add.cart.simple',['pro_id' => $product->id, 'price' => $product->price, 'offerprice' => $product->offer_price]) }}"
                                                             class="addSimpleCardFrom{{$product->id}}">
                                                           @csrf

                                                           <input name="qty" type="hidden"
                                                                  value="{{ $product->min_order_qty }}"
                                                                  max="{{ $product->max_order_qty }}"
                                                                  class="qty-section">

                                                           <a href="javascript:"
                                                              onclick="addSimpleProCard({{$product->id}})"
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
                           @endif


                       </div>
                   </div>
               </div>
           </div>

       </section>
       <!-- Product End -->

   </div>
@endsection
@section('script')
    <script>
        function mobilesubmit(){
            $('.mobilesubmitForm').submit();
        }
        function submitForm() {
            {{--$("#filterform").submit(function (event){--}}
            {{--    event.preventDefault();--}}

            {{--    var form=$("#filterform")[0];--}}
            {{--    var data=new FormData(form);--}}

            {{--    $.ajax({--}}
            {{--        type:"get",--}}
            {{--        url:"{{route('filter_product')}}",--}}
            {{--        data:data,--}}
            {{--        success:function (result){--}}
            {{--            --}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
            // alert("sarowar");
            // if (varType) {
            //     // console.log('varType');
            //     $('.varType').val(varType);
            // }
            $('.submitForm').submit();
        }
    </script>
@endsection
