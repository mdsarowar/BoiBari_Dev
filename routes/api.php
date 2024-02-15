<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your cart/totalAPI!
|
 */

/** Single Homepage API */

Route::get('homepage', 'Api\MainController@homepage');
Route::get('bestseller', 'Api\MainController@bestseller');
Route::get('get/tabbed/products/{catid}', 'Api\MainController@categoryproducts');

Route::get('demo-json', 'Api\MainController@demo_json');


/** Fetch current time */
Route::get('/fetch/time',function(){
    return response()->json(now()->format('Y-m-d h:i:s'));
});

/** Change Currency API */

Route::get('/change-currency', 'Api\CurrencyController@changeCurrency');

/** Login register and logout with refresh token api */

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('custom-login', 'Api\Auth\LoginController@custom_login');
Route::post('social-login', 'Api\Auth\LoginController@socialLogin');
Route::post('register', 'Api\Auth\RegisterController@register');

/* Guest Cart */

Route::post('guestcart/list', 'Api\CartController@guestCart');

/** Three level Categories with product without products api */
Route::get('categories', 'Api\MainController@categories');
Route::get('subcategories', 'Api\MainController@subcategories');
Route::get('childcategories', 'Api\MainController@childcategories');
Route::get('category/{id}', 'Api\MainController@getcategoryproduct');
Route::get('subcategory/{id}', 'Api\MainController@getsubcategoryproduct');
Route::get('childcategory/{id}', 'Api\MainController@getchildcategoryproduct');

/** Offer,Hotdeals,Sliders,brands,Page api */
Route::get('/brands', 'Api\MainController@brands');
Route::get('/brands/{id}/products', 'Api\BrandController@getBrandProducts');
Route::get('/page/{slug}', 'Api\MainController@page');

/** Menus API */
Route::get('topmenus', 'Api\MainController@menus');
Route::get('footermenus', 'Api\MainController@footermenus');

/** Genreal FAQs Apis */
Route::get('faqs', 'Api\MainController@faqs');

/* Blogs APIs*/
Route::get('/blog/post/{slug}', 'Api\MainController@blogdetail');

/** Get Language list */
Route::get('/languages', 'Api\MainController@listLanguages');

/** Term & Conditions */
Route::get('/get/{page}', 'Api\MainController@getTermPages');

Route::get('offer/popup', 'Api\MainController@offer_popup');

Route::get('top/menu', 'Api\MainController@top_menus');

Route::get('footer/menu', 'Api\MainController@footer_menus');

Route::get('category', 'Api\MainController@category');   

Route::get('sub/category/{id}', 'Api\MainController@sub_category');  

Route::get('header/offer/banner', 'Api\MainController@header_offer_banner');   
/** User Profile APIs */


Route::get('mywallet', 'Api\MainController@mywallet');

Route::middleware('auth:api')->group(function () {

    /** Logout and refresh tokens */

    Route::post('logout', 'Api\Auth\LoginController@logout');
    Route::post('refresh', 'Api\Auth\LoginController@refresh');

    Route::get('myprofile', 'Api\MainController@userprofile');
    Route::get('mywallet', 'Api\MainController@mywallet');

    Route::post('add/money', 'Api\MainController@addMoneyInWallet');

    Route::get('bank/details', 'Api\MainController@bank_details');
    Route::post('add/bank/detail', 'Api\MainController@add_bank_detail');
    Route::post('update/bank/detail/{id}', 'Api\MainController@update_bank_detail');
    Route::delete('delete/bank/detail/{id}', 'Api\MainController@delete_bank_detail');

    Route::get('check/pincode', 'Api\MainController@check_pincode');

    Route::post('help-desk/support', 'Api\MainController@help_support');

    Route::post('update/profile', 'Api\MainController@update_profile');

    Route::post('/track/order','Api\MainController@track_order')->name('track.order.result');
    
    Route::get('fail/orders', 'Api\MainController@fail_orders');

    Route::get('affiliate', 'Api\MainController@affiliate');

    Route::get('user/ticket', 'Api\MainController@get_ticket_by_user');

    Route::get('all/tickets', 'Api\MainController@get_all_ticket');

    Route::get('user/review', 'Api\MainController@user_review');    

    Route::get('user/notification', 'Api\MainController@user_notification');   

    Route::get('hotdeal', 'Api\MainController@mobile_hotdeal');   
    
    Route::get('manageaddress', 'Api\MainController@getuseraddress');
    Route::post('create-address', 'Api\MainController@createaddress');

    Route::get('billing-address', 'Api\MainController@listbillingaddress');
    Route::post('create-billing-address', 'Api\MainController@createbillingaddress');

    Route::get('mybanks', 'Api\MainController@getuserbanks');
    Route::get('my-reviews','Api\MainController@myReviews');
    Route::get('/reviews/{productid}/{type}', 'Api\ProductController@allreviews')->name('allreviews');

    Route::get('notifications', 'Api\MainController@myNotifications');

    /**Cart API's */
    Route::get('cart', 'Api\CartController@yourCart');
    Route::post('addtocart', 'Api\CartController@addToCart');
    Route::post('guestcart/add', 'Api\CartController@guestCartStore');
    Route::post('remove/cart/item', 'Api\CartController@cartItemRemove');
    Route::post('clear-cart', 'Api\CartController@clearCart');
    Route::post('increase-quantity/in/cart', 'Api\CartController@increaseQuantity');

    /** Wishlist Collection & Wishlist */
    Route::get('wishlist', 'Api\ProductController@wishlist');
    Route::post('wishlist/remove/{wishlistid}', 'Api\ProductController@removeitemfromWishlist');

    Route::get('wishlist/collection', 'Api\WishlistController@listCollection');
    Route::get('wishlist/collection/{id}', 'Api\WishlistController@listCollectionItemsByID');
    Route::post('wishlist/create-collection', 'Api\WishlistController@createCollection');

    /** Apply Coupans */
    Route::post('/apply-coupans', 'Api\CoupanApplyController@apply');
    Route::post('/remove-coupan', 'Api\CoupanApplyController@removeCoupan');

    /** Pincode fetch with address for logged in user */
    Route::get('/search/pincode/auth/', 'Api\MainController@fetchPinCodeAddressForAuthUser');

    /** Order Review  */

    Route::post('/order-review', 'Api\OrderController@orderReview');

    /* Comments*/
    Route::get('/comments/{productid}/{type}', 'Api\CommentController@allproductcomment');

    /** Local Pickup apply and remove */
    Route::post('/localpickup/apply', 'Api\OrderController@localpickupapply');
    Route::post('/localpickup/remove', 'Api\OrderController@localpickupremove');

    Route::post('/rpay/paymentid', 'Api\PaymentController@getPaymentID');
    Route::post('/paytm/checksum/create', 'Api\PaymentController@createPaytmCheckSum');

    /** Confirm Order API */
    Route::post('/confirm/order', 'Api\PaymentController@confirmOrder');

    /** Orders API */
    Route::get('/orders','Api\OrderController@listOrders');
    Route::get('/orders/{orderid}','Api\OrderController@viewOrder');

});

/** Add Item in wishlist */

Route::post('wishlist/add/{variantid}', 'Api\ProductController@additeminWishlist');

/** Product detail page */

Route::get('/details/{productid}/{variantid}/{type}', 'Api\ProductController@detailProduct');

/* Delivery Location API*/
Route::get('/delivery-check', 'Api\ProductController@checkPincode');

/** General Configuration */
Route::get('/configs', 'Api\ConfigController@getConfigs');

/** Payment Methods */
Route::get('/payment-list', 'Api\ConfigController@getPaymentMethods');

/** List of coutries , states, cities */
Route::get('/countries', 'Api\MainController@listofcountries');
Route::get('/states/{countryid}', 'Api\MainController@listofstates');
Route::get('/city/{stateid}', 'Api\MainController@listofcities');

/** Search Cities */
Route::get('/search/city/', 'Api\MainController@searchcity');

/** Pincode fetch with address for guest user */
Route::get('/search/pincode/guest/', 'Api\MainController@fetchPinCodeAddressForGuest');
Route::get('/check-for-update', 'OtaUpdateController@checkforupate');
Route::post('/verify/add-on', 'AddOnManagerController@verifycode');

/** Flashdeal api */
Route::get('/view/all/flashdeals','Api\FlashdealController@getalldeals');
Route::get('/view/deal/{id}','Api\FlashdealController@viewdeal');