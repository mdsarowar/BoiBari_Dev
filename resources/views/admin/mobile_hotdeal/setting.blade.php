@extends('admin.layouts.master-soyuz')
@section('title',__('Create a Hotdeal'))
@section('body')

<?php
  $data['heading'] = 'Create a Hotdeal';
  $data['title0'] = 'Marketing';
  $data['title1'] = 'Create a Hotdeal';
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
            <div class="col-lg-8">
              <h5 class="box-title">{{ __('Add Hotdeal') }}</h5>
            </div>
            <div class="col-md-4">
             
            </div>
          </div>
          
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('mobile/hotdeal/store')}}"
            data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$hotdeal?$hotdeal->id:''}}">
            <div class="row">

              <div class="form-group col-md-12">
                <label class="control-label" for="first-name">
                  {{__("Image")}}
                </label>
                <div class="input-group">
                  <input type="file" class="form-control" name="image" placeholder="" />
                </div>
                <img class="mx-auto object-fit" id="preview2" align="center" width="150" height="150" src="{{ url('images/mobile_hotdeal',$hotdeal?$hotdeal->image:'') }}" alt="">
              </div>

              <div class="form-group col-md-6">
                <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                  {{ __("Reset") }}</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                  {{ __("Create") }}</button>
              </div>

              <div class="clear-both"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
  <script>
    $('#link_by').on('change',function(){

      if($(this).val() == 'sp'){

        $('.variantproduct').addClass('d-none').removeClass('d-block');
        $('.simpleproduct').addClass('d-block').removeClass('d-none');

      }

      if($(this).val() == 'vp'){

        $('.variantproduct').addClass('d-block').removeClass('d-none');
        $('.simpleproduct').addClass('d-none').removeClass('d-block');

      }

    });
  </script>
@endpush