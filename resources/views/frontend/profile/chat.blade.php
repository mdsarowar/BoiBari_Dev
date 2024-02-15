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
            <li class="breadcrumb-item active" aria-current="page">{{__('Chat')}}</li>
          </ol>
        </nav>
        <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
          <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">{{__('Chat')}}</h3>
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
            <?php $active['active'] = 'Mychat'; ?>
          @include('frontend.profile.sidebar',$active)
          <div class="col-lg-9 col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
                
                <div class="chat-main-block">
                    <div class="mb-20">
                        <h5 class="card-title"><i class="feather icon-message-circle"></i>{{__('My Chats')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            @if(isset($conversations))
                                @forelse($conversations as $chat)
                                    <div class="shadow-sm card mb-3 border chat-conversation">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="chat-conversation-block">
                                                        <h6 class="box-title">{{__('Conversation ID')}}</h6>
                                                        <p><a href="{{ route('user.chat.view',$chat->conv_id) }}">{{ $chat->conv_id }}</a></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="chat-conversation-block">
                                                        <h6 class="box-title">{{__('Conversation with')}}</h6>
                                                        <p>{{ $chat->sender->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="chat-conversation-block">
                                                        <h6 class="box-title">{{__('Last Message')}}</h6>
                                                        <p> <b><?php if(isset($chat->chat->last()->message)){ echo $chat->chat->last()->message; } ?> </b> {{ __('from') }} <?php  if(isset($chat->chat->last()->user->name)){ echo $chat->chat->last()->user->name; } ?> -  <?php if(isset($chat->chat->last()->created_at)){ echo $chat->chat->last()->created_at->format('jS M Y - h:i A'); } ?>  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="chat-list">
                                <div class="chat-search">
                                    <div class="order-block">
                                        <form class="search-form">
                                            <div class="input-group">                        
                                                <div class="form-group">
                                                    <input type="search" name="user" class="form-control" id="search" placeholder="Search">
                                                    <button type="submit">
                                                        <div class="search-icon">
                                                            <i data-feather="search"></i>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="chat-user-list">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($users as $user)
                                            <a href="{{ route('adminchat.start',$user->id) }}">
                                                <li class="media">
                                                    @if($user->image != '' && file_exists(public_path().'/images/user/'.$user->image))
                                                        <img class="align-self-center mr-3 rounded-circle img-fluid" src="{{ url('images/user/'.$user->image) }}"/>
                                                    @else 
                                                        <img class="align-self-center mr-3 rounded-circle img-fluid" src="{{ Avatar::create($user->name)->toBase64() }}"/>
                                                    @endif
                                                    <div class="media-body">
                                                        <h5>{{ $user->name }}</h5>
                                                        @if($user->role_id=='a')
                                                        <p>Admin</p>
                                                        @elseif($user->role_id=='c')
                                                        <p>Customer</p>
                                                        @else
                                                        <p>Vendor</p>
                                                        @endif
                                                    </div>
                                                </li>
                                            </a>  
                                        @endforeach     
                                    </ul>
                                    <small>{!! $users->links() !!}</small>  
                                </div>
                            </div>
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
<script src="{{ url('frontend/assets/vendor/chat/custom-chat.js') }}"></script>
<script src="{{ url('frontend/assets/js/jquery.slimscroll.js') }}"></script>
@endsection
