@extends('admin.layouts.master-soyuz')
@section('title',__('Add Special Offer |'))
@section('body')

<?php
  $data['heading'] = 'Add Special Offers';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Special Offers';
  $data['title2'] = 'Add Special Offers';
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
                <h5>{{ __('Add Special Offer') }}</h5>
              </div>
              <div class="col-md-2">
                <div class="widgetbar">
                  <a href="{{url('admin/special/')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                </div>
              </div>
            </div>
            
        </div>
        <div class="card-body">

          <!-- form start -->
          <form action="{{url('admin/special')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
            {{csrf_field()}}

            <!-- row start -->
            <div class="row">

              <div class="form-group col-md-6">
                <label for="">{{ __("Belongs To:") }}</label>
                <select required name="link_by" id="link_by" class="select2 form-control">
                  <option value="sp">{{ __("Link with simple product") }}</option>
                  <option value="vp">{{ __("Link with variant product") }}</option>
                </select>
              </div>

              <div class="simpleproduct form-group col-md-6">
                <label class="control-label" for="first-name">
                  {{  __('Select Simple Product') }} <span class="required">*</span>
                </label>

                <select name="simple_pro_id" class="form-control select2 col-md-12">
                  <option value="">{{ __('Please Select Product')  }}</option>
                  @foreach($simple_products as $key => $sp)
                  <option value="{{$key}}">{{$sp}}</option>
                  @endforeach
                </select>

              </div>


              <div class="d-none variantproduct form-group col-md-6">
                <label class="control-label" for="first-name">
                  {{  __('Select Variant Product') }} <span class="required">*</span>
                </label>

                <select name="pro_id" class="form-control select2 col-md-12">
                  <option value="">{{ __('Please Select Product')  }}</option>
                  @foreach($products as $key => $pro)
                  <option value="{{$key}}">{{$pro}}</option>
                  @endforeach
                </select>

              </div>

              <!-- Status -->
              <div class="form-group col-md-6">
                <label for="exampleInputDetails">{{ __('Status') }} </label><br>
                <label class="switch">
                  <input class="slider" type="checkbox" name="status" checked />
                  <span class="knob"></span>
                </label><br>
                <small>{{ __('(Please Choose Status)')  }}</small>
              </div>

              <!-- create and close button -->
              <div class="col-md-12">
                <div class="form-group">
                  <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                    {{ __("Create")}}</button>
                </div>
              </div>

            </div><!-- row end -->

          </form>
          <!-- form end -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@push('script')
<script>
  $('#link_by').on('change', function () {

    if ($(this).val() == 'sp') {

      $('.variantproduct').addClass('d-none').removeClass('d-block');
      $('.simpleproduct').addClass('d-block').removeClass('d-none');

    }

    if ($(this).val() == 'vp') {

      $('.variantproduct').addClass('d-block').removeClass('d-none');
      $('.simpleproduct').addClass('d-none').removeClass('d-block');

    }

  });
</script>
@endpush