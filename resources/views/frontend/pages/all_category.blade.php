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

@section('title','Boibari |  Authors')
@section("content")
<div style="background-color: #fff8f5">

    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container bg-white">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Filter') }}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb"
                         style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{ __('Filter') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home End -->

    <!-- Prodcut Start -->
    <section class="product-filter-main-block">
        <div class="container">
            <div class="row">
                {{--                    @if($footer3_widget->shiping)--}}
                @foreach($categories as $cat)
                    <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 20px">
                        <div class="customer-support-block border-hover" data-aos="fade-right">
                            <div class="border-hover-two">
                                <a href="{{route('all_product',[$cat->id,'main'])}}">
                                    <div class="row">
                                        <div class="col-lg-3 col-4">
                                            <div class="support-img">
                                                {{--                                                    <img src="{{ url('frontend/assets/images/support/shipping icon.png') }}"--}}
                                                @if($cat->image != '' && file_exists(public_path() . '/images/category/' . $cat->image))
                                                    <img src="{{ url('images/category/'.$cat->image) }}"
                                                         class="img-fluid shipping-img" alt="{{__($cat->title)}}">
                                                @else
                                                    <img class="img-fluid shipping-img" title="{{__($cat->title)}}"
                                                         src="{{url('images/no-image.png')}}" alt="No Image"/>
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

                {{--                    @endif--}}
                {{--                    @if($footer3_widget->mobile)--}}
                {{--                        <div class="col-lg-3 col-md-6 col-sm-6">--}}
                {{--                            <div class="customer-support-block border-hover" data-aos="fade-up">--}}
                {{--                                <div class="border-hover-two">--}}
                {{--                                    <div class="row">--}}
                {{--                                        <div class="col-lg-3 col-4">--}}
                {{--                                            <div class="support-img">--}}
                {{--                                                <img src="{{ url('frontend/assets/images/support/headset-solid.png') }}"--}}
                {{--                                                     class="img-fluid" alt="">--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-lg-9 col-8">--}}
                {{--                                            <div class="support-dtl">--}}
                {{--                                                <h5 class="support-title">{{ $footer3_widget->mobile }}</h5>--}}
                {{--                                                <p></p>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
                {{--                    @if($footer3_widget->return)--}}
                {{--                        <div class="col-lg-3 col-md-6 col-sm-6">--}}
                {{--                            <div class="customer-support-block border-hover" data-aos="fade-up">--}}
                {{--                                <div class="border-hover-two">--}}
                {{--                                    <div class="row">--}}
                {{--                                        <div class="col-lg-3 col-4">--}}
                {{--                                            <div class="support-img">--}}
                {{--                                                <img src="{{ url('frontend/assets/images/support/security.png') }}"--}}
                {{--                                                     class="img-fluid" alt="">--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-lg-9 col-8">--}}
                {{--                                            <div class="support-dtl">--}}
                {{--                                                <h5 class="support-title">{{ $footer3_widget->return }}</h5>--}}
                {{--                                                <p></p>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
                {{--                    @if($footer3_widget->money)--}}
                {{--                        <div class="col-lg-3 col-md-6 col-sm-6">--}}
                {{--                            <div class="customer-support-block border-hover" data-aos="fade-left">--}}
                {{--                                <div class="border-hover-two">--}}
                {{--                                    <div class="row">--}}
                {{--                                        <div class="col-lg-3 col-4">--}}
                {{--                                            <div class="support-img">--}}
                {{--                                                <img src="{{ url('frontend/assets/images/support/money.png') }}"--}}
                {{--                                                     class="img-fluid" alt="">--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-lg-9 col-8">--}}
                {{--                                            <div class="support-dtl">--}}
                {{--                                                <h5 class="support-title">{{ $footer3_widget->money }}</h5>--}}
                {{--                                                <p></p>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
            </div>
        </div>
    </section>
    <!-- Product End -->

</div>
@endsection
@section('script')
    <script>
        function submitForm(varType = '') {
            if (varType) {
                $('.varType').val(varType);
            }
            $('.submitForm').submit();
        }
    </script>
@endsection
