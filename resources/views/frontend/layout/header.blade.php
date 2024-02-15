<?php
$genral = App\Genral::first();
$banner = App\BannerSetting::first();
?>
<input type="hidden" class="baseURl" value="{{url('/')}}">

    <!-- Navbar Fullscreen Start -->
    <section id="navbar" class="navbar-main-block fullscreen-navbar">
{{--        <div class="">--}}
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row p-1 mb-1 bg-light text-dark">
                        <div class="col-md-1 bg-info  text-center">
                            {{--                    <div class="">--}}
                            <div class="fw-bolder">
                                আপডেট
                            </div>
                            {{--                    </div>--}}
                        </div>
                        <div class="col-md-11 text-center">
                            {{--                    <div class="text-center py-1 px-2 white--text font-weight-bold">--}}
                            <marquee data-v-5606edfa="" behavior="scroll" direction="left"  class="">
                                 👉 বইবাড়ী ওয়েবসাইটে আপনাকে স্বাগতম।
                            </marquee>
                            {{--                    </div>--}}
                        </div>
                    </div>
                    <div class="row g-0">
                        {{--                <div class="col-xl-12 col-lg-12">--}}

                        {{--                    <div class="welcome-text">--}}
                        {{--                        <section class="py-0" style="margin-top: 3px;">--}}
                        {{--                            <div class="d-flex" style="max-width: 1300px; margin: auto;">--}}
                        {{--                               --}}
                        {{--                            </div>--}}
                        {{--                        </section>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        <div class="col-xl-9 col-lg-12 col-md-12 col-12">
                            @if($banner && isset($banner) && $banner->status=='1')
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{substr($banner->content,0,70)}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i data-feather="x"></i></button>
                                </div>
                            @endif
                        </div>
                        {{--                <div class="col-xl-2 col-lg-2">--}}
                        {{--                    <div class="language-country-block">--}}
                        {{--                        <ul>--}}
                        {{--                            <li>--}}
                        {{--                                @if(App\AutoDetectGeo::first()->enabel_multicurrency == '1')--}}
                        {{--                                    <select class="form-select" name="currency" onchange="val()" id="currency">--}}

                        {{--                                        @if(App\AutoDetectGeo::first()->currency_by_country == 1)--}}

                        {{--                                            @forelse($manualcurrency as $currency)--}}

                        {{--                                                @if(isset($currency->currency))--}}

                        {{--                                                    @if(Session::get('currency') && Session::get('currency')['mainid'])--}}
                        {{--                                                    <option {{ Session::get('currency')['mainid'] == $currency->currency->id ? "selected" : "" }} value="{{ $currency->currency->id }}">{{ $currency->currency->code }} </option>--}}
                        {{--                                                    @else--}}
                        {{--                                                    <option value="{{ $currency->currency ? $currency->currency->id : '' }}">{{ $currency->currency ? $currency->currency->code : '' }} </option>--}}
                        {{--                                                    @endif--}}
                        {{--                                                @endif--}}

                        {{--                                            @empty--}}

                        {{--                                                <option value="{{ $defCurrency->currency ? $defCurrency->currency->id : '' }}">{{ $defCurrency->currency ? $defCurrency->currency->code : '' }}</option>--}}

                        {{--                                            @endforelse--}}

                        {{--                                        @else--}}

                        {{--                                            @foreach($multiCurrency as $currency)--}}
                        {{--                                                @if(Session::get('currency') && Session::get('currency')['mainid'])--}}
                        {{--                                                    <option {{ Session::get('currency')['mainid'] == $currency->currency->id ? "selected" : "" }} value="{{ $currency->currency->id }}">{{ $currency->currency->code }} </option>--}}
                        {{--                                                @else--}}
                        {{--                                                    <option value="{{ $currency->currency ? $currency->currency->id : '' }}">{{ $currency->currency ? $currency->currency->code : '' }} </option>--}}
                        {{--                                                @endif--}}
                        {{--                                            @endforeach--}}

                        {{--                                        @endif--}}

                        {{--                                    </select>--}}

                        {{--                                    @else--}}

                        {{--                                    <select class="form-select" name="currency" onchange="val()" id="currency">--}}

                        {{--                                        <option value="{{ $defCurrency->currency->id }}">{{ $defCurrency->currency->code }}</option>--}}

                        {{--                                    </select>--}}

                        {{--                                @endif--}}
                        {{--                            </li>--}}
                        {{--                            <li>--}}
                        {{--                                <select class="form-select changed_language" name="" id="changed_lng">--}}
                        {{--                                    @foreach($langauges as $lang)--}}
                        {{--                                    <option {{ Session::get('changed_language') == $lang->lang_code ? "selected" : ""}}--}}
                        {{--                                    value="{{ $lang->lang_code }}">{{ $lang->name }}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                    </div>
                </div>
                <div class="col-md-2 mb-0">
                    <div class="social-link-block mb-0">
{{--                        <h5 class="footer-title">{{__('Social Links')}}</h5>--}}
                        <ul>

                            @foreach($socials as $social)

                                @if($social->url=='https://facebook.com' || $social->url=='http://facebook.com')
                                    <li><a target="_blank" href="https://www.facebook.com/boibaari?mibextid=ZbWKwL" title="facebook"><i class="" data-feather="facebook"></i></a></li>
                                @endif

                                @if($social->url=='https://twitter.com' || $social->url=='http://twitter.com')
                                    <li><a target="_blank" href="{{$social->url}}" title="twitter"><i data-feather="twitter"></i></a></li>
                                @endif

                                @if($social->url=='https://instagram.com' || $social->url=='http://instagram.com')
                                    <li><a target="_blank" href="{{$social->url}}" title="instagram"><i data-feather="instagram"></i></a></li>
                                @endif

                                @if($social->url=='https://youtube.com' || $social->url=='http://youtube.com')
                                    <li><a target="_blank" href="{{$social->url}}" title="youtube"><i data-feather="youtube"></i></a></li>
                                @endif

                                @if($social->url=='https://linkedin.com' || $social->url=='http://linkedin.com')
                                    <li><a target="_blank" href="{{$social->url}}" title="linkedin"><i data-feather="linkedin"></i></a></li>
                                @endif

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
{{--            <div class="row mobile">--}}
{{--                <div class="col-md-1"></div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="row p-1 mb-1 bg-light text-dark">--}}
{{--                        <div class="col-md-1 bg-info  text-center">--}}
{{--                            --}}{{--                    <div class="">--}}
{{--                            <div class="fw-bolder">--}}
{{--                                আপডেট--}}
{{--                            </div>--}}
{{--                            --}}{{--                    </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-11 text-center">--}}
{{--                            --}}{{--                    <div class="text-center py-1 px-2 white--text font-weight-bold">--}}
{{--                            <marquee data-v-5606edfa="" behavior="scroll" direction="left"  class="">--}}
{{--                                💥বিসিএস, ব্যাংক, NTRCA, প্রাইমারি সহ সকল কোর্সে ৬০% ডিসকাউন্টে ভর্তি চলছে নতুন বছর--}}
{{--                                উপলক্ষে!! 👉আপনার পছন্দ অনুযায়ী 🕙সকাল এবং বিকাল এর 🕙 ব্যাচ থেকে বেছে নিন আপনার--}}
{{--                                ব্যাচটি...--}}
{{--                            </marquee>--}}
{{--                            --}}{{--                    </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row g-0">--}}
{{--                        --}}{{--                <div class="col-xl-12 col-lg-12">--}}

{{--                        --}}{{--                    <div class="welcome-text">--}}
{{--                        --}}{{--                        <section class="py-0" style="margin-top: 3px;">--}}
{{--                        --}}{{--                            <div class="d-flex" style="max-width: 1300px; margin: auto;">--}}
{{--                        --}}{{--                               --}}
{{--                        --}}{{--                            </div>--}}
{{--                        --}}{{--                        </section>--}}
{{--                        --}}{{--                    </div>--}}
{{--                        --}}{{--                </div>--}}
{{--                        <div class="col-xl-9 col-lg-12 col-md-12 col-12">--}}
{{--                            @if($banner && isset($banner) && $banner->status=='1')--}}
{{--                                <div class="alert alert-primary alert-dismissible fade show" role="alert">--}}
{{--                                    {{substr($banner->content,0,70)}}--}}
{{--                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i data-feather="x"></i></button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        --}}{{--                <div class="col-xl-2 col-lg-2">--}}
{{--                        --}}{{--                    <div class="language-country-block">--}}
{{--                        --}}{{--                        <ul>--}}
{{--                        --}}{{--                            <li>--}}
{{--                        --}}{{--                                @if(App\AutoDetectGeo::first()->enabel_multicurrency == '1')--}}
{{--                        --}}{{--                                    <select class="form-select" name="currency" onchange="val()" id="currency">--}}

{{--                        --}}{{--                                        @if(App\AutoDetectGeo::first()->currency_by_country == 1)--}}

{{--                        --}}{{--                                            @forelse($manualcurrency as $currency)--}}

{{--                        --}}{{--                                                @if(isset($currency->currency))--}}

{{--                        --}}{{--                                                    @if(Session::get('currency') && Session::get('currency')['mainid'])--}}
{{--                        --}}{{--                                                    <option {{ Session::get('currency')['mainid'] == $currency->currency->id ? "selected" : "" }} value="{{ $currency->currency->id }}">{{ $currency->currency->code }} </option>--}}
{{--                        --}}{{--                                                    @else--}}
{{--                        --}}{{--                                                    <option value="{{ $currency->currency ? $currency->currency->id : '' }}">{{ $currency->currency ? $currency->currency->code : '' }} </option>--}}
{{--                        --}}{{--                                                    @endif--}}
{{--                        --}}{{--                                                @endif--}}

{{--                        --}}{{--                                            @empty--}}

{{--                        --}}{{--                                                <option value="{{ $defCurrency->currency ? $defCurrency->currency->id : '' }}">{{ $defCurrency->currency ? $defCurrency->currency->code : '' }}</option>--}}

{{--                        --}}{{--                                            @endforelse--}}

{{--                        --}}{{--                                        @else--}}

{{--                        --}}{{--                                            @foreach($multiCurrency as $currency)--}}
{{--                        --}}{{--                                                @if(Session::get('currency') && Session::get('currency')['mainid'])--}}
{{--                        --}}{{--                                                    <option {{ Session::get('currency')['mainid'] == $currency->currency->id ? "selected" : "" }} value="{{ $currency->currency->id }}">{{ $currency->currency->code }} </option>--}}
{{--                        --}}{{--                                                @else--}}
{{--                        --}}{{--                                                    <option value="{{ $currency->currency ? $currency->currency->id : '' }}">{{ $currency->currency ? $currency->currency->code : '' }} </option>--}}
{{--                        --}}{{--                                                @endif--}}
{{--                        --}}{{--                                            @endforeach--}}

{{--                        --}}{{--                                        @endif--}}

{{--                        --}}{{--                                    </select>--}}

{{--                        --}}{{--                                    @else--}}

{{--                        --}}{{--                                    <select class="form-select" name="currency" onchange="val()" id="currency">--}}

{{--                        --}}{{--                                        <option value="{{ $defCurrency->currency->id }}">{{ $defCurrency->currency->code }}</option>--}}

{{--                        --}}{{--                                    </select>--}}

{{--                        --}}{{--                                @endif--}}
{{--                        --}}{{--                            </li>--}}
{{--                        --}}{{--                            <li>--}}
{{--                        --}}{{--                                <select class="form-select changed_language" name="" id="changed_lng">--}}
{{--                        --}}{{--                                    @foreach($langauges as $lang)--}}
{{--                        --}}{{--                                    <option {{ Session::get('changed_language') == $lang->lang_code ? "selected" : ""}}--}}
{{--                        --}}{{--                                    value="{{ $lang->lang_code }}">{{ $lang->name }}</option>--}}
{{--                        --}}{{--                                    @endforeach--}}
{{--                        --}}{{--                                </select>--}}
{{--                        --}}{{--                            </li>--}}
{{--                        --}}{{--                        </ul>--}}
{{--                        --}}{{--                    </div>--}}
{{--                        --}}{{--                </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 mb-0">--}}
{{--                    <div class="social-link-block mb-0">--}}
{{--                        <h5 class="footer-title">{{__('Social Links')}}</h5>--}}
{{--                        <ul>--}}

{{--                            @foreach($socials as $social)--}}

{{--                                @if($social->url=='https://facebook.com' || $social->url=='http://facebook.com')--}}
{{--                                    <li><a target="_blank" href="https://www.facebook.com/boibaari?mibextid=ZbWKwL" title="facebook"><i class="" data-feather="facebook"></i></a></li>--}}
{{--                                @endif--}}

{{--                                @if($social->url=='https://twitter.com' || $social->url=='http://twitter.com')--}}
{{--                                    <li><a target="_blank" href="{{$social->url}}" title="twitter"><i data-feather="twitter"></i></a></li>--}}
{{--                                @endif--}}

{{--                                @if($social->url=='https://instagram.com' || $social->url=='http://instagram.com')--}}
{{--                                    <li><a target="_blank" href="{{$social->url}}" title="instagram"><i data-feather="instagram"></i></a></li>--}}
{{--                                @endif--}}

{{--                                @if($social->url=='https://youtube.com' || $social->url=='http://youtube.com')--}}
{{--                                    <li><a target="_blank" href="{{$social->url}}" title="youtube"><i data-feather="youtube"></i></a></li>--}}
{{--                                @endif--}}

{{--                                @if($social->url=='https://linkedin.com' || $social->url=='http://linkedin.com')--}}
{{--                                    <li><a target="_blank" href="{{$social->url}}" title="linkedin"><i data-feather="linkedin"></i></a></li>--}}
{{--                                @endif--}}

{{--                            @endforeach--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
    </section>
    <!-- Navbar Smallscreen End -->

    <!-- Topbar Fullscreen Start -->
    <section id="topbar" class="topbar-main-block fullscreen-topbar">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-2">
                    <div class="logo" >
                        <a href="{{ url('/') }}" title="{{ $genral->title }}"><img src="{{url('images/genral/'.$front_logo)}}" class="img-fluid" alt="{{ $genral->title }}" style="height: 50px;width: 150px"></a>
                    </div>
                </div>
                <div class="col-lg-7 border-0">
                    <div class="topbar-search-product search-cat-box" id="search-xs">
                        <form method="get" enctype="multipart/form-data" action="{{url('search/')}}" class="search-form" id="searchSubmit">
                            <div class="input-group">
{{--                                <span class="input-group-btn">--}}
{{--                                    <select id="searchDropMenu" class="form-select searchDropMenu" onchange="changeCategory(this.value,'main')" aria-label="Default select example" name="cat">--}}
{{--                                        <option selected>{{__('All Categories')}}</option>--}}
{{--                                        @foreach(App\Category::where('status','1')->orderBy('position')->get() as $key => $category)--}}
{{--                                        <option value="{{ $category->id }}">{{ $category->title }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </span>--}}
                                <div class="form-group">
                                    <input type="text" id="ipad_vsearch" class="form-control search-field-new" name="keyword" placeholder="{{__('Search For Products Brands And Categories')}}">
                                    <a href="javascript:" onclick="searchInput()" title="search"><i data-feather="search"></i></a>
                                    <div id="course_data"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="topbar-product-icon">
                        <ul>
{{--                            @if(Auth::check())--}}
{{--                            <li><a href="{{url('wishlist')}}" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="{{__('Wishlist')}}"><i data-feather="heart"></i><span class="topbar-action-badge wishlist_count">{{App\Wishlist::where('user_id',Auth::user()->id)->count()}}</span></a></li>--}}
{{--                            <li><a href="{{url('comparisonlist')}}" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="{{__('Compare')}}"><i data-feather="anchor"></i></a></li>--}}
{{--                            @endif--}}
                            <li>
                                <a href="{{url('cart')}}" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="{{__('Cart')}}">
                                    <i data-feather="shopping-cart"></i>
                                    <span class="topbar-action-badge cart_count" id="cart_amount">
                                        <?php
                                            if(Auth::check()){
                                                echo App\Cart::where('user_id', Auth::user()->id)->count();
                                            } else {
                                                echo Session::get('cart')?count(Session::get('cart')):'0';
//                                                echo Session::get('guest_cart_count')? Session::get('guest_cart_count'):'0';
                                            }
                                        ?>
{{--                                        {{\Illuminate\Support\Facades\Session::get()}}--}}

                                    </span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    @if(Auth::check())
                                    <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{Auth::check()?Auth::user()->name:''}}">
                                        <i data-feather="user"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="user-img">
                                                @if(Auth::check() && Auth::user()->image != '' && file_exists(public_path() . '/images/user/' . Auth::user()->image))
                                                    <img src="{{url('/images/user/'.Auth::user()->image)}}" class="img-fluid" alt="{{Auth::check()?Auth::user()->name:''}}">
                                                @elseif(Auth::check())
                                                    <img src="{{Avatar::create(Auth::user()->name)->toBase64()}}" class="img-fluid" alt="{{Auth::check()?Auth::user()->name:''}}">
                                                @else
                                                    <img src="frontend/assets/images/user.png" class="img-fluid" alt="Profile">
                                                @endif
                                            </div>
                                            <div class="user-dtl">
                                                <h6 class="user-name">{{Auth::check()?Auth::user()->name:''}}</h6>
                                                <p><a href="{{Auth::check()?Auth::user()->email:''}}" title="{{Auth::check()?Auth::user()->email:''}}">{{Auth::check()?Auth::user()->email:''}}</a></p>
                                            </div>
                                        </li>
                                        @if(Auth::check() && Auth::user()->role_id=='a')
                                        <li><a class="dropdown-item" href="{{route('admin.main')}}" title="{{ __('Admin Dashboard') }}"><i data-feather="globe"></i>{{ __('Admin Dashboard') }}</a></li>
                                        @elseif(Auth::check() && Auth::user()->role_id=='v')
                                            @if(isset(Auth::user()->store))
                                                <li><a class="dropdown-item" href="{{route('seller.dboard')}}" title="Seller Dashboard"><i data-feather="globe"></i>{{ __('Seller Dashboard') }}</a></li>
                                            @endif
                                        @endif
                                        @if(Auth::check())
                                        <li><a class="dropdown-item" href="{{route('user.profile')}}" title="{{ __('My Account') }}"><i data-feather="user"></i>{{ __('My Account') }}</a></li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:" title="{{ __('Logout') }}" onclick="logout()"><i data-feather="log-out"></i>{{ __('Logout') }}</a>
                                            <form action="{{ route('logout') }}" method="POST" class="logout-form display-none">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                        @endif
                                    </ul>
                                    @else
                                        <a class="dropdown-toggle" href="javascript:" role="button" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            Login / Register
                                        </a>
                                    @endif
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Topbar Fullscreen End -->

    <!-- Topbar App Start -->
    <section id="topbar" class="topbar-main-block smallscreen-topbar">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-1">
                    <div class="hamburger-menu">
                        <span onclick="openNav()" class="hamburger">&#9776; </span>
                        <div id="mySidenav" class="sidenav">
                            <div class="topbar-sidenav">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="logo">
                                            <img src="{{url('images/genral/footer/'.$front_logo)}}" class="img-fluid" alt="Logo">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" title="close">&times;</a>
                                    </div>
                                </div>
                                <div class="topbar-search-product">
                                    <form action="#" class="search-form">
                                        <div class="input-group">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="search" placeholder="Search for products, brands and categories">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu-tab-pane" type="button" role="tab" aria-controls="menu-tab-pane" aria-selected="true">{{__('Menu')}}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories-tab-pane" type="button" role="tab" aria-controls="categories-tab-pane" aria-selected="false">{{__('Categories')}}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="menu-tab-pane" role="tabpanel" aria-labelledby="menu-tab" tabindex="0">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown" title="{{__('Categories')}}"><i data-feather="award"></i>{{__('All Categories')}}</a>
                                                <ul class="dropdown-menu">
                                                    @foreach(App\Category::where('status','1')->latest()->paginate(7) as $key => $cat)
                                                        <li>
                                                            <a class="dropdown-item " href="javascript:" onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">
                                                                {{ $cat->title }}
                                                                @if(count($cat->subcategory))
                                                                    <i data-feather="chevron-right"></i>
                                                                @endif
                                                            </a>
                                                            @if(count($cat->subcategory))
                                                                <ul class="submenu dropdown-menu">
                                                                    @foreach($cat->subcategory as $subKey => $subcat)
                                                                        <li>
                                                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$subcat->title}}">{{__($subcat->title)}}
                                                                                @if(count($subcat->childcategory))
                                                                                    <i data-feather="chevron-right"></i>
                                                                                @endif
                                                                            </a>
                                                                            @if(count($subcat->childcategory))
                                                                                <ul class="submenu dropdown-menu">
                                                                                    @foreach($subcat->childcategory as $childKey => $childcat)
                                                                                        <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$childcat->id}}, 'child')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="{{ url('/') }}" title="Home"><i data-feather="home"></i>{{__('Home')}}</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link" aria-current="page" href="{{route('all_authors')}}" title="Author">{{ __('Authors') }}</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link" aria-current="page" href="{{route('all_publishers')}}" title="Publisher">{{ __('Publishers') }}</a>
                                            </li>
{{--                                            <li class="nav-item">--}}
{{--                                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" title="{{__('Offer Zone')}}"><i data-feather="award"></i>{{__('Offer Zone')}}</a>--}}
{{--                                                <ul class="dropdown-menu">--}}
{{--                                                    @foreach(App\Category::where('status','1')->orderBy('position')->paginate(10) as $key => $cat)--}}
{{--                                                        <li>--}}
{{--                                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">--}}
{{--                                                            {{ $cat->title }}--}}
{{--                                                                @if(count($cat->subcategory))--}}
{{--                                                                <i data-feather="chevron-right"></i>--}}
{{--                                                                @endif--}}
{{--                                                            </a>--}}
{{--                                                            @if(count($cat->subcategory))--}}
{{--                                                            <ul class="submenu dropdown-menu">--}}
{{--                                                                @foreach($cat->subcategory as $subKey => $subcat)--}}
{{--                                                                <li>--}}
{{--                                                                    <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$subcat->title}}">{{__($subcat->title)}}--}}
{{--                                                                    @if(count($subcat->childcategory))--}}
{{--                                                                        <i data-feather="chevron-right"></i>--}}
{{--                                                                    @endif--}}
{{--                                                                    </a>--}}
{{--                                                                    @if(count($subcat->childcategory))--}}
{{--                                                                    <ul class="submenu dropdown-menu">--}}
{{--                                                                        @foreach($subcat->childcategory as $childKey => $childcat)--}}
{{--                                                                        <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </ul>--}}
{{--                                                                    @endif--}}
{{--                                                                </li>--}}
{{--                                                                @endforeach--}}
{{--                                                            </ul>--}}
{{--                                                            @endif--}}
{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li class="nav-item">--}}
{{--                                                <a class="nav-link" href="{{url('blog')}}" title="{{__('Blog')}}"><i data-feather="file-text"></i>{{__('Blog')}}</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="nav-item">--}}
{{--                                                <a class="nav-link" href="{{url('flashdeals/list')}}" title="{{__('Flash Deals')}}"><i data-feather="zap"></i>{{__('Flash Deals')}}</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="nav-item">--}}
{{--                                                <a class="nav-link" href="{{url('comparisonlist')}}" title="{{__('Compare')}}"><i data-feather="anchor"></i>{{__('Compare')}}</a>--}}
{{--                                            </li>--}}
                                            @if(Auth::check() && Auth::user()->role_id=='a')
                                            <li class="nav-item"><a class="nav-link" href="{{route('admin.main')}}" title="{{ __('Admin Dashboard') }}"><i data-feather="globe"></i>{{ __('Admin Dashboard') }}</a></li>
                                            @elseif(Auth::check() && Auth::user()->role_id=='v')
                                                @if(isset(Auth::user()->store))
                                                    <li class="nav-item"><a class="nav-link" href="{{route('seller.dboard')}}" title="Seller Dashboard"><i data-feather="globe"></i>{{ __('Seller Dashboard') }}</a></li>
                                                @endif
                                            @endif
                                            @if(Auth::check())
                                            <li class="nav-item"><a class="nav-link" href="{{route('user.profile')}}" title="{{ __('My Account') }}"><i data-feather="user"></i>{{ __('My Account') }}</a></li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:" title="{{ __('Logout') }}" onclick="logout()"><i data-feather="log-out"></i>{{ __('Logout') }}</a>
                                                <form action="{{ route('logout') }}" method="POST" class="logout-form display-none">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                            @else
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('user_login')}}" title="Login"><i data-feather="log-out"></i>{{ __('Login') }}</a>
                                                <a class="nav-link" href="{{route('user_register')}}" title="Register"><i data-feather="user"></i>{{ __('Register') }}</a>
                                            </li>
                                            @endif
{{--                                            <li class="nav-item dropdown lang-dropdown">--}}
{{--                                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="En">EN <i data-feather="chevron-down"></i></a>--}}
{{--                                                <ul class="dropdown-menu">--}}
{{--                                                    @foreach($langauges as $lang)--}}
{{--                                                    <li><a class="dropdown-item" href="javascript:" onchange="changed_lng( $lang->lang_code )" title="{{ $lang->name }}">{{ $lang->name }}</a></li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li class="nav-item dropdown lang-dropdown">--}}
{{--                                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" title=""><img src="frontend/assets/images/country/country_01.png" class="img-fluid" alt=""> <i data-feather="chevron-down"></i></a>--}}
{{--                                                <ul class="dropdown-menu">--}}
{{--                                                    @if(App\AutoDetectGeo::first()->enabel_multicurrency == '1')--}}
{{--                                                        @if(App\AutoDetectGeo::first()->currency_by_country == 1)--}}
{{--                                                            @forelse($manualcurrency as $currency)--}}
{{--                                                                @if(isset($currency->currency))--}}
{{--                                                                    <li><a class="dropdown-item" onchange="val($currency->currency->id)" href="javascript:" title="{{ $currency->currency->code }}">{{ $currency->currency->code }}</a></li>--}}
{{--                                                                @endif--}}
{{--                                                                @empty--}}
{{--                                                                    <li><a class="dropdown-item" onchange="val($currency->currency->id)" href="javascript:" title="{{ $currency->currency->code }}">{{ $currency->currency->code }}</a></li>--}}
{{--                                                            @endforelse--}}
{{--                                                        @else--}}
{{--                                                            @foreach($multiCurrency as $currency)--}}
{{--                                                                <li><a class="dropdown-item" onchange="val($currency->currency->id)" href="javascript:" title="{{ $currency->currency->code }}">{{ $currency->currency->code }}</a></li>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endif--}}
{{--                                                    @else--}}
{{--                                                        <li><a class="dropdown-item" onchange="val( $defCurrency->currency->id )" href="javascript:" title="{{ $defCurrency->currency->code }}">{{ $defCurrency->currency->code }}</a></li>--}}
{{--                                                    @endif--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="categories-tab-pane" role="tabpanel" aria-labelledby="categories-tab" tabindex="0">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown" id="myDropdown">
                                                <ul class="dropdown-menu show">

                                                    @foreach(App\Category::where('status','1')->orderBy('position')->get() as $key => $cat)
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:"  onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">
                                                            <img src="{{url('images/category/'.$cat->icon)}}" class="img-fluid" alt=" {{ $cat->title }} ">
                                                            {{ $cat->title }}
                                                            @if(count($cat->subcategory))
                                                            <i data-feather="chevron-right"></i>
                                                            @endif
                                                        </a>
                                                        @if(count($cat->subcategory))
                                                        <ul class="submenu dropdown-menu">
                                                            @foreach($cat->subcategory as $subKey => $subcat)
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:"  onclick="changeCategory({{$subcat->id}},'sub')" title="{{$subcat->title}}">{{$subcat->title}}</a>
                                                                @if(count($subcat->childcategory))
                                                                <ul class="submenu dropdown-menu">
                                                                    @foreach($subcat->childcategory as $childKey => $childcat)
                                                                    <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$childcat->id}}, 'child')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-5">
                    <div class="logo">
                    <a href="{{ url('/') }}" title="logo"><img src="{{url('images/genral/'.$front_logo)}}" class="img-fluid" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-4 col-md-6">
                    <div class="topbar-product-icon">
                        <ul>
{{--                            @if(Auth::check())--}}
{{--                            <li><a href="{{url('wishlist')}}" data-bs-toggle="tooltip" data-bs-placement="down" data-bs-title="{{__('Wishlist')}}"><i data-feather="heart"></i><span class="topbar-action-badge wishlist_count">{{App\Wishlist::where('user_id',Auth::user()->id)->count()}}</span></a></li>--}}
{{--                            <li><a href="{{url('comparisonlist')}}" data-bs-toggle="tooltip" data-bs-placement="down" data-bs-title="{{__('Compare')}}"><i data-feather="anchor"></i></a></li>--}}
{{--                            @endif--}}
                            <li>
                                <a href="{{url('cart')}}" data-bs-toggle="tooltip" data-bs-placement="down" data-bs-title="{{__('Cart')}}">
                                    <i  class="topbar-action-badge cart_count">
                                        <span id="cart_amount1">
                                             <?php
                                             if(Auth::check()){
                                                 echo App\Cart::where('user_id', Auth::user()->id)->count();
                                             } else {
                                                 echo Session::get('cart')?count(Session::get('cart')):'';
//                                                echo Session::get('guest_cart')?count([Session::get('guest_cart')]):'';
                                             }
                                             ?>
                                        </span>

                                     </i>
{{--                                    <span class="topbar-action-badge cart_count" id="cart_amount">--}}
{{--                                        <?php--}}
{{--                                        if(Auth::check()){--}}
{{--                                            echo App\Cart::where('user_id', Auth::user()->id)->count();--}}
{{--                                        } else {--}}
{{--                                            echo Session::get('cart')?count(Session::get('cart')):'0';--}}
{{--//                                                echo Session::get('guest_cart_count')? Session::get('guest_cart_count'):'0';--}}
{{--                                        }--}}
{{--                                        ?>--}}
{{--                                                                                {{\Illuminate\Support\Facades\Session::get()}}--}}

{{--                                    </span>--}}
                                </a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="user">
                                        <i data-feather="user"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="user-img">
                                                @if(Auth::check() && Auth::user()->image != '' && file_exists(public_path() . '/images/user/' . Auth::user()->image))
                                                    <img src="{{url('/images/user/'.Auth::user()->image)}}" class="img-fluid" alt="{{Auth::check()?Auth::user()->name:''}}">
                                                @elseif(Auth::check())
                                                    <img src="{{Avatar::create(Auth::user()->name)->toBase64()}}" class="img-fluid" alt="{{Auth::check()?Auth::user()->name:''}}">
                                                @else
                                                    <img src="frontend/assets/images/user.png" class="img-fluid" alt="Profile">
                                                @endif
                                            </div>
                                            <div class="user-dtl">
                                                <h6 class="user-name">{{Auth::check()?Auth::user()->name:''}}</h6>
                                                <p><a href="mailto:{{Auth::check()?Auth::user()->email:''}}" title="Email">{{Auth::check()?Auth::user()->email:''}}</a></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Topbar App End -->

        <!-- Home Start -->
    <section id="home" class="home-main-block product-home">
      <div class="container">
        <div class="row g-0">
{{--          <div class="col-xl-3 col-lg-3">--}}
{{--            <div class="home-categories-block">--}}
{{--              <nav class="navbar navbar-expand-lg navbar-dark bg-primary">--}}
{{--                <div class="collapse navbar-collapse" id="main_nav">--}}
{{--                  <ul class="navbar-nav">--}}
{{--                    <li class="nav-item dropdown" id="myDropdown">--}}
{{--                      <a class="nav-link dropdown-toggle categorylist" href="javascript:" data-bs-toggle="dropdown" title=""><i data-feather="list"></i>{{__('Categories')}}</a>--}}
{{--                      <ul class="dropdown-menu categorylist" data-aos="fade-right">--}}
{{--                      @foreach(App\Category::where('status','1')->orderBy('position')->paginate(10) as $key => $cat)--}}
{{--                        <li>--}}
{{--                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">--}}
{{--                            @if($cat->icon && @file_get_contents('images/category/'.$cat->icon))--}}
{{--                            <img src="{{url('images/category/'.$cat->icon)}}" class="img-fluid" alt=" {{ $cat->title }} ">--}}
{{--                            @endif--}}
{{--                            {{ __($cat->title) }}--}}
{{--                            @if(count($cat->subcategory))--}}
{{--                            <i data-feather="chevron-right"></i>--}}
{{--                            @endif--}}
{{--                            </a>--}}
{{--                            @if(count($cat->subcategory))--}}
{{--                            <ul class="submenu dropdown-menu">--}}
{{--                            @foreach($cat->subcategory as $subKey => $subcat)--}}
{{--                            <li>--}}
{{--                                <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$subcat->title}}">{{__($subcat->title)}}--}}
{{--                                    @if(count($subcat->childcategory))--}}
{{--                                        @if(count($cat->subcategory))--}}
{{--                                        <i data-feather="chevron-right"></i>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                </a>--}}

{{--                                @if(count($subcat->childcategory))--}}
{{--                                <ul class="submenu dropdown-menu">--}}
{{--                                    @foreach($subcat->childcategory as $childKey => $childcat)--}}
{{--                                    <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                                @endif--}}
{{--                            </li>--}}
{{--                            @endforeach--}}
{{--                            </ul>--}}
{{--                            @endif--}}
{{--                        </li>--}}
{{--                        @endforeach--}}
{{--                        <form action="{{route('filtershop')}}" method="Get" id="fillterform">--}}
{{--                            <input type="hidden" name="category" id="categoryId">--}}
{{--                            <input type="hidden" name="start" value="0.00">--}}
{{--                            <input type="hidden" name="end" value="0.00">--}}
{{--                            <input type="hidden" name="sid" id="subId">--}}
{{--                            <input type="submit" class="form-control d-none" value="Filter">--}}
{{--                        </form>--}}
{{--                      </ul>--}}
{{--                    </li>--}}
{{--                  </ul>--}}
{{--                </div>--}}
{{--              </nav>--}}
{{--            </div>--}}
{{--          </div>--}}
          <div class="col-xl-12 col-lg-12 col-md-12">
            <nav class="navbar navbar-expand-lg menubar about-menubar ">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="row sticky">
                        <ul class="navbar-nav">
                            <li class="nav-item active col-md-2">
                                <a  class="form-select text-dark " href="#" data-bs-toggle="dropdown" title="{{__('Categories')}}" >{{__('All Categories')}} </a>
                                <ul class="dropdown-menu ">
                                    @foreach(App\Category::where('status','1')->latest()->paginate(7) as $key => $cat)
                                        <li >
                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">
                                                {{ __($cat->title) }}
                                                @if(count($cat->subcategory))
                                                    <i data-feather="chevron-right"></i>
                                                @endif
                                            </a>
                                            @if(count($cat->subcategory))
                                                <ul class="submenu dropdown-menu">
                                                    @foreach($cat->subcategory as $subKey => $subcat)
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$subcat->title}}">{{__($subcat->title)}}
                                                                @if(count($subcat->childcategory))
                                                                    <i data-feather="chevron-right"></i>
                                                                @endif
                                                            </a>
                                                            @if(count($subcat->childcategory))
                                                                <ul class="submenu dropdown-menu">
                                                                    @foreach($subcat->childcategory as $childKey => $childcat)
                                                                        <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$childcat->id}}, 'child')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>

                                    @endforeach
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item" href="">see more</a>--}}
{{--                                        </li>--}}
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="{{ url('/') }}" title="Home">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="{{route('all_authors')}}" title="Author">{{ __('Authors') }}</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="{{route('all_publishers')}}" title="Publisher">{{ __('Publishers') }}</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" title="{{__('Offer Zone')}}">{{__('Offer Zone')}}</a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    @foreach(App\Category::where('status','1')->orderBy('position')->paginate(10) as $key => $cat)--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$cat->id}},'main')" title="{{ $cat->title }}">--}}
{{--                                                {{ __($cat->title) }}--}}
{{--                                                @if(count($cat->subcategory))--}}
{{--                                                    <i data-feather="chevron-right"></i>--}}
{{--                                                @endif--}}
{{--                                            </a>--}}
{{--                                            @if(count($cat->subcategory))--}}
{{--                                                <ul class="submenu dropdown-menu">--}}
{{--                                                    @foreach($cat->subcategory as $subKey => $subcat)--}}
{{--                                                        <li>--}}
{{--                                                            <a class="dropdown-item" href="javascript:" onclick="changeCategory({{$subcat->id}}, 'sub')" title="{{$subcat->title}}">{{__($subcat->title)}}--}}
{{--                                                                @if(count($subcat->childcategory))--}}
{{--                                                                    <i data-feather="chevron-right"></i>--}}
{{--                                                                @endif--}}
{{--                                                            </a>--}}
{{--                                                            @if(count($subcat->childcategory))--}}
{{--                                                                <ul class="submenu dropdown-menu">--}}
{{--                                                                    @foreach($subcat->childcategory as $childKey => $childcat)--}}
{{--                                                                        <li><a class="dropdown-item" href="javascript:" onclick="changeCategory({{$childcat->id}}, 'child')" title="{{$childcat->title}}">{{__($childcat->title)}}</a></li>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </ul>--}}
{{--                                                            @endif--}}
{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            @endif--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{url('blog')}}" title="{{ __('Blog') }}">{{ __('Blog') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{url('flashdeals/list')}}" title="Flash Deals">{{ __('Flash Deals') }}<i data-feather="zap"></i></a>--}}
{{--                            </li>--}}
                        </ul>

                    </div>

                </div>
              </div>
            </nav>
          </div>
        </div>

      </div>
    </section>
    <!-- Home End -->
    <script>
        function changeCategory(id, pog) {
            var base_URL = $('.baseURl').val();
            var start = '10.00';
            var end = '100000.00';
            var sid=id;
            var url = "{{ route('all_product', ['id'=>':id','pog'=>':pog']) }}";
            url = url.replace(':id', id);
            url = url.replace(':pog', pog);

            window.location=url;

{{--            if(base_URL){--}}
{{--                if(pog=='sub'){--}}
{{--                    var subId = id;--}}
{{--                    var mainId = '0';--}}
{{--                    window.location="{!! route('all_product') !!}";--}}
{{--                    // document.location.href--}}
{{--                    // window.location = base_URL + '/shop?category=' + mainId + '&start='+ start +'&end='+ end +'&sid=' + subId;--}}
{{--                } else {--}}
{{--                    var mainId = id;--}}
{{--                    window.location = base_URL + '/shop?category=' + mainId + '&start='+ start +'&end='+ end;--}}
{{--                }--}}
{{--            }--}}
        }
    </script>