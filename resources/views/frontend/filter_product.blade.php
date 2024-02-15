@extends("frontend.layout.master")
@php

  /** Seo of category pages */

    if(request()->keyword){
        $title      = __('Showing all results for :keyword',['keyword' => request()->keyword]);
        $seodes     = $title;
    }
    else if(request()->chid)
    {
        $findchid = App\Grandcategory::find(request()->chid);
        $title    = __(':title - All products | ',['title' => $findchid->title]);
        $seodes   = strip_tags($findchid->description);
        $seoimage = url('images/grandcategory/'.$findchid->image);
    }
    else if(request()->sid)
    {
        $findsubcat = App\Subcategory::find(request()->sid);
        $title      = __(':title - All products | ',['title' => $findsubcat->title]);
        $seodes     = strip_tags($findsubcat->description);
        $seoimage   = url('images/subcategory/'.$findsubcat->image);

    }else{

        $findcat    = App\Category::find(request()->category);
        $title      = __(':title - All products | ',['title' => $findcat->title]);
        $seodes     = strip_tags($findcat->description);
        $seoimage   = url('images/category/'.$findcat->image);

    }

  /* End */

@endphp
@section('meta_tags')
  <main id="seo_section">
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta name="robots" content="all">
    <meta property="og:title" content="{{ $title }}" />
    <meta name="keywords" content="{{ $title }}">
    <meta property="og:description" content="{{ $seodes }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:image" content="{{ isset($seoimage) ? $seoimage : '' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seodes }}" />
    <meta name="twitter:site" content="{{ url()->full() }}" />
  </main>
@endsection
@section('title','Emart | '. $title)
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
              <li class="breadcrumb-item active" aria-current="page">{{ __('Filter') }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- Home End -->

  <!-- Prodcut Start -->
  <section id="product-filter" class="product-filter-main-block">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="product-filter-sidebar">
            <form action="">

              <div class="product-filter-block checkout-personal-dtl">
                <h4 class="section-title">Brand</h4>
                <ul>
                  <li>
                    <label class="address-checkbox mb-15">Apple
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="address-checkbox mb-15">One Plus
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="address-checkbox mb-15">Samsung
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="address-checkbox mb-15">Sony
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="address-checkbox mb-15">Redmi
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="address-checkbox mb-15">Vivo
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                </ul>
              </div>

              <div class="product-filter-block">
                <h4 class="section-title">Price Range</h4>
                <div class="range-slider">
                  <input name="amountstart" type="range"/>
                  <input name="amountend" type="range"/>
                  <span>
                      <div class="title-one">
                        <input type="number" value="{{$start}}" min="100" max="10000" readonly/>
                      </div>
                      <div class="title-two">
                        <input type="number" value="{{$end}}" min="100" max="10000" readonly/>
                      </div>
                    </span>
                </div>
              </div>

              <div class="product-filter-block checkout-personal-dtl">
                <h4 class="section-title">{{__('Featured Product')}}</h4>
                <ul>
                  <li>
                    <label class="address-checkbox mb-15" onclick="getfeaturedpro('{{ 'featured' }}')">{{__('Featured Product')}}
                      <input type="checkbox" name="featured">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                </ul>
              </div>
              @php
                $getattr = App\ProductAttributes::all();
              @endphp
              <div class="product-filter-block">

                <h4 class="section-title">Colour</h4>
                <div class="deals-colour">
                  <ul class="deals-colour-filter">
                    <li><a href="#" title="" class="colour-five"></a></li>
                    <li><a href="#" title="" class="colour-six"></a></li>
                    <li><a href="#" title="" class="colour-seven"></a></li>
                    <li><a href="#" title="" class="colour-eight"></a></li>
                    <li><a href="#" title="" class="colour-nine"></a></li>
                    <li><a href="#" title="" class="colour-ten"></a></li>
                  </ul>
                </div>

              </div>

              <div class="product-filter-block checkout-personal-dtl">
                @foreach($getattr as $disp => $disp_val)
                    <?php
                    $res = in_array($catid,$disp_val->cats_id);
                    ?>

                  @if($disp_val)

                    <h4 class="section-title">{{str_replace('_', ' ', $disp_val->attr_name)}}</h4>
                    <ul>
                      @foreach ($disp_val->provalues as $ind => $item)
                        @if($item->values == $item->unit_value && $item->unit_value !='')
                          <li>
                            <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}
                              <input type="checkbox" id="btnradio{{ $item->id }}" >
                              <span class="checkmark"></span>
                            </label>
                          </li>
                        @else
                          <li>
                            <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}{{ $item->unit_value }}
                              <input type="checkbox" id="btnradio{{ $item->id }}">
                              <span class="checkmark"></span>
                            </label>
                          </li>

                        @endif
                      @endforeach
                    </ul>
                  @endif
                @endforeach
              </div>

              <div class="product-filter-img">
                <img src="{{ url('frontend/assets/images/product/offer.png') }}" class="img-fluid" alt="no img found">
              </div>

            </form>
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="row">
            @if(count($all_products) && $all_products)
              @foreach($all_products as $key => $product)
                <div class="col-lg-4 col-md-6 col-6">
                  <div class="featured-product-block">
                    <div class="featured-product-img">

                      @if($product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$product->thumbnail))
                        <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="{{__($product->product_name)}}">
                          <img src="{{ url('images/simple_products/'.$product->thumbnail) }}" class="img-fluid" alt="{{__($product->product_name)}}">
                        </a>
                      @else
                        @if(isset($product->subvariants) && count($product->subvariants))
                          @if($product->subvariants != '' && $product->subvariants[0]->variantimages != '' && file_exists(public_path().'/variantimages/thumbnails/'.$product->subvariants[0]->variantimages->main_image))
                            <a href="" title="{{ $product->name }}">
                              <img src="{{ url('/variantimages/thumbnails/'.$product->subvariants[0]->variantimages->main_image) }}" class="img-fluid" alt="{{__($product->name)}}">
                            </a>
                          @else
                            <a href="" title="{{ $product->name }}">
                              <img class="img-fluid" title="{{ $product->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                            </a>
                          @endif
                        @else
                          <a href="" title="{{__($product->product_name)}}">
                            <img class="img-fluid" title="{{ $product->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                          </a>
                        @endif
                      @endif

                      <div class="overlay-bg"></div>
                      <div class="featured-product-icon">
                        <ul>
                          <li><a href="#" title="eye"><i data-feather="eye"></i></a></li>
                          <li><a href="#" title="wishlist"><i data-feather="heart"></i></a></li>
                          <li><a href="#" title="cart"><i data-feather="briefcase"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="featured-product-dtl">
                      <div class="row">
                        <div class="col-lg-9">
                          <h6 class="featured-product-title">

                            @if(isset($product->product_name) && $product->product_name)
                              <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="{{ $product->product_name }}">
                                {{ $product->product_name }}
                              </a>
                            @else
                              <a href="" title="{{ $product->name }}">
                                {{ $product->name }}
                              </a>
                            @endif
                            {{$product->subvariants}}
                          </h6>
                          <p>By MJ Store</p>
                        </div>
                        <div class="col-lg-3">
                          <div class="featured-product-price">
                            <i class="{{ session()->get('currency')?session()->get('currency')['value']:'' }}"></i>
                            @if(isset($product->product_name) && $product->product_name)
                              {{ $product->offer_price != 0 && $product->offer_price != '' ? price_format($product->offer_price) :  price_format($product->price)  }}
                            @else
                              {{ $product->vender_offer_price != 0 && $product->vender_offer_price != '' ? price_format($product->vender_offer_price) :  price_format($product->vender_price)  }}
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else

            @endif
          </div>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item page-arrow">
                <a class="page-link" href="#" aria-label="Previous">
                  <i data-feather="chevron-left"></i>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item page-arrow page-arrow-right">
                <a class="page-link" href="#" aria-label="Next">
                  <i data-feather="chevron-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- Product End -->

</div>
@endsection