@extends("frontend.layout.master")
@section('title', "Emart | $pro->name")
@section("content")   
<!-- Home Start -->
<section id="home" class="home-main-block product-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="{{__('Home')}}">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item" title="{{ $pro->category->title }}">{{ $pro->category->title }}</li>
                        <li class="breadcrumb-item" title="{{ $pro->subcategory->title }}">{{ $pro->subcategory->title }}</li>
                        @if(!empty($pro->childcat->title))
                        <li class="breadcrumb-item" aria-current="page" href="{{ $pro->childcat->getURL() }}" title="{{ $pro->childcat->title }}">{{ $pro->childcat->title }}</li>
                        @endif
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                    <div class="breadcrumb-nav">
                        <h3 class="breadcrumb-title">
                        @if(!empty($pro->childcat->title))
                          {{$pro->childcat->title}}
                        @else
                          {{ $pro->subcategory->title }}
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
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-7">
            <div class="product-des-img-block">
              <div class="slick-slider-block">
                <div class="slider slider-for">
                    <div class="single-product-gallery-item">

                    {{-- single image through js here --}}

                    </div>
                </div>
                <div class="slider slider-nav galleryContainer">
                  
                </div>                
              </div>
            </div>
          </div>
          
          <div class="col-lg-5 col-md-5">
            <div id="details-container"></div>
            
            <div class="deals-dtl-block">

              <div class="deals-avail">
                <span>{{ __('Availability') }} :</span>
                <div class="deal-avail-text text-success stockval value"></div>
              </div>
              
              <h3 class="deals-dtl-title">{{$pro->name}}</h3>
              <?php

                  $review_t = 0;
                  
                  $price_t = 0;

                  $value_t = 0;

                  $sub_total = 0;

                  $ratings_var = 0;
                  
                  $count = count($pro->reviews);

                  $onlyrev = array();

                  foreach ($pro->reviews as $review) {
                      $review_t = $review->qty * 5;
                      $price_t = $review->price * 5;
                      $value_t = $review->value * 5;
                      $sub_total = $sub_total + $review_t + $price_t + $value_t;
                  }

                  $count = ($count * 3) * 5;

                  if ($count != "" && $count > 0) {
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
                <span>{{  $count =  count($pro->reviews) }} {{ __('Ratings and') }} {{ $reviewcount }} {{ __('Reviews') }}</span>
              @else
                <span>{{__('No Rating')}}</span>
              @endif
             
              <div class="deals-dtl-price">
                <ul>
                  <li class="deals-price price price-main dtl-price-main"></li>
                  <li>
                    <s>
                      @if($pro->offer_price != 0)
                        <span class="off_amount"></span>
                      @endif
                    </s>
                  </li>
                  <li class="deals-price-off"> &nbsp;<i data-toggle="tooltip" data-placement="left" title="{{ $pro->tax_r =='' ? __('Taxes Not Included') : __('Taxes Included') }}" data-feather="alert-circle"></i></li>
                </ul>
              </div>
              <div class="deals-dtl-offers">
                <h6 class="deals-offer-title">{{__('Available offers')}}</h6>
                <div class="offer-content">
                  <p><i data-feather="hexagon"></i>{{ __('Rating') }}.</p>
                  @if($pro->w_d !='None' && $pro->w_my !='None' && $pro->w_type !='None')
                  <p><i data-feather="hexagon"></i>{{$pro->w_d}} {{ ucfirst($pro->w_my) }} {{ __('of') }} {{ $pro->w_type }}</p>
                  @endif
                  @if(isset($cashback_settings) && $cashback_settings->enable == 1)
                  <p><i data-feather="hexagon"></i>{{ __("Buy now and earn cashback in your wallet ") }} {{ $cashback_settings->discount_type }}  @if($cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ sprintf("%.2f", $cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $cashback_settings->discount.'%' }}</b> @endif </p>
                  @endif
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="deals-size mb-3">
                      <h6 class="deals-size-title">{{__('Vendor')}} - 
                        <span>
                          <a href="{{ route('store.view',['uuid' => $pro->store->uuid ?? 0, 'title' => $pro->store->name]) }}" class="lnk">
                          {{ $pro->store->name }} 
                          @if($pro->store->verified_store) 
                          <span title="{{__('Verified')}}"><i data-feather="check-circle"></i></span>
                          @endif
                        </span>
                      </h6>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="deals-size mb-4">
                      <h6 class="deals-size-title">{{__('Trust of')}}  
                        <span><b>{{$pro->brand->name}}</b></span>
                      </h6>                      
                    </div>
                  </div>
                </div>

                <div class="deals-resolution mb-30">
                  @php
                    $indexNum = 0;
                  @endphp
                  @foreach($pro->variants as $key=> $mainvariant)
                    <h6 class="deals-size-title">
                      @php
                        $getattrname = App\ProductAttributes::where('id','=',$mainvariant->attr_name)->first();
                      @endphp

                      <span id="Size" class="deals-size-title mb-20">
                        <label class="atrbName" indexnum="{{$indexNum}}" id="{{ $getattrname->id }}" value="{{ $getattrname->attr_name }}">
                          @php
                          $k = '_';
                          @endphp
                          @if (strpos($getattrname->attr_name, $k) == false)
                            {{ $getattrname->attr_name }}
                          @else
                            {{str_replace('_', ' ',$getattrname->attr_name)}}
                          @endif
                        </label>
                      </span>
                    </h6>
                    <ul class="deals-colour-filter deals-resolution-img">
                      <li>
                        @foreach($mainvariant->attr_value as $subvalue)
                          
                          @php
                            $getvaluename = App\ProductValues::where('id','=',$subvalue)->first();
                          @endphp

                          @foreach($pro->subvariants as $key => $ss)

                          @if(isset($ss->main_attr_value[$getattrname->id]) && $ss->main_attr_value[$getattrname->id] == $getvaluename->id)
                          
                            @if($getvaluename->proattr->attr_name == "Color")
                            
                            
                              <a role="button" class="mt-2 mainvar font-weight-bold xyz" 
                                @if(isset($getvaluename) && strcasecmp($getvaluename->values, $getvaluename->unit_value) !=0)
                                  title="{{ $getvaluename->values }}"
                                @else
                                  title="{{ $getvaluename->values ?? '' }}"
                                @endif
                                attr_id="{{ $getattrname->id }}"
                                @if(isset($getvaluename) && strcasecmp($getvaluename->values, $getvaluename->unit_value) !=0)
                                  @if($getvaluename->proattr->attr_name == "Color")
                                    valname="{{ $getvaluename->values }}"
                                  @else
                                    valname="{{ $getvaluename->values }}{{ $getvaluename->unit_value }}"
                                  @endif
                                @else
                                  valname="{{ $getvaluename->values ?? '' }}"
                                @endif
                                  val="{{ $getvaluename->id }}"
                                  name="{{ $getattrname->attr_name }}"
                                  s="0"
                                  id="{{ $getattrname->attr_name }}{{ $getvaluename->id }}" onclick="tagfilter('{{ $getattrname->attr_name }}','{{ $getvaluename->id }}','{{$indexNum}}')">
                                
                                @if(env("SHOW_IMAGE_INSTEAD_COLOR") === true)
                              
                                  <img class="img-fluid" src="{{ url('/variantimages/'.$ss->variantimages->image1) }}" alt="{{ $ss->variantimages->image1 }}">
                                
                                @else

                                    <i style="color:{{ $getvaluename->unit_value }}" class="fa fa-circle"></i>

                                @endif

                              </a>

                            @else
                            
                              
                              <a class="mainvar font-weight-bold xyz" data-bs-toggle="tooltip" data-placement="top"
                                @if(isset($getvaluename) && strcasecmp($getvaluename->values, $getvaluename->unit_value) != 0)
                                  title="{{ $getvaluename->values }} {{ $getvaluename->unit_value }}" 
                                @else
                                  title="{{ $getvaluename->values }}" 
                                @endif 
                                
                                  attr_id="{{ $getattrname->id }}"
                                
                                @if(isset($getvaluename) && strcasecmp($getvaluename->values, $getvaluename->unit_value) !=0)

                                  @if($getvaluename->proattr->attr_name == "Color")
                                    valname="{{ $getvaluename->values }}" 
                                  @else
                                    valname="{{ $getvaluename->values }}{{ $getvaluename->unit_value }}" 
                                  @endif 
                                
                                @else

                                  valname="{{ $getvaluename->values ?? '' }}" 
                                  
                                @endif 
                                
                                val="{{ $getvaluename->id }}"
                                name="{{ $getattrname->attr_name }}" s="0"
                                id="{{ $getattrname->attr_name }}{{ $getvaluename->id }}" onclick="tagfilter('{{ $getattrname->attr_name }}','{{ $getvaluename->id }}','{{$indexNum}}')">

                                @if(isset($getvaluename) && strcasecmp($getvaluename->values, $getvaluename->unit_value) !=0 && $getvaluename->unit_value != null)
                                  {{ $getvaluename->values }} {{ $getvaluename->unit_value }}
                                @else
                                  {{ $getvaluename->values ?? '' }}
                                @endif

                              </a>

                            @endif


                          @endif

                          @endforeach
                        @endforeach
                      </li>
                    </ul>
                  @endforeach
                </div>
                <div class="notifymeblock">

                </div>
                
                <div class="deals-btn">
                  <ul>
                    <li>
                      <div class="quantity-container">
                        <div class="quant-input">
                        </div>
                      </div>
                    </li>
                    @php
                        $ifinwishlist = App\Wishlist::where('user_id',Auth::user()->id)->where('pro_id',$pro->subvariants?$pro->subvariants[0]->id:'')->first();
                    @endphp
                    @if(isset($pro->subvariants))
                      @if(!empty($ifinwishlist))
                      <li class="deals-icon favorite-button-box lnk wishlist add-wishlist">
                          <a class="removeFrmWish" mainid="{{ $pro->subvariants[0]->id }}" data-bs-toggle="tooltip" data-bs-placement="left" data-status="in_wish" data-bs-title="{{ __('Remove From Wishlist') }}"data-remove="{{url('removeWishList/'.$pro->subvariants[0]->id)}}"> <i data-feather="heart"></i>
                          </a>
                      </li>
                      @else
                      <li class="deals-icon favorite-button-box lnk wishlist">
                        <a data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="{{ __('Add To WishList') }}" class="addtowish" data-status="no" mainid="{{ $pro->subvariants[0]->id }}" data-add="{{url('AddToWishList/'.$pro->subvariants[0]->id)}}"> <i data-feather="heart"></i> </a>
                      </li>
                      @endif
                    @endif
                    <li class="deals-icon"><a href="javascript:" data-toggle="modal" data-placement="right" title="{{__('Share')}}" data-target="#sharemodal"><i data-feather="share-2"></i></a></li>
                    <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <div class="share-content modal-body">

                          </div>

                        </div>
                      </div>
                    </div>
                    @php
                      $m=0;
                    @endphp

                    @if(!empty(Session::get('comparison')))

                    @foreach(Session::get('comparison') as $p)

                      @if($p['proid'] == $pro->id)
                        @php
                          $m = 1;
                          break;
                        @endphp
                      @else
                        @php
                          $m = 0;
                        @endphp
                      @endif

                    @endforeach

                    @endif
                    
                    @if($m == 0)
                    <li class="deals-icon"><a title="{{__('Add to Compare')}}" href="{{ route('compare.product',$pro->id) }}"><i data-feather="anchor"></i></a></li>
                    @else
                    <li class="deals-icon"><a title="{{__('Remove From Compare List')}}" href="{{ route('remove.compare.product',$pro->id) }}"><i data-feather="anchor"></i></a></li>
                    @endif
                  </ul>
                </div>

              <div>
              <div class="deals-other-services">
                <h6 class="deals-size-title">{{__('Other Services')}}</h6>
                <div class="price-container info-container">
                  <div class="delivery-detail text-center">
                    <div class="row">

                      @if($pro->codcheck == 1)
                      <div class="col-lg-3 col-4">
                        <div class="image">
                          <img src="{{url('/images/icon-cod.png')}}" class="img-fluid" alt="img">
                        </div>
                        <div class="detail">{{ __('Pay on Delivery') }}</div>
                      </div>
                      @endif
                      @if($pro->return_avbl == 1)
                      <div class="col-lg-3 col-4">
                        <div data-bs-toggle="modal" data-bs-target="#returnmodal" class="image">
                          <img src="{{url('/images/icon-returns.png')}}" class="img-fluid" alt="img">
                        </div>
                        <div class="detail">{{ $pro->returnPolicy->days }} {{ __('Return days') }}
                        </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal fade" id="returnmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h5 class="modal-title" id="myModalLabel">{{ $pro->returnPolicy->name }}</h5>
                            </div>
                            <div class="modal-body">
                              {{ $pro->returnPolicy->des }}
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
                      @if($pro->free_shipping == 1)
                      <div class="col-lg-3 col-4">
                        <div class="image">
                          <img src="{{url('/images/icon-delivered.png')}}" class="img-fluid" alt="img">
                        </div>
                        <div class="detail">{{config('app.name')}} {{ __('Free Delivery') }}</div>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>           

            @if(isset($pro->sizechart) && $pro->size_chart != '' && $pro->sizechart->status == 1)
              <div>
                <h6 class="float-right">
                  <a class="text-primary" data-toggle="modal" data-target="#previewModal" role="button">
                    <i class="fa fa-bar-chart"></i> {{__("View size chart")}}
                  </a>
                </h6>
              </div>
            @endif

            @if(isset($pro->key_features))
              <div class="deals-highlight">
                <h6 class="delivery-title">{{__('Highlight')}}</h6>
                  <ul>
                    <li>{!! $pro->key_features !!}</li>
                  </ul>
              </div>
              <div class="report-text">
                <a href="#reportproduct" data-toggle="modal" title="Report Product">
                  <i data-feather="flag"></i>{{ __('Report incorrect product information') }}.
                </a>
              </div>
            @endif

            @if($pincodesystem == 1)
              <div class="deals-delivery-code">
                <h6 class="delivery-title">{{__('Delivery Details')}}</h6>
                <form id="myForm" method="post">
                  {{csrf_field()}}
                  <div class="form-group">

                    <div class="input-group mb-3">
                      <input placeholder="{{ __('Enter Pincode') }}" required class="pincode-input form-control" onchange="SubmitFormData()" type="text" id="deliveryPinCode" value="">
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

          </div>
        </div>
      </div>
    </section>
    <!-- Product End -->
    <section id="customer-support" class="customer-support-main-block">
      <div class="container">
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
                  <p>{{ __('With our partnered courier services your product will be delivered fast') }}.</p>
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
                  <p>{{ __('With') }} {{ config('app.name') }} {{ __('Quality checks your product quality is 100% trustable') }}.</p>
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
                  <p>{{ __('All your purcahse are secured from our leading payment gateways.') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Description Start -->
    <section id="product-description" class="product-description-main-block">
      <div class="container">
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
                  <a class="nav-link" id="pills-comments-tab" data-bs-toggle="pill" href="#pills-comments" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">{{ count($pro->comments) }} {{__('Comments') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="v-pro-faqs-tab" data-bs-toggle="pill" href="#v-pro-faqs" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">{{__('FAQs') }}</a>
                </li>
              </ul>
              
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                  <div class="description-block">
                    @if($pro->des != '')
                    {!! $pro->des !!}
                    @else
                      <h4>{{ __('No Description') }}</h4>
                    @endif
                    <hr>
                    <p><b>{{ __('Tags') }}:</b>
                      @php
                      $x = explode(',', $pro->tags);
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
                            
                            @if(count($pro->specs)>0)
                            <table class="table">
                              <tbody>
                                @foreach($pro->specs as $spec)
                                <tr>
                                  <th scope="row" class="bg-light bg-gradient">{{ $spec->prokeys }}</th>
                                  <td>{{ $spec->provalues }}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @else
                              <h4>{{ __('No Specifications') }}</h4>
                            @endif

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- <div class="features-block-smallscreen">
                    <div class="row">
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_01.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">12 Years Warranty*</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_02.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">6 Months Ex Warranty*</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_03.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">Emart Authorized</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_04.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">Trusted Quality</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_05.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">Free Shipping in 24 Hrs*</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_06.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">100% Genuine Product</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_07.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">Secure Payment</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="feature-block">
                          <div class="feature-img">
                            <img src="{{ url('frontend/assets/images/product/feature_08.png') }}" class="img-fluid" alt="">
                          </div>
                          <div class="feature-dtl">2 Days Easy Return Policy*</div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
                
                <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                  @auth
      
                    @php
                      $purchased = App\Order::where('user_id',Auth::user()->id)->get();
                      $findproinorder = 0;
                      $alreadyrated = $pro->reviews->where('user',Auth::user()->id)->first();
                    @endphp

                    @if(isset($purchased))
                      @foreach($purchased as $value)
                        @if($value->main_pro_id != '' && in_array($pro->id, $value->main_pro_id))
                          @php
                            $findproinorder = 1;
                          @endphp
                        @endif
                      @endforeach
                    @endif

                    @if($findproinorder == 1)
                        @if(isset($alreadyrated))


                          <h5>
                            {{ __('Your Review') }}
                          </h5>
                          <hr>
                          <div class="row">

                            <div class="col-md-2">
                              @if($alreadyrated->users->image !='')
                              <img src="{{ url('/images/user/'.$alreadyrated->users->image) }}" alt="" class="img-fluid rounded-circle">
                              @else
                              <img class="img-fluid rounded-circle"src="{{ Avatar::create($alreadyrated->users->name)->toBase64() }}">
                              @endif
                            </div>

                            <div class="col-md-8">
                              <p>
                                <b><i>{{ $alreadyrated->users->name }}</i></b>
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
                                <br>

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
                                  <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                  </div>
                                </div>
                                <br>
                                <span class="font-weight500">{{ $alreadyrated->review }}</span>
                              </p>
                            </div>

                          </div>

                          <hr>
                          <a title="View all reviews" class="font-weight-bold pull-right" href="{{ route('allreviews',['id' => $pro->id, 'type' => 'v']) }}">{{ __('View All') }}</a>
                          <h5 class="title">{{ __('Recent Reviews') }}</h5>

                          <hr>

                          <div class="row">

                            <div class="col-lg-3 col-md-3 col-sm-3">
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
                                    $reviews2 = App\UserReview::where('pro_id', $pro->id)->where('status', '1')->get();
                                    @endphp @if(!empty($reviews2[0]))
                                    @php
                                    $count = App\UserReview::where('pro_id', $pro->id)->count();
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


                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var2; ?>%"
                                        class="star-ratings-sprite-rating"></span></div>


                                    @else
                                    <div class="text-center">
                                      {{ __('No Rating') }}
                                    </div>
                                    @endif
                                  </div>
                                  <div class="total-review">{{$count =  count($pro->reviews)}} {{ __('Ratings &') }}
                                    {{$reviewcount}} {{ __('reviews') }}</div>
                                </div>
                                <div>
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

                            <div class="col-md-9">
                              <!-- All reviews will show here-->
                              @foreach($pro->reviews->take(5) as $review)

                              @if($review->status == "1")
                              <div class="row">

                                <div class="col-md-2">
                                  @if($review->users->image !='')
                                  <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                    class=" rounded-circle img-fluid">
                                  @else
                                  <img class="rounded-circle img-fluid"
                                    src="{{ Avatar::create($review->users->name)->toBase64() }}">
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


                              <!--end-->
                            </div>
                          </div>


                        @else
                          <h5>{{ __('Ratere View Purchase') }}</h5>
                          <hr>
                          @php
                            if(!isset($overallrating)){
                            $overallrating = 0;
                            }
                          @endphp
                          <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
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
                                    $reviews2 = App\UserReview::where('pro_id', $pro->id)->where('status', '1')->get();
                                    @endphp @if(!empty($reviews2[0]))
                                    @php
                                    $count = App\UserReview::where('pro_id', $pro->id)->count();
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


                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var2; ?>%"
                                        class="star-ratings-sprite-rating"></span></div>


                                    @else
                                    <div class="text-center">
                                      {{ __('No Rating') }}
                                    </div>
                                    @endif
                                  </div>
                                  <div class="total-review">{{$count =  count($pro->reviews)}} Ratings & {{$reviewcount}}
                                    reviews</div>
                                </div>
                                <div>
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

                            <div class="col-md-8 product-add-review">
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
                                    <form class="cnt-form" method="post" action="{{url('user_review/'.$pro->id)}}">
                                      {{csrf_field()}}
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

                          @if(count($pro->reviews)>0)
                          @foreach($pro->reviews->take(5) as $review)

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
                              @if(count($pro->reviews)>0)

                                @if(!isset($overallrating))
                                  @php
                                  $overallrating = 0;
                                  @endphp
                                @endif
                                <div class="row">

                                  <div class="col-lg-3 col-md-3 col-sm-3">
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
                                          $reviews2 = App\UserReview::where('pro_id', $pro->id)->where('status', '1')->get();
                                          @endphp @if(!empty($reviews2[0]))
                                          @php
                                          $count = App\UserReview::where('pro_id', $pro->id)->count();
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


                                          <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var2; ?>%"
                                              class="star-ratings-sprite-rating"></span></div>


                                          @else
                                          <div class="text-center">
                                            {{ __('No Rating') }}
                                          </div>
                                          @endif
                                        </div>
                                        <div class="total-review">{{$count =  count($pro->reviews)}} Ratings & {{$reviewcount}}
                                          {{ __('reviews') }}</div>
                                      </div>
                                      <div>
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
                                        <p>{{ __('All Customers give this product 4 and 5 Star Rating.') }}</p>
                                      </div>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-9">
                                    @foreach($pro->reviews->take(5) as $review)

                                    @if($review->status == "1")
                                    <div class="row">

                                      <div class="col-md-2">
                                        @if($review->users->image !='')
                                        <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                          class=" rounded-circle img-fluid">
                                        @else
                                        <img class="rounded-circle img-fluid"
                                          src="{{ Avatar::create($review->users->name)->toBase64() }}">
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
                                  </div>
                                </div>
                              @else
                              <h5><i class="fa fa-star"></i> {{ __('Be the first one to rate this product') }}</h5>
                            @endif
                        @endif

                    @else
                      <h5>{{ __('Please') }} <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        {{ __('to rate this product') }}</h5>

                      @if(count($pro->reviews)>0)
                      <hr>
                      <h5>{{ __('Recent Reviews') }}</h5>

                      <hr>
                      <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-3">
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
                                $reviews2 = App\UserReview::where('pro_id', $pro->id)->where('status', '1')->get();
                                @endphp @if(!empty($reviews2[0]))
                                @php
                                $count = App\UserReview::where('pro_id', $pro->id)->count();
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
                              <div class="total-review">{{$count =  count($pro->reviews)}} Ratings & {{$reviewcount}}
                                reviews</div>
                            </div>
                            <div>
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
                              <p>{{ __('All Customers give this product 4 and 5 Star Rating.') }}</p>
                            </div>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-9">
                          @foreach($pro->reviews->take(5) as $review)

                          @if($review->status == "1")
                          <div class="row">

                            <div class="col-md-2">
                              @if($review->users->image !='')
                              <img src="{{ url('/images/user/'.$review->users->image) }}" alt=""
                                class=" rounded-circle img-fluid">
                              @else
                              <img class="rounded-circle img-fluid"
                                src="{{ Avatar::create($review->users->name)->toBase64() }}">
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
                        </div>
                      </div>
                    @endif
                  @endauth
                </div>
                <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab" tabindex="0">
                  <h3><i class="fa fa-comments-o"></i> {{ __('Recent Comments') }}</h3>
                  <hr>
                  @forelse($pro->comments as $key=> $comment)

                    <div class="mt-2 media border border-default p-2">
                      <img src="{{ Avatar::create($comment->name)->toGravatar() }}" class="align-self-center mr-3" alt="{{ $comment->name }}">
                      <div class="media-body">
                        <small class="float-right">{{ $comment->created_at->diffForHumans() }}</small>
                        <h5 class="mt-0">{{ $comment->name }}</h5>
                        <p class="mb-0">
                          {!! $comment->comment !!}
                        </p>
                      </div>
                    </div>
                    <div class="appendComment">

                    </div>
                    @empty
                    <h4><i class="fa fa-trophy"></i> {{ __("No Comment Product") }}</h4>
                  @endforelse

                  @if(count($pro->comments)>5)

                    <p></p>
                    <div align="center" class="remove-row">
                      <button data-proid="{{ $pro->id }}" data-id="{{ $comment->id }}"
                        class="btn-more btn btn-info btn-sm">{{ __('Load More') }}</button>
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
                      <span class="text-red">{{$errors->first('name')}}</span>
                    </div>

                    <div class="form-group mb-20">
                      
                      <label>{{ __("Email") }}: <span class="text-red">*</span></label>
                      <input value="{{ old('email') }}" required name="email" type="email" class="form-control" aria-describedby="emailHelp">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      <input type="hidden" name="id" value="{{$pro->id}}">
                      <span class="text-red">{{$errors->first('email')}}</span>
                    </div>

                    

                    <div class="form-group mb-30">
                      <label>{{ __('Comment') }}: <span class="text-red">*</span></label>
                      <textarea name="comment" required placeholder="{{ __('Comment') }}" class="form-control" rows="3" cols="30">{{ old('comment') }}</textarea>
                      <span class="text-red">{{$errors->first('comment')}}</span>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="v-pro-faqs" role="tabpanel" aria-labelledby="v-pro-faqs-tab" tabindex="0">
                  @forelse($pro->faq as $qid => $fq)
                      <h5 class="mb-20">[Q.{{ $qid+1 }}] {{ $fq->question }}</h5>
                      <p>{!! $fq->answer !!}</p>
                      <hr>
                  @empty
                  
                    <h4>{{ __('NO FAQ') }}</h4>
                  
                  @endforelse
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-5 col-12">
            @if(isset($pro->relsetting))
              <div class="related-product-des">
                <h3 class="related-title">{{__('Related Product')}}</h3>
                @if($pro->relsetting->status == '1')
                    @if(isset($pro->relproduct))
                        @foreach($pro->relproduct->related_pro as $relpro)
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
                                            <div class="col-lg-8 col-md-8 col-9">
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
                                                      @elseif($pro->offer_price=="1")
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
                                            <div class="col-lg-4 col-md-4 col-3">
                                              <div class="related-price">
                                                @if($price_login == '0' || Auth::check())

                                                  @php

                                                  $result = ProductPrice::getprice($relproduct, $orivar)->getData();

                                                  @endphp


                                                  @if($result->offerprice == 0)
                                                    <span class="price"><i class="{{session()->get('currency')['value']}}"></i> {{ sprintf("%.2f",$result->mainprice*$conversion_rate) }}</span>
                                                  @else
                                                    <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{ price_format($result->offerprice*$conversion_rate) }}</span><br>
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
                    @foreach($pro->subcategory->products()->where('status','1')->get() as $relpro)
                      @if(isset($pro->subcategory->products))
                        @foreach($relpro->subvariants as $orivar)

                          @if($orivar->def == '1' && $pro->id != $orivar->products->id)

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
                                <div class="col-lg-8 col-md-8 col-9">
                                  <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5">
                                      <div class="related-img {{ $orivar->stock ==0 ? "pro-img-box" : ""}}">
                                        <a href="{{$url}}" title="{{$pro->name}}">
                                          @if(count($pro->subvariants))

                                            @if(isset($orivar->variantimages['image2']))
                                            <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" src="{{url('/variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" alt="{{$pro->name}}">
                                            @endif

                                          @else
                                            <img class="img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}" title="{{ $pro->name }}" src="{{url('/images/no-image.png')}}" alt="No Image" />
                                          @endif
                                        </a>
                                      </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7">
                                      <div class="related-dtl">
                                        <h6 class="title"><a href="{{$url}}" title="{{$pro->name}}">{{substr($relpro->name, 0, 20)}}{{strlen($relpro->name)>20 ? '...' : ""}}</a></h6>
                                        @if($orivar->stock == 0)
                                          <h5 align="center" class="oottext">{{ __('Out of stock') }} </h5>
                                        @endif

                                        @if($orivar->stock != 0 && $orivar->products->selling_start_at != null && $orivar->products->selling_start_at >= date('Y-m-d H:i:s'))
                                          <h5 align="center" class="oottext2"> {{ __('Coming Soon') }}</h5>
                                        @endif

                                        @if($pro->featured=="1")
                                          <div class="tag hot"><span> {{ __('Hot') }} </span></div>
                                        @elseif($pro->offer_price=="1")
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
                                <div class="col-lg-4 col-md-4 col-3">
                                  <div class="related-price">
                                    @if($price_login == '0' || Auth::check())

                                      @php

                                      $result = ProductPrice::getprice($relpro, $orivar)->getData();

                                      @endphp

                                      @if($result->offerprice == 0)
                                        <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{price_format($result->mainprice*$conversion_rate) }}</span>
                                      @else
                                        <span class="price"><i class="{{session()->get('currency')['value']}}"></i>{{ price_format($result->offerprice*$conversion_rate) }}</span><br>
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
        </div>
      </div>
    </section>
    <!-- Product Description End -->
   
   <!-- Report Product Modal -->
  <div class="modal fade" id="reportproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="myModalLabel">{{ __('Report Product') }} {{ $pro->name }}</h5>
        </div>

        <div class="modal-body">
          <form action="{{ route('rep.pro',$pro->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form group">
              <label>{{ __('Subject') }}: <span class="text-red">*</span></label>
              <input required type="text" name="title" class="form-control" placeholder="{{ __('Why you reporting the prdouct enter title') }}">
            </div>
            <br>
            <div class="form-group">
              <label>{{ __('Email') }}: <span class="text-red">*</span></label>
              <input name="email" required type="email" class="form-control" name="email" placeholder="{{ __('Enteryouremailaddress') }}">
            </div>

            <div class="form-group">
              <label>{{ __('Description') }}: <span class="text-red">*</span></label>
              <textarea required class="form-control" placeholder="{{ __('Briefdescriptionofyourissue') }}"
                name="des" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
              <button class="btn btn-md btn-primary">{{ __('SUBMIT FOR REVIEW') }}</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="notifyMe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-sm modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h6 class="modal-title" id="exampleModalLabel">Notify me</h6>

        </div>
        <div class="modal-body">
          <form action="" method="POST" class="notifyForm">
            @csrf
            <p class="help-block text-dark">
              {{__("Please enter your email to get notified")}}
            </p>
            <div class="form-group">
              <label>Email: <span class="text-red">*</span></label>
              <input name="email" type="email" class="form-control" placeholder="enter your email" required>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-md btn-primary">{{ __("Submit") }}</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Size chart modal -->
    @if(isset($pro->sizechart) && $pro->size_chart != '' && $pro->sizechart->status == 1)
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
                @include('admin.sizechart.previewtable',['template' => $pro->sizechart]) 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-rgba" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
      </div>
    @endif
  <!-- size chart model end -->

@endsection
@section('script')
  <!-- Validation JS -->
  <script src="{{url('front/vendor/js/additional-methods.min.js')}}"></script>
  <!-- Drfit ZOOM JS -->
  <script src="{{ url('front/vendor/js/drift.min.js') }}"></script>
  <script src="{{ url('js/share.js') }}"></script>
  @include('frontend.product_filter.detailpagescript')
  
  <script src="{{ url('js/detailpage.js') }}"></script>
  <script>
    $( document ).ready(function() {
      $('.qty-section').css('display','none');
    });
  </script>
  <script>
    feather.replace();
  </script>
@endsection