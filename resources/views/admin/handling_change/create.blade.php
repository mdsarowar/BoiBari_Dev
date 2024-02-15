@extends('admin.layouts.master-soyuz')
@section('title',__('Add Handling Charge |'))
@section('body')

<?php
  $data['heading'] = 'Add Handling Charge';
  $data['title0'] = 'Shipping & Taxes';
  $data['title1'] = 'Handling Charge';
  $data['title2'] = 'Add Handling Charge';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 

  <div class="row">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
      <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button></p>
      @endforeach
    </div>
    @endif

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          
          <div class="row">
            <div class="col-lg-8">
              <h5 class="box-title">{{ __('Add') }} {{ __('Handling Charge') }}</h5>
            </div>
            <div class="col-md-4">
              <div class="widgetbar">
                <a href="{{ url('admin/handling/charge') }}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i> {{__("Back")}}</a>
              </div>
            </div>
          </div> 

        </div>
        <div class="card-body">
        <form id="demo-form2" method="post"  action="{{route('admin.handling.charge.store')}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    {{__('Method Name')}}:
                  </label>

                  <input type="text" name="method_name" 
                    class="form-control col-md-12">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    {{__('price')}}:
                  </label>

                  <input type="number" name="method_price" step="any" value="{{old('method_price')}}"
                    class="form-control col-md-12">
              </div>
              </div>
              <div class="form-group col-md-12">
         
          <button  type="submit" 
            class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Create") }}</button>
        </div>
              </div>
             
        </form>
      </div>
     </div>
   </div>
  </div>
</div>

@endsection