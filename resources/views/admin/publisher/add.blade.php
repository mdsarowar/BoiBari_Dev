@extends('admin.layouts.master-soyuz')
@section('title',__('Create a Publisher'))
@section('body')

<?php
  $data['heading'] = 'Add Publisher';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Publishers';
  $data['title2'] = 'Add Publisher';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 
  <div class="row">
   
    <div class="col-lg-12">

      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach
      </div>
      @endif


      <div class="card m-b-30">

        <div class="card-header">
          
          <div class="row">
            <div class="col-lg-10">
                <h5 class="card-title"> {{__("Add Publishers")}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{route('publisher.index')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
{{--                <a href="{{ url('admin/category') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>--}}
              </div>
            </div>
          </div>

        </div>

        <div class="card-body">
          <!-- Form Start -->
{{--          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/category')}}" data-parsley-validate class="form-horizontal form-label-left">--}}
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{route('publisher.store')}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__('Publisher')}}: <span class="required">*</span></label>
                <input placeholder="{{ __('Please enter Publisher name') }}" type="text" id="first-name" name="title" class="form-control col-md-12" value="{{old('title')}}">
              </div>

{{--              <div class="form-group col-md-4">--}}
{{--                <label class="control-label text-dark" for="first-name"> {{__('Icon')}}: </label>           --}}
                  <!-- <div class="input-group">
                    <input type="text" class="form-control iconvalue" name="icon" value="{{ __('Choose icon') }}">
                    <span class="input-group-append">
                      <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                    </span>
                  </div> -->
{{--                  <div class="input-group">--}}
{{--                    <div class="custom-file">--}}
{{--                      <input type="file" id="img_upload_input" name="icon" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURLIcon(this);" />--}}
{{--                      <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Icon") }} </label>--}}
{{--                    </div>--}}
{{--                  </div> <br>--}}
{{--                  <div class="thumbnail-img-block-icon mb-3">--}}
{{--                    <img id="image-pre-icon" class="img-fluid" alt="">--}}
{{--                  </div>--}}
{{--              </div>--}}

              <div class="form-group col-md-6">
                <label class="text-dark control-label" for="first-name"> {{__('Image')}}:</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" id="img_upload_input" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);" />
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Image") }} </label>
                  </div>
                </div> <br>
                <div class="thumbnail-img-block mb-3">
                  <img id="image-pre" class="img-fluid" alt="">
                </div> 
              </div>
              
              <div class="form-group col-md-12">
                <label class="text-dark control-label" for="first-name"> {{__('Description')}} <span class="required"></span></label>
                  <textarea cols="2" id="editor1" name="description" rows="5"> {{old('description')}} </textarea>
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__('Please enter description')}})</small>  
              </div>

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Featured:")}}</label><br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" name="featured" type="checkbox" id="toggle-event33" checked>
                  <span class="knob"></span>
                </label>
              </div>
              
              <div class="form-group col-md-6">
                <label class="text-dark control-label" for="first-name"> {{__('Status')}}: <span class="required">*</span> </label> <br>
                  <label class="text-dark switch">
                    <input class="slider tgl tgl-skewed" type="checkbox" id="status" checked="checked">
                    <span class="knob"></span>
                  </label> <br>
                  <input type="hidden" name="status" value="1" id="status3">
              </div>
            </div>
              
            <div class="form-group">
              <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> {{ __("Reset") }}</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ __("Create") }}</button>
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
          directory_name: 'Publisher'
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
  <script>
    $('.thumbnail-img-block-icon').hide();
    function readURLIcon(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.thumbnail-img-block-icon').show();
          $('#image-pre-icon').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection