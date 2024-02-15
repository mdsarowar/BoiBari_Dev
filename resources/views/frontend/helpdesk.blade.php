@extends("frontend.layout.master")
@section('title','Emart | Help Desk')
@section('head-script')
<!-- TinyMCE Editor -->
<script src="{{ url('admin/plugins/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
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
                <li class="breadcrumb-item active" aria-current="page">{{__('Helpdesk & Support')}}</li>
              </ol>
            </nav>
            <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/checkout/breadcrumb.png');">
              <div class="breadcrumb-nav">
                <h3 class="breadcrumb-title">{{__('Helpdesk & Support')}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Home End -->

        <!-- Help Start -->
        <section id="help" class="help-main-block">
            <div class="container">
                <form novalidate class="form" action="{{ route('hdesk.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputIssue" class="form-label">{{__('Issue')}}: <span class="required">*</span></label>
                                <input required type="text" name="issue_title" class="@error('issue_title') is-invalid @enderror form-control">
                                @error('issue_title')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{__('Image')}}: <span class="required">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="file" name="image" class="@error('image') is-invalid @enderror form-control" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    @error('image')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">{{__('Describe your Issue')}} <span class="required">*</span></label>
                                <textarea required name="issue" id="editor1" cols="10" rows="10" class="@error('issue') is-invalid @enderror form-control"></textarea>
                                @error('title')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" title="create ticket" class="btn btn-primary">Create Ticket</button>
                </form>
            </div>
        </section>
            <!-- Help End -->



@endsection
@section('script')
  
@endsection