<?php
namespace App\Http\Controllers;
use App\Address;
use App\Allcity;
use App\Allcountry;
use App\Allstate;
use App\AutoDetectGeo;
use App\BillingAddress;
use App\Cart;
use App\CommissionSetting;
use App\Config;
use App\Country;
use App\CurrencyCheckout;
use App\Districts;
use App\Division;
use App\FailedTranscations;
use App\Genral;
use App\HandlingCharge;
use App\Invoice;
use App\Order;
use App\ShippingWeight;
use App\ShippingCharge;
use App\Unions;
use App\Upazilas;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;
use Session;
use ShippingPrice;
use App\ShippingCoupan;
use App\Affilate;
use function Psy\sh;

class CheckoutController extends Controller
{

    static public $bil_total=0;

    public function getFailedTranscation()
    {
        require_once 'price.php';
        $user = Auth::user();
        $failedtranscations = FailedTranscations::orderby('id', 'DESC')->where('user_id', $user->id)->paginate(10);
        return view('frontend.profile.faild_trancation', compact('conversion_rate', 'failedtranscations'));
    }

    public function chooseaddress(Request $request)
    {
//        return $request;

        
        require_once 'price.php';

        $pincodesystem = Config::first()->pincode_system;

        $getaddress = $request->seladd;
//        return $getaddress;
//        return $pincodesystem;

        if (!isset($getaddress)) {
            $getaddress = Session::get('address');
//            return $getaddress;
        }
//        return $pincodesystem;
//        return 'sarowar';

        #if pincode validation enable !
        if ($pincodesystem == 1) {
            #PinCode validation
            $getpincode = Address::find($getaddress)->pin_code;

            if (strlen($getpincode) > 5) {

                $avbl_pincode = Allcity::where('pincode', $getpincode)->first();

                if (empty($avbl_pincode->pincode)) {
                    notify()->error(__('Delivery not available on selected address pincode !'));
                    return redirect('/checkout');
                }

            } else {
                notify()->error(__('Delivery not available on selected address pincode !'));
                return redirect('/checkout');
            }
        }

        Session::put('address', $getaddress);

        $total = 0;

        $user = Auth::user();

        if (Auth::check()) {

            foreach (Auth::user()->cart as $val) {

                if ($val->semi_total == 0) {
                    $price = $val->price_total;
                } else {
                    $price = $val->semi_total;
                }

                $total = $total + $price;

                Session::put('bil_total', $total);
            }
//            return Session::get('shippingcharge');

            return redirect(route('checkout'));
        }
    }

    
    public function getBillingView()
    {


        require_once 'price.php';

        $shippingcharge = 0;

        if (auth()->check()) {

            $total = Session::get('bil_total');
            $shippingcharge=Session::get('shippingcharge');
//            return $shippingcharge;
//            foreach (auth()->user()->cart as $key => $val) {
//                if($val->active_cart == 1){
//                    if ($val->semi_total == 0) {
//                        $price = $val->price_total;
//                    } else {
//                        $price = $val->semi_total;
//                    }
//
//                $total = $total + $price;
//
//                if (get_default_shipping()->whole_order != 1) {
//                    $shippingcharge += ShippingPrice::calculateShipping($val);
//                    $shippingcharge += shippingprice($val);
//                } else {
//                    $shippingcharge = ShippingPrice::calculateShipping($val);
//                    $shippingcharge += shippingprice($val);
//                }
//             }
//
//            }

//            return $shippingcharge;


            $genrals_settings = Genral::first();

            if ($genrals_settings->cart_amount != 0 && $genrals_settings->cart_amount != '') {

                $t = sprintf("%.2f",(getcarttotal() * $conversion_rate + auth()->user()->cart()->sum('tax_amount') * $conversion_rate));  

                if ($t >= $genrals_settings->cart_amount * $conversion_rate) {
                   
                    $shippingcharge = 0;

                }

            }

        }

        $sentfromlastpage = 0;

        $grandtotal = $total + $shippingcharge;

//        $addresses = auth()->user()->addresses()->with(['getCountry', 'getstate', 'getcity'])
//                    ->whereHas('getCountry')
//                    ->whereHas('getstate')
//                    ->get();

//        $all_country = Allcountry::join('countries', 'countries.country', '=', 'allcountry.iso3')
//                       ->select('allcountry.*')
//                       ->get();


        $addresses=Address::where('user_id',auth()->id())->get();
        return redirect(route('checkout'));
//        return view('frontend.checkout_step2', compact('addresses', 'conversion_rate', 'sentfromlastpage', 'total', 'shippingcharge', 'grandtotal'));
    }

    public function index(Request $request)
    {
//        return $request;

        require_once 'price.php';

        $total = 0;

        $checkoutsetting_check = AutoDetectGeo::first();

//        if ($checkoutsetting_check->enable_cart_page == 1) {
//            $listcheckOutCurrency = CurrencyCheckout::get();
//            $currentCurrency = Session::get('currency');
//
//            foreach ($listcheckOutCurrency as $key => $all) {
//                if ($currentCurrency['id'] == $all->currency) {
//                    if ($all->checkout_currency == 1) {
//                        Session::forget('validcurrency');
//                    } else {
//                        Session::put('validcurrency', 1);
//                        return redirect('/cart');
//                    }
//                }
//            }
//        }

        if (Auth::check()) {

            $user = Auth::user();

            $cart_table = Cart::where('user_id',auth()->id())->where('active_cart', 1)->with(['simple_product','product','product.reviews','variant','product.shippingmethod'])
            ->orWhereHas('simple_product')
            ->whereHas('product',function($query){
                return $query->where('status','1');
            })->whereHas('variant')->get();

            foreach ($cart_table as $carts) {
                $min = $carts->qty;
//                $id = $carts->variant_id;
//                $pros = $carts->variant;
//                $max = 0;
//
//                if (isset($pros)) {
//                    if ($pros->max_order_qty == null) {
//                        $max = $pros->stock;
//                    } else {
//                        $max = $pros->max_order_qty;
//                    }
//
//                    if ($max >= $min) {
//
//                    } else {
//                        notify()->error(__('Sorry the product is out of stock !'));
//                        return back();
//                    }
//                }

                if (isset($cart->simple_product)) {

                    if ($cart->simple_product->max_order_qty == null) {
                        $max = $cart->simple_product->stock;
                    } else {
                        $max = $cart->simple_product->max_order_qty;
                    }

                    if ($max >= $min) {

                    } else {
                        notify()->error(__(':product the product is out of stock now !',['product' => $cart->simple_product->product_name]));
                        return back();
                    }

                }

            }
        }

        if (Auth::check()) {

            $user_id = auth()->id();
            $user = auth()->user();

            $shipping = BillingAddress::where('user_id', $user->id)->first();
//return $shipping;
            if ($request->shipping != "") {
                $descript = $request->shipping;
            } else {
                $x = Session::get('shippingcharge');
                $descript = $x;
            }

            $commision_setting = CommissionSetting::first();

            foreach ($cart_table as $key => $val) {
                if ($val->semi_total == 0) {
                   
                    $total = $total+$val->price_total;
                } else {
                    $total = $total+$val->semi_total;
                }
            }


            $shippingcharge = 0;
//return $shippingcharge;
            foreach ($cart_table as $key => $cart) {
//return $cart->product->free_shipping;
                if ($cart->product && $cart->product->free_shipping == 0) {
                    $free_shipping = $cart->product->shippingmethod;

                    if (!empty($free_shipping)) {
                        if ($free_shipping->name == "Shipping Price") {

                            $weight = ShippingWeight::first();
                            $pro_weight = $cart->variant->weight;

                            if ($weight->weight_to_0 >= $pro_weight) {
                                if ($weight->per_oq_0 == 'po') {
                                    $x = $weight->weight_price_0;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_0;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                } else {
                                    $x = $weight->weight_price_0 * $cart->qty;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_0 * $cart->qty;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                }
                            } elseif ($weight->weight_to_1 >= $pro_weight) {
                                if ($weight->per_oq_1 == 'po') {
                                    $x = $weight->weight_price_1;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_1;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                } else {
                                    $x = $weight->weight_price_1 * $cart->qty;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_1 * $cart->qty;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                }
                            } elseif ($weight->weight_to_2 >= $pro_weight) {
                                if ($weight->per_oq_2 == 'po') {
                                    $x = $weight->weight_price_2;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_2;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                } else {
                                    $x = $weight->weight_price_2 * $cart->qty;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_2 * $cart->qty;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                }
                            } elseif ($weight->weight_to_3 >= $pro_weight) {
                                if ($weight->per_oq_3 == 'po') {
                                    $x = $weight->weight_price_3;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_3;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                } else {
                                    $x = $weight->weight_price_3 * $cart->qty;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_3 * $cart->qty;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                }
                            } else {
                                if ($weight->per_oq_4 == 'po') {
                                    $x = $weight->weight_price_4;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_4;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                } else {
                                    $x = $weight->weight_price_4 * $cart->qty;
                                    $shippingcharge = $shippingcharge + $weight->weight_price_4 * $cart->qty;
                                    Cart::where('id', $cart->id)->update(['shipping' => $x]);
                                }

                            }

                        } else {
//                            return 'sarowar';
                            $x = $free_shipping->price;
                            if ($free_shipping->whole_order == 1) {
                                $shippingcharge = $free_shipping->price;
                            } else {
                                $shippingcharge = $shippingcharge + $free_shipping->price;
                            }
                            Cart::where('id', $cart->id)->update(['shipping' => $x]);

                        }
                    }

                }

                if ($cart->simple_product) {
//return 'simple';
                    if (get_default_shipping() && get_default_shipping()->whole_order == 1) {
//                        return 'whole';
                        $shippingcharge = shippingprice($cart);
//                        return (float)$shippingcharge;
                        $cart->shipping = (float) $shippingcharge;
                        $cart->save();
                    } else {
//                        return 'sarowar';
                        $shippingcharge = $shippingcharge + shippingprice($cart);
//                        return (float)$shippingcharge;
                        $cart->shipping = (float) $shippingcharge;
                        $cart->save();
                    }
//                    return $shippingcharge;

                }
//                return 'sarowar';

            }

            $cartamountsetting = Genral::first();
//            return $conversion_rate;
//return $cartamountsetting->cart_amount;
            if ($cartamountsetting->cart_amount != 0 && $cartamountsetting->cart_amount != '') {
                
                if ($total * $conversion_rate >= $cartamountsetting->cart_amount * $conversion_rate) {
                    $shippingcharge = 0;
                }
            }
//            return $shippingcharge;

            Session::put('shippingcharge', $shippingcharge);

            $grandtotal = $total + $shippingcharge;

//            $addresses = auth()->user()->addresses()->with(['getCountry', 'getstate', 'getcity'])->whereHas('getCountry')->whereHas('getstate')->get();
            $addresses = Address::where('user_id',$user_id)->get();
//            dd($user_id);

//            $country = Allcountry::join('countries', 'countries.country', '=', 'allcountry.iso3')->select('allcountry.*')->get();
            $divisions=Division::all();
//return $divisions;
            return view('frontend.checkout', compact( 'divisions','addresses', 'conversion_rate', 'grandtotal', 'user', 'total', 'shipping', 'shippingcharge'));

        }

        notify()->warning(__('Login First !'));
        return redirect('cart');

    }

    public function add(Request $request)
    {
//        return 'sarowar';

        require_once 'price.php';

        $user = Auth::user();
//        return $user->district_id   ;

        $addrid = Session::get('address');
        $getaddress = Address::find($addrid);
        $payable=sprintf('%.2f',Session::get('bil_total')) ;
        $useraddress=Address::where('user_id',$user->id)->where('defaddress',1)->first();


//        dd($addr);
//        return $getaddress;
        $sameship=1;
//        $test= $getaddress->union_id;
//        return $useraddress?$useraddress->name:$getaddress->name;
        

//        if (auth()->user()->billingAddress()->count()) {
//            if ($sameship == 1) {
//                Session::put('ship_check', $addrid);

                $newbilling = new BillingAddress();

                $newbilling->total = $payable;
                $newbilling->firstname = $useraddress?$useraddress->name:$getaddress->name;
                $newbilling->address = clean($useraddress?$useraddress->address:$getaddress->address);
                $newbilling->mobile = $useraddress?$useraddress->phone:$getaddress->phone;
                $newbilling->division_id =$useraddress ?$useraddress->division_id: $getaddress->division_id;
                $newbilling->district_id = $useraddress ?$useraddress->district_id: $getaddress->district_id;
                $newbilling->upazila_id = $useraddress ?$useraddress->upazila_id:$getaddress->upazila_id;
                $newbilling->union_id = $useraddress ?$useraddress->union_id:$getaddress->union_id;
                $newbilling->user_id = $user->id;
                $newbilling->save();

                session()->put('billing',
                    [
                        'firstname' => $useraddress?$useraddress->name:$getaddress->name,
                        'address' => $useraddress?$useraddress->address:$getaddress->address,
                        'division_id' =>$useraddress ?$useraddress->division_id: $getaddress->division_id,
                        'district_id' => $useraddress ?$useraddress->district_id: $getaddress->district_id,
                        'upazila_id' => $useraddress ?$useraddress->upazila_id:$getaddress->upazila_id,
                        'union_id' => $useraddress ?$useraddress->union_id:$getaddress->union_id,
                        'total' => $payable,
                        'mobile' => $useraddress?$useraddress->phone:$getaddress->phone,
                        'user_id'=>$user->id
                    ]
                );

//            } else {
////                return 'hello';
//                Session::put('ship_check', '0');
//                if ($request->billing_name != '' && $request->billing_address != '' && $request->billing_mobile != '' ) {
//                    $newbilling = new BillingAddress();
//
//                    $newbilling->total = $request->total;
//                    $newbilling->firstname = $getaddress->name;
//                    $newbilling->address = clean($getaddress->address);
//                    $newbilling->mobile = auth()->user()->mobile;
//                    $newbilling->division_id = $getaddress->division_id;
//                    $newbilling->district_id = $getaddress->district_id;
//                    $newbilling->upazila_id = $getaddress->upazila_id;
//                    $newbilling->union_id = $getaddress->union_id;
//                    $newbilling->user_id = Auth::user()->id;
////                $newbilling->email = $getaddress->email;
//
//                    $newbilling->save();
//
//                    $addflag = 0;
//                    #validation here
//                    $alladdress = auth()->user()->addresses;
//
//                    foreach ($alladdress as $value) {
//
//                        if ($value->name == $request->billing_name && $value->address == $request->billing_address && $value->city_id == $request->city_id && $value->state_id == $request->state_id && $value->country_id == $request->country_id && $request->billing_pincode == $value->pin_code) {
//
//                            $addflag = 1;
//                        }
//                    }
//                    ##
//
//                    if ($addflag != 1) {
//                        return 'hellonew';
//
//                        $newaddress = new Address();
//
//                        $newaddress->name = $request->billing_name;
//                        $newaddress->address = clean($request->billing_address);
//                        $newaddress->email = $request->billing_email;
//                        $newaddress->phone = $request->billing_mobile;
//                        $newaddress->division_id = $request->division_id;
//                        $newaddress->district_id = $request->district_id;
//                        $newaddress->upazila_id = $request->upazila_id;
//                        $newaddress->union_id = $request->union_id;
//                        $newaddress->defaddress = "0";
//                        $newaddress->user_id = auth()->id();
//
//                        $newaddress->save();
//                    }
//
//                    session()->put('billing', ['firstname' => $request->billing_name, 'address' => $request->billing_address, 'email' => $request->billing_email, 'country_id' => $request->country_id, 'city' => $request->city_id, 'state' => $request->state_id, 'total' => $request->total, 'mobile' => $request->billing_mobile, 'pincode' => $request->billing_pincode]);
//                } else {
//                    notify()->error(__('Please fill all fields to continue !'));
//                    return back();
//                }
//
//            }

//        } else {
////            return 'helo1';
//            if ($sameship == 1) {
//
//                Session::put('ship_check', $addrid);
//                Session::forget('ship_from_choosen_address');
//
//                $getaddress = Address::find($addrid);
//
//                session()->put('billing', ['firstname' => $getaddress->name, 'address' => $getaddress->address,  'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id' => $getaddress->upazila_id, 'union_id' => $getaddress->union_id, 'total' => $request->total, 'mobile' => $getaddress->phone]);
//
//            } else {
//
//                Session::put('ship_check', 0);
//
//                $data = $request->all();
//
//                $getalladdress = auth()->user()->billingAddress;
//
//                $getuseraddress = auth()->user()->addresses;
//
//                $flag = 0;
//                $add_cus = 0;
//                $add_flag = 0;
//                foreach ($getalladdress as $value) {
//
//                    if ($value->firstname == $data['billing_name'] && $value->address == $data['billing_address'] && $value->city == $data['city_id'] && $value->state == $data['state_id'] && $value->country_id == $data['country_id']) {
//
//                        #if match found putting flag = 1
//                        foreach ($getuseraddress as $value2) {
//
//                            if ($value2->name == $data['billing_name'] && $value2->address == $data['billing_address'] && $value2->city_id == $data['city_id'] && $value2->state_id == $data['state_id'] && $value2->country_id == $data['country_id']) {
//
//                                $add_cus = $value2->id;
//                                $add_flag = 1;
//
//                            }
//
//                        }
//
//                        $flag = 1;
//
//                        break;
//
//                    } else {
//
//                        #if match not found putting flag = 0
//                        $flag = 0;
//                        #address if already there
//                        foreach ($getuseraddress as $value2) {
//
//                            if ($value2->name == $data['billing_name'] && $value2->address == $data['billing_address'] && $value2->city_id == $data['city_id'] && $value2->state_id == $data['state_id'] && $value2->country_id == $data['country_id']) {
//
//                                $add_cus = $value2->id;
//                                $add_flag = 1;
//
//                            }
//
//                        }
//
//                    }
//                }
//
//                $config = Config::first();
//
//                if ($flag == 1) {
//
//                    Session::put('ship_from_choosen_address', $add_cus);
//
//                    if ($config->pincode_system == 0) {
//                        session()->put('billing', ['firstname' => $getaddress->name, 'address' => $getaddress->address,  'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id' => $getaddress->upazila_id, 'union_id' => $getaddress->union_id, 'total' => $request->total, 'mobile' => $getaddress->phone]);
//                    } else {
//                        session()->put('billing', ['firstname' => $getaddress->name, 'address' => $getaddress->address,  'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id' => $getaddress->upazila_id, 'union_id' => $getaddress->union_id, 'total' => $request->total, 'mobile' => $getaddress->phone]);
//                    }
//
//                } else {
//
//                    Session::forget('ship_from_choosen_address');
//                    #Saving in billing table if address match not found
//                    $newbilling = new BillingAddress();
//                    $newbilling->total = $request->total;
//                    $newbilling->firstname = $request->billing_name;
//                    $newbilling->address = clean($request->billing_address);
//                    $newbilling->mobile = $request->billing_mobile;
//                    $newbilling->pincode = $request->billing_pincode;
//                    $newbilling->city = $request->city_id;
//                    $newbilling->state = $request->state_id;
//                    $newbilling->country_id = $request->country_id;
//                    $newbilling->user_id = Auth::user()->id;
//                    $newbilling->email = $request->billing_email;
//
//                    $newbilling->save();
//
//                    if ($add_flag != 1) {
//                        #Saving as Shipping address for next-time
//                        $newaddress = new Address();
//
//                        $newaddress->name = $request->billing_name;
//                        $newaddress->address = clean($request->billing_address);
//                        $newaddress->email = $request->billing_email;
//                        $newaddress->phone = $request->billing_mobile;
//                        $newaddress->pin_code = $request->billing_pincode;
//                        $newaddress->city_id = $request->city_id;
//                        $newaddress->state_id = $request->state_id;
//                        $newaddress->country_id = $request->country_id;
//                        $newaddress->defaddress = "0";
//                        $newaddress->user_id = auth()->id();
//
//                        $newaddress->save();
//                    }
//
//                    if ($config->pincode_system == 1) {
////                        session()->put('billing', ['firstname' => $data['billing_name'], 'address' => $data['billing_address'], 'email' => $data['billing_email'], 'country_id' => $data['country_id'], 'city' => $data['city_id'], 'state' => $data['state_id'], 'total' => $request->total, 'mobile' => $data['billing_mobile'], 'pincode' => $data['billing_pincode']]);
//                        session()->put('billing', ['firstname' => $getaddress->name, 'address' => $getaddress->address,  'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id' => $getaddress->upazila_id, 'union_id' => $getaddress->union_id, 'total' => $request->total, 'mobile' => $getaddress->phone]);
//                    } else {
////                        session()->put('billing', ['firstname' => $data['billing_name'], 'address' => $data['billing_address'], 'email' => $data['billing_email'], 'country_id' => $data['country_id'], 'city' => $data['city_id'], 'state' => $data['state_id'], 'total' => $request->total, 'mobile' => $data['billing_mobile']]);
//                        session()->put('billing', ['firstname' => $getaddress->name, 'address' => $getaddress->address,  'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id' => $getaddress->upazila_id, 'union_id' => $getaddress->union_id, 'total' => $request->total, 'mobile' => $getaddress->phone]);
//                    }
//                }
//
//            }
//
//        }

        $sentfromlastpage = 0;
//        notify()->success(__('Billing address updated successfully Now you can process to payment!'));

        return redirect(route('order.review'));
        // return view('front.checkout', compact('conversion_rate', 'sentfromlastpage'));

    }

    public function orderReview()
    {
//        return 'order review';
        $handing_charge_array=array();
        $genrals_settings = Genral::first();

        $shipping_coupan = ShippingCoupan::first()->name;
        $shipping_coupan_type = ShippingCoupan::first()->coupan_type;
        $shipping_coupan_per_price = ShippingCoupan::first()->number_of_price;
        $shipping_coupan_status = ShippingCoupan::first()->status;

        $handling_charge = HandlingCharge::get();
//        return $handling_charge;

        $count_handling_charge = HandlingCharge::where('Type_of_charge',HandlingCharge::_GLOBAL)->count();
//        return $count_handling_charge;

        $handling_amount =null;
        if(!empty($handling_charge[0])){
            if(count($handling_charge) ==$count_handling_charge){
                $genrals_settings->update(['handlingcharge'=>$handling_charge[0]->global_price]);
            }else{
    
                if(!empty($handling_charge)){
    
                    foreach($handling_charge as $handlingcharge){
                        
                        $handing_charge_array[strtolower($handlingcharge->payment_getway_name)]=$handlingcharge->price;
                    }
    
                }
    
                $count_handling_charge = HandlingCharge::where('payment_getway_name', 'paypal')->get();
                if(isset($count_handling_charge[0]->price)){
                    $genrals_settings->update(['handlingcharge'=>$count_handling_charge[0]->price]);
                }
                else{
                    $genrals_settings->update(['handlingcharge'=>0]);
                }
            
            }
        }
        require  'price.php';
//        return 'sarowar';
        $sentfromlastpage = 0;

//        $addresses = auth()->user()->addresses()->with(['getCountry', 'getstate', 'getcity'])->whereHas('getCountry')->whereHas('getstate')->get();
        $addresses=Address::where('user_id',auth()->id())->get();

        $cart_table = Cart::where('user_id',auth()->id())->where('active_cart',1)->with(['simple_product','product','product.reviews','variant','product.shippingmethod'])
        ->orWhereHas('simple_product')
        ->whereHas('product',function($query){
            return $query->where('status','1');
        })->whereHas('variant')->get();



        $shippingcharge = session()->get('shippingcharge');
//        return $shippingcharge;

//        $all_country = Allcountry::join('countries', 'countries.country', '=', 'allcountry.iso3')->select('allcountry.*')->get();
//
//        $selectedstates = DB::table('allstates')->where('country_id', Session::get('billing')['country_id'])->get();
//
//        $selectedcities = DB::table('allcities')->where('state_id', Session::get('billing')['state'])->get();
//        return Session::get('billing');
        $selectdivision = Division::where('id',Session::get('billing')['division_id'])->get();
        $selectdistrict = Districts::where('id',Session::get('billing')['district_id'])->get();
        $selectupazila = Upazilas::where('id',Session::get('billing')['upazila_id'])->get();
        $selectunion = Unions::where('id',Session::get('billing')['union_id'])->get();
//        'division_id' => $getaddress->division_id, 'district_id' => $getaddress->district_id, 'upazila_id	' => $getaddress->upazila_id, 'union_id	'
//        return $selectdivision;

       
      $selectedaddress = Address::find(Session::get('address'));
//      return $selectedaddress;

     /**
      * shipping charge feature add
      */
     $shippingChage = null;
     $shippingAddress = ShippingCharge::where("city_id",$selectedaddress->district_id? $selectedaddress->district_id:'')->first();
//     return $shippingAddress;

     if($shippingAddress){
         if($shippingAddress->Type_of_charge =="global"){
            $shippingChage =$shippingAddress->global_price;
         }else{
            $shippingChage =$shippingAddress->custom_price;
         }
     }

      //  dd($selectedaddress->getcity->name);

        /** Cart Shipping Changes */

        $count = collect();
//        return $cart_table;

        $cart_table->each(function ($cart) use ($count) {
//return 'sss';
           if($cart->active_cart == 1){ 

//            if ($cart->ship_type != 'localpickup' && $cart->variant && $cart->product) {
//
//                $cart->shipping = (float) ShippingPrice::calculateShipping($cart);
//                $cart->save();
//
//            }

            if ($cart->ship_type != 'localpickup' && $cart->simple_product) {
//return "ship";
                $cart->shipping = (float) shippingprice($cart);
                $cart->save();

            }
//            return 'sarowar';

            if (get_default_shipping()->whole_order == 1) {

                /** Get the products count which have not free shipping */

                if ($cart->ship_type != 'localpickup' && $cart->product && $cart->product->free_shipping == 0) {

                    $count->push(1);
                }

                if ($cart->simple_product && $cart->ship_type != 'localpickup' && $cart->simple_product->free_shipping == 0) {

                    $count->push(1);

                }

                /** end */
            }
        }   

        });

        if(count($count)){
            $cart_table->each(function($cart) use ($count) {

                if($cart->active_cart == 1){ 

                if (get_default_shipping()->whole_order == 1) {
    
//                    if ($cart->ship_type != 'localpickup' && $cart->variant && $cart->product) {
//
//                        $cart->shipping = (float) ShippingPrice::calculateShipping($cart) / $count->count();
//                        $cart->save();
//
//                    }
        
                    if ($cart->ship_type != 'localpickup' && $cart->simple_product) {
        
                        $cart->shipping = (float) shippingprice($cart) / $count->count();
                        $cart->save();
        
                    }
                }
            }
    
            });
        }

        $ctotal = 0;
        // Update Shipping process
        $shippingcharge =Session::get('shippingcharge');
            foreach ($cart_table as $key => $crt) {
                if($crt->active_cart == 1){ 
                    if($crt->semi_total != 0){
                        $ctotal += $crt->semi_total + $crt->shipping - $crt->tax_amount;
                    }else{
                        $ctotal += $crt->price_total + $crt->shipping - $crt->tax_amount;
                    }
                }
            }
//return $ctotal;
            if(isset($ctotal)){

                $genrals_settings = Genral::first();

                if($genrals_settings->cart_amount != 0 && $genrals_settings->cart_amount != ''){

                    if($ctotal >= $genrals_settings->cart_amount){
                        
                        DB::table('carts')->where('user_id', '=', auth()->id())->update(['shipping' => 0]);

                    }

                }

            }
            $shippingcharge =Session::get('shippingcharge');
//            return $shippingcharge;
            $divisions=Division::all();
//        dd($genrals_settings);
        // End
        /** End */
        return view('frontend.checkout_step', compact('divisions','shippingChage','selectedaddress', 'selectdivision', 'selectdistrict', 'selectupazila', 'selectunion', 'shippingcharge', 'cart_table','conversion_rate', 'addresses', 'sentfromlastpage','handling_charge','handing_charge_array','shipping_coupan', 'shipping_coupan_type', 'shipping_coupan_per_price', 'shipping_coupan_status', 'ctotal'));
    }

    public function show_profile()
    {
 
        require_once 'price.php';
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            // Personal Info
            $user = Auth::user();
            $country = Country::all();
            $states = Allstate::where('country_id', $user->country_id)->get();
            $citys = Allcity::where('state_id', $user->state_id)->get();
            $divisions=Division::all();

            return view('frontend.profile.personal_info', compact('divisions','conversion_rate','user', 'country', 'citys', 'states'));
        }

    }

    public function all_order()
    {
        require_once 'price.php';
        $user = Auth::user();
        $orders = Order::with(['invoices', 'invoices.variant', 'invoices.simple_product', 'invoices.variant.variantimages'])->whereHas('invoices')->orderBy('id', 'desc')->where('user_id', $user->id)->where('status', '=', 1)->get();
        return view('frontend.all_orders', compact('conversion_rate', 'orders'));
    }

    public function update(Request $request, $id)
    {
//        return $request;

        $user = User::findOrFail($id);

        $input = $request->all();

        if ($request->name == '') {
            $input['name'] = $user->name;
        }
        if ($request->mobile == '') {
            $input['mobile'] = $user->mobile;
        }
        if ($request->division_id == '') {
            $input['division_id'] = $user->division_id;
        }
        if ($request->district_id == '') {
            $input['district_id'] = $user->district_id;
        }
        if ($request->upazila_id == '') {
            $input['upazila_id'] = $user->upazila_id;
        }
        if ($request->union_id == '') {
            $input['union_id'] = $user->union_id;
        }

        if ($file = $request->file('image')) {

            if ($user->image != null) {
                if (file_exists(public_path() . '/images/user/' . $user->image)) {
                    unlink(public_path() . '/images/user/' . $user->image);
                }
            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/user/';
            $name = time() . $file->getClientOriginalName();
            $optimizeImage->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $name);

            $input['image'] = $name;

        } else {

            $input['password'] = $user->password;
            $input['image'] = $user->image;
            try
            {
                $user->update($input);
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    return back()->with("success", __("Phone alerdy exists"));
                }
            }
        }

        try
        {
            $user->update($input);

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with("success", __("Phone already exists !"));
            }
        }

        return redirect('profile')->with('success', 'Profile has been updated');
    }

    public function changepassword()
    {
        $data['user'] = Auth::user();
        return view('frontend.profile.change_password',$data);
    }

    public function changepass(Request $request, $id)
    {

        $this->validate($request, ['old_password' => 'required', 'password' => 'required|between:6,50|confirmed', 'password_confirmation' => 'required']);
        $user = User::findOrFail($id);

        if (Hash::check($request->old_password, $user->password)) {

            $user->fill([
                'password' => Hash::make($request->password),
            ])->save();

            notify()->success(__('Password changed successfully !'));
            return back();
        } else {
            notify()->error(__('Old password is incorrect !'));
            return back();
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', __('Password updated successfully !'));
    }

    public function order()
    {
        require_once 'price.php';

        $user = Auth::user();

        $orders = Order::with(['invoices', 'invoices.variant', 'invoices.simple_product', 'invoices.variant.variantimages'])->whereHas('invoices')->orderBy('id', 'desc')->where('user_id', $user->id)->where('status', '=', 1)->paginate(5);

        $ord_postfix = Invoice::first()?Invoice::first()->order_prefix:'';

        return view('frontend.profile.orders', compact('ord_postfix', 'orders', 'user', 'conversion_rate'));
    }

}