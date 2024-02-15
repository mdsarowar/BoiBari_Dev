@extends("frontend.layout.master")
@section('title','Emart | Blogs')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Blog')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ __('Blog') }}</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

<!-- Blog Start -->
<div id="blog" class="blog-main-block">
    <div class="container">
        <div class="row">
            
            @foreach($blogs as $key => $blog)            
            <div class="col-lg-3 col-md-6">
                <div class="blog-block">
                    <div class="blog-img">
                        <a href="{{ route('front.blog.show',$blog->slug) }}" title="">
                        @if($blog->image != '' && file_exists(public_path().'/images/blog/'.$blog->image))
                            <img src="{{ url('/images/blog/'.$blog->image) }}" class="img-fluid" alt="{{__($blog->heading)}}">
                        @else
                            <img class="img-fluid" title="{{ $blog->heading }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                        @endif
                        </a>
                    </div>
                    <div class="blog-post">
                        <div class="row">
                            <div class="col-lg-8 col-8">
                                <div class="blog-date">
                                    <ul>
                                        <li><a href="{{ route('front.blog.show',$blog->slug) }}" title="{{date('M d,Y', strtotime($blog->created_at))}}">{{date('M d,Y', strtotime($blog->created_at))}}</a></li>
                                        <li><span><a href="{{ route('front.blog.show',$blog->slug) }}" title="{{__('By')}} {{$blog->user}}">{{__('By')}} {{$blog->user}}</a></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-4">
                                <p><a href="{{ route('front.blog.show',$blog->slug) }}" title="{{ read_time($blog->des ) }}">{{ read_time($blog->des ) }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="blog-dtl">
                        <h5 class="blog-title"><a href="{{ route('front.blog.show',$blog->slug) }}" title="{{ __($blog->heading) }}">{{ substr($blog->heading,'0','25') }}..</a></h5>
                        <p>{{ str_limit(strip_tags(html_entity_decode($blog->des)), $limit = 100, $end = '...') }}</p>
                       
                        <a href="{{ route('front.blog.show',$blog->slug) }}" type="button" class="btn btn-primary" title="Read More">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- Blog End -->

@endsection