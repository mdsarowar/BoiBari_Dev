@extends('admin.layouts.master-soyuz')
@section('title',__('Create a Brand | '))
@section('body')

<?php
  $data['heading'] = 'Create a Brand';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Brand';
  $data['title2'] = 'Create a Brand';
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
                <h5 class="card-title"> {{__("Create a Brand")}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{ url('admin/brand') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data"
        action="{{url('admin/brand')}}" data-parsley-validate class="form-horizontal form-label-left">
        {{csrf_field()}}
        
        <div class="row">
          <div class="form-group col-md-6">
            <label class="control-label text-dark" for="first-name">
              {{__('Brand Name')}}: <span class="required">*</span>
            </label>
              <input placeholder="{{ __('Please enter brand name') }}" type="text" id="first-name" name="name" class="form-control col-md-12" value="{{ old('name') }}">
          </div>

          <div class="form-group col-md-6">
            <label class="control-label text-dark" for="first-name">
              Select Category: <span class="required">*</span>
            </label>
              <select multiple="multiple" class="form-control select2" name="category_id[]">
                <option value="">Select Category</option>
                @foreach (App\Category::where('status','1')->get(); as $item)
                  <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
              </select>
          </div>

          <div class="form-group col-lg-6">
            <label class="control-label text-dark" for="first-name">
              {{__("Brand Logo")}} <span class="required">*</span>
            </label>
            <!-- <div class="input-group">
              <input required readonly id="image" name="image" type="text" class="form-control">
              <div class="input-group-append">
                  <span data-input="image" class="bg-primary text-light midia-toggle input-group-text">{{ __("Browse") }}</span>
              </div>
            </div>
            <small class="txt-desc">({{__("Please Choose Brand Logo")}})</small> -->
            <div class="input-group">
              <div class="custom-file">
                <input type="file" id="img_upload_input" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);" />
                <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Profile") }} </label>
              </div>
            </div> <br>
            <div class="thumbnail-img-block mb-3">
              <img id="image-pre" class="img-fluid" alt="">
            </div> 
          </div>

          <div class="form-group col-md-3">
            <label class="text-dark">
              {{__('Status')}}:
            </label><br>
            <label class="switch">
              <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"   checked="checked">
              <span class="knob"></span>
            </label>
            <br>
            <input type="hidden" name="status" value="1" id="status3">
            <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Choose status for your brand")}})</small>
            </div>
            <div class="form-group col-md-3">
              <label class="text-dark">
              {{__('Show image in footer')}}:
              </label><br>
              <label class="switch">
                <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"   checked="checked">
                <span class="knob"></span>
              </label>
              <br>
              <input type="hidden" name="show_image" value="1" id="status3">
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("If You Choose Active Then Image Show In Footer Brand Logo")}})</small>
              </div>
            <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
              {{ __("Reset") }}</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
              {{ __("Create") }}</button>
          </div>
        </div>

        <div class="clear-both"></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
  <script>
      $(".midia-toggle").midia({
          base_url: '{{url('')}}',
          directory_name: 'brand',
          dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          }
      });
  </script>
  <script>
    $('.thumbnail-img-block').hide();
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
@endsection