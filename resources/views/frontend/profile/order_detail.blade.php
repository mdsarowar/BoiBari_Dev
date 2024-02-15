@extends("frontend.layout.master")
@php
$sellerac = App\Store::where('user_id','=', $user->id)->first();
@endphp
@section('title',"BoiBari | View Order #$inv_cus->order_prefix$order->order_id")
@section("content")   
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
                            <li class="breadcrumb-item">{{__('Order')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Order Details')}}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{__('Order Details')}}</h3>
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
                <?php $active['active'] = 'Myorder'; ?>
                @include('frontend.profile.sidebar',$active)
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="py-30">
                            <div class="order-review-block">

                                @php
                                    $checkOrderCancel = $order->cancellog;
                                    $orderlog = $order->fullordercancellog;
                                    $deliverycheck = array();
                                    $tstatus = 0;
                                    $cancel_valid = array();
                                @endphp

                                @if(count($order->invoices)>1)

                                    @foreach($order->invoices as $inv)
                                        @if($inv->variant)

                                            @if($inv->variant->products->cancel_avl != 0)
                                                @php
                                                    array_push($cancel_valid,1);
                                                @endphp
                                            @else
                                                @php
                                                    array_push($cancel_valid,0);
                                                @endphp
                                            @endif

                                        @endif
                                    @endforeach

                                @else
                                    @php
                                        array_push($cancel_valid,0);
                                    @endphp
                                @endif

                                @if(isset($order))
                                    @foreach($order->invoices as $sorder)
                                        @if($sorder->status == 'delivered' || $sorder->status == 'cancel_request' || $sorder->status
                                        =='return_request' || $sorder->status == 'returned' || $sorder->status == 'refunded' || $sorder->status ==
                                        'ret_ref')
                                            @php
                                                array_push($deliverycheck, 0);
                                            @endphp
                                        @else
                                            @php
                                                array_push($deliverycheck, 1);
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif



                                @if(in_array(0, $deliverycheck))
                                    @php
                                        $tstatus = 1;
                                    @endphp
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{__('Shipping Address')}}</th>
                                            <th scope="col">{{__('Billing Address')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><b> {{ $address->name }}, {{ $address->phone }}</b></td>
                                            <td><b>{{ $order->billing_address['firstname'] }}, {{ $order->billing_address['mobile'] }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>{{ strip_tags($address->address) }}</td>
                                            <td>{{ strip_tags($order->billing_address['address']) }}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $bildivision= App\Division::where('id',$order->billing_address['division_id'])->first()->bn_name;
                                                $bildistrict = App\Districts::where('id',$order->billing_address['district_id'])->first()->bn_name;
                                                $bilupazila = App\Upazilas::where('id',$order->billing_address['upazila_id'])->first()->bn_name;
                                                $bilunion = App\Unions::where('id',$order->billing_address['union_id'])->first()->bn_name;
                                            @endphp
                                            @php
                                                $shdivision= App\Division::where('id',$address->division_id)->first()->bn_name;
                                                $shdistrict= App\Districts::where('id',$address->district_id)->first()->bn_name;
                                                $shupazila= App\Upazilas::where('id',$address->upazila_id)->first()->bn_name;
                                                $shunion= App\Unions::where('id',$address->union_id)->first()->bn_name;
                                            @endphp
                                            <td>{{ $shdivision }}, {{ $shdistrict }}, {{ $shupazila }}, {{ $shunion }}</td>
                                            <td>{{ $bildivision }}, {{ $bildistrict }}, {{ $bilupazila }}, {{ $bilunion }}</td>
                                            {{--                                            @php--}}
                                            {{--                                                $c = App\Allcountry::where('id',$order->billing_address['country_id'])->first()->nicename;--}}
                                            {{--                                                $s = App\Allstate::where('id',$order->billing_address['state'])->first()->name;--}}
                                            {{--                                                $ci = App\Allcity::where('id',$order->billing_address['city'])->first() ? App\Allcity::where('id',$order->billing_address['city'])->first()->name : '';--}}
                                            {{--                                            @endphp--}}
                                            {{--                                            <td>{{ $ci }}, {{ $s }}, {{ $ci }}</td>--}}
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered order-view-dtl-table">
                                        <thead>
                                        <tr>
                                            <td>
                                                <b>Transcation ID:</b> {{ $order->transaction_id }}
                                            </td>
                                            <td>
                                                <b>Payment Method:</b> {{ $order->payment_method }}
                                            </td>
                                            <td>
                                                <b>Order Date: </b> {{ date('d-m-Y',strtotime($order->created_at)) }}
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                @foreach($order->invoices as $o)

                                    @php
                                        $orivar = $o->variant;
                                    @endphp

                                    <div class="order-view-dtl-page mt-4">
                                        <div class="order-view-header">
                                            <div class="order-view-title">
                                                @if($o->status == 'delivered' || $o->status == 'return_request')
                                                    <a title="Click to View or print" href="{{ route('user.get.invoice',$o->id) }}"
                                                       class="float-right btn btn-sm btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                        {{ __('Invoice') }}
                                                    </a>
                                                @endif

                                                @if($o->status == 'delivered')
                                                    @if(isset($o->simple_product) && $o->simple_product->type == 'd_product')
                                                        <a title="Download your item" href="{{ URL::temporarySignedRoute('user.download.order', now()->addMinutes(2), ['orderid' => $o->id]) }}"
                                                           class="mr-2 float-right btn btn-sm bg-success text-light"><i class="fa fa-download" aria-hidden="true"></i>
                                                            {{ __('Download') }}
                                                        </a>
                                                    @endif
                                                @endif

                                                @if(isset($orivar->products))
                                                    @if($orivar->products->return_avbl == '1' && $o->status == 'delivered')
                                                        @php
                                                            $days = $orivar->products->returnPolicy->days;
                                                            $endOn = date("d-M-Y", strtotime("$o->updated_at +$days days"));
                                                            $today = date('d-M-Y');
                                                        @endphp

                                                        @if($today == $endOn)
                                                            <a aria-disabled="true" href="javascript:" class="mr-2 btn btn-sm btn-danger disabled">{{ __('Return period is ended !') }}</a>
                                                        @else
                                                            <!--END-->
                                                            <a class="mr-2 btn btn-sm btn-danger" href="{{ route('return.window',Crypt::encrypt($o->id)) }}">{{ __('Return') }}</a>
                                                        @endif
                                                    @else
                                                        <a aria-disabled="true" class="mr-2 btn btn-sm btn-danger disabled">{{ __('Return not available !') }} </a>
                                                    @endif

                                                @elseif(isset($o->simple_product) && $o->status == 'delivered')

                                                    @if($o->simple_product->return_avbl == '1')

                                                        @php

                                                            $days = $o->simple_product->returnPolicy->days;
                                                            $endOn = date("d-M-Y", strtotime("$o->updated_at +$days days"));
                                                            $today = date('d-M-Y');

                                                        @endphp

                                                        @if($today == $endOn)
                                                            <a aria-disabled="true" href="javascript:" class="mr-2 btn btn-sm btn-danger disabled">{{ __('Return period is ended !') }}</a>
                                                        @else
                                                            <!--END-->
                                                            <a class="mr-2 btn btn-sm btn-danger" href="{{ route('return.window',Crypt::encrypt($o->id)) }}">{{ __('Return') }}</a>
                                                        @endif
                                                    @else
                                                        <a aria-disabled="true" class="mr-2 btn btn-sm btn-danger disabled">{{ __('Return not available !') }} </a>
                                                    @endif

                                                @endif

                                                @if(isset($orivar->products))
                                                    @if($orivar->products->cancel_avl == '1')
                                                        @if($o->status == 'pending' || $o->status == 'processed')
                                                            @php
                                                                $secureid = Crypt::encrypt($o->id);
                                                            @endphp
                                                            <a @if(env('DEMO_LOCK')==0) title="Cancel This Order?" data-toggle="modal" data-target="#proceedCanItem{{ $o->id }}" @else disabled="disabled" title="This action is disabled in demo !" @endif class="btn btn-sm btn-danger">{{__('Cancel')}}</a>
                                                        @else
                                                            <a aria-disabled="true" title="Cancel This Order" class="btn btn-sm btn-danger disabled" href="javascript:">Cancel</a>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if(!in_array($o->status,['shipped','delivered','refunded','return_request','ret_ref','Refund Pending','canceled']))

                                                        @if($o->simple_product && $o->simple_product->cancel_avbl == '1')
                                                            <a @if(env('DEMO_LOCK')==0) title="Cancel This Order?" data-toggle="modal" data-target="#proceedCanItem{{ $o->id }}" @else disabled="disabled" title="This action is disabled in demo !" @endif class="btn btn-sm btn-danger">{{__('Cancel')}}</a>
                                                        @else
                                                            <a aria-disabled="true" title="Cancel This Order" class="btn btn-sm btn-danger disabled" href="javascript:">Cancel</a>
                                                        @endif

                                                    @endif
                                                @endif



                                                @if( isset($o->variant) || isset($o->simple_product) )
                                                    <div class="modal fade" id="proceedCanItem{{ $o->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Item:
                                                                        @if($o->variant)
                                                                            {{$orivar->products->name}}
                                                                            ({{variantname($o->variant)}})
                                                                        @endif

                                                                        @if($o->simple_product)
                                                                            {{ $o->simple_product->product_name }}
                                                                        @endif
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if(!in_array($o->status,['shipped','canceled','delivered','Refund Pending','ret_ref','refunded','return_request','shipped']))
                                                                        <form action="{{ route('cancel.item',Crypt::encrypt($o->id)) }}" method="POST">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="font-weight-normal" for="">{{ __('Choose Reason') }} <span class="required">*</span></label>
                                                                                <select class="form-control" required="" name="comment" id="">
                                                                                    <option value="">{{ __('Please Choos eReason') }}</option>
                                                                                    @forelse(App\RMA::where('status','=','1')->get() as $rma)
                                                                                        <option value="{{ $rma->reason }}">{{ $rma->reason }}</option>
                                                                                    @empty
                                                                                        <option value="Other">{{ __('My Reason is not listed here') }}</option>
                                                                                    @endforelse
                                                                                </select>
                                                                            </div>
                                                                            @if($order->payment_method !='COD' && $order->payment_method !='BankTransfer')
                                                                                <div class="form-group">
                                                                                    <label class="font-weight-normal" for="">{{ __('Choose Refund Method') }}: </label>
                                                                                    <label class="font-weight-normal"><input onclick="hideBank('{{ $o->id }}')" id="source_check_o{{ $o->id }}" required type="radio" value="orignal" name="source" />{{ __('Orignal Source') }} [{{ $o->order->payment_method }}] </label>&nbsp;&nbsp;
                                                                                    @if(Auth::user()->banks()->count())
                                                                                        <label class="font-weight-normal"><input onclick="showBank('{{ $o->id }}')" id="source_check_b{{ $o->id }}" required type="radio" value="bank" name="source" /> {{ __('In Bank') }}</label>
                                                                                        <select name="bank_id" id="bank_id_single{{ $o->id }}" class="display-none form-control">
                                                                                            @foreach(Auth::user()->banks as $bank)
                                                                                                <option value="{{ $bank->id }}">{{ $bank->bankname }} ({{ $bank->acno }})</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    @else
                                                                                        <label class="font-weight-normal"><input disabled="disabled" type="radio" /> {{ __('In Bank') }} <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Add a bank account in My Bank Account" aria-hidden="true"></i></label>
                                                                                    @endif
                                                                                </div>
                                                                            @else

                                                                                @if(Auth::user()->banks()->count())
                                                                                    <label class="font-weight-normal"><input onclick="showBank('{{ $o->id }}')" id="source_check_b{{ $o->id }}" required type="radio" value="bank" name="source" />{{ __('In Bank') }}</label>
                                                                                    <select name="bank_id" id="bank_id_single{{ $o->id }}" class="form-control display-none">
                                                                                        @foreach(Auth::user()->banks as $bank)
                                                                                            <option value="{{ $bank->id }}">{{ $bank->bankname }} ({{ $bank->acno }})</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @else
                                                                                    <label class="font-weight-normal"><input disabled="disabled" type="radio" /> {{ __('In Bank') }} <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Add a bank account in My Bank Account" aria-hidden="true"></i></label>
                                                                                @endif


                                                                            @endif
                                                                            <div class="alert alert-info">
                                                                                <h5><i class="fa fa-info-circle"></i> {{ __('Important') }} !</h5>

                                                                                <ol class="font-weight600 sq">
                                                                                    <li>{{ __('IF Original source is choosen than amount will be reflected to your orignal source in 1-2 days(approx)') }}.</li>

                                                                                    <li>
                                                                                        {{ __('IF Bank Method is choosen than make your you added a bank account else refund will not procced. IF already added than it will take 14 days to reflect amount in your bank account (Working Days*)') }}*).
                                                                                    </li>

                                                                                    <li>{{ __('Amount will be paid in original currency which used at time of placed order') }}.</li>

                                                                                </ol>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-md btn-info">
                                                                                {{ __('Procced') }}...
                                                                            </button>
                                                                            <p class="help-block">{{ __('This action cannot be undone') }} !</p>
                                                                            <p class="help-block">{{ __('It will take time please do not close or refresh window') }} !</p>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="order-view-body">
                                            <div id="OrderRow62" class="full-order-main-block">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                                                        @if(isset($orivar))
                                                            @if(isset($orivar->variantimages) && file_exists(public_path().'/variantimages/thumbnails/'.$orivar->variantimages->main_image))
                                                                <img class="img-fluid pro-img2" src="{{url('variantimages/thumbnails/'.$orivar->variantimages->main_image)}}" alt="Product Image" />
                                                            @else
                                                                <img class="img-fluid pro-img2" src="{{ Avatar::create($orivar->products->name)->toBase64() }}" alt="Product Image" />
                                                            @endif
                                                        @endif

                                                        @if($o->simple_product)

                                                            @if($o->simple_product->thumbnail != '' && file_exists(public_path().'/images/simple_products/'.$o->simple_product->thumbnail))
                                                                <img class="img-fluid pro-img2" src="{{ url('images/simple_products/'.$o->simple_product->thumbnail) }}"/>
                                                            @else
                                                                <img class="img-fluid pro-img2" src="{{ Avatar::create($o->simple_product->product_name)->toBase64() }}"/>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-5 col-md-3 col-sm-3 col-7 full-order-main-block">
                                                        @if(isset($orivar->products))
                                                            <a target="_blank" href="{{ $orivar->products->getURL($orivar) }}"><b>{{substr($orivar->products->name, 0, 30)}}{{strlen($orivar->products->name)>30 ? '...' : ""}}</b>
                                                                <small>
                                                                    ({{variantname($o->variant)}})
                                                                </small>
                                                            </a>
                                                            <br>
                                                            {{--                                                        <small><b>{{ __('Sold By:') }}</b> {{$orivar->products->store->name}}</small>--}}
                                                        @endif
                                                        @if(isset($o->simple_product))
                                                            <a target="_blank" href="{{ route('show.product',['id' => $o->simple_product->id, 'slug' =>   $o->simple_product->slug]) }}">
                                                                <b>{{ $o->simple_product->product_name }}</b>
                                                            </a>
                                                            <br>
                                                            {{--                                                        <small><b>{{ __('Sold By') }}:</b> {{$o->simple_product->store->name}}</small>--}}
                                                        @endif
                                                        <br>
                                                        <small><b>Qty:</b> {{$o->qty}}</small>

                                                        @if($o->status == 'delivered')
                                                            <p>{{ __('Your Product is deliverd on') }} <br> <b>{{ date('d-m-Y @ h:i:a',strtotime($o->updated_at)) }}</b></p>
                                                        @endif

                                                        @if($o->status == 'return_request')
                                                            <span class="font-weight-normal badge badge-warning">{{ __('Return Requested') }}</span> <br>
                                                        @endif

                                                        @if($o->status == 'ret_ref')
                                                            <span class="font-weight-normal badge badge-success"> {{ __('Returned & Refunded') }}</span> <br>
                                                        @endif

                                                        @if($o->status == 'cancel_request')
                                                            <span class="font-weight-normal badge badge-danger"> {{ __('Cancellation requested') }} </span><br>
                                                        @endif

                                                        @if($o->status == 'canceled')
                                                            <span class="font-weight-normal badge badge-danger">{{ __('Cancelled') }} </span><br>
                                                        @endif

                                                        @if($o->status == 'refunded' || $o->status == 'return_request' || $o->status == 'returned' || $o->status == 'ret_ref')

                                                            @php
                                                                $refundlog = $o->refundlog;
                                                            @endphp


                                                            @if(isset($refundlog))

                                                                @if($refundlog->status == 'initiated')


                                                                    <small class="font-weight600">{{ __('Return Request Intiated with Ref. No:') }}
                                                                        [{{ $refundlog->txn_id }}]
                                                                        @if($refundlog->method_choosen == 'bank')
                                                                            <br>
                                                                            {{ __('Choosen bank:') }}

                                                                            @if(!$refundlog->bank)
                                                                                {{ __('Choosen bank has been deleted !') }}
                                                                            @else
                                                                                <u>{{$refundlog->bank->bankname}} (XXXX{{ substr($refundlog->bank->acno, -4) }})</u>
                                                                            @endif
                                                                        @endif
                                                                    </small>


                                                                @else

                                                                    @if($refundlog->method_choosen == 'orignal')

                                                                        <small class="font-weight600">{{ __('Refund Amount') }} <i
                                                                                    class="fa {{ $o->order->paid_in }}"></i>{{ $refundlog->amount }} {{ __('is') }}
                                                                            {{$refundlog->status}} {{ __('to your Requested payment source') }} {{ $refundlog->pay_mode }}
                                                                            {{ __('and will be reflected to your a/c in 1-2 working days.') }} <br> ({{ __('TXN ID:') }}
                                                                            {{ $refundlog->txn_id }})
                                                                        </small>

                                                                    @else

                                                                        <small class="font-weight600">
                                                                            {{ __('Refund Amount') }} <i class="fa {{ $o->order->paid_in }}"></i>
                                                                            {{ $refundlog->amount }} is
                                                                            {{$refundlog->status}} {{ __('to your Requested bank a/c') }} <u>{{$refundlog->bank->bankname ?? 'Bank account deleted'}}
                                                                                (XXXX{{ substr($refundlog->bank->acno, -4) }})</u> @if($refundlog->status !='refunded')
                                                                                {{ __('and will be reflected to your a/c in 1-2 working days.') }}@endif <br> (TXN ID:
                                                                            {{ $refundlog->txn_id }})
                                                                            .
                                                                            <br>
                                                                            @if($refundlog->txn_fee != '')
                                                                                {{ __('Transcation FEE Charge:') }} <i
                                                                                        class="fa {{ $o->order->paid_in }}"></i>{{ $refundlog->txn_fee }}
                                                                            @endif
                                                                        </small>

                                                                    @endif

                                                                @endif
                                                            @endif

                                                        @endif

                                                        @php

                                                            $log = App\CanceledOrders::where('inv_id', '=', $o->id)
                                                                                        ->where('user_id',Auth::user()->id)
                                                                                        ->with('bank')
                                                                                        ->first();

                                                            $orderlog = App\FullOrderCancelLog::where('order_id','=',$order->id)
                                                                                            ->with('bank')
                                                                                            ->first();
                                                        @endphp

                                                        @if(isset($log))



                                                            @if($log->method_choosen == 'orignal')

                                                                <small class="text-justify"><b>Refund Amount <u><i
                                                                                    class="fa {{ $o->order->paid_in }}"></i>{{$log->amount}}</u>
                                                                        {{ __('is refunded to original source') }} ({{ $o->order->payment_method }}).
                                                                        {{ __("IF it don't than it will take 1-2 days to reflect in your account.") }}
                                                                        <br>({{ __("TXN ID:") }} {{ $log->transaction_id }})</b></small>
                                                            @elseif($log->method_choosen == 'bank' && $log->is_refunded == 'pending' )
                                                                <small><b>{{ __('Refund Amount') }} <u><i
                                                                                    class="fa {{ $o->order->paid_in }}"></i>{{$log->amount}}</u>
                                                                        {{ __('is proceeded to your bank ac, amount will be reflected to your bank ac in 14 working days.') }}
                                                                        <br>
                                                                        ({{ __('Refrence No.') }} {{ $log->transaction_id }})</b></small>

                                                                @if(isset($log->bank))
                                                                    <br>
                                                                    <small><b>Choosen Bank: {{ $log->bank->bankname }} ({{ $log->bank->acno }})</b></small>
                                                                @else
                                                                    {{ __('Choosen Bank ac deleted !') }}
                                                                @endif
                                                            @elseif($log->method_choosen == 'bank' && $log->is_refunded == 'completed' )
                                                                <small><b>{{ __('Amount') }} <u><i class="fa {{ $o->order->paid_in }}"></i>{{$log->amount}}</u>
                                                                        {{ __('is refunded to your bank ac.') }} <br>
                                                                        @if($log->txn_fee !='')
                                                                            {{ __('Transcation FEE:') }} <i class="fa {{ $o->order->paid_in }}"></i>{{ $log->txn_fee }}

                                                                            @if(isset($log->bank))
                                                                                <br>
                                                                                <small><b>{{ __('Choosen Bank:') }} {{ $log->bank->bankname }} ({{ $log->bank->acno }})</b></small>
                                                                            @else
                                                                                {{ __('Choosen Bank ac deleted !') }}
                                                                            @endif
                                                                        @endif
                                                                        <br>({{ __('TXN ID:') }} {{ $log->transaction_id }})
                                                                    </b></small>
                                                            @endif

                                                        @elseif(isset($orderlog))



                                                            @if(in_array($o->id, $orderlog->inv_id))


                                                                @if($orderlog->method_choosen == 'orignal')

                                                                    <small><b>{{ __('Refund Amount') }} <u><i class="fa {{ $o->order->paid_in }}"></i>

                                                                                @if($o->order->discount !=0)

                                                                                    @if($o->order->distype == 'product')


                                                                                        @if($o->discount != 0)

                                                                                            {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                        @else

                                                                                            {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}

                                                                                        @endif



                                                                                    @elseif($o->order->distype == 'category')

                                                                                        @if($o->discount != 0)

                                                                                            {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                        @else
                                                                                            {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                        @endif

                                                                                    @elseif($o->order->distype == 'cart')

                                                                                        {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                    @endif

                                                                                @else
                                                                                    {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                @endif

                                                                            </u> {{ __('is refunded to original source') }} ({{ $o->order->payment_method }}).
                                                                            {{ __("IF it don't than it will take 1-2 days to reflect in your account.") }}
                                                                            <br>({{ __("TXN ID:") }} {{ $orderlog->txn_id }})</b></small>
                                                                @elseif($orderlog->method_choosen == 'bank' && $orderlog->is_refunded == 'pending' )
                                                                    <small><b>{{ __("Refund Amount") }} <u><i class="fa {{ $o->order->paid_in }}"></i>

                                                                                @if($o->order->discount !=0)

                                                                                    @if($o->order->distype == 'product')


                                                                                        @if($o->discount != 0)

                                                                                            {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                        @else

                                                                                            {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}

                                                                                        @endif



                                                                                    @elseif($o->order->distype == 'category')

                                                                                        @if($o->discount !=0 || $o->discount !='')

                                                                                            {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                        @else
                                                                                            {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                        @endif

                                                                                    @elseif($o->order->distype == 'cart')

                                                                                        {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                    @endif

                                                                                @else
                                                                                    {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                @endif

                                                                            </u>
                                                                            {{ __("is proceeded to your bank ac, amount will be reflected to your bank ac in 14 working days.") }}
                                                                            <br>
                                                                            ({{ __('Refrence No.') }} {{ $orderlog->txn_id }})</b></small>


                                                                    @if(isset($orderlog->bank))
                                                                        <br>
                                                                        <small><b>{{ __("Choosen Bank:") }} {{ $orderlog->bank->bankname }} ({{ $orderlog->bank->acno }})</b></small>
                                                                    @else
                                                                        {{ __("Choosen Bank ac modified or deleted !") }}
                                                                    @endif

                                                                @endif

                                                                @if($orderlog->method_choosen == 'bank' && $orderlog->is_refunded == 'completed' )

                                                                    @if(in_array($o->id, $orderlog->inv_id))
                                                                        <small><b>{{ __('Amount') }} <u><i class="fa {{ $o->order->paid_in }}"></i> @if($o->order->discount
                                                                            !=0)

                                                                                        @if($o->order->distype == 'product')

                                                                                            @if($o->discount != 0)

                                                                                                {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                            @else

                                                                                                {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}

                                                                                            @endif


                                                                                        @elseif($o->order->distype == 'category')

                                                                                            @if($o->discount != 0)

                                                                                                {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                            @else
                                                                                                {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                            @endif

                                                                                        @else

                                                                                            {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}

                                                                                        @endif

                                                                                    @else
                                                                                        {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                                    @endif </u> {{ __("is refunded to your bank ac.") }} <br>

                                                                                @if($orderlog->txn_fee !='')
                                                                                    {{ __("Transcation FEE:") }} <i class="fa {{ $order->paid_in }}"></i>{{ $orderlog->txn_fee }}
                                                                                @endif
                                                                                <br>({{ __("TXN ID:") }} {{ $orderlog->txn_id }})
                                                                            </b></small>
                                                                        @php
                                                                            $bank = $orderlog->bank;
                                                                        @endphp
                                                                        @if(isset($bank))
                                                                            <br>
                                                                            <small><b>{{ __("Choosen Bank:") }} {{ $bank->bankname }} ({{ $bank->acno }})</b></small>
                                                                        @else
                                                                            {{ __("Choosen Bank ac deleted !") }}
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        @endif

                                                        @if($o->local_pick =='')
                                                            @if($o->status == 'pending' || $o->status == 'processed' || $o->status == 'shipped')
                                                                <div class="mt-2">
                                                                    <a role="button" href="{{ route('track.order',['trackingid' => $o['tracking_id']]) }}" class="btn btn-info" title="Track">
                                                                        {{ __('Track') }}
                                                                    </a>
                                                                </div>

                                                                @if($o->courier_channel != '' && $o->tracking_link != '' && $o->exp_delivery_date != '')

                                                                    <p class="mt-2 font-weight-bold">
                                                                        {{__("Your order has been shipped via")}} {{ $o->courier_channel }} {{ __("you can track your package here with ") }} {{ $o->tracking_link }} {{__('and expected delivery date is :date',['date' => date("d-M-Y",strtotime($o->exp_delivery_date))] )}}.
                                                                    </p>

                                                                @endif

                                                            @endif
                                                        @else
                                                            @if($o->status != 'delivered' && $o->status !='refunded' && $o->status !='ret_ref' && $o->status
                                                            !='returned' && $o->status != 'canceled' && $o->status != 'return_request')
                                                                <hr>
                                                                <div class="col-md-12 card bg-light">

                                                                    <div class="card-body">
                                                                        <p><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                                            {{ __('Last Pickup Date') }}
                                                                        </p>
                                                                        <p class="font-weight600">
                                                                            {{ $o->loc_deliv_date == '' ? "Yet to update" : date('d/m/Y',strtotime($o->loc_deliv_date)) }} •
                                                                            <a title="Click to see store address" class="know_more" data-toggle="modal"
                                                                               data-target="#localpickModal{{ $o->id }}">
                                                                                {{__('Expand more')}}
                                                                            </a> </p>
                                                                    </div>

                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($o->status != 'delivered' && $o->local_pick != '')

                                                            <div class="modal fade" id="localpickModal{{ $o->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="p-2 modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h5 class="modal-title" id="myModalLabel">
                                                                                {{ __('Local Pickup Store Address') }}
                                                                            </h5>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <p>
                                                                                {{ __('Pick your Ordered Item') }}

                                                                                @if($o->variant)
                                                                                    <b>
                                                                                        {{ $o->variant->products->name }}
                                                                                        <small>({{ variantname($o->variant) }})</small>
                                                                                    </b>
                                                                                @else
                                                                                    <b>{{ $o->simple_product->product_name }}</b>
                                                                                @endif
                                                                                {{ __('From:') }}
                                                                            </p>

                                                                            {{--                                                                            @php--}}
                                                                            {{--                                                                            --}}
                                                                            {{--                                                                                $country = App\Allcountry::where('id',$o->seller->store->country_id)->first();--}}
                                                                            {{--                                                                                $state = App\Allstate::where('id',$o->seller->store->state_id)->first()->name;--}}
                                                                            {{--                                                                                $city = App\Allcity::where('id',$o->seller->store->city_id)->first()->name;--}}
                                                                            {{--                                                                                --}}
                                                                            {{--                                                                            @endphp--}}

                                                                            <div class="store_header">
                                                                                {{--                                                                                @if(isset($o->variant))--}}

                                                                                {{--                                                                            --}}

                                                                                {{--                                                                                <h5>{{ $o->variant->products->store->name }}</h5>--}}
                                                                                {{--                                                                                <p>{{ $o->variant->products->store->address }}</p>--}}
                                                                                {{--                                                                                <p>{{ $city }}, {{ $state }},{{ $country['nicename'] }}</p>--}}
                                                                                {{--                                                                                <p>{{ $o->variant->products->store->pin_code }}</p>--}}

                                                                                {{--                                                                                @elseif($o->simple_product)--}}
                                                                                {{--                                                                                <h5>{{ $o->seller->store->name }}</h5>--}}
                                                                                {{--                                                                                <p>{{ $o->seller->store->address }}</p>--}}
                                                                                {{--                                                                                <p>{{ $city }}, {{ $state }},{{ $country['nicename'] }}</p>--}}
                                                                                {{--                                                                                <p>{{ $o->seller->store->pin_code }}</p>--}}
                                                                                {{--                                                                                @endif--}}
                                                                            </div>
                                                                            <p></p>
                                                                            <p>{{ __('on') }} <b>{{ $o->loc_deliv_date !='' ? date('d/m/Y',strtotime($o->loc_deliv_date))  : "Yet to update" }}</b> </p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <b>
                                                            <i class="{{ $o->order->paid_in }}"></i>

                                                            @if($o->order->discount !=0)

                                                                @if($o->order->distype == 'product')

                                                                    {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}
                                                                    <small class="couponbox"><b>{{ $order->coupon }}</b> applied</small>

                                                                @elseif($o->order->distype == 'simple_product')

                                                                    {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}
                                                                    <small class="couponbox"><b>{{ $order->coupon }}</b> applied</small>


                                                                @elseif($o->order->distype == 'category')


                                                                    @if($o->discount != 0)
                                                                        {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}
                                                                        <small class="couponbox"><b>{{ $order->coupon }}</b> applied</small>
                                                                    @else
                                                                        {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                                    @endif



                                                                @elseif($o->order->distype == 'cart')

                                                                    <!-- {{ price_format(($o->qty*$o->price+$o->tax_amount+$o->shipping)-$o->discount,2) }}
                                                                    <small class="couponbox"><b>{{ $order->coupon }}</b> applied</small> -->
                                                                    {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}

                                                                @endif

                                                            @else
                                                                {{ price_format($o->qty*$o->price+$o->tax_amount+$o->shipping,2) }}
                                                            @endif



                                                        </b><br>
                                                        <small>(Incl. of tax &amp; shipping)</small>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach


                            </div>
                            <div class="card">
                                <table class="table">
                                    <tbody class="f-right">
                                    <tr>
                                        <td colspan="3"><b>{{ __('Total') }}:</b></td>
                                        <td><i class="{{ $order->paid_in }}"></i> {{ price_format($order->order_total+$order->discount ) }}</td>
                                    </tr>
                                    @if($o->order->distype == 'cart')
                                        <tr>
                                            <td colspan="3"><b>{{ __('Discount') }}:</td>
                                            <td><i class="{{ $order->paid_in }}"></i> {{ price_format($order->discount ) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3"><b>{{ __('Total Gift Charge') }}:</b></td>
                                        <td><i class="{{ $order->paid_in }}"></i> {{ price_format($order->gift_charge) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>{{ __('Handling Charge') }}:</b></td>
                                        <td><i class="{{ $order->paid_in }}"></i> {{ price_format($order->handlingcharge) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>{{ __('Order Total') }}:</b></td>
                                        <td><i class="{{ $order->paid_in }}"></i> {{ price_format(($order->order_total+$order->handlingcharge),2) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
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

@section('script')

<script src="{{ url('js/userorder.js') }}"></script>
<script>
      $('.source_check').on('click', function() {
        var source = $(this).val();
        if(source == 'bank') {
          $('#bank_id').show();
          $('#bank_id').attr('required', 'required');
        } else {
          $('#bank_id').hide();
          $('#bank_id').removeAttr('required');
        }
      });

      function hideBank(id) {
        $('#bank_id_single' + id).hide();
        $('#bank_id_single' + id).removeAttr('required');
      }

      function showBank(id) {
        $('#bank_id_single' + id).show();
        $('#bank_id_single' + id).attr('required', 'required');
      }
    </script>
@endsection

