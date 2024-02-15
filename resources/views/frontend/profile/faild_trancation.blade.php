@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   

<div style="background-color: #fff8f5">
    <!-- Home Start -->
    <section id="home" class="home-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item">{{__('Account')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('My Failed Transcations')}}</li>
                        </ol>
                    </nav>
                    <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                        <div class="breadcrumb-nav">
                            <h3 class="breadcrumb-title">{{ __('My Failed Transcations') }}</h3>
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
                <?php $active['active'] = 'Failedt'; ?>
                @include('frontend.profile.sidebar',$active)
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="personal-info-block failed-trans-block">
                            <div class="card-header">
                                <h3 class="section-title">{{ __('My Failed Transcations') }} ({{ auth()->user()->failedtxn->count() }})</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table filed-block">
                                        <thead>
                                        <th>#</th>
                                        <th>{{ __('TXN ID') }}</th>
                                        <th>{{ __('Time') }}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($failedtranscations->take(10) as $key=> $ftxn)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><h6>{{ $ftxn->txn_id }}</h6></td>
                                                <td><p>{{ date('d-m-Y h:i A',strtotime($ftxn->created_at)) }}</p></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div> {!! $failedtranscations->links() !!}</div>
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