@extends("frontend.layout.master")
@section('title','BoiBari | Cart')
@section("content")
<div style="background-color: #fff8f5">

    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container bg-white">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Cart')}}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{ __('Cart') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home End -->

    @php
        //                $pro = Session('pro_qty');

                        $value = Session::get('cart');

                        if (Auth::check())
                        {
                          $count = $cart_table->count();
                        }
                        else {
                          if (isset($value))
                              {
                                $count = count($value);
                              }
                          else
                              {
                                $count = 0;
                              }
                        }

                        if(Auth::check()){
                          $usercart = $count;
                        }else{
                          $usercart = session()->get('cart');
                        }
    @endphp

            <!-- Cart Start -->
    <section id="cart" class="cart-main-block">
        <div class="container bg-white">
            <div class="row">
                <div class="col-lg-8 col-md-7 pc">

                    @if($count > 0 && $count != null)
                        @if(Session::has('validcurrency'))
                            <div class="cart-alert">
                                <i class="fa fa-info-circle"></i> <b>{{ __('Oscur') }} <u>{{ Session::get('currency')['id'] }}</u>{{ __('CerrorMsg') }} !</b>
                            </div>
                        @endif

                        @if(Auth::check())
                            @foreach($cart_table as $row)
                                @php
                                    //                            $orivar = $row->variant;
                                @endphp

                                @isset($orivar)
                                    <!-- Varient Product Code Here -->
                                    {{--                            <div class="wishlist-block">--}}
                                    {{--                                <div class="alert alert-dismissible fade show" role="alert">--}}
                                    {{--                                    <table class="table">--}}
                                    {{--                                        <tbody>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td style="width:10%;"></td>--}}
                                    {{--                                                <td class="p-25" style="width:12%;">--}}
                                    {{--                                                    <a href="{{ App\Helpers\ProductUrl::getUrl($row->variant->id) }}" title="{{$row->product->name}}">--}}
                                    {{--                                                    @if($orivar->variantimages['main_image'] != '' && file_exists(public_path().'/variantimages/thumbnails/'.$orivar->variantimages['main_image']))--}}
                                    {{--                                                        <img class="img-fluid" title="{{$row->product->name}}" src="{{url('variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" alt="{{__('Product Image')}}" />--}}
                                    {{--                                                    @else--}}
                                    {{--                                                        <img class="img-fluid" title="{{$row->product->name}}" src="{{url('images/no-image.png')}}" alt="{{__('No Image')}}" />--}}
                                    {{--                                                    @endif--}}
                                    {{--                                                    </a>--}}
                                    {{--                                                </td>  --}}
                                    {{--                                                <td class="brd-rgt p-25 wishlist-title" style="width:35%;">--}}
                                    {{--                                                    <a href="{{ App\Helpers\ProductUrl::getUrl($row->variant->id) }}" title="{{$row->product->name}}">{{ucfirst($row->product->name)}}</a>--}}
                                    {{--                                                    <p><small>( {{ variantname($row->variant) }} )</small></p>--}}
                                    {{--                                                    @foreach($row->variant->main_attr_value as $key=> $orivar)--}}

                                    {{--                                                        @php--}}
                                    {{--                                                            $getattrname = App\ProductAttributes::where('id',$key)->first()->attr_name;--}}
                                    {{--                                                            $getvarvalue = App\ProductValues::where('id',$orivar)->first();--}}
                                    {{--                                                        @endphp--}}

                                    {{--                                                        <span class="product-color"><b>--}}

                                    {{--                                                            @php--}}
                                    {{--                                                            $k = '_';--}}
                                    {{--                                                            @endphp--}}
                                    {{--                                                            @if (strpos($getattrname, $k) == false)--}}

                                    {{--                                                            {{ $getattrname }}:--}}

                                    {{--                                                            @else--}}

                                    {{--                                                            {{str_replace('_', ' ', $getattrname)}}:--}}

                                    {{--                                                            @endif--}}

                                    {{--                                                            </b>--}}

                                    {{--                                                        </span>--}}

                                    {{--                                                        @if(isset($getvarvalue) && strcasecmp($getvarvalue->unit_value, $getvarvalue->values) != 0 && $getvarvalue->unit_value != null)--}}
                                    {{--                                                            @if($getvarvalue->proattr->attr_name == "Color" || $getvarvalue->proattr->attr_name == "Colour" || $getvarvalue->proattr->attr_name == "color" || $getvarvalue->proattr->attr_name == "colour")--}}

                                    {{--                                                                <div class="display-inline">--}}
                                    {{--                                                                    <div class="color-options">--}}
                                    {{--                                                                        <ul>--}}
                                    {{--                                                                            <li title="{{ $getvarvalue->values }}" class="color varcolor active"><a href="javascript:" title=""><i style="color: {{ $getvarvalue->unit_value }}" class="fa fa-circle"></i></a>--}}
                                    {{--                                                                                <div class="overlay-image overlay-deactive"></div>--}}
                                    {{--                                                                            </li>--}}
                                    {{--                                                                        </ul>--}}
                                    {{--                                                                    </div>--}}
                                    {{--                                                                </div>--}}

                                    {{--                                                            @else--}}
                                    {{--                                                                <span>{{ $getvarvalue->values }} {{ $getvarvalue->unit_value ?? '' }}</span>--}}
                                    {{--                                                            @endif--}}
                                    {{--                                                        @else--}}
                                    {{--                                                            <span>{{ $getvarvalue->values }} </span>--}}
                                    {{--                                                        @endif--}}
                                    {{--                                                    @endforeach--}}
                                    {{--                                                    @if(isset($row->product->cashback_settings) && $row->product->cashback_settings->enable == 1)--}}
                                    {{--                                                        <p>{{ __("Congrats ! You can earn cashback in your wallet") }} {{ $row->product->cashback_settings->discount_type }}  @if($row->product->cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ price_format($row->product->cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $row->product->cashback_settings->discount.'%' }}</b> @endif </p>--}}
                                    {{--                                                    @endif--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td class="brd-rgt p-15" style="width:20%;">--}}
                                    {{--                                                    <?php--}}
                                    {{--                                                        $id = $row->variant_id; --}}

                                    {{--                                                        if($row->variant->max_order_qty == null || $row->variant->max_order_qty == 0 || $row->variant->max_order_qty == '')--}}
                                    {{--                                                        {--}}
                                    {{--                                                            $product_stock = $row->variant->stock;--}}
                                    {{--                                                        }else{--}}
                                    {{--                                                            $product_stock = $row->variant->max_order_qty;--}}
                                    {{--                                                        }--}}
                                    {{--                                                    ?>--}}
                                    {{--                                                    <div class="quantity">--}}
                                    {{--                                                        <input type="number" id="rent-day" data-id="{{$row->id}}" data-type="sp"--}}
                                    {{--                                                                data-pr="{{$product_stock}}" name="quantity" value="{{$row->qty}}" price="{{$row->price_total}}"--}}
                                    {{--                                                                variant="{{ $id }}" offerprice="{{$row->semi_total}}" max="{{$product_stock}}"--}}
                                    {{--                                                                min="{{$row->variant->min_order_qty}}">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td class="brd-rgt p-25" style="width:28%;">--}}
                                    {{--                                                @if($row->semi_total == 0)--}}
                                    {{--                                                    <i class="price {{session()->get('currency')['value']}}"></i>--}}
                                    {{--                                                    <span class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="{{$row->id}}">--}}
                                    {{--                                                    {{price_format($row->price_total*$conversion_rate,2)}}--}}
                                    {{--                                                    </span>--}}
                                    {{--                                                @else--}}
                                    {{--                                                    <i class="price {{session()->get('currency')['value']}}"></i>--}}
                                    {{--                                                    <span class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="{{$row->id}}">--}}
                                    {{--                                                        {{price_format($row->semi_total*$conversion_rate,2)}} --}}
                                    {{--                                                    </span>--}}

                                    {{--                                                    <i class="price-strike {{session()->get('currency')['value']}}"></i>--}}
                                    {{--                                                    <s class="price-strike" id="strike{{$row->id}}">{{sprintf("%.2f",$row->price_total*$conversion_rate,2)}}</s>--}}
                                    {{--                                                @endif--}}
                                    {{--                                                </td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                        </tbody>--}}
                                    {{--                                    </table>--}}
                                    {{--                                    <a href="{{url('remove_table_cart/'.$row->variant_id)}}" title="{{__('Remove from cart')}}" class="icon">--}}
                                    {{--                                        <button title="close_button" type="button" class="btn-close"></button>--}}
                                    {{--                                    </a>--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                @endisset

                                @if($row->simple_product)
                                    <!-- Simple Product Code Here -->
                                    <div class="wishlist-block">
                                        <div class="alert alert-dismissible fade show" role="alert">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td style="width:10%;"></td>
                                                    <td style="width:12%;">
                                                        <a href="{{ route('show.product',['id' => $row->simple_product->id, 'slug' =>   $row->simple_product->slug]) }}" title="">
                                                            @if($row->simple_product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$row->simple_product->thumbnail))
                                                                <img src="{{url('images/simple_products/'.$row->simple_product->thumbnail)}}" class="img-fluid" alt="{{__('Product Image')}}">
                                                            @else
                                                                <img class="img-fluid" title="{{ $row->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td class="brd-rgt p-25 wishlist-title" style="width:35%;">
                                                        <a href="{{ route('show.product',['id' => $row->simple_product->id, 'slug' =>   $row->simple_product->slug]) }}" title="{{ $row->simple_product->product_name }}">{{ ucfirst($row->simple_product->product_name) }}</a>

                                                        @if(isset($row->simple_product->cashback_settings) && $row->simple_product->cashback_settings->enable == 1)
                                                            <p>
                                                                {{ __("Congrats ! You can earn cashback in your wallet") }} {{ $row->simple_product->cashback_settings->discount_type }}  @if($row->simple_product->cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ price_format( $row->simple_product->cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $row->simple_product->cashback_settings->discount.'%' }}</b> @endif
                                                            </p>
                                                        @endif
                                                    </td>
                                                        <?php

                                                        if($row->simple_product->max_order_qty == null || $row->simple_product->max_order_qty == 0 || $row->simple_product->max_order_qty == '')
                                                        {
                                                            $product_stock = $row->simple_product->stock;

                                                        }else{
                                                            $product_stock = $row->simple_product->max_order_qty;
                                                        }

                                                        ?>
                                                    <td class="brd-rgt p-15" style="width:20%;">
                                                        <div class="quantity">
                                                            <input type="number" id="rent-day" data-id="{{$row->id}}" data-type="sp"
                                                                   data-pr="{{$product_stock}}" name="quantity" value="{{$row->qty}}" price="{{$row->price_total}}"
                                                                   variant="{{ $row->id }}" offerprice="{{$row->semi_total}}" max="{{$product_stock}}"
                                                                   min="{{$row->simple_product->min_order_qty}}">
                                                        </div>
                                                    </td>
                                                    <td class="brd-rgt p-25" style="width:28%;">
                                                        @if($row->semi_total == 0)
                                                            <i class="price {{session()->get('currency')['value']}}"></i><span class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="{{$row->id}}">
                                                        {{price_format($row->price_total*$conversion_rate)}}
                                                        </span>
                                                        @else
                                                            <i class="price {{session()->get('currency')['value']}}"></i><span
                                                                    class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="{{$row->id}}">
                                                        {{price_format($row->semi_total*$conversion_rate)}}
                                                        </span>

                                                            <i class="price-strike {{session()->get('currency')['value']}}"></i>
                                                            {{--                                                    <del id="strike{{$row->id}}"><s>{{price_format($row->price_total*$conversion_rate)}}</s></del>--}}
                                                            <del class="price-strike"
                                                                 id="strike{{$row->id}}"><s>{{price_format($row->price_total*$conversion_rate)}}</s></del>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <a href="{{ route("rm.simple.cart",$row->id) }}" title="{{__('Remove from cart')}}">
                                                <button title="close_button" type="button" class="btn-close"></button>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @if(!empty($value))
                                @foreach($value as $row)
                                    @php
                                        $id = $row['id'];
                                        $qty = $row['quantity'];
                                        $product =\App\SimpleProduct::find($id);
                                    @endphp

                                    @isset($product)
                                        <!-- Simple Product Code Here -->
                                        <div class="wishlist-block">
                                            <div class="alert alert-dismissible fade show" role="alert">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width:10%;"></td>
                                                        <td style="width:12%;">
                                                            <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="">
                                                                @if($product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$product->thumbnail))
                                                                    <img src="{{url('images/simple_products/'.$product->thumbnail)}}" class="img-fluid" alt="{{__('Product Image')}}">
                                                                @else
                                                                    <img class="img-fluid" title="{{ $product->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td class="brd-rgt p-25 wishlist-title" style="width:35%;">
                                                            <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="{{ $product->product_name }}">{{ ucfirst($product->product_name) }}</a>

                                                            @if(isset($product->cashback_settings) && $product->cashback_settings->enable == 1)
                                                                <p>
                                                                    {{ __("Congrats ! You can earn cashback in your wallet") }} {{ $product->cashback_settings->discount_type }}  @if($product->cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ price_format( $product->cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $product->cashback_settings->discount.'%' }}</b> @endif
                                                                </p>
                                                            @endif
                                                        </td>
                                                            <?php

                                                            if($product->max_order_qty == null || $product->max_order_qty == 0 || $product->max_order_qty == '')
                                                            {
                                                                $product_stock = $product->stock;

                                                            }else{
                                                                $product_stock = $product->max_order_qty;
                                                            }

                                                            ?>
                                                        <td class="brd-rgt p-15" style="width:20%;">
                                                            <div class="quantity">
                                                                <input type="number"  id="rent-day{{ $row['id'] }}" onchange="qtych('{{ $row['id'] }}')" data-id="{{$id}}" data-type="sp"
                                                                       data-pr="{{$product_stock}}" name="quantity" value="{{ $qty }}" price="{{$qty * $product->price}}"
                                                                       variant="{{ $id }}" offerprice="{{$qty * $product->offer_price}}" variant="{{ $product->id }} max="{{$product_stock}}"
                                                                min="{{$product->min_order_qty}}">
                                                            </div>
                                                        </td>
                                                        <td class="brd-rgt p-25" style="width:28%;">
                                                            @if($product->offer_price == 0)
                                                                <i  class="price {{session()->get('currency')['value']}}"></i>
                                                                <span class="price cart-grand-total-price cart-sub-total-price sub_total" id="nofferss{{$product->id}}">
                                                {{price_format($qty * $product->price)}}
                                                </span>
                                                            @else
                                                                <i class="price {{session()->get('currency')['value']}}"></i>
                                                                <span
                                                                        class="price cart-grand-total-price cart-sub-total-price sub_total_{{$id}}" id="offer_p{{$product->id}}">
                                                    {{price_format($qty * $product->offer_price)}}
                                                </span>

                                                                {{--                                                <i class="price-strike {{session()->get('currency')['value']}}"></i><span class="price-strike"--}}
                                                                {{--                                                                                                                          id="strike{{$id}}"><s>{{price_format($row->price_total*$conversion_rate)}}</s></span>--}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="{{ route("rm.simple.cart",$product->id) }}" title="{{__('Remove from cart')}}">
                                                    <button title="close_button" type="button" class="btn-close"></button>
                                                </a>
                                            </div>
                                        </div>
                                    @endisset

                                @endforeach
                                {{--                    @foreach($cts = Session::get('cart') as $ckey=> $row)--}}
                                {{--                    @foreach($value as $ckey=> $row)--}}
                                {{--                      <form action="#" method="post">--}}
                                {{--                        {{ csrf_field() }}--}}
                                {{--                        @php--}}

                                {{--                        $pro = App\SimpleProduct::withTrashed()->where('id',$row['pro_id'])->first();--}}
                                {{--//                        $orivar = App\AddSubVariant::withTrashed()->where('id','=',$row['variantid'])->first();--}}

                                {{--                        @endphp--}}
                                {{--                        <div class="wishlist-block">--}}
                                {{--                          <div class="alert alert-dismissible fade show" role="alert">--}}
                                {{--                              <table class="table">--}}
                                {{--                                  <tbody>--}}
                                {{--                                      <tr>--}}
                                {{--                                          <td style="width:10%;"></td>--}}
                                {{--                                          <td style="width:12%;"><a href="{{ App\Helpers\ProductUrl::getUrl($orivar->id) }}" title="{{$pro->name}}"><img src="{{url('/variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" class="img-fluid" alt="{{$pro->name}} Image" title="{{$pro->name}}"></a></td>--}}
                                {{--                                          <td class="brd-rgt p-25 wishlist-title" style="width:35%;">--}}
                                {{--                                            <a href="{{ App\Helpers\ProductUrl::getUrl($orivar->id) }}" title="{{$pro->name}}">{{$pro->name}}</a>--}}

                                {{--                                            @php--}}
                                {{--                                            $varinfo = App\AddSubVariant::withTrashed()->where('id','=',$row['variantid'])->first();--}}
                                {{--                                            @endphp--}}
                                {{--                                            <p>--}}
                                {{--                                              <small>--}}
                                {{--                                                @foreach($varinfo->main_attr_value as $key=> $orivar)--}}

                                {{--                                                @php--}}
                                {{--                                                $getattrname = App\ProductAttributes::where('id',$key)->first()->attr_name;--}}
                                {{--                                                $getvarvalue = App\ProductValues::where('id',$orivar)->first();--}}
                                {{--                                                @endphp--}}
                                {{--                                                <span class="product-color"><b>--}}
                                {{--                                                    @php--}}
                                {{--                                                    $k = '_';--}}
                                {{--                                                    @endphp--}}
                                {{--                                                    @if (strpos($getattrname, $k) == false)--}}

                                {{--                                                    {{ $getattrname }}--}}

                                {{--                                                    @else--}}

                                {{--                                                    {{str_replace('_', ' ', $getattrname)}}--}}

                                {{--                                                    @endif--}}
                                {{--                                                  </b>:--}}

                                {{--                                                  @if(isset($getvarvalue) && strcasecmp($getvarvalue->unit_value, $getvarvalue->values) != 0 && $getvarvalue->unit_value--}}
                                {{--                                                  != null)--}}
                                {{--                                                  @if($getvarvalue->proattr->attr_name == "Color" || $getvarvalue->proattr->attr_name == "Colour"--}}
                                {{--                                                  || $getvarvalue->proattr->attr_name == "color" || $getvarvalue->proattr->attr_name == "colour")--}}
                                {{--                                                  <div class="display-inline">--}}
                                {{--                                                    <div class="color-options">--}}
                                {{--                                                      <ul>--}}
                                {{--                                                        <li title="{{ $getvarvalue->values }}" class="color varcolor active">--}}
                                {{--                                                          <i style="color: {{ $getvarvalue->unit_value }}" class="fa fa-circle"></i>--}}
                                {{--                                                          <div class="overlay-image overlay-deactive"> </div>--}}
                                {{--                                                        </li>--}}
                                {{--                                                      </ul>--}}
                                {{--                                                    </div>--}}
                                {{--                                                  </div>--}}
                                {{--                                                  @else--}}
                                {{--                                                  <span>{{ $getvarvalue->values }} {{ $getvarvalue->unit_value ?? '' }}</span>--}}
                                {{--                                                  @endif--}}
                                {{--                                                  <br>--}}
                                {{--                                                  @else--}}
                                {{--                                                  <span>{{ $getvarvalue->values }} </span></span>--}}
                                {{--                                                <br>--}}
                                {{--                                                @endif--}}
                                {{--                                                @endforeach--}}
                                {{--                                              </small>--}}
                                {{--                                            </p>--}}
                                {{--                                            --}}
                                {{--                                          </td>--}}
                                {{--                                          <td class="brd-rgt p-15" style="width:20%;">--}}
                                {{--                                              <?php--}}
                                {{--                                                  --}}
                                {{--                                                $s = App\AddSubVariant::withTrashed()->where('id', '=', $row['variantid'])->first();--}}

                                {{--                                                $limit = 0;--}}

                                {{--                                                if($s->max_order_qty == '' || $s->max_order_qty == null){--}}
                                {{--                                                  $limit = $s->stock;--}}
                                {{--                                                }else{--}}
                                {{--                                                  $limit = $s->max_order_qty;--}}
                                {{--                                                }--}}

                                {{--                                              ?>--}}
                                {{--                                              <div class="quantity">--}}
                                {{--                                                  <input type="number" onchange="qtych('{{ $row['variantid'] }}')"--}}
                                {{--                                                    id="rent-day{{ $row['variantid'] }}" data-id="{{$s->products->id}}" data-type="sp"--}}
                                {{--                                                    data-pr="{{$limit}}" name="quantity" value="{{$row['qty']}}" price="{{$row['varprice']}}"--}}
                                {{--                                                    offerprice="{{$row['varofferprice']}}" variant="{{ $s->id }}" max="{{$limit}}" min="1">--}}
                                {{--                                              </div>--}}
                                {{--                                          </td>--}}
                                {{--                                          <td class="brd-rgt p-25" style="width:28%;">--}}
                                {{--                                            @if($row['varofferprice'] == 0)--}}
                                {{--                                              <div class="price-box cart-product-grand-total cart-product-sub-total">--}}

                                {{--                                                <i class="price {{session()->get('currency')['value']}}"></i> <span class="price cart-grand-total-price cart-sub-total-price" id="nofferss{{ $row['variantid'] }}">{{price_format($row['qty']*$row['varprice']*$conversion_rate)}}</span>--}}

                                {{--                                              </div>--}}
                                {{--                                            @else--}}
                                {{--                                              <div class="price-box cart-product-grand-total cart-product-sub-total">--}}

                                {{--                                                <i class="price {{session()->get('currency')['value']}}"></i> <span id="offer_p{{ $row['variantid'] }}" class="price cart-grand-total-price cart-sub-total-price">{{price_format($row['qty']*$row['varofferprice']*$conversion_rate)}}</span>--}}

                                {{--                                                <del><i class="price-strike {{session()->get('currency')['value']}}"></i> <span id="nofferss{{ $row['variantid'] }}">@if(empty($row['varofferprice'])) @else {{ price_format($row['qty']*$row['varprice']*$conversion_rate) }} @endif</span></del>--}}
                                {{--                                              </div>--}}
                                {{--                                            @endif--}}
                                {{--                                          </td>--}}
                                {{--                                      </tr>--}}
                                {{--                                  </tbody>--}}
                                {{--                              </table>--}}
                                {{--                              <a href="{{url('remove_cart/'.$row['variantid'])}}">--}}
                                {{--                              <button type="button" class="btn-close" title="Remove this item from cart?"></button>--}}
                                {{--                              </a>--}}
                                {{--                          </div>--}}
                                {{--                        </div>--}}
                                {{--                      </form>--}}
                                {{--                    @endforeach--}}
                            @endif
                        @endif

                    @else
                        <div class="wishlist-block text-center">
                            <h5>{{__('Your Shopping Cart is Empty')}}</h5>
                        </div>
                    @endif
                </div>

                <div class="col-lg-8 col-md-7 mobile">

                    @if($count > 0 && $count != null)
                        @if(Session::has('validcurrency'))
                            <div class="cart-alert">
                                <i class="fa fa-info-circle"></i> <b>{{ __('Oscur') }} <u>{{ Session::get('currency')['id'] }}</u>{{ __('CerrorMsg') }} !</b>
                            </div>
                        @endif

                        @if(Auth::check())
                            @foreach($cart_table as $row)
                                @if($row->simple_product)
                                    <!-- Simple Product Code Here -->
                                    <div class="wishlist-block">
                                        <div class="alert alert-dismissible fade show" role="alert">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td style="width:20%;">
                                                        <a href="{{ route("rm.simple.cart",$row->id) }}" title="{{__('Remove from cart')}}">
                                                            <button title="close_button" type="button" class="btn-close"></button>
                                                        </a>
                                                    </td>
                                                    <td style="width:15%;">
                                                        <a href="{{ route('show.product',['id' => $row->simple_product->id, 'slug' =>   $row->simple_product->slug]) }}" title="">
                                                            @if($row->simple_product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$row->simple_product->thumbnail))
                                                                <img src="{{url('images/simple_products/'.$row->simple_product->thumbnail)}}" class="img-fluid" alt="{{__('Product Image')}}">
                                                            @else
                                                                <img class="img-fluid" title="{{ $row->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td class="brd-rgt p-25 wishlist-title" style="width:30%;">
                                                        <a href="{{ route('show.product',['id' => $row->simple_product->id, 'slug' =>   $row->simple_product->slug]) }}" title="{{ $row->simple_product->product_name }}">{{ ucfirst($row->simple_product->product_name) }}</a>

                                                        @if(isset($row->simple_product->cashback_settings) && $row->simple_product->cashback_settings->enable == 1)
                                                            <p>
                                                                {{ __("Congrats ! You can earn cashback in your wallet") }} {{ $row->simple_product->cashback_settings->discount_type }}  @if($row->simple_product->cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ price_format( $row->simple_product->cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $row->simple_product->cashback_settings->discount.'%' }}</b> @endif
                                                            </p>
                                                        @endif
                                                    </td>
                                                        <?php

                                                        if($row->simple_product->max_order_qty == null || $row->simple_product->max_order_qty == 0 || $row->simple_product->max_order_qty == '')
                                                        {
                                                            $product_stock = $row->simple_product->stock;

                                                        }else{
                                                            $product_stock = $row->simple_product->max_order_qty;
                                                        }

                                                        ?>
                                                    <td class="brd-rgt p-15" style="width:10%;">
                                                        <div class="quantity" id="mobile_input">
                                                            <input type="number" id="rent-day" data-id="{{$row->id}}" data-type="sp"
                                                                   data-pr="{{$product_stock}}" name="quantity" value="{{$row->qty}}" price="{{$row->price_total}}"
                                                                   variant="{{ $row->id }}" offerprice="{{$row->semi_total}}" max="{{$product_stock}}"
                                                                   min="{{$row->simple_product->min_order_qty}}">
                                                        </div>
                                                    </td>
                                                    <td class="brd-rgt p-25" style="width:28%;">
                                                        @if($row->semi_total == 0)
                                                            <i class="price {{session()->get('currency')['value']}}"></i>
                                                            <span class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="mobile{{$row->id}}">
                                                        {{price_format($row->price_total*$conversion_rate)}}
                                                        </span>
                                                        @else
                                                            <i class="price {{session()->get('currency')['value']}}"></i><span
                                                                    class="price cart-grand-total-price cart-sub-total-price sub_total_{{$row->id}}" id="mobile{{$row->id}}">
                                                        {{price_format($row->semi_total*$conversion_rate)}}
                                                        </span>

                                                            <i class="price-strike {{session()->get('currency')['value']}}"></i><del class="price-strike"
                                                                                                                                     id="strike{{$row->id}}"><s>{{price_format($row->price_total*$conversion_rate)}}</s></del>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            {{--                                        <a href="{{ route("rm.simple.cart",$row->id) }}" title="{{__('Remove from cart')}}">--}}
                                            {{--                                            <button title="close_button" type="button" class="btn-close"></button>--}}
                                            {{--                                        </a>--}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @if(!empty($value))
                                @foreach($value as $row)
                                    @php
                                        $id = $row['id'];
                                        $qty = $row['quantity'];
                                        $product =\App\SimpleProduct::find($id);
                                    @endphp

                                    @isset($product)
                                        <!-- Simple Product Code Here -->
                                        <div class="wishlist-block">
                                            <div class="alert alert-dismissible fade show" role="alert">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            <a href="{{ route("rm.simple.cart",$product->id) }}" title="{{__('Remove from cart')}}">
                                                                <button title="close_button" type="button" class="btn-close"></button>
                                                            </a>
                                                        </td>
                                                        <td style="width:15%;">
                                                            <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="">
                                                                @if($product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$product->thumbnail))
                                                                    <img src="{{url('images/simple_products/'.$product->thumbnail)}}" class="img-fluid" alt="{{__('Product Image')}}">
                                                                @else
                                                                    <img class="img-fluid" title="{{ $product->product_name }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td class="brd-rgt p-25 wishlist-title" style="width:30%;">
                                                            <a href="{{ route('show.product',['id' => $product->id, 'slug' => $product->slug]) }}" title="{{ $product->product_name }}">{{ ucfirst($product->product_name) }}</a>

                                                            @if(isset($product->cashback_settings) && $product->cashback_settings->enable == 1)
                                                                <p>
                                                                    {{ __("Congrats ! You can earn cashback in your wallet") }} {{ $product->cashback_settings->discount_type }}  @if($product->cashback_settings->cashback_type == 'fix') <i class="{{ session()->get('currency')['value'] }}"></i><b>{{ price_format( $product->cashback_settings->discount * $conversion_rate) }}</b> @else <b>{{ $product->cashback_settings->discount.'%' }}</b> @endif
                                                                </p>
                                                            @endif
                                                        </td>
                                                            <?php

                                                            if($product->max_order_qty == null || $product->max_order_qty == 0 || $product->max_order_qty == '')
                                                            {
                                                                $product_stock = $product->stock;

                                                            }else{
                                                                $product_stock = $product->max_order_qty;
                                                            }

                                                            ?>
                                                        <td class="brd-rgt p-15" style="width:10%;">
                                                            <div class="quantity">
                                                                <input type="number"  id="mobilerent-day{{ $row['id'] }}" onchange="moqtych('{{ $row['id'] }}')" data-id="{{$id}}" data-type="sp"
                                                                       data-pr="{{$product_stock}}" name="quantity" value="{{ $qty }}" price="{{$qty * $product->price}}"
                                                                       variant="{{ $product->id }}" offerprice="{{$qty * $product->offer_price}}" variant="{{ $product->id }} max="{{$product_stock}}"
                                                                min="{{$product->min_order_qty}}">
                                                            </div>
                                                        </td>
                                                        <td class="brd-rgt p-25" style="width:28%;">
                                                            @if($product->offer_price == 0)
                                                                <i  class="price {{session()->get('currency')['value']}}"></i>
                                                                <span class="price cart-grand-total-price cart-sub-total-price sub_total" id="mobilenofferss{{$product->id}}">
                                                {{price_format($qty * $product->price)}}
                                                </span>
                                                            @else
                                                                <i class="price {{session()->get('currency')['value']}}"></i>
                                                                <span
                                                                        class="price cart-grand-total-price cart-sub-total-price sub_total_{{$id}}" id="mobileoffer_p{{$product->id}}">
                                                    {{price_format($qty * $product->offer_price)}}
                                                </span>

                                                                {{--                                                <i class="price-strike {{session()->get('currency')['value']}}"></i><span class="price-strike"--}}
                                                                {{--                                                                                                                          id="strike{{$id}}"><s>{{price_format($row->price_total*$conversion_rate)}}</s></span>--}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    @endisset

                                @endforeach
                                {{--                    @foreach($cts = Session::get('cart') as $ckey=> $row)--}}
                                {{--                    @foreach($value as $ckey=> $row)--}}
                                {{--                      <form action="#" method="post">--}}
                                {{--                        {{ csrf_field() }}--}}
                                {{--                        @php--}}

                                {{--                        $pro = App\SimpleProduct::withTrashed()->where('id',$row['pro_id'])->first();--}}
                                {{--//                        $orivar = App\AddSubVariant::withTrashed()->where('id','=',$row['variantid'])->first();--}}

                                {{--                        @endphp--}}
                                {{--                        <div class="wishlist-block">--}}
                                {{--                          <div class="alert alert-dismissible fade show" role="alert">--}}
                                {{--                              <table class="table">--}}
                                {{--                                  <tbody>--}}
                                {{--                                      <tr>--}}
                                {{--                                          <td style="width:10%;"></td>--}}
                                {{--                                          <td style="width:12%;"><a href="{{ App\Helpers\ProductUrl::getUrl($orivar->id) }}" title="{{$pro->name}}"><img src="{{url('/variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" class="img-fluid" alt="{{$pro->name}} Image" title="{{$pro->name}}"></a></td>--}}
                                {{--                                          <td class="brd-rgt p-25 wishlist-title" style="width:35%;">--}}
                                {{--                                            <a href="{{ App\Helpers\ProductUrl::getUrl($orivar->id) }}" title="{{$pro->name}}">{{$pro->name}}</a>--}}

                                {{--                                            @php--}}
                                {{--                                            $varinfo = App\AddSubVariant::withTrashed()->where('id','=',$row['variantid'])->first();--}}
                                {{--                                            @endphp--}}
                                {{--                                            <p>--}}
                                {{--                                              <small>--}}
                                {{--                                                @foreach($varinfo->main_attr_value as $key=> $orivar)--}}

                                {{--                                                @php--}}
                                {{--                                                $getattrname = App\ProductAttributes::where('id',$key)->first()->attr_name;--}}
                                {{--                                                $getvarvalue = App\ProductValues::where('id',$orivar)->first();--}}
                                {{--                                                @endphp--}}
                                {{--                                                <span class="product-color"><b>--}}
                                {{--                                                    @php--}}
                                {{--                                                    $k = '_';--}}
                                {{--                                                    @endphp--}}
                                {{--                                                    @if (strpos($getattrname, $k) == false)--}}

                                {{--                                                    {{ $getattrname }}--}}

                                {{--                                                    @else--}}

                                {{--                                                    {{str_replace('_', ' ', $getattrname)}}--}}

                                {{--                                                    @endif--}}
                                {{--                                                  </b>:--}}

                                {{--                                                  @if(isset($getvarvalue) && strcasecmp($getvarvalue->unit_value, $getvarvalue->values) != 0 && $getvarvalue->unit_value--}}
                                {{--                                                  != null)--}}
                                {{--                                                  @if($getvarvalue->proattr->attr_name == "Color" || $getvarvalue->proattr->attr_name == "Colour"--}}
                                {{--                                                  || $getvarvalue->proattr->attr_name == "color" || $getvarvalue->proattr->attr_name == "colour")--}}
                                {{--                                                  <div class="display-inline">--}}
                                {{--                                                    <div class="color-options">--}}
                                {{--                                                      <ul>--}}
                                {{--                                                        <li title="{{ $getvarvalue->values }}" class="color varcolor active">--}}
                                {{--                                                          <i style="color: {{ $getvarvalue->unit_value }}" class="fa fa-circle"></i>--}}
                                {{--                                                          <div class="overlay-image overlay-deactive"> </div>--}}
                                {{--                                                        </li>--}}
                                {{--                                                      </ul>--}}
                                {{--                                                    </div>--}}
                                {{--                                                  </div>--}}
                                {{--                                                  @else--}}
                                {{--                                                  <span>{{ $getvarvalue->values }} {{ $getvarvalue->unit_value ?? '' }}</span>--}}
                                {{--                                                  @endif--}}
                                {{--                                                  <br>--}}
                                {{--                                                  @else--}}
                                {{--                                                  <span>{{ $getvarvalue->values }} </span></span>--}}
                                {{--                                                <br>--}}
                                {{--                                                @endif--}}
                                {{--                                                @endforeach--}}
                                {{--                                              </small>--}}
                                {{--                                            </p>--}}
                                {{--                                            --}}
                                {{--                                          </td>--}}
                                {{--                                          <td class="brd-rgt p-15" style="width:20%;">--}}
                                {{--                                              <?php--}}
                                {{--                                                  --}}
                                {{--                                                $s = App\AddSubVariant::withTrashed()->where('id', '=', $row['variantid'])->first();--}}

                                {{--                                                $limit = 0;--}}

                                {{--                                                if($s->max_order_qty == '' || $s->max_order_qty == null){--}}
                                {{--                                                  $limit = $s->stock;--}}
                                {{--                                                }else{--}}
                                {{--                                                  $limit = $s->max_order_qty;--}}
                                {{--                                                }--}}

                                {{--                                              ?>--}}
                                {{--                                              <div class="quantity">--}}
                                {{--                                                  <input type="number" onchange="qtych('{{ $row['variantid'] }}')"--}}
                                {{--                                                    id="rent-day{{ $row['variantid'] }}" data-id="{{$s->products->id}}" data-type="sp"--}}
                                {{--                                                    data-pr="{{$limit}}" name="quantity" value="{{$row['qty']}}" price="{{$row['varprice']}}"--}}
                                {{--                                                    offerprice="{{$row['varofferprice']}}" variant="{{ $s->id }}" max="{{$limit}}" min="1">--}}
                                {{--                                              </div>--}}
                                {{--                                          </td>--}}
                                {{--                                          <td class="brd-rgt p-25" style="width:28%;">--}}
                                {{--                                            @if($row['varofferprice'] == 0)--}}
                                {{--                                              <div class="price-box cart-product-grand-total cart-product-sub-total">--}}

                                {{--                                                <i class="price {{session()->get('currency')['value']}}"></i> <span class="price cart-grand-total-price cart-sub-total-price" id="nofferss{{ $row['variantid'] }}">{{price_format($row['qty']*$row['varprice']*$conversion_rate)}}</span>--}}

                                {{--                                              </div>--}}
                                {{--                                            @else--}}
                                {{--                                              <div class="price-box cart-product-grand-total cart-product-sub-total">--}}

                                {{--                                                <i class="price {{session()->get('currency')['value']}}"></i> <span id="offer_p{{ $row['variantid'] }}" class="price cart-grand-total-price cart-sub-total-price">{{price_format($row['qty']*$row['varofferprice']*$conversion_rate)}}</span>--}}

                                {{--                                                <del><i class="price-strike {{session()->get('currency')['value']}}"></i> <span id="nofferss{{ $row['variantid'] }}">@if(empty($row['varofferprice'])) @else {{ price_format($row['qty']*$row['varprice']*$conversion_rate) }} @endif</span></del>--}}
                                {{--                                              </div>--}}
                                {{--                                            @endif--}}
                                {{--                                          </td>--}}
                                {{--                                      </tr>--}}
                                {{--                                  </tbody>--}}
                                {{--                              </table>--}}
                                {{--                              <a href="{{url('remove_cart/'.$row['variantid'])}}">--}}
                                {{--                              <button type="button" class="btn-close" title="Remove this item from cart?"></button>--}}
                                {{--                              </a>--}}
                                {{--                          </div>--}}
                                {{--                        </div>--}}
                                {{--                      </form>--}}
                                {{--                    @endforeach--}}
                            @endif
                        @endif

                    @else
                        <div class="wishlist-block text-center">
                            <h5>{{__('Your Shopping Cart is Empty')}}</h5>
                        </div>
                    @endif
                </div>


                <div class="col-lg-4 col-md-5">

                    <div class="cart-block">
                        <h4 class="section-title">{{__('Detail')}} ({{$count}} {{__('items')}})</h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 60%;">Total pricess</td>
                                <td>
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    <span id="show-total">
                        @php
                            $total = 0;
                            $oot = array();
//                            $stotal=Session::get('total');
                        @endphp
                                        @guest
                                            @if(!empty(Session::get('cart')))


                                                @foreach($cts = Session::get('cart') as $key => $c)
                                                    @php
                                                        //                                $total=0;
                                                                                            $row= App\SimpleProduct::where('id',$c['id'])->first();

                                                                                            if ($row->offer_price == 0 || $row->offer_price == null){
                                                                                                $stotal = $c['quantity'] * $row->price;

                                                                                            }else{
                                                                                                 $stotal = $c['quantity'] * $row->offer_price;
                                                                                            }

                                                                                            $total=$total+$stotal;

                                                    @endphp

                                                    @php

                                                            @endphp
                                                @endforeach

                                                {{ sprintf("%.2f",$total*$conversion_rate) }}

                                            @endif
                                        @else

                                            @php
                                                $cart_table = App\Cart::where('user_id',auth()->id())->where('active_cart',1)->get();
                                            @endphp

                                            @if(count($cart_table))

                                                @foreach($cart_table as $c)
                                                    @if($c->simple_product)
                                                        @if($c->semi_total != 0)
                                                            @php $price = $c->semi_total - $c->tax_amount; @endphp
                                                        @else
                                                            @php $price = $c->price_total - $c->tax_amount; @endphp
                                                        @endif
                                                    @endif

                                                    {{--                                    @if($c->semi_total == '' || $c->semi_total == null)--}}
                                                    {{--                                        @php $price = $c->price_total; @endphp--}}
                                                    {{--                                    @else--}}
                                                    {{--                                        @php $price = $c->semi_total; @endphp--}}
                                                    {{--                                    @endif--}}

                                                    @php $total= $total+$price; @endphp

                                                @endforeach

                                            @endif
                                            @if(Session::get('gift'))
                                                {{ sprintf("%.2f",$total*$conversion_rate,2)  }}
                                            @endif
                                            {{ price_format(sprintf("%.2f",$total*$conversion_rate))}}
                                        @endif
                        </span>
                                </td>
                            </tr>
                            <?php $shipping = 0; ?>
                            @if(!empty(Session::get('gift')['discount']))
                                <tr>
                                    <td style="width: 60%;">{{ __('Gift Discount') }}</td>
                                    <td class="wishlist-out-stock"><i class="price-strike {{session()->get('currency')['value']}}"></i> {{ Session::get('gift')['discount']}}</td>
                                </tr>
                            @endif
                            @if(App\Cart::isCoupanApplied() == '1')
                                <tr>
                                    <td style="width: 70%;">Coupon</td>
                                    <td class="wishlist-out-stock">
                                        <i class="{{session()->get('currency')['value']}}"></i>
                                        <span class="" id="discountedam">{{  price_format(App\Cart::getDiscount()*$conversion_rate) }}</span>
                                    </td>
                                </tr>
                            @endif
                            @if(Session::has('coupanapplied'))
                                <tr>
                                    <td style="width: 60%;">Coupon</td>
                                    <td class="wishlist-out-stock">
                                        <i class="{{session()->get('currency')['value']}}"></i>
                                        <span class="" id="discountedam"> {{  price_format(session()->get('coupanapplied')['discount'] * $conversion_rate) }}</span>
                                    </td>
                                </tr>
                            @endif
                            <!-- <tr>
                    <td style="width: 70%;">Delivery Charges</td>
                    <td class="wishlist-stock">$ 5</td>
                  </tr> -->
                            </tbody>
                        </table>
                        <table class="table total-amount-table">
                            <tbody>
                            <tr>
                                <td style="width: 60%;">Total Amount</td>
                                <td>
                                    @php

                                        $total = sprintf('%.2f',$total*$conversion_rate);

                                        $shipping = sprintf("%.2f",$shipping * $conversion_rate);

                                        if(App\Cart::isCoupanApplied() == '1'){

                                        $gtotal = ($shipping+$total) - sprintf(App\Cart::getDiscount() * $conversion_rate);

                                        }else{

                                        if(Session::get('gift')){
                                            $gtotal = $shipping + $total - Session::get('gift')['discount'] ;
                                        }else{
                                            $gtotal = $shipping + $total ;
                                        }

                                        }

                                        if(!Auth::check()){

                                        if(Session::has('coupanapplied')){

                                            $gtotal = ($shipping+$total) - (session()->get('coupanapplied')['discount'] * $conversion_rate);

                                        }else{

                                            $gtotal = $shipping + $total;

                                        }

                                        }

                                        Session::put('shippingrate',$shipping);

                                    @endphp
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    <span class="" id="show-total-amoutn"> {{ price_format($gtotal) }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if(Auth::check())
                            <div class="apply-coupon-btn">

                                <form action="{{ route('apply.cpn') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="coupon" placeholder="{{__('Apply Coupon or Vouchers')}}" aria-label="{{__('Apply Coupon or Vouchers')}}" aria-describedby="button-addon2" value="@if(App\Cart::getCoupanDetail()) {{App\Cart::getCoupanDetail()->code}} @elseif(session()->has('coupanapplied')) {{ session()->get('coupanapplied')['code'] }} @endif">
                                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">{{__('Apply')}}</button>
                                    </div>
                                </form>

                                <form action="{{ route('apply.gift') }}" method="POST"  class="giftcardform" >
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="{{ __('Apply Gift Vouchers') }}" aria-label="{{ __('Apply Gift Vouchers') }}" aria-describedby="button-addon1">
                                        <button class="btn btn-outline-primary" type="button" id="button-addon1">{{__('Apply')}}</button>
                                    </div>
                                </form>

                            </div>
                        @endif


                        <div class="checkout-btn">
                            @auth
                                <?php  $c = count($cart_table); ?>
                            @else
                                <?php  $c = count([Session::get('cart')]);?>
                            @endauth

                            <!-- <a href="javascript:" type="button" class="btn btn-primary">{{__('Checkout')}}</a> -->
                            @if(!Session::has('validcurrency'))
                                @if(!empty($oot) && in_array(0, $oot) || $c<1)
                                    <form action="{{url('checkout')}}" method="GET">
                                        {{ csrf_field() }}
                                        <button disabled type="submit" id="proccedtocheckout" title="{{__('Checkout')}}" class="btn btn-primary checkout-btn">{{__('Checkout')}}</button>
                                    </form>
                                @else
                                    @if(!Auth::check())
                                        {{--                        <form action="{{url('checkout')}}" method="GET">--}}
                                        {{--                            {{ csrf_field() }}--}}


                                        {{--                            <button type="button"  class="btn btn-primary ">--}}
                                        <a class="text-info" href="javascript:" role="button" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <button class="btn btn-primary ">
                                                Login / Register
                                            </button>

                                        </a>
                                        {{--                            </button>--}}
                                        {{--                            <button type="button" disabled id="proccedtocheckout" title="{{__('Checkout')}}" class="btn btn-primary checkout-btn">{{__('Login please')}}</button>--}}
                                        {{--                        </form>--}}
                                    @else
                                        @if(count([Session::get('cart')])>0)

                                            <form action="{{url('checkout')}}" method="GET">
                                                {{ csrf_field() }}

                                                <button type="submit" id="proccedtocheckout" title="{{__('Checkout')}}" class="btn btn-primary checkout-btn">{{__('Checkout')}}</button>
                                            </form>
                                        @endif
                                    @endif

                                @endif
                            @else
                                <button type="button" id="proccedtocheckout" disabled="disabled" title="{{__('Checkout')}}" class="btn btn-primary checkout-btn">{{__('Checkout')}}</button>
                            @endif

                            @auth
                                {{-- When user logged in empty cart by table--}}

                                <form action="{{ route('empty.cart') }}" method="POST">
                                    @csrf
                                    <button type="submit" title="{{__('Empty Cart')}}" class="btn btn-primary checkout-btn">{{ __('Empty Cart') }}</button>
                                </form>

                            @else
                                {{-- When user logged in empty cart by session--}}
                                @if(Session::has('cart'))

                                    <form action="{{ route('s.cart',md5(uniqid(rand(), true))) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="{{__('Empty Cart')}}" class="btn btn-primary checkout-btn">{{ __('Empty Cart') }}</button>
                                    </form>

                                @endif

                            @endauth
                        </div>
                    </div>

                </div>

                <div class="col-lg-12">
                    <div class="continue-btn">
                        <a href="{{url('/')}}" type="button" title="{{__('Continue Shopping')}}" class="btn btn-info">{{__('Continue Shopping')}}<i data-feather="arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart End -->
</div>
@endsection

@section('script')

    <script>

        $(function () {

            var conversion_rate = +'{{ $conversion_rate }}';
            $('#mobile_input input').change(function () {
                var p = $(this).attr('price');
                var op = $(this).attr('offerprice');
                var variantId = $(this).attr('variant');
            });
            var urlLike = '{{route('rentdays')}}';
            $("body").on("change keyup", "#rent-day", function (t) {
                t.preventDefault();

                var p = $(this).attr('price');
                var op = $(this).attr('offerprice');
                var variantId = $(this).attr('variant');

                var e = $(this).val();

                var z = $(this).data("id");
                var stock = $(this).data("pr");

                if (e == stock) {
                    swal({
                        title: "Limit reached",
                        text: 'Max Order quantity limit reached !',
                        icon: 'warning'
                    });
                }

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    type: "GET",
                    url: urlLike,
                    data: {
                        days: e,
                        id: z,
                        variant_id: variantId,
                        price: p,
                        offerprice: op

                    },

                    error: function (jqXHR, exception) {

                    }
                }).done(function (t) {
                    var pricetotal = t.pricetotal * conversion_rate;

                    pricetotal = pricetotal.toFixed(2);

                    $('#show-total').text(pricetotal);
                    $('#show-total-amoutn').text(pricetotal);

                    if (t.singletotal == 0) {
                        var singletotal = t.singletotal * conversion_rate;
                        singletotal = singletotal.toFixed(2);
                        $('#' + t.id).text(singletotal);
                        $('#strike' + t.id).text();
                    } else {

                        var singletotal = t.singletotal * conversion_rate;
                        singletotal = singletotal.toFixed(2);
                        var noffertotal = t.noffertotal * conversion_rate;
                        noffertotal = noffertotal.toFixed(2);
                        $('#mobile' + t.id).text(t.singletotal);
                        $('#strike' + t.id).text(noffertotal);
                    }

                    var discount = t.per * conversion_rate
                    discount = discount.toFixed(2);

                    var gtotal = t.gtotal * conversion_rate;
                    gtotal = gtotal.toFixed(2);
                    $('#total_cart').text(gtotal);

                    var shipping = t.shipping * conversion_rate;
                    shipping = shipping.toFixed(2);

                    $('#shipping').text(shipping);

                    $('#discountedam').text(discount);

                    $('#gtotal').text(gtotal);

                    $('#send').val(shipping);

                    $('#subtotal').text(gtotal);

                    $('#qty' + t.id).text(e);


                }).fail(function () {
                    console.log("Error occur !");
                })
            });
        });

        function moqtych(id) {

            var conversion_rate = '{{ $conversion_rate }}';
            var urlLike = '{{route('rentdays')}}';
            var p = $('#mobilerent-day' + id).attr('price');
            var op = $('#mobilerent-day' + id).attr('offerprice');
            var variantId = $('#mobilerent-day' + id).attr('variant');
            var e = $('#mobilerent-day' + id).val();

            var z = $('#mobilerent-day' + id).data("id");
            var stock = $('#mobilerent-day' + id).data("pr");
            if (e == stock) {
                swal({
                    title: "Limit reached",
                    text: 'Max Order quantity limit reached !',
                    icon: 'warning'
                });
            }

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "GET",
                url: urlLike,
                data: {
                    days: e,
                    id: z,
                    variant_id: variantId,
                    price: p,
                    offerprice: op

                },

                error: function (jqXHR, exception) {
                }
            }).done(function (t) {

                var pricetotal = t.pricetotal * conversion_rate;
                pricetotal = pricetotal.toFixed(2);
                $('#show-total').text(pricetotal);
                $('#show-total-amoutn').text(pricetotal);

                if (t.singletotal != 0) {
                    var singletotal = t.singletotal * conversion_rate;
                    singletotal = singletotal.toFixed(2);
                    $('#monofferss' + t.variant_id).text(singletotal);
                } else {
                    var offertotal = t.offertotal * conversion_rate;
                    offertotal = offertotal.toFixed(2);

                    var noffertotal = t.noffertotal * conversion_rate;
                    noffertotal = noffertotal.toFixed(2);

                    $('#mobileoffer_p' + t.variant_id).text(offertotal);
                    $('#nofferss' + t.variant_id).text(noffertotal);
                }

                var total = t.total * conversion_rate;
                total = total.toFixed(2);
                $('#total_cart').text(total);

                var shipping = t.shipping * conversion_rate;
                shipping = shipping.toFixed(2);

                var discount = t.per * conversion_rate
                discount = discount.toFixed(2);

                var gtotal = t.gtotal * conversion_rate;

                gtotal = gtotal.toFixed(2);

                $('#shipping').text(shipping);

                $('#gtotal').text(gtotal);

                $('#discountedam').text(discount);

                $('#send').val(shipping);

                $('#subtotal').text(total);

                $('#sqty' + t.id).text(e);


            }).fail(function () {
                console.log("Error occur !");
            })
        }
    </script>

<script>
  "use strict";

  $(function () {

    var conversion_rate = +'{{ $conversion_rate }}';
    $('.cart-product-quantity input').change(function () {
      var p = $(this).attr('price');
      var op = $(this).attr('offerprice');
      var variantId = $(this).attr('variant');
    });
    var urlLike = '{{route('rentdays')}}';
    $("body").on("change keyup", "#rent-day", function (t) {
      t.preventDefault();

      var p = $(this).attr('price');
      var op = $(this).attr('offerprice');
      var variantId = $(this).attr('variant');

      var e = $(this).val();


      var z = $(this).data("id");
      var stock = $(this).data("pr");

      if (e == stock) {
        swal({
          title: "Limit reached",
          text: 'Max Order quantity limit reached !',
          icon: 'warning'
        });
      }

      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "GET",
        url: urlLike,
        data: {
          days: e,
          id: z,
          variant_id: variantId,
          price: p,
          offerprice: op

        },

        error: function (jqXHR, exception) {

        }
      }).done(function (t) {

        var pricetotal = t.pricetotal * conversion_rate;

        pricetotal = pricetotal.toFixed(2);

        $('#show-total').text(pricetotal);
        $('#show-total-amoutn').text(pricetotal);
        if (t.singletotal == 0) {
          var singletotal = t.singletotal * conversion_rate;
          singletotal = singletotal.toFixed(2);
          $('#' + t.id).text(singletotal);
          $('#strike' + t.id).text();
        } else {
          var singletotal = t.singletotal * conversion_rate;
          singletotal = singletotal.toFixed(2);

          var noffertotal = t.noffertotal * conversion_rate;
          noffertotal = noffertotal.toFixed(2);
          $('#' + t.id).text(singletotal);
          $('#strike' + t.id).text(noffertotal);
        }

        var discount = t.per * conversion_rate
        discount = discount.toFixed(2);

        var gtotal = t.gtotal * conversion_rate;
        gtotal = gtotal.toFixed(2);
        $('#total_cart').text(gtotal);

        var shipping = t.shipping * conversion_rate;
        shipping = shipping.toFixed(2);

        $('#shipping').text(shipping);

        $('#discountedam').text(discount);

        $('#gtotal').text(gtotal);

        $('#send').val(shipping);

        $('#subtotal').text(gtotal);

        $('#qty' + t.id).text(e);


      }).fail(function () {
        console.log("Error occur !");
      })
    });
  });

  function qtych(id) {

    var conversion_rate = '{{ $conversion_rate }}';
    var urlLike = '{{route('rentdays')}}';
    var p = $('#rent-day' + id).attr('price');
    var op = $('#rent-day' + id).attr('offerprice');
    var variantId = $('#rent-day' + id).attr('variant');
    var e = $('#rent-day' + id).val();

    var z = $('#rent-day' + id).data("id");
    var stock = $('#rent-day' + id).data("pr");
    if (e == stock) {
      swal({
        title: "Limit reached",
        text: 'Max Order quantity limit reached !',
        icon: 'warning'
      });
    }

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      type: "GET",
      url: urlLike,
      data: {
        days: e,
        id: z,
        variant_id: variantId,
        price: p,
        offerprice: op

      },

      error: function (jqXHR, exception) {

      }
    }).done(function (t) {

        var pricetotal = t.pricetotal * conversion_rate;
        pricetotal = pricetotal.toFixed(2);
        $('#show-total').text(pricetotal);
        $('#show-total-amoutn').text(pricetotal);

        if (t.singletotal != 0) {
            var singletotal = t.singletotal * conversion_rate;
            singletotal = singletotal.toFixed(2);
            $('#nofferss' + t.variant_id).text(singletotal);
        } else {
            var offertotal = t.offertotal * conversion_rate;
            offertotal = offertotal.toFixed(2);

            var noffertotal = t.noffertotal * conversion_rate;
            noffertotal = noffertotal.toFixed(2);

            $('#offer_p' + t.variant_id).text(t.offertotal);
            $('#nofferss' + t.variant_id).text(noffertotal);
        }

        var total = t.total * conversion_rate;
        total = total.toFixed(2);
        $('#total_cart').text(total);

        var shipping = t.shipping * conversion_rate;
        shipping = shipping.toFixed(2);

        var discount = t.per * conversion_rate
        discount = discount.toFixed(2);

        var gtotal = t.gtotal * conversion_rate;

        gtotal = gtotal.toFixed(2);

        $('#shipping').text(shipping);

        $('#gtotal').text(gtotal);

        $('#discountedam').text(discount);

        $('#send').val(shipping);

        $('#subtotal').text(total);

        $('#sqty' + t.id).text(e);


    }).fail(function () {
      console.log("Error occur !");
    })
  }

  function checkuncheckproduct(id){

    var checkproduct = $('#selectproduct'+id).val();

    if(checkproduct == 1){
      var activecart = 0;
    }
    else{
      var activecart = 1;
    }
    $('#selectproduct'+id).val(activecart);
    var grand_total = $("#gtotal").text();
    var subtotal = $(".sub_total_"+id).text();
    if(activecart == 1){
      var total_amount = parseFloat(grand_total) + parseFloat(subtotal);
    }
    else{
      var total_amount = parseFloat(grand_total) - parseFloat(subtotal);
    }
    if(total_amount<=0){
      $("#gtotal").text(0);
      $("#proccedtocheckout").prop('disabled', true);
    }else{
      $("#proccedtocheckout").prop('disabled', false);
      $("#gtotal").text(total_amount.toFixed(2));
    }

    var updatecart = '{{ url('/UpdateCart') }}';

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: updatecart,
      type: 'POST',
      data : { cartstatus :activecart, cart_id :id },
      success: function (response) {



        if (response == 1) {
          console.log("Success");

        } else {
          console.log("Fail");
        }

      }
    });



  }

  function addtowishlist(id) {

    var wc = $('#wishcount').text();
    wc = Number(wc);
    if (wc == 0) {
      wc = 1;
    } else {
      wc = Number(wc) + 1;
    }

    var addtowishurl = '{{ url('/AddToWishList') }}/'+id; var addtowishurl = '{{ url('/AddToWishList') }}/'+id;

    $.ajax({
      url: addtowishurl,
      type: 'GET',
      success: function (response) {

        $('#wishcount').text(wc);

        if (response == 'success') {
          swal({
            title: "Added",
            text: 'Added to your wishlist !',
            icon: 'success'
          });

          $('#addtowish' + id).parent().html('<a id="removefromwish' + id + '" onclick="removefromwishlist(' + id + ')" class="cursor-pointer icon kal" title="{{ __('Remove From Wishlist ') }}">{{ __('Remove From Wishlist ') }} <i class="fa fa-heart-o"></i></a>');

        } else {
          swal({
            title: "Oops !",
            text: 'Product is already in your wishlist !',
            icon: 'warning'
          });
        }

      }
    });
  }

  function removefromwishlist(id) {

    var removefromwishurl = '{{ url('removeWishList') }}/' + id;

    var wc = $('#wishcount').text();
    wc = Number(wc);
    if (wc == 1) {
      wc = 0;
    } else {
      wc = Number(wc) - 1;
    }

    $.ajax({
      url: removefromwishurl,
      type: 'GET',
      success: function (response) {

        $('#wishcount').text(wc);

        if (response == 'deleted') {
          swal({
            title: "Removed",
            text: 'Removed from your wishlist !',
            icon: 'success'
          });

          $('#removefromwish' + id).parent().html('<a id="addtowish' + id + '" onclick="addtowishlist(' + id +')" class="cursor-pointer icon addtowish" title="{{ __('Add To WishList') }}">{{ __('Add To WishList') }} <i class="fa fa-heart"></i></a>');

        } else {
          swal({
            title: "Oops !",
            text: 'Product is already  removed from your wishlist !',
            icon: 'warning'
          });
        }
      }
    });
  }
  $('.giftCart').on('click',function(){
    $('.giftcardform').toggle();
  })

</script>
@endsection