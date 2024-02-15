@extends("frontend.layout.master")
@section('title','Emart | My Account')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item">{{__('Account')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('My Tickets')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ __('My Tickets') }}</h3>
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
            <?php $active['active'] = 'Ticket'; ?>
            @include('frontend.profile.sidebar',$active)
            <div class="col-lg-9 col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="personal-info-block ticket-block">
                        <div class="card-header">
                            <h3 class="section-title">{{ __('My Tickets') }} ({{ auth()->user()->ticket->count() }})</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Ticket No') }}.</th>
                                        <th>{{ __('Issue') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('View') }}</th>
                                    </tr>
                                </thead>
                                @php
                                $tickets = App\HelpDesk::where('user_id','=',Auth::user()->id)->latest()->paginate(10);
                                @endphp
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td><span class="font-weight500 font-size-12">#{{ $ticket->ticket_no }}</span></td>
                                        <td>{{ $ticket->issue_title }}</td>
                                        <td>
                                            @if($ticket->status =="open")
                                            <p class="font-weight-bold"><i data-feather="volume"></i> <span class="badge badge-secondary">{{ ucfirst($ticket->status) }}</span></p>
                                            @elseif($ticket->status=="pending")
                                            <p class="font-weight-bold"><i data-feather="clock"></i> <span class="badge badge-primary">{{ ucfirst($ticket->status) }}</span></p>
                                            @elseif($ticket->status=="closed")
                                            <p class="font-weight-bold text-secondary"><i data-feather="slash"></i>  <span class="badge badge-dark">{{ ucfirst($ticket->status) }}</span></p>
                                            @elseif($ticket->status=="solved")
                                            <p class="font-weight-bold"><i data-feather="check"></i> <span class="badge badge-success">{{ ucfirst($ticket->status) }}</span></p>
                                            @endif
                                        </td>
                                        <td><a title="view" data-bs-toggle="modal" data-bs-target="#ticket{{ $ticket->id }}" href="javascript:" data-toggle="modal"><i data-feather="eye"></i></a></td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ticket{{ $ticket->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModal">
                                                    #{{ $ticket->ticket_no }} {{ $ticket->issue_title }}
                                                    @if($ticket->status =="open")
                                                    <p class="font-weight-bold info"><i data-feather="volume"></i> <span class="badge badge-secondary">{{ ucfirst($ticket->status) }}</span></p>
                                                    @elseif($ticket->status=="pending")
                                                    <p class="font-weight-bold warning"><i data-feather="clock"></i> {{ ucfirst($ticket->status) }}</p>
                                                    @elseif($ticket->status=="closed")
                                                    <p class="font-weight-bold secondary"><i data-feather="slash"></i> {{ ucfirst($ticket->status) }}</p>
                                                    @elseif($ticket->status=="solved")
                                                    <p class="font-weight-bold success"><i data-feather="check"></i> {{ ucfirst($ticket->status) }}</p>
                                                    @endif 
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{!! $ticket->issue !!}</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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

@endsection

