@extends("frontend.layout.master")
@section('title','Emart | $page->name')
@section('meta_tags')
<link rel="canonical" href="{{ url()->current() }}"/>
<meta name="keywords" content="{{ isset($seoset) ? $seoset->metadata_key : '' }}">
<meta property="og:title" content="{{ $page->name }} | {{ isset($seoset) ? $seoset->project_name : config('app.name') }}" />
<meta property="og:description" content="{{substr(strip_tags($page->des), 0, 100)}}{{strlen(strip_tags( $page->des))>100 ? '...' : ""}}" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{ url('images/genral/'.$front_logo) }}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:image" content="{{ url('images/genral/'.$front_logo) }}" />
<meta name="twitter:description" content="{{substr(strip_tags($page->des), 0, 100)}}{{strlen(strip_tags( $page->des))>100 ? '...' : ""}}" />
<meta name="twitter:site" content="{{ url()->current() }}" />
<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"WebPage","description":"{{substr(strip_tags($page->des), 0, 100)}}{{strlen(strip_tags( $page->des))>100 ? '...' : ""}}","image":"{{ url('images/genral/'.$front_logo) }}"}</script>
@endsection
@section("content") 

<!-- Home Start -->
<section id="home" class="home-main-block product-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}" title="{{__('Home')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
                    </ol>
                </nav>
				<div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
					<div class="breadcrumb-nav">
						<h3 class="breadcrumb-title">{{ $page->name }}</h3>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End --> 

<section id="product" class="product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center mt-20">{{ $page->name }}</h3>
                <hr> 
                {!!  $page->des  !!} 
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')

@endsection