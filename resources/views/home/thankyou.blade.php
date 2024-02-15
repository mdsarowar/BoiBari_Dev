@extends("frontend.layout.master")
@section('title',__('Emart | Order Placed Successfully |'))
@section("content")  
    <!-- Order Confirm Start -->
    <section id="order-confirm" class="order-confirm-main-block">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="thankyou-content text-center my-5">
              <img width="350px" src="{{ url('images/thankyou.svg') }}" class="img-fluid mb-5" alt="thankyou">
              <h2 class="text-success">{{__('Thank You')}} !!!</h2>
              <p class="my-4">{{__('Your Order has been successfully placed. Your Order ID is')}} #{{ app('request')->input('orderid') ?? '' }}</p>
              <div class="button-list">
              <a href="{{ app('request')->input('orderid') ? route('user.view.order',app('request')->input('orderid')) : 'javascript:' }}" role="button" class="btn btn-primary font-16"><i class="feather icon-map-pin "></i>{{__('View Order')}}</a>
              <a href="{{url('/')}}" role="button" class="btn btn-success font-16"><i class="feather icon-file-text"></i>{{__('Continue Shopping')}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Order Confirm End -->
@endsection