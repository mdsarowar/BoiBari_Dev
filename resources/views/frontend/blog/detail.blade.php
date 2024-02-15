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
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="{{__('Home')}}">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('blog')}}" title="{{__('Blog')}}">{{__('Blog')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $value->heading }}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('<?= URL::to('/'); ?>/frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ $value->heading }}</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

    <!-- Blog Detail Start -->
    <section id="blog-detail" class="blog-detail-main-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-7">
            <div class="blog-detail-block">
              <div class="blog-dtl-img">
                @if($value->banner != '' && file_exists(public_path().'/images/blog/'.$value->banner))
                  <img src="{{ url('images/blog/'.$value->banner) }}" title="{{ $value->heading }}" class="img-fluid" alt="{{__($value->heading)}}">
                @else
                  <img class="img-fluid" title="{{ $value->heading }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                @endif
                <div class="blog-badge mt-2">
                  <span class="badge text-bg-primary">{{ date('d/m/Y | h:i A',strtotime($value->created_at)) }}</span>
                </div>
                <div class="blog-badge blog-comment-badge mt-2 mb-2">
                  <span class="badge text-bg-warning">{{ $value->comments->count() }} {{__('Comments')}}</span>
                </div>
              </div>
              <div class="blog-detail-dtl">
                <h2 class="blog-title">{{ $value->heading }}</h2>
                <div class="blog-dtl-cat">{{__('By')}} {{ $value->user }}</div>
                <p>{!! $value->des !!}</p>
                <div class="row mb-20">
                  <div class="col-lg-6 col-md-6">
                    <img src="frontend/assets/images/blog/blog_06.png" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <img src="frontend/assets/images/blog/blog_07.png" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
              <div class="blog-dtl-tag">
                <h3 class="section-title">Share</h3>
                <ul>
                  @php
                    echo Share::currentPage(null,[],'<div class="row">', '</div>')
                    ->facebook()
                    ->twitter()
                    ->telegram()
                    ->whatsapp();
                  @endphp
                </ul>
              </div>
              <div class="blog-dtl-btn d-none">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="previous-btn">
                      <a href="#" title="Previous Post" type="button" class="btn btn-info"><i data-feather="arrow-left"></i>Previous Post</a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="next-btn">
                      <a href="#" title="Next Post" type="button" class="btn btn-info">Next Post<i data-feather="arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="reviews-block mt-4">
                <h3 class="section-title">({{ $value->comments->count() }}) {{__('Comment')}}</h3>
                <form class="register-form" role="form" action="{{ route('blog.comment.store',$value->id) }}" method="POST">
                           @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="{{__('Write Name')}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="{{__('Write Email')}}">
                      </div>
                    </div>
                    <div class="col=lg-12">
                      <div class="mb-3">
                        <div class="form-group">
                          <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" placeholder="{{__('Write Reviews')}}" rows="3"></textarea>
                          <button type="submit" title="{{__('Send')}}" class="btn btn-info"><i data-feather="send"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                @if(count($value->comments)>0)
                  @foreach($value->comments->sortByDesc('id')->where('status','1')->take(5) as $comment)
                  <div class="customer-reviews-block">
                    <div class="row">
                      <div class="col-lg-2 col-md-3">
                        <div class="customer-reviews-img">
                          <img title="{{ $comment->name }}" src="{{ Avatar::create($comment->name)->toBase64() }}" class="img-fluid" alt="">
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-9">
                        <div class="customer-review-dtl">
                          <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-6">
                              <h5 class="customer-title">{{ $comment->name }}</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                              <div class="stars stars-example-css">
                                <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                                <i data-feather="star" style="color:#FDBC00; fill: #FDBC00;"></i>
                              </div>
                            </div>
                          </div>
                          <p>{!! $comment->comment !!}</p>
                          <p class="pull-right">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @else 
                  <div class="text-center">
                    <h6>{{__('No Comments')}}</h6>
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-5">
            <div class="order-block">
              <form action="" method="Get" class="search-form">
                <div class="input-group">                        
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" id="search" name="search" placeholder="{{__('Search')}}" aria-label="{{__('Search')}}" value="{{ request()->get('search') }}" aria-describedby="button-addon2">
                      <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i data-feather="search"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="new-post-blog">
              <h3 class="section-title">{{__('Recent Posts')}}</h3>
              
              @if(count($blogs)>0)
                @foreach($blogs as $key => $post)
                <div class="blog-block">
                  <div class="blog-img">
                    <a href="{{ route('front.blog.show',$post->slug) }}" title="{{ $post->heading }}">
                      @if($post->image != '' && file_exists(public_path().'/images/blog/'.$post->image))
                        <img src="{{ url('images/blog/'.$post->image) }}" title="{{ $post->heading }}" class="img-fluid" alt="{{$post->heading}}">
                      @else
                        <img class="img-fluid" title="{{ $post->heading }}" src="{{url('images/no-image.png')}}" alt="No Image" />
                      @endif
                    </a>
                  </div>
                  <div class="blog-post">
                    <div class="row">
                      <div class="col-lg-8 col-8">
                        <div class="blog-date">
                          <ul>
                            <li><a href="{{ route('front.blog.show',$post->slug) }}" title="{{__('Date')}}">{{ date('d/m/Y', strtotime($post->created_at)) }}</a></li>
                            <li><span><a href="{{ route('front.blog.show',$post->slug) }}" title="{{__('User')}}">{{__('By')}} {{ $value->user }}</a></span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-4 col-4">
                        <p><a href="{{ route('front.blog.show',$post->slug) }}" title="{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="blog-dtl">
                    <h4 class="blog-title"><a href="{{ route('front.blog.show',$post->slug) }}" title="{{__('Card Heading')}}">{{__($post->heading)}}</a></h4>
                  </div>
                </div>
                @endforeach
              @else
              <div class="blog-block">
                <h6 class="blog-title">{{__('No Blog')}}</h6>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Blog Detail End -->

@endsection