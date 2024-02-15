@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   
<div style="background-color: #fff8f5">

  <!-- Home Start -->
  <section id="home" class="home-main-block product-home">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb" class="breadcrumb-main-block">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
              <li class="breadcrumb-item">{{__('Account')}}</li>
              <li class="breadcrumb-item active" aria-current="page">{{__('Order')}}</li>
            </ol>
          </nav>
          <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
            <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">{{__('Order')}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home End -->

  <!-- My Account Start -->
  <section id="my-account" class="my-account-main-block popular-item-main-block">
    <div class="container bg-white">
      <div class="row">
        <?php $active['active'] = 'Myorder'; ?>
        @include('frontend.profile.sidebar',$active)
        <div class="col-lg-9 col-md-8">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="order-block">
              <h3 class="section-title">{{__('My Orders')}} ({{ count($orders) }})</h3>
              <div class="order-search-filter">
                <div class="row d-none">
                  <div class="col-lg-11">
                    <form action="#" class="search-form">
                      <div class="input-group">
                        <div class="form-group">
                          <input type="text" class="form-control" id="search" placeholder="Search">
                          <div class="search-icon">
                            <i data-feather="search"></i>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-1">
                    <a href="" title="">
                      <div class="filter-icon">
                        <i data-feather="filter"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="our-product-block">
                <div class="row">
                  @foreach($orders->take(5) as $order)
                    @php
                      if($order->discount != 0){
                        if($order->distype == 'category'){

                        $findCoupon = App\Coupan::where('code','=',$order->coupon)->first();
                        $catarray = collect();
                          foreach ($order->invoices as $key => $os) {

                            if(isset($os->variant->products) && $os->variant->products->category_id == $findCoupon->cat_id){

                              $catarray->push($os);

                            }

                            if(isset($os->simple_product) && $os->simple_product->category_id == $findCoupon->cat_id){

                              $catarray->push($os);

                            }

                          }

                        }
                      }
                    @endphp
                    <div class="col-lg-6">
                      <div class="product-order-block">
                        <div class="product-date-rate">

                          <div class="row mt-2">
                            <div class="col-lg-12 mb-2">
                              <h6 class="date-title">
                                {{ __('Order ID') }}: <span>{{ $order->transaction_id }}</span>
                              </h6>
                            </div>

                            <div class="col-lg-12">
                              <h6 class="date-title">
                                {{ __('Payment Method') }}: <span>{{ $order->payment_method }}</span>
                              </h6>
                            </div>
                          </div>

                        </div>
                        <div class="product-order-dtl-block">
                          @php
                            $x = count($order->invoices);
                            if(isset($order->invoices[0])){
                              $firstarray = array($order->invoices[0]);
                            }

                            $morearray = array();
                            $counter = 0;

                            foreach ($order->invoices as $value) {
                              if($counter++ >0 ){
                                array_push($morearray, $value);
                              }
                            }

                            $morecount = count($morearray);
                          @endphp
                          @if(isset($firstarray))
                            @foreach($firstarray as $o)
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="product-order-img">

                                    @if($o->variant)
                                      <a target="_blank" href="{{ $o->variant->products->getURL($o->variant) }}" title="{{__('Order Detail')}}">
                                        @if(isset($o->variant->variantimages) && file_exists(public_path().'/variantimages/thumbnails/'.$o->variant->variantimages->main_image))
                                          <img class="img-fluid" src="{{url('variantimages/thumbnails/'.$o->variant->variantimages->main_image)}}" alt="{{__('product name') }}" />
                                        @else
                                          <img class="img-fluid" src="{{ Avatar::create($o->variant->products->name)->toBase64() }}" alt="{{__('product name') }}" />
                                        @endif
                                      </a>
                                    @endif

                                    @if($o->simple_product)
                                      @if($o->simple_product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$o->simple_product->thumbnail))
                                        <img class="img-fluid" src="{{ url('images/simple_products/'.$o->simple_product->thumbnail) }}"/>
                                      @else
                                        <img class="img-fluid" src="{{ Avatar::create($o->simple_product->product_name)->toBase64() }}" alt="product name" />
                                      @endif
                                    @endif

                                  </div>
                                </div>
                                <div class="col-lg-8">
                                  <div class="product-order-dtl">
                                    @if(isset($o->variant))
                                      <h6><a target="_blank" href="{{ $o->variant->products->getURL($o->variant) }}">{{substr($o->variant->products->name, 0, 30)}}{{strlen($o->variant->products->name)>30 ? '...' : ""}}</a></h6>
                                      <p><small>{{ variantname($o->variant) }}</small></p>
                                      {{--                                    <p><small><b>{{__('Sold By')}}:</b> {{$o->variant->products->store->name}}</small></p>--}}
                                    @endif

                                    @if(isset($o->simple_product))
                                      <h6><a target="_blank" href="{{ route('show.product',['id' => $o->simple_product->id, 'slug' =>   $o->simple_product->slug]) }}">{{ $o->simple_product->product_name }}</a></h6>
                                      {{--                                    <p><small><b>{{__('Sold By')}}:</b> {{$o->simple_product->store->name}}</small></p>--}}
                                    @endif

                                    <small><b>{{ __('Qty') }}:</b> {{$o->qty}}</small>

                                  </div>
                                </div>
                              </div>

                            @endforeach
                          @endif
                          <div class="product-order-icon">
                            <a href="{{  route('user.view.order',$order->order_id) }}" title="{{__('Order Detail')}}"><i data-feather="chevron-right"></i></a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <h6 class="date-title">Status: <span>{{ ucfirst($o->status) }}</span></h6>
                          </div>
                          <div class="col-lg-12">
                            <p class="expected-delivery-date">{{ __('Expected delivery by :date',['date' => date("d-M-Y",strtotime($o->exp_delivery_date))]) }}.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <nav aria-label="Page navigation example text-center">
                  <a href="{{url('all/my/order')}}" class="btn btn-primary">View More</a>
                </nav>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Account End -->

</div>
@endsection

