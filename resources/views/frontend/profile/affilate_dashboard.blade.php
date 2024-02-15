@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block product-home">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <nav aria-label="breadcrumb" class="breadcrumb-main-block">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
            <li class="breadcrumb-item">{{__('Account')}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{__('Affiliate Dashboard')}}</li>
          </ol>
        </nav>
        <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
          <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">{{__('Affiliate Dashboard')}}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Home End -->

<!-- My Account Start -->
<section id="my-account" class="my-account-main-block popular-item-main-block">
    <div class="container">
        <div class="row">
            <?php $active['active'] = 'Affilate'; ?>
            @include('frontend.profile.sidebar',$active)
            <div class="col-lg-9 col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="personal-info-block">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="section-title">{{ __('Affiliate Dashboard') }}</h3>
                                </div>
                                <div class="col-lg-6">
                                    <a href="javascript:" class="works-btn" data-bs-toggle="modal" data-bs-target="#howitworks" class="mt-2 h6">
                                        {{ __("How it works?") }}
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade" id="howitworks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! $aff_system->about_system !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="affiliate-link">
                            <h5 class="card-title">
                                {{__("Start refering your friends and start earning !!")}}
                            </h5>
                            <p class="card-text mt-4">
                                {{__("This is your unique refer link share with your friends and family and start earning !")}}
                            </p>
                            <div class="form-group mt-4">
                                <input type="text" readonly class="text-dark text-center form-control cptext" value="{{ route('register',['refercode' => auth()->user()->refer_code ]) }}">
                            </div>
                            <a href="javacript:" title="copy link" type="button" class="copylink btn btn-primary mt-4">
                                {{ __("Copy Link") }}
                            </a>
                        </div>
                        <div class="affiliate-history-block">
                            @if($aff_history->count())
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <h4>{{ __('Affiliate history') }}</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="affiliate-earning-title">{{ __('Total earning') }}  <i class="{{ $defCurrency->currency_symbol }}"></i> {{ $earning }}  
                                            @if(isset($user->wallet) && $defCurrency->currency->code != session()->get('currency')['id'])
                                            <small class="text-primary">
                                                <b>( <i class="{{ session()->get('currency')['value'] }}"></i> {{ sprintf("%.2f",currency($earning, $from = $defCurrency->currency->code, $to = session()->get('currency')['id'] , $format = false)) }})</b> 
                                            </small>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                                @foreach($aff_history as $history)
                                <div class="row py-2">
                                    <div class="col-lg-6">
                                        <div class="mb-2">{{ $history->log }}</div>
                                        <small class="text-muted wallet-log-history-block mt-4">
                                            @if($history->procces == 0)
                                                <p class="text-white bg-secondary">{{ __("Pending") }}</p>
                                            @else 
                                                <p class="text-white bg-success">{{ __("Credited to wallet") }}</p>
                                            @endif                
                                        </small>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="affiliate-history-price"> {{ __('+') }}  <i class="{{ $defCurrency->currency_symbol }}"></i> {{ sprintf("%.2f",$history->amount,2) }}
                                            @if(isset($user->wallet) && $defCurrency->currency->code != session()->get('currency')['id'])
                                            <small class="text-primary"><br>
                                                <b>( <i class="{{ session()->get('currency')['value'] }}"></i> {{ sprintf("%.2f",currency($history->amount, $from = $defCurrency->currency->code, $to = session()->get('currency')['id'] , $format = false)) }})</b> 
                                            </small>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            @endif

                            @if(isset($aff_history))
                            <div class="mx-auto width200px"> {!! $aff_history->links() !!} </div>
                            @endif
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> {!! $aff_system->about_system !!} </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account End -->

@endsection
@section('script')
<script>
    $('.copylink').on('click', function () {
        $(this).text('Copied !');
        var copyText = $('.cptext').val();
        console.log(copyText);
        $('.cptext').select();
        document.execCommand("copy");
    });
</script>
@endsection