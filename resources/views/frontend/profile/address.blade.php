@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<div style="background-color: #fff8f5">
  <!-- Home Start -->
  <section id="home" class="home-main-block product-home">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav aria-label="breadcrumb" class="breadcrumb-main-block">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
              <li class="breadcrumb-item">{{__('Account')}}</li>
              <li class="breadcrumb-item active" aria-current="page">{{__('Manage Address')}}</li>
            </ol>
          </nav>
          <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
            <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">{{__('Manage Address')}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home End -->

  <!-- My Account Start -->
  <section id="my-account" class="my-account-main-block popular-item-main-block">
    <div class="container bg-white">
      <div class="row">
        <?php $active['active'] = 'Address'; ?>
        @include('frontend.profile.sidebar',$active)
        <div class="col-lg-9 col-md-8">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="personal-info-block">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="section-title">{{ __('Manage Address') }}</h3>
                </div>
                <div class="col-lg-6">
                  <a href="javascript:" data-bs-toggle="modal" data-bs-target="#mngaddress" class="btn btn-info"><i data-feather="plus" width="18px" height="18px"></i> {{ __('Add New') }}</a>
                  <!-- Add Modal -->
                  <div class="modal fade" id="mngaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <div class="card-body">
                <div class="row mt-4">
                  @if(count($addresss)>0)
                    @foreach($addresss as $key => $address)
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
                              @if($address->defaddress == 1)
                                <div class="ribbon ribbon-top-right"><span>{{ __('Default') }}</span></div>
                              @endif
                            </div>
                          </td>
                          <td style="width: 60%">
                            <p>{{ strip_tags($address->address) }}</p>
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
                    {{ $addresss->links() }}
                  @else
                    <h2><a class="cursor" data-target="#mngaddress" data-toggle="modal">{{ __('No Address') }}</a></h2>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Account End -->

</div>
@endsection
@section("script")




    @endsection
