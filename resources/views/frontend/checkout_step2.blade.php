@extends("frontend.layout.master")
@section('title','Emart | Checkout')
@section("content")   
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Checkout')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/checkout/breadcrumb.png');">
                    <div class="breadcrumb-nav">
                        <h3 class="breadcrumb-title">{{__('Checkout')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

    <!-- Checkout Start -->
    <section id="checkout" class="checkout-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="accordion" id="accordionExample">

                        <div class="checkout-login checkout-block accordion-item">
                            <div class="accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">A. @guest <span>1</span> {{ __('Login') }} @else {{ __('Logged In') }} @endguest</h3>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="social-login-block">
                                            @auth
                                            <p>
                                                <b>
                                                    <div class="verified-icon">
                                                    <i data-feather="check-circle"></i>
                                                    </div>
                                                    {{ Auth::user()->name }}
                                                </b> 
                                            </p>
                                            <p>
                                                <div class="verified-icon">
                                                    <i data-feather="check-circle"></i>
                                                </div>
                                                {{ Auth::user()->mobile }}
                                            </p>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-block accordion-item">
                            <div class="checkout-address accordion-header">
                                <h3 class="section-title accordion-button" type="button" aria-expanded="true" aria-controls="collapseThree">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="{{ url('checkout') }}">
                                            B. Shipping Address
                                            </a>
                                        </div>
                                    </div>
                                </h3>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <div class="checkout-block accordion-item">
                            <div class="checkout-shipping-method accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">{{__('C.')}} {{__('Billing Information')}}</h3>
                                <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- <label class="address-checkbox mb-30" onchange="sameship()" id="sameasship">{{__('Billing address is same as Shipping address ?')}}
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label> -->
                                        <form class="py-30" id="billingForm" action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                            <input type="hidden" id="shipval" name="sameship" value="1">
                                                
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-30">
                                                        <label for="firstname" class="form-label">{{ __('Name') }} <span class="required">*</span></label>
                                                        <input type="text" class="form-control" id="billing_name" name="billing_name" value="{{Auth::user()?Auth::user()->name:''}}" placeholder="{{ __('Please Enter Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-30">
                                                        <label for="lastname" class="form-label">{{ __('Email') }} <span class="required">*</span></label>
                                                        <input type="text" class="form-control" id="billing_email" name="billing_email" value="{{Auth::user()?Auth::user()->email:''}}" placeholder="{{ __('Please Enter Email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-30">
                                                        <label for="phonenumber" class="form-label">{{ __('Contact No.') }}<span class="required">*</span></label>
                                                        <input type="tel" class="form-control" id="billing_mobile" name="billing_mobile" value="{{Auth::user()?Auth::user()->mobile:''}}" placeholder="{{ __('Please Enter Mobile Number') }}">
                                                    </div>
                                                </div>
{{--                                                @if ($pincodesystem == 1)--}}
{{--                                                <div class="col-lg-6 col-md-6">--}}
{{--                                                    <div class="mb-30">--}}
{{--                                                        <label for="mailaddress" class="form-label">{{ __('Pincode') }}<span class="required">*</span></label>--}}
{{--                                                        <input type="email" class="form-control" id="billing_pincode" name="billing_pincode" placeholder="{{ __('Please Enter first 3 digit of pincode') }}...">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                @endif--}}
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-30">
                                                        <label for="message" class="form-label">{{ __('Address') }} <span class="required">*</span></label>
                                                        <textarea class="form-control" id="billing_address" name="billing_address" placeholder="{{ __('542 W. 15th Street') }}" rows="1" required></textarea>
                                                    </div>
                                                </div>
{{--                                                <div class="col-lg-6 col-md-6">--}}
{{--                                                    <div class="mb-30">--}}
{{--                                                        <label class="font-weight-bold" class="font-weight-normal">{{ __('Country') }} <span class="required">*</span></label>--}}
{{--                                                        <select data-placeholder="{{ __("Please select country") }}" name="country_id" class="form-control select2" id="country_id">--}}
{{--                                                    --}}
{{--                                                        <option value="">{{ __("Please Choose") }}</option>--}}
{{--                                                        @foreach($all_country as $c)--}}
{{--                                                                --}}
{{--                                                            <option value="{{$c->id}}" >--}}
{{--                                                            {{$c->name}}--}}
{{--                                                            </option>--}}
{{--                                            --}}
{{--                                                        @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-6 col-md-6">--}}
{{--                                                    <div class="mb-30">--}}
{{--                                                        <label class="font-weight-bold" class="font-weight-normal">{{ __('State') }} <span class="required"></span></label>--}}
{{--                                                        <select data-placeholder="Please select state" required name="state_id" class="form-control select2" id="upload_id">--}}
{{--                                                        <option value="">{{ __("Please choose") }}</option>--}}
{{--                                                        --}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-6 col-md-6">--}}
{{--                                                    <div class="mb-30">--}}
{{--                                                        <label class="font-weight-bold" class="font-weight-normal">{{ __('City') }} <span class="required">*</span></label>--}}
{{--                                                        <select data-placeholder="{{ __("Please select city") }}" name="city_id" id="city_id" class="form-control select2">--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                
                                                    
                                                <input type="submit" class="btn btn-primary" value="Continue">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-block accordion-item">
                            <div class="checkout-shipping-method accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">{{__('D. Order Review')}}</h3>
                            </div>
                        </div>

                        <div class="checkout-block accordion-item">
                            <div class="checkout-shipping-method accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">{{__('E. Payment Info')}}</h3>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="cart-block">
                        <h4 class="section-title">{{__('Payment Details')}}</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 70%;">{{__('Subtotal')}}</td>
                                    <td><i class="{{session()->get('currency')['value']}}"></i> {{price_format($total*1,2)}}</td>
                                </tr>
                                @if(Session::get('gift'))
                                <tr>
                                    <td style="width: 70%;">{{ __('Gift Discount') }}</td>
                                    <td class="wishlist-out-stock"><i class="{{session()->get('currency')['value']}}"></i> {{Session::get('gift')['discount']}}</td>
                                </tr>
                                @endif
                                @if(Auth::check() && App\Cart::isCoupanApplied() == 1)
                                <tr>
                                    <td style="width: 70%;">{{ __('Discount') }}</td>
                                    <td class="wishlist-out-stock"><i class="{{session()->get('currency')['value']}}"></i> {{price_format(App\Cart::getDiscount()*1,2)}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <table class="table total-amount-table">
                            <tbody>
                                <tr>
                                    <td style="width: 70%;">{{ __('Total') }}</td>
                                    <td>
                                        <i class="{{session()->get('currency')['value']}}"></i>
                                        @if(!App\Cart::isCoupanApplied() == 1)
                                            @if(Session::get('gift'))
                                                {{price_format($grandtotal*1,2) - Session::get('gift')['discount']}}
                                            @else
                                                {{price_format($grandtotal*1,2)}}
                                            @endif
                                        @else
                                            @if(Session::get('gift'))
                                                {{price_format(($grandtotal-App\Cart::getDiscount())*1,2) - Session::get('gift')['discount']}}
                                            @else
                                                {{price_format(($grandtotal-App\Cart::getDiscount())*1,2)}}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Checkout End -->

@endsection

@section('script')
  <script>var baseUrl = "<?= url('/') ?>";</script>
  <script src="{{ url('js/orderpincode.js') }}"></script>
  <script>var baseUrl = "<?= url('/') ?>";</script>
 <script src="{{ url('js/ajaxlocationlist.js') }}"></script>

 <script>
$('#country_id').on('change', function () {
  var up = $('#upload_id').empty();
  var up1 = $('#city_id').empty();
  var cat_id = $(this).val();

  if (cat_id) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      url: baseUrl + '/choose_state',
      data: {
        catId: cat_id
      },
      success: function (data) {
        $('#country_id').append('<option value="">Please Choose</option>');
        up.append('<option value="">Please Choose</option>');
        up1.append('<option value="">Please Choose</option>');
        $.each(data, function (id, title) {
          up.append($('<option>', {
            value: id,
            text: title
          }));
        });
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
      }
    });
  }
});



$('#upload_id').on('change', function () {


  var up = $('#city_id').empty();
  var cat_id = $(this).val();
  if (cat_id) {

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      url: baseUrl + '/choose_city',
      data: {
        catId: cat_id
      },
      success: function (data) {

        up.append('<option value="0">Please Choose</option>');
        $.each(data, function (id, title) {
          up.append($('<option>', {
            value: id,
            text: title
          }));
        });
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
      }
    });
  }
});
    </script>
@endsection