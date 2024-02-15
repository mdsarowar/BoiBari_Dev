@extends('frontend.layout.master')
@section('title',"Emart | FAQ's")
@section('content')
<!-- Home Start -->
<section id="home" class="home-main-block product-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}" title="{{__('Home')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__("FAQ's")}}</li>
                    </ol>
                </nav>
				<div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
					<div class="breadcrumb-nav">
						<h3 class="breadcrumb-title">{{__("FAQ's")}}</h3>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End --> 
<section id="faq" class="faq-main-block">
	<div class="container">
		@foreach($faqs as $key=> $faq)
			<div class="row">
				<div class="col-lg-12">
					<div class="accordion" id="accordionExample" data-aos="fade-up">
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingOne{{$key}}">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne{{$key}}">
									<span>{{ $key+1 }}.</span> {{ $faq->que }}
								</button>
							</h2>
							<div id="collapseOne{{$key}}" class="accordion-collapse collapse {{$key=='0'?'show':''}}" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									{{ $faq->ans }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</section>
@endsection