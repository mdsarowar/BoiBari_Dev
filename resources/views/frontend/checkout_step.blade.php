@extends("frontend.layout.master")
@section('title','BoiBari | Checkout')
@section("content")   
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<div style="background-color: #fff8f5">
    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container bg-white">
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
    @php

        \Session::forget('from-order-review-page');
        \Session::forget('from-pay-page');
        \Session::forget('re-verify');
        \Session::forget('indiantax');

        $per_shipping = 0;
        $tax_amount = 0;
        $total_tax_amount = 0;
        $total_shipping = 0;
        $total = 0;
        $pro = Session('pro_qty');

        $stock= session('stock');
        $after_tax_amount = 0;
        $count = $cart_table->count();

    @endphp
            <!-- Checkout Start -->
    <section id="checkout" class="checkout-main-block">
        <div class="container bg-white">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="accordion" id="accordionExample">

                        <div class="checkout-login checkout-block accordion-item">
                            <div class="accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">A. @guest <span>1</span> {{ __('Login') }} @else {{ __('Logged In') }} @endguest</h3>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="social-login-block">
                                            @auth
                                                <p>
                                                <div class="verified-icon">
                                                    <i data-feather="check-circle"></i>
                                                    <b>{{ Auth::user()->name }}</b>
                                                </div>

                                                </p>
                                                <p>
                                                <div class="verified-icon">
                                                    <i data-feather="check-circle"></i>
                                                    {{ Auth::user()->mobile }}
                                                </div>

                                                </p>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-block accordion-item">
                            <div class="checkout-address accordion-header">
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            B. {{__('Shipping Address')}}
                                        </div>
                                    </div>
                                </h3>
                                <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="py-30">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="view-all-btn">
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i data-feather="plus"></i>{{__('Add New Address')}}</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="row mt-4">
                                                    @if(isset($addresses))
                                                        @foreach($addresses as $key => $address)
                                                            {{--                    @php--}}
                                                            {{--                    $c  = App\Allcountry::where('id',$address->country_id)->first()->nicename;--}}
                                                            {{--                    $s  = App\Allstate::where('id',$address->state_id)->first()->name;--}}
                                                            {{--                    $ci = App\Allcity::where('id',$address->city_id)->first() ? App\Allcity::where('id',$address->city_id)->first()->name : '';--}}
                                                            {{--                    @endphp--}}

                                                            <table class="table manage-address-block ">
                                                                {{--                      <thead>--}}
                                                                {{--                      <tr class="fw-bold">--}}
                                                                {{--                        <td>Name & Phone</td>--}}
                                                                {{--                        <td>Address</td>--}}
                                                                {{--                        <td>Action</td>--}}
                                                                {{--                      </tr>--}}
                                                                {{--                      </thead>--}}
                                                                <tbody>
                                                                {{--                      @if(count($addresss)>0)--}}
                                                                {{--                        @foreach($addresss as $key => $address)--}}
                                                                <tr>
                                                                    <td style="width: 25%">
                                                                        <div class="{{ $address->defaddress == 1 ? "active" : "user-header" }}">
                                                                            <h6>{{$address->name}}, {{ $address->phone }}</h6>
                                                                            {{--                                                                            @if($address->defaddress == 1)--}}
                                                                            {{--                                                                                <div class="ribbon ribbon-top-right"><span>{{ __('Default') }}</span></div>--}}
                                                                            {{--                                                                            @endif--}}
                                                                        </div>
                                                                    </td>
                                                                    <td style="width: 60%">
                                                                        <p>{{ strip_tags($address->address) }}</p>
                                                                        <p>{{ $address->getDivisions->bn_name }} => {{ $address->getdistrict->bn_name }} => {{ $address->getupazila->bn_name }} => {{ $address->getunion->bn_name }}</p>
                                                                        {{--                            <p>{{ strip_tags($address->address) }}, {{ $ci }}, {{ $s }}, {{ $c }}@if (isset($address->pin_code)),({{ $address->pin_code }}) @endif</p>--}}
                                                                    </td>
                                                                    <td style="width: 15%">
                                                                        <div class="manage-add-btn">
                                                                            <button title="{{ __('Edit Address') }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $address->id }}" class="editlabel btn btn-sm btn-info">
                                                                                <i data-feather="edit"></i>
                                                                            </button>
                                                                            <button title="{{ __('Delete Address') }}" type="button" @if(env('DEMO_LOCK')==0) data-bs-toggle="modal" data-bs-target="#deletemodal{{ $address->id }}" @else disabled="" title="This action is disabled in demo !" @endif class="delbtn btn btn-danger btn-sm"><i data-feather="trash"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                {{--                        @endforeach--}}
                                                                </tbody>
                                                            </table>


                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="editModal{{ $address->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="p-2 modal-title" id="myModalLabel">{{ __('Edit Address') }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('address.update',$address->id) }}" role="form" method="POST">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-md-6 col-12">
                                                                                        <div class="mb-3">
                                                                                            <label class="font-weight-bold" class="font-weight-normal" for="name">{{ __('Name') }}:<span class="required">*</span></label>
                                                                                            <input required="" name="name" type="text" value="{{ $address->name }}" placeholder="{{ __('Name') }}" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{--                                <div class="col-lg-4 col-md-6 col-12">--}}
                                                                                    {{--                                  <div class="mb-3">--}}
                                                                                    {{--                                    <label class="font-weight-bold" class="font-weight-normal" for="email">{{ __('Email') }}: <span class="required">*</span></label>--}}
                                                                                    {{--                                    <input type="email" placeholder="Edit Email" class="form-control" name="{{ __('email') }}" value="{{ $address->email }}">--}}
                                                                                    {{--                                  </div>--}}
                                                                                    {{--                                </div>--}}
                                                                                    <div class="col-lg-4 col-md-6 col-12">
                                                                                        <div class="mb-3">
                                                                                            <label class="font-weight-bold" class="font-weight-normal" for="email">{{ __('PhoneNo') }}: <span class="required">*</span></label>
                                                                                            <input  type="text" placeholder="Edit Phone no" class="form-control" name="{{ __('phone') }}" value="{{ $address->phone }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    @include('frontend.edit_bdlocation')



                                                                                    {{--                                <div class="col-lg-4 col-md-6 col-12">--}}
                                                                                    {{--                                  <div class="mb-3">--}}
                                                                                    {{--                                    @if ($pincodesystem == 1)--}}
                                                                                    {{--                                    <label class="font-weight-bold" class="font-weight-normal">{{ __('Pincode') }}: <span class="required">*</span> </label>--}}
                                                                                    {{--                                    <input pattern="[0-9]+" required value="{{ $address->pin_code }}" onkeyup="pincodetry('{{ $address->id }}')" type="text" id="pincode{{ $address->id }}" class="form-control z-index99" name="pin_code">--}}
                                                                                    {{--                                    @endif--}}
                                                                                    {{--                                  </div>--}}
                                                                                    {{--                                </div>--}}
                                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                                        <div class="mb-3">
                                                                                            <label class="font-weight-bold" class="font-weight-normal">{{ __('Address') }}: <span class="required">*</span></label>
                                                                                            <textarea required="" name="address" id="address" cols="20" rows="5" class="form-control">{{ strip_tags($address->address) }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-6 col-12">
                                                                                    <div class="mb-3">
                                                                                        <div class="form-group checkout-personal-dtl">
                                                                                            <label class="address-checkbox">{{ __('Set Default Address') }}
                                                                                                <input {{ $address->defaddress == 1 ? "checked" : "" }} type="checkbox" name="setdef">
                                                                                                <span class="checkmark"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-6 col-12">
                                                                                    <button class="btn btn-primary"><i data-feather="save"></i>{{ __('Update') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade delete-modal" id="deletemodal{{ $address->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            <div class="delete-icon"></div>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <h5 class="modal-heading">{{ __('Are You Sure ?') }}</h5>
                                                                            <p>{{ __('Do you really want to delete this address? This process cannot be undone') }}.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form method="post" action="{{route('address.del',$address->id)}}" class="pull-right">
                                                                                {{csrf_field()}}
                                                                                {{method_field("DELETE")}}
                                                                                <button type="reset" class="btn btn-primary translate-y-3" data-bs-dismiss="modal">
                                                                                    {{ __('No') }}
                                                                                </button>
                                                                                <button type="submit" class="btn btn-danger">
                                                                                    {{ __('Yes') }}
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{--                                                        {{ $addresss->links() }}--}}
                                                    @else
                                                        <h2><a class="cursor" data-target="#mngaddress" data-toggle="modal">{{ __('No Address') }}</a></h2>
                                                    @endif
                                                </div>
                                            </div>

                                            <?php
                                            $biladd=\App\BillingAddress::where('user_id',auth()->id())->latest()->first();
                                            ?>
                                            <h4 class="text-success pb-2">Your Shipping Address store successfully => <span class="fs-6 text-info">{{ $biladd->getdivisions->bn_name }} => {{ $biladd->getdistrict->bn_name }} => {{ $biladd->getupazila->bn_name }} => {{ $biladd->getunion->bn_name }}</span></h4>

                                            <form action="{{route('choose.address')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="total" value="{{$total}}">

                                                @if(count($addresses))
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input " type="radio" name="seladd" checked="checked" value="{{ $addresses[0]->id }}" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{ $addresses[0]->getDivisions->bn_name }} => {{ $addresses[0]->getdistrict->bn_name }} => {{ $addresses[0]->getupazila->bn_name }} => {{ $addresses[0]->getunion->bn_name }}
                                                            {{--                                                            {{ $addresses[0]->getDivisions->bn_name }} => {{ $addresses[0]->getdistrict->bn_name }}--}}
                                                        </label>
                                                    </div>
                                                    @foreach($addresses as $key => $address)
                                                        @if($key > 0)
                                                            <div class="form-check">
                                                                <input class="form-check-input " type="radio" name="seladd"  value="{{ $address->id }}" id="flexRadioDefault{{$address->id}}">
                                                                <label class="form-check-label" for="flexRadioDefault{{$address->id}}">
                                                                    {{ $address->getDivisions->bn_name }} => {{ $address->getdistrict->bn_name }} => {{ $address->getupazila->bn_name }} => {{ $address->getunion->bn_name }}
                                                                </label>
                                                            </div>
                                                        @endif

                                                        {{--                                                        @if($address->defaddress == 1)--}}
                                                        {{--                                                        <div class="form-check">--}}
                                                        {{--                                                            <input class="form-check-input" type="radio" name="seladd" checked="checked" value="{{ $address->id }}" id="flexRadioDefault1">--}}
                                                        {{--                                                            <label class="form-check-label" for="flexRadioDefault1">--}}
                                                        {{--                                                                {{ $address->getDivisions->bn_name }} => {{ $address->getdistrict->bn_name }}--}}
                                                        {{--                                                            </label>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                        @else--}}
                                                        {{--                                                            @if(a) @endif--}}
                                                        {{--                                                            <div class="form-check">--}}
                                                        {{--                                                                <input class="form-check-input" type="radio" name="seladd"  value="{{ $address->id }}" id="flexRadioDefault1">--}}
                                                        {{--                                                                <label class="form-check-label" for="flexRadioDefault1">--}}
                                                        {{--                                                                    {{ $address->getDivisions->bn_name }} => {{ $address->getdistrict->bn_name }}--}}
                                                        {{--                                                                </label>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        @endif--}}
                                                    @endforeach
                                                @else
                                                    <h3>{{ __('No Address') }}</h3>
                                                @endif
                                                <input type="hidden" name="shipping" value="{{ $shippingcharge }}">

                                                {{--                                                @if(Auth::user()->addresses->count()>0)--}}
                                                @if($addresses->count() == 0 )
                                                    <button type="submit" disabled class="btn btn-primary mt-3">{{ __('Deliver Here') }}</button>
                                                @else
                                                    <button type="submit" class="btn btn-primary  mt-3">{{ __('Deliver Here') }}</button>
                                                @endif
                                            </form>

                                            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="p-2 modal-title" id="myModalLabel">{{ __('Add Address') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('address.store') }}" role="form" method="POST">
                                                                @csrf

                                                                @php
                                                                    $ifadd = count(Auth::user()->addresses);
                                                                @endphp

                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-6 col-12">
                                                                        <div class="mb-3">
                                                                            <label class="font-weight-bold" class="font-weight-normal">{{ __('Name') }}:</label>
                                                                            <input required type="text" @if($ifadd<1) value="{{ Auth::user()->name }}" @else value="" @endif placeholder="{{ __('Enter name') }}" name="name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 col-12">
                                                                        <div class="mb-3">
                                                                            <label class="font-weight-bold" class="font-weight-normal">{{ __('Phone No') }}:</label>
                                                                            <input  required type="text" @if($ifadd<1) value="{{ Auth::user()->mobile }}" @else value="" @endif name="phone" placeholder="{{ __('Enter phone no') }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    @include('frontend.bdlocation')
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Divisionss') }} <span class="required">*</span></label>--}}
                                                                    {{--                                --}}{{--                                <select data-placeholder="{{ __("Please select country") }}" name="country_id" id="city_id" class="form-control select2">--}}
                                                                    {{--                                <select data-placeholder="{{ __("Please select Division") }}" name="division_id" id="division_id" class="form-control select2">--}}

                                                                    {{--                                  <option value="">{{ __("Please Choosess") }}</option>--}}
                                                                    {{--                                  @foreach($divisions as $div_id)--}}

                                                                    {{--                                    <option value="{{$div_id->id}}" >--}}
                                                                    {{--                                      {{$div_id->bn_name}}--}}
                                                                    {{--                                    </option>--}}

                                                                    {{--                                  @endforeach--}}
                                                                    {{--                                </select>--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('District') }} <span class="required"></span></label>--}}
                                                                    {{--                                <select data-placeholder="Please select state" required name="district_id" class="form-control select2" id="district_id">--}}
                                                                    {{--                                  --}}{{--                                  <option value="">{{ __("Please choose") }}</option>--}}

                                                                    {{--                                </select>--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Upazila') }} <span class="required"></span></label>--}}
                                                                    {{--                                <select data-placeholder="Please select state" required name="upazila_id" class="form-control select2" id="upazila_id">--}}
                                                                    {{--                                  --}}{{--                                  <option value="">{{ __("Please choose") }}</option>--}}

                                                                    {{--                                </select>--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Union') }} <span class="required"></span></label>--}}
                                                                    {{--                                <select data-placeholder="Please select state" required name="union_id" class="form-control select2" id="union_id">--}}
                                                                    {{--                                  --}}{{--                                  <option value="">{{ __("Please choose") }}</option>--}}

                                                                    {{--                                </select>--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Email') }}:</label>--}}
                                                                    {{--                                <input required type="email" value="{{ Auth::user()->email }}" name="email" placeholder="{{ __('Enter email') }}" class="form-control">--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        <div class="mb-3">
                                                                            <label class="font-weight-bold" class="font-weight-normal">{{ __('Address') }}: </label>
                                                                            <textarea required name="address" id="address" cols="20" rows="5" class="form-control">{{ old('address') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Country') }} <span class="required">*</span></label>--}}
                                                                    {{--                                <select data-placeholder="{{ __("Please select country") }}" name="country_id" class="form-control select2" id="country_id">--}}
                                                                    {{--                              --}}
                                                                    {{--                                  <option value="">{{ __("Please Choose") }}</option>--}}
                                                                    {{--                                  @foreach($country as $c)--}}
                                                                    {{--                                        --}}
                                                                    {{--                                    <option value="{{$c->id}}" >--}}
                                                                    {{--                                      {{$c->name}}--}}
                                                                    {{--                                    </option>--}}
                                                                    {{--                    --}}
                                                                    {{--                                  @endforeach--}}
                                                                    {{--                                </select>--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}
                                                                    {{--                            <div class="col-lg-4 col-md-6 col-12">--}}
                                                                    {{--                              <div class="mb-3">--}}
                                                                    {{--                                @if($pincodesystem == 1)--}}
                                                                    {{--                                <label class="font-weight-bold" class="font-weight-normal">{{ __('Zipcode') }}/--}}
                                                                    {{--                                  {{ __('Pincode') }}: <span class="required">*</span> </label>--}}
                                                                    {{--                                <input pattern="[0-9]+" value="{{ old('pin_code') }}" placeholder="{{ __('Enter pin code') }}" type="text"--}}
                                                                    {{--                                  id="pincode" class="form-control z-index99" name="pin_code">--}}
                                                                    {{--                                <br>--}}
                                                                    {{--                                @endif--}}
                                                                    {{--                              </div>--}}
                                                                    {{--                            </div>--}}

                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        <div class="mb-3">
                                                                            <div class="form-group checkout-personal-dtl">
                                                                                <label class="address-checkbox">{{ __('Set Default Address') }}
                                                                                    <input type="checkbox" name="setdef">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        <button class="btn btn-primary"><i data-feather="save"></i>{{ __('Submit') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="checkout-block accordion-item">
                            <div class="checkout-payment-info accordion-header">
                                {{--                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">A. @guest <span>1</span> {{ __('Login') }} @else {{ __('Logged In') }} @endguest</h3>--}}
                                {{--                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">--}}
                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">E. Payment Info</h3>
                                <div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    @php

                                        $config = $configs;

                                        $checkoutsetting_check = App\AutoDetectGeo::first();

                                        $listcheckOutCurrency =
                                        App\CurrencyCheckout::where('currency','=',Session::get('currency')['id'])->first();


                                        $secure_amount = 0;
                                        $handlingcharge = 0;
                                        $giftDiscount = Session::get('gift') ?  Session::get('gift')['discount'] :0;


                                        // Calulate handling charge
                                        if($genrals_settings->chargeterm == 'fo'){
                                        // on full order handling charge
                                        $handlingcharge = $genrals_settings->handlingcharge;
                                        }elseif($genrals_settings->chargeterm == 'pi'){
                                        // Per item handling charge
                                        $totalcartitem = count($cart_table);
                                        $handlingcharge = $genrals_settings->handlingcharge*$totalcartitem;
                                        }



                                        //end

                                        foreach ($cart_table as $key => $val) {
                                        if($val->active_cart == 1){
                                        if($val->product && $val->variant){
                                        if ($val->product->tax_r != null && $val->product->tax == 0) {

                                            if ($val->ori_offer_price != 0) {
                                                //get per product tax amount
                                                $p = 100;
                                                $taxrate_db = $val->product->tax_r;
                                                $vp = $p + $taxrate_db;
                                                $taxAmnt = intval($val->product->offer_price) / intval($vp) * intval($taxrate_db);
                                                $taxAmnt = sprintf("%.2f", $taxAmnt);
                                                $price = ($val->ori_offer_price - $taxAmnt) * $val->qty;

                                            } else {

                                                $p = 100;
                                                $taxrate_db = $val->product->tax_r;
                                                $vp = $p + $taxrate_db;
                                                $taxAmnt = $val->product->price / $vp * $taxrate_db;

                                                $taxAmnt = sprintf("%.2f", $taxAmnt);

                                                $price = ($val->ori_price - $taxAmnt) * $val->qty;

                                            }

                                            } else {

                                                if ($val->semi_total != 0) {

                                                    $price = $val->semi_total;

                                                } else {

                                                    $price = $val->price_total;

                                                }
                                            }
                                        }else{

                                            if ($val->semi_total != 0) {

                                            $price = $val->semi_total - $val->tax_amount;

                                            } else {

                                            $price = $val->price_total - $val->tax_amount;



                                            }

                                        }


                                        $secure_amount = $secure_amount + $price ;

                                        }

                                        }

                                        if(Session::get('gift')){
                                        $secure_amount = ($secure_amount*$conversion_rate - Session::get('gift')['discount']);
                                        }else{
                                        $secure_amount = $secure_amount*$conversion_rate;
                                        }

                                        $secure_amount = sprintf("%.2f",$secure_amount);

                                        $un_sec = $secure_amount;

                                        $handlingcharge = $handlingcharge*$conversion_rate;

                                        $total_gift_pkg_charge = sprintf("%.2f",auth()->user()->cart()->sum('gift_pkg_charge') * $conversion_rate);

                                        $secure_amount += ($total_shipping*$conversion_rate)+$total_gift_pkg_charge+$total_tax_amount+$handlingcharge;



                                        if(App\Cart::isCoupanApplied() == '1'){
                                        $secure_amount = $secure_amount-(App\Cart::getDiscount()*$conversion_rate);
                                        }


                                        $secure_amount = Crypt::encrypt($secure_amount + $shippingChage ?? $shippingChage);
                                        $handlingchargeS = Crypt::encrypt($handlingcharge);
                                        Session::put('handlingcharge',$handlingchargeS);


                                    @endphp
                                    <div class="accordion-body popular-item-main-block">
                                        <div class="py-30">
                                            <div class="row mb-30">
                                                <div class="col-lg-4">
                                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        @if($config->paypal_enable == '1')
                                                            <a class="nav-link active" id="v-pills-paypalpaytab-tab" data-bs-toggle="pill" href="#v-pills-paypalpaytab" type="button" role="tab" aria-controls="v-pills-paypalpaytab" aria-selected="true" onclick=handlingcharge(this.id)>{{__('Pay Via Paypal')}}</a>
                                                        @endif
                                                        @if($wallet_system == 1)
                                                            <a class="nav-link" id="v-pills-wallet-tab" data-bs-toggle="pill" href="#v-pills-wallet" type="button" role="tab" aria-controls="v-pills-wallet" aria-selected="false">{{__('Pay Via Wallet')}}</a>
                                                        @endif
                                                        @if($config->braintree_enable == '1')
                                                            <a class="nav-link" id="v-pills-braintree-tab" data-bs-toggle="pill" href="#v-pills-braintree" type="button" role="tab" aria-controls="v-pills-braintree" aria-selected="false">{{__('Pay Via Braintree')}}</a>
                                                        @endif
                                                        @if($config->paystack_enable == '1')
                                                            <a class="nav-link" id="v-pills-paystack-tab" data-bs-toggle="pill" href="#v-pills-paystack" type="button" role="tab" aria-controls="v-pills-paystack" aria-selected="false">{{__('Pay Via Paystack')}}</a>
                                                        @endif
                                                        @if($config->instamojo_enable == '1')
                                                            <a class="nav-link" id="v-pills-instamojo-tab" data-bs-toggle="pill" href="#v-pills-instamojo" type="button" role="tab" aria-controls="v-pills-instamojo" aria-selected="false">{{__('Pay Via Instamojo')}}</a>
                                                        @endif
                                                        @if($config->stripe_enable == '1')
                                                            <a class="nav-link" id="v-pills-stripe-tab" data-bs-toggle="pill" href="#v-pills-stripe" type="button" role="tab" aria-controls="v-pills-stripe" aria-selected="false">{{__('Pay Via Stripe')}}</a>
                                                        @endif
                                                        @if($config->payu_enable == '1')
                                                            <a class="nav-link" id="v-pills-payu-tab" data-bs-toggle="pill" href="#v-pills-payu" type="button" role="tab" aria-controls="v-pills-payu" aria-selected="false">{{__('Pay Via PayUBiz / Money')}}</a>
                                                        @endif
                                                        @if($config->paytm_enable == '1')
                                                            <a class="nav-link" id="v-pills-paytam-tab" data-bs-toggle="pill" href="#v-pills-paytam" type="button" role="tab" aria-controls="v-pills-paytam" aria-selected="false">{{__('Pay Via Paytam')}}</a>
                                                        @endif
                                                        @if($config->razorpay == '1')
                                                            <a class="nav-link" id="v-pills-razorpay-tab" data-bs-toggle="pill" href="#v-pills-razorpay" type="button" role="tab" aria-controls="v-pills-razorpay" aria-selected="false">{{__('Pay Via Razorpay')}}</a>
                                                        @endif
                                                        @if($config->payhere_enable == '1')
                                                            <a class="nav-link" id="v-pills-payhere-tab" data-bs-toggle="pill" href="#v-pills-payhere" type="button" role="tab" aria-controls="v-pills-payhere" aria-selected="false">{{__('Pay Via Payhere')}}</a>
                                                        @endif
                                                        @if($config->cashfree_enable == '1')
                                                            <a class="nav-link" id="v-pills-cashfree-tab" data-bs-toggle="pill" href="#v-pills-cashfree" type="button" role="tab" aria-controls="v-pills-cashfree" aria-selected="false">{{__('Pay Via Cashfree')}}</a>
                                                        @endif
                                                        @if($config->omise_enable == '1')
                                                            <a class="nav-link" id="v-pills-omise-tab" data-bs-toggle="pill" href="#v-pills-omise" type="button" role="tab" aria-controls="v-pills-omise" aria-selected="false">{{__('Pay Via Omise')}}</a>
                                                        @endif
                                                        @if($config->rave_enable == '1')
                                                            <a class="nav-link" id="v-pills-rave-tab" data-bs-toggle="pill" href="#v-pills-rave" type="button" role="tab" aria-controls="v-pills-rave" aria-selected="false">{{__('Pay Via Rave')}}</a>
                                                        @endif
                                                        @if($config->moli_enable == '1')
                                                            <a class="nav-link" id="v-pills-moli-tab" data-bs-toggle="pill" href="#v-pills-moli" type="button" role="tab" aria-controls="v-pills-moli" aria-selected="false">{{__('Pay Via Mollie')}}</a>
                                                        @endif
                                                        @if($config->skrill_enable == '1')
                                                            <a class="nav-link" id="v-pills-skrill-tab" data-bs-toggle="pill" href="#v-pills-skrill" type="button" role="tab" aria-controls="v-pills-skrill" aria-selected="false">{{__('Pay Via Skrill')}}</a>
                                                        @endif
                                                        @if($config->sslcommerze_enable == '1')
{{--                                                            <a class="nav-link" id="v-pills-sslcommerze-tab" data-bs-toggle="pill" href="#v-pills-sslcommerze" type="button" role="tab" aria-controls="v-pills-sslcommerze" aria-selected="false">{{__('Pay Via SSlCommerz')}}</a>--}}
                                                        @endif

                                                        <a class="nav-link" id="v-pills-bkash-tab" data-bs-toggle="pill" href="#v-pills-bkash" type="button" role="tab" aria-controls="v-pills-bkash" aria-selected="false">{{__('Pay Via Bkash')}}</a>

                                                        @if($config->enable_amarpay == '1')
                                                            <a class="nav-link" id="v-pills-amarpay-tab" data-bs-toggle="pill" href="#v-pills-amarpay" type="button" role="tab" aria-controls="v-pills-amarpay" aria-selected="false">{{__('Pay Via AAMARPAY')}}</a>
                                                        @endif
                                                        @if($config->iyzico_enable == '1')
                                                            <a class="nav-link" id="v-pills-iyzico-tab" data-bs-toggle="pill" href="#v-pills-iyzico" type="button" role="tab" aria-controls="v-pills-iyzico" aria-selected="false">{{__('Pay Via Iyzcio')}}</a>
                                                        @endif
                                                        @if(config('dpopayment.enable') == 1 && Module::has('DPOPayment') && Module::find('DPOPayment')->isEnabled())

                                                            @include("dpopayment::front.list")

                                                        @endif

                                                        @if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())

                                                            @include("bkash::front.list")

                                                        @endif

                                                        @if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())

                                                            @include("mpesa::front.list")

                                                        @endif

                                                        @if(config('authorizenet.ENABLE') == 1 && Module::has('AuthorizeNet') && Module::find('AuthorizeNet')->isEnabled())

                                                            @include("authorizenet::front.list")

                                                        @endif

                                                        @if(config('worldpay.ENABLE') == 1 && Module::has('Worldpay') && Module::find('Worldpay')->isEnabled())

                                                            @include("worldpay::front.list")

                                                        @endif

                                                        @if(config('midtrains.ENABLE') == 1 && Module::has('Midtrains') && Module::find('Midtrains')->isEnabled())

                                                            @include("midtrains::front.list")

                                                        @endif

                                                        @if(config('paytab.ENABLE') == 1 && Module::has('Paytab') && Module::find('Paytab')->isEnabled())

                                                            @include("paytab::front.list")

                                                        @endif

                                                        @if(config('squarepay.ENABLE') == 1 && Module::has('SquarePay') && Module::find('SquarePay')->isEnabled())

                                                            @include("squarepay::front.list")

                                                        @endif

                                                        @if(config('esewa.ENABLE') == 1 && Module::has('Esewa') && Module::find('Esewa')->isEnabled())

                                                            @include("esewa::front.list")

                                                        @endif

                                                        @if(config('smanager.ENABLE') == 1 && Module::has('Smanager') && Module::find('Smanager')->isEnabled())

                                                            @include("smanager::front.list")

                                                        @endif

                                                        @if(config('senangpay.ENABLE') == 1 && Module::has('Senangpay') && Module::find('Senangpay')->isEnabled())

                                                            @include("senangpay::front.list")

                                                        @endif

                                                        @if(config('onepay.ENABLE') == 1 && Module::has('Onepay') && Module::find('Onepay')->isEnabled())

                                                            @include("onepay::front.list")

                                                        @endif

                                                        @foreach(App\ManualPaymentMethod::where('status','1')->get(); as $item)
                                                            <a class="nav-link" href="#manualpaytab{{ $item->id }}" data-toggle="tab">{{ ucfirst($item->payment_name) }}</a>
                                                        @endforeach

                                                        @if(env('BANK_TRANSFER') == 1)
                                                            <a class="nav-link" href="#btpaytab" data-toggle="tab">{{ __('Bank Tranfer') }}</a>
                                                        @endif

                                                        @if(env('COD_ENABLE') == 1)
                                                            <a class="nav-link" href="#codpaytab" data-toggle="tab">{{ __('Pay On Delivery') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">

                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        {{--                                                        bkash--}}
                                                        <div class="tab-pane fade" id="v-pills-bkash" role="tabpanel" aria-labelledby="v-pills-bkash-tab" tabindex="0">
                                                            @if($checkoutsetting_check->checkout_currency == 1)
                                                                @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'sslcommerze'))
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(pre_order_disable() == false)
                                                                        <form action="{{ route('bkash-create-payment') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <button class="btn btn-primary btn-md" id="">
                                                                                {{__("Pay Now")}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this cash on delivery.') }}</h4>
                                                                    @endif
                                                                @else
                                                                    <h4>{{__('SSLCommerz')}} {{__('Not Available')}}<b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                @endif
                                                            @else
                                                                <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i> {{ Crypt::decrypt($secure_amount) }}</h3>
                                                                <hr>
                                                                @if(pre_order_disable() == false)
                                                                    <form action="{{ route('bkash-create-payment') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                        <button class="btn btn-primary btn-md" id="sslczPayBtn">
                                                                            {{__("Pay Now")}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        {{--end bkash--}}
                                                        @if($config->paypal_enable == '1')

                                                            @if($checkoutsetting_check->checkout_currency == 1)
                                                                <div class="tab-pane fade show active" id="v-pills-paypalpaytab" role="tabpanel" aria-labelledby="v-pills-paypalpaytab-tab" tabindex="0">
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">{{ price_format(Crypt::decrypt($secure_amount)) }}</span></h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'paypal'))

                                                                        <form action="{{ route('processTopayment') }}" method="POST">

                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="payment_method" value="{{ __("Paypal") }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <button type="submit" class="paypal-buy-now-button">
                                                                                <span>{{ __('Express Checkout with') }}</span>
                                                                                <svg aria-label="PayPal" xmlns="http://www.w3.org/2000/svg" width="90" height="33" viewBox="34.417 0 90 33">
                                                                                    <path fill="#253B80" d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.146.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.03.998 1.177 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.804l1.77-11.208a.566.566 0 0 0-.56-.657zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.392-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.955.955 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678H69.41a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.469-.895z">
                                                                                    </path>
                                                                                    <path fill="#179BD7" d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.767 17.537a.57.57 0 0 0 .563.658h3.51a.665.665 0 0 0 .656-.563l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.141-2.694-1.745-4.983-1.745zm.789 6.405c-.373 2.454-2.248 2.454-4.063 2.454h-1.031l.726-4.583a.567.567 0 0 1 .562-.481h.474c1.233 0 2.399 0 3.002.704.358.42.467 1.044.33 1.906zM115.434 13.075h-3.272a.566.566 0 0 0-.562.481l-.146.916-.229-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.312 6.586-.312 1.918.131 3.752 1.22 5.03 1 1.177 2.426 1.666 4.125 1.666 2.916 0 4.532-1.875 4.532-1.875l-.146.91a.57.57 0 0 0 .563.66h2.949a.95.95 0 0 0 .938-.804l1.771-11.208a.57.57 0 0 0-.564-.657zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.483-.574-.666-1.392-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .866-.34.938-.803l2.769-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.562.482z">
                                                                                    </path>
                                                                                </svg>
                                                                            </button>

                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>
                                                                            {{ __('Your transcation is secured with Paypal 128 bit encryption') }}.</p>

                                                                    @else
                                                                        <h4>{{ __('Paypal') }} {{__('Check Not Available') }}
                                                                            <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="tab-pane fade show active" id="v-pills-paypalpaytab" role="tabpanel" aria-labelledby="v-pills-paypalpaytab-tab" tabindex="0">
                                                                    <h3>Pay <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">{{ price_format(Crypt::decrypt($secure_amount)) }}</span></h3>
                                                                    <hr>
                                                                    <form action="{{ route('processTopayment') }}" method="POST">

                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <input type="hidden" name="payment_method" value="{{ __("Paypal") }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <button type="submit" class="paypal-buy-now-button">
                                                                            <span>{{ __('Express Checkout with') }}</span>
                                                                            <svg aria-label="PayPal" xmlns="http://www.w3.org/2000/svg" width="90" height="33" viewBox="34.417 0 90 33">
                                                                                <path fill="#253B80" d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.146.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.03.998 1.177 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.804l1.77-11.208a.566.566 0 0 0-.56-.657zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.392-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.955.955 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678H69.41a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.469-.895z">
                                                                                </path>
                                                                                <path fill="#179BD7" d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.767 17.537a.57.57 0 0 0 .563.658h3.51a.665.665 0 0 0 .656-.563l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.141-2.694-1.745-4.983-1.745zm.789 6.405c-.373 2.454-2.248 2.454-4.063 2.454h-1.031l.726-4.583a.567.567 0 0 1 .562-.481h.474c1.233 0 2.399 0 3.002.704.358.42.467 1.044.33 1.906zM115.434 13.075h-3.272a.566.566 0 0 0-.562.481l-.146.916-.229-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.312 6.586-.312 1.918.131 3.752 1.22 5.03 1 1.177 2.426 1.666 4.125 1.666 2.916 0 4.532-1.875 4.532-1.875l-.146.91a.57.57 0 0 0 .563.66h2.949a.95.95 0 0 0 .938-.804l1.771-11.208a.57.57 0 0 0-.564-.657zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.483-.574-.666-1.392-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .866-.34.938-.803l2.769-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.562.482z">
                                                                                </path>
                                                                            </svg>
                                                                        </button>

                                                                    </form>
                                                                    <hr>
                                                                    <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Paypal 128 bit encryption') }}.</p></p>
                                                                </div>
                                                            @endif

                                                        @endif

                                                        @if($wallet_system == 1)
                                                            <div class="tab-pane fade" id="v-pills-wallet" role="tabpanel" aria-labelledby="v-pills-wallet-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset(Auth::user()->wallet))
                                                                        @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'wallet'))
                                                                            @if(Auth::user()->wallet->status == 1)

                                                                                @if(pre_order_disable() == false)

                                                                                    <!-- If it return false menas cart has some pre order product and payment gateway do not support it -->

                                                                                    @if(round(Auth::user()->wallet->balance*$conversion_rate) >= sprintf("%.2f",Crypt::decrypt($secure_amount)))
                                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                            <span class="payment_amount_label">
                                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                        </span></h3>
                                                                                        <hr>

                                                                                        <form action="{{ route('checkout.with.wallet') }}" method="POST">
                                                                                            @csrf
                                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                            <input class="w3-input w3-border total_secure_amount" id="amount" type="hidden" name="amount" value="{{$secure_amount}}">
                                                                                            <button title="{{ __('Pay') }} {{ __('via') }} {{ __('Wallet') }}" type="submit" class="btn btn-primary">
                                                                                                <i class="fa fa-folder-o" aria-hidden="true"></i> {{ __('Pay') }}
                                                                                                {{ __('via') }} {{ __('Wallet') }}
                                                                                            </button>
                                                                                        </form>

                                                                                    @else
                                                                                        <h4>{{ __('notenoughpoint') }}
                                                                                            <hr> <a title="Your Wallet" href="{{ route('user.wallet.show') }}">My Wallet</a></h4>
                                                                                    @endif

                                                                                @else
                                                                                    <h4 class="text-red">{{ __('Wallet Not Active') }}</h4>
                                                                                @endif

                                                                            @else
                                                                                <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                            @endif

                                                                        @else
                                                                            <h5>{{ __('Wallet') }} {{__('Check Not Available') }}
                                                                                <b>{{ session()->get('currency')['id'] }}</b>.</h5>
                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('Some Thing Want Wrong') }}</h4>
                                                                    @endif

                                                                @else

                                                                    @if(isset(Auth::user()->wallet))
                                                                        @if(Auth::user()->wallet->status == 1)
                                                                            @if(pre_order_disable() == false)
                                                                                @if(round(Auth::user()->wallet->balance*$conversion_rate) >= sprintf("%.2f",Crypt::decrypt($secure_amount)))
                                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                        <span class="payment_amount_label">
                                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                    </span></h3>
                                                                                    <hr>
                                                                                    <form action="{{ route('checkout.with.wallet') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                        <input class="w3-input w3-border total_secure_amount" id="amount" type="hidden" name="amount"
                                                                                               value="{{$secure_amount}}">
                                                                                        <button title="{{ __('Pay') }} {{ __('via') }} {{ __('Wallet') }}" type="submit" class="btn btn-primary">
                                                                                            <i class="fa fa-folder-o" aria-hidden="true"></i> {{ __('Pay') }}
                                                                                            {{ __('via') }} {{ __('Wallet') }}
                                                                                        </button>
                                                                                    </form>
                                                                                @else
                                                                                    <h4>{{ __('Some Thing Want Wrong') }}
                                                                                        <hr> <a title="Your Wallet" href="{{ route('user.wallet.show') }}">My Wallet</a></h4>
                                                                                @endif

                                                                            @else
                                                                                <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                            @endif

                                                                        @else
                                                                            <h4 class="text-red">{{ __('wallet Not Active') }}</h4>
                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('Some Thing Want Wrong') }}</h4>
                                                                    @endif

                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->braintree_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-braintree" role="tabpanel" aria-labelledby="v-pills-braintree-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'braintree'))

                                                                        @if(pre_order_disable() == false)

                                                                            <a href="javascript:void(0);" class="payment-btn bt-btn btn btn-md btn-primary"><i class="fa fa-credit-card"></i> {{__('Pay via Card / Paypal')}}</a>
                                                                            <form method="POST" id="bt-form" action="{{ route('pay.bt') }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="form-group">
                                                                                    <input type="hidden" class="form-control total_secure_amount" name="amount" value="{{ $secure_amount }}">
                                                                                </div>
                                                                                <div class="bt-drop-in-wrapper">
                                                                                    <div id="bt-dropin"></div>
                                                                                </div>
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                                                                <button class="payment-final-bt d-none btn btn-md btn-primary" type="submit">
                                                                                    {{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                    <span class="payment_amount_label">
                                                                                    {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                </span> {{__('Now')}}
                                                                                </button>
                                                                                <div id="pay-errors" role="alert"></div>
                                                                            </form>
                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i>
                                                                                {{ __('Your transcation is secured with Braintree Payments') }}.</p>

                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif

                                                                    @else

                                                                        <h4>{{ __('Braintree') }} {{__('Check Not Available') }}
                                                                            <b>{{ session()->get('currency')['id'] }}</b>.</h4>

                                                                    @endif

                                                                @else

                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                    <hr>
                                                                    @if(pre_order_disable() == false)

                                                                        <a href="javascript:void(0);" class="payment-btn bt-btn btn btn-md btn-primary"><i class="fa fa-credit-card"></i> Pay via Card / Paypal</a>
                                                                        <form method="POST" id="bt-form" action="{{ route('pay.bt') }}">
                                                                            {{ csrf_field() }}
                                                                            <div class="form-group">
                                                                                <input type="hidden" class="form-control total_secure_amount" name="amount" value="{{ $secure_amount }}">
                                                                            </div>
                                                                            <div class="bt-drop-in-wrapper">
                                                                                <div id="bt-dropin"></div>
                                                                            </div>
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                                                                            <button class="payment-final-bt d-none btn btn-md btn-primary" type="submit">
                                                                                Pay <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                {{ sprintf("%.2f",Crypt::decrypt($secure_amount),2) }} Now
                                                                            </button>
                                                                            <div id="pay-errors" role="alert"></div>
                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Braintree Payments.') }}.</p>

                                                                    @else

                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                    @endif

                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->paystack_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-paystack" role="tabpanel" aria-labelledby="v-pills-paystack-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)
                                                                        @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'paystack'))

                                                                            <form method="POST" action="{{ route('pay.via.paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                                                <input type="hidden" name="orderID" value="{{ uniqid() }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                                {{-- required in kobo --}}
                                                                                <input type="hidden" name="quantity" value="1">
                                                                                <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}">
                                                                                <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}">
                                                                                {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                                                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
                                                                                {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                                                                <button class="btn btn-success btn-md" type="submit" value="Pay Now!"> {{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                    <span class="payment_amount_label"> {{ price_format(Crypt::decrypt($secure_amount)) }}</span> {{__('Now')}}
                                                                                </button>

                                                                            </form>

                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Paystack Payments') }}.</p>

                                                                        @else

                                                                            <h4>{{ __('Paystack') }} {{__('Not Available') }}
                                                                                <b>{{ session()->get('currency')['id'] }}</b>.</h4>

                                                                        @endif
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @else

                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">{{ price_format(Crypt::decrypt($secure_amount)) }}</span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <form method="POST" action="{{ route('pay.via.paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                                            <input type="hidden" name="orderID" value="{{ uniqid() }}">
                                                                            <input type="hidden" class="total_paystack_amount" name="amount" value="{{ sprintf("%.2f",(Crypt::decrypt($secure_amount))*100) }}"> {{-- required in kobo --}}
                                                                            <input type="hidden" name="quantity" value="1">
                                                                            <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}">
                                                                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}">
                                                                            {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                                            {{-- works only when using laravel 5.1, 5.2 --}}

                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                                                            <button class="btn btn-success btn-md" type="submit" value="Pay Now!">
                                                                                {{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                <span class="payment_amount_label">
                                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                    </span> {{__('Now')}}
                                                                            </button>

                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Paystack Payments.') }}.</p>

                                                                    @else

                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                    @endif

                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->instamojo_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-instamojo" role="tabpanel" aria-labelledby="v-pills-instamojo-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'instamojo'))

                                                                        <h3>{{__('Pay')}}<i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span></h3>
                                                                        <hr>
                                                                        <form action="{{ route('processTopayment') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="payment_method" value="{{ __("Instamojo") }}">

                                                                            <button type="submit" class="insta-buy-now-button">
                                                                                <span>{{ __('Express Checkout with') }} <img src="{{ url('images/download.png') }}"
                                                                                                                             alt="instamojo" title="{{ __('Pay with Instamojo') }}"></span>
                                                                            </button>
                                                                        </form>
                                                                    @else

                                                                        <h4>{{ __('Instamojo') }} {{__('Not Available')}}
                                                                            <b>{{ session()->get('currency')['id'] }}</b>.</h4>

                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    <form action="{{ route('processTopayment') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <input type="hidden" name="payment_method" value="{{ __("Instamojo") }}">

                                                                        <button type="submit" class="insta-buy-now-button">
                                                                            <span>{{ __('Express Checkout with') }} <img src="{{ url('images/download.png') }}"
                                                                                                                         alt="instamojo" title="{{ __('Pay with Instamojo') }}"></span>
                                                                        </button>
                                                                    </form>
                                                                    <hr>
                                                                    <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Instamojo Payment protection') }}.</p>
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->stripe_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-stripe-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'stripe'))
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                        </h3>

                                                                        @if(pre_order_disable() == false)

                                                                            <div class="row">
                                                                                <div class="col-lg-7 col-md-7">
                                                                                    <div class="card-wrapper"></div>
                                                                                    <br>
                                                                                    <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Secured Transcation Powered By Stripe Payments') }}</p>
                                                                                </div>

                                                                                <div class="col-lg-5 col-md-5">
                                                                                    <div class="form-container active">
                                                                                        <form method="POST" action="{{ route('paytostripe') }}" id="credit-card">
                                                                                            @csrf
                                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                            <div class="form-group">
                                                                                                <input max="16" class="form-control" placeholder="Card number" type="tel" name="number">
                                                                                                @if ($errors->has('number'))
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $errors->first('number') }}</strong>
                                                                                                </span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <input class="form-control" placeholder="Full name" type="text" name="name">
                                                                                                @if ($errors->has('name'))
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $errors->first('name') }}</strong>
                                                                                                </span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <input class="form-control" placeholder="MM/YY" type="tel" name="expiry">
                                                                                                @if ($errors->has('expiry'))
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $errors->first('expiry') }}</strong>
                                                                                                </span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <input class="form-control" placeholder="CVC" type="password" name="cvc">
                                                                                                @if ($errors->has('cvc'))
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $errors->first('cvc') }}</strong>
                                                                                                </span>
                                                                                                @endif
                                                                                            </div>

                                                                                            <input id="amount" type="hidden" class="total_secure_amount form-control" name="amount"
                                                                                                   value="{{ $secure_amount }}">

                                                                                            <div class="form-group">
                                                                                                <button title="{{ __('Click to complete your payment !') }}" type="submit"
                                                                                                        class="btn btn-primary btn-lg btn-block" id="confirm-purchase">{{ __('Pay') }} <i
                                                                                                            class="{{session()->get('currency')['value']}}"></i>
                                                                                                    @if(Session::has('coupanapplied'))
                                                                                                        <span class="payment_amount_label">
                                                                                                    {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                                </span>

                                                                                                    @else
                                                                                                        <span class="payment_amount_label">
                                                                                                    {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                                </span>
                                                                                                    @endif {{ __('Now') }}</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('Stripe Card') }} {{__('Not Available')}} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    @if(pre_order_disable() == false)

                                                                        <div class="row">
                                                                            <div class="col-lg-7 col-md-7">
                                                                                <div class="card-wrapper"></div>
                                                                                <br>
                                                                                <p class="text-muted"><i class="fa fa-lock"></i>
                                                                                    {{ __('Secured Card Transcations Powered By Stripe Payments') }}</p>
                                                                            </div>

                                                                            <div class="col-lg-5 col-md-5">
                                                                                <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                    {{ price_format(Crypt::decrypt($secure_amount),2) }}</h3>
                                                                                <div class="form-container active">
                                                                                    <form method="POST" action="{{route('paytostripe')}}" id="credit-card">
                                                                                        @csrf

                                                                                        <div class="form-group">
                                                                                            <input max="16" class="form-control" placeholder="Card number" type="tel" name="number">
                                                                                            @if ($errors->has('number'))
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('number') }}</strong>
                                                                                    </span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input class="form-control" placeholder="Full name" type="text" name="name">
                                                                                            @if ($errors->has('name'))
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                                    </span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input class="form-control" placeholder="MM/YY" type="tel" name="expiry">
                                                                                            @if ($errors->has('expiry'))
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('expiry') }}</strong>
                                                                                    </span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input class="form-control" placeholder="CVC" type="password" name="cvc">
                                                                                            @if ($errors->has('cvc'))
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('cvc') }}</strong>
                                                                                    </span>
                                                                                            @endif
                                                                                        </div>

                                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                        <input id="amount" type="hidden" class="form-control total_secure_amount" name="amount"
                                                                                               value="{{ $secure_amount }}">

                                                                                        <div class="form-group">
                                                                                            <button title="Click to complete your payment !" type="submit"
                                                                                                    class="btn btn-primary btn-lg btn-block" id="confirm-purchase">{{ __('Pay') }} <i
                                                                                                        class="{{session()->get('currency')['value']}}"></i>
                                                                                                @if(Session::has('coupanapplied'))
                                                                                                    <span class="payment_amount_label">
                                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                        </span>

                                                                                                @else
                                                                                                    {{price_format(Crypt::decrypt($secure_amount)) }}
                                                                                                @endif {{ __('Now') }}</button>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->payu_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-payu" role="tabpanel" aria-labelledby="v-pills-payu-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'payu'))

                                                                        <h3>{{__('Pay')}}<i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">{{ price_format(Crypt::decrypt($secure_amount)) }} </span></h3>
                                                                        <hr>

                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('processTopayment') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="payment_method" value="{{ __("Payu") }}">
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <button type="submit" class="payu-buy-now-button">
                                                                                <span>{{ __('Express checkout with') }} <img src="{{ url('images/payu.png') }}" alt="payulogo"
                                                                                                                             title="{{ __('Pay with PayU') }}"></span>
                                                                                </button>
                                                                            </form>
                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Secured Transcation Powered By PayU Payments') }}</p>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('Payu Money') }} {{__('Not Available')}} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>
                                                                        {{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)
                                                                        <form action="{{ route('processTopayment') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="payment_method" value="{{ __("Payu") }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <button type="submit" class="payu-buy-now-button">
                                                                            <span>{{ __('Express checkout with') }} <img src="{{ url('images/payu.png') }}" alt="payulogo"
                                                                                                                         title="{{ __('Pay with PayU') }}"></span>
                                                                            </button>
                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Secured Transcation Powered By PayU Payments') }}</p>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->paytm_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-paytam" role="tabpanel" aria-labelledby="v-pills-paytam-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'Paytm'))

                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                        </h3>
                                                                        <hr>
                                                                        <form action="{{ route('processTopayment') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="payment_method" value="{{ __("Paytm") }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <button type="submit" class="paytm-buy-now-button">
                                                                                <span>Express checkout with <img src="{{ url('images/paywithpaytm.jpg') }}" title="Pay with Paytm"></span>
                                                                            </button>
                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>
                                                                            {{ __('Secured Transcation Powered By Paytm Payments') }}</p>

                                                                    @else
                                                                        <h4>{{ __('Paytm') }} {{__('Not Available')}}<b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    <form action="{{ route('processTopayment') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <input type="hidden" name="payment_method" value="{{ __("Paytm") }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <button type="submit" class="paytm-buy-now-button">
                                                                            <span>{{ __('Express checkout with') }} <img src="{{ url('images/paywithpaytm.jpg') }}" title="{{ __('Pay with Paytm') }}"></span>
                                                                        </button>
                                                                    </form>
                                                                    <hr>
                                                                    <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Secured Transcation Powered By Paytm Payments') }}</p>
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->razorpay == '1')
                                                            <div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel" aria-labelledby="v-pills-razorpay-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'Razorpay'))
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span></h3>
                                                                        <hr>

                                                                        @if(pre_order_disable() == false)

                                                                            <form id="rpayform" action="{{ route('rpay') }}" method="POST">
                                                                                @php
                                                                                    $order = uniqid();
                                                                                    Session::put('order_id',$order);
                                                                                @endphp
                                                                                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_PAY_KEY') }}"
                                                                                        data-amount="{{ (round(Crypt::decrypt($secure_amount),2))*100 }}"
                                                                                        data-buttontext="Pay {{ $secure_amount }} INR" data-name="{{ $title }}"
                                                                                        data-description="Payment For Order {{ Session::get('order_id') }}"
                                                                                        data-image="{{url('images/genral/'.$front_logo)}}" data-prefill.name="{{ $address->name }}"
                                                                                        data-prefill.email="{{ $address->email }}" data-theme.color="#157ED2">
                                                                                </script>
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                                                            </form>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('RazorPay') }} {{__('Not Available')}} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)
                                                                        <form id="rpayform" action="{{ route('rpay') }}" method="POST">
                                                                            @php
                                                                                $order = uniqid();
                                                                                Session::put('order_id',$order);
                                                                            @endphp
                                                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_PAY_KEY') }}"
                                                                                    data-amount="{{ (round(Crypt::decrypt($secure_amount),2))*100 }}"
                                                                                    data-buttontext="Pay {{ price_format(Crypt::decrypt($secure_amount)) }} INR" data-name="{{ $title }}"
                                                                                    data-description="Payment For Order {{ Session::get('order_id') }}"
                                                                                    data-image="{{url('images/genral/'.$front_logo)}}" data-prefill.name="{{ $address->name }}"
                                                                                    data-prefill.email="{{ $address->email }}" data-theme.color="#157ED2">
                                                                            </script>
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                                                        </form>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->payhere_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-payhere" role="tabpanel" aria-labelledby="v-pills-payhere-tab" tabindex="0">
                                                                @php
                                                                    $address = App\Address::find(session()->get('address'));
                                                                    $payhere_order_id = uniqid();
                                                                @endphp

                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'payhere'))

                                                                        @if(pre_order_disable() == false)

                                                                            <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                                                                                @csrf
                                                                                <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">
                                                                                <!-- Replace your Merchant ID -->
                                                                                <input type="hidden" name="return_url" value="{{ url('/payhere/callback') }}">
                                                                                <input type="hidden" name="cancel_url" value="{{ url('/checkout') }}">
                                                                                <input type="hidden" name="notify_url" value="{{ url('/notify/payhere') }}">
                                                                                <input type="hidden" name="order_id" value="{{ $payhere_order_id }}">
                                                                                <input type="hidden" name="items" value="Payment For Order {{ $payhere_order_id }}">
                                                                                <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                                <input type="hidden" name="first_name" value="{{ Auth::user()->name }}">
                                                                                <input type="hidden" name="last_name" value="{{ Auth::user()->name }}">
                                                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                                                <input type="hidden" name="phone" value="{{ Auth::user()->mobile }}">
                                                                                <input type="hidden" name="address" value="{{ isset($address) ? $address['address'] : "No Address" }}">
                                                                                <input type="hidden" name="city" value="{{ $address->getcity['name'] ?? '' }}">
                                                                                <input type="hidden" name="country" value="{{ $address->getCountry['nicename'] }}">
                                                                                <button type="submit" class="payhere-buy-now-button">
                                                                                    <span> <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                        {{ sprintf("%.2f",Crypt::decrypt($secure_amount),2) }} <img src="{{ url('images/payhere.png') }}" alt="payherelogo" title="Pay with Payhere">
                                                                                    </span>
                                                                                </button>
                                                                            </form>

                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Paypal 128 bit encryption') }}.</p>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif

                                                                    @else
                                                                        <h4>{{ __('Payhere') }} {{__('Not Available') }}<b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                                                                            @csrf
                                                                            <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">
                                                                            <!-- Replace your Merchant ID -->
                                                                            <input type="hidden" name="return_url" value="{{ url('/payhere/callback') }}">
                                                                            <input type="hidden" name="cancel_url" value="{{ url('/checkout') }}">
                                                                            <input type="hidden" name="notify_url" value="{{ url('/notify/payhere') }}">
                                                                            <input type="hidden" name="order_id" value="{{ $payhere_order_id }}">
                                                                            <input type="hidden" name="items" value="Payment For Order {{ $payhere_order_id }}">
                                                                            <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ Crypt::decrypt($secure_amount) }}">
                                                                            <input type="hidden" name="first_name" value="{{ Auth::user()->name }}">
                                                                            <input type="hidden" name="last_name" value="{{ Auth::user()->name }}">
                                                                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                                            <input type="hidden" name="phone" value="{{ Auth::user()->mobile }}">
                                                                            <input type="hidden" name="address"
                                                                                   value="{{ isset($address) ? $address['address'] : "No Address" }}">
                                                                            <input type="hidden" name="city" value="{{ $address->getcity['name'] ?? '' }}">
                                                                            <input type="hidden" name="country" value="{{ $address->getCountry['nicename'] }}">
                                                                            <button type="submit" class="payhere-buy-now-button">
                                                                                <span> <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                {{ sprintf("%.2f",Crypt::decrypt($secure_amount),2) }} <img
                                                                                            src="{{ url('images/payhere.png') }}" alt="payherelogo" title="Pay with Payhere"></span>
                                                                            </button>
                                                                        </form>

                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>
                                                                            {{ __('Your transcation is secured with Payhere transcations.') }}.</p>

                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif

                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->cashfree_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-cashfree" role="tabpanel" aria-labelledby="v-pills-cashfree-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'cashfree'))
                                                                        <form action="{{ route('processTopayment') }}" method="POST">

                                                                            @csrf
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="payment_method" value="{{ __("Cashfree") }}">
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">

                                                                            <button type="submit" class="cashfree-buy-now-button">
                                                                                <span>Express checkout with <img src="{{ url('images/cashfree.svg') }}" alt="cashfree" title="Pay with Cashfree"></span>
                                                                            </button>
                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Cashfree secured payments.') }}.</p>
                                                                    @else
                                                                        <h4>{{ __('Cashfree') }} {{__('Not Available') }} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    <form action="{{ route('processTopayment') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                        <input type="hidden" name="payment_method" value="{{ __("Cashfree") }}">
                                                                        <input type="hidden" name="actualtotal" value="{{ $un_sec }}">

                                                                        <button type="submit" class="cashfree-buy-now-button">
                                                                            <span>Express checkout with <img src="{{ url('images/cashfree.svg') }}" alt="cashfree" title="Pay with Cashfree"></span>
                                                                        </button>
                                                                    </form>
                                                                    <hr>
                                                                    <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Cashfree transcations.') }}.</p>
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->omise_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-omise" role="tabpanel" aria-labelledby="v-pills-omise-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'omise'))
                                                                        @if(pre_order_disable() == false)
                                                                            <form id="checkoutForm" method="POST" action="{{ route('pay.via.omise') }}">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}" />
                                                                                <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                                                                                        data-key="{{ env('OMISE_PUBLIC_KEY') }}"
                                                                                        data-amount="{{ sprintf("%.2f",Crypt::decrypt($secure_amount))*100 }}"
                                                                                        data-frame-label="{{ config('app.name') }}"
                                                                                        data-image="{{ url('images/genral/'.$front_logo) }}"
                                                                                        data-currency="{{ session()->get('currency')['id'] }}"
                                                                                        data-default-payment-method="credit_card">
                                                                                </script>
                                                                            </form>
                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Omise secured payments.') }}.</p>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif
                                                                    @else
                                                                        <h4>{{ __('Omise') }} {{__('Not Available') }} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label"> {{ price_format(Crypt::decrypt($secure_amount)) }}</span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <form id="checkoutForm" method="POST" action="{{ route('pay.via.omise') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}" />
                                                                            <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                                                                                    data-key="{{ env('OMISE_PUBLIC_KEY') }}"
                                                                                    data-amount="{{ sprintf("%.2f",Crypt::decrypt($secure_amount))*100 }}"
                                                                                    data-frame-label="{{ config('app.name') }}"
                                                                                    data-image="{{ url('images/genral/'.$front_logo) }}"
                                                                                    data-currency="{{ session()->get('currency')['id'] }}"
                                                                                    data-default-payment-method="credit_card">
                                                                            </script>
                                                                        </form>

                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Omise transcations.') }}.</p>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->rave_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-rave" role="tabpanel" aria-labelledby="v-pills-rave-tab" tabindex="0">
                                                                @php
                                                                    $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                                                                    array('metaname' => 'size', 'metavalue' => 'big'));
                                                                    $rave_order_id = session()->put('order_id',uniqid());
                                                                @endphp

                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'rave'))

                                                                        @if(pre_order_disable() == false)

                                                                            <form method="POST" action="{{ route('rave.pay') }}" id="paymentForm">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount"
                                                                                       value="{{ sprintf("%.2f",Crypt::decrypt($secure_amount)) }}" />
                                                                                <input type="hidden" name="payment_method" value="both" />
                                                                                <input type="hidden" name="description" value="Payment for order {{ $rave_order_id }}" />
                                                                                <input type="hidden" name="country" value="NG" />
                                                                                <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}" />
                                                                                <input type="hidden" name="email" value="{{ $address->email }}" />
                                                                                <input type="hidden" name="firstname" value="{{ $address->name }}" />
                                                                                <input type="hidden" name="lastname" value="{{ $address->name }}" />
                                                                                <input type="hidden" name="metadata" value="{{ json_encode($array) }}">
                                                                                <input type="hidden" name="phonenumber" value="{{ $address->phone }}" />
                                                                                <input type="hidden" name="logo" value="{{ env('RAVE_LOGO') }}" />
                                                                                <input type="submit" class="total_amount_pay" value="Pay {{ price_format(Crypt::decrypt($secure_amount)) }}" />
                                                                            </form>

                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Rave secured payments.') }}.</p>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else

                                                                        <h4>{{ __('Rave') }} {{__('Not Available') }} <b>{{ session()->get('currency')['id'] }}</b>.</h4>

                                                                    @endif
                                                                @else

                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <form method="POST" action="{{ route('rave.pay') }}" id="paymentForm">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount"
                                                                                   value="{{ sprintf("%.2f",Crypt::decrypt($secure_amount)) }}" />
                                                                            <input type="hidden" name="payment_method" value="both" />
                                                                            <input type="hidden" name="description" value="Payment for order {{ $rave_order_id }}" />
                                                                            <input type="hidden" name="country" value="NG" />
                                                                            <input type="hidden" name="currency" value="{{ session()->get('currency')['id'] }}" />
                                                                            <input type="hidden" name="email" value="{{ $address->email }}" />
                                                                            <input type="hidden" name="firstname" value="{{ $address->name }}" />
                                                                            <input type="hidden" name="lastname" value="{{ $address->name }}" />
                                                                            <input type="hidden" name="metadata" value="{{ json_encode($array) }}">
                                                                            <input type="hidden" name="phonenumber" value="{{ $address->phone }}" />
                                                                            <input type="hidden" name="logo" value="{{ env('RAVE_LOGO') }}" />
                                                                            <input type="submit" class="total_amount_pay" value="Pay {{ price_format(Crypt::decrypt($secure_amount)) }}" />
                                                                        </form>

                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Rave transcations.') }}.</p>

                                                                    @else

                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                    @endif

                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->moli_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-moli" role="tabpanel" aria-labelledby="v-pills-moli-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'mollie'))

                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('mollie.pay') }}" method="POST" autocomplete="off">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                                <button type="submit" class="mollie-buy-now-button">
                                                                                    <span>{{ __('Express checkout with') }} <img src="{{ url('images/moli.png') }}" alt="mollielogo" title="{{ __('Pay with Mollie') }}"></span>
                                                                                </button>
                                                                            </form>

                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Mollie secured payments.') }}.</p>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif
                                                                    @else
                                                                        <h4>{{ __('Mollie') }} {{__('Not Available') }} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)
                                                                        <form action="{{ route('mollie.pay') }}" method="POST" autocomplete="off">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                            <button type="submit" class="mollie-buy-now-button">
                                                                                <span>{{ __('Express checkout with') }} <img src="{{ url('images/moli.png') }}" alt="mollielogo" title="{{ __('Pay with Mollie') }}"></span>
                                                                            </button>
                                                                        </form>

                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i>{{ __('Your transcation is secured with Mollie secured payments.') }}.</p>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->skrill_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-skrill" role="tabpanel" aria-labelledby="v-pills-skrill-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'skrill'))

                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('skrill.pay') }}" method="POST" autocomplete="off">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                                <button type="submit" class="skrill-buy-now-button">
                                                                                    <span>{{ __('Express checkout with') }} <img src="{{ url('images/skrill.png') }}" alt="skrill_logo" title="{{ __('Pay with Skrill') }}"></span>
                                                                                </button>
                                                                            </form>
                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Skrill secured payments.') }}.</p>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                        @endif
                                                                    @else
                                                                        <h4>{{ __('Skrill') }} {{__('Not Available') }} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{ __('Pay') }} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)
                                                                        <form action="{{ route('skrill.pay') }}" method="POST" autocomplete="off">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                            <button type="submit" class="skrill-buy-now-button">
                                                                                <span>{{ __('Express checkout with') }} <img src="{{ url('images/skrill.png') }}" alt="skrill_logo" title="{{ __('Pay with Skrill') }}"></span>
                                                                            </button>
                                                                        </form>
                                                                        <hr>
                                                                        <p class="text-muted"><i class="fa fa-lock"></i> {{ __('Your transcation is secured with Skrill secured payments.') }}.</p>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->sslcommerze_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-sslcommerze" role="tabpanel" aria-labelledby="v-pills-sslcommerze-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'sslcommerze'))
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                        </h3>
                                                                        <hr>
                                                                        @if(pre_order_disable() == false)
                                                                            <form action="{{ route('payvia.sslcommerze') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                                <button class="btn btn-primary btn-md" id="sslczPayBtn">
                                                                                    {{__("Pay Now")}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                    {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                                </button>
                                                                            </form>
                                                                        @else
                                                                            <h4 class="text-red">{{ __('Preorder not available with this cash on delivery.') }}</h4>
                                                                        @endif
                                                                    @else
                                                                        <h4>{{__('SSLCommerz')}} {{__('Not Available')}}<b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i> {{ Crypt::decrypt($secure_amount) }}</h3>
                                                                    <hr>
                                                                    @if(pre_order_disable() == false)
                                                                        <form action="{{ route('payvia.sslcommerze') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                            <button class="btn btn-primary btn-md" id="sslczPayBtn">
                                                                                {{__("Pay Now")}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->enable_amarpay == '1')
                                                            <div class="tab-pane fade" id="v-pills-amarpay" role="tabpanel" aria-labelledby="v-pills-amarpay-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'amarpay'))
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                        </h3>
                                                                        <hr>

                                                                        @if(pre_order_disable() == false)

                                                                            <div class="aamar-pay-btn">
                                                                                {!!
                                                                                    aamarpay_post_button([
                                                                                        'cus_name'  => auth()->user()->name, // Customer name
                                                                                        'cus_email' => auth()->user()->email, // Customer email
                                                                                        'cus_phone' => auth()->user()->mobile // Customer Phone
                                                                                    ], price_format(Crypt::decrypt($secure_amount)), '<i class="fa fa-money"></i> Pay via AAMARPAY', 'btn btn-md btn-primary')
                                                                                !!}
                                                                            </div>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else
                                                                        <h4>{{__('AAMARPAY')}} {{__('Not Available')}} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <div class="aamar-pay-btn">
                                                                            {!!
                                                                                aamarpay_post_button([
                                                                                    'cus_name'  => auth()->user()->name, // Customer name
                                                                                    'cus_email' => auth()->user()->email, // Customer email
                                                                                    'cus_phone' => auth()->user()->mobile // Customer Phone
                                                                                ], price_format(Crypt::decrypt($secure_amount)), '<i class="fa fa-money"></i> Pay via AAMARPAY', 'btn btn-md btn-primary')
                                                                            !!}
                                                                        </div>

                                                                    @else

                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if($config->iyzico_enable == '1')
                                                            <div class="tab-pane fade" id="v-pills-iyzico" role="tabpanel" aria-labelledby="v-pills-iyzico-tab" tabindex="0">
                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'iyzico'))
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                                {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                            </span>
                                                                        </h3>
                                                                        <hr>
                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('iyzcio.pay') }}" method="POST" autocomplete="off">
                                                                                @csrf
                                                                                <div class="row">

                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group mb-20">
                                                                                            <h6>Identity number:</h6>
                                                                                            <input type="text" name="identity_number" class="form- mt-3 mb-3" placeholder="74300864791" required autocomplete="off">
                                                                                            <small class="text-muted"><i class="fa fa-question-circle"></i> TCKN for Turkish merchants, passport number for foreign merchants</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                                                                <input type="hidden" name="mobile" value="{{ $address->phone }}">
                                                                                <input type="hidden" name="conversation_id" value="{{  uniqid() }}" />
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                                <input type="hidden" name="currency" value="{{ session()->get('currency')['id']  }}"/>
                                                                                <input type="hidden" name="mobile" value="{{ $address->phone }}" />
                                                                                <input type="hidden" name="address" value="{{ $address->address }}" />
                                                                                <input type="hidden" name="city" value="{{ $address->getcity['name'] ?? ''}}" />
                                                                                <input type="hidden" name="state" value="{{ $address->getstate['name'] }}" />
                                                                                <input type="hidden" name="country" value="{{ $address->getCountry['name'] }}" />
                                                                                <input type="hidden" name="pincode" value="{{ $address->pin_code }}" />
                                                                                <input type="hidden" name="language" value="{{ app()->getLocale() }}" />
                                                                                <button class="btn btn-primary btn-md" title="checkout"
                                                                                        type="submit">{{__('Pay')}}</button>
                                                                            </form>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else
                                                                        <h4>{{__('Iyzico')}} {{__('Not Available')}} <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                @else
                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                            {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                        </span>
                                                                    </h3>
                                                                    <hr>

                                                                    @if(pre_order_disable() == false)

                                                                        <form action="{{ route('iyzcio.pay') }}" method="POST" autocomplete="off">
                                                                            @csrf
                                                                            <div class="row">

                                                                                <div class="col-md-12">
                                                                                    <div class="form-group mb-20">
                                                                                        <h6>Identity number:</h6>
                                                                                        <input type="text" name="identity_number" class="form-control mt-3 mb-3" placeholder="74300864791" required autocomplete="off">
                                                                                        <small class="text-muted"><i class="fa fa-question-circle"></i> TCKN for Turkish merchants, passport number for foreign merchants</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                                                            <input type="hidden" name="mobile" value="{{ $address->phone }}">
                                                                            <input type="hidden" name="conversation_id" value="{{  uniqid() }}" />
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount  }}" />
                                                                            <input type="hidden" name="currency" value="{{ session()->get('currency')['id']  }}"/>
                                                                            <input type="hidden" name="mobile" value="{{ $address->phone }}" />
                                                                            <input type="hidden" name="address" value="{{ $address->address }}" />
                                                                            <input type="hidden" name="city" value="{{ $address->getcity['name'] ?? ''}}" />
                                                                            <input type="hidden" name="state" value="{{ $address->getstate['name'] }}" />
                                                                            <input type="hidden" name="country" value="{{ $address->getCountry['name'] }}" />
                                                                            <input type="hidden" name="pincode" value="{{ $address->pin_code }}" />
                                                                            <input type="hidden" name="language" value="{{ app()->getLocale() }}" />
                                                                            <button class="btn btn-primary btn-md" title="checkout" type="submit">{{__('Pay')}}</button>
                                                                        </form>

                                                                    @else
                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if(config('dpopayment.enable') == 1 && Module::has('DPOPayment') && Module::find('DPOPayment')->isEnabled())

                                                            @include("dpopayment::front.tab")

                                                        @endif

                                                        @if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())

                                                            @include("bkash::front.tab")

                                                        @endif



                                                        @if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())

                                                            @include("mpesa::front.tab")

                                                        @endif

                                                        @if(config('authorizenet.ENABLE') == 1 && Module::has('AuthorizeNet') && Module::find('AuthorizeNet')->isEnabled())
                                                            @include("authorizenet::front.tab")
                                                        @endif

                                                        @if(config('worldpay.ENABLE') == 1 && Module::has('Worldpay') && Module::find('Worldpay')->isEnabled())

                                                            @include("worldpay::front.tab")

                                                        @endif

                                                        @if(config('midtrains.ENABLE') == 1 && Module::has('Midtrains') && Module::find('Midtrains')->isEnabled())

                                                            @include("midtrains::front.tab")

                                                        @endif

                                                        @if(config('paytab.ENABLE') == 1 && Module::has('Paytab') && Module::find('Paytab')->isEnabled())

                                                            @include("paytab::front.tab")

                                                        @endif

                                                        @if(config('squarepay.ENABLE') == 1 && Module::has('SquarePay') && Module::find('SquarePay')->isEnabled())

                                                            @include("squarepay::front.tab")

                                                        @endif

                                                        @if(config('esewa.ENABLE') == 1 && Module::has('Esewa') && Module::find('Esewa')->isEnabled())

                                                            @include("esewa::front.tab")

                                                        @endif

                                                        @if(config('smanager.ENABLE') == 1 && Module::has('Smanager') && Module::find('Smanager')->isEnabled())

                                                            @include("smanager::front.tab")

                                                        @endif

                                                        @if(config('senangpay.ENABLE') == 1 && Module::has('Senangpay') && Module::find('Senangpay')->isEnabled())

                                                            @include("senangpay::front.tab")

                                                        @endif

                                                        @if(config('onepay.ENABLE') == 1 && Module::has('Onepay') && Module::find('Onepay')->isEnabled())

                                                            @include("onepay::front.tab")

                                                        @endif

                                                        @foreach(App\ManualPaymentMethod::where('status','1')->get(); as $item)
                                                            @php
                                                                $token = str_random(25);
                                                            @endphp
                                                            <div class="tab-pane manualpaytab" id="manualpaytab{{ $item->id }}">

                                                                <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                    <span class="payment_amount_label">
                                                                    {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                </span></h3>
                                                                <hr>

                                                                @if($checkoutsetting_check->checkout_currency == 1)
                                                                    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,$item->payment_name))

                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('manualpay.checkout',['token' => $token, 'payvia' => $item->payment_name]) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">

                                                                                <div class="form-group">
                                                                                    {{--                                                                            <label for="">Attach Purchase Proof <span class="text-red">*</span> </label>--}}
                                                                                    {{--                                                                            <input  title="Please attach a purchase proof !" type="file" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_proof"/>--}}

                                                                                    <label for="">Enter your {{ $item->payment_name }} number <span class="text-red">*</span> </label>
                                                                                    <input required title="Please Enter your account number" type="text" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_number"/>

                                                                                    @error('purchase_proof')
                                                                                    <span class="invalid-feedback text-danger" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                    @enderror

                                                                                </div>

                                                                                <button type="submit" class="cod-buy-now-button">
                                                                                    <span>{{ $item->payment_name }}</span> <i class="fa fa-money"></i>
                                                                                </button>
                                                                            </form>

                                                                            <hr>

                                                                            <div class="row">

                                                                                <div class="col-md-12">
                                                                                    {!! $item->description !!}
                                                                                </div>

                                                                            </div>

                                                                            @if($item->thumbnail != '' && file_exists(public_path().'/images/manual_payment/'.$item->thumbnail) )

                                                                                <div class="card card-1 mt-3">
                                                                                    <div class="text-center card-body">

                                                                                        <img width="300px" height="300px" class="img-fluid" src="{{ url('images/manual_payment/'.$item->thumbnail) }}" alt="{{ $item->thumbnail }}">
                                                                                    </div>
                                                                                </div>

                                                                            @endif

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @else

                                                                        <h4>{{ $item->payment_name }} {{__('Not Available')}}
                                                                            <b>{{ session()->get('currency')['id'] }}</b>.</h4>

                                                                    @endif
                                                                @else

                                                                    @if(pre_order_disable() == false)

                                                                        <form action="{{ route('manualpay.checkout',['token' => $token, 'payvia' => $item->payment_name]) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                            <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">

                                                                            <div class="form-group">
                                                                                {{--                                                                        <label for="">Attach Purchase Proof <span class="text-red">*</span> </label>--}}
                                                                                {{--                                                                        <input required title="Please attach a purchase proof !" type="file" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_proof"/>--}}
                                                                                <label for="">Enter your {{ $item->payment_name }} number <span class="text-red">*</span> </label>
                                                                                <input required title="Please Enter your account number" type="text" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_number"/>

                                                                                @error('purchase_proof')
                                                                                <span class="invalid-feedback text-danger" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                                @enderror

                                                                            </div>

                                                                            <button type="submit" class="cod-buy-now-button">
                                                                                <span>{{ $item->payment_name }}</span> <i class="fa fa-money"></i>
                                                                            </button>
                                                                        </form>

                                                                        <hr>

                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                {!! $item->description !!}
                                                                            </div>

                                                                        </div>

                                                                        @if($item->thumbnail != '' && file_exists(public_path().'/images/manual_payment/'.$item->thumbnail) )

                                                                            <div class="card card-1 mt-3">
                                                                                <div class="text-center card-body">

                                                                                    <img width="300px" height="300px" class="img-fluid" src="{{ url('images/manual_payment/'.$item->thumbnail) }}" alt="{{ $item->thumbnail }}">
                                                                                </div>
                                                                            </div>

                                                                        @endif

                                                                    @else

                                                                        <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                    @endif

                                                                @endif
                                                            </div>

                                                        @endforeach

                                                        @if(env('BANK_TRANSFER') == 1)

                                                            @php
                                                                $bankT = App\BankDetail::first();
                                                            @endphp

                                                            @if($checkoutsetting_check->checkout_currency == 1)
                                                                <div class="tab-pane" id="btpaytab">
                                                                    @if(isset($listcheckOutCurrency->payment_method) &&
                                                                    strstr($listcheckOutCurrency->payment_method,'bankTransfer'))

                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                        <hr>
                                                                        @if(!isset($bankT))
                                                                            <h4>{{ __("Bank Transfer Not Available") }}</h4>
                                                                        @else
                                                                            @if(pre_order_disable() == false)

                                                                                <form action="{{ route('bank.transfer.process',str_random(25)) }}" method="POST" enctype="multipart/form-data" >
                                                                                    @csrf
                                                                                    <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                    <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">

                                                                                    <div class="form-group">
                                                                                        <label for="">Attach Purchase Proof <span class="text-red">*</span> </label>
                                                                                        <input required title="Please attach a purchase proof !" type="file" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_proof"/>

                                                                                        @error('purchase_proof')
                                                                                        <span class="invalid-feedback text-danger" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                                        @enderror

                                                                                    </div>

                                                                                    <button title="{{__('Bank Tranfer')}}" type="submit" class="cod-buy-now-button">
                                                                                        <span>{{__('Bank Tranfer')}}</span> <i class="fa fa-money"></i>
                                                                                    </button>
                                                                                </form>

                                                                                <hr>
                                                                                <p class="text-muted"><i class="fa fa-money"></i> {{__('Bank Transfer')}}</p>

                                                                                <div class="card card-1 mt-3">
                                                                                    <div class="card-body">
                                                                                        <h4>{{__('Following Bank')}}</h4>

                                                                                        @if(isset($bankT))
                                                                                            <p>{{__('Account Name')}}: {{ $bankT->account }}</p>
                                                                                            <p>{{ __('A/c No') }}: {{ $bankT->account }}</p>
                                                                                            <p>{{__('BankName')}}: {{ $bankT->bankname }}</p>
                                                                                            @if($bankT->ifsc != '')
                                                                                                <p>{{ __('IFSC Code') }}: {{ $bankT->ifsc }}</p>
                                                                                            @endif
                                                                                            @if($bankT->swift_code != '')
                                                                                                <p>{{ __('SWIFT Code') }}: {{ $bankT->swift_code }}</p>
                                                                                            @endif
                                                                                        @else
                                                                                            <p>{{__('bankdetailerror')}}</p>
                                                                                        @endif

                                                                                    </div>
                                                                                </div>

                                                                            @else

                                                                                <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                            @endif
                                                                        @endif

                                                                    @else
                                                                        <h4>{{__('BankTranfer')}} {{__('Not Available')}}
                                                                            <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="tab-pane" id="btpaytab">

                                                                    <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                        <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                    <hr>
                                                                    @if(!isset($bankT))
                                                                        <h4>{{ __("bankTransferNotAvailable") }}</h4>
                                                                    @else

                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('bank.transfer.process',str_random(25)) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">

                                                                                <div class="form-group">
                                                                                    <label for="">Attach Purchase Proof <span class="text-red">*</span> </label>
                                                                                    <input required title="Please attach a purchase proof !" type="file" class="@error('purchase_proof') is-invalid @enderror form-control mt-3 mb-3" name="purchase_proof"/>

                                                                                    @error('purchase_proof')
                                                                                    <span class="invalid-feedback text-danger" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                                    @enderror

                                                                                </div>

                                                                                <button title="{{__('Bank Tranfer')}}" type="submit" class="cod-buy-now-button">
                                                                                    <span>{{__('Bank Tranfer')}}</span> <i class="fa fa-money"></i>
                                                                                </button>
                                                                            </form>

                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-money"></i> {{__('Bank Transfer')}}</p>

                                                                            <div class="card card-1 mt-3">
                                                                                <div class="card-body">
                                                                                    <h4>{{__('Following BankT')}}</h4>

                                                                                    @if(isset($bankT))
                                                                                        <p>{{__('Account Name')}}: {{ $bankT->account }}</p>
                                                                                        <p>{{ __('A/c No') }}: {{ $bankT->account }}</p>
                                                                                        <p>{{__('Bank Name')}}: {{ $bankT->bankname }}</p>
                                                                                        <p>{{ __('IFSC Code') }}: {{ $bankT->ifsc }}</p>
                                                                                        @if($bankT->swift_code != '')
                                                                                            <p>{{ __('SWIFT Code') }}: {{ $bankT->swift_code }}</p>
                                                                                        @endif
                                                                                    @else
                                                                                        <p>{{__('Try Again')}}</p>
                                                                                    @endif

                                                                                </div>
                                                                            </div>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                        @endif

                                                                    @endif

                                                                </div>
                                                            @endif

                                                        @endif

                                                        @if(env('COD_ENABLE') == 1)

                                                            @php

                                                                $codcheck = array();
                                                                $order = uniqid();
                                                                Session::put('order_id',$order);

                                                            @endphp

                                                            @foreach($cart_table as $cod_chk)

                                                                @php

                                                                    if(isset($cod_chk->product)){
                                                                        array_push($codcheck,$cod_chk->product->codcheck);
                                                                    }

                                                                    if(isset($cod_chk->simple_product)){
                                                                        array_push($codcheck,$cod_chk->simple_product->cod_avbl);
                                                                    }

                                                                @endphp

                                                            @endforeach

                                                            @if($checkoutsetting_check->checkout_currency == 1)
                                                                <div class="tab-pane" id="codpaytab">
                                                                    @if(isset($listcheckOutCurrency->payment_method) &&
                                                                    strstr($listcheckOutCurrency->payment_method,'cashOnDelivery'))

                                                                        @if(in_array(0, $codcheck))
                                                                            <span class="required">{{__('Some Product Not Support')}}</span>
                                                                        @else
                                                                            @php
                                                                                $token = str_random(25);
                                                                            @endphp
                                                                            <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                                <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                            <hr>
                                                                            @if(pre_order_disable() == false)

                                                                                <form action="{{ route('cod.process',$token) }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                    <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">

                                                                                    <button title="{{__('Poddoor')}}" type="submit" class="cod-buy-now-button">
                                                                                        <span>{{__('Pod')}}</span> <i class="fa fa-money"></i>
                                                                                    </button>
                                                                                </form>
                                                                                <hr>
                                                                                <p class="text-muted"><i class="fa fa-money"></i> {{__('Poddoor')}}</p>

                                                                            @else

                                                                                <h4 class="text-red">{{ __('Preorder not available with this payment gateway') }}</h4>

                                                                            @endif

                                                                        @endif
                                                                    @else
                                                                        <h4>
                                                                            <h4>{{ __('COD') }} {{__('Not Available') }}
                                                                                <b>{{ session()->get('currency')['id'] }}</b>.</h4>
                                                                        </h4>
                                                                    @endif
                                                                </div>
                                                            @else

                                                                <div class="tab-pane" id="codpaytab">

                                                                    @if(in_array(0, $codcheck))
                                                                        <span span class="required">{{__('Some Product Not Support')}}</span>
                                                                    @else
                                                                        @php
                                                                            $token = str_random(25);
                                                                        @endphp
                                                                        <h3>{{__('Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
                                                                            <span class="payment_amount_label">
                                                                        {{ price_format(Crypt::decrypt($secure_amount)) }}
                                                                    </span></h3>
                                                                        <hr>
                                                                        @if(pre_order_disable() == false)

                                                                            <form action="{{ route('cod.process',$token) }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="actualtotal" value="{{ $un_sec }}">
                                                                                <input type="hidden" name="amount" class="total_secure_amount" value="{{ $secure_amount }}">
                                                                                <button title="Pay With Cash @ Delivery Time" type="submit" class="cod-buy-now-button">
                                                                                    <span>{{__('Pod')}}</span> <i class="fa fa-money"></i>
                                                                                </button>
                                                                            </form>
                                                                            <hr>
                                                                            <p class="text-muted"><i class="fa fa-money"></i> {{__('Poddoor')}}</p>

                                                                        @else

                                                                            <h4 class="text-red">{{ __('Preorder not available with this cash on delivery.') }}</h4>

                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            @endif

                                                        @else
                                                            <div class="tab-pane" id="codpaytab">
                                                                <h4 class="text-danger">
                                                                    {{__("Cash on delivery is not available yet !")}}
                                                                </h4>
                                                            </div>
                                                        @endif

                                                        <!-- <div class="tab-pane fade" id="v-pills-instamojo" role="tabpanel" aria-labelledby="v-pills-instamojo-tab" tabindex="0">
                                                        </div> -->
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- <div class="deals-btn">
                                                <ul class="d-flex">
                                                    <li><a href="#" title="Pay Now" type="button" class="btn btn-primary">Pay Now</a></li>
                                                    <li><a href="#" title="Back to Cart" type="button" class="btn btn-warning">Back to Cart</a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="cart-block">
                        <h4 class="section-title">{{__('Payment Details')}}</h4>
                        @if($shipping_coupan_status == 1 && $shipping_coupan_per_price != '')
                            <table class="table d-none">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total totals-value" id="cart-total">

                                            <div class="row">
                                                <div class="col-md-7 col-7" style="margin-left: -16px;">{{__('Free Shipping Coupan')}}</div>
                                                <div class="col-md-7 col-7">

                                            <span class="" id="show-total">
                                                <input type="text" class="form-control" name="freeshipping" id="freeshipping" placeholder="Free Shipping Code">


                                            </span>
                                                </div>
                                                <div class="col-md-5 col-5">
                                                    <button type="submit" class="btn btn-primary" onclick="freeshippingcode()" >Apply Now</button>
                                                </div>
                                            </div>
                                            <strong style="color: red;float: left;" id="shiping_error_msg"></strong>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        @endif
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 70%;">{{__('Subtotal')}}</td>
                                @php
                                    $total = '0';
                                    foreach ($cart_table as $key => $val) {

                                        if($val->active_cart == 1){

                                        if($val->product && $val->variant){
                                            if ($val->product->tax_r != null && $val->product->tax == 0) {

                                                if ($val->ori_offer_price != 0) {
                                                    //get per product tax amount
                                                    $p = 100;
                                                    $taxrate_db = $val->product->tax_r;
                                                    $vp = $p + $taxrate_db;
                                                    $taxAmnt = intval($val->product->offer_price) / intval($vp) * intval($taxrate_db);
                                                    $taxAmnt = sprintf("%.2f", $taxAmnt);
                                                    $price = ($val->ori_offer_price - $taxAmnt) * $val->qty;

                                                } else {

                                                    $p = 100;
                                                    $taxrate_db = $val->product->tax_r;
                                                    $vp = $p + $taxrate_db;
                                                    $taxAmnt = $val->product->price / $vp * $taxrate_db;

                                                    $taxAmnt = sprintf("%.2f", $taxAmnt);

                                                    $price = ($val->ori_price - $taxAmnt) * $val->qty;
                                                }

                                            } else {

                                                if ($val->semi_total != 0) {

                                                    $price = $val->semi_total;

                                                } else {

                                                    $price = $val->price_total;

                                                }
                                            }
                                        }

                                        if($val->simple_product){
                                            if ($val->semi_total != 0) {

                                                $price = $val->semi_total - $val->tax_amount;

                                            } else {

                                                $price = $val->price_total - $val->tax_amount;

                                            }
                                        }

                                        $total = $total + $price;

                                        }

                                    }

                                @endphp
                                <td><i class="{{session()->get('currency')['value']}}"></i> {{price_format($total*$conversion_rate,2)}}</td>
                            </tr>
                            @if(Session::get('gift'))
                                <tr>
                                    <td style="width: 70%;">{{ __('Gift Discount') }}</td>
                                    <td><i class="{{session()->get('currency')['value']}}"></i> {{Session::get('gift')['discount']}}</td>
                                </tr>
                            @endif

                            {{--                                <tr>--}}
                            {{--                                    <td style="width: 70%;">{{__('Tax')}}</td>--}}
                            {{--                                    <td>--}}
                            {{--                                        <span class="" id="show-total">--}}

                            {{--                                            <i class="{{session()->get('currency')['value']}}"></i> {{price_format($total_tax_amount)}}--}}

                            {{--                                        </span>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}

                            <tr>
                                <td style="width: 70%;">{{__('Shipping')}}</td>
                                <td>
                                    @if($shippingChage)
                                        <i class="{{session()->get('currency')['value']}}"></i> {{$shippingChage}}
                                    @else
                                        Free
                                    @endif
                                </td>
                            </tr>

                            @if(Auth::check() && App\Cart::isCoupanApplied() == 1)
                                <tr>
                                    <td style="width: 70%;">{{ __('Discount') }}</td>
                                    <td><i class="{{session()->get('currency')['value']}}"></i> {{price_format(App\Cart::getDiscount()*$conversion_rate,2)}}</td>
                                </tr>
                            @endif

                            @if($total_gift_pkg_charge != 0)
                                <tr>
                                    <td style="width: 70%;">{{__('Gift Charge')}}</td>
                                    <td>
                                        <i class="{{session()->get('currency')['value']}}"></i> {{  price_format($total_gift_pkg_charge) }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td style="width: 70%;">{{__('Handling Charge')}}</td>
                                <td>
                                    <i class="{{session()->get('currency')['value']}}"></i> {{  price_format($handlingcharge) }}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <table class="table total-amount-table">
                            <tbody>
                            <tr>
                                <td style="width: 70%;">{{ __('Total') }}</td>
                                <td>
                                    @php
                                        $secure_pay =0;
                                        $total = sprintf("%.2f",$total*$conversion_rate);
                                        $totals = sprintf("%.2f",$total_shipping*$conversion_rate);
                                        $secure_pay = sprintf("%.2f",$totals + $total + $total_tax_amount + $shippingChage ?? $shippingChage);

                                        if(App\Cart::isCoupanApplied() == '1'){
                                        $secure_pay = sprintf("%.2f",$secure_pay - App\Cart::getDiscount()*$conversion_rate);
                                        }

                                        $secure_pay = sprintf("%.2f",$secure_pay + $handlingcharge + $total_gift_pkg_charge );

                                    @endphp
                                    <i class="{{session()->get('currency')['value']}}"></i>
                                    <span id="grandtotal">

                                            @if( Session::get('gift'))
                                            <span class="payment_amount_label">
                                                {{ price_format($secure_pay) - Session::get('gift')['discount']}}
                                                </span>

                                            <input type="hidden" id="getgrandtotal" value=" {{ price_format($secure_pay) - Session::get('gift')['discount']}}">
                                        @else
                                            <span class="payment_amount_label">
                                                {{ price_format($secure_pay)  }}
                                                </span>

                                            <input type="hidden" id="getgrandtotal" value=" {{ price_format($secure_pay)  }}">
                                        @endif

                                        </span>
                                    @php
                                        session()->put('payamount',sprintf("%.2f",$secure_pay));
                                    @endphp
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

</div>
@endsection

@section('script')

<script src="{{ url('front/vendor/js/card.js') }}"></script>
<script>
  var baseUrl = @json(url('/'));
  var carttotal = @json($total);
</script>
<script src="{{ url('js/orderpincode.js') }}"></script>
<script src="{{ url('js/ajaxlocationlist.js') }}"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.20.0/js/dropin.min.js"></script>

<script>
  var client_token = null;

  $(function () {
    var total_price = $('#getgrandtotal').val();
    var min_purchase_price = <?php echo $genrals_settings->min_pur_amount; ?>;
    if(total_price >=  min_purchase_price){
      $('#on_button').css({display: 'block'});
      $('#off_button').css({display: 'none'});
    }else{
      $('#on_button').css({display: 'none'});
      $('#off_button').css({display: 'block'});
    }

    $('.bt-btn').on('click', function () {
      $('.bt-btn').addClass('load');
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "GET",
        url: "{{ route('bttoken') }}",
        success: function (t) {
          if (t.client != null) {
            client_token = t.client;
            btform(client_token);
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
          $('.bt-btn').removeClass('load');
          alert('Payment error. Please try again later.');
        }
      });
    });
  });

  function freeshippingcode(){
    var getfreeshippingcode = '<?php echo $shipping_coupan; ?>';
    var freeshipping = $('#freeshipping').val();
    var get_shipping_value='<?php echo $shippingChage ?>';
    var grand_total = $('#getgrandtotal').val();
    // var grand_total = $('#getgrandtotal').val().toFixed(2);
    var new_shipping_value = $('#new_shpping').val();

    if(freeshipping){
      $('#new_shpping').text(0);
      var total_amount = parseFloat(grand_total) - parseFloat(get_shipping_value);
      $('.payment_amount_label').text(total_amount);
    //   $('.payment_amount_label').text((total_amount).toFixed(2));
      $('#shiping_error_msg').text('');
    }else{
      $('#new_shpping').text(get_shipping_value);
      var total_amount = parseFloat(grand_total);
      $('.payment_amount_label').text(total_amount);
    //   $('.payment_amount_label').text(total_amount).toFixed(2);
      $('#shiping_error_msg').text('Invalid shipping code!');
    }
 
  }

  function handlingcharge(id){
    var jQueryArray = '<?php echo json_encode($handing_charge_array); ?>';
    var obj = JSON.parse(jQueryArray)
    var gethandlingcharge = 0;
    var totalhandlingcharge = 0;
    if (obj[id] != '' && typeof obj[id] !== "undefined"){
      var gethandlingcharge = obj[id];
    }
    var grand_total = $('#getgrandtotal').val();
    var oldhiddenhandingcharge = $('#hiddenhandingcharge').val();
    var total_amount = parseFloat(grand_total) - parseFloat(oldhiddenhandingcharge) + parseFloat(gethandlingcharge);
    console.log(total_amount);
    $('.payment_amount_label').text((total_amount).toFixed(2));
    var total_amount_pay = "Pay " + total_amount;
    $('.total_amount_pay').val(total_amount_pay).toFixed(2);
    $('.total_secure_amount').val(total_amount);
    $('.total_paystack_amount').val(parseFloat(total_amount*100));
    $('.payment_handling_label').text(gethandlingcharge);
    console.log(total_amount);

  }

  function btform(token) {
    var payform = document.querySelector('#bt-form');
    braintree.dropin.create({
      authorization: token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      },
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        swal({
          title: "Oops ! ",
          text: 'Payment Error please try again later !',
          icon: 'warning'
        });
        $('.preL').fadeOut('fast');
        $('.preloader3').fadeOut('fast');
        return false;
      } else {
        $('.bt-btn').hide();
        $('.payment-final-bt').removeClass('d-none');
      }
      payform.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            swal({
              title: "Oops ! ",
              text: 'Payment Error please try again later !',
              icon: 'warning'
            });
            $('.preL').fadeOut('fast');
            $('.preloader3').fadeOut('fast');
            return false;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          payform.submit();
        });
      });
    });
  }

  $('.gift_pkg_charge').on('change',function(){

    var variant = $(this).data('variant');

     if($(this).is(":checked")){
        
        var charge  = $(this).data('gift_charge');

        axios.post('{{ route("apply.giftcharge") }}',{
          variant : variant,
          charge  : charge
        }).then(res => {
          console.log(res.data);
          if(res.data == 'applied'){

            location.reload();

          }
        }).catch(err => {
            console.log(err);
        });

     }else{
        axios.post('{{ route("reset.giftcharge") }}',{
          variant : variant,
        }).then(res => {

          if(res.data == 'removed'){

            location.reload();

          }

        }).catch(err => {
            console.log(err);
        });
     }



  });
  $('.nav-link').on('click',function(e){
    console.log($(this).attr('href'));
  })

</script>
@if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())
  
    @include("bkash::front.bkashscript")
 
@endif

@stack('payment-script')

@endsection