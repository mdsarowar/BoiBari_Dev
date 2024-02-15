<?php

namespace App\Http\Controllers\Auth;

use App\Affilate;
use App\Cart;
use App\Coupan;
use App\Genral;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponApplyController;
use App\Product;
use App\SimpleProduct;
use App\User;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class RegisterController extends Controller
{

    private $setting;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->setting = Genral::first();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
//        return $request;

       
        if ($this->setting->captcha_enable == 1) {
//            return $request;
            $request->validate([
                'name' => 'required|string|max:255',
//                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                // 'phonecode' => 'required|numeric',
                'mobile' => 'numeric|unique:users,mobile',
                'eula' => 'required',
                'g-recaptcha-response' => ['required', new CaptchaRule],
            ], [
                'g-recaptcha-response.required' => __('Please check the captcha !'),
                'mobile.unique' => __('Mobile no. is already taken !'),
                'mobile.numeric' => __('Mobile no should be numeric !'),
                'eula.required' => __('Please accept terms and condition !'),
//                'phonecode' => __('Phonecode is required'),
            ]
            );

        } else {
//            return $request;
            
            $request->validate([

                'name' => 'required|string|max:255',
//                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'mobile' => 'numeric|unique:users,mobile',
                'eula' => 'required',
                // 'phonecode' => 'required|numeric',
            ], [
                'mobile.unique' => __('Mobile no. is already taken !'),
                'mobile.numeric' => __('Mobile no should be numeric !'),
                'eula.required' => __('Please accept terms and condition !'),
                'phonecode' => __('Phonecode is required'),
            ]);
//            return $request;


        }
//        return $request;
   
        $af_system = Affilate::first();

        if ($af_system && $af_system->enable_affilate == '1') {

            $findreferal = User::firstWhere('refer_code', $request->refer_code);

            if (!$findreferal) {

                return back()->withInput()->withErrors([
                    'refercode' => __('Refer code is invalid !'),
                ]);

            }

        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'type' => $request['type'],
            'phonecode' => $request['phonecode'],
            'password' => Hash::make($request['password']),
            'email_verified_at' => $this->setting->email_verify_enable == '1' ? null : Carbon::now(),
            'is_verified' => 1,
            'refered_from' => $af_system && $af_system->enable_affilate == '1' ? $request['refer_code'] : null,
        ]);
//        return $user;

        $user->assignRole('Customer');

        if ($af_system && $af_system->enable_affilate == '1') {

            $findreferal->getReferals()->create([
                'log' => 'Refer successfull',
                'refer_user_id' => $user->id,
                'user_id' => $findreferal->id,
                'amount' => $af_system->refer_amount,
                'procces' => $af_system->enable_purchase == 1 ? 0 : 1,
            ]);

            if ($af_system->enable_purchase == 0) {

                if (!$findreferal->wallet) {

                    $w = $findreferal->wallet()->create([
                        'balance' => $af_system->refer_amount,
                        'status' => '1',
                    ]);

                    $w->wallethistory()->create([
                        'type' => 'Credit',
                        'log' => 'Referal bonus',
                        'amount' => $af_system->refer_amount,
                        'txn_id' => str_random(8),
                        'expire_at' => date("Y-m-d", strtotime(date('Y-m-d') . '+365 days')),
                    ]);

                }

                if (isset($findreferal->wallet) && $findreferal->wallet->status == 1) {

                    $findreferal->wallet()->update([
                        'balance' => $findreferal->wallet->balance + $af_system->refer_amount,
                    ]);

                    $findreferal->wallet->wallethistory()->create([
                        'type' => 'Credit',
                        'log' => 'Referal bonus',
                        'amount' => $af_system->refer_amount,
                        'txn_id' => str_random(8),
                        'expire_at' => date("Y-m-d", strtotime(date('Y-m-d') . '+365 days')),
                    ]);

                }

            }

        }
        /*Check if user has item in his cart*/


        if ($this->setting->email_verify_enable == '1') {

            $user->sendEmailVerificationNotification();

        }
//        return auth()->id();
        Auth::login($user);

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



        if (!empty(Session::get('cart'))) {
//            return auth()->id();
            $SessionCart = Session::get('cart');

            foreach ($SessionCart as $c) {

                $sp = SimpleProduct::where('id',$c['id'])->first();

                if (isset($sp)) {

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
                }
            }

//            session()->forget('guest_cart');
//            session()->forget('guest_cart_count');
//            return redirect('cart');
            session()->forget('cart');
        }

        return redirect('/');

    }

}