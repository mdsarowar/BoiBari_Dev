<?php
namespace App\Http\Controllers;

use App\AddSubVariant;
use App\Cart;
use App\Coupan;
use App\Product;
use App\SimpleProduct;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\MessageBag;
use Redirect;
use Session;

class CustomLoginController extends Controller
{
    use ThrottlesLogins;

    protected $maxAttempts = 3;
    protected $decayMinutes = 1;


    public function doLogin(Request $request)
    {
//        return $request;

        if (Auth::attempt(['mobile' => $request->get('mobile'), 'password' => $request->get('password'),

            'is_verified' => 1, 'status' => 1], $request->remember)) {
//            return $request->mobile;


            if(!auth()->user()->can('login.can')){
                FacadesAuth::logout();
                $errors = new MessageBag(['mobile' => __('Login access blocked !')]);
                notify()->error($errors);
                return Redirect::back()->withErrors($errors)->withInput($request->except('password'));
            }
//            return 'hello';

            /*Check if user has item in his cart*/
            if (!empty(Session::get('cart'))) {

              $this->cartitem();
                notify()->success('Login Successfully');
                return redirect('cart');
            }

            notify()->success('Login Successfully');
            return redirect()->intended('/');

        } else {
            
            $errors = new MessageBag(['mobile' => 'These credentials do not match our records.']);
            notify()->error('These credentials do not match our records.');
            return Redirect::back()->withErrors($errors)->withInput($request->except('password'));

        }
    }

    public function cartitem()
    {
        $SessionCart = Session::get('cart');
//        return $SessionCart;
        foreach ($SessionCart as $c) {

//            $venderid = Product::find($c['pro_id']);
            $sp = SimpleProduct::where('id',$c['id'])->first();

            if (count(Auth::user()->cart) > 0) {

                $cart = Cart::where('simple_pro_id', $sp->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->first();


                if (isset($cart)) {
                    $quntity=$cart->qty+$c['quantity'];

                    $cart->simple_pro_id =$sp->id;
                    $cart->ori_price = $sp->price;
                    $cart->price_total = $sp->price * $quntity;
                    $cart->ori_offer_price = $sp->offerprice;
                    $cart->semi_total = $sp->offerprice*$quntity;
                    $cart->qty = $quntity;
                    $cart->user_id = auth()->id();
                    $cart->update();
                } else {

                    $cart = new Cart;
//                    $cart->user_id = Auth::user()->id;
                    $cart->simple_pro_id =$sp->id;
                    $cart->ori_price = $sp->price;
                    $cart->price_total = $sp->price *  $c['quantity'];
                    $cart->ori_offer_price = $sp->offerprice;
                    $cart->semi_total = $sp->offerprice *  $c['quantity'];
                    $cart->qty = $c['quantity'];
                    $cart->user_id = auth()->id();
                    $cart->save();

                }

            } else {
                $cart = new Cart;
//                    $cart->user_id = Auth::user()->id;
                $cart->simple_pro_id =$sp->id;
                $cart->ori_price = $sp->price;
                $cart->price_total = $sp->price * $c['quantity'];
                $cart->ori_offer_price = $sp->offerprice ;
                $cart->semi_total = $sp->offerprice * $c['quantity'];
                $cart->qty = $c['quantity'];
                $cart->user_id = auth()->id();
                $cart->save();

            }
        }

        if (session()->has('coupanapplied')) {

            $cpn = Coupan::firstWhere('code', '=', session()->get('coupanapplied')['code']);

            if (isset($cpn)) {

                $applycoupan = new CouponApplyController;

                if (session()->get('coupanapplied')['appliedOn'] == 'category') {
                    $applycoupan->validCouponForCategory($cpn);
                }

                if (session()->get('coupanapplied')['appliedOn'] == 'cart') {
                    $applycoupan->validCouponForCart($cpn);
                }

                if (session()->get('coupanapplied')['appliedOn'] == 'product') {
                    $applycoupan->validCouponForProduct($cpn);
                }

                Session::forget('coupanapplied');
            }

        }

        //Clearing the guest cart
        Session::forget('cart');
        Session::forget('guest_cart');
        Session::forget('guest_cart_count');

    }
}
