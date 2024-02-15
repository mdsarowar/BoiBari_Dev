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
            <li class="breadcrumb-item">{{__('Chat')}}</li>
            <li class="breadcrumb-item active" aria-current="page">
                @if($conversation->sender_id == auth()->id())
                    {{__("Chat with")}} {{ $conversation->reciever->name }}
                @else 
                    {{__("Chat with")}} {{ $conversation->sender->name }}
                @endif
            </li>
          </ol>
        </nav>
        <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
          <div class="breadcrumb-nav">
              <h3 class="breadcrumb-title">
                @if($conversation->sender_id == auth()->id())
                    {{__("Chat with")}} {{ $conversation->reciever->name }}
                @else 
                    {{__("Chat with")}} {{ $conversation->sender->name }}
                @endif
            </h3>
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
                        <div class="row">       
                            <div class="col-lg-12">
                                <div class="chat-detail">
                                    <div class="chat-head">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="media">
                                                        @if($conversation->sender_id == auth()->id() && file_exists(public_path() . '/images/user/' . $conversation->reciever->image) && $conversation->reciever->image)
                                                        <img class="align-self-center mr-3 rounded-circle" src="{{ url('images/user/'.$conversation->reciever->image) }}" alt="Profile">
                                                        @elseif($conversation->sender && file_exists(public_path() . '/images/user/' . $conversation->sender->image) && $conversation->sender->image)
                                                        <img class="align-self-center mr-3 rounded-circle" src="{{ url('images/user/'.$conversation->sender->image) }}" alt="Profile">
                                                        @else
                                                            @if($conversation->sender_id == auth()->id())
                                                            <img class="align-self-center mr-3 rounded-circle" src="{{ Avatar::create($conversation->reciever->name)->toBase64() }}" alt="Profile">
                                                            @else
                                                            <img class="align-self-center mr-3 rounded-circle" src="{{ Avatar::create($conversation->sender->name)->toBase64() }}" alt="Profile">
                                                            @endif    
                                                        @endif
                                                        <div class="media-body">
                                                            <h5>
                                                                @if($conversation->sender_id == auth()->id())
                                                                    {{__("Chat with")}} {{ $conversation->reciever->name }}
                                                                @else 
                                                                    {{__("Chat with")}} {{ $conversation->sender->name }}
                                                                @endif
                                                            </h5>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="chat-back-btn">
                                                    <a href="#" title="back" type="button" class="btn btn-primary">Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-body">
                                        @forelse($conversation->chat as $chat)
                        
                                            @if(auth()->id() != $chat->user_id)
                                                <div class="chat-message chat-message-left">
                                                    <div class="chat-message-text">
                                                        @if($chat->type == 'media' )
                                                            <span>
                                                                <a href="{{ url('images/conversations/'.$chat->media) }}" data-lightbox="image-1" data-title="{{ $chat->media }}">    
                                                                    <img src="{{ url('images/conversations/'.$chat->media)  }}" alt="{{ $chat->media }}" class="img-fluid img-thumbnail">
                                                                </a>
                                                            </span>
                                                        @else
                                                            <span>{{$chat->message}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="chat-message-meta">
                                                        <span>{{ $chat->created_at->format('d-m-Y - h:i A') }}<i class="feather icon-check ml-2"></i></span>
                                                    </div>
                                                </div> 
                                            @else 
                                                <div class="chat-message chat-message-right">
                                                    <div class="chat-message-text">
                                                        @if($chat->type == 'media' )
                                                            <span>
                                                                <a href="{{ url('images/conversations/'.$chat->media) }}" data-lightbox="image-1" data-title="{{ $chat->media }}">    
                                                                    <img src="{{ url('images/conversations/'.$chat->media)  }}" alt="{{ $chat->media }}" width="300px" class="img-fluid img-thumbnail">
                                                                </a>
                                                            </span>
                                                        @else
                                                            <span>{{$chat->message}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="chat-message-meta">
                                                        <span>{{ $chat->created_at->format('d-m-Y - h:i A') }}<i class="feather icon-check ml-2"></i></span>
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                            <h4 class="no_conv text-center text-muted">
                                                <i class="fa fa-commenting-o"></i> {{__("Start a conversation with ")}} 
                                                @if($conversation->sender_id == auth()->id())
                                                    {{ $conversation->reciever->name }}
                                                @else 
                                                    {{ $conversation->sender->name }}
                                                @endif
                                            </h4>

                                        @endforelse
                                        <div class="chatscreen"></div>
                                    </div>
                                    <div class="chat-bottom">
                                        <div class="chat-messagebar">
                                            <!-- <form>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-round btn-secondary-rgba" type="button" id="button-addonmic"><i class="feather icon-mic"></i></button>
                                                    </div>  
                                                    <input type="text" class="form-control" placeholder="Type a message..." aria-label="Text">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-round btn-secondary-rgba" type="submit" id="button-addonlink"><i class="feather icon-link"></i></button>
                                                        <button class="btn btn-round btn-primary-rgba" type="button" id="button-addonsend"><i class="feather icon-send"></i></button>
                                                    </div>
                                                </div>
                                            </form> -->
                                            <form class="chatform" id="chatform" action="javascript:void(0)" enctype="multipart/form-data">

                                                <div class="input-group">
                                                    <input required autofocus type="text" name="message" class="typemessage form-control" placeholder="Type a message..." aria-label="Text">
                                                    <div class="input-group-append">
                                                        <input accept="image/*" type="file" name="media" class="d-none file_choose form-control">
                                                        <button class="btn btn-round btn-secondary-rgba" type="button" id="button-addonlink"><i data-feather="image"></i></button>
                                                        <button class="sendMessage btn btn-round btn-primary-rgba" type="button" id="button-addonsend"><i data-feather="send"></i></button>
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
    </div>
</section>
    <!-- My Account End -->

@endsection
@section('script')
<script>
	var baseUrl = @json(url('/'));
</script>
<script src="{{ url('js/order.js') }}"></script>
<script src="{{ url('js/lightbox.min.js') }}"></script>
<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
<script src="{{ url('frontend/assets/vendor/chat/custom-chat.js') }}"></script>
<script src="{{ url('frontend/assets/js/jquery.slimscroll.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    setTimeout(() => {
        scrolldown();
    }, 1000);

    function scrolldown(){
        $('body').css('overflow','auto');
        var objDiv = document.getElementById("chat-body");
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    var rec_msg_sound = new Audio(@json(url('admin_new/assets/sounds/note.mp3')));
    var typing_sound = new Audio(@json(url('admin_new/assets/sounds/typingsound.mp3')));
    var rec = @json($conversation->sender_id == auth()->id() ? $conversation->receiver_id : $conversation->sender_id);
    console.log(rec);
    var conv_id = @json($conversation->id);
    var id = @json(auth()->id());

    $('.sendMessage').on('click',function(){

        if($('.file_choose').val() == '' && $('.typemessage').val() == ''){
            alert('Message or media is required !');
            return false;
        }

        "use Strict";
        message();
        
    });

    $('.chatform').on('submit',function(){

        "use Strict";

        message();

    });

    $('#button-addonlink').on('click',function(){
        $('.file_choose').click();
    });

    $('.file_choose').on('change', function(e) {
        if (!confirm("are you sure want to sent this file "+ e.target.files[0].name+'?')) {
            e.preventDefault();
            $('.file_choose').val('');
        }else{
            message();
        }
    });

    function message(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData =  new FormData($('#chatform')[0]);

        formData.append('rec_id',rec);

        $.ajax({
            method : 'POST',
            url  : @json(route('send.message',$conversation->id)),
            dataType : 'json',
            data : formData,
            cache : false,
            contentType: false,
            processData: false,
            success : function(response){

                if(response.status == 'success'){


                }else{
                    alert('Failed to sent message: '+response.message);
                    return false;
                }
            }
        });

        
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var secret = @json(env('PUSHER_APP_KEY'));

    var cluster = @json(env("PUSHER_APP_CLUSTER"));

    var pusher = new Pusher(secret, {
        cluster: cluster
    });


    /** if you recieve some message */

    var channel = pusher.subscribe('chat-message');

    

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    // This will apply the debounce effect on the keyup event
    // And it only fires 500ms or half a second after the user stopped typing

    //sent event that user is stopped typing
    $('.typemessage').on('keyup', debounce(function () {

        // alert('typig close');
        
        $.ajax({
            method : 'POST',
            url  : @json(route('typing.message',$conversation->id)),
            dataType : 'json',
            data : {typing : 0, receiver_id : rec },
            success : function(response){
                
                if(response.status == 'success'){
                    
                }else{
                    console.log('Failed to sent indication: '+response.message);
                    return false;
                }
            }
        });

    }, 500));

    //sent event that user is stopped typing

    $('.typemessage').on('keypress',function (){
         $.ajax({
            method : 'POST',
            url  : @json(route('typing.message',$conversation->id)),
            dataType : 'json',
            data : {typing : 1, receiver_id : rec },
            success : function(response){
                if(response.status == 'success'){
                  
                }else{
                    console.log('Failed to sent indication: '+response.message);
                    return false;
                }
            }
        });

    });

    channel.bind('conversation_'+conv_id+'_user_'+id, function (data) {

        var rec_message = data.data.message;
        var time = data.data.time;

        $('.no_conv').html('');

        if(data.data.type != 'media'){
            $(".chatscreen").append('<div class="chat-message chat-message-left"><div class="chat-message-text"><span>'+rec_message+'</span></div><div class="chat-message-meta"><small>'+time+'<i class="feather icon-check ml-2"></i></small></div></div>');
        }else{
            $(".chatscreen").append('<div class="chat-message chat-message-left"><div class="chat-message-text"> <a href="'+data.data.media+'" data-lightbox="image-1" data-title="image"><img src="'+data.data.media+'" width="300px" class="img-fluid img-thumbnail"></a></div><div class="chat-message-meta"><small>'+time+'<i class="feather icon-check ml-2"></i></small></div></div>');
        }
       
        scrolldown();
        rec_msg_sound.play();

    });

    var channel2 = pusher.subscribe('chat-msg-own');

    channel2.bind('conversation_own_'+conv_id+'_user_'+id, function (data) {

        var rec_message = data.data.message;
        var time = data.data.time;

        $('.no_conv').html('');

        if(data.data.type != 'media'){
            $(".chatscreen").append('<div class="chat-message chat-message-right"><div class="chat-message-text"><span>'+rec_message+'</span></div><div class="chat-message-meta"><small>'+time+'<i class="feather icon-check ml-2"></i></small></div></div>');
        }else{
            $(".chatscreen").append('<div class="chat-message chat-message-right"><div class="chat-message-text"> <a href="'+data.data.media+'" data-lightbox="image-1" data-title="image"><img src="'+data.data.media+'" width="300px" class="img-fluid img-thumbnail"></a></div><div class="chat-message-meta"><small>'+time+'<i class="feather icon-check ml-2"></i></small></div></div>');
        }

        $('.typemessage').val('');
        $('.file_choose').val('');
       
        scrolldown();

    });

    /** if your reciver is typing on this converation */

    var typing_channel = pusher.subscribe('typing-channel');

    typing_channel.bind('typing-event-conv-'+conv_id+'-user-'+id, function (data) {


        $('.indicators_status').html('');

        if(data.typingstatus == true){
            typing_sound.play();
            $(".indicators_status").html('<i class="fa fa-commenting-o"></i> Typing...');
        }else{
            typing_sound.pause();
            typing_sound.currentTime = 0;
            $('.indicators_status').html('');
        }


    });
    
</script>
@endsection

