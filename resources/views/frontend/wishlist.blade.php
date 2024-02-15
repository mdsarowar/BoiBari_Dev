@extends("frontend.layout.master")
@section('title','Emart | Wishlist')
@section("content")   
    <!-- Home Start -->
    <section id="home" class="home-main-block product-home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb" class="breadcrumb-main-block">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Wishlist') }}</li>
              </ol>
            </nav>
            <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
              <div class="breadcrumb-nav">
                  <h3 class="breadcrumb-title">{{ __('Wishlist') }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Home End -->

    <!-- Wishlist Start -->
    <section id="wishlist" class="wishlist-main-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="wishlist-block">
              <div class="alert alert-dismissible fade show" role="alert">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      @if(count($data) > 0)
                        @foreach($data as $p)
                          @if($p->variant && $p->variant->products->status == 1)
                            <tr id="productrow{{ $p->variant->id }}">
                              <td style="width:5%;">
                                <a mainid="{{ $p->variant->id }}" data-remove="{{url('removeWishList/'.$p->variant->id)}}" title="{{__('Remove it from your Wishlist')}}" class="removeFrmWish">
                                  <i class="fa fa-times" aria-hidden="true"></i> 
                                </a>
                              </td>
                              <td style="width:10%;">
                                <a href="{{ App\Helpers\ProductUrl::getUrl($p->variant->id) }}" title="{{__('Product Image')}}">
                                  @if(isset($p->variant->variantimages) && file_exists(public_path().'/variantimages/thumbnails/'.$p->variant->variantimages->main_image))
                                  <img title="{{ $p->variant->products->name }}" src="{{ url('variantimages/thumbnails/'.$p->variant->variantimages['main_image']) }}" alt="{{ $p->variant->variantimages['main_image'] }}" class="img-fluid">
                                  @else 
                                  <img title="{{ $p->variant->products->name }}" src="{{url('images/no-image.png')}}" alt="{{ $p->variant->variantimages['main_image'] }}" class="img-fluid">
                                  @endif
                                </a>
                              </td>
                              <td class="brd-rgt p-25 wishlist-title" style="width:35%;"><a href="{{ App\Helpers\ProductUrl::getUrl($p->variant->id) }}" title="{{$p->variant->products->name}}">{{$p->variant->products->name}} <small>({{ variantname($p->variant) }})</small></a></td>
                              <td class="brd-rgt p-25" style="width:15%;">
                                @if($price_login == 0 || Auth::check())
                                  @php
                                  $convert_price = 0;
                                  $show_price = 0;

                                  $commision_setting = App\CommissionSetting::first();

                                  if($commision_setting->type == "flat"){

                                  $commission_amount = $commision_setting->rate;
                                  if($commision_setting->p_type == 'f'){

                                  $totalprice = $p->variant->products->vender_price+$p->variant->price+$commission_amount;
                                  $totalsaleprice = $p->variant->products->vender_offer_price + $p->variant->price + $commission_amount;

                                  if($p->variant->products->vender_offer_price == 0){
                                  $show_price = $totalprice;
                                  }else{
                                  $totalsaleprice;
                                  $convert_price = $totalsaleprice =='' ? $totalprice:$totalsaleprice;
                                  $show_price = $totalprice;
                                  }


                                  }else{

                                  $totalprice = ($p->variant->products->vender_price+$p->variant->price)*$commission_amount;

                                  $totalsaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)*$commission_amount;

                                  $buyerprice = ($p->variant->products->vender_price+$p->variant->price)+($totalprice/100);

                                  $buyersaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)+($totalsaleprice/100);


                                  if($p->variant->products->vender_offer_price ==0){
                                  $show_price = round($buyerprice,2);
                                  }else{
                                  round($buyersaleprice,2);

                                  $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                  $show_price = $buyerprice;
                                  }


                                  }
                                  }else{

                                  $comm = App\Commission::where('category_id',$p->variant->products->category_id)->first();
                                  if(isset($comm)){
                                  if($comm->type=='f'){

                                  $price = $p->variant->products->vender_price + $comm->rate + $p->variant->price;

                                  if($p->variant->products->vender_offer_price != null){
                                  $offer = $p->variant->products->vender_offer_price + $comm->rate + $p->variant->price;
                                  }else{
                                  $offer = $p->variant->products->vender_offer_price;
                                  }

                                  if($p->variant->products->vender_offer_price == 0 || $p->variant->products->vender_offer_price == null){
                                  $show_price = $price;
                                  }else{

                                  $convert_price = $offer;
                                  $show_price = $price;
                                  }


                                  }
                                  else{

                                  $commission_amount = $comm->rate;

                                  $totalprice = ($p->variant->products->vender_price+$p->variant->price)*$commission_amount;

                                  $totalsaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)*$commission_amount;

                                  $buyerprice = ($p->variant->products->vender_price+$p->variant->price)+($totalprice/100);

                                  $buyersaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)+($totalsaleprice/100);


                                  if($p->variant->products->vender_offer_price == 0){
                                  $show_price = round($buyerprice,2);
                                  }else{
                                  $convert_price = round($buyersaleprice,2);

                                  $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                  $show_price = round($buyerprice,2);
                                  }



                                  }
                                  }else{
                                  $commission_amount = 0;

                                  $totalprice = ($p->variant->products->vender_price+$p->variant->price)*$commission_amount;

                                  $totalsaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)*$commission_amount;

                                  $buyerprice = ($p->variant->products->vender_price+$p->variant->price)+($totalprice/100);

                                  $buyersaleprice = ($p->variant->products->vender_offer_price+$p->variant->price)+($totalsaleprice/100);


                                  if($p->variant->products->vender_offer_price == 0){
                                  $show_price = round($buyerprice,2);
                                  }else{
                                  $convert_price = round($buyersaleprice,2);

                                  $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                  $show_price = round($buyerprice,2);
                                  }
                                  }
                                  }
                                  $convert_price_form = $convert_price;
                                  $show_price_form = $show_price;
                                  $convert_price = $convert_price*$conversion_rate;
                                  $show_price = $show_price*$conversion_rate;

                                  @endphp

                                  @if(Session::has('currency'))
                                    @if($convert_price == 0 || $convert_price == 'null')
                                    <span><i class="{{session()->get('currency')['value']}}"></i> {{round($show_price,2)}}</span>
                                    @else
                                    <span><i class="{{session()->get('currency')['value']}}"></i> {{round($convert_price,2)}}</span>
                                    <span><s><i class="{{session()->get('currency')['value']}}"></i> {{round($show_price,2)}}</s></span>
                                    @endif
                                  @endif

                                @endif
                              </td>
                              
                                @if($p->variant->stock == 0)
                                  <td class="brd-rgt p-25 wishlist-out-stock" style="width:15%;">{{ __('Out of stock') }}</td>
                                @else
                                <td class="brd-rgt p-25 wishlist-stock" style="width:15%;">{{ __('In Stock') }}</td>
                                @endif

                              <td class="brd-rgt p-25" style="width:5%;"><a href="{{ App\Helpers\ProductUrl::getUrl($p->variant->id) }}" title="eye"><i data-feather="eye"></i></a></td>
                              <td class="brd-rgt p-25" style="width:5%;">
                                <form method="POST" action="{{route('add.cart',['id' => $p->variant->products->id ,'variantid' =>$p->variant->id, 'varprice' => $show_price_form, 'varofferprice' => $convert_price_form ,'qty' =>$p->variant->min_order_qty])}}" class="addVariantProCard{{$p->variant->products->id}}">
                                    {{ csrf_field() }}
                                    <a href="javascript:" onclick="addVariantProCard({{$p->variant->products->id}})" title="{{__('Add to Cart')}}"><i data-feather="briefcase"></i></a>  
                                </form>
                              </td>
                              <!-- <td class="p-25" style="width:5%;"><a href="#" title="share"><i data-feather="share-2"></i></a></td> -->
                            </tr>
                          @endif
                          @if(isset($p->simple_product) && $p->simple_product->status == '1')
                            <tr id="productrow{{ $p->simple_product?$p->simple_product->id:'' }}">
                              <td style="width:5%;"> 
                                <a data-remove="{{url('removesimplesWishList/'.$p->simple_product->id)}}" title="Remove it from your Wishlist" class="removeFrmWish">
                                  <i class="fa fa-times" aria-hidden="true"></i> 
                                </a>
                              </td>
                              <td style="width:10%;">
                                <a href="{{ route('show.product',['id' => $p->simple_product->id, 'slug' => $p->simple_product->slug]) }}" title="">
                                  @if($p->simple_product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$p->simple_product->thumbnail))
                                    <img class="img-fluid" title="{{ $p->simple_product->products_name }}" src="{{ url('images/simple_products/'.$p->simple_product->thumbnail) }}" alt="{{ $p->simple_product->thumbnail }}">
                                  @else 
                                    <img class="img-fluid" src="{{url('images/no-image.png')}}" alt="Product Image" />
                                  @endif
                                </a>
                              </td>
                              <td class="brd-rgt p-25 wishlist-title" style="width:35%;"><a href="{{ route('show.product',['id' => $p->simple_product->id, 'slug' => $p->simple_product->slug]) }}" title="{{ $p->simple_product->product_name }}">{{ $p->simple_product->product_name }}</a></td>
                              <td class="brd-rgt p-25" style="width:15%;">
                                @if($p->simple_product->offer_price == '')
                                  <span><i class="{{session()->get('currency')['value']}}"></i> {{round($p->simple_product->price * $conversion_rate,2)}} </span>
                                @else
                                  <span><i class="{{session()->get('currency')['value']}}"></i> {{round($p->simple_product->offer_price * $conversion_rate,2)}}</span>
                                  <span> <s> <i class="{{session()->get('currency')['value']}}"></i> {{round($p->simple_product->price * $conversion_rate,2)}}</s></span>
                                @endif
                              </td>
                              @if($p->simple_product->stock == 0)
                                <td class="brd-rgt p-25 wishlist-out-stock" style="width:15%;">{{ __('Out of stock') }}</td>
                              @else
                                <td class="brd-rgt p-25 wishlist-stock" style="width:15%;">{{ __('In Stock') }}</td>
                              @endif
                              <td class="brd-rgt p-25" style="width:5%;"><a href="{{ route('show.product',['id' => $p->simple_product->id, 'slug' => $p->simple_product->slug]) }}" title="eye"><i data-feather="eye"></i></a></td>
                              <td class="brd-rgt p-25" style="width:5%;">
                                <form method="POST" action="{{ $p->simple_product->type == 'ex_product' ? $p->simple_product->external_product_link : route('add.cart.simple',['pro_id' => $p->simple_product->id, 'price' => $p->simple_product->price, 'offerprice' => $p->simple_product->offer_price]) }}" class="addSimpleCardFrom{{$p->simple_product->id}}">
                                    @csrf

                                    <input name="qty" type="hidden" value="{{ $p->simple_product->min_order_qty }}" max="{{ $p->simple_product->max_order_qty }}" class="qty-section">

                                    <a href="javascript:" onclick="addSimpleProCard({{$p->simple_product->id}})" title="{{__('Add To Cart')}}"><i data-feather="briefcase"></i></a>

                                </form>
                              </td>
                              <!-- <td class="p-25" style="width:5%;"><a href="#" title="share"><i data-feather="share-2"></i></a></td> -->
                            </tr>
                          @endif
                        @endforeach
                    @else 
                      <h3><i class="fa fa-heart-o"></i> {{ __("No Data") }}</h3>
                    @endif
                    </tbody>
                  </table>
                  <div class="text-right">
                  {{ $data->appends(request()->all())->links() }}
                  </div>
                  <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Wishlist End -->

@endsection
<script type="text/javascript" src="{{ url('frontend/assets/js/jquery.min.js') }}"></script> <!-- jquery js-->
<script src="{{ url('js/wish2.js') }}"></script>