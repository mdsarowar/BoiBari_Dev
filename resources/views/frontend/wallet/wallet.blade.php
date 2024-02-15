@extends("frontend.layout.master")
@section('title','Emart | My Wallet')
@section("content")   
<!-- Home Start -->
<section id="home" class="home-main-block product-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('My Wallet') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

<!-- Wallet Start -->
<section id="wishlist" class="wishlist-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="my-wallet-main-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="section-title">{{__('My Wallet')}}</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="current-balance text-success">{{__('Current Balance')}} :  
                                <i class="{{ $defCurrency->currency_symbol }}"></i>
                                @if(isset($user->wallet))
                                    {{ $user->wallet->balance }} 
                                @else 
                                    0.00 
                                @endif 
                                @if(isset($user->wallet) && $defCurrency->currency->code != session()->get('currency')['id'])
                                    <i class="{{ session()->get('currency')['value'] }}"></i> {{ price_format(currency($user->wallet->balance, $from = $defCurrency->currency->code, $to = session()->get('currency')['id'] , $format = false)) }}
                                @endif 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form id="mainform" action="{{ route('wallet.choose.paymethod') }}" method="POST">
                        @csrf
                        <div class="row g-0 mb-3">
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon wallet-cur-symbol" id="basic-addon1">
                                        <i class="fa fa-dollar"></i>
                                    </span>
                                    <input name="amount" required="" type="number" class="amountbox form-control" value="1.00" placeholder="0.00" min="1" step="0.01" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <button type="submit" class="pull-left btn btn-primary">
                                        {{__('Procced To Pay')}}...
                                    </button>
                                </div>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <i data-feather="lock"></i> {{__('Once the money is added in wallet its non refundable.')}}
                            </li>
                            <li>
                                <i data-feather="star"></i>{{__('You can use this money to purchase product on this portal.')}}
                            </li>
                            <li>
                                <i data-feather="info"></i> {{__('Money will expire after 1 year from credited date.')}}
                            </li>
                            <li>
                                <i data-feather="info"></i> {{__('Wallet amount will always added in default currency which is:')}}  <b>{{ $defCurrency->currency->code }}</b>
                            </li>
                        </ul>
                    </form>
                    <hr>
                    @if(isset($wallethistory))
                    <div class="wallet-history-block">
                        <h3 class="section-title"{{__('>Wallet History')}}</h3>
                        <hr>
                        @foreach($wallethistory->sortByDesc('id') as $history)
                        <div class="row">
                            <div class="col-lg-10">
                                <h6>{{ $history->log }}</h6>
                                <p>
                                    <small class="text-muted font-size-12 wallet-log-history-block">
                                        @if($history->type == 'Credit')
                                            <b>{{ __('Credited ON') }}: </b> {{ date('d/m/Y | h:i A',strtotime($history->created_at)) }} |
                                            <b>{{ __('Ref ID:') }}</b> {{ $history->txn_id }} | <b>{{ __('Expire ON:') }}</b>
                                            {{ date('d/m/Y | h:i A',strtotime($history->expire_at)) }}
                                        @else
                                            <b>{{ __('Debited ON') }}: </b> {{ date('d/m/Y | h:i A',strtotime($history->created_at)) }} |
                                            <b>{{ __('Ref ID:') }}</b> {{ $history->txn_id }}
                                        @endif
                                    </small>
                                </p>
                            </div>
                            <div class="col-lg-2">
                                <div class="current-balance {{ $history->type == 'Credit' ? "text-success" : "text-danger" }}">
                                    @if($history->type == 'Credit') 
                                        {{ __('+') }} 
                                    @else 
                                        {{ __('-') }} 
                                    @endif 
                                    <i class="{{ $defCurrency->currency_symbol }}"></i>{{ price_format($history->amount,2) }}
                                    @if(isset($user->wallet) && $defCurrency->currency->code != session()->get('currency')['id'])
                                        <small class="text-primary font-size-12">
                                            <br>
                                            <b>( <i class="{{ session()->get('currency')['value'] }}"></i> {{ price_format(currency($history->amount, $from = $defCurrency->currency->code, $to = session()->get('currency')['id'] , $format = false)) }})</b> 
                                        </small>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        <div>{!! $wallethistory->links() !!}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection