<div class="col-lg-3 col-md-4">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link {{$active=='Info'?'active':''}}" href="{{url('profile')}}"><i data-feather="user"></i>{{__('Personal Info')}}</a>
        <a class="nav-link {{$active=='Address'?'active':''}}" href="{{url('manageaddress')}}"><i data-feather="columns"></i>{{ __('Manage Address') }}</a>
        @if($aff_system && $aff_system->enable_affilate == 1)
        <a class="nav-link {{$active=='2Fa'?'active':''}}" href="{{url('2fa')}}"><i data-feather="unlock"></i>{{__('2FA Auth')}}</a>
        <a class="nav-link {{$active=='Affilate'?'active':''}}" href="{{url('user/affiliate/settings')}}"><i data-feather="users"></i>{{ __('Affiliate Dashboard') }}</a>
        @endif
        <a class="nav-link {{$active=='Myorder'?'active':''}}" href="{{url('order')}}"><i data-feather="crosshair"></i>{{ __('My Orders') }}</a>
{{--        <a class="nav-link {{$active=='Mychat'?'active':''}}" href="{{url('mychats')}}"><i data-feather="message-circle"></i>{{ __('My Chats') }}</a>--}}
        <!-- @if($wallet_system == 1) -->
        <a class="nav-link {{$active=='Wallet'?'active':''}}" {{ Nav::isRoute('user.wallet.show') }}" href="{{ route('user.wallet.show') }}"><i data-feather="credit-card"></i> {{ __('My Wallet') }}</a>
        <!-- @endif -->
        <a class="nav-link {{$active=='Failedt'?'active':''}}" href="{{url('myfailedtranscations')}}"><i data-feather="list"></i>{{ __('My Failed Trancations') }}</a>
        <a class="nav-link {{$active=='Ticket'?'active':''}}" href="{{url('mytickets')}}"><i data-feather="file"></i>{{ __('My Tickets') }}</a>
{{--        <a class="nav-link {{$active=='Mybankac'?'active':''}}" href="{{url('mybank')}}"><i data-feather="credit-card"></i>{{ __('My Bank Accounts') }}</a>--}}
        @if($vendor_system == 1)
            @if(empty($sellerac) && Auth::user()->role_id != "a")
            <a class="nav-link" id="v-applysellerac-tab" data-bs-toggle="pill" href="#v-applysellerac" type="button" role="tab" aria-controls="v-applysellerac" aria-selected="false"><i data-feather="check-circle"></i>{{ __('Apply for Seller Account') }}</a>
            @elseif(Auth::user()->role_id != "a")
            <a class="nav-link" id="v-sellerac-tab" data-bs-toggle="pill" href="#v-sellerac" type="button" role="tab" aria-controls="v-sellerac" aria-selected="false"><i data-feather="aperture"></i>{{ __('Seller Dashboard') }}</a>
            @endif
        @endif
        <a class="nav-link {{$active=='ChangePassword'?'active':''}}" href="{{url('change/password')}}"><i data-feather="key"></i>{{ __('Change Password') }}</a>

    </div>
</div>