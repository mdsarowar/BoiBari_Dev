@extends('admin.layouts.master-soyuz')
@section('title',__("Edit Category | "))
@section('body')

<?php
  $data['heading'] = 'Edit Category';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Categories';
  $data['title2'] = 'Edit Category';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 
  <div class="row">
    
    <div class="col-lg-12">

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          @foreach($errors->all() as $error)
          <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></p>
          @endforeach
        </div>
      @endif

      <div class="card m-b-30">

        <div class="card-header">
          
          <div class="row">
            <div class="col-lg-10">
                <h5 class="card-title"> {{__("Edit Category")}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{ url('admin/category') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>

        <div class="card-body">
          <!-- Start Form -->
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/category/'.$cat->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            
            <div class="row">

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__('Category')}}: <span class="required">*</span></label>
                <input placeholder="{{ __('Please enter category name') }}" type="text" id="first-name" name="title" value="{{$cat->title}}" class="form-control col-md-12">
              </div>
              <div class="form-group col-md-6"></div>
              
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__('Icon')}}:</label>
                <!-- <div class="input-group">
                  <input type="text" class="form-control iconvalue" name="icon" value="{{ $cat->icon }}">
                  <span class="input-group-append">
                    <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                  </span>
                </div> -->
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" id="img_upload_input" name="icon" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURLIcon(this);" />
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Icon") }} </label>
                  </div>
                </div> <br>
                <div class="thumbnail-img-block-icon mb-3">
                  @if(@file_get_contents('images/category/'.$cat->icon))
                  <img width="100px" id="image-pre-icon" class="img-fluid bg-primary-rgba p-3" src=" {{url('images/category/'.$cat->icon)}}">
                  @else
                  <img title="{{ $cat->title }}" id="image-pre" class="pro-img" src="{{ Avatar::create($cat['title'])->toBase64() }}" />
                  @endif
                  
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Image")}}: </label>                
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" id="img_upload_input" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);" />
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Profile") }} </label>
                  </div>
                </div><br>
                  <div class="mb-2">
                      @if(@file_get_contents('images/category/'.$cat->image))
                      <img width="100px" id="image-pre" class="img-fluid bg-primary-rgba p-3" src=" {{url('images/category/'.$cat->image)}}">
                      @else
                      <img title="{{ $cat->title }}" id="image-pre" class="pro-img" src="{{ Avatar::create($cat['title'])->toBase64() }}" />
                      @endif
                    </div>
              </div>


              <div class="form-group col-md-12">
                <label class="control-label text-dark" for="first-name"> {{__('Description')}} <span class="required">*</span></label>
                <textarea cols="2" id="editor1" name="description" rows="5"> {{ucfirst($cat->description)}}</textarea>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Featured:")}}</label><br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" name="featured" type="checkbox" id="toggle-event33" {{$cat->featured ==1 ? "checked" : ""}}>
                  <span class="knob"></span>
                </label>
                <br>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("If enabled than Category will be featured")}})</small>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__('Status')}}:</label><br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33" {{$cat->status ==1 ? "checked" : ""}}>
                  <span class="knob"></span>
                  <input type="hidden" name="status" value="{{ $cat->status }}" id="status3">
                </label>
                <br>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please Choose Status")}})</small>
              </div>

            </div>

            <div class="form-group">
              <button @if(env('DEMO_LOCK')==0) type="reset" @else disabled title="{{ __('This operation is disabled is demo !') }}" @endif class="btn btn-danger"><i class="fa fa-ban"></i> {{ __("Reset") }}</button>
              <button @if(env('DEMO_LOCK')==0) type="submit" @else disabled title="{{ __('This operation is disabled is demo !') }}"  @endif class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ __("Update") }}</button>
            </div>
            <div class="clear-both"></div>
          </form>
          <!-- End Form -->

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
  <script>
      $(".midia-toggle").midia({
          base_url: '{{ url('') }}',
          directory_name: 'category'
      });
  </script>
  <script>
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.thumbnail-img-block').show();
          $('#image-pre').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script>
    function readURLIcon(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.thumbnail-img-block').show();
          $('#image-pre-icon').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection