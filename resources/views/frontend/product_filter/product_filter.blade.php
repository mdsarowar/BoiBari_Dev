@extends("frontend.layout.master")
@php

  /** Seo of category pages */

    if(request()->keyword){
        $title      = __('Showing all results for :keyword',['keyword' => request()->keyword]);
        $seodes     = $title;
    }
    else if($chid)
    {
        $findchid = App\Grandcategory::find($chid);
        $title    = __(':title - All products | ',['title' => $findchid?$findchid->title:'']);
        $seodes   = strip_tags($findchid?$findchid->description:'');
        $seoimage = url('images/grandcategory/'.$findchid?$findchid->image:'');
    }
    else if($sid)
    {
        $findsubcat = App\Subcategory::find($sid);
        $title      = __(':title - All products | ',['title' => $findsubcat?$findsubcat->title:'']);
        $seodes     = strip_tags($findsubcat?$findsubcat->description:'');
        $seoimage   = url('images/subcategory/'.$findsubcat?$findsubcat->image:'');

    }else{

        $findcat    = App\Category::find($catid);
        $title      = __(':title - All products | ',['title' => $findcat?$findcat->title:'']);
        $seodes     = strip_tags($findcat?$findcat->description:'');
        if($findcat && $findcat->image){
          $seoimage   = url('images/category/'.$findcat?$findcat->image:'');
        } else {
          $seoimage   = url('images/category/');;
        }
        

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
   
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seodes }}" />
    <meta name="twitter:site" content="{{ url()->full() }}" />
  </main>
@endsection

@section('title','Emart | '. $title)
@section("content")   

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
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
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
    <section id="product-filter" class="product-filter-main-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <div class="product-filter-sidebar">
              <form action="{{url('shop')}}" method="Post" class="submitForm">
              @csrf
                <input type="hidden" name="category" value="{{$catid?$catid:Session::get('category_id')}}">
                <div class="accordion" id="accordionExample">
                  <div class="product-filter-block checkout-personal-dtl accordion-item">
                    <div class="accordion-header" id="headingOne">
                      <h4 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Brand</h4>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <ul>
                            @foreach(App\Brand::where('status','1')->get() as $key => $brands)
                            
                              @if(is_array($brands->category_id))
                                @foreach($brands->category_id as $brandcategory)
                                  @if($brandcategory == $catid)
                                    @if($brand_names && in_array($brands->id,$brand_names))
                                      <li>
                                        <label class="address-checkbox mb-15">{{$brands->name }}
                                          <input type="checkbox" id="br{{ $brands->id }}" onclick="submitForm()" name="brands[]" value="{{ $brands->id }}" checked>
                                          <span class="checkmark"></span>
                                        </label>
                                      </li>
                                    @else
                                      <li>
                                        <label class="address-checkbox mb-15">{{$brands->name }}
                                          <input type="checkbox" id="br{{ $brands->id }}" onclick="submitForm()" name="brands[]" value="{{ $brands->id }}">
                                          <span class="checkmark"></span>
                                        </label>
                                      </li>
                                    @endif
                                  @endif  
                                @endforeach
                              @endif
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                
                  <div class="product-filter-block accordion-item">
                    <div class="accordion-header" id="headingTwo">
                      <h4 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Price Range</h4>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <div class="range-slider">
                            <input name="start" class="start_price" type="range" onchange="submitForm()" value="{{$start?$start:Session::get('start')}}"/>
                            <!-- <input name="end" type="range" onchange="submitForm()" value="{{$end?$end:Session::get('end')}}"/> -->
                            <span>
                              <div class="title-one">
                                <input type="number" min="100" value="{{$start?$start:Session::get('start')}}" max="10000" readonly/>
                              </div>
                              <div class="title-two">
                                <input type="number" value="{{$end?$end:Session::get('end')}}" readonly/>
                              </div>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="product-filter-block checkout-personal-dtl accordion-item">
                    <div class="accordion-header" id="headingThree">
                      <h4 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">{{__('Featured Product')}}</h4>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <ul>
                            <li>
                              <label class="address-checkbox mb-15">{{__('Featured Product')}}
                                <input type="checkbox" name="featured" onclick="submitForm()" {{$featured=='1'?'checked':''}}>
                                <span class="checkmark"></span>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @php
                    $getattr = App\ProductAttributes::all();
                  @endphp
                  <div class="product-filter-block accordion-item">
                    <div class="accordion-header" id="headingFour">
                      <h4 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Colour</h4>
                      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <div class="deals-colour">
                            <ul class="deals-colour-filter">
                              @foreach($getattr as $colors)
                                @foreach($colors->provalues as $key => $color)
                                  @if($color->proattr->attr_name == "Color" || $color->proattr->attr_name == "Colour" || $color->proattr->attr_name =="color" || $color->proattr->attr_name == "colour" )
                                    @if($varValue && in_array($color->id,$varValue))
                                      <li>
                                        <input type="checkbox" name="varValue[]" onclick="submitForm()" value="{{$color->id}}" id="check{{$color->id}}" checked/>
                                        <label for="check{{$color->id}}" onclick="submitForm()">{{$color->values}}</label>
                                      </li>
                                    @else
                                      <li>
                                        <input type="checkbox" name="varValue[]" onclick="submitForm()" value="{{$color->id}}" id="check{{$color->id}}" />
                                        <label for="check{{$color->id}}" onclick="submitForm()">{{$color->values}}</label>
                                      </li>
                                    @endif
                                  @endif
                                @endforeach
                              @endforeach
                              <input type="hidden" name="varType[]" class="varType" value="1">
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="product-filter-block checkout-personal-dtl product-filter-block-two accordion-item">
                    @foreach($getattr as $disp => $disp_val)
                      <?php
                        $res = in_array($catid,$disp_val->cats_id);
                      ?>
                      @if($res == $disp_val->id)
                        @if($disp_val && $disp_val->attr_name!=='Color' && $disp_val->attr_name!=='color' && $disp_val->attr_name!=='Colour' && $disp_val->attr_name!=='colour')
                        <div class="accordion-header" id="headingFive{{$disp}}">
                          <h4 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive{{$disp}}" aria-expanded="true" aria-controls="collapseFive">{{str_replace('_', ' ', $disp_val->attr_name)}}</h4>
                          <div id="collapseFive{{$disp}}" class="accordion-collapse collapse" aria-labelledby="headingFive{{$disp}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <ul>
                                @foreach ($disp_val->provalues as $ind => $item)
                                  @if($item->proattr->attr_name == "Color" || $item->proattr->attr_name == "Colour" || $item->proattr->attr_name =="color" || $item->proattr->attr_name == "colour" )
                                  @else
                                    @if($varValue && in_array($item->id,$varValue))
                                      @if($item->values == $item->unit_value && $item->unit_value !='')
                                        <li>
                                          <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}
                                            <input type="checkbox" id="btnradio{{ $item->id }}" name="varValue[]" value="{{ $item->id }}" onclick="submitForm({{$disp_val->id}})" checked>
                                            <span class="checkmark"></span>
                                          </label>
                                        </li>
                                      @else
                                        <li>
                                          <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}{{ $item->unit_value }}
                                            <input type="checkbox" id="btnradio{{ $item->id }}" name="varValue[]" value="{{ $item->id }}" onclick="submitForm({{$disp_val->id}})" checked>
                                            <span class="checkmark"></span>
                                          </label>
                                        </li>                                
                                      @endif
                                    @else
                                      @if($item->values == $item->unit_value && $item->unit_value !='')
                                        <li>
                                          <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}
                                            <input type="checkbox" id="btnradio{{ $item->id }}" name="varValue[]" value="{{ $item->id }}" onclick="submitForm({{$disp_val->id}})">
                                            <span class="checkmark"></span>
                                          </label>
                                        </li>
                                      @else
                                        <li>
                                          <label class="address-checkbox mb-15" for="btnradio{{ $item->id }}">{{ $item->values }}{{ $item->unit_value }}
                                            <input type="checkbox" id="btnradio{{ $item->id }}" name="varValue[]" value="{{ $item->id }}" onclick="submitForm({{$disp_val->id}})">
                                            <span class="checkmark"></span>
                                          </label>
                                        </li>                                
                                      @endif
                                    @endif
                                  @endif
                                  
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                        @endif
                      @endif
                    @endforeach
                  </div>
                </div>
                <div class="product-filter-img">
                  <img src="{{ url('frontend/assets/images/product/offer.png') }}" class="img-fluid" alt="">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-9 col-md-8">
            <div class="row">
              @include('frontend.product_filter.product')
            </div>            
          </div>
        </div>
      </div>
    </section>
    <!-- Product End -->

@endsection
@section('script')
<script>
  function submitForm(varType='')
  {
    if(varType){
      $('.varType').val(varType);
    }
    $('.submitForm').submit();
  }
</script>
@endsection
