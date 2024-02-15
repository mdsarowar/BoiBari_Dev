@extends("frontend.layout.master")
@section('title','Emart | Contact us')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Compare')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                    <div class="breadcrumb-nav">
                        <h3 class="breadcrumb-title">{{__('Compare')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

@php
   
	if(Session::has('comparison')){
		$clist = Session::get('comparison');
	foreach ($clist as $k => $row) {

		$findpro = App\Product::find($row);

		if(!isset($findpro)){

			unset($clist[$k]);

		}
	}

	Session::put('comparison',$clist);
	}
@endphp

<!-- Compare Start -->
<section id="compare" class="compare-main-block">
    <div class="container">
        <div class="row">
            @if(!empty(Session::get('comparison')))
                <div class="compare-block table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{__('Product')}}</th>
                                @foreach(Session::get('comparison') as $pro)
                                    @php
                                        $product = App\Product::find($pro['proid']);
                                    @endphp
                                    @if(isset($product) && $product->status == 1)
                                    <th scope="col">
                                    @foreach($product->subvariants as $orivar)
                                        @if($orivar->def == 1)

                                        @if($price_login == 0 || Auth::check())
                                        @php
                                        $convert_price = 0;
                                        $show_price = 0;
                                        
                                        $commision_setting = App\CommissionSetting::first();

                                        if($commision_setting->type == "flat"){

                                            $commission_amount = $commision_setting->rate;
                                            if($commision_setting->p_type == 'f'){
                                            
                                            $totalprice = $orivar->products->vender_price+$orivar->price+$commission_amount;
                                            $totalsaleprice = $orivar->products->vender_offer_price + $orivar->price + $commission_amount;

                                            if($orivar->products->vender_offer_price == 0){
                                                $show_price = $totalprice;
                                                }else{
                                                $totalsaleprice;
                                                $convert_price = $totalsaleprice =='' ? $totalprice:$totalsaleprice;
                                                $show_price = $totalprice;
                                                }

                                            
                                            }else{

                                            $totalprice = ($orivar->products->vender_price+$orivar->price)*$commission_amount;

                                            $totalsaleprice = ($orivar->products->vender_offer_price+$orivar->price)*$commission_amount;

                                            $buyerprice = ($orivar->products->vender_price+$orivar->price)+($totalprice/100);

                                            $buyersaleprice = ($orivar->products->vender_offer_price+$orivar->price)+($totalsaleprice/100);

                                            
                                                if($orivar->products->vender_offer_price ==0){
                                                $show_price =  round($buyerprice,2);
                                                }else{
                                                round($buyersaleprice,2);
                                                
                                                $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                                $show_price = $buyerprice;
                                                }
                                            

                                            }
                                        }else{
                                            
                                        $comm = App\Commission::where('category_id',$product->category_id)->first();
                                        if(isset($comm)){
                                            if($comm->type=='f'){
                                            
                                            $price = $orivar->products->vender_price + $comm->rate + $orivar->price;

                                                if($orivar->products->vender_offer_price != null){
                                                $offer =  $orivar->products->vender_offer_price + $comm->rate + $orivar->price;
                                                }else{
                                                $offer =  $orivar->products->vender_offer_price;
                                                }

                                                if($orivar->products->vender_offer_price == 0 || $orivar->products->vender_offer_price == null){
                                                    $show_price = $price;
                                                }else{
                                                
                                                $convert_price = $offer;
                                                $show_price = $price;
                                                }

                                                
                                            }
                                            else{

                                                $commission_amount = $comm->rate;

                                                $totalprice = ($orivar->products->vender_price+$orivar->price)*$commission_amount;

                                                $totalsaleprice = ($orivar->products->vender_offer_price+$orivar->price)*$commission_amount;

                                                $buyerprice = ($orivar->products->vender_price+$orivar->price)+($totalprice/100);

                                                $buyersaleprice = ($orivar->products->vender_offer_price+$orivar->price)+($totalsaleprice/100);

                                                
                                                    if($orivar->products->vender_offer_price == 0){
                                                    $show_price = round($buyerprice,2);
                                                    }else{
                                                    $convert_price =  round($buyersaleprice,2);
                                                    
                                                    $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                                    $show_price = round($buyerprice,2);
                                                    }
                                                
                                                
                                                
                                            }
                                        }
                                            }
                                            $convert_price_form = $convert_price;
                                            $show_price_form = $show_price;
                                            $convert_price = $convert_price*$conversion_rate;
                                            $show_price = $show_price*$conversion_rate;
                                        
                                            @endphp
                                        
                                        

                                        @endif

                                                @php 
                                                    $var_name_count = count($orivar['main_attr_id']);
                                                
                                                    $name = array();
                                                    $var_name;
                                                    $newarr = array();
                                                    for($i = 0; $i<$var_name_count; $i++){
                                                        $var_id =$orivar['main_attr_id'][$i];
                                                        $var_name[$i] = $orivar['main_attr_value'][$var_id];
                                                        
                                                        $name[$i] = App\ProductAttributes::where('id',$var_id)->first();
                                                        
                                                    }


                                                    try {
                                                        $url = url('details') . '/'. str_replace(' ','-',$product->name)  .'/' . $product->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0] . '&' . $name[1]['attr_name'] . '=' . $var_name[1];
                                                    } catch (\Exception $e) {
                                                        $url = url('details') . '/' .str_replace(' ','-',$product->name)  .'/' . $product->id . '?' . $name[0]['attr_name'] . '=' . $var_name[0];
                                                    }

                                                @endphp
                                                    
                                                    <div class="compare-product-img">
                                                        <a href="{{$url}}" title="{{$product->name}}">
                                                        @if(count($product->subvariants)>0)

                                                            @if(isset($orivar->variantimages['image2']))
                                                            <img class="img-fluid" src="{{url('variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}" alt="{{$product->name}}">

                                                            @endif

                                                        @else
                                                            <img class="img-fluid" title="{{ $product->name }}" src="{{url('images/no-image.png')}}" alt="No Image"/>

                                                        @endif
                                                        </a>
                                                    </div>
                                                    <div class="compare-product-dtl">
                                                        <h4 class="section-title"><a href="{{ url($url) }}">{{ $product->name }}</a></h4>
                                                        <div class="price">
                                                        @if($orivar->def == 1)

                                                            @if($price_login == 0 || Auth::check())
                                                            @php
                                                            $convert_price = 0;
                                                            $show_price = 0;

                                                            $commision_setting = App\CommissionSetting::first();

                                                            if($commision_setting->type == "flat"){

                                                            $commission_amount = $commision_setting->rate;
                                                            if($commision_setting->p_type == 'f'){

                                                            $totalprice = $orivar->products->vender_price+$orivar->price+$commission_amount;
                                                            $totalsaleprice = $orivar->products->vender_offer_price + $orivar->price + $commission_amount;

                                                            if($orivar->products->vender_offer_price == 0){
                                                                $show_price = $totalprice;
                                                                }else{
                                                                $totalsaleprice;
                                                                $convert_price = $totalsaleprice =='' ? $totalprice:$totalsaleprice;
                                                                $show_price = $totalprice;
                                                                }

                                                            
                                                            }else{

                                                            $totalprice = ($orivar->products->vender_price+$orivar->price)*$commission_amount;

                                                            $totalsaleprice = ($orivar->products->vender_offer_price+$orivar->price)*$commission_amount;

                                                            $buyerprice = ($orivar->products->vender_price+$orivar->price)+($totalprice/100);

                                                            $buyersaleprice = ($orivar->products->vender_offer_price+$orivar->price)+($totalsaleprice/100);

                                                            
                                                                if($orivar->products->vender_offer_price ==0){
                                                                $show_price =  round($buyerprice,2);
                                                                }else{
                                                                round($buyersaleprice,2);
                                                                
                                                                $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                                                $show_price = $buyerprice;
                                                                }
                                                            

                                                            }
                                                            }else{

                                                            $comm = App\Commission::where('category_id',$product->category_id)->first();
                                                            if(isset($comm)){
                                                            if($comm->type=='f'){
                                                            
                                                            $price = $orivar->products->vender_price + $comm->rate + $orivar->price;

                                                                if($orivar->products->vender_offer_price != null){
                                                                $offer =  $orivar->products->vender_offer_price + $comm->rate + $orivar->price;
                                                                }else{
                                                                $offer =  $orivar->products->vender_offer_price;
                                                                }

                                                                if($orivar->products->vender_offer_price == 0 || $orivar->products->vender_offer_price == null){
                                                                    $show_price = $price;
                                                                }else{
                                                                
                                                                $convert_price = $offer;
                                                                $show_price = $price;
                                                                }

                                                                
                                                            }
                                                            else{

                                                                $commission_amount = $comm->rate;

                                                                $totalprice = ($orivar->products->vender_price+$orivar->price)*$commission_amount;

                                                                $totalsaleprice = ($orivar->products->vender_offer_price+$orivar->price)*$commission_amount;

                                                                $buyerprice = ($orivar->products->vender_price+$orivar->price)+($totalprice/100);

                                                                $buyersaleprice = ($orivar->products->vender_offer_price+$orivar->price)+($totalsaleprice/100);

                                                                
                                                                    if($orivar->products->vender_offer_price == 0){
                                                                    $show_price = round($buyerprice,2);
                                                                    }else{
                                                                    $convert_price =  round($buyersaleprice,2);
                                                                    
                                                                    $convert_price = $buyersaleprice==''?$buyerprice:$buyersaleprice;
                                                                    $show_price = round($buyerprice,2);
                                                                    }
                                                                
                                                            }
                                                            }
                                                            }
                                                            $convert_price_form = $convert_price;
                                                            $show_price_form = $show_price;
                                                            $convert_price = $convert_price*$conversion_rate;
                                                            $show_price = $show_price*$conversion_rate;

                                                            @endphp

                                                            @endif

                                                            @endif

                                                            @if($price_login != 1)
                                                                @if($convert_price != 0)
                                                                    <span> <i class="{{session()->get('currency')['value']}}"></i> {{ $convert_price }} </span>
                                                                    <s class="price-before-discount"> <i class="{{session()->get('currency')['value']}}"></i> {{ $show_price }}</s>
                                                                @else
                                                                    <span> <i class="{{session()->get('currency')['value']}}"></i> {{ $show_price }}</span>
                                                                @endif
                                                            @else
                                                            <span><a title="Login to view price" href="{{ route('login') }}">{{ __('Login to view price') }}</a></span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $incartcheck = 0;

                                                            if(Auth::check()){
                                                                $incart = App\Cart::where('user_id',Auth::user()->id)->where('variant_id',$orivar->id)->first();
                                                                if (isset($incart)) {
                                                                    $incartcheck = 1;
                                                                }else{
                                                                    $incartcheck = 0;
                                                                }
                                                            }else{

                                                                if(!empty(Session::has('cart'))){

                                                                    foreach (Session::get('cart') as $comp) {
                                                                    if($orivar->id == $comp['variantid']){
                                                                        $incartcheck = 1;
                                                                        break;
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                            
                                                        @endphp
                                                        @if($incartcheck == 1)
                                                            @auth
                                                                <a title="{{ __('Remove From Cart') }}" href="{{route('rm.cart',$orivar->id)}}" class="btn btn-warning">{{ __('Remove From Cart')}}<i data-feather="briefcase"></i> </a>                                            
                                                            @else
                                                                <a title="{{ __('Remove From Cart') }}" href="{{route('rm.session.cart',$orivar->id)}}" class="btn btn-warning">{{ __('Remove From Cart') }}<i data-feather="briefcase"></i></a>
                                                            @endif
                                                                
                                                        @else
                                                            @if($price_login != 1)
                                                                <form method="POST" action="{{route('add.cart',['id' => $orivar->products->id ,'variantid' =>$orivar->id, 'varprice' => $show_price_form, 'varofferprice' => $convert_price_form ,'qty' =>$orivar->min_order_qty])}}">
                                                                @csrf
                                                                    <button title="{{ __('Add to Cart') }}" type="submit" class="btn btn-warning">Add to Cart<i data-feather="briefcase"></i></button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </th>
                                                    
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{__('Ratings')}}</th>
                                <td>
                                    <div class="stars stars-example-css">
                                        <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                        <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                        <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                        <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                        <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('Description')}}</th>
                                @foreach(Session::get('comparison') as $product)
                                @php
                                    $pro = App\Product::find($product['proid']);
                                @endphp
                                @if(isset($pro) && $pro->status == 1)
                                    <td>{!! $pro->des !!}</td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th scope="row">{{__('Availability')}}</th>
                                @foreach(Session::get('comparison') as $pro)
                                    @php
                                        $product = App\Product::find($pro['proid']);
                                    @endphp
                                    @if(isset($product) && $product->status == 1)
                                        <td>
                                        @foreach($product->subvariants as $orivar)
                                            @if($orivar->def == 1)
                                                @if($orivar->stock > 0)
                                                <span class="wishlist-stock">{{__('In Stock')}}</span>
                                                @else
                                                <span class="wishlist-out-stock">{{__('Out of Stock')}}</span>
                                                @endif
                                                                
                                            @endif
                                        @endforeach
                                    </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th scope="row">{{__('Weight')}}</th>
                                @foreach(Session::get('comparison') as $product)
                                    @php
                                        $product = App\Product::find($product['proid']);
                                    @endphp
                                    @if(isset($product) && $product->status == 1)
                                        <td>
                                        @foreach($product->subvariants as $orivar)
                                            @if($orivar->def == 1)
                                                @if(isset($orivar->unitname['short_code']))
                                                    <p>{{ $orivar->weight.$orivar->unitname['short_code'] }}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th scope="row">{{__('Specification')}}</th>
                                @foreach(Session::get('comparison') as $pro)
                                    @php
                                        $product = App\Product::find($pro['proid']);
                                    @endphp
                                    @if(isset($product) && $product->status == 1)
                                        <td>
                                            @if(count($product->specs)>0)
                                                <table class="width100" border="1">
                                                    @foreach($product->specs as $spec)
                                                    <tr>
                                                        <td><b>{{ $spec->prokeys }}</b></td>
                                                        <td>{{ $spec->provalues }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th scope="row">{{__('Remove')}}</th>
                                
                                @foreach(Session::get('comparison') as $product)
                                @php
                                    $pro = App\Product::find($product['proid']);
                                @endphp
                                    @if(isset($pro) && $pro->status == 1)
                                        <td><a href="{{ route('remove.compare.product',$pro->id) }}" class="remove-icon"><i data-feather="x"></i></a></td>
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <h2>{{__('Compare list is empty')}}</h2>
            @endif
        </div>
    </div>
</section>
<!-- Compare End -->

@endsection

@section('script')
  <script>var baseUrl = "<?= url('/') ?>";</script>
  <script src="{{ url('js/wishlist.js') }}"></script>
@endsection