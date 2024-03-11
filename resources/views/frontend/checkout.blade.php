@extends("frontend.layout.master")
@section('title','BoiBari | Checkout')
@section("content")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
   <div style="background-color: #fff8f5">
       <!-- Home Start -->
       <section id="home" class="home-main-block">
           <div class="container ">
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

                                               <h4 class="text-danger pb-2">Select any Address for Delivery</h4>

                                               <form action="{{route('choose.address')}}" method="post">
                                                   @csrf
                                                   <input type="hidden" name="total" value="{{$total}}">
                                                   {{--                                                <input type="text" name="total" value="{{$total}}">--}}
                                                   @if(count($addresses))
                                                       <div class="form-check mb-3">
                                                           <input class="form-check-input" type="radio" name="seladd" checked="checked" value="{{ $addresses[0]->id }}" id="flexRadioDefault1">
                                                           <label class="form-check-label" for="flexRadioDefault1">
                                                               {{ $addresses[0]->getDivisions->bn_name }} => {{ $addresses[0]->getdistrict->bn_name }} => {{ $addresses[0]->getupazila->bn_name }} => {{ $addresses[0]->getunion->bn_name }}
                                                               {{--                                                            {{ $addresses[0]->getDivisions->bn_name }} => {{ $addresses[0]->getdistrict->bn_name }}--}}
                                                           </label>
                                                       </div>
                                                       @foreach($addresses as $key => $address)
                                                           @if($key > 0)
                                                               <div class="form-check">
                                                                   <input class="form-check-input " type="radio" name="seladd"  value="{{ $address->id }}" id="flexRadioDefault{{ $address->id }}">
                                                                   <label class="form-check-label" for="flexRadioDefault{{ $address->id }}">
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

                           {{--                        <div class="checkout-block accordion-item">--}}
                           {{--                            <div class="checkout-shipping-method accordion-header">--}}
                           {{--                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">{{__('C.')}} {{__('Billing Information')}}</h3>--}}
                           {{--                            </div>--}}
                           {{--                        </div>--}}

                           {{--                        <div class="checkout-block accordion-item">--}}
                           {{--                            <div class="checkout-shipping-method accordion-header">--}}
                           {{--                                <h3 class="section-title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">{{__('D. Order Review')}}</h3>--}}
                           {{--                            </div>--}}
                           {{--                        </div>--}}

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
                                   <td><i class="{{session()->get('currency')['value']}}"></i> {{price_format($total*$conversion_rate,2)}}</td>
                               </tr>
                               <tr>
                                   <td style="width: 70%;">{{__('Curier Charge')}}</td>
                                   <td><i class="{{session()->get('shippingcharge')}}"></i> {{price_format($shippingcharge*$conversion_rate,2)}}</td>
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
                                       <td class="wishlist-out-stock"><i class="{{session()->get('currency')['value']}}"></i> {{price_format(App\Cart::getDiscount()*$conversion_rate,2)}}</td>
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
                                               {{price_format($grandtotal*$conversion_rate,2) - Session::get('gift')['discount']}}
                                           @else
                                               {{price_format($grandtotal*$conversion_rate,2)}}
                                           @endif
                                       @else
                                           @if(Session::get('gift'))
                                               {{price_format(($grandtotal-App\Cart::getDiscount())*$conversion_rate,2) - Session::get('gift')['discount']}}
                                           @else
                                               {{price_format(($grandtotal-App\Cart::getDiscount())*$conversion_rate,2)}}
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
       </section>
       <!-- Checkout End -->

   </div>
@endsection
@section('script')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $("#select_location").select2({
            placeholder: "Select a programming language",
            allowClear: true
        });
        $("#select_location").select2({
            minimumInputLength: 2
        });
    </script>
    <script>
        function selectCity(city_id) {
            var up = $('#select_state').empty();
            var up1 = $('#select_country').empty();
            var cat_id = city_id;

            if (cat_id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: baseUrl + '/admin/select_state_country',
                    data: {
                        catId: cat_id
                    },
                    success: function (data) {
                        console.log(data);
                        // $('#country_id').append('<option value="">Please Choose</option>');
                        // up.append('<option value="">Please Choose</option>');
                        $.each(data.states, function (id, title) {
                            up.append($('<option>', {
                                value: id,
                                text: title
                            }));
                        });

                        $.each(data.country, function (id, title) {
                            up1.append($('<option>', {
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
        }
    </script>
@endsection